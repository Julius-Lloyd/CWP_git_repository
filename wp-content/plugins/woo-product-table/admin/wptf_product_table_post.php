<?php

if ( ! function_exists('wptf_product_table_post') ) {

/**
 * Create Custom post type for Product Table. From now, we will store our shortcode or shortcode's value in this post as meta value
 * 
 * @since 4.1
 * @link https://codex.wordpress.org/Post_Types See details at WordPress.org about Custom Post Type
 */
function wptf_product_table_post() {
        $icon = WPT_Product_Table::getPath( 'BASE_URL' ) . 'images/table_icon.png';
	$labels = array(
		'name'                  => _x( 'Product Table', 'Product Table', 'wptf_pro' ),
		'singular_name'         => _x( 'PRODUCT TABLE', 'PRODUCT TABLE', 'wptf_pro' ),
		'menu_name'             => __( 'PRODUCT TABLE', 'wptf_pro' ),
		'name_admin_bar'        => __( 'Product Table', 'wptf_pro' ),
		'archives'              => __( 'Product Table Archives', 'wptf_pro' ),
		'attributes'            => __( 'Product Table Attributes', 'wptf_pro' ),
		'parent_item_colon'     => __( 'Parent Shortcode:', 'wptf_pro' ),
		'all_items'             => __( 'Product Table', 'wptf_pro' ),
		'add_new_item'          => __( 'Add New', 'wptf_pro' ),
		'add_new'               => __( 'Add New', 'wptf_pro' ),
		'new_item'              => __( 'New Product Table', 'wptf_pro' ),
		'edit_item'             => __( 'Edit Product Table', 'wptf_pro' ),
		'update_item'           => __( 'Update Product Table', 'wptf_pro' ),
		'view_item'             => __( 'View Product Table', 'wptf_pro' ),
		'view_items'            => __( 'View Product Tables', 'wptf_pro' ),
		'search_items'          => __( 'Search Product Table', 'wptf_pro' ),
		'not_found'             => __( 'Not found', 'wptf_pro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wptf_pro' ),
		'featured_image'        => __( 'Featured Image', 'wptf_pro' ),
		'set_featured_image'    => __( 'Set featured image', 'wptf_pro' ),
		'remove_featured_image' => __( 'Remove featured image', 'wptf_pro' ),
		'use_featured_image'    => __( 'Use as featured image', 'wptf_pro' ),
		'insert_into_item'      => __( 'Insert into Product Table', 'wptf_pro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Product Table', 'wptf_pro' ),
		'items_list'            => __( 'Product Table list', 'wptf_pro' ),
		'items_list_navigation' => __( 'Product Table list navigation', 'wptf_pro' ),
		'filter_items_list'     => __( 'Filter Product Table list', 'wptf_pro' ),
	);
	$args = array(
		'label'                 => __( 'PRODUCT TABLE', 'wptf_pro' ),
		'description'           => __( 'Generate your shortcode for Product Table.', 'wptf_pro' ),
		'labels'                => $labels,
		'supports'              => array('title'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 40,
                'menu_icon'             => $icon,//'dashicons-list-view',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
                'register_meta_box_cb'  => 'wptf_shortcode_metabox',
	);
	register_post_type( 'wpt_product_table', $args );

}
add_action( 'init', 'wptf_product_table_post', 0 );

}


//Showing shortcode in All Shortcode page
function wptf_shortcode_column_head($default){
    if ( 'wpt_product_table' == get_post_type() ){
    $default['wptf_shortcode'] = "Shortcode";
    }
    return $default;
}
add_filter('manage_posts_columns', 'wptf_shortcode_column_head');

function wptf_shortcode_column_content($column_name, $post_id){
    if ($column_name == 'wptf_shortcode') {
        $post_title = get_the_title( $post_id );
        $post_title = preg_replace( '/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/',"$1", $post_title );
        echo "<input style='display: inline-block;width:300px;' class='wptf_auto_select_n_copy' type='text' value=\"[Product_Table id='{$post_id}' name='{$post_title}']\" id='wptf_shotcode_content_{$post_id}' readonly>";
        echo '<a style="font-size: 12px !important;padding: 4px 13px !important" class="button button-primary wptf_copy_button_metabox" data-target_id="wptf_shotcode_content_' . $post_id . '">'. esc_html__( 'Copy','wptf_pro' ).'</a>';
        echo '<p style="color: green;font-weight:bold;display:none; padding-left: 12px;" class="wptf_shotcode_content_' . $post_id . '"></p>';
    }  
}
add_action('manage_posts_custom_column', 'wptf_shortcode_column_content', 2, 2);


//Permalink Hiding Option
add_filter( 'get_sample_permalink_html', 'wptf_permalink_hiding' );
function wptf_permalink_hiding( $return ) {
    if ( 'wpt_product_table' == get_post_type() ){
        $return = '';
    }
    return $return;
}


//Hiding Preview Button from all shortcode page
add_filter( 'page_row_actions', 'wptf_preview_button_hiding', 10, 2 );
add_filter( 'post_row_actions', 'wptf_preview_button_hiding', 10, 2 );
function wptf_preview_button_hiding( $actions, $post ) {

    if ( 'wpt_product_table' == get_post_type() ){
        unset( $actions['inline hide-if-no-js'] );
        unset( $actions['view'] );
    }
    return $actions;
}
