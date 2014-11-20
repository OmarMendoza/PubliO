<?php 
class Modelo extends CI_Model{

private $contralores= 'csCapturacontralortemp';

	function __construct(){
		parent::__construct();
	}
	
// get person by id
function dependencias(){	 						
		$query = $this->db->query("select id_dependencia, dependencia from tp_dependencia");      			
		return $query;							
}

function dependencias_solicitante_ambos(){	 						
		$query = $this->db->query("select id_dependencia, dependencia from tp_dependencia where tipo='solicitante' or tipo='ambos'");      			
		return $query;							
}

function dependencias_contratante_ambos(){	 						
		$query = $this->db->query("select id_dependencia, dependencia from tp_dependencia where tipo='contratante' or tipo='ambos'");      			
		return $query;							
}

function obtener_nombre_campa($id){
	$query = $this->db->query("select nombre from tp_campa where id_campa=".$id);      					
	return $query;
}

function obtener_numero_factura($id){
	$query = $this->db->query("select num_factura from tp_factura where id_factura=".$id);      					
	return $query;
}

function obtener_nombre_medio($id){
	$query = $this->db->query("select nombre_comercial from tp_medios where id_medio=".$id);
	$row = $query->row();
	return $row->nombre_comercial;
}

function obtener_id_medio_factura($id){
	$query = $this->db->query("select medio_id from tp_factura where id_factura=".$id);
	$row = $query->row();
	$id_medio=$row->medio_id;
	

	return $id_medio;
}

function obtener_id_dependencia_factura($id){
	$query = $this->db->query("select dependencia_contratante from tp_factura where id_factura=".$id);
	$row = $query->row();
	$dependencia_contratante=$row->dependencia_contratante;
	
	
	return $dependencia_contratante;
}

function obtener_nombre_dependencia($id){
	$query = $this->db->query("select dependencia from tp_dependencia where id_dependencia=".$id);
	$row = $query->row();
	return $row->dependencia;
}

function obtener_numero_contrato($id){
	$query = $this->db->query("select num_contrato from tp_contratos where id_contrato=".$id);
	$row = $query->row();
	return $row->num_contrato;
}

function status(){	 						
		$query = $this->db->query("select status from tp_status_campa");      					
		return $query;							
}

function tipos(){	 						
		$query = $this->db->query("select tipo from tp_tipo_campa");      			
		return $query;							
}

function clasificaciones_campa(){	 						
		$query = $this->db->query("select descripcion_clasificacion from tp_clasificacion_campa");      			
		return $query;							
}

function campas(){	 						
		$query = $this->db->query("select nombre from tp_campa");      			
		return $query;							
}

function medios(){	 						
		$query = $this->db->query("select id_medio,nombre_comercial from tp_medios");      			
		return $query;							
}

function contratos(){	 						
		$query = $this->db->query("select id_contrato,num_contrato from tp_contratos");      			
		return $query;							
}

function contratos_medio_dependencia($id){	 

		$query = $this->db->query("select dependencia_contratante, medio_id from tp_factura where id_factura=".$id);
		$row = $query->row();
		$dependencia=$row->dependencia_contratante;
		$medio=$row->medio_id;
							
		$query = $this->db->query("select id_contrato, num_contrato from tp_contratos where depen=".$dependencia." and medio=".$medio);      			
		return $query;							
}

function campas_dependencia($id){	 

		$query = $this->db->query("select dependencia_s from tp_detalle_factura where id_detalle=".$id);
		$row = $query->row();
		$dependencia=$row->dependencia_s;		
							
		$query = $this->db->query("select id_campa, nombre from tp_campa where depen=".$dependencia);      			
		return $query;							
}

function facturas(){	 						
		$query = $this->db->query("select num_factura from tp_factura");      			
		return $query;							
}

function guardar_campa($datos){	
	$this->db->insert('tp_campa', $datos);
}

function guardar_factura($datos){
	$this->db->insert('tp_factura', $datos);
}

function guardar_presupuesto($datos){			
	$this->db->insert('tp_presupuesto', $datos);
}

function ver_si_existe($anio){			
	$query = $this->db->query("select * from tp_presupuesto where anio=".$anio);      			
	return $query;
}	

function obtener_id_tipo($tipo){
	$query = $this->db->query("select id_tipo from tp_tipo_campa where tipo='".$tipo."'");
	$row = $query->row();
	return $row->id_tipo;
}

function obtener_id_clasificacion_campa($categoria){
	$query = $this->db->query("select id_clasificacion_campa from tp_clasificacion_campa where descripcion_clasificacion='".$categoria."'");
	$row = $query->row();
	return $row->id_clasificacion_campa;
}

function obtener_id_factura($factura){
	$query = $this->db->query("select id_factura from tp_factura where num_factura='".$factura."'");
	$row = $query->row();
	return $row->id_factura;
}

function obtener_id_dependencia($dependencia){
	$query = $this->db->query("select id_dependencia from tp_dependencia where dependencia='".$dependencia."' limit 1");
	$row = $query->row();
	return $row->id_dependencia;
}

function obtener_id_campa($campa){
	$query = $this->db->query("select id_campa from tp_campa where nombre='".$campa."' limit 1");
	$row = $query->row();
	return $row->id_campa;
}

function obtener_id_contrato($contrato){
	$query = $this->db->query("select id_contrato from tp_contratos where num_contrato='".$contrato."' limit 1");
	$row = $query->row();
	return $row->id_contrato;
}

function obtener_id_medio($medio){
	$query = $this->db->query("select id_medio from tp_medios where nombre_comercial='".$medio."' limit 1");
	$row = $query->row();
	return $row->id_medio;
}

function obtener_id_status($status){
	$query = $this->db->query("select id_status from tp_status_campa where status='".$status."' limit 1");
	$row = $query->row();
	return $row->id_status;
}

function obtener_presupuesto($id){
	$query = $this->db->query("select monto_total from tp_presupuesto where id_presupuesto='".$id."'");
	$row = $query->row();
	return $row->monto_total;
}

function borrar_etiquetas_temp(){		
	$query = $this->db->query("delete from tp_etiquetas_temp");
}

function borrar_banners_temp(){		
	$query = $this->db->query("delete from tp_banners_campa_temp");
}

function borrar_videos_temp(){		
	$query = $this->db->query("delete from tp_videos_campa_temp");
}

function borrar_audios_temp(){		
	$query = $this->db->query("delete from tp_audios_campa_temp");
}

function borrar_imagenes_factura_temp(){		
	$query = $this->db->query("delete from tp_imagenes_factura_temp");
}

function borrar_detalle_factura_temp(){		
	$query = $this->db->query("delete from tp_detalle_factura_temp");
}

function borrar_desglose_presupuesto_temp(){		
	$query = $this->db->query("delete from tp_desglose_presupuesto_temp");
}

function borrar_campa($id){		
	$query = $this->db->query("delete from tp_banners_campa where campa=".$id);
	$query = $this->db->query("delete from tp_detalle_factura where campa_factura=".$id);
	$query = $this->db->query("delete from tp_videos_campa where campa=".$id);
	$query = $this->db->query("delete from tp_audios_campa where campa=".$id);
}

function borrar_presupuesto($id){		
	$query = $this->db->query("delete from tp_desglose_presupuesto where presupuesto=".$id);
}

function borrar_factura($id){		
	$query = $this->db->query("delete from tp_detalle_factura where factura=".$id);
}

function etiquetas(){			
	$query = $this->db->query("select * from tp_etiquetas");      			
	return $query;
}

function guardar_etiquetas(){		
	$query = $this->db->query("select MAX(id_campa) as id from tp_campa;");
	$row = $query->row();
	$id_campa=$row->id;
	
	$query = $this->db->query("select id_etiqueta, etiqueta from tp_etiquetas_temp ");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$query2 = $this->db->query("select * from tp_etiquetas where etiqueta='".$row->etiqueta."'");
			$row2 = $query2->row();
			$id_etiqueta=$row2->id_etiqueta;
			
				if ($query2->num_rows() == 0)
				{
					$this->db->query("INSERT INTO tp_etiquetas (etiqueta) VALUES ('".$row->etiqueta."')");
					
					$query3 = $this->db->query("select MAX(id_etiqueta) as id from tp_etiquetas;");
					$row3 = $query3->row();
					$id_etiqueta=$row3->id;
					
					$this->db->query("INSERT INTO tp_etiquetas_campas (id_etiqueta, id_campa) VALUES (".$id_etiqueta.", ".$id_campa.")");
				}
				else{										
					
					$this->db->query("INSERT INTO tp_etiquetas_campas (id_etiqueta, id_campa) VALUES (".$id_etiqueta.", ".$id_campa.")");
					
				}
		}
	}
	
}

function actualizar_etiquetas($datos,$id_camp){
	
	$arreglo = explode(', ',$datos);	
	$arreglo_final=array_unique($arreglo);	
	
	$this->db->query("delete from tp_etiquetas_campas where etiquetas_id_campa=".$id_camp);
	
		foreach ($arreglo_final as $etiqueta) 
		{
			$query2 = $this->db->query("select * from tp_etiquetas where etiqueta='".$etiqueta."'");
			$row2 = $query2->row();
			$id_etiqueta=$row2->id_etiqueta;
			
				if ($query2->num_rows() == 0)
				{
					$this->db->query("INSERT INTO tp_etiquetas (etiqueta) VALUES ('".$etiqueta."')");
					
					$query3 = $this->db->query("select MAX(id_etiqueta) as id from tp_etiquetas;");
					$row3 = $query3->row();
					$id_etiqueta=$row3->id;
					
					$this->db->query("INSERT INTO tp_etiquetas_campas (etiquetas_id_etiqueta, etiquetas_id_campa) VALUES (".$id_etiqueta.", ".$id_camp.")");
				}
				else{										
					
					$this->db->query("INSERT INTO tp_etiquetas_campas (etiquetas_id_etiqueta, etiquetas_id_campa) VALUES (".$id_etiqueta.", ".$id_camp.")");
					
				}
		}
	
}

function guardar_banners(){		
	$query = $this->db->query("select MAX(id_campa) as id from tp_campa;");
	$row = $query->row();
	$id_campa=$row->id;
	
	$query = $this->db->query("select banner from tp_banners_campa_temp ");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_banners_campa (campa, banner) VALUES (".$id_campa.", '".$row->banner."')");
		}
	}
	
}

function guardar_videos(){		
	$query = $this->db->query("select MAX(id_campa) as id from tp_campa;");
	$row = $query->row();
	$id_campa=$row->id;
	
	$query = $this->db->query("select video from tp_videos_campa_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_videos_campa (campa, video) VALUES (".$id_campa.", '".$row->video."')");
		}
	}
	
}

function guardar_nuevos_videos($campa){	
	
	$id_campa=$campa;
	
	$query = $this->db->query("select video from tp_videos_campa_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_videos_campa (campa, video) VALUES (".$id_campa.", '".$row->video."')");
		}
	}
	
}

function guardar_nuevos_banners($campa){	
	
	$id_campa=$campa;
	
	$query = $this->db->query("select banner from tp_banners_campa_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_banners_campa (campa, banner) VALUES (".$id_campa.", '".$row->banner."')");
		}
	}
	
}

function guardar_audios(){		
	$query = $this->db->query("select MAX(id_campa) as id from tp_campa;");
	$row = $query->row();
	$id_campa=$row->id;
	
	$query = $this->db->query("select audio from tp_audios_campa_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_audios_campa (campa, audio) VALUES (".$id_campa.", '".$row->audio."')");
		}
	}
	
}

function guardar_nuevos_audios($campa){	
		
	$id_campa=$campa;
	
	$query = $this->db->query("select audio from tp_audios_campa_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_audios_campa (campa, audio) VALUES (".$id_campa.", '".$row->audio."')");
		}
	}
	
}

function guardar_imagenes_factura(){		
	$query = $this->db->query("select MAX(id_factura) as id from tp_factura;");
	$row = $query->row();
	$id_factura=$row->id;
	
	$query = $this->db->query("select imagen from tp_imagenes_factura_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_imagenes_factura (factura, imagen) VALUES (".$id_factura.", '".$row->imagen."')");
		}
	}
	
}

function guardar_nuevas_imagenes($factura){	
		
	$id_factura=$factura;
	
	$query = $this->db->query("select imagen from tp_imagenes_factura_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_imagenes_factura (factura, imagen) VALUES (".$id_factura.", '".$row->imagen."')");
		}
	}
	
}

function guardar_imagenes_testigo_factura(){		
	$query = $this->db->query("select MAX(id_factura) as id from tp_factura;");
	$row = $query->row();
	$id_factura=$row->id;
	
	$query = $this->db->query("select imagen from tp_imagenes_testigo_factura_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_imagenes_testigo_factura (factura, imagen) VALUES (".$id_factura.", '".$row->imagen."')");
		}
	}	
}

function guardar_nuevas_imagenes_testigo($factura){			
	$id_factura=$factura;	
	$query = $this->db->query("select imagen from tp_imagenes_testigo_factura_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_imagenes_testigo_factura (factura, imagen) VALUES (".$id_factura.", '".$row->imagen."')");
		}
	}
	
}

function guardar_detalle_factura(){		
	$query = $this->db->query("select MAX(id_factura) as id from tp_factura;");
	$row = $query->row();
	$id_factura=$row->id;
	
	$query = $this->db->query("select concepto,unidades,monto_concepto,dependencia_s,campa_factura from tp_detalle_factura_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_detalle_factura (factura, concepto, unidades, monto_concepto,dependencia_s, campa_factura) VALUES (".$id_factura.", '".$row->concepto."',".$row->unidades.",'".$row->monto_concepto."',".$row->dependencia_s.",".$row->campa_factura.")");
		}
	}	
}

function guardar_nuevo_detalle($factura){	
		
	$id_factura=$factura;
	
	$query = $this->db->query("select concepto,unidades,monto_concepto, dependencia_s,campa_factura from tp_detalle_factura_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_detalle_factura (factura, concepto, unidades, monto_concepto,dependencia_s, campa_factura) VALUES (".$id_factura.", '".$row->concepto."',".$row->unidades.",'".$row->monto_concepto."',".$row->dependencia_s.",".$row->campa_factura.")");
		}
	}	
}

function guardar_nuevo_desglose_presupuesto($id){				
	
	$query = $this->db->query("select id_concepto,concepto,cantidad, porcentaje from tp_desglose_presupuesto_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_desglose_presupuesto (presupuesto, id_concepto, concepto, cantidad, porcentaje) VALUES (".$id.", '".$row->id_concepto."','".$row->concepto."',".$row->cantidad.",".$row->porcentaje.")");
		}
	}	
}

function actualizar_monto_factura($id){
	$query = $this->db->query("update tp_factura set monto_total=(select SUM(monto_concepto*unidades) from tp_detalle_factura where tp_detalle_factura.factura=".$id.") where id_factura=".$id);
}

function guardar_desglose_presupuesto(){		
	$query = $this->db->query("select MAX(id_presupuesto) as id from tp_presupuesto;");
	$row = $query->row();
	$id_presupuesto=$row->id;
	
	$query = $this->db->query("select id_concepto,concepto,cantidad,porcentaje from tp_desglose_presupuesto_temp");
	if ($query->num_rows() > 0)
	{
		foreach ($query->result() as $row)
		{
			$this->db->query("INSERT INTO tp_desglose_presupuesto (presupuesto, id_concepto, concepto, cantidad, porcentaje) VALUES (".$id_presupuesto.", '".$row->id_concepto."','".$row->concepto."',".$row->cantidad.",".$row->porcentaje.")");
		}
	}	
}

function obtener_monto_gastado($id){
	$query = $this->db->query("select SUM(monto_concepto*unidades) as total from tp_detalle_factura where campa_factura=".$id);
	$row = $query->row();
	return $row->total;
}

function obtener_monto_gastado_contrato($id){
	$query = $this->db->query("SELECT sum(monto_total) as total from tp_factura where contrato=".$id);
	$row = $query->row();
	return $row->total;
}

function totales_detalle_factura($id){
	$query = $this->db->query("SELECT SUM(unidades) as total_unidades, sum(monto_concepto*unidades) as total_monto from tp_detalle_factura where factura=".$id);
	return $query;
}

function totales_detalle_factura_campa($id){
	$query = $this->db->query("SELECT SUM(unidades) as total_unidades, sum(monto_concepto*unidades) as total_monto from tp_detalle_factura where campa_factura=".$id);
	return $query;
}

function obtener_clasificacion($id){
	$query = $this->db->query("select descripcion_clasificacion from tp_clasificacion where id_clasificacion=".$id);
	$row = $query->row();
	return $row->descripcion_clasificacion;
}

function obtener_clasificaciones($id){
	$query = $this->db->query("select * from tp_clasificacion");
	return $query;
}

function actualizar_porcentaje($id_concepto){
	
	$query = $this->db->query("select presupuesto from tp_desglose_presupuesto where id_desglose_presupuesto=".$id_concepto);
	$row = $query->row();
	$id_presupuesto=$row->presupuesto;
	
	$query = $this->db->query("select monto_total from tp_presupuesto where id_presupuesto=".$id_presupuesto);
	$row = $query->row();
	$presupuesto=$row->monto_total;
	
	$query = $this->db->query("select cantidad from tp_desglose_presupuesto where id_desglose_presupuesto=".$id_concepto);
	$row = $query->row();
	$monto=$row->cantidad;
	
	$porcentaje=$monto/$presupuesto*100;
	
	$porcentaje=intval($porcentaje); 
	
	$query = $this->db->query("update tp_desglose_presupuesto set porcentaje=".$porcentaje." where id_desglose_presupuesto=".$id_concepto);
}


//detalle del registro de medio

function registro_medio($id){
	$query = $this->db->query("select * from tp_medios,tp_clasificacion,tp_cobertura where id_medio=".$id." and clasificacion=id_clasificacion and tp_medios.cobertura=id_cobertura");
	return $query;
}

function registro_campa($id){
	$query = $this->db->query("select nombre,anio,tp_tipo_campa.tipo,descripcion_clasificacion,tema,objetivo,periodicidad_inicio,periodicidad_fin,dependencia,costo_total,tp_status_campa.status from tp_campa,tp_tipo_campa,tp_clasificacion_campa,tp_dependencia,tp_status_campa where tp_campa.tipo=id_tipo and id_clasificacion_campa=clasificacion_campa and depen=id_dependencia and tp_campa.status=id_status and id_campa=".$id);
	return $query;
}

function etiquetas_campa($id){
	$query = $this->db->query("select etiqueta from tp_etiquetas, tp_etiquetas_campas where id_etiqueta=etiquetas_id_etiqueta and etiquetas_id_campa=".$id);
	return $query;
}

function registro_contrato($id){
	$query = $this->db->query("select * from tp_contratos,tp_dependencia,tp_medios, tp_modalidad_contratos where depen=id_dependencia and medio=id_medio and tp_contratos.modalidad=id_modalidad and id_contrato=".$id);
	return $query;
}

function iniciar_tabla_logo(){
	$query = $this->db->query("select * from tp_logos");
	if ($query->num_rows() == 0){
		$this->db->query("INSERT INTO tp_logos (id_logo) VALUES (1)");
	}
}

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

function nombre_usuario($id){
	$query = $this->db->query("select username from tp_usuarios where id=".$id);
	$row = $query->row();
	return $row->username;
}

}