<?php

if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_action( 'vc_load_default_templates_action', 'profi_shovondesign_vc_homepage' ); // Hook in

function profi_shovondesign_vc_homepage() {
    $data            = array(); // Create new array
    $data['name']    = esc_html__( 'Profi - Homepage', 'profi-toolkit' ); // Assign name for your custom template
    $data['weight']  = 0; // Weight of your template in the template list
    $data['content'] = <<<CONTENT

[vc_row full_width="stretch_row_content_no_spaces"][vc_column][profi_home_slides count="-1" height="700" nav="false"][/vc_column][/vc_row][vc_row][vc_column][profi_about_section enable_sec_title="1" about_img="1857" titles="%5B%7B%22skill_title%22%3A%22DEVELOPMENT%22%2C%22skill_value%22%3A%2269%22%7D%2C%7B%22skill_title%22%3A%22Design%22%2C%22skill_value%22%3A%2280%22%7D%2C%7B%22skill_title%22%3A%22BRANDING%22%2C%22skill_value%22%3A%2265%22%7D%2C%7B%22skill_title%22%3A%22COPYRIGHTING%22%2C%22skill_value%22%3A%2278%22%7D%2C%7B%22skill_title%22%3A%22MARKETING%22%2C%22skill_value%22%3A%2275%22%7D%5D" skills="%5B%7B%22skill_title%22%3A%22Design%22%2C%22skill_value%22%3A%2280%22%7D%2C%7B%22skill_title%22%3A%22HTML%22%2C%22skill_value%22%3A%2290%22%7D%2C%7B%22skill_title%22%3A%22PHP%22%2C%22skill_value%22%3A%2275%22%7D%2C%7B%22skill_title%22%3A%22Wordpress%22%2C%22skill_value%22%3A%2265%22%7D%2C%7B%22skill_title%22%3A%22Javascript%22%2C%22skill_value%22%3A%2250%22%7D%5D" about_btns="%5B%7B%22btn_text%22%3A%22Hire%20me.%22%2C%22btn_icon%22%3A%22fa%20fa-thumbs-up%22%2C%22btn_link%22%3A%22%23%22%7D%2C%7B%22btn_text%22%3A%22DOWLOAD%20RESUME%22%2C%22btn_icon%22%3A%22fa%20fa-download%22%2C%22btn_link%22%3A%22%23%22%7D%5D" about_text="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley."][/vc_column][/vc_row][vc_row css=".vc_custom_1576331302396{padding-right: 15px !important;padding-left: 15px !important;}"][vc_column][vc_row_inner css=".vc_custom_1576325455922{padding-bottom: 80px !important;}"][vc_column_inner width="1/4"][profi_fun_facts fun_facts_icon_type="3" fun_facts_icon_class="icon-trophy" fun_facts_number="200" fun_facts_desc="Awarded Won"][/vc_column_inner][vc_column_inner width="1/4"][profi_fun_facts fun_facts_icon_type="3" fun_facts_icon_class="icon-profile-male" fun_facts_number="150" fun_facts_desc="Happy Clients"][/vc_column_inner][vc_column_inner width="1/4"][profi_fun_facts fun_facts_icon_type="3" fun_facts_icon_class="icon-linegraph" fun_facts_number="19999" fun_facts_desc="Lines of Code"][/vc_column_inner][vc_column_inner width="1/4"][profi_fun_facts fun_facts_icon_type="3" fun_facts_icon_class="icon-download" fun_facts_number="199" fun_facts_desc="Project Complete"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces"][vc_column][profi_services section_bg_color="1" enable_sec_title="1" nav="false"][/vc_column][/vc_row][vc_row][vc_column][profi_projects][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces"][vc_column][profi_testimonials section_bg_color="1" enable_sec_title="0" nav="false" dots="false"][/vc_column][/vc_row][vc_row][vc_column][profi_contact enable_sec_title="1" just_get_id="157" contact_get_id="157"][/vc_column][/vc_row]

CONTENT;

    vc_add_default_templates( $data );
}