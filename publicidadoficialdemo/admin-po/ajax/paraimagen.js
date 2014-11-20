
function objetoAjax(){
    var xmlhttp=false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }

    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {	
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

   
var i1=130;
var i2=128;
var c=1;
   
$(document).ready(function() { 	  	  			
            $('#photoimg').live('change', function(){				
							 																	    
			    $("#preview").html('<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">');
			    //$("#preview").html('hola');				
				$("#imageform").ajaxForm({
						//
						target: '#preview'
						
						//target: '<img src="capturas/Chrysanthemum.jpg"/>'
											
				}).submit();
				
				if(c<=9 && c!=1){
					i1=i1+130;
					$("#preview").width(i1);
				}				
				if(c%9==0){
					$("#preview").height(i2);
				}
				c++;			
				
			});					
        });
		

var i1_2=130;
var i2_2=128;
var c2=1;
		
$(document).ready(function() { 	  	  			
            $('#photoimg2').live('change', function(){				
							 																	    
			    $("#preview2").html('<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">');
			    //$("#preview").html('hola');				
				$("#imageform2").ajaxForm({
						//
						target: '#preview2'
						
						//target: '<img src="capturas/Chrysanthemum.jpg"/>'
											
				}).submit();
				
				if(c2<=9 && c2!=1){
					i1_2=i1_2+130;
					$("#preview2").width(i1_2);
				}				
				if(c2%9==0){
					$("#preview2").height(i2_2);
				}
				c2++;			
				
			});					
        });
		
		
var i1_audio=130;
var i2_audio=128;
var caudio=1;
		
$(document).ready(function() { 	  	  			
            $('#agregar_audio').live('change', function(){				
							 																	    
			    $("#previewaudio").html('<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">');
			    //$("#preview").html('hola');				
				$("#audioform").ajaxForm({
						//
						target: '#previewaudio'
						
						//target: '<img src="capturas/Chrysanthemum.jpg"/>'
											
				}).submit();
				
				if(caudio<=9 && caudio!=1){
					i1_audio=i1_audio+130;
					$("#previewaudio").width(i1_audio);
				}				
				if(caudio%9==0){
					$("#previewaudio").height(i2_audio);
				}
				caudio++;			
				
			});					
        });
		
var i1_video=130;
var i2_video=128;
var cvideo=1;
		
$(document).ready(function() { 	  	  			
            $('#agregar_video').live('click', function(){								
				
				var codigo_video=document.getElementById('video').value;								
				var posicion = codigo_video.lastIndexOf('src');	
				
				if(posicion!=-1){
								
				codigo_video=codigo_video.substring(posicion, codigo_video.length);								;				
				codigo_video=codigo_video.substring(5, codigo_video.length);				
				posicion = codigo_video.lastIndexOf('"');
				codigo_video=codigo_video.substring(0, posicion);
				//alert(codigo_video);		
				document.getElementById('video').value=codigo_video;																							
							 																	    
			    $("#previewvideo").html('<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">');
			    //$("#preview").html('hola');				
				$("#videoform").ajaxForm({
						//
						
						target: '#previewvideo'
						
						
						//target: '<img src="capturas/Chrysanthemum.jpg"/>'
											
				}).submit();
				
				if(cvideo<=9 && cvideo!=1){
					i1_video=i1_video+130;
					$("#previewvideo").width(i1_video);
				}				
				if(cvideo%9==0){
					$("#previewvideo").height(i2_video);
				}
				cvideo++;											
				
				}
				
				else{
					alert("codigo incorrecto");
					document.getElementById('video').value='';
				}
				
				//document.getElementById('video').value='';
				
			});					
			document.getElementById('video').value='';
        });


   
   function eliminar_imagen_factura(id){
	   		divResultado = document.getElementById('preview');
			divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
		    //var id=$(this).attr('data-id');			
			//var id= document.getElementById('eliminar_imagen_factura');		
			ajax=objetoAjax();
			ajax.open("GET", "../../ajax/eliminar_imagen_factura.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
   }         
   

   
   function eliminar_nueva_imagen_factura(id){
	   		divResultado = document.getElementById('preview');
			divResultado.innerHTML='<img src="../../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';		
			ajax=objetoAjax();
			ajax.open("GET", "../../../ajax/eliminar_nueva_imagen_factura.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
   }
   
   

   
   function eliminar_imagen_testigo_factura(id){
			divResultado = document.getElementById('preview2');
			divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';		
			ajax=objetoAjax();
			ajax.open("GET", "../../ajax/eliminar_imagen_testigo.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
   }
   
   
 
   function eliminar_nueva_imagen_testigo_factura(id){
			divResultado = document.getElementById('preview2');
			divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';					
			ajax=objetoAjax();
			ajax.open("GET", "../../../ajax/eliminar_nueva_imagen_testigo.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
   }
   
   $(document).ready(function() {
	$('.eliminar_banner').live('click',function(){					    
			divResultado = document.getElementById('preview');
			divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
			var id=$(this).attr('data-id');
			ajax=objetoAjax();
			ajax.open("GET", "../../ajax/eliminar_banner.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
		});					
   });
   
   function eliminar_nuevo_banner(id){
			divResultado = document.getElementById('preview');
			divResultado.innerHTML='<img src="../../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';		    	
			ajax=objetoAjax();
			ajax.open("GET", "../../../ajax/eliminar_nuevo_banner.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
   }
   
  
   
   $(document).ready(function() {
	$('.eliminar_audio').live('click',function(){
			divResultado = document.getElementById('previewaudio');
			divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
		    var id=$(this).attr('data-id');			
			ajax=objetoAjax();
			ajax.open("GET", "../../ajax/eliminar_audio.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
		});					
   });
    
   function eliminar_nuevo_audio(id){
	   		divResultado = document.getElementById('previewaudio');
			divResultado.innerHTML='<img src="../../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';		   
			ajax=objetoAjax();
			ajax.open("GET", "../../../ajax/eliminar_nuevo_audio.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
   }
   
   $(document).ready(function() {
	$('.eliminar_video').live('click',function(){
			divResultado = document.getElementById('previewvideo');
			divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
		    var id=$(this).attr('data-id');			
			ajax=objetoAjax();
			ajax.open("GET", "../../ajax/eliminar_video.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
		});					
   });
   
   $(document).ready(function() {
	$('.eliminar_nuevo_video').live('click',function(){
			divResultado = document.getElementById('previewvideo');
			divResultado.innerHTML='<img src="../../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';			
		    var id=$(this).attr('data-id');			
			ajax=objetoAjax();
			ajax.open("GET", "../../../ajax/eliminar_nuevo_video.php?id="+id,true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {			
					divResultado.innerHTML = ajax.responseText			
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
			ajax.send("ban=2");
		});					
   });
		
function limpiar(){
	document.getElementById('video').value='';
}