<?php

namespace Social_Image_Generator\Image_Generator;

use Intervention\Image\ImageManagerStatic as Image;
use Social_Image_Generator\Admin;

class Generator {
    /**
     * @var \Intervention\Image\Image|false
     */
    public $image;
    public $text;
    public $featured_image;
    public $site_title;
    public $site_link;
    public $settings;
    public $font_file;
    public $font_size;

    public function __construct($text = '', $featured_image = '') {
        $this->text = $text;
        $this->featured_image = $featured_image;
        $this->site_title = get_bloginfo('name');
        $this->site_link = strtoupper(str_replace(['https://', 'http://', 'www.'], '', get_site_url()));
        $this->settings = Admin::get_template_settings();
    }

    /**
     * Add a gradient.
     *
     * @param \Intervention\Image\Image $image
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     * @param string $color
     * @param string $direction
     * @return \Intervention\Image\Image
     */
    private function add_gradient($image, $x1 = 0, $y1 = 0, $x2 = 1200, $y2 = 630, $opacity = 100, $direction = 'vertical') {
        $gradient = Image::make(SOCIAL_IMAGE_GENERATOR_IMG_PATH . "gradients/{$direction}-{$opacity}.png");
        $gradient->resize($x2 - $x1, $y2 - $y1);
        $image->insert($gradient, 'top-left', $x1, $y1);

        return $image;
    }

    /**
     * Add featured image
     *
     * @param \Intervention\Image\Image $image
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     * @return \Intervention\Image\Image
     */
    private function add_featured_image($image, $x1 = 0, $y1 = 0, $x2 = 1200, $y2 = 630) {
        if (empty($this->featured_image) && empty($this->settings['fallback'])) {
            return $image;
        }

        $featured_image = Image::make(!empty($this->featured_image) ? $this->featured_image : $this->settings['fallback']['url']);
        $featured_image->fit($x2 - $x1, $y2 - $y1);
        $image->insert($featured_image, 'top-left', $x1, $y1);

        return $image;
    }

    /**
     * Given a string, font size and max width, return the string shortened
     * so it fits in the max width.
     *
     * @param string $string
     * @param int $size
     * @param int $max_width
     * @return string
     */
    private function get_words_by_max_width($string, $size, $max_width) {
        $words = explode(' ', $string);

        // Prevent infinite loop if word is longer than max width.
        if (count($words) === 1) {
            return $words[0];
        }

        $box = \imagettfbbox($size * (3/4), 0, $this->font_file, $string);

        if (abs($box[6] - $box[4]) <= $max_width) {
            return $string;
        }

        array_pop($words);

        return $this->get_words_by_max_width(implode(' ', $words), $size, $max_width);
    }

    /**
     * Given a string, font size and max width, split up the string into lines
     * that fit in the max width.
     *
     * @param string $string
     * @param int $size
     * @param int $max_width
     * @return array
     */
    private function wrap_string_by_width($string, $size, $max_width) {
        $sentence = $this->get_words_by_max_width($string, $size, $max_width);
        $remainder = trim(substr($string, strlen($sentence)));

        if (!empty($remainder)) {
            return array_merge([$sentence], $this->wrap_string_by_width($remainder, $size, $max_width));
        }

        return [$sentence];
    }

    /**
     * Add a title in the right position.
     *
     * @param \Intervention\Image\Image $image
     * @param int $x Horizontal distance from edge. When centered, this is the middle of the text.
     * @param int $y Vertical distance from edge. When centered, this is the middle of the text.
     * @param int $max_width Max width of the text.
     * @param int $size Font size in px.
     * @param float $line_height Line height of the text.
     * @param string $align Horizontal alignment of the text. Left, center or right.
     * @param string $valign Vertical alignment of the text. Top, center or bottom.
     * @param string $font_style Vertical alignment of the text. Top, center or bottom.
     * @return \Intervention\Image\Image
     */
    private function add_title($image, $x = 60, $y = 60, $max_width = 1080, $size = 64, $line_height = 1.1, $align = 'left', $valign = 'top', $font_style = 'default') {
        if (empty($this->text)) {
            return $image;
        }

        $text = $this->text;

        if ($font_style === 'upper') {
            $text = strtoupper($text);
        }

        $lines = $this->wrap_string_by_width($text, $size, $max_width);
        $height = ($line_height * $size * count($lines));

        foreach ($lines as $i => $line) {
            $current_x = $x;
            $current_y = $y + ($line_height * $size * $i);

            if ($align === 'right') {
                $current_x = 1200 - $x;
            }

            if ($valign === 'center') {
                $current_y = $y + ($line_height * $size * $i) - ($height / 2);
            }

            // If we align from the bottom, the text needs to start at $y from
            // the bottom and work its way up.
            if ($valign === 'bottom') {
                $offset = $size * $line_height - $size;
                $current_y = (630 - $y) - ($size * $line_height * (count($lines) - $i)) + $offset;
            }

            $image->text($line, $current_x, $current_y, function ($font) use ($size, $align) {
                $font->file($this->font_file);
                $font->size($size);
                $font->color($this->settings['colors']['text']);
                $font->align($align);
                $font->valign('top');
            });
        }

        return $image;
    }

    /**
     * Return an Intervention instance of the logo.
     *
     * @return \Intervention\Image\Image
     */
    private function get_logo_img() {
        $id = $this->settings['logo']['id'];
        $width = (int) $this->settings['logo']['width'];
        $url = wp_get_attachment_image_src($id, 'large');

        if (empty($url) || empty($width)) {
            return false;
        }

        $uploads = wp_upload_dir();
        $path = str_replace($uploads['baseurl'], $uploads['basedir'], $url[0]);

        return Image::make($path)->widen($width * 2);
    }

    /**
     * Add a logo in the right position.
     *
     * @param \Intervention\Image\Image $image
     * @param int $x Horizontal distance from edge. When centered, this is the middle of the logo.
     * @param int $y Vertical distance from edge. When centered, this is the middle of the logo.
     * @param int $size Font size in px.
     * @param int $link_size Font size in px of the site link (usually smaller).
     * @param string $align Horizontal alignment of the logo. Left, center or right.
     * @param string $valign Vertical alignment of the logo. Top, center or bottom.
     * @return \Intervention\Image\Image
     */
    private function add_logo($image, $x = 60, $y = 60, $size = 32, $link_size = 24, $align = 'left', $valign = 'top') {
        // Default
        if (!isset($this->settings['logo'])) {
            $this->settings['logo'] = [
                'type' => 'title'
            ];
        }

        if ($this->settings['logo']['type'] === 'none') {
            return $image;
        }

        if ($this->settings['logo']['type'] === 'image') {
            if (!empty($this->settings['logo']['id'])) {
                $image->insert($this->get_logo_img(), "{$valign}-{$align}", $x, $y);
            }

            return $image;
        }

        $size = $this->settings['logo']['type'] === 'link' ? $link_size : $size;
        $texts = [
            'title' => $this->site_title,
            'text' => isset($this->settings['logo']['text']) ? $this->settings['logo']['text'] : '',
            'link' => $this->site_link
        ];

        if ($align === 'right') {
            $x = 1200 - $x;
        }

        if ($valign === 'bottom') {
            $y = 630 - $y;
        }

        $image->text($texts[$this->settings['logo']['type']], $x, $y, function ($font) use ($size, $align, $valign) {
            $font->file($this->font_file);
            $font->size($size);
            $font->color($this->settings['colors']['logo']);
            $font->align($align);
            $font->valign($valign);
        });

        return $image;
    }

    /**
     * Get the image with a specific template
     *
     * @param string $template
     * @return \Intervention\Image\Image
     */
    private function get_from_template($template) {
        switch ($template) {
            case 'twentytwenty':
                $this->font_file = SOCIAL_IMAGE_GENERATOR_ASSETS_PATH . 'fonts/inter/inter-900.ttf';

                $image = Image::canvas(1200, 630, $this->settings['colors']['background'])
                    ->rectangle(0, 530, 1200, 630, function ($draw) {
                        $draw->background($this->settings['colors']['accent']);
                    });
                $image = $this->add_title($image, 60, 140, 1080, 64, 1.3, 'left', 'bottom');
                $image = $this->add_logo($image);

                return $image;
            case 'twentynineteen':
                $this->font_file = SOCIAL_IMAGE_GENERATOR_ASSETS_PATH . 'fonts/roboto/roboto-700.ttf';

                $image = Image::canvas(1200, 630, $this->settings['colors']['background']);
                $image = $this->add_title($image, 60, 60, 1080, 72, 1.1, 'left', 'bottom');
                $image = $this->add_logo($image);

                // Add accent
                $lines = count($this->wrap_string_by_width($this->text, 72, 1080));
                $title_height = $lines * 1.1 * 72;
                $y = 630 - ($title_height + 60 + 48);
                $image->rectangle(60, ($y - 6), 200, $y, function ($draw) {
                    $draw->background($this->settings['colors']['accent']);
                });

                return $image;
            case 'twentyseventeen':
                $this->font_file = SOCIAL_IMAGE_GENERATOR_ASSETS_PATH . 'fonts/roboto/roboto-700.ttf';

                $image = Image::canvas(1200, 630,'#000')
                    ->rectangle(0, 510, 1200, 630, function ($draw) {
                        $draw->background($this->settings['colors']['background']);
                    });

                $image = $this->add_featured_image($image, 0, 0, 1200, 510);
                $image = $this->add_gradient($image, 0, 0, 1200, 510, 40);
                $image = $this->add_title($image, 60, 180, 1080, 56, 1.1, 'left', 'bottom', 'upper');

                if ($this->settings['logo']['type'] === 'image') {
                    $image = $this->add_logo($image, 60, 40, 32, 24, 'left', 'bottom');
                } else {
                    $image = $this->add_logo($image, 60, 570, 32, 32, 'left', 'center');
                }

                return $image;
            case 'sunflower':
                $this->font_file = SOCIAL_IMAGE_GENERATOR_ASSETS_PATH . 'fonts/alegreya/alegreya-700.ttf';

                $bg = Image::make(SOCIAL_IMAGE_GENERATOR_IMG_PATH . 'templates/sunflower/bg.png')->fit(1200, 630);
                $image = Image::canvas(1200, 630)->insert($bg);

                $image = $this->add_title($image, 600, 315, 700, 72, 1.3, 'center', 'center');
                $image = $this->add_logo($image, 100, 100);

                return $image;
            case 'fullscreen':
                $this->font_file = SOCIAL_IMAGE_GENERATOR_ASSETS_PATH . 'fonts/inter/inter-900.ttf';

                $image = Image::canvas(1200, 630, '#000');
                $image = $this->add_featured_image($image);
                $image = $this->add_gradient($image, 0, 0, 1200, 630, 100);
                $image = $this->add_title($image, 60, 60, 1080, 64, 1.3, 'left', 'bottom');
                $image = $this->add_logo($image);

                return $image;
        }
    }

    /**
     * @return \Intervention\Image\Image
     */
    public function generate() {
        return $this->get_from_template(isset($this->settings['template']) ? $this->settings['template'] : 'twentytwenty');
    }
}
