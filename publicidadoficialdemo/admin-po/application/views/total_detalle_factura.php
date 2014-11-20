<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/estilo.css" />
<title>Transparencia Publicidad</title>
</head>
<body>
<br>
<div class="div1">

<table width="100%" cellpadding="2" cellspacing="0" style="font-family:arial;	
	       font-size:12px;left:0px; top:20px; border:1px solid #c4c4c4; text-align:left; margin-buttom:20px;"> 
<tr>
<th width="33%" style="background:#6DA8C6; color:#fff; border:1px solid #fff;"></th>
<th width="33%" style="background:#6DA8C6; color:#fff; border:1px solid #fff;">Unidades</th>
<th width="33%" style="background:#6DA8C6; color:#fff; border:1px solid #fff;">Monto</th>
</tr>

<tr>
<td>Total</td>
<?php foreach($totales->result() as $fila) { ?>		        
        <td><?php echo number_format($fila->total_unidades)?></td>
        <td><?php echo "$".number_format($fila->total_monto)?></td>               
<?php } ?>
</tr>
</table>

</div>
            
</body>
</html>