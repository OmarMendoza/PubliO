<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
  <!--       <link rel="stylesheet" type="text/css" href="css/login/text.css" media="screen" />!-->
         <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/estilo.css"/>
         <style type="text/css">
             h1{
				 font-family: Arial, Helvetica, sans-serif;
                 font-size: 24px;
                 text-align:left;
                 /*margin: 20px 0px;*/
				 margin-bottom:10px;
				 /*margin-right:370px;*/
				 color:#00B5E2;
             }
			 
			 #raya{
				 border-bottom: 1px dashed #00B5E2;				
			 }
             #login{
                 background: #fefefe;   						 
				 margin: 0 auto;
				max-width: 1000px;
				overflow:hidden;
				position:relative;
				font-weight: lighter;
				font-family:Arial;
				font-size: 14px;
				text-align: center;
				
             }
             #formulario_login{
                 font-size: 14px;
				 margin:0px auto !important;
				 				 				 
                 /*border: 8px solid #112233;*/
				 /*background-color: #A9A9F5;
				 background-color: #005761;*/
             }
             label{
                 display: block;
                 font-size: 16px;
                 /*color: #333333;*/
				 color: #8D8D8D;
                 /*font-weight: bold;*/
             }
             input[type=text],input[type=password]{
                 padding: 5px 6px;
                 width: 300px;
				 background-color: #FFF;				 
             }
			 
			 input[type=submit]{
				 width:161px;
				 height:33px;
				 border:none;                 
                 background: url('../imagenes/is.gif') no-repeat;
                 /*color: #A9A9F5;*/
				
				/* font-weight: bold;*/		
				 margin-top:20px;
				 margin-left:155px;
				 margin-bottom:20px;
				 /*font-weight: bold;*/
				 
             }
            
             #campos_login{				
				 width: 320px;
				 margin: 0px auto;
				 
                
             }
             p{
                 color: #8D8D8D;
                 font-weight: bold;
             }
			 
			#container_12{
				 height:auto; min-height:55%;
			}
			
			#container_12:after{
				width:100%;
				height:150px;
				display:block;
				clear:both;
			}
         </style>
    </head>
    <body>
    <?php
    $username = array('name' => 'username', 'placeholder' => 'Introduce tu nombre de usuario');
    $password = array('name' => 'password',    'placeholder' => 'Introduce tu contraseña');
    $submit = array('name' => 'submit', 'value' => ' ', 'title' => 'Iniciar sesión');
	$captcha_input = array('name' => 'captcha', 'placeholder' => 'Introduce los 6 caracteres que vez en la imagen');
    ?>
    
    <br>
    <br>
    <br>
    <br>
    <div id="container_12">        
        <div id="login">                  
            <div id="formulario_login">                                     		            
                <div id="campos_login">               
                <h1 > Bienvenido </h1>
                                        
                    <div id="raya"> </div>   	
                    <?=form_open(base_url().'index.php/login/autentificar')?>
                    <label for="username">&nbsp;</label>
                    <?=form_input($username)?><p><? //=form_error('username') ?></p>
                    <label for="password">&nbsp;</label>
                    <?=form_password($password)?><p><? //=form_error('password') ?></p>
                    <?=form_hidden('token',$token)?> 
                    <br>
                    <?=$captcha['image']?>
                    <br><br>
                    <?=form_input($captcha_input)?><p><? //=form_error('password') ?></p>                  
                    <input type="hidden" value="<?=$captcha['word']?>" name="string_captcha" />                    
                    <?=form_submit($submit)?>                                      
                    <?=form_close()?>
                    <?php 
                    if($this->session->flashdata('usuario_incorrecto'))
                    {
                    ?>
                    <p><?=$this->session->flashdata('usuario_incorrecto')?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>    
    </body>
</html>