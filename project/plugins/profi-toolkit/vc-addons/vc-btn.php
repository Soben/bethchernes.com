<?php if (!defined('ABSPATH')) die('-1');

vc_map(
	array(
		"name" => esc_html__( "Profi Button", "profi-toolkit" ),
		"base" => "profi_btn",
		"category" => esc_html__( "Profi Theme Addons", "profi-toolkit"),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Button Text", "profi-toolkit" ),
				"param_name" => "btn_text",
				"value" => esc_html__( "Button", "profi-toolkit" ),
				"description" => esc_html__( "Type button text here.", "profi-toolkit" )
			),
			array(
				"type" => "iconpicker",
				"heading" => esc_html__( "Choose Icon", "profi-toolkit" ),
				"param_name" => "btn_icon",
				"value" => esc_html__( "fa fa-thumbs-up", "profi-toolkit" ),
				"description" => esc_html__( "Choose a icon from here.", "profi-toolkit" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Button Link", "profi-toolkit" ),
				"param_name" => "btn_link",
				"value" => esc_html__( "#", "profi-toolkit" ),
				"description" => esc_html__( "Type button link here.", "profi-toolkit" )
			),
		)
	)
);