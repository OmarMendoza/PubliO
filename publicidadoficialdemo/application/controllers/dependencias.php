<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Dependencias extends CI_Controller {

  function __construct()
  {
	
    parent::__construct();
	$this->load->helper('url');
	$this->load->model('modelo');
	$this->load->model('modelo_listado');
	//$this->load->library('grocery_crud');
	//$this->load->database();
	//$this->load->library(array('session'));
		
    /*$this->load->database();
    $this->load->library('grocery_crud');
    $this->load->helper('url');	
	$this->load->model('modeloejemplo');	
	$this->load->library('pagination'); //Cargamos la librería de paginación	
    $this->load->library('table');//-->haremos uso de tablas*/
		
  }

  public function index()
  {    
    redirect('dependencias/cargar/0');			
  }
  
  function cargar($anio_aux){
	  
	  	if($anio_aux==0){
	  		$anio=$this->modelo->anio_inicial_dependencias();}
		else{
			$anio=$anio_aux;
		}
		
		$dependencias_contratantes=$this->modelo->dependencias_contratantes($anio);	
		
		$datos='{
		"name": "Dependencias contratantes",
		"children": [ ';				
		
		foreach($dependencias_contratantes->result() as $fila) { 
															
				$datos=$datos.'{
                    "url": "'.base_url().'/index.php/dependencias/detalle_dependencia/'.$fila->id_dependencia.'/'.$anio.'",
                    "name": "'.$fila->dependencia.'",
                    "size": '.$fila->monto.',
                    "value": 4.6443908991413725
                },';	 							 		
	 	}
		$datos = substr($datos, 0, -1);
		//quitar última coma (,)
		$datos=$datos.'] }';
		
		write_file('treemap/dependenciascontratantes.json', $datos);
		
	    $data['opcion'] = 'dependencias';
		//$data['dependencias_contratantes']=$this->modelo->dependencias_contratantes($anio);	
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();		
	  	$this->load->view('cabecera',$data);
		$data['monto_total_contratante']=$this->modelo->monto_total_dependencia_contratante($anio);
		$data['anios_dependencias']=$this->modelo->anios_dependencias();
		$data['anio']=$anio;
		
		if($anio==date("Y"))
		$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();
		
		$data['dependencias_contratantes']=$this->modelo_listado->lista_dependencias_contratantes();	 
  		$this->load->view('dependenciacontratante',$data);	
		$this->load->view('pie');								
  } 
  
   function cargar_solicitantes($anio){	
   
   		$dependencias_solicitantes=$this->modelo->dependencias_solicitantes($anio);	
		
		$datos='{
		"name": "Dependencias solicitantes",
		"children": [ ';				
		
		foreach($dependencias_solicitantes->result() as $fila) { 
															
				$datos=$datos.'{
                    "url": "'.base_url().'index.php/dependencias/detalle_dependencia_solicitante/'.$fila->id_dependencia.'/'.$anio.'",
                    "name": "'.$fila->dependencia.'",
                    "size": '.$fila->monto.',
                    "value": 4.6443908991413725
                },';	 							 		
	 	}
		$datos = substr($datos, 0, -1);
		//quitar última coma (,)
		$datos=$datos.'] }';
		
		write_file('treemap/dependenciassolicitantes.json', $datos);
		    
	    $data['opcion'] = 'dependencias';	
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	
	  	$this->load->view('cabecera',$data);	 
		//$data['dependencias_solicitantes']=$this->modelo->dependencias_solicitantes($anio);	
		$data['monto_total_solicitante']=$this->modelo->monto_total_dependencia_solicitantes($anio);	
		$data['anios_dependencias']=$this->modelo->anios_dependencias();
		$data['anio']=$anio;	
		
		if($anio==date("Y"))
		$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();				
		
		$data['dependencias_solicitantes']=$this->modelo_listado->lista_dependencias_solicitantes();
  		$this->load->view('dependenciasolicitante',$data);	
		$this->load->view('pie');								
  } 
  
  function detalle_dependencia($id, $anio){
	  	$data['opcion'] = 'dependencias';
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	
	  	$this->load->view('cabecera',$data);
		$data['id_dependencia']=$id;
		$data['anio']=$anio;
		$data['nombre_dependencia']=$this->modelo->nombre_dependencia($id);
		$data['numero_campas']=$this->modelo->numero_campas_dependencia($id, $anio);
		$data['monto_gastado']=$this->modelo->monto_gastado_dependencia_contratante($id, $anio);		
		
		$data['campas_dependencias_contratantes']=$this->modelo_listado->lista_campas_depen_contratante($id, $anio);		
  		$this->load->view('detalle_dependencia',$data);	
		$this->load->view('pie');				
  }
  
  function detalle_dependencia_solicitante($id, $anio){
	  	$data['opcion'] = 'dependencias';
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	
	  	$this->load->view('cabecera',$data);
		$data['id_dependencia']=$id;
		$data['anio']=$anio;
		$data['nombre_dependencia']=$this->modelo->nombre_dependencia($id);
		$data['numero_campas']=$this->modelo->numero_campas_dependencia_solicitante($id, $anio);
		$data['monto_gastado']=$this->modelo->monto_gastado_dependencia_solicitante($id, $anio);		
		
		$data['campas_dependencias_solicitantes']=$this->modelo_listado->lista_campas_depen_solicitante($id, $anio);
  		$this->load->view('detalle_dependencia_solicitante',$data);	
		$this->load->view('pie');				
  }
  
  function detalle_dependencia_buscador($id){
	  	$data['opcion'] = 'dependencias';
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	
	  	$this->load->view('cabecera',$data);
		$data['id_dependencia']=$id;
		$data['anio']=0;
		$data['nombre_dependencia']=$this->modelo->nombre_dependencia($id);
		$data['numero_campas']=$this->modelo->numero_campas_dependencia_solicitante_busqueda($id);
		$data['monto_gastado']=$this->modelo->monto_gastado_dependencia_solicitante_busqueda($id);		
		
		$data['campas_dependencias_busqueda']=$this->modelo_listado->lista_campas_depen_busqueda($id);
  		$this->load->view('detalle_dependencia_solicitante_busqueda',$data);			
		$this->load->view('pie');				
  }
  
  function cargar_contratante_por_anio(){
	  
	  	$anio=$this->input->post('anio');
		
		$dependencias_contratantes=$this->modelo->dependencias_contratantes($anio);	
		
		$datos='{
		"name": "Dependencias contratantes",
		"children": [ ';				
		
		foreach($dependencias_contratantes->result() as $fila) { 
															
				$datos=$datos.'{
                    "url": "'.base_url().'/index.php/dependencias/detalle_dependencia/'.$fila->id_dependencia.'/'.$anio.'",
                    "name": "'.$fila->dependencia.'",
                    "size": '.$fila->monto.',
                    "value": 4.6443908991413725
                },';	 							 		
	 	}
		$datos = substr($datos, 0, -1);
		//quitar última coma (,)
		$datos=$datos.'] }';
		
		write_file('treemap/dependenciascontratantes.json', $datos);
		
	  	$data['opcion'] = 'dependencias';
		$data['dependencias_contratantes']=$this->modelo->dependencias_contratantes($anio);	
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();		
	  	$this->load->view('cabecera',$data);
		$data['monto_total_contratante']=$this->modelo->monto_total_dependencia_contratante($anio);
		$data['anios_dependencias']=$this->modelo->anios_dependencias();
		$data['anio']=$anio;
		
		if($anio==date("Y"))
		$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();
		
		$data['dependencias_contratantes']=$this->modelo_listado->lista_dependencias_contratantes();	 	 
  		$this->load->view('dependenciacontratante',$data);	
		$this->load->view('pie');
  }
  
  function cargar_solicitante_por_anio(){
	  	
		$anio=$this->input->post('anio');
		
		$dependencias_solicitantes=$this->modelo->dependencias_solicitantes($anio);	
		
		$datos='{
		"name": "Dependencias solicitantes",
		"children": [ ';				
		
		foreach($dependencias_solicitantes->result() as $fila) { 
															
				$datos=$datos.'{
                    "url": "'.base_url().'index.php/dependencias/detalle_dependencia_solicitante/'.$fila->id_dependencia.'/'.$anio.'",
                    "name": "'.$fila->dependencia.'",
                    "size": '.$fila->monto.',
                    "value": 4.6443908991413725
                },';	 							 		
	 	}
		$datos = substr($datos, 0, -1);
		//quitar última coma (,)
		$datos=$datos.'] }';
		
		write_file('treemap/dependenciassolicitantes.json', $datos);
		
	    $data['opcion'] = 'dependencias';	
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	
	  	$this->load->view('cabecera',$data);	 
		$data['monto_total_solicitante']=$this->modelo->monto_total_dependencia_solicitantes($anio);	
		$data['anios_dependencias']=$this->modelo->anios_dependencias();
		$data['anio']=$anio;
		
		if($anio==date("Y"))
		$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();
		
		$data['dependencias_solicitantes']=$this->modelo_listado->lista_dependencias_solicitantes();
  		$this->load->view('dependenciasolicitante',$data);	
		$this->load->view('pie');								
  } 
       
}