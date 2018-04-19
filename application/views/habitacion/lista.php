<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Habitaciones</h3>
                    <p class="text-muted">Lista de todas las Habitaciones del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nro Habitacion</th>
                                    <th>Tipo Habitacion</th>
                                    <th class='text-center'>Precio(S/)</th>
                                    <th class='text-center'>Disponibildad</th>
                                    <th class='text-center'>Estado</th>
                                    
                                    <th class='text-center'>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>

                                    <td><?= $cont++ ?></td>
                                    <td><?= "Habitacion: <strong>".$val->nrohabitacion."</strong>" ?></td>
                                    <td><?= $val->tipohabitacion ?></td>
                                    <td class="text-center">
                                    <?= $val->precio ?>
                                    </td>
                                    <td class='text-center'><?php 
                                   /*
            disponibilidad       Estado
            - Ocupado (2)            - Limpio (1)
            - Libre  (1)             - Sucio (2)
                                     - Cambio sabana (3)
            - Reservado. (3)         - Eliminado (0)
        */
                                    switch ( $val->disponibilidad ) {
                                        case '1':
                                            $classd= "btn btn-success btn-xs";
                                            $d = "LIBRE";
                                            break;
                                        case '2':
                                            $classd= "btn btn-danger btn-xs";
                                            $d ="OCUPADO";
                                            break;
                                        case '3':
                                            $classd= "btn btn-warning btn-xs";
                                            $d ="RESERVADO";
                                            break;
                                        case '4':
                                            $classd= "btn btn-info btn-xs";
                                            $d ="INACTIVO";
                                            break;
                                        case '5':
                                            $classd= "btn btn-primary btn-xs";
                                            $d ="EVENTUAL";
                                            break;
                                        case '6':
                                            $classd= "btn btn-danger btn-xs";
                                            $d ="MENSUAL";
                                            break;
                                    }

                                    ?>
                                        
                                    <button type="button" class='<?= $classd ?>'>
                                    <?= $d ?>
                                    </button>

                                    </td>
                                    <td class='text-center'><?php

                                     $e = $val->estado;
                                    if( $val->disponibilidad == '2'){
                                        if($val->cambiosabana!='1900-01-01'){
                                             if($val->cambiosabana <= date("Y-m-d") && $val->estcambiosabana=='0'){
                                                $e = '3';
                                            }
                                        }
                                       
                                    }
    
                                    switch ($e) {
                                        case '1':
                                            $classe= "btn btn-success btn-xs";
                                            $e ="LIMPIO";
                                            break;
                                        case '2':
                                            $classe= "btn btn-danger btn-xs";
                                            $e ="SUCIO";
                                            break;
                                         case '3':
                                            $classe= "btn btn-info btn-xs";
                                            $e ="CAMBIO SABANA";
                                            break;
                                    }
                                   
                                    ?>
                                    <button type="button" class='<?= $classe ?>'>
                                    <?= $e ?>
                                    </button>

                                    </td>
                                    
                            
                                    <td class='text-center'>
                                        <button onclick="form_estado('<?= $val->idhabitacion ?>')" type="button" class='btn btn-info btn-sm'>
                                            Estado
                                        </button>
                                        <button onclick="form_edit('<?= $val->idhabitacion ?>')" type="button" class='btn btn-warning btn-sm'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                         <button onclick="showEliminar('<?= $val->idhabitacion ?>')" type="button" class='btn btn-danger btn-sm'>
                                             <i class="fa fa-trash-o"></i>
                                         </button>
                                         <button onclick="verhistorial('<?= $val->idhabitacion ?>')" type="button" class='btn btn-info btn-sm'>
                                             Historial
                                         </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            
                        </table>

                    </div>
                </div>
            </div>
            
        </div>