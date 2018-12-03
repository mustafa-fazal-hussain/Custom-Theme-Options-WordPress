(function($) {
	$(document).ready(function() {

		function generator_add_file(event, selector) {
		
			var upload = $(".uploaded-file"), frame;
			var $el = $(this);

			event.preventDefault();

			// If the media frame already exists, reopen it.
			if ( frame ) {
				frame.open();
				return;
			}

			// Create the media frame.
			frame = wp.media({
				// Set the title of the modal.
				title: $el.data('choose'),

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: $el.data('update'),
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			frame.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = frame.state().get('selection').first();
				frame.close();
				selector.find('.upload').val(attachment.attributes.url);
				if ( attachment.attributes.type == 'image' ) {
					selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '"><a class="remove-image">Remove</a>').slideDown('fast');
				}
				selector.find('.upload-button').unbind().addClass('remove-file').removeClass('upload-button');
				selector.find('.of-background-properties').slideDown();
				selector.find('.remove-image, .remove-file').on('click', function() {
					generator_remove_file( $(this).parents('.section') );
				});
			});

			// Finally, open the modal.
			frame.open();
		}
        
		function generator_remove_file(selector) {
			selector.find('.remove-image').hide();
			selector.find('.upload').val('');
			selector.find('.of-background-properties').hide();
			selector.find('.screenshot').slideUp();
			selector.find('.remove-file').unbind().addClass('upload-button').removeClass('remove-file');
			// We don't display the upload button if .upload-notice is present
			// This means the user doesn't have the WordPress 3.5 Media Library Support
			if ( $('.section-upload .upload-notice').length > 0 ) {
				$('.upload-button').remove();
			}
			selector.find('.upload-button').live('click', function() {
				generator_add_file(event, $(this).parents('.section'));
			});
		}
		
		$('.remove-image, .remove-file').live('click', function() {
			generator_remove_file( $(this).parents('.section') );
        });
        
        $('.upload-button').live('click', function( event ) {
        	generator_add_file(event, $(this).parents('.section'));
        });
        
    });
	
})(jQuery);

jQuery(document).ready( function(){
 function media_upload( button_class) {
    var _custom_media = true,
    _orig_send_attachment = wp.media.editor.send.attachment;
    jQuery('body').on('click',button_class, function(e) {
        var button_id ='#'+jQuery(this).attr('id');
        /* console.log(button_id); */
        var self = jQuery(button_id);
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(button_id);
        var id = button.attr('id').replace('_button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media  ) { 
               jQuery('.generator_media_url').val(attachment.url);
            } else {
                return _orig_send_attachment.apply( button_id, [props, attachment] );
            }
        }
        wp.media.editor.open(button);
        return false;
    });
}
media_upload( '.generator_media_upload');
});


 var fnames = new Array();var ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[0]='EMAIL';ftypes[0]='email';
            try {
                var jqueryLoaded=jQuery;
                jqueryLoaded=true;
            } catch(err) {
                var jqueryLoaded=false;
            }
            var head= document.getElementsByTagName('head')[0];
            if (!jqueryLoaded) {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = '//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
                head.appendChild(script);
                if (script.readyState && script.onload!==null){
                    script.onreadystatechange= function () {
                          if (this.readyState == 'complete') mce_preload_check();
                    }    
                }
            }
            
            var err_style = '';
            try{
                err_style = mc_custom_error_style;
            } catch(e){
                err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
            }
            var head= document.getElementsByTagName('head')[0];
            var style= document.createElement('style');
            style.type= 'text/css';
            if (style.styleSheet) {
              style.styleSheet.cssText = err_style;
            } else {
              style.appendChild(document.createTextNode(err_style));
            }
            head.appendChild(style);
            setTimeout('mce_preload_check();', 250);
            
            var mce_preload_checks = 0;
            function mce_preload_check(){
                if (mce_preload_checks>40) return;
                mce_preload_checks++;
                try {
                    var jqueryLoaded=jQuery;
                } catch(err) {
                    setTimeout('mce_preload_check();', 250);
                    return;
                }
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
                head.appendChild(script);
                try {
                    var validatorLoaded=jQuery("#fake-form").validate({});
                } catch(err) {
                    setTimeout('mce_preload_check();', 250);
                    return;
                }
                mce_init_form();
            }
            function mce_init_form(){
                jQuery(document).ready( function() {
                  var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
                  var mce_validator = jQuery("#mc-embedded-subscribe-form").validate(options);
                  jQuery("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
                  options = { url: 'http://ommune.us2.list-manage1.com/subscribe/post-json?u=9c754572be34858540694990b&id=4ae2e7fd84&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
                                beforeSubmit: function(){
                                    jQuery('#mce_tmp_error_msg').remove();
                                    jQuery('.datefield','#mc_embed_signup').each(
                                        function(){
                                            var txt = 'filled';
                                            var fields = new Array();
                                            var i = 0;
                                            jQuery(':text', this).each(
                                                function(){
                                                    fields[i] = this;
                                                    i++;
                                                });
                                            jQuery(':hidden', this).each(
                                                function(){
                                                    var bday = false;
                                                    if (fields.length == 2){
                                                        bday = true;
                                                        fields[2] = {'value':1970};//trick birthdays into having years
                                                    }
                                                    if ( fields[0].value=='MM' && fields[1].value=='DD' && (fields[2].value=='YYYY' || (bday && fields[2].value==1970) ) ){
                                                        this.value = '';
                                                    } else if ( fields[0].value=='' && fields[1].value=='' && (fields[2].value=='' || (bday && fields[2].value==1970) ) ){
                                                        this.value = '';
                                                    } else {
                                                        if (/\[day\]/.test(fields[0].name)){
                                                            this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;									        
                                                        } else {
                                                            this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
                                                        }
                                                    }
                                                });
                                        });
                                    jQuery('.phonefield-us','#mc_embed_signup').each(
                                        function(){
                                            var fields = new Array();
                                            var i = 0;
                                            jQuery(':text', this).each(
                                                function(){
                                                    fields[i] = this;
                                                    i++;
                                                });
                                            jQuery(':hidden', this).each(
                                                function(){
                                                    if ( fields[0].value.length != 3 || fields[1].value.length!=3 || fields[2].value.length!=4 ){
                                                        this.value = '';
                                                    } else {
                                                        this.value = 'filled';
                                                    }
                                                });
                                        });
                                    return mce_validator.form();
                                }, 
                                success: mce_success_cb
                            };
                  jQuery('#mc-embedded-subscribe-form').ajaxForm(options);
                  
                  
                });
            }
            function mce_success_cb(resp){
                jQuery('#mce-success-response').hide();
                jQuery('#mce-error-response').hide();
                if (resp.result=="success"){
                    jQuery('#mce-'+resp.result+'-response').show();
                    jQuery('#mce-'+resp.result+'-response').html(resp.msg);
                    jQuery('#mc-embedded-subscribe-form').each(function(){
                        this.reset();
                    });
                } else {
                    var index = -1;
                    var msg;
                    try {
                        var parts = resp.msg.split(' - ',2);
                        if (parts[1]==undefined){
                            msg = resp.msg;
                        } else {
                            i = parseInt(parts[0]);
                            if (i.toString() == parts[0]){
                                index = parts[0];
                                msg = parts[1];
                            } else {
                                index = -1;
                                msg = resp.msg;
                            }
                        }
                    } catch(e){
                        index = -1;
                        msg = resp.msg;
                    }
                    try{
                        if (index== -1){
                            jQuery('#mce-'+resp.result+'-response').show();
                            jQuery('#mce-'+resp.result+'-response').html(msg);            
                        } else {
                            err_id = 'mce_tmp_error_msg';
                            html = '<div id="'+err_id+'" style="'+err_style+'"> '+msg+'</div>';
                            
                            var input_id = '#mc_embed_signup';
                            var f = jQuery(input_id);
                            if (ftypes[index]=='address'){
                                input_id = '#mce-'+fnames[index]+'-addr1';
                                f = jQuery(input_id).parent().parent().get(0);
                            } else if (ftypes[index]=='date'){
                                input_id = '#mce-'+fnames[index]+'-month';
                                f = jQuery(input_id).parent().parent().get(0);
                            } else {
                                input_id = '#mce-'+fnames[index];
                                f = jQuery().parent(input_id).get(0);
                            }
                            if (f){
                                jQuery(f).append(html);
                                jQuery(input_id).focus();
                            } else {
                                jQuery('#mce-'+resp.result+'-response').show();
                                jQuery('#mce-'+resp.result+'-response').html(msg);
                            }
                        }
                    } catch(e){
                        jQuery('#mce-'+resp.result+'-response').show();
                        jQuery('#mce-'+resp.result+'-response').html(msg);
                    }
                }
            }