<?php if (!defined('ABSPATH')) die('-1');

vc_map(
	array(
		"name" => esc_html__( "Profi Section Title", "profi-toolkit" ),
		"base" => "profi_section_title",
		"category" => esc_html__( "Profi Theme Addons", "profi-toolkit"),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Section Title", "profi-toolkit" ),
				"param_name" => "sec_title",
				"value" => esc_html__( "Section Title.", "profi-toolkit" ),
				"description" => esc_html__( "Type section title here.", "profi-toolkit" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Section Sub-Title", "profi-toolkit" ),
				"param_name" => "sec_subtitle",
				"value" => esc_html__( "section sub title", "profi-toolkit" ),
				"description" => esc_html__( "Type section sub-title here.", "profi-toolkit" )
			),
		)
	)
);