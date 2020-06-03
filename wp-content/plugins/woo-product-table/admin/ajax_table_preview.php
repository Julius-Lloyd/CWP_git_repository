<?php
/**
 * This file is Activated now
 * Will ad in Future. 
 * Just keeping information, I have kept this file
 * 
 * @since 1.0.0
 * @updated 1.0.4 Currently Inactive this file.
 */

/**
 * Function for Live Table Update for Configure page
 * 
 * @since 1.0.0
 * @deprecated since 1.0.4 1.0.4_12_5.5.2018
 */

function wptf_live_table_setting(){
    if( isset( $_POST['action'] ) == 'wptf_table_preview' ){
        $atts = $_POST['info'];
        echo wptf_shortcode_generator( $atts );
    }else{
        echo '<p style="color: #d00;">' . esc_html( 'Critical Error', 'wptf_pro' ) . '</p>';
    }
    die();
}

