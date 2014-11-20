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

function agregar_detalle_factura(){				
	var concepto=document.getElementById("concepto").value;
	var unidades=document.getElementById("unidades").value;
	var monto_concepto=document.getElementById("monto_concepto").value;		
	var dependencia_s=document.getElementById("dependencia_s").value;		
	//document.getElementById('campa_aux').value=document.getElementById('campas').value;					
	if(concepto!=""&&unidades!=""&& isNaN(unidades)==false && monto_concepto!="" && isNaN(monto_concepto)==false &&dependencia_s!="seleccione"){	
	
	var campa=document.getElementById("campas").value;
	
	if(campa!="seleccione"){
	
	divResultado = document.getElementById('agregar_factura');
	divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
	
    ajax=objetoAjax();
    ajax.open("GET", "../../ajax/agregar_detalle_factura.php?concepto="+concepto+"&unidades="+unidades+"&monto="+monto_concepto+"&dependencia_s="+dependencia_s+"&campa="+campa,true);
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            divResultado.innerHTML = ajax.responseText;				
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");
	document.getElementById("concepto").value='';
	document.getElementById("unidades").value='';
	document.getElementById("monto_concepto").value='';		
	document.getElementById("dependencia_s").value='seleccione';
	document.getElementById("campas").options.length = 0;
	}
	else{
		alert("seleccione la campaña");
	}
	
	}
	else{
		alert("ingrese todos los datos");
	}
} 

function agregar_nuevo_detalle_factura(){
	var concepto=document.getElementById("concepto").value;
	var unidades=document.getElementById("unidades").value;
	var monto_concepto=document.getElementById("monto_concepto").value;	
	var dependencia_s=document.getElementById("dependencia_s").value;	
	//var campa=document.getElementById("campas").value;	
	if(concepto!=""&&unidades!=""&& isNaN(unidades)==false && monto_concepto!="" && isNaN(monto_concepto)==false &&dependencia_s!="seleccione"){
	
	var campa=document.getElementById("campas").value;	
	
	if(campa!="seleccione"){
		
	divResultado = document.getElementById('agregar_factura');
	divResultado.innerHTML='<img src="../../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
	
    ajax=objetoAjax();
    ajax.open("GET", "../../../ajax/agregar_nuevo_detalle_factura.php?concepto="+concepto+"&unidades="+unidades+"&monto="+monto_concepto+"&dependencia_s="+dependencia_s+"&campa="+campa,true);
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            divResultado.innerHTML = ajax.responseText			
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");
	
	document.getElementById("concepto").value='';
	document.getElementById("unidades").value='';
	document.getElementById("monto_concepto").value='';		
	document.getElementById("dependencia_s").value='seleccione';
	document.getElementById("campas").options.length = 0;
	}
	else{
		alert("Seleccione la campaña");
	}
	}
	else{
		alert("ingrese todos los datos");
	}
}


function agregar_desglose_presupuesto(){				
	var id_concepto=document.getElementById("id_concepto").value;	
	var concepto=document.getElementById("concepto").value;
	var cantidad=document.getElementById("cantidad").value;				
	var presupuesto=document.getElementById("monto_total").value;						
	//document.getElementById('campa_aux').value=document.getElementById('campas').value;					
	if(id_concepto!=""&& concepto!="" && cantidad!=""&& isNaN(cantidad)==false && presupuesto!="" && isNaN(presupuesto)==false){			
	
	divResultado = document.getElementById('agregar_concepto');
	divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
	
    ajax=objetoAjax();
    ajax.open("GET", "../../ajax/agregar_desglose_presupuesto.php?id_concepto="+id_concepto+"&concepto="+concepto+"&cantidad="+cantidad+"&presupuesto="+presupuesto,true);
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            divResultado.innerHTML = ajax.responseText			
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");
	document.getElementById("id_concepto").value='';
	document.getElementById("concepto").value='';
	document.getElementById("cantidad").value='';		
	
	}
	else{
		alert("ingrese todos los datos");
	}
}  

function agregar_nuevo_desglose_presupuesto(){				
	var id_concepto=document.getElementById("id_concepto").value;	
	var concepto=document.getElementById("concepto").value;
	var cantidad=document.getElementById("cantidad").value;				
	var presupuesto=document.getElementById("monto_total").value;							
	//document.getElementById('campa_aux').value=document.getElementById('campas').value;					
	if(id_concepto!=""&& concepto!="" && cantidad!=""&& isNaN(cantidad)==false && presupuesto!="" && isNaN(presupuesto)==false){			
	
	divResultado = document.getElementById('agregar_concepto');
	divResultado.innerHTML='<img src="../../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
	
    ajax=objetoAjax();
    ajax.open("GET", "../../../ajax/agregar_nuevo_desglose_presupuesto.php?id_concepto="+id_concepto+"&concepto="+concepto+"&cantidad="+cantidad+"&presupuesto="+presupuesto,true);
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            divResultado.innerHTML = ajax.responseText			
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");
	document.getElementById("id_concepto").value='';
	document.getElementById("concepto").value='';
	document.getElementById("cantidad").value='';		
	
	}
	else{
		alert("ingrese todos los datos");
	}
}

var arreglo_etiquetas = [];
var i=0;

function agregar_etiqueta_(etiqueta){
	
	if(etiqueta==""){				
	var etiqueta=document.getElementById("etiqueta").value;	
	}
	
	i=0;		
	for (i in arreglo_etiquetas) {
	  if(arreglo_etiquetas[i]==etiqueta){
		  etiqueta="";
	  }
	}
								
	//document.getElementById('campa_aux').value=document.getElementById('campas').value;					
	if(etiqueta!=""){					
	
	divResultado = document.getElementById('agregar_etiqueta');
	divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
	
    ajax=objetoAjax();
    ajax.open("GET", "../../ajax/agregar_nueva_etiqueta.php?etiqueta="+etiqueta,true);
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            divResultado.innerHTML = ajax.responseText	
			arreglo_etiquetas.push(etiqueta);		
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");
	document.getElementById("etiqueta").value='';	
		
	}
	else{
		document.getElementById("etiqueta").value='';
	}
}


function consultar_contratos(){		
	if(document.getElementById("medios").value!='seleccione'){	
	var medio=document.getElementById("medios").value;	
	var dependencia=document.getElementById("dependencia_c").value;				
	divResultado = document.getElementById('mostrar_contrato');
	document.getElementById('texto_contrato').style.display="none";
    ajax=objetoAjax();
    ajax.open("GET", "../../ajax/consultar_contratos.php?dependencia="+dependencia+"&medio="+medio,true);
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            divResultado.innerHTML = ajax.responseText			
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");	
	}
	else{
		alert('seleccione medio');
		document.getElementById("dependencia_c").value='seleccione';
	}
} 

function consultar_editar_contratos(){		
	if(document.getElementById("field-medio_id").value!=''){	
	var medio=document.getElementById("field-medio_id").value;	
	var dependencia=document.getElementById("field-dependencia_contratante").value;				
    ajax=objetoAjax();
    ajax.open("GET", "../../../../ajax/consultar_editar_contratos.php?dependencia="+dependencia+"&medio="+medio,true);
	
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            document.getElementById("field-contrato").innerHTML = ajax.responseText			
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");	
	}
	else{
		alert('seleccione medio');
		document.getElementById("field-dependencia_contratante").value='';
	}
}

function borrar_contrato_dependencia(){	
	document.getElementById("dependencia_c").value='seleccione';
	document.getElementById("contratos").options.length = 0;			
}

function borrar_editar_contrato_dependencia(){	
	document.getElementById("field-dependencia_contratante").value='';
	document.getElementById("field-contrato").options.length = 0;
				
}

function consultar_campa(){
	var dependencia=document.getElementById("dependencia_s").value;				
	divResultado = document.getElementById('mostrar_campa');
	document.getElementById('texto_campa').style.display="none";
    ajax=objetoAjax();
    ajax.open("GET", "../../ajax/consultar_campa.php?dependencia="+dependencia,true);
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            divResultado.innerHTML = ajax.responseText			
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");
}

function consultar_editar_campa(){
	var dependencia=document.getElementById("field-dependencia_s").value;	
	document.getElementById("field-campa_factura").options.length = 0;					
    ajax=objetoAjax();	
    ajax.open("GET", "../../../../../ajax/consultar_editar_campa_factura.php?dependencia="+dependencia,true);
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            document.getElementById("field-campa_factura").innerHTML = ajax.responseText			
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");
}


function consultar_nueva_campa(){
	var dependencia=document.getElementById("dependencia_s").value;				
	divResultado = document.getElementById('mostrar_campa');
	document.getElementById('texto_campa').style.display="none";
    ajax=objetoAjax();
    ajax.open("GET", "../../../ajax/consultar_campa.php?dependencia="+dependencia,true);
	ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {			
            divResultado.innerHTML = ajax.responseText			
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
    ajax.send("ban=2");
}


function eliminar_detalle_factura(id){		
		divResultado = document.getElementById('agregar_factura');
		divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
		ajax=objetoAjax();
		ajax.open("GET", "../../ajax/eliminar_detalle_factura.php?id="+id,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {			
				divResultado.innerHTML = ajax.responseText			
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
		ajax.send("ban=2");
}

function eliminar_nuevo_detalle_factura(id){				
		divResultado = document.getElementById('agregar_factura');
		divResultado.innerHTML='<img src="../../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';		
		ajax=objetoAjax();
		ajax.open("GET", "../../../ajax/eliminar_nuevo_detalle_factura.php?id="+id,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {			
				divResultado.innerHTML = ajax.responseText			
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
		ajax.send("ban=2");
}

function eliminar_desglose_presupuesto(id){		
		divResultado = document.getElementById('agregar_concepto');
		divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
		ajax=objetoAjax();
		ajax.open("GET", "../../ajax/eliminar_desglose_presupuesto.php?id="+id,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {			
				divResultado.innerHTML = ajax.responseText			
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
		ajax.send("ban=2");
}

function eliminar_nuevo_desglose_presupuesto(id){		
		divResultado = document.getElementById('agregar_concepto');
		divResultado.innerHTML='<img src="../../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
		ajax=objetoAjax();
		ajax.open("GET", "../../../ajax/eliminar_nuevo_desglose_presupuesto.php?id="+id,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {			
				divResultado.innerHTML = ajax.responseText			
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
		ajax.send("ban=2");
}

function eliminar_etiqueta(id){		
		divResultado = document.getElementById('agregar_etiqueta');
		divResultado.innerHTML='<img src="../../imagenes/cargando.gif" style="margin-left:0px; margin-top:10px; margin-buttom:30px;">';
		ajax=objetoAjax();
		ajax.open("GET", "../../ajax/eliminar_etiqueta.php?id="+id,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {			
				divResultado.innerHTML = ajax.responseText			
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
		ajax.send("ban=2");
}

$(document).ready(function() {
	$('.ver_dependencia').live('click',function(){
		var id=$(this).attr('data-id');	
		var nombre = $("#nombre" + id).val();					
		var modal=$('#modal');
		modal.html("<p style='color:#fff;'>Nombre: "+nombre+"</p> <br> <a style='color:#fff;' href='../contratos/contrato_dependencia/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> Contratos </a> <a style='margin-left:50px;color:#fff;' href='../campa/campa_dependencia/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> Campañas </a> ");
		modal.modal();

		return false;
	});
});

$(document).ready(function() {
	$('.ver_dependencia_campa').on('click',function(){
		var id=$(this).attr('data-id');	
		var nombre = $("#nombre" + id).val();					
		var modal=$('#modal');
		modal.html('<p style="color:#fff;">Nombre: '+nombre+"</p> <br> <a style='color:#fff;' href='../../contratos/contrato_dependencia/"+id+"' > <!--<img alt='Campañas' src='../../../imagenes/campa.png'>!--> Contratos </a> <a style='margin-left:50px;color:#fff;' href='../../campa/campa_dependencia/"+id+"' > <!--<img alt='Campañas' src='../../../imagenes/campa.png'>!--> Campañas </a> ");
		modal.modal();

		return false;
	});
});

$(document).ready(function() {
	$('.ver_medio').live('click',function(){
		var id=$(this).attr('data-id');	
		var nombre = $("#nombre_medio" + id).val();					
		var modal=$('#modal');
		modal.html("<p style='color:#fff;'>Nombre: "+nombre+"</p> <br> <a style='color:#fff;' href='../contratos/ver_contratos_medio/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> Contratos </a> <a style='margin-left:50px;color:#fff;' href='../facturas/facturas_medio/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> Facturas </a> ");
		modal.modal();

		return false;
	});
});



$(document).ready(function() {
	$('.ver_contrato_medio').on('click',function(){
		var id=$(this).attr('data-id');	
		var nombre = $("#nombre_medio" + id).val();					
		var modal=$('#modal');
		modal.html("<p style='color:#fff;'>Nombre: "+nombre+"</p> <br> <a style='color:#fff;' href='../../contratos/ver_contratos_medio/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> Contratos </a> <a style='margin-left:50px;color:#fff;' href='../../facturas/facturas_medio/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> Facturas </a> ");
		modal.modal();

		return false;
	});
});

$(document).ready(function() {
	$('.ver_contrato').on('click',function(){
		var id=$(this).attr('data-id');	
		var contrato = $("#contrato" + id).val();					
		var modal=$('#modal');
		modal.html("<p style='color:#fff;'>Número de contrato: "+contrato+"</p> <br> <a style='color:#fff;' href='../contratos/ver_contratos_medio/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> </a> <a style='margin-left:0px;color:#fff;' href='../facturas/facturas_contrato/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> Facturas </a> ");
		modal.modal();

		return false;
	});
});

$(document).ready(function() {
	$('.ver_contrato_factura').on('click',function(){
		var id=$(this).attr('data-id');	
		var contrato = $("#contrato" + id).val();					
		var modal=$('#modal');
		modal.html("<p style='color:#fff;'>Número de contrato: "+contrato+"</p> <br> <a style='color:#fff;' href='../../contratos/ver_contratos_medio/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> </a> <a style='margin-left:0px;color:#fff;' href='../../facturas/facturas_contrato/"+id+"' > <!--<img alt='Campañas' src='../../imagenes/campa.png'>!--> Facturas </a> ");
		modal.modal();

		return false;
	});
});
