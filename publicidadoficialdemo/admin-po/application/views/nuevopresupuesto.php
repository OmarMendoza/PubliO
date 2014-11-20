<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />

<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />

<script type="text/javascript" src="<?php echo base_url(); ?>ajax/ajaxs.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/calendario_dw/jquery-1.4.4.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>ajax/paraimagen.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery.form.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/prettyForms.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery-ui-1.8.6.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery.ui.datepicker-es.js"></script>

<script type="text/javascript">
     
   function validar_formulario(){
	   
	  var total_presupuesto = parseInt(document.getElementById("monto_total").value);		  
	  var total_capturado = parseInt(document.getElementById("total_presupuesto").value);		  	   	  	  	  
		    	      
   	  if(document.getElementById("monto_total").value!=''){
		   
		   if(total_presupuesto==total_capturado){		   		   	  		   		  	   	  																																																								              $("#form1").submit(); 				
		   }
		   else{
			   alert('Los montos totales no coinciden');
		   }
	   }
	   else{
		   document.getElementById("monto_total").style.backgroundColor="#66ff33"
		   alert("ingrese el monto total")
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
<body>

<br><br>

<div class="grocery">

<?php if(isset($mensaje)) { echo '<center><h2>'.$mensaje.'<h2></center>'; } ?> 

<h2>Datos generales</h2>

<table width="100%" border="0">
<form id="form1" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>index.php/presupuesto/guardar'>
<tr>
<td width="30%">Año: </td><td width="70%">

<select id="e1" name="anio" style="width:155px;">
<?php for ($i = date("Y")+2; $i >= date("Y")-10; $i--) { ?>				
        <option value="<?php echo $i?>" <?php if($i==date("Y")) echo "selected"; ?> ><?php echo $i?></option>        
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>Presupuesto asignado a comunicación social: </td><td><input type="text" name="monto_total" id="monto_total" onKeyPress="return validar(event)" /> </td>
</tr>
 
<tr>
<td>
<h2>Desglose de conceptos</h2>
</td>
</tr>

<tr>
<td>
Clave del concepto
</td>
<td>
<input type="text" name="id_concepto" id="id_concepto" />
</td>
</tr>

<tr>
<td>
Nombre del concepto
</td>
<td>
<input type="text" name="concepto" id="concepto"  />
</td>
</tr>

<tr>
<td>
Cantidad asignado
</td>
<td>
<input type="text" name="cantidad" id="cantidad" onKeyPress="return validar(event)" />
</td>
</tr>

<tr>
<td> </td>
<td>
<input type="button" value="Agregar concepto" onClick="agregar_desglose_presupuesto()" class="boton" style="margin-bottom:10px; margin-top:10px;" />
</td>
</tr>

</form>

</table>

<div class="agregar_concepto" id="agregar_concepto" style="margin-left:304px; margin-bottom:10px; ">
</div>

<input type="button" value="Guardar presupuesto" onClick="validar_formulario()"  class="boton" style="margin-right:20px;" /> 
<input type="button" value="Cancelar" onclick="history.back()" class="boton"/>

<br>
<br>

</div>
    
        
</body>
</html>