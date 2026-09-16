<?php

function school_register_custom_post_types(){
    //Register Student post Type
        $labels = array(
        'name'                     => _x( 'Students', 'post type general name', 'school-theme' ),
        'singular_name'            => _x( 'Student', 'post type singular name', 'school-theme' ),
        'add_new'                  => _x( 'Add New', 'Student', 'school-theme' ),
        'add_new_item'             => __( 'Add New Student', 'school-theme' ),
        'edit_item'                => __( 'Edit Student', 'school-theme' ),
        'new_item'                 => __( 'New Student', 'school-theme' ),
        'view_item'                => __( 'View Student', 'school-theme' ),
        'view_items'               => __( 'View Students', 'school-theme' ),
        'search_items'             => __( 'Search Students', 'school-theme' ),
        'not_found'                => __( 'No Students found.', 'school-theme' ),
        'not_found_in_trash'       => __( 'No Students found in Trash.', 'school-theme' ),
        'parent_item_colon'        => __( 'Parent Students:', 'school-theme' ),
        'all_items'                => __( 'All Students', 'school-theme' ),
        'archives'                 => __( 'Student Archives', 'school-theme' ),
        'attributes'               => __( 'Student Attributes', 'school-theme' ),
        'insert_into_item'         => __( 'Insert into Student', 'school-theme' ),
        'uploaded_to_this_item'    => __( 'Uploaded to this Student', 'school-theme' ),
        'featured_image'           => __( 'Student featured image', 'school-theme' ),
        'set_featured_image'       => __( 'Set Student featured image', 'school-theme' ),
        'remove_featured_image'    => __( 'Remove Student featured image', 'school-theme' ),
        'use_featured_image'       => __( 'Use as featured image', 'school-theme' ),
        'menu_name'                => _x( 'Students', 'admin menu', 'school-theme' ),
        'filter_items_list'        => __( 'Filter Students list', 'school-theme' ),
        'items_list_navigation'    => __( 'Students list navigation', 'school-theme' ),
        'items_list'               => __( 'Students list', 'school-theme' ),
        'item_published'           => __( 'Student published.', 'school-theme' ),
        'item_published_privately' => __( 'Student published privately.', 'school-theme' ),
        'item_revereted_to_draft'  => __( 'Student reverted to draft.', 'school-theme' ),
        'item_trashed'             => __( 'Student trashed.', 'school-theme' ),
        'item_scheduled'           => __( 'Student scheduled.', 'school-theme' ),
        'item_updated'             => __( 'Student updated.', 'school-theme' ),
        'item_link'                => __( 'Student link.', 'school-theme' ),
        'item_link_description'    => __( 'A link to a Student.', 'school-theme' ),
    );
        $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'rewrite'            => array( 'slug' => 'students' ),
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array( 'title' => array( 'placeholder' => 'Add student name' ), 'editor', 'thumbnail' ),
        'template'           => array( array( 'core/paragraph',array(
                'placeholder' => 'Add Biography...',
            ) ), array( 'core/button', array('text' => 'See my Portfolio','url'=> 'example.com') ) ),
        'template_lock'      => 'all'
    );
    register_post_type( 'fwd-student', $args );
}
add_action( 'init', 'school_register_custom_post_types' );
function school_register_taxonomies(){
    // Add Student Category Taxonomy
    $labels = array(
        'name'                  => _x( 'Student Specialties', 'taxonomy general name', 'school-theme' ),
        'singular_name'         => _x( 'Student Specialty', 'taxonomy singular name', 'school-theme' ),
        'search_items'          => __( 'Search Student Specialties', 'school-theme' ),
        'all_items'             => __( 'All Student Specialty', 'school-theme' ),
        'parent_item'           => __( 'Parent Student Specialty', 'school-theme' ),
        'parent_item_colon'     => __( 'Parent Student Specialty:', 'school-theme' ),
        'edit_item'             => __( 'Edit Student Specialty', 'school-theme' ),
        'view_item'             => __( 'View Student Specialty', 'school-theme' ),
        'update_item'           => __( 'Update Student Specialty', 'school-theme' ),
        'add_new_item'          => __( 'Add New Student Specialty', 'school-theme' ),
        'new_item_name'         => __( 'New Student Specialty Name', 'school-theme' ),
        'template_name'         => __( 'Student Specialty Archives', 'school-theme' ),
        'menu_name'             => __( 'Student Specialty', 'school-theme' ),
        'not_found'             => __( 'No student specialties found.', 'school-theme' ),
        'no_terms'              => __( 'No student specialties', 'school-theme' ),
        'items_list_navigation' => __( 'Student Specialties list navigation', 'school-theme' ),
        'items_list'            => __( 'Student Specialties list', 'school-theme' ),
        'item_link'             => __( 'Student Specialty Link', 'school-theme' ),
        'item_link_description' => __( 'A link to a student specialty.', 'school-theme' ),
    );
    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'hierarchical'      => true,
        'rewrite'           => array( 'slug' => 'student-specialties' ),
    );
    register_taxonomy( 'fwd-student-specialty', array( 'fwd-student' ), $args );

}
add_action( 'init', 'school_register_taxonomies' );


add_filter( 'enter_title_here', 'my_title_placeholders' );

function my_title_placeholders( $placeholder ){
    $screen = get_current_screen();
	switch ( $screen->post_type ) {
		case 'fwd-student':
			$placeholder = __( 'Add student name' );
			break;
		case 'fwd-staff':
			$placeholder = __( 'Enter course title' );
			break;
		default: break;
		
	}

    return $placeholder;
}

//This will flush permalinks when switching themes
function school_rewrite_flush() {
    school_register_custom_post_types();
    school_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'school_rewrite_flush' );

