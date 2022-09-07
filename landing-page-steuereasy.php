<?php

/**
 * Template Name: Landing Page - steuerEASY
 */

get_header();
?>

<main class="main-content landing-page">
    <header id="hero">
        <div class="hero-inner max-width">
            <div>
                <h1 class="text-left"><span class="h2 text-primary">steuerEASY</span><br><span class="font-medium h3">Deine kostengünstige Erstberatung von Steuerexperten</span></h1>
                <a href="/steuererklaerung-beauftragen/?product=steuerEASY" class="mt-4 btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
            <!-- <img src="<?php echo STM_THEME_IMG; ?>/mortgage-loan.svg" alt="Grundsteuererklärung"> -->
            <div class="hero-image-wrapper dots">
                <?php echo get_image_tag(32974, 'steuermachen', 'steuermachen', 'left', 'full'); ?>
            </div>
        </div>
    </header>

    <!-- <section class="section-countdown">
        <div class="text-center section-inner max-width">
            <div class="p-5 text-white countdown-wrapper box-shadow">
                <h4 class="text-left">Keine Frist verpassen. Der Countdown für die Abgabe deiner Steuererklärung 2021 läuft!</h4>
                <?php # the_countdown('October 31, 2022 23:59:59'); ?>
                <?php the_countdown(); ?>
            </div>
        </div>
    </section> -->

    <section class="section-price my-6">
        <!-- <div class="section-inner aligncenter">
            <div class="img-label-wrapper">
                <?php echo get_image_tag(32980, 'Steuer Sprechblasen', '', 'right'); ?>
                <div class="label">Kostengünstige Erstberatung - steuerEASY jetzt bestellen!</div>
            </div>
            <div class="price-wrapper">25,00 €</div>
        </div> -->
        <div class="price-card mx-auto">
            <div>
                <div class="title">steuerEASY</div>
                <ul class="description">
                    <li>Du erhälst eine kostengünstige Beratung</li>
                    <li>Du hast Fragen zu steuerlichen Themen? Buche eine Beratung mit einem Steuerexperten.</li>
                </ul>
            </div>
            <div>
                <div class="price-wrapper">
                    <div class="price">25 €</div>
                    <div class="vat-info">(inkl. MwSt.)</div>
                </div>
                <div class="cta-wrapper">
                    <a class="btn btn-primary btn-mdxl" href="/steuererklaerung-beauftragen/?product=steuerEASY">Jetzt beauftragen</a></div>
                </div>
            </div>
        <div>
    </section>

    <section class="section-benefits">
        <div class="section-inner max-width">
            <div class="benefits-box box-shadow">
                <div class="px-4 py-3 header bg-secondary">
                    <h3>Sichere dir jetzt deinen persönlichen Steuerexperten und deine optimale Steuer&shy;rück&shy;erstattung:</h3>
                </div>
                <div class="main">
                    <ul class="benefits">
                        <li>Professionelle Beratung</li>
                        <li>Nur im Falle der Rückererstattung fallen Kosten an </li>
                        <li>Zeit und Nerven gespart</li>
                        <li>Einfache Anwendung</li>
                        <li>Sicherheitsgarantie durch Steuerexperten an deiner Seite</li>
                    </ul>

                    <img src="<?php echo STM_THEME_IMG; ?>/tax.svg" alt="Tax">
                </div>
            </div>

            <div class="mt-5 text-center order-now">
                <a href="/steuererklaerung-beauftragen/?product=steuerEASY" class="btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
        </div>
    </section>
</main>

<?php

get_footer();