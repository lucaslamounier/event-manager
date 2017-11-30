 <div class="container-fluid" style="margin-top: 30px;">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                  <div id="ajax-response" style="background-color:#E6E6FA ;color:blue;"> </div>
                    
                    <div class="alert alert-danger" id="erro" style="display: none;">
						<strong>Erro !</strong> Não foi possível realizar a inscrição do participante, por favor tente mais tarde ou entre em <a href="https://viaviva2017.com.br/contato"> contato conosco </a> !
                    </div>

                    <div class="alert alert-info" id="exists" style="display: none;">
                        <strong>Atenção ! Participante já inscrito no evento.</strong>
                    </div>

                    <div class="alert alert-success" id="sucess" style="display: none;">
                        <!-- <strong>Participante inscrito com sucesso !</strong> -->
						<h3>Obrigado por se inscrever no <br /> Via Viva - I Seminário Socioambiental em Infraestrutura de Transportes</h3>
                    </div>

                    <div class="alert alert-success" id="msg-recaptcha" style="display: none;">
                        <strong>Marque a caixa de resposta e tente novamente !</strong>
                    </div>

                    <div id="img-load" style="display: none; text-align:center;">
						<h1><strong> Por Favor, Aguarde... </strong></h1>
                        <span id="image-load"></span>
                    </div> 


                    <form class="formulario" id="ajaxpalestrantform" method="post">
                        <div class="form-group">
                            <input type="hidden" name="action" value="form_palestrante">
                            <label for="username" class="custom-label-form">Nome completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" size="40">
                        </div>
                        <div class="form-group">
                            <label for="email" class="custom-label-form">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" size="40">
                        </div>
                        <div class="form-group chlg-resize-form">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <label for="cpf" class="custom-label-form">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" onkeypress="formatar('###.###.###-##', this);" placeholder="somente números" >
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
                                       <input type="text" class="form-control" id="empresa" name="empresa" size="100">
                                           </div>
                                           <div class="col-md-6 col-xs-12">
                                               <label for="cargo" class="custom-label-form">Cargo</label>
                                               <input type="text" class="form-control" id="cargo" name="cargo" size="100">
                                           </div>

                                       </div>
                                   </div>
    
                                    <button type="submit" style="margin-top: 30px; color: white;font-weight: bold;background-color: black;" name="cf-submitted" class="btn btn_3">CADASTRAR</button>

                                  
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