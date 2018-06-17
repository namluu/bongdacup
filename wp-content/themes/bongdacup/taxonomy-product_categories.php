<?php get_header(); ?>
<?php global $sTemplateURL; ?>
    <div id="main">
        <div class="container">
            <div class="row">
                <aside class="col-md-2-4 col-sm-3">
                    <?php get_sidebar(); ?>
                </aside>
                <div class="col-md-9-6 col-sm-9">
                    <section class="wr-article">
                        <section class="group-category">
                            <div class="row">
                                <?php
                                the_breadcrumb();
                                $current = get_queried_object();
                                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                                $args = array(
                                    'product_categories' => $current->slug,
                                    'post_type' => 'products',
                                    'post_status' => 'publish',
                                    'paged' => $paged
                                );
                                $products = new WP_Query($args);
                                $i = 0;
                                while ($products->have_posts()): $products->the_post();
                                    if (has_post_thumbnail()) {
                                        $thumUrl = reset(wp_get_attachment_image_src(get_post_thumbnail_id(),'thumb-home'));
                                    } else {
                                        $thumUrl = $sTemplateURL.'/images/no-image-box.png';
                                    }
                                    ?>
                                    <div class="product-item col-md-4 col-sm-4">
                                        <div class="item-img">
                                            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                                                <img class="media-object img-responsive" src="<?php echo $thumUrl ?>" alt="<?php the_title() ?>">
                                            </a>
                                        </div>
                                        <div class="item-name"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
                                    </div>
                                    <?php
                                    $i++;
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </section>

                        <?php the_posts_pagination( array(
                            'prev_text' => '<span class="screen-reader-text">' . __( 'Trang trước' ) . '</span>',
                            'next_text' => '<span class="screen-reader-text">' . __( 'Trang sau' ) . '</span>',
                            'before_page_number' => '',
                        ) ); ?>
                    </section>
                </div>
            </div>
        </div>
    </div>
<?php get_footer() ?>