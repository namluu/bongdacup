<?php get_header(); ?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <?php if ($match = getMatch()): ?>
                <strong><?php echo $match->league_name ?></strong>
                <h1 class="text-center"><strong><?php echo $match->name ?></strong></h1>
                <p class="text-center"><em><strong><?php echo date('H:i', strtotime($match->match_date)) ?>, <?php echo date('d/m/Y', strtotime($match->match_date)) ?></strong></em></p>
                <div><?php echo $match->description ?></div>
            <?php endif; ?>
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