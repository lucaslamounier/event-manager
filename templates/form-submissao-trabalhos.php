<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
                <h2>DADOS DE CADASTRO</h2>
                <p><strong>Atenção:</strong> Para submeter um trabalho, o proponente deve estar inscrito no evento <strong>VIA VIVA</strong> e observar as diretrizes especificadas em REGRAS GERAIS.</p>
                
                <!-- Mensagens de alerta -->
                
                 <div class="alert alert-info alert-dismissable" style="display: none;" id="msg-email-incorrect">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    E-mail ou CPF do proponente inscrito no evento, não conferem.
                    <p>Qualquer dúvida entre em <a href="/contato">contato conosco.</a></p>
                </div>

                <div class="alert alert-danger alert-dismissable" style="display: none;" id="msg-nao-cadastrado">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        Proponente não inscrito no evento.
                       <a href="/inscricao"> Clique aqui </a> e faça sua inscrição !
                </div>

                  <div class="alert alert-danger alert-dismissable" style="display: none;" id="msg-erro">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                   Ocorreu um erro ao realizar sua solicitação
                    <p>Tente mais tarde ou entre em <a href="/contato">contato conosco.</a></p>
                </div>


                <!-- Fim mensagem de alerta -->
                
                <form id="checkParticipante" action="" method="POST">
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input type="hidden" name="action" value="check_participante">
                        <input  maxlength="30" type="text" name="email" id="email" required="required" class="form-control" placeholder="seu-email@provedor.com"  />
                    </div>
                    <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input maxlength="15" type="text" name="cpf" id="cpf" required="required" class="form-control" placeholder="Informe somente números" />
                    </div>
                    <button class="btn btn-primary btn-lg pull-right btn-check" style="font-size: 15px;" type="submit">Próximo</button>
                </form>
            </div>
        </div>
    </div>

    <form id="sendTrabalho" action="" method="POST" enctype="multipart/form-data">
            
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h2> REGRAS GERAIS </h2>
                 <input type="hidden" name="action" value="send_trabalho">
                <div class="form-group">
                    <label class="well-title control-label">
                    Período de Submissão de trabalho</label>
                    <div class="well">Até 26/01/2018 às 22:00 horas, 
                    horário de Brasília-DF</div>
                </div>
                <div class="form-group">
                    <label class="well-title control-label">
                    Diretrizes para submissão de trabalhos</label>
                    <div class="well">
                        <?php 
                            $url_arquivo = ACFSURL.'/files/Diretrizes-Submissao-de-Trabalhos-Via-Viva.pdf';
                        ?>
                        <a href="<?php echo $url_arquivo ?>" download>
                            <span class="dashicons dashicons-download"></span> 
                            Clique aqui para realizar o download das diretrizes para submissão de trabalhos.
                        </a>
                    </div>
                    <p>Será enviado uma cópia ao e-mail cadastrado das diretrizes para submissão de trabalhos.</p>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" value="" name="accept-terms"
                        id="accept-terms">
                    Marcando esta opção você concorda com as diretrizes para a submissão de trabalhos</label>
                    </div>
                </div>
                <button style="font-size: 15px;" class="btn btn-primary nextBtn btn-lg pull-right " type="button" id="btn-step2" disabled>Próximo</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h2> Envio de Trabalhos</h2>
                <div class="form-group">
                     <select id="tipoTrabalho" name="tipoTrabalho" class="form-control" required>
                        <option selected>Selecione o tipo do trabalho</option>
                        <option value="artigos_tecnico_cientificos">Artigos técnico-científicos</option>
                        <option value="relatos_tecnicos">Relatos técnicos</option>
                        <option value="estudo_de_caso">Estudos de caso</option>
                      </select>
                </div>
                <div class="form-group">
                    <label for="file-artigo" class="sr-only ">Trabalho</label>
                    <input class="chlg-input-extra" type="file" id="artigo" name="artigo" required>
                    <p class="chlg-mg-text" id="artigo-label"> 
                        Tipos de arquivos permitidos (.doc, .docx ou .pdf) 
                    </p>
                </div>
            <!-- Google recaptcha -->
            <div class="g-recaptcha" data-sitekey="6LeV3DkUAAAAAEloIT8Am_7u_DlH9vx7ZjptE8wt"></div>   
            <button class="btn btn-success btn-lg pull-right" type="submit">Enviar</button>
            </div>
        </div>
    </div>
     </form>
<!-- </form> -->
</div>
<script>

</script>