<form id="form_al" class="form-horizontal form-label-left form-material">
    <input type="hidden" name="id" id="id">
    <input type="hidden" name="idreserva" id="idreserva">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Formulario de Alquiler</h3>
                <input type="hidden" name="idhabitacion" id="idhabitacion" value="<?= $habitacion[0]->idhabitacion ?>">
                <p class="text-muted">Llene todos los campos para proceder con el Alquiler</p>
              
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
                        <input id="precioxdia" name="precioxdia" class="form-control" value="<?= $habitacion[0]->precio ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                        Cliente
                    </label>
                    <input type="hidden" name="idcliente" id="idcliente">
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input onkeypress="return solonumeros(event)" onblur="searchdni(this)" id="al_dni" name="al_dni" class="form-control" value="" placeholder="Nro Documento">
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input id="cliente" name="cliente" readonly class="form-control" value="" placeholder="Cliente">
                    </div>
                     <div class="col-md-2 col-sm-6 col-xs-12" id="estcli">
                        
                    </div>
                    <div class="col-md-1 col-sm-6 col-xs-12">
                        <button onclick="form_cliente()" type="button" class='btn btn-info'>
                            <i class="fa fa-plus"></i>    
                        </button>
                    </div>
                </div>

                <div id="panelmorosidad">
                    
                </div>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idtipoalquiler">
                        Tipo Alquiler
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line' name="idtipoalquiler">
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
                   
                        <select class='form-control form-control-line' name="idmotivoviaje">
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
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <input type="text" placeholder="Ingrese Localidad de Procedencia" id="localidad" name="localidad" class="form-control" maxlength="200" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="kit">
                        KIT
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line' name="kit">
                            <option value="">Seleccione...</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                    <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="pagoinicial">
                        Pago Inicial(S/.)
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="text" id="pagoinicial" name="pagoinicial" class="form-control" maxlength="100" value='0'>
                    </div>
                </div>
    
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">
                        Fecha
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="date" max="<?= date("Y-m-d") ?>" name="fecha" id="fecha" class="form-control" value="<?= date("Y-m-d") ?>">
                    </div>
                    <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="hora">
                        Hora
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="time" id="hora" name="hora" class="form-control" value='<?= date("H:i:s") ?>'>
                    </div>
                </div>
         
         
                 <div class="text-center">
                    <button type="button" class="btn btn-default" onclick="window.location='<?= base_url('alquiler') ?>'">
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-success" onclick="save()" id='btn_save_alquiler'>
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
                <button type="button" class="btn btn-success" onclick="save_cliente()">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>