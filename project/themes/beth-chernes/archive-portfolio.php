<?php

$context = Timber\Timber::context();
$context['headerTitle'] = 'Portfolio';

$taxonomiesToDisplay = get_field('portfolio_ordering', 'options');
$portfolioItemsByTerm = [];
foreach ($taxonomiesToDisplay as $current) {
  $currentTermDetails =  new Timber\Term($current['term']);

  if (!$currentTermDetails) {
    // Term might've been deleted. Ignore.
    continue;
  }

  $postArgs = [
    'post_type' => Poutine\BethChernes\PostTypes\Portfolio::$slug,
    'tax_query' => [
      [
        'taxonomy' => Poutine\BethChernes\PostTypes\Portfolio::$taxonomySlug,
        'field'    => 'term_id',
        'terms'    => $currentTermDetails->ID,
      ],
    ],
    'posts_per_page' => 6,
  ];;

  array_push($portfolioItemsByTerm, [
    'term' => $currentTermDetails,
    'entries' => Timber\Timber::get_posts($postArgs),
  ]);
}

$context['postsByTerm'] = $portfolioItemsByTerm;
Timber\Timber::render( 'portfolio.twig', $context );