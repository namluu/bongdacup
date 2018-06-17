<?php
function the_breadcrumb() {
    echo '<ol class="breadcrumb">';
    if (!is_home()) {
        echo wp_sprintf('<li><a href="%s"><span class="glyphicon glyphicon-home"></span></a></li>', get_option('home'));
        if (is_category()) {
            echo '<li>';
            $term = get_queried_object();
            if ($term->parent != 0) {
                echo '<a href="'.get_category_link($term->parent).'">';
                echo get_the_category_by_ID( $term->parent );
                echo '</a>';
                echo '</li><li>';
                echo $term->name;
            } else {
                echo $term->name;
            }
            echo '</li>';
        } elseif (is_single()) {
            //the_category(' </li><li> ', 'multiple');
            the_taxonomies(['template' => '% %l', 'before' => '<li>', 'after' => '</li>']);
            echo wp_sprintf('<li>%s</li>', get_the_title());
        } elseif (is_page()) {
            echo wp_sprintf('<li>%s</li>', get_the_title());
        } elseif (is_post_type_archive('products')) {
            echo '<li>Sản Phẩm</li>';;
        } else {
            if ($current = get_queried_object()) {
                echo wp_sprintf('<li>%s</li>', $current->name);
            }
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ol>';
}

function has_content_sidebar($id) {
    ob_start();
    dynamic_sidebar($id);
    $sidebar = ob_get_contents();
    ob_end_clean();

    return $sidebar === "" ? false : true;
}

/**
 * load list post by category show in home page
 */
function getPostInCategory($cateSlug, $num, $style) {
    global $sTemplateURL;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $num,
        'orderby' => 'ID',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $cateSlug
            )
        )
    );
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();
        if (has_post_thumbnail()) {
            $thumUrl = reset(wp_get_attachment_image_src(get_post_thumbnail_id(), $style));
        } else {
            switch ($style) {
                case 'thumb-small':
                    $thumUrl = $sTemplateURL.'/images/truc-tiep-bong-da-38x38.png';
                break;
                case 'thumb-home':
                    $thumUrl = $sTemplateURL.'/images/truc-tiep-bong-da-222x180.png';
                break;
            }
        }
        ?>
        <li>
            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                <img class="media-object img-responsive" src="<?php echo $thumUrl ?>" alt="<?php the_title() ?>">
                <span class="media-title"><?php the_title() ?></span>
            </a>
        </li>
        <?php
    endwhile;
    wp_reset_postdata();
}
