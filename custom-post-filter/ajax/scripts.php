<?php
function load_scripts() {
	wp_enqueue_script('ajax-script', get_stylesheet_directory_uri() .'/assets/js/filter-post.js', array('jquery'), time(), true);
	wp_localize_script('ajax-script','wp_ajax', array("ajax_url" => admin_url('admin-ajax.php')));

}
add_action('wp_enqueue_scripts', 'load_scripts');
