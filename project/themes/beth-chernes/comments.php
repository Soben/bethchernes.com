<?php
  // No Comments on Password Protected pages/posts
  if ( post_password_required() ) {
    return;
  }
?>

<section class="content-comments">
	<?php
	if ( have_comments() ) : ?>
		<h2 class="comments__title">Feedback</h2><!-- .comments__title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text sr-only">Comment Navigation</h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( 'Older Comments' ); ?></div>
				<div class="nav-next"><?php next_comments_link( 'Newer Comments' ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text sr-only">Comment navigation</h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( 'Older Comments' ); ?></div>
				<div class="nav-next"><?php next_comments_link( 'Newer Comments' ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments">Comments are closed.</p>
	<?php
	endif;

	comment_form();
	?>

</section>
