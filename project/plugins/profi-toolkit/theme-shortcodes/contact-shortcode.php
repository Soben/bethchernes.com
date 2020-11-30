<?php if (!defined('ABSPATH')) die('-1');

function profi_contact_shortcode( $atts, $content = null ){
    extract( shortcode_atts( array(
        'section_bg_color'	=> 0,
        'sec_title'	=> esc_html__( 'Conatct.', 'profi-toolkit' ),
        'sec_subtitle' => esc_html__( 'Say hello', 'profi-toolkit' ),
        'enable_sec_title' => 1,
        'contact_get_id' => '',
    ), $atts) );

	if ( $section_bg_color == 1 ) {
		 $enable_sec_bg_gray = 'section-gray';
	} else {
		 $enable_sec_bg_gray = '';
	}

	$contactform7 = do_shortcode('[contact-form-7 id="'.$contact_get_id.'"]');

    $profi_contact_markup = '
	<section id="contact" class="contact-area section-padding '.esc_attr( $enable_sec_bg_gray ).'">
		<div class="container">';

			if ( $enable_sec_title == 1 ) {
				$profi_contact_markup .='
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">';

							if (!empty( $sec_title )) {
				                	$profi_contact_markup .='<h2>'.esc_html( $sec_title ).'</h2>';
				            } else {
				                $profi_contact_markup .='';
				            }
				            if (!empty( $sec_subtitle )) {
				                $profi_contact_markup .=''.profi_shovondesign_wp_kses( wpautop( $sec_subtitle ) ).'';
				            } else {
				                $profi_contact_markup .='';
				            }
					    	$profi_contact_markup .='

						</div>
					</div>
				</div>';
			} else {
				$profi_contact_markup .='';
			}

			$profi_contact_markup .='
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">';

						if ( !empty( $contactform7 )) {
							$profi_contact_markup .=''.$contactform7.'';
						} else {
							$profi_contact_markup .='';
						}
						
					$profi_contact_markup .='
					</div>
				</div>
			</div>
		</div>
	</section>
    ';

    return $profi_contact_markup;
}
add_shortcode('profi_contact', 'profi_contact_shortcode');