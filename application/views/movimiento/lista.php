<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Movimientos</h3>
                    <p class="text-muted">Lista de todos los Movimientos del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo Movimiento</th>
                                    <th>Concepto</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>

                                    <td><?= $cont++ ?></td>
                                    <td><?= $val->tipomovimiento ?></td>
                                    <td><?= $val->concepto ?></td>
                                    <td><?= $val->fecha ?></td>
                                    <td><?= number_format($val->monto,'2') ?></td>
                                    
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            
                        </table>

                    </div>
                </div>
            </div>
            
        </div>