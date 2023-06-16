<?php
/**
 *
 * Plugin Name:       AutoGrid
 * Plugin URI:        https://www.auto-grid.com/
 * Description:       Custom plugin for AutoGrid - Feature Post.
 * Version:           1.0.0
 * Author:            AutoGrid
 * Author URI:        https://www.auto-grid.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       autogrid
 * Domain Path:       /languages
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Define plugin version.
if ( ! defined( 'AUTOGRID_VERSION' ) ) {
	define( 'AUTOGRID_VERSION', '1.0.0' );
}

// Define plugin dir path.
if ( ! defined( 'AUTOGRID_PATH' ) ) {
	define( 'AUTOGRID_PATH', plugin_dir_path( __FILE__ ) );
}

// Define plugin dir url.
if ( ! defined( 'AUTOGRID_PLUGIN_URL' ) ) {
	define( 'AUTOGRID_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// Define plugin menu slug.
if ( ! defined( 'AUTOGRID_MENU_SLUG' ) ) {
	define('AUTOGRID_MENU_SLUG', 'autogrid');
}

// Define plugin basename.
if ( ! defined( 'AUTOGRID_PLUGIN_BASENAME' ) ) {
	define('AUTOGRID_PLUGIN_BASENAME', plugin_basename( __FILE__ ));
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-autogrid-main.php';

register_activation_hook( __FILE__, 'activate_autogrid' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/activator.php
 */
function activate_autogrid() {
	require_once ('includes/activator.php');
	Autogrid_Activator::activate();
}

register_deactivation_hook( __FILE__, 'deactivate_autogrid' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/deactivator.php
 */
function deactivate_autogrid() {
	require_once ('includes/deactivator.php');
    Autogrid_Deactivator::deactivate();
}

/**
 * Begins execution of the plugin.
 * 
 * @since    1.0.0
 */
function init_autogrid_plugin() {
	autogrid::get_instance();
}

add_action( 'plugins_loaded', 'init_autogrid_plugin', apply_filters( 'autogrid_action_priority', 10 ) );
