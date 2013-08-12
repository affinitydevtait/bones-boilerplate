<?
/**
 * Twitter Class
 *
 * Retrieves Twitter feed and stores data in a transient
 *
 * @author  Trystan Potter
 */
class WP_Affinity_Twitter {
	private $data;
	private $tweets;
	private $seconds = 1800;

	/**
	 * This does all the magic leg work, will poll the Twitter API every half hour maximum
	 * and store it in a transient object (WordPress cache)
	 * 
	 * @param  boolean $multiple Return multiple or a single tweet
	 * @return Object  Tweet object
	 */
	public function anm_tweet($multiple = false) {
		// Debugging
		//delete_transient('twitter_feed');

		// Get Twitter Data
		$this->data = get_transient('twitter_feed');

		$last_update = $this->data[0];
		$this->tweets = $this->data[1];

		// If it hasn't been set yet - set the transient
		if( false == $this->data ) {
			
			// Check admin settings have been set
			if( get_option('consumer_key') ) {
				// Get data
				$this->get_twitter_data();
				$this->set_twitter_transient();
			} else {
				// Throw error?
				$obj = new stdClass();
				$obj->text = "Twitter settings haven't been set, go to WordPress Admin -> Settings -> Twitter Settings";
				$this->tweets[0] = $obj;
			}
		}

		// Return multiple or a single tweet?
		if(true == $multiple) {
			return $this->tweets;
		} else {
			return $this->tweets[0];
		}
	}

	private function get_twitter_data() {
		// Get tweets for this user
		require_once('twitter_api/twitteroauth/twitteroauth.php');

		/* Create a TwitterOauth object with consumer/user tokens. */
		$connection = new TwitterOAuth(get_option('consumer_key'), get_option('consumer_secret'), get_option('access_token'), get_option('access_token_secret'));

		// Pull tweets
		$this->tweets = $connection->get('statuses/user_timeline');
	}

	private function set_twitter_transient() {
		$new_content = array();
		$new_content[0] = time();
		$new_content[1] = $this->tweets;

		// Write tweets to cache file
		set_transient('twitter_feed', $new_content, $this->seconds);
	}
}
?>