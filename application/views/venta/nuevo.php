<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Nueva Venta</h3>
            <p class="text-muted">Llene los campos para crear una nueva venta</p>

            <form id="form" class="form-horizontal form-label-left form-material">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="tipocliente">
                    Tipo Cliente
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <input onclick="cambiarCli(this)" type="checkbox" id="tipocliente" checked name="tipocliente"> Interno
                </div>
            </div>
            <input type="hidden" name="idalquiler" id="idalquiler">
             <div class="form-group" id="cli_interno">
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
                <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="producto">
                    Producto
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <input type="hidden" name="idproducto" id="idproducto">
                    <input type="text" id="producto" name="producto" class="form-control" placeholder="Producto" readonly>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-12">
                    <button onclick="mostrarProductos()" type="button" class='btn btn-info'>
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="monto">
                    Monto
                </label>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <input type="text" id="monto" name="monto" class="form-control" placeholder="Monto">
                </div>
                <div class="col-md-1 col-sm-6 col-xs-12">
                    <button type="button" onclick="addproducto()" class='btn btn-info'>
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>

            <table class='table table-striped table-bordered' style="width: 60%; margin: 0 auto;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Monto (S/.)</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody id='listaproducto'>

                </tbody>
            </table>
            <br><br>
            <div class="text-center">
                Total(S/.): <input type="button" name="totalventa" id="totalventa" value="0">    
            </div>
    <br>
            <div class="form-group">
                <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="cancelado">
                    Cancelado
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <input  type="checkbox" id="cancelado" name="cancelado">
                </div>
            </div>
            </form>
            
            
            <br><br>

            <div class="text-center">
                <button type="button" class="btn btn-danger" onclick="window.location='<?= base_url('venta')?>'">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" id="btn_save_venta" onclick="save()">
                    Guardar
                </button>
            </div>

        </div>
    </div>
</div>


<div id="modalProducto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <form id="form" class="form-horizontal form-label-left form-material">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">Lista de Productos</h4>
            </div>
            <div class="modal-body">
                   <table class="table table-striped table-bordered" id="productoslista">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Producto</th>
                               <th>Accion</th>
                           </tr>
                       </thead>
                       <tbody>
                        <?php $cont=1;foreach ($productos as $producto): ?>
                           <tr>
                               <td><?= $cont++ ?></td>
                               <td><?= $producto->nombre ?></td>
                               <td><button onclick="aproducto('<?= $producto->idproducto ?>','<?= $producto->nombre ?>')" type="button" class="btn btn-success btn-xs">Agregar</button></td>
                           </tr>
                        <?php endforeach; ?>
                       </tbody>
                   </table>

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