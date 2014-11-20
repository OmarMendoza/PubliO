<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Campa extends CI_Controller {

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
    redirect('campa/principal');			
  }
  
  function imprimir(){
	  $data['opcion'] = 'campa';	  
	  $this->load->view('cabecera', $data);	  
  }
  
  function nuevo(){
	  $data['opcion'] = 'campa';
	  	$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  $this->load->view('cabecera', $data);
	  $data['opcion_campa'] = 'nueva_campa';
	  $this->load->view('opciones_campa', $data);	  
	  
	  $this->modelo->borrar_banners_temp();
	  $this->modelo->borrar_videos_temp();
	  $this->modelo->borrar_audios_temp();
	  $this->modelo->borrar_etiquetas_temp();
	  
	  $dependencias = $this->modelo->dependencias_solicitante_ambos();	
	  $data['dependencias'] = $dependencias; 
	  $status = $this->modelo->status();	
	  $data['status'] = $status;
	  $tipos = $this->modelo->tipos();	
	  $data['tipos'] = $tipos;
	  $clasificaciones = $this->modelo->clasificaciones_campa();	
	  $data['clasificaciones'] = $clasificaciones;
	  $etiquetas = $this->modelo->etiquetas();	
	  $data['etiquetas'] = $etiquetas;
	  $this->load->view('nuevacampa', $data);
	  $this->load->view('pie');	
	  
  }
  
    function principal(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_campa');
		$crud->set_subject('campa');		
		$crud->set_language('spanish');
		$crud->fields(
		'nombre',			
		'anio',	
		'tema',
		'tipo',
		'clasificacion_campa',
		'etiquetas',		
		'objetivo',
		'periodicidad_inicio',
		'periodicidad_fin',
		'depen',
		'costo_total',
		'status'
		);
		
		$crud->columns('nombre','anio',/*'tema',*/'periodicidad_inicio','periodicidad_fin','dependencia_aux','costo_total','monto_gastado'/*,'status'*/);			
		
		$crud->display_as('anio','Año')->display_as('periodicidad_inicio','Inicio')->display_as('periodicidad_fin','Fin')->display_as('dependencia_aux','Dependencia')->display_as('status','Estatus')->display_as('depen','Dependencia')->display_as('costo_total','Costo estimado (variable no pública)')->display_as('clasificacion_campa','Categoría de la campaña')->display_as('etiquetas','Etiquetas (separado por comas)');
		
		$crud->callback_column('dependencia_aux',array($this,'hacer_vinculo'));
		
		$crud->callback_column('monto_gastado',array($this,'obtener_monto_gastado'));
		
		$crud->callback_column('costo_total',array($this,'formato_dinero_costo_total'));				
		
		$crud->required_fields( 'nombre',			
		'anio',	
		'tema',						
		'depen',
		'tipo',
		'clasificacion_campa',
		'objetivo',
		'periodicidad_inicio',
		'periodicidad_fin',
		'costo_total',
		'status');
		
		$crud->callback_edit_field('depen',array($this,'editar_dependencia_solicitante'));	
		$crud->callback_edit_field('anio',array($this,'editar_anio_campa'));
		$crud->callback_edit_field('etiquetas',array($this,'editar_etiquetas'));
		
		$crud->set_rules('costo_total','Costo de la campaña','integer');	
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
			
		$crud->set_relation('tipo', 'tp_tipo_campa', 'tipo');
		$crud->set_relation('clasificacion_campa', 'tp_clasificacion_campa', 'descripcion_clasificacion',null,'id_clasificacion_campa');		
		$crud->set_relation('depen', 'tp_dependencia', 'dependencia');
		$crud->set_relation('status', 'tp_status_campa', 'status');
	
		$crud->add_action('Banners de la campaña',base_url().'imagenes/banners.png','','',array($this,'modificar_url_banners'));
		$crud->add_action('Facturas de la campaña',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		$crud->add_action('Videos de la campaña',base_url().'imagenes/videos.png','','',array($this,'modificar_url_videos'));
		$crud->add_action('Audios de la campaña',base_url().'imagenes/audios.png','','',array($this,'modificar_url_audios'));
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
		
		
		$crud->callback_before_delete(array($this,'eliminar_campa'));
		
		$crud->callback_before_update(array($this,'actualizar_etiquetas'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'campa';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$data['opcion_campa'] = 'ver_todo';
	    $this->load->view('opciones_campa', $data);	
		$this->load->view('campa', $output);
		
		$this->load->view('pie');		
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
  function editar_etiquetas($value,$primary_key){
	 $etiquetas_campa=$this->modelo->etiquetas_campa($primary_key); 
	 $total=$etiquetas_campa->num_rows()-1;
	 $i=0;
	 $contenido='';
	 foreach($etiquetas_campa->result() as $fila2) { 
	 	$contenido=$contenido.$fila2->etiqueta;
		if($total!=$i){ 
		$contenido=$contenido.", ";
		}
		$i++;
	 }

	  return '<input id="field-etiquetas1" type="text" name="etiquetas1" value="'.$contenido.'">';
  }
  
  function actualizar_etiquetas($post_array, $primary_key){
	  $this->modelo->actualizar_etiquetas($post_array['etiquetas1'], $primary_key);
	  return $post_array;
  }
  
  function editar_anio_campa($value,$primary_key)
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
  
  public function eliminar_campa($primary_key){
	  
    $this->modelo->borrar_campa($primary_key);
    return true;
	
  }
  
  function formato_dinero_costo_total($primary_key , $row)
  {	 
  	if($row->costo_total!=""){ 			
	return "$".number_format($row->costo_total);	
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
    return '<select id="field-depen" name="depen" style="width:300px">
	<option value="">Seleccione Dependencia</option>'.$contenido.'</select>';
  }
  
  function hacer_vinculo($primary_key , $row)
  {	
  	if($row->depen!=""){
	$dependencia=$this->modelo->obtener_nombre_dependencia($row->depen);
	$dependencia_aux=substr($dependencia,0, 40).'...';
	
	return '<a class="ver_dependencia" href="javascript:void(0);" data-id="'.$row->depen.'" >'.$dependencia_aux.' </a> 
	<input type="hidden" id="nombre'.$row->depen.'" value="'.$dependencia.'" />';
	}
  } 
  
  function obtener_monto_gastado($primary_key , $row)
  {	
	$monto_gastado=$this->modelo->obtener_monto_gastado($row->id_campa);		
	return "$".number_format($monto_gastado);	
  } 
  
  function modificar_url_banners($primary_key , $row)
  {
    return site_url('banners/principal').'/'.$row->id_campa;
  }
  
  function modificar_url_videos($primary_key , $row)
  {
    return site_url('videos/principal').'/'.$row->id_campa;
  }
  
   function modificar_url_audios($primary_key , $row)
  {
    return site_url('audios/principal').'/'.$row->id_campa;
  }
  
  function modificar_url_facturas($primary_key , $row)
  {
    return site_url('detalle_factura/facturas_campa').'/'.$row->id_campa;
  }
  
  function modificar_url_detalle_registro($primary_key , $row)
  {
    return site_url('campa/detalle_registro').'/'.$row->id_campa;
  }  
  
  function agregar_opciones($post_array, $primary_key)
  {
    $data['nuevo_banner'] = '';
	$this->load->view('opciones_banner_imagen_otros', $data);
  }      
  
  function administracion(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_campa');
		$crud->set_subject('campa');		
		$crud->set_language('spanish');
		$crud->fields(
		'nombre',			
		'anio',	
		'tema',
		'tipo',
		'clasificacion_campa',
		'etiquetas',		
		'objetivo',
		'periodicidad_inicio',
		'periodicidad_fin',
		'depen',
		'costo_total',
		'status'
		);
		
		$crud->columns('nombre','anio',/*'tema',*/'periodicidad_inicio','periodicidad_fin','dependencia_aux','costo_total','monto_gastado'/*,'status'*/);
		
     $crud->edit_fields('nombre','anio','tema','tipo','clasificacion_campa','etiquetas','objetivo','periodicidad_inicio','periodicidad_fin','depen','costo_total','status');	
		
		$crud->display_as('anio','Año')->display_as('periodicidad_inicio','Inicio')->display_as('periodicidad_fin','Fin')->display_as('dependencia_aux','Dependencia')->display_as('status','Estatus')->display_as('depen','Dependencia')->display_as('costo_total','Costo estimado (variable no pública)')->display_as('clasificacion_campa','Categoría de la campaña')->display_as('etiquetas','Etiquetas (separado por comas)');
		
		$crud->callback_column('dependencia_aux',array($this,'hacer_vinculo'));		
		$crud->callback_column('monto_gastado',array($this,'obtener_monto_gastado'));		
		$crud->callback_column('costo_total',array($this,'formato_dinero_costo_total'));
		
		$crud->required_fields( 'nombre',			
		'anio',	
		'tema',						
		'depen',
		'tipo',
		'clasificacion_campa',
		'objetivo',
		'periodicidad_inicio',
		'periodicidad_fin',
		'costo_total',
		'status');
		
		$crud->callback_edit_field('depen',array($this,'editar_dependencia_solicitante'));		
		$crud->callback_edit_field('anio',array($this,'editar_anio_campa'));
		$crud->callback_edit_field('etiquetas',array($this,'editar_etiquetas'));			
		
		$crud->set_rules('costo_total','Costo de la campaña','integer');
		
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->add_action('Banners de la campaña',base_url().'imagenes/banners.png','','',array($this,'modificar_url_banners'));
		$crud->add_action('Facturas de la campaña',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		$crud->add_action('Videos de la campaña',base_url().'imagenes/videos.png','','',array($this,'modificar_url_videos'));
		$crud->add_action('Audios de la campaña',base_url().'imagenes/audios.png','','',array($this,'modificar_url_audios'));
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
			
		$crud->set_relation('tipo', 'tp_tipo_campa', 'tipo');	
		$crud->set_relation('clasificacion_campa', 'tp_clasificacion_campa', 'descripcion_clasificacion',null,'id_clasificacion_campa');	
		$crud->set_relation('depen', 'tp_dependencia', 'dependencia');
		$crud->set_relation('status', 'tp_status_campa', 'status');				
		
		$crud->callback_before_delete(array($this,'eliminar_campa'));				
		
		$crud->callback_before_update(array($this,'actualizar_etiquetas'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'campa';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);	
		$data['opcion_campa'] = 'ver_todo';
	    $this->load->view('opciones_campa', $data);	
		$this->load->view('campa', $output);	
		
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}	
  }  
  
  function buscar(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_campa');
		$crud->set_subject('campa');		
		$crud->set_language('spanish');
		$crud->fields(
		'nombre',			
		'anio',	
		'tema',
		'tipo',
		'clasificacion_campa',
		'etiquetas',		
		'objetivo',
		'periodicidad_inicio',
		'periodicidad_fin',
		'depen',
		'costo_total',
		'status'
		);
		
		$crud->columns('nombre','anio',/*'tema',*/'periodicidad_inicio','periodicidad_fin','dependencia_aux','costo_total','monto_gastado'/*,'status'*/);
		
	$crud->edit_fields('nombre','anio','tema','tipo','clasificacion_campa','etiquetas','objetivo','periodicidad_inicio','periodicidad_fin','depen','costo_total','status');	
		
		$crud->display_as('anio','Año')->display_as('periodicidad_inicio','Inicio')->display_as('periodicidad_fin','Fin')->display_as('dependencia_aux','Dependencia')->display_as('status','Estatus')->display_as('depen','Dependencia')->display_as('costo_total','Costo estimado (variable no pública)')->display_as('clasificacion_campa','Categoría de la campaña')->display_as('etiquetas','Etiquetas (separado por comas)');
		
		$crud->callback_column('dependencia_aux',array($this,'hacer_vinculo'));		
		$crud->callback_column('monto_gastado',array($this,'obtener_monto_gastado'));		
		$crud->callback_column('costo_total',array($this,'formato_dinero_costo_total'));
		
		$crud->required_fields( 'nombre',			
		'anio',	
		'tema',						
		'depen',
		'tipo',
		'clasificacion_campa',
		'objetivo',
		'periodicidad_inicio',
		'periodicidad_fin',
		'costo_total',
		'status');
		
		$crud->callback_edit_field('depen',array($this,'editar_dependencia_solicitante'));		
		$crud->callback_edit_field('anio',array($this,'editar_anio_campa'));
		$crud->callback_edit_field('etiquetas',array($this,'editar_etiquetas'));				
	  	
		$crud->set_rules('costo_total','Costo de la campaña','integer');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->add_action('Banners de la campaña',base_url().'imagenes/banners.png','','',array($this,'modificar_url_banners'));
		$crud->add_action('Facturas de la campaña',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		$crud->add_action('Videos de la campaña',base_url().'imagenes/videos.png','','',array($this,'modificar_url_videos'));
		$crud->add_action('Audios de la campaña',base_url().'imagenes/audios.png','','',array($this,'modificar_url_audios'));	
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));			
		
			
		$crud->set_relation('tipo', 'tp_tipo_campa', 'tipo');	
		$crud->set_relation('clasificacion_campa', 'tp_clasificacion_campa', 'descripcion_clasificacion',null,'id_clasificacion_campa');	
		$crud->set_relation('depen', 'tp_dependencia', 'dependencia');
		$crud->set_relation('status', 'tp_status_campa', 'status');				
		
		$dato = $this->input->post('buscar');				
		
		$crud->like('anio',"$dato");
	    $crud->or_like('tema',"$dato");
		$crud->or_like('nombre',"$dato");
		$crud->or_like('dependencia',"$dato");				
		
		$crud->callback_before_delete(array($this,'eliminar_campa'));	
		
		$crud->callback_before_update(array($this,'actualizar_etiquetas'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'campa';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);	
		$data['opcion_campa'] = 'buscar';
	    $this->load->view('opciones_campa', $data);	
		$this->load->view('campa', $output);
		
		$this->load->view('pie');		
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
  function guardar(){	  	  	  
	  	  	  
	  $this->form_validation->set_rules('nombre', 'nombre','required');
	  $this->form_validation->set_rules('tema', 'tema','required');	  
	  $this->form_validation->set_rules('objetivo', 'objetivo','required');
	  $this->form_validation->set_rules('publicidad_inicio', 'publicidad_inicio', 'required');
	  $this->form_validation->set_rules('publicidad_fin', 'publicidad_fin','required');
	  $this->form_validation->set_rules('costototal', 'costototal', 'required');
	  
	  $this->form_validation->set_message('required', 'El es requerido');
	  
	   if($this->form_validation->run() == FALSE)
            {               
				redirect('campa/nuevo');       
            }
	    else{
				
	  $nombre = $this->input->post('nombre');
	  $anio_campa = $this->input->post('anio');
	  $tema = $this->input->post('tema');
	  
	  $tipo = $this->input->post('tipo');
	  $tipo = $this->modelo->obtener_id_tipo($tipo);
	  
	  $categoria = $this->input->post('categoria');
	  $categoria = $this->modelo->obtener_id_clasificacion_campa($categoria);
	  
	  $objetivo = $this->input->post('objetivo');
	  	  	  
	  $publicidad_inicio = $this->input->post('publicidad_inicio');
	  list($dia,$mes,$anio)=explode("/",$publicidad_inicio);
	  $publicidad_inicio=$anio."/".$mes."/".$dia; 
	  
	  $publicidad_fin = $this->input->post('publicidad_fin');
	  list($dia,$mes,$anio)=explode("/",$publicidad_fin);
	  $publicidad_fin=$anio."/".$mes."/".$dia;
	  
	  $dependencia = $this->input->post('dependencia');
	  $dependencia = $this->modelo->obtener_id_dependencia($dependencia);
	  $costo_total = $this->input->post('costototal');
	  $status = $this->input->post('status');
	  $status = $this->modelo->obtener_id_status($status);
	  
		   
	  $datos = array(
			'nombre' => $nombre ,
			'anio' => $anio_campa ,
			'tema' => $tema,
			'tipo' => $tipo ,
			'objetivo' => $objetivo,
			'periodicidad_inicio' => $publicidad_inicio,
			'periodicidad_fin' => $publicidad_fin ,
			'depen' => $dependencia ,
			'costo_total' => $costo_total,
			'status' => $status,
			'clasificacion_campa' => $categoria
	   );
	   
	   $this->modelo->guardar_campa($datos);
	   $this->modelo->guardar_banners();
	   $this->modelo->borrar_banners_temp();
	   $this->modelo->guardar_videos();
	   $this->modelo->borrar_videos_temp();
	   $this->modelo->guardar_audios();
	   $this->modelo->borrar_audios_temp();
	   $this->modelo->guardar_etiquetas();
	   $this->modelo->borrar_etiquetas_temp();
	   
	   redirect('campa/principal'); 
	 }	   	   
  }    
  
  function campa_dependencia($id){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_campa');
		$crud->set_subject('campa');		
		$crud->set_language('spanish');
		$crud->fields(
		'nombre',			
		'anio',	
		'tema',
		'tipo',
		'clasificacion_campa',
		'etiquetas',		
		'objetivo',
		'periodicidad_inicio',
		'periodicidad_fin',
		'depen',
		'costo_total',
		'status'
		);
		
		$crud->columns('nombre','anio',/*'tema',*/'periodicidad_inicio','periodicidad_fin','dependencia_aux','costo_total','monto_gastado'/*,'status'*/);
		
	$crud->edit_fields('nombre','anio','tema','tipo','clasificacion_campa','etiquetas','objetivo','periodicidad_inicio','periodicidad_fin','depen','costo_total','status');	
		
		$crud->display_as('anio','Año')->display_as('periodicidad_inicio','Inicio')->display_as('periodicidad_fin','Fin')->display_as('dependencia_aux','Dependencia')->display_as('status','Estatus')->display_as('depen','Dependencia')->display_as('costo_total','Costo estimado (variable no pública)')->display_as('clasificacion_campa','Categoría de la campaña')->display_as('etiquetas','Etiquetas (separado por comas)');
		
		$crud->callback_column('dependencia_aux',array($this,'hacer_vinculo_dependencia_campa'));		
		$crud->callback_column('monto_gastado',array($this,'obtener_monto_gastado'));		
		$crud->callback_column('costo_total',array($this,'formato_dinero_costo_total'));		
		
		$crud->required_fields( 'nombre',			
		'anio',	
		'tema',						
		'depen',
		'tipo',
		'clasificacion_campa',
		'objetivo',
		'periodicidad_inicio',
		'periodicidad_fin',
		'costo_total',
		'status');
		
		$crud->callback_edit_field('depen',array($this,'editar_dependencia_solicitante'));		
		$crud->callback_edit_field('anio',array($this,'editar_anio_campa'));
		$crud->callback_edit_field('etiquetas',array($this,'editar_etiquetas'));		
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->set_rules('costo_total','Costo de la campaña','integer');
		
		
		$crud->where('depen',$id);
			
		$crud->set_relation('tipo', 'tp_tipo_campa', 'tipo');
		$crud->set_relation('clasificacion_campa', 'tp_clasificacion_campa', 'descripcion_clasificacion',null,'id_clasificacion_campa');		
		$crud->set_relation('depen', 'tp_dependencia', 'dependencia');
		$crud->set_relation('status', 'tp_status_campa', 'status');
	
		$crud->add_action('Banners de la campaña',base_url().'imagenes/banners.png','','',array($this,'modificar_url_banners'));
		$crud->add_action('Facturas de la campaña',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		$crud->add_action('Videos de la campaña',base_url().'imagenes/videos.png','','',array($this,'modificar_url_videos'));
		$crud->add_action('Audios de la campaña',base_url().'imagenes/audios.png','','',array($this,'modificar_url_audios'));
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));			
		
		$crud->callback_before_delete(array($this,'eliminar_campa'));	
		
		$crud->callback_before_update(array($this,'actualizar_etiquetas'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'campa';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	  
	  	$this->load->view('cabecera', $data);
		$dependencia=$this->modelo->obtener_nombre_dependencia($id);
		$data['opcion_campa'] = 'campas_dependencia';
		$data['dependencia'] = $dependencia;
	    $this->load->view('opciones_campa', $data);		
		$this->load->view('campa', $output);
		
		$data['campa_dependencia'] = '';
		$data['id'] = $id;
		$this->load->view('opciones_banner_imagen_otros', $data);
		
		$this->load->view('regresar');
		
		$this->load->view('pie');		
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}	
  }
  
  function hacer_vinculo_dependencia_campa($primary_key , $row)
  {	
  	if($row->depen!=""){
	$dependencia=$this->modelo->obtener_nombre_dependencia($row->depen);
	$dependencia_aux=substr($dependencia,0, 40).'...';
	
	return '<a class="ver_dependencia_campa" href="javascript:void(0);" data-id="'.$row->depen.'" >'.$dependencia_aux.' </a> 
	<input type="hidden" id="nombre'.$row->depen.'" value="'.$dependencia.'" />';
	}
  } 
  
  function detalle_registro($id){	 
		$data['opcion'] = 'campa';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);
		$data['opcion_campa'] = 'detalle_registro';	  
	  	$this->load->view('opciones_campa', $data);
		$detalleregistrocampa=$this->modelo->registro_campa($id);	
		$data['detalleregistrocampa'] = $detalleregistrocampa;		
		$etiquetas_campa=$this->modelo->etiquetas_campa($id);
		$data['etiquetas_campa'] = $etiquetas_campa;
		$this->load->view('detalleregistrocampa', $data);	
		$this->load->view('pie');				
  }
  
    
}