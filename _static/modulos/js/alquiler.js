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

function buscarDNIRepetido(){
    var dni = $("#nrodocumento").val();
    if(dni !=''){
        $.get(url+"cliente/ajax_searchdni/"+dni, function(data) {
            if(data.length>0){
                alerta("EL DNI ya existe",'Se registro un cliente con este DNI','warning');
                $("#btn_add_cliente").attr("disabled",true);
            }else{
                $("#btn_add_cliente").removeAttr("disabled");
            }
        },'json');
    }
    
}

function search_cliente(op){
    $.get(url+"cliente/clientListModal/"+op, function(data) {
            $("#showListClient").empty().html(data);
            $('#clientes').dataTable();
            $("#modalListaClientes").modal("show");
    });
}

function search_transportista(){
    $.get(url+"transportista/transportistaListModal", function(data) {
            $("#showListTransportista").empty().html(data);
            $('#transportista').dataTable();
            $("#modalListaTransportista").modal("show");
    });
}




filatableacomp = 1;
function addacompaniante(nombre,nrodoc){
        if(nombre=="" && nrodoc==""){
            nombre = $("#nomacompaniante").val();
            nrodoc = $("#dni_acom").val();
        }
        
	if(nombre!="" && nrodoc!=""){
		
            fila = "<tr class='acompaniante' id='f"+filatableacomp+"'>";
            fila +="<td class='text-center'>"+filatableacomp+"</td>";
            fila +="<td class='text-center'><input type='hidden' name='nombres_acomp[]' value='"+nombre+"'>"+nombre+"</td>";
            fila +="<td class='text-center'><input type='hidden' name='dni_acomp[]' value='"+nrodoc+"'>"+nrodoc+"</td>";
            fila +="<td class='text-center'><button onclick=\"removeproducto('"+filatableacomp+"')\" type='button' class='btn btn-danger'><i class='fa fa-trash-o'></i></button></td>";
            fila +="</tr>";

            $("#listaacompaniante").append(fila);
            
            if(nombre=="" && nrodoc==""){
                $("#nomacompaniante").val("");
                $("#dni_acom").val("");
            }else{
                $("#modallistaacompaniante").modal("hide");
            }
            
            

            filatableacomp++;
		
		
	}else{
		alerta("Campos Vacios","Llene los campos correspondientes","error");
	}
}

function removeproducto(id){
	
	$("#f"+id).remove();
}


function seleccionaCliente(idcliente,nombre,apellido,nrodoc,tipodoc){
	$.get(url+"alquiler/ajax_morosidad/"+idcliente+"/1", function(morosidad1) {
	$.get(url+"alquiler/ajax_morosidad/"+idcliente+"/2", function(morosidad2) {
	$.get(url+"alquiler/ultimo_alquiler/"+idcliente, function(ultimo_alquiler) {
        $.get(url+"encargo/encargoCliente/"+nrodoc, function(data_encargo) {
        $.get(url+"alquiler/totalpuntos/C/"+idcliente, function(data_puntos) {
            
        
            
            // ASIGNACIN DE DATOS DEL CLIENTE
            
            $("#idcliente").val(idcliente);
            $("#al_dni").val(nrodoc);
            $("#cliente").val(apellido+", "+nombre);
            $("#panelmorosidad").empty().html(morosidad1);    
            
            // CONFIGURACIONES PARA MOSTRAR LA MOROSIDAD

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
            btn = "<button type='button' onclick=\"vermoroso('"+func+"','"+est+"')\" class='"+clas+"'>";
            btn+= "<i class='"+icon+"'></i> "+text;
            btn+= "</button>";

            $("#estcli").html(btn);

            // MOSTRAR OBSERVACIONES DEL ULTIMO ALQUILER
            
            if(ultimo_alquiler.length != 0){
                    if(ultimo_alquiler[0].evaluacion == ""){
                            op = "No se registraron Observaciones en el Ultimo Alquiler";
                            clase = "alert alert-info";
                    }else{
                            clase = "alert alert-warning";
                            op = ultimo_alquiler[0].evaluacion;
                    }

                    obser = "<div class='"+clase+"'>";
                    obser +="<strong>Ultima Observacion: </strong>"+op;
                    obser +="</div>";

                    $("#observaciones_alquiler").html(obser);
            }
            
            // DATOS DE ENCARGO 
             
            if(data_encargo.length != 0){
                //console.log(encargo);
                enc = [];
                for (var i = 0; i < data_encargo.length; i++) {
                    enc[i] = data_encargo[i]; 
                }
                encargo  = "&nbsp;&nbsp;";
                encargo += "<button type='button' class='btn btn-secondary' onclick=\"mostrarEncargos('"+nrodoc+"')\">";
                encargo +="<i class='fa fa-briefcase' aria-hidden='true'></i>";
                encargo +="</button>";
                $("#estcli").append(encargo);
            }
            
            // ALERTA CLIENTE MOROSO
                       
            if(morosidad2.length>0){

                    alerta("Cliente Moroso","No se podra registrar Alquiler","error");
            }

            $("#estcli").show();
            
            $("#modalListaClientes").modal("hide");
            
            // CREAR BOTON DE MODAL DE ACOMPAÑIANTE
            
            btn_acomp  = "";
            btn_acomp += "<button type='button' class='btn btn-success' onclick=\"mostrarMAcomp('"+nrodoc+"')\">";
            btn_acomp +="<i class='fa fa-users' aria-hidden='true'></i>";
            btn_acomp +="</button>";
            
            $("#btn_acompaniante").html(btn_acomp);

            //CARGAR DATOS DE ALQUILER ANTERIOR
            $("#idtipoalquiler").val(ultimo_alquiler[0].tipoalquiler_idtipoalquiler);
            
            // ACTIVAR O DESACTIVAR PANEL RECOMENDACION

            if(ultimo_alquiler[0].tipoalquiler_idtipoalquiler == '2'){
                $("#panelrecomendacion").hide();
                $("#a_cliente").attr('checked', true);
                $("#a_transportista").attr('checked', true);
            }else{
                $("#panelrecomendacion").show();
                $("#a_cliente").attr('checked', false);
                $("#a_transportista").attr('checked', false);
            }
            
            $("#idmotivoviaje").val(ultimo_alquiler[0].motivoviaje_idmotivoviaje);
            if(tipodoc == '0'){
                $("#idprocedencia").val(ultimo_alquiler[0].procedencia_idprocedencia);
                $("#localidad").val(ultimo_alquiler[0].localidad);
            }
            
            // CARGAR TOTAL PUNTOS (VERIFICAR A TRAVES DE Modal)
            $("#totalpuntos").val(data_puntos);

            // FIN DE ALQUILER ANTERIOR

            // REMOVER ATRIBUTOS STYLE
            $("#observaciones_alquiler").removeAttr("style");
           // $("#panelmorosidad").removeAttr("style");
            $("#estcli").removeAttr("style");

        },"json");
	},"json");
        },"json");
        },"json");
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


function editar_alquiler(id){
	
}
function volver_t(r){
	$(r).modal("hide");
	$("#modalopcion").modal("show");

}
function config_pasajeros(id){
	$.get(url+controlador+"/buscarAlquiler/"+id, function(data) {
		$.get(url+controlador+"/listarOpcion/"+id, function(datar) {
			$("#encabezadoT").html("<h4 style='width: 200px;' class='btn btn-primary'><strong>Cuarto N° "+data[0].nrohabitacion+"</strong></h4>");
			$("#list_option_view").empty().html(datar);
			$("#modalopcion").modal("show");
		});
	},"json");
	
}
function ver_alquiler(){
	$.get(url+controlador+"/ver_alquiler/"+$("#idalquiler_actual").val(), function(data) {
		$("#modalopcion").modal("hide");
		$("#detallever").empty().html(data);
		$("#modalver").modal("show");
	});
	
}
function anular_alquiler(){	
	if(confirm("¿Esta seguro de Anular este alquiler?")){
		$.ajax({
			url : url+controlador+"/anular_alquiler/",
			type: "POST",
			data: {'id':$("#idalquiler_actual").val()},
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
function edit_alquiler(){
	//alert($("#idalquiler_actual").val());
	$("#modalopcion").modal("hide");
	$.get(url+controlador+"/edit_alquiler/"+$("#idalquiler_actual").val(), function(data) {
		$("#tableList").empty().html(data);
		$("#panelmorosidad").hide();
		$("#panelmensual").hide();
		$("#estcli").hide();
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

function save(isMarketingPuntos){
         
    labels = ['al_dni','cliente','precioxdia','idtipoalquiler','idmotivoviaje','idprocedencia','kit','localidad', 'fecha','hora'];
    
    fallas = false;
    cont = 0;
    for (var i = 0; i < labels.length; i++) {
            if($("[name='"+labels[i]+"']").val() == ""){
                    fallas = true;
                    alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
                    break;
            }
    }
    if(!fallas){
        if($("#fpago").val()== '0'){
            alerta("Metodo de Pago Vacio","Elija el un Metodo de Pago",'error');
        }else{
            // ACTIVAR VALIDACIONES DE MARKETING PUNTOS
            if(isMarketingPuntos){
                c_rec = $("#a_cliente").is(':checked');
                t_rec = $("#a_transportista").is(':checked');
                if(!c_rec){
                    if($("[name='c_dni']").val() == ""){
                        alerta("Cliente que recomendo en Blanco","Elija el cliente que le Recomendo el Servicio",'error');
                    }else{
                        cont++;
                    }
                }else{
                    cont++;
                }
                if(cont == 1){
                    if(!t_rec){
                        if($("[name='t_dni']").val() == ""){
                            alerta("Trasportista que recomendo en Blanco","Elija el transportista que le Recomendo el Servicio",'error');
                        }else{
                            cont++;
                        }
                    }else{
                        cont++;
                    } 
                } 
            }else{
                cont = 2;
            } 
        } 
    }

    if(cont == 2){
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

function save_edit(){
	labels = ['al_dni','cliente','precioxdia','idtipoalquiler','idmotivoviaje','idprocedencia','kit','localidad','fecha','hora'];
	fallas = false;
	for (var i = 0; i < labels.length; i++) {
		if($("[name='"+labels[i]+"']").val() == ""){
			fallas = true;
			alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
			break;
		}
	}

	
	if(!fallas){
		
		$("#btn_save_alquiler_edit").attr("disabled",true);
		$.ajax({
			url: url+controlador+'/save_edit',
			type: 'POST',
			dataType: 'JSON',
			data: $("#form_al").serialize(),
			success: function(data){
				alerta("Guardado Exitoso",'Se guardo correctamente','success');
				$("#btn_save_alquiler_edit").removeAttr("disabled");
				 view_miniatura();
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
	$.get(url+"alquiler/ultimo_alquiler/"+data[0].idcliente, function(ultimo_alquiler) {
        $.get(url+"encargo/encargoCliente/"+data[0].nrodocumento, function(data_encargo) {
        $.get(url+"alquiler/totalpuntos/C/"+data[0].idcliente, function(data_puntos) {
            
        
                                      
        if(data.length>0){
            
            // CARGAR DATOS DE CLIENTE EN EL FORMULARIO ALQUILER
                
            $("#idcliente").val(data[0].idcliente);
            $("#cliente").val(data[0].apellidos+", "+data[0].nombres);
            $("#panelmorosidad").empty().html(morosidad1);
            
            // CREANDO Y ASIGNANDO CONFIGURACIONES EN CASO DE SER MOROSO
            
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
            
            btn = "<button type='button' onclick=\"vermoroso('"+func+"','"+est+"')\" class='"+clas+"'>";
            btn+= "<i class='"+icon+"'></i> "+text;
            btn+= "</button>";

            $("#estcli").html(btn);
            
            
            // EXTRAYENDO DATOS DE ULTIMO ALQUILER
            
            if(ultimo_alquiler.length != 0){
                if(ultimo_alquiler[0].evaluacion == ""){
                        op = "No se registraron Observaciones en el Ultimo Alquiler";
                        clase = "alert alert-info";
                }else{
                        clase = "alert alert-warning";
                        op = ultimo_alquiler[0].evaluacion;
                }

                obser = "<div class='"+clase+"'>";
                obser +="<strong>Ultima Observacion: </strong>"+op;
                obser +="</div>";

                $("#observaciones_alquiler").html(obser);
            }

            
            // DATOS DE ENCARGO 
             
            if(data_encargo.length != 0){
                //console.log(encargo);
                enc = [];
                for (var i = 0; i < data_encargo.length; i++) {
                    enc[i] = data_encargo[i]; 
                }
                encargo  = "&nbsp;&nbsp;";
                encargo += "<button type='button' class='btn btn-secondary' onclick=\"mostrarEncargos('"+data[0].nrodocumento+"')\">";
                encargo +="<i class='fa fa-briefcase' aria-hidden='true'></i>";
                encargo +="</button>";
                $("#estcli").append(encargo);
            }
            
             
            // ALERTA DE CLIENTE MOROSO
            
            if(morosidad2.length>0){
                alerta("Cliente Moroso","No se podra registrar Alquiler","error");
            }

            $("#estcli").show();
            
            // CREAR BOTON DE MODAL DE ACOMPAÑIANTE
            
            btn_acomp  = "";
            btn_acomp += "<button type='button' class='btn btn-success' onclick=\"mostrarMAcomp('"+data[0].nrodocumento+"')\">";
            btn_acomp +="<i class='fa fa-users' aria-hidden='true'></i>";
            btn_acomp +="</button>";
            
            $("#btn_acompaniante").html(btn_acomp);
            

            //CARGAR DATOS DE ALQUILER ANTERIOR
            
            $("#idtipoalquiler").val(ultimo_alquiler[0].tipoalquiler_idtipoalquiler);
            
            // ACTIVAR O DESACTIVAR PANEL RECOMENDACION

            if(ultimo_alquiler[0].tipoalquiler_idtipoalquiler == '2'){
                $("#panelrecomendacion").hide();
                $("#a_cliente").attr('checked', true);
                $("#a_transportista").attr('checked', true);
            }else{
                $("#panelrecomendacion").show();
                $("#a_cliente").attr('checked', false);
                $("#a_transportista").attr('checked', false);
            }
            
            $("#idmotivoviaje").val(ultimo_alquiler[0].motivoviaje_idmotivoviaje);
            if(data[0].tipodocumento == 0){
                $("#idprocedencia").val(ultimo_alquiler[0].procedencia_idprocedencia);
                $("#localidad").val(ultimo_alquiler[0].localidad);
            }
            
            // CARGAR TOTAL PUNTOS (VERIFICAR A TRAVES DE Modal)
            $("#totalpuntos").val(data_puntos);
            

            // REMOVER ATRIBUTOS STYLE
            $("#observaciones_alquiler").removeAttr("style");
            //$("#panelmorosidad").removeAttr("style");
            $("#estcli").removeAttr("style");

        }},"json");},"json");},"json");},"json");});},"json");}
	
}

function mostrarMAcomp(dni){
    // EXTRAER LOS ACOMPANIANTES SE LOS CLIENTES
    $.get(url+"cliente/acompanianteCliente/"+dni, function(view) {
        // AGREGAR VISTA AL MODAL
        $("#showAcompaniantes").empty().html(view);
        // DATATABLE
        $("#tableListacompaniante").dataTable();
        // MOSTAR EL MODAL
        $("#modallistaacompaniante").modal("show");
    });
}

function mostrarEncargos(dni){
    // EXTRAER LOS ENCARGO SE LOS CLIENTES
    $.get(url+"encargo/createTableEncargoCliente/"+dni, function(view) {
        // AGREGAR VISTA AL MODAL
        $("#showEncargos").empty().html(view);
        // MOSTAR EL MODAL
        $("#modalEncargos").modal("show");
    });
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
			alert(labels[i]);
			alerta("Campos en Blanco","Se necesita llenar todos los Campos",'error');
			break;
		}
	}
	if(!fallas){

		$("#btn_add_cliente").attr("disabled",true);
		$.ajax({
			url: url+'cliente/ajax_save',
			type: 'POST',
			dataType: 'JSON',
			data: $("form").serialize(),
			success: function(data){
				console.log(data);
				$('#modalFormulario').modal('hide');
				$("#btn_add_cliente").removeAttr("disabled");
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

	/*if(idtipoalquiler == '3'){
		$.get(url+controlador+"/monto_mensual/"+$("#precioxdia").val(), function(data) {
			$("#pagoinicial").val(data);
			$("#panelmensual").show();
		},"json");
		
	}else{
		$("#pagoinicial").val("0");
		$("#panelmensual").hide();
	}*/
        if(idtipoalquiler == '2'){
            $("#panelrecomendacion").hide();
            $("#a_cliente").attr('checked', true);
            $("#a_transportista").attr('checked', true);
            
        }else{
            $("#panelrecomendacion").show();
            $("#a_cliente").attr('checked', false);
            $("#a_transportista").attr('checked', false);
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
                $('#amortizaciones').dataTable();
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

// FUNCIONES DE RECOMENDACION (CLIENTE, MOTOTAXISTA)
function anonimorecomendador(c){
    if(c.checked){
        $("#c_dni").attr("disabled",true);
        $("#btn_cliente_recomendador").attr("disabled",true);
        
    }else{
        $("#c_dni").removeAttr("disabled");
        $("#btn_cliente_recomendador").removeAttr("disabled",true);
    }
}
function anonimotrasportista(c){
    if(c.checked){
        $("#t_dni").attr("disabled",true);
        $("#btn_transportista_recomendador").attr("disabled",true);
        
    }else{
        $("#t_dni").removeAttr("disabled");
        $("#btn_transportista_recomendador").removeAttr("disabled",true);
    }
}

function searchdni_cliente(c){
    if(c.value!=""){
        $.get(url+"cliente/ajax_searchdni/"+c.value, function(data) {
            
            $("#c_idcliente").val(data[0].idcliente);
            $("#c_cliente").val(data[0].apellidos+", "+data[0].nombres);
        },'json');
    }
    
}

function add_cliente_recomendador(id,nombre,apellido,nrodoc){
    idclientealquiler = $("#idcliente").val();
    if(idclientealquiler == id){
        alerta("Este Huesped esta Realizando el alquiler","Busque Otro Cliente que recomiende","error");
    }else{
        $("#c_idcliente").val(id);
        $("#c_dni").val(nrodoc);
        $("#c_cliente").val(apellido+", "+nombre);
        $("#modalListaClientes").modal("hide");
    }
}

function searchdni_transportista(c){
     if(c.value!=""){
        $.get(url+"transportista/ajax_searchdni/"+c.value, function(data) {
       
            $("#t_idtransportista").val(data[0].idtransportista);
            $("#t_transportista").val(data[0].apellidos+", "+data[0].nombres);
        },'json');
    }
}

function add_tranportista_recomendador(id,nombre,apellido,nrodoc){
    $("#t_idtransportista").val(id);
    $("#t_dni").val(nrodoc);
    $("#t_transportista").val(apellido+", "+nombre);
    $("#modalListaTransportista").modal("hide");
}

// FUNCIONES DE METODO DE PAGO

function cambiarMetodoPago(c){
    
    if(c.value == '1'){// METODO DINERO
       $("#pagoefectivo").show();
       $("#pagopuntos").hide();
    }else if(c.value == '2'){ // METODO PUNTOS MARTINEZ
       $("#pagoefectivo").hide();
       $("#pagopuntos").show();
    }else if(c.value == '0'){ // METODO SELECCIONE
       $("#pagoefectivo").hide();
       $("#pagopuntos").hide();
    }
}

function validapuntos(){
    tp = $("#totalpuntos").val();
    pp = $("#montopagopuntos").val();
 
    if(pp!=""){
        if(!isNaN(pp)){// ES UN NUMERO
            tnum = parseFloat(tp);
            num = parseFloat(pp);
            if(num<0){ // SI NUMERO ES MENOR A 0
                alerta("Puntos ingresados Invalido","Ingrese un Numero correcto","error");
                $("#montopagopuntos").focus();
                $("#btn_save_alquiler").attr("disabled",true);
            }else{ // SI NUMERO ES IGUAL O MAYOR A CERO
                if(num>tnum){ // SI ESCRIBE UNA CANTIDA MAYOR A LA QUE TIENE
                    alerta("Puntos Excedidos","Usted no tiene la cantidad de puntos ingresados","error");
                    $("#montopagopuntos").focus();
                    $("#btn_save_alquiler").attr("disabled",true);
                }else{ // SI ESCRIBE MONTO IGUAL O MENOR A LA QUE TIENE
                    $("#btn_save_alquiler").removeAttr("disabled");
                }
            }
        }else{ // NO ES UN NUMERO
            alerta("Puntos ingresados Invalido","Ingrese un Numero correcto","error");
            $("#montopagopuntos").focus();
            $("#btn_save_alquiler").attr("disabled",true);
        }
    }else{
        alerta("Ingrese Puntos","Ingrese un Numero de puntos","error");
        $("#montopagopuntos").focus();
        $("#btn_save_alquiler").attr("disabled",true);
    }
}

function validadinero(){
    pp = $("#pagoinicial").val();

    if(pp!=""){
        if(!isNaN(pp)){// ES UN NUMERO
            num = parseFloat(pp);
            if(num<0){ // SI MONTO ES MENOR A 0
                alerta("Monto ingresados Invalido","Ingrese un monto correcto","error");
                $("#pagoinicial").focus();
                $("#btn_save_alquiler").attr("disabled",true);
            }else{ // SI MONTO ES IGUAL O MAYOR A CERO   
                $("#btn_save_alquiler").removeAttr("disabled");
            }
        }else{ // NO ES UN NUMERO
            alerta("Monto ingresados Invalido","Ingrese un monto correcto","error");
            $("#pagoinicial").focus();
            $("#btn_save_alquiler").attr("disabled",true);
        }
    }else{
        alerta("Ingrese Monto","Ingrese un monto de pago","error");
        $("#pagoinicial").focus();
        $("#btn_save_alquiler").attr("disabled",true);
    }
}


