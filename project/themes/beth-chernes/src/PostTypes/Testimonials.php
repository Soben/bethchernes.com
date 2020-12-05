<?php

namespace Poutine\BethChernes\PostTypes;

class Testimonials extends PostType
{
  static $slug = "testimonials";
  static $singular = "Testimonial";
  static $plural = "Testimonials";

  public static function registerCPT()
  {
    $labels = array(
      "name"                  => self::$plural,
      "singular_name"         => self::$singular,
  );

  $args = array(
      "labels"             => $labels,
      "public"             => true,
      "publicly_queryable" => false,
      "show_ui"            => true,
      "show_in_menu"       => true,
      "query_var"          => true,
      "rewrite"            => array( "slug" => self::$slug ),
      "capability_type"    => "post",
      "has_archive"        => true,
      "hierarchical"       => false,
      "menu_position"      => null,
      "menu_icon"          => "dashicons-format-status",
      "supports"           => array( "title", "editor", "thumbnail" ),
  );

  register_post_type( self::$slug, $args );
  }

  public static function registerTaxonomies()
  {

  }

}