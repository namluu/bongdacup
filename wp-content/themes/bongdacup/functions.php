<?php
/**
 * Register menus
 */
add_action('init', function() {
    register_nav_menus(
        array(
            'top-menu' => 'Top Menu',
            'main-menu' => 'Main Menu',
            'left-menu' => 'Left Menu'
        )
    );
});


/*
 * Register feature image in post manager
 */
add_theme_support( 'post-thumbnails');

/*
 * Register a new image size, use in category page
 */
if (function_exists('add_image_size')) {
    add_image_size('thumb-home', 222, 180, false); //(no cropped)
    add_image_size('thumb-small', 44, 44, false); //(no cropped)
}

/**
 * Control excerpt length
 */
 add_filter('excerpt_length', function() {
    return 25;
 } );

/**
 * Change [...] string in excerpt
 */

 add_filter('excerpt_more', function() {
    return '...';
 } );



/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );

remove_action('wp_head','wp_generator');

function add_menuclass($ulclass) {
   return preg_replace('/<a /', '<a class="waves-effect waves-light"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');

function plural( $count, $text ) {
    return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}" ) );
}
function ago( $datetime ) {
    $current = new DateTime(date( 'Y-m-d H:i:s', current_time( 'timestamp' ) ));
    $interval = $current->diff( $datetime );
    $suffix = ( $interval->invert ? ' trước' : '' );
    if ( $v = $interval->y >= 1 ) return plural( $interval->y, 'năm' ) . $suffix;
    if ( $v = $interval->m >= 1 ) return plural( $interval->m, 'tháng' ) . $suffix;
    if ( $v = $interval->d >= 1 ) return plural( $interval->d, 'ngày' ) . $suffix;
    if ( $v = $interval->h >= 1 ) return plural( $interval->h, 'giờ' ) . $suffix;
    if ( $v = $interval->i >= 1 ) return plural( $interval->i, 'phút' ) . $suffix;
    return plural( $interval->s, 'giây' ) . $suffix;
}

function truncate($text, $length) {
   $length = abs((int)$length);
   if(strlen($text) > $length) {
      $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
   }
   return($text);
}

function bg_recent_comments($no_comments = 5, $comment_len = 100, $avatar_size = 40) {
    $comments_query = new WP_Comment_Query();
    $comments = $comments_query->query( array( 'number' => $no_comments, 'status' => 'approve' ) );
    $comm = '';
    if ( $comments ) :
        $comm .= '<ul class="list-unstyled list-comment">';
            foreach ( $comments as $comment ) :
                $link = '<a class="author" href="' . get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID . '">';
                $date = new DateTime($comment->comment_date);

                $content = apply_filters( 'get_comment_text', $comment->comment_content );

                $comm .= '<li>';
                $comm .= $link . get_avatar( $comment->comment_author_email, $avatar_size ) . '</a> ';
                $comm .= '<span class="main">';
                $comm .= $link . get_comment_author( $comment->comment_ID ) . ':</a> ';
                $comm .= '<span class="content">' . strip_tags( truncate($content, $comment_len) ) . '</span>';
                $comm .= '<br><span class="text-muted">' . ago($date) . '</span>';
                $comm .= '<br>' . $link . get_the_title($comment->comment_post_ID) . '</a> ';
                $comm .= '</span>';
                $comm .= '</li>';
            endforeach;
        $comm .= '</ul>';
    else :
        $comm .= 'No comments.';
    endif;
    echo $comm;
}

add_action('comment_post', 'comment');
function comment($comment_reply_id)
{
    $comment = get_comment($comment_reply_id);
    if($comment->comment_parent != 0)
    {
        $old_comment = get_comment($comment->comment_parent);
        if($old_comment->user_id == 0)
        {
            $email = $old_comment->comment_author_email;
            $name = $comment->comment_author;
            $content = truncate($comment->comment_content, 200);
            $post = get_post($comment->comment_post_ID);
            $title = $post->post_title;
            $link = get_permalink($comment->comment_post_ID);
            //$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
            $subject = sprintf('Bình luận đã được trả lời tại tructiepbonghd.com' );

            $message  = "<p>" . sprintf('Bình luận của bạn trong bài viết: %s', $title ) . "<p>";
            $message .= "<p>" . sprintf( 'Đã được trả lời bởi: %1$s ', $name ) . "</p>";
            $message .= 'Nội dung: ' . "<br>" . $content . "<br>";
            $message .= 'bạn có thể theo dõi tại: ' . "<br>";
            $message .= $link . "#comments";

            $headers = array();
            $headers[] = "MIME-Version: 1.0";
            $headers[] = 'Content-Type: text/html; charset=UTF-8';
            $headers[] = 'From: No Reply <no-reply@namluu.com>';
            $headers[] = "Subject: {$subject}";

            wp_mail( $email, $subject, $message, implode("\r\n", $headers) );
        }
    }
}

// remove Open Sans font
if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
    }
    add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
// Uncomment below to remove from admin
// add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;


show_admin_bar( false );
function remove_core_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

// remove the DNS
add_filter( 'emoji_svg_url', '__return_false' );
// REMOVE EMOJI ICONS
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// remove XML-RPC for security
add_filter('xmlrpc_enabled', '__return_false');
add_filter( 'wp_headers', 'disable_x_pingback' );
function disable_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}
remove_action('wp_head', 'rsd_link'); //removes EditURI/RSD (Really Simple Discovery) link.
remove_action('wp_head', 'wlwmanifest_link'); //removes wlwmanifest (Windows Live Writer) link.
remove_action('wp_head', 'wp_generator'); //removes meta name generator.
remove_action('wp_head', 'wp_shortlink_wp_head'); //removes shortlink.
remove_action('wp_head', 'feed_links', 2 ); //removes feed links.
remove_action('wp_head', 'feed_links_extra', 3 );  //removes comments feed.

add_filter( 'wp_sprintf_l', function() {
    return array(
        /* translators: used to join items in a list with more than 2 items */
        'between'          => sprintf( __('%s, %s'), '', '' ),
        /* translators: used to join last two items in a list with more than 2 times */
        'between_last_two' => sprintf( __('%s, và %s'), '', '' ),
        /* translators: used to join items in a list with only 2 items */
        'between_only_two' => sprintf( __('%s và %s'), '', '' ),
    );
} );

include_once( get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
include_once( get_template_directory() . '/inc/widgets.php' );
include_once( get_template_directory() . '/inc/helpers.php' );
//include_once( get_template_directory() . '/inc/customPostTypes.php' );

