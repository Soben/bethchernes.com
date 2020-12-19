<?php

namespace Poutine\BethChernes\Shortcodes;

class Icon
{
  public static function register()
  {
    $class = new self();
    add_shortcode( "icon", [$class, "render"] );
  }

  public function render( $atts ) {
    $atts = shortcode_atts( [
      'class' => 'far fa-exclamation-triangle',
      'size' => null,
      'color' => null,
    ], $atts, "icon" );

    $styles = "";
    if ($atts['size']) {
      $size = (int)$atts['size'];
      $styles = "width: {$size}px; height: {$size}px;";
    }
 
    if ($atts['color'] && in_array($atts['color'], ['gray', 'red', 'black', 'blue'])) {
      $atts['class'] .= " shortcode-icon--{$atts['color']}";
    }

    return "<i class=\"shortcode-icon {$atts['class']}\" style=\"{$styles}\"></i>";
  }
}