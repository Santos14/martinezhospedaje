 <table class="table" id="transportista">
        <thead>
            <tr>
                <td>#</td>
                <td>DNI</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Accion</td>
            </tr>
        </thead>
        <tbody>
            <?php $cont=1; ?>
            <?php foreach ($clientes as $cli): ?>
            <tr>
                <td><?= $cont++ ?></td>
                <td><?= $cli->dni ?></td>
                <td><?= $cli->nombres ?></td>
                <td><?= $cli->apellidos ?></td>
                <td><button class="btn btn-success btn-xs" onclick="add_tranportista_recomendador('<?= $cli->idtransportista ?>','<?= $cli->nombres ?>','<?= $cli->apellidos ?>','<?= $cli->dni ?>')">Agregar</button></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>