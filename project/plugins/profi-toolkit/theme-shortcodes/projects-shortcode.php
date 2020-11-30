<?php if (!defined('ABSPATH')) die('-1');

function profi_projects_shortcode( $atts, $content = null ){
    extract( shortcode_atts( array(
        'section_bg_color'	=> 0,
    	'sec_title'	=> esc_html__( 'Portfolio.', 'profi-toolkit' ),
        'sec_subtitle' => esc_html__( 'What I done', 'profi-toolkit' ),
        'enable_sec_title' => 1,
    ), $atts) );

	if ( $section_bg_color == 1 ) {
		 $enable_sec_bg_gray = 'section-gray';
	} else {
		 $enable_sec_bg_gray = '';
	}

    $project_categories = get_terms( 'projects_cat' );

    $profi_projects_markup = '

    	<script>
    		jQuery(document).ready(function($){
    			jQuery(".grid").mixitup({
					targetSelector: ".mix"
				});
				jQuery(".image-popup").magnificPopup({
					type:"image",
					gallery:{
						enabled:true
					},
					removalDelay: 300,
					mainClass: "mfp-fade",
				});
    		});
    	</script>

		<section id="portfolio" class="portfolio-area section-padding '.esc_attr( $enable_sec_bg_gray ).'">
			<div class="container">';

			if ( $enable_sec_title == 1 ) {
				$profi_projects_markup .='
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">';

							if (!empty( $sec_title )) {
				                	$profi_projects_markup .='<h2>'.esc_html( $sec_title ).'</h2>';
				            } else {
				                $profi_projects_markup .='';
				            }
				            if (!empty( $sec_subtitle )) {
				                $profi_projects_markup .=''.profi_shovondesign_wp_kses( wpautop( $sec_subtitle ) ).'';
				            } else {
				                $profi_projects_markup .='';
				            }
					    	$profi_projects_markup .='

						</div>
					</div>
				</div>';
			} else {
				$profi_projects_markup .='';
			}

			$profi_projects_markup .='
				<div class="row">
					<div class="portfolio-filter text-center">
						<ul class="list-unstyled">
							<li class="filter active" data-filter="all">all</li>';

							if ( !empty($project_categories) && ! is_wp_error( $project_categories )) {
								foreach ( $project_categories as $category ) {
									$profi_projects_markup .= '<li class="filter" data-filter="'.$category->slug.'">'.$category->name.'</li>';
								}
							}

							$profi_projects_markup .= '
						</ul>
					</div>
					<div class="grid">';

						$projects_array = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'project' ) );

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

						$profi_projects_markup .= '	
						<div class="col-md-4 col-sm-6 mix '.esc_attr( $project_assigned_cat ).'">
							<div class="single-work">

								<img src="'.get_the_post_thumbnail_url( get_the_ID(), 'large' ).'" class="img-responsive" alt="'.get_the_title().'">

								<div class="work-overlay text-center">
									<div class="work-title">
										<a href="'.get_permalink().'">
											<h5>'.get_the_title().'</h5>
										</a>
										<p>'.esc_html( $project_assigned_cat_name ).'</p>
									</div>									
									<div class="work-icon">
										<a href="'.get_the_post_thumbnail_url( get_the_ID(), 'large' ).'" class="image-popup" title="'.get_the_title().'">
											<i class="icon-camera"></i>
										</a>
									</div>
								</div>
							</div>
						</div>';
						endwhile;
						wp_reset_query();
						
					$profi_projects_markup .= '	
					</div>
				</div>
			</div>
		</section>
    ';
    return $profi_projects_markup;
}
add_shortcode('profi_projects', 'profi_projects_shortcode');