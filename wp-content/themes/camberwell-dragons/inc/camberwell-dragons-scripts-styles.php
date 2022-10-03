<?php

/**
 * Add Main camberwell-dragons Style and Scripts
 * 
 * @package camberwell-dragons
 */
add_action('wp_enqueue_scripts', 'enqueue_camberwell_main_styles');
if (!function_exists('enqueue_camberwell_main_styles')) :

    function enqueue_camberwell_main_styles() {
        wp_register_style('camberwell-main-style', get_template_directory_uri() . '/public/css/main.css');
        wp_enqueue_style('camberwell-main-style');

        wp_register_style('camberwell-custom-style', get_template_directory_uri() . '/custom/custom.css');
        wp_enqueue_style('camberwell-custom-style');
    }

endif;

add_action('wp_footer', 'enqueue_camberwell_main_scripts');
if (!function_exists('enqueue_camberwell_main_scripts')) :

    function enqueue_camberwell_main_scripts() {
        wp_enqueue_script('camberwell-vendor-js', get_template_directory_uri() . '/public/js/vendor.js', array('jquery-core'), 100, true);
        wp_enqueue_script('camberwell-main-js', get_template_directory_uri() . '/public/js/main.js', array('jquery-core'), 100, true);

       /*  if (is_singular('event')) {
            wp_enqueue_script('camberwell-atc-js', get_template_directory_uri() . '/custom/atc.js', array('jquery-core'), 100, true);
        } */

        wp_register_script('camberwell-custom-js', get_template_directory_uri() . '/custom/custom.js', array('jquery-core'), '', true);
        wp_localize_script('camberwell-custom-js', 'ajax_posts', array('ajaxurl' => admin_url('admin-ajax.php'), 'template_directory_uri' => get_template_directory_uri()));
        wp_enqueue_script('camberwell-custom-js');
    }
endif;