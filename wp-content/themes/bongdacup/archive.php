<?php get_header(); ?>
<?php global $sTemplateURL; ?>
    <div id="main">
        <div class="container">
            <div class="row"><div class="col-md-12"><?php get_template_part('slideshow') ?></div></div>
            <div class="row">
                <aside class="col-md-2-4 col-sm-3">
                    <?php get_sidebar(); ?>
                </aside>
                <div class="col-md-9-6 col-sm-9"></div>
            </div>
        </div>
    </div>
<?php get_footer() ?>