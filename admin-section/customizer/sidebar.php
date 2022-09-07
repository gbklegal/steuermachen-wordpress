<?php

/**
 * Sidebar
 */

/**
 * Config
 */
$sidebar_quick_link_count = 4;

/**
 * Customizer
 */
$wp_customize->add_panel('siderbar_panel', [
    'title' => 'Seitenleiste',
    'priority' => 36,
]);

$wp_customize->add_section('quick_links_section', [
    'title' => 'Quick Links',
    'panel' => 'siderbar_panel',
    // 'priority' => 35,
]);

global $post;
$args = [
    'numberposts' => -1,
    'post_type' => 'post',
    'post_status' => 'publish',
];
$posts = get_posts($args);

$select_posts = [
    false => 'Keinen Blogbeitrag anzeigen',
];

foreach ($posts as $post) {
    $select_posts[$post->ID] = $post->ID . ' | ' . $post->post_title;
}

/**
 * @param int $number
 * @param array $choices
 */
$quick_link_template = function ($number, $choices) {
    global $select_posts;

    if (!$number || !$choices) {
        return [];
    }

    return [
        'label' => "Quick Link {$number}",
        'description' => 'Wähle einen Blogbeitrag aus',
        'section' => 'quick_links_section',
        'type' => 'select',
        'choices' => $choices,
    ];
};

for ($i = 1; $i <= $sidebar_quick_link_count; $i++) {
    $wp_customize->add_setting("quick_link_{$i}");

    $wp_customize->add_control("quick_link_{$i}", $quick_link_template($i, $select_posts));
}
