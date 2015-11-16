<?php
/**
 * This file contains a function which checks if the MP Menu plugin is installed.
 *
 * @since 1.0.0
 *
 * @package    MP Menu
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */
 
/**
* Check to make sure the MP Menu Plugin is installed.
*
* @since    1.0.0
* @link     http://mintplugins.com/doc/plugin-checker-class/
* @return   array $plugins An array of plugins to be installed. This is passed in through the mp_menu_check_plugins filter.
* @return   array $plugins An array of plugins to be installed. This is passed to the mp_menu_check_plugins filter. (see link).
*/
if (!function_exists('mp_menu_plugin_check')){
	function mp_menu_plugin_check( $plugins ) {
		
		$add_plugins = array(
			array(
				'plugin_name' => 'MP Menu',
				'plugin_message' => __('You require the MP Menu plugin. Install it here.', 'pastel_wedding_theme_bundle'), 
				'plugin_filename' => 'mp-menu.php',
				'plugin_download_link' => 'http://mintplugins.com/repo/mp-menu/?downloadfile=true',
				'plugin_info_link' => 'http://mintplugins.com/plugins/mp-menu',
				'plugin_group_install' => true,
				'plugin_required' => true,
			)
		);
		
		$return_array = array_merge( $plugins, $add_plugins );
		
		return $return_array;
	}
}
add_filter( 'mp_core_check_plugins', 'mp_menu_plugin_check' );