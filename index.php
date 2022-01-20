<?php get_header(); ?>

<?php // var_dump(get_the_ID()); ?>
<?php // var_dump(have_posts()); ?>

<?php if (is_home()): ?>
<main class="main-content">
    <?php if (have_posts()): ?>
        <header>
            <h2>Neueste Beiträge</h2>
        </header>
        <div class="posts-wrapper">
        <?php while (have_posts()): ?>
            <?php the_post(); ?>
            <?php get_template_part('/template-parts/content-list-posts'); ?>
            <?php #the_posts_pagination(); ?>
        <?php endwhile; ?>
        </div>
    <?php endif; ?>
</main>
<?php elseif (is_single()): ?>
<main class="main-content">
    <?php the_post(); ?>
    <?php get_template_part('/template-parts/content-single'); ?>
</main>
<?php else: ?>
<main class="main-content prose">
    <?php while (have_posts()): ?>
        <?php the_post(); ?>
        <?php get_template_part('/template-parts/content-default'); ?>
    <?php endwhile; ?>
</main>
<?php endif; ?>

<?php get_footer(); ?>