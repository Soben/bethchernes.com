<?php

namespace Poutine\BethChernes;

use Timber;
use Twig;

class Theme extends Timber\Site {
 
	static $THEME_NAME = "beth-chernes";
	static $VERSION = "2020.12.21";
	
	/** Register */
	public function __construct() {
		// Filters
		add_filter( "timber/context", [$this, "add_to_context"] );
		add_filter( "timber/twig", [$this, "add_to_twig"] );

		// Actions
		add_action( "after_setup_theme", [$this, "theme_supports"] );
		add_action( "init", [$this, "register_post_types"] );
		add_action( "init", [$this, "register_taxonomies"] );
		add_action( "init", [$this, "register_acf_fields"] );
		add_action( "init", [$this, "register_shortcodes"] );
		add_action( "widgets_init", [$this, "register_sidebars"] );
		add_action( "wp_enqueue_scripts", [$this, "enqueue_styles"] );
		add_action( "wp_enqueue_scripts", [$this, "enqueue_scripts"] );
		add_action( "after_setup_theme", [$this, "register_menus"] );
		add_action( "wp_print_scripts", [$this, "include_print_scripts"] );
		add_filter( "get_the_archive_title", [$this, "cleanup_archive_title"] );

		parent::__construct();
	}

	function cleanup_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( "", false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( "", false );
    } elseif ( is_author() ) {
        $title = "<span class=\"vcard\">" . get_the_author() . "</span>";
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( "", false );
    } elseif ( is_tax() ) {
        $title = single_term_title( "", false );
		} elseif ( is_year() ) {
        $title = get_the_date( "Y" );
    } elseif ( is_month() ) {
				$title = get_the_date( "F Y" );
		}
  
    return $title;
	}

	public function include_print_scripts() {
		if ( (!is_admin()) && is_singular() && comments_open() && get_option("thread_comments") ) {
			wp_enqueue_script( "comment-reply" );
		}
	}

	public function register_sidebars() {
		Sidebars\Primary::register();
	}

	public function register_shortcodes() {
		Shortcodes\Button::register();
		Shortcodes\Icon::register();
		Shortcodes\Highlight::register();
		Shortcodes\Social::register();
	}

	public function register_menus() {
		register_nav_menu( "top_menu", "Primary Menu" );
	}
	
	public function enqueue_styles() {
		wp_enqueue_style( self::$THEME_NAME, get_stylesheet_directory_uri() . "/assets/css/main.css", [], self::$VERSION );
	}
	
	public function enqueue_scripts() {
		wp_enqueue_script( "font-awesome", "https://kit.fontawesome.com/2e5bb6538f.js", [], "5.15.1" );
		wp_enqueue_script( "flickity", get_stylesheet_directory_uri() . "/assets/js/vendor/flickity.js", ["jquery"], "2.2.1", true );
		wp_enqueue_script( self::$THEME_NAME, get_stylesheet_directory_uri() . "/assets/js/main.js", ["jquery", "flickity", "font-awesome"], self::$VERSION, true );
	}
	
	public function register_acf_fields() {
		if (!function_exists("acf_add_options_page")) {
			return;
		}

		acf_add_options_page([
      "page_title" 	=> "Theme Settings",
      "menu_title"	=> "Theme Settings",
      "menu_slug" 	=> "theme-settings",
      "capability"	=> "edit_posts",
      "redirect"		=> false
    ]);
	}

	/** Custom Post Types */
	public function register_post_types() {
		PostTypes\Portfolio::registerCPT();
		PostTypes\Services::registerCPT();
		PostTypes\Testimonials::registerCPT();
	}
	/** Custom Taxonomies */
	public function register_taxonomies() {

	}

	/** Global Context
	 *
	 * @param string $context
	 */
	public function add_to_context( $context ) {
		$context["menu"] = new Timber\Menu( "top_menu" );
		$context["logo"] = new Timber\Image( get_field("logo", "options") );
		$context["copyright"] = get_field("copyright", "options") ?: get_bloginfo("name");
		$context["site"]  = $this;
    
		return $context;
	}

	public function theme_supports() {
		add_theme_support( "title-tag" );
		add_theme_support( "post-thumbnails" );
		add_theme_support( "menus" );

		add_theme_support(
			"html5",
			[
				"comment-form",
				"comment-list",
				"gallery",
				"caption",
			]
		);
	}

	/** Custom Twig Functions
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		// $twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		// $twig->addFilter( new Twig\TwigFilter( "myfoo", [$this, "myfoo"] ) );
		return $twig;
	}
}