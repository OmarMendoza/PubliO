<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Dependencia extends CI_Controller {

  function __construct()
  {
	
    parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->model('modelo');
	$this->load->library('grocery_crud');
	$this->load->library('form_validation');
	$this->load->library(array('session'));
	
	if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'administrador')
    {
       redirect(base_url().'index.php/login');
    }
	
 		
  }

  function index()
  {    
    redirect('dependencia/principal');			
  }
  
  function imprimir(){
	  $data['opcion'] = 'dependencias';	  
	  $this->load->view('dependencias', $data);	  
  }    
  
    function principal(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_dependencia');
		$crud->set_subject('dependencia');		
		$crud->set_language('spanish');
		$crud->fields(
		'id_dependencia',
		'dependencia'		
		);
		
		$crud->required_fields(
		'dependencia','tipo');	
		
		$crud->columns('dependencia');
		
		$crud->edit_fields('dependencia','tipo');	
		
		$crud->callback_edit_field('tipo',array($this,'editar_tipo'));
		
		$crud->callback_column('dependencia',array($this,'nombre_completo'));
								
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_back_to_list();			 		
	
		$crud->add_action('Campañas de la dependencia',base_url().'imagenes/campa.png','','',array($this,'modificar_url_campa'));
		$crud->add_action('Contratos de la dependencia',base_url().'imagenes/contratos.png','','',array($this,'modificar_url_contratos'));
		
		$crud->callback_before_delete(array($this,'eliminar_dependencia'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'dependencias';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	  
	  	$this->load->view('cabecera', $data);	
		$data['opcion_dependencia'] = 'ver_todo';	  
	  	$this->load->view('opciones_dependencia', $data);
		$this->load->view('dependencias', $output);	
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
   public function eliminar_dependencia($primary_key){
	  
    $this->modelo->borrar_dependencia($primary_key);
    return true;
	
  }
  
  function nombre_completo($primary_key , $row)
  {	
  	if($row->id_dependencia!=""){
	$dependencia=$this->modelo->obtener_nombre_dependencia($row->id_dependencia);	
	return $dependencia;
	}
  } 
  
  function modificar_url_campa($primary_key , $row)
  {
    return site_url('campa/campa_dependencia').'/'.$row->id_dependencia;
  }
  
  function modificar_url_contratos($primary_key , $row)
  {
    return site_url('contratos/contrato_dependencia').'/'.$row->id_dependencia;
  }        
  
  function agregar_tipo()
  {
    return 'Contratante <input type="radio" name="tipo" value="contratante" style="margin-right:15px"/>      Solicitante <input type="radio" name="tipo" value="solicitante" style="margin-right:15px" />      Ambos <input type="radio" name="tipo" value="ambos" />';
  }
  
   function editar_tipo($value, $primary_key)
  {
	$contenido="";
	
	if($value=="contratante"){
		$contenido=$contenido.'Contratante <input type="radio" name="tipo" value="contratante" checked="checked" style="margin-right:15px"/>';
	}
	else{
		$contenido=$contenido.'Contratante <input type="radio" name="tipo" value="contratante" style="margin-right:15px"/>';
	}
	
	if($value=="solicitante"){
		$contenido=$contenido.'Solicitante <input type="radio" name="tipo" value="solicitante" checked="checked" style="margin-right:15px"/>';
	}
	else{
		$contenido=$contenido.'Solicitante <input type="radio" name="tipo" value="solicitante" style="margin-right:15px"/>';
	}
	
	if($value=="ambos"){
		$contenido=$contenido.'Ambos <input type="radio" name="tipo" value="ambos" checked="checked"/>';
	}
	else{
		$contenido=$contenido.'Ambos <input type="radio" name="tipo" value="ambos"/>';
	}
	
    return $contenido;
  }
  
  function administracion(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_dependencia');
		$crud->set_subject('dependencia');		
		$crud->set_language('spanish');
		$crud->fields(
		'id_dependencia',		
		   'dependencia'
		);
		
		$crud->columns('dependencia');
		
		$crud->edit_fields('dependencia','tipo');
		
		$crud->add_fields('dependencia','tipo');
		
		$crud->callback_column('dependencia',array($this,'nombre_completo'));
		
		//$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_back_to_list();
		
		$crud->required_fields(
		'dependencia','tipo');
		
		$crud->callback_add_field('tipo',array($this,'agregar_tipo'));
		
		$crud->callback_edit_field('tipo',array($this,'editar_tipo'));
		
		$crud->callback_column('dependencia',array($this,'nombre_completo'));
			 
		//$crud->set_field_upload('archivo','../photos');		
		//$crud->callback_column('archivo',array($this,'obtener_imagen'));			
		//$crud->callback_after_upload(array($this,'obtener_imagen_upload'));
		
		$crud->add_action('Campañas de la dependencia',base_url().'imagenes/campa.png','','',array($this,'modificar_url_campa'));
		$crud->add_action('Facturas de la dependencia',base_url().'imagenes/contratos.png','','',array($this,'modificar_url_contratos'));		
		
		$crud->callback_before_delete(array($this,'eliminar_dependencia'));						
		
		$output = $crud->render();
		
		$data['opcion'] = 'dependencias';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional(); 
	  	$this->load->view('cabecera', $data);
		$data['opcion_dependencia'] = 'nueva_dependencia';	  
	  	$this->load->view('opciones_dependencia', $data);	
		$this->load->view('dependencias', $output);	
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}	
  }  
  
  function buscar(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_dependencia');
		$crud->set_subject('dependencia');		
		$crud->set_language('spanish');
		$crud->fields(
		'id_dependencia',
		'dependencia'
		);
		
		$crud->required_fields(
		'dependencia','tipo');
		
		$crud->columns('dependencia');
		
		$crud->edit_fields('dependencia','tipo');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_back_to_list();
		
		$crud->add_action('Campañas de la dependencia',base_url().'imagenes/campa.png','','',array($this,'modificar_url_campa'));
		$crud->add_action('Contratos de la dependencia',base_url().'imagenes/contratos.png','','',array($this,'modificar_url_contratos'));		
		
		$crud->callback_add_field('tipo',array($this,'agregar_tipo'));
		
		$crud->callback_edit_field('tipo',array($this,'editar_tipo'));
							 					
		$crud->callback_column('dependencia',array($this,'nombre_completo'));
		
		$dato = $this->input->post('buscar');				
		
		$crud->like('dependencia',"$dato");	   
    	//$crud->or_like('clasificacion',$dato);
		
		$crud->callback_before_delete(array($this,'eliminar_dependencia'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'dependencias';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);
		$data['opcion_dependencia'] = 'buscar';	  
	  	$this->load->view('opciones_dependencia', $data);	
		$this->load->view('dependencias', $output);	
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }  
  
  function ver_dependencia($id){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_dependencia');
		$crud->set_subject('dependencia');		
		$crud->set_language('spanish');
		$crud->fields(		
		   'dependencia'
		);
		
		//$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_back_to_list();
		
		$crud->required_fields(
		'dependencia','tipo');
		
		$crud->where('id_dependencia',$id);
		
		$crud->callback_column('dependencia',array($this,'nombre_completo'));
			 
		//$crud->set_field_upload('archivo','../photos');		
		//$crud->callback_column('archivo',array($this,'obtener_imagen'));			
		//$crud->callback_after_upload(array($this,'obtener_imagen_upload'));
		
		$crud->add_action('Campañas de la dependencia',base_url().'imagenes/campa.png','','',array($this,'modificar_url_campa'));
		$crud->add_action('Facturas de la dependencia',base_url().'imagenes/contratos.png','','',array($this,'modificar_url_contratos'));
		
		$crud->callback_before_delete(array($this,'eliminar_dependencia'));								
		
		$output = $crud->render();
		
		$data['opcion'] = 'dependencias';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);
		$data['opcion_dependencia'] = 'ninguno';	  
	  	$this->load->view('opciones_dependencia', $data);	
		$this->load->view('dependencias', $output);		
		
		$this->load->view('pie');
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}	
  }   
  
}