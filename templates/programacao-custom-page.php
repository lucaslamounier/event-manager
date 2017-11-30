<?php 


/*
	Template Default para Programação do evento
*/

	get_header(); // Busca o header

?>

<div id="primary" class="content-area">
		<main id="main" class="content site-main" role="main">

				<h1>Teste</h1>

			<?php 
			
						while (have_posts()): the_post();
							$imagem = get_the_post_thumbnail(get_the_ID(), 'medium');
							$imagem_url = wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'medium');
						endwhile;	


			 ?>
					
		</main>

</div>






<?php 
	get_footer();

?>
