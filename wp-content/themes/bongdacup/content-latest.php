<?php
global $sTemplateURL;
$thumUrl = $sTemplateURL.'/images/no-image-box.png';
if (has_post_thumbnail()) {
    $attachs = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumb-home');
    $thumUrl = $attachs ? reset($attachs) : $thumUrl;
}
?>
<article id="post-<?php the_ID(); ?>" class="article-post">
    <div class="media">
        <div class="media-left">
            <a href="<?php the_permalink() ?>">
                <img class="media-object" src="<?php echo $thumUrl ?>" alt="<?php the_title() ?>" width="200">
            </a>
            <div class="tag">
                <?php //the_tags('', ''); ?>
                <?php if( $tags = get_the_tags() ) {
                        foreach( $tags as $tag ) {
                            echo '<a href="' . get_term_link( $tag, $tag->taxonomy ) . '"><i class="fa fa-tag"></i> ' . $tag->name . '</a>';
                        }
                    } ?>
            </div>
        </div>
        <div class="media-body">
            <a href="<?php the_permalink() ?>" rel="bookmark"><h4 class="media-heading"><?php the_title() ?></h4></a>
            <ul class="entry-meta clearfix">
                <li class="date"> 
                    <i class="fa fa-calendar"></i>
                    <time datetime="<?php the_time('G:i, j/n/Y') ?>"><?php the_time('G:i, j/n/Y') ?></time>
                </li>
                <!--<li class="author"><i class="fa fa-user"></i> <?php the_author() ?></li>-->
                <li class="category">
                    <i class="fa fa-folder"></i> 
                    <?php the_category(' / ', 'multiple') ?>
                </li>
                <!--<li class="views"><i class="fa fa-eye"></i> 12,503 Views</li>-->
                <li class="comments">
                    <i class="fa fa-comment"></i>
                    <a href="<?php comments_link(); ?>"> <?php comments_number( 'no comment', '1 comment', '% comments' ) ?></a>
                </li>
                <li class="pull-right">
                    <div class="fb-like" data-href="<?php the_permalink() ?>" data-layout="button_count"></div>
                </li>
            </ul>
            <div class="media-desc"><?php the_excerpt() ?></div>
            <a href="<?php the_permalink() ?>" class="readmore" title="<?php the_title() ?>" rel="nofollow">Read More<span> <i class="fa fa-long-arrow-right"></i></span></a>
        </div>
    </div>
</article>