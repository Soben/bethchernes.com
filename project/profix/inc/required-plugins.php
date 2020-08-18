<?php

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'profi_shovondesign_register_required_plugins' );

function profi_shovondesign_register_required_plugins() {
	
	$plugins = array(

		array(
			'name'               => esc_html__('Profi Toolkit', 'profix'), 
			'slug'               => 'profi-toolkit', 
			'source'             => get_template_directory() . '/inc/plugins/profi-toolkit.zip', 
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),

		array(
			'name'               => esc_html__('WPBakery Visual Composer', 'profix'), 
			'slug'               => 'js_composer', 
			'source'             => get_template_directory() . '/inc/plugins/js_composer.zip', 
			'required'           => true,
			'force_activation'   => false, 
			'force_deactivation' => false,
		),

		array(
			'name'      => esc_html__('Contact Form 7', 'profix'),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
        
		array(
			'name'      => esc_html__('Breadcrumb NavXT', 'profix'),
			'slug'      => 'breadcrumb-navxt',
			'required'  => true,
		),

		array(
			'name'      => esc_html__('One Click Demo Import', 'profix'),
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),

		array(
			'name'      => esc_html__('Classic Editor', 'profix'),
			'slug'      => 'classic-editor',
			'required'  => true,
		),

	);

	$config = array(
		'id'           => 'profix',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}