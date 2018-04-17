$(document).ready(function () {
 	init();
});
var controlador = "movimiento";
var text = "Movimiento";
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
	$.get(url+controlador+"/form_nuevo", function(data) {
		$("#tableList").empty().html(data);
		//$("#newpanel").hide();
		
	});
}

function cambioTipo(){
	$.get(url+controlador+"/conceptos/"+$("#idtipomovimiento").val(), function(data) {
		console.log(data);
		$("#idconcepto").html("<option value=''>Seleccione...</option>")
		for (var i = 0; i < data.length; i++) {
			$("#idconcepto").append("<option value='"+data[i].idconcepto+"'>"+data[i].descripcion+"</option>")	
		}
	},"json");
}

function cambioConcepto(){
	$.get(url+controlador+"/listaconcepto/"+$("#idconcepto").val(), function(data) {
		$("#listaconcepto").empty().html(data);
	});	
}

function habitacion(id,total,acc){

	op = false;

	if(id!=""){
		$("#h_idalquiler").val(id);	
	}
	
	if(acc == '1'){
		if(total!=""){
			$("#h_monto").val(total);	
			op = true;
		}
	}else if(acc=='2'){
		if(total==""){
			$("#montoamortizacion").val("");
			$("#modalAmortizacion").modal("show");
		}else{
			if($("#montoamortizacion").val()!=""){
				if(!isNaN($("#montoamortizacion").val())){
					if(parseFloat($("#m"+$("#h_idalquiler").val()).val()) != 0){
						if(parseFloat($("#montoamortizacion").val())>0 && parseFloat($("#montoamortizacion").val())<=parseFloat($("#m"+$("#h_idalquiler").val()).val())){
							op = true;
							$("#h_monto").val($("#montoamortizacion").val());	
							$("#modalAmortizacion").modal("hide");
						}else{
							console.log("fuera de Rango");
							alerta("Fuera de Rango","El monto tiene que ser mayor a 0 y menor a "+$("#m"+$("#h_idalquiler").val()).val(),"error");
						}
					}else{
						if($("#montoamortizacion").val()>0){
							op = true;
							$("#h_monto").val($("#montoamortizacion").val());	
							$("#modalAmortizacion").modal("hide");
						}
					}
				}else{
					console.log("No es Numero");
					alerta("No es Numero","El valor Ingresado no es numero","error");
				}
			}else{
				console.log("Es Igual a espacio");
					alerta("Campo Vacio","Ingrese un valor al campo","error");
			}
			
		}
	}

	if(op){

		$("#btn_todo_movimiento").attr("disabled",true);
		$("#btn_amortiza_movimiento").attr("disabled",true);
		$.ajax({
			url: url+controlador+'/ajax_pagohabitacion',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form_movimiento").serialize(),
			success: function(data){
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				$("#btn_todo_movimiento").removeAttr("disabled");
				$("#btn_amortiza_movimiento").removeAttr("disabled");
				init();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}

}
function venta(id,total,accion){
	$("#v_idventa").val(id);
	$("#v_monto").val(total);
	
	$("#btn_venta_movimiento").attr("disabled",true);
	$.ajax({
		url: url+controlador+'/ajax_pagoventa',
		type: 'POST',
		dataType: 'JSON',
		data: $("#form_movimiento").serialize(),
		success: function(data){
			alerta("Guardado Exitoso",'Se guardo correctamente','success');
			$("#btn_venta_movimiento").removeAttr("disabled");
			init();
		},
		error: function(jqXHR, textStatus, errorThrown){
			alerta("Error de Guardado",errorThrown,'error');
		}
	});
}

function imprevisto(id,total){
	$("#i_idimprevisto").val(id);
	$("#i_monto").val(total);
	$("#btn_imprevisto_movimiento").attr("disabled",true);
	$.ajax({
		url: url+controlador+'/ajax_pagoimprevisto',
		type: 'POST',
		dataType: 'JSON',
		data: $("#form_movimiento").serialize(),
		success: function(data){
			alerta("Guardado Exitoso",'Se guardo correctamente','success');
			$("#btn_imprevisto_movimiento").removeAttr("disabled");
			init();
		},
		error: function(jqXHR, textStatus, errorThrown){
			alerta("Error de Guardado",errorThrown,'error');
		}
	});
}

function compras(){
	$("#btn_compras_movimiento").attr("disabled", true);
	$.ajax({
		url: url+controlador+'/ajax_compras',
		type: 'POST',
		dataType: 'JSON',
		data: $("#form_movimiento").serialize(),
		success: function(data){
			alerta("Guardado Exitoso",'Se guardo correctamente','success');
			$("#btn_compras_movimiento").removeAttr("disabled");
			init();
		},
		error: function(jqXHR, textStatus, errorThrown){
			alerta("Error de Guardado",errorThrown,'error');
		}
	});
}


function save(){
	labels = ['idtipomovimiento','idconcepto','monto'];
	fallas = false;
	for (var i = 0; i < labels.length; i++) {
		if($("[name='"+labels[i]+"']").val() == ""){
			fallas = true;
			alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
			break;
		}
	}
	if(!fallas){
		$("#btn_movimiento_general").attr("disabled",true);
		$.ajax({
			url: url+controlador+'/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form_movimiento").serialize(),
			success: function(data){
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				$("#btn_movimiento_general").removeAttr("disabled");
				init();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alerta("Error de Guardado",errorThrown,'error');
			}
		});
	}
}


// compra productos
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
		fila = "<tr class='productos' id='f"+filatableproducto+"'>";
        fila +="<td><input type='hidden' name='idproducto[]' value='"+$("#idproducto").val()+"'>"+filatableproducto+"</td>";
        fila +="<td>"+$("#producto").val()+"</td>";
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
		alerta("Campos Vacios","Llene los campos correspondientes","error");
	}
}

function removeproducto(id){
	$("#totalventa").val((parseFloat($("#totalventa").val())-parseFloat($("#p"+id).val())).toFixed(2));
	$("#f"+id).remove();
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
