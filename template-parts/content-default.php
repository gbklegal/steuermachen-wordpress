<?php $_is_steuerlexikon =
    wp_get_post_parent_id() === STM_STEUERLEXIKON_PAGE_ID; ?>
<div class="post-wrapper<?= return_if(
    $_is_steuerlexikon,
    ' single-post steuerlexikon-post'
) ?>">
    <header id="hero" class="post-header hero-wrapper"><?php
// if (has_title_image()) echo ' hero-wrapper'
?>
        <div class="hero-text">
            <?php the_title('<h1 class="post-title">', '</h1>'); ?>
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
        <?php if ($_is_steuerlexikon): ?>
            <div class="post-sidebar">
                <?php the_post_sidebar_content(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>