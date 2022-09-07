<?php

/**
 * WPCF7 Spam Filter
 *
 * Adds the individual sections, settings, and controls to the theme customizer
 */
$wp_customize->add_section('wpcf7_spam_filter_section', [
    'title' => 'WPCF7 Spam Filter',
    'priority' => 40,
]);

$wp_customize->add_setting('wpcf7_spam_filter_key_words');

$wp_customize->add_control('wpcf7_spam_filter_key_words', [
    'label' => 'Schlüsselwörter',
    'description' => 'Sollte eines oder mehrere Wörter im Betreff oder der Nachricht vorkommen, so wird das Formular als Spam gespeichert und keine E-Mail versendet.<br>Hinweis: Es wird nicht auf Groß- oder Kleinschreibung geachtet und jedes einzelne Wort muss mit einem Komma (,) unterteilt werden.',
    'section' => 'wpcf7_spam_filter_section',
    'type' => 'textarea',
    'input_attrs' => [
        'placeholder' => 'spam, xevil, usw.',
    ],
]);
