<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Lista de Pasajeros</h3>
            <p class="text-muted">Lista Pasajeros Actuales del Hospedaje Martinez</p>
            <div class="table-responsive">
                 <table class='table table-striped table-bordered' id="listapasajeros">
                     
                     <thead>
                         <tr>
                            <th class="text-center">#</th>
                             <th class="text-center">Habitacion</th>
                             <th class="text-center">Precio(S/.)</th>
                             <th class="text-center">Ingreso</th>
                             <th class="text-center">DNI</th>
                             <th class="text-center">Apellidos y Nombres</th>
                             <th class="text-center">Deuda</th>
                        
                             
                         </tr>
                     </thead>
                     <tbody>
                        <?php $cont=1; ?> 
                        <?php foreach ($habitaciones as $hb): ?>
                         <tr>
                            <td class="text-center"><?= $cont++ ?></td>
                            <td class="text-center"><?= $hb->nrohabitacion ?></td>
                            <?php 
                            $est = false;
                            for ($i=0; $i < count($data_alquiler["alquiler"]) ; $i++) { 
                                if($hb->idhabitacion == $data_alquiler["alquiler"][$i]->habitacion_idhabitacion){ 
                                        $est = true;
                            ?>

                                     <td class="text-center"><?= $data_alquiler["alquiler"][$i]->precioxdia ?></td>
                                     <td class="text-center"><?= $data_alquiler["alquiler"][$i]->fecha_ingreso ?></td>
                                     <td class="text-center"><?= $data_alquiler["alquiler"][$i]->nrodocumento ?></td>
                                     <td><?= $data_alquiler["alquiler"][$i]->nombres." ".$data_alquiler["alquiler"][$i]->apellidos ?></td>
                                     <td class="text-center"><?= number_format(($data_alquiler["deuda_habitacion"][$i]+$data_alquiler["deuda_ventas"][$i]+$data_alquiler["deuda_imprevistos"][$i]),'2') ?></td>

                            <?php  
                                    break;  
                                }
                            } 
                            if(!$est){ ?>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            <?php

                            }
                            ?>
                         </tr>

                        <?php endforeach ?>
                     </tbody>
                 </table>
            </div>
        </div>
    </div>
    
</div>