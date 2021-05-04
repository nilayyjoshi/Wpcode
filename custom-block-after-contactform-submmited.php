<?php
function bytes_function() {
?>	
	
		
	<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script>
		jQuery( document ).ready(function() 
		{
			//jQuery("#thankudiv").remove();
			//jQuery("#thankudiv").hide();
			
			document.addEventListener( 'wpcf7mailfailed', function( event ) {
				//alert( "Submission successful!" );
				
				jQuery("#wpcf7-f1507-p1508-o1").hide();
				
				jQuery( ".entry-content" ).insertAfter( "#thankudiv" );
	
				jQuery("#thankudiv").show();

				
			}, false );

		});
	</script>
	
	<div id="thankudiv">
	
			<P> Thank you so much for the code </p>
	</div>

    
<?php
}
add_action( 'wp_head', 'bytes_function' );