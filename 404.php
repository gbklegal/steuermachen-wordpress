<?php

/**
 * Redirect old blog URLs to the current pattern.
 */

/**
 * @return string
 */
$_get_path = function () {
    $uri = $_SERVER['REQUEST_URI'];
    $path = explode('?', $uri)[0];

    return $path;
};

/**
 * @return bool;
 */
$_match_pattern = function () use ($_get_path) {
    $pattern = '/^\/\d{4}\/\d{2}\/\d{2}\/[\d\w\-]+\/?/';

    return preg_match($pattern, $_get_path()) === 1;
};

if ($_match_pattern()) {
    $extracted_slug = explode('/', $_get_path())[4];

    wp_redirect(home_url('/steuerratgeber/' . $extracted_slug));
}
?>
<?php get_header(); ?>
<img src="<?php echo STM_THEME_URL; ?>/img/404.svg" class="_404-image">
<main class="text-center main-content _404">
    <h2 class="uppercase">Ups! Die Seite konnte leider nicht gefunden werden.</h2>
    <a class="btn btn-primary btn-lg" href="<?php echo get_site_url(); ?>"><i class="icon-arrow-left"></i> Zurück zu Startseite</a>
    <form class="search-form" action="<?php echo get_site_url(); ?>" method="get">
        <p>Vielleicht versuchen Sie es mit einem der untenstehenden Links oder einer Suche?</p>
        <div class="field-wrapper">
            <input type="search" name="s" class="field field-search" placeholder=" " required="">
            <span class="field-icon"></span>
            <label>Suche</label>
        </div>
    </form>
</main>
<?php get_footer();
