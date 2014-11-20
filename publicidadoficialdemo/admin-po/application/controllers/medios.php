<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Medios extends CI_Controller {

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
    redirect('medios/principal');			
  }
  
  function imprimir(){
	  $data['opcion'] = 'medios';	  
	  $this->load->view('cabecera', $data);	
	  $this->load->view('medios');	  
  }
  
  function principal(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_medios');
		$crud->set_subject('medios');		
		$crud->set_language('spanish');
		$crud->fields(			
		'razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',
		'cobertura',
		'perfil_demografico',
		'tarifario',
		'ver_tarifario',
		'acta_constitutiva',
		'curriculum_empresarial',
		'ficha_tecnica',
		'ver_ficha_tecnica'
		);
		
		$crud->columns('razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion_aux',
		'cobertura');
		
		$crud->display_as('razon_social','Razón social')->display_as('nombre_comercial','Nombre comercial')->display_as('padron_proveedor','Número de proveedor')->display_as('clasificacion_aux','Clasificación')->display_as('cobertura','Cobertura')->display_as('perfil_demografico','Perfil demográfico')->display_as('tarifario','Tarifario')->display_as('ver_tarifario','¿publicar tarifario?')->display_as('acta_constitutiva','Acta constitutiva')->display_as('curriculum_empresarial','Currículum empresarial')->display_as('ficha_tecnica','Ficha técnica')->display_as('ver_ficha_tecnica','¿publicar ficha técnica?');
		
		$crud->required_fields( 'razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',		
		'cobertura');
		
		
		$crud->edit_fields('razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',		
		'cobertura',
		'perfil_demografico',
		'tarifario',
		'ver_tarifario',
		'acta_constitutiva',
		'curriculum_empresarial',
		'ficha_tecnica',
		'ver_ficha_tecnica');	
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		
		$crud->set_subject('medio');
		
			
		$crud->set_relation('clasificacion', 'tp_clasificacion', 'descripcion_clasificacion',null,'id_clasificacion');		
		$crud->set_relation('cobertura', 'tp_cobertura', 'cobertura');
		
		$crud->set_field_upload('acta_constitutiva','archivos/actas_constitutivas');
		$crud->set_field_upload('curriculum_empresarial','archivos/curriculum_empresarial');
		$crud->set_field_upload('ficha_tecnica','archivos/fichas_tecnica');
		$crud->set_field_upload('tarifario','archivos/tarifarios');
		
		$crud->callback_after_upload(array($this,'obtener_imagen_upload'));
		
		$crud->callback_column('clasificacion_aux',array($this,'columna_clasificacion'));
		
		$crud->add_action('Contratos del medio',base_url().'imagenes/contratos.png','','',array($this,'modificar_url_contratos'));
		$crud->add_action('Facturas del medio',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
		
		$crud->callback_add_field('ver_tarifario',array($this,'agregar_ver_tarifario'));		
		$crud->callback_edit_field('ver_tarifario',array($this,'editar_ver_tarifario'));
		$crud->callback_add_field('ver_ficha_tecnica',array($this,'agregar_ver_ficha_tecnica'));		
		$crud->callback_edit_field('ver_ficha_tecnica',array($this,'editar_ver_ficha_tecnica'));
		
		$crud->callback_before_delete(array($this,'eliminar_medio'));
	  
		$output = $crud->render();			
				
		$data['opcion'] = 'medios';	  
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);
		$data['opcion_medio'] = 'ver_todos';	  
	  	$this->load->view('opciones_medios', $data);
		$this->load->view('medios', $output);
		$this->load->view('pie');				
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
  
   public function eliminar_medio($primary_key){
	  
    $this->modelo->borrar_medio($primary_key);
    return true;
	
  }
  
  function columna_clasificacion($primary_key , $row)
  {	
  	if($row->clasificacion!=""){
	
	$clasificacion=$this->modelo->obtener_clasificacion($row->clasificacion);
	
	$clasificacion=substr($clasificacion,0, 8).'...';	
	
	return $clasificacion;
	}
  } 
  
  
  function obtener_icono_acta($primary_key , $row)
  {
    return '<a target="_blank" href="'.base_url().'archivos/actas_constitutivas/'.$row->acta_constitutiva.'"> <IMG SRC="'.base_url().'imagenes/pdf.png" WIDTH=25 HEIGHT=25> </a>';
  }
  
  function obtener_icono_curriculum($primary_key , $row)
  {
    return '<a target="_blank" href="'.base_url().'archivos/curriculum_empresarial/'.$row->curriculum_empresarial.'"> <IMG SRC="'.base_url().'imagenes/pdf.png" WIDTH=25 HEIGHT=25> </a>';
  }
  
  function obtener_icono_ficha($primary_key , $row)
  {
    return '<a target="_blank" href="'.base_url().'archivos/fichas_tecnica/'.$row->ficha_tecnica.'"> <IMG SRC="'.base_url().'imagenes/pdf.png" WIDTH=25 HEIGHT=25> </a>';
  }
  
  function obtener_icono_tarifario($primary_key , $row)
  {
    return '<a target="_blank" href="'.base_url().'archivos/tarifarios/'.$row->tarifario.'"> <IMG SRC="'.base_url().'imagenes/pdf.png" WIDTH=25 HEIGHT=25> </a>';
  }
  
  function modificar_url_contratos($primary_key , $row)
  {	  	
    return site_url('contratos/ver_contratos_medio').'/'.$row->id_medio;
  }
  
  function modificar_url_facturas($primary_key , $row)
  {
    return site_url('facturas/facturas_medio').'/'.$row->id_medio;
  }
  
  function modificar_url_detalle_registro($primary_key , $row)
  {
    return site_url('medios/detalle_registro').'/'.$row->id_medio;
  }
  
  function administracion(){
	  
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_medios');
		$crud->set_subject('medios');		
		$crud->set_language('spanish');
		$crud->fields(			
		'razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',	
		'cobertura',
		'perfil_demografico',
		'tarifario',
		'ver_tarifario',
		'acta_constitutiva',
		'curriculum_empresarial',
		'ficha_tecnica',
		'ver_ficha_tecnica'
		);
		
		$crud->add_fields('razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',		
		'cobertura',
		'perfil_demografico',
		'tarifario',
		'ver_tarifario',
		'acta_constitutiva',
		'curriculum_empresarial',
		'ficha_tecnica',
		'ver_ficha_tecnica');
		
		$crud->columns('razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion_aux',
		'cobertura');		
		
		$crud->display_as('razon_social','Razón social')->display_as('nombre_comercial','Nombre comercial')->display_as('padron_proveedor','Número de proveedor')->display_as('clasificacion_aux','Clasificación')->display_as('clasificacion','Clasificación')->display_as('cobertura','Cobertura')->display_as('perfil_demografico','Perfil demográfico')->display_as('tarifario','Tarifario')->display_as('ver_tarifario','¿publicar tarifario?')->display_as('acta_constitutiva','Acta constitutiva')->display_as('curriculum_empresarial','Currículum empresarial')->display_as('ficha_tecnica','Ficha técnica')->display_as('ver_ficha_tecnica','¿publicar ficha técnica?');
		
		$crud->required_fields( 'razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',		
		'cobertura');
		
		$crud->edit_fields('razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',		
		'cobertura',
		'perfil_demografico',
		'tarifario',
		'ver_tarifario',
		'acta_constitutiva',
		'curriculum_empresarial',
		'ficha_tecnica',
		'ver_ficha_tecnica');
		
		$crud->set_subject('medio');
		
		$crud->unset_export();
		$crud->unset_print();
			
		$crud->set_relation('clasificacion', 'tp_clasificacion', 'descripcion_clasificacion',null,'id_clasificacion');		
		$crud->set_relation('cobertura', 'tp_cobertura', 'cobertura');
		
		$crud->set_field_upload('acta_constitutiva','archivos/actas_constitutivas');
		$crud->set_field_upload('curriculum_empresarial','archivos/curriculum_empresarial');
		$crud->set_field_upload('ficha_tecnica','archivos/fichas_tecnica');
		$crud->set_field_upload('tarifario','archivos/tarifarios');
		
		$crud->callback_after_upload(array($this,'obtener_imagen_upload'));
		
		$crud->callback_column('clasificacion_aux',array($this,'columna_clasificacion'));
		
		$crud->add_action('Contratos del medio',base_url().'imagenes/contratos.png','','',array($this,'modificar_url_contratos'));
		$crud->add_action('Facturas del medio',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
		
		$crud->callback_add_field('ver_tarifario',array($this,'agregar_ver_tarifario'));		
		$crud->callback_edit_field('ver_tarifario',array($this,'editar_ver_tarifario'));
		$crud->callback_add_field('ver_ficha_tecnica',array($this,'agregar_ver_ficha_tecnica'));		
		$crud->callback_edit_field('ver_ficha_tecnica',array($this,'editar_ver_ficha_tecnica'));
		
		$crud->callback_before_delete(array($this,'eliminar_medio'));
				
		$output = $crud->render();
		
		$data['opcion'] = 'medios';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();  
	  	$this->load->view('cabecera', $data);
		$data['opcion_medio'] = 'nuevo_medio';	  
	  	$this->load->view('opciones_medios', $data);	
		$this->load->view('medios', $output);
		$this->load->view('pie');		
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}	
  }
  
  function obtener_imagen_upload($uploader_response,$field_info, $files_to_upload)
  {
    $this->load->library('image_moo');
 
    //Is only one file uploaded so it ok to use it with $uploader_response[0].
    $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
 
    $this->image_moo->load($file_uploaded)->resize(200,200)->save($file_uploaded,true);
 
    return true;
  }
  
  function agregar_ver_tarifario()
  {
    return 'Sí <input type="radio" name="ver_tarifario" value="si" style="margin-right:15px;"/> No <input type="radio" name="ver_tarifario" value="no" />';
  }
  
   function editar_ver_tarifario($value, $primary_key)
  {
	$contenido="";
	
	if($value=="si"){
		$contenido=$contenido.'Sí <input type="radio" name="ver_tarifario" value="si" checked="checked" style="margin-right:15px;"/>';
	}
	else{
		$contenido=$contenido.'Sí <input type="radio" name="ver_tarifario" value="si" style="margin-right:15px;"/>';
	}
	
	if($value=="no"){
		$contenido=$contenido.'No <input type="radio" name="ver_tarifario" value="no" checked="checked"/>';
	}
	else{
		$contenido=$contenido.'No <input type="radio" name="ver_tarifario" value="no"/>';
	}		
	
    return $contenido;
  }
  
  function agregar_ver_ficha_tecnica()
  {
    return 'Sí <input type="radio" name="ver_ficha_tecnica" value="si" style="margin-right:15px;"/> No <input type="radio" name="ver_ficha_tecnica" value="no" />';
  }
  
   function editar_ver_ficha_tecnica($value, $primary_key)
  {
	$contenido="";
	
	if($value=="si"){
		$contenido=$contenido.'Sí <input type="radio" name="ver_ficha_tecnica" value="si" checked="checked"  style="margin-right:15px;"/>';
	}
	else{
		$contenido=$contenido.'Sí <input type="radio" name="ver_ficha_tecnica" value="si"  style="margin-right:15px;"/>';
	}
	
	if($value=="no"){
		$contenido=$contenido.'No <input type="radio" name="ver_ficha_tecnica" value="no" checked="checked"/>';
	}
	else{
		$contenido=$contenido.'No <input type="radio" name="ver_ficha_tecnica" value="no"/>';
	}		
	
    return $contenido;
  }
  
  function buscar(){
	  try{	
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_medios');
		$crud->set_subject('medios');		
		$crud->set_language('spanish');
		$crud->fields(			
		   'razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',
		'clasificacion_aux',
		'cobertura');
		
		$crud->columns('razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion_aux',
		'cobertura');
		
		$crud->display_as('razon_social','Razón social')->display_as('nombre_comercial','Nombre comercial')->display_as('padron_proveedor','Número de proveedor')->display_as('clasificacion_aux','Clasificación')->display_as('cobertura','Cobertura')->display_as('perfil_demografico','Perfil demográfico')->display_as('tarifario','Tarifario')->display_as('ver_tarifario','¿publicar tarifario?')->display_as('acta_constitutiva','Acta constitutiva')->display_as('curriculum_empresarial','Currículum empresarial')->display_as('ficha_tecnica','Ficha técnica')->display_as('ver_ficha_tecnica','¿publicar ficha técnica?');
		
		$crud->required_fields( 'razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',		
		'cobertura');
		
		$crud->edit_fields('razon_social',	
		'nombre_comercial',
		'padron_proveedor',
		'clasificacion',		
		'cobertura',
		'perfil_demografico',
		'tarifario',		
		'ver_tarifario',
		'acta_constitutiva',
		'curriculum_empresarial',
		'ficha_tecnica',
		'ver_ficha_tecnica');
		
		$crud->set_subject('medio');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
			
		$crud->set_relation('clasificacion', 'tp_clasificacion', 'descripcion_clasificacion');		
		$crud->set_relation('cobertura', 'tp_cobertura', 'cobertura');
		
		$crud->set_field_upload('acta_constitutiva','archivos/actas_constitutivas');
		$crud->set_field_upload('curriculum_empresarial','archivos/curriculum_empresarial');
		$crud->set_field_upload('tarifario','archivos/tarifarios');		
		$crud->set_field_upload('ficha_tecnica','archivos/fichas_tecnica');
		
		$crud->callback_after_upload(array($this,'obtener_imagen_upload'));
		
		$crud->callback_column('clasificacion_aux',array($this,'columna_clasificacion'));
		
		$crud->add_action('Contratos del medio',base_url().'imagenes/contratos.png','','',array($this,'modificar_url_contratos'));
		$crud->add_action('Facturas del medio',base_url().'imagenes/facturas.png','','',array($this,'modificar_url_facturas'));
		$crud->add_action('ver todos los datos',base_url().'imagenes/lupa.gif','','',array($this,'modificar_url_detalle_registro'));
		
		$dato = $this->input->post('buscar');				
		
		$crud->like('razon_social',"$dato");
	    $crud->or_like('nombre_comercial',"$dato");
		$crud->or_like('descripcion_clasificacion',"$dato");
		
		$crud->callback_add_field('ver_tarifario',array($this,'agregar_ver_tarifario'));		
		$crud->callback_edit_field('ver_tarifario',array($this,'editar_ver_tarifario'));
		$crud->callback_add_field('ver_ficha_tecnica',array($this,'agregar_ver_ficha_tecnica'));		
		$crud->callback_edit_field('ver_ficha_tecnica',array($this,'editar_ver_ficha_tecnica'));
		
		$crud->callback_before_delete(array($this,'eliminar_medio'));
		
		$output = $crud->render();
		
		$data['opcion'] = 'medios';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);
		$data['opcion_medio'] = 'buscar';	  
	  	$this->load->view('opciones_medios', $data);	
		$this->load->view('medios', $output);	
		$this->load->view('pie');	
		
		}catch(Exception $e){
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
    	}
	
  }
    
  function detalle_registro($id){	 
		$data['opcion'] = 'medios';
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera', $data);
		$data['opcion_medio'] = 'detalle_registro';	  
	  	$this->load->view('opciones_medios', $data);
		$detalleregistromedio=$this->modelo->registro_medio($id);	
		$data['detalleregistromedio'] = $detalleregistromedio;
		$this->load->view('detalleregistromedio', $data);	
		$this->load->view('pie');				
  }
  
  
}