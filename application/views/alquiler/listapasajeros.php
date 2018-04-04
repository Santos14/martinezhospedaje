<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Lista de Pasajeros</h3>
            <p class="text-muted">Lista Pasajeros Actuales del Hospedaje Martinez</p>
            <div class="table-responsive">
                 <table class='table table-striped table-bordered'>
                     
                     <thead>
                         <tr>
                             <th>Habitacion</th>
                             <th>Ingreso</th>
                             <th>DNI</th>
                             <th>Apellidos y Nombres</th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($habitaciones as $hb): ?>
                         <tr>
                             <td><?= $hb->nrohabitacion ?></td>
                             <?php 

                             foreach ($alquiler as $al){
                                if($hb->idhabitacion == $al->idhabitacion){ ?>
                                    <td><?= date_format(new Datetime($al->fecha_ingreso),'Y-m-d') ?></td>
                                    <td><?= $al->nrodocumento ?></td>
                                    <td><?= $al->apellidos.", ".$al->nombres ?></td>
                                    
                             <?php  
                                    break; 
                                }else{?>
                                <td></td>
                                <td></td>
                                <td></td>

                                <?php  }
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