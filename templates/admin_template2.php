  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="container">
  <h2>Gerenciamento do Evento</h2>
  <p>Painel de controle do evento, no qual é apresentado os inscritos no evento, bem como a possibilidade
  de inscrição do palestrante.</p>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Inscritos no evento</a></li>
    <li><a data-toggle="tab" href="#menu1">Cadastrar Palestrante</a></li>
    <li><a data-toggle="tab" href="#menu2">Trabalhos Enviados</a></li>
    <li><a data-toggle="tab" href="#menu3">Check-in</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <?php 

        $dir = plugin_dir_path( __FILE__ );
        load_template($dir.'/admin_inscritos.php');

       ?>
    </div>
    <div id="menu1" class="tab-pane fade">
     <?php 

        $dir = plugin_dir_path( __FILE__ );
        load_template($dir.'/form-inscricao-palestrante.php');

       ?>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Trabalhos enviados</h3>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Check-In</h3>
    </div>
  </div>
</div>