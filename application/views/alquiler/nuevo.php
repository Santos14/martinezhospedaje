<form id="form_al" class="form-horizontal form-label-left form-material">
    <input type="hidden" name="id" id="id">
    <input type="hidden" name="idreserva" id="idreserva">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Formulario de Alquiler</h3>
                <input type="hidden" name="idhabitacion" id="idhabitacion" value="<?= $habitacion[0]->idhabitacion ?>">
                <p class="text-muted">Llene todos los campos para proceder con el Alquiler</p>
              
                 <legend>Datos de la Habitacion</legend>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                        Nro. Habitacion
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input id="habitacion" name="habitacion" class="form-control" value="<?= $habitacion[0]->nrohabitacion ?>" readonly>
                    </div>
                    <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="precioxdia">
                        Precio(S/.)
                    </label>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input id="precioxdia" name="precioxdia" id="precioxdia" class="form-control" value="<?= $habitacion[0]->precio ?>">
                    </div>
                </div>
                  <legend>Datos del Huesped</legend>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                        Cliente
                    </label>
                    <input type="hidden" name="idcliente" id="idcliente">
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input onblur="searchdni(this)" id="al_dni" name="al_dni" class="form-control" value="" placeholder="Nro Documento">
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input id="cliente" name="cliente" readonly class="form-control" value="" placeholder="Cliente">
                    </div>

                    

                    <div class="col-md-2 col-sm-6 col-xs-12" id="estcli" style="display: none">
                        
                    </div>

                    

  
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <button onclick="search_cliente('1')" type="button" class='btn btn-info'>
                            <i class="fa fa-search"></i>    
                        </button>
                        <button onclick="form_cliente()" type="button" class='btn btn-info'>
                            <i class="fa fa-plus"></i>    
                        </button>
                    </div>
                </div>


                <div id="observaciones_alquiler" style="width: 65%;margin-left: 25%;display: none;">
                    
                </div>


                <div id="panelmorosidad" style="display: none">
                    
                </div>

                <legend>Datos de los Acompañantes</legend>


                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="producto">
                        Acompañante
                    </label>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" id="nomacompaniante" name="nomacompaniante" class="form-control" placeholder="Nombres y Apellidos">
                    </div>
                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="monto">
                        DNI
                    </label>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" id="dni_acom" name="dni_acom" class="form-control" placeholder="DNI">
                    </div>
                    <div class="col-md-1 col-sm-6 col-xs-12 text-center" id='config_acompaniante'>
                        <button type="button" onclick="addacompaniante('','')" class='btn btn-info'>
                            <i class="fa fa-plus"></i> Agregar
                        </button>               
                    </div>
                    <div class="col-md-1 col-sm-6 col-xs-12" id="btn_acompaniante"></div>
                </div>


                <table class='table table-striped table-bordered' style="width: 60%; margin: 0 auto;">
                    <thead>
                        <tr>
                            <th class='text-center'>ID</th>
                            <th class='text-center'>Acompañante</th>
                            <th class='text-center'>DNI</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody id='listaacompaniante'>

                    </tbody>
                </table>



                
                <legend>Datos del Alquiler</legend>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idtipoalquiler">
                        Tipo Alquiler
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line' id="idtipoalquiler" name="idtipoalquiler" onchange="cambiartipoalquiler()">
                            <option value="">Seleccione...</option>
                        <?php foreach ($tipo_alquileres as $tipo):?>
                            <option value="<?= $tipo->idtipoalquiler ?>"><?= $tipo->descripcion ?></option>
                        <?php endforeach;?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idmotivoviaje">
                        Motivo Viaje
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line' id="idmotivoviaje" name="idmotivoviaje">
                            <option value="">Seleccione...</option>
                        <?php foreach ($motivo_viaje as $tipo):?>
                            <option value="<?= $tipo->idmotivoviaje ?>"><?= $tipo->descripcion ?></option>
                        <?php endforeach;?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idprocedencia">
                        Procedencia
                    </label>
                    <div class="col-md-2">
                        <input type="checkbox" onclick="cambiarprocedencia(this)" checked name="c_nacional" id="c_nacional"> Nacional
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line' name="idprocedencia" id="idprocedencia">
                            <option value="">Seleccione...</option>
                             <?php foreach ($tipo_procedencia as $tipo):?>
                            <option value="<?= $tipo->idprocedencia ?>"><?= $tipo->lugar ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="localidad">
                        Localidad
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <input type="text" placeholder="Ingrese Localidad de Procedencia" id="localidad" name="localidad" class="form-control" maxlength="200" >
                    </div>
                    <label  class="control-label col-md-1 col-sm-3 col-xs-12" for="kit">
                        KIT
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line' name="kit">
                            <option value="">Seleccione...</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                </div>
                
    
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">
                        Fecha Ingreso
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="date" onblur="cambiofecha()" max="<?= date("Y-m-d") ?>" name="fecha" id="fecha" class="form-control" value="<?= date("Y-m-d") ?>">
                    </div>
                    <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="hora">
                        Hora Ingreso
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="time" id="hora" name="hora" class="form-control" value='<?= date("H:i:s") ?>'>
                    </div>
                </div>

                <div class="form-group" id='panelmensual' style="display:none;">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_fin">
                        Fecha Termino
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input readonly type="date" max="<?= date("Y-m-d") ?>" name="fecha_fin" id="fecha_fin" class="form-control" value="<?= date ('Y-m-d',strtotime('+30 days',strtotime(date("Y-m-d")))) ?>">
                    </div>
                    <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="hora_fin">
                        Hora Termino
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input readonly type="time" id="hora_fin" name="hora_fin" class="form-control" value='<?= $horatermino.":00:00" ?>'>
                    </div>
                </div>
                
                <legend>Metodo de Pago</legend>
                
                <div class="form-group">
                    
                   <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fpago">
                        Forma de Pago
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line'onchange="cambiarMetodoPago(this)" name="fpago" id="fpago">
                            <option value="0">Seleccione...</option>
                            <option value="1">Dinero</option>
                            <?php if($isMarketingPuntos){ ?>
                            <option value="2">Puntos Martinez</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div id="pagoefectivo" style="display: none">
                    <div class="form-group">
                        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="pagoinicial">
                            Pago Inicial(S/.)
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input onblur="validadinero()" type="text" id="pagoinicial" name="pagoinicial" class="form-control" maxlength="100" value='0'>
                        </div>
                    </div>
                </div>
                <div id="pagopuntos" style="display: none">
                    <div class="form-group">
                        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="totalpuntos">
                            Puntos Acumulados
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="text" id="totalpuntos" readonly name="totalpuntos" class="form-control" maxlength="100" value='0'>
                        </div>
                        <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="pagopuntos">
                            Pago Inicial (Puntos)
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input onblur="validapuntos()" type="text" id="montopagopuntos" name="montopagopuntos" class="form-control" maxlength="100" value='0'>
                        </div>
                    </div>
                </div>
                
                

                
                
                <?php if($isMarketingPuntos){ ?>
                
                <div id="panelrecomendacion">
                    <legend>Recomendaciones de Servicios</legend>

                    <div class="form-group">
                       <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="c_idcliente">
                           Recomendado por:
                       </label>
                       <input type="hidden" name="c_idcliente" id="c_idcliente">
                       <div class="col-md-2 col-sm-6 col-xs-12">
                           <input onblur="searchdni_cliente(this)" id="c_dni" name="c_dni" class="form-control" value="" placeholder="Nro Documento Cliente">
                       </div>
                       <div class="col-md-3 col-sm-6 col-xs-12">
                           <input id="c_cliente" name="c_cliente" readonly class="form-control" value="" placeholder="Nombre Completo Cliente">
                       </div>

                       <div class="col-md-1 col-sm-6 col-xs-12">
                           <button onclick="search_cliente('2')" type="button" class='btn btn-info' id="btn_cliente_recomendador">
                               <i class="fa fa-search"></i>    
                           </button>
                       </div>
                       <div class="col-md-1 col-sm-6 col-xs-12">
                           <input onclick="anonimorecomendador(this)" type="checkbox" id="a_cliente" name="a_cliente"/>
                           Anonimo
                       </div>
                   </div>

                   <div class="form-group">
                       <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="t_idtransportista">
                           Transportista:
                       </label>
                       <input type="hidden" name="t_idtransportista" id="t_idtransportista">
                       <div class="col-md-2 col-sm-6 col-xs-12">
                           <input onblur="searchdni_transportista(this)" id="t_dni" name="t_dni" class="form-control" value="" placeholder="Nro Documento Transportista">
                       </div>
                       <div class="col-md-3 col-sm-6 col-xs-12">
                           <input id="t_transportista" name="t_transportista" readonly class="form-control" value="" placeholder="Nombre Completo Transportista">
                       </div>

                       <div class="col-md-1 col-sm-6 col-xs-12">
                           <button onclick="search_transportista()" type="button" class='btn btn-info' id="btn_transportista_recomendador">
                               <i class="fa fa-search"></i>    
                           </button>
                       </div>
                       <div class="col-md-1 col-sm-6 col-xs-12">
                           <input onclick="anonimotrasportista(this)"  type="checkbox" id="a_transportista" name="a_transportista"/>
                           Anonimo
                       </div>
                   </div>
                 </div>
                 
                <?php } ?>
                 
                 
                 <div class="text-center">
                    <button type="button" class="btn btn-default" onclick="window.location='<?= base_url('alquiler') ?>'">
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-success" onclick="save('<?php echo $isMarketingPuntos ?>')" id='btn_save_alquiler'>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
   
</form>

<div id="modalFormulario" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">Formulario Cliente</h4>
            </div>
            <div class="modal-body" id='mCliente'>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" id="btn_add_cliente" onclick="save_cliente()">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL CLIENTE REUTILIZABLE (NUEVO.php) -->
<div id="modalListaClientes" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">LISTA DE CLIENTES</h4>
            </div>
            <div class="modal-body" id="showListClient">
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
               
            </div>
        </div>
    </div>
</div>

<div id="modalListaTransportista" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">LISTA DE TRANSPORTISTAS</h4>
            </div>
            <div class="modal-body" id="showListTransportista">
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
               
            </div>
        </div>
    </div>
</div>
<!-- MODAL ENCARGOS -->
<div id="modalEncargos" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">LISTA DE ENCARGOS</h4>
            </div>
            <div class="modal-body" id="showEncargos">
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
               
            </div>
        </div>
    </div>
</div>
<!-- MODAL ACOMPANIANTE -->
<div id="modallistaacompaniante" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">LISTA DE ACOMPANIANTE</h4>
            </div>
            <div class="modal-body" id="showAcompaniantes">
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
               
            </div>
        </div>
    </div>
</div>