<?php
wp_enqueue_script('inview-script', get_stylesheet_directory_uri() . '/js/inview.js');
wp_enqueue_script('livesearch-script', get_stylesheet_directory_uri() . '/js/livesearch.js');

get_header();
?>
<main class="main-content">
    <?php
    $the_query = new WP_Query(['s' => get_search_query()]);
    $search_results_count = $the_query->found_posts;
    $search_result_text = 'Suchergebnis';

    if ($search_results_count !== 1) {
        $search_result_text .= 'se';
    }
    ?>
    <h2><?= $search_results_count ?> <?= $search_result_text ?> für: <strong><?= get_query_var('s') ?></strong></h2>
    <div class="search-results">
    <?php if ($the_query->have_posts()): ?>
        <?php while ($the_query->have_posts()):
            $the_query->the_post(); ?>
                <div class="search-result">
                    <a class="h3" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php the_excerpt(); ?>
                </div>
            <?php
        endwhile;endif; ?>
    </div>
</main>
<?php get_footer();
