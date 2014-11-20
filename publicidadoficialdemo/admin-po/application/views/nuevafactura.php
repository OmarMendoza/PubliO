<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />

<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />

<link href="<?php echo base_url(); ?>calendario-jquery/calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET">

<script type="text/javascript" src="<?php echo base_url(); ?>ajax/ajaxs.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/calendario_dw/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/calendario_dw/calendario_dw.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>ajax/paraimagen.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery.form.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/prettyForms.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery-ui-1.8.6.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery.ui.datepicker-es.js"></script>


<script type="text/javascript">
     
   function validar_formulario(){	   	    
	   
	   var numero = parseInt(document.getElementById("num_factura").value);
	   
	   if(document.getElementById("num_factura").value!=''){
		   		   	  		   
		   	if(document.getElementById("concepto_general").value!=''){	
			
				var monto = parseInt(document.getElementById("monto_total").value);	
				
				var total_factura=parseInt(document.getElementById('total_factura').value);								
				   	  
					if(document.getElementById("monto_total").value!='' && isNaN(monto)==false && monto==total_factura ){	
					
					  if(document.getElementById("fecha").value!=''){		   	  																																	   	  												   	  
							if(document.getElementById("medios").value!='seleccione'){		   	  																																		   	  												   	  
									if(document.getElementById("dependencia_c").value!='seleccione'){	
									
									document.getElementById('aux_contrato').value=document.getElementById('contratos').value;
											
											if(document.getElementById('aux_contrato').value!='seleccione'){	
									
												document.getElementById('aux_contrato').value=document.getElementById('contratos').value;		   	  																																		   	  												   	  
												$("#form1").submit(); 
																										
											}																										  							
											else{
												//document.getElementById("dependencia_c").style.backgroundColor="#66ff33"
												alert("seleccione el contrato")
											}		   	  																													   	  												 									 														
										}																										  							
									else{
										document.getElementById("dependencia_c").style.backgroundColor="#66ff33"
										alert("Seleccione la dependencia contratante")
									}   														
								}																										  							
							else{
								document.getElementById("medios").style.backgroundColor="#66ff33"
								alert("Seleccione el medio")
							}
					    }																										  							
						else{
							document.getElementById("fecha").style.backgroundColor="#66ff33"
							alert("Ingrese la fecha de la factura")
						 } 
					   }																										  							
					else{
				   		document.getElementById("monto_total").style.backgroundColor="#66ff33"
				   		alert("Ingrese el monto total de la factura")
					}  		
	   		}
	   		else{
			   document.getElementById("concepto_general").style.backgroundColor="#66ff33"
		   	   alert("Ingrese el concepto general de la factura")
	   		}  		
	   }
	   else{
		   document.getElementById("num_factura").style.backgroundColor="#66ff33"
		   alert("Ingrese el numero de la factura")
	   }
   } 
   
   function validar(e) {            
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; //Tecla de retroceso (para poder borrar)
    //if (tecla==44) return true; //Coma ( En este caso para diferenciar los decimales )
    if (tecla==48) return true;
    if (tecla==49) return true;
    if (tecla==50) return true;
    if (tecla==51) return true;
    if (tecla==52) return true;
    if (tecla==53) return true;
    if (tecla==54) return true;
    if (tecla==55) return true;
    if (tecla==56) return true;
	if (tecla==57) return true;
    patron = /1/; //ver nota
    te = String.fromCharCode(tecla);
    return patron.test(te); 
}      
   
</script>

<title>Nueva Campaña</title>

</head>
<body onload='$(".fecha").calendarioDW();'>

<div class="grocery">

<h2>Datos generales</h2>

<table width="100%" border="0">
<form id="form1" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>index.php/facturas/guardar'>
<tr>
<td width="4%">Número de factura: </td><td width="30%"><input type="text" name="num_factura" id="num_factura" /></td>
</tr>
<tr>
<td>Concepto general: </td><td><input type="text" name="concepto_general" id="concepto_general"/> </td>
</tr>
<tr>
<td>Monto total: </td><td><input type="text" name="monto_total" id="monto_total" onKeyPress="return validar(event)" /> </td>
</tr>
<tr>
<td>Fecha: </td><td><input type="text" name="fecha" id="fecha" class="fecha" /> </td>
</tr>
<tr>
<td>Medios: </td><td>
<div id="cualquiera" class="cualquiera">
<select id="medios" name="medios" style="width:155px;" onChange="borrar_contrato_dependencia()">
<option value="seleccione">Seleccione medio</option>
<?php foreach($medios->result() as $fila) { ?>		
        <option value="<?php echo $fila->nombre_comercial?>"><?php echo $fila->nombre_comercial?></option>        
<?php } ?>
</select>
</div>
</td>  
</tr>
<tr>
<td>Dependencia contratante: </td><td> 
<select id="dependencia_c" name="dependencia_c" onChange="consultar_contratos()" style="width:155px;">
<option value="seleccione">Seleccione dependencia</option>
<?php foreach($dependencias->result() as $fila) { ?>		
        <option value="<?php echo $fila->dependencia?>"><?php echo $fila->dependencia?></option>        
<?php } ?>
</select>

<input type="hidden" name="aux_contrato" id="aux_contrato"/>
</td>
</tr>

<tr>
<td>Contrato: </td><td>
<div id="texto_contrato" class="texto_contrato" style="margin-top:9px;">
Seleccione la dependencia contratante
</div>
<div id="mostrar_contrato" name="mostrar_contratos" class="mostrar_contrato">
</div>
</td>
</tr>

<tr>

<td>

<h2>Desglose de la factura</h2>
</td>
</tr>

<tr>
<td width="10%">
Subconcepto de la factura
</td>
<td>
<input type="text" name="concepto" id="concepto" size="20" />
</td>
</tr>

<tr>
<td width="10%">
Unidades del subconcepto
</td>
<td>
<input type="text" name="unidades" id="unidades" onKeyPress="return validar(event)" />
</td>
</tr>

<tr>
<td width="10%">
Monto del subconcepto
</td>
<td>
<input type="text" name="monto_concepto" id="monto_concepto" onKeyPress="return validar(event)"/>
</td>
</tr>

<tr>
<td>
Dependencia solicitante
</td>
<td>
<select id="dependencia_s" name="dependencia_s" onChange="consultar_campa()" style="width:155px; margin-bottom:10px;">
<option value="seleccione">Seleccione dependencia</option>
<?php foreach($dependencias_solicitantes->result() as $fila) { ?>		
        <option value="<?php echo $fila->dependencia?>"><?php echo $fila->dependencia?></option>        
<?php } ?>
</select>
</td>
</tr>

<tr>
<td>
Campaña
</td>
<td>
<div id="texto_campa" class="texto_campa">
Seleccione la dependencia solicitante
</div>
<div id="mostrar_campa" class="mostrar_campa">
</div>

<input type="hidden" name="campa_aux" id="campa_aux"/>
</td>
</tr>

<tr>
<td> </td>
<td>
<input type="button" value="Agregar a factura" onClick="agregar_detalle_factura()" class="boton" style="margin-bottom:10px; margin-top:10px;" />
</td>
</tr>

</form>

</table>



<div class="agregar_factura" id="agregar_factura" style="margin-left:200px; margin-bottom:10px; ">
</div>


<h2>Digitalización</h2>

<table>

<tr><td valign="top" width="6%">Imágenes de la factura: </td><td width="22%">
 
<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>ajax/ajaximagefacturas.php'>
<input type="file" name="photoimg" id="photoimg" onClick=""/>
<div id="preview" name="preview">
</div>
<!--<div class="upload">!-->
<!--</div>!-->
</form>

</td>
</tr>
</table>

<!--h2>Imagenes de testigo</h2>

<table>
<tr>
<td valign="top" width="7%">
Imágenes de testigo de la factura: </td><td width="24%">
 
<form id="imageform2" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>ajax/ajaximagetestigofacturas.php'>
<input type="file" name="photoimg2" id="photoimg2" onClick=""/>
<div id="preview2" name="preview2">
</div>
</form>

</td>
</tr>

</table!-->


<input type="button" value="Guardar factura" onClick="validar_formulario()"  class="boton" style="margin-right:20px;" /> 
<input type="button" value="Cancelar" onclick="history.back()" class="boton"/>

<br>
<br>

</div>
    
        
</body>
</html>