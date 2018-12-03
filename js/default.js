jQuery(document).ready(function(e) {
	
	jQuery.noConflict();
	jQuery('.color-field').wpColorPicker();
	jQuery('.save-options').hide();
	jQuery('.remove-image').click(function(e) {
        jQuery('#logo').val('');
    });
	
	jQuery("#form-option").children().each(function(){
		this.value=jQuery(this).val().trim();
	});
	
	function getFormObj(formId) {
		var formObj = {};
		var inputs = jQuery('#'+formId).serializeArray();
		jQuery.each(inputs, function (i, input) {
			if(input.name != 'option_page' && input.name != '_wpnonce' && input.name != 'action' && input.name != '_wp_http_referer')
			{
				formObj[input.name] = input.value;
			}
		});
		return formObj;
	}
	
	jQuery("#ex").click(function (e)
	{
		
		var data = getFormObj('form-option');
		var a = JSON.stringify(data);
		jQuery('.theme-textareaExport').val(a);
		//console.log(data);
		
	});
	

	jQuery("#form-option").submit(function(e)
	{
		jQuery('.themeSpiner').show();
		var postData = jQuery(this).serializeArray();
		var formURL = jQuery(this).attr("action");
		
		jQuery.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			async:false,
			success:function(data, textStatus, jqXHR)
			{
			
			//jQuery('.themeSpiner').hide();
			jQuery('.save-options').fadeIn();
			setTimeout(function () {jQuery('.save-options').fadeOut();jQuery('.themeSpiner').hide();}, 3000);
			//jQuery('.themeSpiner').hide();
		},
		error: function(jqXHR, textStatus, errorThrown)
			{
			//if fails
			}
		});
		
		e.preventDefault(); //STOP default action
	});
		
});	


	
	