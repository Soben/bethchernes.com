<?php

$context = Timber\Timber::context();
$context['posts'] = Timber\Timber::get_posts();

if ( is_front_page() === true ) {
  Poutine\BethChernes\Theme::include_fontAwesome();
  $context['masthead_social'] = poutine_getSocialLinks();
}

Timber\Timber::render( 'index.twig', $context );