<?php

function university_post_type(){
    //Event Post Type
    register_post_type('event',array(
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
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
        'supports' => array('title','editor'),
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
}

add_action('init','university_post_type');