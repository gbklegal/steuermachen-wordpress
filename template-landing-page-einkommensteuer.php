<?php

/**
 * Template Name: Landing Page - Einkommensteuer
 */

$_publisher_mode = '';
$publisher_id = $_GET['p_id'] ?? null;
$publisher_id_param = !empty($publisher_id) ? "&p_id={$publisher_id}" : '';

if (true === is_publisher_mode()) {
    $_publisher_mode = 'publisher';
}

get_header($_publisher_mode);
?>

<main class="main-content landing-page">
    <header id="hero">
        <div class="hero-inner max-width">
            <div>
                <h1 class="text-left"><span class="h2 text-primary<?php echo return_if(is_christmas_time(), ' text-christmas'); ?>">Deine Einkommen&shy;steuer&shy;erklärung</span><br><span class="font-medium h3">Jetzt einfach von Steuer&shy;experten machen lassen</span></h1>
                <a href="/steuererklaerung-beauftragen/?product=steuererklärungMACHEN<?= $publisher_id_param ?>" class="mt-4 btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
            <div class="hero-image-wrapper dots">
                <?php echo get_image_tag(33022, 'Begeisterte Frau', 'Einkommensteuer', 'left', 'full'); ?>
            </div>
        </div>
    </header>

    <section class="section-countdown">
        <div class="text-center section-inner max-width">
            
            <div class="p-5 text-white countdown-wrapper box-shadow">
                <h4 class="text-left">Keine Frist verpassen. Der Countdown für die Abgabe deiner Steuererklärung 2021 läuft!</h4>
                <?php
# the_countdown('October 31, 2022 23:59:59');
?>
                <?php the_countdown(); ?>
            </div>
        </div>
    </section>

    <section class="section-price">
        <div class="text-center section-inner">
            <h2 class="pb-3"><span class="text-primary">Berechne</span> deinen individuellen <span class="text-primary">Preis</span></h2>

            <div class="calculator-wrapper">
                <div class="calculator-inner">
                    <p class="mb-2">Unsere Preise sind gestaffelt, für die Einkommensteuererklärung nach Bruttojahreseinkommen</p>
                    <p class="mb-4">Mit unserem Beitragsrechner kannst du deinen voraussichtlichen Preis berechnen</p>

                    <?php the_price_calculator([
                        'url' => "/steuererklaerung-beauftragen/?product=steuererklärungMACHEN{$publisher_id_param}&bje=",
                    ]); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section-benefits">
        <div class="section-inner max-width">
            <div class="benefits-box box-shadow">
                <div class="px-4 py-3 text-white header bg-primary">
                    <h3>Sichere dir jetzt deinen persönlichen Steuerexperten und deine optimale Steuer&shy;rückerstattung:</h3>
                </div>
                <div class="main">
                    <ul class="benefits">
                        <li>Professionelle Beratung</li>
                        <li>Maximale Rückererstattung</li>
                        <li>Einfache Anwendung</li>
                        <li>Zeit und Nerven sparend</li>
                        <li>Sicherheitsgarantie durch Steuerexperten an deiner Seite</li>
                    </ul>

                    <img src="<?php echo STM_THEME_IMG; ?>/tax.svg" alt="Tax">
                </div>
            </div>

            <div class="mt-5 text-center order-now">
                <a href="/steuererklaerung-beauftragen/?product=steuererklärungMACHEN<?= $publisher_id_param ?>" class="btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer($_publisher_mode);
