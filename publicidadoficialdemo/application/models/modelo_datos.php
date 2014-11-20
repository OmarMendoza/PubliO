<?php 
class Modelo_datos extends CI_Model{

	function __construct(){
		parent::__construct();
	}

function presupuestos(){	 						
		$query = $this->db->query("select anio as año, monto_total from tp_presupuesto");      			
		return $query;							
}

function detalle_presupuestos(){	 						
		$query = $this->db->query("select anio as año, concepto, cantidad, porcentaje from tp_desglose_presupuesto, tp_presupuesto where presupuesto=id_presupuesto");      			
		return $query;							
}

function gastado_publicidad(){
	$query = $this->db->query("select year(fecha) as año, SUM(monto_total) as monto_total_gastado from tp_factura group by year(fecha)");
	return $query;	
}

function numero_medios(){	 						
		$query = $this->db->query("select year(fecha_celebracion) as año, COUNT(DISTINCT medio) as num_medios from tp_contratos GROUP BY year(fecha_celebracion)");      			
		return $query;							
}

function numero_medios_coberturas(){	 						
		$query = $this->db->query("select year(fecha_celebracion) as año, tp_cobertura.cobertura, COUNT(DISTINCT medio) as num_medios 
from tp_contratos, tp_medios, tp_cobertura where medio=id_medio and tp_medios.cobertura=id_cobertura GROUP BY year(fecha_celebracion), cobertura");      			
		return $query;							
}

function numero_medios_tipo(){
		$query = $this->db->query("select year(fecha_celebracion) as año, tp_clasificacion.descripcion_clasificacion as tipo_de_medio, COUNT(DISTINCT medio) as num_medios from tp_contratos, tp_medios, tp_clasificacion where medio=id_medio and tp_medios.clasificacion=tp_clasificacion.id_clasificacion 
GROUP BY year(fecha_celebracion), clasificacion");      			
		return $query;
}

function cantidad_medios_clasificacion(){	 						
		$query = $this->db->query("select year(fecha) as año, descripcion_clasificacion as clasificacion_de_medio, SUM(monto_total) as total from tp_factura, tp_medios, tp_clasificacion where medio_id=id_medio and tp_medios.clasificacion=id_clasificacion GROUP BY año, id_clasificacion");      			
		return $query;							
}

function montos_contratados(){
	$query = $this->db->query("select year(fecha_celebracion) as año, SUM(monto_contrato) as total from tp_contratos group by year(fecha_celebracion)");
	return $query;
}

function numero_campas(){	 						
		$query = $this->db->query("select anio as año, COUNT(*) as num_campas from tp_campa GROUP BY anio");      			
		return $query;							
}

function numero_campas_cobertura(){	 						
		$query = $this->db->query("select anio as año, tp_tipo_campa.tipo as cobertura, COUNT(*) as numero_de_campañas from tp_campa, tp_tipo_campa where tp_campa.tipo=id_tipo GROUP BY anio, tp_campa.tipo");      			
		return $query;							
}

function numero_campas_categoria(){	 						
		$query = $this->db->query("select anio as año, tp_clasificacion_campa.descripcion_clasificacion as categoria_de_campaña, COUNT(*) as numero_de_campañas from tp_campa, tp_clasificacion_campa where tp_clasificacion_campa.id_clasificacion_campa=tp_clasificacion_campa 
GROUP BY anio, tp_clasificacion_campa.id_clasificacion_campa");      			
		return $query;							
}

function numero_dependencias(){	 						
		$query = $this->db->query("select count(*) as numero_de_dependencias from tp_dependencia");      			
		return $query;							
}

function numero_dependencias_contratantes(){	 						
		$query = $this->db->query("select count(*) as numero_de_dependencias_contratantes from tp_dependencia where tipo='contratante' or tipo='ambos'");      			
		return $query;							
}

function numero_dependencias_solicitantes(){	 						
		$query = $this->db->query("select count(*) as numero_de_dependencias_solicitantes from tp_dependencia where tipo='solicitante' or tipo='ambos'");      			
		return $query;							
}

}