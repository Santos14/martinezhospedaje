<?php 
    if(count($ingreso)!=0){
        $ingreso = $ingreso[0]->monto;
    }else{
        $ingreso = 0;
    }

    if(count($egreso)!=0){
         $egreso = $egreso[0]->monto;
    }else{
        $egreso = 0;
    }   

?>



<div class="row">
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Ingresos:</h3>
            <ul class="list-inline two-part">
                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">S/. <?= number_format($ingreso,'2') ?></span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Egresos:</h3>
            <ul class="list-inline two-part">
                <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">S/. <?= number_format($egreso,'2') ?></span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Saldo Actual:</h3>
            <ul class="list-inline two-part">

                <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">S/. <?= number_format($ingreso-$egreso,'2') ?></span></li>
            </ul>
        </div>
    </div>
</div>



<div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Movimientos</h3>
                    <p class="text-muted">Lista de todos los Movimientos del Hospedaje Martinez</p>
                    <div class="table-responsive">
                         <table class="table" id='datatable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo Movimiento</th>
                                    <th>Concepto</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont=1; ?>
                                <?php foreach($data->result() as $val):?>
                                <tr>

                                    <td><?= $cont++ ?></td>
                                    <td><?= $val->tipomovimiento ?></td>
                                    <td><?= $val->concepto ?></td>
                                    <td><?= $val->fecha ?></td>
                                    <td><?= number_format($val->monto,'2') ?></td>
                                    
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            
                        </table>

                    </div>
                </div>
            </div>
            
        </div>