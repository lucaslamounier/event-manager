<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>


<div class="container" style="width: 80% ;background-color: #dadada; padding: 50px 50px 50px 50px;">
<div id="messagens">
    <!-- Mensagens de alerta -->

        <div class="alert alert-danger alert-dismissable" style="display: none;" id="msg-erro">
            <h3 style="text-align: center;"> Ocorreu um erro ao realizar sua solicitação </h3>
            <p>Tente mais tarde ou entre em <a href="/contato">contato conosco.</a></p>
        </div>

         <div class="alert alert-info alert-dismissable" style="display: none;" id="msg-erro-email">
         
            <h3 style="text-align: center;"> Trabalho enviado com sucesso !</h3>
            <p>Ocorreu um erro ao enviar email com as diretrizes para o proponente.</p>
        </div>

        <div class="alert alert-success" style="display: none;" id="success">
            <h3 style="text-align: center;">Tabalho enviado com sucesso !
                <br /> Em breve você receberá um email de confirmação com as regras.</h3>
        </div>

        <div style="display: none;" id="userExists">
            <h3 style="text-align: center;"> Proponente já realizou o envio de trabalho. </h3>
        </div>

        <div id="img-load" style="display: none; text-align:center;">
            <h1><strong> Por Favor, Aguarde... </strong></h1>
            <span id="image-load"></span>
        </div>

        <!-- Fim mensagem de alerta -->

    </div>

    <div id="formulario-body">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <p class="panel-subtile">DADOS DE CADASTRO</p>
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle custom-btn-circle">1</a>
                    

                </div>
                <div class="stepwizard-step">
                    <p class="panel-subtile">REGRAS GERAIS</p>
                    <a href="#step-2" type="button" class="btn btn-default btn-circle custom-btn-circle" disabled="disabled">2</a>
                    
                </div>
                <div class="stepwizard-step">
                    <p class="panel-subtile">ENVIO DE TRABALHO</p>
                    <a href="#step-3" type="button" class="btn btn-default btn-circle custom-btn-circle" disabled="disabled">3</a>
                </div>
            </div>
        </div>
        <!-- <form role="form">-->
        <div class="row setup-content" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h2 class="margin-bottom-title">DADOS DE CADASTRO</h2>
                    <p><strong>Atenção:</strong> Para realizar a submissão de trabalho é necessário que o participante esteja inscrito no evento e observe as diretrizes especificadas na aba <strong>REGRAS GERAIS</strong>.</p>
                    <div class="alert alert-danger alert-dismissable" style="display: none;" id="msg-email-incorrect">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> E-mail ou CPF do proponente inscrito no evento não conferem. <br />Verifique se os dados são os mesmos informados no momento da inscrição.
                        <p>Qualquer dúvida entre em <a href="/contato">contato conosco.</a></p>
                    </div>
                    <div class="alert alert-danger alert-dismissable" style="display: none;" id="msg-nao-cadastrado">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> Proponente não inscrito no evento.
                        <a href="/inscricao"> Clique aqui </a> e faça sua inscrição !
                    </div>
                    <form id="checkParticipante" action="" method="POST">
                        <div class="form-group">
                            <label class="control-label">E-mail</label>
                            <input type="hidden" name="action" value="check_participante">
                            <input maxlength="30" type="text" name="email" id="email" required="required" class="form-control" placeholder="seu-email@provedor.com" />
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

        <form id="sendTrabalho" action="" method="POST" enctype="multipart/form-data" 
        role="form" data-toggle="validator">

            <div class="row setup-content" id="step-2">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h2 class="margin-bottom-title"> REGRAS GERAIS </h2>
                        <input type="hidden" name="action" value="send_trabalho">
                        <div class="form-group">
                            <label class="well-title control-label">
                    Período de Submissão de trabalho</label>
                            <div class="well">Até 26/01/2018 às 22:00 horas, horário de Brasília-DF</div>
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
                            Clique aqui para visualizar as diretrizes para submissão de trabalhos.
                        </a>
                            </div>
                            <p style="color:red;">Será enviado uma cópia ao e-mail cadastrado das diretrizes para submissão de trabalhos.</p>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                        <input type="checkbox" value="sim" name="accept-terms"
                        id="accept-terms" required>
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
                        <h2 class="margin-bottom-title"> Envio de Trabalho</h2>
                        <div class="form-group">
                            <label for="tipoTrabalho">Tipo do trabalho</label>
                            <select class="form-control" name="tipoTrabalho" id="tipoTrabalho" required="required">
                                <option value="">Selecione o tipo do trabalho </option>
                                <option value="Artigos técnico-científicos">Artigos técnico-científicos</option>
                                <option value="Estudos de caso">Estudos de caso</option>
                                <option value="Relatos técnicos">Relatos técnicos</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="temaTrabalho">Tema do trabalho</label>
                            <select class="form-control" name="temaTrabalho" id="temaTrabalho" required="required">
                                <option value="">Selecione o tema do trabalho</option>
                                <option value="Planejamento socioambiental em concessões de transportes">Planejamento socioambiental em concessões de transportes</option>
                                <option value="Riscos e custos socioambientais em concessões de transportes">Riscos e custos socioambientais em concessões de transportes</option>
                                <option value="Remoções involuntárias em concessões de transportes">Remoções involuntárias em concessões de transportes</option>
                                 <option value="Receitas acessórias em concessões de transportes">Receitas acessórias em concessões de transportes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="artigo">Trabalho</label>
                            <input class="form-control-file"  type="file" id="artigo" name="artigo" required="required">
                           <span class="chlg-mg-text" id="artigo-label">Tipos de arquivos permitidos (.doc, .docx ou .pdf)</span>
                        </div>
                        <!-- Google recaptcha -->
                        <div class="g-recaptcha" data-sitekey="6LeV3DkUAAAAAEloIT8Am_7u_DlH9vx7ZjptE8wt"></div>
                        <button class="btn btn-success btn-lg pull-right" type="submit">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
        <script>
            $('#sendTrabalho').validator();
        </script>
        <!-- </form> -->
    </div>
</div>
<div class="container-fluid" style="width: 80%; padding: 36px 8px 38px 0px;display: none;">
                           <div class="form-group">
                            <label class="well-title control-label">
                    Diretrizes para submissão de trabalhos</label>
                            <div class="well">
                                <?php 
                            $url_arquivo = ACFSURL.'/files/Diretrizes-Submissao-de-Trabalhos-Via-Viva.pdf';
                        ?>
                                <a href="<?php echo $url_arquivo ?>" download required>
                            <span class="dashicons dashicons-download"></span> 
                            Clique aqui para visualizar as diretrizes para submissão de trabalhos.
                        </a>
                            </div>
                        </div>
</div>
<script>
</script>