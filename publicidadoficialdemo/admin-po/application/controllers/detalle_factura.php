<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Detalle_factura extends CI_Controller {

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
		$crud->set_table('tp_detalle_factura');
		$crud->set_subject('Desglose');		
		$crud->set_language('spanish');
		$crud->fields(
		'factura',
		'factura_aux',			
		'contrato',					
		'concepto',			
		   'unidades',
		   'monto_concepto',
		   'dependencia_s',
		   'campa_factura'
		);
		
		$crud->display_as('dependencia_s','Dependencia solicitante')->display_as('campa_factura','Campaña')->display_as('factura_aux','Factura')->display_as('concepto','Subconcepto')->display_as('monto_concepto','Monto subconcepto');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();				
		
		$crud->columns('factura','concepto','unidades','monto_concepto','dependencia_s','campa_factura');
		
		$crud->edit_fields('concepto','unidades','monto_concepto','dependencia_s','campa_factura');	
		
		$crud->required_fields( 'concepto',			
		'unidades',	
		'monto_concepto',						
		'dependencia_s',
		   'campa_factura');
		
		 $crud->callback_edit_field('dependencia_s',array($this,'editar_dependencia_solicitante'));		 		 
		 
		 $crud->callback_edit_field('campa_factura',array($this,'editar_campa'));	
		 
		 $crud->callback_column('monto_concepto',array($this,'formato_dinero_monto_concepto'));
		 				
		
		
		$crud->where('factura',$id);
			 
		
		$crud->set_relation('factura', 'tp_factura', 'num_factura');
		
		$crud->set_relation('dependencia_s', 'tp_dependencia', 'dependencia');
		
		$crud->set_relation('campa_factura', 'tp_campa', 'nombre');
		
		
		$crud->callback_after_upload(array($this,'obtener_imagen_upload'));	
									
		
		$output = $crud->render();
		
		$data['opcion'] = 'facturas';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);
		$data['opcion_factura'] = 'detalle_factura';
		
		$num_factura="";
		$facturas = $this->modelo->obtener_numero_factura($id);	
		foreach($facturas->result() as $fila) { $num_factura=$fila->num_factura; }
	    $data['num_factura'] = $num_factura;
		
	    $this->load->view('opciones_facturas', $data);	
		
		$data['nuevo_detalle'] = '';
		$data['id'] = $id;
		$this->load->view('opciones_banner_imagen_otros', $data);
		
		$totales = $this->modelo->totales_detalle_factura($id);
		$data['totales'] = $totales;
		$this->load->view('total_detalle_factura', $data);	
		
		$this->load->view('factura', $output);	
		
		$this->load->view('regresar');
		
		$this->load->view('pie');							
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }  
  
  function formato_dinero_monto_concepto($primary_key , $row)
  {	 
  	if($row->monto_concepto!=""){ 			
	return "$".number_format($row->monto_concepto);	
	}
  }
  
  function facturas_campa($id){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_detalle_factura');
		$crud->set_subject('Desglose');		
		$crud->set_language('spanish');
		$crud->fields(
		'factura',
		'factura_aux',
		'medio',
		'dependencia_contratante',	
		'contrato',					
		'concepto',			
		   'unidades',
		   'monto_concepto',
		   'dependencia_s',
		   'campa_factura'
		);
		
		$crud->display_as('dependencia_s','Dependencia solicitante')->display_as('campa_factura','Campaña')->display_as('factura_aux','Factura')->display_as('concepto','Subconcepto')->display_as('monto_concepto','Monto subconcepto');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();				
		
		$crud->columns('factura','medio','dependencia_contratante','concepto','unidades','monto_concepto');
		
		$crud->edit_fields('concepto','unidades','monto_concepto','dependencia_s','campa_factura');	
		
		$crud->required_fields( 'concepto',			
		'unidades',	
		'monto_concepto',						
		'dependencia_s',
		   'campa_factura');
		
		 $crud->callback_edit_field('dependencia_s',array($this,'editar_dependencia_solicitante'));		 		 
		 
		 $crud->callback_edit_field('campa_factura',array($this,'editar_campa'));	
		 				
		
		
		$crud->where('campa_factura',$id);
			 
		
		$crud->set_relation('factura', 'tp_factura', 'num_factura');
		
		$crud->set_relation('dependencia_s', 'tp_dependencia', 'dependencia');
		
		$crud->set_relation('campa_factura', 'tp_campa', 'nombre');
		
		
		$crud->callback_after_upload(array($this,'obtener_imagen_upload'));	
		
		
		$crud->callback_column('medio',array($this,'hacer_vinculo_medio'));	
		
		$crud->callback_column('dependencia_contratante',array($this,'hacer_vinculo_dependencia_contratante'));		
		
		$crud->callback_column('monto_concepto',array($this,'formato_dinero_monto_concepto'));					
								
		
		$output = $crud->render();
		
		$data['opcion'] = 'facturas';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$data['opcion_factura'] = 'detalle_factura';
		
		$num_factura="";
		$facturas = $this->modelo->obtener_numero_factura($id);	
		foreach($facturas->result() as $fila) { $num_factura=$fila->num_factura; }
	    $data['num_factura'] = $num_factura;
		
	    $this->load->view('opciones_facturas', $data);	
		
		$data['nuevo_detalle'] = '';
		$data['id'] = $id;
		$this->load->view('opciones_banner_imagen_otros', $data);
		
		$totales = $this->modelo->totales_detalle_factura_campa($id);
		$data['totales'] = $totales;
		$this->load->view('total_detalle_factura', $data);	
		
		$this->load->view('factura', $output);	
		
		$this->load->view('regresar');
		
		$this->load->view('pie');							
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
    
  
  function editar_dependencia_solicitante($value, $primary_key)
  {
	$contenido='';
	$dependencias = $this->modelo->dependencias_solicitante_ambos();
	foreach($dependencias->result() as $fila) {
		$contenido=$contenido.'<option value="'.$fila->id_dependencia.'"';
		if($fila->id_dependencia==$value){
			$contenido=$contenido.' selected ';
		}
		$contenido=$contenido.'>'.$fila->dependencia.'</option>';
	}
    return '<select id="field-dependencia_s" name="dependencia_s" style="width:300px" onchange="consultar_editar_campa()" >
	<option value="">Seleccione Dependencia</option>'.$contenido.'</select>';
  }    
  
  function editar_campa($value, $primary_key)
  {
	$contenido='';
	$campas = $this->modelo->campas_dependencia($primary_key);
	foreach($campas->result() as $fila) {
		$contenido=$contenido.'<option value="'.$fila->id_campa.'"';
		if($fila->id_campa==$value){
			$contenido=$contenido.' selected ';
		}
		$contenido=$contenido.'>'.$fila->nombre.'</option>';
	}
	
	return '<select id="field-campa_factura" name="campa_factura" style="width:300px" >
	<option value="">Seleccione Dependencia</option>'.$contenido.'</select>';
  }
  
  function hacer_vinculo($primary_key , $row)
  {
	$num_factura="";
	$facturas=$this->modelo->obtener_numero_factura($row->factura);
	foreach($facturas->result() as $fila) { $num_factura=$fila->num_factura; }
    return '<a href="'.base_url().'index.php/detalle_factura/principal/'.$row->factura.'">'.$num_factura.' </a>';
  }   
  
   function hacer_vinculo_medio($primary_key , $row)
  {	
	$id_medio=$this->modelo->obtener_id_medio_factura($row->factura);
	$nombre_medio=$this->modelo->obtener_nombre_medio($id_medio);
	
	$nombre_medio=substr($nombre_medio,0, 40).'...';
	
    return '<a class="ver_contrato_medio" href="javascript:void(0);" data-id="'.$id_medio.'" >'.$nombre_medio.'</a> 
	<input type="hidden" id="nombre_medio'.$id_medio.'" value="'.$nombre_medio.'" />';
  } 
  
  function hacer_vinculo_dependencia_contratante($primary_key , $row)
  {	
	$id_dependencia=$this->modelo->obtener_id_dependencia_factura($row->factura);
	$dependencia_contratante=$this->modelo->obtener_nombre_dependencia($id_dependencia);
	
	$dependencia_contratante=substr($dependencia_contratante,0, 40).'...';
    return '<a class="ver_dependencia_campa" href="javascript:void(0);" data-id="'.$id_dependencia.'" >'.$dependencia_contratante.'</a> 
	<input type="hidden" id="nombre_medio'.$id_dependencia.'" value="'.$dependencia_contratante.'" />';
  }      
  
  function agregar($id){
	 
		$this->modelo->borrar_detalle_factura_temp();
		
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
		$dependencias = $this->modelo->dependencias_solicitante_ambos();	
    	$data['dependencias'] = $dependencias;			
		$this->load->view('nuevodetalle', $data);		
		
		$this->load->view('pie');	
					
  } 
  
  function guardar(){
	  $factura = $this->input->post('factura');
	  $factura = $this->modelo->obtener_id_factura($factura);
	  
	  $this->modelo->guardar_nuevo_detalle($factura);
	  
	  $this->modelo->borrar_detalle_factura_temp();
	  
	  $this->modelo->actualizar_monto_factura($factura);
	  
	  redirect('detalle_factura/principal/'.$factura); 
	  	  
  }  
  
}