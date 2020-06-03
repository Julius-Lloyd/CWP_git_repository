<?php

/**
 * getting Config value. If get config value from post, then it will receive from post, Otherwise, will take data from Configuration value.
 * 
 * @param type $table_ID Mainly post ID of wptf_product_table. That means: its post id of product table
 * @return type Array
 */
function wptf_get_config_value( $table_ID ){
    $config_value = $temp_config_value = get_option( 'wptf_configure_options' );
    $config = get_post_meta( $table_ID, 'config', true );
    if( !empty( $config ) && is_array( $config ) ){
        $config_value = $config;
    }
    $config_value['footer_cart'] = $temp_config_value['footer_cart'];
    $config_value['footer_cart_size'] = $temp_config_value['footer_cart_size'];
    $config_value['footer_possition'] = $temp_config_value['footer_possition'];
    $config_value['footer_bg_color'] = $temp_config_value['footer_bg_color'];
    $config_value['thumbs_lightbox'] = $temp_config_value['thumbs_lightbox'];
    $config_value['disable_cat_tag_link'] = $temp_config_value['disable_cat_tag_link'];
    return $config_value;
}
// Hook into Woocommerce when adding a product to the cart

add_filter( 'woocommerce_add_to_cart_fragments', 'wptf_per_item_fragment', 999 , 1 );

if( !function_exists( 'wptf_per_item_fragment' ) ) {
	function wptf_per_item_fragment($fragments)
	{
		ob_start();
                $Cart = WC()->cart->cart_contents;
                $product_response = false;
                if( is_array( $Cart ) && count( $Cart ) > 0 ){
                    foreach($Cart as $perItem){
                        //var_dump($perItem);
                        $pr_id = (String) $perItem['product_id'];
                        $pr_value = (String) $perItem['quantity'];
                        $product_response[$pr_id] = (String)  (isset( $product_response[$pr_id] ) ? $product_response[$pr_id] + $pr_value : $pr_value);
                        //$fragments["span.wptf_ccount.wptf_ccount_$pr_id"] = "<span class='wptf_ccount wptf_ccount_$pr_id'>$pr_value</span>";
                    }
                }
                //$fragments["span.wptf_ccount"] = "";
                if( is_array( $product_response ) && count( $product_response ) > 0 ){
                    foreach( $product_response as $key=>$value ){
                        //var_dump($perItem);
                        $pr_id = (String) $key;
                        $pr_value = (String) $value;
                        $fragments["span.wptf_ccount.wptf_ccount_$pr_id"] = "<span class='wptf_ccount wptf_ccount_$pr_id'>$pr_value</span>";
                    }
                }
                $fragments['.wpt-footer-cart-wrapper>a'] = '<a href="' . wc_get_cart_url() . '">' . WC()->cart->get_cart_subtotal() . '</a>';
		echo wp_json_encode($product_response);
		
		$fragments["wptf_per_product"] = ob_get_clean();
                //WC_AJAX::get_refreshed_fragments();
		return $fragments;
	}
}

/**
 * Generate paginated links based on Args.
 * 
 * @param type $args Args of WP_Query's
 * @return type String
 */
function wptf_paginate_links( $args = false ){
    $html = false;
    if( $args ){
        $product_loop = new WP_Query($args);
        $big = 99999999;
        $paginate = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'mid_size'  =>  3,
            'prev_next' =>  false,
            'current' => max( 1, $args['paged'] ),
            'total' => $product_loop->max_num_pages
        ));
        $html .= $paginate; 
    }
    return $html;
}

/**
 * Generate full pagination based on Args.
 * 
 * @param type $args Args of WP_Query's
 * @return type String
 */
function wptf_pagination_by_args( $args = false, $temp_number = false ){
    $html = false;
    if( $args ){
        $html .= "<div class='wptf_table_pagination' data-temp_number='{$temp_number}'>";
        $paginate = wptf_paginate_links( $args );
        $html .= $paginate; 
        $html .= "</div>";
    }
    return $html;
}
/**
 * Generate Product's Attribute
 * 
 * @global type $product Default global product variable, it will only work inside loop
 * @param type $attributes Array
 * @return string 
 */
function wptf_additions_data_attribute( $attributes = false ){
    global $product;
    $html = false;
    if( $attributes && is_array( $attributes ) && count( $attributes ) > 0 ){
        foreach ( $attributes as $attribute ) :
        $html .= "<div class='wptf_each_attribute_wrapper'>";
            $html .= "<label>" . wc_attribute_label( $attribute->get_name() ) . "</label>";
            
            $values = array();

            if ( $attribute->is_taxonomy() ) {
                    $attribute_taxonomy = $attribute->get_taxonomy_object();
                    $attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

                    foreach ( $attribute_values as $attribute_value ) {
                            $value_name = esc_html( $attribute_value->name );

                            if ( $attribute_taxonomy->attribute_public ) {
                                    $values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
                            } else {
                                    $values[] = $value_name;
                            }
                    }
            } else {
                    $values = $attribute->get_options();

                    foreach ( $values as &$value ) {
                            $value = make_clickable( esc_html( $value ) );
                    }
            }

	$html .= apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
            
        $html .= '</div>';
        endforeach;
    }
    return $html;
}

/**
 * Checking Value for Select option tag
 * Used in shortcode.php file actually
 * 
 * @param type $got_value
 * @param type $this_value
 * @return type String
 */
function wptf_check_sortOrder( $got_value = false, $this_value = 'nothing' ){
    return $got_value == $this_value ? 'selected' : ''; 
}

/**
 * To get Final Columns List as Array, where will unavailable default disable_column
 * 
 * @return Array 
 */
function wptf_default_columns_array(){
    $column_array = WPT_Product_Table::$columns_array;
    /**
     * To this disable array, Only available keywords of Column Keyword Array
     * 
     */
    $disable_column_keyword = WPT_Product_Table::$colums_disable_array;
    foreach( $disable_column_keyword as $value ){
        unset( $column_array[$value] );
    }
    return $column_array;
}

/**
 * We used this function to get default keywords array from default columns array
 * 
 * @return Array Only Keys of Column Array
 * @since 3.6
 */
function wptf_default_columns_keys_array(){
    return array_keys( wptf_default_columns_array() );
}

/**
 * We used this function to get default values array from default columns array
 * 
 * @return Array Only values of Column Array
 * @since 3.6
 */
function wptf_default_columns_values_array(){
    return array_values( wptf_default_columns_array() );
}

/**
 * Taxonomy column generator
 * clue is: tax_
 * 
 * @param type $item_key
 * @return String
 */
function wptf_taxonomy_column_generator( $item_key ){
    $key = 'tax_';
    $len = strlen( $key );
    $check_key = substr( $item_key, 0, $len );
    if( $check_key == $key ){
        return $item_key;
    }
}

/**
 * Custom Fields column generator
 * clue is: cf_
 * 
 * @param type $item_key
 * @return String
 */
function wptf_customfileds_column_generator( $item_key ){
    $key = 'cf_';
    $len = strlen( $key );
    $check_key = substr( $item_key, 0, $len );
    if( $check_key == $key ){
        return $item_key;
    }
}

/**
 * Making new String/description based on word Limit.
 * 
 * @param String $string
 * @param Integer $word_limit
 * @return String
 */
function wptf_limit_words( $string = '', $word_limit = 10 ){
    $words = explode( " ",$string );
    
    $output = implode( " ",array_splice( $words,0,$word_limit ) );
    if( count( $words ) > $word_limit ){
       $output .= $output . '...'; 
    }
    return $output;
}

/**
 * Go generate as Array from 
 * 
 * @param Array $string Obviously should be an Array, Otherwise, it will generate false.
 * @param Array $default_array Actually if not fount a real String, and if we want to return and default value, than we can set here. 
 * @return Array This function will generate comman string to Array
 */
function wptf_explode_string_to_array( $string,$default_array = false ) {
    $final_array = false;
    if ( $string && is_string( $string ) ) {
        $string = rtrim( $string, ', ' );
        $final_array = explode( ',', $string );
    } else {
        if( is_array( $default_array ) ){
        $final_array = $default_array;
        }
    }
    return $final_array;
}

/**
 * Generate each row data for product table. This function will only use for once place.
 * I mean: in shortcode.php file normally.
 * But if anybody want to use any others where, you have to know about $table_column_keywords and $wptf_each_row
 * both should be Array, Although I didn't used condition for $wptf_each_row Array to this function. 
 * So used: based on your own risk.
 * 
 * @param Array $table_column_keywords
 * @param Array $wptf_each_row
 * @return String_Variable
 */
function wptf_generate_each_row_data($table_column_keywords = false, $wptf_each_row = false) {
    $final_row_data = false;
    if ( is_array( $table_column_keywords ) && count( $table_column_keywords ) > 0) {
        foreach ( $table_column_keywords as $each_keyword ) {
            $final_row_data .= ( isset( $wptf_each_row[$each_keyword] ) ? $wptf_each_row[$each_keyword] : false );
        }
    }
    return $final_row_data;
}

/**Generaed a Array for $wptf_permitted_td 
 * We will use this array to confirm display Table body's TD inside of Table
 * 
 * @since 1.0.4
 * @date 27/04/2018
 * @param Array $table_column_keywords
 * @return Array/False
 */
function wptf_define_permitted_td_array( $table_column_keywords = false ){
    
    $wptf_permitted_td = false;
    if( $table_column_keywords && is_array( $table_column_keywords ) && count( $table_column_keywords ) > 0 ){
        foreach( $table_column_keywords as $each_keyword ){
            $wptf_permitted_td[$each_keyword] = true;
        }
    }
    return $wptf_permitted_td;
}

/**
 * Generating <options>VAriation Atribute</option> for Product Variation
 * CAn be removed later.
 * 
 * @param type $current_single_attribute
 * @return string
 */
function wptf_array_to_option_atrribute( $current_single_attribute = false ){
    $html = '<option value>'.esc_html__( 'None', 'wptf_pro' ).'</option>';
    if( is_array( $current_single_attribute ) && count( $current_single_attribute ) ){
        foreach( $current_single_attribute as $wptf_pr_attributes ){
        $html .= "<option value='{$wptf_pr_attributes}'>" . ucwords( $wptf_pr_attributes ) . "</option>";
        }
    }
    return $html;
}

/**
 * For Variable product, Variation's attribute will generate to select tag
 * 
 * @param Array $attributes
 * @param Int $product_id
 * @param Int $temp_number
 * @return string HTML Select tag will generate from Attribute
 */
function wptf_variations_attribute_to_select( $attributes , $product_id = false, $default_attributes = false, $temp_number = false ){
    $html = false;
    $html .= "<div class='wptf_varition_section' data-product_id='{$product_id}'  data-temp_number='{$temp_number}'>";
    foreach( $attributes as $attribute_key_name=>$options ){

        $label = wc_attribute_label( $attribute_key_name );
        $attribute_name = wc_variation_attribute_name( $attribute_key_name );
        $only_attribute = str_replace( 'attribute_', '', $attribute_name);
        $default_value = !isset( $default_attributes[$only_attribute] ) ? false : $default_attributes[$only_attribute]; //Set in 3.9.0
        
        $html .= "<select data-product_id='{$product_id}' data-attribute_name='{$attribute_name}' placeholder='{$label}'>";
        $html .= "<option value='0'>" . $label . "</option>";
        foreach( $options as $option ){
            $html .= "<option value='" . esc_attr( $option ) . "' " . ( $default_value == $option ? 'selected' : '' ) . ">" . ucwords($option) . "</option>";
        }
        $html .= "</select>";
        
    }
    $html .= "<div class='wptf_message wptf_message_{$product_id}'></div>";
    $html .= '</div>';

    return $html;
}


/**
 * Getting unit amount with unint sign. Suppose: Kg, inc, cm etc
 * woocommerce has default wp_options for weight,height etc's unit.
 * Example: for weight, woocommerce_weight_unit
 * 
 * @param string $target_unit Such as: weight, height, lenght, width
 * @param int $value Can be any number. It also can be floating point number. Normally decimal
 * @return string If get unit and value is gater than o, than it will generate string, otheriwse false
 */
function wptf_get_value_with_woocommerce_unit( $target_unit, $value ){
    $get_unit = get_option( 'woocommerce_' . $target_unit . '_unit' );
    return ( is_numeric( $value ) && $value > 0 ? $value . ' ' . $get_unit : false );
}

/**
 * Adding wptf_'s class at body tag, when Table will show.
 * Only for frontEnd
 * 
 * @global type $post
 * @global type $shortCodeText
 * @param type $class
 * @return string
 */
function wptf_adding_body_class( $class ) {

    global $post,$shortCodeText;

    if( isset($post->post_content) && has_shortcode( $post->post_content, $shortCodeText ) ) {
        $class[] = 'wptf_pro_table_body';
        $class[] = 'wptf_pro_table';
        $class[] = 'woocommerce';
    }
    return $class;
}
add_filter( 'body_class', 'wptf_adding_body_class' );

/**
 * Displaying Notice to our plugin for rating issue
 * 
 * @return Notice displaying a notice void
 * @since 1.9
 */
function wptf_important_notice_for_users() {
    if(!class_exists('WOO_Product_Table')){
        if('wpt_product_table' == get_post_type()){
        ob_start();
    ?>
    <div class="notice notice-success is-dismissible">
        <a style="color: #FFEB3B;" href="https://codecanyon.net/item/woo-product-table-pro/20676867" target="_blank"><h4 style="background: black;display: inline-block;padding: 5px;"><span style="display: block;color: white;font-size: 17px;font-weight: bold;">Woo Product Table</span>NEW YEAR OFFER - 50% Discount <a href="https://codecanyon.net/item/woo-product-table-pro/20676867" style="color: white;text-decoration: none;background: #ff0000ab;display: inline-block;padding: 1px 5px;">Get Pro</a></h4></a>
    </div>
    <?php 
        echo ob_get_clean();
        }
   }
}
//add_action('admin_notices','wptf_important_notice_for_users');
