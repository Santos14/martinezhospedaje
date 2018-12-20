 <table class="table" id="clientes">
        <thead>
            <tr>
                <td>#</td>
                <td>Tipo Doc</td>
                <td>N° Doc</td>
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
                <td>
                <?php 
                    if($cli->tipodocumento=='0'){
                        echo "DNI";
                    }else{
                        echo "Pasaporte";
                    }
                ?>      
                </td>
                <td><?= $cli->nrodocumento ?></td>
                <td><?= $cli->nombres ?></td>
                <td><?= $cli->apellidos ?></td>
                
                <td>
                    <?php if($option == '1'){ ?>
                    <button class="btn btn-success btn-xs" onclick="seleccionaCliente('<?= $cli->idcliente ?>','<?= $cli->nombres ?>','<?= $cli->apellidos ?>','<?= $cli->nrodocumento ?>','<?= $cli->tipodocumento ?>')">Agregar</button>
                    <?php }else if($option == '2'){ ?>
                      <button class="btn btn-success btn-xs" onclick="add_cliente_recomendador('<?= $cli->idcliente ?>','<?= $cli->nombres ?>','<?= $cli->apellidos ?>','<?= $cli->nrodocumento ?>')">Agregar</button>
                    <?php }else{ ?>
                    <button class="btn btn-success btn-xs" onclick="add_cliente_edit('<?= $cli->idcliente ?>','<?= $cli->nombres ?>','<?= $cli->apellidos ?>','<?= $cli->nrodocumento ?>')">Agregar</button>  
                    <?php } ?>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>