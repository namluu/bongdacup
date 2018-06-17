<?php get_header(); ?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php the_breadcrumb() ?>
                <section class="latest">
                    <div class="composs-panel-title"> <strong><?php single_cat_title( '', true ); ?></strong></div>
                    <?php echo category_description(); ?>
                    <?php if ( have_posts() ) : $count = 0; ?>
                        <div class="row">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php if ($count && $count % 3 == 0) echo '</div><div class="row">'; ?>
                            <div class="col-md-4">
                                <?php get_template_part('content', 'grid'); ?>
                            </div>
                        <?php $count++; 
                            endwhile; ?>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
            <aside class="col-md-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</div>
<?php get_footer() ?>