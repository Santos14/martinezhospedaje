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

function searchdni(c){
	if(c.value!=""){
		$.get(url+"cliente/ajax_searchdni/"+c.value, function(data) {
			if(data.length>0){
				$("#idcliente").val(data[0].idcliente);
				$("#cliente").val(data[0].apellidos+", "+data[0].nombres);
			}				
		},"json");
	}
}

function seleccionaCliente(idcliente,nombre,apellido,nrodoc){							
	$("#idcliente").val(idcliente);
	$("#al_dni").val(nrodoc);
	$("#cliente").val(apellido+", "+nombre);			
	$("#modalListaClientes").modal("hide");
}


function search_cliente(op){

	$.get(url+"cliente/clientListModal/"+op, function(data) {
		$("#showListClient").empty().html(data);
		$('#clientes').dataTable();
		$("#modalListaClientes").modal("show");
	});
}
function save(){

	labels = ['al_dni','cliente','idalmacen','descripcion','fecha','hora'];
	fallas = false;

	for (var i = 0; i < labels.length; i++) {
		if($("[name='"+labels[i]+"']").val() == ""){
			fallas = true;
			alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
			break;
		}
	}
	if(!fallas){
		$("#btn_save_encargo").attr("disabled",true);
		$.ajax({
			url: url+controlador+'/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form").serialize(),
			success: function(data){
				$("#btn_save_encargo").removeAttr("disabled");
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				init();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}
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
