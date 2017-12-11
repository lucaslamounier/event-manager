function sendChecking(id, nome, email, cpf) {

	// Oculta o botão de check-in
	var id_button = 'button_' + id;
	jQuery("#"+id_button).hide();

	// Apresenta o gif de load
	var id_load_image = 'load_' + id;
	jQuery("#"+id_load_image).show();

	var id_check_image_ok = 'checked_'+ id;
	var id_checked_fail = 'checked_fail_'+ id;

    
    jQuery.ajax({

        type: 'POST',
        url: chekinJS.ajaxurl,
        data: {

            action: 'checking',
            nome: nome,
            id: id,
            email: email,
            cpf: cpf
        },

        success: function(data, textStatus, XMLHttpRequest) {
        	if(data == 1){

        		jQuery("#"+id_button).hide();
        		jQuery("#"+id_load_image).hide();
        		jQuery("#"+id_check_image_ok).show();
        		jQuery("#"+id_checked_fail).hide();
        	
        	}else{
        		jQuery("#"+id_button).hide();
        		jQuery("#"+id_load_image).hide();
        		jQuery("#"+id_check_image_ok).hide();
        		jQuery("#"+id_checked_fail).show();
        	}
        },

        error: function(MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
 }