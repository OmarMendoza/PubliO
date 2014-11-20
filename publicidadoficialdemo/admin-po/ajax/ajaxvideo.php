<!--<script type="text/javascript" src="scripts/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.alerts.js"></script>
<link rel="stylesheet" href="js/jquery.alerts.css" type="text/css" />!-->
<?php
//echo "hola";
require_once('conexion.php');
$conexion=new Conexion();
$db = $conexion->conecta(); 
mysql_query("SET CHARACTER SET utf8 ");

	//$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$video = $_POST['video'];
								
			
			$videos="<table> <tr>";
			$videos_borrar="<table> <tr>";						
		
		mysql_query("insert into tp_videos_campa_temp (campa,video) values (0,'$video')", $db);
						
									$sql="select id_video, video from tp_videos_campa_temp";									
									$Rec = mysql_query($sql, $db);
									$total = mysql_num_rows($Rec);					
									$Reg = mysql_fetch_assoc($Rec);	 
									$i=1;
									do{																												
																		


$videos=$videos.'<td><iframe width="120" height="120" src="'.$Reg['video'].'" frameborder="0" allowfullscreen></iframe> </td>';

$videos_borrar=$videos_borrar.'<td><a style="margin-right:95px;" class="eliminar_video" href="javascript:void(0);" data-id="'.$Reg['id_video'].'">Borrar</a></td>';	
                            
										
										if($i%9==0){
											$videos = $videos."<br>";
										}
										
										$i++;
									}while ($Reg = mysql_fetch_assoc($Rec) );
										
									$videos=$videos."</tr> </table>";	
									$videos_borrar=$videos_borrar."</td> </table>";
									$videos=$videos.$videos_borrar;
														
									echo $videos;																		
								
			exit;
									
		}
?>