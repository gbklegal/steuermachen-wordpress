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

$wp_customize->add_setting(
    'banner_link'
);

$wp_customize->add_control(
    'banner_link',
    array(
        'label' => 'Bannerverlinkung',
        'description' => 'Leer lassen um den Banner <strong>nicht</strong> zu verlinken.',
        'section' => 'banner_section',
        'type' => 'url',
        // 'type' => 'dropdown-pages',
    )
);