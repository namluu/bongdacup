<?php get_header(); ?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="td-ss-main-content">
                    <?php
                    if (have_posts()) {
                        while ( have_posts() ) : the_post();
                            ?>
                            <div class="td-page-header">
                                <h1 class="entry-title td-page-title">
                                    <span><?php the_title() ?></span>
                                </h1>
                            </div>
                            <div class="td-page-content">
                                <input type="hidden" name="gameId" value="<?php echo $_GET['game'] ?>">
                                <ul class="eventsListUl viewUl list-unstyled" id="videoBlock" data-list="2">
                                    <li class="clear">
                                        <div class="nameCon">
                                            <div class="sport" id="sport"></div>
                                            <a href="#" class="name" id="teamVS"></a>
                                            <div class="liga" id="liga"></div>
                                        </div>
                                        <div class="videoCon">
                                            <div id="video-player"></div>
                                            <iframe src="http://tipswin365.com/videoPlay.php?id=156137841" height="462" frameborder="0" scrolling="no" style="width: 100%;z-index:9999 !important"></iframe>
                                        </div>
                                        <div class="moreCon">
                                        <div class="moreBlock">
                                            <span class="name" id="streamId"></span>
                                        </div>

                                    </li>
                                </ul>

                            <?php
                                the_content();
                        endwhile;//end loop

                    }
                    ?>
                    </div>
                    <?php comments_template('', true); ?>
                </div>
            </div>
            <aside class="col-md-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</div>

<?php get_footer() ?>