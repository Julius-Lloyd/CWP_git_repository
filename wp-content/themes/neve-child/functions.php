<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! function_exists( 'neve_child_load_css' ) ):
	/**
	 * Load CSS file.
	 */
	function neve_child_load_css() {
		wp_enqueue_style( 'neve-child-style', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'neve-style' ), NEVE_VERSION );
	}
endif;
add_action( 'wp_enqueue_scripts', 'neve_child_load_css', 20 );

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
add_filter('jpeg_quality', function($arg){return 100;});


remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action('wptf_table_disable_product_link', 5);

/*Javascript enque*/

function my_custom_scripts() {
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );



		add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields)
 {
 
 $fields['billing']['billing_company']['placeholder'] = 'Firma Navn';
 $fields['billing']['billing_company']['label'] = 'Firma Navn';
 $fields['billing']['billing_first_name']['placeholder'] = 'Fornavn'; 
 $fields['billing']['billing_first_name']['label'] = 'Fornavn'; 
 $fields['billing']['billing_last_name']['label'] = 'Efternavn'; 
 $fields['billing']['billing_address_1']['label'] = 'Adresse'; 
 $fields['billing']['billing_address_2']['label'] = 'Adresse'; 
 $fields['billing']['billing_address_2']['placeholder'] = 'Etage, dør'; 
 $fields['billing']['billing_postcode']['label'] = 'Post nummer ';
 $fields['billing']['billing_last_name']['placeholder'] = 'Efternavn';
 $fields['billing']['billing_email']['placeholder'] = 'Email Adresse ';
 $fields['billing']['billing_phone']['label'] = 'Telefon ';
 $fields['billing']['billing_phone']['placeholder'] = 'Telefon ';
 $fields['billing']['billing_city']['label'] = 'By ';
 
 return $fields;
 }
 function wc_remove_checkout_fields( $fields ) {

    unset( $fields['billing']['billing_country'] );
 

    return $fields;
}
add_filter('gettext', 'change_checkout_btn');
add_filter('ngettext', 'change_checkout_btn');

//function 
function change_checkout_btn($checkout_btn){
  $checkout_btn= str_ireplace('Checkout', 'Kassen', $checkout_btn);
  return $checkout_btn;
}


?>
