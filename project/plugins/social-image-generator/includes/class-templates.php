<?php

namespace Social_Image_Generator;

class Templates {
    public static function all() {
        return [
            'fullscreen' => [
                'name' => __('Fullscreen', 'social-image-generator'),
                'slug' => 'fullscreen',
                'image' => true,
                'colors' => [
                    'logo' => '#fff',
                    'text' => '#fff',
                ]
            ],
            'twentytwenty' => [
                'name' => __('TwentyTwenty', 'social-image-generator'),
                'slug' => 'twentytwenty',
                'image' => false,
                'colors' => [
                    'logo' => '#ef4949',
                    'text' => '#111',
                    'background' => '#fff',
                    'accent' => '#f7f1e7',
                ]
            ],
            'twentynineteen' => [
                'name' => __('TwentyNineteen', 'social-image-generator'),
                'slug' => 'twentynineteen',
                'image' => false,
                'colors' => [
                    'logo' => '#ef4949',
                    'text' => '#111',
                    'background' => '#fff',
                    'accent' => '#767676',
                ]
            ],
            'twentyseventeen' => [
                'name' => __('TwentySeventeen', 'social-image-generator'),
                'slug' => 'twentyseventeen',
                'image' => true,
                'colors' => [
                    'logo' => '#ef4949',
                    'text' => '#fff',
                    'background' => '#fff',
                ]
            ],
            'sunflower' => [
                'name' => __('Sunflower', 'social-image-generator'),
                'slug' => 'sunflower',
                'image' => false,
                'colors' => [
                    'logo' => '#ef4949',
                    'text' => '#322e25',
                ]
            ]
        ];
    }

    public static function get($slug) {
        return self::all()[$slug];
    }
}
