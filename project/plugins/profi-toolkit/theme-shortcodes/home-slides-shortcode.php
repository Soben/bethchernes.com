<?php if (!defined('ABSPATH')) die('-1');

function profi_home_slides_shortcode( $atts ){
    extract( shortcode_atts( array(
        'count'	=> 3,
		'slider_id'	=> '',
		'height'	=> '650',
		'loop'	=> 'true',
		'autoplay'	=> 'true',
		'autoplayTimeout'	=> 5000,
		'nav'	=> 'true',
		'dots'	=> 'true',
    ), $atts) );


    if ($count == 1) {
    	$q = new WP_Query( array( 'posts_per_page' => $count, 'post_type' => 'slide', 'p' => $slider_id ) );
    } else {
    	$q = new WP_Query( array( 'posts_per_page' => $count, 'post_type' => 'slide' ) );
    }


    if ($count == 1) {
    	$home_slide_markup = '';
    } else {
    	$home_slide_markup = '
	    <script>
			jQuery(window).load(function(){
				jQuery(".profi-slides").owlCarousel({
					items: 1,
					loop: '.$loop.',
					autoplay: '.$autoplay.',
					autoplayTimeout: '.$autoplayTimeout.',
					nav: '.$nav.',
					dots: '.$dots.', 
					navText:["<i class=\'fa fa-angle-double-left\'></i>", "<i class=\'fa fa-angle-double-right\'></i>"],
				});
			});
		</script>';
    }

    
	$home_slide_markup .= '
    <div class="profi-slides" id="home">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();

        if (get_post_meta($idd, 'profi_slide_options', true)) {
			$slide_meta = get_post_meta($idd, 'profi_slide_options', true);
		} else {
			$slide_meta = array();
		}

		if (array_key_exists('enable_overlay', $slide_meta)) {
			$enable_overlay = $slide_meta['enable_overlay'];
		} else {
			$enable_overlay = true;
		}

		if (array_key_exists('overlay_percentage', $slide_meta)) {
			$overlay_percentage = $slide_meta['overlay_percentage'];
		} else {
			$overlay_percentage = .3;
		}

		if (array_key_exists('overlay_color', $slide_meta)) {
			$overlay_color = $slide_meta['overlay_color'];
		} else {
			$overlay_color = '#000000';
		}

        $post_content = get_the_content();
        
        $home_slide_markup .= '
        <div class="profi-slide-item text-center" style="background-image:url('.esc_url( get_the_post_thumbnail_url($idd, 'large') ).'); height:'.esc_attr( $height ).'px">';
			if ($enable_overlay == true) {
				$home_slide_markup .= '<div class="slide-overlay" style="opacity:'.esc_attr( $overlay_percentage ).'; background-color:'.esc_attr( $overlay_color ).'"></div>';
			}
        	$home_slide_markup .= '
            <div class="profi-slide-table">
				<div class="profi-slide-tablecell">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h2>'.esc_html( get_the_title( $idd ) ).'</h2>
								'.profi_shovondesign_wp_kses( wpautop( $post_content ) ).'';

								if (!empty( $slide_meta['social_options'] )) {
									$home_slide_markup .='<ul class="list-inline social-links">';
										foreach ($slide_meta['social_options'] as $social_option) {
											$home_slide_markup .='<li><a href="'.esc_url( $social_option['social_link'] ).'" target="_blank"><i class="'.esc_attr( $social_option['social_icon'] ).'"></i></a></li>';
										}
									$home_slide_markup .='</ul>';
								}

								$home_slide_markup .='
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
        ';        
    endwhile;
    $home_slide_markup.= '</div>';
    wp_reset_query();
    return $home_slide_markup;
}
add_shortcode('profi_home_slides', 'profi_home_slides_shortcode');