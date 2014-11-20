<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Logos extends CI_Controller {

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
	
	$this->modelo->iniciar_tabla_logo();	    
	
		
  }

  	
  
  function principal(){	    	  							
		
		try{
				
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('tp_logos');
		$crud->set_subject('logo');		
		$crud->set_language('spanish');
		$crud->fields(
		'logo_gobierno',			
		'vinculacion_logo_gobierno',
		'logo_opcional',
		'vinculacion_logo_opcional'
		);		
		
		$crud->display_as('logo_gobierno','Logotipo principal');
		$crud->display_as('vinculacion_logo_gobierno','Vínculo del logotipo principal');
		$crud->display_as('logo_opcional','Logotipo secundario (opcional)');
		$crud->display_as('vinculacion_logo_opcional','Vínculo del logotipo secundario');
		
		$crud->unset_add();
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_delete();
		$crud->unset_list();
		
		$crud->where('id_logo',1);		
		
		$crud->set_field_upload('logo_gobierno','archivos/logos');
		
		$crud->set_field_upload('logo_opcional','archivos/logos');
		
		$crud->callback_after_upload(array($this,'obtener_imagen_upload'));	
		
		$crud->callback_after_update(array($this, 'redireccionar'));								
		
		$output = $crud->render();
		
		$data['opcion'] = '';	  
		$data['cambiar_logos'] = '';	
		$data['nombre_usuario'] = $this->modelo->nombre_usuario($this->session->userdata('id_usuario'));
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional(); 
	  	$this->load->view('cabecera', $data);
		$this->load->view('nuevos_logos',$output);												
		$this->load->view('pie');						
		
		}catch(Exception $e){
			
		 	   if($e->getCode() == 14)
			   {
				   redirect('medios/principal');					
			   }
			   else
			   {
				show_error($e->getMessage());
			   }
			   
    	}
  }
  
  function redireccionar($post_array,$primary_key)
  {
	  return 'logos/principal'; 
  }
  
  function obtener_imagen_upload($uploader_response, $field_info, $files_to_upload)
  {
    $this->load->library('image_moo');
 
    $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
 
 	if($field_info->field_name=="logo_opcional"){
		
    $this->image_moo->load($file_uploaded)->save($file_uploaded,true);
	
	}
	
	else{
		
		$this->image_moo->load($file_uploaded)->save($file_uploaded,true);
		
	}
 
    return true;
  }
         
  
}