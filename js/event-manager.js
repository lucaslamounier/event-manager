  jQuery(document).ready(function() {

	jQuery("#ajaxcontactform").on('submit',function(e){
		
		e.preventDefault();
		var data = new FormData(this);
		jQuery("#ajaxcontactform").hide();
		jQuery("#img-load").show();
		
		jQuery.ajax({
	        type: "POST",
	        url: eventManagerJS.ajaxurl,
	        contentType: false,
        	processData: false,
        	enctype: "multipart/form-data",
	        data: data,
		    success: function(data, textStatus, XMLHttpRequest) {
		    	if(data === "1"){
		    		//jQuery('#ajaxcontactform').resetForm();
		    		jQuery("#sucess").show();
					jQuery("#img-load").hide();
		    		//jQuery("#div-artigo-file").hide();
            		//jQuery("#div-artigo-label").hide();   
		    	}else if(data === "2"){
		    		//jQuery('#ajaxcontactform').resetForm();
		    		jQuery("#exists").show();
					jQuery("#img-load").hide();
		    		//jQuery("#div-artigo-file").hide();
            		//jQuery("#div-artigo-label").hide();   
		    	}else if(data === "0"){
		    		//jQuery('#ajaxcontactform').resetForm();
		    		jQuery("#erro").show();
					jQuery("#img-load").hide();
		    		//jQuery("#div-artigo-file").hide();
            		//jQuery("#div-artigo-label").hide();

		    	}else if(data === "3"){
		    		//jQuery('#ajaxcontactform').resetForm();
		    		jQuery("#msg-recaptcha").show();
					jQuery("#img-load").hide();
		    		//jQuery("#div-artigo-file").hide();
            		//jQuery("#div-artigo-label").hide();
		    	}else if(data === "4"){
					jQuery("#existsCpf").show();
					jQuery("#img-load").hide();
				}
		    },
	        error: function(MLHttpRequest, textStatus, errorThrown) {
	            jQuery("#erro").show();
				jQuery("#img-load").hide();
	        }
    	});

	});

});

 