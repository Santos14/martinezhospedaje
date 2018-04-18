<div class="modal-header">
<h4 class="modal-title">Detalle Alquiler</h4>

</div>
<div class="modal-body">

<p><strong>Cuarto N°:</strong> <?= $habitacion[0]->nrohabitacion ?></p>
<p><strong>Estado:</strong>
<?php
switch ($alquiler[0]->estado) {
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
</p>
<p><strong>Tipo Alquiler:</strong> <?= $tipoalquiler[0]->descripcion ?></p>
<p><strong>Motivo Viaje:</strong> <?= $motivoviaje[0]->descripcion ?></p>
<p><strong>Cliente:</strong> <?= $cliente[0]->apellidos.", ".$cliente[0]->nombres ?></p>
<p><strong>Procedencia:</strong> <?= $procedencia[0]->lugar ?></p>
<p><strong>Localidad:</strong> <?= $alquiler[0]->localidad ?></p>
<p><strong>Precio x Dia:</strong> S/. <?= $alquiler[0]->precioxdia ?></p>
<p><strong>Fecha Ingreso:</strong> <?= $alquiler[0]->fecha_ingreso ?></p>

<?php if($alquiler[0]->estado == '2'):?>
<p><strong>Fecha Salida:</strong> 
<?php 

$fs = new DateTime($alquiler[0]->fecha_salida);
if(date_format($fs,"Y-m-d") == '1900-01-01'){
    echo "Alquiler Activo";
}else{
    echo $alquiler[0]->fecha_salida;;
}


?>
</p>

<p><strong>Nro Dias:</strong> <?= $alquiler[0]->nrodias." dias" ?></p>
<p><strong>Evaluacion:</strong> <?php 
if($alquiler[0]->evaluacion==""){
    echo "No tiene";
}else{
  echo $alquiler[0]->evaluacion;
}
?></p>
<?php endif;?>


</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">
    Cerrar
  </button>
</div>
