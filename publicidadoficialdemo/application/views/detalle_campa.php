<!DOCTYPE html>
<html lang="en">
<head>

<link type="text/css" href="<?php echo base_url(); ?>listado/css/style.css" rel="stylesheet" />

	<meta charset="utf-8">
	<title>Transparencia Publicidad</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/carrusel/css/carrusel.css">    
    
    <script type="text/javascript" src="<?php echo base_url(); ?>admin-po/calendario-jquery/jquery-1.8.2.min.js"></script>
    
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/lib/jquery.history.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/lib/raphael.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/lib/vis4.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/lib/Tween.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/build/bubbletree.js"></script>
	<script type="text/javascript" src="http://assets.openspending.org/openspendingjs/master/lib/aggregator.js"></script>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bubbletree/build/bubbletree2.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>bubbletree/styles/cofog.js"></script> 
    
    <!-- Para la galeria -->
    
	<script type="text/javascript" src="<?php echo base_url(); ?>galeria/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>galeria/jquery.fancybox.css?v=2.1.5" media="screen" />
    <script type="text/javascript" src="<?php echo base_url(); ?>galeria/galeria.js"></script>
    
    <script type="text/javascript">
       
		$(function() {
			
			var onNodeClick = function(node) {
				//alert(node.amount);
			}		
		 	
		 	var $tooltip = $('<div class="tooltip">Tooltip</div>');
                        $('.page .bubbletree').append($tooltip);
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
				
				<?php foreach($detalles->result() as $fila) { 
						$total=$fila->monto_total;
				} ?>
				
				<?php
					$numero_tipo_medio=0; 					
					$suma_prensa=0;
					$num_prensa=0;
					$suma_radio=0;
					$num_radio=0;
					$suma_internet=0;
					$num_internet=0;
					$suma_tv=0;
					$num_tv=0;
					$suma_cine=0;					
					$num_cine=0;
					$suma_exterior=0;					
					$num_exterior=0;
					$suma_otro=0;
					$num_otro=0;
					
					foreach($clasificacion_gastos->result() as $fila) { 
						if($fila->clasificacion==1){
						$suma_prensa=$suma_prensa+$fila->monto_medio;
						$num_prensa++;
						}
						
						if($fila->clasificacion==2){
						$suma_radio=$suma_radio+$fila->monto_medio;
						$num_radio++;
						}
						
						if($fila->clasificacion==3){
						$suma_internet=$suma_internet+$fila->monto_medio;
						$num_internet++;
						}
						
						if($fila->clasificacion==4){
						$suma_tv=$suma_tv+$fila->monto_medio;
						$num_tv++;
						}
						
						if($fila->clasificacion==5){
						$suma_cine=$suma_cine+$fila->monto_medio;
						$num_cine++;
						}
						
						if($fila->clasificacion==6){
						$suma_exterior=$suma_exterior+$fila->monto_medio;
						$num_exterior++;
						}
						
						if($fila->clasificacion==7){
						$suma_otro=$suma_otro+$fila->monto_medio;
						$num_otro++;
						}
					} 					
				?>	
				
					//------------medios impresos---------------									
										
					<?php if($suma_prensa>0){ $numero_tipo_medio++; ?>
					
									
					var child = {
						
					<?php if($num_prensa==1){	
					
					foreach($clasificacion_gastos->result() as $fila) { 									 
					
					if($fila->clasificacion==1){
					
					?> 
					label: 'Prensa: <?php echo $fila->nombre_comercial; ?> <br>$<?php echo number_format($suma_prensa); ?><br>', 
					amount: <?php echo $suma_prensa?>,
					color: '#5C8EA9',																														
					icon: "<?php echo base_url(); ?>imagenes/svg/escrita_icon.svg"
					
					
					<?php } 
					
					   }?>
					   
					};										
					
					node.children.push(child);	
					
					<?php } 
					
					if($num_prensa>1){ ?>										
					
					label: 'Prensa <br>$<?php echo number_format($suma_prensa); ?><br><?php //echo $porcentaje_medio; ?>', 
					amount: <?php echo $suma_prensa?>,
					color: '#5C8EA9',																														
					icon: "<?php echo base_url(); ?>imagenes/svg/escrita_icon.svg"																																			
					
					};	
					
					node.children.push(child);
					
					child.children=[];																																																																					
					
					<?php 
					foreach($clasificacion_gastos->result() as $fila) { 
					
					if($fila->clasificacion==1){ ?>
					
						var child1 = {
							label: '<?php echo $fila->nombre_comercial ?> <br>$<?php echo number_format($fila->monto_medio); ?><br><?php //echo $porcentaje_medio; ?>%', 
							color: '#5C8EA9',
							amount: <?php echo $fila->monto_medio?>																																		
						}
					
						child.children.push(child1);
					<?php } 
					
						}
					
					}?>											
					
					<?php } ?>										
										
					//--------------radio------------------
										
					<?php if($suma_radio>0){ $numero_tipo_medio++; ?>
									
					var child = {
						
					<?php if($num_radio==1){	
					
					foreach($clasificacion_gastos->result() as $fila) { 									 
					
					if($fila->clasificacion==2){
					
					?> 
					label: 'Radio: <?php echo $fila->nombre_comercial; ?> <br>$<?php echo number_format($suma_radio); ?><br>', 
					amount: <?php echo $suma_radio?>,
					color: '#00B5E2',																														
					icon: "<?php echo base_url(); ?>imagenes/svg/radio_icon.svg"
					
					
					<?php } 
					
					   }?>
					   
					};										
					
					node.children.push(child);	
					
					<?php } 
					
					if($num_radio>1){ ?>										
					
					label: 'Radio <br>$<?php echo number_format($suma_radio); ?><br><?php //echo $porcentaje_medio; ?>', 
					amount: <?php echo $suma_radio?>,	
					color: '#00B5E2',																													
					icon: "<?php echo base_url(); ?>imagenes/svg/radio_icon.svg"																																			
					
					};	
					
					node.children.push(child);
					
					child.children=[];																																																																					
					
					<?php 
					foreach($clasificacion_gastos->result() as $fila) { 
					
					if($fila->clasificacion==2){ ?>
					
						var child1 = {
							label: '<?php echo $fila->nombre_comercial ?> <br>$<?php echo number_format($$fila->monto_medio); ?><br><?php //echo $porcentaje_medio; ?>', 
							color: '#00B5E2',
							amount: <?php echo $fila->monto_medio?>																																		
						}
					
						child.children.push(child1);
					<?php } 
					
						}
					
					}?>											
					
					<?php } ?>										
															
					
					//--------------internet------------------
										
					<?php if($suma_internet>0){ $numero_tipo_medio++; ?>
									
					var child = {
						
					<?php if($num_internet==1){	
					
					foreach($clasificacion_gastos->result() as $fila) { 									 
					
					if($fila->clasificacion==3){
					
					?> 
					label: 'Internet: <?php echo $fila->nombre_comercial; ?> <br>$<?php echo number_format($suma_internet); ?><br>', 
					amount: <?php echo $suma_internet?>,
					color: '#35A6B6',																														
					icon: "<?php echo base_url(); ?>imagenes/svg/internet_icon.svg"
					
					
					<?php } 
					
					   }?>
					   
					};										
					
					node.children.push(child);	
					
					<?php } 
					
					if($num_internet>1){ ?>										
					
					label: 'Internet <br> $<?php echo number_format($suma_internet); ?><br><?php //echo $porcentaje_medio; ?>', 
					amount: <?php echo $suma_internet?>,	
					color: '#35A6B6',																													
					icon: "<?php echo base_url(); ?>imagenes/svg/internet_icon.svg"																																			
					
					};	
					
					node.children.push(child);
					
					child.children=[];																																																																					
					
					<?php 
					foreach($clasificacion_gastos->result() as $fila) { 
					
					if($fila->clasificacion==3){ ?>
					
						var child1 = {
							label: '<?php echo $fila->nombre_comercial ?> <br>$<?php echo number_format($fila->monto_medio); ?><br><?php //echo $porcentaje_medio; ?>',
							color: '#35A6B6', 
							amount: <?php echo $fila->monto_medio?>																																		
						}
					
						child.children.push(child1);
					<?php } 
					
						}
					
					}?>											
					
					<?php } ?>
										
					
					//--------------tv------------------
										
					<?php if($suma_tv>0){ $numero_tipo_medio++; ?>
									
					var child = {
						
					<?php if($num_tv==1){	
					
					foreach($clasificacion_gastos->result() as $fila) { 									 
					
					if($fila->clasificacion==4){
					
					?> 
					label: 'Tv: <?php echo $fila->nombre_comercial; ?> <br>$<?php echo number_format($suma_tv); ?><br>', 
					amount: <?php echo $suma_tv?>,
					color: '#005862',																															
					icon: "<?php echo base_url(); ?>imagenes/svg/tv_icon.svg"
					
					
					<?php } 
					
					   }?>
					   
					};										
					
					node.children.push(child);	
					
					<?php } 
					
					if($num_tv>1){ ?>										
					
					label: 'Tv <br> $<?php echo number_format($suma_tv); ?><br><?php //echo $porcentaje_medio; ?>', 
					amount: <?php echo $suma_tv?>,	
					color: '#005862',																														
					icon: "<?php echo base_url(); ?>imagenes/svg/tv_icon.svg"																																			
					
					};	
					
					node.children.push(child);
					
					child.children=[];																																																																					
					
					<?php 
					foreach($clasificacion_gastos->result() as $fila) { 
					
					if($fila->clasificacion==4){ ?>
					
						var child1 = {
							label: '<?php echo $fila->nombre_comercial ?> <br>$<?php echo number_format($fila->monto_medio); ?><br><?php //echo $porcentaje_medio; ?>%', 
							color: '#005862',	
							amount: <?php echo $fila->monto_medio?>																																		
						}
					
						child.children.push(child1);
					<?php } 
					
						}
					
					}?>											
					
					<?php } ?>
															
					//--------------cine------------------
										
					<?php if($suma_cine>0){ $numero_tipo_medio++; ?>
									
					var child = {
						
					<?php if($num_cine==1){	
					
					foreach($clasificacion_gastos->result() as $fila) { 									 
					
					if($fila->clasificacion==5){
					
					?> 
					label: 'Cine: <?php echo $fila->nombre_comercial; ?> <br>$<?php echo number_format($suma_cine); ?><br>', 
					amount: <?php echo $suma_cine?>,
					color: '#6DA8C6',																														
					icon: "<?php echo base_url(); ?>imagenes/svg/cine_icon.svg"
					
					
					<?php } 
					
					   }?>
					   
					};										
					
					node.children.push(child);	
					
					<?php } 
					
					if($num_cine>1){ ?>										
					
					label: 'Cine <br>$<?php echo number_format($suma_cine); ?><br><?php //echo $porcentaje_medio; ?>', 
					amount: <?php echo $suma_cine?>,
					color: '#6DA8C6',																														
					icon: "<?php echo base_url(); ?>imagenes/svg/cine_icon.svg"																																			
					
					};	
					
					node.children.push(child);
					
					child.children=[];																																																																					
					
					<?php 
					foreach($clasificacion_gastos->result() as $fila) { 
					
					if($fila->clasificacion==5){ ?>
					
						var child1 = {
							label: '<?php echo $fila->nombre_comercial ?> <br>$<?php echo number_format($fila->monto_medio); ?><br><?php //echo $porcentaje_medio; ?>', 
							color: '#6DA8C6',
							amount: <?php echo $fila->monto_medio?>																																		
						}
					
						child.children.push(child1);
					<?php } 
					
						}
					
					}?>											
					
					<?php } ?>
					
					
					//--------------exterior------------------
										
					<?php if($suma_exterior>0){ $numero_tipo_medio++; ?>
									
					var child = {
						
					<?php if($num_exterior==1){	
					
					foreach($clasificacion_gastos->result() as $fila) { 									 
					
					if($fila->clasificacion==6){
					
					?> 
					label: 'Publicidad exterior: <?php echo $fila->nombre_comercial; ?> <br>$<?php echo number_format($suma_exterior); ?><br>', 
					amount: <?php echo $suma_exterior?>,	
					color: '#345463',																													
					icon: "<?php echo base_url(); ?>imagenes/svg/exteriores_icon.svg"
					
					
					<?php } 
					
					   }?>
					   
					};										
					
					node.children.push(child);	
					
					<?php } 
					
					if($num_exterior>1){ ?>										
					
					label: 'Publicidad exterior <br>$<?php echo number_format($suma_exterior); ?><br><?php //echo $porcentaje_medio; ?>', 
					amount: <?php echo $suma_exterior?>,	
					color: '#345463',																													
					icon: "<?php echo base_url(); ?>imagenes/svg/exteriores_icon.svg"																																			
					
					};	
					
					node.children.push(child);
					
					child.children=[];																																																																					
					
					<?php 
					foreach($clasificacion_gastos->result() as $fila) { 
					
					if($fila->clasificacion==6){ ?>
					
						var child1 = {
							label: '<?php echo $fila->nombre_comercial ?> <br>$<?php echo number_format($fila->monto_medio); ?><br><?php //echo $porcentaje_medio; ?>', 
							color: '#345463',
							amount: <?php echo $fila->monto_medio?>																																		
						}
					
						child.children.push(child1);
					<?php } 
					
						}
					
					}?>											
					
					<?php } ?>
					
					
					//--------------otro------------------
										
					<?php if($suma_otro>0){ $numero_tipo_medio++; ?>
									
					var child = {
						
					<?php if($num_otro==1){	
					
					foreach($clasificacion_gastos->result() as $fila) { 									 
					
					if($fila->clasificacion==7){
					
					?> 
					label: 'Otro: <?php echo $fila->nombre_comercial; ?> <br>$<?php echo number_format($suma_otro); ?><br>', 
					amount: <?php echo $suma_otro?>,	
					color: '#0D95C7',																													
					icon: "<?php echo base_url(); ?>imagenes/svg/otros_icon.svg"
					
					
					<?php } 
					
					   }?>
					   
					};										
					
					node.children.push(child);	
					
					<?php } 
					
					if($num_otro>1){ ?>										
					
					label: 'Otro <br>$<?php echo number_format($suma_otro); ?><br><?php //echo $porcentaje_medio; ?>', 
					amount: <?php echo $suma_otro?>,
					color: '#0D95C7',																														
					icon: "<?php echo base_url(); ?>imagenes/svg/otros_icon.svg"																																			
					
					};	
					
					node.children.push(child);
					
					child.children=[];																																																																					
					
					<?php 
					foreach($clasificacion_gastos->result() as $fila) { 
					
					if($fila->clasificacion==7){ ?>
					
						var child1 = {
							label: '<?php echo $fila->nombre_comercial ?> <br>$<?php echo number_format($fila->monto_medio); ?><br><?php //echo $porcentaje_medio; ?>', 
							color: '#0D95C7',
							amount: <?php echo $fila->monto_medio?>																																		
						}
					
						child.children.push(child1);
					<?php } 
					
						}
					
					}?>											
					
					<?php } ?>
					
				<?php if($numero_tipo_medio==1) { ?>	
				
				var child={																																						
					label:'',
					amount:0,
					color: '#fff'																																		
				};
																																			
				node.children.push(child);
				
				var child={																																						
					label:'',
					amount:0,
					color: '#fff'																																		
				};
																																			
				node.children.push(child);
				
				<?php } ?>
				
				<?php if($numero_tipo_medio==2) { ?>	
				
				var child={																																						
					label:'',
					amount:0,
					color: '#fff'																																		
				};
																																			
				node.children.push(child);			
				
				<?php } ?>
				
				
				/*var child={																																						
					label:'Tv',
					amount:10,
					color: '#005862',
					icon: "<?php echo base_url(); ?>imagenes/svg/tv_icon.svg"																																			
				};
																																			
				node.children.push(child);
				
				var child={																																						
					label:'Internet',
					amount:10,
					color: '#35A6B6',
					icon: "<?php echo base_url(); ?>imagenes/svg/internet_icon.svg"																																			
				};
																																			
				node.children.push(child);
				
				var child={																																						
					label:'Prensa',
					amount:10,
					color: '#5C8EA9',
					icon: "<?php echo base_url(); ?>imagenes/svg/escrita_icon.svg"																																		
				};
																																			
				node.children.push(child);
				
				var child={																																						
					label:'Cine',
					amount:10,
					color: '#6DA8C6',
					icon: "<?php echo base_url(); ?>imagenes/svg/cine_icon.svg"																																			
				};
																																			
				node.children.push(child);
				
				var child={																																						
					label:'Exterior',
					amount:0,
					color: '#345463',
					icon: "<?php echo base_url(); ?>imagenes/svg/exteriores_icon.svg"																																			
				};
																																			
				node.children.push(child);
				
				var child={																																						
					label:'Otro',
					amount:10,
					color: '#0D95C7',
					icon: "<?php echo base_url(); ?>imagenes/svg/otros_icon.svg"																																			
				};
																																			
				node.children.push(child);*/								
																
				return node;
				
			}
			
			<?php //$porcentaje=($gastado/$presupuesto) * 100; ?>
			var data = generateRandomData({
				label: 'Total gastado:<br>$<?php echo number_format($total); ?><br><?php //echo round($porcentaje,2); ?>%<br>',
				amount: <?php echo $total ?>,
				color: '#7F7F7F'					
			});
			
			
			new BubbleTree({							
				data: data,				
				container: '.bubbletree',
				bubbleType: 'icon',
				nodeClickCallback: onNodeClick,
				firstNodeCallback: onNodeClick,				
				tooltipCallback: tooltip
			});
			
		});
                                        
	</script>     
    
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
.letra_radio{
	font-weight: bold;
	color:#6DA8C6;
}
.letra_tv{
	font-weight: bold;
	color:#42677A;
}

.letra_prensa{
	font-weight: bold;
	color:#49507A;
}
.letra_internet{
	font-weight: bold;
	color:#231F20;
}

.raya{
	border-bottom: 1px dashed #7F7F7F;
	margin-top:10px;
	margin-bottom:10px;
	width: 80%;				
}

.raya_completa{
	border-bottom: 1px solid #7F7F7F;
	margin-top:10px;
	margin-bottom:10px;
	width: 100%;				
}

.volver{
	background: url('../../../imagenes/volver.gif') no-repeat;
	width:80px;
	height:28px;
	border:none;
	cursor: pointer;
	*cursor: hand;
}

.numero_chico{	
	color:#00B5E2;
	font-size:30px;
}

#tablaradio{
	font-weight: bold;
	color:#7B7D7C;
	border-top: 2px solid #6DA8C6;
	
}

#tablatv{
	font-weight: bold;
	color:#7B7D7C;
	border-top: 2px solid #42677A;
	
}

#tablaprensa{
	font-weight: bold;
	color:#7B7D7C;
	border-top: 2px solid #49507A;
	
}

#tablainternet{
	font-weight: bold;
	color:#7B7D7C;
	border-top: 2px solid #231F20;
	
}

.tablamedios .con_raya{	
	border-right: 2px solid #BEBEBE;
}

#radio{
	visibility:hidden;
	margin:0px;
}

#tv{
	visibility:collapse;
	margin:0px;		
}

#prensa{
	visibility:hidden;
	margin:0px;
}

#internet{
	visibility:hidden;
	margin:0px;
}


/*para grafica circular*/


#container {
  width: 1000px;
  margin: 0 auto;
}

#chart {
	margin-top:-40px;
	float: left;
}

#chartData {
     
}

#chartData th, #chartData td {
  
}

#chartData th {
	text-align:left;  
}

#chartData td {
  cursor: pointer;
}

#chartData td.highlight {
  background: #e8e8e8;
}

#chartData tr:hover td {
  background: #f0f0f0;
}


/*tabla con scroll*/

.outer {
position:relative;
width:45%;
float:right;
}
.innera {
overflow:auto;
width:100%;
height:300px;
}



</style>

</head>
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

<input type="button" value="" class="volver" onclick="location.href='<?php echo base_url(); ?>index.php/campas'" />

</td>

<td width="80%" align="right">
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52c6306f41aea844"></script>
<div class="addthis_sharing_toolbox"></div>
<!--div class="fb-like" data-href="<?php base_url() ?>" data-width="250" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" style="margin-right:35px;"></div>

<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php base_url() ?>" data-via="oaxtransparente" data-lang="es" data-text="Campaña: <?php echo $fila->nombre ?> | #Transparencia en #Publicidadoficial del @GobOax">Twittear</a>
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


<table width="100%" class="tabladetallecampa"> 

<tr>

<td width="48%"> 

<?php foreach($detalles->result() as $fila) { ?>		      

Nombre de la campaña: <label class="letra"> <?php echo $fila->nombre ?> </label><br>
Cobertura: <label class="letra"> <?php echo $fila->tipo ?> </label><br>
Año: <label class="letra"> <?php echo $fila->anio ?> </label><br>
Dependencia solicitante: <label class="letra"> <?php echo $fila->dependencia; ?> </label><br>
Categoria de la campaña: <label class="letra"> <?php echo $fila->descripcion_clasificacion; ?> </label><br>
Etiquetas: <label class="letra">
<?php 
$total=$etiquetas_campa->num_rows()-1;
$i=0;
foreach($etiquetas_campa->result() as $fila2) { ?>
<?php echo $fila2->etiqueta?>
<?php if($total!=$i) echo ", " ?>
<?php $i++;
} ?>
</label><br>


<div class="raya"> </div>

Duración de la campaña:<br>
Inicio <label class="letra"> <?php echo $fila->periodicidad_inicio;  ?> </label> Fin <label class="letra"> <?php echo $fila->periodicidad_fin; ?> </label><br>

<div class="raya"> </div>

Monto gastado:<br>
<label class="numero_chico"> $<?php echo number_format($fila->monto_total); ?> </label><br>

</td>
<td width="4%">&nbsp;</td>
<td width="48%" align="left" valign="top"> 

Tema: <label class="letra"> <?php echo $fila->tema; ?> </label>  <br>

Objetivo:<label class="letra"> <?php echo $fila->objetivo; ?></label> <br>

<?php } ?>

</td> 

</tr>

</table>

<br><div class="raya_completa"> </div><br>

<div class="bubbletree-wrapper">
		<div class="bubbletree"></div>
</div>



<?php $contador_1=0;
	  $contador_2=0;
	  $contador_3=0;
	  $contador_4=0;
	  $contador_5=0;
	  $contador_6=0;
	  $contador_7=0; ?>

<div class="outer">
<div class="innera">
  
<table align="right" width="100%">
<thead></thead>
<tfoot></tfoot>
<tbody>      

<?php foreach($clasificacion_gastos->result() as $fila) {?>
		
    	<?php if($fila->clasificacion==1) { 
		$contador_1++;
		if($contador_1==1) {?>
        <tr><td colspan="2" bgcolor="#5C8EA9" style="font-weight:bold; font-size:20px; color:#fff">Medios impresos</td></tr>
        <?php } ?>
       <tr><td><?php echo $fila->nombre_comercial?></td><td>$<?php echo number_format($fila->monto_medio)?></td></tr>
        <?php } if($fila->clasificacion==2) { 
		$contador_2++;
		if($contador_2==1) {?>
        <tr><td colspan="2" bgcolor="#00B5E2" style="font-weight:bold; font-size:20px; color:#fff">Radio</td></tr>
        <?php } ?>
       <tr><td><?php echo $fila->nombre_comercial?></td><td>$<?php echo number_format($fila->monto_medio)?></td></tr>
        <?php } if($fila->clasificacion==3) { 
		$contador_3++;
		if($contador_3==1) {?>
        <tr><td colspan="2" bgcolor="#35A6B6" style="font-weight:bold; font-size:20px; color:#fff">Internet</td></tr>
        <?php } ?>
       <tr><td><?php echo $fila->nombre_comercial?></td><td>$<?php echo number_format($fila->monto_medio)?></td></tr>
        <?php } if($fila->clasificacion==4) {
		$contador_4++;
		if($contador_4==1) {?>
        <tr><td colspan="2" bgcolor="#005862" style="font-weight:bold; font-size:20px; color:#fff">Televisión</td></tr>
        <?php } ?>
       <tr><td><?php echo $fila->nombre_comercial?></td><td>$<?php echo number_format($fila->monto_medio)?></td></tr>
        <?php } if($fila->clasificacion==5) { 
		$contador_5++;
		if($contador_5==1) {?>
        <tr><td colspan="2" bgcolor="#6DA8C6" style="font-weight:bold; font-size:20px; color:#fff">Cine</td></tr>
        <?php } ?>
       <tr><td><?php echo $fila->nombre_comercial?></td><td>$<?php echo number_format($fila->monto_medio)?></td></tr>
        <?php } if($fila->clasificacion==6) { 
		$contador_6++;
		if($contador_6==1) {?>
        <tr><td colspan="2" bgcolor="#345463" style="font-weight:bold; font-size:20px; color:#fff">Publicidad exterior</td></tr>
        <?php } ?>
       <tr><td><?php echo $fila->nombre_comercial?></td><td>$<?php echo number_format($fila->monto_medio)?></td></tr>
        <?php } if($fila->clasificacion==7) { 
		$contador_7++;
		if($contador_7==1) {?>
        <tr><td colspan="2" bgcolor="#0D95C7" style="font-weight:bold; font-size:20px; color:#fff">Otro</td></tr>
        <?php } ?>
        <tr><td><?php echo $fila->nombre_comercial?></td><td>$<?php echo number_format($fila->monto_medio)?></td></tr>       
<?php } } ?>		        

</tbody>
</table>

</div>
</div>

<br><br>

<div class="raya_completa" style="margin-top:400px;"> </div>
		
        <label class="letra">Imagen</label>
        <?php 
		  if(count($fotos->result())>0){
		 ?>
		<div id="divCarousel">
			<div id="divIzquierda"></div>
			<div id="divCentro">
				<ul>					                    
                    <?php foreach($fotos->result() as $fila) { ?>		                         
                    <li>
     <a class="fancybox" href="<?php echo base_url(); ?>admin-po/archivos/banners/<?php echo $fila->banner; ?>" data-fancybox-group="gallery" title="">
                    <img width="128" height="128" src="<?php echo base_url(); ?>admin-po/archivos/banners/<?php echo $fila->banner; ?>">
     </a>
                    </li>
                    <?php } ?>
				</ul>
			</div>
			<div id="divDerecha"></div>
			<div class="clsSalto"></div>
		</div>
        <?php 
		     } else
		     echo "<br><br>"."No existen archivos de imagen"."<br>"; ?>
        
        <br>   
        <label class="letra">Video</label>
        <?php 
		  if(count($videos->result())>0){
		 ?>
        <div id="divCarousel2">
			<div id="divIzquierda2"></div>
			<div id="divCentro2">
				<ul>					                    
                    <?php foreach($videos->result() as $fila) { ?>		                         
                    <li><iframe width="128" height="128" src="<?php echo $fila->video; ?>" allowfullscreen></iframe></li>
                    <?php } ?>
				</ul>
			</div>
			<div id="divDerecha2"></div>
			<div class="clsSalto2"></div>  
		</div>
         <?php 
		     } else
		     echo "<br><br>"."No existen archivos de video"."<br>"; ?>
        
        <br>
        <label class="letra">Audio</label>
        
<!--link href="<?php echo base_url();?>admin-po/jplayer/js/jPlayer.css" rel="stylesheet" type="text/css" /!-->
<!--link href="<?php echo base_url();?>admin-po/jplayer/js/prettify/prettify-jPlayer.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>admin-po/jplayer/skin/blue.monday/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>admin-po/jplayer/js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin-po/jplayer/js/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin-po/jplayer/js/jquery.jplayer.inspector.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin-po/jplayer/js/themeswitcher.js"></script-->
<script type="text/javascript" src="<?php echo base_url();?>admin-po/audiojs/audio.js"></script>



<style>
#wrapperaudio { width: 400px; margin: 10px 0px; }
      
#wrapperaudio ol { padding: 0px; margin: 0px; list-style: decimal-leading-zero inside; color: #ccc; width: 460px; border-top: 1px solid #ccc; font-size: 0.9em; }
#wrapperaudio ol li { position: relative; margin: 0px; padding: 9px 23px 10px; border-bottom: 1px solid #ccc; cursor: pointer; }
#wrapperaudio ol li a { display: block; text-indent: -3.3ex; padding: 0px 0px 0px 20px; }
#wrapperaudio li.playing { color: #aaa; text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.3); }
#wrapperaudio li.playing a { color: #000; }
#wrapperaudio li.playing:before { content: '♬'; width: 14px; height: 14px; padding: 3px; line-height: 14px; margin: 0px; position: absolute; left: 1px; top: 9px; color: #000; font-size: 13px; text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.2); }
      
      #shortcuts { position: relative; bottom: 0px; width: 100%; color: #666; font-size: 0.9em; margin: 0px 0px 0px; padding: 20px 20px 15px; }
      #shortcuts div { width: 460px; margin: 0px 0px; }
      #shortcuts h1 { margin: 0px 0px 6px; }
      #shortcuts p { margin: 0px 0px 18px; }
      #shortcuts em { font-style: normal; background: #d3d3d3; padding: 3px 9px; position: relative; left: -3px;
        -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px;
        -webkit-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); -o-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); }

      @media screen and (max-device-width: 480px) {
        #wrapperaudio { position: relative; left: -3%; }
        #shortcuts { display: none; }
      }

</style>

<script>
$(function() { 
        
        var a = audiojs.createAll({
          trackEnded: function() {
            var next = $('ol li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.addClass('playing').siblings().removeClass('playing');
            audio.load($('a', next).attr('data-src'));
            audio.play();
          }
        });
        
        var audio = a[0];
            first = $('ol a').attr('data-src');
        $('ol li').first().addClass('playing');
        audio.load(first);

        $('ol li').click(function(e) {
          e.preventDefault();
          $(this).addClass('playing').siblings().removeClass('playing');
          audio.load($('a', this).attr('data-src'));
          audio.play();
        });
        
		$(document).keydown(function(e) {
          var unicode = e.charCode ? e.charCode : e.keyCode;
             // right arrow
          if (unicode == 39) {
            var next = $('li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.click();
            // back arrow
          } else if (unicode == 37) {
            var prev = $('li.playing').prev();
            if (!prev.length) prev = $('ol li').last();
            prev.click();
            // spacebar
          } else if (unicode == 32) {
            audio.playPause();
          }
        })
      });</script>
        <?php 
		  if(count($audios->result())>0){
	
		 ?>
         <br><br>
      
      <div id="wrapperaudio">
      <audio preload></audio>
      <ol>
         <?php foreach($audios->result() as $fila) { ?>
           <li><a href="#" data-src="<?php echo base_url()?>admin-po/archivos/audios/<?php echo $fila->audio; ?>"><?php echo $fila->audio; ?></a></li>
        	<?php } ?>
      </ol>
    </div>
    <div id="shortcuts">
      <div>
        <p>Teclas:</p>
        <p><em>&rarr;</em> Siguiente audio</p>
        <p><em>&larr;</em> Anterior audio</p>
        <p><em>Space</em> Reproducir/detener</p>
      </div>
      
        </div> <?php  
		     } else
		     echo "<br><br>"."No existen archivos de audio";  ?>
                
        <br>
                   
         </div> 
		<script type="text/javascript" src="<?php echo base_url(); ?>carrusel/js/carrusel.js"></script>

</div>

</body>
</html>