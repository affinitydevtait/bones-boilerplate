<?
class WP_Settings {
	
	private $hide = array();

	/**
	 * [WP_Settings description]
	 */
	public function WP_Settings() {
		$this->using_posts();
		$this->using_comments();

		add_action('admin_menu', array($this, 'hide_menus'));
	}

	public function using_posts() {
		
		// Set default value
		if( "" == get_option('using_posts') ):
			update_option('using_posts', "true");
		endif;

		if( "false" == get_option('using_posts')):
			array_push($this->hide, __('Posts'));
		endif;
	}

	public function using_comments() {
		
		// Set default value
		if( "" == get_option('using_comments') ):
			update_option('using_comments', "true");
		endif;

		if( "false" == get_option('using_comments')):
			array_push($this->hide, __('Comments'));
		endif;
	}

	public function hide_menus () {
		global $menu;
		end ($menu);
		
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL?$value[0]:"" , $this->hide)){unset($menu[key($menu)]);}
		}
	}

	public function get_tab_content() {
		 /*
		 * Settings - Admin Reskin
		 * Settings - Using News Option (Sets up Custom Post Type - optionally hides Posts)
		 * Settings - Social (Twitter done, Facebook?)
		 */
		?>
		<?php //screen_icon(); ?>
		<h2>Generic Settings</h2>
		
		<form method="post" action="options.php"> 
		<? settings_fields( 'anm_settings_options' ); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="blogname">Admin Reskin</label></th>
				<td>
					<fieldset>
					<label title='Enabled'><input type='radio' name='admin_reskin' value='true' disabled="disabled" /> <span>Enabled</span></label><br />
					<label title='Disabled'><input type='radio' name='admin_reskin' value='false' disabled="disabled" /> <span>Disabled</span></label><br />
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="blogname">Using Posts</label></th>
				<td>
					<fieldset>
					<label title='Enabled'><input type='radio' name='using_posts' value='true' <? echo (get_option('using_posts') == "true") ? "checked='checked'" : ""; ?> /> <span>Enabled</span></label><br />
					<label title='Disabled'><input type='radio' name='using_posts' value='false' <? echo (get_option('using_posts') == "true") ? "" : "checked='checked'"; ?> /> <span>Disabled</span></label><br />
					<p class="description">Hides Posts Menu Item. If you want to use News, create a custom post type!</p>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="blogname">Using Comments</label></th>
				<td>
					<fieldset>
					<label title='Enabled'><input type='radio' name='using_comments' value='true' <? echo (get_option('using_comments') == "true") ? "checked='checked'" : ""; ?> /> <span>Enabled</span></label><br />
					<label title='Disabled'><input type='radio' name='using_comments' value='false' <? echo (get_option('using_comments') == "true") ? "" : "checked='checked'"; ?> /> <span>Disabled</span></label><br />
					<p class="description">Hides Comments Menu Item.</p>
					</fieldset>
				</td>
			</tr>
		</table>
		<? submit_button(); ?>
		</form>

		<h2>Twitter Settings</h2>
		
		<p>This uses the API from Twitter to retrieve a user's tweets</p>

		<h3>Client Instructions</h3>

		<ol>
			<li>Go to <a href="https://dev.twitter.com" target="_blank">https://dev.twitter.com</a> and sign in</li>
			<li>Hover over their screen name (top right) and go to 'My Applications'</li>
			<li>Click 'Create a new application'</li>
			<li>
				Enter these details:<br />
				<ul>
					<li><strong>Name:</strong> &lt;CompanyName&gt; Tweet Feed</li>
						<li><strong>Description:</strong> Pulls the users latest tweets</li>
					<li><strong>Website:</strong> http://www.affinitynewmedia.com</li>
				</ul>
				Obviously replace &lt;CompanyName&gt; with the Company Name, eg. "Affinity Tweet Feed"
			</li>
			<li>Agree to their terms &amp; conditions, enter captcha and click create</li>
			<li>Click 'Create my access token'</li>
			<li>Email Affinity the Consumer Key, Consumer Secret, Access token and Access token secret</li>
		</ol>

		<br />

		<h3>Access Keys</h3>

		<form method="post" action="options.php"> 
		<? settings_fields( 'anm_options_group' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Consumer Key</th>
				<td><input type="text" name="consumer_key" value="<?php echo get_option('consumer_key'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Consumer Secret</th>
				<td><input type="text" name="consumer_secret" value="<?php echo get_option('consumer_secret'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Access Token</th>
				<td><input type="text" name="access_token" value="<?php echo get_option('access_token'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Access Token Secret</th>
				<td><input type="text" name="access_token_secret" value="<?php echo get_option('access_token_secret'); ?>" /></td>
			</tr>
		</table>

		<? submit_button(); ?>
		</form>

		<br />
		
		<h3>Developer Instructions</h3>

		<p>
			$tweet = anm_tweet();<br />
$timestamp = strtotime($tweet-&gt;created_at);<br />
$tweet_content = $tweet-&gt;text;<br />
$screen_name = $tweet-&gt;user-&gt;screen_name;<br />
$profile_link = "https://twitter.com/" . $screen_name;<br />
$tweet_link = "https://twitter.com/" . $screen_name . "/status/" . $tweet->id_str;<br /><br />

echo &quot;Timestamp: &quot; . $timestamp . &quot;&lt;br /&gt;&quot;;<br />
echo &quot;Date in dd mm yyyy format:&quot; . date(&quot;d m Y&quot;, $timestamp) . &quot;&lt;br /&gt;&quot;;<br />
echo &quot;Tweet Content: &quot; . $tweet_content . &quot;&lt;br /&gt;&quot;;<br />
echo &quot;Screen Name: &quot; . $screen_name . &quot;&lt;br /&gt;&quot;;<br />
		</p>
		<?
	}
}







?>