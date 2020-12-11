<?php

$context = Timber\Timber::context();
$context['posts'] = Timber\Timber::get_posts();
$context['sidebar'] = Timber\Timber::get_sidebar('sidebar.php');

Timber\Timber::render( 'archive.twig', $context );