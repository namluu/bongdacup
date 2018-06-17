<?php get_header(); ?>
<div id="main">
    <div class="container">
        <div class="row">
            <aside class="col-md-2-4 col-sm-3">
                <?php get_sidebar(); ?>
            </aside>
            <div class="col-md-9-6 col-sm-9">
                <section class="latest">
                    <?php if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part('content', 'latest');
                    endwhile; ?>
                    <?php else: ?>
                    Không tìm thấy kết quả tìm kiếm
                    <?php endif; ?>
                    <?php /*
                    $empty = false;
                    if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                        $title = get_the_title();
                        $content = get_the_content();

                        $keys= explode(" ",trim($s));
                        $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title);
                        
                        $content = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $content);

                        if ( $s && strpos($title, implode('|', $keys)) ) {
                            echo '<p><a href="'.get_permalink().'">' . $title. '</a><p>';
                        } 
                        elseif ( $s && $pos = strpos($content, implode('|', $keys)) ) {
                            echo '<p><a href="'.get_permalink().'">' . $title . '</a><p>';
                            //echo '<small>...' . mb_substr($content, $pos - 50, $pos - 30, 'UTF-8') . '...</small>';
                        }
                        else {
                            $empty = true;
                        }
                        //get_template_part('content', 'latest');
                    endwhile; ?>
                    <?php endif; ?>
                    <?php if ($empty): ?>
                    Không tìm thấy từ khóa <?php echo $s; ?>
                    <?php endif;*/ ?>
                </section>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>