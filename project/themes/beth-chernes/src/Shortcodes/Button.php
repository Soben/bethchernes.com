<?php

namespace Poutine\BethChernes\Shortcodes;

class Button
{
  public static function register()
  {
    $class = new self();
    add_shortcode( "button", [ $class, "render" ] );
  }

  public function render( $atts, $content = "Click Me" ) {
    $atts = shortcode_atts( [
      "link" => "#",
      "target" => "_self",
    ], $atts, "button" );
 
    return "<a class=\"btn\" href=\"{$atts["link"]}\">{$content}</a>";
  }
}