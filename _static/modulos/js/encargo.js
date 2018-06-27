$(document).ready(function () {
 	init();
});
var controlador = "encargo";
var text = "Encargo";
var idglobal;
var table;

function init(){
	$.get(url+controlador+"/tableList", function(data) {
		$("#tableList").empty().html(data);
		$('#datatable').dataTable();
	});
}

function form_add(){
	save_method = 'add';
	$.get(url+controlador+"/nuevo", function(data) {
		$("#tableList").empty().html(data);
	});
}
function form_edit(id){
	$.ajax({
		url: url+controlador+'/ajax_edit',
		type: 'POST',
		dataType: 'JSON',
		data: {'id':id},
		success: function(data){
			alerta("Encargo Entregado",'Se entrego con Exito el Encargo','success');
			init();
		},
		error: function(jqXHR, textStatus, errorThrown){
			alerta("Error de Guardado",errorThrown,'error');
		}
	});
}

function save(){

	labels = ['descripcion','nomalmacen'];
	fallas = false;

	for (var i = 0; i < labels.length; i++) {
		if($("[name='"+labels[i]+"']").val() == ""){
			fallas = true;
			alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
			break;
		}
	}
	if(!fallas){
		$("#btn_save_almacen").attr("disabled",true);
		$.ajax({
			url: url+controlador+'/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form").serialize(),
			success: function(data){
				console.log(data);
				$('#modalFormulario').modal('hide');
				$("#btn_save_almacen").removeAttr("disabled");
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				init();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}
}

function showEliminar(id){
	idglobal = id;
	$("#modalEliminar").modal("show");
}

function form_delete(){
	$.ajax({
		url : url+controlador+"/ajax_delete/",
		type: "POST",
		data: {'id':idglobal},
		dataType: "JSON",
		success: function(data){
			console.log(data);
			$('#modalEliminar').modal('hide');			
			alerta("Anulado Exitoso",'Se anulo correctamente','success');
			init();
		},
		error: function (jqXHR, textStatus, errorThrown){
			alerta("Error de Guardado",errorThrown,'error');
		}
	});
}
