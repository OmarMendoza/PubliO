
<html lang="en">
<head>

<link rel="image_src" href="http://www.oaxtransparente.oaxaca.gob.mx/publicidadoficial/imagenes/logo_PO.png" />

<meta charset="utf-8">
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Transparencia Publicidad</title>

<style>

.rellenar{
background:#231F20; 
height:120px; 
width:30%;
z-index:-999;
position:absolute; 
float:left; 
top:0;
}

</style>

</head>
<body>

<div class="logos">

<div class="rellenar"></div>

<div class="page" style="z-index:99; position:relative">

<img src="<?php echo base_url(); ?>imagenes/triangulo_color.png" style="float:left; margin-top:-2px; margin-bottom:2px; margin-left:100px;"/>

<DIV STYLE="position:absolute; left:0px; top:20px; visibility:visible z-index:2;"> 

<img usemap="#Map1" src="<?php echo base_url(); ?>imagenes/logo_PO.png" style="float:right;"/>

<map name="Map1">
      <area shape="rect" coords="0,0,500,100" href="<?php echo base_url(); ?>">    
</map>

</DIV>

<br>

<a <?php if($url_logo_opcional!=""){ ?> target="_blank" href="<?php echo $url_logo_opcional; ?>" <?php } ?> >

<?php if($logo_opcional!="") { ?>
<img height="66" style="float:right;" src="<?php echo base_url(); ?>admin-po/archivos/logos/<?php echo $logo_opcional ?>"/>
<?php } ?>

</a>

<a <?php if($url_logo!=""){ ?> target="_blank" href="<?php echo $url_logo; ?>" <?php } ?> >
<?php if($logo!="") { ?>
<img height="66" style="float:right" src="<?php echo base_url(); ?>admin-po/archivos/logos/<?php echo $logo ?>"/>
<?php } ?>
</a>

</div>

</div>





<div class="page">

<div class="menu" style="margin-top:35px;">

            <ul>                              	                                                            
             <li><a href="<?php echo base_url(); ?>index.php" <?php if($opcion=="inicio") { echo 'id="primero"'; } ?> >Inicio</a></li>
             
<li><a href="<?php echo base_url(); ?>index.php/contratosmedios" <?php if($opcion=="contratosmedios") { echo 'id="primero"'; }  ?> >Medios y contratos</a></li>
           <li><a href="<?php echo base_url(); ?>index.php/campas" <?php if($opcion=="campas") { echo 'id="primero"'; } ?> >Campañas</a></li>             			
             <li><a href="<?php echo base_url(); ?>index.php/dependencias" <?php if($opcion=="dependencias") { echo 'id="primero"'; } ?>>Por dependencia</a></li>
        	 <li style="float:right; margin-top:-3px; margin-right:15px;">
			 <?=form_open(base_url().'index.php/principal/buscar')?>
			 <input type="text" name="buscar" id="buscar" size="35" value="  Buscar" onFocus="if (this.value=='  Buscar') this.value='';" onBlur="if (this.value=='') this.value='  Buscar';" />
			 <?=form_close()?>
             </li>                                                    
            </ul>            
</div>

</div>
            
</body>
</html>