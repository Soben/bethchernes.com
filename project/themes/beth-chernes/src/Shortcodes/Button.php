<?php

namespace Poutine\BethChernes\Shortcodes;

class Button
{
  public static function register()
  {
    $class = new self();
    add_shortcode( "button", array( $class, "render" ) );
  }

  public function render( $atts, $content = "Click Me" ) {
    $atts = shortcode_atts( array(
      "link" => "#",
      "target" => "_self",
    ), $atts, "button" );
 
    return "<a class=\"btn\" href=\"{$atts["link"]}\">{$content}</a>";
  }
}