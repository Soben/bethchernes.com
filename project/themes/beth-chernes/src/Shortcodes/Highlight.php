<?php

namespace Poutine\BethChernes\Shortcodes;

class Highlight
{
  public static function register()
  {
    $class = new self();
    add_shortcode( "highlight", array( $class, "render" ) );
  }

  public function render( $atts, $content = "" ) {
    $atts = shortcode_atts( array(
    ), $atts, "highlight" );
 
    return "<span class=\"highlight\">{$content}</span>";
  }
}