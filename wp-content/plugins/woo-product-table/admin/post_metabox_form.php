<div id="wptf_configuration_form" class="wptf_shortcode_gen_panel">
    <h3 style="margin: 0">
        <a target="_blank" href="https://wordpress.org/support/plugin/woo-product-table/#no-topic-0">Get Support</a> | 
        <a target="_blank" href="https://codeastrology.com/support/forums/forum/woo-product-table-pro-making-quick-order-table/">Forum</a> | 
        <a target="_blank" href="https://codecanyon.net/item/woo-product-table-pro/20676867">Get Pro</a>
        
    </h3>
    <!-- New Version's Warning. We will remove it from 5.00 | End -->
    <?php
    /**
     * Tab Maintenance. Table will be come from [tabs] folder based on $tab_array
     * this $tab_arry will define, how much tab and tab content
     */
    $tab_array = array(
        'column_settings'   => __( "Column", 'wptf_pro' ),
        'basics'            => __( 'Basics', 'wptf_pro' ),
        'table_style'       => __( 'Design', 'wptf_pro' ),
        'conditions'        => __( 'Conditions', 'wptf_pro' ),
        'search_n_filter'   => __( 'Search Box And Filter','wptf_pro' ),
        'pagination'        => __( 'Pagination', 'wptf_pro' ),
        'mobile'            => __( 'Mobile Issue', 'wptf_pro' ),
        'config'            => __( 'Configuration', 'wptf_pro' ),
    );

    echo '<nav class="nav-tab-wrapper">';
    $active_nav = 'nav-tab-active';
    foreach ($tab_array as $nav => $title) {
        echo "<a href='#{$nav}' data-tab='{$nav}' class='wptf_nav_for_{$nav} wptf_nav_tab nav-tab " . esc_attr( $active_nav ) . "'>" . esc_html__( $title ). "</a>";
        $active_nav = false;
    }
    echo '</nav>';


    //Now start for Tab Content
    $active_tab_content = 'tab-content-active';
    foreach ($tab_array as $tab => $title) {
        echo '<div class="wptf_tab_content tab-content ' . esc_attr( $active_tab_content ) . '" id="' . esc_attr( $tab ) . '">';
        echo '<div class="fieldwrap">';
        $tab_file_of_admin = WPT_FREE_BASE_DIR . 'admin/tabs/' . $tab . '.php';
        if ( is_file( $tab_file_of_admin ) ) {
            echo '<br>'; //Insert a break to each Tab's header
            include $tab_file_of_admin; //WPT_FREE_BASE_DIR . 'admin/tabs/' . $tab . '.php';
        } else {
            echo '<h2>' . $tab . '.php ' . esc_html__( 'file is not found in tabs folder','wptf_pro' ) . '</h2>';
        }
        echo '</div>'; //End of .fieldwrap
        echo '</div>'; //End of Tab content div
        $active_tab_content = false; //Active tab content only for First
    }
    ?>

</div>

<style>
/*****For Column Moveable Item*******/
ul#wptf_column_sortable li>span.handle{
    background-image: url('<?php echo WPT_FREE_BASE_URL . 'images/move.png'; ?>');
}
</style>
