<!--<script type="text/javascript" src="scripts/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.alerts.js"></script>
<link rel="stylesheet" href="js/jquery.alerts.css" type="text/css" />!-->
<?php
echo "hola";
require_once('conexion.php');
$conexion=new Conexion();
$db = $conexion->conecta(); 
mysql_query("SET CHARACTER SET utf8 ");
			
//session_start();
//$usuario=$_SESSION['usuario'];

$path = "../archivos/banners/";

	$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];									
			
			$imagenes="<table> <tr>";
			$imagenes_borrar="<table> <tr>";
			
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(1024*1024))
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(copy($tmp, $path.$actual_image_name))
								{																	
									
									mysql_query("insert into tp_banners_campa_temp (campa,banner) values (0,'$actual_image_name')", $db);
						
									$sql="select id_banner,banner from tp_banners_campa_temp";									
									$Rec = mysql_query($sql, $db);
									$total = mysql_num_rows($Rec);					
									$Reg = mysql_fetch_assoc($Rec);	 
									$i=1;
									do{																				
										
$imagenes = $imagenes.'<td> <img src="../../archivos/banners/'.$Reg['banner'].'" class="preview" > </td>';

$imagenes_borrar=$imagenes_borrar.'<td><a style="margin-right:95px;" class="eliminar_banner" href="javascript:void(0);" data-id="'.$Reg['id_banner'].'">Borrar</a></td>';										                             
										
										if($i%9==0){
											$imagenes = $imagenes."<br>";
										}
										
										$i++;
									}while ($Reg = mysql_fetch_assoc($Rec) );
															
									$imagenes=$imagenes."</tr> </table>";	
									$imagenes_borrar=$imagenes_borrar."</td> </table>";
									$imagenes=$imagenes.$imagenes_borrar;					
									echo $imagenes;																		
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
				echo "Por favor seleccione una imagen..!";
				
			exit;
									
		}
?>