<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Morosos</h3>
                    <p class="text-muted">Lista de todos los Morosos del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <!--th>Tipo Documento</th-->
                                    <th>Nro. Documento</th>
                                    <th>Apellidos</th>
                                    <th>Nombres</th>
                                    <th>Concepto</th>
                                    <th>Monto(S/.)</th>
                                    <th>Estado</th>

                                    <th class='text-center'>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>

                                    <td><?= $cont++ ?></td>
                                    <td><?= date_format(new Datetime($val->fecha),"Y-m-d") ?></td>
                                    <!--td><?= ($val->tipodocumento == '0')? "DNI":"Pasapote" ?></td-->
                                    <td><?= $val->nrodocumento ?></td>
                                    <td><?= $val->apellidos ?></td>
                                    <td><?= $val->nombres ?></td>
                                    <td><?= $val->concepto ?></td>
                                    <td><?= number_format($val->monto,'2') ?></td>
                                    <td>
                                        <?php if($val->estado == '1'){ ?>
                                            <button type="button" class='btn btn-warning btn-xs'>
                                                Pendiente
                                            </button>
                                        <?php }else if($val->estado == '2'){ ?>
                                            <button type="button" class='btn btn-danger btn-xs'>
                                                Cancelado
                                            </button>
                                        <?php } ?>
                                    </td>
                                    
                                    <td class='text-center'>
                                        <button onclick="pagarmorosidad('<?= $val->idmorosidad ?>')" type="button" class='btn btn-success btn-xs'>
                                            Pagar
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