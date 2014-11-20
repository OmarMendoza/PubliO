<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $dependencia="{$_GET['dependencia']}";			
			
	$resultado = mysql_query("select nombre from tp_campa,tp_dependencia where depen=id_dependencia and dependencia='$dependencia'", $db); 	 
	echo '<select id="campas" name="campas" style="width:155px;">'; 
	echo '<option value="seleccione" >Seleccione la campaña</option>';
	while ($fila = mysql_fetch_row($resultado)){ 
       echo '<option value="'.$fila[0].'" >'.$fila[0].'</option>'; 
	} 
	echo '</select>';
?>
