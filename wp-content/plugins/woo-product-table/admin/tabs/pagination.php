<?php
$pagination =  get_post_meta( $post->ID, 'pagination', true );
?>
<div class="wptf_column wptf_disable_column">
    <label class="wptf_label" for="wptf_table_shorting"><?php esc_html_e( 'Pagination on/of', 'wptf_pro' ); ?></label>
    <select name="pagination[start]" data-name='sort' id="wptf_table_shorting" class="wptf_fullwidth wptf_data_filed_atts" >
        
        <option value="1" selected="selected"><?php esc_html_e( 'Enable (Default)', 'wptf_pro' ); ?></option>
        <option value="1"><?php esc_html_e( 'Disable', 'wptf_pro' ); ?></option>
    </select>
</div>
<b><?php esc_html_e( 'To chan  ge style, go to Design tab', 'wptf_pro' ); ?></b>