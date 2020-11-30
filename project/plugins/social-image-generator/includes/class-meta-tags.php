<?php

namespace Social_Image_Generator;

class Meta_Tags {
    public function __construct() {
        add_action('wp_head', [$this, 'add_og_tags']);
    }

    public function add_og_tags() {
        $url = get_rest_url(null, '/' . SOCIAL_IMAGE_GENERATOR_API_BASE . '/image/' . get_the_ID());

        echo '<meta property="og:image" content="' .  esc_url($url) . '" />';
        echo '<meta property="og:image:width" content="1200" />';
        echo '<meta property="og:image:height" content="630" />';
        echo '<meta property="twitter:card" content="summary_large_image" />';
    }
}
