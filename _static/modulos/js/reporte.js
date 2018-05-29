$(document).ready(function () {
 	
});
function verinforme(){
	if($("#mes").val()!='' && $("#anio").val()!=''){
		$.get(url+"reporte/informeestadistica/"+$("#mes").val()+"/"+$("#anio").val(), function(data) {
			$("#showtable").empty().html(data);
		});
	}
}

function alojamiento(){
	if($("#dia").val()!=''){
		$.get(url+"reporte/alojamiento_imprimir/"+$("#dia").val(), function(data) {

			$("#showtable").empty().html(data);
			var base64Img = null;
			var doc = new jsPDF();

	        doc.text("Hospedaje Martinez",14, 15);
	        doc.setFontSize(9);
	        doc.text("Calle Julio C. Pinedo N° 152 - Telef.: (065) 352935", 14, 20);
	        doc.setFontSize(7);
	        doc.text("Yurmaguas - Alto Amazonas - Loreto", 14, 24);

		       

		    doc.setFontSize(14);
		    doc.text("Reporte de Pagos por Habitacion", 14, 37);
		    doc.setFontSize(8);
		    doc.text("DIA: "+$("#dia").val(), 14, 42);
		    var elem = document.getElementById("table_reporte");
		    var res = doc.autoTableHtmlToJson(elem);

		    doc.autoTable(res.columns, res.data, {
		    	
		    	startY: 45,
		    	styles: {cellPadding: 0.5, fontSize: 9},
		    	columnStyles: {text: {columnWidth: 'auto'}}
		    });

		  
		    doc.setProperties({
	            title: 'Pago de Alquileres',
	            subject: 'A jspdf-autotable example pdf'
	        });

		    $("#iframe-reporte").attr("src",doc.output('datauristring'));
		});
	}else{
		alerta("Sin Fecha","Ingrese Fecha","error");
	}
}

function historialpasajeros(){
	if($("#fecha_inicio").val()!='' && $("#fecha_fin").val()!=''){
		$.get(url+"reporte/historialpasajeros_imprimir/"+$("#fecha_inicio").val()+"/"+$("#fecha_fin").val(), function(data) {
			$("#showtable").empty().html(data);
			var base64Img = null;
			var doc = new jsPDF('l');


		   	doc.text("Hospedaje Martinez",14, 15);
	        doc.setFontSize(9);
	        doc.text("Calle Julio C. Pinedo N° 152 - Telef.: (065) 352935", 14, 20);
	        doc.setFontSize(7);
	        doc.text("Yurmaguas - Alto Amazonas - Loreto", 14, 24);


		    
		    doc.setFontSize(14);
		    doc.text("Historial de Estancias (Alquileres)", 14, 37);
		    doc.setFontSize(8);
		    doc.text("Del "+$("#fecha_inicio").val()+" al "+$("#fecha_fin").val(), 14, 42);
		    var elem = document.getElementById("table_reporte");
		    var res = doc.autoTableHtmlToJson(elem);

		    doc.autoTable(res.columns, res.data, {
		    	startY: 48,
		    	styles: {cellPadding: 0.5, fontSize: 7}
		    });

	
		    doc.setProperties({
	            title: 'Historial de Pasajeros',
	            subject: 'A jspdf-autotable example pdf'
	        });

		    $("#iframe-reporte").attr("src",doc.output('datauristring'));
		});
	}else{
		alerta("Sin Fecha","Ingrese Fecha","error");
	}

}







function estadodia(){
	if($("#dia").val()!=''){
		$.get(url+"reporte/estadodia_imprimir/"+$("#dia").val(), function(data) {

			$("#showtable").empty().html(data);
			var base64Img = null;
			var doc = new jsPDF();

	        doc.text("Hospedaje Martinez",14, 15);
	        doc.setFontSize(9);
	        doc.text("Calle Julio C. Pinedo N° 152 - Telef.: (065) 352935", 14, 20);
	        doc.setFontSize(7);
	        doc.text("Yurmaguas - Alto Amazonas - Loreto", 14, 24);

		       

		    var totalPagesExp = "{total_pages_count_string}";
		    doc.setFontSize(14);
		    doc.text("Reporte del de Movimientos del Dia", 14, 37);
		    doc.setFontSize(8);
		    doc.text("DIA: "+$("#dia").val(), 14, 42);
		    var t_ing = document.getElementById("table_i");
		    var t_egr = document.getElementById("table_e");
		    var t_sal = document.getElementById("table_s");
		    var res_ing = doc.autoTableHtmlToJson(t_ing);
		    var res_egr = doc.autoTableHtmlToJson(t_egr);
		    var res_sal = doc.autoTableHtmlToJson(t_sal);


		    doc.setFontSize(11);
		    doc.text("Ingresos",14,52);
		    doc.autoTable(res_ing.columns, res_ing.data, {
		    	
		    	startY: 55,
		    	styles: {cellPadding: 0.5, fontSize: 9},
		    	columnStyles: {text: {columnWidth: 'auto'}}
		    });

		    doc.text("Egresos",14,doc.autoTable.previous.finalY + 10);
		    doc.autoTable(res_egr.columns, res_egr.data, {
				
		    	startY: doc.autoTable.previous.finalY + 15,
		    	styles: {cellPadding: 0.5, fontSize: 9},
		    	columnStyles: {text: {columnWidth: 'auto'}}
		    });

		    doc.autoTable(res_sal.columns, res_sal.data, {
				
		    	startY: doc.autoTable.previous.finalY + 15,
		    	styles: {cellPadding: 0.5, fontSize: 11},
		    	columnStyles: {text: {columnWidth: 'auto'}}
		    });


		    if (typeof doc.putTotalPages === 'function') {
		        doc.putTotalPages(totalPagesExp);
		    }

		    doc.setProperties({
	            title: 'Movimientos del Dia',
	            subject: 'A jspdf-autotable example pdf'
	        });

		    $("#iframe-reporte").attr("src",doc.output('datauristring'));
		});
	}else{
		alerta("Sin Fecha","Ingrese Fecha","error");
	}
}

function verestadomes(){
	if($("#mes").val()!='' && $("#anio").val()!=''){
		$.get(url+"reporte/estadomes_imprimir/"+$("#mes").val()+"/"+$("#anio").val(), function(data) {

			$("#showtable").empty().html(data);
			var base64Img = null;
			var doc = new jsPDF();

	        doc.text("Hospedaje Martinez",14, 15);
	        doc.setFontSize(9);
	        doc.text("Calle Julio C. Pinedo N° 152 - Telef.: (065) 352935", 14, 20);
	        doc.setFontSize(7);
	        doc.text("Yurmaguas - Alto Amazonas - Loreto", 14, 24);

		       

		    var totalPagesExp = "{total_pages_count_string}";
		    doc.setFontSize(14);
		    doc.text("Reporte del de Movimientos Mensuales", 14, 37);
		    doc.setFontSize(8);
		    doc.text("MES: "+$("#mes").val()+" - "+$("#anio").val(), 14, 42);
		    var t_ing = document.getElementById("table_i");
		    var t_egr = document.getElementById("table_e");
		    var t_sal = document.getElementById("table_s");
		    var res_ing = doc.autoTableHtmlToJson(t_ing);
		    var res_egr = doc.autoTableHtmlToJson(t_egr);
		    var res_sal = doc.autoTableHtmlToJson(t_sal);


		    doc.setFontSize(11);
		    doc.text("Ingresos",14,52);
		    doc.autoTable(res_ing.columns, res_ing.data, {
		    	
		    	startY: 55,
		    	styles: {cellPadding: 0.5, fontSize: 9},
		    	columnStyles: {text: {columnWidth: 'auto'}}
		    });

		    doc.text("Egresos",14,doc.autoTable.previous.finalY + 10);
		    doc.autoTable(res_egr.columns, res_egr.data, {
				
		    	startY: doc.autoTable.previous.finalY + 15,
		    	styles: {cellPadding: 0.5, fontSize: 9},
		    	columnStyles: {text: {columnWidth: 'auto'}}
		    });

		    doc.autoTable(res_sal.columns, res_sal.data, {
				
		    	startY: doc.autoTable.previous.finalY + 15,
		    	styles: {cellPadding: 0.5, fontSize: 11},
		    	columnStyles: {text: {columnWidth: 'auto'}}
		    });


		    if (typeof doc.putTotalPages === 'function') {
		        doc.putTotalPages(totalPagesExp);
		    }

		    doc.setProperties({
	            title: 'Movimientos Mensuales',
	            subject: 'A jspdf-autotable example pdf'
	        });

		    $("#iframe-reporte").attr("src",doc.output('datauristring'));
		});
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


