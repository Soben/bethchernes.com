<?php

$context = Timber\Timber::context();
$context['posts'] = new Timber\PostQuery();
$context['sidebar'] = Timber\Timber::get_sidebar('sidebar.php');
$context['subheader'] = get_the_archive_title();

Timber\Timber::render( 'archive.twig', $context );