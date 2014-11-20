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
<!--<td width="8%" align="left">
<a href="<?php echo base_url();?>index.php/medios/principal" <?php if($opcion_medio=="ver_todos") { echo 'id="primero"'; } ?>> Ver todos </a> 
</td>
<td width="42%" align="left">
<a href="<?php echo base_url();?>index.php/medios/administracion/add" <?php if($opcion_medio=="nuevo_medio") { echo 'id="primero"'; } ?>> Agregar nuevo medio </a> 
</td>!-->
<td align="left"> <h2> <?php if($opcion_presupuesto=="ver_presupuesto") { echo 'Presupuesto actual en comunicación social'; }  if($opcion_presupuesto=="nuevo_presupuesto") { echo 'Ingrese los datos del nuevo presupuesto'; } if($opcion_presupuesto=="buscar") { echo 'Resultado de la búsqueda'; }  if($opcion_presupuesto=="desglose") { echo 'Desglose del presupuesto '; } ?> </h2> </td>
<td width="50%" align="right"> 
<?=form_open(base_url().'index.php/presupuesto/buscar')?>
<input type="text" name="buscar" id="buscar" size="40" value="Buscar" onfocus="if (this.value=='Buscar') this.value='';" onblur="if (this.value=='') this.value='Buscar';" /> <!--<input type="submit" value="Buscar medio" class="boton" /> !-->
<?=form_close()?>
</td>
</tr>
</table>

<br>

<!--
<table width="50%" class="opciones"> 
<tr>
<td width="8%" align="left">
<a href="<?php echo base_url();?>index.php/medios/principal" <?php if($opcion_medio=="ver_todos") { echo 'id="primero"'; } ?>> Ver todos </a> 
</td>
<td width="42%" align="left">
<a href="<?php echo base_url();?>index.php/medios/administracion/add" <?php if($opcion_medio=="nuevo_medio") { echo 'id="primero"'; } ?>> Agregar nuevo medio </a> 
</td>
</tr>
</table>!-->


<div class="menu2">
<ul>
<li style="width:40%" <?php if($opcion_presupuesto=="ver_presupuesto") { echo 'id="primero"'; } ?>>
<a href="<?php echo base_url();?>index.php/presupuesto/principal"> Ver presupuesto </a>
</li>
<li style="width:60%" <?php if($opcion_presupuesto=="nuevo_presupuesto") { echo 'id="primero"'; } ?>>
<a style="margin-right:10px" href="<?php echo base_url();?>index.php/presupuesto/nuevo" > Nuevo presupuesto </a> 
</li>
</ul>
</div>

</div>
            
</body>
</html>