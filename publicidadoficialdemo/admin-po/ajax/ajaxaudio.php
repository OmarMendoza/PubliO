<!--<script type="text/javascript" src="scripts/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.alerts.js"></script>
<link rel="stylesheet" href="js/jquery.alerts.css" type="text/css" />!-->
<?php
require_once('conexion.php');
$conexion=new Conexion();
$db = $conexion->conecta(); 
mysql_query("SET CHARACTER SET utf8 ");
			
$path = "../archivos/audios/";

	$valid_formats = array("mp3");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['agregar_audio']['name'];
			$size = $_FILES['agregar_audio']['size'];									
			
			$audios="<table>";
			
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(10024*10024))
						{
							$actual_audio_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['agregar_audio']['tmp_name'];
							if(copy($tmp, $path.$actual_audio_name))
								{																	
									
									mysql_query("insert into tp_audios_campa_temp (campa,audio) values (0,'$actual_audio_name')", $db);
						
									$sql="select id_audio,audio from tp_audios_campa_temp";									
									$Rec = mysql_query($sql, $db);
									$total = mysql_num_rows($Rec);					
									$Reg = mysql_fetch_assoc($Rec);	 
									$i=1;
									do{																				
										
$audios = $audios."<tr> <td> <a target='_blank' href='../../jplayer/reproductor.php?audio=".$Reg['audio']."'>".$Reg['audio']."</a></td>";

$audios=$audios.'<td><a style="margin-right:95px;" class="eliminar_audio" href="javascript:void(0);" data-id="'.$Reg['id_audio'].'">Borrar</a></td></tr>';										                             
										
										if($i%9==0){
											$audios = $audios."<br>";
										}
										
										$i++;
									}while ($Reg = mysql_fetch_assoc($Rec) );
															
									$audios=$audios."</table>";	
									
									echo $audios;																		
								}
							else
								echo "Fallo proceso";
						}
						else
						echo "Tamaño de imagen max 1 MB";					
						}
						else
						echo "Formato de archivo invalido..";	
				}
				
			else
				echo "Por favor seleccione un audio..!";
				
			exit;
									
		}
?>