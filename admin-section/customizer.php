<?php

/**
 * ***********************************
 *
 * Customizer
 *
 * @see https://themefoundation.com/wordpress-theme-customizer/
 *
 * ***********************************
 */

/**
 * TODO: change this description because the idea is copied from the onpress theme
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function steuermachen_customize_register($wp_customize)
{
    $path = get_template_directory();

    /**
     * Load Customize Configs
     */
    // Site Options
    require_once $path . '/admin-section/customizer/banner.php';
    require_once $path . '/admin-section/customizer/front-page.php';
    require_once $path . '/admin-section/customizer/sidebar.php';
    require_once $path . '/admin-section/customizer/site-identity.php';
    require_once $path . '/admin-section/customizer/countdown.php';
    require_once $path . '/admin-section/customizer/wpcf7-spam-filter.php';
}
add_action('customize_register', 'steuermachen_customize_register');
