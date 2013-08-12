<?php
Class youtube_thumb {
    public $wpdb;
    public $updated;
    
    public function __construct() {
        $this->wpdb = $GLOBALS[wpdb];
    }
    
    function fetch_youtube_image( $post_ID )  
    {	
        //Check to make sure function is not executed more than once on save
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return;

        if ( !current_user_can('edit_post', $post_ID) ) 
        return;

        //remove_action('save_post', 'fetch_youtube_image');	

        $post = get_post( $post_ID );
        $youtube_url = get_field('youtube_url');
        $parse_url = parse_url($youtube_url);
        $ytcode = str_replace('v=', '', $parse_url['query']);
        $youtube_image = 'http://img.youtube.com/vi/' . $ytcode . '/maxresdefault.jpg';

        if ( strpos( $youtube_image, $_SERVER['HTTP_HOST'] )===false && $youtube_url)
        {

            //Fetch and Store the Image	
            $get = wp_remote_get( $youtube_image );
            $type = wp_remote_retrieve_header( $get, 'content-type' );
            $mirror = wp_upload_bits( rawurldecode( basename( $youtube_image ) ), '', wp_remote_retrieve_body( $get ) );

            $attachment = array(
            'post_title'=> basename( $youtube_image ),
            'post_mime_type' => $type
            );

            if( get_field('youtube_thumbnail') == '' )
            {
                $attach_id = wp_insert_attachment( $attachment, $mirror['file'], $post_ID );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $youtube_image );

                wp_update_attachment_metadata( $attach_id, $attach_data );

                $this->updated = $attach_id;

                add_filter('acf/update_value/name=youtube_thumbnail', array($this, "my_acf_update_value"), 10, 3);

            }

            add_action('save_post', 'fetch_youtube_image');		
        } 
    }
    
    function my_acf_update_value( ) {
        return $this->updated;
    }
}
?>
