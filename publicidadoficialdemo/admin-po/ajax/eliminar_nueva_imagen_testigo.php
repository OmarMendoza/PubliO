<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $id="{$_GET['id']}";
	   	
	$imagenes="<table> <tr>";
	$imagenes_borrar="<table> <tr>";
			
	mysql_query("delete from tp_imagenes_testigo_factura_temp where id_imagen_factura=$id",$db);
			
									$sql="select id_imagen_factura, imagen from tp_imagenes_testigo_factura_temp";									
									
									$Rec = mysql_query($sql, $db);
									$total = mysql_num_rows($Rec);					
									$Reg = mysql_fetch_assoc($Rec);	 
									$i=1;
									do{
										if($Reg['imagen']!=null)										
$imagenes = $imagenes.'<td> <img src="../../../archivos/imagenes_testigo_factura/'.$Reg['imagen'].'" class="preview2" > </td>';
										if($Reg['imagen']!=null)
$imagenes_borrar=$imagenes_borrar.'<td><a style="margin-right:95px;" class="eliminar_nueva_imagen_testigo" href="javascript:void(0);" onclick="eliminar_nueva_imagen_testigo_factura('.$Reg['id_imagen_factura'].')" >Borrar</a></td>';                             
										
										if($i%9==0){
											$imagenes = $imagenes."<br>";
										}
										
										$i++;
									}while ($Reg = mysql_fetch_assoc($Rec) );
									
									$imagenes=$imagenes."</tr> </table>";	
									$imagenes_borrar=$imagenes_borrar."</td> </table>";
									$imagenes=$imagenes.$imagenes_borrar;					
									echo $imagenes;	
?>
