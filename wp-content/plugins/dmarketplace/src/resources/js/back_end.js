jQuery(document).ready(function($) {
   
    console.log('front_end_js');

    $('#dm-test-mailer-transport-button').click(function(event){

        event.preventDefault();
        
//        var data = {
//			action: 'dm_test_mailer_transport',
//                        dm_dest_email: $('#dm-test-mailer-transport-email').val()
//		};
//
//		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
//		jQuery.post(ajaxurl, data, function(response) {
//			alert('Got this from the server: ' + response);
//		});
                
        $.post({
            url: ajaxurl,
            dataType: 'json',
            data: {
                action: 'dm_test_mailer_transport',
                dm_dest_email: $('#dm-test-mailer-transport-email').val()
            },
            success: function(data, textStatus, jqXHR){
                console.log('success');
                console.log(data);
                $('#dm-test-mailer-transport-response').addClass('notice notice-success').toggle();
            },
            error: function(data){
                console.log('error');
                console.log(data);
                $('#dm-test-mailer-transport-response').addClass('notice notice-error').toggle();
            }
        });

    });
    
});