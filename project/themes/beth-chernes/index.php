<?php

$context = Timber\Timber::context();
$context["posts"] = new Timber\PostQuery();

if ( is_front_page() === true ) {
  $context["masthead_social"] = poutine_getSocialLinks();
}

if ( is_singular() ) {
  $context["modules"] = poutine_processModules($context["posts"][0]->ID);
}

Timber\Timber::render( "index.twig", $context );