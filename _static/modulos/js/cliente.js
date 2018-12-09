$(document).ready(function () {
 	init();
});

var controlador = "cliente";
var text = "Cliente";
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

function verhistorial(id){

	$.get(url+controlador+"/verhistorial/"+id, function(data) {
		$("#tableList").empty().html(data);
		$('#datatable').dataTable();
	});
}

function ver_alquiler(id){
	$.get(url+"alquiler/ver_alquiler/"+id, function(data) {
		$("#detallever").empty().html(data);
		$("#modalver").modal("show");
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
			$('[name="id"]').val(data[0].idcliente);
			$('[name="nrodocumento"]').val(data[0].nrodocumento);
			$('[name="tipodocumento"]').val(data[0].tipodocumento);
			$('[name="nombre"]').val(data[0].nombres);
			$('[name="apellido"]').val(data[0].apellidos);
			$('[name="nacionalidad"]').val(data[0].nacionalidad);
			$('[name="ocupacion"]').val(data[0].ocupacion);
			$('[name="fechanac"]').val(data[0].fechanac);
			$('[name="sexo"]').val(data[0].sexo);
			$('[name="telefono"]').val(data[0].telefono);
			$("#modalFormulario").modal("show");
		}else{
			alert("Error al Extraer Datos")
		}
	},"json");
}

function save(){
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
    var dni = $("#nrodocumento").val();
    if(dni !=''){
        $.get(url+controlador+"/ajax_searchdni/"+dni, function(data) {
            if(data.length>0){
                alerta("EL DNI ya existe",'Se registro un cliente con este DNI','warning');
                $("#btn_save_cliente_cli").attr("disabled",true);
            }else{
                $("#btn_save_cliente_cli").removeAttr("disabled");
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
