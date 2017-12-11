<div class="row">
  <div class="table-responsive">          
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Tipo de trabalho</th>
        <th>Tema do trabalho</th>
		    <th>Data de envio do trabalho</th>
        <th>Arquivo</th>
      </tr>
    </thead>
    <tbody>
      
      <?php 
            global $wpdb;

              $table_name = $wpdb->prefix."participante_evento";

              $sql = 'SELECT * FROM '.$table_name.' where possui_artigo = 1 and url_artigo != "" order by nome;';

              $resultados = $wpdb->get_results($sql);

             if(count($resultados) < 1){

                echo "
                    <tr>
                        <td colspan='7' style='text-align:center;'> <h3> Nenhum trabalho enviado até o momento. </h3> </td>
                    </tr>
                ";

              }else{
				  $index = 1;
                  foreach($resultados as $key => $res) {
					$row = $index++;
                   /* $has_artigo = ($res->possui_artigo == 0) ? "Não": "<a target='_blank' title='Clique aqui para visualizar.' href='".$res->url_artigo."'>Sim</a>";*/
					
					//$has_artigo = ($res->possui_artigo == 0) ? "Não": "Sim";
          $has_palestrante = ($res->is_palestrante == 0) ? "Não": "Sim";



					$apresentacao_arquivo = '<a href="'.$res->url_artigo.'" target="_blank"><span class="dashicons dashicons-download"></span></a>';  
          $telefone = (!empty($res->telefone)) ? $res->telefone: " - ";					  
          
          echo "
                <tr>
                  <td>".$row."</td>
                  <td>".$res->nome."</td>
                  <td>".$res->email."</td>
                  <td>".$res->tipo_trabalho."</td>
                  <td>".$res->tema_trabalho."</td>
  						    <td>".date("d/m/Y H:m:s", strtotime($res->data_envio_artigo))."</td>
                  <td>".$apresentacao_arquivo."</td>
                </tr>
                      ";
                  }
            } 
       ?>
    </tbody>
  </table>
  </div>
</div>