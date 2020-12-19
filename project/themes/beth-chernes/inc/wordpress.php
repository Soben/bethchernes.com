<?php

// Clean up of Wordpress items.

// Remove wp-emoji
// https://kinsta.com/knowledgebase/disable-emojis-wordpress/#disable-emojis-code
add_action( "init", "poutine_removeEmoji" );
function poutine_removeEmoji() {
  remove_action( "wp_head", "print_emoji_detection_script", 7 );
  remove_action( "admin_print_scripts", "print_emoji_detection_script" );
  remove_action( "wp_print_styles", "print_emoji_styles" );
  remove_action( "admin_print_styles", "print_emoji_styles" ); 
  remove_filter( "the_content_feed", "wp_staticize_emoji" );
  remove_filter( "comment_text_rss", "wp_staticize_emoji" ); 
  remove_filter( "wp_mail", "wp_staticize_emoji_for_email" );
  add_filter( "tiny_mce_plugins", function($plugins) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, ["wpemoji"] );
    } else {
      return [];
    }
  });
  add_filter( "wp_resource_hints", function($urls, $relation_type) {
    if ( "dns-prefetch" == $relation_type ) {
      $emoji_svg_url = apply_filters( "emoji_svg_url", "https://s.w.org/images/core/emoji/2/svg/" );
      $urls = array_diff( $urls, [$emoji_svg_url] );
    }

    return $urls;
  }, 10, 2 );
}

// Remove JQuery Migrate
// https://www.infophilic.com/remove-jquery-migrate-wordpress/
add_action( "wp_default_scripts", "poutine_removeJQueryMigrate" );
function poutine_removeJQueryMigrate( $scripts ) {
  if ( ! is_admin() && isset( $scripts->registered["jquery"] ) ) {
    $script = $scripts->registered["jquery"];
    if ( $script->deps ) { 
      // Check whether the script has any dependencies
      $script->deps = array_diff( $script->deps, ["jquery-migrate"] );
    }
  }
}