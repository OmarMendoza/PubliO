<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Imagenes_factura extends CI_Controller {

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
    //redirect('/principal');			
  	}   
  
    function principal($id){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_imagenes_factura');
		$crud->set_subject('imagenes_factura');		
		$crud->set_language('spanish');
		$crud->fields(
		'factura',			
		   'imagen'
		);
		
		$crud->required_fields(
		'factura',			
		   'imagen'
		);
		
		$crud->set_subject('imagen');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->where('factura',$id);
			 
		
		$crud->set_relation('factura', 'tp_factura', 'num_factura');
		
		$crud->set_field_upload('imagen','archivos/imagenes_factura');
		
		
		$crud->callback_after_upload(array($this,'obtener_imagen_upload'));									
		
		$output = $crud->render();
		
		$data['opcion'] = 'facturas';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		
		$data['opcion_factura'] = 'imagenes_factura';
		
		$num_factura="";
		$facturas = $this->modelo->obtener_numero_factura($id);	
		foreach($facturas->result() as $fila) { $num_factura=$fila->num_factura; }
	    $data['num_factura'] = $num_factura; 
		
	    $this->load->view('opciones_facturas', $data);
	  	
	  $data['nueva_imagen_factura'] = '';
		$data['id'] = $id;
		$this->load->view('opciones_banner_imagen_otros', $data);	
		$this->load->view('factura', $output);
		
		$this->load->view('regresar');
		
		$this->load->view('pie');					
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }      
  
  function obtener_imagen_upload($uploader_response,$field_info, $files_to_upload)
  {
    $this->load->library('image_moo');
 
    $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
 
    $this->image_moo->load($file_uploaded)->save($file_uploaded,true);
 
    return true;
  }
  
  function agregar($id){
	  
	  	$this->modelo->borrar_imagenes_factura_temp();
	 			
		$data['opcion'] = 'facturas';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);			
		
		$facturas = $this->modelo->obtener_numero_factura($id);		
	    $data['facturas'] = $facturas;
		$data['id'] = $id;			
		$this->load->view('nuevaimagen', $data);
		
		$this->load->view('pie');		
				
  } 
  
  function guardar(){
	  $factura = $this->input->post('factura');
	  $factura = $this->modelo->obtener_id_factura($factura);
	  
	  $this->modelo->guardar_nuevas_imagenes($factura);
	  
	  $this->modelo->borrar_imagenes_factura_temp();
	  
	  redirect('imagenes_factura/principal/'.$factura); 
	  	  
  }  
  
}