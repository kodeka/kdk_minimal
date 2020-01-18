<?php
/**
 * @version    1.0.0
 * @package    KDK Minimal (theme)
 * @author     Kodeka - https://kodeka.io
 * @copyright  Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */

if (post_password_required()) {
    return;
}

$comments = get_comments(array(
    'post_id' => get_the_ID(),
    'status' => 'approve'
));

?>

<div id="comments" class="comments-area">
    <?php if (!empty($comments) && count($comments)): ?>
    <h2 class="comments-title">
        <?php
            $comment_count = (int) get_comments_number();
            if ($comment_count == 1) {
                printf(
                    /* translators: 1: title. */
                    esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'kdk_minimal' ),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'kdk_minimal' ) ),
                    number_format_i18n( $comment_count ),
                    '<span>' . get_the_title() . '</span>'
                );
            }
        ?>
    </h2>

    <?php the_comments_navigation(); ?>

    <ol class="comment-list">
        <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
            ), $comments);
        ?>
    </ol>

    <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()): ?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'kdk_minimal' ); ?></p>
    <?php
        endif;
    endif;
    ?>

    <?php comment_form(); ?>
</div>
