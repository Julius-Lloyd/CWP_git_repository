<?php
/**
 * Plugin Name: Woo Product Table
 * Plugin URI: https://wcproducttable.xyz/
 * Description: WooCommerce all products display as a table in one page by shortcode. Fully responsive and mobile friendly. Easily customizable - color,background,title,text color etc.
 * Author: CodeAstrology
 * Author URI: https://codecanyon.net/user/codeastrology
 * Tags: woocommerce product,woocommerce product table, product table, product list, product menu, Quick Order Table, Custom field table, Taxonomy table, table, wc product table, wc table, product table lite
 * 
 * Version: 2.6.1
 * Requires at least:    4.0.0
 * Tested up to:         5.3.2
 * WC requires at least: 3.0.0
 * WC tested up to: 	 3.9.1
 * 
 * Text Domain: wptf_pro
 * Domain Path: /languages/
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Defining constant
 */
define( 'WPT_FREE_PLUGIN_BASE_FOLDER', plugin_basename( dirname( __FILE__ ) ) );
define( 'WPT_FREE_PLUGIN_BASE_FILE', plugin_basename( __FILE__ ) );
define( "WPT_FREE_BASE_URL", plugins_url() . '/'. plugin_basename( dirname( __FILE__ ) ) . '/' );
define( "WPT_FREE_DIR_BASE", dirname( __FILE__ ) . '/' );
define( "WPT_FREE_BASE_DIR", str_replace( '\\', '/', WPT_FREE_DIR_BASE ) );

/**
 * Default Configuration for WOO Product Table Pro
 * 
 * @since 1.0.0 -5
 */
$shortCodeText = 'Product_Table';
/**
* Including Plugin file for security
* Include_once
* 
* @since 1.0.0
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
WPT_Product_Table::getInstance();

/**
 * @since 1.7
 */
WPT_Product_Table::$columns_array =  array(
    'product_id'    => __( 'ID', 'wptf_pro' ),
    'serial_number' => __( 'SL', 'wptf_pro' ),
    'thumbnails'    => __( 'Thumbnails', 'wptf_pro' ),
    'product_title' => __( 'Product Title', 'wptf_pro' ),
    //'description'   =>  __( 'Description', 'wptf_pro' ),
    'category'      => __( 'Category', 'wptf_pro' ),
    'tags'          => __( 'Tags', 'wptf_pro' ),
    'sku'           => __( 'SKU', 'wptf_pro' ),
    'weight'        => __( 'Weight(kg)', 'wptf_pro' ),
    'length'        => __( 'Length(cm)', 'wptf_pro' ),
    'width'         => __( 'Width(cm)', 'wptf_pro' ),
    'height'        => __( 'Height(cm)', 'wptf_pro' ),
    'rating'        => __( 'Rating', 'wptf_pro' ),
    'stock'         => __( 'Stock', 'wptf_pro' ),
    'price'         => __( 'Price', 'wptf_pro' ),
    'wishlist'      => __( 'Wish List', 'wptf_pro' ),
    'quantity'      => __( 'Quantity', 'wptf_pro' ),
    'total'         => __( 'Total Price', 'wptf_pro' ),
    'Message'       => __( 'Short Message', 'wptf_pro' ),
    'quick'         => __( 'Quick View', 'wptf_pro' ),
    'date'          =>  __( 'Date', 'wptf_pro' ),
    'modified_date' =>  __( 'Modified Date', 'wptf_pro' ),
    'attribute' =>  __( 'Attributes', 'wptf_pro' ),
    'variations' =>  __( 'Variations', 'wptf_pro' ),
    'action'        => __( 'Action', 'wptf_pro' ),
    'check'         => __( 'Check', 'wptf_pro' ),
    'quoterequest'  => __( 'Quote Request', 'wptf_pro' ),
);

/**
 * @since 1.7
 */
WPT_Product_Table::$colums_disable_array = array(
    'product_id',
    'serial_number',
    //'description',
    'tags',
    'weight',
    'length',
    'width',
    'height',
    'total',
    'quick',
    'date',
    'modified_date',
    'wishlist',
    'quoterequest',
    'attribute',
    'variations',
    'Message',
);

//Set Style Selection Options.
WPT_Product_Table::$style_form_options = array(
    'custom'       =>  __( 'Customized Design', 'wptf_pro' ),
//    'default'       =>  __( 'Default Style', 'wptf_pro' ),
//    'blacky'        =>  __( 'Beautifull Blacky', 'wptf_pro' ),
//    'smart'         =>  __( 'Smart Thin', 'wptf_pro' ),
//    'none'          =>  __( 'Select None', 'wptf_pro' ),
//    'green'         =>  __( 'Green Style', 'wptf_pro' ),
//    'blue'          =>  __( 'Blue Style', 'wptf_pro' ),
);
/**
 * Set ShortCode text as Static Properties
 * 
 * @since 1.0.0 -5
 */
WPT_Product_Table::$shortCode = $shortCodeText;

/**
 * Set Default Value For Every where, 
 * 
 * @since 1.9
 */
WPT_Product_Table::$default = array(
    'custom_message_on_single_page'=>  true, //Set true to get form in Single Product page for Custom Message
    'footer_cart'           =>  'always_show', //hide_for_zerro
    'footer_cart_size'           =>  '74',
    'footer_bg_color'           =>  '#0a7f9c',
    'footer_possition'           =>  'footer_possition',
    'sort_mini_filter'      =>  'ASC',
    'sort_searchbox_filter' =>  'ASC',
    'custom_add_to_cart'    =>  'add_cart_left_icon',
    'thumbs_image_size'     =>  60,
    'thumbs_lightbox'       => '1',
    'popup_notice'          => '1',
    'disable_product_link'  =>  '0',
    'disable_cat_tag_link'  =>  '0',
    'product_link_target'   =>  '_blank',
    'product_not_founded'   =>  __( 'Products Not founded!', 'wptf_pro' ),
    'load_more_text'        =>  __( 'Load more', 'wptf_pro' ),
    'quick_view_btn_text'   =>  __( 'Quick View', 'wptf_pro' ), 
    'loading_more_text'     =>  __( 'Loading..', 'wptf_pro' ),
    'search_button_text'    =>  __( 'Search', 'wptf_pro' ),
    'search_keyword_text'   =>  __( 'Search Keyword', 'wptf_pro' ),
    'disable_loading_more'  =>  'normal',//Load More //load_more_hidden
    'instant_search_filter' =>  '0',
    'filter_text'           =>  __( 'Filter:', 'wptf_pro' ),
    'filter_reset_button'   =>  __( 'Reset', 'wptf_pro' ),
    'instant_search_text'   =>  __( 'Instant Search..', 'wptf_pro' ),
    'yith_browse_list'      =>  __( 'Browse the list', 'wptf_pro' ),
    'yith_add_to_quote_text'=>  __( 'Add to Quote', 'wptf_pro' ),
    'yith_add_to_quote_adding'=>  __( 'Adding..', 'wptf_pro' ),
    'yith_add_to_quote_added' =>  __( 'Quoted', 'wptf_pro' ),
    'item'                  =>  __( 'Item', 'wptf_pro' ), //It will use at custom.js file for Chinging
    'items'                 =>  __( 'Items', 'wptf_pro' ), //It will use at custom.js file for Chinging
    'add2cart_all_added_text'=>  __( 'Added', 'wptf_pro' ), //It will use at custom.js file for Chinging
    'right_combination_message' => __( 'Not available', 'wptf_pro' ),
    'right_combination_message_alt' => __( 'Product variations is not set Properly. May be: price is not inputted. may be: Out of Stock.', 'wptf_pro' ),
    'no_more_query_message' => __( 'There is no more products based on current Query.', 'wptf_pro' ),
    'select_all_items_message' => __( 'Please select all items.', 'wptf_pro' ),
    'out_of_stock_message'  => __( 'Out of Stock', 'wptf_pro' ),
    'adding_in_progress'    =>  __( 'Adding in Progress', 'wptf_pro' ),
    'no_right_combination'  =>  __( 'No Right Combination', 'wptf_pro' ),
    'sorry_out_of_stock'    =>  __( 'Sorry! Out of Stock!', 'wptf_pro' ),
    'type_your_message'     =>  __( 'Type your Message.', 'wptf_pro' ),
    'sorry_plz_right_combination' =>    __( 'Sorry, Please choose right combination.', 'wptf_pro' ),
    
    'all_selected_direct_checkout' => 'no',
    'product_direct_checkout' => 'no',
    
    //Added Search Box Features @Since 3.3
    'search_box_title' => sprintf( __( 'Search Box (%sAll Fields Optional%s)', 'wptf_pro' ),'<small>', '</small>'),
    'search_box_searchkeyword' => __( 'Search Keyword', 'wptf_pro' ),
    'search_box_orderby'    => __( 'Order By', 'wptf_pro' ),
    'search_box_order'      => __( 'Order', 'wptf_pro' ),
    //For Default Table's Content
    'table_in_stock'        =>  __( 'In Stock', 'wptf_pro' ),//'In Stock',
    'table_out_of_stock'    =>  __( 'Out of Stock', 'wptf_pro' ),//'Out of Stock',
    'table_on_back_order'   =>  __( 'On Back Order', 'wptf_pro' ),//'On Back Order',
 
    
);

/**
 * Main Manager Class for WOO Product Table Plugin.
 * All Important file included here.
 * Set Path and Constant also set WPT_Product_Table Class
 * Already set $_instance, So no need again call
 */
class WPT_Product_Table{
    
    /**
     * To set Default Value for Woo Product Table, So that, we can set Default Value in Plugin Start and 
     * can get Any were
     *
     * @var Array 
     */
    public static $default = array();
    
    /*
     * List of Path
     * 
     * @since 1.0.0
     * @var array
     */
    protected $paths = array();
    
    /**
     * Set like Constant static array
     * Get this by getPath() method
     * Set this by setConstant() method
     *  
     * @var type array
     */
    private static $constant = array();
    
    /**
     * Property for Shortcode Stroring
     *
     * @var String 
     */
    public static $shortCode;
    
    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     *
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '5.6';
    
    /**
     * Only for Admin Section, Collumn Array
     * 
     * @since 1.7
     * @var Array
     */
    public static $columns_array = array();

    
    /**
     * Only for Admin Section, Disable Collumn Array
     * 
     * @since 1.7
     * @var Array
     */
    public static $colums_disable_array = array();

    /**
     * Set Array for Style Form Section Options
     *
     * @var type 
     */
    public static $style_form_options = array();
    
    /**
    * Core singleton class
    * @var self - pattern realization
    */
   private static $_instance;
   
   /**
    * Set Plugin Mode as 1 for Giving Data to UPdate Options
    *
    * @var type Int
    */
   protected static $mode = 1;
   
    /**
    * Get the instane of WPT_Product_Table
    *
    * @return self
    */
   public static function getInstance() {
           if ( ! ( self::$_instance instanceof self ) ) {
                   self::$_instance = new self();
           }

           return self::$_instance;
   }
   
   
   public function __construct() {
        //Condition and check php verion and WooCommerce activation
        if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }
        
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
                return;
        }
        
       $dir = dirname( __FILE__ ); //dirname( __FILE__ )
       
       /**
        * See $path_args for Set Path and set Constant
        * 
        * @since 1.0.0
        */
       $path_args = array(
           'PLUGIN_BASE_FOLDER' =>  plugin_basename( $dir ),
           'PLUGIN_BASE_FILE' =>  plugin_basename( __FILE__ ),
           'BASE_URL' =>  plugins_url() . '/'. plugin_basename( $dir ) . '/', //using plugins_url() instead of WP_PLUGIN_URL
           'BASE_DIR' =>  str_replace( '\\', '/', $dir . '/' ),
       );
       /**
        * Set Path Full with Constant as Array
        * 
        * @since 1.0.0
        */
       $this->setPath($path_args);

       /**
        * Set Constant
        * 
        * @since 1.0.0
        */
       $this->setConstant($path_args);
        if( !class_exists( 'WOO_Product_Table' ) ):
        //Load File
            if( is_admin() ){
                 require_once $this->path('BASE_DIR','admin/wptf_product_table_post.php');
                 require_once $this->path('BASE_DIR','admin/post_metabox.php');
                 require_once $this->path('BASE_DIR','admin/duplicate.php');
                 //Notice Handle
                 require_once $this->path('BASE_DIR','Notice/handle.php');

                 require_once $this->path('BASE_DIR','admin/menu_plugin_setting_link.php');
                 require_once $this->path('BASE_DIR','admin/style_js_adding_admin.php');
                 require_once $this->path('BASE_DIR','admin/fac_support_page.php');
                 require_once $this->path('BASE_DIR','admin/configuration_page.php');
            }

        require_once $this->path('BASE_DIR','includes/style_js_adding.php');
        require_once $this->path('BASE_DIR','includes/functions.php');
        require_once $this->path('BASE_DIR','includes/ajax_add_to_cart.php'); 
        require_once $this->path('BASE_DIR','includes/shortcode.php');

        endif;
   }
   
   /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin() {

           if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

           $message = sprintf(
                   /* translators: 1: Plugin name 2: Elementor */
                   esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'wpt_pro' ),
                   '<strong>' . esc_html__( 'Woo Product Table', 'wpt_pro' ) . '</strong>',
                   '<strong><a href="' . esc_url( 'https://wordpress.org/plugins/woocommerce/' ) . '" target="_blank">' . esc_html__( 'WooCommerce', 'wpt_pro' ) . '</a></strong>'
           );

           printf( '<div class="notice notice-error is-dismissible"><p>%1$s</p></div>', $message );

    }



    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_php_version() {

           if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

           $message = sprintf(
                   /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
                   esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wpt_pro' ),
                   '<strong>' . esc_html__( 'Woo Product Table', 'wpt_pro' ) . '</strong>',
                   '<strong>' . esc_html__( 'PHP', 'wpt_pro' ) . '</strong>',
                    self::MINIMUM_PHP_VERSION
           );

           printf( '<div class="notice notice-error is-dismissible"><p>%1$s</p></div>', $message );

    }
   
   /**
    * Set Path
    * 
    * @param type $path_array
    * 
    * @since 1.0.0
    */
   public function setPath( $path_array ) {
       $this->paths = $path_array;
   }
   
   private function setConstant( $contanst_array ) {
       self::$constant = $this->paths;
   }
   /**
    * Set Path as like Constant Will Return Full Path
    * Name should like Constant and full Capitalize
    * 
    * @param type $name
    * @return string
    */
   public function path( $name, $_complete_full_file_path = false ) {
       $path = $this->paths[$name] . $_complete_full_file_path;
       return $path;
   }
   
   /**
    * To Get Full path to Anywhere based on Constant
    * 
    * @param type $constant_name
    * @return type String
    */
   public static function getPath( $constant_name = false ) {
       $path = self::$constant[$constant_name];
       return $path;
   }
   /**
    * Update Options when Installing
    * This method has update at Version 3.6
    * 
    * @since 1.0.0
    * @updated since 3.6_29.10.2018 d/m/y
    */
   public static function install() {
       ob_start();
       //check current value
       $current_value = get_option('wptf_configure_options');
       $default_value = self::$default;
       $default_value['plugin_name'] = self::getName();
       $default_value['plugin_version'] =  self::getVersion();
       $changed_value = false;
       //Set default value in Options
       if($current_value){
           foreach( $default_value as $key=>$value ){
              if( isset($current_value[$key]) && $key != 'plugin_version' ){
                 $changed_value[$key] = $current_value[$key];
              }else{
                  $changed_value[$key] = $value;
              }
           }
           update_option( 'wptf_configure_options', $changed_value );
       }else{
           update_option( 'wptf_configure_options', $default_value );
       }
       
   }
   
   /**
    * Plugin Uninsall Activation Hook 
    * Static Method
    * 
    * @since 1.0.0
    */
   public function uninstall() {
       //Nothing for now
   }
   
   /**
    * Getting full Plugin data. We have used __FILE__ for the main plugin file.
    * 
    * @since V 1.5
    * @return Array Returnning Array of full Plugin's data for This Woo Product Table plugin
    */
   public static function getPluginData(){
       return get_plugin_data( __FILE__ );
   }
   
   /**
    * Getting Version by this Function/Method
    * 
    * @return type static String
    */
   public static function getVersion() {
       $data = self::getPluginData();
       return $data['Version'];
   }
   
   /**
    * Getting Version by this Function/Method
    * 
    * @return type static String
    */
   public static function getName() {
       $data = self::getPluginData();
       return $data['Name'];
   }
   public static function getDefault( $indexKey = false ){
       $default = self::$default;
       if( $indexKey && isset( $default[$indexKey] ) ){
           return $default[$indexKey];
       }
       return $default;
   }

}

/**
* Plugin Install and Uninstall
*/
register_activation_hook(__FILE__, array( 'WPT_Product_Table','install' ) );
register_deactivation_hook( __FILE__, array( 'WPT_Product_Table','uninstall' ) );
