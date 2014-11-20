<!--<script type="text/javascript" src="scripts/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.alerts.js"></script>
<link rel="stylesheet" href="js/jquery.alerts.css" type="text/css" />!-->
<?php
//echo "hola";
require_once('conexion.php');
$conexion=new Conexion();
$db = $conexion->conecta(); 
mysql_query("SET CHARACTER SET utf8 ");

//session_start();
//$usuario=$_SESSION['usuario'];

	//$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$audio = $_POST['audio'];
			$descripcion_audio= $_POST['descripcion_audio'];
			//$size = $_FILES['photoimg']['size'];	
								
			//$posicion = strpos('src', $video);
									
			//if ($posicion == true) {																		
					//preg_match_all('/(src)=("[^"]*")/i',$video, $resultado);																														
					//$video = $resultado[0][0]; //explode ("'",$resultado[0][0]);
					//$tam=strlen($video);
					//$video = substr($video, 5, $tam);	
														
					//$tam=strpos($video, '"');
					//$video = substr($video, 0, $tam);
					//$video=explode ('"',$video);																				
			//}								
						
			
			$audios="<table> <tr>";
			$audios_borrar="<table> <tr>";
						
			/*if(strlen($name))
				{
					//list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(1024*1024))
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(copy($tmp, $path.$actual_image_name))
								{	*/																
									
									mysql_query("insert into tp_audios_campa_temp (campa,audio,descripcion_audio) values (0,'$audio','$descripcion_audio')", $db);
						
									$sql="select id_audio, audio from tp_audios_campa_temp";									
									$Rec = mysql_query($sql, $db);
									$total = mysql_num_rows($Rec);					
									$Reg = mysql_fetch_assoc($Rec);	 
									$i=1;
									do{																												
																		
		

$audios=$audios.'<td><iframe width="120" height="120" src="'.$Reg['audio'].'" frameborder="0" allowfullscreen></iframe> </td>';

$audios_borrar=$audios_borrar.'<td><a style="margin-right:95px;" class="eliminar_audio" href="javascript:void(0);" data-id="'.$Reg['id_audio'].'">Borrar</a></td>';	
                            
										
										if($i%9==0){
											$audios = $audios."<br>";
										}
										
										$i++;
									}while ($Reg = mysql_fetch_assoc($Rec) );
															
									$audios=$audios."</tr> </table>";	
									$audios_borrar=$audios_borrar."</td> </table>";
									$audios=$audios.$audios_borrar;
									
								
				
			exit;
									
		}
?>