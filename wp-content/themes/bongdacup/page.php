<?php get_header() ?>
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <section class="wr-article">
                <?php the_breadcrumb() ?>
                <?php if ( have_posts() ) :
                    while ( have_posts() ) : the_post();?>
                <h1><?php the_title(); ?></h1>
                <article class="article"><?php the_content(); ?></article>
                <?php endwhile;
                endif; ?>
                </section>
            </div>
            <aside class="col-md-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</div>
<?php get_footer() ?>