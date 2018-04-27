<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tabla Imprevistos</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a onclick="form_add()" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Nuevo

                </a>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Imprevisto</li>
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
                <h4 class="modal-title" id="title_form">Formulario Imprevisto</h4>
            </div>
            <div class="modal-body">
               

    <input type="hidden" name="id" id="id">
    <input type="hidden" name="idalquiler" id="idalquiler">
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idhabitacion">
            Habitacion Ocupadas
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <select class='form-control form-control-line' name="idhabitacion" id="idhabitacion" onchange="buscarCli()">
                <option value="">Seleccione...</option>
                <?php foreach ($hab_ocupadas as $val): ?>
                <option value="<?= $val->idhabitacion ?>"><?= $val->nrohabitacion ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-5 col-sm-6 col-xs-12">
            <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Cliente Actual" readonly maxlength="100">
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idtipoimprevisto">
            Tipo Imprevisto
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <select class='form-control form-control-line' name="idtipoimprevisto" id="idtipoimprevisto">
                <option value="">Seleccione...</option>
                <?php foreach ($tipoimprevisto as $val): ?>
                <option value="<?= $val->idtipoimprevisto ?>"><?= $val->descripcion ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">
            Fecha
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="date" id="fecha" name="fecha" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="monto">
            Monto
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" id="monto" name="monto" class="form-control" placeholder="Ingrese Monto">
        </div>
    </div>

    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="imp_pagado">
            Pagar
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="checkbox" id="imp_pagado" name="imp_pagado">
        </div>
    </div>

    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="save()" id='btn_save_imprevisto'>
                    Aceptar
                </button>
            </div>
        </div>
        </form>
    </div>
</div>