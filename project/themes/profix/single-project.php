<?php
/**
 * The template for displaying only single project
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Profix
 */

get_header(); 
	
	if ( get_post_meta( $post->ID, 'profi_project_options', true ) ) {
		$page_meta = get_post_meta( $post->ID, 'profi_project_options', true );
	} else {
		$page_meta = array();
	}

	if ( array_key_exists( 'client_details', $page_meta ) ) {
		$client_details = $page_meta['client_details'];
	} else {
		$client_details = '';
	}

	if ( array_key_exists( 'project_date', $page_meta ) ) {
		$project_date = $page_meta['project_date'];
	} else {
		$project_date = '';
	}

	if ( array_key_exists( 'project_url', $page_meta ) ) {
		$project_url = $page_meta['project_url'];
	} else {
		$project_url = '';
	}
?>

	<div <?php if ( has_post_thumbnail() ) : ?>style="background-image: url(<?php echo esc_url( the_post_thumbnail_url('large') ); ?>);" <?php endif; ?> class="profi-breadcrumb-area text-center">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>

	<div class="profi-internal-area single-project-area section-enable-padding">
		<div class="container">
			<div class="row">
				<?php while(have_posts()) : the_post() ;
					$profi_port_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
					?>
				<!-- START SINGLE PROJECT IMAGE DESIGN AREA -->
				<div class="col-md-8">
					<div class="single-project-img">
						<img src="<?php echo esc_url( $profi_port_img['0'] ); ?>" class="img-responsive" alt="Project Image">
					</div>
				</div>
				<!-- / END SINGLE PROJECT IMAGE DESIGN AREA -->
				<!-- START SINGLE PROJECT TEXT DESIGN AREA -->
				<div class="col-md-4">
					<div class="single-project-text">
						<div class="about-single-project">
							<h4><?php esc_html_e( 'About Project', 'profix' ); ?></h4>
							<?php the_content(); ?>
						</div>
						<div class="details-single-project">
							<h4><?php esc_html_e( 'Project Details', 'profix' ); ?></h4>
							<ul class="list-unstyled">
								<?php if( $client_details ) { ?>
								<li><i class="fa fa-user"></i><b><?php esc_html_e( 'Client: ', 'profix' ); ?></b><?php echo esc_html( $client_details ); ?></li>
								<?php }?>
								
								<?php if( $project_date ) { ?>
								<li><i class="fa fa-calendar-o"></i><b><?php esc_html_e( 'Date: ', 'profix' ); ?></b><?php echo esc_html( $project_date ); ?></li>
								<?php }?>

								<li><i class="fa fa-folder-open-o"></i><b><?php esc_html_e( 'Category: ', 'profix' ); ?></b>
									<?php 
										$port_category = get_the_terms(get_the_ID(), 'projects_cat');
										if ( $port_category && ! is_wp_error( $port_category )) {
											foreach ( $port_category as $pcat ) { ?>
												<span class="cat_name"><?php echo esc_html($pcat->name); echo ', ';?></span>
										<?php }
										}
									?>
								</li>
								
								<?php if( $project_url ) { ?>
								<li><i class="fa fa-folder-open-o"></i><b><?php esc_html_e( 'Project Url: ', 'profix' ); ?></b><a href="<?php echo esc_url( $project_url ); ?>" target="_blank"><?php echo esc_html( $project_url ); ?></a></li>
								<?php }?>

							</ul>
						</div>
						<a class="button" href="<?php echo esc_url( $project_url ); ?>" target="_blank"><?php esc_html_e( 'See Live Project', 'profix' ); ?></a>
					</div>
				</div>
				<!-- / END SINGLE PROJECT TEXT DESIGN AREA -->
				<?php endwhile;?>
			</div>


			<!-- START RELATED PROJECT DESIGN AREA -->
			<div class="row">
				<div class="related-projects">
					<div class="col-md-12">
						<h4><?php esc_html_e( 'Related Projects', 'profix' ); ?></h4>
					</div>

					<?php
					$projects_array = new WP_Query( array( 'posts_per_page' => 3, 'post_type' => 'project' ) );

					while($projects_array->have_posts()) : $projects_array->the_post();

					$project_category = get_the_terms( get_the_ID(), 'projects_cat' );

					if ( $project_category && ! is_wp_error( $project_category ) ) {
						$project_cat_list = array();

						foreach ( $project_category as $category ) {
							$project_cat_list[] = $category->slug;
						}
						$project_assigned_cat = join( " ", $project_cat_list );
					} else {
						$project_assigned_cat = '';
					}

					if ( $project_category && ! is_wp_error( $project_category ) ) {
						$project_cat_list = array();

						foreach ( $project_category as $category ) {
							$project_cat_list[] = $category->name;
						}
						$project_assigned_cat_name = join( ", ", $project_cat_list );
					} else {
						$project_assigned_cat_name = '';
					}
					?>

					<!-- START SINGLE PORTFOLIO DESIGN AREA -->
					<div class="col-md-4 col-sm-6 mix <?php echo esc_attr( $project_assigned_cat ); ?>">
						<div class="single-work">

							<img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" class="img-responsive" alt="Project Image">

							<div class="work-overlay text-center">
								<div class="work-title">
									<a href="<?php the_permalink(); ?>">
										<h5><?php the_title(); ?></h5>
									</a>
									<p><?php echo esc_html( $project_assigned_cat_name ); ?></p>
								</div>									
								<div class="work-icon">
									<a href="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" class="image-popup" title="<?php the_title(); ?>">
										<i class="icon-camera"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- / END SINGLE PORTFOLIO DESIGN AREA -->

					<?php endwhile;
					wp_reset_postdata();?>

				</div>
			</div>
			<!-- / END RELATED PROJECT DESIGN AREA -->
		</div>
	</div>

<?php
get_footer();
