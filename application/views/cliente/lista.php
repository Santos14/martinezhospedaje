<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Clientes</h3>
                    <p class="text-muted">Lista de todos los Clientes del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo Documento</th>                           
                                    <th>Nro Documento</th>                           
                                    <th>Apellidos</th>
                                    <th>Nombres</th>
                                    <th>Ocupacion</th>
                                    <th class='text-center'>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>

                                    <td><?= $cont++ ?></td>
                                    <td><?= ($val->tipodocumento=='0')? "DNI":"Pasaporte" ?></td>
                                    <td><?= $val->nrodocumento ?></td>
                                    <td><?= $val->apellidos ?></td>
                                    <td><?= $val->nombres ?></td>
                                    <td><?= $val->ocupacion ?></td>
                                    
                                    <td class='text-center'>
                                        <button onclick="form_edit('<?= $val->idcliente ?>')" type="button" class='btn btn-warning btn-sm'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                         <button onclick="showEliminar('<?= $val->idcliente ?>')" type="button" class='btn btn-danger btn-sm'>
                                             <i class="fa fa-trash-o"></i>
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