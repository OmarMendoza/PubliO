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
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>listado/js/funcionesdependenciasolicitantebusqueda.js"></script>
        <!--    JQUERY    -->
        <!--    FORMATO DE TABLAS    -->
        <link type="text/css" href="<?php echo base_url(); ?>listado/css/demo_table.css" rel="stylesheet" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>listado/js/jquery.dataTables.js"></script>
        <!--    FORMATO DE TABLAS    -->
        <script type="text/javascript">
        $(document).ready(function(){
		   $('#tabla_lista_campas_dependencia_solicitante_busqueda').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
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

.tabladetalledependencia td{
	width:50%;
	text-align:center;
	height:100px;
}

.tabladetalledependencia .con_raya{	
	border-right: 1px solid #00B5E2;
}

.letra{	
	font-weight: bold;
}

.letra_azul{	
	font-weight: bold;
	color:#00B5E2;
}

.numero{	
	color:#00B5E2;
	font-size:45px;
}

#contenido a {
	color: #00B5E2;
	/*text-decoration:underline;*/
	font-size:14px;
}

.volver{
	background: url('<?php echo base_url(); ?>imagenes/volver.gif') no-repeat;
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

<div class="page">

<table width="100%">

<tr>

<td width="20%">

<input type="button" value="" class="volver" onclick="history.back()" />

</td>

<td width="80%" align="right">
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52c6306f41aea844"></script>
<div class="addthis_sharing_toolbox"></div>

<!--div class="fb-like" data-href="<?php base_url() ?>" data-width="250" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" style="margin-right:35px;"></div>

<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php base_url() ?>" data-via="oaxtransparente" data-lang="es" data-text="<?php echo $nombre_dependencia; ?> | #Transparencia en #Publicidadoficial del @GobOax">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php base_url() ?>"></div>

<script type="text/javascript">
  window.___gcfg = {lang: 'es'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script-->

</td>

</tr>

</table>

<br><br>


<label class="letra_azul"> <?php echo $nombre_dependencia; ?> </label> <br><br>

<table width="100%" class="tabladetalledependencia"> 

<tr>

<td class="con_raya"> <label class="letra"> Campañas </label> <br> solicitadas <br> <label class="numero"> <?php echo $numero_campas; ?> </label> </td> <td> <label class="letra"> Gasto </label> <br> total <br><label class="numero"> $<?php echo number_format($monto_gastado); ?> </label> </td> 

</tr>

</table>

<br>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_campas_dependencia_solicitante_busqueda" style="margin-bottom:0px;">
                <thead>                	
                    <tr>
                        <th>Nombre de la campaña</th><!--Estado-->
                        <th>Año</th>
                        <th>Cobertura</th>
                        <th>Monto</th>                        
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
                    <?php

     
                   foreach($campas_dependencias_busqueda->result() as $fila)
                   { ?>
                               <tr>
                               <td class="leftb"> <a href="../../campas/detalle_campa/<?php echo $fila->id_campa ?>">
							   <?php echo mb_convert_encoding($fila->nombre, "UTF-8") ?></a> </td>
                               <td class="leftb"><?php echo mb_convert_encoding($fila->anio, "UTF-8") ?></td>
							   <td class="leftb"><?php echo mb_convert_encoding($fila->tipo, "UTF-8") ?></td>
							   <td>$<?php echo number_format($fila->monto_campa) ?></td>
								
                               </tr>
                     
                    <?php    }
                    ?>
                <tbody>
            </table>

</div>

<br>

</body>
</html>