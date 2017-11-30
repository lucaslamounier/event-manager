  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div>
  <?php  
  	echo "<h1><center>".__(" Participantes inscritos no VIA VIVA ", TEXT_DOMAIN)."</center> </h1>"; ?>                                                                                     
  <div class="table-responsive" style="margin-top: 50px;">          
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Empresa</th>
        <th>Cargo</th>
        <th>Realizou envio de artigo ?</th>
      </tr>
    </thead>
    <tbody>
      
      <?php 
            global $wpdb;

              $resultados = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}participante_evento order by nome;" );

             if(count($resultados) < 1){

                echo "
                    <tr>
                        <td colspan='8' style='text-align:center;'> <h3> Nenhum participate registrado até o momento. </h3> </td>
                    </tr>
                ";

              }else{
				  $index = 1;
                  foreach($resultados as $key => $res) {
					$row = $index++;
                   /* $has_artigo = ($res->possui_artigo == 0) ? "Não": "<a target='_blank' title='Clique aqui para visualizar.' href='".$res->url_artigo."'>Sim</a>";*/
					
					$has_artigo = ($res->possui_artigo == 0) ? "Não": "Sim";
					  
                    $telefone = (!empty($res->telefone)) ? $res->telefone: " - ";
					
					  
                      echo "
                            <tr>
                                <td>".$row."</td>
                                <td>".$res->nome."</td>
                                <td>".$res->email."</td>
                                <td>".$res->cpf."</td>
                                <td>".$telefone."</td>
                                <td>".$res->empresa."</td>
                                <td>".$res->cargo."</td>
                                <td>".$has_artigo ."</td>
                            </tr>
                      ";
                  }
            } 
       ?>
    </tbody>
  </table>
  </div>
</div>