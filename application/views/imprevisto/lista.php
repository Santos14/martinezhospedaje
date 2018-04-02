<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Imprevistos</h3>
                    <p class="text-muted">Lista de Imprevistos Pendientes de Pago del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>N° Cuarto</th>
                                    <th>Cliente</th>
                                    <th>Tipo Imprevisto</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th class='text-center'>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>

                                    <td><?= $cont++ ?></td>
                                    <td><?= $val->fecha ?></td>
                                    <td><?= $val->nrohabitacion ?></td>
                                    <td><?= $val->apellidos.", ".$val->nombres ?></td>
                                    <td><?= $val->tipoimprevisto ?></td>
                                    <td><?= $val->monto ?></td>
                                    <td><?php 

                                    switch ($val->estado) {
                                        case '1':
                                            echo "<button class='btn btn-warning btn-xs'>Pendiente</button>";
                                            break;
                                        case '2':
                                            echo "<button class='btn btn-success btn-xs'>Cancelado</button>";
                                            break;
                                        case '0':
                                            echo "<button class='btn btn-danger btn-xs'>Anulado</button>";
                                            break;
                                    }

                                    ?>
                                        
                                    </td>
                                    
                                    <td class='text-center'>
                                        <?php if($val->estado=='1'): ?>
                                         <button onclick="showEliminar('<?= $val->idimprevisto ?>')" type="button" class='btn btn-danger btn-xs'>
                                             <i class="fa fa-trash-o"></i> Anular
                                         </button>
                                     <?php endif?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            
                        </table>

                    </div>
                </div>
            </div>
            
        </div>