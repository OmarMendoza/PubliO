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
   	  	      $("#form1").submit();  														
	   															
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

<title>Nueva Audio</title>

</head>
<body>

<div class="grocery">

<h2> Ingrese los nuevos conceptos del presupuesto </h2><br>

<form id="form1" method="post" enctype="multipart/form-data" action='<?php echo base_url(); ?>index.php/desglose_presupuesto/guardar'>

<input type="hidden" name="id_presupuesto" id="id_presupuesto" value="<?php echo $id ?>" />

<input type="hidden" name="monto_total" id="monto_total" value="<?php echo $presupuesto ?>" />

</form>

<table width="100%">


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
<input type="button" value="Agregar concepto" onClick="agregar_nuevo_desglose_presupuesto()" class="boton" style="margin-bottom:10px; margin-top:10px;" />
</td>
</tr>

</table>

<div class="agregar_concepto" id="agregar_concepto" style="margin-left:215px; margin-bottom:10px; ">
</div>


<input type="button" value="Guardar presupuesto" onClick="validar_formulario()" style="margin-right:20px; margin-top:20px;" class="boton"/>
<input type="button" onclick=" location.href='<?php echo base_url();?>/index.php/desglose_presupuesto/principal/<?php echo $id;?>' " value="Cancelar" class="boton" /> 


</div>

<br><br><br>
            
</body>
</html>