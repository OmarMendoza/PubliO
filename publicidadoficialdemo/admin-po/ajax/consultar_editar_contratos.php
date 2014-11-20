<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $dependencia="{$_GET['dependencia']}";	
	$medio="{$_GET['medio']}";		
			
    $contenidos='<option value="">Seleccione contrato</option>'; 
	
	$resultado = mysql_query("select id_contrato, num_contrato from tp_contratos where depen=$dependencia and medio=$medio;", $db); 	 	
	while ($fila = mysql_fetch_row($resultado)){ 
       $contenidos=$contenidos.'<option value="'.$fila[0].'" >'.$fila[1].'</option>'; 
	} 
		
	echo $contenidos;
		
?>
