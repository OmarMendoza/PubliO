<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Presupuesto extends CI_Controller {

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
    redirect('presupuesto/principal');			
  }   
  
  function principal(){	    		 		
		try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_presupuesto');
		$crud->set_subject('presupuesto');		
		$crud->set_language('spanish');
		$crud->fields(
		'id_presupuesto',			
		   'anio',	
		'monto_total'
		);
		
		$crud->edit_fields('anio',	
		'monto_total');
		
		$crud->columns('anio','monto_total');
		
		$crud->display_as('anio','Año')->display_as('monto_total','Monto total');
		
		$crud->required_fields( 'anio',	
		'monto_total');
				
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->set_subject('presupuesto');
		
		$crud->add_action('Desglose del presupuesto',base_url().'imagenes/detalle.png','','',array($this,'modificar_url_desglose'));
		
		$crud->callback_column('monto_total',array($this,'formato_dinero'));
		
		$crud->callback_before_delete(array($this,'eliminar_presupuesto'));	
		
		$crud->callback_edit_field('anio',array($this,'editar_anio_presupuesto'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'presupuesto';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$data['opcion_presupuesto'] = 'ver_presupuesto';	  
	  	$this->load->view('opciones_presupuesto', $data);
		$this->load->view('presupuesto',$output);
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
							
  } 
  
  function editar_anio_presupuesto($value,$primary_key)
  {
	$contenido='';
	$anio=$value;
	
	for ($i = date("Y")+2 ; $i >= date("Y")-10; $i--) {		
		if($i==$anio){
			$contenido=$contenido.'<option value="'.$i.'" selected >'.$i.'</option>';
		}
		else{
			$contenido=$contenido.'<option value="'.$i.'" >'.$i.'</option>';
		}        
    }

    return '<select id="field-anio" name="anio" style="width:300px" >'.$contenido.'</select>';
  } 
  
  function buscar(){	    		 		
		try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_presupuesto');
		$crud->set_subject('presupuesto');		
		$crud->set_language('spanish');
		$crud->fields(
		'id_presupuesto',			
		   'anio',	
		'monto_total'
		);
		
		$crud->edit_fields('anio',	
		'monto_total');
		
		$crud->columns('anio','monto_total');
		
		$crud->display_as('anio','Año')->display_as('monto_total','Monto total');
		
		$crud->required_fields( 'anio',	
		'monto_total');
				
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->set_subject('presupuesto');
		
		$crud->add_action('Desglose del presupuesto',base_url().'imagenes/detalle.png','','',array($this,'modificar_url_desglose'));
		
		$crud->callback_column('monto_total',array($this,'formato_dinero'));
		
		$crud->callback_before_delete(array($this,'eliminar_presupuesto'));	
		
		$crud->callback_edit_field('anio',array($this,'editar_anio_presupuesto'));
		
		$dato = $this->input->post('buscar');				
		
		$crud->like('anio',"$dato");
	    $crud->or_like('monto_total',"$dato");		
		
		$output = $crud->render();
		
		$data['opcion'] = 'presupuesto';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional(); 
	  	$this->load->view('cabecera', $data);
		$data['opcion_presupuesto'] = 'ver_presupuesto';	  
	  	$this->load->view('opciones_presupuesto', $data);
		$this->load->view('presupuesto',$output);
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
							
  }
  
  public function eliminar_presupuesto($primary_key){
	  
    $this->modelo->borrar_presupuesto($primary_key);
    return true;
	
  }
  
  function modificar_url_desglose($primary_key , $row)
  {
    return site_url('desglose_presupuesto/principal').'/'.$row->id_presupuesto;
  } 
  
  function nuevo(){
	    $this->modelo->borrar_desglose_presupuesto_temp();
	  	$data['opcion'] = 'presupuesto';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$data['opcion_presupuesto'] = 'nuevo_presupuesto';	  
	  	$this->load->view('opciones_presupuesto', $data);
		$this->load->view('nuevopresupuesto');
		$this->load->view('pie');
  }
  
  function guardar(){
	  $anio = $this->input->post('anio');	 
	  $monto_total = $this->input->post('monto_total');	  	  		  
	  
	  $datos = array(
			'anio' => $anio ,			
			'monto_total' => $monto_total
	   );
	   
	   $resultado=$this->modelo->ver_si_existe($anio);
	   
	   if($resultado->num_rows() == 0){	   
	   $this->modelo->guardar_presupuesto($datos);
	   $this->modelo->guardar_desglose_presupuesto();	   	   
	   $this->modelo->borrar_desglose_presupuesto_temp();	   	       
	   redirect('presupuesto/principal');
	   }	   
	   else{
		    $data['opcion'] = 'presupuesto';
			$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));	  
			$this->load->view('cabecera', $data);
			$data['opcion_presupuesto'] = 'nuevo_presupuesto';
			$data['mensaje'] = 'Ya existe un presupuesto para este año';	  
			$this->load->view('opciones_presupuesto', $data);
			$this->load->view('nuevopresupuesto', $data );
			$this->load->view('pie');			
	   }
  }
  
  function formato_dinero($primary_key , $row)
  {	 
  	if($row->monto_total!=""){ 			
	return "$".number_format($row->monto_total);	
	}
  }
  
}