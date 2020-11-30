<?php if (!defined('ABSPATH')) die('-1');

function profi_section_title_shortcode( $atts, $content = null ){
    extract( shortcode_atts( array(
        'sec_title'	=> esc_html__( 'Section Title.', 'profi-toolkit' ),
        'sec_subtitle' => esc_html__( 'section sub title', 'profi-toolkit' ),
    ), $atts) );

    $section_title_markup = '
		<div class="section-title text-center">';
                    
            if (!empty( $sec_title )) {
                $section_title_markup .='<h2>'.esc_html( $sec_title ).'</h2>';
            } else {
                $section_title_markup .='';
            }
            if (!empty( $sec_subtitle )) {
                $section_title_markup .=''.profi_shovondesign_wp_kses( wpautop( $sec_subtitle ) ).'';
            } else {
                $section_title_markup .='';
            }

        $section_title_markup .='
        </div>
    ';

    return $section_title_markup;
}
add_shortcode('profi_section_title', 'profi_section_title_shortcode');