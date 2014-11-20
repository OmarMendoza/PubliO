<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Transparencia en publicidad oficial</title>
    
        <!--    ESTILO GENERAL   -->
        <link type="text/css" href="<?php echo base_url(); ?>listado/css/style.css" rel="stylesheet" />
        <!--    ESTILO GENERAL    -->
        <!--    JQUERY   -->
        <script type="text/javascript" src="<?php echo base_url(); ?>listado/js/jquery.js"></script>        
        <!--    JQUERY    -->
        <!--    FORMATO DE TABLAS    -->
        <link type="text/css" href="<?php echo base_url(); ?>listado/css/demo_table.css" rel="stylesheet" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>listado/js/jquery.dataTables.js"></script>
        
        <script type="text/javascript" language="javascript">
        
        $(document).ready(function(){
           $('#tabla_lista_paises').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
                "sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
            } );
        })
        
        </script>
        
        <!--    FORMATO DE TABLAS    -->        
        
</head>

<style type="text/css">

html, body{ 
color:#8D8D8D;
font-family:Arial;
}

.tablacontratosmedios{
	margin-bottom:30px;
}
.tablacontratosmedios td{
	width:50%;
	text-align:center;
	height:100px;
}

.tablacontratosmedios .con_raya{	
	border-right: 1px solid #7F7F7F;
}

.letra{
	font-weight: bold;
}
.numero{	
	color:#00B5E2;
	font-size:55px;
}

#contenido a {
	color: #00B5E2;
	/*text-decoration:underline;*/
	font-size:14px;
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

<div class="page" style="font-size:16px;">

<table width="100%" style="font-size:16px; margin-top:30px;">

<tr>

<td width="20%">

<form action="<?php echo base_url()?>index.php/contratosmedios/cargar_por_anio" method="post">

Año

<select id="anio" name="anio" onchange="this.form.submit()">
<?php foreach($anios_medios_contratados->result() as $fila) { ?>		
        <option value="<?php echo $fila->anio?>" <?php if($fila->anio==$anio) echo "selected" ?> ><?php echo $fila->anio?></option>        
<?php } ?>
</select>

</form>

</td>

<td width="80%" align="right">

<div class="fb-like" data-href="<?php base_url() ?>" data-width="250" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" style="margin-right:35px;"></div>

<a href="https://twitter.com/share" class="twitter-share-button" data-url=""<?php base_url() ?>index.php/contratosmedios/cargar" data-via="oaxtransparente" data-lang="es" data-text="Contratos y medios | #Transparencia en #Publicidadoficial del @GobOax" >Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<!-- Inserta esta etiqueta donde quieras que aparezca Botón Compartir. -->
<div class="g-plus" data-action="share" data-annotation="bubble" data-href=""<?php base_url() ?>/contratosmedios/cargar"></div>

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

<br>
<table width="100%"><tr><td width="100%" align="right"><?php if (isset($ultima_actualizacion)) { ?>Última actualización: <?php echo $ultima_actualizacion; } ?></td></tr></table>
<br>

<table width="100%" class="tablacontratosmedios" style="font-size:16px;"> 

<tr>

<td class="con_raya"> <label class="letra"> Medios </label>contratados <br> <label class="numero"> <?php echo $num_medios; ?> </label> </td> <td> <label class="letra"> Monto</label> contratado <br> <label class="numero"> $<?php echo number_format($monto_contratado); ?> </label> </td> 

</tr>

</table>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_paises" style="margin-bottom:-5px;">
                <thead>                	
                    <tr>
                        <th>Medio contratado</th><!--Estado-->
                        <th>Tipo de medio</th>
                        <th>Año</th>
                        <th>Cobertura</th>
                        <th>Monto contratado</th>
                    </tr>
                </thead>
                <tfoot>               
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                  <tbody>
                  
                                                                                                                                                     
                    <?php foreach($todo_medios->result() as $fila) { ?>		
							  <tr>
                               <td class="leftb"> <a href="detalle_contratomedio/<?php echo $fila->id_medio?>">
							   <?php echo mb_convert_encoding($fila->nombre_comercial, "UTF-8")?></a> </td>
                               <td class="leftb"><?php echo mb_convert_encoding($fila->descripcion_clasificacion, "UTF-8")?></td>
							   <td class="leftb"><?php echo mb_convert_encoding($fila->anio, "UTF-8")?></td>
							   <td class="leftb"><?php echo mb_convert_encoding($fila->cobertura, "UTF-8")?></td>
							   <td><?php echo number_format($fila->contratado)?></td>
								 
                              </tr>
                   
                    <?php } ?>
    <tbody>
</table>

</div>

<br>

</body>
</html>