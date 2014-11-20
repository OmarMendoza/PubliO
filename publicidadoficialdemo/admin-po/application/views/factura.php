<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Medios</title>

<?php
foreach($css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<link type='text/css' href='<?php echo base_url();?>css/estilo_modal.css' rel='stylesheet' media='screen' />    
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/calendario_dw/jquery-1.8.2.min.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>ajax/ajaxs.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>calendario-jquery/jquery.simplemodal.js"></script>     

</head>
<body>

<div class="page">

<br>
<br>

</div>

<div class="div1">

<?php echo $output; ?>
    
</div>

<div style=" display:none;" id="modal">								
		</div>
    
<br>
  
</body>
</html>