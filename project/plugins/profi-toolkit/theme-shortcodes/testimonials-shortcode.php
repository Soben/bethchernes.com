<?php if (!defined('ABSPATH')) die('-1');

function profi_testimonials_shortcode( $atts ){
    extract( shortcode_atts( array(
        'section_bg_color'	=> 0,
    	'sec_title'	=> esc_html__( 'Testimonial.', 'profi-toolkit' ),
        'sec_subtitle' => esc_html__( 'Client says about me', 'profi-toolkit' ),
        'enable_sec_title' => 1,
        'count'	=> -1,
		'loop'	=> 'true',
		'autoplay'	=> 'true',
		'autoplayTimeout'	=> 5000,
		'nav'	=> 'true',
		'dots'	=> 'true',
    ), $atts) );

	if ( $section_bg_color == 1 ) {
		 $enable_sec_bg_gray = 'section-gray';
	} else {
		 $enable_sec_bg_gray = '';
	}

	$profi_testimonials_markup = '
    <script>
		jQuery(window).load(function(){
			jQuery(".testimonial-carousel").owlCarousel({
				items: 1,
				loop: '.$loop.',
				autoplay: '.$autoplay.',
				autoplayTimeout: '.$autoplayTimeout.',
				nav: '.$nav.',
				dots: '.$dots.', 
				navText:["<i class=\'fa fa-angle-double-left\'></i>", "<i class=\'fa fa-angle-double-right\'></i>"],
			});
		});
	</script>

	<section id="testimonial" class="testimonial-area section-padding text-center '.esc_attr( $enable_sec_bg_gray ).'">
		<div class="container">';

			if ( $enable_sec_title == 1 ) {
				$profi_testimonials_markup .='
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">';

							if (!empty( $sec_title )) {
				                	$profi_testimonials_markup .='<h2>'.esc_html( $sec_title ).'</h2>';
				            } else {
				                $profi_testimonials_markup .='';
				            }
				            if (!empty( $sec_subtitle )) {
				                $profi_testimonials_markup .=''.profi_shovondesign_wp_kses( wpautop( $sec_subtitle ) ).'';
				            } else {
				                $profi_testimonials_markup .='';
				            }
					    	$profi_testimonials_markup .='

						</div>
					</div>
				</div>';
			} else {
				$profi_testimonials_markup .='';
			}

			$profi_testimonials_markup .='
			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-sm-12">
					<div>
						<div class="testimonial-carousel">';

							$testimonial_array = new WP_Query( array( 'posts_per_page' => $count, 'post_type' => 'testimonials' ) );

							while($testimonial_array->have_posts()) : $testimonial_array->the_post();

							if ( get_post_meta( get_the_ID(), 'profi_testimonial_options', true ) ) {
								$testimonial_meta = get_post_meta( get_the_ID(), 'profi_testimonial_options', true);
							} else {
								$testimonial_meta = array();
							}

							if (array_key_exists('author_discription', $testimonial_meta)) {
								$author_discription = $testimonial_meta['author_discription'];
							} else {
								$author_discription = '';
							}

							$post_content = get_the_content();

							$profi_testimonials_markup .='
							<div class="item">
								<div class="testimonial-img">
									<img src="'.esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ).'" class="img-responsive" alt="'.esc_html( get_the_title() ).'" />
									<h4>'.esc_html( get_the_title() ).'</h4>';

									if ( !empty( $author_discription ) ) {
										$profi_testimonials_markup .='<h6>'.esc_html( $author_discription ).'</h6>';
									} else {
										$profi_testimonials_markup .='';
									}
									
									$profi_testimonials_markup .='
								</div>
								'.wpautop( $post_content ).'
							</div>';

							endwhile;
							wp_reset_query();

						$profi_testimonials_markup .='
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	';
    return $profi_testimonials_markup;
}
add_shortcode('profi_testimonials', 'profi_testimonials_shortcode');