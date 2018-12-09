<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Mototaxistas</h3>
                    <p class="text-muted">Lista de todos los Mototaxistas Socios del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DNI</th>                                                      
                                    <th>Apellidos</th>
                                    <th>Nombres</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th class='text-center'>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>

                                    <td><?= $cont++ ?></td>
                                    <td><?= $val->dni ?></td>
                                    <td><?= $val->apellidos ?></td>
                                    <td><?= $val->nombres ?></td>
                                    <td><?= $val->direccion ?></td>
                                    <td><?= $val->telefono ?></td>
                                    
                                    <td class='text-center'>
                                        <button onclick="form_edit('<?= $val->idtransportista ?>')" type="button" class='btn btn-warning btn-sm'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                         <button onclick="showEliminar('<?= $val->idtransportista ?>')" type="button" class='btn btn-danger btn-sm'>
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