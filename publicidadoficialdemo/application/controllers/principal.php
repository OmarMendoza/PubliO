<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Principal extends CI_Controller {

  function __construct()
  {
	
    parent::__construct();
	$this->load->helper('url');
	$this->load->model('modelo');
	$this->load->dbutil();
	$this->load->helper('download');
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
    //redirect('principal/cargar');
	$anio=$this->modelo->anio_inicial_principal();		
	$data['opcion'] = 'inicio';	
	$data['logo'] = $this->modelo->logo();
	$data['url_logo'] = $this->modelo->url_logo();
	$data['logo_opcional'] = $this->modelo->logo_opcional();
	$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	$this->load->view('cabecera',$data);	 
	$data['presupuesto']=$this->modelo->obtener_presupuesto_actual($anio);
	$data['gastado']=$this->modelo->gastado_al_momento($anio);
	$data['num_medios']=$this->modelo->medios_contratados($anio);
	$data['num_campas']=$this->modelo->campas_realizadas($anio);	
	$data['desgloses']=$this->modelo->desglose_presupuesto($anio);
	$data['clasificacion']=$this->modelo->clasificacion_gastos_tipo_medio($anio);
	$data['medios_participantes']=$this->modelo->nombre_medios_participantes($anio);
	$data['anios_principal']=$this->modelo->anios_principal();
	$data['anio']=$anio;
	
	if($anio==date("Y")){
	$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();}
		
  	$this->load->view('principal',$data);
	$this->load->view('pie');		
  }  
  
  function cargar_por_anio(){
	    if(isset($_GET['anio'])){
			$anio=$_GET['anio'];
		}
		else{
			$anio=$this->input->post('anio');
		}
	    $data['opcion'] = 'inicio';
		$data['logo'] = $this->modelo->logo();
		$data['url_logo'] = $this->modelo->url_logo();
		$data['logo_opcional'] = $this->modelo->logo_opcional();
		$data['url_logo_opcional'] = $this->modelo->url_logo_opcional();	
		$this->load->view('cabecera',$data);			 
		$data['presupuesto']=$this->modelo->obtener_presupuesto_actual($anio);
		$data['gastado']=$this->modelo->gastado_al_momento($anio);
		$data['num_medios']=$this->modelo->medios_contratados($anio);
		$data['num_campas']=$this->modelo->campas_realizadas($anio);	
		$data['desgloses']=$this->modelo->desglose_presupuesto($anio); 
		$data['clasificacion']=$this->modelo->clasificacion_gastos_tipo_medio($anio);
		$data['medios_participantes']=$this->modelo->nombre_medios_participantes($anio);
		$data['anios_principal']=$this->modelo->anios_principal();
		$data['anio']=$anio;
		
		if($anio==date("Y")){
		$data['ultima_actualizacion']=$this->modelo->ultima_actualizacion_factura();}
	
		$this->load->view('principal',$data);
		$this->load->view('pie');								
  } 
  
  function buscar(){
	  
	  $dato = $this->input->post('buscar');	
	  
	  $data['opcion'] = 'busqueda';	
	  $data['resultado_presupuesto']=$this->modelo->buscar_presupuesto($dato);
	  $data['resultado_medios']=$this->modelo->buscar_medios($dato);
	  $data['resultado_contratos']=$this->modelo->buscar_contratos($dato);
	  $data['resultado_campas']=$this->modelo->buscar_campas($dato);
	  $data['resultado_dependencias']=$this->modelo->buscar_dependencias($dato);
	  
	  $data['logo'] = $this->modelo->logo();
	  $data['url_logo'] = $this->modelo->url_logo();
	  $data['logo_opcional'] = $this->modelo->logo_opcional();
	  $data['url_logo_opcional'] = $this->modelo->url_logo_opcional();
	  
	  $this->load->view('cabecera',$data);
	  $this->load->view('busqueda',$data);
	  $this->load->view('pie');	  	  
  }
  
   function obtener_datos_presupuesto(){	   	  			
		$config = array (
				'root'    => 'dependencias',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
		);
		header("Content-Type: application/rss+xml; charset=utf-8");
		$datos=$this->dbutil->xml_from_result($this->modelo->dependencias(),$config);
		
		echo $datos;
		
		//write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config));
		
		//if(!write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config)))
			//echo "No se pudo";
		//else
			//echo "Se grabo";
  }
  
  function obtener_datos_campa(){	   	  			
		$config = array (
				'root'    => 'dependencias',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
		);
		header("Content-Type: application/rss+xml; charset=utf-8");
		$datos=$this->dbutil->xml_from_result($this->modelo->dependencias(),$config);
		
		echo $datos;
		
		//write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config));
		
		//if(!write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config)))
			//echo "No se pudo";
		//else
			//echo "Se grabo";
  }
  
  function obtener_datos_contratos(){	   	  			
		$config = array (
				'root'    => 'dependencias',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
		);
		header("Content-Type: application/rss+xml; charset=utf-8");
		$datos=$this->dbutil->xml_from_result($this->modelo->dependencias(),$config);
		
		echo $datos;
		
		//write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config));
		
		//if(!write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config)))
			//echo "No se pudo";
		//else
			//echo "Se grabo";
  }
  
  function obtener_datos_medios(){	   	  			
		$config = array (
				'root'    => 'dependencias',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
		);
		header("Content-Type: application/rss+xml; charset=utf-8");
		$datos=$this->dbutil->xml_from_result($this->modelo->dependencias(),$config);
		
		echo $datos;
		
		//write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config));
		
		//if(!write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config)))
			//echo "No se pudo";
		//else
			//echo "Se grabo";
  }
  
  function obtener_datos_facturas(){	   	  			
		$config = array (
				'root'    => 'dependencias',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
		);
		header("Content-Type: application/rss+xml; charset=utf-8");
		$datos=$this->dbutil->xml_from_result($this->modelo->dependencias(),$config);
		
		echo $datos;
		
		//write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config));
		
		//if(!write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config)))
			//echo "No se pudo";
		//else
			//echo "Se grabo";
  }
  
  function obtener_datos_dependencias(){	   	  			
		$config = array (
				'root'    => 'dependencias',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
		);
		header("Content-Type: application/rss+xml; charset=utf-8");
		$datos=$this->dbutil->xml_from_result($this->modelo->dependencias(),$config);
		
		echo $datos;
		
		//write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config));
		
		//if(!write_file('dependencias.xml', $this->dbutil->xml_from_result($this->modelo->dependencias(),$config)))
			//echo "No se pudo";
		//else
			//echo "Se grabo";
  }
  
  function descarga_datos(){
	  
	  $delimiter = ",";
	  $newline = "\r\n";

	  $datos="Presupuestos,\r\n".$this->dbutil->csv_from_result($this->modelo->presupuestos(),$delimiter, $newline);
	  $datos=$datos."Desglose de presupuestos,\r\n".$this->dbutil->csv_from_result($this->modelo->detalle_presupuestos(),$delimiter, $newline);		
	  $datos=$datos."Dependencias,\r\n".$this->dbutil->csv_from_result($this->modelo->datos_dependencias(),$delimiter, $newline);  
	  $datos=$datos."Campañas,\r\n".$this->dbutil->csv_from_result($this->modelo->campas(),$delimiter, $newline);
	  //$datos=$datos."Medios,\r\n".$this->dbutil->csv_from_result($this->modelo->medios(),$delimiter, $newline);
	  //$datos=$datos."Contratos,\r\n".$this->dbutil->csv_from_result($this->modelo->contratos(),$delimiter, $newline);	  	  
		  
	  $nombre = 'datos.csv';

      force_download($nombre, $datos);
	  
  }
       
}