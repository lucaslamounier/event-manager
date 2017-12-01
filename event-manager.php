<?php

/*
Plugin Name: Gerenciador de Eventos
Plugin URI: 
Description: Plugin desenvolvido para implementar o registro de participantes e submissão de trabalhos
Version: 1.0
Author: Lucas Lamounier
Author URI: http://github.com/lucaslamounier
Text Domain: event-manager
License: GPL2

*/

defined('ABSPATH') or die( 'Nope, not accessing this' );
define('ACFSURL', WP_PLUGIN_URL."/".dirname( plugin_basename( __FILE__ ) ) );
define('ACFPATH', WP_PLUGIN_DIR."/".dirname( plugin_basename( __FILE__ ) ) );

require_once(plugin_dir_path(__FILE__).'/includes/programacao-class.php');
require_once(plugin_dir_path(__FILE__).'/includes/shortcode-class.php');

//require_once(plugin_dir_path(__FILE__).'/includes/pagetemplater.php');

class Event_manager {

  private static $instance;
  private static $wpdb;
  private static $info;
  const TEXT_DOMAIN = "event-manager";

  public static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct() {
    // Instala o plugin,  cria a tabela no banco de dados e etc.
    add_action('init', array($this, 'instalar'));

    // Adiciona o Template no admin do wordpress
    add_action('admin_menu', array($this, 'settings_admin_tab'));

    // Adiciona shortcode para o formulário
    //add_shortcode( 'form_inscricao_via_viva', array($this, 'form_shortcode'));
    add_shortcode( 'form_inscricao', array($this, 'form_shortcode_func'));
    add_shortcode( 'form_inscricao_submissao_trabalhos', 
                    array($this, 'form_shortcode_submissao_trabalhos'));
    
    // Registrando a chamada ajax para o formulário 
    // Action do formulário de inscrição 
    //add_action( 'wp_ajax_form_inscr', array($this,'form_inscr'));
	
	  add_action("wp_ajax_form_inscr", array($this,'form_inscr'));
    add_action("wp_ajax_nopriv_form_inscr", array($this,'form_inscr'));

    /* Action para o envio de formulário na submissão de trabalhos */
    add_action("wp_ajax_check_participante", array($this,'check_participante'));
    add_action("wp_ajax_nopriv_check_participante", array($this,'check_participante'));

    /* Action para o envio de formulário de submissão de trabalhos, parte 2 */
    add_action("wp_ajax_send_trabalho", array($this,'receive_trabalho'));
    add_action("wp_ajax_nopriv_send_trabalho", array($this,'receive_trabalho'));


    // Ajax para a palestrantes
    add_action("wp_ajax_form_palestrante", array($this,'form_palestrante'));

    // Adicionar script no admin 
    add_action ('admin_enqueue_scripts', array($this,'custom_admin_enqueue'));

    // Registrando o js do plugin.
    add_action('wp_enqueue_scripts', array($this, 'event_manager_enqueuescripts'), 99);

    add_filter('page_template', array($this, 'programacao_page_template'));

    add_action('wp_head', array($this,'head_code'), 99);

    // Adiciona o painel de boas vindas
    //add_action('welcome_panel', array($this, 'welcome_panel'));

    // Altera o rodapé do site
    add_action('wp_footer', array($this, 'altera_rodape'), 99);
  }

  public function custom_admin_enqueue(){
      
    wp_enqueue_script('ajax-script', ACFSURL.'/js/palestrantes-admin.js', array('jquery'));
    wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
  }

  public function head_code(){ 

      $output = '';

      echo $output;

}

  public function welcome_panel(){
  ?>

    <div class="welcome-panel-content">
      <h3> <?=__("Seja Bem Vindo ao Painel Administrativo", 'event-manager'); ?> </h3>
       <h4> <?=__("VIA VIVA – I Seminário Socioambiental em Infraestrutura de Transportes", 'event-manager'); ?> </h4>
        <p> <?=__("Siga-nos nas redes sociais", 'event-manager'); ?>  </p>

        <div id="icons">
          <a href="#" target="_blank">
         <span class="dashicons dashicons-facebook"></span>
        </a>
        <a href="#" target="_blank">
         <span class="dashicons dashicons-twitter"></span>
        </a>

        </div>

    </div>

  <?php
   }

  public function programacao_page_template( $page_template ){
      if (is_page('programacao-completa-do-evento')) {
          $page_template = dirname( __FILE__ ) . '/templates/programacao-custom-page.php';
      }
      return $page_template;
  }

   public function altera_rodape(){
      //echo "©2017 Ministério dos Transportes | Todos os direitos reservados New";
    load_template(dirname( __FILE__ )  . '/templates/footer2.php');
  }

  public function form_html() {
     load_template(dirname( __FILE__ )  . '/templates/form-inscricao.php'); 
  }

   public function form_html_submissao_trabalhos() {
     load_template(dirname( __FILE__ )  . '/templates/form-submissao-trabalhos.php'); 
  }

  /*Logica de checar se o participante já está inscrito */
  public function check_participante(){

      $cpf   = sanitize_text_field( $_POST["cpf"] );
      $email   = sanitize_email( $_POST["email"] );

      $existParticipanteCpf =  $this->checkExistsParticipanteCpf($cpf);
      
      $existParticipanteEmail =  $this->checkExistsParticipanteEmail($email);

      /* Se o participante ja está inscrito no evento, pode enviar arquivo */
      if($existParticipanteCpf && $existParticipanteEmail){
        wp_die(1);
      
      /* Participante registrado com outro email */
      }else if($existParticipanteCpf && !$existParticipanteEmail){
        wp_die(2);

      /* Participante não registrado */
      }else{
        wp_die(0);
      }
  }

  /* Lógica do submit de inscrição de palestrante */
  
  public function form_palestrante(){

          $nome    = sanitize_text_field( $_POST["nome"] );
          $email   = sanitize_email( $_POST["email"] );
          $cpf   = sanitize_text_field( $_POST["cpf"] );
          $telefone   = sanitize_text_field( $_POST["telefone"] );
          $empresa = sanitize_text_field( $_POST["empresa"] );
          $cargo = sanitize_text_field( $_POST["cargo"] );

          $file_path = NULL;
          $data_envio_artigo = NULL;
          $possui_artigo = 0;
          $data_inscricao = Event_manager::getDatetimeNow();

          $dados = array(
                        "nome" => $nome, 
                        "email" => $email, 
                        "cpf" => $cpf,
                        "telefone" => $telefone, 
                        "empresa" => $empresa,
                        "cargo" => $cargo, 
                        "possui_artigo" => $possui_artigo,
                        "data_envio_artigo" => $data_envio_artigo,
                        "url_artigo" => $file_path, 
                        "data_inscricao" => $data_inscricao,
                        "is_palestrante" => 1
          );

	  
	        $existParticipanteCpf =  $this->checkExistsParticipanteCpf($cpf);	  	
		      $existParticipanteEmail =  $this->checkExistsParticipanteEmail($email);
	  
          if(!$existParticipanteCpf && !$existParticipanteEmail){
                  
              $resultado = $this->insertParticipante($dados);
              
              if($resultado){
                  // Participante cadastrado com sucesso.
                  wp_die("1");
              }else{
                  // Ocorreu um erro ao realizar o cadastro do participante
                  wp_die("0");
              }
          
          }else if(!$existParticipanteEmail && $existParticipanteCpf){
			  	
                wp_die("4");
		      
          }else {
                // Participante já inscrito no evento
                wp_die("2");
          }
  }

  public function form_inscr() {

          $nome    = sanitize_text_field( $_POST["nome"] );
          $email   = sanitize_email( $_POST["email"] );
          $cpf  = $this->limpaCPF_CNPJ($_POST["cpf"]);
          $telefone   = sanitize_text_field( $_POST["telefone"] );
          $empresa = sanitize_text_field( $_POST["empresa"] );
          $cargo = sanitize_text_field( $_POST["cargo"] );
          $possui_artigo = (int) $_POST["AnwaserEnviarArtigo"];
          //$file = $_FILES["file-artigo"];

          $file_path = NULL;
          $data_envio_artigo = NULL;
          $data_inscricao = Event_manager::getDatetimeNow();

          if(isset($_POST['g-recaptcha-response'])){
            $captcha = $_POST['g-recaptcha-response'];
          }

          if (empty($captcha)) {
            // Se hover erro no recaptcha 
            //die("3");
            wp_die("3");

          } else if (!empty($captcha)) {

              $dados = array("nome" => $nome, "email" => $email, "cpf" => $cpf,
                      "telefone" => $telefone, "empresa" => $empresa,
                      "cargo" => $cargo, "possui_artigo" => $possui_artigo,
                      "data_envio_artigo" => $data_envio_artigo,
                      "url_artigo" => $file_path, 
					            "data_inscricao" => $data_inscricao,
                      "is_palestrante" => 0
              );


              $existParticipante = $this->checkExistsParticipante($cpf, $email);
			  
			        $existParticipanteCpf =  $this->checkExistsParticipanteCpf($cpf);
	  	
		          $existParticipanteEmail =  $this->checkExistsParticipanteEmail($email);

              if(!$existParticipanteCpf && !$existParticipanteEmail){
                  
                    $resultado = $this->insertParticipante($dados);
				    
				            $enviou_email = $this->deliver_mail($email);
              
                    if($resultado && $enviou_email){
                       // Participante cadastrado com sucesso.
                       wp_die("1");
                    }else if($resultado && !$enviou_email){
						          $this->deliver_mail($email);
						          wp_die("1");
      					    }else{
                          // Ocorreu um erro ao realizar o cadastro do participante
                          wp_die("0");
                    }

              }else if($existParticipanteCpf && !$existParticipanteEmail){
				            wp_die("4");

      			  }else {
                    // Participante já inscrito no evento
                    wp_die("2");
              }


        } // End Else recaptcha
         
  } // End form_inscricao

  /* Action do formulário de submissão de trabalhos */
  public function receive_trabalho(){

      $email   = sanitize_email( $_POST["email"] );
      $cpf  = $this->limpaCPF_CNPJ($_POST["cpf"]);
      $file_uploaded = $_FILES["artigo"];
      $accept_terms = $_POST["accept-terms"];
      $tipo_trabalho = $_POST["tipoTrabalho"];

      if(isset($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
      }

      if(isset($file_uploaded)){

          $file = wp_upload_bits($file_uploaded['name'], null, 
                      @file_get_contents($file_uploaded['tmp_name'] ) );

          if ($file['error']){
              wp_die("-1");
          }else{
            // Upload foi realizado com sucesso.
            $file_path = $file["url"];
            $data_envio_artigo = $this->getDatetimeNow();
          }
      }


      if(!empty($captcha) && !empty($file_path)){
         

          $check_uploaded_file = $this->checkUpdatedFile($email, $cpf);

          if($check_uploaded_file && $check_uploaded_file["possui_artigo"] == 1 && !empty($check_uploaded_file["url_artigo"])){

            wp_die("2"); // participante ja realizou envio de trabalho
          }else if($check_uploaded_file && $check_uploaded_file["possui_artigo"] == 0 && empty($check_uploaded_file["url_artigo"])){

              $dados = array("email" => $email, "cpf" => $cpf,
                      "possui_artigo" => 1, "data_envio_artigo" => $data_envio_artigo,
                      "url_artigo" => $file_path, "tipo_trabalho" => $tipo_trabalho,
                      "id" => $check_uploaded_file["id"]
              );

              $update = $this->atualizaParticipante($dados);

              if($update){
                wp_die("1"); // tudo certo
              }else{
                wp_die("3"); //
              }

          }else{

              wp_die("0"); // Ocorreu algum erro

          }

      }else{
        wp_die("4"); // recaptcha nao marcado
      }
  }

  public function atualizaParticipante($dados){

      $sql = "UPDATE `".Event_manager::$wpdb->prefix."participante_evento`
            SET 
            `possui_artigo` = 1,
            `url_artigo` = ".$dados["url_artigo"].",
            `data_envio_artigo` = ".$dados["data_envio_artigo"].",
            `tipo_trabalho` = ".$dados["tipo_trabalho"]."
            WHERE `id` = ".$dados["tipo_trabalho"];

      $update = $this::$wpdb->query($sql);
      
      if($update){
          return true;
      }else{
          return false;
      }
  }

	
	/* Função para envio de email */
	public function deliver_mail($email) {
		$to = get_option( 'admin_email' );
		$subject = 'Confirmação de inscrição para o Via Viva';
		$body = '<div> 
				<h4>Obrigado por se inscrever</h4>
				<p>VIA VIVA é o I Seminário Socioambiental em Infraestrutura de Transportes, cujo tema 2017 é “Gestão socioambiental em concessões de transportes terrestres”, tem por objetivo promover o debate acerca do tratamento das questões socioambientais no âmbito das concessões rodoviárias e ferroviárias.<br /> O evento contará com a participação de representantes do governo, do mercado, dos órgãos de controle, da academia e de outras instituições que possuem interesse no tema e acontecerá nos dias 12 e 13 de Dezembro de 2017, no Auditório do Ministério dos Trasnportes. </p>
				
				<p>Atenciosamente, <br /> Equipe VIA VIVA.</p>
		
		</div>';
		$headers = array('From: VIA VIVA <via.viva@transportes.gov.br>', 'Content-Type: text/html; charset=UTF-8');
 
		$send_ok = wp_mail($email, $subject, $body, $headers );
		
		if($send_ok){
			return true;
		}else{
			return false;
		}
    }
	
	public function limpaCPF_CNPJ($valor){
 		$valor = trim($valor);
 		$valor = str_replace(".", "", $valor);
 		$valor = str_replace(",", "", $valor);
 		$valor = str_replace("-", "", $valor);
 		$valor = str_replace("/", "", $valor);
 		return $valor;
	}

  public function checkExistsParticipante($cpf, $email){
  		$sql = "SELECT * FROM `".Event_manager::$wpdb->prefix."participante_evento` WHERE cpf = '$cpf' AND email = '$email';";
        $count = $this::$wpdb->query($sql);
  		return ($count != 0) ? true : false;
  }
	
  public function checkExistsParticipanteEmail($email){
  		$sql = "SELECT * FROM `".Event_manager::$wpdb->prefix."participante_evento` WHERE email = '$email';";
        $count = $this::$wpdb->query($sql);
  		return ($count != 0) ? true : false;
  }


  public function checkUpdatedFile($email, $cpf){
      $sql = "SELECT * FROM `".Event_manager::$wpdb->prefix."participante_evento` WHERE email = '$email' and cpf = '$cpf';";
      return $wpdb->get_row($sql);
  }
  
  public function checkExistsParticipanteCpf($cpf){
  		$sql = "SELECT * FROM `".Event_manager::$wpdb->prefix."participante_evento` WHERE cpf = '$cpf';";
        $count = $this::$wpdb->query($sql);
  		return ($count != 0) ? true : false;
  }

  public function insertParticipante($array_participante){

            $sql = "INSERT INTO `".Event_manager::$wpdb->prefix."participante_evento`
										(`nome`,
										`email`,
										`cpf`,
										`empresa`,
										`cargo`,
										`data_inscricao`,
										`telefone`,
										`is_palestrante`,
										`possui_artigo`,
										`url_artigo`,
										`data_envio_artigo`) VALUES ('".$array_participante['nome']."',
																'".$array_participante['email']."',
																'".$array_participante['cpf']."',
																'".$array_participante['empresa']."',
																'".$array_participante['cargo']."',
																'".$array_participante['data_inscricao']."',
																'".$array_participante['telefone']."',
																".$array_participante['is_palestrante'].",
																".$array_participante['possui_artigo'].",
																'".$array_participante['url_artigo']."',
																'".$array_participante['data_envio_artigo']."');";
            
          $insert = $this::$wpdb->query($sql);
      
          if($insert){
              return true;
          }else{
              return false;
          }
  }
  
  public function getDatetimeNow() {
          $tz_object = new DateTimeZone('Brazil/East');
          $datetime = new DateTime();
          $datetime->setTimezone($tz_object);
          return $datetime->format('Y\-m\-d\ H:i:s');
  }

  /**
  * Função de inicialização, centraliza a definição de filtros/ações
  *
  */
  public static function inicializar(){
    		global $wpdb;
    				
    		//Mapear objetos WP
    		Event_manager::$wpdb = $wpdb;
    		
    		//Outros mapeamentos
    		Event_manager::$info['plugin_fpath'] = dirname(__FILE__);	
	}

  public function form_shortcode_func($atts){
        ob_start();
        $this->form_html();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;

  }

   public function form_shortcode_submissao_trabalhos($atts){
        ob_start();
        $this->form_html_submissao_trabalhos();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
  }

  // Cria no painel administrador o icone para a página de participantes do evento
  public function settings_admin_tab(){
  		add_menu_page('Gerenciamento de Evento', 'Gerenciamento do Evento', 'manage_options', 
        'lls_event_manager', 'Event_manager::html_admin_page', 'dashicons-id-alt', 11);
  }

	// Registra o template da página de administrador
	public function html_admin_page(){
	  		$dir = plugin_dir_path( __FILE__ );
	  		load_template($dir.'/templates/admin_template2.php');
	} 


  /* Cria o banco de dados */
  public static function instalar(){

  		if(is_null(Event_manager::$wpdb)) Event_manager::inicializar();
    		
    		//Criar base de dados
     		$sql = "CREATE TABLE IF NOT EXISTS `".Event_manager::$wpdb->prefix."participante_evento` (
    					  `id` INT NOT NULL AUTO_INCREMENT,
    					  `nome` VARCHAR(45) NULL,
    					  `email` VARCHAR(45) NULL,
    					  `cpf` VARCHAR(15) NULL,
    					  `empresa` VARCHAR(45) NULL,
    					  `cargo` VARCHAR(45) NULL,
    					  `data_inscricao` DATETIME NULL,
                `telefone` VARCHAR(16) NULL,
    					  `is_palestrante` TINYINT NULL DEFAULT 0,
    					  `possui_artigo` TINYINT NULL DEFAULT 0,
    					  `url_artigo` VARCHAR(45) NULL,
    					  `data_envio_artigo` DATETIME NULL,
                `tipo_trabalho` VARCHAR(50) NULL,
     						 PRIMARY KEY (`id`))";
    		Event_manager::$wpdb->query($sql);

    		// DELETA A TABELA NA DESINSTALAÇÃO
    		// register_uninstall_hook( __FILE__, array($this, 'desinstalar'));
  }


  public static function event_manager_enqueuescripts(){
      
      wp_enqueue_script('event-manager-js', ACFSURL.'/js/event-manager.js', array('jquery'));
      wp_localize_script('event-manager-js', 'eventManagerJS', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

       wp_enqueue_script('submissao-trabalhos-js', ACFSURL.'/js/submissao-trabalhos.js', array('jquery'));
      wp_localize_script('submissao-trabalhos-js', 'trabalhosJS', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

      /* Registrando css do plugin */
      wp_enqueue_style('event-manager-styles', plugin_dir_url(__FILE__).'/css/event-manager.css');
      
  }

			
  /**
  * Esta função remove tracos de uma instalação deste plugin, removendo
  * as tabelas e dados da base de dados
  */
  public static function desinstalar(){
	//Remover bases de dados
	$sqlDelete = "DROP TABLE `".Event_manager::$wpdb->prefix."participante_evento`";
	Event_manager::$wpdb->query($sqlDelete);
  }

}

Event_manager::getInstance();
Programacao_manager::getInstance();

?>