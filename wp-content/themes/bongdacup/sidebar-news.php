<?php global $sTemplateURL; ?>

<div class="content-box2 mr-t-13">
    <div class="box-title">Tin thể thao</div>
    <div class="s-active">
        <ul class="list-unstyled list-news">
        <?php
        $thumUrl = $sTemplateURL.'/images/no-image-box.png';
        $query = new WP_Query( array( 'category_name' => 'tin-the-thao', 'posts_per_page' => 7 ) );
        ?>
        <?php while ( $query->have_posts() ): 
            $query->the_post();
            if (has_post_thumbnail()) {
                $attachs = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumb-home');
                $thumUrl = $attachs ? reset($attachs) : $thumUrl;
            }
            ?>
            <li>
                <div class="media">
                    <div class="media-left">
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                            <img class="" src="<?php echo $thumUrl ?>" alt="<?php the_title() ?>" width="100">
                        </a>
                    </div>
                    <div class="media-body">
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
                        <?php 
                        $time = strtotime(get_the_date('y-m-d'));
                        $curtime = current_time('timestamp');
                        $diff = $curtime - $time;
                        if ($diff <= 96400) : // post in today is new
                        ?>
                            <img src="<?php echo get_site_url() ?>/images/red-3.gif' ?>">
                        <?php endif ?>
                    </div>
                </div>
            </li>
            <?php wp_reset_postdata();
        endwhile; ?>
        </ul>
    </div>
</div>