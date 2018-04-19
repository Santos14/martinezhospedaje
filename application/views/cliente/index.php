<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tabla Cliente</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a onclick="form_add()" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Nuevo

                </a>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Cliente</li>
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
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">Formulario Cliente</h4>
            </div>
            <div class="modal-body" id='form_cli'>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="save()" id='btn_save_cliente_cli'>
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>
    
<div id="modalver" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content" id="detallever">
            
        </div>
    </div>
</div>

