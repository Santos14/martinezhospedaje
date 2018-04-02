$(document).ready(function () {
 	init();
});
var controlador = "habitacion";
var text = "Habitacion";
var idglobal;
var table;

function init(){
	$.get(url+controlador+"/tableList", function(data) {
		$("#tableList").empty().html(data);
		$('#datatable').dataTable();
	});
}

function init_servicio(){
	$.get(url+controlador+"/space_servicio", function(servicio) {
		$("#space_servicio").empty().html(servicio);
	});
}

function init_elemento(){
	$.get(url+controlador+"/space_elemento", function(elemento) {
		$("#space_elemento").empty().html(elemento);
	});
}


function form_add(){
	save_method = 'add';
	$.get(url+controlador+"/form_nuevo", function(nuevo) {
		$.get(url+controlador+"/space_servicio", function(servicio) {
			$.get(url+controlador+"/space_elemento", function(elemento) {
				$("#tableList").empty().html(nuevo);
				$("#space_servicio").empty().html(servicio);
				$("#space_elemento").empty().html(elemento);
			});
		});
	});
}

function serv_add(){
	$("#title_form_serv").text("Agregar Servicio");
	$("#btn_save_serv").text("Crear");
	$('#form_servicio')[0].reset();
	$("#serv_id").val("");
	$("#modalServicio").modal("show");
}

function elem_add(){
	$("#title_form_elem").text("Agregar Elemento");
	$("#btn_save_elem").text("Crear");
	$('#form_elemento')[0].reset();
	$("#elem_id").val("");
	$("#modalElemento").modal("show");
}

function serv_edit(id){
	$("#title_form_serv").text("Editar Servicio");
	$("#btn_save_serv").text("Actualizar");
	$('#form_servicio')[0].reset();
	$.get(url+'servicio/ajax_edit/'+id, function(data, textStatus, xhr) {
		if(textStatus=="success"){
			$('[name="serv_id"]').val(data[0].idservicio);
			$('[name="serv_descripcion"]').val(data[0].descripcion);
			$("#modalServicio").modal("show");
		}else{
			alert("Error al Extraer Datos")
		}
	},"json");
}

function elem_edit(id){
	$("#title_form_elem").text("Editar Elemento");
	$("#btn_save_elem").text("Actualizar");
	$('#form_elemento')[0].reset();
	$.get(url+'elemento/ajax_edit/'+id, function(data, textStatus, xhr) {
		if(textStatus=="success"){
			$('[name="elem_id"]').val(data[0].idelemento);
			$('[name="elem_descripcion"]').val(data[0].descripcion);
			$('[name="elem_especificacion"]').val(data[0].especificacion);
			$("#modalElemento").modal("show");
		}else{
			alert("Error al Extraer Datos")
		}
	},"json");
	
}

function form_edit(id){
	
	$.get(url+controlador+'/ajax_edit/'+id, function(data, textStatus, xhr) {
		if(textStatus=="success"){
			$.get(url+controlador+"/form_nuevo", function(nuevo) {
				$.get(url+controlador+"/space_servicio", function(servicio) {
					$.get(url+controlador+"/space_elemento", function(elemento) {
						$("#tableList").empty().html(nuevo);
						$("#space_servicio").empty().html(servicio);
						$("#space_elemento").empty().html(elemento);

						$('[name="id"]').val(data["habitacion"][0].idhabitacion);
						$('[name="nrohabitacion"]').val(data["habitacion"][0].nrohabitacion);
						$('[name="precio"]').val(data["habitacion"][0].precio);
						$('[name="idtipohabitacion"]').val(data["habitacion"][0].tipohabitacion_idtipohabitacion);
						
						if(data["detalle_servicio"].length!=0){
							for (var i = 0; i < data["detalle_servicio"].length; i++) {
								console.log("#serv_check"+data["detalle_servicio"][i].servicio_idservicio);
								$("#serv_check"+data["detalle_servicio"][i].servicio_idservicio).attr("checked",true);
							}
						}
						if(data["detalle_elemento"].length!=0){
							for (var i = 0; i < data["detalle_elemento"].length; i++) {
								console.log("#elem_check"+data["detalle_elemento"][i].elemento_idelemento);
								$("#elem_check"+data["detalle_elemento"][i].elemento_idelemento).attr("checked",true);
								$("#elem_text"+data["detalle_elemento"][i].elemento_idelemento).removeAttr('disabled');
								$("#elem_text"+data["detalle_elemento"][i].elemento_idelemento).val(data["detalle_elemento"][i].especificacion);
							}	
						}


					});
				});
			});

		}else{
			alert("Error al Extraer Datos")
		}
	},"json");
}

function save(){
	labels = ['nrohabitacion'];
	elem = $(".elem_opcion");
	serv = $(".serv_opcion");
	count_elem = 0;
	count_serv = 0;
	fallas = false;
	for (var i = 0; i < labels.length; i++) {
		if($("[name='"+labels[i]+"']").val() == ""){
			fallas = true;
			alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
			break;
		}
	}

	if(!fallas){
		for (var i = 0; i < serv.length; i++) {
			if(serv[i].checked){
				count_serv++;
			}
		}
		for (var f = 0; f < elem.length; f++) {
			if(elem[f].checked){
				count_elem++;
			}
		}

		if(count_elem==0){
			alerta("Sin Elementos","Elija elementos para la Habitacion",'error');
		}else{

			$.ajax({
				url: url+controlador+'/ajax_save',
				type: 'POST',
				dataType: 'JSON',
				data: $("#form").serialize(),
				success: function(data){
					console.log(data);
					alerta("Guardado Exitoso",'Se guardo correctamente','success');
					init();
				},
				error: function(jqXHR, textStatus, errorThrown){
					alerta("Error de Guardado",errorThrown,'error');
				}
			});
		}	
	}
	
}

function save_servicio(){
	labels = ['serv_descripcion'];
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
			url: url+'servicio/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form_servicio").serialize(),
			success: function(data){
				console.log(data);
				$('#modalServicio').modal('hide');
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				init_servicio();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}
}

function save_elemento(){
	labels = ['elem_descripcion','elem_especificacion'];
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
			url: url+'elemento/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form_elemento").serialize(),
			success: function(data){
				console.log(data);
				$('#modalElemento').modal('hide');
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				init_elemento();
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

function serv_elim(id){
	idglobal = id;
	$("#modalEliminarServicio").modal("show");
}

function elem_elim(id){
	idglobal = id;
	$("#modalEliminarElemento").modal("show");
}


function serv_delete(){
	$.ajax({
		url : url+"servicio/ajax_delete/",
		type: "POST",
		data: {'id':idglobal},
		dataType: "JSON",
		success: function(data){
			console.log(data);
			$('#modalEliminarServicio').modal('hide');			
			alerta("Eliminado Exitoso",'Se elimino correctamente','success');
			init_servicio();
		},
		error: function (jqXHR, textStatus, errorThrown){
			alerta("Error de Guardado",errorThrown,'error');
		}
	});
}

function elem_delete(){
	$.ajax({
		url : url+"elemento/ajax_delete/",
		type: "POST",
		data: {'id':idglobal},
		dataType: "JSON",
		success: function(data){
			console.log(data);
			$('#modalEliminarElemento').modal('hide');			
			alerta("Eliminado Exitoso",'Se elimino correctamente','success');
			init_elemento();
		},
		error: function (jqXHR, textStatus, errorThrown){
			alerta("Error de Guardado",errorThrown,'error');
		}
	});
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

function showEsp(c,id){
	if(c.checked){
		$("#elem_text"+id).removeAttr('disabled');
	}else{
		$("#elem_text"+id).attr('disabled',true);
		$("#elem_text"+id).val('');
	}

}