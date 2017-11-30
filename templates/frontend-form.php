
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- Início do formulário -->

 <div class="container-fluid chlg-bg-envia-form-app-legislative">
       <section id="chlg-envia-form-app-legislative">
           <div class="container">
               <div class="row">
                   <div class="col-md-10 col-md-offset-1">
                       <h1 style="text-align: center;">INSCRIÇÃO</h1>
                   </div>
               </div>
               <div class="row">
                   <hr>
               </div>
               <div class="row">
                   <div class="col-md-8 col-md-offset-2">
                       <form class="chlg-send-app-pf" action="/forms/app-legislativo/envia-form-pf" method="post" enctype="multipart/form-data">
                           <div class="form-group">
                               <label for="username">Nome completo</label>
                               <input type="text" class="form-control" id="username" name="nome">
                           </div>
                           <div class="form-group">
                               <label for="email">E-mail</label>
                               <input type="email" class="form-control" id="email" name="email">
                           </div>
                           <div class="form-group chlg-resize-form">
                               <div class="row">
                                   <div class="col-md-6 col-xs-12">
                                     <label for="cpf">CPF</label>
                               <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" onkeypress="formatar('###.###.###-##', this);">
                                   </div>
                                   <div class="col-md-6 col-xs-12">
                                       <label for="telefone">Telefone</label>
                                       <input type="text" class="form-control" id="telefone" name="telefone" maxlength="11">
                                   </div>
                               </div>
                           </div>
                           <div class="form-group">
                               <label for="empresa">Empresa</label>
                               <input type="text" class="form-control" id="empresa" name="empresa">
                           </div>
                           <div class="form-group chlg-resize-form">
                               <div class="row">
                                   <div class="col-md-6 col-xs-12">
                                       <label for="cargo">Cargo</label>
                                       <input type="text" class="form-control" id="cargo" name="cargo">
                                   </div>
                               </div>
                           </div>
                           <div class="form-group">
                               <p class="chlg-desc-section">
                                   <strong class="text-success">ARTIGO</strong> - Você também poderá enviar o artigo após a inscrição.
                               </p>
                           </div>
                           <div class="form-group">
                           		<p class="chlg-mg-text" id="submissao-label">
                                   Deseja fazer a submissão de artigo cientifico ?
                               </p>
                               <label class="radio-inline">
                                   <input class="chlg-radio-btn" type="radio" name="numTrabalho" value="1"/> <span class="chlg-sel-trabalho">Sim</span>
                               </label>
                                <label class="radio-inline">
                                   <input class="chlg-radio-btn" type="radio" name="numTrabalho" value="2" checked/> <span class="chlg-sel-trabalho">Não</span>
                                </label>
                           </div>
                           <div class="form-group">
                               <p class="chlg-mg-text" id="artigo-label">
                                   Arquivo (.doc, .docx ou .pdf) contendo o artigo a ser apresentado.
                               </p>
                           </div>
                           <div class="form-group">
                               <div class="row">
                                   <div class="col-xs-6">
                                       <label for="file-artigo" class="sr-only">Artigo</label>
                                       <input class="chlg-input-extra" type="file" id="file-artigo" 
                                       name="arquivo">
                                   </div>
                                   <div class="col-xs-6"></div>
                               </div>
                           </div>
                           <hr>
                           <button type="submit" class="btn btn-warning btn-lg">Enviar</button>
                       </form>
                   </div>
               </div>
           </div>
       </section>
   </div>
<!-- Fim do formulário -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
	// Função para formatar CPF
function formatar(mascara, documento) {
				var i = documento.value.length;
				var saida = mascara.substring(0, 1);
				var texto = mascara.substring(i)

				if (texto.substring(0, 1) != saida) {
						documento.value += texto.substring(0, 1);
				}
};


</script>