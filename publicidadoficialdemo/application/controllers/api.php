<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

  function __construct()
  {
	
    parent::__construct();
	$this->load->helper('url');
	$this->load->model('modelo');
	$this->load->dbutil();	
  }

  public function index()
  {
	  $config = array (
				'root'    => 'presupuestos',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
	  );
	  header("Content-Type: application/rss+xml; charset=utf-8");
	  $datos=$this->dbutil->xml_from_result($this->modelo->presupuestos(),$config);
	  
	  $config = array (
				'root'    => 'desglose de presupuestos',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
	  );
	  header("Content-Type: application/rss+xml; charset=utf-8");
	  $datos=$datos.$this->dbutil->xml_from_result($this->modelo->detalle_presupuestos(),$config);
	  
	  $config = array (
				'root'    => 'dependencias',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
	  );
	  header("Content-Type: application/rss+xml; charset=utf-8");
	  $datos=$datos.$this->dbutil->xml_from_result($this->modelo->datos_dependencias(),$config);
	  
	  $config = array (
				'root'    => 'campañas',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
	  );
	  header("Content-Type: application/rss+xml; charset=utf-8");
	  $datos=$datos.$this->dbutil->xml_from_result($this->modelo->campas(),$config);
	  
	  $config = array (
				'root'    => 'medios',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
	  );
	  header("Content-Type: application/rss+xml; charset=utf-8");
	  $datos=$datos.$this->dbutil->xml_from_result($this->modelo->medios(),$config);
	  
	  $config = array (
				'root'    => 'contratos',
				'element' => 'registro',
				'newline' => "\n",
				'tab'    => "\t"
	  );
	  header("Content-Type: application/rss+xml; charset=utf-8");
	  $datos=$datos.$this->dbutil->xml_from_result($this->modelo->contratos(),$config);
	  
	  echo $datos;
  }    
       
}