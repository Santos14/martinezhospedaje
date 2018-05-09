$(document).ready(function () {
 	init();
});
var controlador = "venta";
var text = "Ventas";
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
	$.get(url+controlador+'/form_nuevo', function(data) {
		$("#tableList").empty().html(data);
	});
}
function form_detalle(id){
	$("#title_form").text("Detalle Venta");
	$.get(url+controlador+'/detalle_venta/'+id, function(data) {
		$("#listProductos").empty().html(data);
		$("#modalDetalle").modal("show");
	});
}

function buscarCli(){
	idhabitacion = $("#idhabitacion").val();
	console.log(idhabitacion);
	$.get(url+"cliente/clienteActual/"+idhabitacion, function(data) {
		$("#idalquiler").val(data[0].idalquiler);
		$("#cliente").val(data[0].apellidos+", "+data[0].nombres);
	},"json");
}

function cambiarCli(c){
	if(c.checked){
		$("#cli_interno").show();
	}else{
		$("#cli_interno").hide();
	}

}

function mostrarProductos(){
	$("#productoslista").dataTable();
	$("#modalProducto").modal("show");
}

function aproducto(id,nombre){
	$("#idproducto").val(id);
	$("#producto").val(nombre);
	$("#modalProducto").modal("hide");
}
filatableproducto = 1;
function addproducto(){
	if($("#producto").val()!="" && $("#monto").val()!=""){
		if(!isNaN($("#monto").val())){
			fila = "<tr class='productos' id='f"+filatableproducto+"'>";
	        fila +="<td><input type='hidden' name='idproducto[]' value='"+$("#idproducto").val()+"'>"+filatableproducto+"</td>";
	        fila +="<td>"+	$("#producto").val();+"</td>";
	        fila +="<td><input type='text' style='border:none;background:none;' id='p"+filatableproducto+"' name='precio[]' value='"+parseFloat($("#monto").val()).toFixed(2)+"'></td>";
	        fila +="<td><button onclick=\"removeproducto('"+filatableproducto+"')\" type='button' class='btn btn-danger'><i class='fa fa-trash-o'></i></button></td>";
	        fila +="</tr>";
			$("#listaproducto").append(fila);
			
			$("#totalventa").val((parseFloat($("#totalventa").val())+parseFloat($("#monto").val())).toFixed(2));
			$("#idproducto").val("");
			$("#producto").val("");
			$("#monto").val("");
			filatableproducto++;
		}else{
			alerta("Monto ingresado no Valido","El monto ingresado para el producto no es valido","error");
		}
		
	}else{
		alerta("Campos Vacios","Llene los campos correspondientes","error");
	}
}

function removeproducto(id){
	$("#totalventa").val((parseFloat($("#totalventa").val())-parseFloat($("#p"+id).val())).toFixed(2));
	$("#f"+id).remove();
}

function save(){
	enviar = false;
	if($("#tipocliente").is(':checked')){
		labels = ['idhabitacion','cliente','fecha','hora'];
		fallas = true;
		
		for (var i = 0; i < labels.length; i++) {
			if($("[name='"+labels[i]+"']").val() == ""){
				fallas = false;
				alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
				break;
			}
		}
		if(fallas){
			op = true;
			if($(".productos").length==0){
				op = false;
				alerta("No hay Productos","No hay productos asignados a la Venta",'error');
			}

			if(op){
				enviar = true;
			}
		}
		
	}else{
		labels = ['fecha','hora'];
		fallas = true;
		
		for (var i = 0; i < labels.length; i++) {
			if($("[name='"+labels[i]+"']").val() == ""){
				fallas = false;
				alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
				break;
			}
		}
		if(fallas){
			op = true;
			if($(".productos").length==0){
				op = false;
				alerta("No hay Productos","No hay productos asignados a la Venta",'error');
			}

			if(op){
				enviar = true;
			}	
		}
		
	}
	if(enviar){

		$("#btn_save_venta").attr("disabled",true);
		$.ajax({
			url: url+controlador+'/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form").serialize(),
			success: function(data){
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				$("#btn_save_venta").removeAttr("disabled");
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
