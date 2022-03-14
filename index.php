<?php __DIR__ . '/includes/utilities.php'; ?>
<?php get_header(); ?>

<?php // var_dump(get_the_ID()); ?>
<?php // var_dump(have_posts()); ?>

<?php if (is_home() || is_category()): ?>
<main class="main-content">
    <?php if (have_posts()): ?>
        <header>
            <?php if (is_category()): ?>
            <h2>Kategorie: <?php echo get_the_category()[0]->name; ?></h2>
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
        <?php the_posts_navigation(); ?>
    <?php endif; ?>
</main>
<?php elseif (is_single()): ?>
<main class="main-content">
    <?php the_post(); ?>
    <?php get_template_part('/template-parts/content-single'); ?>
</main>
<?php else: ?>
<main class="main-content">
    <?php while (have_posts()): ?>
        <?php the_post(); ?>
        <?php get_template_part('/template-parts/content-default'); ?>
    <?php endwhile; ?>
</main>
<?php endif; ?>

<?php get_footer(); ?>