<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>Publicidad Oficial</title>

	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/lib/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/lib/jquery.history.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/lib/raphael.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/lib/vis4.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/lib/Tween.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/build/bubbletree.js"></script>
	<script type="text/javascript" src="http://assets.openspending.org/openspendingjs/master/lib/aggregator.js"></script>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bubbletree/build/bubbletree.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/styles/cofog.js"></script>    
    
    <script type="text/javascript">
       
		$(function() {
			
			var onNodeClick = function(node) {
				/*var cotIcon=(node.icon);
				var porIcon = cotIcon.substring(74);
				
				
				switch(porIcon){
				 case 'cine_icon.svg': break;	
				 case 'escrita_icon.svg': break;	
				 case 'exteriores_icon.svg': break;	
				 case 'internet_icon.svg': break;	
				 case 'otros_icon.svg': break;	
				 case 'radio_icon.svg': break;	
				 case 'tv_icon.svg': break;	
				 default: break;
				}*/
			}		
		 	
		 	var $tooltip = $('<div class="tooltip">Tooltip</div>');
                        $('.bubbletree').append($tooltip);
                        $tooltip.hide();
                                                  
		 	var getTooltip = function() {
                                return this.getAttribute('tooltip');
      };
     
      var tooltip = function(event) {
                                if (event.type == 'SHOW') {
                                        // show tooltip
                                        $tooltip.css({ 
                                                left: event.mousePos.x + 4, 
                                                top: event.mousePos.y + 4 
                                        });
                                        $tooltip.html(event.node.label+' <b>'+event.node.famount+'</b>');
                                        $tooltip.show();
                                } else {
                                        // hide tooltip
                                        $tooltip.hide();
                                }
      };
									
		
			function generateRandomData(node, level) {	
										
				node.children = [];	
				
			<?php $clasificacion_medio=0 ?>
			
			<?php   foreach($clasificacion->result() as $fila) { ?>
				
					var child = {
					<?php $porcentaje_medio=($fila->total/$gastado) * 100; ?>  
					amount: <?php echo $fila->total?>,
					
					
					<?php if($fila->id_clasificacion==1) {					
					$clasificacion_medio=$fila->id_clasificacion;	
					?>	
label: 'Medios impresos <br>$<?php echo number_format($fila->total); ?><br><?php echo round($porcentaje_medio); ?>%',
					color: '#5C8EA9',														
					icon: "<?php echo base_url(); ?>imagenes/svg/escrita_icon.svg"
					
					<?php }?>	
					
					<?php if($fila->id_clasificacion==2) {
					$clasificacion_medio=$fila->id_clasificacion;	
					?>
label: '<?php echo $fila->descripcion_clasificacion?><br>$<?php echo number_format($fila->total); ?><br><?php echo round($porcentaje_medio); ?>%',
					color: '#00B5E2',															
					icon: "<?php echo base_url(); ?>imagenes/svg/radio_icon.svg"
					<?php }?>
					
					<?php if($fila->id_clasificacion==3) {
					$clasificacion_medio=$fila->id_clasificacion;	
					?>
label: '<?php echo $fila->descripcion_clasificacion?><br>$<?php echo number_format($fila->total); ?><br><?php echo round($porcentaje_medio); ?>%',
					color: '#35A6B6',															
					icon: "<?php echo base_url(); ?>imagenes/svg/internet_icon.svg"
					<?php }?>
					
					<?php if($fila->id_clasificacion==4) {
					$clasificacion_medio=$fila->id_clasificacion;	
					?>
label: '<?php echo $fila->descripcion_clasificacion?><br>$<?php echo number_format($fila->total); ?><br><?php echo round($porcentaje_medio); ?>%',
					color: '#005862',															
					icon: "<?php echo base_url(); ?>imagenes/svg/tv_icon.svg"
					<?php }?>
					
					<?php if($fila->id_clasificacion==5) {
					$clasificacion_medio=$fila->id_clasificacion;	
					?>
label: '<?php echo $fila->descripcion_clasificacion?><br>$<?php echo number_format($fila->total); ?><br><?php echo round($porcentaje_medio); ?>%',
					color: '#6DA8C6',															
					icon: "<?php echo base_url(); ?>imagenes/svg/cine_icon.svg"
					<?php }?>
					
					<?php if($fila->id_clasificacion==6) {
					$clasificacion_medio=$fila->id_clasificacion;	
					?>
label: 'Publicidad exterior <br>$<?php echo number_format($fila->total); ?><br><?php echo round($porcentaje_medio); ?>%',
					color: '#345463',															
					icon: "<?php echo base_url(); ?>imagenes/svg/exteriores_icon.svg"
					<?php }?>
					
					<?php if($fila->id_clasificacion==7) {
					$clasificacion_medio=$fila->id_clasificacion;	
					?>
label: '<?php echo $fila->descripcion_clasificacion?><br>$<?php echo number_format($fila->total); ?><br><?php echo round($porcentaje_medio); ?>%',
					color: '#0D95C7',															
					icon: "<?php echo base_url(); ?>imagenes/svg/otros_icon.svg"
					<?php }?>
					
					};
					
					node.children.push(child);
					
					child.children = [];
					
					<?php   foreach($medios_participantes->result() as $fila2) { ?>					
							<?php if($fila2->id_clasificacion==$clasificacion_medio) { ?>
							
								<?php $porcentaje_cada_medio=($fila2->total/$gastado) * 100; ?>
								
								var child1={
								label:'<?php echo $fila2->nombre_comercial?><br>$<?php echo number_format($fila2->total) ?><br><?php echo round($porcentaje_cada_medio)?>%',
								amount:<?php echo $fila2->total?>				
								}
								
								child.children.push(child1);
								
							<?php } ?>
					<?php } ?>
																						
					
				<?php } ?>
				
				<?php if($clasificacion->num_rows()==1) { ?>
								
					var child = {
					label: '', 
					amount: 0,	
					color: '#fff'
															
					};
					
					node.children.push(child);
					
					var child = {
					label: '', 
					amount: 0,	
					color: '#fff'
															
					};
					
					node.children.push(child);
					
				<?php } ?>
				
				<?php if($clasificacion->num_rows()==2) { ?>
								
					var child = {
					label: '', 
					amount: 0,	
					color: '#fff'
															
					};
					
					node.children.push(child);
										
				<?php } ?>
					/*child.children = [];																
					
					var child1={
					label:'kjklklkdj',
					amount:4				
					}
					
					child.children.push(child1);
					
					var child2={
					label:'kjklklkdj',
					amount:4					
					}
					
					var child = {
					label: 'Tv', 
					amount: 37,	
					color: '#005862',																													
					icon: "<?php echo base_url(); ?>imagenes/svg/tv_icon.svg"										
					};
					
					node.children.push(child);
					
					child.children = [];																
					
					var child1={
					label:'kjklklkdj',
					amount:10					
					}
					
					child.children.push(child1);
					
					var child2={
					label:'kjklklkdj',
					amount:10					
					}
					
					child.children.push(child2);					
					
					var child2={
					label:'kjklklkdj',
					amount:17					
					}
					
					child.children.push(child2);					
					
					var child = {
					label: 'Internet', 
					amount: 10,		
					color: '#35A6B6',																												
					icon: "<?php echo base_url(); ?>imagenes/svg/internet_icon.svg"										
					};
					
					node.children.push(child);
					
					child.children = [];																
					
					var child1={
					label:'kjklklkdj',
					amount:5					
					}
					
					child.children.push(child1);
					
					var child2={
					label:'kjklklkdj',
					amount:5					
					}
					
					child.children.push(child2);
					
					var child = {
					label: 'Impresos', 
					amount: 10,		
					color: '#5C8EA9',																												
					icon: "<?php echo base_url(); ?>imagenes/svg/escrita_icon.svg"										
					};
					
					node.children.push(child);
					
					child.children = [];																
					
					var child1={
					label:'kjklklkdj',
					amount:5					
					}
					
					child.children.push(child1);
					
					var child2={
					label:'kjklklkdj',
					amount:5					
					}
					
					child.children.push(child2);
					
					var child = {
					label: 'Cine', 
					amount: 15,		
					color: '#6DA8C6',																												
					icon: "<?php echo base_url(); ?>imagenes/svg/cine_icon.svg"										
					};
					
					node.children.push(child);
					
					child.children = [];																
					
					var child1={
					label:'kjklklkdj',
					amount:5					
					}
					
					child.children.push(child1);
					
					var child2={
					label:'kjklklkdj',
					amount:10					
					}
					
					child.children.push(child2);
					
					var child = {
					label: 'Exterior', 
					amount: 5,		
					color: '#345463',																												
					icon: "<?php echo base_url(); ?>imagenes/svg/exteriores_icon.svg"										
					};
					
					node.children.push(child);
					
					child.children = [];																
					
					var child1={
					label:'kjklklkdj',
					amount:2					
					}
					
					child.children.push(child1);
					
					var child2={
					label:'kjklklkdj',
					amount:3					
					}
					
					child.children.push(child2);
					
					var child = {
					label: 'Otro', 
					amount: 10,		
					color: '#0D95C7',																												
					icon: "<?php echo base_url(); ?>imagenes/svg/otros_icon.svg"										
					};
					
					node.children.push(child);
					
					child.children = [];																
					
					var child1={
					label:'kjklklkdj',
					amount:5					
					}
					
					child.children.push(child1);
					
					var child2={
					label:'kjklklkdj',
					amount:5					
					}
					
					child.children.push(child2);*/										
				
				return node;	
				
			}
				
				
				
			<?php $porcentaje=($gastado/$presupuesto) * 100; ?>
			var data = generateRandomData({
				label: 'Total gastado: <br>$<?php echo number_format($gastado); ?><br>',
				amount: <?php echo $gastado ?>,
				color: '#7F7F7F'				
			});
			
			
			new BubbleTree({
				data: data,
				container: '.bubbletree',
				bubbleType: ['donut', 'icon', 'donut'],
				
						nodeClickCallback: onNodeClick,
						firstNodeCallback: onNodeClick,											
						//tooltipCallback: tooltip,																		

			});
			
		});
                                        
	</script>
    
    
</head>

<link type="text/css" href="<?php echo base_url(); ?>listado/css/style.css" rel="stylesheet" />

<style type="text/css">


html, body{ 
color:#8D8D8D;
}

.tabla1 td{
	width:25%;
	text-align:center;
	height:100px;
	color:#8D8D8D;
	font-size:16px;
}

.tabla1 .con_raya{	
	border-right: 1px solid #7F7F7F;
}

.tabla2 td{	
	color:#8D8D8D;
	font-size:16px;
	border-bottom:1px solid #000;
}

.tabla2 .con_raya{	
	border-right: 1px solid #7F7F7F;
}

.letra{
	font-weight: bold;
}
.numero{	
	color:#00B5E2;
	font-size:55px;
}

.numero_chico{	
	color:#00B5E2;
	font-size:35px;
}

.raya{
	border-bottom: 5px solid #231F20;
	width: 40%;
	float:right;
	margin-bottom:4px;			
}

/*tabla con scroll*/

.outer {
position:relative;
width:410px;
float:right;
/*text-transform:lowercase;*/
}
.innera {
overflow:auto;
width:100%;
height:300px;
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

<form action="<?php echo base_url()?>index.php/principal/cargar_por_anio" method="post">

Año

<select id="anio" name="anio" onchange="this.form.submit()">
<?php foreach($anios_principal->result() as $fila) { ?>	
        <option value="<?php echo $fila->anio?>" <?php if($fila->anio==$anio) echo "selected" ?> ><?php echo $fila->anio?></option>        
<?php } ?>
</select>

</form>

</td>

<td width="80%" align="right">
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52c6306f41aea844"></script>
<div class="addthis_sharing_toolbox"></div>

<!--div class="fb-like" data-href="http://www.oaxtransparente.oaxaca.gob.mx/publicidadoficial" data-width="250" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" style="margin-right:35px;"></div>

<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.oaxtransparente.oaxaca.gob.mx/publicidadoficial" data-via="oaxtransparente" data-lang="es" data-text="#Transparencia en #Publicidadoficial del @GobOax">Twittear</a>
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

<table width="100%"><tr><td width="100%" align="right"> <?php if (isset($ultima_actualizacion)) { ?> Última actualización: <?php echo $ultima_actualizacion; } ?></td></tr></table>

<br>
<table width="100%" class="tabla1"> 
<tr> 
<td class="con_raya"> <label class="letra"> Presupuesto </label> de <br>comunicación social <br><br> 
<label class="numero_chico">$<?php echo number_format($presupuesto) ?></label> </td> 
<td class="con_raya"> <label class="letra"> Gastado </label> en <br> publicidad oficial <br><br> <label class="numero_chico"> $<?php echo number_format($gastado); ?> </label> </td>
<td class="con_raya"> <label class="letra"> Medios </label> <br> contratados <br> <label class="numero"> <?php echo $num_medios; ?> </label> </td> 
<td> <label class="letra"> Campañas </label> <br> realizadas <br><a class="numero" href="<?php echo base_url(); ?>index.php/campas"> <?php echo $num_campas; ?></a> </td> 
</tr>
</table>

<br><br><br>

<div class="bubbletree-wrapper">
		<div class="bubbletree"></div>
</div>


<table width="40%" align="right" style="font-size:16px;" ><tr><th>Desglose del presupuesto</th></tr></table>
<br><br>
<div class="raya"></div>
<br>

<table width="410px" align="right" style="font-size:16px;" border="0">
<tr><th align="left" width="22%">Clave</th><th align="left" width="27%">Concepto</th><th align="left" width="22%">Monto</th><th align="left" width="10%">%</th></tr>
</table>

<div class="outer">
<div class="innera" style="height:400px">

<table class="tabla2" width="100%" style="font-size:16px; table-layout: fixed;">
<thead></thead>
<tfoot></tfoot>
<tbody>
<?php foreach($desgloses->result() as $fila) { ?>	
<tr><td width="22%" class="con_raya" align="left"><?php echo $fila->id_concepto ?></td><td width="27%" class="con_raya" align="left"><?php echo ucfirst(strtolower($fila->concepto)) ?></td><td width="22%" class="con_raya" align="left">$<?php echo number_format($fila->cantidad) ?></td><td width="9%" align="left"><?php echo $fila->porcentaje ?>%</td></tr>
<?php } ?>		 
         
</tbody>
</table><br><br><br>
    
<table width="410px" align="center" style="font-size:16px; border-bottom:5px solid #000" ><tr><th>Gasto por tipo medio<br></th></tr></table><br>
<table class="tabla2"  width="410px" align="right" style="font-size:16px;" border="0">
<tr><th align="left" width="40%">Medio</th><th align="left" width="40%">Monto</th>
    <th align="left" width="20%"></th></tr>
<?php 
foreach($clasificacion->result() as $fila) {
   // echo $fila->total;
    $porcentaje_medio=($fila->total/$gastado) * 100;  
?>
<tr><td width="40%" class="con_raya" align="left"><?php echo $fila->descripcion_clasificacion ?></td>
    <td width="40%" class="con_raya" align="left"><?php echo number_format($fila->total) ?></td>
    <td width="20%" align="left"><a href="<?php echo base_url() ?>index.php/campas_medios/cargar/<?php echo $fila->id_clasificacion ?>/<?php echo $anio; ?>" style="color:#00B5E2;">Ver más</a></td></tr>
    
    
<?php } ?>		 
             
</table>    
    
</div>

</div>

</div>


<br><br>

</body>
</html>