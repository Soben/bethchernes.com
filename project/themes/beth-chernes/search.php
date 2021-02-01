<?php

$context = Timber\Timber::context();

$context['posts'] = new Timber\PostQuery();
$context['sidebar'] = Timber\Timber::get_sidebar('sidebar.php');

$context['headerTitle'] = "Search";

$searchTerm = get_search_query();
$context['subheader'] = "Results for '{$searchTerm}'";

Timber\Timber::render( 'archive.twig', $context );