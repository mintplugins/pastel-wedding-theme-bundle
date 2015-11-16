<?php
/**
 * This file contains the MP_CORE_Licensed_Parent_Plugin_Installation_Routine class
 *
 * @link http://mintplugins.com/doc/MP_CORE_Licensed_Parent_Plugin_Installation_Routine/
 * @since 1.0.0
 *
 * @package    MP Core
 * @subpackage Classes
 *
 * @copyright  Copyright (c) 2015, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */

/**
 * Set up the global $mp_core_options
 *
 * @since 1.0
 * @global $wpdb
 * @global $mp_core_options
 * @return void
 */
if ( !function_exists( 'mp_core_global_options_init' ) ){
	function mp_core_global_options_init(){
		
		global $mp_core_options;
		
		$mp_core_options = get_option('mp_core_options');
		
		if( !session_id() ){
			session_start();
		}
				
	}
}

//Set up our Global Options for MP Stacks
mp_core_global_options_init();

/**
 * This class handles the setup for a Parent Plugin. Set it up in the plugin activation hook for Parent Plugin. 
 * 
 * The field can be singular or they can repeat in groups. 
 * It works by passing an associative array containing the information for the fields to the class
 *
 * @author     Philip Johnston
 * @link       http://mintplugins.com/doc/metabox-class/
 * @since      1.0.0
 * @return     void
 */
if (!class_exists('MP_CORE_Licensed_Parent_Plugin_Installation_Routine')){
	class MP_CORE_Licensed_Parent_Plugin_Installation_Routine{
					
		protected $_parent_plugin_title;
		protected $_metabox_items_array = array();
		
		/**
		 * Constructor
		 *
		 * @access   public
		 * @since    1.0.0
		 * @link     http://mintplugins.com/doc/MP_CORE_Licensed_Parent_Plugin_Installation_Routine/
		 * @author   Philip Johnston
		 * @see      sanitize_title()
		 * @param    array $theme_bundle_being_installed_array (required) See link for description.
		 * @return   void
		 */	
		public function __construct( $theme_bundle_being_installed_array ){
					
			global $mp_core_options;
			
			if ( !isset( $mp_core_options['parent_plugin_activation_status'] ) || $mp_core_options['parent_plugin_activation_status'] == 'complete' ){
				return false;	
			}
						
			//Set class wide parent plugin title
			$this->_parent_plugin_title = $theme_bundle_being_installed_array['fancy_title'];	
			
			//Set class wide parent plugin slug using hyphens as separators
			$this->_full_parent_plugin_hyphen_slug = str_replace("_", "-", $theme_bundle_being_installed_array['theme_bundle_slug'] );	
			
			//Set class wide parent plugin slug using underscores as separators
			$this->_full_parent_plugin_underscore_slug = $theme_bundle_being_installed_array['theme_bundle_slug'];	
			
			$this->_parent_plugin_api_url = $theme_bundle_being_installed_array['plugin_api_url'];
				
			$this->_license_key = get_option( $this->_full_parent_plugin_hyphen_slug . '_license_key' );
			$this->_license_key_valid = get_option( $this->_full_parent_plugin_hyphen_slug . '_license_status_valid' );
			
			//As a backup for hosts with extremely low timeout times, because we are doing an hefty installation, 
			//we may need to bump this time up - for only this installation. Note: This will not work if safe_mode is on.
			set_time_limit( 300 );
													
			//Set up hooked functions
			add_action( 'admin_init', array( $this, 'license_capture_upon_activation' ) );
			add_action( 'admin_init', array( $this, 'mp_parent_plugin_checking_active_plugins' ) );
			add_action( 'admin_footer', array( $this, 'footer_redirects_after_dependant_installs' ) );
			add_action( 'shutdown', array( $this, 'redirect_upon_activation' ) );
											
		}
	
		/**
		 * Redirects to installation of dependencies, saves Theme MetaData.
		 *
		 * @since 1.0
		 * @global $wpdb
		 * @global $mp_core_options
		 * @return void
		 */
		function redirect_upon_activation(){
			
			global $mp_core_options;
					
			//If we have just activated
			if ( $mp_core_options['parent_plugin_activation_status'] == 'just_activated' ){
							
				// Bail if activating from network, or bulk
				if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
					
					//Flush the rewrite rules
					flush_rewrite_rules();
					
					//Tell the mp_core_options that we no longer just activated so no redirects happen.
					$mp_core_options['parent_plugin_activation_status'] = 'cancelled';	
					//Save our mp_core_options - since we've just activated and changed some of them
					update_option( 'mp_core_options', $mp_core_options );
				
					return;
				}
				
				//If the core is NOT active (and we aren't installing the core right now), redirect the core installation
				if ( !function_exists('mp_core_textdomain') ){
					
					//Tell the mp_core_options that we are activating the core
					$mp_core_options['parent_plugin_activation_status'] = 'installing_core';	
					//Save our mp_core_options - since we've just activated and changed some of them
					update_option( 'mp_core_options', $mp_core_options );
				
					//Redirect to install the core
					wp_redirect( admin_url( sprintf( 'options-general.php?page=mp_core_install_plugins_page&action=install-plugin&_wpnonce=%s', wp_create_nonce( 'install-plugin' ) ) ) );	
					exit();
					
				}
				
				//If we made it this far, the core is active
				
				//If there isn't a valid license key, Make it so the license input form is all the user sees
				if ( !$this->_license_key_valid ){	 
					
					$mp_core_options['parent_plugin_activation_status'] = 'getting_license';	
					
					//Save our mp_core_options - since we've just activated and changed some of them
					update_option( 'mp_core_options', $mp_core_options );
					
					//wp_redirect( admin_url() );	
					
					// Redirect the user to Parent Plugin's Welcome Page
					echo '<script type="text/javascript">';
						echo "window.location = '" . admin_url() . "';";
					echo '</script>';
					exit();
				
				}
				
				//Set up the name of the function in the parent plugin where we check if all dependant plugins are installed
				$dependency_function_name = $this->_full_parent_plugin_underscore_slug . '_dependencies';
				
				//If all required plugins are active, redirect to the welcome page
				if ( $dependency_function_name() ){
					
					//Tell the mp_core_options that we no longer just activated
					$mp_core_options['parent_plugin_activation_status'] = 'complete';	
					
					//Tell mp_core_options that some default items need to now be set up since all needed plugins are activated.	
					$mp_core_options['setup_default_' . $this->_full_parent_plugin_underscore_slug . '_items'] = true;
						
					//Save our mp_core_options - since we've just activated and changed some of them
					update_option( 'mp_core_options', $mp_core_options );
							
					// Redirect the user to our welcome page - or other page if an add-on filters this redirect
					wp_redirect( admin_url() );
					exit();
				}
				//If all required plugins are NOT active, redirect to the mp-core intaller and install any other needed plugins too.
				else{
									
					$mp_core_options['parent_plugin_activation_status'] = 'installing_dependencies';	
				
					//Save our mp_core_options - since we've just activated and changed some of them
					update_option( 'mp_core_options', $mp_core_options );
					
					wp_redirect( admin_url( sprintf( 'options-general.php?page=mp_core_install_plugins_page&action=install-plugin&_wpnonce=%s', wp_create_nonce( 'install-plugin' ) ) ) );	
					exit();
					
				}
				
			}
			
		}
			
		//If no Parent Plugin license exists, Gets Paren Plugin's License,
		function license_capture_upon_activation(){
			
			global $wpdb, $mp_core_options, $wp_version;
					
			//If the user just clicked cancel on the license actication
			if ( isset( $_GET['mp-core-parent-plugin-license-cancelled'] ) ){	
				
				//Tell the mp_core_options that we no longer just activated so no redirects happen.
				$mp_core_options['parent_plugin_activation_status'] = 'cancelled';	
				//Save our mp_core_options - since we've just activated and changed some of them
				update_option( 'mp_core_options', $mp_core_options );
				
				return false;
			}
									
			//Only keep going if we are supposed to be getting a license and the core is active
			if ( $mp_core_options['parent_plugin_activation_status'] == 'getting_license' && function_exists( 'mp_core_textdomain' ) ){
									
				//If there isn't a valid license key, Make it so the license input form is all the user sees
				if ( !$this->_license_key_valid ){
				
					//If the license is invalid
					if ( !$this->_license_key_valid && !empty( $this->_license_key ) ){
							$h2_title = __( 'Invalid License for ', 'mp_core' ) . '<br />' . $this->_parent_plugin_title . '...';
					}else{
							$h2_title = __( 'Enter your license key to complete installation of ', 'mp_core' ) . '<br />' . $this->_parent_plugin_title . '...'; 
					}
					
					$placeholder_prefix = !$this->_license_key_valid && !empty( $this->_license_key )  ? __( 'Oops! The License Key you entered isn\'t valid', 'mp_core' ) : __( 'Enter your License Key for', 'mp_core' );
					
					//JS and CSS for the loading animation: http://codepen.io/manussakis/pen/VYgBVG
					$html_head = '<script type="text/javascript" src="' . get_bloginfo( 'wpurl' ) . '/wp-includes/js/jquery/jquery.js"></script>';
					$html_head .= '<script type="text/javascript" src="' . MP_CORE_PLUGIN_URL . 'includes/js/utility/velocity.min.js"></script>';
					$html_head .= '
						<script type="text/javascript">
							
							var license_submit_counter = 0;
							
							jQuery(document).ready(function($){
															
								//When the form is submitted, let the user know something is happening
								$( "#' . $this->_full_parent_plugin_underscore_slug . '_license" ).on( "submit", function( event ){
									
									
									if ( license_submit_counter == 0 ){				
										
										event.preventDefault();
										
										license_submit_counter = 1;
																			
										//Hide everything in the body
										$( "body *" ).hide();
										
										//Show a message that something is happening.
										$( "#notify_user_of_happenings, #notify_user_of_happenings *").show();
										
										$( "html, body" ).css( "background-color", "#222222" );
										$( "html, body" ).css( "box-shadow", "none" );
										
										var license_delay = setInterval(function(){ 
											clearInterval(license_delay);
											$( "#' . $this->_full_parent_plugin_underscore_slug . '_license" ).submit();
										}, 500);
																		
									}
									
								});
								
								$(".small, .small-shadow").velocity({
									rotateZ: [0,-360]},{
									loop:true,
									duration: 2000
								});
								$(".medium, .medium-shadow").velocity({
									rotateZ: -240},{
									loop:true,
									duration: 2000
								});
								$(".large, .large-shadow").velocity({
									rotateZ: 180},{
									loop:true,
									duration: 2000
								});
							});';
					$html_head .= '</script>';
					$html_head .= '<style type="text/css">';
						$html_head .= 'body, html {
									  width: 100%;
									  height: 100%;
									}
									
									.container {
									  height: 100%;
									  display: -webkit-box;
									  display: -webkit-flex;
									  display: -ms-flexbox;
									  display: flex;
									  -webkit-box-pack: center;
									  -webkit-justify-content: center;
										  -ms-flex-pack: center;
											  justify-content: center;
									  -webkit-box-align: center;
									  -webkit-align-items: center;
										  -ms-flex-align: center;
											  align-items: center; }
									
									.machine {
									  width: 60vmin;
									  fill: #fff; }
									
									.small-shadow, .medium-shadow, .large-shadow {
									  fill: rgba(0, 0, 0, 0.05); }
									
									.small {
									  -webkit-transform-origin: 100.136px 225.345px;
										  -ms-transform-origin: 100.136px 225.345px;
											  transform-origin: 100.136px 225.345px; }
									
									.small-shadow {
									  -webkit-transform-origin: 110.136px 235.345px;
										  -ms-transform-origin: 110.136px 235.345px;
											  transform-origin: 110.136px 235.345px; }
									
									.medium {
									  -webkit-transform-origin: 254.675px 379.447px;
										  -ms-transform-origin: 254.675px 379.447px;
											  transform-origin: 254.675px 379.447px; }
									
									.medium-shadow {
									  -webkit-transform-origin: 264.675px 389.447px;
										  -ms-transform-origin: 264.675px 389.447px;
											  transform-origin: 264.675px 389.447px; }
									
									.large {
									  -webkit-transform-origin: 461.37px 173.694px;
										  -ms-transform-origin: 461.37px 173.694px;
											  transform-origin: 461.37px 173.694px; }
									
									.large-shadow {
									  -webkit-transform-origin: 471.37px 183.694px;
										  -ms-transform-origin: 471.37px 183.694px;
											  transform-origin: 471.37px 183.694px; }';
					$html_head .= '</style>';
					
					//Set up the html form we'll show to the user so they can enter their license
					$page_body_html = '<form id="' . $this->_full_parent_plugin_underscore_slug . '_license" action="' . admin_url() . '" method="post">
				
						<input name="' . $this->_full_parent_plugin_hyphen_slug . '_license_key" id="license_key" style="margin-bottom:10px;" placeholder="' .  $placeholder_prefix . ' ' . $this->_parent_plugin_title. ' " value="" />
					   
						<input name="submit_button" type="submit" id="submit_button" class="button" style="width:initial; float:left; display:inline-block; margin-right:5px;" value="' .  __( 'Complete Installation', 'mp_core' ). '">
					   
					   ' .  wp_nonce_field( $this->_full_parent_plugin_hyphen_slug  . '_nonce', $this->_full_parent_plugin_hyphen_slug  . '_nonce' ). '
					   
					   <a href="' .  add_query_arg( array( 'mp-core-parent-plugin-license-cancelled' => true ), admin_url() ). '" class="button">' .  __( 'Cancel', 'mp_core' ). '</a>
					</form>
					<p>' . __( 'Lost your License Key? Log into your account at', 'mp_core' ) . ' <a href="' . $this->_parent_plugin_api_url . '" target="_blank">' . $this->_parent_plugin_api_url 					. '</a></p>
					<div id="notify_user_of_happenings" style="display:none;">
						<div class="container" style="width:200px; margin: 0px auto;">
							<svg class="machine"xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 645 526">
							  <defs/>
							  <g>
								<path  x="-173,694" y="-173,694" class="large-shadow" d="M645 194v-21l-29-4c-1-10-3-19-6-28l25-14 -8-19 -28 7c-5-8-10-16-16-24L602 68l-15-15 -23 17c-7-6-15-11-24-16l7-28 -19-8 -14 25c-9-3-18-5-28-6L482 10h-21l-4 29c-10 1-19 3-28 6l-14-25 -19 8 7 28c-8 5-16 10-24 16l-23-17L341 68l17 23c-6 7-11 15-16 24l-28-7 -8 19 25 14c-3 9-5 18-6 28l-29 4v21l29 4c1 10 3 19 6 28l-25 14 8 19 28-7c5 8 10 16 16 24l-17 23 15 15 23-17c7 6 15 11 24 16l-7 28 19 8 14-25c9 3 18 5 28 6l4 29h21l4-29c10-1 19-3 28-6l14 25 19-8 -7-28c8-5 16-10 24-16l23 17 15-15 -17-23c6-7 11-15 16-24l28 7 8-19 -25-14c3-9 5-18 6-28L645 194zM471 294c-61 0-110-49-110-110S411 74 471 74s110 49 110 110S532 294 471 294z"/>
							  </g>
							  <g>
								<path x="-136,996" y="-136,996" class="medium-shadow" d="M402 400v-21l-28-4c-1-10-4-19-7-28l23-17 -11-18L352 323c-6-8-13-14-20-20l11-26 -18-11 -17 23c-9-4-18-6-28-7l-4-28h-21l-4 28c-10 1-19 4-28 7l-17-23 -18 11 11 26c-8 6-14 13-20 20l-26-11 -11 18 23 17c-4 9-6 18-7 28l-28 4v21l28 4c1 10 4 19 7 28l-23 17 11 18 26-11c6 8 13 14 20 20l-11 26 18 11 17-23c9 4 18 6 28 7l4 28h21l4-28c10-1 19-4 28-7l17 23 18-11 -11-26c8-6 14-13 20-20l26 11 11-18 -23-17c4-9 6-18 7-28L402 400zM265 463c-41 0-74-33-74-74 0-41 33-74 74-74 41 0 74 33 74 74C338 430 305 463 265 463z"/>
							  </g>
							  <g >
								<path x="-100,136" y="-100,136" class="small-shadow" d="M210 246v-21l-29-4c-2-10-6-18-11-26l18-23 -15-15 -23 18c-8-5-17-9-26-11l-4-29H100l-4 29c-10 2-18 6-26 11l-23-18 -15 15 18 23c-5 8-9 17-11 26L10 225v21l29 4c2 10 6 18 11 26l-18 23 15 15 23-18c8 5 17 9 26 11l4 29h21l4-29c10-2 18-6 26-11l23 18 15-15 -18-23c5-8 9-17 11-26L210 246zM110 272c-20 0-37-17-37-37s17-37 37-37c20 0 37 17 37 37S131 272 110 272z"/>
							  </g>
							  <g>
								<path x="-100,136" y="-100,136" class="small" d="M200 236v-21l-29-4c-2-10-6-18-11-26l18-23 -15-15 -23 18c-8-5-17-9-26-11l-4-29H90l-4 29c-10 2-18 6-26 11l-23-18 -15 15 18 23c-5 8-9 17-11 26L0 215v21l29 4c2 10 6 18 11 26l-18 23 15 15 23-18c8 5 17 9 26 11l4 29h21l4-29c10-2 18-6 26-11l23 18 15-15 -18-23c5-8 9-17 11-26L200 236zM100 262c-20 0-37-17-37-37s17-37 37-37c20 0 37 17 37 37S121 262 100 262z"/>
							  </g>
							  <g>
								<path x="-173,694" y="-173,694" class="large" d="M635 184v-21l-29-4c-1-10-3-19-6-28l25-14 -8-19 -28 7c-5-8-10-16-16-24L592 58l-15-15 -23 17c-7-6-15-11-24-16l7-28 -19-8 -14 25c-9-3-18-5-28-6L472 0h-21l-4 29c-10 1-19 3-28 6L405 9l-19 8 7 28c-8 5-16 10-24 16l-23-17L331 58l17 23c-6 7-11 15-16 24l-28-7 -8 19 25 14c-3 9-5 18-6 28l-29 4v21l29 4c1 10 3 19 6 28l-25 14 8 19 28-7c5 8 10 16 16 24l-17 23 15 15 23-17c7 6 15 11 24 16l-7 28 19 8 14-25c9 3 18 5 28 6l4 29h21l4-29c10-1 19-3 28-6l14 25 19-8 -7-28c8-5 16-10 24-16l23 17 15-15 -17-23c6-7 11-15 16-24l28 7 8-19 -25-14c3-9 5-18 6-28L635 184zM461 284c-61 0-110-49-110-110S401 64 461 64s110 49 110 110S522 284 461 284z"/>
							  </g>
							  <g>
								<path x="-136,996" y="-136,996" class="medium" d="M392 390v-21l-28-4c-1-10-4-19-7-28l23-17 -11-18L342 313c-6-8-13-14-20-20l11-26 -18-11 -17 23c-9-4-18-6-28-7l-4-28h-21l-4 28c-10 1-19 4-28 7l-17-23 -18 11 11 26c-8 6-14 13-20 20l-26-11 -11 18 23 17c-4 9-6 18-7 28l-28 4v21l28 4c1 10 4 19 7 28l-23 17 11 18 26-11c6 8 13 14 20 20l-11 26 18 11 17-23c9 4 18 6 28 7l4 28h21l4-28c10-1 19-4 28-7l17 23 18-11 -11-26c8-6 14-13 20-20l26 11 11-18 -23-17c4-9 6-18 7-28L392 390zM255 453c-41 0-74-33-74-74 0-41 33-74 74-74 41 0 74 33 74 74C328 420 295 453 255 453z"/>
							  </g>
							</svg>
						</div>
					</div>';
				
				
					$action_page_args = array( 
						'page_title' => !$this->_license_key_valid && !empty( $this->_license_key ) ? __( 'Invalid License', 'mp_core' ) : __( 'Install', 'mp_core' ) . ' ' . $this->_parent_plugin_title,
						'html_head' => $html_head,
						'h2_title' => $h2_title,
						'page_body_html' => $page_body_html,
					);
								
					echo mp_core_simple_action_page( $action_page_args );
					
					die();
				}
				
				//If a valid license was just activated from the parent plugin license-only page
				else{
						
					//Set up the name of the function in the parent plugin where we check if all dependant plugins are installed
					$dependency_function_name = $this->_full_parent_plugin_underscore_slug . '_dependencies';
															
					//If all required plugins are active, redirect to the welcome page
					if ( $dependency_function_name() ){
						
						//Tell the mp_core_options that we no longer just activated
						$mp_core_options['parent_plugin_activation_status'] = 'complete';	
							
						//Save our mp_core_options - since we've just activated and changed some of them
						update_option( 'mp_core_options', apply_filters( 'mp_core_parent_plugin_installation_complete_filter', $mp_core_options, $this->_full_parent_plugin_underscore_slug ) );
						
						//This hook can be used to set up default meta options or Theme Settings etc
						do_action( 'mp_core_parent_plugin_installation_complete', $this->_full_parent_plugin_underscore_slug );
					
						// Redirect the user to our welcome page - or other page if an add-on filters this redirect
						wp_redirect( admin_url() );
						exit();
					}
					//If all required plugins are NOT active, redirect to the mp-core intaller and install any other needed plugins too.
					else{
						
						$mp_core_options['parent_plugin_activation_status'] = 'installing_dependencies';	
					
						//Save our mp_core_options - since we've just activated and changed some of them
						update_option( 'mp_core_options', $mp_core_options );
						
						wp_redirect( admin_url( sprintf( 'options-general.php?page=mp_core_install_plugins_page&action=install-plugin&_wpnonce=%s', wp_create_nonce( 'install-plugin' ) ) ) );	
						exit();
					}
					
				}
			}
		}
		
		/**
		 * This is sort of "in-between" function. It is redirected to solely to check if any plugins need to be installed by the parent plugin. 
		 * If they don't, it redirect directly to admin. If they do need to be installed still, it redirects to the installation page.
		 *
		 * @since 1.0
		 * @global $mp_core_options
		 * @return void
		 */
		function mp_parent_plugin_checking_active_plugins(){
			
			global $mp_core_options;
			
			if ( !isset( $_GET['mp_parent_plugin_checking_active_plugins'] ) ){
				return false;	
			}
			
			//See if we have a value for the number of times this installation has been attempted.
			$mp_installation_attempts = isset( $_SESSION['mp_installation_attempts'] ) ? $_SESSION['mp_installation_attempts'] : NULL;
			
			//Set up the name of the function in the parent plugin where we check if all dependant plugins are installed
			$dependency_function_name = $this->_full_parent_plugin_underscore_slug . '_dependencies';
													
			//If all required plugins are active, redirect to the welcome page
			if ( !$dependency_function_name() ){
					
				//If we should be checking the active plugins on this new page load
				wp_redirect( admin_url( sprintf( 'options-general.php?' . $mp_installation_attempts . '&page=mp_core_install_plugins_page&action=install-plugin&_wpnonce=%s', wp_create_nonce( 'install-plugin' ) ) ) );	
				exit;
			}
			else{
				
				$_SESSION['mp_installation_attempts'] = 0;
							
				//Flush the rewrite rules
				flush_rewrite_rules();
				
				//Tell the mp_core_options that we no longer just activated
				$mp_core_options['parent_plugin_activation_status'] = 'complete';	
					
				//Save our mp_core_options - since we've just activated and changed some of them
				update_option( 'mp_core_options', apply_filters( 'mp_core_parent_plugin_installation_complete_filter', $mp_core_options, $this->_full_parent_plugin_underscore_slug ) );
				
				//This hook can be used to set up default meta options or Theme Settings etc
				do_action( 'mp_core_parent_plugin_installation_complete', $this->_full_parent_plugin_underscore_slug );
				
				//If all plugins are active that should be, redirect to the admin dashboard.
				wp_redirect( admin_url() . '?the_parent_plugin_welcome' );	
				exit;
			}
	
		}
		
		/**
		 * This function fires in the footer to set redirects after installations of dependencies
		 *
		 * @since 1.0
		 * @global $mp_core_options
		 * @return void
		 */
		function footer_redirects_after_dependant_installs(){
			global $mp_core_options;
							
			//If we are installing dependant plugins, once they are all installed tell parent_plugin_activation_status that we are complete
			if( $mp_core_options['parent_plugin_activation_status'] == 'installing_dependencies' ){
				
				$_SESSION['mp_installation_attempts'] = !isset( $_SESSION['mp_installation_attempts'] ) || empty( $_SESSION['mp_installation_attempts'] ) ? 0 : $_SESSION['mp_installation_attempts'];
							
				//Set up the name of the function in the parent plugin where we check if all dependant plugins are installed
				$dependency_function_name = $this->_full_parent_plugin_underscore_slug . '_dependencies';
														
				//If all required plugins are active, redirect to the welcome page
				if ( $dependency_function_name() || $_SESSION['mp_installation_attempts'] >= 5 ){
					
					$_SESSION['mp_installation_attempts'] = 0;
							
					//Flush the rewrite rules
					flush_rewrite_rules();
					
					//Tell the mp_core_options that we no longer just activated
					$mp_core_options['parent_plugin_activation_status'] = 'complete';	
						
					//Save our mp_core_options - since we've just activated and changed some of them
					update_option( 'mp_core_options', apply_filters( 'mp_core_parent_plugin_installation_complete_filter', $mp_core_options, $this->_full_parent_plugin_underscore_slug ) );
					
					//This hook can be used to set up default meta options or Theme Settings etc
					do_action( 'mp_core_parent_plugin_installation_complete', $this->_full_parent_plugin_underscore_slug );
					
					// Redirect the user to Parent Plugin's Welcome Page
					echo '<script type="text/javascript">';
						echo "window.location = '" . admin_url() . '?parent_plugin_welcome' . "';";
					echo '</script>';
				}
				//If all required plugins are not activated, redirect to the plugin installation page
				else{
					
					$_SESSION['mp_installation_attempts'] = $_SESSION['mp_installation_attempts'] + 1;
					
					//NOTICE: If plugins were installed on this page, they need to be rechecked for whether they are active before we redirect the user to another installation page
					//This is because all required plugins COULD be active now - and we just don't know it because those newly active plugins are only actually "active" on the next page load.	
					//Therefore, we will redirect the user to a page dedicated to checking for plugins and redirecting accordingly. 
					//This will be achieved by using the 'mp_parent_plugin_checking_active_plugins' URL variable.
					echo '<script type="text/javascript">';
						echo "window.location = '" . esc_url( add_query_arg( array( 'mp_parent_plugin_checking_active_plugins' => true ), admin_url() ) ) . "';";
					echo '</script>';					
					
				}
				
			}
			
			
			//If we are currently installing the core, redirect to the license only page when complete
			if( $mp_core_options['parent_plugin_activation_status'] == 'installing_core' ){
				
				//If we were redirected to install mp-core and other required plugins
				if ( isset( $_GET['page'] ) && $_GET['page'] == 'mp_core_install_plugins_page' ){
					
					$mp_core_options['parent_plugin_activation_status'] = 'getting_license';
					//Save our mp_core_options - since we've just activated and changed some of them
					update_option( 'mp_core_options', $mp_core_options );
							
					// Redirect the user to the single license page after MP Core has been installed
					echo '<div style="background-color:#fff; padding:20px; width:100%; text-align: center; position:absolute; top:0; right:0;">' . __( 'Installing other assets...please wait...', 'mp_core' ) . '</div>';
					
					echo '<script type="text/javascript">';
						echo "window.location = '" . admin_url() . "';";
					echo '</script>';
					
					echo '</div>';
						
						
				}	
			}
		}
	}
}