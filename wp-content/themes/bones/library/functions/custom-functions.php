<?php
/************* CUSTOM FUNCTIONS *****************/

function my_custom_logo() {
	echo '
		<style type="text/css">
			#header-logo { background-image: url(' . get_bloginfo('template_directory') . '/library/images/custom-logo.gif) !important; }
		</style>
	';
}

// remove unnecessary header info
function remove_header_info() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link');         // for WordPress <  3.0
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // for WordPress >= 3.0
}

function add_googleanalytics() {
	// Paste your Google Analytics code
}

// Some more functions.....
?>
