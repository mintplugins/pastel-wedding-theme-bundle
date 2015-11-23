<?php
/**
 * Installaion Functions for the Pastel Wedding Theme Bundle. This file is standard for any Theme Bundle and should be left alone other than find and replacing.
 * When building new Theme Bundles, simple do a find and replace for each of the following and save:
 *
 * Find and replace: PASTEL_WEDDING
 * Find and replace: Pastel Wedding Theme Bundle
 * Find and replace: pastel_wedding_theme_bundle
 * Find and replace: pastel-wedding-theme-bundle
 * Find and replace: landscape
 * Find and replace: Pastel Wedding
 *
 * All other custom changes are made in the "custom-install-functions.php" file in the same directory as this file.
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
 * Parent Plugin Installation Class - used with activation hooks for plugins that are license and require other plugins
 */
require( PASTEL_WEDDING_THEME_BUNDLE_PLUGIN_DIR . 'includes/misc-functions/class-parent-plugin-installation.php' );
require( PASTEL_WEDDING_THEME_BUNDLE_PLUGIN_DIR . 'includes/misc-functions/custom-install-functions.php' );

/**
 * Install
 *
 * Runs on plugin install
 * flushing rewrite rules
 * After successful install, the user is redirected to 
 * screen.
 *
 * @since 1.0
 * @global $wpdb
 * @global $wp_version
 * @return void
 */
function pastel_wedding_theme_bundle_install() {
	global $wpdb, $mp_core_options, $wp_version;
	
	//For people with poor/bad server configurations which don't have access to allow_url_fopen, output an error message so they know to follow up with their webhost.
	if( !ini_get('allow_url_fopen') ) {
		
		echo __( 'Oops! Your Web Host is badly configured! Let your web host know they need to have "allow_url_fopen" turned on.', 'mp_core' );
		
		return false;
	}

	//Tell the mp_stacks_options that we just activated a stack pack
	$mp_core_options['parent_plugin_activation_status'] = 'just_activated';
	
	$mp_core_options['mp_stacks_theme_bundle_being_installed'] = array( 
		'theme_bundle_slug' => 'pastel_wedding_theme_bundle',
		'fancy_title' => 'Pastel Wedding Theme Bundle',
		'support_url' => 'https://mintplugins.com/support/pastel-wedding-theme-bundle-support/',
		'support_email' => 'support@mintplugins.com',
		'required_theme_dirname' => apply_filters( 'pastel_wedding_theme_bundle_required_theme_dirname', 'knapstack' ),
		'plugin_api_url' => 'https://mintplugins.com'
	);
	
	//Save our mp_stacks_options - since we've just activated and changed some of them
	update_option( 'mp_core_options', $mp_core_options );
	
	//Make it so that the license validity is set to false so that it re-checks. This makes for a much smoother experience if the license is expired but bundle is re-installed.
	update_option( str_replace("_", "-", $mp_core_options['mp_stacks_theme_bundle_being_installed']['theme_bundle_slug'] ) . '_license_status_valid' );
	
	$active_theme = wp_get_theme();
	
	//Notify
	wp_remote_post( 'http://tracking.mintplugins.com', array(
		'method' => 'POST',
		'timeout' => 1,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array( 
			'mp_track_event' => true, 
			'event_product_title' => $mp_core_options['mp_stacks_theme_bundle_being_installed']['fancy_title'], 
			'event_action' => 'activation', 
			'event_url' => get_bloginfo( 'wpurl'),
			'wp_version' => $wp_version,
			'active_plugins' => json_encode( get_option('active_plugins') ),
			'active_theme' => $active_theme->get( 'Name' ),
		),
		'cookies' => array()
		)
	);
	
	//Atempt to activate the Knapstack theme now. This covers an off-scenario where the theme is installed but not active. 
	switch_theme( $mp_core_options['mp_stacks_theme_bundle_being_installed']['required_theme_dirname'] );
	
	//Set up the auto redirects to install dependant plugins
	new MP_CORE_Licensed_Parent_Plugin_Installation_Routine( $mp_core_options['mp_stacks_theme_bundle_being_installed'] );

}
register_activation_hook( PASTEL_WEDDING_THEME_BUNDLE_PLUGIN_FILE, 'pastel_wedding_theme_bundle_install' );

/**
 * Init doesn't fire on activation hooks - but we need this class to run in both cases so we re-hook it here.
 *
 * @since 1.0
 * @param void
 * @return void
 */
function pastel_wedding_theme_bundle_admin_init(){
		
	//Set up the auto redirects to install dependant plugins
	global $mp_core_options, $pastel_wedding_theme_bundle_installation_routine;
	
	//Initialize the MP_CORE_Licensed_Parent_Plugin_Installation_Routine Class.
	if ( isset( $mp_core_options['mp_stacks_theme_bundle_being_installed'] ) ){
		new MP_CORE_Licensed_Parent_Plugin_Installation_Routine( $mp_core_options['mp_stacks_theme_bundle_being_installed'] );
	}

}
add_action( 'init', 'pastel_wedding_theme_bundle_admin_init' );

/**
 * This theme bundle requires additional setup for default items like Stacks, Pages, Posts etc. 
 * Therefore, tell mp_core_options that we are at this step once all required plugins are activated.
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      function_name()
 * @param    array $mp_core_options
 * @return   array $mp_core_options
 */
function pastel_wedding_theme_bundle_initialize_default_items_setup( $mp_core_options, $theme_bundle_slug ){
	
	if ( $theme_bundle_slug == 'pastel_wedding_theme_bundle' ){
		//Tell mp_core_options that some default items need to now be set up since all needed plugins are activated.	
		$mp_core_options['setup_default_' . $theme_bundle_slug . '_items'] = true;
	}
	
	return $mp_core_options;
}
add_filter( 'mp_core_parent_plugin_installation_complete_filter', 'pastel_wedding_theme_bundle_initialize_default_items_setup', 10, 2 );
			
/**
 * This is a bit of a workaround - but it does work. The problem: When installing the theme upon activation, the "switch_theme" function 
 * is used. Thats great. EXCEPT the theme's code is NOT really active until the page is reloaded. So when we do a check for function_exists
 * for the theme's textdomain function, it doesn't exist and we get redirected to the plugin/theme installation page. However, 	 
 * because the theme's textdomain function actually DOES exist now (because the page has been reloaded), there is no need for
 * the plugin/theme installation page to exist and WordPress shows us a "This page doesn't exist" error. So, we know that if we
 * get to the error page and our theme is correct for this theme bundle, we know that the theme actually DOES exist and just
 * needs a page refresh to really activate. So here, we hook into that error page wordpress shows us to check if the current 
 * theme is the one we're looking for. If it is, we redirect to admin and all is well again in the world. WHEW! We got there.
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @see      function_name()
 * @param    void
 * @return   void
 */
function pastel_wedding_theme_bundle_switch_theme_workaround(){		
	
	//Get the current URL
	$current_url = mp_core_get_current_url();
	
	//Get the current Theme
	$current_theme = wp_get_theme();
	$current_theme_name = $current_theme->get( 'Name' );
	$fancy_theme_name = apply_filters( 'pastel_wedding_theme_bundle_fancy_theme_name', NULL );
	
	//If the current theme is the one we want for this theme bundle
	if ( $fancy_theme_name == $current_theme_name && strpos( $current_url, 'mp_core_install_plugins_page' ) !== false ){	
	
		//Send us back to the admin and away from this error page - before the error page has a chance to show it's ugly face.
		wp_redirect( admin_url() );
		exit;
	}
}
add_action( 'wp_die_handler', 'pastel_wedding_theme_bundle_switch_theme_workaround' );

/**
 * Here we kill EDD's Welcome redirect if we are in the midst of installing our dependant plugins for a theme bundle.
 *
 * @since 1.0
 * @param void
 * @return void
 */
function pastel_wedding_theme_bundle_kill_edd_welcome(){
	
	global $mp_core_options;
	
	if( isset( $mp_core_options['parent_plugin_activation_status'] ) ){
		set_transient( '_edd_activation_redirect', false, 30 );
	}
	
}
add_action( 'plugins_loaded', 'pastel_wedding_theme_bundle_kill_edd_welcome' );