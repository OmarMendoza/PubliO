<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Facturas extends CI_Controller {

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
    redirect('facturas/principal');			
  }
  
  function imprimir(){
	  $data['opcion'] = 'facturas';	  
	  $this->load->view('cabecera', $data);	  
  }
  
  function nuevo(){
	  $data['opcion'] = 'facturas';
	  	$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  $this->load->view('cabecera', $data);
	  $data['opcion_factura'] = 'nueva_factura';
	  $this->load->view('opciones_facturas', $data);	
	  
	  $this->modelo->borrar_detalle_factura_temp();
	  $this->modelo->borrar_imagenes_factura_temp();
	  
	  $campas = $this->modelo->campas();	
	  $data['campas'] = $campas; 
	  $medios = $this->modelo->medios();	
	  $data['medios'] = $medios;
	  $contratos = $this->modelo->contratos();	
	  $data['contratos'] = $contratos;
	  
	  $dependencias = $this->modelo->dependencias_contratante_ambos();	
	  $data['dependencias'] = $dependencias;	
	  
	  $dependencias_solicitantes = $this->modelo->dependencias_solicitante_ambos();	
	  $data['dependencias_solicitantes'] = $dependencias_solicitantes;	
	    
	  $this->load->view('nuevafactura', $data);	
	  
	  $this->load->view('pie');
	  
  }
  
    function principal(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_factura');
		$crud->set_subject('factura');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'num_factura',
		   'fecha',	
		'concepto_general',
		'monto_total',
		'dependencia_contratante',
		'dependencia_contratante_aux',
		'medio_id',
		'medio_aux',
		'contrato',
		'contrato_aux'
		);
		
		$crud->columns('num_factura','fecha','concepto_general','monto_total','dependencia_contratante_aux','medio_aux','contrato_aux');
		
		$crud->edit_fields('num_factura','fecha','concepto_general','monto_total','medio_id','dependencia_contratante','contrato');
		
		$crud->callback_column('dependencia_contratante_aux',array($this,'hacer_vinculo'));
		
		$crud->callback_column('contrato_aux',array($this,'hacer_vinculo_contrato'));
		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_medio'));
		
		$crud->callback_column('monto_total',array($this,'formato_dinero_monto_total'));
		
		$crud->display_as('num_factura','Número de factura')->display_as('dependencia_contratante_aux','Dependencia contratante')->display_as('contrato_aux','Contrato')->display_as('medio_aux','Medio')->display_as('medio_id','Medio');
		
		$crud->required_fields( 'num_factura',
		'fecha',			
		'concepto_general',	
		'monto_total',						
		'dependencia_contratante',
		'medio_id',
		'contrato');
				
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_back_to_list();
		
		 $crud->callback_edit_field('dependencia_contratante',array($this,'editar_dependencia_contratante'));
		 
		 $crud->callback_edit_field('medio_id',array($this,'editar_medio'));
		 
		 $crud->callback_edit_field('contrato',array($this,'editar_contrato'));
			 
		
		 
		 $crud->add_action('Desglose de la factura',base_url().'imagenes/detalle.png','','',array($this,'modificar_url_detalle'));		 

		 $crud->add_action('Factura digitalizada',base_url().'imagenes/imagenes.png','','',array($this,'modificar_url_imagenes'));	
			
	$crud->set_relation('dependencia_contratante', 'tp_dependencia', 'dependencia');		
	$crud->set_relation('medio_id', 'tp_medios', 'nombre_comercial');	
	$crud->set_relation('contrato', 'tp_contratos', 'num_contrato');
	
		$crud->callback_before_delete(array($this,'eliminar_factura'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'facturas';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional(); 
	  	$this->load->view('cabecera', $data);
		$data['opcion_factura'] = 'ver_todo';
	  $this->load->view('opciones_facturas', $data);	
		$this->load->view('factura', $output);	
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
   public function eliminar_factura($primary_key){
	  
    $this->modelo->borrar_factura($primary_key);
    return true;
	
  }
  
  function formato_dinero_monto_total($primary_key , $row)
  {	 
  	if($row->monto_total!=""){ 			
	return "$".number_format($row->monto_total);	
	}
  }
  
   function editar_medio($value, $primary_key)
  {
	$contenido='';
	$medios = $this->modelo->medios();
	
	foreach($medios->result() as $fila) {          
		$contenido=$contenido.'<option value="'.$fila->id_medio.'"';
		if($fila->id_medio==$value){
			$contenido=$contenido.' selected ';
		}
		$contenido=$contenido.'>'.$fila->nombre_comercial.'</option>';     
	} 
	
    return '<select id="field-medio_id" name="medio_id" style="width:300px" onChange="borrar_editar_contrato_dependencia()">
	<option value="">Seleccione Medio</option>'.$contenido.'</select>';	    
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
    return '<select id="field-dependencia_contratante" name="dependencia_contratante" style="width:300px" onChange="consultar_editar_contratos()">
	<option value="">Seleccione Dependencia</option>'.$contenido.'</select>';
  }    
  
  function editar_contrato($value, $primary_key)
  {
	$contenido='';
	$contratos = $this->modelo->contratos_medio_dependencia($primary_key);
	foreach($contratos->result() as $fila) {
		$contenido=$contenido.'<option value="'.$fila->id_contrato.'"';
		if($fila->id_contrato==$value){
			$contenido=$contenido.' selected ';
		}
		$contenido=$contenido.'>'.$fila->num_contrato.'</option>';
	}

	
    return '<select id="field-contrato" name="contrato" style="width:300px">
	<option value="">Seleccione Contrato</option>'.$contenido.'</select>';	    
  }
  
  function hacer_vinculo($primary_key , $row)
  {	
  	
	$dependencia=$this->modelo->obtener_nombre_dependencia($row->dependencia_contratante);
	$dependencia_aux=substr($dependencia,0, 40).'...';
	
	return '<a class="ver_dependencia" href="javascript:void(0);" data-id="'.$row->dependencia_contratante.'" >'.$dependencia_aux.' </a> 
	<input type="hidden" id="nombre'.$row->dependencia_contratante.'" value="'.$dependencia.'" />';
	
	
  } 
  
  function hacer_vinculo_contrato($primary_key , $row)
  {	
  	if($row->contrato!=""){
		
	$contrato=$this->modelo->obtener_numero_contrato($row->contrato);		
	
	return '<a class="ver_contrato" href="javascript:void(0);" data-id="'.$row->contrato.'" >'.$contrato.' </a> 
	<input type="hidden" id="contrato'.$row->contrato.'" value="'.$contrato.'" />';
	
	}
  } 
  
   function hacer_vinculo_medio($primary_key , $row)
  {	
  	
	$medio=$this->modelo->obtener_nombre_medio($row->medio_id);
	$medio_aux=substr($medio,0, 40).'...';
 
    return '<a class="ver_medio" href="javascript:void(0);" data-id="'.$row->medio_id.'" >'.$medio_aux.' </a> 
	<input type="hidden" id="nombre_medio'.$row->medio_id.'" value="'.$medio.'" />';
	
  } 
  
  
  function modificar_url_detalle($primary_key , $row)
  {
    return site_url('detalle_factura/principal').'/'.$row->id_factura;
  }
  
  function modificar_url_imagenes($primary_key , $row)
  {
    return site_url('imagenes_factura/principal').'/'.$row->id_factura;
  }
  function modificar_url_imagenes_testigo($primary_key , $row)
  {
    return site_url('imagenes_testigo_factura/principal').'/'.$row->id_factura;
  }
  
  
  function administracion(){
	   try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_factura');
		$crud->set_subject('factura');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'num_factura',
		   'fecha',	
		'concepto_general',
		'monto_total',
		'dependencia_contratante',
		'dependencia_contratante_aux',
		'medio_id',
		'medio_aux',
		'contrato',
		'contrato_aux'
		);
		
		$crud->columns('num_factura','fecha','concepto_general','monto_total','dependencia_contratante_aux','medio_aux','contrato_aux');
		
		$crud->edit_fields('num_factura','fecha','concepto_general','monto_total','medio_id','dependencia_contratante','contrato');
		
		$crud->callback_column('dependencia_contratante_aux',array($this,'hacer_vinculo'));
		
		$crud->callback_column('contrato_aux',array($this,'hacer_vinculo_contrato'));
		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_medio'));
		
		$crud->callback_column('monto_total',array($this,'formato_dinero_monto_total'));
		
		$crud->display_as('num_factura','Número de factura')->display_as('dependencia_contratante_aux','Dependencia contratante')->display_as('contrato_aux','Contrato')->display_as('medio_aux','Medio')->display_as('medio_id','Medio');
		
		$crud->required_fields( 'num_factura',
		'fecha',			
		'concepto_general',	
		'monto_total',						
		'dependencia_contratante',
		'medio_id',
		'contrato');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();	
		
		$crud->callback_edit_field('dependencia_contratante',array($this,'editar_dependencia_contratante'));
		 
		 $crud->callback_edit_field('medio_id',array($this,'editar_medio'));
		 
		 $crud->callback_edit_field('contrato',array($this,'editar_contrato'));		
			 
			
		$crud->set_relation('dependencia_contratante', 'tp_dependencia', 'dependencia');		
		$crud->set_relation('medio_id', 'tp_medios', 'nombre_comercial');
		$crud->set_relation('contrato', 'tp_contratos', 'num_contrato');
		
		$crud->add_action('Desglose de la factura',base_url().'imagenes/detalle.png','','',array($this,'modificar_url_detalle'));		 

		 $crud->add_action('Factura digitalizada',base_url().'imagenes/imagenes.png','','',array($this,'modificar_url_imagenes'));								
		
		$crud->callback_before_delete(array($this,'eliminar_factura'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'facturas';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional(); 
	  	$this->load->view('cabecera', $data);
		$data['opcion_factura'] = 'ver_todo';
	  $this->load->view('opciones_facturas', $data);	
		$this->load->view('factura', $output);	
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
  }    
  
  function buscar(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_factura');
		$crud->set_subject('factura');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'num_factura',
		   'fecha',	
		'concepto_general',
		'monto_total',
		'dependencia_contratante',
		'dependencia_contratante_aux',
		'medio_id',
		'medio_aux',
		'contrato',
		'contrato_aux'
		);
		
		$crud->columns('num_factura','fecha','concepto_general','monto_total','dependencia_contratante_aux','medio_aux','contrato_aux');
		
		$crud->edit_fields('num_factura','fecha','concepto_general','monto_total','medio_id','dependencia_contratante','contrato');
		
		$crud->callback_column('dependencia_contratante_aux',array($this,'hacer_vinculo'));
		
		$crud->callback_column('contrato_aux',array($this,'hacer_vinculo_contrato'));
		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_medio'));
		
		$crud->callback_column('monto_total',array($this,'formato_dinero_monto_total'));
		
		$crud->display_as('num_factura','Número de factura')->display_as('dependencia_contratante_aux','Dependencia contratante')->display_as('contrato_aux','Contrato')->display_as('medio_aux','Medio')->display_as('medio_id','Medio');
		
		$crud->required_fields( 'num_factura',
		'fecha',			
		'concepto_general',	
		'monto_total',						
		'dependencia_contratante',
		'medio_id',
		'contrato');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->callback_edit_field('dependencia_contratante',array($this,'editar_dependencia_contratante'));
		 
		 $crud->callback_edit_field('medio_id',array($this,'editar_medio'));
		 
		 $crud->callback_edit_field('contrato',array($this,'editar_contrato'));		
			 
			
		$crud->set_relation('dependencia_contratante', 'tp_dependencia', 'dependencia');		
		$crud->set_relation('medio_id', 'tp_medios', 'nombre_comercial');
		$crud->set_relation('contrato', 'tp_contratos', 'num_contrato');
		
		$crud->add_action('Desglose de la factura',base_url().'imagenes/detalle.png','','',array($this,'modificar_url_detalle'));		 

		 $crud->add_action('Factura digitalizada',base_url().'imagenes/imagenes.png','','',array($this,'modificar_url_imagenes'));					
		
		$dato = $this->input->post('buscar');				
		
		$crud->like('num_factura',"$dato");
	    $crud->or_like('dependencia',"$dato");
		$crud->or_like('nombre_comercial',"$dato");
		$crud->or_like('num_contrato',"$dato");
		
		$crud->callback_before_delete(array($this,'eliminar_factura'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'facturas';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$data['opcion_factura'] = 'buscar';
	  $this->load->view('opciones_facturas', $data);	
		$this->load->view('factura', $output);		
		
		$this->load->view('pie');
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
  function guardar(){
	  $num_factura = $this->input->post('num_factura');
	  $concepto_general = $this->input->post('concepto_general');
	  $monto_total = $this->input->post('monto_total');
	  $medio = $this->input->post('medios');
	  $medio = $this->modelo->obtener_id_medio($medio);
	  
	  $contrato = $this->input->post('aux_contrato');	 	   
	  $contrato = $this->modelo->obtener_id_contrato($contrato);
	  
	  $dependencia_c = $this->input->post('dependencia_c');	
	  $dependencia_c = $this->modelo->obtener_id_dependencia($dependencia_c);	
	  
	  $fecha = $this->input->post('fecha');
	  list($dia,$mes,$anio)=explode("/",$fecha);
	  $fecha=$anio."/".$mes."/".$dia;	  	
	  
	  
	  $datos = array(
			'num_factura' => $num_factura ,
			'concepto_general' => $concepto_general ,
			'monto_total' => $monto_total,
			'dependencia_contratante' => $dependencia_c ,
			'medio_id' => $medio,
			'contrato' => $contrato,
			'fecha' => $fecha
	   );
	   
	   $this->modelo->guardar_factura($datos);
	   $this->modelo->guardar_detalle_factura();
	   $this->modelo->guardar_imagenes_factura();
	   //$this->modelo->guardar_imagenes_testigo_factura();
	   
	   $this->modelo->borrar_detalle_factura_temp();
	   $this->modelo->borrar_imagenes_factura_temp();
	  //$this->modelo->borrar_imagenes_testigo_factura_temp();
	   
	    
	  redirect('facturas/principal');
  }
  
  function facturas_medio($id){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_factura');
		$crud->set_subject('factura');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'num_factura',
		   'fecha',	
		'concepto_general',
		'monto_total',
		'dependencia_contratante',
		'dependencia_contratante_aux',
		'medio_id',
		'medio_aux',
		'contrato',
		'contrato_aux'
		);
		
		$crud->columns('num_factura','fecha','concepto_general','monto_total','dependencia_contratante_aux','medio_aux','contrato_aux');
		
		$crud->edit_fields('num_factura','fecha','concepto_general','monto_total','medio_id','dependencia_contratante','contrato');
		
		$crud->callback_column('dependencia_contratante_aux',array($this,'hacer_vinculo_dependencia_medio'));
		
		$crud->callback_column('contrato_aux',array($this,'hacer_vinculo_contrato_factura'));
		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_contrato_medio'));
		
		$crud->callback_column('monto_total',array($this,'formato_dinero_monto_total'));
		
		$crud->display_as('num_factura','Número de factura')->display_as('dependencia_contratante_aux','Dependencia contratante')->display_as('contrato_aux','Contrato')->display_as('medio_aux','Medio')->display_as('medio_id','Medio');
		
		$crud->required_fields( 'num_factura',
		'fecha',			
		'concepto_general',	
		'monto_total',						
		'dependencia_contratante',
		'medio_id',
		'contrato');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_back_to_list();
		
		$crud->callback_edit_field('dependencia_contratante',array($this,'editar_dependencia_contratante'));
		 
		 $crud->callback_edit_field('medio_id',array($this,'editar_medio'));
		 
		 $crud->callback_edit_field('contrato',array($this,'editar_contrato'));					 
		
		$crud->where('medio_id',$id);
			 
		 
		 $crud->add_action('Desglose de la factura',base_url().'imagenes/detalle.png','','',array($this,'modificar_url_detalle'));		 
	
		 $crud->add_action('Factura digitalizada',base_url().'imagenes/imagenes.png','','',array($this,'modificar_url_imagenes'));	
			
	$crud->set_relation('dependencia_contratante', 'tp_dependencia', 'dependencia');		
	$crud->set_relation('medio_id', 'tp_medios', 'nombre_comercial');	
	$crud->set_relation('contrato', 'tp_contratos', 'num_contrato');
	
		$crud->callback_before_delete(array($this,'eliminar_factura'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'facturas';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional(); 
	  	$this->load->view('cabecera', $data);
		$data['opcion_factura'] = 'facturas_medio';
		$medio=$this->modelo->obtener_nombre_medio($id);
		$data['medio'] = $medio;		
	    $this->load->view('opciones_facturas', $data);	
		$this->load->view('factura', $output);	
		
		$data['facturas_medio'] = '';
		$data['id'] = $id;
		$this->load->view('opciones_banner_imagen_otros', $data);
		
		$this->load->view('regresar');
		
		$this->load->view('pie');		
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }        
  
  function facturas_contrato($id){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_factura');
		$crud->set_subject('factura');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'num_factura',
		   'fecha',	
		'concepto_general',
		'monto_total',
		'dependencia_contratante',
		'dependencia_contratante_aux',
		'medio_id',
		'medio_aux',
		'contrato',
		'contrato_aux'
		);
		
		$crud->columns('num_factura','fecha','concepto_general','monto_total','dependencia_contratante_aux','medio_aux','contrato_aux');
		
		$crud->edit_fields('num_factura','fecha','concepto_general','monto_total','medio_id','dependencia_contratante','contrato');
		
		$crud->callback_column('dependencia_contratante_aux',array($this,'hacer_vinculo_dependencia_medio'));
		
		$crud->callback_column('contrato_aux',array($this,'hacer_vinculo_contrato_factura'));
		
		$crud->callback_column('medio_aux',array($this,'hacer_vinculo_contrato_medio'));
		
		$crud->callback_column('monto_total',array($this,'formato_dinero_monto_total'));
		
		$crud->display_as('num_factura','Número de factura')->display_as('dependencia_contratante_aux','Dependencia contratante')->display_as('contrato_aux','Contrato')->display_as('medio_aux','Medio')->display_as('medio_id','Medio');
		
		$crud->required_fields( 'num_factura',
		'fecha',			
		'concepto_general',	
		'monto_total',						
		'dependencia_contratante',
		'medio_id',
		'contrato');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->callback_edit_field('dependencia_contratante',array($this,'editar_dependencia_contratante'));
		 
		 $crud->callback_edit_field('medio_id',array($this,'editar_medio'));
		 
		 $crud->callback_edit_field('contrato',array($this,'editar_contrato'));			 		 
		
		$crud->where('contrato',$id);
			 
		 
		$crud->add_action('Desglose de la factura',base_url().'imagenes/detalle.png','','',array($this,'modificar_url_detalle'));		 

		 $crud->add_action('Factura digitalizada',base_url().'imagenes/imagenes.png','','',array($this,'modificar_url_imagenes'));	
		 
	$crud->set_relation('dependencia_contratante', 'tp_dependencia', 'dependencia');		
	$crud->set_relation('medio_id', 'tp_medios', 'nombre_comercial');
	$crud->set_relation('contrato', 'tp_contratos', 'num_contrato');
	
	    $crud->callback_before_delete(array($this,'eliminar_factura'));	
		
		$output = $crud->render();
		
		$data['opcion'] = 'facturas';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$data['opcion_factura'] = 'facturas_contrato';	
		$contrato=$this->modelo->obtener_numero_contrato($id);	
		$data['contrato']=$contrato;
	    $this->load->view('opciones_facturas', $data);	
		$this->load->view('factura', $output);	
		
		$data['facturas_contrato'] = '';
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
  	if($row->dependencia_contratante!=""){
	$dependencia=$this->modelo->obtener_nombre_dependencia($row->dependencia_contratante);
	$dependencia_aux=substr($dependencia,0, 40).'...';
	
	return '<a class="ver_dependencia_campa" href="javascript:void(0);" data-id="'.$row->dependencia_contratante.'" >'.$dependencia_aux.' </a> 
	<input type="hidden" id="nombre'.$row->dependencia_contratante.'" value="'.$dependencia.'" />';
	}
  } 
  
  function hacer_vinculo_contrato_medio($primary_key , $row)
  {	
  	if($row->medio_id!=""){
	$medio=$this->modelo->obtener_nombre_medio($row->medio_id);
	$medio_aux=substr($medio,0, 40).'...';
    return '<a class="ver_contrato_medio" href="javascript:void(0);" data-id="'.$row->medio_id.'" >'.$medio_aux.' </a> 
	<input type="hidden" id="nombre_medio'.$row->medio_id.'" value="'.$medio.'" />';
	}
  } 
  
  function hacer_vinculo_contrato_factura($primary_key , $row)
  {	
  	if($row->contrato!=""){
	$contrato=$this->modelo->obtener_numero_contrato($row->contrato);		
	
	return '<a class="ver_contrato_factura" href="javascript:void(0);" data-id="'.$row->contrato.'" >'.$contrato.' </a> 
	<input type="hidden" id="contrato'.$row->contrato.'" value="'.$contrato.'" />';
	}
  } 
    
}