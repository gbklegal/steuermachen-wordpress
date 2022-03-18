<?php get_header(); ?>
<main class="main-content">
    <?php
        $the_query = new WP_Query(['s' => get_search_query()]);
        $search_results_count = $the_query->found_posts;
        $search_result_text = 'Suchergebnis';

        if ($search_results_count < 1 || $search_results_count > 1)
            $search_result_text .= 'se';

        if ($the_query->have_posts()):
            _e("<h2>{$search_results_count} {$search_result_text} für: <strong>" . get_query_var('s') . "</strong></h2>");
        ?>
        <div class="search-results">
        <?php 
            while ($the_query->have_posts()):
                $the_query->the_post();
            ?>
                <div class="search-result">
                    <a class="h3" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php the_excerpt(); ?>
                </div>
            <?php
            endwhile;
        ?>
        </div>
        <?php
        endif;
    ?>
</main>
<?php get_footer();