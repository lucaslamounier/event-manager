jQuery(document).ready(function() {


    var navListItems = jQuery('div.setup-panel div a'),
        allWells = jQuery('.setup-content'),
        allNextBtn = jQuery('.nextBtn');

    allWells.hide();

    navListItems.click(function(e) {
        e.preventDefault();
        var target = jQuery(jQuery(this).attr("href")),
            item = jQuery(this);

        if (!item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            item.addClass('btn-primary');
            allWells.hide();
            target.show();
            target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function() {

        var curStep = jQuery(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = jQuery('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        jQuery(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                jQuery(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    jQuery('div.setup-panel div a.btn-primary').trigger('click');

    jQuery("#accept-terms").click(function() {
        var checked_status = this.checked;
        if (checked_status == true) {
            jQuery("#btn-step2").removeAttr("disabled");
        } else {
            jQuery("#btn-step2").attr("disabled", "disabled");
        }
    });

    jQuery("#sendTrabalho").on('submit', function(e) {
        e.preventDefault();
        var cpf = jQuery("#cpf").val();
        var email = jQuery("#email").val();
        var data = new FormData(this);

        data.append("email", email);
        data.append("cpf", cpf);

        jQuery("#formulario-body").hide();
        jQuery("#img-load").show();

        jQuery.ajax({
            type: "POST",
            url: trabalhosJS.ajaxurl,
            contentType: false,
            processData: false,
            enctype: "multipart/form-data",
            data: data,
            success: function(data, textStatus, XMLHttpRequest) {
                if(data == 1){
                    jQuery("#img-load").hide();
                    jQuery("#success").show();   
                }else if(data == 2){
                    jQuery("#img-load").hide();
                    jQuery("#userExists").show();    
                }else if(data == 3){
                    jQuery("#img-load").hide();
                    jQuery("#msg-erro").show();    
                }else if(data == 4){
                    jQuery("#img-load").hide();
                    jQuery("#msg-erro-email").show();
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown) {
                jQuery("#img-load").hide();
                jQuery("#msg-erro").show();
                console.error(errorThrown);   
            }
        });
    });


    jQuery("#checkParticipante").on('submit', function(e) {

        e.preventDefault();
        var data = jQuery(this).serialize();

        jQuery.ajax({
            type: "POST",
            url: trabalhosJS.ajaxurl,
            data: data,
            success: function(data, textStatus, XMLHttpRequest) {
                /*Já inscrito no evento pode ir para o proximo */
                if (data === "1") {

                    var curStep = jQuery(".btn-check").closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = jQuery('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                        curInputs = curStep.find("input[type='text'],input[type='url']"),
                        isValid = true;

                    jQuery(".form-group").removeClass("has-error");
                    for (var i = 0; i < curInputs.length; i++) {
                        if (!curInputs[i].validity.valid) {
                            isValid = false;
                            jQuery(curInputs[i]).closest(".form-group").addClass("has-error");
                        }
                    }

                    if (isValid)
                        nextStepWizard.removeAttr('disabled').trigger('click');

                    /* Participante inscrito com outro email */
                } else if (data === "2") {
                    jQuery("#msg-email-incorrect").show();

                    /* Participante não escrito no evento */
                } else if (data === "0") {
                    jQuery("#msg-nao-cadastrado").show();
                    /* algum erro aconteceu */
                } else {
                    jQuery("#msg-erro").show();
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown) {
                debugger;
                alert("error");
            }
        });
    });

});