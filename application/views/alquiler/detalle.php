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

<div class="modal-header">
              <h4 class="btn btn-info modal-title"><strong>Cuarto N° <?= $habitacion[0]->nrohabitacion ?></strong></h4>
            
          </div>
          <div class="modal-body">
          
<div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Detalle</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Estancia</a>
                    </li>
                     <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab1" data-toggle="tab" aria-expanded="false">Compras</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Imprevistos</a>
                    </li>
      
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                      <p><strong>Cliente:</strong> <?= $cliente[0]->apellidos.", ".$cliente[0]->nombres ?></p>
                      <p><strong>Telefono:</strong> <?= $cliente[0]->telefono ?></p>
                      <p><strong>Procedencia:</strong> <?= $procedencia[0]->lugar ?></p>
                      <p><strong>Localidad:</strong> <?= $alquiler[0]->localidad ?></p>
                      <p><strong>Tipo Alquiler:</strong> <?= $tipoalquiler[0]->descripcion ?></p>
                      <p><strong>Precio x Dia:</strong> S/. <?= $alquiler[0]->precioxdia ?></p>
                      <p><strong>Fecha Ingreso:</strong> <?= $alquiler[0]->fecha_ingreso ?></p>
                      <p><strong>Motivo Viaje:</strong> <?= $motivoviaje[0]->descripcion ?></p>
                      <p><strong>Cambio Sabana:</strong> <?= $habitacion[0]->cambiosabana ?></p>
                      <p><strong>KIT:</strong> <?= ($alquiler[0]->kit=='1')? "SI":"NO" ?></p>
                      
                      

                      <br><br>
                      <div class="text-center">
                        DEUDA TOTAL(S/.) <input style="color: #FFF;width: 100px;text-align:center;font-weight:bold;font-size: 16px;background: #41b3f9; border:1px solid silver;border-radius: 10px;padding: 5px;" name="deutotal" id="deutotal" readonly> 

                      </div>
                      
                      


                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                      <!-- INICIO ESTANCIA-->

                    <?php $tipoalquiler = $alquiler[0]->tipoalquiler_idtipoalquiler; ?>
                    <?php if($tipoalquiler != '3'){ ?>
                    <?php 
                          $rango=false;
  
                          if($fechaingreso->format('H')>='00' && $fechaingreso->format('i') >= '00' && $fechaingreso->format('s') >= '00'){
                        
                             if($fechaingreso->format('H')<=$hora_fin && $fechaingreso->format('i') <=$minuto_fin && $fechaingreso->format('s') <= $segundo_fin){
                              $rango = true;
                             }
                           
                             
                            

                                  }

                          ?>
                      <table class="table" id="estancia">
                        <thead>
                          <tr>
                            <th>Dia</th>
                            <th>Fecha</th>
                            <th>Precio</th>
                            <th>Estado</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $cont = 1; $pen = 0; $s = 0;
                          $f = date_format($fechaingreso,"Y-m-d");

                          ?>

                          
                        
                          <?php if($dias == "0"): ?>

                                <tr>
                                  <td><?= $cont++ ?></td>
                                  
                                  <?php 
                                  
                                  if($rango):
                                      $n =  date ('Y-m-d',strtotime ('-1 day',strtotime($f)));
                                  else:
                                      $n = $f;
                                  endif;
                                  ?>

                                  <?php ?>
                                  <td><?= $n ?></td>
                                  <td><?= $alquiler[0]->precioxdia ?></td>
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
                        <td><button type="button" class="btn btn-warning btn-xs">Pendiente</button></td>



                                  <?php else: ?>

                                      <?php if($resto < $alquiler[0]->precioxdia): ?>



                            <?php $pendiente = $alquiler[0]->precioxdia-$resto ?>
                            <?php $pen+=$pendiente; ?>
                            <?php $resto = 0; ?>

                        

                         <td><button type="button" class="btn btn-warning btn-xs">Pendiente(S/. <?= $pendiente ?>)</button></td>
                    
                                      <?php else: ?>




                                        <?php if($resto >= $alquiler[0]->precioxdia): ?>
                          <?php $resto = $resto - $alquiler[0]->precioxdia ?>


                          <td><button type="button" class="btn btn-success btn-xs">Cancelado</button></td>



                                        <?php endif; ?>


                                      <?php endif; ?>

                                  <?php endif; ?>
                                  
                                </tr>
                                
                                <?php for ($i = 0; $i < $s ; $i++): ?>
                                  <?php  $n =  date ('Y-m-d',strtotime ('+1 day',strtotime($n))); ?>

                                <tr>

                                  <td><?= $cont++ ?></td>
                                  <td><?= $n ?></td>
                                  <td><?= $alquiler[0]->precioxdia ?></td>
<td>
                                  <?php if($resto != 0){ ?>

                                      <?php if($resto >= $alquiler[0]->precioxdia){ ?>
          <?php $resto = $resto -$alquiler[0]->precioxdia; ?>

                                  <button type="button" class="btn btn-success btn-xs">Cancelado</button>

                                      <?php }else{ ?>

<?php $resto = $alquiler[0]->precioxdia - $resto; 
      $pen += $resto;
?>
<button type="button" class="btn btn-warning btn-xs">Pendiente(S/. <?= $resto ?>)</button>

                                      <?php }?>

                                  <?php }else{ ?>

                                  <?php $pen+=$alquiler[0]->precioxdia; ?>
                                  <button type="button" class="btn btn-warning btn-xs">Pendiente</button>

                                  <?php } ?>

      
      </td>


                                </tr>

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
                              <tr>
                                <td><?= $i+1 ?></td>
                                <td>

                                <?php 
                                if($rango){
                                 
                                  echo $n;
                                   $n =  date ('Y-m-d',strtotime ('+1 day',strtotime($n)));
                                }else{
                                  echo $fechaingreso->format('Y-m-d');
                                  $fechaingreso->add(new DateInterval('P1D'));
                                }

                                
                                
                                ?>
                                  

                                </td>
                                <td><?= $alquiler[0]->precioxdia ?></td>
                                <?php if( $resto != 0): ?>
                                <?php if( $resto >= $alquiler[0]->precioxdia): ?>
                              <td><button type="button" class="btn btn-success btn-xs">Cancelado</button></td>
                              <?php $resto = $resto - $alquiler[0]->precioxdia; ?>
                              <?php else:?>
                                <?php $r = $alquiler[0]->precioxdia - $resto; 
                                    $resto =0;
                                    $pen += $r;
                                   ?>
                                <td><button type="button" class="btn btn-warning btn-xs">Pendiente(S/. <?= $r ?> )</button></td>
                                <?php endif; ?>
                              <?php else: ?>
                                <?php $pen+=$alquiler[0]->precioxdia; ?>
                                 <td><button type="button" class="btn btn-warning btn-xs">Pendiente</button></td>
                                <?php endif; ?>
                                <?php ?>
                                <?php ?>
                                
                              </tr>
                          <?php  }
                          ?>
                          
                          <?php endif; ?>
                        </tbody>
                      </table>
                      <br>
                      <div class="text-center">
                        DEUDA(S/.) <input style="color: #FFF;width: 100px;text-align:center;font-weight:bold;font-size: 16px;background: #41b3f9; border:1px solid silver;border-radius: 10px;padding: 5px;" name="deudaxhabitacion" id="deudaxhabitacion" readonly="" value="<?= number_format($pen,'2') ?>">  
                      </div>


                      <?php }else if($tipoalquiler == '3'){ 

                          $fechasalida = new DateTime($alquiler[0]->fecha_salida);
                          $diff = $ahora->diff($fechasalida);

                          $dias = (strtotime(date_format($fechasalida,"Y-m-d"))-strtotime(date_format($ahora,"Y-m-d")))/86400;
                          $dias = abs($dias); $dias = floor($dias); 

                      ?>

                        <input type="hidden" name="deudaxhabitacion" id="deudaxhabitacion" readonly="" value="0">  
                        <div class="text-center">
                         <h3> DIAS RESTANTES</h3>
                        </div>
                        <div class="text-center">
                        <input style="color: #FFF;width: 100px;text-align:center;font-weight:bold;font-size: 16px;background: #41b3f9; border:1px solid silver;border-radius: 10px;padding: 5px;" name="diasrestantes" id="diasrestantes" readonly value="<?= $diff->d  ?>">  
                        </div>
                      <?php } ?>

                      
                    </div>


                    <!-- FIN ESTANCIA-->

                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab1">
                      <table class="table" id="compras">
                        <thead>
                          <tr>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th class="text-center">Estado</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $comp = 0; ?>
                          <?php foreach ($ventas as $venta): ?>
                          <tr>
                            <td><?= $venta->fecha ?></td>
                            <td><?= $venta->total ?></td>
                            <td class="text-center">
                              <?php 
                              switch ($venta->estado) {
                                case '1':
                                  $comp += $venta->total;
                                  echo "<button class='btn btn-warning btn-xs'>Pendiente</button>";
                                  break;
                                case '2':
                                  echo "<button class='btn btn-success btn-xs'>Cancelado</button>";
                                  break;
                              } 
                            ?></td>
                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                      <br>
                    <div class="text-center">
                        DEUDA(S/.) <input style="color: #FFF;width: 100px;text-align:center;font-weight:bold;font-size: 16px;background: #41b3f9; border:1px solid silver;border-radius: 10px;padding: 5px;" id="deudacompras" name="deudacompras" readonly="" value="<?= number_format($comp,'2') ?>">  
                      </div>

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab2">
                    
                    <table class="table" id="imprevistos">
                        <thead>
                          <tr>
                            <th>Fecha</th>
                            <th>Tipo Imprevisto</th>
                            <th>Total</th>
                            <th class="text-center">Estado</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $contimp = 0;
                          foreach ($imprevistos as $imp): ?>
                          <tr>
                            <td><?= $imp->fecha ?></td>
                            <td><?= $imp->tipoimprevisto ?></td>
                            <td><?= $imp->monto ?></td>
                            <td class="text-center"><?php 
                              switch ($imp->estado) {
                                case '1':
                                $contimp+=$imp->monto;
                                  echo "<button class='btn btn-warning btn-xs'>Pendiente</button>";
                                  break;
                                case '2':
                                  echo "<button class='btn btn-success btn-xs'>Cancelado</button>";
                                  break;
                              } 
                            ?></td>
                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                      <br>
                    <div class="text-center">
                        DEUDA(S/.) <input style="color: #FFF;width: 100px;text-align:center;font-weight:bold;font-size: 16px;background: #41b3f9; border:1px solid silver;border-radius: 10px;padding: 5px;" id="deudaimprevisto" name="deudaimprevisto" readonly="" value="<?= number_format($contimp,'2') ?>">  
                      </div>

                    </div>
                   
                  </div>
                </div>



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
                Cerrar
            </button>
        </div>
