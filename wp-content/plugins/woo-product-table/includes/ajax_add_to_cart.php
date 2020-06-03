<?php

/**
 * Loading paginate lins for product table
 * for ajax
 * 
 * @return String it will render paginate link
 */
function wptf_ajax_paginate_links_load(){
    $targetTableArgs = ( isset( $_POST['targetTableArgs'] ) ? $_POST['targetTableArgs'] : false );
    $temp_number = ( isset( $_POST['temp_number'] ) ? $_POST['temp_number'] : false );
    $directkey = ( isset( $_POST['directkey'] ) ? $_POST['directkey'] : false );
    $texonomies = ( isset( $_POST['texonomies'] ) ? $_POST['texonomies'] : false );
    //$custom_field = ( isset( $_POST['custom_field'] ) ? $_POST['custom_field'] : false );
    $pageNumber = ( isset( $_POST['pageNumber'] ) && $_POST['pageNumber'] > 0 ? $_POST['pageNumber'] : 1 );
    $load_type = ( isset( $_POST['load_type'] ) && $_POST['load_type'] == 'current_page' ? true : false );
    
    $args = $targetTableArgs['args'];
    ###global $wpdb;
    ###var_dump($wpdb['last_query']);
    ###echo '<pre>';
    ###print_r($wpdb['last_query']);
    ###echo '</pre>';
    if( !$load_type ){
        if( isset( $directkey['s'] ) ){
            $args['s'] = $directkey['s'];
        }
        $args['orderby'] = ( isset( $directkey['orderby'] ) ? $directkey['orderby'] : false );
        $args['order'] = ( isset( $directkey['order'] ) ? $directkey['order'] : false );
        /**
         * Texonomy Handle
         */
        /*
        //unset($args['tax_query']);
        if( is_array( $texonomies ) && count( $texonomies ) > 0 ){
            foreach( $texonomies as $texonomie_key => $texonomie ){
                if(is_array( $texonomie ) && count( $texonomie ) > 0 ){
                    $args['tax_query'][] = array(
                        'taxonomy' => $texonomie_key,
                        'field' => 'id',
                        'terms' => $texonomie,
                        'operator' => 'IN'
                    );
                }
            }
        }
        $args['tax_query']['relation'] = 'AND';
        
        */
        
        /*
          //unset($args['meta_query']);
        if( is_array( $custom_field ) && count( $custom_field ) > 0 ){
            foreach( $custom_field as $custom_field_key => $custom_field_value ){
                if(is_array( $texonomie ) && count( $texonomie ) > 0 ){
                    $args['meta_query'][] = array(
                        'key' => $custom_field_key,
                        'value' => $custom_field_value,
                    );
                }
            }
            $args['meta_query']['relation'] ='AND';
        }
        */
    }
    
    /**
     * Page Number Hander
     */
    $args['paged']   = $pageNumber;
    $table_column_keywords  = $targetTableArgs['wptf_table_column_keywords'];
    $sort                       = $args['order'];
    $wptf_permitted_td           = $targetTableArgs['wptf_permitted_td'];
    $add_to_cart_text           = $targetTableArgs['wptf_add_to_cart_text'];
    
    $texonomy_key               = isset( $targetTableArgs['texonomy_key'] ) ? $targetTableArgs['texonomy_key'] : false;
    $customfield_key            = isset( $targetTableArgs['customfield_key'] ) && is_array( $targetTableArgs['customfield_key'] ) ? $targetTableArgs['customfield_key'] : false;
    $filter_keywords            = $targetTableArgs['filter_key'];
    $filter_box                 = $targetTableArgs['filter_box'];
    $description_type           = $targetTableArgs['description_type'];
    $ajax_action                = $targetTableArgs['ajax_action'];
    $description_on                = $targetTableArgs['description_on'];
    
    
    $table_row_generator_array = array(
        'args'                      => $args,
        'wptf_table_column_keywords' => $table_column_keywords,
        'wptf_product_short'         => $sort,
        'wptf_permitted_td'          => $wptf_permitted_td,
        'wptf_add_to_cart_text'      => $add_to_cart_text,
        'temp_number'               => $temp_number,
        'texonomy_key'              => $texonomy_key,
        'customfield_key'           => $customfield_key,
        'filter_key'                => $filter_keywords,
        'filter_box'                => $filter_box,
        'description_type'          => $description_type,
        'ajax_action'               => $ajax_action,
        'description_on'            => $description_on,
    );
    echo '<mypagi myjson="'. esc_attr( wp_json_encode( $table_row_generator_array ) ) .'">'. wpt_paginate_links( $args ) . '</mypagi>';
    die();
}
add_action( 'wp_ajax_wptf_ajax_paginate_links_load', 'wptf_ajax_paginate_links_load' );
add_action( 'wp_ajax_nopriv_wptf_ajax_paginate_links_load', 'wptf_ajax_paginate_links_load' );

/**
 * Table Load by ajax Query before on Tables Top
 * 
 * @since 1.9
 */
function wptf_ajax_table_row_load(){
    
    $targetTableArgs = ( isset( $_POST['targetTableArgs'] ) ? $_POST['targetTableArgs'] : false );
    $temp_number = ( isset( $_POST['temp_number'] ) ? $_POST['temp_number'] : false );
    $directkey = ( isset( $_POST['directkey'] ) ? $_POST['directkey'] : false );
    $texonomies = ( isset( $_POST['texonomies'] ) ? $_POST['texonomies'] : false );
    $custom_field = ( isset( $_POST['custom_field'] ) ? $_POST['custom_field'] : false );
    $pageNumber = ( isset( $_POST['pageNumber'] ) && $_POST['pageNumber'] > 0 ? $_POST['pageNumber'] : 1 );
    $load_type = ( isset( $_POST['load_type'] ) && $_POST['load_type'] == 'current_page' ? true : false );
    
    
    $args = $targetTableArgs['args'];
    
    
    if( !$load_type ){
        if( isset( $directkey['s'] ) ){
            $args['s'] = $directkey['s'];
        }
        $args['orderby'] = ( isset( $directkey['orderby'] ) ? $directkey['orderby'] : false );
        $args['order'] = ( isset( $directkey['order'] ) ? $directkey['order'] : false );
        //$args['custom_field'] = ( isset( $directkey['custom_field'] ) ? $directkey['custom_field'] : false );
        /**
         * Texonomy Handle
         */
        //unset($args['tax_query']);
        /*
        if( is_array( $texonomies ) && count( $texonomies ) > 0 ){
            foreach( $texonomies as $texonomie_key => $texonomie ){
                if(is_array( $texonomie ) && count( $texonomie ) > 0 ){
                    $args['tax_query'][] = array(
                        'taxonomy' => $texonomie_key,
                        'field' => 'id',
                        'terms' => $texonomie,
                        'operator' => 'IN'
                    );
                }
            }
        }
        */
        //$args['tax_query']['relation'] = 'AND';
        
        
        /*
          //unset($args['meta_query']);
        if( is_array( $custom_field ) && count( $custom_field ) > 0 ){
            foreach( $custom_field as $custom_field_key => $custom_field_value ){
                if(is_array( $custom_field ) && count( $custom_field ) > 0 ){
                    $args['meta_query'][] = array(
                        'key' => $custom_field_key,
                        'value' => $custom_field_value,
                    );
                }
            }
            $args['meta_query']['relation'] ='AND';
        }
        */
        
        
    }
    /**
     * Page Number Hander
     */
   
    $args['paged']   = $pageNumber;
    $table_column_keywords  = $targetTableArgs['wptf_table_column_keywords'];
    $sort                       = $args['order'];
    $wptf_permitted_td           = $targetTableArgs['wptf_permitted_td'];
    $add_to_cart_text           = $targetTableArgs['wptf_add_to_cart_text'];
    $texonomy_key               = $targetTableArgs['texonomy_key'];
    $customfield_key            = $targetTableArgs['customfield_key'];
    $filter_keywords            = $targetTableArgs['filter_key'];
    $filter_box                 = $targetTableArgs['filter_box'];
    $description_type           = $targetTableArgs['description_type'];
    $ajax_action                = $targetTableArgs['ajax_action'];
    $description_on                = $targetTableArgs['description_on'];
    
    $table_row_generator_array = array(
        'args'                      => $args,
        'wptf_table_column_keywords' => $table_column_keywords,
        'wptf_product_short'         => $sort,
        'wptf_permitted_td'          => $wptf_permitted_td,
        'wptf_add_to_cart_text'      => $add_to_cart_text,
        'temp_number'               => $temp_number,
        'texonomy_key'              => $texonomy_key,
        'customfield_key'           => $customfield_key,
        'filter_key'                => $filter_keywords,
        'filter_box'                => $filter_box,
        'description_type'          => $description_type,
        'ajax_action'               => $ajax_action,
        'description_on'            => $description_on,
    );
    
    echo wptf_table_row_generator( $table_row_generator_array );
     
    die();
}
add_action( 'wp_ajax_wptf_query_table_load_by_args', 'wptf_ajax_table_row_load' );
add_action( 'wp_ajax_nopriv_wptf_query_table_load_by_args', 'wptf_ajax_table_row_load' );

/**
 * Adding Item by Ajax. This Function is not for using to any others whee.
 * But we will use this function for Ajax
 * 
 * @since 1.0.4
 * @date 28.04.2018 (D.M.Y)
 * @updated 04.05.2018
 */
function wptf_ajax_add_to_cart() {
    
    $product_id     = ( isset($_POST['product_id']) && !empty( $_POST['product_id']) ? $_POST['product_id'] : false );
    $quantity       = ( isset($_POST['quantity']) && !empty( $_POST['quantity']) && is_numeric($_POST['quantity']) ? $_POST['quantity'] : 1 );
    $variation_id   = ( isset($_POST['variation_id']) && !empty( $_POST['variation_id']) ? $_POST['variation_id'] : false );
    $variation      = ( isset($_POST['variation']) && !empty( $_POST['variation']) ? $_POST['variation'] : false );
    $custom_message = ( isset($_POST['custom_message']) && !empty( $_POST['custom_message']) ? $_POST['custom_message'] : false );
    
    $string_for_var = '_var' . implode('_', $variation) . '_';
    
    $cart_item_data = false; //Set default value false, if found Custom message, than it will generate true
    
    if( $custom_message ){
        $custom_message = htmlspecialchars( $custom_message ); //$custom_message is Generating for tag and charecter
    
        /**
         * Custom Message for Product Adding
         * 
         * @since 1.9
         */
        $cart_item_data[ 'wptf_custom_message' ] = $custom_message;
            // below statement make sure every add to cart action as unique line item
        $cart_item_data['unique_key'] = md5( $product_id . $string_for_var . '_' .$custom_message );
    }
    
    wptf_adding_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data );
   
    die();
}

add_action( 'wp_ajax_wptf_ajax_add_to_cart', 'wptf_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_wptf_ajax_add_to_cart', 'wptf_ajax_add_to_cart' );

/**
 * Getting refresh for fragments
 * 
 * @Since 3.7
 */
function wptf_fragment_refresh(){
    WC_AJAX::get_refreshed_fragments();
    die();
}
add_action( 'wp_ajax_wptf_fragment_refresh', 'wptf_fragment_refresh' );
add_action( 'wp_ajax_nopriv_wptf_fragment_refresh', 'wptf_fragment_refresh' );

/**
 * Getting Image URL and with info for variation images
 * 
 * @Since 3.7
 */
function wptf_variation_image_load(){
    $variation_id = isset( $_POST['variation_id'] ) ? $_POST['variation_id'] : false;
    if( $variation_id ){
        $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $variation_id ), 'full', false );   
        echo $img_src[0] . ' ' . $img_src[1];
    }

    die();
}
add_action( 'wp_ajax_wptf_variation_image_load', 'wptf_variation_image_load' );
add_action( 'wp_ajax_nopriv_wptf_variation_image_load', 'wptf_variation_image_load' );


/**
 * To use in Action Hook for Ajax
 * for Multiple product adding to cart by One click
 * 
 * @since 1.0.4
 * @version 1.0.4
 * @date 3.5.2018
 * return Void
 */
function wptf_ajax_multiple_add_to_cart() {
    $products = false;
    if ( isset( $_POST['products'] ) && is_array( $_POST['products'] ) ) {
        $products = $_POST['products'];
    }
    wptf_adding_to_cart_multiple_items( $products );
    
    die();
}

add_action( 'wp_ajax_wptf_ajax_mulitple_add_to_cart', 'wptf_ajax_multiple_add_to_cart' );
add_action( 'wp_ajax_nopriv_wptf_ajax_mulitple_add_to_cart', 'wptf_ajax_multiple_add_to_cart' );

/**
 * Adding Item to cart by Using WooCommerce WC() Static Object
 * WC()->cart->add_to_cart(); Need few Perameters
 * Normally we tried to Check Each/All Action, When Adding
 * 
 * @param Int $product_id
 * @param Int $quantity
 * @param Int $variation_id
 * @param Array $variation
 * @return Void
 */
function wptf_adding_to_cart( $product_id = 0, $quantity = 1, $variation_id = 0, $variation = array(), $cart_item_data = array() ){
    
    $validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variation, $cart_item_data );     
    if( $validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data ) ){
        $config_value = get_option( 'wptf_configure_options' );
        if( $config_value['popup_notice'] == '1' ){
            wc_add_notice( '"' . get_the_title( $product_id ) . '" ' . $config_value['add2cart_all_added_text']);
        }
        return true;
    }
    return;
}

/**
 * Getting notice by ajax, Control this function from custom.js file
 * 
 * @since 3.8
 * @return type data
 */
function wptf_print_notice(){
    wc_print_notices();
    die();
}
add_action('wp_ajax_wptf_print_notice', 'wptf_print_notice');
add_action('wp_ajax_nopriv_wptf_print_notice', 'wptf_print_notice');

/**
 * Adding Multiple product to Cart by One click. So we used an Array
 * Array's each Item has indivisual Array with product_id,variation_id,quantity,variations's array
 * 
 * @param Array $products Product's Array which will use for adding to cart
 * @return Void
 */
function wptf_adding_to_cart_multiple_items( $products = false ){
    if ( $products && is_array( $products ) ){
        $serial = 0;
        foreach ( $products as $product ) {
            $product_id = ( isset($product['product_id']) && !empty( $product['product_id'] ) ? $product['product_id'] : false );
            $quantity = ( isset($product['quantity']) && !empty( $product['quantity'] ) && is_numeric( $product['quantity'] ) ? $product['quantity'] : 1 );
            $variation_id = ( isset($product['variation_id']) && !empty( $product['variation_id'] ) ? $product['variation_id'] : false );
            $variation = ( isset($product['variation']) && !empty( $product['variation'] ) ? $product['variation'] : false );
            
            //Added at @Since 1.9
            $custom_message = ( isset($product['custom_message']) && !empty( $product['custom_message'] ) ? $product['custom_message'] : false );
            
            //Added at 2.1
            $string_for_var = '_var' . implode( '_', $variation ) . '_';

            //Added at @Since 1.9
            $cart_item_data = false; //Set default value false, if found Custom message, than it will generate true

            if( $custom_message ){
                $custom_message = htmlspecialchars( $custom_message ); //$custom_message is Generating for tag and charecter

                /**
                 * Custom Message for Product Adding
                 * 
                 * @since 1.9
                 */
                $cart_item_data[ 'wptf_custom_message' ] = $custom_message;
                    // below statement make sure every add to cart action as unique line item
                $cart_item_data['unique_key'] = md5( $product_id . $string_for_var . '_' .$custom_message );
            }
            wptf_adding_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data );
            $serial++;
        }
        if( $serial > 0 ){
            return false;
        }
    }
}

/**
 * Adding Custom Mesage Field in Single Product Page
 * By Default: Disable, if you need, you can active it by enable action under this function
 * 
 * @since 1.9
 * @date 7.6.2018 d.m.y
 */
function wptf_add_custom_message_field() {
    echo '<table class="variations" cellspacing="0">
          <tbody>
              <tr>
              <td class="label"><label for="custom_message">'.esc_html__( 'Short Message', 'wptf_pro' ).'</label></td>
              <td class="value">
                  <input id="custom_message" type="text" name="wptf_custom_message" placeholder="'.esc_attr__( 'Short Message for Order', 'wptf_pro' ).'" />                      
              </td>
          </tr>                               
          </tbody>
      </table>';
}

/**
 * To set Validation, I mean: Required.
 * By Default: Disable, if you need, you can active it by enable action under this function
 * 
 * @since 1.9
 * @return boolean
 */
function wptf_custom_message_validation() { 
    if ( empty( $_REQUEST['wptf_custom_message'] ) ) {
        wc_add_notice( __( 'Please enter Short Message', 'wptf_pro' ), 'error' );
        return false;
    }
    return true;
}


/**
 * Saving Custom Message Data here
 * 
 * @param type $cart_item_data
 * @param type $product_id
 * @return string
 */
function wptf_save_custom_message_field( $cart_item_data, $product_id ) {
    if( isset( $_REQUEST['wptf_custom_message'] ) ) {
        $generated_message = htmlspecialchars( $_REQUEST['wptf_custom_message']);
        $cart_item_data[ 'wptf_custom_message' ] =  $generated_message;
        /* below statement make sure every add to cart action as unique line item */
        $cart_item_data['unique_key'] = $product_id . '_' . $generated_message;//md5( microtime().rand() );
    }
    return $cart_item_data;
}
add_action( 'woocommerce_add_cart_item_data', 'wptf_save_custom_message_field', 10, 2 );

/**
 * For Displaying custom Message in WooCommerce Cart
 * Need Woo 2.4.2 or updates
 * 
 * @param type $cart_data
 * @param type $cart_item
 * @return Array
 */
function wptf_render_meta_on_cart_and_checkout( $cart_data, $cart_item = null ) {
    $custom_items = array();
    /* Woo 2.4.2 updates */
    if( !empty( $cart_data ) ) {
        $custom_items = $cart_data;
    }
    if( isset( $cart_item['wptf_custom_message'] ) ) {
        $custom_items[] = array( "name" => __( 'Message', 'wptf_pro' ), "value" => $cart_item['wptf_custom_message'] );
    }
    return $custom_items;
}
add_filter( 'woocommerce_get_item_data', 'wptf_render_meta_on_cart_and_checkout', 10, 2 );

/**
 * Adding Customer Message to Order
 * 
 * @param type $item_id Session ID of Item's
 * @param type $values Value's Array of Customer message
 * @param type $cart_item_key
 * 
 * @since 1.9 6.6.2018 d.m.y
 * @return Void This Function will add Customer Custom Message to Order
 */
function wptf_order_meta_handler( $item_id, $values, $cart_item_key ) {
    if( isset( $values['wptf_custom_message'] ) ) {
        wc_add_order_item_meta( $item_id, __( 'Message', 'wptf_pro' ), $values['wptf_custom_message'] );
    }
}
add_action( 'woocommerce_new_order_item', 'wptf_order_meta_handler', 1, 3 );