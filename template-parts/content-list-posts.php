<article id="post-<?php the_ID(); ?>" <?php post_class([
    'list-article',
    'clearfix',
]); ?>>
    <div class="list-article-thumb">
        <a href="<?php echo esc_url(get_permalink()); ?>">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('large');
            } else {
                echo '<img alt="" src="' .
                    get_template_directory_uri() .
                    '/assets/images/placholder2.png">';
            } ?>
        </a>
    </div>
    <div class="list-article-content">
        <div class="list-article-categories">
            <?php echo get_the_category_list(' / '); ?>
        </div>
        <a class="list-article-link" href="<?php echo esc_url(
            get_permalink()
        ); ?>">
            <h3><?php the_title(); ?></h3>
        </a>
        <p><span class="posted-on"><i class="icon-calendar"></i> <?= get_the_date() ?></span></p>
        <?php the_excerpt(); ?>
    </div>
</article>