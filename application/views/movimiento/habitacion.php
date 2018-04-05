<?php 
  $hora_termino = $politica[0]->numero;
  $minuto_termino = "00";
  $segundo_termino = "00";
//TERNINO DE FIN DEL DIA 
  $hora_fin = '02';
  $minuto_fin = "59";
  $segundo_fin = "59";

  
?>


<input type="hidden" name="h_idalquiler" id="h_idalquiler">
<input type="hidden" name="h_monto" id="h_monto">
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Cuartos Pendientes de Pago</h3>
            <div class="table-responsive">
                 <table class="table" id='datatable'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>N° Cuarto</th>
                            <th>Cliente</th>
                            <th class="text-center">Deuda</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                  <?php

                  for ($h = 0; $h < count($alquiler) ; $h++) {
                      $ahora = new DateTime("NOW");
                      $fi = new DateTime($alquiler[$h]->fecha_ingreso);
                      $diff = $ahora->diff($fi);

                      $dias = (strtotime(date_format($fi,"Y-m-d"))-strtotime(date("Y-m-d")))/86400;
                      $dias = abs($dias); $dias = floor($dias); 

                      $rango=false;

                      if($fi->format('H')>='00' && $fi->format('i') >= '00' && $fi->format('s') >= '00'){
                          if($fi->format('H')<=$hora_fin  && $fi->format('i') <= $minuto_fin  && $fi->format('s') <= $segundo_fin ){
                            $rango = true;
                         }
                      }

                      $cont = 1; 
                      $pen = 0;
                      $s = 0;

                      $f = date_format($fi,"Y-m-d");

                      $pagado = $alquiler[$h]->pagado; 
                      if($dias == "0"): 

                          if($rango){
                              $n =  date ('Y-m-d',strtotime ('-1 day',strtotime($f)));
                          }else{
                              $n = $f;
                          }
                        
                           
                                                     
                          if($rango){
                            if(date("H")>=$hora_termino && date("i")>=$minuto_termino && date("s")>=$segundo_termino){
                                $s = 1;
                              }
                          }

                          if($pagado==""){
                              $resto = 0;  
                              $pen+=$alquiler[$h]->precioxdia;    

                          }else{

                            $resto = $pagado; 
                            if($resto < $alquiler[$h]->precioxdia){
                                $resto = $alquiler[$h]->precioxdia-$resto;  
                                $pen+=$resto; 
                            }else{
                                if($resto == $alquiler[$h]->precioxdia){
                                    $resto = $alquiler[$h]->precioxdia-$resto;         
                                }
                            }
                          } 

                          for ($i = 0; $i < $s ; $i++){ 
                            $n =  date ('Y-m-d',strtotime ('+1 day',strtotime($n)));  

                             if($resto != 0){  
                                if($resto >= $alquiler[$h]->precioxdia){  
                                   $resto = $resto -$alquiler[$h]->precioxdia;  
                                }else{ 
                                    $resto = $alquiler[$h]->precioxdia - $resto; 
                                    $pen += $resto;
                                } 
                              }else{  
                                    $pen+=$alquiler[$h]->precioxdia;     
                               }  
                          } 


                      else:   

                        $cant = $dias; 

                        if(date("H")>=$hora_termino && date("i")>=$minuto_termino && date("s")>=$segundo_termino){
                            $cant++;
                        }
                        if($rango){
                          $cant++;
                        }
                        if($pagado!=""){
                          $resto = $pagado;  
                        }else{
                          $resto = 0;
                        }
                        
                        $n =  date ('Y-m-d',strtotime ('-1 day',strtotime($f)));
                        for ($i = 0; $i < $cant ; $i++) { 
                        

                            if($rango){
                              $n =  date ('Y-m-d',strtotime ('+1 day',strtotime($n)));
                            }else{
                              
                              $fi->add(new DateInterval('P1D'));
                            }

                            if( $resto != 0){
                              if( $resto >= $alquiler[$h]->precioxdia){
                                $resto = $resto - $alquiler[$h]->precioxdia;  
                              }else{
                                $r = $alquiler[$h]->precioxdia - $resto; 
                                $resto =0;
                                $pen += $r;
                              } 
                            }else{
                              $pen+=$alquiler[$h]->precioxdia;  
                            }               
                         }
                                   
                      endif;  ?>
<?php if($pen!=0):?>
<tr>
  <td><?= $h+1 ?> </td>
  <td><?= $alquiler[$h]->nrohabitacion ?></td>
  <td><?= $alquiler[$h]->nombres.", ".$alquiler[$h]->apellidos ?></td>
  <td class="text-center"><input type="text" id="m<?= $alquiler[$h]->idalquiler ?>" name="m<?= $alquiler[$h]->idalquiler ?>" value="<?= number_format($pen,'2') ?>" style="background: none;border: none;text-align: center;"></td>
  <td class="text-center">
    
    <button type="button" onclick="habitacion('<?= $alquiler[$h]->idalquiler ?>','<?= $pen ?>','1')" class="btn btn-success btn-xs">Pagar Todo</button>
    <button type="button" onclick="habitacion('<?= $alquiler[$h]->idalquiler ?>','','2')" class="btn btn-warning btn-xs">Amortizar</button>
 
  </td>
</tr>
 <?php endif?>




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
                <button type="button" class="btn btn-success" onclick="habitacion('','0','2')" id='btn_save'>
                    Aceptar
                </button>
            </div>
        </div>
        </form>
    </div>
</div>



