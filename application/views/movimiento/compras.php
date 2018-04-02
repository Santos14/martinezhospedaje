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
<br><br>
<div class="text-center">
 <button type="button" class="btn btn-success" onclick="compras()">
                    Guardar
                </button> 
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