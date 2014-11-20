<?php require_once('../../admin-po/ajax/conexion.php');

$conexion=new Conexion();

$cn=  $conexion->conecta();

$listado=  mysql_query("select id_campa, nombre, dependencia.dependencia as dependencia_solicitante, anio, descripcion_clasificacion, tipo_campa.tipo as tipo, SUM(detalle_factura.monto_concepto*unidades) as total_campa
 from campa, clasificacion_campa, tipo_campa, dependencia, medios, factura, detalle_factura where clasificacion_campa=id_clasificacion_campa and  campa.tipo=tipo_campa.id_tipo and
depen=id_dependencia and medios.id_medio=factura.medio_id and factura.id_factura=detalle_factura.factura 
and id_dependencia=dependencia_s and id_campa=campa_factura GROUP BY id_campa",$cn);
?>

 <script type="text/javascript" language="javascript" src="../../listado/js/jslistadocampas.js"></script>
 
    
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_campas" style="margin-bottom:0px;">            
            
                <thead style="margin-top:10px;">                	                
            
                    <tr valign="bottom">
                        <th>Campaña</th><!--Estado-->
                        <th>Año</th>
                        <th>Categoria</th>
                        <th>Dependencia solicitante</th>
                        <th>Dependencia contratante</th>
                        <th>Cobertura</th>
                        <th>Monto</th>
                        <td valign="bottom"><div style="background:#00B5E2; color:#fff; padding:2px; font-size:12px;">M</div>     
                        <td valign="bottom"><div style="background:#005862; color:#fff; padding:2px; font-size:12px;">R</div> 
                        <td valign="bottom"><div style="background:#35A6B6; color:#fff; padding:2px; font-size:12px;">I</div> 
                        <td valign="bottom"><div style="background:#5C8EA9; color:#fff; padding:2px; font-size:12px;">T</div> 
                        <td valign="bottom"><div style="background:#6DA8C6; color:#fff; padding:2px; font-size:12px;">C</div> 
                        <td valign="bottom"><div style="background:#345463; color:#fff; padding:2px; font-size:12px;">E</div> 
                        <td valign="bottom"><div style="background:#0D95C7; color:#fff; padding:2px; font-size:12px;">O</div>                   
                        <!--td bgcolor="#00B5E2" style="color:#fff; font-weight: bold; width:15px; height:15px; padding:10px;">R</td>
                        <td bgcolor="#005862" style="color:#fff; font-weight: bold; width:15px; height:15px; padding:10px;">T</td>
                        <td bgcolor="#35A6B6" style="color:#fff; font-weight: bold; width:15px; height:15px; padding:10px;">I</td>
                        <td bgcolor="#5C8EA9" style="color:#fff; font-weight: bold; width:15px; height:15px; padding:10px;">M</td>
                        <td bgcolor="#6DA8C6" style="color:#fff; font-weight: bold; width:15px; height:15px; padding:10px;">C</td>
                        <td bgcolor="#345463" style="color:#fff; font-weight: bold; width:15px; height:15px; padding:10px;">P</td>                       
                        <td bgcolor="#0D95C7" style="color:#fff; font-weight: bold; width:15px; height:15px; padding:10px;">O</td!-->
                        
                    </tr>
                </thead>
                <tfoot>               
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                  <tbody>
                  <div style="margin-bottom:0px;" > </div>                                                                                            
                    <?php
					
					$array = array(0,0,0,0,0,0,0);
     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td class="leftb"> <a href="detalle_campa/'.$reg['id_campa'].'">'.mb_convert_encoding($reg['nombre'], "UTF-8").'</a> </td>';
                               echo '<td class="leftb">'.mb_convert_encoding($reg['anio'], "UTF-8").'</td>';
							   
							   echo '<td class="leftb">'.mb_convert_encoding($reg['descripcion_clasificacion'], "UTF-8").'</td>';
							   
							   echo '<td class="leftb">'.mb_convert_encoding($reg['dependencia_solicitante'], "UTF-8").'</td>';
							   
							   $dependencias_contratantes=  mysql_query("select distinct dependencia from factura, detalle_factura, dependencia where id_factura=factura and dependencia_contratante=id_dependencia and campa_factura=".$reg['id_campa'],$cn);	
							   
							   echo '<td class="leftb">';
							   
							   $dependencias="";
							   
							   while($contratantes=  mysql_fetch_array($dependencias_contratantes))
                   			   {
								   $dependencias=$dependencias.mb_convert_encoding($contratantes['dependencia'], "UTF-8").", ";
							   }
							   
							   $dependencias=substr($dependencias, 0, -2);
							   
							   echo $dependencias;
							   
							   echo '</td>';
							   
							   echo '<td class="leftb">'.mb_convert_encoding($reg['tipo'], "UTF-8").'</td>';
							   echo '<td class="leftb">$'.number_format($reg['total_campa']).'</td>';
							   
							   $tipos_medios=  mysql_query("SELECT clasificacion from medios, factura, detalle_factura, clasificacion where id_medio=medio_id and medios.clasificacion=clasificacion.id_clasificacion and id_factura=factura and campa_factura=".$reg['id_campa']." GROUP BY medio_id",$cn);														   
							     
							   while($tipo=  mysql_fetch_array($tipos_medios))
                   			   {
								   		if($tipo['clasificacion']==1){
											$array[0]=1;
											//medios impresos
										}
										if($tipo['clasificacion']==2){
											$array[1]=1;
											//radio
										}
										if($tipo['clasificacion']==3){
											$array[2]=1;
											//internet
										}
										if($tipo['clasificacion']==4){
											$array[3]=1;
											//televión
										}
										if($tipo['clasificacion']==5){
											$array[4]=1;
											//cine
										}
										if($tipo['clasificacion']==6){
											$array[5]=1;
											//publicidad exterior
										}
										if($tipo['clasificacion']==7){
											$array[6]=1;
											//otro
										}										
							   }
							   
							   		echo '<td class="leftb">';
									if($array[0]==1){
										echo '<IMG width="6px" height="6px" SRC="../../listado/libs/punto.gif">';										
									}
									echo '</td>';
									
									echo '<td class="leftb">';
									if($array[1]==1){
										echo '<IMG width="6px" height="6px" SRC="../../listado/libs/punto.gif">';										
									}
									echo '</td>';
									
									echo '<td class="leftb">';
									if($array[2]==1){
										echo '<IMG width="6px" height="6px" SRC="../../listado/libs/punto.gif">';
									}
									echo '</td>';
									
									echo '<td class="leftb">';
									if($array[3]==1){
										echo '<IMG width="6px" height="6px" SRC="../../listado/libs/punto.gif">';
									}
									echo '</td>';
									
									echo '<td class="leftb">';
									if($array[4]==1){
										echo '<IMG width="6px" height="6px" SRC="../../listado/libs/punto.gif">';
									}
									echo '</td>';
									
									echo '<td class="leftb">';									
									if($array[5]==1){
										echo '<IMG width="6px" height="6px" SRC="../../listado/libs/punto.gif">';
									}
									echo '</td>';
									
									echo '<td class="leftb">';
									if($array[6]==1){
										echo '<IMG width="6px" height="6px" SRC="../../listado/libs/punto.gif">';
									}
									echo '</td>';																
							   
							   
							   foreach ($array as &$valor){
								   $valor=0;
							   }
								 
                               echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
