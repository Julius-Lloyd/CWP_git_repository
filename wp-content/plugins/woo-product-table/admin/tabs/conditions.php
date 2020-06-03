<?php
$meta_conditions =  get_post_meta( $post->ID, 'conditions', true );
?>
<div class="wptf_column">
    <label class="wptf_label" for="wptf_table_shorting"><?php esc_html_e( 'Sorting/Order', 'wptf_pro' ); ?></label>
    <select name="conditions[sort]" data-name='sort' id="wptf_table_shorting" class="wptf_fullwidth wptf_data_filed_atts" >
        
        <option value="ASC" <?php echo isset( $meta_conditions['sort'] ) && $meta_conditions['sort'] == 'ASC' ? 'selected' : ''; ?>><?php esc_html_e( 'ASCENDING (Default)', 'wptf_pro' ); ?></option>
        <option value="DESC" <?php echo isset( $meta_conditions['sort'] ) && $meta_conditions['sort'] == 'DESC' ? 'selected' : ''; ?>><?php esc_html_e( 'DESCENDING', 'wptf_pro' ); ?></option>
        <option value="random" <?php echo isset( $meta_conditions['sort'] ) && $meta_conditions['sort'] == 'random' ? 'selected' : ''; ?>><?php esc_html_e( 'Random', 'wptf_pro' ); ?></option>
    </select>
</div>


<div class="wptf_column">
    <label class="wptf_label" for="wptf_table_sort_order_by"><?php esc_html_e( 'Order By', 'wptf_pro' ); ?></label>
    <select name="conditions[sort_order_by]" data-name='sort_order_by' id="wptf_table_sort_order_by" class="wptf_fullwidth wptf_data_filed_atts" >
        <option value="name" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'name' ? 'selected' : ''; ?>><?php esc_html_e( 'Name (Default)', 'wptf_pro' ); ?></option>
        <option value="menu_order" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'menu_order' ? 'selected' : ''; ?>><?php esc_html_e( 'Menu Order', 'wptf_pro' ); ?></option> <!-- default menu_order -->
        
        <option value="meta_value" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'meta_value' ? 'selected' : ''; ?>><?php esc_html_e( 'Custom Meta Value', 'wptf_pro' ); ?></option>
        <option value="meta_value_num" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'meta_value_num' ? 'selected' : ''; ?>><?php esc_html_e( 'Custom Meta Number (if numeric data)', 'wptf_pro' ); ?></option>
        <option value="date" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'date' ? 'selected' : ''; ?>><?php esc_html_e( 'Date', 'wptf_pro' ); ?></option>
        
        <option value="ID" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'ID' ? 'selected' : ''; ?>><?php esc_html_e( 'ID', 'wptf_pro' ); ?></option>
        <option value="author" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'author' ? 'selected' : ''; ?>><?php esc_html_e( 'Author', 'wptf_pro' ); ?></option>
        <option value="title" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'title' ? 'selected' : ''; ?>><?php esc_html_e( 'Product Title', 'wptf_pro' ); ?></option>
        
        <option value="type" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'type' ? 'selected' : ''; ?>><?php esc_html_e( 'Type', 'wptf_pro' ); ?></option>
        
        <option value="modified" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'modified' ? 'selected' : ''; ?>><?php esc_html_e( 'Modified', 'wptf_pro' ); ?></option>
        <option value="parent" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'parent' ? 'selected' : ''; ?>><?php esc_html_e( 'Parent', 'wptf_pro' ); ?></option>
        <option value="rand" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'rand' ? 'selected' : ''; ?>><?php esc_html_e( 'Rand', 'wptf_pro' ); ?></option>
        <option value="comment_count" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'comment_count' ? 'selected' : ''; ?>><?php esc_html_e( 'Reviews/Comment Count', 'wptf_pro' ); ?></option>
        <option value="relevance" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'relevance' ? 'selected' : ''; ?>><?php esc_html_e( 'Relevance', 'wptf_pro' ); ?></option> 
        <option value="none" <?php echo isset( $meta_conditions['sort_order_by'] ) && $meta_conditions['sort_order_by'] == 'none' ? 'selected' : ''; ?>><?php esc_html_e( 'None', 'wptf_pro' ); ?></option>
    </select>
    <p>Chose 'Custom_meta or custom_meta_value' - if you want to sort by price, model, sku, color itc. <b>For price or any number, Please chose <span>Custom Meta value(if number)</span></b></p>
</div>
<div style="display: none;" class="wptf_column wptf_disable_column" id="wptf_meta_value_wrapper">
    <label class="wptf_label" for="wptf_product_meta_value_sort"><?php echo sprintf( esc_html__( 'Meta Value for [Custom Meta Value] of %s Custom Meta Value %s', 'wptf_pro' ),'<b>','</b>' ); ?></label>
    <input name="conditions[meta_value_sort]" value="<?php echo isset( $meta_conditions['meta_value_sort'] ) ? $meta_conditions['meta_value_sort'] : ''; ?>" data-name='meta_value_sort' id="wptf_product_meta_value_sort" class="wptf_fullwidth wptf_data_filed_atts" type="text">
    <p style="color: #00aef0;"><?php esc_html_e( 'Type your Right meta value here. EG: "_sku,_price,_customNumber" - use any one only, there should now and space', 'wptf_pro' ); ?></p>
</div>



<div class="wptf_column wptf_disable_column">
    <label class="wptf_label" for="wptf_product_min_price"><?php esc_html_e( 'Set Minimum Price', 'wptf_pro' ); ?></label>
    <input name="conditions[min_price]" data-name='min_price' value="<?php echo isset( $meta_conditions['min_price'] ) ?$meta_conditions['min_price'] : ''; ?>" id="wptf_product_min_price" class="wptf_fullwidth wptf_data_filed_atts" type="number" pattern="[0-9]*">
</div>
<div class="wptf_column wptf_disable_column">
    <label class="wptf_label" for="wptf_product_max_price"><?php esc_html_e( 'Set Maximum Price', 'wptf_pro' ); ?></label>
    <input name="conditions[max_price]" data-name='max_price' value="<?php echo isset( $meta_conditions['max_price'] ) ?$meta_conditions['max_price'] : ''; ?>" id="wptf_product_max_price" class="wptf_fullwidth wptf_data_filed_atts" type="number" pattern="[0-9]*">
</div>
<div class="wptf_column">
    <label class="wptf_label" for="wptf_table_description_type"><?php esc_html_e( 'Description Type', 'wptf_pro' ); ?></label>
    <select name="conditions[description_type]" data-name='description_type' id="wptf_table_description_type" class="wptf_fullwidth wptf_data_filed_atts" >
        <option value="short_description" <?php echo isset( $meta_conditions['description_type'] ) && $meta_conditions['description_type'] == 'short_description' ? 'selected' : ''; ?>><?php esc_html_e( 'Short Description', 'wptf_pro' ); ?></option><!-- Default Value -->
        <option value="description" <?php echo isset( $meta_conditions['description_type'] ) && $meta_conditions['description_type'] == 'description' ? 'selected' : ''; ?>><?php esc_html_e( 'Long Description', 'wptf_pro' ); ?></option>
    </select>
    <p style="color: #0087be;"><?php echo sprintf( esc_html__( 'Here was %sdescription_lenght%s, But from 3.6, We have removed %sdescription_lenght%s', 'wptf_pro' ),'<b>','</b>','<b>','</b>' ); ?>.</p>
</div>

<div class="wptf_column wptf_disable_column">
    <label class="wptf_label" for="wptf_table_only_stock"><?php esc_html_e( 'Only Stock Product', 'wptf_pro' ); ?></label>
    <select name="conditions[only_stock]" data-name='only_stock' id="wptf_table_only_stock" class="wptf_fullwidth wptf_data_filed_atts" >
        <option value="no" selected="selected"><?php esc_html_e( 'All Product', 'wptf_pro' ); ?></option>
        <option value="no"><?php esc_html_e( 'Yes (Only Stock)', 'wptf_pro' ); ?></option>
    </select>
</div>


<div class="wptf_column">
    <label class="wptf_label" for="wptf_posts_per_page"><?php esc_html_e( 'Post Limit/Per Load Limit', 'wptf_pro' ); ?></label>
    <input name="conditions[posts_per_page]" data-name='posts_per_page' value="<?php echo isset( $meta_conditions['posts_per_page'] ) ?$meta_conditions['posts_per_page'] : '20'; ?>" id="wptf_posts_per_page" class="wptf_fullwidth wptf_data_filed_atts" type="number" pattern="[0-9]*" placeholder="<?php esc_attr_e( 'Eg: 50 (for display 20 products', 'wptf_pro' ); ?>" value="20">
</div>