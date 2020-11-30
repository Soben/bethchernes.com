<?php
/*
Plugin Name: Profi Toolkit
Plugin URI: http://shovondesign.com
Description: After install the Profix WordPress Theme, you must need to install this "Profi Toolkit Plugin" first to get all functions of Profix WP Theme.
Author: Tanvirul Haque
Author URI: http://www.shovondesign.com
Version: 1.0.2
Text Domain: profi-toolkit
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define
define( 'PROFI_ACC_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'PROFI_ACC_PATH', plugin_dir_path( __FILE__ ) );


function profi_toolkit_get_slide_as_list() {

    $args = wp_parse_args( array(
        'post_type'   => 'slide',
        'numberposts' => - 1,
    ) );

    $posts = get_posts( $args );

    $post_options = array( esc_html__( '--Select Slide--', 'profi-toolkit' ) => '' );

    if ( $posts ) {
        foreach ( $posts as $post ) {
            $post_options[ $post->post_title ] = $post->ID;
        }
    }

    return $post_options;
}


add_action( 'init', 'profi_toolkit_custom_post' );
function profi_toolkit_custom_post() {
    register_post_type( 'slide',
        array(
            'labels'    => array(
                'name'          => esc_html__( 'Slides', 'profi-toolkit' ),
                'singular_name' => esc_html__( 'Slide', 'profi-toolkit' )
            ),
            'supports'  => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'menu_icon' => 'dashicons-images-alt2',
            'public'    => false,
            'show_ui'   => true,
        )
    );

    register_post_type( 'services',
        array(
            'labels'    => array(
                'name'          => esc_html__( 'Services', 'profi-toolkit' ),
                'singular_name' => esc_html__( 'Service', 'profi-toolkit' )
            ),
            'supports'  => array( 'title', 'editor', 'page-attributes' ),
            'menu_icon' => 'dashicons-admin-site',
            'public'    => false,
            'show_ui'   => true,
        )
    );

    register_post_type( 'project',
        array(
            'labels'    => array(
                'name'          => esc_html__( 'Projects', 'Post Type General Name', 'profi-toolkit' ),
                'singular_name' => esc_html__( 'Project', 'Post Type Singular Name', 'profi-toolkit' )
            ),
            'supports'  => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'menu_icon' => 'dashicons-portfolio',
            'public'    => true,
        )
    );

    register_post_type( 'testimonials',
        array(
            'labels'    => array(
                'name'          => esc_html__( 'Testimonials', 'profi-toolkit' ),
                'singular_name' => esc_html__( 'Testimonial', 'profi-toolkit' )
            ),
            'supports'  => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'menu_icon' => 'dashicons-testimonial',
            'public'    => false,
            'show_ui'   => true,
        )
    );
}

function profi_toolkit_custom_post_taxonomy() {
    register_taxonomy(
        'projects_cat',
        'project',
        array(
            'hierarchical'      => true,
            'label'             => esc_html__( 'Project Category', 'profi-toolkit' ),
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array(
                'slug'       => 'project-category',
                'with_front' => true
            )
        )
    );
}

add_action( 'init', 'profi_toolkit_custom_post_taxonomy' );


// Print Shortcode in widgets
add_filter( 'widget_text', 'do_shortcode' );


// Loading VC addon
require_once( PROFI_ACC_PATH . 'vc-addons/vc-blocks-load.php' );


// Theme Shortcodes
require_once( PROFI_ACC_PATH . 'theme-shortcodes/home-slides-shortcode.php' );
require_once( PROFI_ACC_PATH . 'theme-shortcodes/about-shortcode.php' );
require_once( PROFI_ACC_PATH . 'theme-shortcodes/section-title-shortcode.php' );
require_once( PROFI_ACC_PATH . 'theme-shortcodes/btn-shortcode.php' );
require_once( PROFI_ACC_PATH . 'theme-shortcodes/services-shortcode.php' );
require_once( PROFI_ACC_PATH . 'theme-shortcodes/fun-facts-shortcode.php' );
require_once( PROFI_ACC_PATH . 'theme-shortcodes/projects-shortcode.php' );
require_once( PROFI_ACC_PATH . 'theme-shortcodes/testimonials-shortcode.php' );
require_once( PROFI_ACC_PATH . 'theme-shortcodes/contact-shortcode.php' );


//Registering Profi Toolkit File
function profi_toolkit_files() {
    wp_enqueue_style( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'assets/css/owl.carousel.css' );
    wp_enqueue_style( 'profi-toolkit', plugin_dir_url( __FILE__ ) . 'assets/css/profi-toolkit.css' );

    wp_enqueue_script( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'assets/js/owl.carousel.min.js', array( 'jquery' ), '20120206', true );
    wp_enqueue_script( 'mixitup', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.mixitup.min.js', array( 'jquery' ), '20120206', true );
}

add_action( 'wp_enqueue_scripts', 'profi_toolkit_files' );