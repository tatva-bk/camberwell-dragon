<?php
/**
 * Functions which create Custom Posttypes into WordPress
 *
 * @package camberwell
 */

add_action('init', 'camberwell_dragons_create_post_type');
function camberwell_dragons_create_post_type() {
    
    $support = array('title', 'editor', 'thumbnail', 'revisions', 'author', 'excerpt');
    generate_post_type('Events', 3, $support, 'event', ['menu_icon' => 'dashicons-calendar']);
    generate_post_type('Programs', 3, $support, 'program', ['menu_icon' => 'dashicons-groups']);
    generate_post_type('Championship', 3, $support, 'championship', ['menu_icon' => 'dashicons-awards']);

}

// Function to generate custom Post type
function generate_post_type($string, $flag = 0, $support = '', $slug = '', $extra = array()) {
    
    $singular = ucwords($string);
    $plural = $singular;
    if ($flag == 0) {
        $plural = $singular . "s";
    } else if ($flag == 1) {
        $plural = rtrim($singular, "y") . "ies";
    } else if ($flag == 2) {
        $plural = $singular . "es";
    } else if ($flag == 3) {
        $plural = $singular;
    }

    if ($support == '') {
        $support = array('title', 'editor', 'thumbnail', 'revisions', 'author', 'excerpt');
    }
    $labels = array(
        'name' => _x($plural, $string),
        'singular_name' => _x($singular, $string),
        'add_new' => _x('Add New', $string),
        'add_new_item' => _x('Add New ' . $singular, $string),
        'edit_item' => _x('Edit ' . $singular, $string),
        'new_item' => _x('New ' . $singular, $string),
        'view_item' => _x('View ' . $plural, $string),
        'search_items' => _x('Search ' . $plural, $string),
        'not_found' => _x('No ' . $plural . ' found', $string),
        'not_found_in_trash' => _x('No ' . $plural . ' found in Trash', $string),
        'parent_item_colon' => _x('Parent ' . $singular . ':', $string),
        'menu_name' => _x($plural, $singular),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Allows the user to create ' . $plural,
        'supports' => $support,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'show_in_rest' => true
    );
    if (!empty($extra)) {
        $args = array_merge($args, $extra);
    }
    
    $string = ($slug != '') ? $slug : $string;
    register_post_type($string, $args);
}