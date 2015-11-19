<?php
/**
 * Custom Installation Functions for the Pastel Wedding Theme Bundle. Make custom changes for installation here.
 *
 * Find and replace: PASTEL_WEDDING
 * Find and replace: Pastel Wedding Theme Bundle
 * Find and replace: pastel_wedding_theme_bundle
 * Find and replace: pastel-wedding-theme-bundle
 * Find and replace: landscape
 * Find and replace: Pastel Wedding
 * 
 * @link http://mintplugins.com/doc/
 * @since 1.0.0
 *
 * @package     MP Stacks + Pastel Wedding
 * @subpackage  Functions
 *
 * @copyright   Copyright (c) 2015, Mint Plugins
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author      Philip Johnston
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Returns the array of the custom theme mods for this theme. As a developer, you can get this array under "Appearance" > "Export Customizer" with the MP Stacks + Developer Add-On.
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      function_name()
 * @param    void
 * @return   array
 */
function pastel_wedding_theme_bundle_theme_mods(){
			
	return array ( 
		0 => false, 
		'mp_knapstack_button_submit' => '#62c5b2', 
		'mp_knapstack_button_hover' => '#00c49d', 
		'mp_knapstack_borders' => '#62c5b2', 
		'mp_knapstack_secondary_bg_color' => '#62c5b2', 
		'mp_knapstack_form_input_text_color' => '#565656', 
		'mp_knapstack_form_input_inactive_color' => '#62c5b2', 
		'mp_knapstack_form_input_active_color' => '#00c49d', 
		'mp_knapstack_header_nav_text_color' => '#62c5b2', 
		'mp_knapstack_text_color' => '#62c5b2', 
		'mp_core_logo' => 'http://demo.mintplugins.com/pastel-wedding-theme-bundle/wp-content/uploads/sites/11/2015/11/logo-placeholder.png', 
		'mp_core_logo_width' => '100', 
		'mp_core_logo_height' => '100', 
		'mp_stacks_footer_stack' => 'none'
	);
	
}
add_filter( 'mp_stacks_required_theme_mods_for_' . 'pastel_wedding_theme_bundle', 'pastel_wedding_theme_bundle_theme_mods' );

/**
 * Return what the dirname of the theme we wish to use should be. 
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      function_name()
 * @param    string $theme_dir_name
 * @return   string $theme_dir_name
 */
function pastel_wedding_theme_bundle_required_theme_dirname_custom( $theme_dir_name ){
	return 'knapstack';
}
add_filter( 'pastel_wedding_theme_bundle_required_theme_dirname', 'pastel_wedding_theme_bundle_required_theme_dirname_custom' );

/**
 * Return what the Fancy Name of theme we wish to use should be. This is the title in the theme's style.css file.
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      function_name()
 * @param    string $fancy_theme_name
 * @return   string $fancy_theme_name
 */
function pastel_wedding_theme_bundle_fancy_theme_name_custom( $fancy_theme_name ){
	return 'Knapstack Theme';
}
add_filter( 'pastel_wedding_theme_bundle_fancy_theme_name', 'pastel_wedding_theme_bundle_fancy_theme_name_custom' );

/**
 * Set up the Smooth Scroll plugin's default setting for the Pastel Wedding Theme Bundle
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      function_name()
 * @param    string $theme_bundle_slug
 * @return   string $theme_bundle_slug
 */

function pastel_wedding_theme_bundle_smooth_scroll_up_setup( $theme_bundle_slug ){
	
	if ( $theme_bundle_slug == 'pastel_wedding_theme_bundle' ){
		
		//MP Smooth Scroll Up Plugin Default Settings
		$smooth_scroll_up_setting = array(
			'scrollup_text' => NULL,
			'scrollup_type' => 'image',
			'scrollup_position' => 'right', 
			'scrollup_show' => '1',
			'scrollup_mobile' => '0',
			'scrollup_animation' => NULL,
			'scrollup_distance' => NULL,
			'scrollup_attr' => NULL 
		);
		update_option( 'scrollup_settings', $smooth_scroll_up_setting );
		
	}
}
add_action( 'mp_stacks_additional_installation_actions', 'pastel_wedding_theme_bundle_smooth_scroll_up_setup' );