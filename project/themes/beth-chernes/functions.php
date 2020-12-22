<?php

require_once( __DIR__ . '/vendor/autoload.php' );
require_once( __DIR__ . '/inc/wordpress.php' );

new Poutine\BethChernes\Theme();

function poutine_getSocialLinks()
{
  return [
    "twitter"     => [
      "link" => get_field("link_twitter", "options"),
      "icon" => "fab fa-twitter",
      "name" => "Twitter",
    ],
    "linkedin"    => [
      "link" => get_field("link_linkedin", "options"),
      "icon" => "fab fa-linkedin-in",
      "name" => "Linkedin",
    ],
    "facebook"    => [
      "link" => get_field("link_facebook", "options"),
      "icon" => "fab fa-facebook-f",
      "name" => "Facebook",
    ],
    "instagram"   => [
      "link" => get_field("link_instagram", "options"),
      "icon" => "fab fa-instagram",
      "name" => "Instagram",
    ],
  ];
}

function poutine_processModules( $postID )
{
  $modules = get_field("modules", $postID);

  if ( !$modules || count($modules) <= 0) {
    return;
  }

  foreach ($modules as &$current) {
    switch ($current["module"]) {
      case "services":
        $args = [
          "posts_per_page" => 3,
          "post_type" => Poutine\BethChernes\PostTypes\Services::$slug,
          "orderby" => "post__in",
        ];
        if ( $current["services"]["show_latest"] === false ) {
          $args["post__in"] = $current["services"]["items"];
        }
        $current["displayItems"] = Timber\Timber::get_posts($args);
        break;
      case "blog":
        $args = [
          "posts_per_page" => 3,
          "post_type" => "post",
          "orderby" => "post__in",
        ];
        if ( $current["posts"]["show_latest"] === false ) {
          $args["post__in"] = $current["posts"]["items"];
        }
        $current["displayItems"] = Timber\Timber::get_posts($args);
        break;
      case "testimonials":
        $args = [
          "posts_per_page" => 3,
          "post_type" => Poutine\BethChernes\PostTypes\Testimonials::$slug,
          "orderby" => "post__in",
        ];
        $args["post__in"] = $current["testimonials"]["items"];
        $current["displayItems"] = Timber\Timber::get_posts($args);
        break;
      case "portfolio":
          $args = [
            "posts_per_page" => 3,
            "post_type" => Poutine\BethChernes\PostTypes\Portfolio::$slug,
            "orderby" => "post__in",
          ];
          if ( $current["portfolio"]["show_latest"] === false ) {
            $args["post__in"] = $current["portfolio"]["items"];
          }
          $current["displayItems"] = Timber\Timber::get_posts($args);
          break;
      case "form":
        // Determine what the form Shortcode needs to be, if anything.
        if (count($current["form"]["form"]) >= 1) {
          $current["formID"] = $current["form"]["form"][0];
        }
        break;
      case "rich-text":
      default:
        continue 2;
    }
  }

  return $modules;
}