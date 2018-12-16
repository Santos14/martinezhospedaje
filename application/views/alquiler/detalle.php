<?php 
    $deuda_habitacion = $data["deuda_habitacion"][0];
    $deuda_compras = $data["deuda_ventas"][0];
    $deuda_imprevistos = $data["deuda_imprevistos"][0];
    
    $deuda_total = $deuda_habitacion+$deuda_compras+$deuda_imprevistos;
    
?>

<div class="modal-header">
    <h4 class="btn btn-info modal-title"><strong>Cuarto N° <?= $data["alquiler"][0]->nrohabitacion ?></strong></h4>
</div>
<div class="modal-body">
          
    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Detalle</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Estancia</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab1" data-toggle="tab" aria-expanded="false">Compras</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Imprevistos</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Amortizaciones</a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            
            
            <!-- PANEL DETALLE ALQUILER -->
            
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                <p><strong>Cliente:</strong> <?= $data["alquiler"][0]->nombres." ".$data["alquiler"][0]->apellidos ?></p>
                <p><strong>Telefono:</strong> <?= $data["alquiler"][0]->telefono ?></p>
                <p><strong>Procedencia:</strong> <?= $data["alquiler"][0]->lugar ?></p>
                <p><strong>Localidad:</strong> <?= $data["alquiler"][0]->localidad ?></p>
                <p><strong>Tipo Alquiler:</strong> <?= $data["alquiler"][0]->tipoalquiler ?></p>
                <p><strong>Precio x Dia:</strong> S/. <?= $data["alquiler"][0]->precioxdia ?></p>
                <p><strong>Fecha Ingreso:</strong> <?= $data["alquiler"][0]->fecha_ingreso ?></p>
                <p><strong>Motivo Viaje:</strong> <?= $data["alquiler"][0]->motivoviaje ?></p>
                <p><strong>Cambio Sabana:</strong> <?= $data["alquiler"][0]->cambiosabana ?></p>
                <p><strong>KIT:</strong> <?= ($data["alquiler"][0]->kit=='1')? "SI":"NO" ?></p>

                <br><br>
                <div class="text-center">
                  DEUDA TOTAL(S/.) <input style="color: #FFF;width: 100px;text-align:center;font-weight:bold;font-size: 16px;background: #41b3f9; border:1px solid silver;border-radius: 10px;padding: 5px;" name="deutotal" id="deutotal" value="<?= number_format($deuda_total,'2') ?>" readonly> 

                </div>

            </div>

            <!-- PANEL ESTANCIA -->
            
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                <table class="table" id="estancia">
                    <thead>
                        <tr>
                            <th>Dia</th>
                            <th>Fecha</th>
                            <th>Precio</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cont = 1; ?>
                        <?php foreach ($data["cronograma_estancia"][0] as $reg) { ?>
                        <tr>
                            <td><?= $cont++ ?></td>
                            <td><?= $reg[0] ?></td>
                            <td><?= $reg[1] ?></td>
                            <td>
                                <?php if($reg[2]=='Cancelado'){ ?>
                                <button type="button" class="btn btn-success btn-xs"><?= $reg[2] ?></button>
                                <?php }else{ ?>
                                <button type="button" class="btn btn-warning btn-xs"><?= $reg[2] ?></button>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <div class="text-center">   
                  DEUDA(S/.) <input style="color: #FFF;width: 100px;text-align:center;font-weight:bold;font-size: 16px;background: #41b3f9; border:1px solid silver;border-radius: 10px;padding: 5px;" name="deudaxhabitacion" id="deudaxhabitacion" readonly="" value="<?= number_format($deuda_habitacion,'2') ?>">  
                </div>
            </div>

          <!-- PANEL COMPRAS -->

            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab1">
                <table class="table" id="compras">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data["lista_ventas"][0] as $comp) { ?>
                        <tr>
                            <td><?= $comp[0] ?></td>
                            <td><?= $comp[1] ?></td>
                            <td>
                                <?php if($comp[2]=='Cancelado'){ ?>
                                <button type="button" class="btn btn-success btn-xs"><?= $comp[2] ?></button>
                                <?php }else{ ?>
                                <button type="button" class="btn btn-warning btn-xs"><?= $comp[2] ?></button>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <div class="text-center">
                    DEUDA(S/.) <input style="color: #FFF;width: 100px;text-align:center;font-weight:bold;font-size: 16px;background: #41b3f9; border:1px solid silver;border-radius: 10px;padding: 5px;" id="deudacompras" name="deudacompras" readonly="" value="<?= number_format($deuda_compras,'2') ?>">  
                 </div>
            </div>
          
            <!-- PANEL IMPREVISTOS -->
          
            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab2">

                <table class="table" id="imprevistos">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo Imprevisto</th>
                            <th>Total</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data["lista_imprevisto"][0] as $imp) { ?>
                        <tr>
                            <td><?= $imp[0] ?></td>
                            <td><?= $imp[1] ?></td>
                            <td><?= $imp[2] ?></td>
                            <td>
                                <?php if($imp[3]=='Cancelado'){ ?>
                                <button type="button" class="btn btn-success btn-xs"><?= $imp[3] ?></button>
                                <?php }else{ ?>
                                <button type="button" class="btn btn-warning btn-xs"><?= $imp[3] ?></button>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <div class="text-center">
                    DEUDA(S/.) <input style="color: #FFF;width: 100px;text-align:center;font-weight:bold;font-size: 16px;background: #41b3f9; border:1px solid silver;border-radius: 10px;padding: 5px;" id="deudaimprevisto" name="deudaimprevisto" readonly="" value="<?= number_format($deuda_imprevistos,'2') ?>">  
                </div>
            </div>
            
            <!-- PANEL AMORTIZACIONES -->
          
            <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab3">

                <table class="table" id="amortizaciones">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Tipo Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data["lista_amortizacion"][0] as $amo) { ?>
                        <tr>
                            <td><?= $amo[0] ?></td>
                            <td><?= $amo[1] ?></td>
                            <td>
                                <?php if($amo[2]=='D'){ ?>
                                <button type="button" class="btn btn-success btn-xs">Dinero</button>
                                <?php }else{ ?>
                                <button type="button" class="btn btn-warning btn-xs">Puntos</button>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>   
                
            </div>  
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">
        Cerrar
    </button>
</div>
