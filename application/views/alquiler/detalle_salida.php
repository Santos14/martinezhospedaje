<?php 
  $index = 0;
  for ($i=0; $i < count($data_alquiler["alquiler"]) ; $i++) { 
       if($data_alquiler["alquiler"][$i]->idalquiler == $idalquiler){ 
          $index=$i;
          break;
       }
  }
  $pen = $data_alquiler["deuda_habitacion"][$index];
  $comp = $data_alquiler["deuda_ventas"][$index];
  $contimp = $data_alquiler["deuda_imprevistos"][$index];
  if($data_alquiler["alquiler"][$i]->kit == '1'){
     $kit = "Se le Entrego Toalla";
  }else{
     $kit = "No se le entrego Toalla";
  }
?>

<form id="form_pagartodo" class="form-horizontal form-label-left form-material">


<input type="hidden" name="idalquiler" id="idalquiler" value="<?= $data_alquiler["alquiler"][$index]->idalquiler ?>">

<input type="hidden" name="est" id="est">

<div class="modal-header">
              <h4 class="btn btn-info modal-title"><strong>Cuarto N° <?= $data_alquiler["alquiler"][$index]->nrohabitacion ?></strong></h4>
            
          </div>
          <div class="modal-body">

<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
        Cliente
    </label>
    <input type="hidden" name="idcliente" id="idcliente">
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input id="cliente" name="cliente" readonly class="form-control" value="<?= $data_alquiler["alquiler"][$index]->apellidos.", ".$data_alquiler["alquiler"][$index]->nombres ?>">
    </div>
</div>

<table class='table table-striped table-bordered'>
  <thead>
    <tr>
      <th class="text-center">N°</th>
      <th class="text-center">Concepto Deuda</th>
      <th class="text-center">Monto</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center">1</td>
      <td>Por Alojamiento</td>
      <td class="text-center"><input style="text-align:center;width:80px;background: none; border:none;" name="alojamiento" value="<?= number_format($pen,'2') ?>" readonly></td>
    </tr>
    <tr>
      <td class="text-center">2</td>
      <td>Por Compras</td>
      <td class="text-center"><input style="text-align:center;width:80px;background: none; border:none;" name="compras" value="<?= number_format($comp,'2') ?>" readonly></td>
    </tr>
    <tr>
      <td class="text-center">3</td>
      <td>Por Imprevistos</td>
      <td class="text-center"><input style="text-align:center;width:80px;background: none; border:none;" name="imprevistos" value="<?= number_format($contimp,'2') ?>" readonly></td>
    </tr>
    <tr>
      <td class="text-center" colspan="2">TOTAL</td>
      <td class="text-center"><?= number_format($pen+$comp+$contimp,'2') ?></td>
    </tr>
  </tbody>
</table>
<br><br>
<?php if($data_alquiler["alquiler"][$i]->kit == '1'): ?>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
        Nota
    </label>
    
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input readonly="" name="kit" id="kit" class="form-control" value="<?= $kit ?>">
    </div>
</div>
<?php endif; ?>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
        Observacion de Salida
    </label>
    
    <div class="col-md-8 col-sm-6 col-xs-12">
        <textarea class="form-control" name="observacion" id="observacion" placeholder="Ingrese Observacion de salida" rows="3"></textarea>
    </div>
</div>
<?php $total = $pen+$comp+$contimp; ?>
<?php if($total != 0): ?>
<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
       Cancelado
    </label>
    
    <div class="col-md-8 col-sm-6 col-xs-12">
       <input type="checkbox" name="pagado" id="pagado">
    </div>
</div>
<?php endif ?>

</div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-success" id="btn_desocuparhabitacion" onclick="pagartodo('1')">
                    Desocupar
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
       
    </div>
</div>

</form>