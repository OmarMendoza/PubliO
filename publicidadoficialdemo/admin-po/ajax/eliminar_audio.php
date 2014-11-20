<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $id="{$_GET['id']}";
	   	
	$audios="<table>";	
			
	mysql_query("delete from tp_audios_campa_temp where id_audio=$id",$db);
			
									$sql="select id_audio, audio from tp_audios_campa_temp";									
									
									$Rec = mysql_query($sql, $db);
									$total = mysql_num_rows($Rec);					
									$Reg = mysql_fetch_assoc($Rec);	 
									$i=1;
									do{
										if($Reg['audio']!=null)										
$audios=$audios."<tr> <td> <a target='_blank' href='../../jplayer/reproductor.php?audio=".$Reg['audio']."'>".$Reg['audio']."</a></td>";
										if($Reg['audio']!=null)
$audios=$audios.'<td><a style="margin-right:95px;" class="eliminar_audio" href="javascript:void(0);" data-id="'.$Reg['id_audio'].'">Borrar</a></td></tr>';	                             
										
										if($i%9==0){
											$audios = $audios."<br>";
										}
										
										$i++;
									}while ($Reg = mysql_fetch_assoc($Rec) );
									
									$audios=$audios."</table>";								
									
									echo $audios;	
?>
