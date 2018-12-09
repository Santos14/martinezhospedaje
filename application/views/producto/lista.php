<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Productos</h3>
                    <p class="text-muted">Lista de todos los Productos del Kiosko del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Productos</th>
                                    <th>Puntos</th>
                                    <th class='text-center'>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>

                                    <td><?= $cont++ ?></td>
                                    <td><?= $val->nombre ?></td>
                                    <td><?= $val->puntos ?></td>
                                    
                                    <td class='text-center'>
                                        <button onclick="form_edit('<?= $val->idproducto ?>')" type="button" class='btn btn-warning btn-sm'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                         <button onclick="showEliminar('<?= $val->idproducto ?>')" type="button" class='btn btn-danger btn-sm'>
                                             <i class="fa fa-trash-o"></i>
                                         </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            
                        </table>

                    </div>
                </div>
            </div>
            
        </div>