<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $id="{$_GET['id']}";
	   	
	$audios="<table> <tr>";
	$audios_borrar="<table> <tr>";	
			
	mysql_query("delete from tp_audios_campa_temp where id_audio=$id",$db);
			
									$sql="select id_audio, audio from tp_audios_campa_temp";									
									
									$Rec = mysql_query($sql, $db);
									$total = mysql_num_rows($Rec);					
									$Reg = mysql_fetch_assoc($Rec);	 
									$i=1;
									do{
										if($Reg['audio']!=null)										
$audios=$audios.'<td><iframe width="120" height="120" src="'.$Reg['audio'].'" frameborder="0" allowfullscreen></iframe> </td>';
										if($Reg['audio']!=null)
$audios_borrar=$audios_borrar.'<td><a style="margin-right:95px;" class="eliminar_nuevo_audio" href="javascript:void(0);" onclick="eliminar_nuevo_audio('.$Reg['id_audio'].')" >Borrar</a></td>';	                             
										
										if($i%9==0){
											$audios = $audios."<br>";
										}
										
										$i++;
									}while ($Reg = mysql_fetch_assoc($Rec) );
									
									$audios=$audios."</tr> </table>";	
									$audios_borrar=$audios_borrar."</td> </table>";
									$audios=$audios.$audios_borrar;
									
									echo $audios;	
?>
