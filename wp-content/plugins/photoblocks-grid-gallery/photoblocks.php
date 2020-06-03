<?php

/**
 * Plugin Name:              Gallery PhotoBlocks
 * Description:              Build your unique photo gallery
 * Version:                  1.1.50
 * Author:                   MachoThemes
 * Author URI:               https://www.machothemes.com
 * Requires:                 4.9 or higher
 * License:                  GPLv3 or later
 * License URI:              http://www.gnu.org/licenses/gpl-3.0.html
 * Requires PHP:             5.6
 * Text Domain:             photoblocks
 * Domain Path:             /languages
 *
 * Copyright 2018-2019       GreenTreeLabs     diego@greentreelabs.net
 * Copyright 2019            MachoThemes       office@machothemes.com
 * SVN commit with proof of ownership transfer: https://plugins.trac.wordpress.org/changeset/2163480/photoblocks-grid-gallery
 *
 * NOTE: MachoThemes took ownership of this plugin on: 09/26/2019 08:45:57 AM AM as can be seen from the above SVN commit.
 *
 * Original Plugin URI:      https://photoblocks.greentreelabs.net/
 * Original Author URI:      https://greentreelabs.net
 * Original Author:          https://profiles.wordpress.org/greentreealbs/
 */
if ( !defined( "PHOTOBLOCKS_DIR" ) ) {
    define( "PHOTOBLOCKS_DIR", plugin_dir_path( __FILE__ ) );
}

if ( !function_exists( "photoblocks_starter" ) ) {
    function photoblocks_starter()
    {
        if ( !defined( 'PHOTOBLOCKS_V' ) ) {
            define( 'PHOTOBLOCKS_V', "1.1.49" );
        }
        // If this file is called directly, abort.
        if ( !defined( 'WPINC' ) ) {
            die;
        }
        // Create a helper function for easy SDK access.
        function photob_fs()
        {
            global  $photob_fs ;
            
            if ( !isset( $photob_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $photob_fs = fs_dynamic_init( array(
                    'id'             => '1673',
                    'slug'           => 'photoblocks-grid-gallery',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_7bce4a7ee9f50fe570544d6c087d0',
                    'is_premium'     => false,
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'trial'          => array(
                    'days'               => 14,
                    'is_require_payment' => true,
                ),
                    'menu'           => array(
                    'slug' => 'photoblocks',
                ),
                    'is_live'        => true,
                ) );
            }
            
            return $photob_fs;
        }
        
        // Init Freemius.
        photob_fs();
        // Signal that SDK was initiated.
        do_action( 'photob_fs_loaded' );
        define( "PHOTOBLOCKS_PLAN", "free" );
        $photoblocks_db_version = "1.0";
        require plugin_dir_path( __FILE__ ) . 'includes/class-photoblocks-utils.php';
        /**
         * The code that runs during plugin activation.
         * This action is documented in includes/class-photoblocks-activator.php
         */
        function activate_photoblocks()
        {
            require_once plugin_dir_path( __FILE__ ) . 'includes/class-photoblocks-activator.php';
            Photoblocks_Activator::activate();
        }
        
        register_activation_hook( __FILE__, 'activate_photoblocks' );
        /**
         * The core plugin class that is used to define internationalization,
         * admin-specific hooks, and public-facing site hooks.
         */
        require plugin_dir_path( __FILE__ ) . 'includes/class-photoblocks.php';
        /**
         * Begins execution of the plugin.
         *
         * Since everything within the plugin is registered via hooks,
         * then kicking off the plugin from this point in the file does
         * not affect the page life cycle.
         *
         * @since    1.0.0
         */
        function run_photoblocks()
        {
            $plugin = new Photoblocks();
            $plugin->run();
        }
        
        run_photoblocks();
    }
    
    photoblocks_starter();
}
