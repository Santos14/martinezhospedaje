<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Alquiler de Habitaciones</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Alquiler</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <div class="text-center">
            <button type="button" class='btn btn-primary' id="miniatura" onclick="view_miniatura()" >Miniaturas</button>
            <button type="button" class='btn btn-default' id="lista" onclick="view_lista()">Deudas Actuales</button>
            <button type="button" class='btn btn-default' id="alquiler" onclick="view_alquileres()">Historial</button>
        </div>
        <br>
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
        <form id="form_res" class="form-horizontal form-label-left form-material">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">Nueva Reserva</h4>
            </div>
            <div class="modal-body">
               

    <input type="hidden" name="id" id="id">
    
    <input type="hidden" name="idhabitacion" id="idhabitacion">

    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
            Cliente
        </label>
        <input type="hidden" name="idcliente" id="idcliente">
        <div class="col-md-2 col-sm-6 col-xs-12">
            <input onkeypress="return solonumeros(event)" onblur="searchdni(this)" id="al_dni" name="al_dni" class="form-control" value="" placeholder="DNI" maxlength="8">
        </div>
        <div class="col-md-5 col-sm-6 col-xs-12">
            <input id="cliente" name="cliente" readonly class="form-control" value="" placeholder="Cliente">
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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="save_reserva()" id='btn_save'>
                    Aceptar
                </button>
            </div>
        </div>
        </form>
    </div>
</div>

<div id="modalDetalleReserva" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <form id="form_res" class="form-horizontal form-label-left form-material">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">Datos de la Reserva</h4>
            </div>
            <div class="modal-body" id='detalle_reserva'>
               

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
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

<div id="modalopcion" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="text-center modal-header" id="encabezadoT" >
                
            </div>
            <div class="modal-body" id="list_option_view">
               

            </div>
            <div class="modal-footer">
            <div class="text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
                
            </div>
        </div>
    </div>
</div>

<form id="cancelar">
    <input type="hidden" name="cancelar_id" id="cancelar_id">
</form>