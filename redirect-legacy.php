<?php

/**
 * Template Name: Redirect Legacy
 */

$post_name = $post->post_name;
$query_string = $_SERVER['QUERY_STRING'] ?? '';

if ($post_name === 'steuererklaerung-beauftragen-fa-landing') {
    wp_redirect("/steuererklaerungen/?p_id=4231&{$query_string}");
}
