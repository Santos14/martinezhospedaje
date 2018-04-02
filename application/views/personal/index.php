<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tabla Personal</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a onclick="form_add()" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Nuevo

                </a>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Personal</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <div id="tableList">
            
        </div>

        
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <footer class="footer text-center"> 2018 &copy; Hospedaje Martinez</footer>
</div>
<!-- /#page-wrapper -->
</div>

<div id="modalEliminar" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¿Desea Eliminar el Registro?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="form_delete();">
                    Eliminar
                </button>
            </div>
        </div>

    </div>
</div>



<div id="modalFormulario" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <form id="form" class="form-horizontal form-label-left form-material">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">Formulario Personal</h4>
            </div>
            <div class="modal-body">
               

    <input type="hidden" name="id" id="id">
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="descripcion">
            Cargo
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
       
            <select class='form-control form-control-line' name="idcargo">
                <option value="">Seleccione...</option>
                <?php foreach ($dataC->result() as $val): ?>
                <option value="<?= $val->idcargo ?>"><?= $val->descripcion ?></option>
                <?php endforeach; ?>
                
            </select>
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idtipopersonal">
            Tipo Personal
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
       
            <select class='form-control form-control-line' name="idtipopersonal">
                <option value="">Seleccione...</option>
                <?php foreach ($dataT->result() as $val): ?>
                <option value="<?= $val->idtipopersonal ?>"><?= $val->descripcion ?></option>
                <?php endforeach; ?>
                
            </select>
        </div>
    </div>
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
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="dni">
            DNI
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input onkeypress="return solonumeros(event)" type="text" id="dni" name="dni" class="form-control" placeholder="Ingrese DNI" required maxlength="8">
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
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">
            Telefono
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input onkeypress="return solonumeros(event)" type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese Telefono" required maxlength="9">
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion">
            Direcion
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese Direccion" required maxlength="100">
        </div>
    </div>
    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="save()" id='btn_save'>
                    Aceptar
                </button>
            </div>
        </div>
        </form>
    </div>
</div>