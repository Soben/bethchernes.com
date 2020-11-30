 <?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Profix
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if(has_post_thumbnail()) : ?>
		<div class="profi-featured-content">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'profi-shovondesign-blog-thumb' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php
		if ( is_single() ) :

		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php profi_shovondesign_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( is_single() ) {
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'profix' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			} else {
				the_excerpt();
				echo '<a href="'.esc_url( get_permalink() ).'" class="button">'.esc_html__( 'Read More', 'profix' ).'</a>';
			}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'profix' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php profi_shovondesign_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->