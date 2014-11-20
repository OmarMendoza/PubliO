<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Transparencia Publicidad</title>
</head>
<body>

<div class="page">


<?php if (isset($nuevo_banner)) { ?>

<!--<a style="float:right;" href="<?php // echo base_url();?>index.php/campa/principal"> Regresar a listado de campañas </a> !-->

<a id="agregar" style="float:right;" href="<?php echo base_url();?>index.php/banners/agregar/<?php echo $id?>" <?php if($opcion_campa=="nuevo_banner") { echo 'id="primero"'; } ?> > Agregar nuevo banner </a> 

<?php } ?>


<?php if (isset($nuevo_audio)) { ?>

<!--<a style="float:right;" href="<?php echo base_url();?>index.php/campa/principal"> Regresar a listado de campañas </a> !-->

<a id="agregar" style="float:right;" href="<?php echo base_url();?>index.php/audios/agregar/<?php echo $id?>" <?php if($opcion_campa=="nuevo_audio") { echo 'id="primero"'; } ?> > Agregar nuevo audio </a> 


<?php } ?>


<?php if (isset($nuevo_video)) { ?>
<!--<a style="float:right;" href="<?php echo base_url();?>index.php/campa/principal"> Regresar a listado de campañas </a> !-->
<a id="agregar" style="float:right;" href="<?php echo base_url();?>index.php/videos/agregar/<?php echo $id?>" <?php if($opcion_campa=="nuevo_video") { echo 'id="primero"'; } ?> > Agregar nuevo video </a> 


<br>
<br>

<?php } ?>

<?php if (isset($nuevo_detalle)) { ?>
<!--<a style="float:right;" href="<?php echo base_url();?>index.php/facturas/principal"> Regresar a listado de facturas </a> !-->

<a id="agregar" style="float:right;" href="<?php echo base_url();?>index.php/detalle_factura/agregar/<?php echo $id?>"  <?php if($opcion_factura=="nuevo_detalle") { echo 'id="primero"'; } ?>> Agregar nuevo concepto de la factura </a> 

<?php } ?>

<?php if (isset($nuevo_desglose)) { ?>

<a id="agregar" style="float:right;" href="<?php echo base_url();?>index.php/desglose_presupuesto/agregar/<?php echo $id?>" 
<?php if($opcion_presupuesto=="nuevo_desglose") { echo 'id="primero"'; } ?>> Agregar nuevo concepto al desglose </a> 

<?php } ?>

<?php if (isset($nueva_imagen_factura)) { ?>

<!--<a style="float:right;" href="<?php echo base_url();?>index.php/facturas/principal"> Regresar a listado de facturas </a> !-->

<a id="agregar" style="float:right;" href="<?php echo base_url();?>index.php/imagenes_factura/agregar/<?php echo $id?>"  <?php if($opcion_factura=="nueva_imagen") { echo 'id="primero"'; } ?>> Agregar nueva imagen </a> 

<?php } ?>

<?php if (isset($nueva_imagen_testigo)) { ?>
<!--<a style="float:right;" href="<?php echo base_url();?>index.php/facturas/principal"> Regresar a listado de facturas </a> !-->
<a id="agregar" style="float:right;" href="<?php echo base_url();?>index.php/imagenes_testigo_factura/agregar/<?php echo $id?>"  <?php if($opcion_factura=="nueva_imagen_testigo") { echo 'id="primero"'; } ?>> Agregar nueva imagen de testigo </a> 

<?php } ?>

<?php if (isset($regresar)) { ?>

<a id="regresar" style="float:right;" onclick="history.back()" href="javascript:void(0);"> Regresar </a> 

<?php } ?>



</div>
      
      <br>
            
</body>
</html>