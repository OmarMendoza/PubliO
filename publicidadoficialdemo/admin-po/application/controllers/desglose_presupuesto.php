<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Desglose_presupuesto extends CI_Controller {

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
		$crud->set_table('tp_desglose_presupuesto');
		$crud->set_subject('Desglose');		
		$crud->set_language('spanish');
		$crud->fields(
		'id_desglose_presupuesto',
		'presupuesto',
		'id_concepto',
		'concepto',
		'cantidad',
		'porcentaje'
		);	
		
		$crud->columns('id_concepto','concepto','cantidad','porcentaje');		
		
		$crud->display_as('id_concepto','Clave del concepto');	
		
		$crud->required_fields( 'id_concepto',			
		'concepto',	
		'cantidad');				
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();								
		
		$crud->edit_fields('id_concepto','concepto','cantidad');	
		
		$crud->where('presupuesto',$id);			 							
		
		$crud->callback_after_update(array($this, 'actualizar_porcentaje'));
		
		$crud->callback_column('cantidad',array($this,'formato_dinero'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'presupuesto';
	    $data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$data['opcion_presupuesto'] = 'desglose';	  
	  	$this->load->view('opciones_presupuesto', $data);
		
		$data['nuevo_desglose'] = '';
		$data['id'] = $id;
		$this->load->view('opciones_banner_imagen_otros', $data);
		//$data['output'] = $output;
		//$data['opcion_medios'] = 'ver_todos';	
		$this->load->view('presupuesto',$output);
		
		$this->load->view('regresar');
		
		$this->load->view('pie');						
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  } 
  
  function formato_dinero($primary_key , $row)
  {	 
  	if($row->cantidad!=""){ 			
	return "$".number_format($row->cantidad);	
	}
  } 
  
  function actualizar_porcentaje($post_array,$primary_key)
	{
 	$this->modelo->actualizar_porcentaje($primary_key);
    return true;
	} 
	
   function agregar($id){
	 
		$this->modelo->borrar_desglose_presupuesto_temp();
		
		$data['opcion'] = 'presupuesto';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);				
				
		$data['id'] = $id;
		
		$data['presupuesto'] = $this->modelo->obtener_presupuesto($id);
   
		$this->load->view('nuevodesglosepresupuesto', $data);		
		
		$this->load->view('pie');	
					
  }
  
  function guardar(){
	  
	  $id = $this->input->post('id_presupuesto');
	  
	  $this->modelo->guardar_nuevo_desglose_presupuesto($id);
	  
	  $this->modelo->borrar_desglose_presupuesto_temp();
	  
	  //$this->modelo->actualizar_monto_factura($factura);
	  
	  redirect('desglose_presupuesto/principal/'.$id); 
	  	  
  } 
  
}