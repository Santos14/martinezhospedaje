 <table class="table" id="tableListacompaniante">
    <thead>
        <tr>
            <td>#</td>
            <td>N° Doc</td>
            <td>Nombres y Apellidos</td>
            <td>Accion</td>
        </tr>
    </thead>
    <tbody>
        <?php $cont=1; ?>
        <?php foreach ($acompaniante as $cli): ?>
        <tr>
            <td><?= $cont++ ?></td>
            <td><?= $cli->nrodoc ?></td>
            <td><?= $cli->nomcompleto ?></td>
            <td>
                <button class="btn btn-success btn-xs" onclick="addacompaniante('<?= $cli->nomcompleto ?>','<?= $cli->nrodoc ?>')">Agregar</button>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>