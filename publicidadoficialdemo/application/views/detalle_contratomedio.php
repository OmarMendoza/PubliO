<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Transparencia Publicidad</title>
		<!--    ESTILO GENERAL   -->
        <link type="text/css" href="<?php echo base_url(); ?>listado/css/style.css" rel="stylesheet" />
        <!--    ESTILO GENERAL    -->
        <!--    JQUERY   -->
        <script type="text/javascript" src="<?php echo base_url(); ?>listado/js/jquery.js"></script>        
        <!--    JQUERY    -->
        <!--    FORMATO DE TABLAS    -->
        <link type="text/css" href="<?php echo base_url(); ?>listado/css/demo_table.css" rel="stylesheet" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>listado/js/jquery.dataTables.js"></script>
        <!--    FORMATO DE TABLAS    -->    
        
		<script type="text/javascript" language="javascript">
        $(document).ready(function(){
		   $('#tabla_lista_contratos').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
				"sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
			} );
		})
        </script>
        
</head>

<style type="text/css">

html, body{ 
color:#8D8D8D;
font-family:Arial;
font-size: 14px;
}
 

.tablacampas .con_raya{	
	border-right: 1px solid #00B5E2;
}

.letra{
	font-weight: bold;
	color:#00B5E2;
}

.raya{
	border-bottom: 1px dashed #7F7F7F;
	margin-top:10px;
	margin-bottom:10px;
	width: 60%;				
}

#contenido a {
	color: #00B5E2;
	/*text-decoration:underline;*/
	font-size:14px;
}

.volver{
	background: url('../../../imagenes/volver.gif') no-repeat;
	width:80px;
	height:28px;
	border:none;
	cursor: pointer;
	*cursor: hand;
}
		 
</style>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=601013836595770";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<br><br>

<div class="page" style="font-size:16px;">

<table width="100%">

<tr>

<td width="20%">

<input type="button" value="" class="volver" onclick="history.back()" />

</td>

<td width="80%" align="right">

<div class="fb-like" data-href="<?php base_url() ?>" data-width="250" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" style="margin-right:35px;"></div>

<?php foreach($detalles->result() as $fila) { ?>

<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php base_url() ?>" data-via="oaxtransparente" data-lang="es" data-text="<?php echo $fila->nombre_comercial ?> | #Transparencia en #Publicidadoficial del @GobOax">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<?php } ?>


<!-- Inserta esta etiqueta donde quieras que aparezca Botón Compartir. -->
<div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php base_url() ?>"></div>

<!-- Inserta esta etiqueta después de la última etiqueta de compartir. -->
<script type="text/javascript">
  window.___gcfg = {lang: 'es'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

</td>

</tr>

</table>

<br><br>


<table width="100%" class="tabladetallecampa"> 

<tr>

<td width="48%">

<?php foreach($detalles->result() as $fila) { ?>
 
Nombre comercial: <label class="letra"> <?php echo $fila->nombre_comercial ?> </label><br><br>
Razón social:<br> <label class="letra"> <?php echo $fila->razon_social ?> </label><br><br>
No. de registro en el padrón de proveedores:<br> <label class="letra"> <?php echo $fila->padron_proveedor ?> </label><br><br>
Tipo de medio: <label class="letra"> <?php echo $fila->descripcion_clasificacion ?> </label><br>
Cobertura: <label class="letra"> <?php echo $fila->cobertura ?> </label><br><br>

<?php if($fila->ver_ficha_tecnica=="si"){ ?>

<div class="raya"> </div>

<a target="_blank" href="<?php echo base_url(); ?>admin-po/archivos/fichas_tecnica/<?php echo $fila->ficha_tecnica ?>" style="color:#00B5E2; font-weight:bold; text-decoration:underline;"> Ver</a> Ficha técnica del medio <br>

<?php } ?>

<?php if($fila->ver_tarifario=="si"){ ?>

<div class="raya"> </div>

<a target="_blank" href="<?php echo base_url(); ?>admin-po/archivos/tarifarios/<?php echo $fila->tarifario ?>" style="color:#00B5E2; font-weight:bold; text-decoration:underline;"> Ver</a> Tarifario <br>

<?php } ?>

<div class="raya"> </div>

</td> 
<td width="4%">&nbsp;</td>
<td width="48%" valign="top">

Perfil demográfico: <br> 
<label class="letra">  <?php echo $fila->perfil_demografico  ?> </label> <br>

<?php } ?>

</td> 

</tr>

</table>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_contratos" style="margin-bottom:0px;">
                <thead>                	
                    <tr>
                        <th>No. de contrato</th><!--Estado-->
                        <th>Objeto del contrato</th>
                        <th>Fecha de celebración</th>
                        <th>Monto contratado</th>
                        <th>Monto gastado</th>                     
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
                    <?php foreach($contratos_medio->result() as $fila) { ?>
                               <tr>
                               <td class="leftb"><?php echo mb_convert_encoding($fila->num_contrato, "UTF-8")?></td>
                               <td class="leftb"><?php echo mb_convert_encoding($fila->objeto_contrato, "UTF-8")?></td>
							   <td class="leftb"><?php echo mb_convert_encoding($fila->fecha_celebracion, "UTF-8")?></td>
							   <td class="leftb">$<?php echo number_format($fila->monto_contrato)?></td>
							   <td class="leftb">$<?php echo number_format($fila->monto_gastado);
							   $porcentaje=$fila->monto_gastado/$fila->monto_contrato*100;
							   $porcentaje=round($porcentaje); ?>
			<div style="width:100px; height:20; border: 1px solid #000; text-align:center; font-weight: bold;"><div style="width:'.$porcentaje.'px; height:20; background:#969696; font-size:12px; color:#00B5E2; font-weight: bold; text-align:center;"><label style="color:#000; font-size:12px; font-weight: bold; text-align:center; margin-left:2px;"><?php echo $porcentaje ?>%</label></div></div>
									</td>
								 
                               </tr>
                     
                    <?php  } ?>
                <tbody>
</table>

</div>

<br>

</body>
</html>