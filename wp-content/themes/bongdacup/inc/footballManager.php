<?php if (function_exists('getFootballManager')) :?>
<ul id="" class="eventsListUl" data-list="1">
    <?php $matches = getFootballManager() ?>
    <?php foreach ($matches as $match): ?>
        <?php
        $leagueUrl = esc_url( home_url( '/giai/'.$match->league_url ) );
        $matchUrl = esc_url( home_url( '/tran-dau/'.$match->url ) );
        $homeUrl = esc_url( home_url( '/cau-lac-bo/'.$match->home_url ) );
        $awayUrl = esc_url( home_url( '/cau-lac-bo/'.$match->away_url ) );
        $defaultUrl = esc_url( FM_PLUGIN_URL . '/images/default.png' );

        $time = strtotime($match->match_date);
        $curtime = current_time('timestamp');
        $diff = $curtime - $time;
        $showLive = $diff > 0 && $diff < 7200 ? true : false;
        $showPass = $diff > 7200 ? true : false;
        ?>
        <li>
            <div class="leaguelogo column">
                <a href="<?php echo $matchUrl ?>" title="<?php echo $match->league_name ?>">
                    <img src="<?php echo $match->league_img?:$defaultUrl ?>" height="50" class="img-responsive">
                </a>
            </div>
            <div class="matchtime column">
                <p><?php echo date('H:i', strtotime($match->match_date)) ?></p>
                <p><strong><?php echo date('d/m', strtotime($match->match_date)) ?></strong></p>
            </div>
            <div class="homelogo column">
                <a href="<?php echo $matchUrl ?>" title="<?php echo $match->home_name ?>">
                    <img src="<?php echo $match->home_img ? $match->home_img : $defaultUrl ?>" height="50" class="img-responsive">
                </a>
            </div>
            <div class="matchtitle column">
                <h2><a href="<?php echo $matchUrl ?>"><?php echo $match->name ?></a></h2>
                <?php if ($showLive): ?>
                    <img src="images/live.gif">
                <?php endif ?>
                <?php if ($showPass): ?>
                    <img src="images/dislive.png">
                <?php endif ?>
            </div>
            <div class="awaylogo column">
                <a href="<?php echo $matchUrl ?>" title="<?php echo $match->away_name ?>">
                    <img src="<?php echo $match->away_img ? $match->away_img : $defaultUrl ?>" height="50" class="img-responsive">
                </a>
            </div>
            <div class="livelink column">
                <a href="<?php echo $matchUrl ?>" class="btn btn-primary">Trực tiếp</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>