<?php

require_once( __DIR__ . '/vendor/autoload.php' );

add_theme_support( 'align-wide' );

add_action('wp_enqueue_scripts', function() {
	// @TODO set version number instead of false.
	wp_enqueue_style('beth-chernes', get_stylesheet_directory_uri() . '/assets/dist/main.css', [], false, 'all');
	wp_enqueue_script('beth-chernes', get_stylesheet_directory_uri() . '/assets/dist/main.js', ['jquery'], false, true );
});