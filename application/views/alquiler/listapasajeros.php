<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Lista de Pasajeros</h3>
            <p class="text-muted">Lista Pasajeros Actuales del Hospedaje Martinez</p>
            <div class="table-responsive">
                 <table class='table table-striped table-bordered' id="listapasajeros">
                     
                     <thead>
                         <tr>
                            <th class="text-center">Item</th>
                             <th class="text-center">Habitacion</th>
                             <th class="text-center">Ingreso</th>
                             <th class="text-center">DNI</th>
                             <th class="text-center">Apellidos y Nombres</th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php $cont=1; ?> 
                        <?php foreach ($habitaciones as $hb): ?>
                         <tr>
                            <td class="text-center"><?= $cont++ ?></td>
                             <td class="text-center"><?= $hb->nrohabitacion ?></td>
                             <?php 
                             $op = false;
                             foreach ($alquiler as $al){
                                if($hb->idhabitacion == $al->idhabitacion){ ?>
                                    <td class="text-center"><?= date_format(new Datetime($al->fecha_ingreso),'Y-m-d') ?></td>
                                    <td class="text-center"><?= $al->nrodocumento ?></td>
                                    <td><?= $al->apellidos.", ".$al->nombres ?></td>
                                    
                             <?php  $op=true;
                                    break; 
                                }

                             }
                             if(!$op){ ?>
                             <td></td>
                            <td></td>
                            <td></td>

                             <?php }

                             ?>
                             
                           
                         </tr>

                        <?php endforeach ?>
                     </tbody>
                 </table>
            </div>
        </div>
    </div>
    
</div>