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

<td width="12%">
Año: <label class="numero" style="font-size:20px !important"><?php echo $anio;?></label>
</td>
<td width="8%" align="right" style="border-left:1px solid #7F7F7F;"> <label class="letra"> Medio:</label></td> 
<td width="15%" align="left"> <label class="numero" style="font-size:20px !important"> <?php echo $clasificacion_medio; ?> </label> </td>

<td width="10%" align="right" style="border-left:1px solid #7F7F7F;"> <label class="letra"> Campañas </label> realizadas: </td> 

<td width="10%" align="left"> <label class="numero"> <?php echo $num_campas; ?> </label> </td>

<td width="10%" align="right" style="border-left:1px solid #7F7F7F;"> <label class="letra"> Gastado </label> por medio: </td> 
<td width="25%" align="left"> <label class="numero"> $<?php echo number_format($costototalmedio); ?> </label> </td>

<td width="40%" align="right">
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


</center>



<!--div style="margin: 0 auto;
max-width: 1000px;
overflow:hidden;
position:relative;
font-weight: lighter;
font-size: 12px;"!-->

<br>
<br>

            
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_campas" style="margin-bottom:0px;">            
            
                <thead style="margin-top:10px;">                	                
            
                    <tr valign="bottom">
                        <th>Campaña</th><!--Estado-->
                        <th>Año</th>
                        <th>Categoria</th>
                        <th>Dependencia solicitante</th>                       
                        <th>Cobertura</th>
                        <th>Medio</th>
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
					
					$array = array(0,0,0,0,0,0,0);
					
                    foreach($todas_campas->result() as $fila)
                    { ?>
                               <tr>
                               <td class="leftb"> <a href="<?php echo base_url(); ?>index.php/campas/detalle_campa/<?php echo $fila->id_campa ?> "><?php echo mb_convert_encoding($fila->nombre, "UTF-8") ?></a> </td>
                               <td class="leftb"><?php echo mb_convert_encoding($fila->anio, "UTF-8")?></td>
							   
							   <td class="leftb"><?php echo mb_convert_encoding($fila->clasificacioncampa, "UTF-8") ?></td>
							   
							   <td class="leftb"><?php echo mb_convert_encoding($fila->dependencia_solicitante, "UTF-8") ?></td>						
							    <td class="leftb"><?php echo mb_convert_encoding($fila->cobertura, "UTF-8") ?></td>
                               <td class="leftb"><?php echo mb_convert_encoding($fila->tipomedio, "UTF-8") ?></td>						
							   
							   <td class="leftb">$<?php echo number_format($fila->totalmedio) ?></td>
							   
							   	
								 
								 
                               </tr>
                     
                    <?php } ?>
                <tbody>
            </table>

</div>

<br>

</body>
</html>