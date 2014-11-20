<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Audios extends CI_Controller {

  function __construct()
  {	 
	parent::__construct();
	$this->load->helper('url');
	$this->load->model('modelo');
	$this->load->library('grocery_crud');
	$this->load->library(array('session'));
	
	if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'administrador')
    {
       redirect(base_url().'index.php/login');
    }	    
  }

  	function index()
  	{    		
  	}   
  
    function principal($id){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_audios_campa');
		$crud->set_subject('audio');		
		$crud->set_language('spanish');
		$crud->fields(
		'campa',			
		'audio'
		);
		
		
		$crud->display_as('campa','Campaña');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->where('campa',$id);
		
		$crud->set_relation('campa', 'tp_campa', 'nombre');
		
		$crud->set_field_upload('audio','archivos/audios');
		
		$crud->callback_column('audio',array($this,'obtener_audio'));								
		
		$output = $crud->render();
		
		$data['opcion'] = 'campa';		
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));		
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	  
	  	$this->load->view('cabecera', $data);
		
		$data['opcion_campa'] = 'audios_campa';
		
		$nombre_campa="";
		$campas=	$this->modelo->obtener_nombre_campa($id);		
		foreach($campas->result() as $fila) { $nombre_campa=$fila->nombre; }
		$data['nombre_campa'] = $nombre_campa;	
			    
		$this->load->view('opciones_campa', $data);		
		
		$data['nuevo_audio'] = '';
		$data['id'] = $id;		
		$this->load->view('opciones_banner_imagen_otros', $data);	
		
		$this->load->view('campa', $output);
		
		$this->load->view('regresar');	
		
		$this->load->view('pie');				
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
  function obtener_audio($primary_key , $row)
  {
	return "<a target='_blank' href='".base_url()."jplayer/reproductor.php?audio=".$row->audio."'>".$row->audio."</a>";
  }          
  
  function agregar($id){
	  
	  	$this->modelo->borrar_audios_temp();
		
	  	$data['opcion'] = 'campa';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional(); 
	  	$this->load->view('cabecera', $data);				
			
		$campas = $this->modelo->obtener_nombre_campa($id);	
	    $data['campas'] = $campas;	
		$data['id'] = $id;		
		$this->load->view('nuevoaudio', $data);	
		
		$this->load->view('pie');
  }   
  
  function guardar(){
	  $campa = $this->input->post('campas');	  
	  $campa = $this->modelo->obtener_id_campa($campa);
	  
	  $this->modelo->guardar_nuevos_audios($campa);
	  
	  $this->modelo->borrar_audios_temp();
	  
	  redirect('audios/principal/'.$campa); 
	  	  
  }
  
}