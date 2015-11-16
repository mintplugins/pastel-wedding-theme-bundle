<?php
/**
 * This file contains a function which checks if the Smooth Scroll Up plugin is installed.
 *
 * @since 1.0.0
 *
 * @package    MP Smooth Scroll Up Check
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2015, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */
 
/**
* Check to make sure the MP Smooth Scroll Up is installed.
*
* @since    1.0.0
* @link     http://mintplugins.com/doc/plugin-checker-class/
* @return   array $plugins An array of plugins to be installed. This is passed in through the mp_core_check_plugins filter.
* @return   array $plugins An array of plugins to be installed. This is passed to the mp_core_check_plugins filter. (see link).
*/
if (!function_exists('mp_smooth_scroll_up_plugin_check')){
	function mp_smooth_scroll_up_plugin_check( $plugins ) {
				
		$add_plugins = array(
			array(
				'plugin_name' => 'MP Smooth Scroll Up',
				'plugin_message' => __('You require the Smooth Scroll Up plugin. Install it here.', 'pastel_wedding_theme_bundle'),
				'plugin_filename' => 'mp-smooth-scroll-up.php',
				'plugin_download_link' => 'http://mintplugins.com/repo/mp-smooth-scroll-up/?downloadfile=true',
				'plugin_api_url' => 'http://mintplugins.com/',
				'plugin_info_link' => 'https://wordpress.org/plugins/smooth-scroll-up/',
				'plugin_group_install' => true,
				'plugin_licensed' => false,
				'plugin_required' => true,
				'plugin_wp_repo' => false,
			)
		);
		
		return array_merge( $plugins, $add_plugins );
	}
}
add_filter( 'mp_core_check_plugins', 'mp_smooth_scroll_up_plugin_check' );