
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Historial de Estancias</h3>
            <p class="text-muted"><strong>CUARTO N°:</strong> <?= $habitacion[0]->nrohabitacion ?></p>
            
            <br>
            <div class="table-responsive">
                 <table class="table" id='datatable'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nro Doc</th> 
                            <th>Cliente</th>                           
                            <th>Fecha Ingreso</th>                           
                            <th>Fecha Salida</th>
                            <th>Nro Dias</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cont = 1; ?>
                        <?php foreach ($alquileres as $alq): ?>
                            <tr>
                                <td><?= $cont++ ?></td>
                                <td><?= $alq->nrodocumento ?></td>
                                <td><?= $alq->apellidos.", ".$alq->nombres ?></td>
                                <td><?= $alq->fecha_ingreso ?></td>
                                <td>
                                <?php $fs = new DateTime($alq->fecha_salida)?>
                                <?php 
                                    if(date_format($fs,"Y-m-d") =='1900-01-01'){
                                        echo "";
                                    }else{
                                        echo $alq->fecha_salida;
                                    }
                                ?>
                                </td>
                                <td><?= $alq->nrodias ?></td>
                                <td>
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
                                <td>
                                    <button onclick="ver_alquiler('<?= $alq->idalquiler ?>')" class='btn btn-info btn-xs'><i class='fa fa-eye'></i></button>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                       
                    </tbody>
                    
                </table>

            </div>
            <br>
            <div class="text-center">
                <button type="button" onclick="window.location = '<?= base_url("habitacion")?>'" class="btn btn-danger">
                    Atras
                </button>
            </div>
        </div>
    </div>

    
</div>

    
