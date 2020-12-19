<?php

namespace Poutine\BethChernes\Shortcodes;

class Highlight
{
  public static function register()
  {
    $class = new self();
    add_shortcode( "highlight", [ $class, "render" ] );
  }

  public function render( $atts, $content = "" ) {
    $atts = shortcode_atts( [
    ], $atts, "highlight" );
 
    return "<span class=\"highlight\">{$content}</span>";
  }
}