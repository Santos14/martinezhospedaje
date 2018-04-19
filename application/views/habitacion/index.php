<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tabla Habitacion</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a  onclick="form_add()" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Nuevo

                </a>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Habitacion</li>
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
<!--ELIMINAR SERVICIO-->
<div id="modalEliminarServicio" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¿Desea Eliminar el Registro?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="serv_delete();">
                    Eliminar
                </button>
            </div>
        </div>

    </div>
</div>
<!--ELIMINAR ELEMENTO-->
<div id="modalEliminarElemento" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¿Desea Eliminar el Registro?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="elem_delete();">
                    Eliminar
                </button>
            </div>
        </div>

    </div>
</div>

<!--FORMULARIO SERVICIO-->
<div id="modalServicio" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <form id="form_servicio" class="form-horizontal form-label-left form-material">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form_serv">Formulario Servicio</h4>
            </div>
            <div class="modal-body">
               

    <input type="hidden" name="serv_id" id="serv_id">
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="serv_descripcion">
            Servicio
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" id="serv_descripcion" name="serv_descripcion" class="form-control" placeholder="Ingrese Servicio" maxlength="100">
        </div>
    </div>
    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="save_servicio()" id='btn_save_serv'>
                    Aceptar
                </button>
            </div>
        </div>
        </form>
    </div>
</div>

<div id="modalElemento" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <form id="form_elemento" class="form-horizontal form-label-left form-material">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form_elem">Formulario Elemento</h4>
            </div>
            <div class="modal-body">
               

    <input type="hidden" name="elem_id" id="elem_id">
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="elem_descripcion">
            Elemento
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" id="elem_descripcion" name="elem_descripcion" class="form-control" placeholder="Ingrese Elemento" required maxlength="100">
        </div>
    </div>
    
    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="save_elemento()" id='btn_save_elem'>
                    Aceptar
                </button>
            </div>
        </div>
        </form>
    </div>
</div>


<!--FORMULARIO ESTADO-->
<div id="modalEstado" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <form id="form_cambio_estado" class="form-horizontal form-label-left form-material">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form_serv">Cambiar Estado</h4>
            </div>
            <div class="modal-body">
               
            <input type="hidden" name="idhabitacion" id="idhabitacion">
            <div class="form-group">
                <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="c_estado">
                    Estado
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                      <select class='form-control form-control-line' name="c_estado">
                            <option value="">Seleccione...</option>
                            <option value="1">Libre</option>
                            <option value="2">Ocupado</option>
                            <option value="3">Reservado</option>
                            <option value="5">Eventual</option>
                            <option value="6">Mensual</option>
                            <option value="4">Inactivo</option>
                        </select>
                </div>
            </div>
            

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="cambiar_estado()" id='btn_cambiar_estado'>
                    Aceptar
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
<div id="modalver" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content" id="detallever">
            
        </div>
    </div>
</div>
