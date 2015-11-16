<?php 
/**
 * MP Stacks Template Home
 *
 * @link http://mintplugins.com/doc/
 * @since 1.0.0
 *
 * @package     MP Stacks Template Home
 * @subpackage  Functions
 *
 * @copyright   Copyright (c) 2015, Mint Plugins
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author      Philip Johnston
 */

 /**
 * If required add-ons aren't active, stop and install it now
 */
if (!function_exists('mp_stacks_animation_textdomain') || !function_exists('mp_stacks_forms_textdomain') || !function_exists('mp_stacks_gallery_textdomain') || !function_exists('mp_stacks_googlefonts_textdomain') || !function_exists('mp_stacks_parallax_textdomain') || !function_exists('mp_stacks_shadows_textdomain') || !function_exists('mp_stacks_slider_textdomain')){
					
	/**
	 * Check if mp_stacks_animation is installed
	 */
	require( plugin_dir_path(__FILE__) . 'required-add-ons/mp-stacks-animation-check.php' ); 
		
	
					
	/**
	 * Check if mp_stacks_forms is installed
	 */
	require( plugin_dir_path(__FILE__) . 'required-add-ons/mp-stacks-forms-check.php' ); 
		
	
					
	/**
	 * Check if mp_stacks_gallery is installed
	 */
	require( plugin_dir_path(__FILE__) . 'required-add-ons/mp-stacks-gallery-check.php' ); 
		
	
					
	/**
	 * Check if mp_stacks_googlefonts is installed
	 */
	require( plugin_dir_path(__FILE__) . 'required-add-ons/mp-stacks-googlefonts-check.php' ); 
		
	
					
	/**
	 * Check if mp_stacks_parallax is installed
	 */
	require( plugin_dir_path(__FILE__) . 'required-add-ons/mp-stacks-parallax-check.php' ); 
		
	
					
	/**
	 * Check if mp_stacks_shadows is installed
	 */
	require( plugin_dir_path(__FILE__) . 'required-add-ons/mp-stacks-shadows-check.php' ); 
		
	
					
	/**
	 * Check if mp_stacks_slider is installed
	 */
	require( plugin_dir_path(__FILE__) . 'required-add-ons/mp-stacks-slider-check.php' ); 
		
		
}
/**
 * Otherwise, if all required plugins are active, carry out the plugin's functions
 */
else{

	 /**
	 * Add Home to the list of installed stack templates
	 *
	 * @since    1.0.0
	 * @link     http://mintplugins.com/doc/mp_stacks_templates_add_pastel_wedding_home
	 * @see      function_name()
	 * @param    array $installed_templates See link for description.
	 * @return   array $installed_templates See link for description.
	 */
	function mp_stacks_templates_add_pastel_wedding_home( $installed_templates ){ 
		
		$installed_templates['mp_stacks_pastel_wedding_home_array'] = array(
			'template_slug' => 'pastel_wedding_home',
			'template_title' => __( 'Home', 'pastel_wedding_theme_bundle' ),
			'template_description' => __('', 'pastel_wedding_theme_bundle' ),
			'template_tags' => '',
			'template_preview_img' => plugins_url( '/images/preview_thumbnail.jpg', __FILE__ ),
			'template_demo_url' => '',
		);
		
		return $installed_templates;
	
	}
	add_filter( 'mp_stacks_installed_templates', 'mp_stacks_templates_add_pastel_wedding_home' );
	
	/**
	 * Add This Stack Template to the list of Default Stacks to create when the parent Theme Bundle is activated.
	 *
	 * @since    1.0.0
	 * @link     https://mintplugins.com/doc/mp_stacks_templates_pastel_wedding_home_to_default_stacks
	 * @see      function_name()
	 * @param    array $default_stacks_to_create See link for description.
	 * @return   array $default_stacks_to_create See link for description.
	 */
	function mp_stacks_templates_pastel_wedding_home_to_default_stacks( $default_stacks_to_create ){ 
				
		$default_stacks_to_create['page']['pastel_wedding_home'] = array( 'title' => 'Home','page_template' => 'default', );
		
		return $default_stacks_to_create;
	
	}
	add_filter( 'pastel_wedding_theme_bundle_default_stacks', 'mp_stacks_templates_pastel_wedding_home_to_default_stacks' );
	
	/**
	 * This function holds and returns the Home Template Array
	 *
	 * @since    1.0.0
	 * @link     http://mintplugins.com/doc/mp-stacks-stack-template-function
	 * @return   array The Stack Template Aray
	 */
	function mp_stacks_pastel_wedding_home_array(){ 
	
		$template_array = array (
  'stack_title' => '',
  'stack_description' => 'Created using: ',
  'stack_bricks' => 
  array (
    'brick_1' => 
    array (
      'brick_title' => 'Pattern Wedding Header Brick',
      'mp_stack_order' => 1000,
      '_edit_lock' => 
      array (
        'value' => '1447382903:3',
      ),
      '_edit_last' => 
      array (
        'value' => '3',
      ),
      'brick_first_content_type' => 
      array (
        'value' => 'slider',
      ),
      'brick_no_borders' => 
      array (
        'value' => '',
      ),
      'brick_bg_image' => 
      array (
        'value' => 'header-image-6.jpg',
        'attachment' => true,
      ),
      'mp_stacks_singletext_content_type_repeater' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'brick_text_color' => 
            array (
              'value' => '#ffffff',
              'attachment' => false,
            ),
            'brick_text_font_size' => 
            array (
              'value' => '110',
              'attachment' => false,
            ),
            'brick_text_line_height' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom' => 
            array (
              'value' => '-60',
              'attachment' => false,
            ),
            'brick_text_color_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_tablet' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_color_laptop' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_mobile' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_google_font' => 
            array (
              'value' => 'Cabin',
              'attachment' => false,
            ),
            'brick_text_google_font_weight_style' => 
            array (
              'value' => '400',
              'attachment' => false,
            ),
            'brick_text' => 
            array (
              'value' => '&lt;p&gt;&lt;img class=&quot;alignnone size-full wp-image-91&quot; src=&quot;were-getting-married-turquoise.png&quot; alt=&quot;were-getting-married-turquoise&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;
&lt;p&gt;&lt;img class=&quot;alignnone size-full wp-image-91&quot; src=&quot;were-getting-married-turquoise.png&quot; alt=&quot;were-getting-married-turquoise&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;
',
              'attachment' => true,
            ),
          ),
          1 => 
          array (
            'brick_text_color' => 
            array (
              'value' => '#62c5b2',
              'attachment' => false,
            ),
            'brick_text_font_size' => 
            array (
              'value' => '28',
              'attachment' => false,
            ),
            'brick_text_line_height' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_color_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_laptop' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_google_font' => 
            array (
              'value' => 'Raleway',
              'attachment' => false,
            ),
            'brick_text_google_font_weight_style' => 
            array (
              'value' => '200',
              'attachment' => false,
            ),
            'brick_text' => 
            array (
              'value' => '&lt;p style=&quot;text-align: center;&quot;&gt;July 9, 2015 | 655 Wedding St. Toronto On. | 2:00PM&lt;/p&gt;
',
              'attachment' => false,
            ),
          ),
          2 => 
          array (
            'brick_text_color' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_laptop' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_google_font' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_google_font_weight_style' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text' => 
            array (
              'value' => '&lt;p style=&quot;text-align: center;&quot;&gt;[mp_button icon=&quot;fa-envelope-o&quot; icon_position=&quot;left&quot; icon_size=&quot;&quot; icon_spacing=&quot;&quot; text=&quot;RSVP&quot; link=&quot;#rsvp&quot; btn_bg=&quot;show&quot; color=&quot;#62c5b2&quot; hover_color=&quot;&quot; text_color=&quot;#ffffff&quot; hover_text_color=&quot;&quot; open_type=&quot;_self&quot; lightbox_width=&quot;500&quot; lightbox_height=&quot;500&quot;][mp_button icon=&quot;fa-heart&quot; icon_position=&quot;left&quot; icon_size=&quot;&quot; icon_spacing=&quot;&quot; text=&quot;Our Story&quot; link=&quot;#our-story&quot; btn_bg=&quot;show&quot; color=&quot;&quot; hover_color=&quot;&quot; text_color=&quot;&quot; hover_text_color=&quot;&quot; open_type=&quot;_self&quot; lightbox_width=&quot;500&quot; lightbox_height=&quot;500&quot;]&lt;/p&gt;
',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'mp_stack_id' => 
      array (
        'value' => '3',
      ),
      'brick_second_content_type' => 
      array (
        'value' => 'singletext',
      ),
      'brick_min_above_below' => 
      array (
        'value' => '150',
      ),
      'brick_overall_google_font' => 
      array (
        'value' => 'Cabin',
      ),
      'mp_stacks_slider_images' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'mp_stacks_slider_image_url' => 
            array (
              'value' => 'square-1.jpg',
              'attachment' => true,
            ),
            'mp_stacks_slider_video_url' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'mp_stacks_slider_image_link_url' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'mp_stacks_slider_image_url_open_type' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'mp_slider_lightbox_width' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'mp_slider_lightbox_height' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'brick_ct1_shadow_enabled' => 
      array (
        'value' => '',
      ),
      'brick_ct2_shadow_enabled' => 
      array (
        'value' => '',
      ),
      'brick_ct1_shadow_blur' => 
      array (
        'value' => '30',
      ),
      'brick_ct1_shadow_opacity' => 
      array (
        'value' => '23',
      ),
      'brick_ct2_shadow_color' => 
      array (
        'value' => '#d6adbb',
      ),
      'mp_stacks_slider_height' => 
      array (
        'value' => '1000',
      ),
      'brick_ct1_waypoint_animation_on' => 
      array (
        'value' => 'brick_ct1_waypoint_animation_on',
      ),
      'ct1_waypoint_animation_keyframes' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'animation_length' => 
            array (
              'value' => '500',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
          ),
          1 => 
          array (
            'animation_length' => 
            array (
              'value' => '2000',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'brick_ct1_waypoint_animation_reverse_upon_out' => 
      array (
        'value' => '',
      ),
      'brick_ct1_mouseover_animation_on' => 
      array (
        'value' => '',
      ),
      'ct1_mouseover_animation_keyframes' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'animation_length' => 
            array (
              'value' => '500',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'brick_ct2_waypoint_animation_on' => 
      array (
        'value' => 'brick_ct2_waypoint_animation_on',
      ),
      'ct2_waypoint_animation_keyframes' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'animation_length' => 
            array (
              'value' => '500',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
          ),
          1 => 
          array (
            'animation_length' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '10',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
          2 => 
          array (
            'animation_length' => 
            array (
              'value' => '1000',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'brick_ct2_waypoint_animation_reverse_upon_out' => 
      array (
        'value' => '',
      ),
      'brick_ct2_mouseover_animation_on' => 
      array (
        'value' => '',
      ),
      'ct2_mouseover_animation_keyframes' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'animation_length' => 
            array (
              'value' => '500',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'brick_bg_waypoint_animation_on' => 
      array (
        'value' => 'brick_bg_waypoint_animation_on',
      ),
      'bg_waypoint_animation_keyframes' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'animation_length' => 
            array (
              'value' => '500',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
          ),
          1 => 
          array (
            'animation_length' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'brick_bg_waypoint_animation_reverse_upon_out' => 
      array (
        'value' => '',
      ),
      'brick_bg_mouseover_animation_on' => 
      array (
        'value' => '',
      ),
      'bg_mouseover_animation_keyframes' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'animation_length' => 
            array (
              'value' => '500',
              'attachment' => false,
            ),
            'opacity' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
            'rotateZ' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateX' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'translateY' => 
            array (
              'value' => '0',
              'attachment' => false,
            ),
            'scale' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'mp_stacks_parallax_on' => 
      array (
        'value' => 'mp_stacks_parallax_on',
      ),
      'brick_ct2_shadow_weight' => 
      array (
        'value' => 'double_weight',
      ),
      'brick_bg_image_opacity' => 
      array (
        'value' => '80',
      ),
      'brick_bg_color' => 
      array (
        'value' => '#ffffff',
      ),
    ),
    'brick_2' => 
    array (
      'brick_title' => 'Our Story',
      'mp_stack_order' => 1010,
      '_edit_lock' => 
      array (
        'value' => '1447359489:3',
      ),
      '_edit_last' => 
      array (
        'value' => '3',
      ),
      'brick_first_content_type' => 
      array (
        'value' => 'image',
      ),
      'brick_second_content_type' => 
      array (
        'value' => 'singletext',
      ),
      'brick_ct1_shadow_enabled' => 
      array (
        'value' => '',
      ),
      'brick_ct2_shadow_enabled' => 
      array (
        'value' => '',
      ),
      'brick_no_borders' => 
      array (
        'value' => '',
      ),
      'mp_stacks_singletext_content_type_repeater' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'brick_text_color' => 
            array (
              'value' => '#56a495',
              'attachment' => false,
            ),
            'brick_text_font_size' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_line_height' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_laptop' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_google_font' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_google_font_weight_style' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text' => 
            array (
              'value' => '&lt;p&gt;Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec quis iaculis turpis. Nullam varius velit sed massa malesuada semper. Nullam eget eros vestibulum, sagittis odio in, ornare lectus. Etiam dignissim ex ut nulla sagittis pharetra. In ex nulla, eleifend sit amet posuere luctus, tincidunt accumsan erat. Vestibulum non sodales nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc molestie leo elit, a efficitur justo vehicula dapibus. Integer finibus egestas placerat. In condimentum ipsum sed condimentum accumsan.&lt;/p&gt;
&lt;p&gt;Suspendisse id lorem at nulla commodo malesuada in sed nulla. Curabitur sit amet interdum velit. Mauris dictum dignissim risus eu tincidunt. Etiam pulvinar tempus justo et finibus. Nulla rutrum elit nisi, at iaculis augue viverra feugiat. Fusce efficitur accumsan ligula eu sollicitudin. Duis feugiat magna vel placerat dignissim. Sed cursus diam nec dui imperdiet lacinia. Sed aliquet interdum fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In in mauris vel nisi tempor viverra vel at sem. Nunc lobortis sem tortor, vel volutpat mi lacinia interdum. Suspendisse semper molestie lectus, sed porta magna venenatis eget.&lt;/p&gt;
',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'mp_stack_id' => 
      array (
        'value' => '3',
      ),
      'brick_main_image' => 
      array (
        'value' => 'our-story-banner-2.png',
        'attachment' => true,
      ),
      'brick_alignment' => 
      array (
        'value' => 'centered',
      ),
      'brick_min_below_c1' => 
      array (
        'value' => '45',
      ),
    ),
    'brick_3' => 
    array (
      'brick_title' => 'RSVP',
      'mp_stack_order' => 1020,
      '_edit_lock' => 
      array (
        'value' => '1447349978:3',
      ),
      '_edit_last' => 
      array (
        'value' => '3',
      ),
      'brick_no_borders' => 
      array (
        'value' => '',
      ),
      'brick_bg_image' => 
      array (
        'value' => 'header-image-5.jpg',
        'attachment' => true,
      ),
      'mp_stack_id' => 
      array (
        'value' => '3',
      ),
      'brick_first_content_type' => 
      array (
        'value' => 'singletext',
      ),
      'mp_stacks_singletext_content_type_repeater' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'brick_text_color' => 
            array (
              'value' => '#b2e2d4',
              'attachment' => false,
            ),
            'brick_text_font_size' => 
            array (
              'value' => '200',
              'attachment' => false,
            ),
            'brick_text_line_height' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_color_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_tablet' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_color_laptop' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_mobile' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_google_font' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_google_font_weight_style' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text' => 
            array (
              'value' => '&lt;p&gt;RSVP&lt;/p&gt;
',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'brick_second_content_type' => 
      array (
        'value' => 'forms',
      ),
      'mp_stacks_forms_fields' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'field_title' => 
            array (
              'value' => 'Name of Guest',
              'attachment' => false,
            ),
            'field_description' => 
            array (
              'value' => 'Please enter the guest\'s name.',
              'attachment' => false,
            ),
            'field_type' => 
            array (
              'value' => 'textbox',
              'attachment' => false,
            ),
            'field_placeholder' => 
            array (
              'value' => 'Guest\'s Name',
              'attachment' => false,
            ),
            'field_taxonomy' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'field_select_values' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'field_width' => 
            array (
              'value' => '49',
              'attachment' => false,
            ),
            'field_placement' => 
            array (
              'value' => 'inline-block',
              'attachment' => false,
            ),
            'field_meta_key' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
          1 => 
          array (
            'field_title' => 
            array (
              'value' => 'Email',
              'attachment' => false,
            ),
            'field_description' => 
            array (
              'value' => 'Please enter your email',
              'attachment' => false,
            ),
            'field_type' => 
            array (
              'value' => 'email',
              'attachment' => false,
            ),
            'field_placeholder' => 
            array (
              'value' => 'Your Email Address',
              'attachment' => false,
            ),
            'field_taxonomy' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'field_select_values' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'field_width' => 
            array (
              'value' => '50',
              'attachment' => false,
            ),
            'field_placement' => 
            array (
              'value' => 'inline-block',
              'attachment' => false,
            ),
            'field_meta_key' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
          2 => 
          array (
            'field_title' => 
            array (
              'value' => 'Meal Option',
              'attachment' => false,
            ),
            'field_description' => 
            array (
              'value' => 'Select the meal option for this guest',
              'attachment' => false,
            ),
            'field_type' => 
            array (
              'value' => 'radio',
              'attachment' => false,
            ),
            'field_placeholder' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'field_taxonomy' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'field_select_values' => 
            array (
              'value' => 'Meal Option 1, Meal Option 2, Meal Option 3',
              'attachment' => false,
            ),
            'field_width' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
            'field_placement' => 
            array (
              'value' => 'table',
              'attachment' => false,
            ),
            'field_meta_key' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
          3 => 
          array (
            'field_title' => 
            array (
              'value' => 'Additional Information',
              'attachment' => false,
            ),
            'field_description' => 
            array (
              'value' => 'Enter any additional details you\'d like us to know about this guest.',
              'attachment' => false,
            ),
            'field_type' => 
            array (
              'value' => 'textarea',
              'attachment' => false,
            ),
            'field_placeholder' => 
            array (
              'value' => 'Enter any additional details you\'d like us to know about this guest.',
              'attachment' => false,
            ),
            'field_taxonomy' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'field_select_values' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'field_width' => 
            array (
              'value' => '100',
              'attachment' => false,
            ),
            'field_placement' => 
            array (
              'value' => 'table',
              'attachment' => false,
            ),
            'field_meta_key' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'mp_stacks_forms_recaptcha' => 
      array (
        'value' => '',
      ),
      'mp_stacks_forms_submission_actions' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'mp_stacks_forms_action' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'mp_stacks_forms_emails' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'email_subject_line' => 
            array (
              'value' => 'Form submitted from http://demo.mintplugins.com/pattern-wedding-theme-bundle',
              'attachment' => false,
            ),
            'wppost_post_type' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'wppost_post_status' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'mp_stacks_forms_field_titles_font_color' => 
      array (
        'value' => '#475853',
      ),
      'mp_stacks_forms_field_desc_font_color' => 
      array (
        'value' => '#5f766f',
      ),
      'mp_stacks_forms_submit_button_text_color' => 
      array (
        'value' => '#ffffff',
      ),
      'mp_stacks_forms_submit_button_background_color' => 
      array (
        'value' => '#475853',
      ),
      'mp_stacks_forms_submit_button_hover_text_color' => 
      array (
        'value' => '#ffffff',
      ),
      'mp_stacks_forms_submit_button_hover_background_color' => 
      array (
        'value' => '#5f766f',
      ),
      'brick_ct1_shadow_enabled' => 
      array (
        'value' => '',
      ),
      'brick_ct2_shadow_enabled' => 
      array (
        'value' => '',
      ),
      'mp_stacks_parallax_on' => 
      array (
        'value' => 'mp_stacks_parallax_on',
      ),
    ),
    'brick_4' => 
    array (
      'brick_title' => 'Gallery',
      'mp_stack_order' => 1030,
      '_edit_lock' => 
      array (
        'value' => '1447285020:3',
      ),
      '_edit_last' => 
      array (
        'value' => '3',
      ),
      'brick_first_content_type' => 
      array (
        'value' => 'gallery',
      ),
      'brick_alignment' => 
      array (
        'value' => 'centered',
      ),
      'gallery_source' => 
      array (
        'value' => 'wp',
      ),
      'gallery_wp_gallery_shortcode' => 
      array (
        'value' => '[mp_stacks_gallery ids="undefined,undefined,undefined,undefined,undefined,undefined,undefined,undefined,undefined,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71"]',
      ),
      'brick_no_borders' => 
      array (
        'value' => '',
      ),
      'mp_stack_id' => 
      array (
        'value' => '3',
      ),
      'brick_bg_image' => 
      array (
        'value' => '',
      ),
    ),
    'brick_5' => 
    array (
      'brick_title' => '',
      'mp_stack_order' => 1040,
      '_edit_last' => 
      array (
        'value' => '3',
      ),
      'brick_first_content_type' => 
      array (
        'value' => 'singletext',
      ),
      'brick_ct1_shadow_enabled' => 
      array (
        'value' => '',
      ),
      'brick_ct2_shadow_enabled' => 
      array (
        'value' => '',
      ),
      'brick_no_borders' => 
      array (
        'value' => '',
      ),
      'mp_stacks_singletext_content_type_repeater' => 
      array (
        'value' => 
        array (
          0 => 
          array (
            'brick_text_color' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size' => 
            array (
              'value' => '35',
              'attachment' => false,
            ),
            'brick_text_line_height' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_color_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_tablet' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_tablet' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_color_laptop' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_color_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_font_size_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_line_height_mobile' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_paragraph_margin_bottom_mobile' => 
            array (
              'value' => '15',
              'attachment' => false,
            ),
            'brick_text_google_font' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text_google_font_weight_style' => 
            array (
              'value' => '',
              'attachment' => false,
            ),
            'brick_text' => 
            array (
              'value' => '&lt;p&gt;[mp_stack stack=&quot;2&quot;]&lt;/p&gt;
',
              'attachment' => false,
            ),
          ),
        ),
      ),
      'mp_stack_id' => 
      array (
        'value' => '3',
      ),
      '_edit_lock' => 
      array (
        'value' => '1447378794:3',
      ),
    ),
  ),
);
		
		//Loop through each brick
		foreach( $template_array['stack_bricks'] as $brick_name => $brick_options ){
			
			//Loop through each meta option
			foreach( $brick_options as $meta_key => $meta_option ){
				
				//If this isn't the title or the order
				if ( $meta_key != 'brick_title' && $meta_key != 'mp_stack_order' ){
						
					//If this is a repeater
					if ( isset( $meta_option['value'] ) && is_array( $meta_option['value'] ) ){
						
						$fixed_repeaters = array();
						
						$repeat_counter = 0;
						
						//Loop thorugh each repeater
						foreach( $meta_option['value'] as $repeaters ){
							
							//Loop through each field in this repeater
							foreach( $repeaters as $field_key_id => $repeater_meta_option ){
								
								//If this is an attachment, set the url to be local to this plugin
								if ( isset( $repeater_meta_option['attachment'] ) && $repeater_meta_option['attachment'] ){
									
									//Check if this field contains any HTML img tags
									if ( strpos( $repeater_meta_option['value'], '&lt;p&gt;&lt;img' ) !== false ){
										
										//Get the URL in each img tag's "src" attribute
										$value_explode_results = explode( 'src=&quot;', $repeater_meta_option['value'] );
										
										$rebuilt_field_value = NULL;
																			
										//Loop through each exploded string
										if ( is_array( $value_explode_results ) ){
											foreach( $value_explode_results as $value_explode_result ){
																						
												//Get the image url
												$temp_explode_holder = explode( '&quot', $value_explode_result );
												$img_url = $temp_explode_holder[0];
												
												$repeater_meta_option['value'] = str_replace( $img_url, plugins_url( 'images/' . $img_url, __FILE__ ), $repeater_meta_option['value'] );
												
											}
										}
										
										$template_array['stack_bricks'][$brick_name][$meta_key]['value'][$repeat_counter][$field_key_id]['value'] = $repeater_meta_option['value'];
									}
									else{
									
										$template_array['stack_bricks'][$brick_name][$meta_key]['value'][$repeat_counter][$field_key_id]['value'] = plugins_url( 'images/' . $repeater_meta_option['value'], __FILE__ );
									}
									
								}
							}
							
							$repeat_counter = $repeat_counter + 1;
							
						}
					}
					
					//If this is not a repeater
					else{
						
						//If this is an attachment, set the url to be local to this plugin
						if ( isset( $meta_option['attachment'] ) && $meta_option['attachment'] ){
							
							//Check if this field contains any HTML img tags
							if ( strpos( $meta_option['value'], '&lt;p&gt;&lt;img' ) !== false ){
								
								//Get the URL in each img tag's "src" attribute
								$value_explode_results = explode( 'src=&quot;', $meta_option['value'] );
								
								$rebuilt_field_value = NULL;
																
								//Loop through each exploded string
								if ( is_array( $value_explode_results ) ){
									foreach( $value_explode_results as $value_explode_result ){
																				
										//Get the image url
										$temp_explode_holder = explode( '&quot', $value_explode_result );
										$img_url = $temp_explode_holder[0];
	
										$meta_option['value'] = str_replace( $img_url, plugins_url( 'images/' . $img_url, __FILE__ ), $meta_option['value'] );
										
									}
								}
								
								$template_array['stack_bricks'][$brick_name][$meta_key]['value'] = $meta_option['value'];
							}
							else{		
									
								$template_array['stack_bricks'][$brick_name][$meta_key]['value'] = plugins_url( 'images/' . $meta_option['value'], __FILE__ );
							}
						}
						
					}
				}
				
			}
			
		}
		
		return $template_array;
		
	}}