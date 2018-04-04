

<div class="row">
   <?php foreach ($habitaciones as $habitacion):?>
    <?php 
        //ARMAR LINEA DE SERVICIOS
        $serv = array();
        foreach ($servicios as $servicio):
            if($habitacion->idhabitacion == $servicio->habitacion_idhabitacion){
                $serv[] = $servicio->servicio;
            }
        endforeach;
        if(count($serv) > 0){
            $s = "(";
            for ($i = 0; $i < count($serv) ; $i++) {
                $s.=$serv[$i];
                if($i+1 >= count($serv)){
                    $s.=")";
                }else{
                    $s.=", ";
                }
            }
        }else{
            $s = "Simple";
        }
        
        //ARMAR DISPONIBILIDAD
        switch ( $habitacion->disponibilidad ) {
            case '1':
                $classd= "btn btn-success";
                $d = "LIBRE";
                break;
            case '2':
                $classd= "btn btn-danger";
                $d ="OCUPADO";
                break;
            case '3':
                $classd= "btn btn-warning";
                $d ="RESERVADO";
                break;
        }
        //ARMAR ESTADO

        $e = $habitacion->estado;
        if( $habitacion->disponibilidad == '2'){
            if($habitacion->cambiosabana!='1900-01-01'){
                 if($habitacion->cambiosabana <= date("Y-m-d") && $habitacion->estcambiosabana=='0'){
                    $e = '3';
                }
            }
           
        }
        
        switch ($e) {
            case '1':
                $estadocuarto = '1';
                $classe= "btn btn-default btn-xs";
                $e ="Limpio";
                break;
            case '2':
                $estadocuarto = '2';
                $classe= "btn btn-danger btn-xs";
                $e ="Sucio";
                break;
             case '3':
                $estadocuarto = '3';
                $classe= "btn btn-info btn-xs";
                $e ="Cambio Sabana";
                break;
        }
    ?>


    <div class="col-sm-2">
        
        <div class="white-box" id='box'>
            <div class='text-left'>
                <?php if($habitacion->disponibilidad=="2"){?>
                <a onclick="salir('<?= $habitacion->idalquiler ?>')" class="btn btn-default btn-xs" id="part_izquierda">
                    Salir
                </a>
                <a onclick="detalle('<?= $habitacion->idalquiler ?>')" class="btn btn-danger btn-xs" id="part_derecha">
                    Detalle
                </a>
                <?php }else if($habitacion->disponibilidad=="1"){?>
                <a onclick="reservar('<?= $habitacion->idhabitacion ?>')" class="btn btn-default btn-xs" id="part_izquierda">
                    Reservar
                </a>
                <a onclick="alquilar('<?= $habitacion->idhabitacion ?>')" class="btn btn-success btn-xs" id="part_derecha">
                    Alquilar
                </a>
                <?php }else if($habitacion->disponibilidad=="3"){?>
                <a onclick="cancelar('<?= $habitacion->idhabitacion ?>')" class="btn btn-default btn-xs" id="part_izquierda">
                    Cancelar
                </a>
                <a onclick="alquilar_reservacion('<?= $habitacion->idhabitacion ?>')" class="btn btn-warning btn-xs" id="part_derecha">
                    Alquilar
                </a>

                <?php }?>

            </div>
            
            <h3 class="box-title text-center" id='title_nro'><strong><?= $habitacion->nrohabitacion ?></strong></h3>
            <p class="text-center" id='type'><?= $habitacion->tipohabitacion ?></p>
            <p class="text-center" id='service'><?= $s ?></p>
            <p class="text-center" id='price'>S/. <?= $habitacion->precio ?></p>
            <p class="text-center" id="u">
                <a onclick="cambioestado('<?= $estadocuarto ?>','<?= $habitacion->idhabitacion ?>')" class="<?= $classe ?>">
                    <?= $e ?>
                </a>
            </p>
             
            
        </div>
        <p onclick="ver('<?=$habitacion->disponibilidad ?>','<?= $habitacion->idhabitacion ?>')" class="<?= $classd ?>" id='btn_estado'>
            <strong><?= $d ?></strong>
        </p>
    </div>
    <?php endforeach;?>
</div>




<div id="modalDetalle" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content" id="detalleHAB">
            
        </div>
    </div>
</div>
<div id="modalSalir" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content" id="salirHAB">
            
        </div>
    </div>
</div>