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
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="descripcion">
        Descripcion
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <textarea type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese Descripcion" rows="2"></textarea>
    </div>
    <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="monto">
        Monto
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id="monto" name="monto" class="form-control" placeholder="Ingrese Monto">
    </div>
</div>


<div class='text-center'>
	
    <button type="button" class="btn btn-success" id="btn_movimiento_general" onclick="save()">
        Guardar
    </button>
            
</div>