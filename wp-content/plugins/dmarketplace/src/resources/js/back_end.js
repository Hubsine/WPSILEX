jQuery(document).ready(function($) {
        
    $('#dm-test-mailer-transport-button').click(function(event){

        event.preventDefault();
        
        $('#dm-test-mailer-transport-response').removeClass().html('');
        var dmData = {
            action: 'dm_test_mailer_transport',
            dmMailerData: {
                from_email: $('#dm-mailer-from-email')      .val(),
                from_name:  $('#dm-mailer-from-name')       .val(),
                transport:  $('#dm-mailer-transport-select').val(),
                smtp:       $('#dm-smtp-smtp')              .val(),
                security:   $('#dm-smtp-security-select')   .val(),
                port:       $('#dm-smtp-port')              .val(),
                username:   $('#dm-smtp-username')          .val(),
                password:   $('#dm-smtp-password')          .val(),
                command:    $('#dm-sendmail-command')       .val(),
                to: $('#dm-test-mailer-transport-email').val()
            }
        };
        
        console.log(dmData);
        
        $.post({
            url: ajaxurl,
            //dataType: 'json',
            data: dmData,
            success: function(data, textStatus, jqXHR){
                
                if(data.success){
                    $('#dm-test-mailer-transport-response').addClass('notice notice-success').html(data.data.message).show();
                }else{
                    $('#dm-test-mailer-transport-response').addClass('notice notice-error').html(data.data.message).show();
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown){
                
                $('#dm-test-mailer-transport-response').addClass('notice notice-error').html(
                        errorThrown + "'<br'>" +
                        jqXHR.responseText
                        ).show();
            }
        });

    });
    
});