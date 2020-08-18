<?php if ( ! defined( 'ABSPATH' ) ) {
    die;
} // Cannot access pages directly.

function profi_shovondesign_custom_css() {
    wp_enqueue_style(
        'profi_custom_style',
        get_template_directory_uri() . '/assets/css/custom_style.css'
    );

    $profix_body_font    = cs_get_option( 'profix_body_font' );
    $profix_heading_font = cs_get_option( 'profix_heading_font' );

    if ( ! empty( $profix_body_font ) ) {
        $profix_body_font         = cs_get_option( 'profix_body_font' )['family'];
        $profix_body_font_variant = cs_get_option( 'profix_body_font' )['variant'];
    } else {
        $profix_body_font         = 'Ubuntu';
        $profix_body_font_variant = '300';
    }

    if ( ! empty( $profix_heading_font ) ) {
        $profix_heading_font         = cs_get_option( 'profix_heading_font' )['family'];
        $profix_heading_font_variant = cs_get_option( 'profix_heading_font' )['variant'];
    } else {
        $profix_heading_font         = 'Lato';
        $profix_heading_font_variant = '900';
    }

    $footer_bg  = cs_get_option( 'footer_bg' );
    $text_color = cs_get_option( 'text_color' );

    $custom_css = '
        body { font-family:' . esc_html( $profix_body_font ) . '; font-weight:' . esc_attr( $profix_body_font_variant ) . ' } 
        h1,h2,h3,h4,h5,h6, .navbar-brand { font-family: ' . esc_html( $profix_heading_font ) . '; font-weight:' . esc_attr( $profix_heading_font_variant ) . ' }
    ';

    if ( ! empty( $footer_bg ) ) {
        $custom_css .= '
            .copyright {background-color:' . esc_attr( $footer_bg ) . '}
        ';
    }

    if ( ! empty( $text_color ) ) {
        $custom_css .= '
            .copyright {color:' . esc_attr( $text_color ) . ';}
        ';
    }

    wp_add_inline_style( 'profi_custom_style', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'profi_shovondesign_custom_css' );