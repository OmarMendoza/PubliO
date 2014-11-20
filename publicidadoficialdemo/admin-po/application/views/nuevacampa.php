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

<!--for select
<script src="http://ajax.googleapis.com/ajax/libs/mootools/1.3/mootools-yui-compressed.js"></script>
<script src="http://localhost/gasto/plugins/chosen-master/Demos/mootools-more-1.4.0.1.js"></script>
<script src="http://localhost/gasto/plugins/chosen-master/Source/chosen.js"></script>
<script src="http://localhost/gasto/plugins/chosen-master/Source/Locale.en-US.Chosen.js"></script>
<script type="text/javascript"> 
$(".chzn-select").chosen(); 
$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
</script>
<link rel="stylesheet" href="http://localhost/gasto/plugins/chosen-master/Source/chosen.css" />

<!--for select 2
<script src="http://localhost/gasto/plugins/select/select2.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="http://localhost/gasto/plugins/select/select2.css" />!-->


   
<script type="text/javascript">

   $(document).ready(function(){	   
      $(".publicidad_inicio").calendarioDW();
	  $(".publicidad_fin").calendarioDW();	 
   })
   
   $(document).ready(function() { $(".e1").select2(); });
       
   function validar_formulario(){
	   if(document.getElementById("nombre").value!=''){
		   		   	  		   
		   	if(document.getElementById("tema").value!=''){	
			
			if(document.getElementById("tipo").value!='seleccione'){
				
				if(document.getElementById("categoria").value!='seleccione'){
				   	  
					if(document.getElementById("objetivo").value!=''){		   	  
						
							if(document.getElementById("publicidad_inicio").value!=''){		   	  
							
								if(document.getElementById("publicidad_fin").value!=''){																		
									
									if(document.getElementById("dependencia").value!='seleccione'){	
										   	  												   	  
											var costo_total = parseInt(document.getElementById("costototal").value);
									
											if(document.getElementById("costototal").value!='' && isNaN(costo_total)==false ){	
																										  
													$("#form1").submit();  														
											}
											else{
												document.getElementById("costototal").style.backgroundColor="#66ff33"
												alert("Ingrese el costo estimado de la campaña")
											}  														
									}
									else{
										document.getElementById("dependencia").style.backgroundColor="#66ff33"
										alert("Seleccione la dependencia solicitante de la campaña")
									} 		
								}
								else{
									document.getElementById("publicidad_fin").style.backgroundColor="#66ff33"
									alert("Ingrese de finalización de la campaña")
								}	
																							
							}
							else{
								document.getElementById("publicidad_inicio").style.backgroundColor="#66ff33"
								alert("Ingrese fecha de inicio de la campaña")
							}
										  		
					}
					else{
				   		document.getElementById("objetivo").style.backgroundColor="#66ff33"
				   		alert("Ingrese el objetivo de la campaña")
					}
					
					}
					else{
				   		document.getElementById("categoria").style.backgroundColor="#66ff33"
				   		alert("Seleccione la categoria de la campaña")
					}
					
					}
					
				else{
				   		document.getElementById("tipo").style.backgroundColor="#66ff33"
				   		alert("Ingrese el tipo de campaña")
					}  		
	   		}
	   		else{
			   document.getElementById("tema").style.backgroundColor="#66ff33"
		   	   alert("Ingrese el tema de la campaña")
	   		}  		
	   }
	   else{
		   document.getElementById("nombre").style.backgroundColor="#66ff33"
		   alert("Ingrese el nombre de la campaña")
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
   
   $("#nombre").click(function() { 
   		document.getElementById("nombre").style.backgroundColor="#FFFFFF"           
   });
   
   function mostrar_etiquetas(){
	   if(document.getElementById('todas_etiquetas').style.visibility=='visible'){
		   document.getElementById('todas_etiquetas').style.visibility='hidden'
	   }
	   else{
		   document.getElementById('todas_etiquetas').style.visibility='visible'
	   }
   }
   
</script>


<title>Nueva Campaña</title>

</head>
<body>

<div class="page">

<br><br>

</div>

<div class="grocery">             
 
<form id="form1" method="post" enctype="multipart/form-data" action='<?php base_url(); ?>guardar'>

<h2>Datos generales</h2>
<table width="100%">
<tr>
<td width="20%">Nombre: </td><td width="80%">
<input type="text" name="nombre" id="nombre" value="<?php echo set_value('nombre'); ?>" class="introducir" />
<?php echo form_error('nombre'); ?></td>
</tr>
<tr class="columnairregular">
<td>Año: </td><td>

<select id="e1" name="anio" style="width:155px;">
<?php for ($i = date("Y") ; $i >= date("Y")-10; $i--) { ?>		
        <option value="<?php echo $i?>"><?php echo $i?></option>        
<?php } ?>
</select>

</td>
</tr>
<tr>
<td>Tema: </td><td><input type="text" name="tema" id="tema" value="<?php echo set_value('tema'); ?>" /> </td>
</tr>
<tr class="columnairregular">
<td>Tipo: </td><td> 

<select class="e1" id="tipo" name="tipo" style="width:155px;">
<option value="seleccione">Seleccione tipo</option>
<?php foreach($tipos->result() as $fila) { ?>		
        <option value="<?php echo $fila->tipo?>"><?php echo $fila->tipo?></option>        
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>Categoría de la campaña: </td><td> 

<select class="e1" id="categoria" name="categoria" style="width:155px;">
<option value="seleccione">Seleccione categoría</option>
<?php foreach($clasificaciones->result() as $fila) { ?>		
        <option value="<?php echo $fila->descripcion_clasificacion?>"><?php echo $fila->descripcion_clasificacion?></option>        
<?php } ?>
</select>
</td>
</tr>

<tr>
<td>Etiquetas: </td><td>
<input type="text" name="etiqueta" id="etiqueta" value="" />
<input type="button" value="Añadir" onclick="agregar_etiqueta_('')" class="boton"/>
</td>
</tr>
<tr>
<td></td><td>
<div class="agregar_etiqueta" id="agregar_etiqueta" style="margin-left:0px; margin-bottom:10px; ">
</div>
</td>
</tr>
<tr>
<td></td><td>
<div onClick="mostrar_etiquetas()" style="cursor:pointer; text-decoration:underline; ">Mostrar etiquetas existentes</div>
<div class="todas_etiquetas" id="todas_etiquetas" style="margin-left:0px; margin-bottom:10px; visibility:hidden; margin-top:5px;">
<?php 
$total=$etiquetas->num_rows()-1;
$i=0;
foreach($etiquetas->result() as $fila2) { ?>
<a href="#" onClick="agregar_etiqueta_('<?php echo $fila2->etiqueta?>');"><?php echo $fila2->etiqueta?></a>
<?php if($total!=$i) echo ", " ?>
<?php $i++;
} ?>
</div>
</td>
</tr>

<tr>
<td>Objetivo: </td><td> <input type="text" name="objetivo" id="objetivo" value="<?php echo set_value('objetivo'); ?>" /> </td>
</tr>
<tr class="columnairregular">
<td>Inicio de la campaña: </td><td> <input type="text" name="publicidad_inicio" id="publicidad_inicio" class="publicidad_inicio" value="<?php echo set_value('publicidad_inicio'); ?>"/> <br> </td>
</tr>
<tr>
<td>Fin de la campaña: </td><td> <input type="text" name="publicidad_fin" id="publicidad_fin" class="publicidad_inicio" value="<?php echo set_value('publicidad_fin'); ?>" /> <br> </td>
</tr>
<tr class="columnairregular">
<td>Dependencia: </td><td>
<select data-placeholder="seleccione dependencia" class="chzn-select" id="dependencia" name="dependencia" tabindex="1" style="width:155px;">
<option value="seleccione">Seleccione dependencia</option>
<?php foreach($dependencias->result() as $fila) { ?>		
        <option value="<?php echo $fila->dependencia?>"><?php echo $fila->dependencia?></option>        
<?php } ?>
</select>

</td>   
</tr>
<tr>
<td>Costo estimado (variable no pública): </td><td> <input type="text" name="costototal" id="costototal" value="<?php echo set_value('costototal'); ?>" onKeyPress="return validar(event)"/> <br> </td>
</tr>
<tr class="columnairregular">
<td>Estatus: </td><td>
<select id="status" name="status" style="width:155px;">
<option value="seleccione">Seleccione estatus</option>
<?php foreach($status->result() as $fila) { ?>		
        <option value="<?php echo $fila->status?>"><?php echo $fila->status?></option>        
<?php } ?>
</select>
</td>
</tr>

</table>
</form>
 <br>
 
<h2>Banners</h2>

<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>ajax/ajaximage.php'>
<table width="100%"><tr><td valign="top" width="20%">Banners:  
</td><td>
<input type="file" name="photoimg" id="photoimg" onClick="" />
<div id="preview" name="preview">

<!--<script type="text/javascript"> 
$("#preview").width(260);
</script>!-->

</div></td></tr></table>
<!--<div class="upload">!-->

<!--</div>!-->
</form>

<h2>Audios</h2>

<form id="audioform" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>ajax/ajaxaudio.php'>
<table width="100%"><tr><td valign="top" width="20%">Audios: 
</td><td>

<!--<input type="text" name="descripcion_audio" id="descripcion_audio"/>!-->

<!--input type="hidden" name="audio_a" id="audio_a"/!-->
<input type="file" id="agregar_audio" name="agregar_audio" onClick="" />

<div id="previewaudio" name="previewaudio">

<!--<iframe width="130" height="128" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F59051244&secret_token=s-kXDPR"></iframe>!-->

</div></td></tr></table>

</form>

<br>

<h2>Videos</h2>

<form id="videoform" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>ajax/ajaxvideo.php'>
<table width="100%"><tr><td valign="top" width="20%">Ingrese código del video:</td><td>
<textarea style="width:500px; height:100px;" name="video" id="video" ></textarea></td></tr><tr>

<td valign="top"></td><td>

<!--<input type="text" name="descripcion_video" id="descripcion_video"/>!-->

<input type="hidden" name="video_a" id="video_a"/>

<input id="agregar_video" name="agregar_video" type="button" value="Agregar video" onClick="" class="boton" />

<div id="previewvideo" name="previewvideo">

</div></td></tr></table><br>

<br>
<input type="button" value="Guardar campaña" onClick="validar_formulario()" class="boton" style="margin-right:20px;"/>
<input type="button" value="Cancelar" onclick="history.back()" class="boton"/>
<!--<div class="upload">!-->
<!--</div>!-->
</form>

<br>

<!--
Utilitarios: 
 
<form id="utiliariosform" method="post" enctype="multipart/form-data">
<div id="previewutiliarios" name="previewutiliarios">
</div>
<!--<div class="upload">!-->
<!--<input type="file" name="utiliarios" id="utiliarios" onClick=""/>
<!--</div>!-->
<!--</form>

<br>
<br>

Otro soporte: 
 
<form id="otrosform" method="post" enctype="multipart/form-data">
<div id="previewotros" name="previewotros">
</div>
<!--<div class="upload">!-->
<!--<input type="file" name="otros" id="otros" onClick=""/>
<!--</div>!-->
<!--</form>


<!--Banners:
 
<form id="imageform" method="post" enctype="multipart/form-data" action='ajax/ajaximage.php'>
<div id="preview" name="preview">
</div>
<div class="upload">
<input type="file" name="photoimg" id="photoimg" onClick=""/>
</div>
</form>!-->

</div>
            
</body>
</html>