<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Contratosmedios extends CI_Controller {

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
    redirect('contratosmedios/cargar');			
  }
  
  function cargar(){
	    $anio=$this->modelo->anio_inicial_contratos();
	    $data['opcion'] = 'contratosmedios';
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	
	  	$this->load->view('cabecera',$data);
		$data['num_medios']=$this->modelo->medios_contratados($anio);
		$data['monto_contratado']=$this->modelo->monto_contratado($anio);
		$data['anios_medios_contratados']=$this->modelo->anios_medios_contratados();
		$data['anio']=$anio;
		
		if($anio==date("Y"))
		$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();
		
		$data['todo_medios']=$this->modelo_listado->lista_medios();	 
  		$this->load->view('contratosmedios',$data);	
		$this->load->view('pie');								
  } 
  
  function detalle_contratomedio($id){
	    $data['opcion'] = 'contratosmedios';
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	
	  	$this->load->view('cabecera',$data);
		$data['detalles']=$this->modelo->detalle_contratomedio($id);
		$data['contratos_medio']=$this->modelo_listado->lista_contratos($id);	 
  		$this->load->view('detalle_contratomedio',$data);	
		$this->load->view('pie');								
  }
  
  function cargar_por_anio(){
	    $anio=$this->input->post('anio');
	    $data['opcion'] = 'contratosmedios';
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	
	  	$this->load->view('cabecera',$data);
		$data['num_medios']=$this->modelo->medios_contratados($anio);
		$data['monto_contratado']=$this->modelo->monto_contratado($anio);
		$data['anios_medios_contratados']=$this->modelo->anios_medios_contratados();
		$data['anio']=$anio;
		
		if($anio==date("Y"))
		$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();
			 
  		$data['todo_medios']=$this->modelo_listado->lista_medios();	
		$this->load->view('contratosmedios',$data);	
		$this->load->view('pie');							
  }
       
}