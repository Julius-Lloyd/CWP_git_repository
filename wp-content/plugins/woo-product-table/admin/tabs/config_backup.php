<?php
$config = $wptf_post_config =  get_post_meta( $post->ID, 'config', true );

if( !is_array( $config ) ){
    $config = get_option( 'wptf_configure_options' );
}

function wptf_selected_data(  $wptf_post_config, $keyword, $gotten_value ){
    $config = isset( $wptf_post_config ) && is_array( $wptf_post_config ) && count( $wptf_post_config ) > 0 ? $wptf_post_config : get_option( 'wptf_configure_options' );
    
    
    //echo ( isset( $config[$keyword] ) && $config[$keyword] == $gotten_value ? 'selected' : false  );
}
?>


<input name="config[plugin_version]" type="hidden" value="<?php echo WPT_Product_Table::getVersion(); ?>" style="">
<input name="config[plugin_name]" type="hidden" value="<?php echo WPT_Product_Table::getName(); ?>" style="">
<div style="padding-top: 15px;padding-bottom: 15px;" class="fieldwrap wptf_result_footer">
        <span class="configure_section_title"><?php esc_html_e( 'Basic Settings', 'wptf_pro' );?></span><?php wptf_selected_data(  $wptf_post_config, 'custom_add_to_cart',  'add_cart_no_icon' );?>
        <table class="wptf_config_form">
            <tbody>
                <tr>
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_custom_add_to_cart"><?php esc_html_e( 'Add to Cart Icon', 'wptf_pro' );?></label></th>
                        <td>
                            <select name="config[custom_add_to_cart]" id="wptf_table_custom_add_to_cart" class="wptf_fullwidth" >
                                <option value="add_cart_no_icon" <?php wptf_selected_data(  $wptf_post_config, 'custom_add_to_cart',  'add_cart_no_icon' );?>><?php esc_html_e( 'No Icon', 'wptf_pro' );?></option>
                                <option value="add_cart_only_icon" <?php wptf_selected_data(  $wptf_post_config, 'custom_add_to_cart',  'add_cart_only_icon' );?>><?php esc_html_e( 'Only Icon', 'wptf_pro' );?></option>
                                <option value="add_cart_left_icon" <?php wptf_selected_data(  $wptf_post_config, 'custom_add_to_cart',  'add_cart_left_icon' );?>><?php esc_html_e( 'Left Icon and Text', 'wptf_pro' );?></option>
                                <option value="add_cart_right_icon" <?php wptf_selected_data(  $wptf_post_config, 'custom_add_to_cart',  'add_cart_right_icon' );?>><?php esc_html_e( 'Text and Right Icon', 'wptf_pro' );?></option>
                            </select>

                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_footer_cart"><?php esc_html_e( 'Footer Cart Option', 'wptf_pro' );?></label></th>
                        <td>
                            <select name="config[footer_cart]" id="wptf_table_footer_cart" class="wptf_fullwidth" >
                                <option value="hide_for_zerro" <?php wptf_selected_data(  $wptf_post_config, 'footer_cart',  'hide_for_zerro' );?>><?php esc_html_e( 'Hide for Zero', 'wptf_pro' );?></option>
                                <option value="always_show" <?php wptf_selected_data(  $wptf_post_config, 'footer_cart',  'always_show' );?>><?php esc_html_e( 'Always Show', 'wptf_pro' );?></option>
                                <option value="always_hide" <?php wptf_selected_data(  $wptf_post_config, 'footer_cart',  'always_hide' );?>><?php esc_html_e( 'Always Hide', 'wptf_pro' );?></option>
                            </select>

                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th> <label for="wptf_table_footer_bg_color" class="wptf_label"><?php esc_html_e( 'Footer Cart BG Color', 'wptf_pro' );?></label></th>
                        <td>
                          <input name="config[footer_bg_color]" class="wptf_data_filed_atts wptf_color_picker" value="<?php echo $config['footer_bg_color']; ?>" id="wptf_table_footer_bg_colort" type="text" placeholder="<?php esc_attr_e( 'BG Color', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_footer_possition"><?php esc_html_e( 'Footer Cart Position', 'wptf_pro' );?></label></th>
                        <td>
                            <select name="config[footer_possition]" id="wptf_table_footer_possition" class="wptf_fullwidth" >
                                <option value="bottom_right" <?php wptf_selected_data(  $wptf_post_config, 'footer_possition',  'bottom_right' );?>><?php esc_html_e( 'Bottom Right', 'wptf_pro' );?></option>
                                <option value="bottom_left" <?php wptf_selected_data(  $wptf_post_config, 'footer_possition',  'bottom_left' );?>><?php esc_html_e( 'Bottom Left', 'wptf_pro' );?></option>
                                <option value="top_right" <?php wptf_selected_data(  $wptf_post_config, 'footer_possition',  'top_right' );?>><?php esc_html_e( 'Top Right', 'wptf_pro' );?></option>
                                <option value="top_left" <?php wptf_selected_data(  $wptf_post_config, 'footer_possition',  'top_left' );?>><?php esc_html_e( 'Top Left', 'wptf_pro' );?></option>
                            </select>

                        </td>
                     </div>
                </tr>

                <tr>
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_footer_cart_size"><?php echo sprintf( esc_html__('Footer Cart Size %s[Only Int]%s', 'wptf_pro'),'<small>', '</small>' );?></label></th>
                        <td>
                            <input name="config[footer_cart_size]" class="wptf_data_filed_atts" value="<?php echo $config['footer_cart_size']; ?>" id="wptf_table_thumbs_image_size" type="number" placeholder="<?php esc_attr_e( 'Default Size. eg: 70', 'wptf_pro' );?>" min="50" max="" pattern="[0-9]*" inputmode="numeric">
                        </td>
                     </div>
                </tr>


                <tr>
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_sort_mini_filter"><?php esc_html_e( 'Mini Filter Sorting', 'wptf_pro' );?></label></th>
                        <td>
                            <select name="config[sort_mini_filter]" id="wptf_table_sort_mini_filter" class="wptf_fullwidth" >
                                <option value="0" <?php wptf_selected_data(  $wptf_post_config, 'sort_mini_filter',  '0' );?>><?php esc_html_e( 'None', 'wptf_pro' );?></option>
                                <option value="ASC" <?php wptf_selected_data(  $wptf_post_config, 'sort_mini_filter',  'ASC' );?>><?php esc_html_e( 'Ascending', 'wptf_pro' );?></option>
                                <option value="DESC" <?php wptf_selected_data(  $wptf_post_config, 'sort_mini_filter',  'DESC' );?>><?php esc_html_e( 'Descending', 'wptf_pro' );?></option>
                            </select>

                        </td>
                     </div>
                </tr>

                <tr>
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_sort_searchbox_filter"><?php esc_html_e( 'Search Box Taxonomy Sorting', 'wptf_pro' );?></label></th>
                        <td>
                            <select name="config[sort_searchbox_filter]" id="wptf_table_sort_mini_filter" class="wptf_fullwidth" >
                                <option value="0" <?php wptf_selected_data(  $wptf_post_config, 'sort_searchbox_filter',  '0' );?>><?php esc_html_e( 'None', 'wptf_pro' );?></option>
                                <option value="ASC" <?php wptf_selected_data(  $wptf_post_config, 'sort_searchbox_filter',  'ASC' );?>><?php esc_html_e( 'Ascending', 'wptf_pro' );?></option>
                                <option value="DESC" <?php wptf_selected_data(  $wptf_post_config, 'sort_searchbox_filter',  'DESC' );?>><?php esc_html_e( 'Descending', 'wptf_pro' );?></option>
                            </select>
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_thumbs_image_size"><?php echo sprintf( esc_html__('Thumbs Image Size %s[Only Int]%s', 'wptf_pro'),'<small>', '</small>' );?></label></th>
                        <td>
                            <input name="config[thumbs_image_size]" class="wptf_data_filed_atts" value="<?php echo $config['thumbs_image_size']; ?>" id="wptf_table_thumbs_image_size" type="number" placeholder="<?php esc_attr_e( 'Thumbnail size. eg: 56', 'wptf_pro' );?>" min="16" max="" pattern="[0-9]*" inputmode="numeric">
                        </td>
                     </div>
                </tr>

                <tr> 
                    <!-- New at Version: 3.9 -->
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_popup_notice"><?php esc_html_e( 'Popup Notice [New]', 'wptf_pro' );?></label></th>
                        <td>
                           <select name="config[popup_notice]" id="wptf_table_popup_notice" class="wptf_fullwidth" >
                                <option value="1" <?php wptf_selected_data(  $wptf_post_config, 'popup_notice',  '1' );?>><?php esc_html_e( 'Enable', 'wptf_pro' );?></option>
                                <option value="0" <?php wptf_selected_data(  $wptf_post_config, 'popup_notice',  '0' );?>><?php esc_html_e( 'Disable', 'wptf_pro' );?></option>
                            </select>
                        </td>
                     </div>
                </tr>


                <tr> 
                    <!-- New at Version: 3.1 -->
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_thumbs_lightbox"><?php esc_html_e( 'Thumbs Image LightBox', 'wptf_pro' );?></label></th>
                        <td>
                           <select name="config[thumbs_lightbox]" id="wptf_table_thumbs_lightbox" class="wptf_fullwidth" >
                                <option value="1" <?php wptf_selected_data(  $wptf_post_config, 'thumbs_lightbox',  '1' );?>><?php esc_html_e( 'Enable', 'wptf_pro' );?></option>
                                <option value="0" <?php wptf_selected_data(  $wptf_post_config, 'thumbs_lightbox',  '0' );?>><?php esc_html_e( 'Disable', 'wptf_pro' );?></option>
                            </select>
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th> <label class="wptf_label" for="wptf_table_disable_product_link"><?php esc_html_e( 'Disable Product Link', 'wptf_pro' );?></label></th>
                        <td>
                            <select name="config[disable_product_link]" id="wptf_table_disable_product_link" class="wptf_fullwidth" >
                                <option value="1" <?php wptf_selected_data(  $wptf_post_config, 'disable_product_link',  '1' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                <option value="0" <?php wptf_selected_data(  $wptf_post_config, 'disable_product_link',  '0' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                            </select>
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th>  <label class="wptf_label" for="wptf_table_product_link_target"><?php esc_html_e( 'Product Link Open Type', 'wptf_pro' );?></label>
                        <td>
                            <select name="config[product_link_target]" id="wptf_table_disable_product_link" class="wptf_fullwidth" >
                                <option value="_blank" <?php wptf_selected_data(  $wptf_post_config, 'product_link_target',  '_blank' );?>><?php esc_html_e( 'New Tab', 'wptf_pro' );?></option>
                                <option value="_self" <?php wptf_selected_data(  $wptf_post_config, 'product_link_target',  '_self' );?>><?php esc_html_e( 'Self Tab', 'wptf_pro' );?></option>
                            </select>
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_all_selected_direct_checkout"><?php esc_html_e( 'Direct Checkout Page[for Add to cart Selected]', 'wptf_pro' );?></label></th>
                        <td>
                            <select name="config[all_selected_direct_checkout]" id="wptf_table_all_selected_direct_checkout" class="wptf_fullwidth" >
                                <option value="no" <?php wptf_selected_data(  $wptf_post_config, 'all_selected_direct_checkout',  'no' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                                <option value="yes" <?php wptf_selected_data(  $wptf_post_config, 'all_selected_direct_checkout',  'yes' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                            </select>
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th> <label class="wptf_label" for="wptf_table_product_direct_checkout"><?php esc_html_e( 'Enable Quick Buy Button [Direct Checkout Page for each product]', 'wptf_pro' );?></label></th>
                        <td>
                            <select name="config[product_direct_checkout]" id="wptf_table_product_direct_checkout" class="wptf_fullwidth" >
                                <option value="no" <?php wptf_selected_data(  $wptf_post_config, 'product_direct_checkout',  'no' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                                <option value="yes" <?php wptf_selected_data(  $wptf_post_config, 'product_direct_checkout',  'yes' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                            </select>
                            <p style="color: #0071a1;padding: 0;margin: 0;"><?php esc_html_e( 'Direct going to Checkout Page just after Added to cart for each product', 'wptf_pro' );?></p>
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th><label class="wptf_label" for="wptf_table_disable_cat_tag_link"><?php echo sprintf( esc_html__('Disable %s[Categories and Tags]%s Link', 'wptf_pro'),'<strong>', '</strong>' );?></label> </th>
                        <td>
                            <select name="config[disable_cat_tag_link]" id="wptf_table_disable_product_link" class="wptf_fullwidth" >
                                <option value="1" <?php wptf_selected_data(  $wptf_post_config, 'disable_cat_tag_link',  '1' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                <option value="0" <?php wptf_selected_data(  $wptf_post_config, 'disable_cat_tag_link',  '0' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                            </select>
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th> <label class="wptf_label" for="wptf_table_disable_loading_more"><?php echo sprintf( esc_html__('Disable %s[Load More]%s Button', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                            <select name="config[disable_loading_more]" id="wptf_table_disable_loading_more" class="wptf_fullwidth" >
                                <option value="load_more_hidden" <?php wptf_selected_data(  $wptf_post_config, 'disable_loading_more',  'load_more_hidden' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                <option value="normal" <?php wptf_selected_data(  $wptf_post_config, 'disable_loading_more',  'normal' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
                            </select>
                        </td>
                     </div>
                </tr>

                <tr> 
                    <div class="wptf_column">
                        <th> <label class="wptf_label" for="wptf_table_instant_search_filter"><?php esc_html_e( 'Instant Search Filter', 'wptf_pro' );?></label></th>
                        <td>
                           <select name="config[instant_search_filter]" id="wptf_table_instant_search_filter" class="wptf_fullwidth" >
                                <option value="1" <?php wptf_selected_data(  $wptf_post_config, 'instant_search_filter',  '1' );?>><?php esc_html_e( 'Yes', 'wptf_pro' );?></option>
                                <option value="0" <?php wptf_selected_data(  $wptf_post_config, 'instant_search_filter',  '0' );?>><?php esc_html_e( 'No', 'wptf_pro' );?></option>
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
                          <input name="config[product_not_founded]" class="wptf_data_filed_atts" value="<?php echo $config['product_not_founded']; ?>" id="wptf_table_product_not_founded" type="text" placeholder="<?php esc_attr_e( 'Not founded any products in this query.', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>

                <tr> 
                    <div class="wptf_column">
                        <th> <label for="wptf_table_load_more_text" class="wptf_label"><?php echo sprintf( esc_html__('%s[Load More]%s - Button Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                          <input name="config[load_more_text]" class="wptf_data_filed_atts" value="<?php echo $config['load_more_text']; ?>" id="wptf_table_load_more_text" type="text" placeholder="<?php esc_attr_e( 'Load More text write here', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>

                <tr> 
                    <div class="wptf_column">
                        <th>   <label for="wptf_table_search_button_text" class="wptf_label"><?php echo sprintf( esc_html__('%s[Search]%s - Button Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                           <input name="config[search_button_text]" class="wptf_data_filed_atts" value="<?php echo $config['search_button_text']; ?>" id="wptf_table_search_button_textt" type="text" placeholder="<?php esc_attr_e( 'Search text write here', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th><label for="wptf_table_search_keyword_text" class="wptf_label"><?php echo sprintf( esc_html__( '%s[Search Keyword]%s - Text',  'wptf_pro' ), '<b>',  '</b>'  );?></label></th>
                        <td>
                            <input name="config[search_keyword_text]" class="wptf_data_filed_atts" value="<?php echo $config['search_keyword_text']; ?>" id="wptf_table_search_button_textt" type="text" placeholder="<?php esc_attr_e( 'Search Keyword', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>

                <tr> 
                    <div class="wptf_column">
                        <th><label for="wptf_table_loading_more_text" class="wptf_label"><?php  echo sprintf( esc_html__('%s[Loading..]%s - Button Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                          <input name="config[loading_more_text]" class="wptf_data_filed_atts" value="<?php echo $config['loading_more_text']; ?>" id="wptf_table_loading_more_text" type="text" placeholder="<?php esc_attr_e( 'Loading.. text write here', 'wptf_pro' );?>"> 
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th> <label for="wptf_table_instant_search_textt" class="wptf_label"><?php echo sprintf( esc_html__('%s[Instance Search]%s - Text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                          <input name="config[instant_search_text]" class="wptf_data_filed_atts" value="<?php echo $config['instant_search_text']; ?>" id="wptf_table_instant_search_text" type="text" placeholder="<?php esc_attr_e( 'attr', 'wptf_pro' );?>"> 
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th> <label for="wptf_table_filter_text" class="wptf_label"><?php  echo sprintf( esc_html__('%s[Filter]%s - Text of Filter', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                            <input name="config[filter_text]" class="wptf_data_filed_atts" value="<?php echo $config['filter_text']; ?>" id="wptf_table_filter_text" type="text" placeholder="<?php esc_attr_e( 'eg: Filter', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th><label for="wptf_table_filter_reset_button" class="wptf_label"><?php  echo sprintf( esc_html__('%s[Reset]%s - Button Text of Filter', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                           <input name="config[filter_reset_button]" class="wptf_data_filed_atts" value="<?php echo $config['filter_reset_button']; ?>" id="wptf_table_filter_reset_button" type="text" placeholder="<?php esc_attr_e( 'eg: Reset', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>

                <tr> 
                    <div class="wptf_column">
                        <th><label for="wptf_table_item" class="wptf_label"><?php esc_html_e( 'Item [for Singular]', 'wptf_pro' );?></label></th>
                        <td>
                         <input name="config[item]" class="wptf_data_filed_atts" value="<?php echo $config['item']; ?>" id="wptf_table_item" type="text" placeholder="<?php esc_attr_e( 'Item | for All selected Button', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th> <label for="wptf_table_item" class="wptf_label"><?php esc_html_e( 'Item [for Plural]', 'wptf_pro' );?></label></th>
                        <td>
                         <input name="config[items]" class="wptf_data_filed_atts" value="<?php echo $config['items']; ?>" id="wptf_table_item" type="text" placeholder="<?php esc_attr_e( 'Item | for All selected Button', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>

                <tr> 
                    <div class="wptf_column">
                        <th> <label for="wptf_table_item" class="wptf_label"><?php esc_html_e( 'Add to Cart all selected [Added] Text', 'wptf_pro' );?></label></th>
                        <td>
                            <input name="config[add2cart_all_added_text]" class="wptf_data_filed_atts" value="<?php echo $config['add2cart_all_added_text']; ?>" id="wptf_table_item" type="text" placeholder="<?php esc_attr_e( 'Added text for [Add to cart Selected]', 'wptf_pro' );?>">
                        </td>
                    </div>

                </tr>

                <tr> 
                    <div class="wptf_column">
                        <th><label for="wptf_table_search_box_title" class="wptf_label"><?php esc_html_e( 'Search Box title', 'wptf_pro' );?></label></th>
                        <td>
                         <input name="config[search_box_title]" class="wptf_data_filed_atts" value="<?php echo $config['search_box_title']; ?>" id="wptf_table_search_box_title" type="text" placeholder="<?php esc_attr_e( 'Search Box title', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th><label for="wptf_table_search_box_searchkeyword" class="wptf_label"><?php esc_html_e( 'Search Keyword text', 'wptf_pro' );?></label></th>
                        <td>
                         <input name="config[search_box_searchkeyword]" class="wptf_data_filed_atts" value="<?php echo $config['search_box_searchkeyword']; ?>" id="wptf_table_search_box_searchkeyword" type="text" placeholder="<?php esc_attr_e( 'Search Keyword text', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_search_box_orderby" class="wptf_label"><?php esc_html_e( 'SearchBox Order By text', 'wptf_pro' );?></label></label></th>
                        <td>
                            <input name="config[search_box_orderby]" class="wptf_data_filed_atts" value="<?php echo $config['search_box_orderby']; ?>" id="wptf_table_search_box_orderby" type="text" placeholder="<?php esc_attr_e( 'Order By text', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_search_box_order" class="wptf_label"><?php esc_html_e( 'SearchBox Order text', 'wptf_pro' );?></label></label></th>
                        <td>
                            <input name="config[search_box_order]" class="wptf_data_filed_atts" value="<?php echo $config['search_box_order']; ?>" id="wptf_table_search_box_title" type="text" placeholder="<?php esc_attr_e( 'Order text', 'wptf_pro' );?>">
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
                          <input name="config[quick_view_btn_text]" class="wptf_data_filed_atts" value="<?php echo $config['quick_view_btn_text']; ?>" id="wptf_table_quick_view_btn_text" type="text" placeholder="<?php esc_attr_e( 'eg: Quick View', 'wptf_pro' );?>">
                          <p style="color: #005082;padding: 0;margin: 0;"><?php echo sprintf( esc_html__('Only for %s YITH WooCommerce Quick View%s Plugin', 'wptf_pro'),'<a target="_blank" href="https://wordpress.org/plugins/yith-woocommerce-quick-view/">', '</a>' );?></p>
                        </td>
                     </div>
                </tr>

                 <tr> 
                    <div class="wptf_column">
                        <th> <label for="wptf_table_yith_browse_list" class="wptf_label"><?php echo sprintf( esc_html__('%s[Browse Quote list]%s - text ', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                          <input name="config[yith_browse_list]" class="wptf_data_filed_atts" value="<?php echo $config['yith_browse_list']; ?>" id="wptf_table_yith_add_to_quote_text" type="text" placeholder="<?php esc_attr_e( 'Browse the list - text write here', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th><label for="wptf_table_yith_add_to_quote_text" class="wptf_label"><?php echo sprintf( esc_html__('%s[Add to Quote]%s - button text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                           <input name="config[yith_add_to_quote_text]" class="wptf_data_filed_atts" value="<?php echo $config['yith_add_to_quote_text']; ?>" id="wptf_table_yith_add_to_quote_text" type="text" placeholder="<?php esc_attr_e( 'Add to Quote text write here', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th> <label for="wptf_table_yith_add_to_quote_adding" class="wptf_label"><?php echo sprintf( esc_html__('%s[Quote Adding]%s - text', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                          <input name="config[yith_add_to_quote_adding]" class="wptf_data_filed_atts" value="<?php echo $config['yith_add_to_quote_adding']; ?>" id="wptf_table_yith_add_to_quote_adding" type="text" placeholder="<?php esc_attr_e( 'Adding text write here', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr> 
                    <div class="wptf_column">
                        <th> <label for="wptf_table_yith_add_to_quote_added" class="wptf_label"><?php echo sprintf( esc_html__('%s[Quote Added]%s - text ', 'wptf_pro'),'<b>', '</b>' );?></label></th>
                        <td>
                         <input name="config[yith_add_to_quote_added]" class="wptf_data_filed_atts" value="<?php echo $config['yith_add_to_quote_added']; ?>" id="wptf_table_yith_add_to_quote_added" type="text" placeholder="<?php esc_attr_e( 'Quote Added text write here', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
            </tbody>
        </table>

        <span class="configure_section_title"><?php echo sprintf( esc_html__('Table\'s Default Content %sSince 3.3%s', 'wptf_pro'), '<small style="color: orange; font-size: 12px;">', '</small>' );?></span>
        <table class="wptf_config_form">
            <tbody>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_table_in_stock" class="wptf_label"><?php esc_html_e( '[In Stock] for Table Column', 'wptf_pro' );?></label></th>
                        <td>
                            <input name="config[table_in_stock]" class="wptf_data_filed_atts" value="<?php echo $config['table_in_stock']; ?>" id="wptf_table_table_in_stock" type="text" placeholder="<?php esc_attr_e( 'In Stock', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_table_out_of_stock" class="wptf_label"><?php esc_html_e( '[Out of Stock] for Table Column', 'wptf_pro' );?></label></th>
                        <td>
                            <input name="config[table_out_of_stock]" class="wptf_data_filed_atts" value="<?php echo $config['table_out_of_stock']; ?>" id="wptf_table_table_out_of_stock" type="text" placeholder="<?php esc_attr_e( 'Out of Stock', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>

                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_table_on_back_order" class="wptf_label"><?php esc_html_e( '[On Back Order] for Table Column', 'wptf_pro' );?></label></th>
                        <td>
                            <input name="config[table_on_back_order]" class="wptf_data_filed_atts" value="<?php echo $config['table_on_back_order']; ?>" id="wptf_table_table_on_back_order" type="text" placeholder="<?php esc_attr_e( 'On Back Order', 'wptf_pro' );?>">
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
                            <input name="config[right_combination_message]" class="wptf_data_filed_atts" value="<?php echo $config['right_combination_message']; ?>" id="wptf_table_right_combination_message" type="text" placeholder="<?php esc_attr_e( 'Not Available', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_right_combination_message_alt" class="wptf_label"><?php esc_html_e( '[Product variations is not set Properly. May be: price is not inputted. may be: Out of Stock.] Message', 'wptf_pro' );?></label></th>
                        <td>    
                            <input name="config[right_combination_message_alt]" class="wptf_data_filed_atts" value="<?php echo $config['right_combination_message_alt']; ?>" id="wptf_table_right_combination_message_alt" type="text" placeholder="<?php esc_attr_e( 'Product variations is not set Properly. May be: price is not inputted. may be: Out of Stock.', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_select_all_items_message" class="wptf_label"><?php esc_html_e( '[Please select all items.] Message', 'wptf_pro' );?></label></th>
                        <td>    
                            <input name="config[select_all_items_message]" class="wptf_data_filed_atts" value="<?php echo $config['select_all_items_message']; ?>" id="wptf_table_select_all_items_message" type="text" placeholder="<?php esc_attr_e( 'Please select all items.', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_out_of_stock_message" class="wptf_label"><?php esc_html_e( '[Out of Stock] Message', 'wptf_pro' );?></label></th>
                        <td>    
                            <input name="config[out_of_stock_message]" class="wptf_data_filed_atts" value="<?php echo $config['out_of_stock_message']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'Out of Stock', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_no_more_query_message" class="wptf_label"><?php esc_html_e( '[There is no more products based on current Query.] Message', 'wptf_pro' );?></label></th>
                        <td>    
                            <input name="config[no_more_query_message]" class="wptf_data_filed_atts" value="<?php echo $config['no_more_query_message']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'There is no more products based on current Query.', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_out_of_stock_message" class="wptf_label"><?php esc_html_e( '[ Adding in Progress ] Message', 'wptf_pro' );?></label></th>
                        <td>    
                            <input name="config[adding_in_progress]" class="wptf_data_filed_atts" value="<?php echo $config['adding_in_progress']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'Adding in Progress', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_out_of_stock_message" class="wptf_label"><?php esc_html_e( '[ No Right Combination ] Message', 'wptf_pro' );?></label></th>
                        <td>    
                            <input name="config[no_right_combination]" class="wptf_data_filed_atts" value="<?php echo $config['no_right_combination']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'No Right Combination', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_sorry_plz_right_combination" class="wptf_label"><?php esc_html_e( '[ Sorry, Please choose right combination. ] Message', 'wptf_pro' );?></label></th>
                        <td>    
                            <input name="config[sorry_plz_right_combination]" class="wptf_data_filed_atts" value="<?php echo $config['sorry_plz_right_combination']; ?>" id="wptf_table_sorry_plz_right_combination" type="text" placeholder="<?php esc_attr_e( 'Sorry, Please choose right combination.', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                    <div class="wptf_column">
                        <th><label for="wptf_table_out_of_stock_message" class="wptf_label"><?php esc_html_e( '[ Sorry! Out of Stock! ] Message', 'wptf_pro' );?></label></th>
                        <td>    
                            <input name="config[sorry_out_of_stock]" class="wptf_data_filed_atts" value="<?php echo $config['sorry_out_of_stock']; ?>" id="wptf_table_out_of_stock_message" type="text" placeholder="<?php esc_attr_e( 'Sorry! Out of Stock!', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
                <tr>
                     <!-- New Added at Version 3.1 -->
                    <div class="wptf_column">
                        <th><label for="wptf_table_type_your_message" class="wptf_label"><?php esc_html_e( '[Type your Message.] Message', 'wptf_pro' );?></label></th>
                        <td>    
                            <input name="config[type_your_message]" class="wptf_data_filed_atts" value="<?php echo $config['type_your_message']; ?>" id="wptf_table_type_your_message" type="text" placeholder="<?php esc_attr_e( 'Type your Message.', 'wptf_pro' );?>">
                        </td>
                     </div>
                </tr>
            </tbody>
        </table>

</div>
