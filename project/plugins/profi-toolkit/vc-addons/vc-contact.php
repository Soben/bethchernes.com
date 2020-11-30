<?php if (!defined('ABSPATH')) die('-1');

vc_map(
	array(
		"name" => esc_html__( "Profi Contact Section", "profi-toolkit" ),
		"base" => "profi_contact",
		"category" => esc_html__( "Profi Theme Addons", "profi-toolkit"),
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Section Background Color", "profi-toolkit" ),
				"param_name" => "section_bg_color",
				"std" => esc_html__( "0", "profi-toolkit" ),
				"value"	=> array(
					esc_html__( "White Color", "profi-toolkit") => '0',
					esc_html__( "Gray Color", "profi-toolkit") => '1',
				),
				"description" => esc_html__( "Choose background color.", "profi-toolkit" ),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Enable Section Heading & Sub-Heading?", "profi-toolkit" ),
				"param_name" => "enable_sec_title",
				"std" => esc_html__( "true", "profi-toolkit" ),
				"value"	=> array(
					esc_html__( "Yes", "profi-toolkit" ) => '1',
					esc_html__( "No", "profi-toolkit" ) => '0',
				),
				"description" => esc_html__( "Select 'Yes' for Show and 'No' for Hide.", "profi-toolkit" ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Section Title", "profi-toolkit" ),
				"param_name" => "sec_title",
				"std" => esc_html__( "Conatct.", "profi-toolkit" ),
				"description" => esc_html__( "Type section title here.", "profi-toolkit"),
				"dependency" => array(
					"element" => "enable_sec_title",
					"value" => array("1"),
				)
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Section Sub-title", "profi-toolkit" ),
				"param_name" => "sec_subtitle",
				"std" => esc_html__( "Say hello", "profi-toolkit" ),
				"description" => esc_html__( "Type section sub-title here.", "profi-toolkit"),
				"dependency" => array(
					"element" => "enable_sec_title",
					"value" => array("1"),
				)
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Enter Shortcode ID", "profi-toolkit" ),
				"param_name" => "contact_get_id",
				"description" => esc_html__( "Enter Contact Form shortcode ID number.", "profi-toolkit")
			),
		)
	)
);