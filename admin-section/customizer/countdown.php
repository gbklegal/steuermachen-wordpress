<?php

/**
 * Countdown
 * 
 * Adds the individual sections, settings, and controls to the theme customizer
 */
$wp_customize->add_section(
    'countdown_section',
    array(
        'title' => 'Countdown',
        'priority' => 35
    )
);


$wp_customize->add_setting(
    'countdown_end'
);

$wp_customize->add_control(
    'countdown_end',
    array(
        'label' => 'Countdown Ende',
        'description' => 'Dieses Datum wird als Standardwert für den Countdown Shortcode hergenommen.',
        'section' => 'countdown_section',
        'type' => 'datetime-local',
        'input_attrs' => array(
            'min' => substr( date('c'), 0, 16 )
        )
    )
);


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