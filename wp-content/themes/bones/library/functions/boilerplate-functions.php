<?php
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

?>
