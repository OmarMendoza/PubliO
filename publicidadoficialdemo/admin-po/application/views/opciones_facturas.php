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
<td align="left">
<h2> <?php if($opcion_factura=="ver_todo") { echo 'Listado de facturas'; }  if($opcion_factura=="nueva_factura") { echo 'Ingrese los datos de la nueva factura'; } if($opcion_factura=="buscar") { echo 'Resultado de la búsqueda'; } if($opcion_factura=="imagenes_factura") { echo 'Digitalización de la factura "'.$num_factura.'"'; } if($opcion_factura=="imagenes_testigo_factura") { echo 'Imagenes testigo de la factura "'.$num_factura.'"'; } if($opcion_factura=="detalle_factura") { echo 'Desglose de la factura "'.$num_factura.'"'; } if($opcion_factura=="facturas_medio") { echo 'Facturas del medio "'.$medio.'"'; } if($opcion_factura=="facturas_campa") { echo 'Facturas de la campaña "'.$nombre_campa.'"'; } if($opcion_factura=="facturas_contrato") { echo 'Facturas del contrato numero "'.$contrato.'"'; } ?>  </h2>
</td>
<td width="50%" align="right"> 
<?=form_open(base_url().'index.php/facturas/buscar')?>
<input type="text" name="buscar" id="buscar" size="40" value="Buscar" onfocus="if (this.value=='Buscar') this.value='';" onblur="if (this.value=='') this.value='Buscar';"  /> 
<?=form_close()?>
</td>
</tr>
</table>

<br>

<div class="menu2">
<ul>
<li style="width:30%" <?php if($opcion_factura=="ver_todo") { echo 'id="primero"'; } ?>>
<a style="margin-right:10px" href="<?php echo base_url();?>index.php/facturas/principal" > Ver todos </a>
</li>
<li style="width:70%" <?php if($opcion_factura=="nueva_factura") { echo 'id="primero"'; } ?>>
<a style="margin-right:10px" href="<?php echo base_url();?>index.php/facturas/nuevo" > Agregar nueva factura </a> </li>
</ul>
</div>

<br>

</div>
            
</body>
</html>