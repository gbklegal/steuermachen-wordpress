<?php

/**
 * Banner
 * 
 * Adds the individual sections, settings, and controls to the theme customizer
 */
$wp_customize->add_section(
    'banner_section',
    array(
        'title' => 'Banner',
        // 'description' => 'Inhalt des Banners.',
        'priority' => 35,
    )
);

$wp_customize->add_setting(
    'hide_banner'
);

$wp_customize->add_control(
    'hide_banner',
    array(
        'label' => 'Banner ausblenden',
        'section' => 'banner_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'banner_content'
);

$wp_customize->add_control(
    'banner_content',
    array(
        'label' => 'Inhalt des Banners',
        'section' => 'banner_section',
        'type' => 'textarea',
    )
);