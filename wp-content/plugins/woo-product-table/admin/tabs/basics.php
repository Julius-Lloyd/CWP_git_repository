<?php
$meta_basics = get_post_meta( $post->ID, 'basics', true );
?>

<?php
    /**
     * To Get Category List of WooCommerce
     * @since 1.0.0 -10
     */
    $args = array(
        'hide_empty'    => false, 
        'orderby'       => 'count',
        'order'         => 'DESC',
    );

    //WooCommerce Product Category Object as Array
    $wptf_product_cat_object = get_terms('product_cat', $args);
?>


<div class="wptf_column">
    <label class="wptf_label" for="wptf_product_slugs"><?php echo sprintf( esc_html__('Category Includes %s (Click to choose Categories) %s','wptf_pro'),'<small>','</small>');?></label>
    <select name="basics[product_cat_ids][]" data-name="product_cat_ids" id="wptf_product_ids" class="wptf_fullwidth wptf_data_filed_atts" multiple>
        <?php
        foreach ( $wptf_product_cat_object as $category ) {
            echo "<option value='{$category->term_id}' " . ( isset( $meta_basics['product_cat_ids'] ) && is_array( $meta_basics['product_cat_ids'] ) && in_array( $category->term_id, $meta_basics['product_cat_ids'] ) ? 'selected' : false ) . ">{$category->name} - {$category->slug} ({$category->count})</option>";
        }
        ?>
    </select>
</div>


<div class="wptf_column wptf_disable_column">
    <label class="wptf_label"><?php esc_html_e( 'Product ID Include (Separate with comma)', 'wptf_pro' );?> <span style="color: #00B500;font-weight: normal;font-size: 80%; background-color: #ddd; padding: 0 5px;">New</span></label>
    <input name="basics[post_include]" data-name="post_include" value="<?php echo isset( $meta_basics['post_include'] ) ? $meta_basics['post_include'] : ''; ?>" class="wptf_data_filed_atts" type="text" placeholder="Example: 1,2,3,4">
    <p>To make table with specific product, Input product's ID - separate with comma.</p>
</div>
<div class="wptf_column">
    <label class="wptf_label"><?php esc_html_e( 'Product ID Exclude (Separate with comma)', 'wptf_pro' );?></label>
    <input name="basics[post_exclude]" data-name="post_exclude" value="<?php echo isset( $meta_basics['post_exclude'] ) ? $meta_basics['post_exclude'] : ''; ?>" class="wptf_data_filed_atts" type="text" placeholder="Example: 1,2,3,4">
</div>

<div class="wptf_column">
    <label class="wptf_label" for="wptf_product_slugs"><?php echo sprintf( esc_html__( 'Category Exclude %s (Click to choose Categories) %s', 'wptf_pro' ), '<small>', '</small>' );?></label>
    <select name="basics[cat_explude][]" data-name="cat_explude" id="wptf_product_ids" class="wptf_fullwidth wptf_data_filed_atts" multiple>
        <?php
        foreach ( $wptf_product_cat_object as $category ) {
            echo "<option value='{$category->term_id}' " . ( isset( $meta_basics['cat_explude'] ) && is_array( $meta_basics['cat_explude'] ) && in_array( $category->term_id, $meta_basics['cat_explude'] ) ? 'selected' : false ) . ">{$category->name} - {$category->slug} ({$category->count})</option>";
        }
        ?>
    </select>
</div>


<?php
    $wptf_product_ids_tag = false;
    /**
     * To Get Category List of WooCommerce
     * @since 1.0.0 -10
     */
    $args = array(
        'hide_empty' => true,
        'orderby' => 'count',
        'order' => 'DESC',
    );

    //WooCommerce Product Category Object as Array
    $wptf_product_tag_object = get_terms('product_tag', $args);
?>


<div class="wptf_column">
    <label class="wptf_label" for="product_tag_ids"><?php  echo sprintf( esc_html__( 'Tag Includes %s (Click to choose Tags) %s', 'wptf_pro' ), '<small>', '</small>' );?></label>
    <select name="basics[product_tag_ids][]" data-name="product_tag_ids" id="product_tag_ids" class="wptf_fullwidth wptf_data_filed_atts" multiple>
        <?php
        foreach ( $wptf_product_tag_object as $tags ) {
            echo "<option value='{$tags->term_id}' " . ( isset( $meta_basics['product_tag_ids'] ) && is_array( $meta_basics['product_tag_ids'] ) && in_array( $tags->term_id, $meta_basics['product_tag_ids'] ) ? 'selected' : false ) . ">{$tags->name} - {$tags->slug} ({$tags->count})</option>";
        }
        ?>
    </select>
</div>

<div class="wptf_column wptf_disable_column" style="border: 1px solid #5ccc7d;background: #ebffee;padding: 10px;">
    <label class="wptf_label wptf_table_ajax_action" for='wptf_table_minicart_position'><?php esc_html_e('Ajax Action (Enable/Disable)','wptf_pro');?></label>
    <select name="basics[ajax_action]" data-name='ajax_action' id="wptf_table_ajax_action" class="wptf_fullwidth wptf_data_filed_atts" >
        <option value="ajax_active" selected><?php esc_html_e('Active Ajax (Default)','wptf_pro');?></option>
        <option value="ajax_active" ><?php esc_html_e('Disable Ajax Action','wptf_pro');?></option>
    </select>
</div>


<div class="wptf_column wptf_disable_column">
    <label class="wptf_label" for='wptf_table_minicart_position'><?php esc_html_e( 'Mini Cart Position', 'wptf_pro' );?></label>
    <select name="basics[minicart_position]" data-name='minicart_position' id="wptf_table_minicart_position" class="wptf_fullwidth wptf_data_filed_atts" >
        <option value="top" <?php echo isset( $meta_basics['minicart_position'] ) && $meta_basics['minicart_position'] == 'top' ? 'selected' : false; ?>><?php esc_html_e( 'Top (Default)', 'wptf_pro' );?></option>
        <option value="bottom" <?php echo isset( $meta_basics['minicart_position'] ) && $meta_basics['minicart_position'] == 'bottom' ? 'selected' : false; ?>><?php esc_html_e( 'Bottom', 'wptf_pro');?></option>
        <option value="none" <?php echo isset( $meta_basics['minicart_position'] ) && $meta_basics['minicart_position'] == 'none' ? 'selected' : false; ?>><?php esc_html_e( 'None', 'wptf_pro' );?></option>
    </select>
</div>



<div class="wptf_column">
    <label class="wptf_label" for='wptf_table_table_class'><?php esc_html_e( 'Set a Class name for Table', 'wptf_pro' );?></label>
    <input name="basics[table_class]" value="<?php echo isset( $meta_basics['table_class'] ) ? $meta_basics['table_class'] : ''; ?>" class="wptf_data_filed_atts" data-name="table_class" type="text" placeholder="<?php esc_attr_e( 'Product Table Class Name (Optional)', 'wptf_pro' ); ?>" id='wptf_table_table_class'>
</div>

<div class="wptf_column">
    <label class="wptf_label" for='wptf_table_temp_number'><?php esc_html_e( 'Temporary Number for Table', 'wptf_pro' );?></label>
    <input name="basics[temp_number]" class="wptf_data_filed_atts readonly" data-name="temp_number" type="text" placeholder="123" id='wptf_table_temp_number' value="<?php echo isset( $meta_basics['temp_number'] ) ? $meta_basics['temp_number'] : random_int( 10, 300 ); ?>" readonly="readonly">
    <p><?php esc_html_e( 'This is not very important, But should different number for different shortcode of your table. Mainly to identify each table.', 'wptf_pro' );?></p>
</div>


<div class="wptf_column">
    <label class="wptf_label" for="wptf_table_add_to_cart_text"><?php esc_html_e( '(Add to cart) Text', 'wptf_pro' );?></label>
    <input name="basics[add_to_cart_text]" class="wptf_data_filed_atts" data-name="add_to_cart_text" type="text" value="<?php echo isset( $meta_basics['add_to_cart_text'] ) ? $meta_basics['add_to_cart_text'] : __( 'Add to cart', 'wptf_pro' ); ?>" placeholder="<?php esc_attr_e( 'Example: Buy', 'wptf_pro' ); ?>" id="wptf_table_add_to_cart_text">
    <p><?php echo sprintf( esc_html__( 'Put a Space (" ") for getting default %s Add to Cart Text %s', 'wptf_pro' ), '<b>', '</b>' );?></p>
</div>

<div class="wptf_column">
    <label class="wptf_label" for="wptf_table_add_to_cart_selected_text"><?php esc_html_e( '(Add to cart(Selected]) Text', 'wptf_pro' );?></label>
    <input name="basics[add_to_cart_selected_text]"  class="wptf_data_filed_atts" data-name="add_to_cart_selected_text" type="text" value="<?php echo isset( $meta_basics['add_to_cart_selected_text'] ) ? $meta_basics['add_to_cart_selected_text'] : __( 'Add to Cart (Selected)', 'wptf_pro' ); ?>" placeholder="<?php esc_attr_e( 'Example: Add to cart Selected', 'wptf_pro' ); ?>" id="wptf_table_add_to_cart_selected_text">
</div>

<div class="wptf_column">
    <label class="wptf_label" for="wptf_table_check_uncheck_text"><?php esc_html_e( '(All Check/Uncheck) Text', 'wptf_pro' );?></label>
    <input name="basics[check_uncheck_text]"  class="wptf_data_filed_atts" data-name="check_uncheck_text" type="text" value="<?php echo isset( $meta_basics['check_uncheck_text'] ) ? $meta_basics['check_uncheck_text'] : __( 'All Check/Uncheck','wptf_pro' ); ?>" placeholder="<?php esc_attr_e( 'Example: All Check/Uncheck', 'wptf_pro' );?>" id="wptf_table_check_uncheck_text">
</div>
<hr> 
<div class="wptf_column">
    <label class="wptf_label" for="wptf_table_author"><?php esc_html_e( 'AuthorID/UserID/VendorID (Optional)', 'wptf_pro' );?></label>
    <input name="basics[author]"  class="wptf_data_filed_atts" data-name="author" type="number" value="<?php echo isset( $meta_basics['author'] ) ? $meta_basics['author'] : ''; ?>" placeholder="Author ID/Vendor ID" id="wptf_table_author">
    <p style="color: #006394;"><?php esc_html_e( 'Only AuthorID or AuthorName field for both [AuthorID/UserID/VendorID] or [author_name/username/VendorUserName]. Don\'t use both.', 'wptf_pro' );?></p>
</div>
<div class="wptf_column">
    <label class="wptf_label" for="wptf_table_author_name"><?php esc_html_e( 'author_name/username/VendorUserName (Optional)', 'wptf_pro' );?></label>
    <input name="basics[author_name]"  class="wptf_data_filed_atts" data-name="author_name" type="text" value="<?php echo isset( $meta_basics['author_name'] ) ? $meta_basics['author_name'] : ''; ?>" placeholder="Author username/ Vendor username" id="wptf_table_author_name">
    <p style="color: #006394;"><?php esc_html_e( 'Only AuthorID or AuthorName field for both [AuthorID/UserID/VendorID] or [author_name/username/VendorUserName]. Don\'t use both.', 'wptf_pro' );?></p>
</div>
