$(document).ready(function () {
 	init();
});
var controlador = "alquiler";
var text = "Alquiler";
var idglobal;
var table;

function init(){

	$.get(url+controlador+"/tableList", function(data) {
		$("#tableList").empty().html(data);
		$('#datatable').dataTable();
	});
}

function view_miniatura(){
	$("#miniatura").removeClass().addClass('btn btn-primary');
	$("#lista").removeClass().addClass('btn btn-default');
	$("#alquiler").removeClass().addClass('btn btn-default');
	init();
}

function view_lista(){
	$("#miniatura").removeClass().addClass('btn btn-default');
	$("#lista").removeClass().addClass('btn btn-primary');
	$("#alquiler").removeClass().addClass('btn btn-default');
	$.get(url+controlador+"/listapasajeros", function(data) {
		$("#tableList").empty().html(data);
		$("#listapasajeros").dataTable();
	});
}

function view_alquileres(){
	$("#miniatura").removeClass().addClass('btn btn-default');
	$("#lista").removeClass().addClass('btn btn-default');
	$("#alquiler").removeClass().addClass('btn btn-primary');
	$.get(url+controlador+"/listaalquiler", function(data) {
		$("#tableList").empty().html(data);
		$("#listaalquiler").dataTable();
	});


}

function anular_alquiler(id){
	if(confirm("¿Esta seguro de Anular este alquiler?")){
		$.ajax({
			url : url+controlador+"/anular_alquiler/",
			type: "POST",
			data: {'id':id},
			dataType: "JSON",
			success: function(data){
				alerta("Alquiler Anulado",'Se Anulo exitosamente','success');
				view_alquileres();
			},
			error: function (jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}
}
function editar_alquiler(id){
	
}
function ver_alquiler(id){
	$.get(url+controlador+"/ver_alquiler/"+id, function(data) {
		$("#detallever").empty().html(data);
		$("#modalver").modal("show");
	});
	
}

function restaurar_alquiler(id){
	if(confirm("¿Esta seguro de Restaurar este alquiler?")){
		$.ajax({
			url : url+controlador+"/restaurar_alquiler/",
			type: "POST",
			data: {'id':id},
			dataType: "JSON",
			success: function(data){
				alerta("Alquiler Restaurado",'Se Restauro exitosamente','success');
				view_alquileres();
			},
			error: function (jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}
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
			$('[name="id"]').val(data[0].idtipoalquiler);
			$('[name="descripcion"]').val(data[0].descripcion);
			$("#modalFormulario").modal("show");
		}else{
			alert("Error al Extraer Datos")
		}
	},"json");
}

function cambioestado(estadocuarto,id){
	if(estadocuarto == 2 || estadocuarto==3){
		if(confirm("¿Ya se realizo la Accion?")){
			$.ajax({
				url: url+controlador+'/cambioestadocuarto',
				type: 'POST',
				dataType: 'JSON',
				data: {'estado_cuarto':estadocuarto,'id':id},
				success: function(data){
					init();
				},
				error: function(jqXHR, textStatus, errorThrown){
					alerta("Error de Guardado",errorThrown,'error');
				}
			});
		}
	}
	
	
}

function save(){
	labels = ['al_dni','cliente','precioxdia','idtipoalquiler','idmotivoviaje','idprocedencia','kit','pagoinicial','localidad'];
	fallas = false;
	for (var i = 0; i < labels.length; i++) {
		if($("[name='"+labels[i]+"']").val() == ""){
			fallas = true;
			alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
			break;
		}
	}

	
	if(!fallas){
		
		$("#btn_save_alquiler").attr("disabled",true);
		$.ajax({
			url: url+controlador+'/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form_al").serialize(),
			success: function(data){
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				$("#btn_save_alquiler").removeAttr("disabled");
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

function cambiarprocedencia(s){
	if(s.checked){
		$l = "N";
	}else{
		$l = "E";
	}

	$.get(url+controlador+"/cambiarprocedencia/"+$l, function(data) {

		$("#idprocedencia").html("<option value=''>Seleccione...</option>");
		for (var i = 0; i < data.length; i++) {
			$("#idprocedencia").append("<option value='"+data[i].idprocedencia+"'>"+data[i].lugar+"</option>");
		}
	},"json");
}
est = 0;
function vermoroso(e){
	if(e=='1'){
		if(est==0){
			est=1;
			$("#panelmorosidad").show();
		}else{
			est=0;
			$("#panelmorosidad").hide();
		}
	}
}


function searchdni(c){
	if(c.value!=""){
		$.get(url+"cliente/ajax_searchdni/"+c.value, function(data) {
			$.get(url+"alquiler/ajax_morosidad/"+data[0].idcliente+"/1", function(morosidad1) {
				$.get(url+"alquiler/ajax_morosidad/"+data[0].idcliente+"/2", function(morosidad2) {
					if(data.length>0){
						console.log(morosidad2.length);
						if(morosidad2.length>0){
							$("#btn_save_alquiler").attr("disabled",true);
							clas = "btn btn-danger";
							icon = "fa fa-close";
							text = "MOROSO";
							func = "1";

						}else{
							$("#btn_save_alquiler").removeAttr('disabled');
							clas = "btn btn-success";
							icon = "fa fa-check";
							text = "EXCELENTE";
							func = "2";
						}
						$("#idcliente").val(data[0].idcliente);
						$("#cliente").val(data[0].apellidos+", "+data[0].nombres);
						$("#panelmorosidad").empty().html(morosidad1);
						

						btn = "<button type='button' onclick=\"vermoroso('"+func+"','"+est+"')\" class='"+clas+"'>";
	                    btn+= "<i class='"+icon+"'></i> "+text;
	                    btn+= "</button>";

	                    $("#estcli").html(btn);
	                    if(morosidad2.length>0){
	                    	
	                    	alerta("Cliente Moroso","No se podra registrar Alquiler","error");
	                    }
	                   
						$("#estcli").show();
					}
				},"json");
			});
		},"json");
	}
	
}

function form_cliente(){
	$.get(url+"cliente/form_cli/", function(data) {
		$("#mCliente").empty().html(data);
		$("#modalFormulario").modal("show");
	});
}
function save_cliente(){
	labels = ['tipodocumento','nrodocumento','nombres','apellidos','nacionalidad','ocupacion','fechanac','sexo','telefono'];
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
			url: url+'cliente/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("form").serialize(),
			success: function(data){
				console.log(data);
				$('#modalFormulario').modal('hide');
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}
	
	
}
function alquilar(id){
	$.get(url+controlador+"/form_alquiler/"+id, function(data) {
		$("#tableList").empty().html(data);
		$("#panelmorosidad").hide();
		$("#panelmensual").hide();
		$("#estcli").hide();
	});
}

function cambiartipoalquiler(){
	idtipoalquiler = $("#idtipoalquiler").val();
	console.log(idtipoalquiler);
	if(idtipoalquiler == '3'){
		$.get(url+controlador+"/monto_mensual/"+$("#precioxdia").val(), function(data) {
			$("#pagoinicial").val(data);
			$("#panelmensual").show();
		},"json");
		
	}else{
		$("#panelmensual").hide();
	}
}

function cambiofecha(){
	$.get(url+controlador+"/fecha_mensual/"+$("#fecha").val(), function(data) {
		$("#fecha_fin").val(data);
	},"json");
}

function reservar(id){
	$("#idhabitacion").val(id);
	$("#modalFormulario").modal("show");
}

function save_reserva(){
	labels = ['idcliente','cliente','fecha'];
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
			url: url+controlador+'/reservar',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form_res").serialize(),
			success: function(data){
				alerta("Reservacion Exitosa",'Se realizo correctamente la reservacion','success');
				$("#idhabitacion").val("");
				$("#idcliente").val("");
				$("#al_dni").val("");
				$("#cliente").val("");
				$("#fecha").val("");
				$('#modalFormulario').modal('hide');
				init();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}
}

function detalle(id){
	$.get(url+controlador+"/form_detalle/"+id, function(data) {
		$("#detalleHAB").empty().html(data);
		$('#estancia').dataTable();
		$('#compras').dataTable();
		$('#imprevistos').dataTable();
		deudageneral = parseFloat($("#deudaxhabitacion").val())+parseFloat($("#deudacompras").val())+parseFloat($("#deudaimprevisto").val());
		$("#deutotal").val(deudageneral.toFixed(2));
		$("#modalDetalle").modal("show");

	});
	
}

function salir(id){
	$.get(url+controlador+"/form_salir/"+id, function(data) {
		$("#salirHAB").empty().html(data);
		deudageneral = parseFloat($("#deudaxhabitacion").val())+parseFloat($("#deudacompras").val())+parseFloat($("#deudaimprevisto").val());
		$("#deutotal").val(deudageneral.toFixed(2));
		$("#modalSalir").modal("show");
	});
}

function cancelar(ids){
	$("#cancelar_id").val(ids);
	$.ajax({
		url: url+controlador+'/cancelar_reservacion',
		type: 'POST',
		dataType: 'JSON',
		data: $("#cancelar").serialize(),
		success: function(data){
			alerta("Reservacion Cancelada",'Se cancelo correctamente la reservacion','success');
			init();
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR);
			alerta("Error de Guardado",errorThrown,'error');
		}
	});

}

function ver(s,id){
	if(s=='3'){
		$.get(url+controlador+'/ver_reservacion/'+id, function(data) {
			html = "";
			html += " <p><strong>N° Habitacion: </strong> "+data[0].nrohabitacion+"</p>";
			html += " <p><strong>Cliente: </strong> "+data[0].apellidos+", "+data[0].nombres+"</p>";
			html += " <p><strong>Fecha: </strong> "+data[0].fecha+"</p>";
			$("#detalle_reserva").html(html);
		
			$("#modalDetalleReserva").modal("show");
		},"json");	
	}
}

function alquilar_reservacion(id){
	$.get(url+controlador+'/ver_reservacion/'+id, function(data_res) {
		$.get(url+controlador+"/form_alquiler/"+id, function(data) {

			$("#tableList").empty().html(data);
			$("#idcliente").val(data_res[0].idcliente);
			$("#al_dni").val(data_res[0].nrodocumento);
			$("#idreserva").val(data_res[0].idreserva);
			$("#cliente").val(data_res[0].apellidos+", "+data_res[0].nombres);

		});
	},"json");
}

function pagartodo(val){
	
	$("#est").val(val);
	$("#btn_desocuparhabitacion").attr("disabled",true);
	$.ajax({

		url: url+controlador+'/pagartodo',
		type: 'POST',
		dataType: 'JSON',
		data: $("#form_pagartodo").serialize(),
		success: function(data){
			alerta("Habitacion Desocupada",'Se desocupo la habitacion, proceda a limpiar','success');
			$("#modalSalir").modal("hide");
			$("#btn_desocuparhabitacion").removeAttr("disabled");
			init();
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR);
			alerta("Error de Guardado",errorThrown,'error');
		}
	});	

}