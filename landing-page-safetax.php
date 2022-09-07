<?php

/**
 * Template Name: Landing Page - safeTax
 */

get_header();
?>

<main class="main-content landing-page">
    <header id="hero">
        <div class="hero-inner max-width">
            <div>
                <h1 class="text-left"><span class="h2 text-primary">safeTax</span><span class="font-medium h3"> - Deine Einkommen&shy;steuererklärung mit vollständiger Kostenkontrolle </span></h1>
                <a href="/steuererklaerung-beauftragen/?product=safeTax" class="mt-4 btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
            <div class="hero-image-wrapper dots">
                <?php echo get_image_tag('32977', 'BILD BESCHREIBUNG', 'safeTax', 'left', 'full'); ?>
            </div>
        </div>
    </header>

    <section class="section-countdown">
        <div class="text-center section-inner max-width">
            <div class="p-5 text-white countdown-wrapper box-shadow">
                <h4 class="text-left">
                    <p>Verpasse nicht die Frist!</p>
                    <p class="mb-0">Der Countdown für die Abgabe deiner Grundsteuererklärung läuft!</p>
                </h4>
                <?php the_countdown('2022-10-31 23:59:59'); ?>
            </div>
        </div>
    </section>

    <section class="section-price section-my">
        <div class="text-center section-inner">
            <h2 class="mb-3"><span class="text-primary">Berechne</span> deinen <span class="text-primary">Steuerrückerstattung</span></h2>
            <?php the_steuerrechner(); ?>
            <p class="mt-2 text-grey mx-auto max-w-full">safeTax: Nur im Falle einer Rückerstattung erhalten wir einen geringfügigen Anteil von 20%.</p>
            <a class="btn btn-primary mx-auto block whitespace-nowrap w-fit" href="/steuererklaerung-beauftragen/?product=safeTax">Jetzt Steuererklärung machen lassen</a>

            <!-- <div class="calculator-wrapper">
                <div class="calculator-inner">
                    <p class="mb-2">Die Preise der Steuerexperten richten sich nach der Steuerberatervergütungsverordnung und werden anhand des Grundstückswerts bestimmt.</p>
                    <p class="mb-4">Mit unserem Preisrechner kannst du deinen voraussichtlichen Preis berechnen.</p>

                    <?php the_property_tax_price_calculator(); ?>
                </div>
            </div> -->
        </div>
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
                <a href="/steuererklaerung-beauftragen/?product=safeTax" class="btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
        </div>
    </section>
</main>

<?php

get_footer();