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
                <ul class="entry-meta clearfix">
                    <li class="date"> 
                        <i class="fa fa-calendar"></i>
                        <time datetime="<?php the_time('G:i, j/n/Y') ?>"><?php the_time('G:i, j/n/Y') ?></time>
                    </li>
                    <li class="author"><i class="fa fa-user"></i> <?php the_author() ?></li>
                    <!--<li class="views"><i class="fa fa-eye"></i> 12,503 Views</li>-->
                    <li class="comments">
                        <i class="fa fa-comment"></i>
                        <a href="<?php comments_link(); ?>"> <?php comments_number( 'no comment', '1 comment', '% comments' ) ?></a>
                    </li>
                    <li class="pull-right">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_sharing_toolbox"></div>
                    </li>
                </ul>
                <article class="article"><?php the_content(); ?></article>
                <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="http://tructiepbonghd.com" data-numposts="5" data-width="100%"></div>
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