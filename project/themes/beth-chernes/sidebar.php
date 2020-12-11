<?php

$context = Timber\Timber::context();
$context['widgets'] = Timber\Timber::get_widgets('primary');

Timber\Timber::render('partials/sidebar.twig', $context);