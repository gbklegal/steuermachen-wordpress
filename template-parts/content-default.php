<div class="post-wrapper">
    <header id="hero" class="post-header hero-wrapper"><?php // if (has_title_image()) echo ' hero-wrapper' ?>
        <div class="hero-text">
            <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
            <?php if (has_secondary_title()): ?>
                <div class="secondary-title"><?php the_secondary_title(); ?></div>
            <?php endif; ?>
        </div>
        <?php if (has_title_image()): ?>
            <div class="hero-image">
                <?php the_title_image(); ?>
            </div>
        <?php endif; ?>
    </header>
    <div class="post-content-wrapper">
        <div class="post-content">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php the_content(); ?>
            </article>
        </div>
    </div>
</div>