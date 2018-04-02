<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Politicas</h3>
                    <p class="text-muted">Lista de todas las Politicas del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Politica</th>
                                    <th>Valor Numerico</th>
                                    <th>Medida</th>
                                    <th>Estado</th>
                                    <th class='text-center'>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>

                                    <td><?= $cont++ ?></td>
                                    <td><?= $val->fecha ?></td>
                                    <td><?= $val->descripcion ?></td>
                                    <td><?= $val->numero ?></td>
                                    <td><?= $val->unidad_medida ?></td>
                                    <td><?= ($val->estado==1)? "Activo":"Inactivo" ?></td>
                                    
                                    <td class='text-center'>
                                        <button onclick="form_estado('<?= $val->idpoliticas ?>','<?= ($val->estado==1)? "2":"1" ?>')" type="button" class='<?= ($val->estado==1)? "btn btn-info btn-sm":"btn btn-success btn-sm" ?>'>
                                            <?= ($val->estado==1)? "Inactivar":"Activar" ?>
                                        </button>
                                        <button onclick="form_edit('<?= $val->idpoliticas ?>')" type="button" class='btn btn-warning btn-sm'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                         <button onclick="showEliminar('<?= $val->idpoliticas ?>')" type="button" class='btn btn-danger btn-sm'>
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