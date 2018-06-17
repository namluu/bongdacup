<?php get_header(); ?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="td-ss-main-content">
                    <div class="wr-sec">
                        <div class="top-descript">
                            <div class="shape-title">Đang chiếu trực tiếp</div>
                        </div>
                        <section class="s-active">
                            <input type="hidden" name="typeAllow" value="1">
                            <ul id="listEvents" class="eventsListUl" data-list="1">
                                <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                <span class="sr-only">Loading...</span>
                            </ul>
                        </section>
                    </div>
                </div>
                <?php comments_template('', true); ?>

                <?php $page = get_page_by_path( 'gioi-thieu-truc-tiep' ); ?>
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
            </div>
            <aside class="col-md-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</div>

<?php get_footer() ?>