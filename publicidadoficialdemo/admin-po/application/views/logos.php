<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Transparencia en Publicidad Oficial</title>
<script src="/jquery_plugins/jquery.easing-1.3.pack.js"></script>
<script src="/jquery_plugins/jquery.ui.widget.js"></script>
<script src="/jquery_plugins/jquery.iframe-transport.js"></script> 
<script src="/jquery_plugins/jquery.fileupload.js"></script>


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

<img src="<?php echo base_url(); ?>imagenes/triangulo_color.png" style="float:left; margin-top:-2px; margin-bottom:2px; margin-left:100px"/>

<DIV STYLE="position:absolute; left:0px; top:20px; visibility:visible z-index:2;"> 

<img usemap="#Map1" src="<?php echo base_url(); ?>imagenes/logo_PO.png" style="float:right;"/>

<map name="Map1">
      <area shape="rect" coords="0,0,500,100" href="<?php echo base_url(); ?>">    
</map>

</DIV>

<br>

<a <?php if($url_logo_opcional!=""){ ?> target="_blank" href="<?php echo $url_logo_opcional; ?>" <?php } ?> >

<?php if($logo_opcional!="") { ?>
<img height="66" style="float:right;" src="<?php echo base_url(); ?>archivos/logos/<?php echo $logo_opcional ?>"/>
<?php } ?>

</a>

<a <?php if($url_logo!=""){ ?> target="_blank" href="<?php echo $url_logo; ?>" <?php } ?> >
<?php if($logo!="") { ?>
<img height="66" style="float:right" src="<?php echo base_url(); ?>archivos/logos/<?php echo $logo ?>"/>
<?php } ?>
</a>

</div>

</div>

            
</body>
</html>