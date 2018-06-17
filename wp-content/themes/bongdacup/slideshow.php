<?php
if (function_exists( 'getTkSlideshow' )) :
    $slides = getTkSlideshow(); ?>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="5000">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php foreach($slides as $num => $slide): ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $num ?>" class="<?php if ($num == 0) echo 'active' ?>"></li>
            <?php endforeach; ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php foreach($slides as $num => $slide): ?>
                <div class="item <?php if ($num == 0) echo 'active' ?>">
                    <a href="<?php echo $slide->link_url ? $slide->link_url : '#' ?>">
                        <img src="<?php echo $slide->link_image ?>" class="img-responsive">
                    </a>
                    <?php echo stripslashes($slide->description) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php endif; ?>
