<?php

/**
 * Template Name: FAQ
 */

get_header();

?>
<main class="main-content faq">
    <div id="hero" class="hero-wrapper">
        <div class="hero-text">
            <h1>Häufig gestellte Fragen (FAQ)</h1>
            <p>Haben Sie ein paar Fragen, bevor Sie beginnen?</p>
        </div>
        <div class="hero-image">
            <img src="<?php echo STM_THEME_URL; ?>/img/faq.png" alt="" srcset="<?php echo STM_THEME_URL; ?>/img/faq@2x.png 2x">
        </div>
    </div>
    <div class="content-wrapper">
        <section>
        <?php the_content(); ?>
        </section>

        <section>
            <header class="text-center">
                <h2>So einfach geht's mit Steuern</h2>
                <h3 class="font-normal">Angst vor der Steuererklärung? - Keine Panik</h3>
            </header>
        </section>

        <section class="curvy-video-section">
            <img class="alignfull" src="<?php echo STM_THEME_URL; ?>/img/curvy.svg">
            <div class="curvy-video-inner">
                <h2>Sehen Sie sich unser Video an, um mehr zu erfahren</h2>
                <iframe loading="lazy" src="https://player.vimeo.com/video/582851235" allow="autoplay; fullscreen" allowfullscreen="" width="640" height="360" frameborder="0"></iframe>
            </div>
        </section>
        <div class="cta text-center">
            <a class="btn btn-primary" href="">Jetzt Steuererklärung machen lassen</a>
        </div>
    </div>
</div>
<?php

get_footer();