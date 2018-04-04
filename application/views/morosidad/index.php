<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tabla Morosidad</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a onclick="form_add()" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Nuevo

                </a>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Morosidad</li>
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
                <h4 class="modal-title" id="title_form">Formulario Tipo Habitacion</h4>
            </div>
            <div class="modal-body">
               

    <input type="hidden" name="id" id="id">
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
            Cliente
        </label>
        <input type="hidden" name="idcliente" id="idcliente">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input onkeypress="return solonumeros(event)" onblur="searchdni(this)" id="al_dni" name="al_dni" class="form-control" value="" placeholder="Nro Documento">
        </div>
        <div class="col-md-5 col-sm-6 col-xs-12">
            <input id="cliente" name="cliente" readonly class="form-control" value="" placeholder="Cliente">
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idconcepto">
            Concepto
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <select class='form-control form-control-line' name="idconcepto">
                <option value="">Seleccione...</option>
                <option value="1">Por Habitacion</option>
                <option value="4">Por Compras</option>
                <option value="9">Por Imprevistos</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="monto">
            Monto
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" id="monto" name="monto" class="form-control" placeholder="Ingrese Monto" maxlength="10">
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">
            Fecha
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="date" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>" value="<?= date("Y-m-d") ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="hora">
            Hora
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="time" id="hora" name="hora" value="<?= date("H:i:s") ?>" class="form-control">
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