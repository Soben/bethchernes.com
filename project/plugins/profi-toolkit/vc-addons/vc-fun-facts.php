<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map(
    array(
        "name"     => __( "Profi Fun Facts Box", "profi-toolkit" ),
        "base"     => "profi_fun_facts",
        "category" => __( "Profi Theme Addons", "profi-toolkit" ),
        "params"   => array(
            array(
                "type"        => "dropdown",
                "heading"     => __( "Fun Facts Style", "profi-toolkit" ),
                "param_name"  => "fun_facts_style",
                "description" => __( "Choose a Fun facts style.", "profi-toolkit" ),
                "std"         => __( "fun-facts-style-one", "profi-toolkit" ),
                "value"       => array(
                    'Style One'   => 'fun-facts-style-one',
                    'Style Two'   => 'fun-facts-style-two',
                    'Style Three' => 'fun-facts-style-three'
                ),
            ),

            array(
                "type"        => "colorpicker",
                "heading"     => __( "Background Color", "profi-toolkit" ),
                "param_name"  => "fun_facts_bg",
                "description" => __( "Choose background color.", "profi-toolkit" ),
            ),

            array(
                "type"        => "dropdown",
                "heading"     => __( "Choose Fun Facts Icon Type", "profi-toolkit" ),
                "param_name"  => "fun_facts_icon_type",
                "description" => __( "Choose a icon type.", "profi-toolkit" ),
                "std"         => __( "2", "profi-toolkit" ),
                "value"       => array(
                    'Upload Icon Image' => 1,
                    'FontAwesome icon'  => 2,
                    'Add Icon Class'    => 3,
                ),
            ),

            array(
                "type"        => "attach_image",
                "heading"     => __( "Upload icon", "profi-toolkit" ),
                "param_name"  => "fun_facts_upload_icon",
                "description" => __( "Upload a icon image.", "profi-toolkit" ),
                "dependency"  => array(
                    "element" => "fun_facts_icon_type",
                    "value"   => array( "1" ),
                )
            ),

            array(
                "type"        => "iconpicker",
                "heading"     => __( "Choose icon", "profi-toolkit" ),
                "param_name"  => "fun_facts_choose_icon",
                "description" => __( "Choose a icon from here.", "profi-toolkit" ),
                "dependency"  => array(
                    "element" => "fun_facts_icon_type",
                    "value"   => array( "2" ),
                )
            ),

            array(
                "type"        => "textfield",
                "heading"     => __( "Icon Class Name", "profi-toolkit" ),
                "param_name"  => "fun_facts_icon_class",
                "description" => __( "Type icon class name here.", "profi-toolkit" ),
                "dependency"  => array(
                    "element" => "fun_facts_icon_type",
                    "value"   => array( "3" ),
                )
            ),

            array(
                "type"        => "textfield",
                "heading"     => __( "Fun Facts Number", "profi-toolkit" ),
                "param_name"  => "fun_facts_number",
                "description" => __( "Type only number here.", "profi-toolkit" ),
            ),

            array(
                "type"        => "textfield",
                "heading"     => __( "Fun Facts discription", "profi-toolkit" ),
                "param_name"  => "fun_facts_desc",
                "description" => __( "Type fun facts discription here.", "profi-toolkit" ),
            ),
        )
    )
);