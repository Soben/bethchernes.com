<?php if (!defined('ABSPATH')) die('-1');

function profi_services_shortcode( $atts ){
    extract( shortcode_atts( array(
        'section_bg_color'	=> 0,
    	'sec_title'	=> esc_html__( 'Services.', 'profi-toolkit' ),
        'sec_subtitle' => esc_html__( 'What I do', 'profi-toolkit' ),
        'enable_sec_title' => 1,
        'count'	=> -1,
        'desktop_count'	=> 3,
        'tablet_count'	=> 2,
        'mobile_count'	=> 1,
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

    $q = new WP_Query( array( 'posts_per_page' => $count, 'post_type' => 'services' ) );

	$profi_services_markup = '
    <script>
		jQuery(window).load(function(){
			jQuery(".service-carousel").owlCarousel({
				items: 3,
				margin: 30,
				loop: '.$loop.',
				autoplay: '.$autoplay.',
				autoplayTimeout: '.$autoplayTimeout.',
				nav: '.$nav.',
				dots: '.$dots.', 
				navText:["<i class=\'fa fa-angle-double-left\'></i>", "<i class=\'fa fa-angle-double-right\'></i>"],
				responsive: {
					0:{
						items: '.$mobile_count.',
					},
					600:{
						items: '.$tablet_count.',
					},
					1000:{
						items: '.$desktop_count.',
					},
				}
			});
		});
	</script>

	<section id="service" class="service-area section-padding '.esc_attr( $enable_sec_bg_gray ).'">
		<div class="container">';

			if ( $enable_sec_title == 1 ) {
				$profi_services_markup .='
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">';

							if (!empty( $sec_title )) {
				                	$profi_services_markup .='<h2>'.esc_html( $sec_title ).'</h2>';
				            } else {
				                $profi_services_markup .='';
				            }
				            if (!empty( $sec_subtitle )) {
				                $profi_services_markup .=''.profi_shovondesign_wp_kses( wpautop( $sec_subtitle ) ).'';
				            } else {
				                $profi_services_markup .='';
				            }
					    	$profi_services_markup .='

						</div>
					</div>
				</div>';
			} else {
				$profi_services_markup .='';
			}

			$profi_services_markup .='
			<div class="row">
				<div class="service-carousel">';
					while($q->have_posts()) : $q->the_post();
			        $idd = get_the_ID();

			        if (get_post_meta($idd, 'profi_service_options', true)) {
						$service_meta = get_post_meta($idd, 'profi_service_options', true);
					} else {
						$service_meta = array();
					}

					if (array_key_exists('upload_service_icon', $service_meta)) {
						$upload_service_icon = $service_meta['upload_service_icon'];
					} else {
						$upload_service_icon = '';
					}

					if (array_key_exists('choose_service_icon', $service_meta)) {
						$choose_service_icon = $service_meta['choose_service_icon'];
					} else {
						$choose_service_icon = '';
					}

			        $post_content = get_the_content();

			        $profi_services_markup .='
					<div class="item">
						<div class="single-service">';

							if ( !empty( $upload_service_icon ) ) {
								$profi_services_markup .='<img style="height:52px; width:52px;" src="'.esc_url( $upload_service_icon ).'" alt="'.get_the_title( $idd ).'"/>';
							} else {
								$profi_services_markup .='';
							}
							
							if ( !empty( $choose_service_icon ) ) {
								$profi_services_markup .='<i class="'.esc_attr( $choose_service_icon ).'"></i>';
							} else {
								$profi_services_markup .='';
							}
							
							$profi_services_markup .='
							<h4>'.esc_html( get_the_title( $idd ) ).'</h4>
							'.profi_shovondesign_wp_kses( wpautop( $post_content ) ).'
						</div>
					</div>';

					endwhile;
					wp_reset_query();
					$profi_services_markup .='
				</div>
			</div>
		</div>
	</section>      
    ';
    return $profi_services_markup;
}
add_shortcode('profi_services', 'profi_services_shortcode');