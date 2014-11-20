<?php 
class Modelo extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
// get person by id
function dependencias(){	 						
		$query = $this->db->query("select id_dependencia, dependencia from tp_dependencia");      			
		return $query;							
}

function anio_inicial_principal(){	 						
		$query = $this->db->query("select max(anio) as anio from tp_presupuesto, 
tp_desglose_presupuesto where id_presupuesto=presupuesto");      			
		$row = $query->row();
		return $row->anio;							
}


function anios_principal(){	 						
		$query = $this->db->query("select distinct anio from tp_presupuesto, 
tp_desglose_presupuesto where id_presupuesto=presupuesto");      			
		return $query;							
}

function obtener_presupuesto_actual($anio){
	$query = $this->db->query("select monto_total from tp_presupuesto where anio=".$anio);	
	if($query->num_rows>0){		
	$row = $query->row();
	return $row->monto_total;	
	}
	else{
	return 0;
	}
}

function desglose_presupuesto($anio){
	$query = $this->db->query("select * from tp_presupuesto, tp_desglose_presupuesto where id_presupuesto=presupuesto and anio=".$anio);
	return $query;
}

function gastado_al_momento($anio){
	$query = $this->db->query("select SUM(monto_total) as monto_total from tp_factura where fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31'");
	$row = $query->row();
	return $row->monto_total;
}

function anio_inicial_contratos(){	 						
		$query = $this->db->query("select max(YEAR(fecha_fin)) as anio from tp_contratos");      			
		$row = $query->row();
		return $row->anio;						
}

function anios_medios_contratados(){	 						
		$query = $this->db->query("select DISTINCT YEAR(fecha_fin) as anio from tp_contratos");      			
		return $query;							
}

function medios_contratados($anio){	
	$query = $this->db->query("select COUNT(DISTINCT medio) as num_medios from tp_contratos WHERE fecha_celebracion>='".$anio."-01-01' and fecha_celebracion<='".$anio."-12-31'");
	$row = $query->row();
	return $row->num_medios;
}

function anio_inicial_campas(){	 						
		$query = $this->db->query("select max(anio) as anio from tp_campa");      			
		$row = $query->row();
		return $row->anio;							
}
function anio_inicial_campas_medios($id){	 						
		$query = $this->db->query("select max(anio) as anio from tp_campa where tipo=$id");      			
		$row = $query->row();
		return $row->anio;							
}
function anios_campas(){	 						
		$query = $this->db->query("select DISTINCT anio from tp_campa");      			
		return $query;							
}

function campas_realizadas($anio){	
	$query = $this->db->query("select COUNT(*) as num_campas from tp_campa WHERE anio=".$anio);
	$row = $query->row();
	return $row->num_campas;
}
//PEWNDIENTE TODO
function campas_medios_realizadas($anio,$id){	
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
	//$row = $query->row();
	return $query->num_rows();
}

function clasificacion_gastos_tipo_medio($anio){
	$query = $this->db->query("select id_clasificacion, descripcion_clasificacion, SUM(monto_total) as total from tp_factura, tp_medios, tp_clasificacion 
where medio_id=id_medio and tp_medios.clasificacion=id_clasificacion and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31' GROUP BY id_clasificacion;");
	return $query;			 
}
function clasificacion_gastos_tipo_medioc($anio,$id){
	$query = $this->db->query("select id_clasificacion, descripcion_clasificacion, SUM(monto_total) as total from tp_factura, tp_medios, tp_clasificacion where medio_id=id_medio and tp_medios.clasificacion=id_clasificacion and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31' and id_clasificacion=".$id." GROUP BY id_clasificacion;");
	$row = $query->row();
	return $row->total;			 
}
function nombre_medios_participantes($anio){
	$query = $this->db->query("select nombre_comercial,id_clasificacion,sum(monto_total) as total from tp_clasificacion,tp_medios,tp_factura where id_clasificacion=clasificacion and id_medio=medio_id and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31' GROUP BY id_medio");
	return $query;
}

function costo_promedio_campa($anio){	
	$query = $this->db->query("select sum(monto_concepto)/(select count(DISTINCT campa_factura) 
from tp_detalle_factura, tp_campa where id_campa=campa_factura and anio=".$anio.") as promedio from tp_campa, tp_detalle_factura where id_campa=campa_factura and anio=".$anio);
	
	if($query->num_rows>0){		
	$row = $query->row();
	return $row->promedio;	
	}
	else{
	return 0;
	}
}

function monto_contratado($anio){
	$query = $this->db->query("select SUM(monto_contrato) as total from tp_contratos WHERE fecha_celebracion>='".$anio."-01-01' and fecha_celebracion<='".$anio."-12-31'");
	$row = $query->row();
	return $row->total;
}

function detalle_campa($id){
	$query = $this->db->query("select nombre, tp_tipo_campa.tipo, anio, periodicidad_inicio, periodicidad_fin, tema, objetivo, SUM(monto_concepto*unidades) as monto_total, dependencia, descripcion_clasificacion  
from tp_campa, tp_tipo_campa, tp_clasificacion_campa, tp_dependencia, tp_detalle_factura where tp_campa.tipo=tp_tipo_campa.id_tipo and depen=id_dependencia 
and id_dependencia=tp_detalle_factura.dependencia_s and tp_detalle_factura.campa_factura=id_campa and clasificacion_campa=id_clasificacion_campa and id_campa=".$id." GROUP BY id_campa");
	return $query;	
}

function etiquetas_campa($id){
	$query = $this->db->query("select etiqueta from tp_etiquetas, tp_etiquetas_campas where id_etiqueta=etiquetas_id_etiqueta and etiquetas_id_campa=".$id);
	return $query;
}

function detalle_contratomedio($id){
	$query = $this->db->query("select * from tp_medios, tp_clasificacion, tp_cobertura where clasificacion=id_clasificacion and tp_medios.cobertura=id_cobertura and id_medio=".$id);
	return $query;	
}

function fotos_campa($id){
	$query = $this->db->query("select * from tp_banners_campa where campa=".$id);
	return $query;	
}

function videos_campa($id){
	$query = $this->db->query("select * from tp_videos_campa where campa=".$id);
	return $query;	
}

function audios_campa($id){
	$query = $this->db->query("select * from tp_audios_campa where campa=".$id);
	return $query;	
}

function nombre_dependencia($id){	
	$query = $this->db->query("select * from tp_dependencia WHERE id_dependencia=".$id);
	$row = $query->row();
	return $row->dependencia;
}

function monto_total_campas($anio){	
	$query = $this->db->query("select SUM(monto_concepto*unidades) as total from tp_campa, tp_detalle_factura where id_campa=campa_factura and anio=".$anio);	
	
	if($query->num_rows>0){		
	$row = $query->row();
	return $row->total;	
	}
	else{
	return 0;
	}
}

function clasificaciones_campa(){	 						
		$query = $this->db->query("select descripcion_clasificacion from tp_clasificacion_campa");      			
		return $query;							
}

function anio_inicial_dependencias(){	 						
		$query = $this->db->query("select distinct max(YEAR(fecha)) as anio from tp_factura");      			
		$row = $query->row();
		return $row->anio;						
}

function anios_dependencias(){	 						
		$query = $this->db->query("select distinct YEAR(fecha) as anio from tp_factura");      			
		return $query;							
}

function montos_campas($anio){	
	$query = $this->db->query("select SUM(monto_concepto*unidades) as costo_campa, nombre, tema as tema_campa, id_campa, descripcion_clasificacion from tp_campa, tp_clasificacion_campa, 
tp_detalle_factura where clasificacion_campa=id_clasificacion_campa and id_campa=campa_factura and anio=".$anio." GROUP BY campa_factura ORDER BY costo_campa DESC");	
	return $query;

}

function numero_campas_dependencia($id, $anio){	
	$query = $this->db->query("select COUNT(DISTINCT campa_factura) as num_campas from tp_factura, tp_detalle_factura 
WHERE factura=id_factura and dependencia_contratante=".$id." and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31'");
	$row = $query->row();
	return $row->num_campas;
}

function numero_campas_dependencia_solicitante($id, $anio){	
	$query = $this->db->query("select count(*) as num_campas from tp_campa WHERE depen=".$id." and anio=".$anio."");
	$row = $query->row();
	return $row->num_campas;
}

function numero_campas_dependencia_solicitante_busqueda($id){	
	$query = $this->db->query("select count(*) as num_campas from tp_campa WHERE depen=".$id);
	$row = $query->row();
	return $row->num_campas;
}

function monto_gastado_dependencia_contratante($id, $anio){	
	$query = $this->db->query("select sum(monto_total) as total from tp_factura where dependencia_contratante=".$id." and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31'");
	
	if($query->num_rows>0){		
	$row = $query->row();
	return $row->total;	
	}
	else{
	return 0;
	}
}


function monto_gastado_dependencia_solicitante($id, $anio){	
	$query = $this->db->query("select sum(monto_concepto*unidades) as total from tp_detalle_factura, tp_factura 
where tp_detalle_factura.factura=id_factura and dependencia_s=".$id." and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31'");
	
	if($query->num_rows>0){		
	$row = $query->row();
	return $row->total;	
	}
	else{
	return 0;
	}
}

function monto_gastado_dependencia_solicitante_busqueda($id){	
	$query = $this->db->query("select sum(monto_concepto*unidades) as total from tp_detalle_factura, tp_factura 
where tp_detalle_factura.factura=id_factura and dependencia_s=".$id);
	
	if($query->num_rows>0){		
	$row = $query->row();
	return $row->total;	
	}
	else{
	return 0;
	}
}


function monto_total_dependencia_contratante($anio){	
	$query = $this->db->query("select SUM(monto_total) as total from tp_factura where fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31'");
	$row = $query->row();
	return $row->total;
}

function dependencias_contratantes($anio){	
	$query = $this->db->query("select id_dependencia, dependencia, tipo, SUM(monto_total) as monto from tp_dependencia, tp_factura where id_dependencia=dependencia_contratante and (tipo='ambos' or tipo='contratante') and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31' GROUP BY id_dependencia order by monto desc");	
	return $query;
}

function monto_total_dependencia_solicitantes($anio){	
	$query = $this->db->query("select SUM(monto_concepto*unidades) as total from tp_factura, tp_detalle_factura where 
id_factura=factura and fecha>='".$anio."-01-01' and fecha<='".$anio."-31-01'");
	$row = $query->row();
	return $row->total;
}

function dependencias_solicitantes($anio){	
	$query = $this->db->query("select id_dependencia, dependencia, tipo ,SUM(monto_concepto*unidades) as monto from tp_dependencia, tp_factura, tp_detalle_factura where id_factura=factura and id_dependencia=dependencia_s and (tipo='ambos' or tipo='solicitante') and fecha>='".$anio."-01-01' and fecha<='".$anio."-12-31' GROUP BY id_dependencia order by monto desc");	
	return $query;
}

function clasificacion_gasto_campa($id){
	$query = $this->db->query("SELECT sum(monto_concepto*unidades) as monto_medio, nombre_comercial, nombre, clasificacion from tp_campa,tp_factura,tp_detalle_factura,tp_medios where
 id_factura=factura and id_campa=tp_detalle_factura.campa_factura and id_medio=medio_id and id_campa=".$id." GROUP BY id_medio order by clasificacion");
	return $query;	
}

function clasificacion_medio($id){
	$query = $this->db->query("SELECT descripcion_clasificacion from tp_clasificacion where id_clasificacion=".$id);
	if($query->num_rows>0){		
	$row = $query->row();
	return $row->descripcion_clasificacion;	
	}
	else{
	return 0;
	}
		
}
function costo_tipo_medio($id){
	$query = $this->db->query("SELECT 
YEAR(tp_campa.periodicidad_inicio) as anio,
tp_clasificacion.descripcion_clasificacion as tipomedio,
tp_clasificacion.id_clasificacion as idtipomedio,
sum(tp_detalle_factura.monto_concepto*tp_detalle_factura.unidades)as totalmedio

from tp_campa 
     INNER JOIN tp_clasificacion_campa on tp_campa.tipo=tp_clasificacion_campa.id_clasificacion_campa
     INNER JOIN tp_dependencia on tp_campa.depen=tp_dependencia.id_dependencia
     INNER JOIN tp_detalle_factura on tp_detalle_factura.campa_factura=tp_campa.id_campa
		 INNER JOIN tp_factura on tp_detalle_factura.factura=tp_factura.id_factura
     INNER JOIN tp_medios on tp_factura.medio_id=tp_medios.id_medio
     INNER JOIN tp_clasificacion on tp_medios.clasificacion=tp_clasificacion.id_clasificacion 
where tp_clasificacion.id_clasificacion=$id");
	if($query->num_rows>0){		
	$row = $query->row();
	return $row->totalmedio;	
	}
	else{
	return 0;
	}
		
}

function ultima_actualizacion_factura(){	
	$query = $this->db->query("select max(fecha) as ultimo from tp_factura");	
	$row = $query->row();
	
	$fecha="0000-00-00";
	if($row->ultimo!=""){
	list($anio,$mes,$dia)=explode("-",$row->ultimo);
	$fecha=$dia."/".$mes."/".$anio;
	}
	
	return $fecha;
	
}

function ultima_actualizacion_contrato(){	
	$query = $this->db->query("select max(fecha_celebracion) as maximo from tp_contratos");	
	return $query;
	return $row->maximo;
}

function buscar_presupuesto($dato){
	/*$query = $this->db->query("select * from presupuesto, desglose_presupuesto where id_presupuesto=presupuesto and anio like '%".$dato."%' or concepto like '%".$dato."%'");	
	return $query;*/
	
	$this->db->select('*');
	$this->db->from('tp_presupuesto');
	$this->db->join('tp_desglose_presupuesto', 'id_presupuesto = presupuesto');
	$this->db->like('anio', $dato);
	$this->db->or_like('concepto', $dato); 
	$query=$this->db->get();
	//$this->db->join('', 'comentarios.id = blogs.id');	
	return $query;	
}

function buscar_medios($dato){
	$this->db->select('*');
	$this->db->from('tp_medios');
	$this->db->join('tp_clasificacion', 'tp_medios.clasificacion = id_clasificacion');
	$this->db->join('tp_cobertura', 'tp_medios.cobertura = id_cobertura');
	$this->db->like('nombre_comercial', $dato);
	$this->db->or_like('razon_social', $dato);
	$this->db->or_like('padron_proveedor', $dato);
	$this->db->or_like('descripcion_clasificacion', $dato);
	$this->db->or_like('tp_cobertura.cobertura', $dato);  
	$query=$this->db->get();
	//$this->db->join('', 'comentarios.id = blogs.id');	
	return $query;
}

function buscar_contratos($dato){
	$this->db->select('*');
	$this->db->from('tp_contratos');
	$this->db->join('tp_medios', 'medio = id_medio');
	$this->db->join('tp_clasificacion', 'tp_medios.clasificacion = id_clasificacion');
	$this->db->join('tp_cobertura', 'tp_medios.cobertura = id_cobertura');
	$this->db->like('nombre_comercial', $dato);
	$this->db->or_like('razon_social', $dato);
	$this->db->or_like('padron_proveedor', $dato);
	$this->db->or_like('descripcion_clasificacion', $dato);
	$this->db->or_like('tp_cobertura.cobertura', $dato);
	$this->db->or_like('num_contrato', $dato);
	$this->db->or_like('objeto_contrato', $dato);
	$query=$this->db->get();
	//$this->db->join('', 'comentarios.id = blogs.id');	
	return $query;
}

function buscar_campas($dato){
	$this->db->select('*');
	$this->db->from('tp_campa');
	$this->db->join('tp_tipo_campa', 'id_tipo = tp_campa.tipo');
	$this->db->join('tp_dependencia', 'id_dependencia = depen');
	$this->db->join('tp_clasificacion_campa', 'id_clasificacion_campa = tp_clasificacion_campa');
	//$this->db->join('etiquetas_campas', 'etiquetas_id_campa = id_campa');
	//$this->db->join('etiquetas', 'etiquetas.id_etiqueta = etiquetas_campas.id_etiqueta');
	$this->db->like('nombre', $dato);
	$this->db->or_like('anio', $dato);	
	$this->db->or_like('tema', $dato);
	$this->db->or_like('tp_tipo_campa.tipo', $dato);
	$this->db->or_like('objetivo', $dato);
	$this->db->or_like('periodicidad_inicio', $dato); 
	$this->db->or_like('periodicidad_fin', $dato); 
	$this->db->or_like('dependencia', $dato);
	$this->db->or_like('descripcion_clasificacion', $dato); 
	//$this->db->or_like('etiqueta', $dato); 
	$query=$this->db->get();
	//$this->db->join('', 'comentarios.id = blogs.id');	
	return $query;
}

function buscar_dependencias($dato){
	$this->db->select('*');
	$this->db->from('tp_dependencia');
	$this->db->like('dependencia', $dato);
	$query=$this->db->get();
	//$this->db->join('', 'comentarios.id = blogs.id');	
	return $query;
}

/*function buscar_contratos($dato){
	$query = $this->db->query("select * from presupuesto, desglose_presupuesto where anio=".$dato." or concepto='".$dato."'");	
	return $query;
}

function buscar_campas($dato){
	$query = $this->db->query("select * from presupuesto, desglose_presupuesto where anio=".$dato." or concepto='".$dato."'");	
	return $query;
}

function buscar_dependencia($dato){
	$query = $this->db->query("select * from presupuesto, desglose_presupuesto where anio=".$dato." or concepto='".$dato."'");	
	return $query;
}*/

function logo(){
	$query = $this->db->query("select * from tp_logos limit 1");
	if ($query->num_rows() > 0){
		$row = $query->row();
		return $row->logo_gobierno;
	}
	else{
		return "";
	}
}

function url_logo(){
	$query = $this->db->query("select * from tp_logos limit 1");
	if ($query->num_rows() > 0){
	$row = $query->row();
	return $row->vinculacion_logo_gobierno;
	}
	else{
		return "";
	}
}

function logo_opcional(){
	$query = $this->db->query("select * from tp_logos limit 1");
	if ($query->num_rows() > 0){
	$row = $query->row();
	return $row->logo_opcional;
	}
	else{
		return "";
	}
}

function url_logo_opcional(){
	$query = $this->db->query("select * from tp_logos limit 1");
	if ($query->num_rows() > 0){
	$row = $query->row();
	return $row->vinculacion_logo_opcional;
	}
	else{
		return "";
	}
}

function presupuestos(){	 						
		$query = $this->db->query("select anio as año, monto_total from tp_presupuesto");      			
		return $query;							
}

function detalle_presupuestos(){	 						
		$query = $this->db->query("select anio as año, concepto, cantidad, porcentaje from tp_desglose_presupuesto, tp_presupuesto where presupuesto=id_presupuesto");      			
		return $query;							
}

function datos_dependencias(){	 						
		$query = $this->db->query("select dependencia from tp_dependencia");      			
		return $query;							
}

function campas(){	 						
		$query = $this->db->query("select nombre, anio as año, tp_tipo_campa.tipo as tipo, objetivo, periodicidad_inicio, periodicidad_fin, dependencia, costo_total as costo_aproximado, 
SUM(monto_concepto*unidades) as costo_total, tp_status_campa.status as status, descripcion_clasificacion
from tp_campa, tp_tipo_campa, tp_dependencia, tp_status_campa, tp_clasificacion_campa, tp_detalle_factura where tp_campa.tipo=id_tipo and depen=id_dependencia and 
tp_campa.status=id_status and tp_clasificacion_campa=id_clasificacion_campa and id_campa=tp_campa_factura group by tp_campa_factura
ORDER BY periodicidad_inicio desc");      			
		return $query;							
}

function contratos(){	 						
		$query = $this->db->query("select fecha_celebracion, num_contrato as numero_de_contrato, dependencia, razon_social as medio, monto_contrato as monto_contratado, objeto_contrato,
fecha_inicio, fecha_fin, motivoadj as motivo_de_adjudicación, partidapres as partida_presupuestaria from tp_contratos, tp_dependencia, tp_medios, tp_modalidad_contratos
where depen=id_dependencia and medio=id_medio and tp_contratos.modalidad=id_modalidad");      			
		return $query;							
}
function medios(){	 						
		$query = $this->db->query("select razon_social, nombre_comercial, padron_proveedor, descripcion_clasificacion as clasificacion, tp_cobertura.cobertura as cobertura 
from tp_medios, tp_clasificacion, tp_cobertura where tp_medios.clasificacion=id_clasificacion and tp_medios.cobertura=id_cobertura");      			
		return $query;							
}

}