<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>hola publicidad</title>
    <!--    ESTILO GENERAL  !-->
        <link type="text/css" href="<?php echo base_url(); ?>listado/css/style.css" rel="stylesheet" />
        <!--    ESTILO GENERAL    
        <!--    JQUERY  !-->
        <script type="text/javascript" src="<?php echo base_url(); ?>listado/js/jquery.js"></script>
        <!--    JQUERY    -->
        <!--    FORMATO DE TABLAS !-->   
        <link type="text/css" href="<?php echo base_url(); ?>listado/css/demo_table.css" rel="stylesheet" />  
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>listado/js/jquery.dataTables.js"></script>
        <!--    FORMATO DE TABLAS    -->                                     
        
        <script type="text/javascript" src="<?php echo base_url(); ?>treemap/d3.v3.min.js"></script>
        
        <script type="text/javascript" language="javascript">
        $(document).ready(function(){
			   $('#tabla_lista_campas').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
					"sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
				} );
		})
        </script>
        
</head>

<style type="text/css">

html, body{ 
color:#8D8D8D;
}

.tablacampas td{
	width:100%;
	text-align:center;
	height:100px;
}

.tablacampas .con_raya{	
	border-right: 1px solid #00B5E2;
}

.letra{
	font-weight: bold;
}
.numero{	
	color:#00B5E2;
	font-size:35px;
}

#contenido a {
	color: #00B5E2;
	/*text-decoration:underline;*/
	font-size:14px;
}

#contenido a:active {
	color: #00B5E2;
}

#contenido a:visited {
	color: #00B5E2;
}

#contenido a:hover {
	color: #00B5E2;
/*text-decoration: underline;	*/
}

.raya_completa{
	border-bottom: 1px solid #7F7F7F;
	margin-top:10px;
	margin-bottom:10px;
	width: 100%;
	height: 40px;				
}

/*estilo para treemap*/

	#chart {
        width: 1200px;
        height: 420px;
        margin: 0px auto;
        position: relative;
        -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
                box-sizing: border-box;
				color:#fff;
				font-size:24px;
    }

    text {
        pointer-events: none;					
    }
    .grandparent text { /* header text */        
        font-size: medium;
        font-family: Arial;
		color:#ffffff;
		padding-left:20px;	
    }

    rect {
        fill: none;
        stroke: #fff;
				
    }

    rect.parent,
    .grandparent rect {
        stroke-width: 2px;		
    }

    .grandparent rect {
        fill: #7F7F7F;		 
    }

    .children rect.parent,
    .grandparent rect {
        cursor: pointer;
		
    }

    rect.parent {
        pointer-events: all; 
    }

    .children:hover rect.child,
    .grandparent:hover rect {
        fill: #aaa;
    }

    .textdiv { /* text in the boxes */
        font-size: small;
        padding: 10px;
        font-family:Arial; 
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

<table width="100%" style="font-size:16px; margin-top:30px; height:30px;">

<tr>

<td width="14%">

<form action="<?php echo base_url()?>index.php/campas/cargar_por_anio" method="post">

Año

<select id="anio" name="anio" onchange="this.form.submit()">
<?php foreach($anios_campas->result() as $fila) { ?>		
        <option value="<?php echo $fila->anio?>" <?php if($fila->anio==$anio) echo "selected" ?> ><?php echo $fila->anio?></option>        
<?php } ?>
</select>

</form>

</td>

<td width="20%" align="right" style="border-left:1px solid #7F7F7F;"> <label class="letra"> Campañas </label> realizadas: </td> 

<td width="6%" align="left"> <label class="numero"> <?php echo $num_campas; ?> </label> </td>

<td width="60%" align="right">
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52c6306f41aea844"></script>
<div class="addthis_sharing_toolbox"></div>

<!--div class="fb-like" data-href="" data-width="250" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" style="margin-right:35px; margin-top:-10px;"></div>

<a href="https://twitter.com/share" class="twitter-share-button" data-url="" data-via="oaxtransparente" data-lang="es" data-text="Campañas | #Transparencia en #Publicidadoficial del @GobOax" >Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://www.oaxtransparente.oaxaca.gob.mx/publicidadoficial"></div>

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

<br>

<table width="100%"><tr><td width="100%" align="right"><?php if (isset($ultima_actualizacion)) { ?>Última actualización: <?php echo $ultima_actualizacion; } ?></td></tr></table>

<br>

<center>

<table width="10%" class="tablacampas" align="center" style="font-size:16px;"> 

<tr>

<!--td style="border-left:1px solid #7F7F7F; border-right:1px solid #7F7F7F;"> <label class="letra"> Campañas </label> <br>realizadas <br> <label class="numero"> <?php echo $num_campas; ?> </label> </td!--> 

</tr>

</table>

</center>

<?php 
//$arreglo_colores = array("#BFBFBF", "#35A6B6", "#5BB7C4" , "#000000", "#005862", "#4C4C4C", "#287F89", "#979596"); 
$arreglo_colores = array("#00B5E2", "#005862", "#35A6B6" , "#05C8EA9", "#6DA8C6", "#345463", "#0D95C7"); 
$numero_colores=count($arreglo_colores);
$contador=0;

?>

<!--div id="treeMap" style="width: 100%;height: 400px; color:#fff" ></div!-->

			<p id="chart">
            <script type="text/javascript" src="<?php echo base_url(); ?>treemap/zoomable_treemap.js"></script>
            </p>


<!--div style="margin: 0 auto;
max-width: 1000px;
overflow:hidden;
position:relative;
font-weight: lighter;
font-size: 12px;"!-->

<br><div class="raya_completa"> </div><br>

<table align="right" style="font-size:10px;">
<td><img src="<?php echo base_url() ?>imagenes/imagenes/prensa.png" height="18" width="18"/></td><td style="padding-right:12px;">Medios impresos</td>
<td><img src="<?php echo base_url() ?>imagenes/imagenes/radio.png" height="18" width="18"/></td><td style="padding-right:12px;">Radio</td>
<td><img src="<?php echo base_url() ?>imagenes/imagenes/internet.png" height="18" width="18"/></td><td style="padding-right:12px;">Internet</td>
<td><img src="<?php echo base_url() ?>imagenes/imagenes/tv.png" height="18" width="18"/></td><td style="padding-right:12px;">Televisión</td>
<td><img src="<?php echo base_url() ?>imagenes/imagenes/cine.png" height="18" width="18"/></td><td style="padding-right:12px;">Cine</td>
<td><img src="<?php echo base_url() ?>imagenes/imagenes/exterior.png" height="18" width="18"/></td><td style="padding-right:12px;">Publicidad exterior</td>
<td><img src="<?php echo base_url() ?>imagenes/imagenes/otros.png" height="18" width="18"/></td><td style="padding-right:12px;">Otro</td>
</table>
<br>
<br>



            
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_campas" style="margin-bottom:0px;">            
            
                <thead style="margin-top:10px;">                	                
            
                    <tr valign="bottom">
                        <th>Campaña</th><!--Estado-->
                        <th>Año</th>
                        <th>Categoria</th>
                        <th>Dependencia solicitante</th>
                        <th>Dependencia contratante</th>
                        <th>Cobertura</th>
                        <th>Monto</th>    
                        <td valign="bottom"><img src="<?php echo base_url() ?>imagenes/imagenes/prensa.png" height="18" width="16"/></td>
                        <td valign="bottom"><img src="<?php echo base_url() ?>imagenes/imagenes/radio.png" height="18" width="16"/></td>
                        <td valign="bottom"><img src="<?php echo base_url() ?>imagenes/imagenes/internet.png" height="18" width="16"/></td>
                        <td valign="bottom"><img src="<?php echo base_url() ?>imagenes/imagenes/tv.png" height="18" width="15"/></td>
                        <td valign="bottom"><img src="<?php echo base_url() ?>imagenes/imagenes/cine.png" height="18" width="16"/></td>
                        <td valign="bottom"><img src="<?php echo base_url() ?>imagenes/imagenes/exterior.png" height="18" width="16"/></td>
                        <td valign="bottom"><img src="<?php echo base_url() ?>imagenes/imagenes/otros.png" height="18" width="15"/></td>  
                        
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
					
					$array = array(0,0,0,0,0,0,0);
					
                    foreach($todas_campas->result() as $fila)
                    { ?>
                               <tr>
                               <td class="leftb"> <a href="detalle_campa/<?php echo $fila->id_campa ?> "><?php echo mb_convert_encoding($fila->nombre, "UTF-8") ?></a> </td>
                               <td class="leftb"><?php echo mb_convert_encoding($fila->anio, "UTF-8")?></td>
							   
							   <td class="leftb"><?php echo mb_convert_encoding($fila->descripcion_clasificacion, "UTF-8") ?></td>
							   
							   <td class="leftb"><?php echo mb_convert_encoding($fila->dependencia_solicitante, "UTF-8") ?></td>						
							   
							   <td class="leftb">
							   
							   <?php $dependencias="";
							   
							   foreach($dependencias_contratantes_campas->result() as $fila3)
                   			   {
								   
								   if($fila3->campa_factura==$fila->id_campa){
								   $dependencias=$dependencias.mb_convert_encoding($fila3->dependencia, "UTF-8").", ";
								   }
								   
							   }
							   
							   $dependencias=substr($dependencias, 0, -2);
							   
							   echo $dependencias; ?>
							   
							   </td>
							   
							   <td class="leftb"><?php echo mb_convert_encoding($fila->tipo, "UTF-8") ?></td>
							   <td class="leftb">$<?php echo number_format($fila->total_campa) ?></td>
							   
							   <?php 													   
							     
							   foreach($clasificaciones_campas->result() as $fila2)
                   			   {
								   		if($fila2->clasificacion==1 && $fila2->campa_factura==$fila->id_campa){
											$array[0]=1;
											//medios impresos
										}
										if($fila2->clasificacion==2 && $fila2->campa_factura==$fila->id_campa){
											$array[1]=1;
											//radio
										}
										if($fila2->clasificacion==3 && $fila2->campa_factura==$fila->id_campa){
											$array[2]=1;
											//internet
										}
										if($fila2->clasificacion==4 && $fila2->campa_factura==$fila->id_campa){
											$array[3]=1;
											//televión
										}
										if($fila2->clasificacion==5 && $fila2->campa_factura==$fila->id_campa){
											$array[4]=1;
											//cine
										}
										if($fila2->clasificacion==6 && $fila2->campa_factura==$fila->id_campa){
											$array[5]=1;
											//publicidad exterior
										}
										if($fila2->clasificacion==7 && $fila2->campa_factura==$fila->id_campa){
											$array[6]=1;
											//otro
										}										
							   }?>
							   
							   		<td class="leftb">
									<?php if($array[0]==1){?>
										<IMG width="6px" height="6px" SRC="<?php echo base_url(); ?>listado/libs/punto.gif">
									<?php } ?>
									</td>
									
									<td class="leftb">
									<?php if($array[1]==1){ ?>
										<IMG width="6px" height="6px" SRC="<?php echo base_url(); ?>listado/libs/punto.gif">
									<?php } ?>
									</td>
									
									<td class="leftb">
									<?php if($array[2]==1){ ?>
										<IMG width="6px" height="6px" SRC="<?php echo base_url(); ?>listado/libs/punto.gif">
									<?php } ?>
									</td>
									
									<td class="leftb">
									<?php if($array[3]==1){ ?>
										<IMG width="6px" height="6px" SRC="<?php echo base_url(); ?>listado/libs/punto.gif">
									<?php } ?>
									</td>
									
									<td class="leftb">
									<?php if($array[4]==1){ ?>
										<IMG width="6px" height="6px" SRC="<?php echo base_url(); ?>listado/libs/punto.gif">
									<?php } ?>
									</td>
								
									<td class="leftb">
									<?php if($array[5]==1){ ?>
										<IMG width="6px" height="6px" SRC="<?php echo base_url(); ?>listado/libs/punto.gif">
									<?php } ?>
									</td>
									
									<td class="leftb">
									<?php if($array[6]==1){ ?>
										<IMG width="6px" height="6px" SRC="<?php echo base_url(); ?>listado/libs/punto.gif">
									<?php } ?>
									</td>
							   
							   
							   <?php foreach ($array as &$valor){
								   $valor=0;
							   }?> 
								 
                               </tr>
                     
                    <?php } ?>
                <tbody>
            </table>

</div>

<br>

</body>
</html>