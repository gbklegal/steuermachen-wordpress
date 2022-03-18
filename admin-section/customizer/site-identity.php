<?php

// Retina Logo
$wp_customize->add_setting( 'custom_retina_logo',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
        // 'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'custom_retina_logo',
        array(
            'label'   => 'Retina Logo',
            'section' => 'title_tagline',
        )
    )
);