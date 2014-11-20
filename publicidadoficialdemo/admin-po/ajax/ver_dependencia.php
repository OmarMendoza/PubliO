<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
        
	$id="{$_GET['id']}"; 			
			
	$resultado = mysql_query("SELECT * FROM tp_dependencia where id_dependencia=".$id, $db); 
	echo '<table border = "0" width="100%">'; 	 
	while ($fila = mysql_fetch_row($resultado)){ 
       echo '<tr><td>'.$fila[1].'</td><td>'.$fila[2].'</td><td>'.$fila[3].'</td></tr>'; 
	} 
	echo '</table>';
?>
