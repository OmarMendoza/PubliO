<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>Publicidad Oficial</title>		
    
</head>

<link type="text/css" href="<?php echo base_url(); ?>listado/css/style.css" rel="stylesheet" />

<style type="text/css">

html, body{ 
color:#8D8D8D;
}

.raya{
	border-bottom: 5px solid #231F20;
	width: 40%;
	float:right;
	margin-bottom:4px;			
}

.ver_mas_informacion{	
	color:#00B5E2;
	border: 1px solid #00B5E2;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	padding: 2px 5px;
	margin: 0 2px;
	cursor: pointer;
	*cursor: hand;
}

.ver_mas_informacion {
	background-color: #fff;
}

.ver_mas_informacion:hover {
	background-color: #ccc;
}

</style>

<body>

<div class="page" style="font-size:16px;">

<br><br>

<table>
<tr><td valign="top">Resultado de la búsqueda</td></tr>
</table>

<br>

<?php if($resultado_presupuesto->num_rows==0 &&$resultado_medios->num_rows==0 &&$resultado_contratos->num_rows==0 &&$resultado_campas->num_rows==0 &&$resultado_dependencias->num_rows==0) { ?>

<table style="height:300px;">
<tr><td valign="top">No hay resultados para este criterio</td></tr>
</table>

<?php }?>

<?php if($resultado_presupuesto->num_rows>0) { ?>
<table width="100%">
<tr><td colspan="4" align="left" style="color:#00B5E2;">Presupuesto</td></tr>
<tr>
<th align="left" width="5%">Año</th><th align="left" width="58%">Concepto</th><th align="left" width="10%">Cantidad</th><th align="left" width="10%">Porcentaje</th>
</tr>
<?php  foreach($resultado_presupuesto->result() as $fila) {?>
<tr><td><?php echo $fila->anio?></td><td><?php echo $fila->concepto?></td><td>$<?php echo number_format($fila->cantidad)?></td><td align="center"><?php echo $fila->porcentaje?>%</td><td align="right"><a class="ver_mas_informacion" href="<?php echo base_url()?>index.php/principal/cargar_por_anio?anio=<?php echo $fila->anio?>">Ver más información</a></td></tr>
<?php } ?>
</table>
<br><br>
<?php } ?>

<?php if($resultado_medios->num_rows>0) { ?>
<table width="100%">
<tr><td colspan="3" align="left" style="color:#00B5E2;">Medios</td></tr>
<tr>
<th width="18%" align="left">Nombre comercial</th><th width="18%" align="left">Razón social</th><th width="12%" align="left">Cobertura</th><th width="10%" align="left">Número de proveedor</th>
<th width="23%" align="left">Tipo</th><tr>
<?php  foreach($resultado_medios->result() as $fila) {?>
<tr><td><?php echo $fila->nombre_comercial?></td><td><?php echo $fila->razon_social?></td><td><?php echo $fila->cobertura?></td><td><?php echo $fila->padron_proveedor?></td><td><?php echo $fila->descripcion_clasificacion?></td><td width="16%" align="right"><a class="ver_mas_informacion" href="<?php echo base_url()?>index.php/contratosmedios/detalle_contratomedio/<?php echo $fila->id_medio?>">Ver más información</a></td></tr>
<?php } ?>
</table>
<br><br>
<?php } ?>

<?php if($resultado_contratos->num_rows>0) { ?>
<table width="100%">
<tr><td colspan="3" align="left" style="color:#00B5E2;">Contratos</td></tr>
<tr>
<th width="20%" align="left">Medio</th><th width="10%" align="left">Número de contrato</th><th width="50%" align="left">Objeto del contrato</th><tr>
<?php  foreach($resultado_contratos->result() as $fila) {?>
<tr><td><?php echo $fila->nombre_comercial?></td><td><?php echo $fila->num_contrato?></td><td><?php echo $fila->objeto_contrato?></td><td width="16%" align="right"><a class="ver_mas_informacion" href="<?php echo base_url()?>index.php/contratosmedios/detalle_contratomedio/<?php echo $fila->id_medio?>">Ver más información</a></td></tr>
<?php } ?>
</table>
<br><br>
<?php } ?>

<?php if($resultado_campas->num_rows>0) { ?>
<table width="100%">
<tr><td colspan="3" align="left" style="color:#00B5E2;">Campañas</td></tr>
<tr>
<th width="19%" align="left">Nombre</th><th width="4%" align="left">Año</th><th width="20%" align="left">Tema</th><th width="20%" align="left">Categoria de la campaña</th><th width="20%" align="left">Dependencia</th>
<tr>
<?php  foreach($resultado_campas->result() as $fila) {?>
<tr><td><?php echo $fila->nombre?></td><td><?php echo $fila->anio?></td><td><?php echo $fila->tema?></td><td><?php echo $fila->descripcion_clasificacion?></td><td><?php echo $fila->dependencia?></td><td align="right"><a class="ver_mas_informacion" href="<?php echo base_url()?>index.php/campas/detalle_campa/<?php echo $fila->id_campa?>">Ver más información</a></td></tr>
<?php } ?>
</table>
<br><br>
<?php } ?>

<?php if($resultado_dependencias->num_rows>0) { ?>
<table width="100%">
<tr><td colspan="3" align="left" style="color:#00B5E2;">Dependencias</td></tr>
<tr>
<th width="82%" align="left">Dependencia</th>
<tr>
<?php  foreach($resultado_dependencias->result() as $fila) {?>
<tr><td width="75%"><?php echo $fila->dependencia?></td><td width="25%" align="right"><a class="ver_mas_informacion" href="<?php echo base_url()?>index.php/dependencias/detalle_dependencia_buscador/<?php echo $fila->id_dependencia?>">Ver más información</a></td></tr>
<?php } ?>
</table>
<?php } ?>


</div>

<br><br>


</body>
</html>