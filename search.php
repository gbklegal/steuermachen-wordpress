<?php get_header(); ?>
<main class="main-content">
    <?php
        $the_query = new WP_Query(['s' => get_search_query()]);
        if ($the_query->have_posts()):
            _e('<h2>Suchergebnisse für: <strong>'.get_query_var('s').'</strong></h2>');
        ?>
        <div class="search-results">
        <?php 
            while ($the_query->have_posts()):
                $the_query->the_post();
            ?>
                <div class="search-result">
                    <a href="<?php the_permalink(); ?>">
                        <h3><?php the_title(); ?></h3>
                    </a>
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