<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<link rel="stylesheet" type="text/css" href="http://localhost/publicidadoficial/carrusel/css/carrusel.css">

<script src="http://localhost/publicidadoficial/graficacircular/jquery.min.js"></script>
<!--[if IE]>
<script src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
<![endif]-->
<script src="http://localhost/publicidadoficial/graficacircular/grafica.js"></script>
<script type="text/javascript" src="http://localhost/publicidadoficial/carrusel/js/carrusel.js"></script>


<style type="text/css">

.tabladetallecampa td{
	width:50%;		
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

.raya_radio{
	border-bottom: 2px solid #6DA8C6;
	margin-top:10px;
	margin-bottom:10px;
	width: 60%;				
}

.raya_tv{
	border-bottom: 2px solid #42677A;
	margin-top:10px;
	margin-bottom:10px;
	width: 60%;				
}

.raya_prensa{
	border-bottom: 2px solid #49507A;
	margin-top:10px;
	margin-bottom:10px;
	width: 60%;				
}

.raya_internet{
	border-bottom: 2px solid #231F20;
	margin-top:10px;
	margin-bottom:10px;
	width: 60%;				
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
	border:none
}

.numero_chico{	
	color:#00B5E2;
	font-size:30px;
}

.tablamedios{
	font-weight: bold;
	color:#7B7D7C;
}

.tablamedios .con_raya{	
	border-right: 2px solid #BEBEBE;
}


/*para grafica circular*/
.wideBox {
  clear: both;
  text-align: center;
  margin-bottom: 50px;
  padding: 10px;
  background: #ebedf2;
  border: 1px solid #333;
  line-height: 80%;
}

#container {
  width: 900px;
  margin: 0 auto;
}

#chart, #chartData {
  border: 1px solid #333;
  background: #ebedf2 url("http://localhost/publicidadoficial/graficacircular/images/gradient.png") repeat-x 0 0;
}

#chart {
  display: block;
  margin: 0 0 50px 0;
  float: left;
  cursor: pointer;
}

#chartData {
  width: 200px;
  margin: 0 40px 0 0;
  float: right;
  border-collapse: collapse;
  box-shadow: 0 0 1em rgba(0, 0, 0, 0.5);
  -moz-box-shadow: 0 0 1em rgba(0, 0, 0, 0.5);
  -webkit-box-shadow: 0 0 1em rgba(0, 0, 0, 0.5);
  background-position: 0 -100px;
}

#chartData th, #chartData td {
  padding: 0.5em;
  border: 1px dotted #666;
  text-align: left;
}

#chartData th {
  border-bottom: 2px solid #333;
  text-transform: uppercase;
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


</style>

</head>



<body>

<div id="container">  

  <canvas id="chart" width="500" height="400"></canvas>

<br><br>

<table>
<tr><td>
  <table style="visibility:inherit;">

    <tr>
      <th>opcion 1</th><th>Sales ($)</th>
     </tr>

    <tr style="color: red">
     <td>opcion 2 <table> <tr>
      <th>opcion 1</th><th>Sales ($)</th>
     </tr> </table> </td><td>1862.12</td>
    </tr>

    <tr style="color: #194E9C">
      <td>opcion 3 <table> <tr>
      <th>opcion 1</th><th>Sales ($)</th>
     </tr> </table> </td><td>1316.00</td>
    </tr>

    <tr style="color: #ED9C13">
      <td>opcion 4 <table> <tr>
      <th>opcion 1</th><th>Sales ($)</th>
     </tr> </table> </td><td>712.49</td>
    </tr>
    
  </table>
</td></tr>

<tr><td>
  <table id="chartData">

    <tr>
      <th>opcion 1</th><th>Sales ($)</th>
     </tr>

    <tr style="color: red">
     <td>opcion 2 <table> <tr>
      <th>opcion 1</th><th>Sales ($)</th>
     </tr> </table> </td><td>1862.12</td>
    </tr>

    <tr style="color: #194E9C">
      <td>opcion 3 <table> <tr>
      <th>opcion 1</th><th>Sales ($)</th>
     </tr> </table> </td><td>1316.00</td>
    </tr>

    <tr style="color: #ED9C13">
      <td>opcion 4 <table> <tr>
      <th>opcion 1</th><th>Sales ($)</th>
     </tr> </table> </td><td>712.49</td>
    </tr>
    
  </table>
</td></tr>
</table>              
      
</div>




<div class="page">

<br>
<input type="button" value="" class="volver" onclick="history.back()" />
<!--a style="float:left;" onclick="history.back()" href="javascript:void(0);" class="volver">a</a!--> <br><br><br><br>

<table width="100%" class="tabladetallecampa"> 

<tr>

<td> 

<?php foreach($detalles->result() as $fila) { ?>		      

Nombre de la campaña: <label class="letra"> <?php echo $fila->nombre ?> </label><br>
Cobertura: <label class="letra"> <?php echo $fila->tipo ?> </label><br>
Año: <label class="letra"> <?php echo $fila->anio ?> </label><br>
Dependencia solicitante: <label class="letra"> <?php echo $fila->dependencia; ?> </label><br>

<div class="raya"> </div>

Duración de la campaña:<br>
Inicio <label class="letra"> <?php echo $fila->periodicidad_inicio;  ?> </label> Fin <label class="letra"> <?php echo $fila->periodicidad_fin; ?> </label><br>

<div class="raya"> </div>

Monto gastado:<br>
<label class="numero_chico"> $<?php echo number_format($fila->monto_total); ?> </label><br>

</td> 
<td valign="top"> 
<label class="letra"> Tema:</label> <?php echo $fila->tema; ?>  <br>

<label class="letra"> Objetivo:</label> <?php echo $fila->objetivo; ?> <br>

<?php } ?>

</td> 

</tr>

</table>

<br>
<div class="raya_completa"> </div>
<br>

<table width="100%">
<tr>

<td width="50%">

</td>

<td width="50%">

<table align="left">

<tr><th>Tipo</th><th>Sales ($)</th></tr>

<tr style="color: red">
<td>
Radio
</td>
<td>1862.12</td>
</tr>

<tr style="color: blue">
<td>
Tv
</td>
<td>1862.12</td>
</tr>

<tr style="color: black">
<td style="height:50px;">
Prensa
</td>
<td>1862.12</td>
</tr>

<tr style="color: yellow">
<td>Internet
</td>
<td>1862.12</td>
</tr>

</table>

<table>
<tr>
<td>

<div class="raya_radio"> </div>
<table width="100%" class="tablamedios">
<?php foreach($clasificacion_gastos->result() as $fila) { 
if($fila->clasificacion==1)
echo "<tr><td width='30%' class='con_raya'>".$fila->nombre_comercial."</td><td width='70%'>$".number_format($fila->monto_medio)."</td></tr>";
} ?>
</table>
</td>
</tr>

<tr>
<td>
<div class="raya_tv"> </div>
<table width="100%" class="tablamedios">
<?php foreach($clasificacion_gastos->result() as $fila) { 
if($fila->clasificacion==2)
echo "<tr><td width='30%' class='con_raya'>".$fila->nombre_comercial."</td><td width='70%'>$".number_format($fila->monto_medio)."</td></tr>";
} ?>
</table>
</td>
</tr>

<tr>
<td>
<div class="raya_prensa"> </div>
<table width="100%" class="tablamedios">
<?php foreach($clasificacion_gastos->result() as $fila) { 
if($fila->clasificacion==5)
echo "<tr><td width='30%' class='con_raya'>".$fila->nombre_comercial."</td><td width='70%'>$".number_format($fila->monto_medio)."</td></tr>";
} ?>
</table>
</td>
</tr>

<tr>
<td>
<div class="raya_internet"> </div>
<table width="100%">
<?php foreach($clasificacion_gastos->result() as $fila) { 
if($fila->clasificacion==3)
echo "<tr><td width='30%' class='con_raya'>".$fila->nombre_comercial."</td><td width='70%'>$".number_format($fila->monto_medio)."</td></tr>";
} ?>
</table>
</td>
</tr>

</table>


</td>
</tr>
</table>

<div class="raya_completa"> </div>
		
        <label class="letra">Fotos</label>
        
		<div id="divCarousel">
			<div id="divIzquierda"></div>
			<div id="divCentro">
				<ul>					                    
                    <?php foreach($fotos->result() as $fila) { ?>		                         
                    <li><img width="128" height="128" src="<?php echo base_url(); ?>admin-po/archivos/banners/<?php echo $fila->banner; ?>"></li>
                    <?php } ?>
				</ul>
			</div>
			<div id="divDerecha"></div>
			<div class="clsSalto"></div>
		</div>
        
        <label class="letra">Videos</label>
        
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
        
        <label class="letra">Audios</label>
        
        <div id="divCarousel3">
			<div id="divIzquierda3"></div>
			<div id="divCentro3">
				<ul>					                    
                    <?php foreach($audios->result() as $fila) { ?>		                         
                    <li><iframe width="128" height="128" scrolling="no" frameborder="no" src="<?php echo $fila->audio; ?>"></iframe></li>
                    <?php } ?>
				</ul>
			</div>
			<div id="divDerecha3"></div>
			<div class="clsSalto3"></div>
		</div>
        
        <!--script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script!-->                
        
		<script type="text/javascript" src="http://localhost/publicidadoficial/carrusel/js/carrusel.js"></script>

</div>


</body>
</html>