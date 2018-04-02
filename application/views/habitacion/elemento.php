<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Elementos</h3>
            <p class="text-muted">Llene los Elementos con los que cuenta la Habitacion</p>
            <button onclick="elem_add()" type="button" class='btn btn-success btn-sm'>
                <i class="fa fa-plus"></i> Agregar
            </button>
            <div class="table-responsive">
                 <table class="table" id="tableelemento">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Elemento</th>
                            <th class='text-center'>Seleccionar</th>
                            <th class='text-center'>Especificacion</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cont=1; ?>
                        <?php foreach($elementos as $elem):?>
                        <tr>

                            <td>
                                <?= $cont++ ?>        
                            </td>
                            <td ><?= $elem->descripcion ?></td>
                            <td class='text-center'>
                                <input type="checkbox" id="elem_check<?= $elem->idelemento ?>" class="elem_opcion" onclick="showEsp(this,'<?= $elem->idelemento ?>')"  name="elem_cheks[]" value='<?= $elem->idelemento ?>'>
                            </td>
                            <td class='text-center'><input maxlength="50" id='elem_text<?= $elem->idelemento ?>' disabled name="elem_especificacion[]"></td>
                            
                            <td class='text-center'>
                                <button onclick="elem_edit('<?= $elem->idelemento ?>')" type="button" class='btn btn-warning btn-sm'>
                                    <i class="fa fa-edit"></i>
                                </button>
                                 <button onclick="elem_elim('<?= $elem->idelemento ?>')" type="button" class='btn btn-danger btn-sm'>
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