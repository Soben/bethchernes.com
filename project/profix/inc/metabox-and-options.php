<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

// remove default shortcode options
function profi_shovondesign_shortcode_options( $options ) {
	$options      = array();
}
add_filter( 'cs_shortcode_options', 'profi_shovondesign_shortcode_options' );

// remove default customizer 
function profi_shovondesign_customizer( $options ) {
	$options      = array();
}
add_filter( 'cs_customize_options', 'profi_shovondesign_customizer' );

function profi_shovondesign_metabox_options( $options ) {

	$options      = array(); // remove old options
	/*-------------------
	Page Meta Options
	---------------------*/
	$options[]    = array(
		'id'        => 'profi_page_options',
		'title'     => esc_html__('Page Options', 'profix'),
		'post_type' => 'page',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name' => 'profi_page_options_meta',
				'icon'  => 'fa fa-cog',
				'fields' => array(
					array(
						'id'    => 'enable_title',
						'type'  => 'switcher',
						'title' => esc_html__('Enable Page Title?', 'profix'),
						'default' => true,
						'desc' => esc_html__('If you want to enable Page title, please select On', 'profix'),
					),
					array(
						'id'    => 'custome_title',
						'type'  => 'text',
						'title' => esc_html__('Custome Page Title?', 'profix'),
						'dependency'   => array( 'enable_title', '==', 'true' ),
						'desc' => esc_html__('If you want to custome Page title, please type here.', 'profix'),
					),
				),
			)
		),
	);

	/*-------------------
	Slides Meta Options
	---------------------*/
	$options[]    = array(
		'id'        => 'profi_slide_options',
		'title'     => esc_html__('Slide Options', 'profix'),
		'post_type' => 'slide',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name' => 'profi_slide_options_meta',
				'fields' => array(
					array(
						'id'              => 'social_options',
						'type'            => 'group',
						'title'           => esc_html__('Social Icons', 'profix'),
						'button_title'    => esc_html__('Add New', 'profix'),
						'accordion_title' => esc_html__('Add New Icon', 'profix'),
						'fields'          => array(
							array(
								'id'    => 'social_icon',
								'type'  => 'icon',
								'title' => esc_html__('Choose Icon', 'profix'),
								'desc' => esc_html__('Choose a social icon.', 'profix'),
							),
							array(
								'id'    => 'social_link',
								'type'  => 'text',
								'title' => esc_html__('Type URL', 'profix'),
								'desc' => esc_html__('Enter social profile link here.', 'profix'),
							),
						),
					),
					array(
						'id'    => 'enable_overlay',
						'type'  => 'switcher',
						'default'  => true,
						'title' => esc_html__('Enable Overlay?', 'profix'),
						'desc' => esc_html__('Select On for enable overlay.', 'profix'),
					),
					array(
						'id'    => 'overlay_percentage',
						'type'  => 'text',
						'default' => esc_attr('.3'),
						'title' => esc_html__('Overlay Percentage', 'profix'),
						'desc' => esc_html__('Type Overlay Percentage in floting number. Max value is 1', 'profix'),
						'dependency'   => array( 'enable_overlay', '==', 'true' ),
					),
					array(
						'id'      => 'overlay_color',
						'type'    => 'color_picker',
						'title'   => esc_html__('Overlay Color', 'profix'),
						'desc' => esc_html__('Choose overlay color from here.', 'profix'),
						'default' => esc_attr('#000000'),
						'dependency'   => array( 'enable_overlay', '==', 'true' ),
					),
				),
			),
		),
	);

	/*-------------------
	Services Meta Options
	---------------------*/
	$options[]    = array(
		'id'        => 'profi_service_options',
		'title'     => esc_html__('Service Icon Options', 'profix'),
		'post_type' => 'services',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name' => 'profi_service_options_meta',
				'fields' => array(
					array(
						'id'       => 'icon_type',
						'type'     => 'select',
						'title'    => esc_html__('Select Icon Type', 'profix'),
						'default'  => esc_html__('choose_icon', 'profix'),
						'options'  => array(
							'choose_icon'   => esc_html__('Choose Font Icon', 'profix'),
							'upload_icon'  => esc_html__('Upload Icon Image', 'profix'),
						),
					),
					array(
						'id'            => 'upload_service_icon',
						'type'          => 'upload',
						'title'         => esc_html__('Upload Icon Image', 'profix'),
						'settings'      => array(
							'upload_type'  => 'image',
							'button_title' => esc_html__('Upload', 'profix'),
							'frame_title'  => esc_html__('Select an image', 'profix'),
							'insert_title' => esc_html__('Use this image', 'profix'),
						),
						'dependency'   => array( 'icon_type', '==', 'upload_icon' ),
						'desc' => esc_html__('Upload an image for icon.', 'profix'),
					),
					array(
						'id'    => 'choose_service_icon',
						'type'  => 'icon',
						'title' => esc_html__('Choose Font Icon', 'profix'),
						'dependency'   => array( 'icon_type', '==', 'choose_icon' ),
						'desc' => esc_html__('Choose service font icon here.', 'profix'),
					),
				),
			),
		),
	);

	/*-------------------
	Project Meta Options
	---------------------*/
	$options[]    = array(
		'id'        => 'profi_project_options',
		'title'     => esc_html__('Project Options', 'profix'),
		'post_type' => 'project',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name' => 'profi_project_options_meta',
				'fields' => array(
					array(
						'id'    => 'client_details',
						'type'  => 'text',
						'default' => esc_html__('ShovonDesign, Inc.', 'profix'),
						'title' => esc_html__('Client Details', 'profix'),
						'desc' => esc_html__('Type client details here.', 'profix'),
					),
					array(
						'id'    => 'project_date',
						'type'  => 'text',
						'default' => esc_html__('July 30, 2017', 'profix'),
						'title' => esc_html__('Project Date', 'profix'),
						'desc' => esc_html__('Type project date here.', 'profix'),
					),
					array(
						'id'    => 'project_url',
						'type'  => 'text',
						'default' => esc_html__('http://www.shovondesign.com', 'profix'),
						'title' => esc_html__('Project Url', 'profix'),
						'desc' => esc_html__('Type project url here.', 'profix'),
					),
				),
			)
		),
	);


	/*-----------------------
	Testimonials Meta Options
	-------------------------*/
	$options[]    = array(
		'id'        => 'profi_testimonial_options',
		'title'     => esc_html__('Testimonial Options', 'profix'),
		'post_type' => 'testimonials',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name' => 'profi_testimonial_options_meta',
				'fields' => array(
					array(
						'id'    => 'author_discription',
						'type'  => 'text',
						'title' => esc_html__('Testimonial Author Discription', 'profix'),
						'desc' => esc_html__('Type testimonial author discription here.', 'profix'),
					),
				),
			)
		),
	);

	return $options;

}
add_filter( 'cs_metabox_options', 'profi_shovondesign_metabox_options' );


function profi_shovondesign_theme_option_settings ( $settings ) {

	$settings = array();

	$settings	= array(
		'menu_title'      => esc_html__('Theme Options', 'profix'),
		'menu_type'       => 'theme',
		'menu_slug'       => 'profi-theme-options',
		'ajax_save'       => true,
		'show_reset_all'  => true,
		'framework_title' => esc_html__('Profix. - by ShovonDesign', 'profix'),
	);

	return $settings;
}
add_filter('cs_framework_settings', 'profi_shovondesign_theme_option_settings');


function profi_shovondesign_theme_options($options){
       
    $options = array(); // remove old opotions

	$options[]    = array(
		'name'      => 'profi_general_setting',
		'title'     => esc_html__('General Setting', 'profix'),
		'icon'      => 'fa fa-cogs',
		'fields'    => array(
			array(
				'id'    => 'enable_image_logo',
				'type'  => 'switcher',
				'title' => esc_html__('Enable Image Logo', 'profix'),
				'default' => true,
				'label' => esc_html__('Select ON for enable image logo.', 'profix'),
			),
			array(
				'id'    => 'image_logo',
				'type'  => 'upload',
				'title' => esc_html__('Add Image Logo', 'profix'),
				'desc' => esc_html__('Add Your Image LOGO here', 'profix'),
				'default' => get_template_directory_uri() . '/assets/img/logo.png',
				'dependency'   => array( 'enable_image_logo', '==', 'true' ),
			),
			array(
				'id'    => 'image_logo_max_height',
				'type'  => 'text',
				'default'   => esc_attr('50'),
				'title' => esc_html__('Logo Maximum Height', 'profix'),
				'desc' => esc_html__('Type logo maximum height in px', 'profix'),
				'dependency'   => array( 'enable_image_logo', '==', 'true' ),
			),
			array(
              'id'      => 'enable_preloader',
              'type'    => 'switcher',
              'title'   => esc_html__('Enable Preloader', 'profix'),
              'default' => true,
              'label' => esc_html__('Select ON for show preloader.', 'profix'),
            ),
		)
	);

	$options[]    = array(
		'name'      => 'profi_typography_setting',
		'title'     => esc_html__('Typography Setting', 'profix'),
		'icon'      => 'fa fa-font',
		'fields'    => array(
			array(
				'id'    => 'profix_body_font',
				'type'      => 'typography',
				'title' => esc_html__('Body Font', 'profix'),
				'desc' => esc_html__('Select body font and body font weight.', 'profix'),
				'default' => array(
					'family'  => 'Ubuntu',
					'variant' => '300',
					'font'    => 'google', // this is helper for output
				),
			),
			array(
				'id'       => 'profix_body_font_variant',
				'type'     => 'checkbox',
				'title'    => esc_html__('Body font types', 'profix'),
				'desc' => esc_html__('Select font types which are want to load on your site.', 'profix'),
				'options'  => array(
					'100'  => esc_html__('100', 'profix'),
					'100i'  => esc_html__('100i', 'profix'),
					'200'  => esc_html__('200', 'profix'),
					'200i'  => esc_html__('200i', 'profix'),
					'300'  => esc_html__('300', 'profix'),
					'300i'  => esc_html__('300i', 'profix'),
					'400'  => esc_html__('400', 'profix'),
					'400i'  => esc_html__('400i', 'profix'),
					'500'  => esc_html__('500', 'profix'),
					'500i'  => esc_html__('500i', 'profix'),
					'600'  => esc_html__('600', 'profix'),
					'600i'  => esc_html__('600i', 'profix'),
					'700'  => esc_html__('700', 'profix'),
					'700i'  => esc_html__('700i', 'profix'),
					'800'  => esc_html__('800', 'profix'),
					'800i'  => esc_html__('800i', 'profix'),
					'900'  => esc_html__('900', 'profix'),
					'900i'  => esc_html__('900i', 'profix'),
				),
				'default'  => array( '300', '300i', '400', '400i', '700', '700i' )
			),
			array(
				'id'        => 'profix_heading_font',
				'type'      => 'typography',
				'title'     => esc_html__('Heading Font', 'profix'),
				'desc' => esc_html__('Select heading font and heading font weight.', 'profix'),
				'default'   => array(
					'family'  => 'Lato',
					'variant' => '900',
					'font'    => 'google', // this is helper for output
				),
			),
			array(
				'id'       => 'profix_heading_font_variant',
				'type'     => 'checkbox',
				'title'    => esc_html__('Heading font types', 'profix'),
				'desc' => esc_html__('Select font types which are want to load on your site.', 'profix'),
				'options'  => array(
					'100'  => esc_html__('100', 'profix'),
					'100i'  => esc_html__('100i', 'profix'),
					'200'  => esc_html__('200', 'profix'),
					'200i'  => esc_html__('200i', 'profix'),
					'300'  => esc_html__('300', 'profix'),
					'300i'  => esc_html__('300i', 'profix'),
					'400'  => esc_html__('400', 'profix'),
					'400i'  => esc_html__('400i', 'profix'),
					'500'  => esc_html__('500', 'profix'),
					'500i'  => esc_html__('500i', 'profix'),
					'600'  => esc_html__('600', 'profix'),
					'600i'  => esc_html__('600i', 'profix'),
					'700'  => esc_html__('700', 'profix'),
					'700i'  => esc_html__('700i', 'profix'),
					'800'  => esc_html__('800', 'profix'),
					'800i'  => esc_html__('800i', 'profix'),
					'900'  => esc_html__('900', 'profix'),
					'900i'  => esc_html__('900i', 'profix'),
				),
				'default'  => array( '700', '700i', '900', '900i' )
			),
		)
	);


	$options[]    = array(
		'name'      => 'profi_blog_setting',
		'title'     => esc_html__('Blog Setting', 'profix'),
		'icon'      => 'fa fa-newspaper-o',
		'fields'    => array(
			array(
				'id'        => 'post_by',
				'type'      => 'switcher',
				'title'     => esc_html__('Display Post By?', 'profix'),
				'default'   => true,
				'label' => esc_html__('Select ON for show Post By.', 'profix'),
			),
			array(
				'id'        => 'post_date',
				'type'      => 'switcher',
				'title'     => esc_html__('Display Post Date?', 'profix'),
				'default'   => true,
				'label' => esc_html__('Select ON for show post date.', 'profix'),
			),
			array(
				'id'        => 'post_comment',
				'type'      => 'switcher',
				'title'     => esc_html__('Display Comment Counts?', 'profix'),
				'default'   => true,
				'label' => esc_html__('Select ON for show comment counts.', 'profix'),
			),
			array(
				'id'        => 'post_category',
				'type'      => 'switcher',
				'title'     => esc_html__('Display Post Categories?', 'profix'),
				'default'   => true,
				'label' => esc_html__('Select ON for show post categories.', 'profix'),
			),
			array(
				'id'        => 'post_tag',
				'type'      => 'switcher',
				'title'     => esc_html__('Display Post Tags?', 'profix'),
				'default'   => true,
				'label' => esc_html__('Select ON for show post tags.', 'profix'),
			),
			array(
				'id'        => 'post_nav',
				'type'      => 'switcher',
				'title'     => esc_html__('Display Post Navigation?', 'profix'),
				'default'   => true,
				'label' => esc_html__('Select ON for show post navigation.', 'profix'),
			),
		)
	);

	$options[]    = array(
		'name'      => 'profi_footer_setting',
		'title'     => esc_html__('Footer Setting', 'profix'),
		'icon'      => 'fa fa-pencil-square-o',
		'fields'    => array(
			array(
				'id'        => 'footer_bg',
				'type'      => 'color_picker',
				'title'     => esc_html__('Footer Background Color.', 'profix'),
				'desc' => esc_html__('Choose a color for footer background.', 'profix'),
				'default'   => esc_attr('#333'),
			),
			array(
				'id'        => 'text_color',
				'type'      => 'color_picker',
				'title'     => esc_html__('Footer Text Color.', 'profix'),
				'desc' => esc_html__('Choose a color for footer text.', 'profix'),
				'default'   => esc_attr('#fff'),
			),
			array(
				'id'        => 'footer_copyright_text',
				'type'      => 'textarea',
				'title'     => esc_html__('Footer Copyright Text.', 'profix'),
				'desc' => esc_html__('Enter footer text here.', 'profix'),
				'default'   => esc_html__('Copyright 2017 PROFIX - All Rights Reserved.', 'profix'),
			),
		)
	);

	$options[]    = array(
		'name'      => 'profi_scripts_setting',
		'title'     => esc_html__('Scripts Setting', 'profix'),
		'icon'      => 'fa fa-file-code-o',
		'fields'    => array(
			array(
				'id'    => 'head_scripts',
				'type'  => 'textarea',
				'title' => esc_html__('Head Scripts', 'profix'),
				'sanitize' => false,
				'desc' => esc_html__('scripts goes before closing </head>', 'profix'),
				),
			array(
				'id'    => 'body_end_scripts',
				'type'  => 'textarea',
				'title' => esc_html__('Footer Scripts', 'profix'),
				'sanitize' => false,
				'desc' => esc_html__('scripts goes before closing </body>', 'profix'),
			),
		)
	);       

	return $options;
}
add_filter('cs_framework_options', 'profi_shovondesign_theme_options');