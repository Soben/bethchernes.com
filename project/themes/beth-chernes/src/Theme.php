<?php

namespace Poutine\BethChernes;

use Timber;
use Twig;

class Theme extends Timber\Site {
 
	static $THEME_NAME = "beth-chernes";
	static $VERSION = "2021.01.28";
	
	/** Register */
	public function __construct() {
		// Filters
		add_filter( "timber/context", [$this, "add_to_context"] );
		add_filter( "timber/twig", [$this, "add_to_twig"] );
		add_filter( "get_the_archive_title", [$this, "cleanup_archive_title"] );
		// add_filter( "style_loader_tag", [$this, "preload_css"], 10, 4 );

		if (! defined("WP_LOCAL_DEV") || ! WP_LOCAL_DEV) {
			// Hide ACF Admin Panel on Staging/Production
			add_filter("acf/settings/show_admin", "__return_false");
			add_filter("acf/settings/capability", function () { return "do_not_allow"; });
		}

		// Actions
		add_action( "after_setup_theme", [$this, "theme_supports"] );
		add_action( "init", [$this, "disable_emoji"]);
		add_action( "init", [$this, "register_post_types"] );
		add_action( "init", [$this, "register_taxonomies"] );
		add_action( "init", [$this, "register_acf_fields"] );
		add_action( "init", [$this, "register_shortcodes"] );
		add_action( "widgets_init", [$this, "register_sidebars"] );
		add_action( "wp_enqueue_scripts", [$this, "enqueue_styles"] );
		add_action( "wp_enqueue_scripts", [$this, "enqueue_scripts"] );
		add_action( "after_setup_theme", [$this, "register_menus"] );
		add_action( "wp_print_scripts", [$this, "include_print_scripts"] );

		parent::__construct();
	}

	public function disable_emoji ()
	{
		remove_action( "wp_head", "print_emoji_detection_script", 7 );
		remove_action( "admin_print_scripts", "print_emoji_detection_script" );
		remove_action( "wp_print_styles", "print_emoji_styles" );
		remove_action( "admin_print_styles", "print_emoji_styles" ); 
		remove_filter( "the_content_feed", "wp_staticize_emoji" );
		remove_filter( "comment_text_rss", "wp_staticize_emoji" ); 
		remove_filter( "wp_mail", "wp_staticize_emoji_for_email" );
		add_filter( "tiny_mce_plugins", [$this, "disable_emojis_tinymce"] );
		add_filter( "wp_resource_hints", [$this, "disable_emojis_remove_dns_prefetch"], 10, 2 );
	}

	public function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( "wpemoji" ) );
		} else {
			return array();
		}
	}
	 
	public function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( "dns-prefetch" == $relation_type ) {
			/** This filter is documented in wp-includes/formatting.php */
			$emoji_svg_url = apply_filters( "emoji_svg_url", "https://s.w.org/images/core/emoji/2/svg/" );
			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}

		return $urls;
	}

	public function cleanup_archive_title( $title ) {
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
		register_nav_menu( "footer_menu", "Footer Menu" );
	}
	
	public function enqueue_styles() {
		wp_enqueue_style( self::$THEME_NAME, get_stylesheet_directory_uri() . "/assets/css/main.css", [], self::$VERSION );
	}
	
	public function enqueue_scripts() {
		wp_enqueue_script( "font-awesome", "https://kit.fontawesome.com/2e5bb6538f.js", [], "5.15.1", true );
		wp_enqueue_script( "flickity", get_stylesheet_directory_uri() . "/assets/js/vendor/flickity.js", ["jquery"], "2.2.1", true );
		wp_enqueue_script( self::$THEME_NAME, get_stylesheet_directory_uri() . "/assets/js/main.js", ["jquery", "flickity", "font-awesome"], self::$VERSION, true );
	}

	public function preload_css($html, $handle, $href, $media) {
		if (is_admin()) {
			return $html;
		}
		
		$html = <<<EOT
			<link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" id="{$handle}" href="{$href}" type="text/css" media="{$media}" />
		EOT;
		
		return $html;
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
		$context["menu_footer"] = new Timber\Menu( "footer_menu" );
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
		$twig->addFilter( new Timber\Twig_Filter('esc_attr', function($title) {
			return esc_attr( $title );
		}));
		return $twig;
	}
}