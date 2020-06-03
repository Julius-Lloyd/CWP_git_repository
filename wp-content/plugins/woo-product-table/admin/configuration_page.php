<?php

/**
 * Executing selected item for options
 * 
 * @since 2.4 
 */
function wptf_selected(  $keyword, $gotten_value ){
    $current_config_value = get_option( 'wptf_configure_options' );
    echo ( isset( $current_config_value[$keyword] ) && $current_config_value[$keyword] == $gotten_value ? 'selected' : false  );
}

/**
 * For Configuration Page
 * 
 * @since 2.4
 */
function wptf_configuration_page(){

    if( isset( $_POST['data'] ) && isset( $_POST['reset_button'] ) ){
        //Reset 
        $value = WPT_Product_Table::$default;
        update_option( 'wptf_configure_options',  $value  );
       
    }else if( isset( $_POST['data'] ) && isset( $_POST['configure_submit'] ) ){
        //configure_submit
        $value = ( is_array( $_POST['data'] ) ? $_POST['data'] : false  );
         //Update Maintenace for Free Version, So that always keep default value
        //since 1.4 (04-12-18)
        $default = get_option('wptf_configure_options');
        
          
        $value['footer_bg_color'] = $default['footer_bg_color'];
        $value['footer_possition'] = $default['footer_possition'];
        $value['footer_cart_size'] = $default['footer_cart_size'];
        
        $value['thumbs_image_size'] = $default['thumbs_image_size'];
        $value['all_selected_direct_checkout'] = $default['all_selected_direct_checkout'];
        $value['product_direct_checkout'] = $default['product_direct_checkout'];
        $value['instant_search_filter'] = $default['instant_search_filter'];
        $value['disable_cat_tag_link'] = $default['disable_cat_tag_link'];
        $value['disable_product_link'] = $default['disable_product_link'];
        
        $value['table_in_stock'] = $default['table_in_stock'];
        $value['table_out_of_stock'] = $default['table_out_of_stock'];
        $value['table_on_back_order'] = $default['table_on_back_order'];
        $value['popup_notice'] = $default['popup_notice'];
        
        update_option( 'wptf_configure_options',  $value );
    }
    $current_config_value = get_option( 'wptf_configure_options' );
    ?>
    <div class="wrap wptf_wrap wptf_configure_page">
        <h2></h2>
        <div id="wptf_configuration_form" class="wptf_leftside">
            
            <h2 style="padding-left: 15px;" class="plugin_name"><?php echo WPT_Product_Table::getName(); ?> <span class="plugin_version">v <?php echo WPT_Product_Table::getVersion(); ?></span></h2>
        
            <div style="padding-top: 15px;padding-bottom: 15px;" class="fieldwrap wptf_result_footer">
                <br style="clear: both;">
            <h1 style="padding-left: 15px;"><?php esc_html_e( 'Common Configuration', 'wptf_pro' );?></h1>
            <p style="padding-left: 10px;"><?php esc_html_e( 'Remember: Each product table has individual configuration, which will be considered as first priority. But this configuration has no "First Priority".', 'wptf_pro' );?></p>
            <br>
                <form action="" method="POST">
                    <input name="data[plugin_version]" type="hidden" value="<?php echo WPT_Product_Table::getVersion(); ?>" style="">
                    <input name="data[plugin_name]" type="hidden" value="<?php echo WPT_Product_Table::getName(); ?>" style="">
                    <span class="configure_section_title"><?php esc_html_e( 'Basic Settings', 'wptf_pro' );?></span>
                    <table class="wptf_config_form">
                        <tbody>
                            <tr>
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_custom_add_to_cart"><?php esc_html_e( 'Add to Cart Icon', 'wptf_pro' );?></label></th>
                                    <td>
                                        <select name="data[custom_add_to_cart]" id="wptf_table_custom_add_to_cart" class="wptf_fullwidth" >
                                            <option value="add_cart_no_icon" <?php wptf_selected( 'custom_add_to_cart',  'add_cart_no_icon' );?>><?php esc_html_e( 'No Icon', 'wptf_pro' );?></option>
                                            <option value="add_cart_only_icon" <?php wptf_selected( 'custom_add_to_cart',  'add_cart_only_icon' );?>><?php esc_html_e( 'Only Icon', 'wptf_pro' );?></option>
                                            <option value="add_cart_left_icon" <?php wptf_selected( 'custom_add_to_cart',  'add_cart_left_icon' );?>><?php esc_html_e( 'Left Icon and Text', 'wptf_pro' );?></option>
                                            <option value="add_cart_right_icon" <?php wptf_selected( 'custom_add_to_cart',  'add_cart_right_icon' );?>><?php esc_html_e( 'Text and Right Icon', 'wptf_pro' );?></option>
                                        </select>

                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_footer_cart"><?php esc_html_e( 'Footer Cart Option', 'wptf_pro' );?></label></th>
                                    <td>
                                        <select name="data[footer_cart]" id="wptf_table_footer_cart" class="wptf_fullwidth" >
                                            <option value="hide_for_zerro" <?php wptf_selected( 'footer_cart',  'hide_for_zerro' );?>><?php esc_html_e( 'Hide for Zero', 'wptf_pro' );?></option>
                                            <option value="always_show" <?php wptf_selected( 'footer_cart',  'always_show' );?>><?php esc_html_e( 'Always Show', 'wptf_pro' );?></option>
                                            <option value="always_hide" <?php wptf_selected( 'footer_cart',  'always_hide' );?>><?php esc_html_e( 'Always Hide', 'wptf_pro' );?></option>
                                        </select>

                                    </td>
                                 </div>
                            </tr>
                            <tr class="only_for_premium"> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_footer_bg_color" class="wptf_label"><?php esc_html_e( 'Footer Cart BG Color', 'wptf_pro' );?></label></th>
                                    <td>
                                      <input name="data[footer_bg_color]" class="wptf_data_filed_atts wptf_color_picker" value="<?php echo $current_config_value['footer_bg_color']; ?>" id="wptf_table_footer_bg_colort" type="text" placeholder="<?php esc_attr_e( 'BG Color', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr class="only_for_premium">
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_footer_possition"><?php esc_html_e( 'Footer Cart Position', 'wptf_pro' );?></label></th>
                                    <td>
                                        <select name="data[footer_possition]" id="wptf_table_footer_possition" class="wptf_fullwidth" >
                                            <option value="bottom_right" <?php wptf_selected( 'footer_possition',  'bottom_right' );?>><?php esc_html_e( 'Bottom Right', 'wptf_pro' );?></option>
                                            <option value="bottom_left" <?php wptf_selected( 'footer_possition',  'bottom_left' );?>><?php esc_html_e( 'Bottom Left', 'wptf_pro' );?></option>
                                            <option value="top_right" <?php wptf_selected( 'footer_possition',  'top_right' );?>><?php esc_html_e( 'Top Right', 'wptf_pro' );?></option>
                                            <option value="top_left" <?php wptf_selected( 'footer_possition',  'top_left' );?>><?php esc_html_e( 'Top Left', 'wptf_pro' );?></option>
                                        </select>

                                    </td>
                                 </div>
                            </tr>
                            
                            <tr class="only_for_premium">
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_footer_cart_size"><?php echo sprintf( esc_html__('Footer Cart Size %s[Only Int]%s', 'wptf_pro'),'<small>', '</small>' );?></label></th>
                                    <td>
                                        <input name="data[footer_cart_size]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['footer_cart_size']; ?>" id="wptf_table_thumbs_image_size" type="number" placeholder="<?php esc_attr_e( 'Default Size. eg: 70', 'wptf_pro' );?>" min="50" max="" pattern="[0-9]*" inputmode="numeric">
                                    </td>
                                 </div>
                            </tr>
                            
                            
                            <tr>
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_sort_mini_filter"><?php esc_html_e( 'Mini Filter Sorting', 'wptf_pro' );?></label></th>
                                    <td>
                                        <select name="data[sort_mini_filter]" id="wptf_table_sort_mini_filter" class="wptf_fullwidth" >
                                            <option value="0" <?php wptf_selected( 'sort_mini_filter',  '0' );?>><?php esc_html_e( 'None', 'wptf_pro' );?></option>
                                            <option value="ASC" <?php wptf_selected( 'sort_mini_filter',  'ASC' );?>><?php esc_html_e( 'Ascending', 'wptf_pro' );?></option>
                                            <option value="DESC" <?php wptf_selected( 'sort_mini_filter',  'DESC' );?>><?php esc_html_e( 'Descending', 'wptf_pro' );?></option>
                                        </select>

                                    </td>
                                 </div>
                            </tr>
                            
                            <tr>
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_sort_searchbox_filter"><?php esc_html_e( 'Search Box Taxonomy Sorting', 'wptf_pro' );?></label></th>
                                    <td>
                                        <select name="data[sort_searchbox_filter]" id="wptf_table_sort_mini_filter" class="wptf_fullwidth" >
                                            <option value="0" <?php wptf_selected( 'sort_searchbox_filter',  '0' );?>><?php esc_html_e( 'None', 'wptf_pro' );?></option>
                                            <option value="ASC" <?php wptf_selected( 'sort_searchbox_filter',  'ASC' );?>><?php esc_html_e( 'Ascending', 'wptf_pro' );?></option>
                                            <option value="DESC" <?php wptf_selected( 'sort_searchbox_filter',  'DESC' );?>><?php esc_html_e( 'Descending', 'wptf_pro' );?></option>
                                        </select>
                                    </td>
                                 </div>
                            </tr>
                            <tr class="only_for_premium">
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_thumbs_image_size"><?php echo sprintf( esc_html__('Thumbs Image Size %s[Only Int]%s', 'wptf_pro'),'<small>', '</small>' );?></label></th>
                                    <td>
                                        <input name="data[thumbs_image_size]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['thumbs_image_size']; ?>" id="wptf_table_thumbs_image_size" type="number" placeholder="<?php esc_attr_e( 'Thumbnail size. eg: 56', 'wptf_pro' );?>" min="16" max="" pattern="[0-9]*" inputmode="numeric">
                                    </td>
                                 </div>
                            </tr>
                            
                            <tr class="only_for_premium"> 
                                <!-- New at Version: 3.9 -->
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_popup_notice"><?php esc_html_e( 'Popup Notice [New]', 'wptf_pro' );?></label></th>
                                    <td>
                                       <select name="data[popup_notice]" id="wptf_table_popup_notice" class="wptf_fullwidth" >
                                            <option value="1" <?php wptf_selected( 'popup_notice',  '1' );?>><?php esc_html_e( 'Enable', 'wptf_pro' );?></option>
                                            <option value="0" <?php wptf_selected( 'popup_notice',  '0' );?>><?php esc_html_e( 'Disable', 'wptf_pro' );?></option>
                                        </select>
                                    </td>
                                 </div>
                            </tr>
                            
                            
                            <tr class="only_for_premium"> 
                                <!-- New at Version: 3.1 -->
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_thumbs_lightbox"><?php esc_html_e( 'Thumbs Image LightBox', 'wptf_pro' );?></label></th>
                                    <td>
                                       <select name="data[thumbs_lightbox]" id="wptf_table_thumbs_lightbox" class="wptf_fullwidth" >
                                            <option value="1" <?php wptf_selected( 'thumbs_lightbox',  '1' );?>><?php esc_html_e( 'Enable', 'wptf_pro' );?></option>
                                            <option value="0" <?php wptf_selected( 'thumbs_lightbox',  '0' );?>><?php esc_html_e( 'Disable', 'wptf_pro' );?></option>
                                        </select>
                                    </td>
                                 </div>
                            </tr>
                            <tr class="only_for_premium"> 
                                <div class="wptf_column">
                                    <th> <label class="wptf_label" for="wptf_table_disable_product_link"><?php esc_html_e( 'Disable Product Link', 'wptf_pro' );?></label></th>
                                    <td>
                                        <select name="data[disable_product_link]" id="wptf_table_disable_product_link" class="wptf_fullwidth" >
                                            <option value="1" <?php wptf_selected( 'disable_product_link',  '1' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                            <option value="0" <?php wptf_selected( 'disable_product_link',  '0' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                                        </select>
                                    </td>
                                 </div>
                            </tr>
                            <tr class="only_for_premium"> 
                                <div class="wptf_column">
                                    <th>  <label class="wptf_label" for="wptf_table_product_link_target"><?php esc_html_e( 'Product Link Open Type', 'wptf_pro' );?></label>
                                    <td>
                                        <select name="data[product_link_target]" id="wptf_table_disable_product_link" class="wptf_fullwidth" >
                                            <option value="_blank" <?php wptf_selected( 'product_link_target',  '_blank' );?>><?php esc_html_e( 'New Tab', 'wptf_pro' );?></option>
                                            <option value="_self" <?php wptf_selected( 'product_link_target',  '_self' );?>><?php esc_html_e( 'Self Tab', 'wptf_pro' );?></option>
                                        </select>
                                    </td>
                                 </div>
                            </tr>
                            <tr class="only_for_premium"> 
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_all_selected_direct_checkout"><?php esc_html_e( 'Direct Checkout Page[for Add to cart Selected]', 'wptf_pro' );?></label></th>
                                    <td>
                                        <select name="data[all_selected_direct_checkout]" id="wptf_table_all_selected_direct_checkout" class="wptf_fullwidth" >
                                            <option value="no" <?php wptf_selected( 'all_selected_direct_checkout',  'no' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                                            <option value="yes" <?php wptf_selected( 'all_selected_direct_checkout',  'yes' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                        </select>
                                    </td>
                                 </div>
                            </tr>
                            <tr class="only_for_premium"> 
                                <div class="wptf_column">
                                    <th> <label class="wptf_label" for="wptf_table_product_direct_checkout"><?php esc_html_e( 'Enable Quick Buy Button [Direct Checkout Page for each product]', 'wptf_pro' );?></label></th>
                                    <td>
                                        <select name="data[product_direct_checkout]" id="wptf_table_product_direct_checkout" class="wptf_fullwidth" >
                                            <option value="no" <?php wptf_selected( 'product_direct_checkout',  'no' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                                            <option value="yes" <?php wptf_selected( 'product_direct_checkout',  'yes' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                        </select>
                                        <p style="color: #0071a1;padding: 0;margin: 0;"><?php esc_html_e( 'Direct going to Checkout Page just after Added to cart for each product', 'wptf_pro' );?></p>
                                    </td>
                                 </div>
                            </tr>
                            <tr class="only_for_premium"> 
                                <div class="wptf_column">
                                    <th><label class="wptf_label" for="wptf_table_disable_cat_tag_link"><?php echo sprintf( esc_html__('Disable %s[Categories and Tags]%s Link', 'wptf_pro'),'<strong>', '</strong>' );?></label> </th>
                                    <td>
                                        <select name="data[disable_cat_tag_link]" id="wptf_table_disable_product_link" class="wptf_fullwidth" >
                                            <option value="1" <?php wptf_selected( 'disable_cat_tag_link',  '1' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                            <option value="0" <?php wptf_selected( 'disable_cat_tag_link',  '0' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                                        </select>
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th> <label class="wptf_label" for="wptf_table_disable_loading_more"><?php echo sprintf( esc_html__('Disable %s[Load More]%s Button', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                        <select name="data[disable_loading_more]" id="wptf_table_disable_loading_more" class="wptf_fullwidth" >
                                            <option value="load_more_hidden" <?php wptf_selected( 'disable_loading_more',  'load_more_hidden' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                            <option value="normal" <?php wptf_selected( 'disable_loading_more',  'normal' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                                        </select>
                                    </td>
                                 </div>
                            </tr>
                            
                            <tr class="only_for_premium"> 
                                <div class="wptf_column">
                                    <th> <label class="wptf_label" for="wptf_table_instant_search_filter"><?php esc_html_e( 'Instant Search Filter', 'wptf_pro' );?></label></th>
                                    <td>
                                       <select name="data[instant_search_filter]" id="wptf_table_instant_search_filter" class="wptf_fullwidth" >
                                            <option value="1" <?php wptf_selected( 'instant_search_filter',  '1' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                            <option value="0" <?php wptf_selected( 'instant_search_filter',  '0' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                                        </select>
                                    </td>
                                 </div>
                            </tr>
                        </tbody>
                    </table>
                    <span class="configure_section_title"><?php esc_html_e( 'Label Text', 'wptf_pro' );?></span>
                    <table class="wptf_config_form">
                        <tbody>
                            <tr> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_product_not_founded" class="wptf_label"><?php echo sprintf( esc_html__('%s[Products Not founded!]%s - Message Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                      <input name="data[product_not_founded]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['product_not_founded']; ?>" id="wptf_table_product_not_founded" type="text" placeholder="<?php esc_attr_e( 'Not founded any products in this query.', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            
                            <tr> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_load_more_text" class="wptf_label"><?php echo sprintf( esc_html__('%s[Load More]%s - Button Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                      <input name="data[load_more_text]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['load_more_text']; ?>" id="wptf_table_load_more_text" type="text" placeholder="<?php esc_attr_e( 'Load More text write here', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            
                            <tr> 
                                <div class="wptf_column">
                                    <th>   <label for="wptf_table_search_button_text" class="wptf_label"><?php echo sprintf( esc_html__('%s[Search]%s - Button Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                       <input name="data[search_button_text]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['search_button_text']; ?>" id="wptf_table_search_button_textt" type="text" placeholder="<?php esc_attr_e( 'Search text write here', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th><label for="wptf_table_search_keyword_text" class="wptf_label"><?php echo sprintf( esc_html__( '%s[Search Keyword]%s - Text',  'wptf_pro' ), '<b>',  '</b>'  );?></label></th>
                                    <td>
                                        <input name="data[search_keyword_text]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['search_keyword_text']; ?>" id="wptf_table_search_button_textt" type="text" placeholder="<?php esc_attr_e( 'Search Keyword', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            
                            <tr> 
                                <div class="wptf_column">
                                    <th><label for="wptf_table_loading_more_text" class="wptf_label"><?php  echo sprintf( esc_html__('%s[Loading..]%s - Button Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                      <input name="data[loading_more_text]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['loading_more_text']; ?>" id="wptf_table_loading_more_text" type="text" placeholder="<?php esc_attr_e( 'Loading.. text write here', 'wptf_pro' );?>"> 
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_instant_search_textt" class="wptf_label"><?php echo sprintf( esc_html__('%s[Instance Search]%s - Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                      <input name="data[instant_search_text]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['instant_search_text']; ?>" id="wptf_table_instant_search_text" type="text" placeholder="<?php esc_attr_e( 'attr', 'wptf_pro' );?>"> 
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_filter_text" class="wptf_label"><?php  echo sprintf( esc_html__('%s[Filter]%s - Text of Filter', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                        <input name="data[filter_text]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['filter_text']; ?>" id="wptf_table_filter_text" type="text" placeholder="<?php esc_attr_e( 'eg: Filter', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th><label for="wptf_table_filter_reset_button" class="wptf_label"><?php  echo sprintf( esc_html__('%s[Reset]%s - Button Text of Filter', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                       <input name="data[filter_reset_button]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['filter_reset_button']; ?>" id="wptf_table_filter_reset_button" type="text" placeholder="<?php esc_attr_e( 'eg: Reset', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                           
                            <tr> 
                                <div class="wptf_column">
                                    <th><label for="wptf_table_item" class="wptf_label"><?php esc_html_e( 'Item [for Singular]', 'wptf_pro' );?></label></th>
                                    <td>
                                     <input name="data[item]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['item']; ?>" id="wptf_table_item" type="text" placeholder="<?php esc_attr_e( 'Item | for All selected Button', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_item" class="wptf_label"><?php esc_html_e( 'Item [for Plural]', 'wptf_pro' );?></label></th>
                                    <td>
                                     <input name="data[items]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['items']; ?>" id="wptf_table_item" type="text" placeholder="<?php esc_attr_e( 'Item | for All selected Button', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            
                            <tr> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_item" class="wptf_label"><?php esc_html_e( 'Add to Cart all selected [Added] Text', 'wptf_pro' );?></label></th>
                                    <td>
                                        <input name="data[add2cart_all_added_text]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['add2cart_all_added_text']; ?>" id="wptf_table_item" type="text" placeholder="<?php esc_attr_e( 'Added text for [Add to cart Selected]', 'wptf_pro' );?>">
                                    </td>
                                </div>

                            </tr>
                            
                            <tr> 
                                <div class="wptf_column">
                                    <th><label for="wptf_table_search_box_title" class="wptf_label"><?php esc_html_e( 'Search Box title', 'wptf_pro' );?></label></th>
                                    <td>
                                     <input name="data[search_box_title]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['search_box_title']; ?>" id="wptf_table_search_box_title" type="text" placeholder="<?php esc_attr_e( 'Search Box title', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th><label for="wptf_table_search_box_searchkeyword" class="wptf_label"><?php esc_html_e( 'Search Keyword text', 'wptf_pro' );?></label></th>
                                    <td>
                                     <input name="data[search_box_searchkeyword]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['search_box_searchkeyword']; ?>" id="wptf_table_search_box_searchkeyword" type="text" placeholder="<?php esc_attr_e( 'Search Keyword text', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_search_box_orderby" class="wptf_label"><?php esc_html_e( 'SearchBox Order By text', 'wptf_pro' );?></label></label></th>
                                    <td>
                                        <input name="data[search_box_orderby]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['search_box_orderby']; ?>" id="wptf_table_search_box_orderby" type="text" placeholder="<?php esc_attr_e( 'Order By text', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_search_box_order" class="wptf_label"><?php esc_html_e( 'SearchBox Order text', 'wptf_pro' );?></label></label></th>
                                    <td>
                                        <input name="data[search_box_order]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['search_box_order']; ?>" id="wptf_table_search_box_title" type="text" placeholder="<?php esc_attr_e( 'Order text', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                        </tbody>
                    </table>
                    <span class="configure_section_title"><?php echo sprintf( esc_html__('External Plugin\'s %s[YITH]%s ', 'wptf_pro'),'<span style="color: orange; font-size: 18px;">', '</span>' );?></span>
                    <table class="wptf_config_form external_plugin">
                        <tbody>
                             <tr> 
                                <!-- Quick View Button Text -->
                                <div class="wptf_column">
                                    <th><label for="wptf_table_quick_view_btn_text" class="wptf_label"><?php echo sprintf( esc_html__('%s[Quick View]%s - Button Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                      <input name="data[quick_view_btn_text]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['quick_view_btn_text']; ?>" id="wptf_table_quick_view_btn_text" type="text" placeholder="<?php esc_attr_e( 'eg: Quick View', 'wptf_pro' );?>">
                                      <p style="color: #005082;padding: 0;margin: 0;"><?php echo sprintf( esc_html__('Only for %s YITH WooCommerce Quick View%s Plugin', 'wptf_pro'),'<a target="_blank" href="https://wordpress.org/plugins/yith-woocommerce-quick-view/">', '</a>' );?></p>
                                    </td>
                                 </div>
                            </tr>
                            
                             <tr> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_yith_browse_list" class="wptf_label"><?php echo sprintf( esc_html__('%s[Browse Quote list]%s - text ', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                      <input name="data[yith_browse_list]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['yith_browse_list']; ?>" id="wptf_table_yith_add_to_quote_text" type="text" placeholder="<?php esc_attr_e( 'Browse the list - text write here', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th><label for="wptf_table_yith_add_to_quote_text" class="wptf_label"><?php echo sprintf( esc_html__('%s[Add to Quote]%s - button text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                       <input name="data[yith_add_to_quote_text]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['yith_add_to_quote_text']; ?>" id="wptf_table_yith_add_to_quote_text" type="text" placeholder="<?php esc_attr_e( 'Add to Quote text write here', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_yith_add_to_quote_adding" class="wptf_label"><?php echo sprintf( esc_html__('%s[Quote Adding]%s - text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                      <input name="data[yith_add_to_quote_adding]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['yith_add_to_quote_adding']; ?>" id="wptf_table_yith_add_to_quote_adding" type="text" placeholder="<?php esc_attr_e( 'Adding text write here', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr> 
                                <div class="wptf_column">
                                    <th> <label for="wptf_table_yith_add_to_quote_added" class="wptf_label"><?php echo sprintf( esc_html__('%s[Quote Added]%s - text ', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                                    <td>
                                     <input name="data[yith_add_to_quote_added]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['yith_add_to_quote_added']; ?>" id="wptf_table_yith_add_to_quote_added" type="text" placeholder="<?php esc_attr_e( 'Quote Added text write here', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                        </tbody>
                    </table>
                    
                    <span class="configure_section_title"><?php echo sprintf( esc_html__('Table\'s Default Content %sSince 3.3%s', 'wptf_pro'), '<small style="color: orange; font-size: 12px;">', '</small>' );?></span>
                    <table class="wptf_config_form">
                        <tbody>
                            <tr class="only_for_premium">
                                <div class="wptf_column">
                                    <th><label for="wptf_table_table_in_stock" class="wptf_label"><?php esc_html_e( '[In Stock] for Table Column', 'wptf_pro' );?></label></th>
                                    <td>
                                        <input name="data[table_in_stock]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['table_in_stock']; ?>" id="wptf_table_table_in_stock" type="text" placeholder="<?php esc_attr_e( 'In Stock', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr class="only_for_premium">
                                <div class="wptf_column">
                                    <th><label for="wptf_table_table_out_of_stock" class="wptf_label"><?php esc_html_e( '[Out of Stock] for Table Column', 'wptf_pro' );?></label></th>
                                    <td>
                                        <input name="data[table_out_of_stock]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['table_out_of_stock']; ?>" id="wptf_table_table_out_of_stock" type="text" placeholder="<?php esc_attr_e( 'Out of Stock', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            
                            <tr class="only_for_premium">
                                <div class="wptf_column">
                                    <th><label for="wptf_table_table_on_back_order" class="wptf_label"><?php esc_html_e( '[On Back Order] for Table Column', 'wptf_pro' );?></label></th>
                                    <td>
                                        <input name="data[table_on_back_order]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['table_on_back_order']; ?>" id="wptf_table_table_on_back_order" type="text" placeholder="<?php esc_attr_e( 'On Back Order', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                    <!-- Here was Table of MiniCart's default content. We have keep backup to backup_configuration.php -->
                    
                    <span class="configure_section_title"><?php esc_html_e( 'All Messages', 'wptf_pro' );?></span>
                    <table class="wptf_config_form wptf_all_messages">
                        <tbody>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_right_combination_message" class="wptf_label"><?php esc_html_e( 'Variations [Not available] Message', 'wptf_pro' );?></label></th>
                                    <td> 
                                        <input name="data[right_combination_message]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['right_combination_message']; ?>" id="wptf_table_right_combination_message" type="text" placeholder="<?php esc_attr_e( 'Not Available', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_right_combination_message_alt" class="wptf_label"><?php esc_html_e( '[Product variations is not set Properly. May be: price is not inputted. may be: Out of Stock.] Message', 'wptf_pro' );?></label></th>
                                    <td>    
                                        <input name="data[right_combination_message_alt]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['right_combination_message_alt']; ?>" id="wptf_table_right_combination_message_alt" type="text" placeholder="<?php esc_attr_e( 'Product variations is not set Properly. May be: price is not inputted. may be: Out of Stock.', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_select_all_items_message" class="wptf_label"><?php esc_html_e( '[Please select all items.] Message', 'wptf_pro' );?></label></th>
                                    <td>    
                                        <input name="data[select_all_items_message]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['select_all_items_message']; ?>" id="wptf_table_select_all_items_message" type="text" placeholder="<?php esc_attr_e( 'Please select all items.', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_out_of_stock_message" class="wptf_label"><?php esc_html_e( '[Out of Stock] Message', 'wptf_pro' );?></label></th>
                                    <td>    
                                        <input name="data[out_of_stock_message]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['out_of_stock_message']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'Out of Stock', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_no_more_query_message" class="wptf_label"><?php esc_html_e( '[There is no more products based on current Query.] Message', 'wptf_pro' );?></label></th>
                                    <td>    
                                        <input name="data[no_more_query_message]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['no_more_query_message']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'There is no more products based on current Query.', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_out_of_stock_message" class="wptf_label"><?php esc_html_e( '[ Adding in Progress ] Message', 'wptf_pro' );?></label></th>
                                    <td>    
                                        <input name="data[adding_in_progress]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['adding_in_progress']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'Adding in Progress', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_out_of_stock_message" class="wptf_label"><?php esc_html_e( '[ No Right Combination ] Message', 'wptf_pro' );?></label></th>
                                    <td>    
                                        <input name="data[no_right_combination]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['no_right_combination']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'No Right Combination', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_sorry_plz_right_combination" class="wptf_label"><?php esc_html_e( '[ Sorry, Please choose right combination. ] Message', 'wptf_pro' );?></label></th>
                                    <td>    
                                        <input name="data[sorry_plz_right_combination]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['sorry_plz_right_combination']; ?>" id="wptf_table_sorry_plz_right_combination" type="text" placeholder="<?php esc_attr_e( 'Sorry, Please choose right combination.', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                <div class="wptf_column">
                                    <th><label for="wptf_table_out_of_stock_message" class="wptf_label"><?php esc_html_e( '[ Sorry! Out of Stock! ] Message', 'wptf_pro' );?></label></th>
                                    <td>    
                                        <input name="data[sorry_out_of_stock]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['sorry_out_of_stock']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'Sorry! Out of Stock!', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                            <tr>
                                 <!-- New Added at Version 3.1 -->
                                <div class="wptf_column">
                                    <th><label for="wptf_table_type_your_message" class="wptf_label"><?php esc_html_e( '[Type your Message.] Message', 'wptf_pro' );?></label></th>
                                    <td>    
                                        <input name="data[type_your_message]" class="wptf_data_filed_atts" value="<?php echo $current_config_value['type_your_message']; ?>" id="wptf_table_type_your_message" type="text" placeholder="<?php esc_attr_e( 'Type your Message.', 'wptf_pro' );?>">
                                    </td>
                                 </div>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" name="configure_submit" class="button-primary primary button btn-info"><?php esc_html_e( 'Submit', 'wptf_pro' );?></button>
                    <button type="submit" name="reset_button" class="button"><?php esc_html_e( 'Reset', 'wptf_pro' );?></button>
                    
                </form>
            </div>
            
        </div>
        <!-- Right Side start here -->
        <?php include __DIR__ . '/includes/right_side.php'; ?> 
    </div>  
    
    <style>
        .tab-content{display: none;}
        .tab-content.tab-content-active{display: block;}
        .wptf_leftside,.wptf_rightside{float: left;}
        .wptf_leftside{
            width: 75%;overflow:hidden;
        }
        .break_space_large{display: block;visibility: hidden;height: 25px;background: transparent;}
        .break_space,.break_space_medium{display: block;visibility: hidden;height: 15px;background: transparent;}
        .break_space_small{display: block;visibility: hidden;height: 5px;background: transparent;}
        .wptf_rightside{width: 25%;}
        @media only screen and (max-width: 800px){
            .wptf_leftside{width: 100%;}
            .wptf_rightside{display: none !important;}
        }
        /*****For Column Moveable Item*******/
        ul#wptf_column_sortable li>span.handle{
            background-image: url('<?php echo WPT_FREE_BASE_URL . 'images/move.png'; ?>' );
        }

    </style>
    <?php
}
