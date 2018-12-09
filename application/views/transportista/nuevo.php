<form id="form" class="form-horizontal form-label-left form-material">
<input type="hidden" name="id" id="id">

<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="dni">
        DNI
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input onblur="buscarDNIRepetido()" type="text" id="dni" name="dni" class="form-control" placeholder="Ingrese Nro DNI">
    </div>
</div>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">
        Nombres
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Ingrese Nombre" required maxlength="100">
    </div>
</div>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="apellidos">
        Apellidos
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Ingrese Apellido" required maxlength="100">
    </div>
</div>

<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion">
        Direccion
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese Direccion" required maxlength="100">
    </div>
</div>

<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">
        Telefono
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input onkeypress="return solonumeros(event)" type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese Telefono" required maxlength="9">
    </div>
</div>

<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="sexo">
        Sexo
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <select class='form-control form-control-line' name="sexo">
            <option value="">Seleccione...</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fechanac">
        Fecha Nacimiento
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="date" id="fechanac" name="fechanac" class="form-control" >
    </div>
</div>

<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="placa_vehiculo">
        Placa Vehicular
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="text" id="placa_vehiculo" name="placa_vehiculo" class="form-control" placeholder="Ingrese Placa Vehiculo" required maxlength="50">
    </div>
</div>

</form>