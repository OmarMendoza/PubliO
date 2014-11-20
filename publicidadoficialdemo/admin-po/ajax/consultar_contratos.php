<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $dependencia="{$_GET['dependencia']}";	
	$medio="{$_GET['medio']}";		
			
	$resultado = mysql_query("select num_contrato from tp_dependencia,tp_contratos,tp_medios where depen=id_dependencia and medio=id_medio and dependencia='$dependencia' and nombre_comercial='$medio';", $db); 	 
	echo '<select id="contratos" name="contratos" style="width:155px;">'; 
	echo '<option value="seleccione" >Seleccione el contrato</option>';
	while ($fila = mysql_fetch_row($resultado)){ 
       echo '<option value="'.$fila[0].'" >'.$fila[0].'</option>'; 
	} 
	echo '</select>';
?>
