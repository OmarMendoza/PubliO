<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" media="all" t
ype="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Medios</title> 
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/calendario_dw/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery.form.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/calendario_dw/jquery-1.8.2.min.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>ajax/ajaxs.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery.simplemodal.js"></script>     
  
<script type="text/javascript">
     
   function validar_formulario(){	   	   	  																							   	  												   		   
   	if(document.getElementById('nombre_usuario').value!=''&&document.getElementById('password').value!=''&&document.getElementById('nuevo_password').value!=''&&document.getElementById('repetir_password').value!=''){	
	   	   	  	
				if(document.getElementById('nuevo_password').value==document.getElementById('repetir_password').value){	
	   	   	  	
				$("#form1").submit();
																		
				}
				else{
				   alert('Repita en nuevo password correctamente');
				}
		  														
	   	}
	   	else{
		   alert('Ingrese todos los datos');
	   	}  														
   }      
   
</script>

</head>

<body>

<br><br>

<div class="grocery">

<form id="form1" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>index.php/usuarios/guardar'>

<input name="id_usuario" id="id_usuario" type="hidden" value="<?php echo $id_usuario ?>">

<table>
<tr>
<td>Nombre de usuario:</td><td><input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo $nombre_usuario ?>" /></td>
</tr>
<tr>
<td>Password:</td><td><input type="password" name="password" id="password" /> <?php if (isset($error)) { echo "Error contraseña actual incorrecta"; } ?></td>
</tr>
<tr>
<td>Nuevo password:</td><td><input type="password" name="nuevo_password" id="nuevo_password" /></td>
</tr>
<tr>
<td>Repetir nuevo password:</td><td><input type="password" name="repetir_password" id="repetir_password" /></td>
</tr>
</table>

<br><br>

<input type="button" value="Actualizar datos" onClick="validar_formulario()"  class="boton" style="margin-right:20px;" /> 
<input type="button" value="Cancelar" onclick="history.back()" class="boton"/>

</form>


</div>
         
<br>
            
</body>
</html>