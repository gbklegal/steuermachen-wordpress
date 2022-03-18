<?php

/**
 * theme base url
 */
define('STM_THEME_URL', get_template_directory_uri());


function add_enqueue_script_attributes( $tag, $handle ) {
    // Add defer
    if( 'defer' === $handle ) {
         return str_replace( ' src="', ' defer src="', $tag );
    }

    // Add async
    if( 'async' === $handle ) {
         return str_replace( ' src="', ' async src="', $tag );
    }

    return $tag;
}

add_filter('script_loader_tag', 'add_enqueue_script_attributes', 10, 2);


function steuermachen_theme_setup() {
    $customLogoDefaults = array(
        'width'                => 42,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
    );
 
    add_theme_support( 'custom-logo', $customLogoDefaults );


    add_theme_support('post-thumbnails', array(
        'post',
        'page',
        'custom-post-type-name',
    ));

    // remove read more on the_excerpt but keep the three dots
    add_filter('excerpt_more', function() { return '...'; });
}
add_action( 'init', 'steuermachen_theme_setup');


/**
 * Helper function
 * get image only by attachment ID like wp_get_attachment_image without the advanced settings and uneditable sizes
 * 
 * @param attachment_id
 * @param size
 * @param class_name
 * 
 * @return string
 */
function get_image_by_id( int $attachment_id, string $size, string $class_name = '', string $img_alt = '' ):string {
    $attachment_id = absint($attachment_id);
    $img_url = wp_get_attachment_image_url($attachment_id, $size);

    if ($img_alt === '') {
        $img_alt = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
    }

    if ($class_name !== '') {
        $class_name = ' class="'.$class_name.'"';
    }

    $html = '<img src="'.$img_url.'" alt="'.$img_alt.'"'.$class_name.'>';

    return $html;
}


/**
 * Replace the_excerpt "more" text with a link
 *
 */
function ld_new_excerpt_more($more) {
    global $post;
    return '...<p><a class="more-link" href="'. get_permalink($post->ID) . '">weiterlesen</a></p>';
}
add_filter('excerpt_more', 'ld_new_excerpt_more');


/**
 * change the default length of the_excerpt string length
 * 
 * @param int $length
 * 
 * @return int
 */
function replace_excerpt_length( ){
    // 20 means 20 words
    return 20;
}
add_filter('excerpt_length', 'replace_excerpt_length');



/**
 * initilize steuermachen theme
 * with the help of add_action init
 */
function init_stm_theme() {
    /**
     * initilize (register) nav menus
     * these are later accessible via wp_nav_menu()
     * @see https://developer.wordpress.org/themes/functionality/navigation-menus/#display-menus
     */
    register_nav_menus([
        'primary' => __( 'Header Navigation' ),
        'footer_1' => __( 'Footer - Über steuermachen.de' ),
        'footer_2' => __( 'Footer - Rechtliche Dokumente' ),
        'footer_3' => __( 'Footer - Kooperation | Wir helfen dir' ),
    ]);
}
add_action( 'init', 'init_stm_theme' );



/**
 * helper function
 * 
 * @param string $query
 * @param string $post_type (Optional)
 * 
 */
function get_search_results( string $query, ?string $post_type = null ):array {
    $args = ['s' => $query];

    if (true === is_string($post_type))
        $args['post_type'] = $post_type;

    $the_query = new WP_Query($args);

    if ($the_query->have_posts())
        while ($the_query->have_posts()) {
            $the_query->the_post();

            the_ID();
            echo '<br>';
            the_title();
            echo '<br>' . get_post_type();
            echo '<br>';
            the_permalink(get_the_ID());

            echo '<br><br>';
        }

    return [];
}

// get_search_results('demo', 'page');

// exit;


/**
 * helper function
 * 
 * @param string $theme_location_name
 * @param array $args
 * 
 * @return void
 */
function get_nav_menu( string $theme_location_name, array $args = array() ):void {
    $array = array(
        'theme_location' => $theme_location_name
    );
    $array = array_merge($array, $args);
    
    wp_nav_menu($array);
}


/**
 * get table of contents from html string
 * @see http://www.10stripe.com/articles/automatically-generate-table-of-contents-php.php#script
 * 
 * @param string $html_string
 * @param int $depth (5) - (optional)
 * 
 * @return string
 */
function table_of_contents( string $content, int $depth = 5 ):string {

    // get the headings down to the specified depth
    $pattern = '/<h[2-'.$depth.']*[^>]*>(.*?)<\/h[2-'.$depth.']>/';
    preg_match_all($pattern, $content, $matches);

    // reformat the results to be more usable
    $list_items = '';
    foreach ($matches[1] as $match) {
        $title = $match;
        $slug = _wp_to_kebab_case($title);

        if ($title == '' || $slug == '')
            continue;

        $list_items .= '<li><a href="#'.$slug.'">'.$title.'</a></li>';
    }

    return $list_items;
}


/**
 * This function adds nice anchor with id attribute to our h* tags for reference
 * @link: http://www.w3.org/TR/html4/struct/links.html#h-12.2.3
 * @see: http://bigemployee.com/adding-id-attributes-to-h2-tags-in-wordpress-to-use-as-anchor-tag/
 */
function anchor_content_h( $content) {
    // depth how far we want to go
    $depth = 5;

    // Pattern that we want to match
    $pattern = '/<h[2-'.$depth.']*[^>]*>(.*?)<\/h[2-'.$depth.']>/';

    // now run the pattern and callback function on content
    // and process it through a function that replaces the title with an id 
    $content = preg_replace_callback($pattern, function($matches) {
        $depth = 5;
        $head = $matches[0];
        $title = $matches[1];
        $slug = _wp_to_kebab_case($title);

        $head = preg_replace('/<h([2-' . $depth . '])>/', '<h$1 id="'.$slug.'">', $head);

        return $head;
    }, $content);

    return $content;
}
add_filter('the_content', 'anchor_content_h');

// function table_of_contents_init( string $html_string, int $depth = 5 ) {
//     $pattern = '/<h[2-'.$depth.']*[^>]*>.*?<\/h[2-'.$depth.']>/';
//     preg_match_all($pattern, $html_string, $matches);

//     $heads = implode("\n", $matches[0]);
//     $heads = preg_replace('/<h([1-' . $depth . '])>/', '<h$1 id="#$2">', $heads);
//     $heads = preg_replace('/<\/h[1-' . $depth . ']>/', '</h$1>', $heads);

//     var_dump($heads);
// }


/**
 * ***********************************
 * 
 * Shortcodes
 * 
 * ***********************************
 */


/**
 * Temporary shortcode to satisfy coding
 */
function tmp_shortcode_content() {
    include __DIR__ . '/tmp_shortcode_content.php';
}
add_shortcode('tmp_content', 'tmp_shortcode_content');


/**
 * Utility Shortcode
 * Get Image (Attachment) by ID.
 * 
 * @param array $atts
 * 
 * @return string
 */
function get_attachment_shortcode( $atts ):string {
    // keep default if not used later
    $attachment_attr = array();

    // image id
    $image_id = $atts['id'] ?? false;

    // image width
    $image_width = $atts['width'] ?? 'auto';

    // image height
    $image_height = $atts['height'] ?? 'auto';

    // check if width or height is a number
    if (is_numeric($image_width) || is_numeric($image_height)) {
        // add width and height to image size array even they contain 'auto'
        $image_size = [
            $image_width,
            $image_height
        ];
    } else {
        // image size
        $image_size = $atts['size'] ?? '';
    }

    // class (overwrite)
    $class = $atts['class'] ?? null;

    // check if a class was set
    if (false === is_null($class))
        $attachment_attr['class'] = $class;

    // return image as HTML string or a empty string if failed
    return wp_get_attachment_image( $image_id, $image_size, false, $attachment_attr );
}
add_shortcode('image', 'get_attachment_shortcode');


/**
 * Utility function
 * Get Image (Attachment) by ID.
 * 
 * Function version of the image shortcode.
 * 
 * @param string $image_id
 * @param string $image_size - optional (Default: '')
 * @param string $class - optional (Default: null)
 */
function get_attachment( $image_id, $image_size = '', $class = null ) {
    return get_attachment_shortcode( [
        'id' => $image_id,
        'size' => $image_size,
        'class' => $class
    ] );
}


/**
 * Utility function
 * Echo Image (Attachment) by ID.
 * 
 * Function version of the image shortcode.
 * 
 * @param string $image_id
 * @param string $image_size - optional (Default: '')
 * @param string $class - optional (Default: '')
 */
function the_attachment( $image_id, $image_size = '', $class = null ) {
    echo get_attachment( $image_id, $image_size, $class );
}


/**
 * CTA Button Shortcode
 */
function cta_button_shortcode( $atts ) {
    $href = $atts['href'] ?? '#';
    $value = $atts['value'] ?? '';
    $size = $atts['size'] ?? false;
    $theme = $atts['theme'] ?? false;

    if ($size !== false)
        $size = ' btn-' . $size;

    if ($theme !== false)
        $theme = ' btn-' . $theme;

    echo '<a class="btn' . $size . $theme . '" href="' . $href . '">' . $value . '</a>';
}
add_shortcode('cta_button', 'cta_button_shortcode');


/**
 * Remove input wrapper from WP Contact Form 7 plugin.
 */
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});


/**
 * Add class attribute to the posts navigation.
 * Turn them from a link (anchor tag) to a button (look).
 */
add_filter('next_posts_link_attributes', 'post_link_attributes');
add_filter('previous_posts_link_attributes', 'post_link_attributes');

function post_link_attributes($output) {
    return 'class="btn btn-primary"';
}


/**
 * get the trusted shops rating from the last year
 * 
 * TODO add optional error resporting (show response_code)
 * TODO replace current api request with wp_remote_get/wp_remote_post (more: https://deliciousbrains.com/wordpress-http-api-requests/)
 * 
 * To avoid high traffic on the trusted shops api because the number isn't changing rapidly,
 * the rating is getting stored in an cookie for an hour and from there beeing loaded.
 * 
 * @param array $attr
 * - @param string $period - optional (Default: all)
 * 
 * @return string
 */
function trusted_shops_rating( array $attr = [] ):string {
    $period = $attr['period'] ?? 'all';

    /**
     * helper function to set cookies for 1 hour
     * 
     * @param string $cookie_name
     * @param string $cookie_value
     * 
     * @return bool
     */
    if (false === function_exists('create_cookie')) {
        function create_cookie( $cookie_name, $cookie_value ):bool {
            // set cookie for 1 hour (3600 seconds)
            return setcookie($cookie_name, $cookie_value, time() + 3600, '/');
        }
    }

    /**
     * get the access token via oauth
     * 
     * @return string - access token
     */
    if (false === function_exists('get_access_token')) {
        function get_access_token() {
            $url = 'https://login.etrusted.com/oauth/token';
            $data = [
                'client_id' => '1478bf1ccf6b__steuermachen-website',
                'client_secret' => '382ff162-100e-4d87-96b0-b3777c41ba2b',
                'grant_type' => 'client_credentials',
                'audience' => 'https://api.etrusted.com'
            ];
            $post_data = http_build_query($data);
            $options = [
                'http' => [
                    'method'  => 'POST',
                    'content' => $post_data
                ]
            ];

            $stream_context = stream_context_create($options);
            $result = @file_get_contents($url, false, $stream_context);

            $result_json = json_decode($result);

            $access_token = $result_json->access_token;

            // TODO add error fallback

            return $access_token;
        }
    }

    /**
     * get rating from trusted shops api
     * 
     * @param string $period
     * 
     * @return string
     */
    if (false === function_exists('get_rating')) {
        function get_rating( string $period ):string {
            $url = 'https://api.etrusted.com/channels/chl-dd15a939-2472-443a-95cd-157c853459cb/service-reviews/aggregate-rating';
            // $url = 'https://code.tobias-roeder.de/http_response_code/http_response_code.php?response_code=418';
            $options = [
                'http' => [
                    'method'  => 'GET',
                    'header'  => 'Authorization: Bearer ' . get_access_token()
                ]
            ];

            $stream_context = stream_context_create($options);
            $result = @file_get_contents($url, false, $stream_context);

            // filter the response code out of the http response header as integer
            $response_code = (int) explode(' ', $http_response_header[0])[1];

            // var_dump($response_code);

            if ($response_code === 200) {
                $json = json_decode($result, true);

                if ($period === 'all')
                    $period = 'overall';
                else
                    $period .= 'days';

                return $json[$period]['rating'];
            }

            return '0';
        }
    }

    // check if cookie already exists
    $trusted_shops_rating = $_COOKIE['trusted_shops_rating'] ?? null;

    // if cookie not exists create and return lastest rating
    if (is_null($trusted_shops_rating)) {
        $_trusted_shops_rating = get_rating($period);
        create_cookie('trusted_shops_rating', $_trusted_shops_rating);

        return $_trusted_shops_rating;
    }

    return $trusted_shops_rating;
}
add_shortcode('trusted_shops_rating', 'trusted_shops_rating');


/**
 * get trusted shops rating
 * 
 * @param string $period - optional (Default: all)
 * 
 * @return bool
 */
function get_trusted_shops_rating( string $period = 'all' ):string {
    $attr = [
        'period' => $period
    ];
    return trusted_shops_rating( $attr );
}


/**
 * echos the trusted shops rating
 * 
 * @param string $period - optional (Default: all)
 */
function the_trusted_shops_rating( string $period = 'all' ) {
    echo get_trusted_shops_rating( $period );
}


/**
 * calculate the star length and get also a rounded rating
 * 
 * @param string $period - optional (Default: 365)
 * 
 * @return array
 */
function trusted_shops_rating_stars( $period = '365' ):array {
    $rating = (float) get_trusted_shops_rating($period);
    $max_rating = 0.05;

    // $rating_rounded = number_format(round($rating, 1), 2);
    $star_length = $rating / $max_rating;

    $result = [
        // 'rating' => $rating_rounded,
        'rating' => $rating,
        'star_length' => $star_length
    ];

    return $result;
}


/**
 * trusted shops logo with rating and rating stars
 * 
 * @return string
 */
function trusted_shops() {
    $content = '';

    $_trusted_shops_rating_stars = trusted_shops_rating_stars();
    $rating = $_trusted_shops_rating_stars['rating'];
    $star_length = $_trusted_shops_rating_stars['star_length'];

    $content .= '<div class="trusted-shops-wrapper">';
    $content .= get_attachment('442', 'thumbnail');
    $content .= '<div class="trusted-shops-rating-wrapper">
            <h3 class="mb-0 font-normal">Käuferschutz</h3>
            <div class="mb-0 h3">';
    $content .= $rating;
    $content .= '/5.00</div>
            <div class="stars" style="--stars-width:';
    $content .= $star_length;
    $content .= '%"></div>
        </div>
    </div>';

    return $content;
}
add_shortcode('trusted_shops', 'trusted_shops');


/**
 * echos the trusted shops wrapper
 */
function the_trusted_shops() {
    echo trusted_shops();
}


/**
 * Trusted Shops Logo shortcode
 * 
 * @param string|int $image_size - optional (Default: thumbnail)
 * @param string $url - optional (Default: link to ratings)
 * @param bool $wrap_p - optional (Default: true)
 * 
 * @return string
 */
function get_trusted_shops_logo( $attr ):string {
    $attachment_id = 442;
    $image_size = $attr['size'] ?? 100;
    $url = $attr['url'] ?? 'https://www.trustedshops.de/bewertung/info_X24AEB26CBD9A2EBDB8A0AC232A1BB7F9.html';
    // $target = $attr['target'] ?? '_blank'; // enable if required
    // $rel = $attr['rel'] ?? 'noopener noreferrer nofollow'; // enable if required
    $wrap_p = $attr['wrap_p'] ?? true;

    // check if image size string contains a word or an integer
    if ((int)$image_size === 0)
        $size = $image_size;
    else
        $size = [$image_size];

    // content start
    $content = '';

    // wrap the whole content with an paragraph tag if needed
    if ($wrap_p === true) $content .= '<p>';

    // wrap image with an anchor tag
    $content .= '<a href="' . $url . '" rel="noopener noreferrer nofollow" target="_blank">';

    // image as HTML string or a empty string if failed
    $content .= wp_get_attachment_image( $attachment_id, $size);

    // close wrapper (anchor tag)
    $content .= '</a>';

    // close wrapper (paragraph tag)
    if ($wrap_p === true) $content .= '</p>';

    // return the image with the anchor (and p) tag wrapper
    return $content;
}
add_shortcode('trusted_shops_logo', 'get_trusted_shops_logo');


/**
 * CTA Button shortcode
 * 
 * @param string $value
 * @param string $link_to - optional (Default: order)
 * @param string $url - optional (Default: <empty string>) this overwrites link_to
 * @param string $class - optional (Default: btn btn-theme-primary btn-full) this overwrites the default classes
 * @param string $add_class - optional (Default: <empty string>)
 * @param bool $wrap_p - optional (Default: true)
 */
function get_cta_button( $attr ):string {
    $value = $attr['value'] ?? '';
    $link_to = $attr['link_to'] ?? 'order';
    $url = $attr['url'] ?? '';
    $class = $attr['class'] ?? 'btn btn-theme-primary btn-full';
    $add_class = $attr['add_class'] ?? '';
    $wrap_p = $attr['wrap_p'] ?? true;

    $links = [
        'order' => '/steuererklaerung-beauftragen/',
        'steuereasy' => '/steuereasy/',
        'safetax' => '/' // does not exists on the website yet
    ];

    // check if url is empty and link to key exists
    if (empty($url) && array_key_exists($link_to, $links))
        $url = home_url($links[$link_to]);

    // check if there a classes to be added
    if (!empty($add_class))
        $class .= ' ' . $add_class;

    // content start
    $content = '';

    // wrap the whole content with an paragraph tag if needed
    if ($wrap_p === true) $content .= '<p>';

    // link
    $content .= '<a class="' . $class . '" href="' . $url . '">' . $value . '</a>';

    // close wrapper (paragraph tag)
    if ($wrap_p === true) $content .= '</p>';

    // return the link (with the p tag wrapper)
    return $content;
}
add_shortcode('cta_button', 'get_cta_button');



function sc_playground($atts, $content) {
    $header = $atts['header'] ?? '';
    $image_id = $atts['image_id'] ?? 0;

    return $content;
}
add_shortcode('playground', 'sc_playground');


/**
 * * Test
 * Price Card as shortcodes
 * 
 * - price card (wrapper)
 * - price card list
 * - price card price
 */
function price_card( $attr ) {
    $title = $attr['title'] ?? '';
    $price = $attr['price'] ?? '';
    $items = array_filter($attr, 'is_int', ARRAY_FILTER_USE_KEY);
    $url = $attr['url'] ?? '#';

    $content = '<div class="mx-auto price-card">
        <div>
            <div class="title">' . $title . '</div>
            <ul class="description">';
        foreach ($items as $item)
            $content .= "<li>$item</li>";
        $content .= '</ul>
        </div>
        <div>
            <div class="price-wrapper">
                <div class="price">' . $price . '&euro;</div>
                <div class="vat-info">(ohne MwSt.)</div>
            </div>
            <div class="cta-wrapper">
                <a class="btn btn-primary btn-mdxl" href="' . $url . '">Jetzt bestellen</a>
            </div>
        </div>
    </div>';

    return $content;
}
add_shortcode('price_card', 'price_card');

// DEMO
// [price_card title="Premium" price="49" "Du kannst das ganze Jahr über Dokumente sicher hochladen und sammeln" "Du erhältst für das aktuelle Jahr eine qualifizierte steuerrechtliche Beratung durch deinen Steuerexperten" "Wenn du eine Steuererklärung bei uns beauftragst, erstatten wir dir alle bereits bezahlten Kosten "]



/**
 * Steuerrechner (Quick Tax)
 * 
 * @return string
 */
function get_steuerrechner() {
    $content = '';

    // add steuerrechner css and js files
    wp_enqueue_style('steuerrechner-style', get_stylesheet_directory_uri() . '/css/steuerrechner.min.css');
    wp_enqueue_script('steuerrechner-script', get_stylesheet_directory_uri() . '/js/steuerrechner.min.js');

    // steuerrechner content
    $content .= '<div id="steuerrechner">
        <div class="progress-wrapper">
            <div class="progress-bar"></div>
        </div>

        <form method="post" name="steuerrechner" onsubmit="return false">

            <!-- STEP 1 -->
            <section data-step="1">
                <h3>Wähle dein jährliches Bruttoeinkommen aus (ca.)</h3>
                <div class="radio-wrapper radio-triple">
                    <label>
                        <input type="radio" name="bje" value="8tgohapk">
                        <div class="label">0 - 9k &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="f0ps693k">
                        <div class="label">10k - 14k &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="gdh4wo35">
                        <div class="label">15k - 34k &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="28bdv9ct">
                        <div class="label">35k - 54k &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="iqt18dgo">
                        <div class="label">55k - 69k &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="8cj3sdaf">
                        <div class="label">> 70k &euro;</div>
                    </label>
                </div>
            </section>

            <!-- STEP 2 -->
            <section data-step="2" hidden>
                <h3>In welcher Steuerklasse bist du?</h3>
                <div class="radio-wrapper radio-triple">
                    <label>
                        <input type="radio" name="steuerklasse" value="s70nqblu">
                        <div class="label">Steuerklasse 1</div>
                    </label>
                    <label>
                        <input type="radio" name="steuerklasse" value="qa0ubmhy">
                        <div class="label">Steuerklasse 2</div>
                    </label>
                    <label>
                        <input type="radio" name="steuerklasse" value="3i8dtp70">
                        <div class="label">Steuerklasse 3</div>
                    </label>
                    <label>
                        <input type="radio" name="steuerklasse" value="pc6yqtxg">
                        <div class="label">Steuerklasse 4</div>
                    </label>
                    <label>
                        <input type="radio" name="steuerklasse" value="muh3q6p0">
                        <div class="label">Steuerklasse 5</div>
                    </label>
                    <label>
                        <input type="radio" name="steuerklasse" value="41ozqcsx">
                        <div class="label">Steuerklasse 6</div>
                    </label>
                </div>
            </section>

            <!-- STEP 3 -->
            <section data-step="3" hidden>
                <h3>Gib deinen Arbeitsweg in km an (einfache Wegstrecke)</h3>
                <div class="number-wrapper">
                    <input type="number" name="arbeitsweg" oninput="checkValue(this)">
                    <input type="button" value="Weiter" disabled>
                </div>
            </section>

            <!-- STEP 4 -->
            <section data-step="4" hidden>
                <h3>Hattest du eine/mehrere berufliche Weiterbildung/en?</h3>
                <div class="radio-wrapper radio-double">
                    <label>
                        <input type="radio" name="berufliche_weiterbildung" value="lgunwzdf">
                        <div class="label">Ja</div>
                    </label>
                    <label>
                        <input type="radio" name="berufliche_weiterbildung" value="bzw5kr6f">
                        <div class="label">Nein</div>
                    </label>
                </div>
            </section>

            <!-- STEP 5 -->
            <section data-step="5" hidden>
                <h3>Wähle die Anzahl deiner Kinder</h3>
                <div class="radio-wrapper radio-triple">
                    <label>
                        <input type="radio" name="kinder" value="nqdhxspv">
                        <div class="label">0</div>
                    </label>
                    <label>
                        <input type="radio" name="kinder" value="68d0n29u">
                        <div class="label">1</div>
                    </label>
                    <label>
                        <input type="radio" name="kinder" value="6lki7zu0">
                        <div class="label">2</div>
                    </label>
                    <label>
                        <input type="radio" name="kinder" value="n24ufj9g">
                        <div class="label">3</div>
                    </label>
                    <label>
                        <input type="radio" name="kinder" value="dok8bcv1">
                        <div class="label">4</div>
                    </label>
                    <label>
                        <input type="radio" name="kinder" value="wqatlzfu">
                        <div class="label">5 oder mehr</div>
                    </label>
                </div>
            </section>

            <!-- STEP 6 -->
            <section data-step="6" hidden>
                <h3>Bist du bereits verheiratet?</h3>
                <div class="radio-wrapper radio-double">
                    <label>
                        <input type="radio" name="verheiratet" value="knt2e3rd">
                        <div class="label">Ja</div>
                    </label>
                    <label>
                        <input type="radio" name="verheiratet" value="n7msrdoe">
                        <div class="label">Nein</div>
                    </label>
                </div>
            </section>

            <section data-stage="2"></section>

            <!-- (FINAL RESULT) -->
            <section data-step="final" hidden>
                <div class="section-inner">
                    <p>Bitte haben Sie einen Moment Geduld, Ihre geschätzte Steuerrückerstattung wird gerade berechnet...</p>
                    <div class="spinner"></div>
                </div>
            </section>

        </form>

        <!-- <section class="cta">
            <a href="https://steuermachen.de/steuererklaerung-beauftragen/?utm_source=steuermachen.de&utm_medium=steuerrechner&utm_campaign=steuer2021" class="btn btn-primary">Jetzt Steuererklärung machen lassen</a>
        </section> -->
    </div>';

    return $content;
}
add_shortcode('steuerrechner', 'get_steuerrechner');

/**
 * Steuerrechner (Quick Tax)
 * echos the steuerrechner
 * 
 * @return void
 */
function the_steuerrecher() {
    echo get_steuerrechner();
}


/**
 * Utility function
 * 
 * get custom logo url string
 * 
 * @return string - if no custom logo exists return empty string
 */
function get_custom_logo_url() {
    if (has_custom_logo())
        return wp_get_attachment_image_url( get_theme_mod('custom_logo'), '' );

    return '';
}


/**
 * Add custom retina logo support
 * 
 * get custom retina logo url
 * 
 * @return int
 */
function get_custom_retina_logo() {
    return attachment_url_to_postid( get_theme_mod( 'custom_retina_logo' ) );
}

/**
 * echo the retina logo url
 */
function the_custom_retina_logo() {
    echo get_custom_retina_logo();
}

/**
 * check if a custom retina logo exists
 * 
 * @return bool
 */
function has_custom_retina_logo() {
    return (bool) get_custom_retina_logo();
}


/**
 * advanced get_image_tag function
 * this functions adds srcset parameter at the end
 * 
 * original function:
 * @see https://developer.wordpress.org/reference/functions/get_image_tag/
 * 
 * @param string|int $id
 * @param string $alt
 * @param string $title
 * @param string $align
 * @param string|array $size - optional
 * @param string $add_class - optional
 * @param string $srcset - optional
 * 
 * @return string
 */
function stm_get_image_tag( $id, $alt, $title, $align, $size = 'medium', $add_class = '', $srcset = '' ) {
    list( $image_src, $width, $height ) = image_downsize( $id, $size );
    $hwstring = image_hwstring( $width, $height );

    $title = $title ? 'title="' . esc_attr( $title ) . '" ' : '';
    $srcset = $srcset ? 'srcset="' . esc_attr( $srcset ) . '" ' : '';

    $size_class = is_array( $size ) ? implode( 'x', $size ) : $size;
    $class = 'align' . esc_attr( $align ) . ' size-' . esc_attr( $size_class ) . ' wp-image-' . $id . ' ' . $add_class;

    $html = '<img src="' . esc_attr( $image_src ) . '" alt="' . esc_attr( $alt ) . '" ' . $title . $hwstring . 'class="' . $class . '" ' . $srcset . ' />';

    return $html;
}


/**
 * Require init from Admin Section.
 */
require trailingslashit( get_template_directory() ) . 'admin-section/customizer.php';

/**
 * Require init from Includes.
 */
require trailingslashit( get_template_directory() ) . 'includes/init.php';


/**
 * include this files if a user is logged in
 */
if (true === is_user_logged_in()) {
    wp_enqueue_style( 'admin-style', trailingslashit( get_template_directory_uri() ) . 'css/admin.css');
}


/**
 * remove jQuery Migrate
 */
function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];

        if ( $script->deps ) { 
            // Check whether the script has any dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );