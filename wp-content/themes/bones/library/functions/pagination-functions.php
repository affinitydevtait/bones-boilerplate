<?php
function pagination($range = 4, $orderby = FALSE){
	// $paged - number of the current page
	global $paged, $wp_query, $posts_per_page;
	
	// How much pages do we have?	
	if ( !$max_page ) {
		$max_page = $wp_query->max_num_pages;
	}

	// How much posts do we have?	
	if ( !$found_posts ) {
		$found_posts = $wp_query->found_posts;
	}

	// We need the pagination only if there are more than 1 page
	//if($max_page > 1){
		
		echo '<div class="paging clearfix">';

		if(!$paged){
			$paged = 1;
		}
		
		$from = ($paged * $posts_per_page) - $posts_per_page + 1;
		$to = ($paged * $posts_per_page);
		
		if ($to > $found_posts) $to = $found_posts;
		
		echo "<ul class='right'>";
                
		echo "<li class=\"none-page\">Page: </li>";
		
		// On the first page, don't put the First page link
//		if($paged != 1){
//			echo "<li class='page-prev'>";
//			previous_posts_link('Prev');
//		}
	
		// To the previous page
		// We need the sliding effect only if there are more pages than is the sliding range
		if($max_page > $range){
			// When closer to the beginning
			if($paged < $range){
				for($i = 1; $i <= ($range + 1); $i++){
					echo "<li";
					
					if($i==$paged) echo " class='selected'";
					
					echo "><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
				}
			}
	
			// When closer to the end
			elseif($paged >= ($max_page - ceil(($range/2)))){
				for($i = $max_page - $range; $i <= $max_page; $i++){
					echo "<li";
					
					if($i==$paged) echo " class='selected'";
					
					echo "><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
				}
			}
			
			// Somewhere in the middle
			elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
					echo "<li";
					
					if($i==$paged) echo " class='selected'";
					
					echo "><a href='" . get_pagenum_link($i) . "'";
					echo ">$i</a></li>";
				}
			}
		}
		
		// Less pages than the range, no sliding effect needed
		else{
			for($i = 1; $i <= $max_page; $i++){
				echo "<li";
				
				if($i==$paged) echo " class='selected'";
				
				echo "><a href='" . get_pagenum_link($i)."'>$i</a></li>";
			}
		}
		
		// Next page
		// On the last page, don't put the Last page link
//		if($paged != $max_page){
//			echo "<li class='page-next'>";	
//				next_posts_link('Next');
//			echo "</li>";
//		}
	
		echo "</ul>";
		echo '<span class="count"><strong>Results:</strong> ' . $found_posts . '</span>';
		if( $orderby ){
			
			$get_query_var = $_GET['listby'];
			
			echo '<span class="listby">
						<strong>List by:</strong> 
						<select id="listby-select" name="listby">
							<option value="all" ' . (($get_query_var == 'all' || $get_query_var == '')?'selected':'') . '>All</option>
							<option value="products" ' . (($get_query_var == 'products')?'selected':'') . '>Products</option>
							<option value="news" ' . (($get_query_var == 'news')?'selected':'') . '>News & Media</option>
							<option value="markets" ' . (($get_query_var == 'markets')?'selected':'') . '>Markets & Services</option>
						</select>
						<input id="listby-search" type="hidden" name="s" value="' . get_search_query() . '" />
				  </span>';

			echo '</div>';
		}
	//}
}
?>
