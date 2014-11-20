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
	   if(document.getElementById('campas').value!='seleccione'){	   	   	  																							   	  	      $("#form1").submit();  														
	   }
	   else{
		   alert('seleccione campaña');
	   }
   }      
   
</script>

<title>Nueva Campaña</title>

</head>
<body>

<div class="grocery">

<h2> Ingrese el nuevo video para la campaña "<?php foreach($campas->result() as $fila) { echo $fila->nombre; }?>" </h2><br>

<form id="form1" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>index.php/videos/guardar'>

<table width="100%"><tr><td valign="top" width="20%">Campaña: </td><td> 
<select id="campas" name="campas" style="width:155px; margin-bottom:15px;">
<?php foreach($campas->result() as $fila) { ?>		
        <option value="<?php echo $fila->nombre?>"><?php echo $fila->nombre?></option>        
<?php } ?>
</select>
</td></tr>

</form>

<form id="videoform" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>ajax/ajaxnuevovideo.php'>
<tr><td valign="top" width="20%">Ingrese código del video: </td><td>
<textarea style="width:500px; height:100px;" name="video" id="video" ></textarea></td></tr><tr><td valign="top"></td><td>

<!--<input type="text" name="descripcion_video" id="descripcion_video"/>!-->

<input type="hidden" name="video_a" id="video_a"/>

<input id="agregar_video" name="agregar_video" type="button" value="Agregar video" onClick="" class="boton" />

<div id="previewvideo" name="previewvideo">

<!--
<object width="130" height="128">
<param name="movie" value="http://www.youtube.com/v/aAt0l5nxoxo"></param>
<param name="wmode" value="transparent"></param>
<embed src="http://www.youtube.com/v/aAt0l5nxoxo" type="application/x-shockwave-flash" wmode="transparent" width="130" height="128">
</embed>
</object>!-->

</div>

</td></tr></table>
<!--<div class="upload">!-->
<!--</div>!-->
</form>

<input type="submit" value="Guardar video" onClick="validar_formulario()" style="margin-right:20px;" class="boton"/>

<input type="button" onclick=" location.href='<?php echo base_url();?>/index.php/videos/principal/<?php echo $id;?>' " value="Cancelar" class="boton" /> 


</div>
            
</body>
</html>