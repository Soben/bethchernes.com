<?php

namespace Social_Image_Generator;

class Admin {
    const OPTIONS_GROUP = 'sig';
    const OPTION_KEY_LICENSE_KEY = 'sig_license_key';
    const OPTION_KEY_LICENSE_KEY_VALID = 'sig_license_key_valid';
    const OPTION_KEY_TEMPLATE_SETTINGS = 'sig_template_settings';

    public function __construct() {
        add_action('init', [$this, 'register_meta']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('rest_api_init', [$this, 'register_settings']);
        add_action('rest_api_init', [$this, 'register_license_key_endpoint']);
        add_action('admin_menu', [$this, 'register_page']);
        add_action('updated_option', [$this, 'maybe_clear_cache']);
    }

    public function register_meta() {
        register_meta('post', 'sig_custom_text', [
            'show_in_rest' => true,
            'type' => 'string',
            'single' => true,
        ]);
    }

    public function register_settings() {
        add_option(static::OPTION_KEY_LICENSE_KEY);
        register_setting(static::OPTIONS_GROUP, static::OPTION_KEY_LICENSE_KEY, [
            'type'              => 'string',
            'show_in_rest'      => true,
            'sanitize_callback' => 'sanitize_text_field'
        ]);

        add_option(static::OPTION_KEY_LICENSE_KEY_VALID);
        register_setting(static::OPTIONS_GROUP, static::OPTION_KEY_LICENSE_KEY_VALID, [
            'type'              => 'boolean',
            'show_in_rest'      => true,
            'sanitize_callback' => 'boolval'
        ]);

        add_option(static::OPTION_KEY_TEMPLATE_SETTINGS);
        register_setting(static::OPTIONS_GROUP, static::OPTION_KEY_TEMPLATE_SETTINGS, [
            'single' => true,
            'type' => 'object',
            'show_in_rest' => [
                'schema' => [
                    'type' => 'object',
                    'properties' => [
                        'template' => [
                            'type' => 'string',
                        ],
                        'colors' => [
                            'type' => 'object',
                            'properties' => [
                                'logo' => ['type' => 'string'],
                                'text' => ['type' => 'string'],
                                'background' => ['type' => 'string'],
                                'accent' => ['type' => 'string'],
                            ],
                        ],
                        'logo' => [
                            'type' => 'object',
                            'properties' => [
                                'type' => ['type' => 'string'],
                                'id' => ['type' => 'number'],
                                'text' => ['type' => 'string'],
                                'width' => ['type' => 'number'],
                            ],
                        ],
                        'fallback' => [
                            'type' => 'object',
                            'properties' => [
                                'id' => ['type' => 'number'],
                                'url' => ['type' => 'string'],
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function register_page() {
        add_management_page(
            __('Social Image Generator', 'social-image-generator'),
            __('Social Image Generator', 'social-image-generator'),
            'manage_options',
            'social-image-generator',
            [$this, 'render_page']
        );
    }

    public function render_page() {
        ?>

        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <div id="social-image-generator-settings" class="sig"></div>
        </div>

        <?php
    }

    public function maybe_clear_cache($option_name) {
        if ($option_name === self::OPTION_KEY_TEMPLATE_SETTINGS) {
            Cache::flush(true);
        }
    }

    /**
     * Get all template settings.
     *
     * @return array
     */
    public static function get_template_settings() {
        $settings = get_option(Admin::OPTION_KEY_TEMPLATE_SETTINGS);

        // Return defaults
        if (empty($settings)) {
            return Templates::get('twentytwenty');
        }

        if (!empty($settings['logo']['id'])) {
            $src = wp_get_attachment_image_src($settings['logo']['id'], 'large');

            if (!empty($src)) {
                $ratio = $src[2] / $src[1];
                $width = $settings['logo']['width'];

                $settings['logo']['url'] = $src[0];
                $settings['logo']['width'] = $width;
                $settings['logo']['height'] = $width * $ratio;
            }
        }

        if (!empty($settings['fallback']) && !empty($settings['fallback']['id'])) {
            $settings['fallback']['url'] = wp_get_attachment_image_url($settings['fallback']['id'], 'full');
        }

        return $settings;
    }

    /**
     * Activate a license key.
     *
     * @param string $license_key
     * @return object
     */
    public static function activate_license_key($license_key = '') {
        $response =  wp_remote_post(
            'https://api.posty.studio/wp-json/posty/v1/activate-license',
            ['body' => ['license_key' => $license_key]]
        );

        return json_decode(wp_remote_retrieve_body($response));
    }

    public function register_license_key_endpoint() {
        register_rest_route(SOCIAL_IMAGE_GENERATOR_API_BASE, '/activate-license', [
            'methods' => \WP_REST_Server::CREATABLE,
            'permission_callback' => function () {
                return current_user_can('manage_options');
            },
            'callback' => function (\WP_REST_Request $request) {
                $key = $request->get_param('licenseKey');
                $response = self::activate_license_key($key);

                update_option(Admin::OPTION_KEY_LICENSE_KEY, $key);
                update_option(Admin::OPTION_KEY_LICENSE_KEY_VALID, $response->code === 'success');

                return rest_ensure_response($response);
            }
        ]);
    }

    /**
     * Render a message if GD is not installed.
     */
    public static function render_gd_not_installed_notice() {
        add_action('admin_notices', function () {
            $message = sprintf(
                esc_html__('Social Image Generator relies on the %s to work. Please contact your host to install this library on your server.', 'social-image-generator'),
                '<a href="https://www.php.net/manual/en/intro.image.php">GD Image Library</a>'
            );

            printf('<div class="notice notice-error"><p>%s</p></div>', $message);
        });
    }
}
