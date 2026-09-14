<?php

function school_register_custom_post_types(){

}
add_action( 'init', 'school_register_custom_post_types' );
function school_register_taxonomies(){

}
add_action( 'init', 'school_register_taxonomies' );





//This will flush permalinks when switching themes
function school_rewrite_flush() {
    school_register_custom_post_types();
    school_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'school_rewrite_flush' );