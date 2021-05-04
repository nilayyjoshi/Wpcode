
add_action( 'admin_footer', 'my_action_javascript' ); // Write our JS below here

function my_action_javascript() { 

global $my_admin_page, $woocommerce, $product, $post;

    $screen = get_current_screen();

    if ( is_admin() && ($screen->post_type == 'product') ) 
	{
        global $post;
       
	    $product_id = $_GET['post'];
		
		//var_dump($product_id);
		
		$product = wc_get_product($product_id);
		
		//echo '<pre>'; print_r($product); echo '</pre>';
		
		$variations = $product->get_available_variations();
		
		$variations_id = wp_list_pluck( $variations, 'variation_id' );
		
		//echo '<pre>'; print_r($variations_id); echo '</pre>';
		
		//echo 'pet';
        
		$variations_id_arry_count = count($variations_id);
		
		for($i=0; $i<$variations_id_arry_count; $i++)
		{
			
			$loop_id = $i;

?>
	<script type="text/javascript" >
		jQuery(document).ready(function($) {
			
				
			jQuery( ".save-variation-changes" ).on( "click", function() 
			{
				//console.log("This input field has 3 "); return false;
			});
				
				
			jQuery(document).on('keyup', '#variable_regular_price_<?php echo $loop_id;?>' , function(){
				
			  console.log("This input field has lost its focusss _<?php echo $loop_id;?>"); return false;
	
			  var data = {
					'action': 'my_action',
					'whatever': 1234
				};

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) 
				{
					console.log('Got this from the server: ' + response);
				});
			});
		});
	</script> 
<?php
		}

    }

}