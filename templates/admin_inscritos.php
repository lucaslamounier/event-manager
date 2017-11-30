<div class="row">
  <div class="table-responsive">          
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Empresa</th>
        <th>Cargo</th>
        <th>Palestrante</th>
        <th>Enviou Trabalho</th>
		<th>Data de inscrição</th>
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
          $has_palestrante = ($res->is_palestrante == 0) ? "Não": "Sim";
					  
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
                                <td>".$has_palestrante."</td>
                                <td>".$has_artigo ."</td>
								<td>".date("d/m/Y H:m:s", strtotime($res->data_inscricao))."</td>
                            </tr>
                      ";
                  }
            } 
       ?>
    </tbody>
  </table>
  </div>
</div>