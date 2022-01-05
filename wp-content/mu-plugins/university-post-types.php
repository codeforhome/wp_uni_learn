<?php

function university_post_type(){
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
}

add_action('init','university_post_type');