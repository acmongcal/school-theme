<?php
function school_enqueues() {

    //Load normalize.css
    wp_enqueue_style( 
        'mindset-normalize', 
        get_theme_file_uri( 'assets/css/normalize.css'), 
        array(), 
        '12.1.0'
    );

	// Load style.css on the front-end
	// Parameters: Unique handle, Source, Dependencies, Version number, Media
	wp_enqueue_style( 
		'mindset-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' ),
		'all'
	);

}
add_action( 'wp_enqueue_scripts', 'school_enqueues' );
// Load custom blocks.
require get_theme_file_path() . '/school-blocks/school-blocks.php';

/**
* Custom Post Types & Custom Taxonomies
*/
// require get_template_directory() . '/inc/post-types-taxonomies.php';