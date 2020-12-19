<?php

$context = Timber\Timber::context();
$context['posts'] = new Timber\PostQuery();
$context['sidebar'] = Timber\Timber::get_sidebar('sidebar.php');

Timber\Timber::render( 'archive.twig', $context );