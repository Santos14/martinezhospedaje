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
		$.get(url+"reporte/adelantosueldo_imprimir/"+$("#fecha_inicio").val()+"/"+$("#fecha_fin").val(), function(data) {
			$("#showtable").empty().html(data);
			var base64Img = null;
			var doc = new jsPDF();


		    var pageContent = function (data) {
		        // HEADER
		        doc.setFontSize(16);
		        doc.setFontStyle('normal');
		        if (base64Img) {
		            doc.addImage(base64Img, 'JPEG', data.settings.margin.left, 15, 10, 10);
		        }
		        doc.text("Hospedaje Martinez", data.settings.margin.left+0, 15);
		        doc.setFontSize(9);
		        doc.text("Calle Julio C. Pinedo N° 152 - Telef.: (065) 352935", data.settings.margin.left+0, 20);
		        doc.setFontSize(7);
		        doc.text("Yurmaguas - Alto Amazonas - Loreto", data.settings.margin.left+0, 24);

		        // FOOTER
		        var str = "Pagina " + data.pageCount;
		        // Total page number plugin only available in jspdf v1.0+
		        if (typeof doc.putTotalPages === 'function') {
		            str = str + " de " + totalPagesExp;
		        }
		        doc.setFontSize(10);
		        doc.text(str, data.settings.margin.left, doc.internal.pageSize.height - 10);
		    };

		    var totalPagesExp = "{total_pages_count_string}";
		    doc.setFontSize(14);
		    doc.text("Adelantos de Suelto", 14, 37);
		    doc.setFontSize(8);
		    doc.text("Del "+$("#fecha_inicio").val()+" al "+$("#fecha_fin").val(), 14, 42);
		    var elem = document.getElementById("table_reporte");
		    var res = doc.autoTableHtmlToJson(elem);

		    doc.autoTable(res.columns, res.data, {
		    	addPageContent: pageContent,
		    	startY: 48,
		    	styles: {cellPadding: 0.5, fontSize: 9}
		    });

		    if (typeof doc.putTotalPages === 'function') {
		        doc.putTotalPages(totalPagesExp);
		    }

		    doc.setProperties({
	            title: 'Adelanto de Sueldo',
	            subject: 'A jspdf-autotable example pdf'
	        });

		    $("#iframe-reporte").attr("src",doc.output('datauristring'));
		});
	}else{
		alerta("Sin Fecha","Ingrese Fecha","error");
	}
}

function pAdelantoSueldo(){
	
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