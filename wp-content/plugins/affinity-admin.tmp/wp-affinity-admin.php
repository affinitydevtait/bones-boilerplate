<?php
/*
Plugin Name: Affinity Admin
Plugin URI: http://www.affinitynewmedia.com
Description: Themes WordPress Admin for Affinity New Media and adds some basic debugging stuff to front end (no overhead) and adds Twitter Functions
Version: 0.16.0
Author: Trystan Potter
Author URI: http://www.affinitynewmedia.com
*/

/**
 * To Do List
 *
 * Tools - Developer Tools & Debugging
 * Tools - Generate Theme (Starkers Variant)
 * Tools - Permission Check
 * Tools - Signoff Assistant
 * Settings - Admin Reskin
 * Settings - Using News Option (Sets up Custom Post Type - optionally hides Posts)
 * Settings - Social (Twitter done, Facebook?)
 * Documents - Advanced Custom Fields Serials
 * Documents - Plugins (List of common Plugins we use)
 * Documents - Documentation / Guidelines
 * Documents - Client Help Guides
 */


include("wp-affinity-admin/Admin.php");
include("wp-affinity-admin/Debug.php");
include("wp-affinity-admin/Documents.php");
include("wp-affinity-admin/Settings.php");
include("wp-affinity-admin/Tools.php");
include("wp-affinity-admin/Update.php");

include("Social/Social.php");



class WP_Affinity_Admin {
	
	// Classes
	public $admin;
	public $debug;
	public $documents;
	public $settings;
	public $social;
	public $tools;
	public $update;

	public function __construct() {		
		$this->admin = new WP_Admin;
		$this->debug = new WP_Debug;
		$this->social = new WP_Social;
		$this->settings = new WP_Settings;
		$this->tools = new WP_Tools;
		$this->documents = new WP_Documents;
		$this->update = new WP_Update;

		$this->init();
	}
	
	public function init() {
        
		isset($_REQUEST['_wp_affinity_nonce']) ? add_action('admin_init',array($this,'wp_affinity_options_save')) : null;

		// Trystans Custom Post Type Archive Fix
		add_filter('nav_menu_css_class', array($this, 'current_type_nav_class'), 10, 2);

		// Affinity Toolset stuff
        add_action( 'admin_menu', array($this,'anm_menu') );
        add_action( 'admin_init', array($this,'register_settings') );
	}

	/**
	 * [register_settings description]
	 * @return [type] [description]
	 */
	function register_settings() {
		// Tools settings
		register_setting( "anm_tools_options", "developer_mode" );
		register_setting( "anm_tools_options", "developer_IP" );

		// Settings settings
		register_setting( "anm_settings_options", "using_posts" );
		register_setting( "anm_settings_options", "using_comments" );

		// Social settings
		register_setting( "anm_options_group", "consumer_key" );
		register_setting( "anm_options_group", "consumer_secret" );
		register_setting( "anm_options_group", "access_token" );
		register_setting( "anm_options_group", "access_token_secret" );
	}

	/**
	 * [anm_menu description]
	 * @return [type] [description]
	 */
	function anm_menu() {
		
		add_menu_page( "Affinity Toolset", "Affinity Toolset", "manage_options", "tools", array($this,'anm_options'), "", 76 );

		add_submenu_page( 'tools', 'Settings', 'Settings', "manage_options", "settings", array($this,'anm_options') );
		add_submenu_page( 'tools', 'Documents', 'Documents', "manage_options", "documents", array($this,'anm_options') );
		add_submenu_page( 'tools', 'Developers', 'Developers', "manage_options", "developers", array($this,'anm_options') );
	}

	/**
	 * [anm_options description]
	 * @return [type] [description]
	 */
	function anm_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		?>
		<div class="wrap">
  			<div id="icon-themes" class="icon32">
  				<br />
  			</div>
  			<h2 class="nav-tab-wrapper">
  				<a class="nav-tab nav-tab-active" href="?page=tools">Tools</a>
  				<a class="nav-tab" href="?page=settings">Settings</a>
  				<a class="nav-tab" href="?page=documents">Documents</a>
  				<a class="nav-tab" href="?page=developers">Developers</a>
			</h2>
			<div class="tab" id="tabs-tools">
				<? $this->tools->get_tab_content(); ?>
			</div>
			<div class="tab" id="tabs-settings">
				<? $this->settings->get_tab_content(); ?>
			</div>
			<div class="tab" id="tabs-documents">
				<? $this->documents->get_documents_tab_content(); ?>
			</div>
			<div class="tab" id="tabs-developers">
				<? $this->documents->get_developers_tab_content(); ?>
			</div>
		</div>
		
		<style>
		.wrap .tab {
			display:none;
		}
		</style>

		<?
		$this->get_js($_GET['page']);
	}

	private function get_js( $active_tab = "tools" ) {
		?>
		<script>
		jQuery(function($) {
			$('.nav-tab').click(function(e) {
				e.preventDefault();

				// Hide all tabs
				$('.wrap .tab').hide();

				// Unselect selected tab
				$('.nav-tab-active').removeClass('nav-tab-active');

				// Get href
				var tab = '#tabs-' + $(this).attr('href').substr(6);

				// Show selected tab
				$(tab).show();

				// Change selected state
				$(this).addClass('nav-tab-active');
			});

			<? echo "$('a[href=\"?page=" . $active_tab . "\"]').click();"; ?>
		});
		</script>
		<?
	}
    
    
	
	
	
	
	/**
	 * Trystans Custom Post Type Archive Parent Menu Fix 
	 *
	 * Sounds complicated - but it isn't. If you don't know what it fixes,
	 * you don't need to use or worry about it.
	 *
	 * In order for this to work reliably, you'll need to go to:
	 * Settings -> Reading -> Front page displays 
	 *   Change the Posts page to --Select--
	 *
	 * Otherwise the News/Blog will always be the parent
	 */
	public function current_type_nav_class($classes, $item) {
	    // Get slug rewrite for the current page post type
	    $this_post_type = get_post_type_object(get_post_type());
	    $rewrite_slug = $this_post_type->rewrite['slug'];

	    // Check if the rewrite slug is same as the menu slug, if it is, parent!
	    if( $rewrite_slug == basename($item->url) ):
	    	array_push($classes, 'current_page_parent');
	    endif;
		
	    return $classes;
	}
}




/**
 * [anm_tweet description]
 * @param  boolean $multiple [description]
 * @return [type]            [description]
 */
function anm_tweet($multiple = false) {
	return $social->anm_tweet($multiple);
}


function is_template( $template = '' ) {
        
    $page_template = get_page_template_slug( get_queried_object_id() );

    if( false == $page_template ) {
         $page_template = basename(get_single_template( get_queried_object_id() ));
    }

    if ( empty( $template ) ) {
        return (bool) $page_template;
    }

    if( is_array($template) ) {

        foreach($template as $t) {
            if ( $t == $page_template ) {
                return true;
            }
        }
    } else {
        if ( $template == $page_template ) {
            return true;
        }

        if ( 'default' == $template && ! $page_template ) {
            return true;
        }
    }

    return false;
}



function current_page_url() {
	$pageURL = 'http';
	
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	
	$pageURL .= "://";
	
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}

	return $pageURL;
}



new WP_Affinity_Admin;
?>