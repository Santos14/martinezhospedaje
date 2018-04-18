<input type="hidden" name="i_idimprevisto" id="i_idimprevisto">
<input type="hidden" name="i_monto" id="i_monto">
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Imprevistos Pendientes de Pago</h3>
            <div class="table-responsive">
                 <table class="table" id='pPago'>
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
                            <td><?= ($val->estado == '1')? "<button class='btn btn-warning btn-xs'>Pendiente</button>":"" ?></td>
                            
                            <td class='text-center'>
                                 <button id="btn_imprevisto_movimiento" onclick="imprevisto('<?= $val->idimprevisto ?>','<?= $val->monto ?>')" type="button" class='btn btn-success btn-xs'>
                                     Pagar
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