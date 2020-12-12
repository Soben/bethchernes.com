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