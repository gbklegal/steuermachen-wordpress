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
