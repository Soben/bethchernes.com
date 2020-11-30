<?php
/**
 * Profix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Profix
 */

if ( ! function_exists( 'profi_shovondesign_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function profi_shovondesign_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Profix, use a find and replace
         * to change 'profix' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'profix', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'profi-shovondesign-blog-thumb', 750, 450, true );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'top_menu' => esc_html__( 'Top Menu', 'profix' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'profi_shovondesign_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add theme editor style.
        add_editor_style( 'assets/css/editor-style.css' );

        // Add Gutenberg support.
        add_theme_support( 'gutenberg', array( 'wide-images' => true ) );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );
    }
endif;
add_action( 'after_setup_theme', 'profi_shovondesign_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function profi_shovondesign_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'profi_shovondesign_content_width', 640 );
}

add_action( 'after_setup_theme', 'profi_shovondesign_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function profi_shovondesign_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'profix' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'profix' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'profi_shovondesign_widgets_init' );

/**
 * Register Custom Google fonts.
 */
function profix_fonts_url() {
    $fonts_url = '';

    $profix_body_font            = cs_get_option( 'profix_body_font' );
    $profix_heading_font         = cs_get_option( 'profix_heading_font' );
    $profix_body_font_variant    = cs_get_option( 'profix_body_font_variant' );
    $profix_heading_font_variant = cs_get_option( 'profix_heading_font_variant' );

    if ( ! empty( $profix_body_font ) ) {
        $profix_body_font = cs_get_option( 'profix_body_font' )['family'];
    } else {
        $profix_body_font = 'Ubuntu';
    }
    if ( ! empty( $profix_heading_font ) ) {
        $profix_heading_font = cs_get_option( 'profix_heading_font' )['family'];
    } else {
        $profix_heading_font = 'Lato';
    }
    if ( ! empty( $profix_body_font_variant ) ) {
        $profix_body_font_variant_get = cs_get_option( 'profix_body_font_variant' );
        $profix_body_font_variant     = implode( ',', $profix_body_font_variant_get );
    } else {
        $profix_body_font_variant = '300,300i,400,400i,700,700i';
    }
    if ( ! empty( $profix_heading_font_variant ) ) {
        $profix_heading_font_variant_get = cs_get_option( 'profix_heading_font_variant' );
        $profix_heading_font_variant     = implode( ',', $profix_heading_font_variant_get );
    } else {
        $profix_heading_font_variant = '700,700i,900,900i';
    }

    $font_families = array();

    $font_families[] = '' . esc_html( $profix_body_font ) . ':' . esc_attr( $profix_body_font_variant ) . '';

    if ( $profix_heading_font != $profix_body_font ) {

        $font_families[] = '' . esc_html( $profix_heading_font ) . ':' . esc_attr( $profix_heading_font_variant ) . '';

    }

    $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),
        'subset' => urlencode( 'latin,latin-ext' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function profi_shovondesign_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'profix-fonts', profix_fonts_url(), array(), null );

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), '4.7' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome.min.css', array(), '3.3.7' );
    wp_enqueue_style( 'et-line', get_template_directory_uri() . '/assets/fonts/et-line.css', array(), '1.0.1' );
    wp_enqueue_style( 'pe-icon-7-stroke', get_template_directory_uri() . '/assets/fonts/pe-icon-7-stroke.css', array(), '1.2.0' );
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.1.0' );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.5.0' );
    wp_enqueue_style( 'profix-deafult', get_template_directory_uri() . '/assets/css/deafult.css', array(), '1.0' );
    wp_enqueue_style( 'profix-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0' );
    wp_enqueue_style( 'profix-style', get_stylesheet_uri() );


    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '20151215', true );
    wp_enqueue_script( 'inview', get_template_directory_uri() . '/assets/js/jquery.inview.min.js', array( 'jquery' ), '20151215', true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '20151215', true );
    wp_enqueue_script( 'wow.js', get_template_directory_uri() . '/assets/js/wow.js', array( 'jquery' ), '20151215', true );
    wp_enqueue_script( 'sticky', get_template_directory_uri() . '/assets/js/jquery.sticky.js', array( 'jquery' ), '20151215', true );
    wp_enqueue_script( 'profix-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Add custom Scripts
    $profi_shovondesign_head_scripts     = cs_get_option( 'head_scripts' );
    $profi_shovondesign_body_end_scripts = cs_get_option( 'body_end_scripts' );

    wp_add_inline_script( 'jquery-migrate', $profi_shovondesign_head_scripts );
    wp_add_inline_script( 'profix-scripts', $profi_shovondesign_body_end_scripts );
}

add_action( 'wp_enqueue_scripts', 'profi_shovondesign_scripts' );

// Add Header Menu
function profi_shovondesign_main_menu() {
    if ( has_nav_menu( 'top_menu' ) ) {
        wp_nav_menu(
            array(
                'theme_location' => 'top_menu',
                'container'      => false,
                'fallback_cb'    => false,
                'menu_class'     => 'nav navbar-nav navbar-right',
            )
        );
    } else {
        echo '<ul class="' . esc_attr( 'nav navbar-nav navbar-right' ) . '"><li><a href="' . admin_url( 'nav-menus.php' ) . '">' . esc_html__( 'Add A Menu', 'profix' ) . '</a></li></ul>';
    }
}

// Add "smoth-scroll" class on <a> tag.
function profi_shovondesign_add_nav_class( $a_class ) {
    return preg_replace( '/<a /', '<a class="' . esc_attr( 'smoth-scroll' ) . '" ', $a_class );
}

add_filter( 'wp_nav_menu', 'profi_shovondesign_add_nav_class' );

// Supported wp_kses
function profi_shovondesign_wp_kses( $val ) {
    return wp_kses( $val, array(

        'p'      => array(),
        'span'   => array(),
        'div'    => array(),
        'strong' => array(),
        'b'      => array(),
        'br'     => array(),
        'h1'     => array(),
        'h2'     => array(),
        'h3'     => array(),
        'h4'     => array(),
        'h5'     => array(),
        'h6'     => array(),
        'a'      => array( 'href' => array(), 'target' => array() ),
        'iframe' => array( 'src' => array(), 'height' => array(), 'width' => array() ),
        'img'    => array( 'src' => array(), 'alt' => array() ),

    ), '' );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Theme Options and Metabox Framework
 */
require get_template_directory() . '/inc/cs-framework/cs-framework.php';
require get_template_directory() . '/inc/metabox-and-options.php';
require get_template_directory() . '/inc/custom-style.php';
require get_template_directory() . '/inc/required-plugins.php';

// One Click Demo importer
if ( class_exists( 'OCDI_Plugin' ) ) {
    function profi_shovondesign_import_files() {
        return array(
            array(
                'import_file_name'       => esc_html__( 'Demo Import', 'profix' ),
                'categories'             => array( 'Category' ),
                'local_import_file'      => trailingslashit( get_template_directory() ) . 'inc/demo-data/profix-demo-data.xml',
                'import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo-data/profix-export.dat',
                'import_notice'          => esc_html__( 'After import demo data, just set static homepage from settings > reading, check widgets & menus.', 'profix' )
            ),
        );
    }

    add_filter( 'pt-ocdi/import_files', 'profi_shovondesign_import_files' );
}