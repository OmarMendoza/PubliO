<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $id="{$_GET['id']}";
	   	
	$videos="<table> <tr>";
	$videos_borrar="<table> <tr>";	
			
	mysql_query("delete from tp_videos_campa_temp where id_video=$id",$db);
			
									$sql="select id_video, video from tp_videos_campa_temp";									
									
									$Rec = mysql_query($sql, $db);
									$total = mysql_num_rows($Rec);					
									$Reg = mysql_fetch_assoc($Rec);	 
									$i=1;
									do{
										if($Reg['video']!=null)										
$videos=$videos.'<td><iframe width="120" height="120" src="'.$Reg['video'].'" frameborder="0" allowfullscreen></iframe> </td>';
										if($Reg['video']!=null)
$videos_borrar=$videos_borrar.'<td><a style="margin-right:95px;" class="eliminar_nuevo_video" href="javascript:void(0);" data-id="'.$Reg['id_video'].'">Borrar</a></td>';	                             
										
										if($i%9==0){
											$videos = $videos."<br>";
										}
										
										$i++;
									}while ($Reg = mysql_fetch_assoc($Rec) );
									
									$videos=$videos."</tr> </table>";	
									$videos_borrar=$videos_borrar."</td> </table>";
									$videos=$videos.$videos_borrar;
														
									echo $videos;	
?>
