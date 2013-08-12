<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/
/*
 *  Modified By Ryan@Affinity for version 2.1 boilerplate
 * @link http://generatewp.com/
 */


// Register Custom Taxonomy
function custom_taxonomy()  {
	
	$single = 'Genre';
	$plural = 'Genres';
	$slug	= 'genre';
	
	$labels = array(
		'name'                       => _x( $plural, 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( $single, 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( $single, 'text_domain' ),
		'all_items'                  => __( 'All Genres', 'text_domain' ),
		'parent_item'                => __( 'Parent ' . $single, 'text_domain' ),
		'parent_item_colon'          => __( 'Parent ' . $single . ':', 'text_domain' ),
		'new_item_name'              => __( 'New ' . $single . ' Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New ' . $single, 'text_domain' ),
		'edit_item'                  => __( 'Edit ' . $single, 'text_domain' ),
		'update_item'                => __( 'Update '  . $single, 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas', 'text_domain' ),
		'search_items'               => __( 'Search ' . $plural, 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove ' . $plural, 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used ' . $plural, 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => $slug,
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$capabilities = array(
		'manage_terms'               => 'manage_categories',
		'edit_terms'                 => 'manage_categories',
		'delete_terms'               => 'manage_categories',
		'assign_terms'               => 'edit_posts',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => $slug,
		'rewrite'                    => $rewrite,
		'capabilities'               => $capabilities,
		'update_count_callback'      => 'myCallBackFunction',
	);
	register_taxonomy( 'genre', 'post', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy', 0 );

//callback function
function myCallBackFunction (){
	//Update Count
}

// Register Custom Post Type
function custom_post_type() {
	
	$single = 'Product';
	$plural = 'Products';
	
	//Post type supports
	$supports = array( 
		'title', 
		'editor', 
		'excerpt', 
		'author', 
		'thumbnail', 
		'comments', 
		'trackbacks', 
		'revisions', 
		'custom-fields', 
		'page-attributes', 
		'post-formats', 
	);
	
	//Post Type taxonomies available
	$taxonomies = array( 
		'category', 
		'post_tag' 
	);
	
	$labels = array(
		'name'                => _x( 'Products', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( $single, 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( $single, 'text_domain' ),
		'parent_item_colon'   => __( 'Parent ' . $single . ':', 'text_domain' ),
		'all_items'           => __( 'All ' . $plural, 'text_domain' ),
		'view_item'           => __( 'View ' . $single, 'text_domain' ),
		'add_new_item'        => __( 'Add New ' . $single, 'text_domain' ),
		'add_new'             => __( 'New ' . $single, 'text_domain' ),
		'edit_item'           => __( 'Edit ' . $single, 'text_domain' ),
		'update_item'         => __( 'Update ' . $single, 'text_domain' ),
		'search_items'        => __( 'Search ' . $plural, 'text_domain' ),
		'not_found'           => __( 'No ' . $plural . ' found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No ' . $plural . ' found in Trash', 'text_domain' ),
	);
	
	$rewrite = array(
		'slug'                => 'product',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	// Comment out where applicable
	$capabilities = array(
		'edit_post'           => 'edit_post',
		'read_post'           => 'read_post',
		'delete_post'         => 'delete_post',
		'edit_posts'          => 'edit_posts',
		'edit_others_posts'   => 'edit_others_posts',
		'publish_posts'       => 'publish_posts',
		'read_private_posts'  => 'read_private_posts',
	);
	
	$args = array(
		'label'               => __( 'product', 'text_domain' ),
		'description'         => __( 'Product information pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => $supports,
		'taxonomies'          => $taxonomies,
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => get_bloginfo('template_url') . '/library/images/custom-post-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'product',
		'rewrite'             => $rewrite,
		'capabilities'        => $capabilities,
	);
	
	register_post_type( 'product', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );

?>
