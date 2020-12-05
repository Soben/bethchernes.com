<?php

namespace Poutine\BethChernes;

use Timber;
use Twig;

class Theme extends Timber\Site {
 
	static $THEME_NAME = "beth-chernes";
	
	/** Register */
	public function __construct() {
		// Filters
		add_filter( "timber/context", array( $this, "add_to_context" ) );
		add_filter( "timber/twig", array( $this, "add_to_twig" ) );

		// Actions
		add_action( "after_setup_theme", array( $this, "theme_supports" ) );
		add_action( "init", array( $this, "register_post_types" ) );
		add_action( "init", array( $this, "register_taxonomies" ) );
		add_action( "wp_enqueue_scripts", array( $this, "enqueue_styles" ) );
		add_action( "wp_enqueue_scripts", array( $this, "enqueue_scripts" ) );

		parent::__construct();
	}
	
	public function enqueue_styles() {
		wp_enqueue_style( self::$THEME_NAME, get_stylesheet_directory_uri() . "/assets/css/main.css", array(), "20201204" );
	}
	
	public function enqueue_scripts() {
		wp_enqueue_script( self::$THEME_NAME, get_stylesheet_directory_uri() . "/assets/js/main.js", array("jquery"), "20201204", true );
	}
  
	/** Custom Post Types */
	public function register_post_types() {
		PostTypes\Testimonials::registerCPT();
		PostTypes\Services::registerCPT();
	}
	/** Custom Taxonomies */
	public function register_taxonomies() {

	}

	/** Global Context
	 *
	 * @param string $context
	 */
	public function add_to_context( $context ) {
		$context["menu"]  = new Timber\Menu();
    $context["site"]  = $this;
    
		return $context;
	}

	public function theme_supports() {
		add_theme_support( "title-tag" );
		add_theme_support( "post-thumbnails" );
		add_theme_support( "menus" );

		add_theme_support(
			"html5",
			array(
				"comment-form",
				"comment-list",
				"gallery",
				"caption",
			)
		);
	}

	/** Custom Twig Functions
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		// $twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		// $twig->addFilter( new Twig\TwigFilter( "myfoo", array( $this, "myfoo" ) ) );
		return $twig;
	}
}