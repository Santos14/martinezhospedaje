<table class="table" id="habdesocupadas">
    <thead>
        <tr>
            <th>#</th>
            <th>Habitacion</th>
            <th>Precio</th>
            <th>Tipo</th>
            <th>Servicios</th>
            <th>Disponibilidad</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        <?php $cont = 1; ?>
        <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $cont++ ?></td>
            <td><?= $d["nrohabitacion"] ?></td>
            <td><?= $d["precio"] ?></td>
            <td><?= $d["tipohabitacion"] ?></td>
            <td><?= $d["servicios"] ?></td>
            <td>
                <button type="button" class="<?= $d["classd"] ?>"><?= $d["disponibilidad"] ?></button>
                
            </td>
            <?php if($d["disponibilidad"] == "LIBRE"){ ?>
            <td>
                <button type="button" onclick="changeHabitacion('<?= $d["idhabitacion"] ?>','<?= $d["nrohabitacion"] ?>','<?= $d["precio"] ?>')" class="btn btn-success btn-xs">Agregar</button>
            </td>
            <?php }else{ ?>
            <td>
                <button type="button" class="btn btn-secondary btn-xs">Bloqueado</button>
            </td>
            <?php } ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>