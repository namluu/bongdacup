<?php get_header() ?>
<?php global $sTemplateURL; ?>
    <div id="main">
        <div class="container">
            <div class="row">
                <aside class="col-md-2-4 col-sm-3">
                    <?php get_sidebar(); ?>
                </aside>
                <div class="col-md-9-6 col-sm-9">
                    <section class="wr-article">
                        <?php the_breadcrumb() ?>
                        <?php if ( have_posts() ) :
                            while ( have_posts() ) : the_post();?>
                                <ul class="entry-meta clearfix">
                                    <li class="date">
                                        <i class="fa fa-calendar"></i>
                                        <time datetime="<?php the_time('G:i, j/n/Y') ?>"><?php the_time('G:i, j/n/Y') ?></time>
                                    </li>
                                    <!--<li class="author"><i class="fa fa-user"></i> <?php the_author() ?></li>-->
                                    <!--<li class="views"><i class="fa fa-eye"></i> 12,503 Views</li>-->
                                    <li class="comments">
                                        <i class="fa fa-comment"></i>
                                        <a href="<?php comments_link(); ?>"> <?php comments_number( 'no comment', '1 comment', '% comments' ) ?></a>
                                    </li>
                                    <li class="pull-right">
                                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                        <div class="addthis_sharing_toolbox"></div>
                                    </li>
                                </ul>
                                <article class="article">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                $thumUrl = reset(wp_get_attachment_image_src(get_post_thumbnail_id(),'large'));
                                            } else {
                                                $thumUrl = $sTemplateURL.'/images/no-image-box.png';
                                            }
                                            ?>
                                            <img class="media-object img-responsive" src="<?php echo $thumUrl ?>" alt="<?php the_title() ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <h1><?php the_title(); ?></h1>
                                            <br>
                                            <p class="text-muted">Công ty Tân Phát Đạt chuyên thi công lắp đặt cửa nhôm giá rẻ chuyên nghiệp uy tín nhất tại TPHCM.</p>
                                            <p class="text-muted">Liên hệ để được báo giá, tư vấn lắp đặt miễn phí. <strong>0988 345 321</strong></p>
                                        </div>
                                    </div>
                                    <h3 class="title-other"><span>Nội dung:</span></h3>
                                    <div class="content-detail">
                                        <?php the_content(); ?>
                                    </div>
                                </article>
                                <?php if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif; ?>
                            <?php endwhile;
                        endif; ?>
                    </section>
                </div>
            </div>
        </div>
    </div>
<?php get_footer() ?>