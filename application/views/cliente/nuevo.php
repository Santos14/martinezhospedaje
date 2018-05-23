<form id="form" class="form-horizontal form-label-left form-material">
<input type="hidden" name="id" id="id">
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">
        Nombres
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese Nombre" required maxlength="100">
    </div>
</div>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido">
        Apellidos
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingrese Apellido" required maxlength="100">
    </div>
</div>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="tipodocumento">
        Tipo Documento
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <select class='form-control form-control-line' name="tipodocumento">
            <option value="">Seleccione...</option>
            <option value="0">DNI</option>
            <option value="1">Pasaporte</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="nrodocumento">
        Nro Documento
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="text" id="nrodocumento" name="nrodocumento" class="form-control" placeholder="Ingrese Nro Documento">
    </div>
</div>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="nacionalidad">
        Nacionalidad
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="text" id="nacionalidad" name="nacionalidad" class="form-control" placeholder="Ingrese Nacionalidad" required maxlength="50">
    </div>
</div>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="ocupacion">
        Ocupacion
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input type="text" id="ocupacion" name="ocupacion" class="form-control" placeholder="Ingrese Ocupacion" required maxlength="50">
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
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">
        Telefono
    </label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input onkeypress="return solonumeros(event)" type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese Telefono" required maxlength="9">
    </div>
</div>
</form>