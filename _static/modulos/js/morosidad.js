$(document).ready(function () {
 	init();
});
var controlador = "morosidad";
var text = "Morosidad";
var idglobal;
var table;

function init(){
	$.get(url+controlador+"/tableList", function(data) {
		$("#tableList").empty().html(data);
		$('#datatable').dataTable();
	});
}
