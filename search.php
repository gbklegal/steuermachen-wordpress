<?php get_header(); ?>
<main class="main-content">
    <?php
        $the_query = new WP_Query(['s' => get_search_query()]);
        if ($the_query->have_posts()):
            _e('<h2>'.get_query_var('s').'</h2>');
            echo '<ul style="padding-left:20px">';
            while ($the_query->have_posts()):
                $the_query->the_post();
            ?>
                <li style="padding:5px 0">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php
            endwhile;
            echo '</ul>';
        endif;
    ?>
</main>
<?php get_footer();