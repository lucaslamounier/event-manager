  jQuery(document).ready(function() {
 	
	jQuery("#ajaxpalestrantform").on('submit',function(e){
		e.preventDefault();

		jQuery("#ajaxpalestrantform").hide();
		jQuery("#img-load").show();
		jQuery('.nav-tabs a[href="#menu1"]').tab('show');
		
		jQuery.ajax({
	        type: "POST",
	        url: ajax_object.ajax_url,
	        data: jQuery(this).serialize(),
		    success: function(data, textStatus, XMLHttpRequest) {
		    	
		    	jQuery('.nav-tabs a[href="#menu1"]').tab('show');

		    	if(data === "1"){
		    		jQuery("#sucess").show();
					jQuery("#img-load").hide(); 
		    	}else if(data === "2"){
		    		jQuery("#exists").show();
					jQuery("#img-load").hide();
		    	}else if(data === "0"){
		    		jQuery("#erro").show();
					jQuery("#img-load").hide();
		    	}else if(data === "3"){
					jQuery("#img-load").hide();
		    	}
		    },
	        error: function(MLHttpRequest, textStatus, errorThrown) {
	            jQuery("#erro").show();
				jQuery("#img-load").hide();
				jQuery('.nav-tabs a[href="#menu1"]').tab('show');
	        }
    	});

	});




});

 