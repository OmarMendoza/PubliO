<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Usuarios extends CI_Controller {

  function __construct()
  {	
	parent::__construct();
	$this->load->helper('url');
	$this->load->model('modelo');
	$this->load->model('login_modelo');
	$this->load->library('grocery_crud');
	$this->load->library(array('session'));
	
	if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'administrador')
    {
       redirect(base_url().'index.php/login');
    }	    
	
		
  }

  	
  
  function principal(){	    	  											
  		
		$data['opcion'] = '';	  			
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['id_usuario'] = $this->session->userdata('id_usuario');
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional(); 
	  	$this->load->view('cabecera', $data);
		$this->load->view('cambiar_datos',$data);												
		$this->load->view('pie');								
		
  }
  
  function guardar(){
	  $id_usuario=$this->input->post('id_usuario');
	  $nombre_usuario = $this->input->post('nombre_usuario');	 
	  $password = $this->input->post('password');
	  $nuevo_password = $this->input->post('nuevo_password');
	  $repetir_password = $this->input->post('repetir_password');
	  if($this->login_modelo->verificar($id_usuario,$nombre_usuario,$password)){
		  $this->login_modelo->actualizar_datos($id_usuario,$nombre_usuario,$nuevo_password);
		   redirect(base_url());		  
	  }
	  else{
		  
		  	$data['opcion'] = '';	  			
			$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
			$data['id_usuario'] = $this->session->userdata('id_usuario');			
			$data['logo'] = $this->modelo->logo();
			$data['url_logo'] = $this->modelo->url_logo();
			$data['logo_opcional'] = $this->modelo->logo_opcional();
			$data['url_logo_opcional'] = $this->modelo->url_logo_opcional(); 
			$this->load->view('cabecera', $data);
			$data['error'] = '';
			$this->load->view('cambiar_datos',$data);												
			$this->load->view('pie');
		  
	  }
  }
}