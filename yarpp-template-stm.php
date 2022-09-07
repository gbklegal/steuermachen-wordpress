<?php
/*
YARPP Template: STM
Description: This template returns posts in a row with thumbnail and title.
Author: Tobias Röder
*/


/* Pick Thumbnail */
// global $_wp_additional_image_sizes;
// if ( isset( $_wp_additional_image_sizes['yarpp-thumbnail'] ) ) {
//     $dimensions['size'] = 'yarpp-thumbnail';
// } else {
    $dimensions['size'] = 'large'; // default
// }
?>

<hr>

<h3>Ähnliche Beiträge</h3>
<?php if ( have_posts() ) : ?>
<div class="recommended-posts-wrapper" data-rss>
    <div class="recommended-posts-inner" data-rss-inner>
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="recommended-post">
                    <a href="<?php the_permalink(); ?>" rel="bookmark norewrite" title="<?php the_title_attribute(); ?>">
                        <div class="recommended-post-thumbnail">
                            <?php the_post_thumbnail( $dimensions['size'], array( 'data-pin-nopin' => 'true' ) ); ?>
                        </div>
                        <span><?php the_title(); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <button data-rss-left>
        <i class="icon-chevron-left"></i>
        <div class="button-overlay"></div>
    </button>
    <button data-rss-right>
        <i class="icon-chevron-right"></i>
        <div class="button-overlay"></div>
    </button>
</div>

<?php else : ?>
<p>No related photos.</p>
<?php endif; ?>
