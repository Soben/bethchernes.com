<?php

namespace Poutine\BethChernes\PostTypes;

class Services extends PostType
{
  static $slug = "services";
  static $singular = "Service";
  static $plural = "Services";

  public static function registerCPT()
  {
    $labels = [
      "name"                  => self::$plural,
      "singular_name"         => self::$singular,
    ];

    $args = [
      "labels"             => $labels,
      "public"             => true,
      "publicly_queryable" => false,
      "show_ui"            => true,
      "show_in_menu"       => true,
      "query_var"          => true,
      "rewrite"            => [ "slug" => self::$slug ],
      "capability_type"    => "post",
      "has_archive"        => true,
      "hierarchical"       => false,
      "menu_position"      => null,
      "menu_icon"          => "dashicons-admin-site-alt",
      "supports"           => [ "title", "editor", "thumbnail" ],
    ];

    register_post_type( self::$slug, $args );
  }

  public static function registerTaxonomies()
  {

  }

}