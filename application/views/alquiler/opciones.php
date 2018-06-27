<input type="hidden" name="idalquiler_actual" id="idalquiler_actual" value="<?= $alq[0]->idalquiler ?>">

<div class="text-center">


<h4 class="modal-title">OPCIONES DE ALQUILER:</h4><br>

 <p><button onclick="ver_alquiler()" style='width: 200px;' class='btn btn-info'><i class='fa fa-eye'></i> VER ALQUILER</button></p>
<p><button onclick="edit_alquiler()" style='width: 200px;' class='btn btn-warning'><i class='fa fa-edit'></i> EDITAR ALQUILER</button></p>
<?php if($alq[0]->estado != '2'){ ?>
 <p><button onclick="anular_alquiler()" style='width: 200px;' class='btn btn-danger'><i class='fa fa-close'></i> ANULAR ALQUILER</button></p>
<?php } ?>
 
</div>