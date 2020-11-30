<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map(
    array(
        "name"     => esc_html__( "Profi Services Section", "profi-toolkit" ),
        "base"     => "profi_services",
        "category" => esc_html__( "Profi Theme Addons", "profi-toolkit" ),
        "params"   => array(
            array(
                "type"        => "dropdown",
                "heading"     => esc_html__( "Section Background Color", "profi-toolkit" ),
                "param_name"  => "section_bg_color",
                "std"         => esc_html__( "0", "profi-toolkit" ),
                "value"       => array(
                    esc_html__( "White Color", "profi-toolkit" ) => '0',
                    esc_html__( "Gray Color", "profi-toolkit" )  => '1',
                ),
                "description" => esc_html__( "Choose background color.", "profi-toolkit" ),
            ),
            array(
                "type"        => "dropdown",
                "heading"     => esc_html__( "Enable Section Heading & Sub-Heading?", "profi-toolkit" ),
                "param_name"  => "enable_sec_title",
                "std"         => esc_html__( "true", "profi-toolkit" ),
                "value"       => array(
                    esc_html__( "Yes", "profi-toolkit" ) => '1',
                    esc_html__( "No", "profi-toolkit" )  => '0',
                ),
                "description" => esc_html__( "Select 'Yes' for Show and 'No' for Hide.", "profi-toolkit" ),
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__( "Section Title", "profi-toolkit" ),
                "param_name"  => "sec_title",
                "std"         => esc_html__( "Services.", "profi-toolkit" ),
                "description" => esc_html__( "Type section title here.", "profi-toolkit" ),
                "dependency"  => array(
                    "element" => "enable_sec_title",
                    "value"   => array( "1" ),
                )
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__( "Section Sub-title", "profi-toolkit" ),
                "param_name"  => "sec_subtitle",
                "std"         => esc_html__( "What I do", "profi-toolkit" ),
                "description" => esc_html__( "Type section sub-title here.", "profi-toolkit" ),
                "dependency"  => array(
                    "element" => "enable_sec_title",
                    "value"   => array( "1" ),
                )
            ),
            array(
                "type"        => "dropdown",
                "heading"     => esc_html__( "Enable Loop?", "profi-toolkit" ),
                "param_name"  => "loop",
                "std"         => esc_html__( "true", "profi-toolkit" ),
                "value"       => array(
                    esc_html__( "Yes", "profi-toolkit" ) => 'true',
                    esc_html__( "No", "profi-toolkit" )  => 'false',
                ),
                "description" => esc_html__( "Select Yes for enable slides loop.", "profi-toolkit" ),
            ),
            array(
                "type"        => "dropdown",
                "heading"     => esc_html__( "Enable Autoplay?", "profi-toolkit" ),
                "param_name"  => "autoplay",
                "std"         => esc_html__( "true", "profi-toolkit" ),
                "value"       => array(
                    esc_html__( "Yes", "profi-toolkit" ) => 'true',
                    esc_html__( "No", "profi-toolkit" )  => 'false',
                ),
                "description" => esc_html__( "Select Yes for enable slides autoplay.", "profi-toolkit" ),
            ),
            array(
                "type"        => "dropdown",
                "heading"     => esc_html__( "Slide Timeout", "profi-toolkit" ),
                "param_name"  => "autoplayTimeout",
                "std"         => esc_html__( "5000", "profi-toolkit" ),
                "value"       => array(
                    esc_html__( "1 Second", "profi-toolkit" )  => '1000',
                    esc_html__( "2 Seconds", "profi-toolkit" ) => '2000',
                    esc_html__( "3 Seconds", "profi-toolkit" ) => '3000',
                    esc_html__( "4 Seconds", "profi-toolkit" ) => '4000',
                    esc_html__( "5 Seconds", "profi-toolkit" ) => '5000',
                ),
                "description" => esc_html__( "Select slides timeout.", "profi-toolkit" ),
            ),
            array(
                "type"        => "dropdown",
                "heading"     => esc_html__( "Enable Navigation Icon?", "profi-toolkit" ),
                "param_name"  => "nav",
                "std"         => esc_html__( "true", "profi-toolkit" ),
                "value"       => array(
                    esc_html__( "Yes", "profi-toolkit" ) => 'true',
                    esc_html__( "No", "profi-toolkit" )  => 'false',
                ),
                "description" => esc_html__( "Select Yes for enable slides navigation icon.", "profi-toolkit" ),
            ),
            array(
                "type"        => "dropdown",
                "heading"     => esc_html__( "Enable Dots?", "profi-toolkit" ),
                "param_name"  => "dots",
                "std"         => esc_html__( "true", "profi-toolkit" ),
                "value"       => array(
                    esc_html__( "Yes", "profi-toolkit" ) => 'true',
                    esc_html__( "No", "profi-toolkit" )  => 'false',
                ),
                "description" => esc_html__( "Select Yes for enable slides dots.", "profi-toolkit" ),
            ),
        )
    )
);