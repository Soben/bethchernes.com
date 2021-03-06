<?php

function poutine_getImages()
{
  global $post;
  $mastheadImageURL = $featuredImageURL = null;

  $mastheadImageID = get_post_meta($post->ID, "masthead_background", true);
  if ($mastheadImageID) {
    $mastheadImageURL = wp_get_attachment_image_url($mastheadImageID, 'full');
  }

  $featuredImageID = get_post_thumbnail_id($post);
  if ($featuredImageID) {
    $featuredImageURL = wp_get_attachment_image_url($featuredImageID, 'full');
  }

  return [$mastheadImageURL, $featuredImageURL];
}

function poutine_imageOverridePages()
{
  return ( is_single() || is_front_page() || is_page() );
}

add_action( "wpseo_add_opengraph_additional_images", "poutine_yoast_addOpengraphImagesIfMissing" );
function poutine_yoast_addOpengraphImagesIfMissing ( $container )
{
  if (poutine_imageOverridePages() && count($container->get_images()) <= 0) {
    list ($mastheadImageURL, $featuredImageURL) = poutine_getImages();
    if ($featuredImageURL) {
      $container->add_image($featuredImageURL);
    } else  if ($mastheadImageURL) {
      $container->add_image($mastheadImageURL);
    }
  }
}

add_filter( "wpseo_twitter_image", "poutine_yoast_overrideTwitterImageIfMissing" );
function poutine_yoast_overrideTwitterImageIfMissing ( $image, $presenter = null)
{
  if (poutine_imageOverridePages() && !$image) {
    list ($mastheadImageURL, $featuredImageURL) = poutine_getImages();
    if ($featuredImageURL) {
      return $featuredImageURL;
    }

    if ($mastheadImageURL) {
      return $mastheadImageURL;
    }
  }

  return $image;
}