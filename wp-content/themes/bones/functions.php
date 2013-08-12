<?php
/*
Author: Ryan Thirlwall @ Affinity New Media

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
Debugging. debug-functions.php
	These query functions will display information at the bottom of the page
	- ?debug=sql
	- ?debug=phpinfo //displays only PHP Information
	- ?debug=http
	- ?debug=cache
	- ?debug=cron
 
	These functions exicuted where called and can be used with eachother
	- dump()
	- add_stop()
	- dump_stops()
	- init_dump()
	- dump_http()
	- dump_trace()
	- print_a()
	- performance()
*/
require_once('library/functions/debug-functions.php'); // you can disable this if you like

/* Affinity Pagination
	- pagination( )
 
 */
require_once('library/functions/pagination-functions.php'); // you can disable this if you like and use bones (bones_page_navi)

/* Boilerplate Functions
 *  A number of function that we have foound useful of the past builds of wordpress
	- get_taxonomy_class()
	- get_thumbnail_caption()
	- get_current_url()
	- get_current_term_ID()
	- the_post_thumbnail_caption()
	- int_to_str()
	- the_date_from_string()
	- get_shorter_excerpt()
	- the_shorter_excerpt()
	- trim_text()
	- current_url() //Deprecated with get_current_url() but still available
	- limit_characters()
    - wph_right_now_content_table_end()
    - df_disable_admin_bar()
 */
require_once('library/functions/boilerplate-functions.php'); 

/*
library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break

/*
library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once('library/custom-post-types/custom-post-type.php'); // you can disable this if you like

/*
library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default

/*
library/translation/translation.php
	- adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/*
library/functions/image-functions.php
	- adding support sharpening resized images ( ajx_sharpen_resized_files )
	- adding support setting crop position on image resizing ( bt_add_image_size( $name, $width, $height, array( $x, $y ) )
*/
require_once('library/functions/image-functions.php'); // you can disable this if you like

/*
library/functions/youtube-class.php
	- adding support to grab youtube video screen shots and save in media library / attach to post ( fetch_youtube_image )
*/
//require_once('library/class/youtube-class.php'); // this comes turned off by default

/*
custom-metaboxes-fields/metabox-functions.php (Added in version 2.1 boilerplate by Ryan@Affinity)
 * Custom Metaboxes and Fields (CMB for short) will create metaboxes with custom fields that will blow your mind.
	- text
	- text small
	- text medium
	- text money
	- date picker
	- date picker (unix timestamp)
	- date time picker combo (unix timestamp)
	- time picker
	- color picker
	- textarea
	- textarea small
	- textarea code
	- select
	- radio
	- radio inline
	- taxonomy radio
	- taxonomy select
	- checkbox
	- multicheck
	- WYSIWYG/TinyMCE
	- Image/file upload
	- oEmbed
*/
require_once('custom-metaboxes-fields/metabox-functions.php'); // you can disable this if you like

/*
library/functions/sidebar-functions.php
	- Place all actyive sidebars
*/
require_once('library/functions/sidebar-functions.php'); 

/*
library/functions/bones-functions.php
	- Native Bones Functions
*/
require_once('library/functions/bones-functions.php'); 

/*
library/functions/members-functions.php
	- Only to be used if WP Members is enabled / installed
*/
require_once('library/functions/members-functions.php'); 

/*
library/functions/custom-functions.php
	- Place any custom functions here
*/
require_once('library/functions/custom-functions.php'); 


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////HOOKS AND IMAGE SIZES///////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////

/******************* ADD HOOKS ********************/
/* Metabox hook */
add_action('init', 'include_init_file');// you can disable this if you like

/* All Settings Hook */
add_action('admin_menu', 'all_settings_link'); // Enables the All Settings option under the settings menu

/* Custom Post Type Right Now Hook */
add_action( 'right_now_content_table_end' , 'wph_right_now_content_table_end' );

/* Remove Header information */
add_action('init', 'remove_header_info'); // remove unnecessary header info

/* Hook the administrative header output */
//add_action('admin_head', 'my_custom_logo'); // this comes turned off by default

/* Google Analytics Hook */
//add_action('wp_footer', 'add_googleanalytics'); // this comes turned off by default

/* Disable Admin Tool Bar */
add_action('init','df_disable_admin_bar');

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

// SQUARED THUMBNAILS
add_image_size( "145thumb", 145, 145, true ); 

// CUSTOM CROPPING ( Position of crop: array( 'center', 'top' ) )
bt_add_image_size( 'custom-top', 981, 330, array( 'center', 'top' ) );
bt_add_image_size( 'custom-center', 982, 330, array( 'center', 'center' ) );
bt_add_image_size( 'custom-bottom', 979, 330, array( 'center', 'bottom' ) );

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
