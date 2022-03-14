<?php
/**
 * The header for the steuermachen theme.
 * 
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * 
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

// add_enqueue_script_attributes(, 'defer');
// wp_enqueue_style('steuermachen-style-old', 'https://steuermachen.de/wp-content/themes/onepress-child/style.css');
wp_enqueue_style('steuermachen-style', get_bloginfo('stylesheet_url'));
wp_enqueue_script('steuermachen-script', get_template_directory_uri() . '/js/script.js');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

    <!-- <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"> -->

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=wp_get_document_title()?></title>

    <?php wp_head(); ?>

</head>
<body>

    <div id="page">
        <header id="header">
            <div class="header-inner">
                <div class="header-content">
                    <div class="header-part">
                        <a href="<?php echo home_url(); ?>">
                            <?php echo get_image_tag('31979', 'steuermachen', 'steuermachen', 'left', [0, 42]); ?>
                        </a>
                        <div class="menu-top-container-wrapper hidden-on-mobile">
                            <?php get_nav_menu('primary'); ?>
                        </div>
                    </div>
                    <div class="header-part">
                        <div class="hidden-on-mobile">
                            <!-- TODO: convert button to a link button -->
                            <button class="btn btn-primary">Anmelden</button>
                        </div>
                    </div>
                </div>
                <div class="header-mobile">
                    <i class="icon-menu" data-show-menu></i>

                    <div class="header-mobile-overlay" id="menu-mobile">
                        <i class="icon-x" data-hide-menu></i>

                        <div class="header-mobile-overlay-inner">
                            <?php get_nav_menu('primary'); ?>
                            <!-- TODO: convert button to a link button -->
                            <button class="btn btn-primary">Anmelden</button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

<?php # exit; ?>

    <div class="container">