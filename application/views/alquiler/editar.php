<form id="form_al" class="form-horizontal form-label-left form-material">
    <input type="hidden" name="id" id="id" value="<?= $alquiler[0]->idalquiler ?>">
    <input type="hidden" name="idreserva" id="idreserva">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Editar Alquiler</h3>
                <input type="hidden" name="idhabitacion" id="idhabitacion" value="<?= $alquiler[0]->habitacion_idhabitacion ?>">
                <p class="text-muted">Cambie los datos Necesarios</p>
              
              <legend>Datos de la Habitacion</legend>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                        Nro. Habitacion
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input id="habitacion" name="habitacion" class="form-control" value="<?= $alquiler[0]->nrohabitacion ?>" readonly>
                    </div>
                    
                </div>
                  <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="precioxdia">
                        Precio(S/.)
                    </label>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input readonly id="precioxdia" name="precioxdia" id="precioxdia" class="form-control" value="<?= $alquiler[0]->precio ?>">
                    </div>
                </div>
                <legend>Datos del Cliente</legend>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                        Cliente
                    </label>
                    <input type="hidden" name="idcliente" id="idcliente" value="<?= $alquiler[0]->cliente_idcliente ?>">
                    
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input id="cliente" name="cliente" readonly class="form-control" value="<?= $alquiler[0]->apellidos.", ".$alquiler[0]->nombres ?>" placeholder="Cliente">
                    </div>
                     
                </div>

                 <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                    <?php 
                    if($alquiler[0]->tipodocumento == '0'){
                        echo "DNI";
                    }else{
                        echo "Pasaporte";
                    } 
                    ?>
                    </label>

                     <div class="col-md-2 col-sm-6 col-xs-12">
                        <input readonly onkeypress="return solonumeros(event)" onblur="searchdni(this)" id="al_dni" name="al_dni" class="form-control" value="<?= $alquiler[0]->nrodocumento ?>" placeholder="Nro Documento">
                    </div>


                </div>
                <legend>Datos del Alquiler</legend>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idtipoalquiler">
                        Tipo Alquiler
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">

                        <?php if($alquiler[0]->tipoalquiler_idtipoalquiler != '3'){ ?>
                   
                        <select class='form-control form-control-line' id="idtipoalquiler" name="idtipoalquiler" onchange="cambiartipoalquiler()">
                            <option value="">Seleccione...</option>


                        <?php foreach ($tipo_alquileres as $tipo):?>
                        <?php

                            if($tipo->idtipoalquiler == $alquiler[0]->tipoalquiler_idtipoalquiler){
                                $sd = "selected";
                            }else{
                                $sd = "";
                            }
                        ?>
                            <option <?= $sd ?> value="<?= $tipo->idtipoalquiler ?>"><?= $tipo->descripcion ?></option>
                        <?php endforeach;?>


                        </select>


                        <?php }else{ ?>

                             <select class='form-control form-control-line' id="idtipoalquiler" name="idtipoalquiler">

                            <option value="3">Mensual</option>
                            </select>

                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idmotivoviaje">
                        Motivo Viaje
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line' name="idmotivoviaje">
                            <option value="">Seleccione...</option>
                        <?php foreach ($motivo_viaje as $tipo):?>

                         <?php
                            if($tipo->idmotivoviaje == $alquiler[0]->motivoviaje_idmotivoviaje){
                                $sd = "selected";
                            }else{
                                $sd = "";
                            }
                        ?>

                            <option <?= $sd ?> value="<?= $tipo->idmotivoviaje ?>"><?= $tipo->descripcion ?></option>
                        <?php endforeach;?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idprocedencia">
                        Procedencia
                    </label>
                    <div class="col-md-2">
                        <?php 
                        if($tipo_procedencia[0]->tipoprocedencia == 'N'){
                            $cr ="checked";
                        }else{
                            $cr ="";
                        } 
                        ?>
                        <input type="checkbox" onclick="cambiarprocedencia(this)" <?= $cr ?> name="c_nacional" id="c_nacional"> Nacional
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line' name="idprocedencia" id="idprocedencia">
                            <option value="">Seleccione...</option>
                             <?php foreach ($tipo_procedencia as $tipo):?>

                         <?php
                            if($tipo->idprocedencia == $alquiler[0]->procedencia_idprocedencia){
                                $sd = "selected";
                            }else{
                                $sd = "";
                            }
                        ?>


                            <option <?= $sd ?>  value="<?= $tipo->idprocedencia ?>"><?= $tipo->lugar ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="localidad">
                        Localidad
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <input type="text" placeholder="Ingrese Localidad de Procedencia" id="localidad" name="localidad" value="<?= $alquiler[0]->localidad ?>" class="form-control" maxlength="200" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="kit">
                        KIT
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <?php $op = array("NO",'SI');?>
                        <select class='form-control form-control-line' name="kit">
                            <option value="">Seleccione...</option>

                            <?php for ($i=0; $i < count($op) ; $i++) { ?>
                            <?php
                                if($i == $alquiler[0]->kit){
                                    $sd = "selected";
                                }else{
                                    $sd = "";
                                }
                            ?>
                                    <option <?= $sd ?> value="<?= $i ?>"><?= $op[$i] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
    
                <?php 

                $date_i = new DateTime($alquiler[0]->fecha_ingreso);
                

                ?>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">
                        Fecha Ingreso
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="date" max="<?= date("Y-m-d") ?>" name="fecha" id="fecha" class="form-control" value="<?= $date_i->format('Y-m-d') ?>">
                    </div>
                    <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="hora">
                        Hora Ingreso
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="time" id="hora" name="hora" class="form-control" value='<?= $date_i->format('H:i:s'); ?>'>
                    </div>
                </div>
                
                <?php 
                if($alquiler[0]->tipoalquiler_idtipoalquiler == '3' || $alquiler[0]->estado == '2' ){

                        $sty = "";

                 }else{
                    $sty = "style='display:none;'";
                 }
                ?>

                <div <?= $sty ?> >
                     <?php $date_s = new DateTime($alquiler[0]->fecha_salida); ?>
                     <div class="form-group">
                        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_fin">
                            Fecha Termino
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="date" max="<?= date("Y-m-d") ?>" name="fecha_fin" id="fecha_fin" class="form-control" value="<?= $date_s->format('Y-m-d') ?>">
                        </div>
                        <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="hora_fin">
                            Hora Termino
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="time" id="hora_fin" name="hora_fin" class="form-control" value='<?= $date_s->format('H:i:s') ?>'>
                        </div>
                    </div>

                </div>

                <div <?= $sty ?> >
                    <div class="form-group">
                        <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_fin">
                            Nro Dias
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="number" name="nrodias" id="nrodias" class="form-control" value="<?= $alquiler[0]->nrodias ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="localidad">
                        Evaluacion
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <textarea id="evaluacion" name="evaluacion" class="form-control"  ><?= $alquiler[0]->evaluacion ?></textarea>
                    </div>
                </div>
         
         
                 <div class="text-center">
                    <button type="button" class="btn btn-default" onclick="window.location='<?= base_url('alquiler') ?>'">
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-success" onclick="save_edit()" id='btn_save_alquiler_edit'>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
   
</form>

<div id="modalFormulario" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">Formulario Cliente</h4>
            </div>
            <div class="modal-body" id='mCliente'>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" id="btn_add_cliente" onclick="save_cliente()">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>

<div id="modalListaClientes" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">LISTA DE CLIENTES</h4>
            </div>
            <div class="modal-body">
                <table class="table" id="clientesList">
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
                                <td><button class="btn btn-success btn-xs" onclick="seleccionaCliente('<?= $cli->idcliente ?>','<?= $cli->nombres ?>','<?= $cli->apellidos ?>','<?= $cli->nrodocumento ?>')">Agregar</button></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
               
            </div>
        </div>
    </div>
</div>