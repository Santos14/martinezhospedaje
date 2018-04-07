$(document).ready(function () {
 	
});
function alojamiento(){
	if($("#dia").val()!=''){
		var urlenvio = url+"reporte/alojamiento_imprimir/"+$("#dia").val();
		$("#iframe-reporte").attr("src",urlenvio); 
	}else{
		alerta("Sin Fecha","Ingrese Fecha","error");
	}
}
function estadodia(){
	if($("#dia").val()!=''){
		var urlenvio = url+"reporte/estadodia_imprimir/"+$("#dia").val();
		$("#iframe-reporte").attr("src",urlenvio); 
	}else{
		alerta("Sin Fecha","Ingrese Fecha","error");
	}
}
