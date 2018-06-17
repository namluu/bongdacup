<?php
/** Category->Product type */
add_action( 'init', 'xd_register_product_categories_type_taxonomy' );
function xd_register_product_categories_type_taxonomy() {
    register_taxonomy(
        'product_categories',
        'products', array(
            'hierarchical' => true,
            'labels' => array(
                'name' => __('Categories (Products)'),
                'menu_name' => __('Categories'),
                'all_items' => __('Categories'),
                'singular_name' => __('Category'),
                'add_new' => __('Add New Category'),
                'add_new_item' => __('Add New Category'),
                'edit_item' => __('Edit Category'),
                'new_item' => __('New Category'),
                'view_item' => __('View Category'),
                'search_items' => __('Search Category'),
                'not_found' => __('No categories found'),
                'not_found_in_trash' => __('No categories found in Trash'),
                'parent_item_colon' => ''
            ),
            'query_var' => true,
            'rewrite' => array('slug' => 'danh-muc', 'with_front' => false)
        )
    );
}
add_action( 'init', 'xd_register_products_type' );
function xd_register_products_type() {
    register_post_type( 'products', array(
        'labels' => array(
            'name' => __('Products'),
            'menu_name' => __('Products'),
            'all_items' => __('Products'),
            'singular_name' => __('Product'),
            'add_new' => __('Add New Product'),
            'add_new_item' => __('Add New Product'),
            'edit_item' => __('Edit Product'),
            'new_item' => __('New Product'),
            'view_item' => __('View Product'),
            'search_items' => __('Search Product'),
            'not_found' => __('No products found'),
            'not_found_in_trash' => __('No products found in Trash'),
            'parent_item_colon' => ''
        ),
        'public' => true,
        'has_archive' => 'san-pham',
        //'has_archive' => true,
        'taxonomies' => array('product_categories'),
        'menu_icon' => 'dashicons-clipboard',
        'menu_position' => 2,
        'supports' => array('title','editor','thumbnail'),
        'rewrite' => array( 'slug' => 'san-pham/%product_categories%', 'with_front' => false ),
    ));
}

/** custom custom post type link = category/post */
function wpa_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'products' ){
        $terms = wp_get_object_terms( $post->ID, 'product_categories' );
        if( $terms ){
            return str_replace( '%product_categories%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wpa_show_permalinks', 1, 2 );

/** support category filter on product list */
add_action('restrict_manage_posts','my_restrict_manage_posts');
function my_restrict_manage_posts() {
    global $typenow;
    if ($typenow=='products'){
        $args = array(
            'show_option_all' => 'Show All Categories',
            'taxonomy'        => 'product_categories',
            'name'            => 'product_categories',
            'selected'        => $_GET['product_categories'],
            'show_count'      => true,
            'hide_empty'      => true
        );
        wp_dropdown_categories($args);
    }
}
add_action( 'request', 'my_request' );
function my_request($request) {
    global $pagenow;
    if ($pagenow=='edit.php' && is_admin() && isset($request['post_type']) && $request['post_type']=='products') {
        $request['product_categories'] = get_term($request['product_categories'],'product_categories')->slug;
    }
    return $request;
}
/** support category column on product list */
add_action('manage_products_posts_columns', 'add_categories_column_to_products_list');
function add_categories_column_to_products_list( $posts_columns ) {
    $posts_columns['cat'] = 'Categories';
    return $posts_columns;
}
add_action('manage_posts_custom_column', 'show_categories_column_for_products_list',10,2);
function show_categories_column_for_products_list( $column_name,$post_id ) {
    global $typenow;
    if ($typenow=='products') {
        $taxonomy = 'product_categories';
        switch ($column_name) {
            case 'cat':
                $categories = get_the_terms($post_id,$taxonomy);
                if (is_array($categories)) {
                    foreach($categories as $key => $category) {
                        $edit_link = get_term_link($category,$taxonomy);
                        $categories[$key] = '<a href="'.$edit_link.'">' . $category->name . '</a>';
                    }
                    //echo implode("<br/>",$categories);
                    echo implode(' | ',$categories);
                }
                break;
        }
    }
}