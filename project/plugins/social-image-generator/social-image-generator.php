<?php
/**
 * Plugin Name: Social Image Generator
 * Description: Automatically generate social images.
 * Author: Posty Studio
 * Author URI: https://posty.studio
 * License: GPL-3.0
 * Version: 1.0.0
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes/helpers.php';

spl_autoload_register(function ($class) {
    if (strpos($class, 'Social_Image_Generator\\') !== 0) {
        return;
    }

    $file = str_replace('Social_Image_Generator\\', '', $class);
    $file = strtolower($file);
    $file = str_replace('_', '-', $file);

    /* Convert sub-namespaces into directories */
    $path = explode('\\', $file);
    $file = array_pop($path);
    $path = implode('/', $path);

    require_once __DIR__ . '/includes/' . $path . '/class-' . $file . '.php';
});

if (!extension_loaded('gd')) {
    Social_Image_Generator\Admin::render_gd_not_installed_notice();

    return;
}

register_activation_hook(__FILE__, ['Social_Image_Generator\Setup', 'activate']);
register_deactivation_hook(__FILE__, ['Social_Image_Generator\Setup', 'deactivate']);

$setup = new Social_Image_Generator\Setup();
$setup->init();
