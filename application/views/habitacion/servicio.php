<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Servicio</h3>
            <p class="text-muted">Llene los Servicios con los que cuenta la Habitacion</p>
            <button onclick="serv_add()" type="button" class='btn btn-success btn-sm'>
                <i class="fa fa-plus"></i> Agregar
            </button>
            <div class="table-responsive">
                 <table class="table" id="tableservicio">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Servicio</th>
                            <th class='text-center'>Agregar</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cont=1; ?>
                        <?php foreach($servicios as $serv):?>
                        <tr>

                            <td>
                                <?= $cont++ ?>
                            </td>
                            <td ><?= $serv->descripcion ?></td>
                            <td class='text-center'><input id="serv_check<?= $serv->idservicio ?>" class="serv_opcion" type="checkbox" name="serv_cheks[]" value="<?= $serv->idservicio ?>"></td>
                            
                            <td class='text-center'>
                                <button onclick="serv_edit('<?= $serv->idservicio ?>')" type="button" class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </button>
                                 <button onclick="serv_elim('<?= $serv->idservicio ?>')" type="button" class='btn btn-danger btn-sm'>
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