 <?php
	/**
	 * 
	 * @return boolean or redirect
	 */
	function check_login_status(){

		if ( is_user_logged_in() === FALSE ){
			if( is_page('login') === FALSE ){
				header('Location: ' . site_url('login') );
			}
		}

		if ( is_user_logged_in() === TRUE ){
			if( is_page('membership') === FALSE ){
				header('Location: ' . site_url('membership') );
			}
		}

	}
	/**
	 * @name display_login()
	 * 
	 * This is another optional page. If you want to be able to direct users to a specific page for login, 
	 * this shortcode allows you to establish a page strictly for that.
	 * 
	 * IMPORTANT: If you are blocking pages by default, this page must be set as unblocked! 
	 * If the page is blocked, it will display a login form as well as the registration form.
	 */
	function display_login(){
		echo do_shortcode('[wp-members page="login"]');
	}

	/**
	 * @name display_registration()
	 * 
	 * The register attribute creates a registration page.  This page is strictly optional, 
	 * since the plugin can place registration in place of the blocked content.  
	 * But some people find that they want to direct users to a specific page for registration. 
	 * Also, if you have a registration page, you can have a registration link display in all of 
	 * the login forms.
	 * 
	 * IMPORTANT: If you are blocking pages by default, this page must be set as unblocked! 
	 * If the page is blocked, it will display a login form as well as the registration form.
	 */
	function display_registration(){
		echo do_shortcode('[wp-members page="register"]');
	}

	/**
	 * @name display_user_profile()
	 * 
	 * While this page is considered optional in terms of the plugin’s operation of blocking content, 
	 * it is a recommended page to set up.  This page allows logged in users to change their password 
	 * (helpful for changing the random password sent by the default plugin setup) and also update 
	 * their registration information.  Also on this page, a user that is not logged in can reset a 
	 * forgotten password.  
	 * 
	 * NOTE: in 2.8.1, this replaces the “members-area” parameter.  If you are using members-area, 
	 * it will still work for now, but you should consider updating to the new parameter.  
	 * If you are using 2.8.0 or earlier, you will need to use the members-area parameter instead 
	 * of user-profile.
	 *
	 * IMPORTANT: If you are blocking pages by default, this page must be set as unblocked! 
	 * If the page is blocked, it will display a login form as well as the registration form.
	 */
	function display_user_profile(){
		echo do_shortcode('[wp-members page="user-profile"]');
	}

	/**
	 * 
	 */
	function password_reset(){
		echo do_shortcode('[wp-members page="password"]');
	}

	/**
	 * 
	 * @param type $fullname
	 * @param type $echo
	 * @return type
	 */
	function display_username( $fullname = FALSE, $echo = FALSE ){
		if( $fullname === TRUE ){
			$return = do_shortcode('[wp-members field="first_name"]') . ' ' . do_shortcode('[wp-members field="last_name"]');
		}else{
			$return = do_shortcode('[wp-members page="user_login"]');
		}

		if( $echo === TRUE ){
			echo $return;
		}else{
			return $return;
		}
	}
	/**
	 * 
	 */
	function display_user_interface(){
		$return = '<ul id="members-profile-menu-logout">';
		$return .= '<li><strong>Welcome</strong></li>';
		$return .= '<li><a class="profile-link" href="' . get_profile_url() . '" title="Edit Profile">' . userinfo('user_login') . '</li>';
		$return .= '<li><a class="logout-link" href="' . wp_logout_url( home_url() ) . '" title="Logout">Logout</a></li>';
		$return .= '</ul>';
		echo $return;
	}
	/**
	 * 
	 * @global type $current_user
	 * @param type $info
	 * @return type
	 */
	function userinfo( $info = FALSE ){
		global $current_user;
		get_currentuserinfo();

		if($info !== FALSE) return $current_user->$info;
		
		return $current_user;
	}
	/**
	 * 
	 * @return type
	 */
	function get_profile_url(){
		return get_option('wpmembers_msurl');
	}
	/**
	 * 
	 * @return type
	 */
	function get_register_url(){
		return get_option('wpmembers_regurl');
	}
	/**
	 * 
	 * @global type $current_user
	 * @return the logged in users access level
	 */
	function access_level(){
		global $current_user;
		get_currentuserinfo();

		$access_level = $current_user->roles;

		return $access_level[0];
	}

	/**
	 * WP_ADMIN FIXES
	 * 
	 */
	add_filter( 'wpmem_login_form', 'remove_wpmem_txt' );
	add_filter( 'wpmem_register_form', 'remove_wpmem_txt' );

	function remove_wpmem_txt( $form ) {
		$old = array( '[wpmem_txt]', '[/wpmem_txt]' );
		$new = array( '', '' );
		return str_replace( $old, $new, $form );
	}
?>
