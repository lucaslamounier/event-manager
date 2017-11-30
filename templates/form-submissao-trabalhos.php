<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

 <!--
 <div class="container-fluid">
 <div class="container">
<div class="panel">

    <div class="col-md-12">
        <div class="row">
            <h2 class="panel-title">Dados do trabalho</h2>

            <span class="well-title">Período de submissão</span>
            <div class="well">
                30/09/2017 até 24/11/2017 </div>
        </div>
    </div>

    <div class="col-md-12">
    	  <div class="panel-group">
		    <div class="panel panel-default">
		      <div class="panel-heading">
		        <h4 class="panel-title">
		          <a data-toggle="collapse" href="#collapse1"><span class="well-title">Informações</span></a>
		        </h4>
		      </div>
		      <div id="collapse1" class="panel-collapse collapse">
		        <div class="panel-body">
					<?php 
				$url_arquivo = ACFSURL.'/files/Diretrizes-Submissao-de-Trabalhos-Via-Viva.pdf#zoom=130';
			 		?>

			 		<iframe id="fred" style="border:1px solid #666CCC" title="PDF in an i-Frame" 
            	src="<?php echo $url_arquivo ?>" frameborder="0" scrolling="auto" height="1100" width="100%" ></iframe>

		        </div>
		       
		      </div>
		    </div>
		  </div>
    </div>
	 <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse2">Envio de Trabalhos</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
</div>
</div>
</div> -->

 <div class="container" style="width: 80% ;background-color: #dadada; padding: 50px 50px 50px 50px;">
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle custom-btn-circle">1</a>
            <p>DADOS DE CADASTRO</p>

        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle custom-btn-circle" disabled="disabled">2</a>
            <p>REGRAS GERAIS</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle custom-btn-circle" disabled="disabled">3</a>
            <p>ENVIO DE TRABALHO</p>
        </div>
    </div>
</div>
<!-- <form role="form">-->
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3>DADOS DE CADASTRO</h3>
                <p><strong>Atenção:</strong> Para realizar o envio de trabalhos é necessário que o participante esteja inscrito no evento. <br />Para se inscrever <a href="/inscricao">clique aqui.</a></p>
                <form id="checkParticipante" action="" method="post">
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input type="hidden" name="action" value="check_participante">
                        <input  maxlength="30" type="text" name="email" id="email" required="required" class="form-control" placeholder="seu-email@provedor.com"  />
                    </div>
                    <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input maxlength="15" type="text" name="cpf" id="cpf" required="required" class="form-control" placeholder="Informe somente números" />
                    </div>
                    <button class="btn btn-primary btn-lg nextBtn pull-right" style="font-size: 15px;" type="submit" id="initial">Próximo</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Diretriz para envio de trabalhos</h3>
                <div class="form-group">
                    <label class="control-label">Company Name</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Company Address</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address"  />
                </div>
                <button style="font-size: 15px;" class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Próximo</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Envio de Trabalhos</h3>
                <button class="btn btn-success btn-lg pull-right" type="submit">Concluir</button>
            </div>
        </div>
    </div>
<!-- </form> -->
</div>
<script>

</script>