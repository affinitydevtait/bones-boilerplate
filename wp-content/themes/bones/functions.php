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

/*
Author: Eddie Machado
URL: htp://themble.com/bones/

1. library/bones.php
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
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once('library/custom-post-type.php'); // you can disable this if you like

/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default

/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/*
5. library/functions/image-functions.php
	- adding support sharpening resized images ( ajx_sharpen_resized_files )
	- adding support setting crop position on image resizing ( bt_add_image_size( $name, $width, $height, array( $x, $y ) )
*/
require_once('library/functions/image-functions.php'); // you can disable this if you like

/*
6. library/functions/youtube-class.php
	- adding support to grab youtube video screen shots and save in media library / attach to post ( fetch_youtube_image )
*/
//require_once('library/functions/youtube-class.php'); // this comes turned off by default

/*
7. custom-metaboxes-fields/metabox-functions.php (Added in version 2.1 boilerplate by Ryan@Affinity)
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
/************* LOAD INIT FILE *****************/
function include_init_file() {
    require_once 'custom-metaboxes-fields/init.php';
}
// relevant functions
require_once('custom-metaboxes-fields/metabox-functions.php'); // you can disable this if you like


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

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __('Sidebar 1', 'bonestheme'),
		'description' => __('The first (primary) sidebar.', 'bonestheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __('Sidebar 2', 'bonestheme'),
		'description' => __('The second (secondary) sidebar.', 'bonestheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* DISABLE ADMIN BAR *********************/

if (!function_exists('df_disable_admin_bar')) {
	
	function df_disable_admin_bar() {
		
		// for the admin page
		remove_action('admin_footer', 'wp_admin_bar_render', 1000);
		// for the front-end
		remove_action('wp_footer', 'wp_admin_bar_render', 1000);
	  	
		// css override for the admin page
		function remove_admin_bar_style_backend() { 
			echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';
		}	  
		add_filter('admin_head','remove_admin_bar_style_backend');
		
		// css override for the frontend
		function remove_admin_bar_style_frontend() {
			echo '<style type="text/css" media="screen">
			html { margin-top: 0px !important; }
			* html body { margin-top: 0px !important; }
			</style>';
		}
		add_filter('wp_head','remove_admin_bar_style_frontend', 99);
  	}
}

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>', 'bonestheme'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'bonestheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
	</form>';
	return $form;
} // don't remove this bracket!

/************* ALL SETTINGS *****************/
// CUSTOM ADMIN MENU LINK FOR ALL SETTINGS
   function all_settings_link() {
    add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
   }
   
/************* RIGHT NOW MOD *****************/
// ADD CUSTOM POST TYPES TO THE 'RIGHT NOW' DASHBOARD WIDGET
function wph_right_now_content_table_end() {
	$args = array(
	 'public' => true ,
	 '_builtin' => false
	);
	
	$output = 'object';
	$operator = 'and';
	$post_types = get_post_types( $args , $output , $operator );
	
	foreach( $post_types as $post_type ) {
		
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
		
		if ( current_user_can( 'edit_posts' ) ) {
			$num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
			$text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
		}
		
		echo '<tr><td class="first num b b-' . $post_type->name . '">' . $num . '</td>';
		echo '<td class="text t ' . $post_type->name . '">' . $text . '</td></tr>';
		
	}
	
	$taxonomies = get_taxonomies( $args , $output , $operator ); 
	
	foreach( $taxonomies as $taxonomy ) {
		
		$num_terms  = wp_count_terms( $taxonomy->name );
		$num = number_format_i18n( $num_terms );
		$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ));
		
		if ( current_user_can( 'manage_categories' ) ) {
			$num = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$num</a>";
			$text = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$text</a>";
		}
		
		echo '<tr><td class="first b b-' . $taxonomy->name . '">' . $num . '</td>';
		echo '<td class="t ' . $taxonomy->name . '">' . $text . '</td></tr>';
	}
}


/************* CUSTOM BOILERPLATE FUNCTIONS *****************/

/**
 * @function get_taxonomy_class( $var )
 * @param type $var
 * @staticvar $term 
 *		@uses get_queried_object()
 *		@see http://codex.wordpress.org/Function_Reference/get_queried_object
 * @return string
 */
function get_taxonomy_class( $var ){
  $term = get_queried_object();   
  $taxonomy_class = $var  . '_' . $term->term_id;
  return $taxonomy_class;
}

/**
 * @function get_thumbnail_caption( $image_id )
 * @param type $image_id
 * @staticvar $thumbnail_image image query
 *		@uses get_posts()
 *		@see http://codex.wordpress.org/Function_Reference/get_post
 * @return type
 */
function get_thumbnail_caption( $image_id ) {

  $thumbnail_image = get_posts(array('p' => $image_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    return $thumbnail_image[0]->post_excerpt;
  }
}

/**
 * @function get_current_url()
 * @uses add_query_arg()
 * @see http://codex.wordpress.org/Function_Reference/add_query_arg
 * 
 * @global type $wp
 * @return type
 */
function get_current_url(){
	global $wp;
	return add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
}

/**
 * 
 * @global type $post
 * @return type
 */
function get_current_term_ID(){
	global $post;
	$terms = wp_get_object_terms( $post->ID, 'category', array('fields'=>'ids'));
    return array_pop( $terms );
}

/**
 * @function the_post_thumbnail_caption()
 * @global type $post
 * @staticvar $thumbnail_id the thmbnail ID
 *		@uses get_post_thumbnail_id()
 *		@see http://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
 * @staticvar $thumbnail_image image query
 *		@uses get_posts()
 *		@see http://codex.wordpress.org/Function_Reference/get_post
 * @return echo The image caption
 */
function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
  }
}

/**
 * 
 * @param type $no
 * @return string
 */
function int_to_str( $no )
{    
	$words = array('0'=> 'zero' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');

    if($no == 0)
        return ' ';
    else {           $novalue='';$highno=$no;$remainno=0;$value=100;$value1=1000;        
            while($no>=100)    {
                if(($value <= $no) &&($no  < $value1))    {
                $novalue=$words["$value"];
                $highno = (int)($no/$value);
                $remainno = $no % $value;
                break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }        
          if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".int_to_str($remainno);
          else { 
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;             
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".int_to_str($remainno);
           }
    }
}

/**
 * 
 * @param type $string
 * @param type $format
 * @return type
 */
function the_date_from_string( $string, $format = 'Y-m-d' )
{
    return date( $format, strtotime( $string ) );
}

/**
 * 
 * @param type $length
 * @return type
 */
function get_shorter_excerpt($length) {
	$excerpt = get_the_excerpt();
	return substr($excerpt, 0, $length) . ((strlen($excerpt) > $length) ? ' ...' : '');
}

/**
 * 
 * @param type $length
 */
function the_shorter_excerpt($length) {
	echo '<p>' . get_shorter_excerpt($length) . '</p>';
}

/**
 * 
 * @param type $input
 * @param type $length
 * @param type $ellipses
 * @param type $strip_html
 * @return string
 */
function trim_text($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }
  
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
  
    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);
  
    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }
  
    return $trimmed_text;
}

function current_url() {
    // Protocol
    $url = ( 'on' == $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
    $url .= $_SERVER['SERVER_NAME'];

    // Port
    $url .= ( '80' == $_SERVER['SERVER_PORT'] ) ? '' : ':' . $_SERVER['SERVER_PORT'];
    $url .= $_SERVER['REQUEST_URI'];
    return trailingslashit( $url );
}

/**
 * 
 * @param type $stringtotrim
 * @param type $charlength
 * @param type $trailtext
 * @return string
 */
function limit_characters($stringtotrim, $charlength, $trailtext) {
	$excerpt = $stringtotrim;
	$the_str = substr($excerpt, 0, $charlength) . $trailtext;
	return $the_str;
}

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
