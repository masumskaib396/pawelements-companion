<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://pawelements.com
 * @since             1.0.0
 * @package           Pawelements
 *
 * @wordpress-plugin
 * Plugin Name:       Pawelements-companion
 * Plugin URI:        https://pawelements.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Pawelements
 * Author URI:        https://pawelements.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pawelements
 * Domain Path:       /languages
 */


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/*
Constants
------------------------------------------ */

/* Set plugin version constant. */
define( 'PAWELEMENTS_VERSION', '0.1');

/* Set constant path to the plugin directory. */
define( 'PAWELEMENTS_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

// Plugin Addons Folder Path
define( 'PAWELEMENTS_ADDONS_DIR', plugin_dir_path( __FILE__ ) . 'widget/' );

// Assets Folder URL
define( 'PAWELEMENTS_ASSETS_PUBLIC', plugins_url( 'assets/public/', __FILE__ ) );
define( 'PAWELEMENTS_ASSETS_ADMIN', plugins_url( 'assets/admin/', __FILE__ ) );
define( 'PAWELEMENTS_ASSETS_VENDOR', plugins_url( 'assets/vendor/', __FILE__ ) );


require_once(PAWELEMENTS_PATH. 'base.php' );
require_once(PAWELEMENTS_PATH. '/inc/helper-functions.php' );