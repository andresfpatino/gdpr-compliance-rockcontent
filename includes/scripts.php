<?php 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/* Front */
function front_scripts() {
    wp_enqueue_style('front-gdpr-css', plugins_url('../public/css/gdpr-compliance-public.css', __FILE__));

}
add_action('wp_enqueue_scripts', 'front_scripts');


/* Admin */
function admin_scripts(){   
    wp_enqueue_style('admin-gdpr-css', plugins_url('../admin/css/gdpr-compliance-admin.css', __FILE__));  
}
add_action('admin_enqueue_scripts', 'admin_scripts');