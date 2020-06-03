<?php

/**
 * Faq and contact us page
 * 
 * @since 4.25
 */
function wptf_fac_support_page(){
?>
<div class="wrap wptf_wrap wptf_configure_page">
        <h2 class="plugin_name"><?php esc_html_e( 'Contact & Support', 'wptf_pro' );?></h2>
        <div id="wptf_configuration_form" class="wptf_leftside">
            
            
            <div style="text-align:center;" class="fieldwrap wptf_result_footer">
                
                <img style="margin: 13px auto;max-width: 100%;" src="<?php echo WPT_FREE_BASE_URL; ?>images/cover_image.jpg">
                <hr>
                <div class="wptf_faq_support_link_collection">
                    <a href="https://codecanyon.net/user/codeastrology/portfolio" target="_blank"><?php esc_html_e( 'CodeAstrology Portfolios', 'wptf_pro' );?></a>
                    <a href="https://codecanyon.net/user/codeastrology" target="_blank"><?php esc_html_e( 'CodeAstrology Profile', 'wptf_pro' );?></a>
                    <a href="https://codeastrology.com/support/" target="_blank"><?php esc_html_e( 'CodeAstrology Support', 'wptf_pro' );?></a>
                    <a href="https://codeastrology.com" target="_blank"><?php esc_html_e( 'CodeAstrology.com', 'wptf_pro' );?></a>

                </div>
                <a href="mailto:codersaiful@gmail.com"><?php esc_html_e( 'We are Freelancer', 'wptf_pro' );?></a>
                <br style="clear: both;">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/ZloiY3NRmW8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></iframe>
                <div>
                    <h3><?php esc_html_e( 'More Video Tutorial', 'wptf_pro' );?></h3>
                    <a href="https://youtu.be/Jl3gTcOOhRQ"><?php esc_html_e( 'Custom Design Of Woo Product Table Pro', 'wptf_pro' );?></a><br>
                    <a href="https://youtu.be/aOzzYBr2Rug"><?php esc_html_e( 'Custom Field Support In WooCommerce Product Table', 'wptf_pro' );?></a><br>
                    <a href="https://youtu.be/w2vZSIzAJFo"><?php esc_html_e( 'Custom Taxnomoy Support In WooCommerce Product Table Pro', 'wptf_pro' );?></a><br>
                    <a href="https://youtu.be/D_hl2UtVTCw"><?php esc_html_e( 'How to use Woo Product Table Pro - Basic to Advance', 'wptf_pro' );?></a><br><br>
                </div>
                <br style="clear: both;">
            </div>
            <!-- </form> -->

            <br style="clear: both;">
        </div>
        <!-- Right Side start here -->
        <?php include __DIR__ . '/includes/right_side.php'; ?> 
        
</div>
<style>
.wptf_leftside,.wptf_rightside{float: left;min-height: 500px;}
.wptf_leftside{
    width: 65%;
}
.wptf_rightside{width: 32%; margin-top: -42px;}
.wptf_faq_support_link_collection a {
    text-decoration: none;
    background: #2a3950;
    padding: 3px 6px;
    cursor: pointer;
    display: inline-block;
    color: #a3d5e0;
    border-radius: 5px;
    transition: all 1s;
    margin: 1px;
}
.wptf_faq_support_link_collection a:hover {
    background: #a3d5e0;
    padding: 3px 8px;
    color: #2a3950;
    border-radius: 8px;
}
@media only screen and (max-width: 800px){
    .wptf_leftside.wptf_rightside{float: none !important;width: 100%;}
}


    </style>
<?php
}