<?php
global $sTemplateURL;
if (has_post_thumbnail()) {
    $attachs = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumb-home');
    $thumUrl = reset($attachs);
} else {
    $thumUrl = $sTemplateURL.'/images/no-image-box.png';
}
?>
<article id="post-<?php the_ID(); ?>" class="">
    <a href="<?php the_permalink() ?>">
        <img class="img-responsive" src="<?php echo $thumUrl ?>" alt="<?php the_title() ?>">
    </a>

    <p class="media-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></p>
    <ul class="entry-meta clearfix">
        <li class="date"> 
            <i class="fa fa-calendar"></i>
            <time datetime="<?php the_time('G:i, j/n/Y') ?>"><?php the_time('G:i, j/n/Y') ?></time>
        </li>
    </ul>
</article>