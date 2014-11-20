<?php 
class Modelo_listado extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
// get person by id
function lista_campas($anio){	//SE LE AGREGO EL PARAMETRO ANIO  						
		$query = $this->db->query("select id_campa, nombre, tp_dependencia.dependencia as dependencia_solicitante, anio, descripcion_clasificacion, tp_tipo_campa.tipo as tipo, 
SUM(tp_detalle_factura.monto_concepto*unidades) as total_campa
 from tp_campa, tp_clasificacion_campa, tp_tipo_campa, tp_dependencia, tp_detalle_factura, tp_factura 
 where clasificacion_campa=id_clasificacion_campa and  
tp_campa.tipo=tp_tipo_campa.id_tipo and
depen=id_dependencia and id_campa=campa_factura and tp_factura.id_factura=tp_detalle_factura.factura 
and anio = $anio
GROUP BY id_campa");      			
		return $query;							
}

function lista_campas_medios($anio,$id){	 						
		$query = $this->db->query("select
tp_campa.id_campa, tp_campa.nombre, YEAR(tp_campa.periodicidad_inicio) as anio,
tp_clasificacion_campa.descripcion_clasificacion as clasificacioncampa,
tp_dependencia.dependencia as dependencia_solicitante, 
tp_clasificacion.descripcion_clasificacion as tipomedio,
tp_cobertura.cobertura,
tp_clasificacion.id_clasificacion as idtipomedio, 
tp_detalle_factura.factura,
sum(tp_detalle_factura.monto_concepto*tp_detalle_factura.unidades)as totalmedio

from tp_campa 
     INNER JOIN tp_clasificacion_campa on tp_campa.tipo=tp_clasificacion_campa.id_clasificacion_campa
     INNER JOIN tp_dependencia on tp_campa.depen=tp_dependencia.id_dependencia
     INNER JOIN tp_detalle_factura on tp_detalle_factura.campa_factura=tp_campa.id_campa
		 INNER JOIN tp_factura on tp_detalle_factura.factura=tp_factura.id_factura
     INNER JOIN tp_medios on tp_factura.medio_id=tp_medios.id_medio
     INNER JOIN tp_clasificacion on tp_medios.clasificacion=tp_clasificacion.id_clasificacion 
     INNER JOIN tp_cobertura on tp_campa.tipo=tp_cobertura.id_cobertura
where tp_clasificacion.id_clasificacion=$id 
AND YEAR (tp_campa.periodicidad_inicio) = $anio GROUP BY id_campa");      			
		return $query;							
}


function clasificaciones_campas(){	 						
		$query = $this->db->query("select campa_factura, tp_medios.clasificacion from tp_detalle_factura, tp_factura, tp_medios where id_factura=factura and medio_id=id_medio");      			
		return $query;							
}

function dependencias_contratantes_campas(){	 						
		$query = $this->db->query("select DISTINCT dependencia, campa_factura from tp_dependencia, tp_factura, tp_detalle_factura where 
id_dependencia=dependencia_contratante and id_factura=factura");      			
		return $query;							
}

function lista_campas_depen_contratante($id_dependencia,$anio){	 						
		$query = $this->db->query("select id_campa, nombre, anio, tp_tipo_campa.tipo, sum(monto_concepto*unidades) as monto_campa 
from tp_campa, tp_tipo_campa, tp_dependencia, tp_factura, tp_detalle_factura where tp_campa.tipo=tp_tipo_campa.id_tipo 
and dependencia_contratante=id_dependencia and factura=id_factura 
and campa_factura=id_campa and dependencia_contratante=".$id_dependencia." and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31' GROUP BY id_campa");      			
		return $query;							
}

function lista_campas_depen_solicitante($id_dependencia,$anio){	 						
		$query = $this->db->query("select id_campa, nombre, anio, tp_tipo_campa.tipo, sum(monto_concepto*unidades) as monto_campa 
from tp_campa, tp_tipo_campa, tp_dependencia, tp_factura, tp_detalle_factura where tp_campa.tipo=tp_tipo_campa.id_tipo 
and factura=id_factura and dependencia_s=id_dependencia
and campa_factura=id_campa and dependencia_s=".$id_dependencia." 
and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31' GROUP BY id_campa");      			
		return $query;							
}

function lista_campas_depen_busqueda($id_dependencia){	 						
		$query = $this->db->query("select id_campa, nombre, anio, tp_tipo_campa.tipo, sum(monto_concepto*unidades) as monto_campa 
from tp_campa, tp_tipo_campa, tp_dependencia, tp_factura, tp_detalle_factura where tp_campa.tipo=tp_tipo_campa.id_tipo 
and factura=id_factura and dependencia_s=id_dependencia
and campa_factura=id_campa and dependencia_s=".$id_dependencia." 
GROUP BY id_campa");      			
		return $query;							
}

function lista_contratos($id_medio){	 						
		$query = $this->db->query("select num_contrato,objeto_contrato, fecha_celebracion,monto_contrato,sum(monto_total) as monto_gastado  from tp_contratos, tp_factura where contrato=id_contrato and medio=".$id_medio." group by id_contrato");      			
		return $query;							
}

function lista_dependencias_contratantes(){	 						
		$query = $this->db->query("select id_dependencia,dependencia,sum(monto_total) as monto, fecha, EXTRACT(YEAR FROM fecha) as anio from tp_dependencia, tp_factura 
where id_dependencia=dependencia_contratante GROUP BY id_dependencia, anio");      			
		return $query;							
}

function lista_dependencias_solicitantes(){	 						
		$query = $this->db->query("select id_dependencia, dependencia,sum(monto_concepto*unidades) as monto, fecha, EXTRACT(YEAR FROM fecha) as anio from tp_dependencia, tp_factura, tp_detalle_factura where id_factura=factura and dependencia_s=id_dependencia GROUP BY id_dependencia, anio");      			
		return $query;							
}

function lista_medios(){	 						
		$query = $this->db->query("select id_medio, nombre_comercial, descripcion_clasificacion, EXTRACT(YEAR FROM fecha_celebracion) as anio, tp_cobertura.cobertura, SUM(monto_contrato) as contratado from tp_contratos, tp_medios, tp_clasificacion, tp_cobertura where medio=id_medio and clasificacion=id_clasificacion and tp_medios.cobertura=id_cobertura GROUP BY medio;");      			
		return $query;							
}


}