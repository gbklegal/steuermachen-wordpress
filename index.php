<?php get_header(); ?>

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
        </main>
    <?php endif; ?>
</main>
<?php elseif (is_single()): ?>
<main class="main-content">
    <?php the_post(); ?>
    <?php get_template_part('/template-parts/content-single'); ?>
</main>
<?php elseif (is_page('steuerlexikon')): ?>
    <main class="main-content">
        <div id="hero">
            <h1>Steuerlexikon</h1>
            <p>Alles, was Sie über Steuern wissen müssen, findest Du in unserem Steuerlexikon.</p>
        </div>
    </main>
<?php endif; ?>

<?php get_footer(); ?>