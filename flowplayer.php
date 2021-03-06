<?php
/**
 *
 * @package   Flowplayer 5 for WordPress
 * @author    Ulrich Pogson <ulrich@pogson.ch>
 * @license   GPL-2.0+
 * @link      http://flowplayer.org/
 * @copyright 2013 Flowplayer Ltd
 *
 * @wordpress-plugin
 * Plugin Name: Flowplayer 5 for WordPress
 * Plugin URI:  http://wordpress.org/plugins/flowplayer5/
 * Description: A HTML5 responsive video player plugin. From the makers of Flowplayer. Supports all three default Flowplayer skins, subtitles, tracking with Google Analytics, splash images. You can use your own watermark logo if you own a Commercial Flowplayer license.
 * Version:     1.1.0
 * Author:      Flowplayer ltd. Anssi Piirainen, Ulrich Pogson
 * Author URI:  http://flowplayer.org/
 * Text Domain: flowplayer5
 * Domain Path: /lang
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $fp5_options;

// Plugin Root File
if ( ! defined( 'FP5_PLUGIN_FILE' ) )
	define( 'FP5_PLUGIN_FILE', __FILE__ );

require_once( plugin_dir_path( __FILE__ ) . 'includes/class-flowplayer.php' );
require_once( plugin_dir_path( __FILE__ ) . 'admin/register-settings.php' );
$fp5_options = fp5_get_settings();

if( is_admin() ) {
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-flowplayer-admin.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-flowplayer-meta-box.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'admin/insert-video-button.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-flowplayer-drive.php' );
} else {
	require_once( plugin_dir_path( __FILE__ ) . 'frontend/class-flowplayer-frontend.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'frontend/shortcode.php' );
}

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( __FILE__, array( 'Flowplayer5', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Flowplayer5', 'deactivate' ) );

Flowplayer5::get_instance();
if( is_admin() ) {
	Flowplayer5_Admin::get_instance();
	Video_Meta_Box::get_instance();
	Flowplayer_Drive::get_instance();
} else {
	Flowplayer5_Frontend::get_instance();
}