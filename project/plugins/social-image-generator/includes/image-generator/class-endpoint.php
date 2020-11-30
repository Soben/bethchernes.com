<?php

namespace Social_Image_Generator\Image_Generator;

use Social_Image_Generator\Cache;

class Endpoint {
    public function __construct() {
        add_action('rest_api_init', [$this, 'register_image_endpoint']);
        add_action('rest_api_init', [$this, 'register_generator_endpoint']);
    }

    public function register_image_endpoint() {
        register_rest_route(SOCIAL_IMAGE_GENERATOR_API_BASE, '/image/(?P<id>\d+)', [
            'methods' => \WP_REST_Server::READABLE,
            'permission_callback' => '__return_true',
            'callback' => function (\WP_REST_Request $request) {
                $post_id = (int) $request['id'];

                if (empty($post_id) || get_post_status($post_id) !== 'publish') {
                    return new \WP_Error(
                        'invalid_id',
                        __('Invalid post ID.', 'social-image-generator'),
                        ['status' => 404]
                    );
                }

                // TODO: ENABLE CACHE!
                $cache_enabled = false;

                if ($cache_enabled && Cache::has($post_id)) {
                    $image = Cache::get($post_id);

                    header('Content-Type: ' . $image['mime']['type']);
                    header('Content-Length: ' . $image['length']);

                    echo $image['file'];
                } else {
                    $custom_text = get_post_meta($post_id, 'sig_custom_text', true);
                    $text = !empty($custom_text) ? $custom_text : get_the_title($post_id);
                    $featured_image = wp_get_attachment_image_url(get_post_thumbnail_id($post_id), 'large');
                    $generator = new Generator($text, $featured_image);
                    $image = $generator->generate();
                    $cached_image = Cache::save($post_id, $image);

                    if (isset($cached_image['error'])) {
                        return new \WP_Error(
                            'social_image_generator_cache_unknown_error',
                            $cached_image['error'],
                            ['status' => 500]
                        );
                    }

                    echo $image->response();
                }
            }
        ]);
    }

    /**
     * Private generator endpoint for creating images with custom text.
     */
    public function register_generator_endpoint() {
        register_rest_route(SOCIAL_IMAGE_GENERATOR_API_BASE, '/generator', [
            'methods' => \WP_REST_Server::READABLE,
            'permission_callback' => function () {
                return current_user_can('manage_options');
            },
            'callback' => function (\WP_REST_Request $request) {
                $generator = new Generator(
                    sanitize_text_field($request['text'] ?: ''),
                    sanitize_text_field($request['image'] ?: '')
                );

                echo $generator->generate()->response();
            }
        ]);
    }
}
