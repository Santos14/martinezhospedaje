
<input type="hidden" name="h_idalquiler" id="h_idalquiler">
<input type="hidden" name="h_monto" id="h_monto">
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Cuartos Pendientes de Pago</h3>
            <div class="table-responsive">
                 <table class="table" id='pPago'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>N°</th>
                            <th>Cliente</th>
                            <th>Precio(S/.)</th>
                            <th class="text-center">Hab.</th>
                            <th class="text-center">Vent.</th>
                            <th class="text-center">Impr.</th>
                            <th class="text-center">Total</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                  <?php

                   for ($i=0; $i < count($data_alquiler["alquiler"]) ; $i++) { ?>
                     

<tr>
  <td><?= $i+1 ?> </td>
  <td><?= $data_alquiler["alquiler"][$i]->nrohabitacion ?></td>
  <td><?= $data_alquiler["alquiler"][$i]->nombres.", ".$data_alquiler["alquiler"][$i]->apellidos ?></td>
  <td><?= $data_alquiler["alquiler"][$i]->precioxdia ?></td>
   <?php $total = $data_alquiler["deuda_habitacion"][$i]+$data_alquiler["deuda_ventas"][$i]+$data_alquiler["deuda_imprevistos"][$i];?>

  <td class="text-center"><input type="text" id="h<?= $data_alquiler["alquiler"][$i]->idalquiler ?>" name="h<?= $data_alquiler["alquiler"][$i]->idalquiler ?>" value="<?= number_format($data_alquiler["deuda_habitacion"][$i],'2') ?>" style="width:60px;background: none;border: none;text-align: center;"></td>
  <td class="text-center"><input type="text" id="v<?= $data_alquiler["alquiler"][$i]->idalquiler ?>" name="v<?= $data_alquiler["alquiler"][$i]->idalquiler ?>" value="<?= number_format($data_alquiler["deuda_ventas"][$i],'2') ?>" style="width:60px;background: none;border: none;text-align: center;"></td>
  <td class="text-center"><input type="text" id="i<?= $data_alquiler["alquiler"][$i]->idalquiler ?>" name="i<?= $data_alquiler["alquiler"][$i]->idalquiler ?>" value="<?= number_format($data_alquiler["deuda_imprevistos"][$i],'2') ?>" style="width:60px;background: none;border: none;text-align: center;"></td>
  <td class="text-center"><input type="text" id="t<?= $data_alquiler["alquiler"][$i]->idalquiler ?>" name="t<?= $data_alquiler["alquiler"][$i]->idalquiler ?>" value="<?= number_format($total,'2') ?>" style="width:60px;background: none;border: none;text-align: center;"></td>
  <td class="text-center">
    
   
    <?php if($total == 0): ?>
    <button type="button" id="btn_amortiza_movimiento" onclick="amortizar('<?= $data_alquiler["alquiler"][$i]->idalquiler ?>','','2')" class="btn btn-primary btn-xs">Adelantar</button>
    <?php else: ?>
        <button type="button" id="btn_todo_movimiento" onclick="allCash('<?= $data_alquiler["alquiler"][$i]->idalquiler ?>')" class="btn btn-success btn-xs">Todo</button> 
      <button type="button" id="btn_amortiza_movimiento" onclick="amortizar('<?= $data_alquiler["alquiler"][$i]->idalquiler ?>','','2')" class="btn btn-danger btn-xs">Amort. Hab.</button>
    <?php endif; ?>
  </td>
</tr>


                <?php  }  ?>



                    </tbody>
                    
                </table>

            </div>

        </div>
    </div>
    
</div>

<div id="modalAmortizacion" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <form id="form" class="form-horizontal form-label-left form-material">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">Amortizacion</h4>
            </div>
            <div class="modal-body">
               
    <div class="form-group">
        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="montoamortizacion">
            Monto de Amortizacion
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <input type="text" id="montoamortizacion" name="montoamortizacion" class="form-control" placeholder="Ingrese Monto">
        </div>
    </div>
    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="amortizar('','0','2')" id='btn_save'>
                    Aceptar
                </button>
            </div>
        </div>
        </form>
    </div>
</div>



