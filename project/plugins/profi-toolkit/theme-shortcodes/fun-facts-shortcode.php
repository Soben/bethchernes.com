<?php

function profi_fun_facts_shortcode( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'fun_facts_style'       => 'fun-facts-style-one',
        'fun_facts_icon_type'   => 2,
        'fun_facts_upload_icon' => '',
        'fun_facts_choose_icon' => '',
        'fun_facts_icon_class'  => '',
        'fun_facts_number'      => '',
        'fun_facts_desc'        => '',
        'fun_facts_bg'          => '',
    ), $atts ) );

    $bg_color = ! empty( $fun_facts_bg ) ? 'style="background:' . $fun_facts_bg . '"' : '';

    $profi_fun_facts_markup = '    	
		<div class="profi-fun-facts ' . $fun_facts_style . '" ' . $bg_color . '>';

    if ( $fun_facts_icon_type == 1 ) {
        $fun_facts_icon_array   = wp_get_attachment_image_src( $fun_facts_upload_icon, 'thumbnail' );
        $profi_fun_facts_markup .= '<img src="' . $service_icon_array[0] . '" alt="' . $fun_facts_desc . '">';
    } elseif ( $fun_facts_icon_type == 2 ) {
        $profi_fun_facts_markup .= '<i class="' . $fun_facts_choose_icon . '"></i>';
    } else {
        $profi_fun_facts_markup .= '<i class="' . $fun_facts_icon_class . '"></i>';
    }

    $profi_fun_facts_markup .= '
			<h2 class="timer">' . $fun_facts_number . '</h2>
			' . profi_shovondesign_wp_kses( wpautop( $fun_facts_desc ) ) . '
		</div>
	';

    return $profi_fun_facts_markup;
}

add_shortcode( 'profi_fun_facts', 'profi_fun_facts_shortcode' );