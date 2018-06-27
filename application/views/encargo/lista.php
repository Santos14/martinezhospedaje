<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Encargos</h3>
                    <p class="text-muted">Lista de todos los Encargos en Almacen del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Almacen</th>
                                    <th>Encargo</th>
                                    <th>Ingreso</th>
                                    <th>Salida</th>
                                    <th>Nro Dias</th>
                                    <th>Nro Doc.</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>

                                    <th class='text-center'>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>
                                    <?php 
                                        $fIngr = new DateTime($val->fecha_ingreso);
                                        $fSal = new DateTime($val->fecha_salida);

                                    ?>
                                    <td><?= $cont++ ?></td>

                                    <td><?= $val->nomalmacen ?></td>
                                    <td><?= $val->descripcion ?></td>
                                    <td><?= date_format($fIngr,'d-m-Y') ?></td>
                                    <td>
                                    <?php 

                                    if(date_format($fSal,'d-m-Y')=='01-01-1900'){
                                        echo " - ";
                                        $fSal = new DateTime("now");
                                    }else{
                                        echo date_format($fSal,'d-m-Y');
                                    }

                                    ?>
                                            
                                    </td>
                                    <td>
                                    <?php

                                        $dias = (strtotime(date_format($fIngr,"Y-m-d"))-strtotime(date_format($fSal,"Y-m-d")))/86400;
                                        $dias = abs($dias); $dias = floor($dias); 

                                        echo $dias;

                                    ?>
                                        
                                    </td>
                                    <td><?= $val->nrodocumento ?></td>
                                    <td><?= $val->nombres." ".$val->apellidos ?></td>
                                    <td>
                                    <?php
                                    $bt = "";
                                    switch ($val->estado) {
                                        case '1':
                                            $bt ="<button type='button' class='btn btn-warning btn-xs'>En Almacen</button>";
                                            break;
                                        case '2':
                                            $bt ="<button type='button' class='btn btn-success btn-xs'>Entregado</button>";
                                            break;
                                    }
                                   
                                   echo $bt;
                                    ?>
                                        
                                    </td>

                                    <td class='text-center'>

                                        <?php if($val->estado!='2'):?>
                                        <button onclick="form_edit('<?= $val->idencargo ?>')" type="button" class='btn btn-success btn-xs'>
                                            <i class="fa fa-check"></i> Entregado
                                        </button>
                                         <button onclick="showEliminar('<?= $val->idencargo ?>')" type="button" class='btn btn-danger btn-xs'>
                                             <i class="fa fa-trash-o"></i> Anulado
                                         </button>
                                         <?php else:?>
                                            <button type='button' class='btn btn-success btn-xs'>Entregado</button>
                                        <?php endif;?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            
                        </table>

                    </div>
                </div>
            </div>
            
        </div>