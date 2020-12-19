<?php

namespace Poutine\BethChernes\Shortcodes;

class Icon
{
  public static function register()
  {
    $class = new self();
    add_shortcode( "icon", array( $class, "render" ) );
  }

  public function render( $atts ) {
    $atts = shortcode_atts( array(
      'class' => 'far fa-exclamation-triangle',
      'size' => null,
    ), $atts, "icon" );

    $styles = "";
    if ($atts['size']) {
      $size = (int)$atts['size'];
      $styles = "width: {$size}px; height: {$size}px;";
    }
 
    return "<i class=\"shortcode-icon {$atts['class']}\" style=\"{$styles}\"></i>";
  }
}