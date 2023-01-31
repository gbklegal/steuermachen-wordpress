<?php

/**
 * Template Name: Landing Page - Grundsteuer
 */

$_publisher_mode = '';
$publisher_id = $_GET['p_id'] ?? null;
$publisher_id_param = !empty($publisher_id) ? "&p_id={$publisher_id}" : '';

if (true === is_publisher_mode()) {
    $_publisher_mode = 'publisher';
}

$_stm_property_tax = [
    ['Die neue Grundsteuer 2022', '<p>Im Jahr 2018 entschied das Bundesverfassungsgericht, dass das Grundsteuergesetz verfassungswidrig ist. Aus diesem Grund ist eine Grundsteuerreform notwendig. Aktuell sollen die Vorschriften zum Einheitswert gegen den Gleichheitsgrundsatz verstoßen. Eine neue Bewertung ist daher essenziell, weswegen alle Grundstückseigentümer nun eine Grundsteuererklärung abgeben müssen. Die Bundesländer dürfen durch die Länderöffnungsklausel eigene Grundsteuermodelle verwenden und vom Bundesmodell abweichen. Sieben Länder haben ein eigenes Modell gewählt, weswegen sich die Berechnungen der Grundsteuer unterscheiden.</p>'],
    ['Wen betrifft die Grundsteuerreform?', '<p>Sobald du ein Grundstück besitzt, betrifft dich die Grundsteuerreform. Prinzipiell können Vermieter die Grundsteuer auf ihre Mieter verlegen, trotzdem müssen diese eine Grundsteuererklärung abgeben. Demnach muss für die rund 36 Millionen Grundstücke jeweils eine Grundsteuererklärung abgegeben werden. Besitzt du mehr als ein Grundstück, kann das schnell umständlich werden.</p>'],
    [
        'Wie wird die Grundsteuer im Bundesmodell berechnet?',
        '<p>Im Bundesmodell ist eine Neubewertung der Immobilien und der Grundstücke essenziell. Dabei müssen neben dem Bodenrichtwert auch die Grundstücksfläche, die Immobilienart sowie die Gebäudefläche, die statistische Nettokaltmiete und die Mietniveaustufe ermittelt werden.</p>
<p>Das dreistufige Besteuerungsverfahren ist für die neue Grundsteuer festgesetzt. Dabei wird zunächst der Grundsteuerwert festgelegt. Durch das Multiplizieren des Grundsteuerwerts mit der Steuermesszahl erhältst du den Steuermessbetrag. Die Städte und Gemeinden setzen dann durch das Multiplizieren des Steuermessbetrags mit dem Hebesatz die Grundsteuer fest.</p>',
    ],
    ['Die neue Grundsteuererklärung', '<p>Die Abgabefrist der Feststellungserklärung ist am 31.10.2022. Die Grundsteuererklärung muss elektronisch an das Finanzamt übermittelt werden, ansonsten kann ein Zwangsgeld auf dich zukommen. Bist du Eigentümer eines Grundstücks oder einer Immobilie, so musst du eine Steuererklärung abgeben. Auch als Eigentümer eines land- und forstwirtschaftlichen Betriebs und als Erbberechtigter musst du eine Steuererklärung abgeben.</p>'],
    [
        'Wie viel kostet die Grundsteuererklärung?',
        '<p>Wenn du deine Einkommensteuererklärung bei einem Lohnsteuerhilfeverein machen lässt, kann dir dieser bei der Feststellungserklärung nicht helfen. Lohnsteuerhilfevereine sind nicht dazu befugt, die Grundsteuererklärung anzufertigen. Alternativ kannst du auch bei einem Steuerberater deine Feststellungserklärung anfertigen lassen. Diese müssen sich an die Steuerberatervergütungsverordnung halten. Hier muss der Steuerberater eine Gebühr verlangen, die abhängig vom Grundstückswert (Gegenstandswert) ist.</p>
<p>Wir bieten die Abgaben der Steuererklärung bereits ab 89,00 EUR brutto an.</p>',
    ],
    ['Wie kannst du die Steuererklärung abgeben?', '<p>Du kannst die Grundsteuererklärung entweder selbst über deinen ELSTER-Zugang abgeben oder du nimmst professionelle Hilfe von deinem persönlichen Steuerexperten in Anspruch. Über steuermachen kannst du einfach und schnell die Grundsteuererklärung machen lassen.</p>'],
];

get_header($_publisher_mode);
?>

<main class="main-content landing-page">
    <header id="hero" class="mb-5">
        <div class="hero-inner max-width">
            <div>
                <h1 class="text-left"><span class="h2 text-primary">Deine Grund&shy;steuer&shy;erklärung</span><br><span class="font-medium h3">Jetzt einfach von Steuer&shy;experten machen lassen</span></h1>
                <a href="/steuererklaerung-beauftragen/?product=grundsteuererklärungMACHEN<?= $publisher_id_param ?>" class="mt-4 btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
            <div class="hero-image-wrapper dots">
                <?php echo get_image_tag('32979', 'BILD BESCHREIBUNG', 'Grundsteuer', 'left', 'full'); ?>
            </div>
        </div>
    </header>

    <section>
        <div class="mt-16 section-inner max-width">
            <p><strong>Im Jahr 2018 entschied das Bundesverfassungsgericht, dass das Grundsteuergesetz verfassungswidrig ist.</strong></p>
            <p>Rund 36 Millionen Immobilien in Deutschland müssen neu bewertet werden. </p>
            <p>Alle Eigentümer eines Grundstücks müssen bis zum 31. Oktober eine Grundsteuererklärung abgeben. Und das für jedes einzelne Grundstück/ Immobilie! </p>
            <p>Versäumst du die Abgabe der Feststellungserklärung, so musst du mit einem hohen Zwangsgeld und einer Schätzung rechnen.</p>
        </div>
    </section>

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

    <section>
        <div class="section-inner max-width">
            <p>Die Grundsteuererklärung ist neu und sieben Bundesländer haben bereits ihre eigenen Grundsteuermodelle. Das macht die Erstellung der Steuererklärung noch komplizierter!</p>
            <p>Durch steuermachen erhältst du die ideale und einfache Unterstützung deines persönlichen Steuerexperten. So kannst du unkompliziert und preiswert deine Grundsteuererklärung machen lassen.</p>
            <p class="text-center"><a href="/steuererklaerung-beauftragen/steuererklaerung-beauftragen/?product=grundsteuererklärungMACHEN<?= $publisher_id_param ?>" class="mt-4 btn btn-primary btn-lg order-now">Jetzt beauftragen</a></p>
        </div>
    </section>

    <section class="section-price">
        <div class="text-center section-inner">
            <h2 class="pb-3"><span class="text-primary">Berechne</span> deinen individuellen <span class="text-primary">Preis</span></h2>

            <div class="calculator-wrapper">
                <div class="calculator-inner">
                    <p class="mb-2">Die Preise der Steuerexperten richten sich nach der Steuerberatervergütungsverordnung und werden anhand des Grundstückswerts bestimmt.</p>
                    <p class="mb-4">Mit unserem Preisrechner kannst du deinen voraussichtlichen Preis berechnen.</p>

                    <?php the_property_tax_price_calculator(['url' => "/steuererklaerung-beauftragen/?product=grundsteuererklärungMACHEN{$publisher_id_param}&property_value="]); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section-benefits">
        <div class="section-inner max-width">
            <div class="benefits-box box-shadow">
                <div class="px-4 py-3 header bg-primary">
                    <h3>Sichere dir jetzt deinen persönlichen Steuerexperten zur Erstellung deiner Grund&shy;steuer&shy;erklärung:</h3>
                </div>
                <div class="main">
                    <ul class="benefits">
                        <li>Professionelle und individuelle Beratung</li>
                        <li>Sicherheitsgarantie durch Steuerexperten an deiner Seite</li>
                        <li>Zeit und Nerven gespart</li>
                        <li>Einfache und sichere Erfassung der relevanten Daten</li>
                        <li>Faire und transparente Preise</li>
                    </ul>

                    <img src="<?php echo STM_THEME_IMG; ?>/tax.svg" alt="Tax">
                </div>
            </div>

            <div class="mt-5 text-center order-now">
                <a href="/steuererklaerung-beauftragen/?product=grundsteuererklärungMACHEN<?= $publisher_id_param ?>" class="btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
        </div>
    </section>

    <!-- <section class="section-explanation">
        <div class="section-inner max-width">
            <h5>Die neue Grundsteuer 2022</h5>
            <p>Im Jahr 2018 entschied das Bundesverfassungsgericht, dass das Grundsteuergesetz verfassungswidrig ist. Aus diesem Grund ist eine Grundsteuerreform notwendig. Aktuell sollen die Vorschriften zum Einheitswert gegen den Gleichheitsgrundsatz verstoßen. Eine neue Bewertung ist daher essenziell, weswegen alle Grundstückseigentümer nun eine Grundsteuererklärung abgeben müssen. Die Bundesländer dürfen durch die Länderöffnungsklausel eigene Grundsteuermodelle verwenden und vom Bundesmodell abweichen. Sieben Länder haben ein eigenes Modell gewählt, weswegen sich die Berechnungen der Grundsteuer unterscheiden.</p>
            <p>&nbsp;</p>
            <h5>Wen betrifft die Grundsteuerreform?</h5>
            <p>Sobald du ein Grundstück besitzt, betrifft dich die Grundsteuerreform. Prinzipiell können Vermieter die Grundsteuer auf ihre Mieter verlegen, trotzdem müssen diese eine Grundsteuererklärung abgeben. Demnach muss für die rund 36 Millionen Grundstücke jeweils eine Grundsteuererklärung abgegeben werden. Besitzt du mehr als ein Grundstück, kann das schnell umständlich werden.</p>
            <p>&nbsp;</p>
            <h5>Wie wird die Grundsteuer im Bundesmodell berechnet?</h5>
            <p>Im Bundesmodell ist eine Neubewertung der Immobilien und der Grundstücke essenziell. Dabei müssen neben dem Bodenrichtwert auch die Grundstücksfläche, die Immobilienart sowie die Gebäudefläche, die statistische Nettokaltmiete und die Mietniveaustufe ermittelt werden.</p>
            <p>Das dreistufige Besteuerungsverfahren ist für die neue Grundsteuer festgesetzt. Dabei wird zunächst der Grundsteuerwert festgelegt. Durch das Multiplizieren des Grundsteuerwerts mit der Steuermesszahl erhältst du den Steuermessbetrag. Die Städte und Gemeinden setzen dann durch das Multiplizieren des Steuermessbetrags mit dem Hebesatz die Grundsteuer fest.</p>
            <p>&nbsp;</p>
            <h5>Die neue Grundsteuererklärung</h5>
            <p>Die Abgabefrist der Feststellungserklärung ist am 31.10.2022. Die Grundsteuererklärung muss elektronisch an das Finanzamt übermittelt werden, ansonsten kann ein Zwangsgeld auf dich zukommen. Bist du Eigentümer eines Grundstücks oder einer Immobilie, so musst du eine Steuererklärung abgeben. Auch als Eigentümer eines land- und forstwirtschaftlichen Betriebs und als Erbberechtigter musst du eine Steuererklärung abgeben.</p>
            <div class="my-5 text-center order-now">
                <a href="/steuererklaerung-beauftragen/?product=grundsteuererklärungMACHEN<?= $publisher_id_param ?>" class="btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
            </div>
            <h5>Wie viel kostet die Grundsteuererklärung?</h5>
            <p>Wenn du deine Einkommensteuererklärung bei einem Lohnsteuerhilfeverein machen lässt, kann dir dieser bei der Feststellungserklärung nicht helfen. Lohnsteuerhilfevereine sind nicht dazu befugt, die Grundsteuererklärung anzufertigen. Alternativ kannst du auch bei einem Steuerberater deine Feststellungserklärung anfertigen lassen. Diese müssen sich an die Steuerberatervergütungsverordnung halten. Hier muss der Steuerberater eine Gebühr verlangen, die abhängig vom Grundstückswert (Gegenstandswert) ist.</p>
            <p>Wir bieten die Abgaben der Steuererklärung bereits ab 89,00 EUR brutto an.</p>
            <p>&nbsp;</p>
            <h5>Wie kannst du die Steuererklärung abgeben?</h5>
            <p>Du kannst die Grundsteuererklärung entweder selbst über deinen ELSTER-Zugang abgeben oder du nimmst professionelle Hilfe von deinem persönlichen Steuerexperten in Anspruch. Über steuermachen kannst du einfach und schnell die Grundsteuererklärung machen lassen.</p>
        </div>
    </section> -->
    <div class="accordion-wrapper">
        <div class="accordion-inner">
            <?php foreach ($_stm_property_tax as $entry): ?>
                <button class="accordion">
                    <h3><?= $entry[0] ?></h3>
                    <svg class="icon-plus" width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.01367 16H27.0137" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.0137 5V27" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="panel">
                    <div class="panel-inner"><?= $entry[1] ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="my-5 text-center order-now">
        <a href="/steuererklaerung-beauftragen/?product=grundsteuererklärungMACHEN<?= $publisher_id_param ?>" class="btn btn-primary btn-lg order-now">Jetzt beauftragen</a>
    </div>
</main>

<?php get_footer($_publisher_mode);
