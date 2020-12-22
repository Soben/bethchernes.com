<?php

namespace Poutine\BethChernes\PostTypes;

class Portfolio extends PostType
{
  static $slug = "portfolio";
  static $taxonomySlug = "portfolio-group";
  static $singular = "Portfolio";
  static $plural = "Portfolio";

  public static function registerCPT()
  {
    $labels = [
      "name"                  => self::$plural,
      "singular_name"         => self::$singular,
    ];

    $args = [
      "labels"             => $labels,
      "public"             => true,
      "publicly_queryable" => true,
      "show_ui"            => true,
      "show_in_menu"       => true,
      "query_var"          => true,
      "rewrite"            => [ "slug" => self::$slug ],
      "capability_type"    => "post",
      "has_archive"        => true,
      "hierarchical"       => false,
      "menu_position"      => null,
      "menu_icon"          => "dashicons-portfolio",
      "supports"           => [ "title", "editor", "thumbnail" ],
    ];

    register_post_type( self::$slug, $args );
    self::registerTaxonomies();
  }

  public static function registerTaxonomies()
  {
    $labels = array(
      'name'              => 'Groups',
      'singular_name'     => 'Group',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => false,
    );

    register_taxonomy( 'portfolio-group', array( self::$slug ), $args );
  }

}