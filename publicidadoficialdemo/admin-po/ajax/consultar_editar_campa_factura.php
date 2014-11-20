<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $dependencia="{$_GET['dependencia']}";			
			
	$contenidos='<option value="">Seleccione campaña</option>'; 
	
	$resultado = mysql_query("select id_campa, nombre from tp_campa where depen=$dependencia", $db); 	 	
	while ($fila = mysql_fetch_row($resultado)){ 
       $contenidos=$contenidos.'<option value="'.$fila[0].'" >'.$fila[1].'</option>'; 
	} 
	echo $contenidos;
?>
