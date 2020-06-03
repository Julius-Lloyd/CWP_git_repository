<?php

add_filter('plugin_action_links_' . WPT_Product_Table::getPath('PLUGIN_BASE_FILE'), 'wptf_add_action_links');

/**
 * For showing configure or add new link on plugin page
 * It was actually an individual file, now combine at 4.1.1
 * @param type $links
 * @return type
 */
function wptf_add_action_links($links) {
    $wptf_links[] = '<a href="' . admin_url( 'post-new.php?post_type=wpt_product_table' ) . '" title="' . esc_attr__( 'Add new Shortcode', 'wptf_pro' ) . '">' . esc_html__( 'Create Table', 'wptf_pro' ).'</a>';
    $wptf_links[] = '<a href="' . admin_url( 'edit.php?post_type=wpt_product_table&page=woo-product-table-config' ) . '" title="' . esc_attr__( 'Configure for Universal', 'wptf_pro' ) . '">' . esc_html__( 'Configure', 'wptf_pro' ) . '</a>';
    $wptf_links[] = '<a href="https://codeastrology.com/support/" title="' . esc_attr__( 'CodeAstrology Support', 'wptf_pro' ) . '" target="_blank">'.esc_html__( 'Support','wptf_pro' ).'</a>';
    return array_merge( $wptf_links, $links );
}


/**
 * Set Menu for WPT (Woo Product Table) Plugin
 * It was actually an individual file, now combine  at 4.1.1
 * 
 * @since 1.0
 * 
 * @package Woo Product Table
 */
function wptf_admin_menu() {
    add_submenu_page( 'edit.php?post_type=wpt_product_table', esc_html__( 'Configuration WPTpro', 'wptf_pro' ),  esc_html__( 'Configure', 'wptf_pro' ), 'edit_theme_options', 'woo-product-table-config', 'wptf_configuration_page' );
    add_submenu_page( 'edit.php?post_type=wpt_product_table', esc_html__( 'FAQ & Support page - Contact With US', 'wptf_pro' ), sprintf( esc_html__( 'FAQ %s& Contact%s', 'wptf_pro' ), '<span style="color:#ff8921;">', '</span>'), 'edit_theme_options', 'wptf_fac_contact_page', 'wptf_fac_support_page' );
    add_submenu_page('edit.php?post_type=wpt_product_table', 'Get Pro - WPT Product Table', 'Get <strong>Pro</strong>', 'edit_theme_options', 'https://codecanyon.net/item/woo-product-table-pro/20676867');
    
}
add_action( 'admin_menu', 'wptf_admin_menu' );