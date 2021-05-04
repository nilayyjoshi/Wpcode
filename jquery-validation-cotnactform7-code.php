<?php
function contact_function() {
?>	
	
		
	<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
	<script>
		jQuery( document ).ready(function() 
		{
			
				jQuery( "#mysubmit" ).on( "click", function() 
				{
					var myforms = $("#contact-form-1511").valid();
					
					//alert(myforms);
					
					if(myforms==true)
					{
						return true;
					}
					else
					{
						return false;
					}

				});

	
				// validate signup form on keyup and submit
					jQuery("#contact-form-1511").validate({
						rules: {
							yourname: "required",
							youremail: {
								required: true,
								minlength: 2
							},
							yoursubject: "required"
						},
						messages: {
							yourname: "Please enter your firstname",
							youremail: "Please enter a valid email address",
							yoursubject: "Please accept our topics",

						}
					});
					
		});
	</script>
    
<?php
}
add_action( 'wp_head', 'contact_function' );