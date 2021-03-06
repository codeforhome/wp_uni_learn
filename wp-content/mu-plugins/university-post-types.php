<?php

function university_post_type(){
    //Event Post Type
    register_post_type('event',array(
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'supports' => array('title','editor','excerpt'),
//        'supports' => array('title','editor','excerpt', 'custom-fields'),
        'show_in_rest' => true, //use new blog editor
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event',
        ),
        // This is where we add taxonomies to our CPT
        'taxonomies'          => array( 'category' ),
        'menu_icon' => 'dashicons-calendar',
    ));

    // Program Post Type
    register_post_type('program',array(
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'program'),
        'supports' => array('title'),
//        'supports' => array('title','editor','excerpt', 'custom-fields'),
        'show_in_rest' => true, //use new blog editor
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Program',
            'singular_name' => 'Program',
        ),
        // This is where we add taxonomies to our CPT
//        'taxonomies'          => array( 'category' ),
        'menu_icon' => 'dashicons-awards',
    ));

    // professor Post Type
    register_post_type('professor',array(
    	'show_in_rest' => true,
        'public' => true,
        'supports' => array('title','editor','thumbnail'),
//        'show_in_rest' => true, //use new blog editor
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor',
        ),
        // This is where we add taxonomies to our CPT
//        'taxonomies'          => array( 'category' ),
        'menu_icon' => 'dashicons-welcome-learn-more',
    ));

    // Campus Post Type
    register_post_type('campus',array(
        'public' => true,
        'has_archive' => true,
        'capability_type' => 'campus',
        'map_meta_cap' => true,
        'rewrite' => array('slug' => 'campus'),
        'supports' => array('title','editor'),
        'show_in_rest' => true, //use new blog editor
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus',
        ),
        // This is where we add taxonomies to our CPT
//        'taxonomies'          => array( 'category' ),
        'menu_icon' => 'dashicons-location-alt',
    ));

	// my note Post Type
	register_post_type('note',array(
		'capability_type' => 'note',
		'map_meta_cap' => true,
		'show_in_rest' => true,
		'public' => false,
		'show_ui' => true, //show in admin deskboard
		'supports' => array('title','editor'),
//        'show_in_rest' => true, //use new blog editor
		'labels' => array(
			'name' => 'Notes',
			'add_new_item' => 'Add New Note',
			'edit_item' => 'Edit Note',
			'all_items' => 'All Notes',
			'singular_name' => 'Note',
		),
		// This is where we add taxonomies to our CPT
//        'taxonomies'          => array( 'category' ),
		'menu_icon' => 'dashicons-welcome-write-blog',
	));

	// Slider Post Type
	register_post_type('slider',array(
//		'capability_type' => 'slider',
//		'map_meta_cap' => true,
//		'show_in_rest' => false,
		'public' => false,
		'show_ui' => true, //show in admin deskboard
		'supports' => array('title'),
//        'show_in_rest' => true, //use new blog editor
		'labels' => array(
			'name' => 'Sliders',
			'add_new_item' => 'Add New Slider',
			'edit_item' => 'Edit Slider',
			'all_items' => 'All Sliders',
			'singular_name' => 'Slider',
		),
		// This is where we add taxonomies to our CPT
//        'taxonomies'          => array( 'category' ),
		'menu_icon' => 'dashicons-align-center',
	));


	// my like Post Type
	register_post_type('like',array(
//		'capability_type' => 'like',
//		'map_meta_cap' => true,
//		'show_in_rest' => true,
		'public' => false,
		'show_ui' => true, //show in admin deskboard
		'supports' => array('title'),
		'labels' => array(
			'name' => 'Likes',
			'add_new_item' => 'Add New Like',
			'edit_item' => 'Edit Like',
			'all_items' => 'All Likes',
			'singular_name' => 'Like',
		),
		// This is where we add taxonomies to our CPT
//        'taxonomies'          => array( 'category' ),
		'menu_icon' => 'dashicons-heart',
	));
}

add_action('init','university_post_type');


