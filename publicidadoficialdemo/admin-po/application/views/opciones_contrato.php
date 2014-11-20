<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Transparencia Publicidad</title>
</head>
<body>

<div class="page">

<br>

<table width="100%" class="opciones"> 
<tr>
<td align="left">
 <h2> <?php if($opcion_contrato=="ver_todo") { echo 'Listado de contratos'; }  if($opcion_contrato=="nuevo_contrato") { echo 'Ingrese los datos del nuevo contrato'; } if($opcion_contrato=="buscar") { echo 'Resultado de la búsqueda'; } if($opcion_contrato=="contratos_medio") { echo 'Contratos del medio"'.$medio.'"'; } if($opcion_contrato=="contratos_dependencia") { echo 'Contratos de la dependencia "'.$dependencia.'"'; }?>  </h2> 
</td>
<td width="50%" align="right"> 
<?=form_open(base_url().'index.php/contratos/buscar')?>
<input type="text" name="buscar" id="buscar" size="40" value="Buscar" onfocus="if (this.value=='Buscar') this.value='';" onblur="if (this.value=='') this.value='Buscar';"/> 
<?=form_close()?>
</td>
</tr>
</table>

<br>

<!--<center> <h2> <?php if($opcion_contrato=="ver_todo") { echo 'Listado de contratos'; }  if($opcion_contrato=="nuevo_contrato") { echo 'Ingrese los datos del nuevo contrato'; } if($opcion_contrato=="buscar") { echo 'Resultado de la búsqueda'; } if($opcion_contrato=="contratos_medio") { echo 'Contratos del medio"'.$medio.'"'; } if($opcion_contrato=="contratos_dependencia") { echo 'Contratos de la dependencia "'.$dependencia.'"'; }?>  </h2> </center>!-->


<div class="menu2">
<ul>
<li style="width:30%" <?php if($opcion_contrato=="ver_todo") { echo 'id="primero"'; } ?>>
<a style="margin-right:10px" href="<?php echo base_url();?>index.php/contratos/principal"> Ver todos </a>
</li>
<li style="width:70%" <?php if($opcion_contrato=="nuevo_contrato") { echo 'id="primero"'; } ?> >
<a style="margin-right:10px" href="<?php echo base_url();?>index.php/contratos/administracion/add"> Agregar nuevo contrato </a> 
</li>
</ul>
</div>


<br>

</div>
            
</body>
</html>