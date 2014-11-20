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
   		if(document.getElementById('factura').value!='seleccione'){	   	   	  																							   	  	      $("#form1").submit();  														
	   	}
	   	else{
		   alert('seleccione campaña');
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

<title>Nueva Audio</title>

</head>
<body>

<div class="grocery">

<h2> Ingrese los subconceptos de la factura "<?php foreach($facturas->result() as $fila) { echo $fila->num_factura; }?>" </h2><br>

<form id="form1" method="post" enctype="multipart/form-data" action='<?php echo base_url(); ?>index.php/detalle_factura/guardar'>

<table width="100%"><tr><td valign="top" width="20%">Factura: </td><td> 
<select id="factura" name="factura" style="width:205px;">
<?php foreach($facturas->result() as $fila) { ?>		
        <option value="<?php echo $fila->num_factura?>"><?php echo $fila->num_factura?></option>        
<?php } ?>
</select>

</td></tr>

</form>

<tr>
<td width="10%">
Subconcepto de la factura
</td>
<td>
<input type="text" name="concepto" id="concepto" />
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
<select id="dependencia_s" name="dependencia_s" onChange="consultar_nueva_campa()" style="width:155px; margin-bottom:10px;">
<option value="seleccione">Seleccione Dependencia</option>
<?php foreach($dependencias->result() as $fila) { ?>		
        <option value="<?php echo $fila->dependencia?>"><?php echo $fila->dependencia?></option>        
<?php } ?>
</select>
</td>
</tr>

<td>
Campaña
</td>
<td>
<div id="texto_campa" class="texto_campa">
Seleccione la dependencia solicitante
</div>
<div id="mostrar_campa" class="mostrar_campa">
</div>
</td>
</tr>

<tr>
<td> </td>
<td>
<input type="button" value="Agregar a factura" onClick="agregar_nuevo_detalle_factura()" class="boton" style="margin-buttom:20px;" />
</td>
</tr>
</table>

<div class="agregar_factura" id="agregar_factura" style="margin-left:205px;">
</div>


<input type="button" value="Guardar detalle(s)" onClick="validar_formulario()" style="margin-right:20px; margin-top:20px;" class="boton"/>
<input type="button" onclick=" location.href='<?php echo base_url();?>/index.php/detalle_factura/principal/<?php echo $id;?>' " value="Cancelar" class="boton" /> 


</div>

<br><br><br>
            
</body>
</html>