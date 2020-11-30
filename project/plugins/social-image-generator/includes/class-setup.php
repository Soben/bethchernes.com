<?php

namespace Social_Image_Generator;

use Social_Image_Generator\Image_Generator\Generator;
use Social_Image_Generator\Cache;

class Setup {
    public function __construct() {
        $this->set_constants();
    }

    private function set_constants() {
        define('SOCIAL_IMAGE_GENERATOR_VERSION', '1.0.0');
        define('SOCIAL_IMAGE_GENERATOR_SLUG', 'social-image-generator');
        define('SOCIAL_IMAGE_GENERATOR_API_BASE', SOCIAL_IMAGE_GENERATOR_SLUG . '/v1');
        define('SOCIAL_IMAGE_GENERATOR_PATH', plugin_dir_path(__DIR__));
        define('SOCIAL_IMAGE_GENERATOR_ASSETS_PATH', SOCIAL_IMAGE_GENERATOR_PATH . 'assets/');
        define('SOCIAL_IMAGE_GENERATOR_IMG_PATH', SOCIAL_IMAGE_GENERATOR_PATH . 'assets/img/');
        define('SOCIAL_IMAGE_GENERATOR_TEMPLATES_PATH', SOCIAL_IMAGE_GENERATOR_PATH . 'templates/');
        define('SOCIAL_IMAGE_GENERATOR_ASSETS_URL', plugin_dir_url(__DIR__) . 'assets/');
        define('SOCIAL_IMAGE_GENERATOR_IMG_URL', SOCIAL_IMAGE_GENERATOR_ASSETS_URL . 'img/');
    }

    public static function activate() {
        flush_rewrite_rules();
        Cache::create();
    }

    public static function deactivate() {
        Cache::destroy();
    }

    public function init() {
        Cache::init();
        new Assets;
        new Admin;
        new Image_Generator\Endpoint;
        new Meta_Tags;
    }
}
