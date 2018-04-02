<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tabla Politicas</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a onclick="form_add()" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Nuevo

                </a>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Politicas</li>
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
                <h4 class="modal-title" id="title_form">Formulario Politicas</h4>
            </div>
            <div class="modal-body">
               

    <input type="hidden" name="id" id="id">
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">
            Fecha
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="date" id="fecha" name="fecha" class="form-control" >
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="descripcion">
            Politica
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese Politica" maxlength="100">
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="numero">
            Valor Numerico
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" id="numero" name="numero" class="form-control" placeholder="Ingrese Valor Numerico">
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="unidad_medida">
            Unidad de Medida
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" id="unidad_medida" name="unidad_medida" class="form-control" placeholder="Ingrese Unidad de Medida" maxlength="20">
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