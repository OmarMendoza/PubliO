<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $id="{$_GET['id']}";
	   	
	$imagenes="<table> <tr>";
	$imagenes_borrar="<table> <tr>";
			
	mysql_query("delete from tp_banners_campa_temp where id_banner=$id",$db);
			
									$sql="select id_banner, banner from tp_banners_campa_temp";									
									
									$Rec = mysql_query($sql, $db);
									$total = mysql_num_rows($Rec);					
									$Reg = mysql_fetch_assoc($Rec);	 
									$i=1;
									do{
										if($Reg['banner']!=null)										
$imagenes = $imagenes.'<td> <img src="../../../archivos/banners/'.$Reg['banner'].'" class="preview" > </td>';
										if($Reg['banner']!=null)
$imagenes_borrar=$imagenes_borrar.'<td><a style="margin-right:95px;" class="eliminar_nuevo_banner" href="javascript:void(0);" onclick="eliminar_nuevo_banner('.$Reg['id_banner'].')" >Borrar</a></td>';                             
										
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
