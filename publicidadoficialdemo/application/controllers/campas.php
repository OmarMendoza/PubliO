<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Campas extends CI_Controller {

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
    redirect('campas/cargar');			
  }
  
  function cargar(){
	    $anio=$this->modelo->anio_inicial_campas();
	  	/*$datos='{
		"name": "Chicago Data Portal",
		"children": [
        {
            "name": "FOIA",
            "children": [
                {
                    "url": "https://data.cityofchicago.org/FOIA/FOIA-Request-Log-Budget-Management/c323-fb2i",
                    "name": "FOIA Log - Budget & Management",
                    "size": 104,
                    "value": 4.6443908991413725
                }
				]
			}
			]
		}';*/
		
		$datos='{
		"name": "Campañas",
		"children": [ ';
		
		$clasificaciones=$this->modelo->clasificaciones_campa();
		$total_clasificaciones=$clasificaciones->num_rows()-1;
	 	$i1=0;
		$campas=$this->modelo->montos_campas($anio);
		$total_campas=$campas->num_rows()-1;
	 	$i2=0;
		$costo_total_categoria=0;
		
		foreach($clasificaciones->result() as $fila) { 
		  	$costo_total_categoria=0;
			$datos=$datos.'{ "name":"'.$fila->descripcion_clasificacion.'",
			"children": [ ';
	 		foreach($campas->result() as $fila2) {
				
				if($fila->descripcion_clasificacion==$fila2->descripcion_clasificacion){
				$datos=$datos.'{
                    "url": "'.base_url().'index.php/campas/detalle_campa/'.$fila2->id_campa.'",
                    "name": "'.$fila2->nombre.'",
                    "size": '.$fila2->costo_campa.',
                    "value": 4.6443908991413725
                },';	 		
				$costo_total_categoria=$costo_total_categoria+$fila2->costo_campa;
				}
	 		}
			$datos = substr($datos, 0, -1);
			//quitar última coma (,)
			$datos=$datos.'],
			"size": '.$costo_total_categoria.'
			},';
	 	}
		$datos = substr($datos, 0, -1);
		//quitar última coma (,)
		$datos=$datos.'] }';
		
		write_file('treemap/datos.json', $datos);		
	    
	    $data['opcion'] = 'campas';	
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera',$data);
		$data['num_campas']=$this->modelo->campas_realizadas($anio);	
		$data['promedio_campas']=$this->modelo->costo_promedio_campa($anio);
		$data['monto_total_campas']=$this->modelo->monto_total_campas($anio);
		//$data['montos_campas']=$this->modelo->montos_campas($anio);
		$data['anios_campas']=$this->modelo->anios_campas();
		$data['anio']=$anio;
		
		if($anio==date("Y"))
		$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();
		
		$data['todas_campas']=$this->modelo_listado->lista_campas($anio);
		$data['clasificaciones_campas']=$this->modelo_listado->clasificaciones_campas();
		$data['dependencias_contratantes_campas']=$this->modelo_listado->dependencias_contratantes_campas();
		
  		$this->load->view('campas',$data);	
		$this->load->view('pie');								
  } 
  
  function detalle_campa($id){
	  	$data['opcion'] = 'campas';	
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera',$data);
		$data['detalles']=$this->modelo->detalle_campa($id);		
		$data['etiquetas_campa'] = $this->modelo->etiquetas_campa($id);
		$data['clasificacion_gastos']=$this->modelo->clasificacion_gasto_campa($id);
		$data['fotos']=$this->modelo->fotos_campa($id);	
		$data['videos']=$this->modelo->videos_campa($id);
		$data['audios']=$this->modelo->audios_campa($id); 
  		$this->load->view('detalle_campa',$data);	
		$this->load->view('pie');
  }
  
  function cargar_por_anio(){
	    $anio=$this->input->post('anio');
		
		$datos='{
		"name": "Campañas",
		"children": [ ';
		
		$clasificaciones=$this->modelo->clasificaciones_campa();
		$total_clasificaciones=$clasificaciones->num_rows()-1;
	 	$i1=0;
		$campas=$this->modelo->montos_campas($anio);
		$total_campas=$campas->num_rows()-1;
	 	$i2=0;
		
		foreach($clasificaciones->result() as $fila) { 
			$datos=$datos.'{ "name":"'.$fila->descripcion_clasificacion.'",
			"children": [ ';
	 		foreach($campas->result() as $fila2) {
				
				if($fila->descripcion_clasificacion==$fila2->descripcion_clasificacion){
				$datos=$datos.'{
                    "url": "'.base_url().'index.php/campas/detalle_campa/'.$fila2->id_campa.'",
                    "name": "'.$fila2->nombre.'",
                    "size": '.$fila2->costo_campa.',
                    "value": 4.6443908991413725
                },';	 		
				}
	 		}
			$datos = substr($datos, 0, -1);
			//quitar última coma (,)
			$datos=$datos.'] },';
	 	}
		$datos = substr($datos, 0, -1);
		//quitar última coma (,)
		$datos=$datos.'] }';
		
		write_file('treemap/datos.json', $datos);	
		
	    $data['opcion'] = 'campas';	
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  	$this->load->view('cabecera',$data);
		$data['num_campas']=$this->modelo->campas_realizadas($anio);	
		$data['promedio_campas']=$this->modelo->costo_promedio_campa($anio);
		$data['monto_total_campas']=$this->modelo->monto_total_campas($anio);
		$data['montos_campas']=$this->modelo->montos_campas($anio);
		$data['anios_campas']=$this->modelo->anios_campas();
		$data['anio']=$anio;
		
		if($anio==date("Y"))
		$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();
		
		$data['todas_campas']=$this->modelo_listado->lista_campas($anio); //CAMBIAR
		$data['clasificaciones_campas']=$this->modelo_listado->clasificaciones_campas();
		$data['dependencias_contratantes_campas']=$this->modelo_listado->dependencias_contratantes_campas();

		//echo '<pre>';var_dump($data);
		
  		$this->load->view('campas',$data);	
		$this->load->view('pie');	 						
  }
       
}