<?php

/**
 * Template Name: FAQ
 */

get_header();

?>
<main class="main-content faq">
    <div id="hero" class="hero-wrapper">
        <div class="hero-text">
            <?php the_title( '<h1>', '</h1>' ); ?>
            <?php if (has_secondary_title()): ?>
                <div class="secondary-title"><?php the_secondary_title(); ?></div>
            <?php endif; ?>
        </div>
        <?php if (has_title_image()): ?>
            <div class="hero-image">
                <?php the_title_image(); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="content-wrapper">
        <section>
        <?php the_content(); ?>
        </section>

        <section class="section-mt easy-with-tax-section">
            <header class="text-center">
                <h2 class="mb-0">So einfach geht's mit Steuern</h2>
                <h3 class="font-normal">Angst vor der Steuererklärung? - Keine Panik</h3>
            </header>

            <main>

                <div class="tabs-wrapper">

                    <div class="changeable-part" data-tabs="content">
                        <div class="content content-selected">
                            <img src="https://picsum.photos/id/198/800/600" alt="">
                        </div>
                        <div class="content">
                            <img src="https://picsum.photos/id/221/800/600" alt="">
                        </div>
                        <div class="content">
                            <img src="https://picsum.photos/id/238/800/600" alt="">
                        </div>
                        <div class="content">
                            <img src="https://picsum.photos/id/1037/800/600" alt="">
                        </div>
                    </div>

                    <div class="selections" data-tabs="selector">
                        <div class="item item-selected">
                            <h3>Beantragen Sie die gewünschte Steuererklärung</h3>
                            <p>Füllen Sie das Bestellformular aus, wählen Sie das gewünschte aus Steuerjahr, für das Sie die Einkommensteuererklärung gemacht und einfach abschicken die Form.</p>
                        </div>
                        <div class="item">
                            <h3>Dokumente vorbereiten und versenden</h3>
                            <p>Füllen Sie das Bestellformular aus, wählen Sie das gewünschte aus Steuerjahr, für das Sie die Einkommensteuererklärung gemacht und einfach abschicken die Form.</p>
                        </div>
                        <div class="item">
                            <h3>Ihr persönliches Finanzamt bietet die Lösung für Ihre Steuererklärung</h3>
                            <p>Fill out the order form, select the desired tax year for which you want to have the income tax return made and simply submit the form.</p>
                        </div>
                        <div class="item">
                            <h3>Fertig: Sie erhalten Ihre geprüfter Steuerbescheid</h3>
                            <p>Wenn Ihr Steuerbescheid vorliegt vom Finanzamt erstellt, wird es von Ihren Steuerexperten geprüft und an Sie weitergeleitet.</p>
                        </div>
                    </div>

                </div>

            </main>
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