<?php if (!defined('ABSPATH')) die('-1');

vc_map( 
	array(
		"name" => esc_html__( "Profi About Section", "profi-toolkit" ),
		"base" => "profi_about_section",
		"category" => esc_html__( "Profi Theme Addons", "profi-toolkit"),
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Section Background Color", "profi-toolkit" ),
				"param_name" => "section_bg_color",
				"std" => esc_html__( "0", "profi-toolkit" ),
				"value"	=> array(
					esc_html__( "White Color", "profi-toolkit" ) => '0',
					esc_html__( "Gray Color", "profi-toolkit" ) => '1',
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
				"std" => esc_html__( "About Me.", "profi-toolkit" ),
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
				"std" => esc_html__( "Who am i", "profi-toolkit" ),
				"description" => esc_html__( "Type section sub-title here.", "profi-toolkit"),
				"dependency" => array(
					"element" => "enable_sec_title",
					"value" => array("1"),
				)
			),
			array(
				"type" => "attach_image",
				"heading" => esc_html__( "About Image", "profi-toolkit" ),
				"param_name" => "about_img",
				"description" => esc_html__( "Add about image (Image size must be 2x3 ration.)", "profi-toolkit")
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__( "About Text", "profi-toolkit" ),
				"param_name" => "about_text",
				"description" => esc_html__( "Type about text here.", "profi-toolkit")
			),
			array(
				'type' => 'param_group',
				"heading" => esc_html__( "About Skills", "profi-toolkit" ),
				'param_name' => 'skills',
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => 'Skill Title',
						'param_name' => 'skill_title',
						"description" => esc_html__( "Type skill title here.", "profi-toolkit" ),
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => 'Skill Value',
						'param_name' => 'skill_value',
						"description" => esc_html__( "Type skill percentage number (Max velu 100).", "profi-toolkit" ),
						'admin_label' => true,
					),
				)
			),
			array(
				'type' => 'param_group',
				"heading" => esc_html__( "About Buttons", "profi-toolkit" ),
				'param_name' => 'about_btns',
				'params' => array(
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Button Text", "profi-toolkit" ),
						"param_name" => "btn_text",
						"value" => '',
						"description" => esc_html__( "Type button text here.", "profi-toolkit" ),
						'admin_label' => true,
					),
					array(
						"type" => "iconpicker",
						"heading" => esc_html__( "Choose Icon", "profi-toolkit" ),
						"param_name" => "btn_icon",
						"value" => '',
						"description" => esc_html__( "Choose a icon from here.", "profi-toolkit" ),
						'admin_label' => true,
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Button Link", "profi-toolkit" ),
						"param_name" => "btn_link",
						"value" => '',
						"description" => esc_html__( "Type button link here.", "profi-toolkit" ),
						'admin_label' => true,
					),
				)
			),
		)
	)
);