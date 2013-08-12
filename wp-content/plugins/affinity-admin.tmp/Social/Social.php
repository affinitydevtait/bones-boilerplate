<?
include("Twitter.php");

/**
 * 
 */
class WP_Social {
	public $twitter;

	public function WP_Social() {
		$twitter = new WP_Affinity_Twitter;
	}

	public function anm_tweet($multiple = false) {

		return $twitter->anm_tweet($multiple);
	}
}


?>