<?php get_header(); ?>

<main class="main-content">

<?php if (is_home() || is_category() || is_author() || is_archive()): ?>

    <?php if (have_posts()): ?>
        <header>
            <?php if (is_category()): ?>
            <h2>Kategorie: <?php single_cat_title(); ?></h2>
            <?php elseif (is_archive()): ?>
            <h2><?php the_archive_title(); ?></h2>
            <?php else: ?>
            <h2>Neueste Beiträge</h2>
            <?php endif; ?>
        </header>
        <div class="posts-wrapper">
        <?php while (have_posts()): ?>
            <?php the_post(); ?>
            <?php get_template_part('/template-parts/content-list-posts'); ?>
        <?php endwhile; ?>
        </div>
        <?php the_posts_navigation(['prev_text' => 'Ältere Beiträge <i class="icon-chevrons-right"></i>', 'next_text' => '<i class="icon-chevrons-left"></i> Neuere Beiträge']); ?>

    <?php endif; ?>

<?php elseif (is_single()): ?>
    <?php the_post(); ?>
    <?php get_template_part('/template-parts/content-single'); ?>
<?php else: ?>

    <?php while (have_posts()): ?>
        <?php the_post(); ?>
        <?php get_template_part('/template-parts/content-default'); ?>
    <?php endwhile; ?>

<?php endif; ?>

</main>

<?php get_footer(); ?>
