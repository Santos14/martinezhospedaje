$(document).ready(function () {
 	init();
});
var controlador = "politicas";
var text = "Politicas";
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
	$("#title_form").text("Agregar "+text);
	$("#btn_save").text("Crear");
	$('#form')[0].reset();
	$("#id").val("");
	$("#modalFormulario").modal("show");
}
function form_edit(id){
	$("#title_form").text("Editar "+text);
	$("#btn_save").text("Actualizar");
	$('#form')[0].reset();
	$.get(url+controlador+'/ajax_edit/'+id, function(data, textStatus, xhr) {
		if(textStatus=="success"){
			$('[name="id"]').val(data[0].idpoliticas);
			$('[name="fecha"]').val(data[0].fecha);
			$('[name="descripcion"]').val(data[0].descripcion);
			$('[name="numero"]').val(data[0].numero);
			$('[name="unidad_medida"]').val(data[0].unidad_medida);
			$("#modalFormulario").modal("show");
		}else{
			alert("Error al Extraer Datos")
		}
	},"json");
}

function form_estado(id,est){
	
	$.post(url+controlador+'/ajax_change',{id:id ,'e': est}, function(data, textStatus, xhr){
		if(textStatus=="success"){
			init()
		}else{
			alerta("Error¡",textStatus,'error');
		}
	},"json");
}


function save(){
	labels = ['fecha','descripcion','numero','unidad_medida'];
	fallas = false;
	for (var i = 0; i < labels.length; i++) {
		if($("[name='"+labels[i]+"']").val() == ""){
			fallas = true;
			alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
			break;
		}
	}
	if(!fallas){
		$.ajax({
			url: url+controlador+'/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("form").serialize(),
			success: function(data){
				console.log(data);
				$('#modalFormulario').modal('hide');
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
			alerta("Eliminado Exitoso",'Se elimino correctamente','success');
			init();
		},
		error: function (jqXHR, textStatus, errorThrown){
			alerta("Error de Guardado",errorThrown,'error');
		}
	});
}
