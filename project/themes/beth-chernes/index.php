<?php

$context = Timber\Timber::context();
$context['posts'] = Timber\Timber::get_posts();

if (is_singular()) {
  $post = $context['posts'][0];
  $context['header'] = get_field("masthead_title", $post->ID) ?: $post->title;
  $context['subheader'] = get_field("masthead_subheader", $post->ID);
} else if ( is_post_type_archive( "post" ) || is_home() ) {
  $context['header'] = "Blog"; // Title for posts page
} else {
  $context['header'] = "404";
}

Timber\Timber::render( 'index.twig', $context );