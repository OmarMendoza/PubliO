<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Contratos extends CI_Controller {

  function __construct()
  {
	
    parent::__construct();
	$this->load->helper('url');
	$this->load->library('grocery_crud');
	$this->load->database();
	$this->load->library(array('session'));
	$this->load->model('modelo');
	
	if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'administrador')
    {
       redirect(base_url().'index.php/login');
    }
	
    
		
  }

  function index()
  {    
    redirect('contratos/principal');			
  }
  
  function imprimir(){
	  $data['opcion'] = 'contratos';	  
	  $this->load->view('cabecera', $data);	  
  }  
  
  function principal(){	 
		try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_contratos');
		$crud->set_subject('contratos');		
		$crud->set_language('spanish');
		$crud->fields(			
		'fecha_celebracion',	
		'num_contrato',
		'monto_contrato',
		'monto_gastado',
		//'objeto_contrato',
		'fecha_inicio',
		'fecha_fin',
		//'archivo',
		'depen',
		'dependencia_aux',
		'medio',
		'medio_aux'//,		
		//'modalidad',
		//'motivoadj',
		//'partidapres'
		);
		
		$crud->columns('fecha_celebracion',	'num_contrato','monto_contrato','monto_gastado','fecha_inicio','fecha_fin',/*'archivo',*/'dependencia_aux','medio_aux'/*,'modalidad','motivoadj','partidapres'*/);
		
		$crud->add_fields('fecha_celebracion',	'num_contrato','monto_contrato','objeto_contrato','fecha_inicio','fecha_fin','archivo','depen','medio',
		'modalidad','motivoadj','partidapres');
		
		$crud->edit_fields('fecha_celebracion',	'num_contrato','monto_contrato','objeto_contrato','fecha_inicio','fecha_fin','archivo','depen','medio',
		'modalidad','motivoadj','partidapres');
		
		$crud->callback_column('dependencia_aux',array($this,'hacer_vinculo'));		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_medio'));		
		$crud->callback_column('monto_gastado',array($this,'obtener_monto_gastado'));		
		$crud->callback_column('monto_contrato',array($this,'formato_dinero_monto_contratado'));
		
		$crud->display_as('fecha_celebracion','Fecha de celebración')->display_as('num_contrato','Número de contrato')->display_as('fecha_inicio','Fecha inicial')->display_as('fecha_fin','Fecha de término')->display_as('depen','Dependencia')->display_as('motivoadj','Motivo de adjudicación')->display_as('partidapres','Partida presupuestal')->display_as('dependencia_aux','Dependencia')->display_as('medio_aux','Medio')->display_as('archivo','Contrato digitalizado');
		
		$crud->required_fields(
		'fecha_celebracion',
		'num_contrato',
		'monto_contrato',
		'objeto_contrato',		
		'fecha_inicio',
		'fecha_fin',	
		'depen',		
		'medio');
		
		$crud->callback_add_field('depen',array($this,'editar_dependencia_contratante'));		
		$crud->callback_edit_field('depen',array($this,'editar_dependencia_contratante'));				
		
		$crud->set_subject('contrato');
		
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->set_rules('monto_contrato','monto del contrato','integer');
			 
		
		$crud->add_action('Facturas del contrato',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
			
		$crud->set_relation('depen', 'tp_dependencia', 'dependencia');				
		$crud->set_relation('medio', 'tp_medios', 'nombre_comercial');		
		$crud->set_relation('modalidad', 'tp_modalidad_contratos', 'modalidad');		
		
		$crud->set_field_upload('archivo','archivos/contratos');
		
		$crud->callback_before_delete(array($this,'eliminar_contrato'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'contratos';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);	
		$data['opcion_contrato'] = 'ver_todo';
	    $this->load->view('opciones_contrato', $data);
		$this->load->view('contratos', $output);	
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
   public function eliminar_contrato($primary_key){
	  
    $this->modelo->borrar_contrato($primary_key);
    return true;
	
  }
  
  function formato_dinero_monto_contratado($primary_key , $row)
  {	 
  	if($row->monto_contrato!=""){ 			
	return "$".number_format($row->monto_contrato);	
	}
  }
  
  function editar_dependencia_contratante($value, $primary_key)
  {
	$contenido='';
	$dependencias = $this->modelo->dependencias_contratante_ambos();
	foreach($dependencias->result() as $fila) {
		$contenido=$contenido.'<option value="'.$fila->id_dependencia.'"';
		if($fila->id_dependencia==$value){
			$contenido=$contenido.' selected ';
		}
		$contenido=$contenido.'>'.$fila->dependencia.'</option>';
	}
    return '<select id="field-depen" name="depen" style="width:300px" >
	<option value="">Seleccione Dependencia</option>'.$contenido.'</select>';
  }
  
  function modificar_url_facturas($primary_key , $row)
  {
    return site_url('facturas/facturas_contrato').'/'.$row->id_contrato;
  }
  
  function modificar_url_detalle_registro($primary_key , $row)
  {
    return site_url('contratos/detalle_registro').'/'.$row->id_contrato;
  }
  
  function hacer_vinculo($primary_key , $row)
  {	
  	if($row->depen!=""){
	$dependencia=$this->modelo->obtener_nombre_dependencia($row->depen);
	$dependencia_aux=substr($dependencia,0, 40).'...';
	/*foreach($facturas->result() as $fila) { $num_factura=$fila->num_factura; }*/
    //return '<a class="ver_dependencia" href="javascript:void(0);" data-id="'.$row->depen.'" href="'.base_url().'index.php/dependencia/ver_dependencia/'.$row->depen.'">'.$dependencia.' </a>';
	
	return '<a class="ver_dependencia" href="javascript:void(0);" data-id="'.$row->depen.'" >'.$dependencia_aux.' </a> 
	<input type="hidden" id="nombre'.$row->depen.'" value="'.$dependencia.'" />';
	}
  } 
  
   function obtener_monto_gastado($primary_key , $row)
  {	
	$monto_gastado=$this->modelo->obtener_monto_gastado_contrato($row->id_contrato);
	
	/*foreach($facturas->result() as $fila) { $num_factura=$fila->num_factura; }*/
    //return '<a class="ver_dependencia" href="javascript:void(0);" data-id="'.$row->depen.'" href="'.base_url().'index.php/dependencia/ver_dependencia/'.$row->depen.'">'.$dependencia.' </a>';
	
	return "$".number_format($monto_gastado);
	
  }
  
  function hacer_vinculo_medio($primary_key , $row)
  {	
  	if($row->medio!=""){
	$medio=$this->modelo->obtener_nombre_medio($row->medio);
	$medio_aux=substr($medio,0, 40).'...';
	/*foreach($facturas->result() as $fila) { $num_factura=$fila->num_factura; }*/
    return '<a class="ver_medio" href="javascript:void(0);" data-id="'.$row->medio.'" >'.$medio_aux.' </a> 
	<input type="hidden" id="nombre_medio'.$row->medio.'" value="'.$medio.'" />';
	}
  } 
  
  function administracion(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_contratos');
		$crud->set_subject('contratos');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'fecha_celebracion',	
		'num_contrato',
		'monto_contrato',
		'monto_gastado',
		//'objeto_contrato',
		'fecha_inicio',
		'fecha_fin',
		//'archivo',
		'depen',
		'dependencia_aux',
		'medio',
		'medio_aux'//,		
		//'modalidad',
		//'motivoadj',
		//'partidapres'
		);
		
		$crud->columns('fecha_celebracion',	'num_contrato','monto_contrato','monto_gastado','fecha_inicio','fecha_fin'/*,'archivo'*/,'dependencia_aux','medio_aux'/*,'modalidad','motivoadj','partidapres'*/);
		
		$crud->add_fields('fecha_celebracion',	'num_contrato','monto_contrato','objeto_contrato','fecha_inicio','fecha_fin','archivo','depen','medio',
		'modalidad','motivoadj','partidapres');
		
		$crud->edit_fields('fecha_celebracion',	'num_contrato','monto_contrato','objeto_contrato','fecha_inicio','fecha_fin','archivo','depen','medio',
		'modalidad','motivoadj','partidapres');
		
		$crud->callback_column('dependencia_aux',array($this,'hacer_vinculo'));		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_medio'));		
		$crud->callback_column('monto_gastado',array($this,'obtener_monto_gastado'));		
		$crud->callback_column('monto_contrato',array($this,'formato_dinero_monto_contratado'));
		
		$crud->display_as('fecha_celebracion','Fecha de celebración')->display_as('num_contrato','Número de contrato')->display_as('fecha_inicio','Fecha inicial')->display_as('fecha_fin','Fecha de término')->display_as('depen','Dependencia')->display_as('motivoadj','Motivo de adjudicación')->display_as('partidapres','Partida presupuestal')->display_as('dependencia_aux','Dependencia')->display_as('medio_aux','Medio')->display_as('archivo','Contrato digitalizado');
		
		$crud->required_fields(
		'fecha_celebracion',
		'num_contrato',
		'monto_contrato',
		'objeto_contrato',		
		'fecha_inicio',
		'fecha_fin',	
		'depen',		
		'medio');
		
		$crud->callback_add_field('depen',array($this,'editar_dependencia_contratante'));
				
		$crud->callback_edit_field('depen',array($this,'editar_dependencia_contratante'));
				
		
		//$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_back_to_list();
		
		$crud->set_rules('monto_contrato','monto del contrato','integer');
			 
		//$crud->set_field_upload('archivo','../photos');		
		//$crud->callback_column('archivo',array($this,'obtener_imagen'));			
		//$crud->callback_after_upload(array($this,'obtener_imagen_upload'));
		
		$crud->add_action('Facturas del contrato',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
			
		$crud->set_relation('depen', 'tp_dependencia', 'dependencia');				
		$crud->set_relation('medio', 'tp_medios', 'nombre_comercial');		
		$crud->set_relation('modalidad', 'tp_modalidad_contratos', 'modalidad');
				
		$crud->set_field_upload('archivo','archivos/contratos');
		
		$crud->callback_before_delete(array($this,'eliminar_contrato'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'contratos';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);	
		$data['opcion_contrato'] = 'nuevo_contrato';
	    $this->load->view('opciones_contrato', $data);
		$this->load->view('contratos', $output);	
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}	
  }    
  
  function buscar(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_contratos');
		$crud->set_subject('contratos');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'fecha_celebracion',	
		'num_contrato',
		'monto_contrato',
		'monto_gastado',
		//'objeto_contrato',
		'fecha_inicio',
		'fecha_fin',
		//'archivo',
		'depen',
		'dependencia_aux',
		'medio',
		'medio_aux'//,	
		//'modalidad',
		//'motivoadj',
		//'partidapres'
		);
		
		$crud->columns('fecha_celebracion',	'num_contrato','monto_contrato','monto_gastado','fecha_inicio','fecha_fin'/*,'archivo'*/,'dependencia_aux','medio_aux'/*,'modalidad','motivoadj','partidapres'*/);
		
		$crud->edit_fields('fecha_celebracion',	'num_contrato','monto_contrato','objeto_contrato','fecha_inicio','fecha_fin','archivo','depen','medio',
		'modalidad','motivoadj','partidapres');
		
		$crud->callback_column('dependencia_aux',array($this,'hacer_vinculo'));		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_medio'));		
		$crud->callback_column('monto_gastado',array($this,'obtener_monto_gastado'));		
		$crud->callback_column('monto_contrato',array($this,'formato_dinero_monto_contratado'));
		
		$crud->display_as('fecha_celebracion','Fecha de celebración')->display_as('num_contrato','Número de contrato')->display_as('fecha_inicio','Fecha inicial')->display_as('fecha_fin','Fecha de término')->display_as('depen','Dependencia')->display_as('motivoadj','Motivo de adjudicación')->display_as('partidapres','Partida presupuestal')->display_as('dependencia_aux','Dependencia')->display_as('medio_aux','Medio')->display_as('archivo','Contrato digitalizado');
		
		$crud->required_fields(
		'fecha_celebracion',
		'num_contrato',
		'monto_contrato',
		'objeto_contrato',		
		'fecha_inicio',
		'fecha_fin',	
		'depen',		
		'medio');
		
		$crud->callback_add_field('depen',array($this,'editar_dependencia_contratante'));
		
		$crud->callback_edit_field('depen',array($this,'editar_dependencia_contratante'));		
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_back_to_list();				
			 
		//$crud->set_field_upload('archivo','../photos');		
		//$crud->callback_column('archivo',array($this,'obtener_imagen'));			
		 //$crud->callback_after_upload(array($this,'obtener_imagen_upload'));
		 
		 $crud->add_action('Facturas del contrato',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		 $crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
			
		$crud->set_relation('depen', 'tp_dependencia', 'dependencia');			
		$crud->set_relation('medio', 'tp_medios', 'nombre_comercial');		
		$crud->set_relation('modalidad', 'tp_modalidad_contratos', 'modalidad');
		
		$crud->set_field_upload('archivo','archivos/contratos');
		
		$dato = $this->input->post('buscar');				
		
		$crud->like('objeto_contrato',"$dato");	
		$crud->or_like('dependencia',"$dato");   
		
		$crud->callback_before_delete(array($this,'eliminar_contrato')); 
		
		$output = $crud->render();
		
		$data['opcion'] = 'contratos';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);	
		$data['opcion_contrato'] = 'buscar';
	    $this->load->view('opciones_contrato', $data);
		$this->load->view('contratos', $output);	
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
  function ver_contratos_medio($id){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_contratos');
		$crud->set_subject('contratos');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'fecha_celebracion',	
		'num_contrato',
		'monto_contrato',
		'monto_gastado',
		//'objeto_contrato',
		'fecha_inicio',
		'fecha_fin',
		//'archivo',
		'depen',
		'dependencia_aux',
		'medio',
		'medio_aux'//,		
		//'modalidad',
		//'motivoadj',
		//'partidapres'
		);
		
		$crud->columns('fecha_celebracion',	'num_contrato','monto_contrato','monto_gastado','fecha_inicio','fecha_fin'/*,'archivo'*/,'dependencia_aux','medio_aux'/*,'modalidad','motivoadj','partidapres'*/);
		
		$crud->edit_fields('fecha_celebracion',	'num_contrato','monto_contrato','objeto_contrato','fecha_inicio','fecha_fin','archivo','depen','medio',
		'modalidad','motivoadj','partidapres');
		
		$crud->callback_column('dependencia_aux',array($this,'hacer_vinculo_dependencia_medio'));		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_contrato_medio'));		
		$crud->callback_column('monto_gastado',array($this,'obtener_monto_gastado'));		
		$crud->callback_column('monto_contrato',array($this,'formato_dinero_monto_contratado'));
		
		$crud->display_as('fecha_celebracion','Fecha de celebración')->display_as('num_contrato','Número de contrato')->display_as('fecha_inicio','Fecha inicial')->display_as('fecha_fin','Fecha de término')->display_as('depen','Dependencia')->display_as('motivoadj','Motivo de adjudicación')->display_as('partidapres','Partida presupuestal')->display_as('dependencia_aux','Dependencia')->display_as('medio_aux','Medio')->display_as('archivo','Contrato digitalizado');
		
		$crud->required_fields(
		'fecha_celebracion',
		'num_contrato',
		'monto_contrato',
		'objeto_contrato',		
		'fecha_inicio',
		'fecha_fin',	
		'depen',		
		'medio');
		
		$crud->callback_add_field('depen',array($this,'editar_dependencia_contratante'));
		
		$crud->callback_edit_field('depen',array($this,'editar_dependencia_contratante'));
				
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_back_to_list();
		
		$crud->where('medio',$id);
			 
		//$crud->set_field_upload('archivo','../photos');		
		//$crud->callback_column('archivo',array($this,'obtener_imagen'));			
		 //$crud->callback_after_upload(array($this,'obtener_imagen_upload'));
		 
		 $crud->add_action('Facturas del contrato',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		 $crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
			
		$crud->set_relation('depen', 'tp_dependencia', 'dependencia');				
		$crud->set_relation('medio', 'tp_medios', 'nombre_comercial');		
		$crud->set_relation('modalidad', 'tp_modalidad_contratos', 'modalidad');
			
		
		$crud->set_field_upload('archivo','archivos/contratos');
		
		$crud->callback_before_delete(array($this,'eliminar_contrato'));		
		
		$output = $crud->render();
		
		$data['opcion'] = 'contratos';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$medio=$this->modelo->obtener_nombre_medio($id);
		$data['opcion_contrato'] = 'contratos_medio';
		$data['medio'] = $medio;
	    $this->load->view('opciones_contrato', $data);		
		$this->load->view('contratos', $output);
		
		$data['contratos_medio'] = '';
		$data['id'] = $id;
		$this->load->view('opciones_banner_imagen_otros', $data);	
		
		$this->load->view('regresar');
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
  function hacer_vinculo_dependencia_medio($primary_key , $row)
  {	
  	if($row->depen!=""){
	$dependencia=$this->modelo->obtener_nombre_dependencia($row->depen);
	$dependencia_aux=substr($dependencia,0, 40).'...';
	/*foreach($facturas->result() as $fila) { $num_factura=$fila->num_factura; }*/
    //return '<a class="ver_dependencia" href="javascript:void(0);" data-id="'.$row->depen.'" href="'.base_url().'index.php/dependencia/ver_dependencia/'.$row->depen.'">'.$dependencia.' </a>';
	
	return '<a class="ver_dependencia_campa" href="javascript:void(0);" data-id="'.$row->depen.'" >'.$dependencia_aux.' </a> 
	<input type="hidden" id="nombre'.$row->depen.'" value="'.$dependencia.'" />';
	}
  } 
  
  function hacer_vinculo_contrato_medio($primary_key , $row)
  {	
  	if($row->medio!=""){
	$medio=$this->modelo->obtener_nombre_medio($row->medio);
	$medio_aux=substr($medio,0, 40).'...';
	/*foreach($facturas->result() as $fila) { $num_factura=$fila->num_factura; }*/
    return '<a class="ver_contrato_medio" href="javascript:void(0);" data-id="'.$row->medio.'" >'.$medio_aux.' </a> 
	<input type="hidden" id="nombre_medio'.$row->medio.'" value="'.$medio.'" />';
	}
  } 
  
  function contrato_dependencia($id){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_contratos');
		$crud->set_subject('contratos');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'fecha_celebracion',	
		'num_contrato',
		'monto_contrato',
		'monto_gastado',
		//'objeto_contrato',
		'fecha_inicio',
		'fecha_fin',
		//'archivo',
		'depen',
		'dependencia_aux',
		'medio',
		'medio_aux'//,		
		//'modalidad',
		//'motivoadj',
		//'partidapres'
		);
		
		$crud->columns('fecha_celebracion',	'num_contrato','monto_contrato','monto_gastado','fecha_inicio','fecha_fin'/*,'archivo'*/,'dependencia_aux','medio_aux'/*,'modalidad','motivoadj','partidapres'*/);
		
		$crud->edit_fields('fecha_celebracion',	'num_contrato','monto_contrato','objeto_contrato','fecha_inicio','fecha_fin','archivo','depen','medio',
		'modalidad','motivoadj','partidapres');
		
		$crud->callback_column('dependencia_aux',array($this,'hacer_vinculo_dependencia_medio'));		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_contrato_medio'));		
		$crud->callback_column('monto_gastado',array($this,'obtener_monto_gastado'));		
		$crud->callback_column('monto_contrato',array($this,'formato_dinero_monto_contratado'));
			
		$crud->display_as('fecha_celebracion','Fecha de celebración')->display_as('num_contrato','Número de contrato')->display_as('fecha_inicio','Fecha inicial')->display_as('fecha_fin','Fecha de término')->display_as('depen','Dependencia')->display_as('motivoadj','Motivo de adjudicación')->display_as('partidapres','Partida presupuestal')->display_as('dependencia_aux','Dependencia')->display_as('medio_aux','Medio')->display_as('archivo','Contrato digitalizado');
		
		$crud->required_fields(
		'fecha_celebracion',
		'num_contrato',
		'monto_contrato',
		'objeto_contrato',		
		'fecha_inicio',
		'fecha_fin',	
		'depen',		
		'medio');
		
		$crud->callback_add_field('depen',array($this,'editar_dependencia_contratante'));
		
		$crud->callback_edit_field('depen',array($this,'editar_dependencia_contratante'));				
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->where('depen',$id);
			 
		 
		 $crud->set_field_upload('archivo','archivos/contratos');
			
		$crud->add_action('Facturas del contrato',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
		
		$crud->set_relation('depen', 'tp_dependencia', 'dependencia');				
		$crud->set_relation('medio', 'tp_medios', 'nombre_comercial');		
		$crud->set_relation('modalidad', 'tp_modalidad_contratos', 'modalidad');
		
		$crud->callback_before_delete(array($this,'eliminar_contrato'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'contratos';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$dependencia=$this->modelo->obtener_nombre_dependencia($id);	
		$data['opcion_contrato'] = 'contratos_dependencia';
		$data['dependencia'] = $dependencia;
	    $this->load->view('opciones_contrato', $data);			
			
		$this->load->view('contratos', $output);
		
		$data['contratos_dependencia'] = '';
		$data['id'] = $id;
		$this->load->view('opciones_banner_imagen_otros', $data);
		
		$this->load->view('regresar');		
		
		$this->load->view('pie');
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
  function detalle_registro($id){	 
		$data['opcion'] = 'contratos';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);
		$data['opcion_contrato'] = 'detalle_registro';	  
	  	$this->load->view('opciones_contrato', $data);
		$detalleregistrocontrato=$this->modelo->registro_contrato($id);	
		$data['detalleregistrocontrato'] = $detalleregistrocontrato;
		$this->load->view('detalleregistrocontrato', $data);	
		$this->load->view('pie');				
  }
  
  
  
  
}