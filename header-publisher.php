<?php
/**
 * The header for the steuermachen theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

/**
 * financeAds
 */
if (isset($_GET['s_id'])) {
    $fa_cookie_name = 's_id';
    $fa_cookie_value = $_GET['s_id'];
    $fa_cookie_duration = time() + 86400 * 90; // = 90 Tage Laufzeit;
    $fa_cookie_path = '/';
    $fa_cookie_domain = 'https://steuermachen.de/'; //bspw. "https://steuermachen.de/"
    $fa_cookie_secure = true; //= dieser Cookie darf nur per HTTPS ausgelesen werden
    $fa_cookie_httponly = true; //= Cookie darf nicht von Javascript-Dateien ausgelesen werden
    $fa_cookie_samesite = 'SameSite=Lax';
}

// setcookie($fa_cookie_name, $fa_cookie_value, $fa_cookie_duration, $fa_cookie_path, $fa_cookie_domain, $fa_cookie_secure, $fa_cookie_httponly, $fa_cookie_samesite);

wp_enqueue_style('steuermachen-style', get_bloginfo('stylesheet_url'));
wp_enqueue_script_footer('steuermachen-script', get_template_directory_uri() . '/js/script.js');
wp_enqueue_script_footer('steuermachen-fa-landing-script', get_template_directory_uri() . '/js/fa-landing.js');

$_chistmas = '';

if (true === is_christmas_time()) {
    $_chistmas = 'christmas';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo wp_get_document_title(); ?></title>

    <?php wp_head(); ?>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

</head>
<body <?php body_class($_chistmas); ?>>

    <div id="page">

    <div class="container">

        <section class="section-stm-logo mb-0 py-2 max-width">
            <img src="<?php echo wp_get_attachment_url(get_theme_mod('custom_logo')); ?>" class="custom-logo" alt="steuermachen">
        </section>