<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Profix
 */

get_header(); ?>
	
	<div class="profi-breadcrumb-area text-center">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'profix' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php if ( function_exists('bcn_display')) bcn_display(); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="profi-internal-area section-enable-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<?php
					if ( have_posts() ) : ?>
					
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
				</div>

				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>

<?php
get_footer();
