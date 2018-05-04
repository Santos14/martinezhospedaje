

<h3 align="center"><strong><u>ESTADISTICA DEL MES DE 
    <?php 
        switch ($mes) {
            case '1':
                $nmes = "ENERO";
                break;
             case '2':
                $nmes = "FEBRERO";
                 break;
            case '3':
                $nmes = "MARZO";
                break;
            case '4':
                $nmes = "ABRIL";
                break;
            case '5':
                $nmes = "MAYO";
                # code...
                break;
            case '6':
                $nmes = "JUNIO";
                # code...
                break;
            case '7':
                $nmes = "JULIO";
                # code...
                break;
            case '8':
                $nmes = "AGOSTO";
                # code...
                break;
            case '9':
                $nmes = "SETIEMBRE";
                # code...
                break;
            case '10':
                $nmes = "OCTUBRE";
                # code...
                break;
            case '11':
                $nmes = "NOVIEMBRE";
                # code...
                break;
            case '12':
                $nmes = "DICIEMBRE";
                # code...
                break; 
        }
        echo $nmes." DEL ".$anio;

    ?></u>
</strong></h3>
<br>
<br>
<table class="table table-bordered">
    <legend>CAPITULO I: IDENTIFICACION Y UBICACION DEL ESTABLECIMIENTO</legend>
    <tr>
        <td>Razon Social</td>
        <td>MARIA LILA TUESTA DE MARTINEZ</td>
        <td>RUC</td>
        <td colspan="5">10009110696</td>
   
    </tr>
    <tr>
        <td>Nombre Comercial</td>
        <td>HOSPEDAJE MARTINEZ</td>
        <td>Clase</td>
        <td></td>
        <td>Categoria</td>
        <td></td>s
        <td>Nro Certificado</td>
        <td>S/N</td>
        
    </tr>
    <tr>
        <td>Direccion</td>
        <td>Julio C. Pinedo # 152</td>
        <td>Telf. Fijo</td>
        <td>065352935</td>
        <td >Sist. de Coord.</td>
        <td colspan="3"></td>

    </tr>
    <tr>
        <td>Region</td>
        <td>LORETO</td>
        <td>Provincia</td>
        <td>Alto Amazonas</td>
        <td>Distrito</td>
        <td colspan="3">Yurimaguas</td>


    </tr>
    <tr>
        <td>Pagina Web</td>
        <td></td>
        <td>E-mail para Reservas</td>
        <td colspan="5"></td>

    </tr>
</table>
<br>
<br>
 <table class="table table-bordered">
    <legend>CAPITULO II: CAPACIDAD DE ALOJAMIENTO OFERTADA / UTILIZADA Y TARIFAS DEL MES</legend>
    
    <tr>
        <td rowspan="3">TIPO DE HABITACION / DEPARTAMENTO</td>
        <td colspan="3">CAPACIDAD DE ALOJAMIENTO OFERTADA</td>
        <td colspan="3">ALOJAMIENTO UTILIZADO</td>
        <td colspan="2" rowspan="2">TARIFA POR DIA HOTELERO</td>
                       
    </tr>
    <tr>
        <td colspan="2">Nro Habitaciones Ofertadas</td>
        <td rowspan="2">Numero de "Plazas Cama"</td>
        <td rowspan="2">Nro de ARRIBOS DE PERSONAS</td>
        <td rowspan="2">Nro de HABITACIONES NOCHE-OCUPADAS</td>
        <td rowspan="2">Nro de PERNOTACIONES</td>                             
    </tr>
    <tr>    
        <td>Con Baño</td>
        <td>Sin Baño</td>
        <td>Con Baño</td>
        <td>Sin Baño</td>
    </tr>
    <?php 
    $total_cB = 0 ;
    $total_sB = 0 ;
    ?>
    <tr>
        <td>Individuales o Simples</td>
        <td><?php $icb = count($ind_conB); echo $icb; $total_cB+=$icb;  ?></td>
        <td><?php $isb = count($ind_sinB); echo $isb; $total_sB+=$isb;  ?></td>
        <td>

        <?php
            $tarribos=0;
            $total_nrocamas=0;
            $cont = 0;
            $tnocupada = 0;
            $tpern = 0;
            foreach ($nrocamas_ind as $nro) {
                if($nro->especificacion >=1){
                    $cont++;
                }
             } 
             $total_nrocamas+=$cont;
             echo $cont;
        ?>
            
        </td>
        <td><?php $aind = $arrib_ind[0]->arribos; echo $aind; $tarribos+=$aind;  ?></td>
        <td>
        <?php
            $sum_t = 0;
            foreach ($hbnoche_ind as $hbn) {
                 $sum_t+=$hbn->totaldias;
            }
            $tnocupada+=$sum_t;
            echo $sum_t;

        ?>
                
        </td>
        <td><?php $pt = $sum_t; echo $pt;  $tpern+=$pt;?></td>
        <td>15.00</td>
        <td>10.00</td> 
    </tr>
    <tr>
        <td>Dobles y Matrimoniales</td>
        <td><?php $mcb = count($mat_conB)+count($dob_conB); echo $mcb; $total_cB+=$mcb;  ?></td>
        <td><?php $msb = count($mat_sinB)+count($dob_sinB); echo $msb; $total_sB+=$msb;  ?></td>
        <td>
            
            <?php

                $cont = 0;
                foreach ($nrocamas_mat as $nro) {
                    if($nro->especificacion >=2){
                        $cont+=2;
                    }
                } 
                 foreach ($nrocamas_dob as $nro) {
                    if($nro->especificacion >=1 && $nro->especificacion <2 ){
                        $cont+=1;
                    }else if($nro->especificacion >=2 ){
                        $cont+=2;
                    }
                } 
                 $total_nrocamas+=$cont;
                 echo $cont;
            ?>


        </td>
        <td><?php $msb = $arrib_mat[0]->arribos+$arrib_dob[0]->arribos; echo $msb; $tarribos+=$msb;  ?></td>
        <td>
        <?php
            $sum_ta = 0;
            foreach ($hbnoche_mat as $hbn) {
                 $sum_ta+=$hbn->totaldias;
            }
            foreach ($hbnoche_dob as $hbn) {
                 $sum_ta+=$hbn->totaldias;
            }
            $tnocupada+=$sum_ta;
            echo $sum_ta;

        ?>
        </td>
        <td><?php $pt2 = $sum_ta*2; echo $pt2;  $tpern+=$pt2;?></td>
        <td>25.00</td>
        <td>15.00</td> 
    </tr>
    <tr>
        <td>TOTAL</td>
        <td><?= $total_cB ?></td>
        <td><?= $total_sB ?></td>
        <td><?= $total_nrocamas ?></td>
        <td><?= $tarribos ?></td>
        <td><?= $tnocupada ?></td>
        <td><?= $tpern ?></td>
        <td>0</td>
        <td>0</td> 
    </tr>
</table>

<br>
<br>
 <table class="table table-bordered">
    <legend>CAPITULO III: NUMERO DE ARRIBOS DE HUESPEDES POR DIA DEL MES</legend>
     
    <?php
    $dias = getMonthDays(4, 2018);
    $cont = 1;
    $sum_da = 0;

    for ($f=0; $f < 4; $f++) {

        echo  "<tr>"; 
        for ($c=0; $c <16 ; $c++) { 
            if($cont<=31){  
                if($c%2 == 0){
                    echo "<td>Dia ".$cont." °</td>";  
                 
                    
                }else{
                    $s = false;
                    $da=0;
                    foreach ($arrib_dias as $d) {
                        $s = date("j",strtotime($d->ingreso));
                        if($s == $cont){
                            $s=true;
                            $da = $d->veces;
                            break;
                        }
                    }
                    if($s){
                        echo "<td>".$da."</td>";   
                    }else{
                        echo "<td>".$da."</td>";
                    }
                    $sum_da+=$da; 
                   
                    $cont++;
                }
            
                
            }else{
                if($c%2 == 0){
                    echo "<td>TOTAL</td>";
                }else{
                    echo "<td>".$sum_da."</td>";
                }
            }

            
            
        }
        echo  "</tr>";
    }

    ?>
   
</table>
<br>
<br>
<legend>CAPITULO IV: ARRIBOS Y PERNOTACIONES SEGUN LUGAR DE RESIDENCIA</legend>

<div class="row">
    <div class="col-md-6">
        <legend>Extranjeros y no Residentes en el Peru</legend>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pais o Continente</th>
                    <th># Arribos</th>
                    <th># Pernotaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $tarribosext = 0;
                $tpernext = 0;
                $tarribosnac = 0;
                $tpernnac = 0;
                ?>
                <?php foreach ($proc_ext as $pext): ?>
                    <tr>
                        <td><?= $pext->lugar ?></td>
                        <?php 
                        $nropert = 0;
                        $arribos = 0;
                        foreach ($arrib_proc as $arr) {
                            if($arr->idprocedencia == $pext->idprocedencia){
                                $arribos = $arr->nroarribos;
                                break;
                            }
                        }
                        foreach ($pernt_proc as $arr) {
                            if($arr->idprocedencia == $pext->idprocedencia){
                                $nropert = $arr->nropernotaciones;
                                break;
                            }
                        }
                         $tarribosext += $arribos;
                         $tpernext+=$nropert;
                        ?>

                        <td><?= $arribos ?></td>
                        <td><?= $nropert ?></td>
                    </tr>  
                <?php endforeach ?> 
                <tr>
                    <td>TOTAL</td>
                    <td><?= $tarribosext ?></td>
                    <td><?= $tpernext ?></td>

                </tr>
                                                       
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <legend>Peruanos y Residentes en el Peru</legend>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Regiones</th>
                    <th># Arribos</th>
                    <th># Pernotaciones</th>
                </tr>
            </thead>
            <tbody>
                   
                <?php foreach ($proc_nac as $pnac): ?>
                    <tr>
                        <td><?= $pnac->lugar ?></td>
                         <?php 
                        $arribos = 0;
                        $nropert = 0;
                        foreach ($arrib_proc as $arr) {
                            if($arr->idprocedencia == $pnac->idprocedencia){
                                $arribos = $arr->nroarribos;
                                break;
                            }
                        }
                        foreach ($pernt_proc as $arr) {
                            if($arr->idprocedencia == $pnac->idprocedencia){
                                $nropert = $arr->nropernotaciones;
                                break;
                            }
                        }
                        $tarribosnac+=$arribos;
                        $tpernnac+=$nropert;
                        ?>
                        <td><?=  $arribos ?></td>
                        <td><?=  $nropert ?></td>
                    </tr>  
                <?php endforeach ?>  
                <tr>
                    <td>TOTAL</td>
                    <td><?= $tarribosnac ?></td>
                    <td><?=  $tpernnac ?></td>

                </tr>                                
            </tbody>
        </table>
    </div>
</div>
 <br>
<br>
<legend>CAPITULO V: MOTIVO PRINCIPAL DEL VIAJE DE LOS HUESPEDES</legend>
<?php 
$cont1 = array();
$cont2 = array();
 ?>
<table class="table table-bordered">
    <tr>
        <td>DETALLE</td>
        <?php foreach ($motvviaje as $mo): ?>
            <td><?= $mo->descripcion ?></td>
        <?php endforeach ?>
    </tr>
    <tr>
        <td>Extranjeros</td>
        <?php foreach ($motvviaje as $mo): 
                $nroarr = 0;
                foreach ($arrib_movi as $mov) {
                    if($mov->tipoprocedencia == 'E'){
                        if($mov->idmotivoviaje == $mo->idmotivoviaje){
                            $nroarr = $mov->nroarribos;

                            break;
                        }
                    }
                }
                $cont1[] =  $nroarr;
        ?>
            <td><?=  $nroarr ?></td>
        <?php endforeach ?>
    </tr>
     <tr>
        <td>Nacionales</td>
         <?php foreach ($motvviaje as $mo): 
                $nroarr = 0;
                foreach ($arrib_movi as $mov) {
                    if($mov->tipoprocedencia == 'N'){
                        if($mov->idmotivoviaje == $mo->idmotivoviaje){
                            $nroarr = $mov->nroarribos;
                            break;
                        }
                    }
                }
                $cont2[] =  $nroarr;
        ?>
        <td><?=  $nroarr ?></td>
        <?php endforeach ?>
    </tr>
     <tr>
        <td>TOTAL</td>
       <?php for ($i=0; $i < count($cont1) ; $i++) { ?>
           <td><?= $cont1[$i]+$cont2[$i] ?></td>
       <?php } ?>
    </tr>
</table>

