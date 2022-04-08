<?php

/**
 * Template Name: Landing Page
 */

/**
 * TODO List
 * create two files
 * - 1: header-fa-landing.php
 * - 2: footer-fa-landing.php
 * include them with get_header( 'fa-landing' ) and so on.
 * Add Christmas Support (fa-landing template from live site)
 */

// echo 'Landing Page ()';

function is_fa_landing() {
    global $post;

    if ($post->post_name === 'steuererklaerung-beauftragen-fa-landing')
        return true;

    return false;
}

/**
 * this variable if empty but if it is 'fa landing'
 * the value will conain the 'fa-landing' value
 */
$_fa_landing = '';

if ( true === is_fa_landing() )
    $_fa_landing = 'fa-landing';

get_header( $_fa_landing );
?>

<main class="main-content landing-page">
    <header id="hero">
        <div class="hero-inner max-width">
            <div>
                <h1 class="text-left"><span class="h2 text-primary<?php echo echo_if( is_christmas_time(), ' text-christmas' ); ?>">Deine Einkommen&shy;steuer&shy;erklärung</span><br><span class="font-medium h3">Jetzt einfach von Steuer&shy;experten machen lassen</span></h1>
                <a href="/steuererklaerung-beauftragen/?p_id=4231" class="mt-4 btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
            <img src="<?php echo STM_THEME_IMG; ?>/hero-icon<?php echo echo_if( is_christmas_time(), '-christmas' ); ?>.svg">
        </div>
    </header>

    <section class="section-countdown">
        <div class="text-center section-inner max-width">
            
            <div class="p-5 text-white countdown-wrapper box-shadow">
                <h4 class="text-left">Keine Frist verpassen. Der Countdown für die Abgabe deiner Steuererklärung 2021 läuft!</h4>
                <?php # the_countdown('October 31, 2022 23:59:59'); ?>
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

                    <?php the_price_calculator(); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section-benefits">
        <div class="section-inner max-width">
            <div class="benefits-box box-shadow">
                <div class="px-4 py-3 text-white header bg-secondary">
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
                <a href="/steuererklaerung-beauftragen/?p_id=4231" class="btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
        </div>
    </section>
</main>

<?php

get_footer( $_fa_landing );