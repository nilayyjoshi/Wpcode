<?php
/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 * Remove first image if it is same as blog post content first image.php
*/

add_action( 'wp_head', 'catch_content_first_image');
function catch_content_first_image() 
{
	  global $post, $posts;
	  $first_img = '';
	  ob_start();
	  ob_end_clean();
	  
	  $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
	  
	  $first_img = $matches[1][0];

	  if(empty($first_img)) 
	  {
		$first_img = "/path/to/default.png";
	  }
	  
	  return $first_img;
}

function filter_same_image() 
{
    //var_dump(is_single());
	
	$catch_content_first_image_src = false;
	
	if ( is_single() && 'post' == get_post_type() ) 
	{
	
		$post_id = get_the_ID();
		
		$post_thumbnail_url = get_the_post_thumbnail_url($post_id,'full');
		
		$post_thumbnail_url_part   = explode('/', $post_thumbnail_url);
		
		$post_thumbnail_url_part_img = end($post_thumbnail_url_part);
		
		$post_thumbnail_url_part_img_dot   = explode('.', $post_thumbnail_url_part_img);
			
		 $post_thumbnail_url_part_img = $post_thumbnail_url_part_img_dot[0];
		
		//echo  '<br>';
		
		$catch_content_first_image =  catch_content_first_image();
		
		//echo  '<br>';
		
		$catch_that_image_part   = explode('/', $catch_content_first_image);
		
		 $catch_that_image_part_img = end($catch_that_image_part);
		
		if (stripos($catch_that_image_part_img, $post_thumbnail_url_part_img) !== false) 
		{		
			//echo 'yes';
			
			return $catch_content_first_image;
		}
			
	}
	
	return $catch_content_first_image;
}

//----------

add_filter( 'the_content', 'filter_the_content_in_the_main_loop', 1 );
 
function filter_the_content_in_the_main_loop( $content ) {
 
    // Check if we're inside the main loop in a single Post.
    if ( is_singular() && in_the_loop() && is_main_query() ) 
	{
	   $filter_same_image =  filter_same_image(); //exit;
		
	   $content =  str_replace($filter_same_image, '', $content);
	   
	   $content_new = preg_replace( '!(<a([^>]+)>)?<img(.*?)src=""([^>]+)>(</a>)?!si' , '' , $content );
    }
 
    return $content_new;
}


//-------------