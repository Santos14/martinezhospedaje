<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Historial de Alquiler</h3>
            <p class="text-muted">Lista de alquileres del Hospedaje Martinez</p>
            <div class="table-responsive">
                 <table class='table table-striped table-bordered' id="listaalquiler">
                     
                     <thead>
                         <tr>
                            <th class="text-center">#</th>
                             <th class="text-center">Habitacion</th>
                             <th class="text-center">Nro Doc</th>
                             <th class="text-center">Apellidos y Nombres</th>
                             <th class="text-center">Ingreso</th>
                             <th class="text-center">Salida</th>
                             <th class="text-center">Aport.(S/.)</th>
                             <th class="text-center">Estado</th>
                             <th class="text-center">Accion</th> 
                         </tr>
                     </thead>
                     <tbody>
                        <?php $cont = 1; ?>
                        <?php foreach ($alquileres as $alq): ?>

                        <?php $fs = new DateTime($alq->fecha_salida)?>
                            <tr>
                                <td><?= $cont++ ?></td>
                                <td><?= $alq->nrohabitacion ?></td>
                                <td><?= $alq->nrodocumento ?></td>
                                <td><?= $alq->apellidos.", ".$alq->nombres ?></td>
                                <td><?= $alq->fecha_ingreso ?></td>
                                <td>
                                <?php 
                                if(date_format($fs,"Y-m-d") =='1900-01-01'){
                                    echo "";
                                }else{
                                    echo $alq->fecha_salida;
                                }
                                ?></td>

                                <td><?= $alq->montopagado ?></td>
                               
                                <td class="text-center">
                                <?php
                                switch ($alq->estado) {
                                    case '0':
                                        $es = "<button class='btn btn-danger btn-xs'>Anulado</button>";
                                        break;
                                    case '1':
                                        $es = "<button class='btn btn-success btn-xs'>Activo</button>";
                                        break;
                                    case '2':
                                       $es = "<button class='btn btn-primary btn-xs'>Terminado</button>";
                                        break;
                                }
                                echo $es; 
                                ?>

                                        
                                </td>
                                <td class='text-center'>

                                <?php if($alq->estado == '1'){ ?>
                                <button onclick="anular_alquiler('<?= $alq->idalquiler ?>')" class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>
                                <!--button onclick="editar_alquiler('<?= $alq->idalquiler ?>')" class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></button-->
                                <button onclick="ver_alquiler('<?= $alq->idalquiler ?>')" class='btn btn-info btn-xs'><i class='fa fa-eye'></i></button>
                            <?php }else if($alq->estado == '0'){ ?>
                                <button onclick="restaurar_alquiler('<?= $alq->idalquiler ?>')" class='btn btn-info btn-xs'><i class='fa fa-rotate-left'></i></button>
                                <button onclick="ver_alquiler('<?= $alq->idalquiler ?>')" class='btn btn-info btn-xs'><i class='fa fa-eye'></i></button>
                                <?php }else{ ?>
                                <button onclick="ver_alquiler('<?= $alq->idalquiler ?>')" class='btn btn-info btn-xs'><i class='fa fa-eye'></i></button>
                                <?php } ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                     </tbody>
                 </table>
            </div>
        </div>
    </div>
    
</div>