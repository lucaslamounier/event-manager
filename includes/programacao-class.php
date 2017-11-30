<?php 

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

class Programacao_manager {

	private static $instance;
	const TEXT_DOMAIN = 'event-manager';

	public static function getInstance() {
		if (self::$instance == NULL) {
		    self::$instance = new self();
		}
    	return self::$instance;
  	}

  	private function __construct(){
  		//add_action('init', array($this, 'register_taxonomies'));
  		//add_action('init', 'Programacao_manager::register_post_type_programacao');
  		//add_action('init', 'Programacao_manager::register_post_type_participante');
  		//add_action( 'init', 'Programacao_manager::gp_register_taxonomy_for_object_type' );
  		
  	}



	public static function gp_register_taxonomy_for_object_type() {
    	register_taxonomy_for_object_type( 'post_tag', 'programacao_evento' );
    	register_taxonomy_for_object_type( 'post_tag', 'palestrantes_evento' );
	}

	public static function register_post_type_programacao(){

		register_post_type('programacao_evento', 

			array(

				'labels' => array(
					'name' => 'Programação do Evento',
					'singular_name' => 'Programação do Evento'
				),
				'description' => 'Post para cadastro de programação',
				'supports' => array(
					'title', 'editor', 'excerpt', 'author', 'revisions', 'thumbnail', 'custom-fields', 'page-attributes'
				),
				'public' => TRUE,
				'menu_icon' => 'dashicons-id-alt',
				'menu_position' => 10,
				'hierarchical' => true
			)
		);
		
	}


	public static function register_post_type_participante(){

		register_post_type('palestrantes_evento', 

			array(

				'labels' => array(
					'name' => 'Palestrantes',
					'singular_name' => 'Palestrante'
				),
				'description' => 'Post para cadastro de Palestrante',
				'supports' => array(
					'title', 'editor', 'excerpt', 'author', 'revisions', 'thumbnail', 'custom-fields',
				),
				'public' => TRUE,
				'menu_icon' => 'dashicons-businessman',
				'menu_position' => 11,
			)
		);
	}

	public static function register_taxonomies(){

		register_taxonomy('tipo_programacao', array('programacao_evento', 'palestrantes_evento', 'post', 'page'),
			
			array(
				'labels' => array(
						'name' => __("Tipos de Programação"),
						'singular_name' => __("Tipo de Programação"),
				), 
				'public' => TRUE,
				'hierarchical' => TRUE,
				'rewrite' => array('slug' => 'tipo-programacao')
			)
		);
	}


}

 ?>