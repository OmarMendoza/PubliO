<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Medios</title>

<link type='text/css' href='<?php echo base_url();?>css/estilo_modal.css' rel='stylesheet' media='screen' />    
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/calendario_dw/jquery-1.8.2.min.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>ajax/ajaxs.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery.simplemodal.js"></script>     
  

</head>

<body>

<div class="page">

<br><br>

<table width="100%">
<?php foreach($detalleregistrocampa->result() as $fila) { ?>		
<tr><td width="40%">Nombre</td><td width="60%"><?php echo $fila->nombre?></td></tr>
<tr><td width="40%">Año</td><td width="60%"><?php echo $fila->anio?></td></tr>        
<tr><td width="40%">Tema</td><td width="60%"><?php echo $fila->tema?></td></tr>   
<tr><td width="40%">Tipo</td><td width="60%"><?php echo $fila->tipo?></td></tr>
<tr><td width="40%">Categoría de la campaña</td><td width="60%"><?php echo $fila->descripcion_clasificacion?></td></tr>
<tr><td width="40%">Etiquetas</td>
<td width="60%">
<?php 
$total=$etiquetas_campa->num_rows()-1;
$i=0;
foreach($etiquetas_campa->result() as $fila2) { ?>
<?php echo $fila2->etiqueta?>
<?php if($total!=$i) echo ", " ?>
<?php $i++;
} ?>
</td></tr>
<tr><td width="40%">Objetivo</td><td width="60%"><?php echo $fila->objetivo?></td></tr>  
<tr><td width="40%">Inicio</td><td width="60%"><?php echo $fila->periodicidad_inicio?></td></tr>        
<tr><td width="40%">Fin</td><td width="60%"><?php echo $fila->periodicidad_fin?></td></tr>        
<tr><td width="40%">Dependencia</td><td width="60%"><?php echo $fila->dependencia?></td></tr>        
<tr><td width="40%">Costo estimado</td><td width="60%"><?php echo "$".number_format($fila->costo_total)?></td></tr>        
<!--tr><td width="40%">Monto gastado</td><td width="60%"><?php //echo $fila->ver_tarifario?></td></tr!-->        
<tr><td width="40%">Estatus</td><td width="60%"><?php echo $fila->status?></td></tr>           
<?php } ?>
</table>

<br>

<a id="regresar" style="float:right;" onclick="history.back()" href="javascript:void(0);"> Regresar </a> 

<br><br><br> 

</div>
            
</body>
</html>