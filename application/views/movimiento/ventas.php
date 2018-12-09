

<input type="hidden" name="v_idventa" id="v_idventa">
<input type="hidden" name="v_monto" id="v_monto">
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Ventas Pendientes de Pago</h3>
            <div class="table-responsive">
                 <table class="table" id='pPago'>
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
                                    echo "<button class='btn btn-danger btn-xs'>A Cuenta</button>";
                                    break;
                                case '2':
                                    echo "<button class='btn btn-success btn-xs'>Cancelado</button>";
                                    break;
                            }
                        ?></td>

                        <td class='text-center'>
                                <button id="btn_venta_movimiento" onclick="venta('<?=  $ventas[$i]->idventa ?>','<?= $ventas[$i]->total ?>','1')" type="button" class='btn btn-success btn-xs'>
                                    Pagar
                                </button>
                            </td>
                        </tr>

                        <?php endfor; ?>
                    </tbody>
                    
                </table>

            </div>
        </div>
    </div>
    
</div>
