<?php

$context = Timber\Timber::context();
$context['posts'] = new Timber\PostQuery();
$context['headerTitle'] = 'Portfolio';

Timber\Timber::render( 'portfolio.twig', $context );