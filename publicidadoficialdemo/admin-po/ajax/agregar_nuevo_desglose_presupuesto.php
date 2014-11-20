<?php 
    require_once('conexion.php');
	
	$conexion=new Conexion();
	
    header("Content-Type: text/html;charset=utf-8");   
	
	$db = $conexion->conecta(); 
    mysql_query("SET CHARACTER SET utf8 ");
    
    $id_concepto="{$_GET['id_concepto']}";
	$concepto="{$_GET['concepto']}";
	$cantidad="{$_GET['cantidad']}"; 
	$presupuesto="{$_GET['presupuesto']}"; 
	$porcentaje=($cantidad/$presupuesto) * 100;    	
	$total=0;
	$total_porcentaje=0;
	
	mysql_query("INSERT INTO tp_desglose_presupuesto_temp(id_desglose_presupuesto, id_concepto,concepto,cantidad, porcentaje) VALUE (0,'$id_concepto', '$concepto', $cantidad, $porcentaje)",$db);
			
	$resultado = mysql_query("SELECT id_desglose_presupuesto, id_concepto, concepto,cantidad, porcentaje FROM tp_desglose_presupuesto_temp", $db); 
    echo '<table cellpadding="2" cellspacing="0" width="80%" 
	       style=" font-family:arial;	
	       font-size:11px;left:0px; top:20px; border:1px solid #c4c4c4; text-align:left; margin-buttom:20px;" >'; 
	echo '<tr><th width="30%" style="background:#6DA8C6; color:#fff; border:1px solid #fff;">Id concepto</th>
	          <th width="10%" style="background:#6DA8C6; color:#fff; border:1px solid #fff;">Concepto</th>
			  <th width="10%" style="background:#6DA8C6; color:#fff; border:1px solid #fff;">Cantidad</th>
			  <th width="10%" style="background:#6DA8C6; color:#fff; border:1px solid #fff;">Porcentaje</th>
		  </tr>'; 
	while ($fila = mysql_fetch_row($resultado)){ 
       echo '<tr><td>'.$fila[1].'</td>
	             <td>'.$fila[2].'</td>
				 <td>$'.number_format($fila[3]).'</td>';
				 $total=$total+$fila[3];
	   echo		 '<td>'.$fila[4].'%</td>';
	   			 $total_porcentaje=$total_porcentaje+$fila[4];				 
	   echo		 '<td><a class="eliminar" href="javascript:void(0);" data-id="'.$fila[0].'" onclick="javascript:eliminar_nuevo_desglose_presupuesto('.$fila[0].')" >Borrar</a></td></tr>'; 
	}
	
	echo '<tr><td style="color:#000; border:1px solid #c4c4c4; background:#6DA8C6;">Totales</td><td></td>
	             <td style="color:#868686; border:1px solid #c4c4c4;">$'.number_format($total).'</td>
				 <td style="color:#868686; border:1px solid #c4c4c4;">'.$total_porcentaje.'%</td></tr></table>';	
				 
	echo '<input type="hidden" name="total_presupuesto" id="total_presupuesto" value="'.$total.'" />';	 	
?>
