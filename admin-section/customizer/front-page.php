<?php

// TODO: add banner section to front page panel

/**
 * Front Page (Startseite)
 */
$wp_customize->add_panel(
    'front_page_panel',
    array(
        'title' => 'Startseite',
        'priority' => 30
    )
);

$wp_customize->add_section(
    'front_page_rating_1_section',
    array(
        'title' => 'Bewertung 1',
        'panel' => 'front_page_panel',
        'priority' => 35,
    )
);

/**
 * Rating 1
 * Name
 */
$wp_customize->add_setting(
    'front_page_rating_name'
);

$wp_customize->add_control(
    'front_page_rating_name',
    array(
        'label' => 'Name',
        'section' => 'front_page_rating_1_section',
        'type' => 'text',
    )
);

/**
 * Rating 1
 * Date
 */
$wp_customize->add_setting(
    'front_page_rating_date'
);

$wp_customize->add_control(
    'front_page_rating_date',
    array(
        'label' => 'Datum',
        'section' => 'front_page_rating_1_section',
        'type' => 'date',
    )
);

/**
 * Rating 1
 * Quote
 */
$wp_customize->add_setting(
    'front_page_rating_quote'
);

$wp_customize->add_control(
    'front_page_rating_quote',
    array(
        'label' => 'Inhalt',
        'section' => 'front_page_rating_1_section',
        'type' => 'textarea',
    )
);

/**
 * Rating 1
 * Star Rating
 */
$wp_customize->add_setting(
    'front_page_rating_star_rating'
);

$wp_customize->add_control(
    'front_page_rating_star_rating',
    array(
        'label' => 'Bewertung',
        'description' => '',
        'section' => 'front_page_rating_1_section',
        'type' => 'number',
    )
);

// $wp_customize->add_setting(
//     'banner_content'
// );

// $wp_customize->add_control(
//     'banner_content',
//     array(
//         'label' => 'Inhalt des Banners',
//         'section' => 'banner_section',
//         'type' => 'textarea',
//     )
// );