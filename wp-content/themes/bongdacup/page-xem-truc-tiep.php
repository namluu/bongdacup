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
                            <div class="td-page-content page-truc-tiep">
                                <input type="hidden" name="gameId" value="<?php echo $_GET['game'] ?>">
                                
                                <ul class="eventsListUl viewUl list-unstyled" id="videoBlock" data-list="2">
                                    <li class="clear">
                                        <div class="nameCon">
                                            <h2 id="teamVS"></h2>
                                            <div class="liga" id="liga"></div>
                                        </div>
                                    </li>
                                </ul>
                                <iframe src="http://tipswin365.com/videoPlay.php?vid=<?php echo $_GET['game'] ?>" height="462" frameborder="0" scrolling="no" style="width: 100%;z-index:9999 !important">
                                </iframe>
                                <br>
                                <iframe src="http://www.nowgoal.com/asianbookie.htm" height="600" width="100%" frameborder="0"></iframe>
                                <br>
                                <h3><a href="https://1xbetvn.com/vi/statistic/game/<?php echo $_GET['simulation_id'] ?>/<?php echo $_GET['simulation_id'] ?>/1/1/-1" target="_blank">Thống kê trận đấu trực tiếp</a></h3>
                                <br>
                                <h3>Thống kê sau trận đấu</h3>
                                <object width="100%" height="450" id="playZonePlayer" type="application/x-shockwave-flash" data="http://vn.1xbet.com/getZone/Zone.swf"><param name="menu" value="false"><param name="wmode" value="opaque"><param name="allowFullScreen" value="true"><param name="AllowScriptAccess" value="always"><param name="scale" value="exactFit"><param name="flashvars" value="ZonePlayGameId=<?php echo $_GET['simulation_id'] ?>&amp;scaleMode=scaleAll&amp;videoID=<?php echo $_GET['simulation_id'] ?>&amp;gameId=<?php echo $_GET['simulation_id'] ?>&amp;lng=vi&amp;sport=1&amp;ref=1">
                                    <param name="lng" value="vi">
                                </object>
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
                <div data-spy="affix" data-offset-top="300" data-offset-bottom="200">
                    <?php get_sidebar('chatbox2'); ?>
                </div>
            </aside>
        </div>
    </div>
</div>
<style type="text/css">
.affix {
    top: 0;
}
.affix-bottom {
    position: absolute;
}
</style>
<?php get_footer() ?>