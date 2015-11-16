<?php
/**
 * This file contains a function which checks if the MP Stacks + Image Forms plugin is installed.
 *
 * @since 1.0.0
 *
 * @package    MP Core + Forms
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */
 
/**
* Check to make sure the MP Stacks + Image Forms Plugin is installed.
*
* @since    1.0.0
* @link     http://mintplugins.com/doc/plugin-checker-class/
* @return   array $plugins An array of plugins to be installed. This is passed in through the mp_core_check_plugins filter.
* @return   array $plugins An array of plugins to be installed. This is passed to the mp_core_check_plugins filter. (see link).
*/
if (!function_exists('mp_stacks_forms_plugin_check')){
	function mp_stacks_forms_plugin_check( $plugins ) {
		
		$add_plugins = array(
			array(
				'plugin_name' => 'MP Stacks + Forms',
				'plugin_message' => __('You require the MP Stacks + Forms plugin. Install it here.', 'mp_stacks_forms'),
				'plugin_filename' => 'mp-stacks-forms.php',
				'plugin_download_link' => 'http://mintplugins.com/repo/mp-stacks-forms/?downloadfile=true',
				'plugin_api_url' => 'https://mintplugins.com/',
				'plugin_info_link' => 'http://mintplugins.com/plugins/mp-stacks-forms',
				'plugin_group_install' => true,
				'plugin_licensed' => false,
				'plugin_licensed_parent_name' => 'Pastel Wedding Theme Bundle',
				'plugin_required' => true,
				'plugin_wp_repo' => false,
			)
		);
		
		return array_merge( $plugins, $add_plugins );
	}
}
add_filter( 'mp_core_check_plugins', 'mp_stacks_forms_plugin_check' );