<?php

/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 */

if (post_password_required()) {
    return;
}

add_filter('comment_excerpt_length', function () {
    return 40;
});

$comment_form_args = [
    // 'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">Deine E-Mail-Adresse wird nicht veröffentlicht.</span></p>',
    'comment_notes_before' => '',

    'comment_field' => '
        <div class="field-wrapper w-full block comment-form-comment">
            <textarea class="field w-full resize-y" id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder=" "></textarea>
            <span class="field-icon"></span>
            <label>Kommentar *</label>
        </div>',

    'fields' => [
        'autor' => '<div class="field-wrapper w-full block comment-form-author">
                <input class="field w-full" id="author" name="author" type="text" value="" size="30" maxlength="245" required="required" placeholder=" " />
                <span class="field-icon"></span>
                <label>Name *</label>
            </div>',

        'email' => '
            <p class="comment-notes"><span id="email-notes">Deine E-Mail-Adresse wird nicht veröffentlicht.</span></p>
            <div class="field-wrapper w-full block comment-form-email">
                <input class="field w-full" id="email" name="email" type="email" value="" size="30" maxlength="100" aria-describedby="email-notes" required="required" placeholder=" " />
                <span class="field-icon"></span>
                <label>E-Mail *</label>
            </div>',
    ],

    'class_submit' => 'btn btn-primary',
];

if (isset($_GET['replytocom'])) {
    $comment_form_args['cancel_reply_before'] = ' - (';
    $comment_form_args['cancel_reply_after'] = ')';
}
?>

<div id="comments" class="comments-area">

<?php if (have_comments()): ?>
    <h3 class="comments-title">
        <?php printf(_n('%1$s Kommentar', '%1$s Kommentare', get_comments_number()), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>'); ?>
    </h3>

    <div class="comment-list flex flex-col gap-4">
        <?php
        // $comment_template = function($comment, $is_child = false) {

        // }

        $comments_args = [
            'order' => 'DESC',
            'hierarchical' => 'threaded',
            'post_id' => get_the_ID(), // TODO: comment this line if this array is used in the function get_approved_comments
            'status' => 'approve',
        ];

        if (is_user_logged_in()) {
            $comments_args['include_unapproved'] = [get_current_user_id()];
        } else {
            $unapproved_email = wp_get_unapproved_comment_author_email();

            if ($unapproved_email) {
                $comments_args['include_unapproved'] = [$unapproved_email];
            }
        }

        // $comments = get_approved_comments(get_the_ID(), $comments_args);
        $comments = get_comments($comments_args);

        foreach ($comments as $comment):

            $comment_status = wp_get_comment_status(get_comment_ID());
            $is_comment_unapproved = $comment_status !== 'approved';

            $_interval = date_diff(date_create(wp_date('Y-m-d H:i:s')), date_create($comment->comment_date));
            $_comment_date = $comment->comment_date_gmt;

            $comment_children = get_approved_comments(get_the_ID(), ['parent' => get_comment_ID()]);
            $has_comment_children = count($comment_children) > 0;
            $has_excerpt = get_comment_excerpt() !== get_comment_text();

            $comment_date = date_i18n('j. F Y', strtotime($_comment_date), false);
            $comment_time = date_i18n('H:i', strtotime($_comment_date), false);
            $comment_time_diff = human_time_diff(strtotime($_comment_date));
            $comment_date_text = $_interval->d <= 0 ? "vor $comment_time_diff veröffentlicht" : "Veröffentlicht am $comment_date um $comment_time Uhr";

            $comment_reply_args = [
                'depth' => 1,
                'max_depth' => 2,
                'reply_text' => 'Antworten',
            ];
            ?>
            <?php if ($has_excerpt): ?><input class="read-more-checkbox" type="checkbox" id="read-more-<?php comment_ID(); ?>"><?php endif; ?>
            <div class="comment p-4 br-2 read-more-wrapper" id="comment-<?php comment_ID(); ?>">
                <div class="flex flex-row gap-3">
                    <?php echo get_avatar(get_comment(), 60, null, get_comment_author() . ' Avatar', ['class' => 'comment-avatar br-round']); ?>
                    <div>
                        <div class="comment-meta pb-2">
                            <div class="comment-author">
                                <strong><?php comment_author(); ?></strong>
                            </div>
                            <span class="comment-date text-grey text-sm"><?php echo $comment_date_text; ?></span>
                            <?php edit_comment_link('(Bearbeiten)', '<span class="ps-1 text-sm">', '</span>'); ?>
                        </div>
                        <div class="comment-content">
                            <?php if ($has_excerpt): ?>
                                <div class="comment-excerpt read-more-excerpt"><?php comment_excerpt(); ?> <label class="read-more" for="read-more-<?php comment_ID(); ?>">weiterlesen</label></div>
                                <div class="comment-text read-more-text"><?php echo wpautop(get_comment_text()); ?></div>
                            <?php else: ?>
                                <?php echo wpautop(get_comment_text()); ?>
                            <?php endif; ?>
                        </div>
                        <div class="comment-reply pt-2"><?php comment_reply_link($comment_reply_args); ?></div>
                        <?php if ($is_comment_unapproved): ?>
                        <div class="comment-unapproved-note pt-2">
                            <em><?php echo __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.'); ?></em>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($has_comment_children): ?>
                    <div class="comment-children">
                    <?php foreach ($comment_children as $comment): ?>
                        <?php
                        $_interval = date_diff(date_create(wp_date('Y-m-d H:i:s')), date_create($comment->comment_date))->d;
                        $_comment_date = $comment->comment_date;
                        $has_excerpt = get_comment_excerpt() !== get_comment_text();

                        $comment_date = date_i18n('j. F Y', strtotime($_comment_date), false);
                        $comment_time = date_i18n('H:i', strtotime($_comment_date), false);
                        $comment_time_diff = human_time_diff(strtotime($_comment_date));
                        $comment_date_text = $_interval <= 0 ? "vor $comment_time_diff veröffentlicht" : "Veröffentlicht am $comment_date um $comment_time Uhr";
                        ?>
                        <?php if ($has_excerpt): ?><input class="read-more-checkbox" type="checkbox" id="read-more-<?php comment_ID(); ?>"><?php endif; ?>
                        <div class="comment-child flex flex-row gap-3 pt-4 read-more-wrapper">
                            <?php echo get_avatar(get_comment(), 60, null, get_comment_author() . ' Avatar', ['class' => 'comment-avatar br-round']); ?>
                            <div>
                                <div class="comment-meta pb-2">
                                    <div class="comment-author">
                                        <strong><?php comment_author(); ?></strong>
                                    </div>
                                    <span class="comment-date text-grey text-sm"><?php echo $comment_date_text; ?></span>
                                    <?php edit_comment_link('(Bearbeiten)', '<span class="ps-1 text-sm">', '</span>'); ?>
                                </div>
                                <div class="comment-content">
                                    <?php if ($has_excerpt): ?>
                                        <div class="comment-excerpt read-more-excerpt"><?php comment_excerpt(); ?> <label class="read-more" for="read-more-<?php comment_ID(); ?>">weiterlesen</label></div>
                                        <div class="comment-text read-more-text"><?php echo wpautop(get_comment_text()); ?></div>
                                    <?php else: ?>
                                        <?php echo wpautop(get_comment_text()); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php
        endforeach;
        ?>
    </div>
<?php endif; ?>

<?php comment_form($comment_form_args); ?>
</div>