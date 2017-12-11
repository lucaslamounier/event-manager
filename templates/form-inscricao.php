 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

 <div class="container-fluid">
    <section id="chlg-envia-form-app-legislative" style="margin-top: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div id="ajax-response" style="background-color:#E6E6FA ;color:blue;"> </div>
                    
                    <div class="alert alert-danger" id="erro" style="display: none;">
						<strong>Erro !</strong> Não foi possível realizar a inscrição do participante, por favor tente mais tarde ou entre em <a href="https://viaviva2017.com.br/contato"> contato conosco </a> !
                    </div>

                    <div class="alert alert-info" id="exists" style="display: none;">
                        <strong>Atenção ! Participante já inscrito no evento.</strong>
                    </div>
					
					<div class="alert alert-info" id="existsCpf" style="display: none;">
                        <strong>Atenção ! Já existe um participante cadastrado com este CPF.</strong>
                    </div>

                    <div class="alert alert-success" id="sucess" style="display: none;">
                        <!-- <strong>Participante inscrito com sucesso !</strong> -->
						<h3>Obrigado por se inscrever no <br /> Via Viva - I Seminário Socioambiental em <br /> Infraestrutura de Transportes</h3>
						<h4>Você receberá um email de confirmação !</h4>
                    </div>

                    <div class="alert alert-success" id="msg-recaptcha" style="display: none;">
                        <strong>Marque a caixa de resposta e tente novamente !</strong>
                    </div>

                    <div id="img-load" style="display: none; text-align:center;">
						<h1><strong> Por Favor, Aguarde... </strong></h1>
                        <span id="image-load"></span>
                    </div> 


                    <form class="formulario" id="ajaxcontactform" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="action" value="form_inscr">
                            <label for="username" class="custom-label-form">Nome completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" size="40" style="border: 1px solid #ccc !important;" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="custom-label-form">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" size="40" style="border: 1px solid #ccc !important;" required>
                        </div>
                        <div class="form-group chlg-resize-form">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <label for="cpf" class="custom-label-form">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" onkeypress="formatar('###.###.###-##', this);" placeholder="somente números" style="border: 1px solid #ccc !important;" required>
                                           </div>
                                           <div class="col-md-6 col-xs-12 ">
                                               <label for="telefone" class="custom-label-form">Telefone</label>
                                               <input type="text" class="form-control" id="telefone" name="telefone" maxlength="15"
                                               >
                                           </div>
                                       </div>
                                   </div>
                    
                                   <div class="form-group chlg-resize-form">
                                       <div class="row">
                                           <div class="col-md-6 col-xs-12">
                                            <label for="empresa " class="custom-label-form">Empresa</label>
                                    <input type="text" class="form-control" id="empresa" name="empresa" size="100" required>
                                           </div>
                                           <div class="col-md-6 col-xs-12">
                                               <label for="cargo" class="custom-label-form">Cargo</label>
                                    <input type="text" class="form-control" id="cargo" name="cargo" size="100" required>
                                           </div>

                                       </div>
                                   </div>
                                  <div class="form-group ">
                                      <p class="custom-label-form " id="submissao-label">
                                           Tem interesse em realizar submissão de trabalho ?
                                       </p>

                                        <label class="radio-inline">
                                        <input class="chlg-radio-btn" type="radio" id="yesArtigo" name="AnwaserEnviarArtigo" value="1"/> <span class="chlg-sel-trabalho">Sim</span>
                                       </label>
                                        <label class="radio-inline">
                                           <input class="chlg-radio-btn" type="radio" id="noArtigo" name="AnwaserEnviarArtigo" value="0" checked/> <span class="chlg-sel-trabalho">Não</span>
                                        </label>                                     
                                   </div>
                                    <div class="form-group " id="div-artigo-label" style="display:none;">
                                       <p class="chlg-desc-section">
                                           <strong class="text-success" style="color:#ff621a; font-size: 17px;"> ARTIGO </strong> - Você também poderá enviar o artigo após a inscrição.
                                       </p>
                                   </div>
                                   <div class="form-group" id="div-artigo-file" style="display:none; ">
                                       <div class="row">
                                           <div class="col-xs-6">
                                               <p class="chlg-mg-text" id="artigo-label"> Tipos de arquivos permitidos (.doc, .docx ou .pdf). </p>
                                               <label for="file-artigo" class="sr-only ">Artigo</label>
                                               <input class="chlg-input-extra" type="file" id="file-artigo" name="file-artigo" />
                                           </div>
                                           <div class="col-xs-6 "></div>
                                       </div>
                                   </div>

                                    <div class="g-recaptcha" data-sitekey="6LeV3DkUAAAAAEloIT8Am_7u_DlH9vx7ZjptE8wt"></div>
                                    <button type="submit" style="margin-top: 30px; color: white;font-weight: bold;" name="cf-submitted " class="btn btn_3">Realizar Inscrição</button>

                                  
                     </form>
                   </div>
               </div>
           </div>
       </section>
   </div>

   <script>
      function formatar(mascara, documento) {
        var i = documento.value.length;
        var saida = mascara.substring(0, 1);
        var texto = mascara.substring(i)

        if (texto.substring(0, 1) != saida) {
            documento.value += texto.substring(0, 1);
        }
    };

   </script>