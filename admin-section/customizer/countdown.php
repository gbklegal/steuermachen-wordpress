<?php

/**
 * Countdown
 *
 * Adds the individual sections, settings, and controls to the theme customizer
 */
$wp_customize->add_section('countdown_section', [
    'title' => 'Countdown',
    'priority' => 40,
]);

$wp_customize->add_setting('countdown_end');

$wp_customize->add_control('countdown_end', [
    'label' => 'Countdown Ende',
    'description' => 'Dieses Datum wird als Standardwert für den Countdown Shortcode hergenommen.',
    'section' => 'countdown_section',
    'type' => 'datetime-local',
    'input_attrs' => [
        'min' => substr(date('c'), 0, 16),
    ],
]);

// TODO uncomment this section when it can be implemented
// $wp_customize->add_setting(
//     'countdown_end_text'
// );

// $wp_customize->add_control(
//     'countdown_end_text',
//     array(
//         'label' => 'Countdown Text Ende',
//         'description' => 'Dieser Text wird angezeit, nachdem der Countdown abgelaufen ist.',
//         'section' => 'countdown_section',
//         'type' => 'text'
//     )
// );
