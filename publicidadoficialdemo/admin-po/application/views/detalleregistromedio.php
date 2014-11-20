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
<?php foreach($detalleregistromedio->result() as $fila) { ?>		
<tr><td width="40%">Razón social</td><td width="60%"><?php echo $fila->razon_social?></td></tr>
<tr><td width="40%">Nombre comercial</td><td width="60%"><?php echo $fila->nombre_comercial?></td></tr>        
<tr><td width="40%">Número de proveedor</td><td width="60%"><?php echo $fila->padron_proveedor?></td></tr>        
<tr><td width="40%">Clasificación</td><td width="60%"><?php echo $fila->descripcion_clasificacion?></td></tr>        
<tr><td width="40%">Cobertura</td><td width="60%"><?php echo $fila->cobertura?></td></tr>        
<tr><td width="40%">Perfil demografico</td><td width="60%"><?php echo $fila->perfil_demografico?></td></tr>        
<tr><td width="40%">Tarifario</td><td width="60%">
<a target="_blank" href="<?php echo base_url(); ?>archivos/tarifarios/<?php echo $fila->tarifario?>"> <IMG SRC="<?php echo base_url(); ?>imagenes/pdf.png" WIDTH=25 HEIGHT=25> </a></td></tr>        
<tr><td width="40%">¿publicar tarifario?</td><td width="60%"><?php echo $fila->ver_tarifario?></td></tr>        
<tr><td width="40%">Acta constitutiva</td><td width="60%">
<a target="_blank" href="<?php echo base_url(); ?>archivos/actas_constitutivas/<?php echo $fila->acta_constitutiva?>"> <IMG SRC="<?php echo base_url(); ?>imagenes/pdf.png" WIDTH=25 HEIGHT=25> </a>
</td></tr>        
<tr><td width="40%">Currículum empresarial</td><td width="60%">
<a target="_blank" href="<?php echo base_url(); ?>archivos/curriculum_empresarial/<?php echo $fila->curriculum_empresarial?>"> <IMG SRC="<?php echo base_url(); ?>imagenes/pdf.png" WIDTH=25 HEIGHT=25> </a>
</td></tr>       
<tr><td width="40%">Ficha técnica</td><td width="60%">
<a target="_blank" href="<?php echo base_url(); ?>archivos/fichas_tecnica/<?php echo $fila->ficha_tecnica?>"> <IMG SRC="<?php echo base_url(); ?>imagenes/pdf.png" WIDTH=25 HEIGHT=25> </a>
</td></tr>       
<tr><td width="40%">¿publicar ficha técnica?</td><td width="60%"><?php echo $fila->ver_ficha_tecnica?></td></tr>        
<?php } ?>
</table>

<br>

<a id="regresar" style="float:right;" onclick="history.back()" href="javascript:void(0);"> Regresar </a>

<br><br><br> 

</div>
            
</body>
</html>