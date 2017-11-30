<?php 

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

class Shortcode_manager {

	private static $instance;

	public static function getInstance() {
		if (self::$instance == NULL) {
		    self::$instance = new self();
		}
    	return self::$instance;
  	}

  	private function __construct(){

  		 add_shortcode( 'custom_template_programacao', array($this, 'custom_template_shortcode'));
  		
  	}


  	public function programacao_html(){

  		?>

			<div class="painel">
			    <h2>Cases, Palestras e Painéis</h2>
			    <div class="description">
			        <p><strong>Dias</strong>: 12 e 13 de Dezembro.</p>
			        <p><strong>Público-alvo</strong>: Servidores Públicos e demais participantes</p>
			 </div>

		    <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#programacao-container" 
		    				aria-expanded="false" aria-controls="collapseExample">Ver programação
			</button>

		    <div class="collapse" id="programacao-container" aria-expanded="false" style="height: 0px;">

		        <div class="contentprogamacao">

		            <?php $custom_query = new WP_Query(
		            	array( 
		            		'post_type' => 'programacao_evento',
		            		'orderby' => 'menu_order',
		            		'order' => 'ASC',
		            		'posts_per_page' => -1,
		            	));
						
						while($custom_query->have_posts()) : $custom_query->the_post(); ?>

							<div class="itemprogramacao">

				                <h3> <?php the_title(); ?> </h3>   

								<?php	
									/* Recupera os meta dados do custom post */
								 	$data = get_post_meta( get_the_ID(), 'Data', true );
								 	$horario = get_post_meta( get_the_ID(), 'Horário', true );
								 	$local = get_post_meta( get_the_ID(), 'Local', true ); 

								 	// Cria regra de apresentação para data e horário.
								 	if($data & $horario ){
								 		$info_local = $data ." - ".$horario;
								 	}else if($data & !$horario){
								 		$info_local = $data;
								 	}else if(!$data & $horario){
								 		$info_local = $horario;
								 	}else{
								 		$info_local = "";
								 	}

								 	echo "<span class='badge badge--programacao'> ". $info_local ."</span>";

								 	if($local){
								 		echo "<span class='badge badge--programacao'> Local: $local </span>";
								 	}

								 	// Verifica se possui conteúdo 
								 	if(the_content() != ''){
								 		echo "<p style='text-align: left;'><strong>Ementa</strong></p>";
								 		echo "<p style='text-align: justify;'><br/>". the_content() ."</p>";
								 	}

								 	// Verifica se possui tipo de programação associado.
								 	$terms = get_the_terms(get_the_ID(), 'tipo_programacao');
								 	
								 	if($terms){
								 			
								 			$term_ids = wp_list_pluck( $terms, 'term_id' );

								 			$args = array(
														'post_type' => 'page',
														'tax_query' => array(
														array(
															'taxonomy' => 'tipo_programacao',
															'field'    => 'id',
															'terms'    => $term_ids,
															),
														),
													);

											$query = new WP_Query($args);
											$qtd_palestrantes = intval($query->found_posts);

											if($qtd_palestrantes != 0){ // Fecha o PHP ?> 	
												<div class="btn-group text-right">
<button class="btn btn-secondary btn-sm" type="button" data-toggle="collapse" data-target="#post-<?php the_ID(); ?>" aria-expanded="false" aria-controls="collapseExample">
										Ver detalhes
											</button></div>

										<!-- Início do Painel Filho -->

										<div class="collapse" id="post-<?php the_ID(); ?>">
				                    <div class="well">
				                        <h4>Palestrantes Convidados</h4>
				                        <div class="table-responsive">
				                            <table class="table table-striped table-hover">
				                                <tbody>
													<?php while($query->have_posts()) : $query->the_post(); ?>
						                                    <tr>
						                                        <td class="palestrante_table_td center-text palestrante-table-td--thumbinail">
						                                        	<?php 

        																$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 

						                                        		echo '<a href="'.esc_url($featured_img_url).'" rel="lightbox">'; 
            																	the_post_thumbnail(
            																		 array(80, 80),
            																		array( 
            																			'class' => 'palestrante-image' )
            																	);
        																echo '</a>';    						
						                                        	 ?>                                        	
						                                        </td>
						                                        <td class="palestrante_table_td palestrante-table-td--large center-text">
						                                        	<a href="<?= the_permalink() ?>">
						                                        		<h4><?php the_title(); ?></h4>
						                                        	</a>						                                      	
						                                        </td>
						                                        <td class="palestrante_table_td palestrante-table-td--large">
								                                      <div class="status Confirmado" style="width: 80px;">
								         
								                                      	<?php echo get_post_meta(get_the_ID(), 'status', true); ?>
								                                      		
								                                      	</div>	
						                                        </td>
						                                    </tr>
													<?php endwhile; ?>
													<?php wp_reset_postdata(); // reset the query ?>
				                                </tbody>
				                            </table>
				                        </div>
				                    </div>
				            	</div>

								<!-- Fim do Painel Filho -->


												<?php
											}
								 	}

								?>

				            </div>	
					<?php endwhile; ?>
					<?php wp_reset_postdata(); // reset the query ?>	
		    </div>
		</div>

	</div>

  		<?php
}


  	public function custom_template_shortcode($atts){
        ob_start();
        $this->programacao_html();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;

   }

}

Shortcode_manager::getInstance();

 ?>