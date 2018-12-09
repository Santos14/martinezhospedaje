$(document).ready(function () {
 	init();
});

var controlador = "transportista";
var text = "Mototaxista";
var idglobal;
var table;

function init(){
	$.get(url+controlador+"/tableList", function(data) {
		$.get(url+controlador+"/form_cli", function(form) {
			$("#tableList").empty().html(data);
			$("#form_cli").empty().html(form);
			$('#datatable').dataTable();
		});
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
			$('[name="id"]').val(data[0].idtransportista);
			$('[name="dni"]').val(data[0].dni);
			$('[name="nombres"]').val(data[0].nombres);
			$('[name="apellidos"]').val(data[0].apellidos);
			$('[name="direccion"]').val(data[0].direccion);
			$('[name="telefono"]').val(data[0].telefono);
			$('[name="sexo"]').val(data[0].sexo);
			$('[name="fechanac"]').val(data[0].fechanac);
			$('[name="placa_vehiculo"]').val(data[0].placa_vehiculo);
			$("#modalFormulario").modal("show");
		}else{
			alerta("Error al Extraer Datos","","danger");
		}
	},"json");
}

function save(){
	labels = ['dni','nombres','apellidos','direccion','telefono','sexo','fechanac','placa_vehiculo'];
	fallas = false;
	for (var i = 0; i < labels.length; i++) {
		if($("[name='"+labels[i]+"']").val() == ""){
			fallas = true;
			alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
			break;
		}
	}
	if(!fallas){
		$("#btn_save_cliente_cli").attr("disabled",true);
		$.ajax({
			url: url+controlador+'/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("form").serialize(),
			success: function(data){
				console.log(data);
				$('#modalFormulario').modal('hide');
				$("#btn_save_cliente_cli").removeAttr("disabled");
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				init();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}
	
	
}

function buscarDNIRepetido(){
    var dni = $("#dni").val();
    if(dni !=''){
        $.get(url+controlador+"/ajax_searchdni/"+dni, function(data) {
            if(data.length>0){
                alerta("EL DNI ya existe",'Se registro un Mototaxista con este DNI','warning');
                $("#btn_save_transportista_cli").attr("disabled",true);
            }else{
                $("#btn_save_transportista_cli").removeAttr("disabled");
            }
        },'json');
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
