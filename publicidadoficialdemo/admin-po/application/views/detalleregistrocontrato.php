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
<?php foreach($detalleregistrocontrato->result() as $fila) { ?>		
<tr><td width="40%">Fecha de celebración</td><td width="60%"><?php echo $fila->fecha_celebracion?></td></tr>
<tr><td width="40%">Número de contrato</td><td width="60%"><?php echo $fila->num_contrato?></td></tr>        
<tr><td width="40%">Monto contrato</td><td width="60%"><?php echo $fila->monto_contrato?></td></tr>   
<tr><td width="40%">Objeto del contrato</td><td width="60%"><?php echo $fila->objeto_contrato?></td></tr> 
<tr><td width="40%">Fecha inicial</td><td width="60%"><?php echo $fila->fecha_inicio?></td></tr>
<tr><td width="40%">Fecha de término</td><td width="60%"><?php echo $fila->fecha_fin?></td></tr>      
<tr><td width="40%">Contrato digitalizado</td><td width="60%">
<a target="_blank" href="<?php echo base_url(); ?>archivos/contratos/<?php echo $fila->archivo?>"> <IMG SRC="<?php echo base_url(); ?>imagenes/pdf.png" WIDTH=25 HEIGHT=25> </a>
</td></tr>        
<tr><td width="40%">Dependencia</td><td width="60%"><?php echo $fila->dependencia?></td></tr>        
<tr><td width="40%">Medio</td><td width="60%"><?php echo $fila->nombre_comercial?></td></tr>        
<tr><td width="40%">Modalidad</td><td width="60%"><?php echo $fila->modalidad?></td></tr>        
<!--tr><td width="40%">Monto gastado</td><td width="60%"><?php //echo $fila->ver_tarifario?></td></tr!-->        
<tr><td width="40%">Motivo de adjudicación</td><td width="60%"><?php echo $fila->motivoadj?></td></tr>           
<tr><td width="40%">Partida presupuestal</td><td width="60%"><?php echo $fila->partidapres?></td></tr>           
<?php } ?>

</table>

<br>

<a id="regresar" style="float:right;" onclick="history.back()" href="javascript:void(0);"> Regresar </a> 

<br><br><br> 

</div>
            
</body>
</html>