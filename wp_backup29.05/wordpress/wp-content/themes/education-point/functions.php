<?php

/**
 * Load css files.
 * @return [type] [description]
 */
function education_point_enqueue_style() {

    wp_enqueue_style( 'di-business-style-default', get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'responsive-commerce-style',  get_stylesheet_directory_uri() . '/style.css', array( 'bootstrap', 'font-awesome', 'di-business-style-default', 'di-business-style-core' ), wp_get_theme()->get('Version'), 'all');

}
add_action( 'wp_enqueue_scripts', 'education_point_enqueue_style' );

/**
 * [education_point_setup description]
 * @return [type] [description]
 */
function education_point_setup() {

	register_nav_menus( array(
		'epfooter'	=> __( 'Footer Menu', 'education-point' ),
	) );
	
}
add_action( 'after_setup_theme', 'education_point_setup' );

