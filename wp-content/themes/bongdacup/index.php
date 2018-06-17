<?php get_header(); ?>
<?php global $sTemplateURL; ?>
        <div class="row">
            <div class="col-md-8">
                <div class="box-title"><a href="<?php echo get_site_url().'/binh-luan/' ?>">Bình luận</a></div>

                <?php get_sidebar('swiperslider'); ?>

                <div class="content-box2 mr-t-13">
                    <div class="box-title">Trận cầu tiêu điểm</div>
                    <section class="box-content mr-t-13 s-active list-scroll match-style">
                        <?php include_once 'inc/footballManager.php' ?>
                    </section>
                </div>

                <div class="content-box2 mr-t-13">
                    <div class="box-title"><a href="<?php echo get_site_url().'/truc-tiep/' ?>">Đang chiếu trực tiếp</a></div>
                    <section class="box-content mr-t-13 s-active list-scroll">
                        <input type="hidden" name="typeAllow" value="1">
                        <ul id="listEvents" class="eventsListUl" data-list="1">
                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                            <span class="sr-only">Loading...</span>
                        </ul>
                    </section>
                </div>

                <hr>

                <div>
                    <?php dynamic_sidebar('dynamic_bodybanner4') ?>
                </div>
                
                <div class="content-box2 mr-t-13">
                    <div class="box-title"><a href="<?php echo get_site_url().'/category/video-clip/' ?>">Video xem lại</a></div>
                    <div class="box-content mr-t-13">
                        <ul class="clearfix list-unstyled video-clip-style">
                            <?php echo getPostInCategory('video-clip', 9, 'thumb-home') ?>
                        </ul>
                    </div>
                </div>

                <?php $page = get_page_by_path( 'gioi-thieu-home' ); ?>
                <?php if ($page && $page->post_status == 'publish'): ?>
                <div class="wr-sec">
                    <div class="top-descript">
                        <div class="shape-title"><?php echo $page->post_title ?></div>
                    </div>
                    <section class="s-active">
                        <ul id="" class="eventsListUl" data-list="1">
                            <li class="text-left">
                                <?php $postwithbreaks = wpautop( $page->post_content, true );echo $postwithbreaks ?>
                            </li>
                        </ul>
                    </section>
                </div>
                <?php endif; ?>

                <div class=""></div>
            </div>
            <aside class="col-md-4">
                <?php get_sidebar(); ?>
                <?php get_sidebar('chatbox'); ?>
                <?php get_sidebar('news'); ?>

<iframe src="http://www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/tructiepbonghdcom&amp;width=300&amp;height=250&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:250px;" allowTransparency="true">
</iframe>

            </aside>
        </div>
    </div>
</div>
<?php get_footer() ?>