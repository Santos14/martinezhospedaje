<table class="table" id='datatable'>
    <thead>
        <tr>
            <th>#</th>

            <th>Almacen</th>
            <th>Encargo</th>
            <th>Ingreso</th>
            <th>Nro Dias</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php $cont=1; ?>
        <?php foreach($encargo as $val):?>
        <tr>
            <?php 
                $fIngr = new DateTime($val->fecha_ingreso);
                $fSal = new DateTime($val->fecha_salida);

            ?>
            <td><?= $cont++ ?></td>

            <td><?= $val->almacen ?></td>
            <td><?= $val->descripcion ?></td>
            <td><?= date_format($fIngr,'d-m-Y') ?></td>
            
            <td>
            <?php
                if(date_format($fSal,'d-m-Y')=='01-01-1900'){
                    $fSal = new DateTime("now");
                }
                $dias = (strtotime(date_format($fIngr,"Y-m-d"))-strtotime(date_format($fSal,"Y-m-d")))/86400;
                $dias = abs($dias); $dias = floor($dias); 
                echo $dias;

            ?>
            </td>
            <td>
            <?php
            $bt = "";
            switch ($val->estado) {
                case '1':
                    $bt ="<button type='button' class='btn btn-warning btn-xs'>En Almacen</button>";
                    break;
                case '2':
                    $bt ="<button type='button' class='btn btn-success btn-xs'>Entregado</button>";
                    break;
            }

           echo $bt;
            ?>

            </td>
         
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>
