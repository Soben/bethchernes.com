<?php if (!defined('ABSPATH')) die('-1');

vc_map(
	array(
		"name" => esc_html__( "Profi Home Slides", "profi-toolkit" ),
		"base" => "profi_home_slides",
		"category" => esc_html__( "Profi Theme Addons", "profi-toolkit"),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Slides Count", "profi-toolkit" ),
				"param_name" => "count",
				"value" => esc_html__( "3", "profi-toolkit" ),
				"description" => esc_html__( "Type slides count number, how much you want to show (-1 for unlimited slides). If you want to show single benner type 1", "profi-toolkit" )
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Single Benner", "profi-toolkit" ),
				"param_name" => "slider_id",
				"value"	=> profi_toolkit_get_slide_as_list(),
				"description" => esc_html__( "Choose a slide for single benner", "profi-toolkit" ),
				"dependency" => array(
					"element" => "count",
					"value" => array("1"),
				)
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Slider Height", "profi-toolkit" ),
				"param_name" => "height",
				"value" => esc_html__( "650", "profi-toolkit" ),
				"description" => esc_html__( "Type slider height here in px.", "profi-toolkit" )
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Enable Loop?", "profi-toolkit" ),
				"param_name" => "loop",
				"std" => esc_html__( "true", "profi-toolkit" ),
				"value"	=> array(
					esc_html__( "Yes", "profi-toolkit" ) => 'true',
					esc_html__( "No", "profi-toolkit" ) => 'false',
				),
				"description" => esc_html__( "Select Yes for enable slides loop.", "profi-toolkit" ),
				"dependency" => array(
					"element" => "count",
					"value" => array("-1","2","3","4","5","6","7","8","9","10"),
				)
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Enable Autoplay?", "profi-toolkit" ),
				"param_name" => "autoplay",
				"std" => esc_html__( "true", "profi-toolkit" ),
				"value"	=> array(
					esc_html__( "Yes", "profi-toolkit" ) => 'true',
					esc_html__( "No", "profi-toolkit" ) => 'false',
				),
				"description" => esc_html__( "Select Yes for enable slides autoplay.", "profi-toolkit" ),
				"dependency" => array(
					"element" => "count",
					"value" => array("-1","2","3","4","5","6","7","8","9","10"),
				)
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Slides Timeout", "profi-toolkit" ),
				"param_name" => "autoplayTimeout",
				"std" => esc_html__( "5000", "profi-toolkit" ),
				"value"	=> array(
					esc_html__( "1 Second", "profi-toolkit" ) => '1000',
					esc_html__( "2 Seconds", "profi-toolkit" ) => '2000',
					esc_html__( "3 Seconds", "profi-toolkit" ) => '3000',
					esc_html__( "4 Seconds", "profi-toolkit" ) => '4000',
					esc_html__( "5 Seconds", "profi-toolkit" ) => '5000',
				),
				"description" => esc_html__( "Select slides timeout.", "profi-toolkit" ),
				"dependency" => array(
					"element" => "count",
					"value" => array("-1","2","3","4","5","6","7","8","9","10"),
				)
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Enable Navigation Icon?", "profi-toolkit" ),
				"param_name" => "nav",
				"std" => esc_html__( "true", "profi-toolkit" ),
				"value"	=> array(
					esc_html__( "Yes", "profi-toolkit" ) => 'true',
					esc_html__( "No", "profi-toolkit" ) => 'false',
				),
				"description" => esc_html__( "Select Yes for enable slides navigation icon.", "profi-toolkit" ),
				"dependency" => array(
					"element" => "count",
					"value" => array("-1","2","3","4","5","6","7","8","9","10"),
				)
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Enable Dots?", "profi-toolkit" ),
				"param_name" => "dots",
				"std" => esc_html__( "true", "profi-toolkit" ),
				"value"	=> array(
					esc_html__( "Yes", "profi-toolkit" ) => 'true',
					esc_html__( "No", "profi-toolkit" ) => 'false',
				),
				"description" => esc_html__( "Select Yes for enable slides dots.", "profi-toolkit" ),
				"dependency" => array(
					"element" => "count",
					"value" => array("-1","2","3","4","5","6","7","8","9","10"),
				)
			),
		)
	)
);