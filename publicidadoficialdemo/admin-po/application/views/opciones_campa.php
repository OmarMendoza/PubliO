<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Transparencia Publicidad</title>
</head>
<body>

<div class="page">

<br>

<table width="100%" class="opciones"> 
<tr>
<td align="left"> <h2> <?php if($opcion_campa=="ver_todo") { echo 'Listado de campañas'; }  if($opcion_campa=="nueva_campa") { echo 'Ingrese los datos de la nueva campaña'; } if($opcion_campa=="buscar") { echo 'Resultado de la búsqueda'; }   if($opcion_campa=="banners_campa") { echo 'Banners de la campaña "'.$nombre_campa.'"'; } if($opcion_campa=="audios_campa") { echo 'Audios de la campaña "'.$nombre_campa.'"'; } if($opcion_campa=="videos_campa") { echo 'Videos de la campaña "'.$nombre_campa.'"'; } if($opcion_campa=="campas_dependencia") { echo 'Campañas de la dependencia "'.$dependencia.'"'; } ?> </h2> 
</td>
<td width="50%" align="right"> 
<?=form_open(base_url().'index.php/campa/buscar')?>
<input type="text" name="buscar" id="buscar" size="40" value="Buscar" onfocus="if (this.value=='Buscar') this.value='';" onblur="if (this.value=='') this.value='Buscar';"/>
<?=form_close()?>
</td>
</tr>
</table>

<br>

<div class="menu2">
<ul>
<li style="width:30%"  <?php if($opcion_campa=="ver_todo") { echo 'id="primero"'; } ?>>
<a href="<?php echo base_url();?>index.php/campa/principal"> Ver todos </a> 
</li>
<li style="width:70%"  <?php if($opcion_campa=="nueva_campa") { echo 'id="primero"'; } ?>>
<a href="<?php echo base_url();?>index.php/campa/nuevo"> Agregar nueva campaña </a> 
</li>
</ul>
</div>

<br>


<!--<center> <h2> <?php if($opcion_campa=="ver_todo") { echo 'Listado de campañas'; }  if($opcion_campa=="nueva_campa") { echo 'Ingrese los datos de la nueva campaña'; } if($opcion_campa=="buscar") { echo 'Resultado de la búsqueda'; }   if($opcion_campa=="banners_campa") { echo 'Banners de la campaña "'.$nombre_campa.'"'; } if($opcion_campa=="audios_campa") { echo 'Audios de la campaña "'.$nombre_campa.'"'; } if($opcion_campa=="videos_campa") { echo 'Videos de la campaña "'.$nombre_campa.'"'; } if($opcion_campa=="campas_dependencia") { echo 'Campañas de la dependencia "'.$dependencia.'"'; } ?> </h2> </center>!-->

</div>
            
</body>
</html>