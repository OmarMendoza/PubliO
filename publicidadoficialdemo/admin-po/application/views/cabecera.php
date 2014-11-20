<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Transparencia Publicidad</title>

<style>

.rellenar{
background:#231F20; 
height:120px; 
width:40%;
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

<a href="<?php echo base_url(); ?>index.php/logos/principal/edit/1" >
<img alt="Editar logotipo" style="float:right" src="<?php echo base_url(); ?>imagenes/editar.png"/>
</a>

<br><br>

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

<!--img usemap="#Map2" src="<?php echo base_url(); ?>imagenes/logos.png" style="float:right; margin-top:25px; margin-right:80px;"/>

<map name="Map2">
	  <!--area shape="rect" coords="140,0,50,200" href="http://www.oaxtransparente.gob.mx/">  
      <area shape="rect" coords="0,0,270,100" href="http://www.oaxaca.gob.mx/">          
</map!-->


</div>

</div>

<div class="page">
<div style="float:right;"> <label>Nombre de usuario: <label style="color:#00B5E2; font-weight:bold;"> <?php echo $nombre_usuario; ?> </label> </label>.<a href="<?php echo base_url(); ?>index.php/usuarios/principal" >
<img alt="Editar datos" src="<?php echo base_url(); ?>imagenes/editar.png"/>
</a>
</div>

<br>

<div class="menu" style="margin-top:35px;">


            <ul>    
    <li><a href="<?php echo base_url(); ?>index.php/presupuesto" <?php if($opcion=="presupuesto") { echo 'id="primero"'; } ?> >Presupuesto</a></li>                  <li><a href="<?php echo base_url(); ?>index.php/medios" <?php if($opcion=="medios") { echo 'id="primero"'; } ?> >Medios</a></li>
             <li><a href="<?php echo base_url(); ?>index.php/campa" <?php if($opcion=="campa") { echo 'id="primero"'; } ?> >Campañas</a></li>
             <li><a href="<?php echo base_url(); ?>index.php/contratos/principal" <?php if($opcion=="contratos") { echo 'id="primero"'; } ?> >Contratos</a></li>             <li><a href="<?php echo base_url(); ?>index.php/facturas/principal" <?php if($opcion=="facturas") { echo 'id="primero"'; } ?> >Facturas</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/dependencia" <?php if($opcion=="dependencias") { echo 'id="primero"'; } ?> >Dependencias</a></li>
            <li style="float:right"><a href="<?php echo base_url(); ?>index.php/login/salir" >Salir</a></li>                              
            </ul>            
</div><!--menu---> 

</div>
            
</body>
</html>