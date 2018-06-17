<?php get_header(); ?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php the_breadcrumb() ?>
                <section class="latest">
                    <div class="composs-panel-title"> <strong><?php single_cat_title( '', true ); ?></strong></div>
                    <?php echo category_description(); ?>
                    <?php if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part('content', 'latest');
                    endwhile; ?>
                    <?php endif; ?>
                </section>
                <?php the_posts_pagination( array(
                    'prev_text' => '<span class="screen-reader-text">' . __( 'Trang trước' ) . '</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Trang sau' ) . '</span>',
                    'before_page_number' => '',
                ) ); ?>
            </div>
            <aside class="col-md-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</div>
<?php get_footer() ?>