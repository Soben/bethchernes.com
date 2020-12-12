<?php

namespace Poutine\BethChernes\Shortcodes;

use Timber\Timber;
use Poutine\BethChernes\Theme;

class Social
{
  public static function register()
  {
    $class = new self();
    add_shortcode( "social", array( $class, "render" ) );
  }

  public function render( $atts, $content = "Click Me" ) {
    $atts = shortcode_atts( [
    ], $atts, "social" );
 
    Theme::include_fontAwesome();
    
    $context = [];
    $context['links'] = poutine_getSocialLinks();

    return Timber::fetch( 'partials/social.twig', $context );
  }
}