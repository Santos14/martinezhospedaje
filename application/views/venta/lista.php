<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Ventas</h3>
                    <p class="text-muted">Lista de todos las ventas Activas del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Especificacion</th>
                                    <th>Estado</th>
                                    <th class='text-center'>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i = 0; $i <count($ventas) ;$i++):?>
                                 <tr>
                                    <td><?= $i+1 ?></td>
                                    <td><?= $ventas[$i]->fecha ?></td>
                                    <td><?= $ventas[$i]->total ?></td>
                                    <td><?= $ventas[$i]->cliente ?></td>

                       

                                <td>
                                <?php 
                                    switch ($ventas[$i]->estado) {
                                        case '1':
                                            echo "<button class='btn btn-pendiente btn-xs'>A Cuenta</button>";
                                            break;
                                        case '2':
                                            echo "<button class='btn btn-success btn-xs'>Cancelado</button>";
                                            break;
                                        case '0':
                                            echo "<button class='btn btn-danger btn-xs'>Anulado</button>";
                                            break;
                                    }
                                ?></td>

                                <td class='text-center'>
                                        <button onclick="form_detalle('<?=  $ventas[$i]->idventa ?>')" type="button" class='btn btn-warning btn-xs'>
                                         Detalle
                                        </button>
                                        <?php if($ventas[$i]->estado == '1'):?>
                                         <button onclick="showEliminar('<?=  $ventas[$i]->idventa ?>')" type="button" class='btn btn-danger btn-xs'>
                                             <i class="fa fa-trash-o"></i> Anular
                                         </button>
                                     <?php endif?>
                                    </td>
                                </tr>
    
                                <?php endfor; ?>
                            </tbody>
                            
                        </table>

                    </div>
                </div>
            </div>
            
        </div>


