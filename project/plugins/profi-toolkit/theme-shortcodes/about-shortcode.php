<?php if (!defined('ABSPATH')) die('-1');

function profi_about_section_shortcode( $atts, $content = null ){
    extract( shortcode_atts( array(
        'section_bg_color'	=> 0,
        'sec_title'	=> esc_html__( 'About me.', 'profi-toolkit' ),
        'sec_subtitle' => esc_html__( 'Who am i', 'profi-toolkit' ),
        'enable_sec_title' => 1,
        'about_img' => '',
        'about_text' => '',
    ), $atts) );

	if ( $section_bg_color == 1 ) {
		 $enable_sec_bg_gray = 'section-gray';
	} else {
		 $enable_sec_bg_gray = '';
	}

    $about_img_array = wp_get_attachment_image_src( $about_img, 'large' );

    $about_section_markup = '
	<section id="about" class="about_area section-padding '.esc_attr( $enable_sec_bg_gray ).'">
		<div class="container">';

			if ( $enable_sec_title == 1 ) {
				$about_section_markup .='
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">';

							if (!empty( $sec_title )) {
				                	$about_section_markup .='<h2>'.esc_html( $sec_title ).'</h2>';
				            } else {
				                $about_section_markup .='';
				            }
				            if (!empty( $sec_subtitle )) {
				                $about_section_markup .=''.profi_shovondesign_wp_kses( wpautop( $sec_subtitle ) ).'';
				            } else {
				                $about_section_markup .='';
				            }
					    	$about_section_markup .='

						</div>
					</div>
				</div>';
			} else {
				$about_section_markup .='';
			}

			$about_section_markup .='
			<div class="row">

				<div class="col-md-4">
					<div class="about-img">
						<img src="'.esc_url( $about_img_array[0] ).'" alt="'.esc_html( $sec_title ).'" class="img-responsive">
					</div>
				</div>

				<div class="col-md-8">
					<div class="about-text">
						'.profi_shovondesign_wp_kses( wpautop( $about_text ) ).'
					</div>
					<div class="about-skills">
						<div class="skills-progress">';

							$skills = vc_param_group_parse_atts( $atts['skills'] );

							foreach ( $skills as $skill ) {
								$about_section_markup .='
								<div class="progress">
									<div class="lead">'.esc_html( $skill['skill_title'] ).'</div>
									<div data-wow-delay="1.2s" data-wow-duration="1.5s" style="width: '.esc_html( $skill['skill_value'] ).'%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;" data-progress="'.esc_html( $skill['skill_value'] ).'%" class="progress-bar wow fadeInLeft">
									<p><span class="timer">'.esc_html( $skill['skill_value'] ).'</span>'.esc_html( '%' ).'</p>
									</div>
								</div>';
							}
							
							$about_section_markup .='
						</div>
					</div>';

					$about_btns = vc_param_group_parse_atts( $atts['about_btns'] );
					
					foreach ( $about_btns as $about_btn ) {
						$about_section_markup .='<a href="'.esc_url( $about_btn['btn_link'] ).'" class="button"><i class="'.esc_attr( $about_btn['btn_icon'] ).'"></i> '.esc_html( $about_btn['btn_text'] ).'</a>';
					}					

					$about_section_markup .='
				</div>
			</div>
		</div>
	</section>
    ';

    return $about_section_markup;
}
add_shortcode('profi_about_section', 'profi_about_section_shortcode');