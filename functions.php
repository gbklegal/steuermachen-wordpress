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
function initStmTheme() {
    /**
     * initilize (register) nav menus
     * these are later accessible via wp_nav_menu()
     * @see https://developer.wordpress.org/themes/functionality/navigation-menus/#display-menus
     */
    register_nav_menus([
        'primary' => __( 'Header Navigation' ),
        'footer_1' => __( 'Footer - Über steuermachen.de' ),
        'footer_2' => __( 'Footer - Rechtliche Dokumente' ),
        'footer_3' => __( 'Footer - Kooperation | Wird helfen Ihnen' ),
    ]);
}
add_action( 'init', 'initStmTheme' );



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

    // return image as HTML string or a empty string if failed
    return wp_get_attachment_image( $image_id, $image_size );
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
 */
function the_attachment( $image_id, $image_size = '' ) {
    echo get_attachment_shortcode( [
        'id' => $image_id,
        'size' => $image_size
    ] );
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
 * 
 * To avoid high traffic on the trusted shops api because the number isn't changing rapidly,
 * the rating is getting stored in an cookie for an hour and from there beeing loaded.
 * 
 * @param array $attr
 * - @param string $period - optional (Default: all)
 * 
 * @return string
 */
function trusted_shops_rating( array $attr ):string {
    $period = $attr['period'] ?? 'all';

    /**
     * helper function to set cookies
     * 
     * @param string $cookie_name
     * @param string $cookie_value
     * 
     * @return bool
     */
    function create_cookie( $cookie_name, $cookie_value ):bool {
        // set cookie for 1 hour (3600 seconds)
        return setcookie($cookie_name, $cookie_value, time() + 3600, '/');
    }

    /**
     * get the access token via oauth
     * 
     * @return string - access token
     */
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

    /**
     * get rating from trusted shops api
     * 
     * @param string $period
     * 
     * @return string
     */
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