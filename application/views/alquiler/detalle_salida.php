<?php 

$hora_termino = $politica[0]->numero;
$minuto_termino = "00";
$segundo_termino = "00";

  $hora_fin = '02';
  $minuto_fin = "59";
  $segundo_fin = "59";


$ahora = new DateTime("NOW");
$fechaingreso = new DateTime($alquiler[0]->fecha_ingreso);
$diff = $ahora->diff($fechaingreso);

$dias = (strtotime(date_format($fechaingreso,"Y-m-d"))-strtotime(date("Y-m-d")))/86400;
$dias = abs($dias); $dias = floor($dias); 

?>


                    <?php 
                          $rango=false;
  
                          if($fechaingreso->format('H')>='00' && $fechaingreso->format('i') >= '00' && $fechaingreso->format('s') >= '00'){
                        
                             if($fechaingreso->format('H')<=$hora_fin && $fechaingreso->format('i') <= $minuto_fin && $fechaingreso->format('s') <= $segundo_fin){
                              $rango = true;
                             }
                           
                             
                            

                                  }

                          ?>
                          <?php $cont = 1; $pen = 0; $s = 0;
                          $f = date_format($fechaingreso,"Y-m-d");

                          ?>

                    

                          <?php if($dias == "0"):?>
                                  
                                  <?php 
                                  
                                  if($rango):
                                      $n =  date ('Y-m-d',strtotime ('-1 day',strtotime($f)));
                                  else:
                                      $n = $f;
                                  endif;
                                  ?>

                                  
                                  <?php $p = count($pagado); ?>
                                  <?php 
                                  

                                  if($rango){
                                    if(date("H")>=$hora_termino && date("i")>=$minuto_termino && date("s")>=$segundo_termino){
                                       $s = 1;
                                      }
                                  }

                                  

                                  ?>
                                  <?php  if($p==0){?>
                                  <?php $resto = 0; ?>
                                  <?php  }else{?>
                                  <?php $resto = $pagado[0]->monto; ?>
                                  <?php  }?>

                                  <?php if($p==0): ?>



                                    <?php $pen+=$alquiler[0]->precioxdia; ?>
              



                                  <?php else: ?>

                                      <?php if($resto < $alquiler[0]->precioxdia): ?>



                            <?php $resto = $alquiler[0]->precioxdia-$resto ?>
                            <?php $pen+=$resto; ?>


                                      <?php else: ?>




                                        <?php if($resto == $alquiler[0]->precioxdia): ?>
                          <?php $resto = $alquiler[0]->precioxdia-$resto ?>



                                        <?php endif; ?>


                                      <?php endif; ?>

                                  <?php endif; ?>
               
                                
                                <?php for ($i = 0; $i < $s ; $i++): ?>
                                  <?php  $n =  date ('Y-m-d',strtotime ('+1 day',strtotime($n))); ?>

                                  <?php if($resto != 0){ ?>

                                      <?php if($resto >= $alquiler[0]->precioxdia){ ?>
          <?php $resto = $resto -$alquiler[0]->precioxdia; ?>

                  

                                      <?php }else{ ?>
<?php $resto = $alquiler[0]->precioxdia - $resto; 
      $pen += $resto;
?>
                                      <?php }?>

                                  <?php }else{ ?>

                                  <?php $pen+=$alquiler[0]->precioxdia; ?>
                                  
                                  <?php } ?>

                                <?php endfor; ?>


                          <?php else: ?> 
                          <?php 
                            
                            $cant = $dias; 

                            if(date("H")>=$hora_termino && date("i")>=$minuto_termino && date("s")>=$segundo_termino){
                                $cant++;
                            }
                            if($rango){
                              $cant++;
                            }
                            if(count($pagado)>0){
                              $resto = $pagado[0]->monto;  
                            }else{
                              $resto = 0;
                            }
                             $n =  date ('Y-m-d',strtotime ('-1 day',strtotime($f)));
                            for ($i = 0; $i < $cant ; $i++) {?>
                            
                                <?php 
                                if($rango){
                                 
                              
                                   $n =  date ('Y-m-d',strtotime ('+1 day',strtotime($n)));
                                }else{
                                  
                                  $fechaingreso->add(new DateInterval('P1D'));
                                }

                                
                                
                                ?>
                                  

                   
                                <?php if( $resto != 0): ?>
                                <?php if( $resto >= $alquiler[0]->precioxdia): ?>
                      
                              <?php $resto = $resto - $alquiler[0]->precioxdia; ?>
                              <?php else:?>
                                <?php $r = $alquiler[0]->precioxdia - $resto; 
                                    $resto =0;
                                    $pen += $r;
                                   ?>
                              
                                <?php endif; ?>
                              <?php else: ?>
                                <?php $pen+=$alquiler[0]->precioxdia; ?>
                              
                                <?php endif; ?>
                                <?php ?>
                                <?php ?>
                                
                              
                          <?php  }
                          ?>
                          
                          <?php endif; ?>

                  
                          <?php $comp = 0; ?>
                          <?php foreach ($ventas as $venta): ?>
      
                      
                              <?php 
                              switch ($venta->estado) {
                                case '1':
                                  $comp += $venta->total;
                                  
                                  break;
                                case '2':
                                  break;
                              } 
                            ?>
                         
                        <?php endforeach; ?>

                          <?php $contimp = 0;
                          foreach ($imprevistos as $imp): ?>
                          
                            <?php 
                              switch ($imp->estado) {
                                case '1':
                                $contimp+=$imp->monto;
                                  
                                  break;
                                case '2':
                                  
                                  break;
                              } 
                            ?>
                          
                        <?php endforeach; ?>


<form id="form_pagartodo" class="form-horizontal form-label-left form-material">


<input type="hidden" name="idalquiler" id="idalquiler" value="<?= $alquiler[0]->idalquiler ?>">

<input type="hidden" name="est" id="est">

<div class="modal-header">
              <h4 class="btn btn-info modal-title"><strong>Cuarto N° <?= $habitacion[0]->nrohabitacion ?></strong></h4>
            
          </div>
          <div class="modal-body">

<div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
        Cliente
    </label>
    <input type="hidden" name="idcliente" id="idcliente">
    <div class="col-md-8 col-sm-6 col-xs-12">
        <input id="cliente" name="cliente" readonly class="form-control" value="<?= $cliente[0]->apellidos.", ".$cliente[0]->nombres ?>">
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
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
                <button type="button" class="btn btn-success" id="btn_desocuparhabitacion" onclick="pagartodo('1')">
                    Desocupar
                </button>
            </div>
        </div>
       
    </div>
</div>

</form>