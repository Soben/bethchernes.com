<?php if (!defined('ABSPATH')) die('-1');

function profi_btn_shortcode( $atts, $content = null ){
    extract( shortcode_atts( array(
        'btn_text'  => esc_html__( 'Button', 'profi-toolkit' ),
        'btn_icon'  => esc_attr__( 'fa fa-thumbs-up', 'profi-toolkit' ),
        'btn_link'	=> '#',
    ), $atts) );

    $btn_markup = '<a href="'.esc_url( $btn_link ).'" class="button"><i class="'.esc_attr( $btn_icon ).'"></i> '.esc_html( $btn_text ).'</a>';

    return $btn_markup;
}
add_shortcode('profi_btn', 'profi_btn_shortcode');