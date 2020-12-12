<?php

require_once( __DIR__ . '/vendor/autoload.php' );

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

// https://www.infophilic.com/remove-jquery-migrate-wordpress/
add_action( 'wp_default_scripts', 'poutine_removeJQueryMigrate' );
function poutine_removeJQueryMigrate( $scripts ) {
  if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
    $script = $scripts->registered['jquery'];
    if ( $script->deps ) { 
      // Check whether the script has any dependencies
      $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
    }
  }
}