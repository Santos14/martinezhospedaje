<form id="form" class="form-horizontal form-label-left form-material">
<input type="hidden" name="id" id="id">
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Habitacion</h3>
            <p class="text-muted">Llene los datos necesarios para la Habitacion</p>

            <div class="form-group">
                <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="nrohabitacion">
                    Nro. Habitacion
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <input type="text" id="nrohabitacion" name="nrohabitacion" class="form-control" placeholder="Ingrese Nro. de Habitacion" maxlength="100">
                </div>
            </div>
            <div class="form-group">
                <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idtipohabitacion">
                    Tipo Habitacion
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
               
                    <select class='form-control form-control-line' name="idtipohabitacion">
                        <option value="">Seleccione...</option>
                    <?php foreach ($tipohabitacion as $tipo):?>
                        <option value="<?= $tipo->idtipohabitacion ?>"><?= $tipo->descripcion ?></option>
                    <?php endforeach;?>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="precio">
                    Precio
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <input type="text" id="precio" name="precio" class="form-control" placeholder="Ingrese Precio de Habitacion">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="space_servicio">
    
</div>

<div id="space_elemento">
    
</div>

<div class="text-center">
    <button type="button" class="btn btn-danger" onclick="window.location='<?= base_url("habitacion") ?>'">
        Cancelar
    </button> 
   <button type="button" class="btn btn-success" onclick="save()" id='btn_save'>
        Guardar
    </button> 
</div>


</form>




