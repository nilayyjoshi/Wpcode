<?php 
function action_wpcf7_mail_sent1( $contact_form ) {

    $wpcf7      = WPCF7_ContactForm::get_current();
    $submission = WPCF7_Submission::get_instance();
   
   $form_id = $wpcf7->id;
   
   if($form_id=="3785")
   {
        if ($submission) 
		{
            global $wpdb;

            $data = $submission->get_posted_data();   

            $phone = $data['phone'];

            $tablename = $wpdb->prefix . 'cf7_vdata_entry';

            $phone_number = $wpdb->get_row($wpdb->prepare( "SELECT id FROM $tablename WHERE 'name' = 'phone' AND 'value' = '".$phone."'"));

            if(empty($phone_number)){
               
               $url= "api";
             
                $response = wp_remote_post( $url, array(
                    'method'      => 'POST',
                    'timeout'     => 45,
                    'redirection' => 5,
                    'httpversion' => '1.0',
                    'blocking'    => true,
                    'headers'     => array(),
                    'body'        => array(
                        'phone_number' => $data['phone'],
                        'first_name' => $data['your-name'],
                        'last_name' => $data['lastname'],
                        'email' => $data['your-email']
                    ),
                    'cookies'     => array()
                    )
                );
			}
			else
			{
				/*
                add_filter('wpcf7_validate_text', 'my_validate_email', 10, 2);
                add_filter( 'wpcf7_skip_mail', 'mycustom_wpcf7_skip_mail', 10, 2 );
                add_filter( 'wpcf7_display_message', 'filter_wpcf7_display_message', 10, 2 ); 
				*/
			}
        }
		
		return $wpcf7;
		return $contact_form;
   }
   	
	return true;
}; 

add_action( 'wpcf7_posted_data', 'action_wpcf7_mail_sent1', 10, 1 ); 

/*
function mycustom_wpcf7_skip_mail( $skip_mail, $contact_form ) {
    $skip_mail = true;
    return $skip_mail; 
}

function filter_wpcf7_display_message( $message, $status) { 
    $status = "validation_failed";
    $message = "You enter phone number alreday exits";
    return $message; 
}; 

function filter_wpcf7_validation_error( $error, $name, $instance ) { 
    // make filter magic happen here... 
    $error = "Your Enter Phone Number Already Exists";
    return $error; 
}; */
         
// add the filter 
/*add_filter( 'wpcf7_validation_error', 'filter_wpcf7_validation_error', 10, 3 ); 

function my_validate_email($result, $tag) {
    
    $errorMessage = 'You Enter Phone Number alreday exits'; // Change to your error message

            $result->invalidate($tag, $errorMessage);
        
    return $result;
}
*/