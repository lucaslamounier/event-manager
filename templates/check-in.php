<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>


<div class="container">                                                                                 
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr id="table-head">
        <th>#</th>
        <th>Nome</th>
        <th>E-mail</th>
         <th>CPF</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>

       <?php 
            global $wpdb;

              $resultados = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}participante_evento order by nome;");

             if(count($resultados) < 1){

                echo "
                    <tr>
                        <td colspan='5' style='text-align:center;'> <h3> Nenhum participate registrado até o momento. </h3> </td>
                    </tr>
                ";

              }else{


                if(is_user_logged_in()){
                  
                  $index = 1;
                  foreach($resultados as $key => $res) {
                    
                    $row = $index++;
                    $nome = $res->nome;
                    $email = $res->email;
                    $cpf = $res->cpf;
                    $id = $res->id;

                    $funcao = "sendChecking('$id','$nome', '$email', '$cpf');";

                    $realizou_checking = $res->realizou_checking;

                    ?>

                    <tr>
                      <td><?php echo $row ?></td>
                      <td><?php echo $nome ?></td>
                      <td><?php echo $email ?></td>
                      <td><?php echo $cpf ?></td>
                      <td style="text-align: center;">
                      <?php 

                          $src_load_image = ACFSURL.'/images/ajax-loader.gif'; 
                          $id_image_load = "load_".$id;
                          $id_image_checked_ok = "checked_".$id;
                          $id_image_fail = "checked_fail_".$id;
                          $src_checked_ok = ACFSURL.'/images/cheked-ok.png'; 
                          $src_checked_fail = ACFSURL.'/images/fail.png'; 

                          if($realizou_checking){

                              echo "<img src='$src_checked_ok'>";

                          }else{

                              echo '<a class="btn btn-default btn-sm" id="button_'.$id.'" onclick="'.$funcao.'"> Realizar Chek-in </a> ';
                          }

                       ?>
                       <img id="<?php echo $id_image_fail ?>" src="<?php echo $src_checked_fail ?>" style="display: none;">   
                       <img id="<?php echo $id_image_checked_ok ?>" src="<?php echo $src_checked_ok ?>" style="display: none;">   
                       <img id="<?php echo $id_image_load ?>" src="<?php echo $src_load_image ?>" style="display: none;">                      
                     </td>
                    </tr>
                    
                    <?php
                  }

              }else{

                  echo "<h2 style='text-align: center;'> Usuário não possui permissão para visualizar esta página.</h2>";
                  echo '
                            <script>

                                      document.getElementById("table-head").style.display = "none";
                            </script>
                  ';

              }
            } 
       ?>
    </tbody>
  </table>
  </div>
</div>
