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

function adelantosueldo(){
	if($("#fecha_inicio").val()!='' && $("#fecha_fin").val()!=''){
		var urlenvio = url+"reporte/adelantosueldo_imprimir/"+$("#fecha_inicio").val()+"/"+$("#fecha_fin").val();
		$("#iframe-reporte").attr("src",urlenvio); 
	}else{
		alerta("Sin Fecha","Ingrese Fecha","error");
	}
}



function deudasdia(){
	var urlenvio = url+"reporte/deudasdia_imprimir/";
	$("#iframe-reporte").attr("src",urlenvio); 
}




function probar(){
	var columns = [ " ID " , " Nombre " , " País " ];
	var rows = [
	    [ 1 , " Shaw " , " Tanzania "],
	    [ 2 , " Nelson " , " Kazajstán "],
	    [ 3 , " Garcia " , " Madagascar "],
	];

	// Solo pt soportado (no mm o in) 
	var doc = new jsPDF('p','pt');
	doc.autoTable (columns, rows);
	//doc.save ('table.pdf');
	doc.output('dataurlnewwindow'); 
}