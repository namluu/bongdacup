<?php
if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h4 class="comments-title">
        <?php
            printf( _n( '%d phản hồi', '%d phản hồi', get_comments_number() ),
                number_format_i18n( get_comments_number() ) );
        ?>
        </h4>
        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 56
                ) );
            ?>
        </ol><!-- .comment-list -->
    <?php endif; ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'twentyfifteen' ); ?></p>
    <?php endif; ?>

    <?php 
    $args = array(
        'title_reply'       => __( 'Gửi phản hồi' ),
        'title_reply_to'    => __( 'Trả lời %s' ),
        'cancel_reply_link' => __( 'Hủy trả lời' ),
        'label_submit'      => __( 'Gửi' )
    );
    comment_form($args); 
    ?>

</div>