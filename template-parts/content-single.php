<div class="post-wrapper single-post">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header id="hero" class="post-header">
            <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
            <?php if ( get_theme_mod( 'single_meta', 1 ) ): ?>
            <div class="post-meta">
                <p class="uppercase posted-on">Veröffentlicht am <?php echo get_the_date(); ?> von <?php echo get_the_author(); ?></p>
            </div>
            <?php endif; ?>
            <div class="post-categories">
                <?php echo get_the_category_list(); ?>
            </div>
        </header>
        <main class="post-content-wrapper">
            <div class="post-table-of-contents">
                <h3 class="text-center">Inhaltsverzeichnis</h3>
                <ul class="table-of-contents">
                    <?php echo tableOfContents(get_the_content()); ?>
                </ul>
            </div>
            <div class="post-content">
                <?php if (has_post_thumbnail()) the_post_thumbnail('post-thumbnail', ['class' => 'post-thumbnail']); ?>
                <?php the_content(); ?>
            </div>
        </main>
    </article>
</div>