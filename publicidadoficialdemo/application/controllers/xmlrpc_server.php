<?php
class Xmlrpc_server extends CI_Controller {
	function index()
	{
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');		
		$this->load->helper('url');
		$this->load->model('modelo_datos');		
		$this->load->dbutil();
		
		$config['functions']['Datos'] = array('function' => 'Xmlrpc_server.process');
		
		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
		
	}
	
	
	function process($peticion)
	{
		
	  //$delimiter = ",";
	  //$newline = "\r\n";
	  
	  $datos1="";
	  $datos2="";
	  $datos3="";
	  $datos4="";
	  $datos5="";
	  $datos6="";
	  $datos7="";
	  $datos8="";
	  $datos9="";
	  $datos10="";
	  $datos11="";
	  $datos12="";
	  $datos13="";

	  //$datos14=$this->dbutil->csv_from_result($this->modelo_datos->presupuestos(),$delimiter, $newline);	  	  
		
	  $consulta=$this->modelo_datos->presupuestos();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos1=$datos1.$fila->año.",".$fila->monto_total."\n";
	  }	  	  
	  
	  ///$datos1=$this->dbutil->csv_from_result($this->modelo_datos->presupuestos(),$delimiter, $newline);
	  //$datos2=$this->dbutil->csv_from_result($this->modelo_datos->gastado_publicidad(),$delimiter, $newline);
	  
	  //$datos=$datos1.$datos2;
	  
	  $consulta=$this->modelo_datos->gastado_publicidad();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos2=$datos2.$fila->año.",".$fila->monto_total_gastado."\n";
	  }
	  
	  $datos="Presupuestos \n".$datos1.",\n Gastado comunicación social \n".$datos2."\n";
	  
	  $consulta=$this->modelo_datos->numero_medios();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos3=$datos3.$fila->año.",".$fila->num_medios."\n";
	  }
	  
	  $datos=$datos."Numero de medios contratados \n".$datos3."\n";
	  
	  $consulta=$this->modelo_datos->numero_medios_coberturas();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos4=$datos4.$fila->año.",".$fila->cobertura.",".$fila->num_medios."\n";
	  }
	  
	  $datos=$datos."Numero de medios contratados por cobertura \n".$datos4."\n";
	  
	  $consulta=$this->modelo_datos->numero_medios_tipo();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos5=$datos5.$fila->año.",".$fila->tipo_de_medio.",".$fila->num_medios."\n";
	  }
	  
	  $datos=$datos."Numero de medios contratados por clasificación \n".$datos5."\n";
	  
	  $consulta=$this->modelo_datos->cantidad_medios_clasificacion();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos6=$datos6.$fila->año.",".$fila->clasificacion_de_medio.",".$fila->total."\n";
	  }
	  
	  $datos=$datos."Montos contratados por clasificación de medio \n".$datos6."\n";
	  
	  $consulta=$this->modelo_datos->montos_contratados();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos7=$datos7.$fila->año.",".$fila->total."\n";
	  }
	  
	  $datos=$datos."Montos contratados \n".$datos7."\n";
	  
	  $consulta=$this->modelo_datos->numero_campas();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos8=$datos8.$fila->año.",".$fila->num_campas."\n";
	  }
	  
	  $datos=$datos."Numero de campañas \n".$datos8."\n";
	  
	  $consulta=$this->modelo_datos->numero_campas_cobertura();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos9=$datos9.$fila->año.",".$fila->cobertura.",".$fila->numero_de_campañas."\n";
	  }
	  
	  $datos=$datos."Numero de campañas por cobertura \n".$datos9."\n";
	  
	  $consulta=$this->modelo_datos->numero_campas_categoria();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos10=$datos10.$fila->año.",".$fila->categoria_de_campaña.",".$fila->numero_de_campañas."\n";
	  }
	  
	  $datos=$datos."Numero de campañas por categoria \n".$datos10."\n";
	  
	  $consulta=$this->modelo_datos->numero_dependencias();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos11=$datos11.$fila->numero_de_dependencias."\n";
	  }
	  
	  $datos=$datos."Numero de dependencias participantes \n".$datos11."\n";
	  
	  $consulta=$this->modelo_datos->numero_dependencias_contratantes();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos12=$datos12.$fila->numero_de_dependencias_contratantes."\n";
	  }
	  
	  $datos=$datos."Numero de dependencias participantes contratantes \n".$datos12."\n";
	  
	  $consulta=$this->modelo_datos->numero_dependencias_solicitantes();
		
	  foreach($consulta->result() as $fila) {	
	  		$datos13=$datos13.$fila->numero_de_dependencias_solicitantes."\n";
	  }
	  
	  $datos=$datos."Numero de dependencias solicitantes \n".$datos13."\n";
	  	  	  	   
		//$parametros = $peticion->output_parameters();
		
		/*$respuesta = array(
							array(
									'usted_dijo'  => $parametros['0'],
									'yo_respondo' => 'Nada mal.'),
							'struct');*/
						
		return $this->xmlrpc->send_response($datos);
	}
}
?>