<?php

/**
 * Template Name: Newsletter
 */

add_filter('body_class', function ($classes) {
    return array_merge($classes, ['no-gradient', 'bg-transparent']);
});

$_subscribe_newsletter = isset($_GET['subscribe_newsletter']) ?? false;
$_is_frame_mode = is_frame_mode();
$_frame_mode = $_is_frame_mode ? '' : ' class="main-content"';

get_header();
?>
<main<?= $_frame_mode ?>>
    <?php if (!$_is_frame_mode): ?>
    <h1><?= the_title() ?></h1>
    <?php endif; ?>
    <?php if (false === $_subscribe_newsletter): ?>
    <form action="<?php echo manipulate_get_params(['subscribe_newsletter' => '']); ?>" method="post">
        <div class="row">
            <div class="field-wrapper">
                <input class="field" type="text" name="firstname" placeholder=" " require>
                <label>Vorname</label>
            </div>
        </div>
        <div class="row">
            <div class="field-wrapper">
                <input class="field" type="text" name="lastname" placeholder=" " require>
                <label>Nachname</label>
            </div>
        </div>
        <div class="row">
            <div class="field-wrapper">
                <input class="field" type="text" name="email" placeholder=" " require>
                <label>E-Mail</label>
            </div>
        </div>
        <div class="row">
            <input class="btn btn-full" type="submit" value="Anmelden">
        </div>
    </form>
    <p class="mt-3 mb-0 text-xs text-justify text-grey">Für den Versand unserer Newsletter nutzen wir rapidmail. Mit deiner Anmeldung stimmst du zu, dass die eingegebenen Daten an rapidmail übermittelt werden. Beachte bitte deren <a href="https://www.rapidmail.de/agb" target="_blank" rel="noreferrer noopener">AGB</a> und <a href="https://www.rapidmail.de/datenschutz-kundenbereich" target="_blank" rel="noreferrer noopener">Datenschutzbestimmungen</a>.</p>
    <?php else: ?>
    <div class="newsletter-final">
        <?php echo get_image_tag(32994, 'lächelnder Panda', '', 'center', [100, 100]); ?>
        <h3 class="text-center">Vielen Dank für deine Anmeldung!</h3>
        <p class="text-center">Wir haben dir auch schon die erste E-Mail geschickt und bitten dich, deine E-Mail-Adresse über den Aktivierungslink zu bestätigen.</p>
    </div>
    <?php endif; ?>
</main>

<?php get_footer();
