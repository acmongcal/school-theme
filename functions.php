<?php
function school_enqueues()
{

	//Load normalize.css
	wp_enqueue_style(
		'school-normalize',
		get_theme_file_uri('assets/css/normalize.css'),
		array(),
		'12.1.0'
	);

	// Load style.css on the front-end
	// Parameters: Unique handle, Source, Dependencies, Version number, Media
	wp_enqueue_style(
		'school-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get('Version'),
		'all'
	);
}
add_action('wp_enqueue_scripts', 'school_enqueues');

function school_enqueue_lightgallery()
{

	if (is_front_page()) {

		wp_enqueue_style(
			'lightgallery',
			get_theme_file_uri('assets/css/lightgallery.css'),
			array(),
			'2.8.3'
		);

		wp_enqueue_script(
			'lightgallery',
			get_theme_file_uri('assets/js/lightgallery.umd.js'),
			array(),
			'2.8.3',
			true
		);

		wp_enqueue_script(
			'lightgallery-settings',
			get_theme_file_uri('assets/js/lightgallery-settings.js'),
			array('lightgallery'),
			'1.0',
			true
		);
	}
}
add_action('wp_enqueue_scripts', 'school_enqueue_lightgallery');

function school_setup()
{

	add_editor_style(get_stylesheet_uri());

	// Custom image sizes
	add_image_size('student-large', 800, 600, true);
	add_image_size('student-small', 400, 300, true);
}
add_action('after_setup_theme', 'school_setup');

function school_add_custom_image_sizes($size_names)
{
	$new_sizes = array(
		'student-large' => __('Student Large', 'school-theme'),
		'student-small' => __('Student Small', 'school-theme'),
	);
	return array_merge($size_names, $new_sizes);
}
add_filter('image_size_names_choose', 'school_add_custom_image_sizes');


// Load custom blocks.

require get_theme_file_path() . '/school-blocks/school-blocks.php';

// Custom Post Types & Custom Taxonomies.

require get_template_directory() . '/inc/post-types-taxonomies.php';
