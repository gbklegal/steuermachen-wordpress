<?php

/**
 * theme base url and more
 */
define('STM_THEME_URL', get_template_directory_uri());
define('STM_THEME_CSS', STM_THEME_URL . '/css');
define('STM_THEME_JS', STM_THEME_URL . '/js');
define('STM_THEME_IMG', STM_THEME_URL . '/img');



/**
 * utility function to create a random id
 * 
 * @param int length - optional
 * 
 * @return string
 */
function random_id( int $length ):string {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $length = 8;
    $random_id = '';
    $i = 1;

    while ($i <= $length) {
        $random_id .= $chars[rand( 0, 61 )];
        $i++;
    }

    return $random_id;
}



/**
 * utility function to manipulate get parameters from url
 * 
 * @param array $add_params - optional
 * @param array $remove_params - optional
 * @param string $url - optional
 */
function manipulate_get_params( array $add_params = [], array $remove_params = [], ?string $url = null ) {
    $get_params = $_GET ?? [];
    if (is_null($url))
        $url = get_permalink(get_the_ID());

    foreach ($add_params as $key => $param) {
        $get_params[$key] = $param;
        // array_push($get_params, $param);
    }

    foreach ($remove_params as $param) {
        unset($get_params[$param]);
    }

    return $url . '?' . http_build_query($get_params);
}



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
add_filter( 'script_loader_tag', 'add_enqueue_script_attributes', 10, 2 );


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
add_action( 'init', 'steuermachen_theme_setup' );


// TODO add this after your holiday, so the others and yourself can edit the sidebar simply in the widgets section
// function steuermachen_widgets_init() {
//     register_sidebar([
//         'id'            => 'front-page-sidebar',
//         'name'          => 'Startseite Sidebar',
//         'description'   => 'A short description of the sidebar.',
//         'before_widget' => '<div id="%1$s" class="widget %2$s">',
//         'after_widget'  => '</div>',
//         'before_title'  => '<h3 class="widget-title">',
//         'after_title'   => '</h3>',
//     ]);
// }
// add_action( 'widgets_init', 'steuermachen_widgets_init' );


// function add_mobile_nav_support( $items, $args ) {
//     var_dump($items);
//     var_dump($args);

//     return $items;
// }
// // wp_nav_menu_items | nav_menu_item_id
// add_filter( 'wp_nav_menu_items', 'add_mobile_nav_support' );
// // add_action( 'wp_add_nav_menu_item', 'add_mobile_nav_support' );


/**
 * remove all links from the post content
 * frame mode related
 */
function the_content_frame_mode( $content ) {
    $allowed_tags = [
        // 'a',
        'abbr',
        'acronym',
        'address',
        'applet',
        'area',
        'article',
        'aside',
        'audio',
        'b',
        'base',
        'basefont',
        'bb',
        'bdo',
        'big',
        'blockquote',
        'body',
        'br',
        'button',
        'canvas',
        'caption',
        'center',
        'cite',
        'code',
        'col',
        'colgroup',
        'command',
        'datagrid',
        'datalist',
        'dd',
        'del',
        'details',
        'dfn',
        'dialog',
        'dir',
        'div',
        'dl',
        'dt',
        'em',
        'embed',
        'eventsource',
        'fieldset',
        'figcaption',
        'figure',
        'font',
        'footer',
        'form',
        'frame',
        'frameset',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'head',
        'header',
        'hgroup',
        'hr',
        'html',
        'i',
        'iframe',
        'img',
        'input',
        'ins',
        'isindex',
        'kbd',
        'keygen',
        'label',
        'legend',
        'li',
        'link',
        'map',
        'mark',
        'menu',
        'meta',
        'meter',
        'nav',
        'noframes',
        'noscript',
        'object',
        'ol',
        'optgroup',
        'option',
        'output',
        'p',
        'param',
        'pre',
        'progress',
        'q',
        'rp',
        'rt',
        'ruby',
        's',
        'samp',
        'script',
        'section',
        'select',
        'small',
        'source',
        'span',
        'strike',
        'strong',
        'style',
        'sub',
        'sup',
        'table',
        'tbody',
        'td',
        'textarea',
        'tfoot',
        'th',
        'thead',
        'time',
        'title',
        'tr',
        'track',
        'tt',
        'u',
        'ul',
        'var',
        'video',
        'wbr'
    ];

    if ( is_frame_mode( 'remove-links', 'app' ) )
        $content = strip_tags( $content, $allowed_tags );

    if ( is_frame_mode( 'remove-affiliate', 'app' ) )
        $content = preg_replace('#<div\s+class="box-info(.*)">[\S\s]*?<\/div>#', '', $content);

    return $content;
}
add_filter( 'the_content', 'the_content_frame_mode' );


/**
 * add frame-mode class to the body
 */
add_filter( 'body_class', function( $body_class ) {
    if ( is_frame_mode() )
        $body_class[] = 'frame-mode';

    return $body_class;
} );


/**
 * Contact Form 7 Spam Filter
 */
add_filter( 'wpcf7_spam', function( $spam ) {
    if ( $spam )
        return $spam;

    $spam_key_words = array_map( 'trim', explode( ',', get_theme_mod( 'wpcf7_spam_filter_key_words' ) ) );

    $found_spam_key_word = function ( $string, $spam_key_words ) {
        foreach ( $spam_key_words as $spam_key_word )
            if ( stripos( $string, $spam_key_word ) !== false )
                return true;

        return false;
    };

    return (
        $found_spam_key_word( $_POST['subject'], $spam_key_words )
        ||
        $found_spam_key_word( $_POST['message'], $spam_key_words )
    );
}, 10, 1 );


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
 * @param array $args - optional
 * 
 * @return void
 */
function get_nav_menu( string $theme_location_name, array $args = [] ):void {
    $array = [
        'theme_location' => $theme_location_name
    ];
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

    return '<a class="btn' . $size . $theme . '" href="' . $href . '">' . $value . '</a>';
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
 * helper function to set cookies for an hour
 * 
 * @param string $cookie_name
 * @param string $cookie_value
 * 
 * @return bool
 */
function create_one_hour_cookie( $cookie_name, $cookie_value ):bool {
    // set cookie for 1 hour (3600 seconds)
    return setcookie($cookie_name, $cookie_value, time() + 3600, '/');
}


/**
 * get the eTrusted (Trusted Shops) access token via oauth
 * 
 * @return string - access token
 */
function get_etrusted_access_token() {
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


/**
 * get rating from trusted shops api
 * 
 * @param string $period
 * 
 * @return string
 */
function get_etrusted_rating( string $period ):string {
    $url = 'https://api.etrusted.com/channels/chl-dd15a939-2472-443a-95cd-157c853459cb/service-reviews/aggregate-rating';
    // $url = 'https://code.tobias-roeder.de/http_response_code/http_response_code.php?response_code=418';
    $options = [
        'http' => [
            'method'  => 'GET',
            'header'  => 'Authorization: Bearer ' . get_etrusted_access_token()
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


/**
 * get eTrusted (Trusted Shops) reviews
 * 
 * further details
 * @see https://developers.etrusted.com/reviews-api/reviews-api.html#getReviews
 * 
 * @param int $count - optional
 * @param string $rating - optional
 * 
 * @return array
 */
function get_etrusted_reviews( int $count = 3, $rating = '4,5' ):array {
    $queries = [
        'channels' => 'chl-dd15a939-2472-443a-95cd-157c853459cb',
        'count' => $count,
        'rating' => (string) $rating
    ];
    $queries = http_build_query($queries);

    $url = 'https://api.etrusted.com/reviews?' . $queries;
    // $url = 'https://code.tobias-roeder.de/http_response_code/http_response_code.php?response_code=418';
    $options = [
        'http' => [
            'method'  => 'GET',
            'header'  => 'Authorization: Bearer ' . get_etrusted_access_token()
        ]
    ];

    $stream_context = stream_context_create($options);
    $result = @file_get_contents($url, false, $stream_context);

    // filter the response code out of the http response header as integer
    $response_code = (int) explode(' ', $http_response_header[0])[1];

    // var_dump($response_code);

    if ($response_code === 200) {
        $json = json_decode($result);
        $reviews = [];

        foreach ($json->items as $item) {
            $reviews[] = [
                'rating' => $item->rating,
                'title' => $item->title,
                'comment' => $item->comment,
                'date' => date_format( date_create( $item->updatedAt ), 'd.m.Y' )
            ];
        }

        return $reviews;
    }

    return [];
}



/**
 * get the trusted shops rating from the last year
 * 
 * TODO add optional error resporting (show response_code)
 * TODO replace current api request with wp_remote_get/wp_remote_post (more: https://deliciousbrains.com/wordpress-http-api-requests/)
 * TODO replace function_exists with an anonymous function (create_cookie() => $create_cookie())
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

    // check if cookie already exists
    $trusted_shops_rating = $_COOKIE['trusted_shops_rating'] ?? null;

    // if cookie not exists create and return lastest rating
    if (is_null($trusted_shops_rating)) {
        $_trusted_shops_rating = get_etrusted_rating($period);
        create_one_hour_cookie('trusted_shops_rating', $_trusted_shops_rating);

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

    // format rating (5 => 5.00)
    $rating = number_format($rating, 2);

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
    /**
     * disable the trusted shops logo shortcode when frame mode is active
     */
    if ( is_frame_mode() )
        return '';

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
    $content .= wp_get_attachment_image( $attachment_id, $size );

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
    /**
     * disable the cta button shortcode when frame mode is active
     */
    if ( is_frame_mode() )
        return '';

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
                        <div class="label">Bis 9.999 &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="f0ps693k">
                        <div class="label">10.000 - 14.999 &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="gdh4wo35">
                        <div class="label">15.000 - 34.999 &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="28bdv9ct">
                        <div class="label">35.000 - 54.999 &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="iqt18dgo">
                        <div class="label">55.000 - 69.999 &euro;</div>
                    </label>
                    <label>
                        <input type="radio" name="bje" value="8cj3sdaf">
                        <div class="label">Über 70.000 &euro;</div>
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
                    <p>Bitte habe einen Moment Geduld, deine geschätzte Steuerrückerstattung wird gerade berechnet ...</p>
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
function the_steuerrechner() {
    echo get_steuerrechner();
}


/**
 * Author Info (Blog Sidebar)
 */
function the_author_info() {
    $author_id = get_the_author_meta( 'ID' );
    $author_name = get_the_author_meta( 'display_name' );
    $author_first_name = get_the_author_meta( 'first_name' );
    $author_description = get_the_author_meta( 'description' );
    $author_avatar = get_avatar( $author_id, 96, '', $author_name, [ 'class' => 'author-avatar' ] );
    $author_posts_url = get_author_posts_url( $author_id );

    $_author_s = '';
    if ( false === str_ends_with( $author_first_name, 's' ) )
        $_author_s = 's';
    ?>
    <div class="author-info">
        <h3 class="text-center"><?php echo $author_name; ?></h3>
        <?php echo $author_avatar; ?>
        <p><?php echo $author_description; ?></p>
        <?php // if ( false === is_frame_mode() ): ?>
        <?php if ( false ): ?>
        <p>
            <a href="<?php echo $author_posts_url; ?>"><?php echo $author_first_name . $_author_s; ?> Artikel</a>
        </p>
        <?php endif; ?>
    </div>
    <?php
}


/**
 * Price Calculator Shortcode
 * 
 * @author Tobias Röder
 * @version 0.1.1
 * 
 * @param array $args - optional
 * 
 * @return string
 */
function get_price_calculator( $args = [] ) {
    $url = $args['url'] ?? '/steuererklaerung-beauftragen/?bje=';
    $position = $args['position'] ?? 'center';

    $content = '';

    wp_enqueue_style('price-calculator-style', STM_THEME_URL . '/css/price-calculator.css');
    wp_enqueue_script('calculator-script', STM_THEME_URL . '/js/calculator.js');
    wp_enqueue_script('price-calculator-script', STM_THEME_URL . '/js/price-calculator.js');

    $content .= '
    <div id="priceCalculator" class="position-'.$position.'">
    <div class="bje-wrapper">
    <label for="bje">Wie hoch ist dein Bruttojahreseinkommen?</label>
    <input type="text" id="bje" placeholder="Dein Bruttojahreseinkommen">
    </div>
    <div class="bje-price-wrapper">
    <label>Dein voraussichtlicher Preis (inkl. MwSt.)</label>
    <div id="bjePrice">&nbsp;</div>
    </div>
    <a href="'.$url.'" class="btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
    </div>';

    return $content;
}

add_shortcode('price_calculator', 'get_price_calculator');

/**
 * Price Calculator
 * echos the price calculator
 * 
 * @param array $args - optional
 * ! @param string $url - optional (might coming soon)
 * ! @param string $position - optional (might coming soon)
 * 
 * @return void
 */
function the_price_calculator( $args = [] ) {
    echo get_price_calculator( $args );
}


/**
 * Property Tax Price Calculator Shortcode
 * 
 * @author Tobias Röder
 * @version 0.1.1
 * 
 * @param array $args - optional
 * 
 * @return string
 */
function get_property_tax_price_calculator( $args = [] ) {
    $url = $args['url'] ?? '/steuererklaerung-beauftragen/?property_value=';
    $position = $args['position'] ?? 'center';

    $content = '';

    wp_enqueue_style('price-calculator-style', STM_THEME_URL . '/css/price-calculator.css');
    wp_enqueue_script('calculator-script', STM_THEME_URL . '/js/calculator.js');
    wp_enqueue_script('property-tax-price-calculator-script', STM_THEME_URL . '/js/property-tax-price-calculator.js');

    $content .= '
    <div id="priceCalculator" class="position-'.$position.'">
    <div class="bje-wrapper">
    <label for="bje">Wie hoch ist dein Grundstückswert?</label>
    <input type="text" id="bje" placeholder="Dein Grundstückswert" data-property-tax-calc->
    </div>
    <div class="bje-price-wrapper">
    <label>Dein voraussichtlicher Preis (inkl. MwSt.)</label>
    <div id="bjePrice">&nbsp;</div>
    </div>
    <a href="'.$url.'" class="btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
    </div>';

    return $content;
}

add_shortcode('property_tax_price_calculator', 'get_property_tax_price_calculator');

/**
 * Property Tax Price Calculator
 * echos the property tax price calculator
 * 
 * @param array $args - optional
 * ! @param string $url - optional (might coming soon)
 * ! @param string $position - optional (might coming soon)
 * 
 * @return void
 */
function the_property_tax_price_calculator( $args = [] ) {
    echo get_property_tax_price_calculator( $args );
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
if ( is_user_logged_in() ) {
    add_action('admin_enqueue_scripts', function() {
        wp_enqueue_style( 'admin-style', trailingslashit( get_template_directory_uri() ) . 'css/admin.css');
    });
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



/**
 * get attachment details from database
 * 
 * @param int|string $attachment_id
 * 
 * @return WP_Query
 */
function get_attachment_details( $attachment_id = 28504 ) {
     $args = [
          'p' => $attachment_id,
          'post_type' => 'attachment'
     ];
     $query = new WP_Query( $args );
     $posts = (array) $query->posts[0];

     $posts['pathinfo'] = pathinfo($posts['guid']);
     $posts['filesize'] = get_attachment_filesize( (int) $attachment_id, false );
     $posts['filesize_human_readable'] = get_attachment_filesize( (int) $attachment_id );

     return $posts;
}


/**
 * get attachment filesize from attachment id with optional units format
 * for better human readability
 * 
 * @param int $attachement_id
 * @param bool $human_readable - optional
 * 
 * @return int|string
 */
function get_attachment_filesize( int $attachment_id, $human_readable = true ) {
     $attachment_abspath = get_attached_file( $attachment_id );
     $attachment_filesize = filesize( $attachment_abspath );

     if ($human_readable === true)
          return size_format( $attachment_filesize, 2 );

     return $attachment_filesize;
}


/**
 * Download PDF shortcode
 * 
 * @param array $args
 * 
 * @return string
 */
function download_pdf( $args ) {
     $attachment_id = $args[0] ?? null;

     if ( is_null( $attachment_id ) )
          return '';

     $content = '';

     $download_pdf_html = function( $attachment_id ) {
          $attachment_details = get_attachment_details( $attachment_id );

          $attachment_title = $attachment_details['post_title'];
          $attachment_name = $attachment_details['pathinfo']['basename'];
          $attachment_url = $attachment_details['guid'];
          $attachment_filesize = $attachment_details['filesize_human_readable'];

          $content .= '<div class="download-pdf-wrapper">'
               . '<div class="download-pdf-details">'
               . '<a href="' . $attachment_url . '">' . $attachment_title . '</a>'
               . ' &bull; '
               . $attachment_filesize
               . '</div><div class="download-pdf-download">'
               . '<a href="' . $attachment_url . '" download="' . $attachment_name . '"><i class="icon-download"></i></a>'
               . '</div></div>';

          return $content;
     };

     $content .= '<div class="download-pdf-list">';

     if ( count($args) > 1 )
          foreach ( $args as $attachment_id) {
               $content .= $download_pdf_html( $attachment_id );
          }
     else
          $content .= $download_pdf_html( $attachment_id );
     
     $content .= '</div>';

     return $content;
}
add_shortcode('download_pdf', 'download_pdf');


/**
 * Countdown
 * 
 * @param array $args
 * 
 * @return string
 */
function get_countdown( $args = [] ):string {
    $default_end = get_theme_mod( 'countdown_end' ) ?? '';
    $end = $args['end'] ?? $default_end;

    $content = '';

    if ( empty( $end ) )
        return $content;

    wp_enqueue_style('steuermachen-countdown-style', get_template_directory_uri() . '/css/countdown.min.css');
    wp_enqueue_script_footer('steuermachen-countdown-script', get_template_directory_uri() . '/js/countdown.js');

    $content .= '
        <div class="countdown" data-countdown-end="' . $end . '" data-countdown>
            <div class="col">
                <div class="number countdown-days" data-countdown-days>
                    <span class="countdown-loader"></span>
                </div>
                <div class="label">
                    <span class="label-content-desktop">Tage</span>
                    <span class="label-content-mobile">Tage</span>
                </div>
            </div>
            <div class="col">
                <div class="number countdown-hours" data-countdown-hours>
                    <span class="countdown-loader"></span>
                </div>
                <div class="label">
                    <span class="label-content-desktop">Stunden</span>
                    <span class="label-content-mobile">Std.</span>
                </div>
            </div>
            <div class="col">
                <div class="number countdown-minutes" data-countdown-minutes>
                    <span class="countdown-loader"></span>
                </div>
                <div class="label">
                    <span class="label-content-desktop">Minuten</span>
                    <span class="label-content-mobile">Min.</span>
                </div>
            </div>
            <div class="col">
                <div class="number countdown-seconds" data-countdown-seconds>
                    <span class="countdown-loader"></span>
                </div>
                <div class="label">
                    <span class="label-content-desktop">Sekunden</span>
                    <span class="label-content-mobile">Sek.</span>
                </div>
            </div>
        </div>
    ';

    return $content;
}
add_shortcode('countdown', 'get_countdown');


/**
 * echos the countdown
 * 
 * @param null|string $end - optional
 */
function the_countdown( ?string $end = null ) {
    echo get_countdown( [ 'end' => $end ] );
}


/**
 * utility function for adding script files into the footer
 * without filling up the same defaults
 * 
 * @param string $handle
 * @param string $src - optional
 * 
 * more details about the parameter
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
function wp_enqueue_script_footer( string $handle, string $src = '' ) {
    wp_enqueue_script( $handle, $src, [], false, true );
}


/**
 * checks if frame mode is active
 * 
 * @param string $parameters - optional
 * 
 * @return bool
 */
function is_frame_mode( string ...$parameters ):bool {
    $is_frame_mode = isset( $_GET['frame_mode'] );

    if ( empty( $parameters ) && $is_frame_mode )
        return true;

    foreach ( $parameters as $parameter ) {
        if ( false === empty( $parameter ) && $_GET['frame_mode'] === $parameter )
            return true;
    }

    return false;
}

/**
 * returns the frame mode parameter value on success else it returns false
 * 
 * @return string|bool
 */
function get_frame_mode_param() {
    return $_GET['frame_mode'] ?? false;
}


/**
 * TODO rename echo_if to return_if and add a utility function called echo_if
 * utility function for if else shorthand
 * 
 * @param bool $condition
 * @param mixed $if_text
 * @param mixed $else_text - optional
 * 
 * @return mixed
 */
function return_if( bool $condition, $if_text, $else_text = '' ) {
    if ( $condition )
        return $if_text;

    return $else_text;
}


/**
 * ! Currently DEV only!
 * log data
 * 
 * @param string $level
 * @param string $message
 * @param array/null $data (optional)
 * 
 * @return void
 */
function log_data( string $level, string $message, ?array $data = null ):void {
    $today = date('Y-m-d');
    $now = date('Y-m-d H:i:s');
	$logFile = __DIR__ . '/log/log-'.$today.'.log';

    $logData = '[' . $now . ' - ' . $level . '] ' . $message . "\n";

    if ($data) {
        $dataString = print_r($data, true) . "\n";
        $logData .= $dataString;
    }
    $logData .= str_repeat('*', 100) . "\n";

    $result = file_put_contents($logFile, $logData, FILE_APPEND);
    // var_dump($logData);
}


/**
 * validates the hCaptcha
 * 
 * @param string $hCaptchaResponse
 * 
 * @return array
 */
function validate_h_captcha( string $h_captcha_response ):array {
    $data = array(
        'secret' => '0x9F80bc3d296b45026CBC73198D18B0a835BDA636',
        'response' => $h_captcha_response
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, 'https://hcaptcha.com/siteverify');
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    $response_data = json_decode($response, true);

    return $response_data;
}


/**
 * esc_html but this function ensures it returns a null not a empty string
 * before the text gets escaped, it's get checked if it's null
 * 
 * @param mixed $text
 * 
 * @return mixed
 */
function esc_html_null( $text ) {
    return is_null($text) ? null : esc_html($text);
}


/**
 * esc_html advanced
 * 
 * @param mixed $text
 * @param bool $empty_fallback - optional
 * 
 * @return mixed
 */
function esc_html_adv( $text, bool $empty_fallback = false ) {
    switch (gettype($text)) {
        case 'array':
            return [];
            break;

        case 'null':
            return null;
            break;

        case 'boolean':
            return $text;
            break;
    }

    if ($empty_fallback === true && empty($text))
        return null;

    return esc_html($text);
}


/**
 * create newsletter rapidmail recipient
 * 
 * @param string $email
 * @param string $firstname
 * @param string $lastname
 * 
 * @return array
 */
function create_newsletter_recipient( string $email, string $firstname, string $lastname ):array {
    $post_data = http_build_query([
        'email' => $email,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'newsletter_name' => 'dev_test', // dev_test // TODO replace dev_test with steuermachen
        'test_mode' => 'yes'
    ]);

    $options = ['http' => [
            'method'  => 'POST',
            'header'  => [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer trDd99BRgxyhRK8TFPvWPRJtrkOCFchRZMk40etjz2YPO0NEaYXosTyJvKK7UxxTl3zGEvPe0Vjef1F2lWlfoIy4vDmS7yak46ZRnaKcNNoTpH6TXu4mTSXx2Bi8IZTGo7JkvmMdUGn0iDsIPSRnAMi0uLDkrH9gF2IgzOiXWrTrGVlG2MVlPPrNFiLJ2Cuniuqe8dt8JId6Egog95GwxkLE8uedKHOnsSqunFEmaY20f8BfNt7azaB47cAjM4JgKtPCQBOYtTBEbni4UFLi2rHEuvYVG7GreppaDzYbJGTjvW9oJtpSKQ8GeXNbA39AfLYa6cGTui8ZL4EdAX48h13Run9Fcq7nFNjfBOkLppJrdXCWfWXHBSvY1BJHWKmKo7vrflHCxeisbZb4BcCJaUNntRiYHaDL2487uuwSOTJWZ9ORsXkAtoihhYnRcQojkvZgJoEkkphJxwf4DAK5jZE61EBRdShjuTUcRcLyAS8tHKMmJEHtC3ipM5WQkNmE'
            ],
            'content' => $post_data,
            'ignore_errors' => true
        ]
    ];

    $context  = stream_context_create($options);

    $result = file_get_contents('https://api.gbk-rae.de/newsletter/rapidmail/', false, $context);

    $json_result = json_decode($result, true);

    return $json_result;
}