<form id="form_al" class="form-horizontal form-label-left form-material">
    <input type="hidden" name="id" id="id" value="<?= $data["alquiler"][0]->idalquiler ?>">
    <input type="hidden" name="idreserva" id="idreserva">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Editar Alquiler</h3>
                <input type="hidden" name="isChangeHabitacion" id="isChangeHabitacion" value="false">
                
                <input type="hidden" name="idhabitacion_original" id="idhabitacion_original" value="<?= $data["alquiler"][0]->habitacion_idhabitacion ?>">
                <input type="hidden" name="habitacion_original" id="habitacion_original" value="<?= $data["alquiler"][0]->nrohabitacion ?>">
                <input type="hidden" name="precio_original" id="precio_original" value="<?= $data["alquiler"][0]->precio ?>">
                <input type="hidden" name="precioxdia_original" id="precioxdia_original" value="<?= $data["alquiler"][0]->precioxdia ?>">
                
          
                <input type="hidden" name="idhabitacion" id="idhabitacion" value="<?= $data["alquiler"][0]->habitacion_idhabitacion ?>">
                <p class="text-muted">Cambie los datos Necesarios</p>
              
              <legend>Datos de la Habitacion</legend>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                        Nro. Habitacion
                    </label>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input id="habitacion" name="habitacion" class="form-control" value="<?= $data["alquiler"][0]->nrohabitacion ?>" readonly>
                    </div>
                     <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="precio">
                        Precio Estandar(S/.)
                    </label>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input readonly id="precio" name="precio" id="precio" class="form-control" value="<?= $data["alquiler"][0]->precio ?>">
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12" id="cambiarHabitacion">
                        <button onclick="cambiahabitacion()" type="button" class='btn btn-info'>
                            <i class="fa fa-refresh"></i> Cambio   
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12" style="display: none;" id="cancelarHabitacion">
                        <button onclick="cancelahabitacion()" type="button" class='btn btn-danger'>
                            <i class="fa fa-close"></i> Cancelar   
                        </button>
                    </div>
                    
                    
                </div>
                
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="precioxdia">
                        Precio Real(S/.)
                    </label>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input id="precioxdia" name="precioxdia" id="precioxdia" class="form-control" value="<?= $data["alquiler"][0]->precioxdia ?>">
                    </div>
                </div>
                <legend>Datos del Cliente</legend>
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                        Cliente
                    </label>
                    <input type="hidden" name="idcliente" id="idcliente" value="<?= $data["alquiler"][0]->cliente_idcliente ?>">
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input readonly onkeypress="return solonumeros(event)" onblur="searchdni(this)" id="al_dni" name="al_dni" class="form-control" value="<?= $data["alquiler"][0]->nrodocumento ?>" placeholder="Nro Documento">
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input id="cliente" name="cliente" readonly class="form-control" value="<?= $data["alquiler"][0]->apellidos.", ".$data["alquiler"][0]->nombres ?>" placeholder="Cliente">
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <button onclick="search_cliente('3')" type="button" class='btn btn-info'>
                            <i class="fa fa-search"></i> Buscar   
                        </button>
                    </div>
                     
                </div>

                <legend>Datos del Alquiler</legend>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idtipoalquiler">
                        Tipo Alquiler
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">

                        <?php if($data["alquiler"][0]->tipoalquiler_idtipoalquiler != '3'){ ?>
                   
                        <select class='form-control form-control-line' id="idtipoalquiler" name="idtipoalquiler" onchange="cambiartipoalquiler()">
                            <option value="">Seleccione...</option>


                        <?php foreach ($tipo_alquiler as $tipo):?>
                        <?php

                            if($tipo->idtipoalquiler == $data["alquiler"][0]->tipoalquiler_idtipoalquiler){
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
                            if($tipo->idmotivoviaje == $data["alquiler"][0]->motivoviaje_idmotivoviaje){
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
                        if($data["alquiler"][0]->tipoprocedencia == 'N'){
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
                             <?php foreach ($procedencia as $pr){?>
                                <?php if($pr->tipoprocedencia == $data["alquiler"][0]->tipoprocedencia){ ?>
                                    <?php
                                        if($pr->idprocedencia == $data["alquiler"][0]->procedencia_idprocedencia){
                                           $sd = "selected";
                                        }else{
                                           $sd = "";
                                        }
                                   ?>
                                    <option <?= $sd ?>  value="<?= $pr->idprocedencia ?>"><?= $pr->lugar ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="localidad">
                        Localidad
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <input type="text" placeholder="Ingrese Localidad de Procedencia" id="localidad" name="localidad" value="<?= $data["alquiler"][0]->localidad ?>" class="form-control" maxlength="200" >
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
                                if($i == $data["alquiler"][0]->kit){
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

                $date_i = new DateTime($data["alquiler"][0]->fecha_ingreso);
                

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
                if($data["alquiler"][0]->tipoalquiler_idtipoalquiler == '3' || $data["alquiler"][0]->estado == '2' ){

                    $sty = "";

                }else{
                    $sty = "style='display:none;'";
                }
                ?>

                <div <?= $sty ?> >
                     <?php $date_s = new DateTime($data["alquiler"][0]->fecha_salida); ?>
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
                            <input type="number" name="nrodias" id="nrodias" class="form-control" value="<?= $data["alquiler"][0]->nrodias ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group" <?= $sty ?>>
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="evaluacion">
                        Evaluacion
                    </label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <textarea id="evaluacion" name="evaluacion" class="form-control"  ><?= $data["alquiler"][0]->evaluacion ?></textarea>
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

<!-- MODAL CLIENTE REUTILIZABLE (EDITAR.php) -->
<div id="modalListaClientes" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">LISTA DE CLIENTES</h4>
            </div>
            <div class="modal-body" id="showListClient">
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
               
            </div>
        </div>
    </div>
</div>

<!-- MODAL HABITACIONES DESOCUPADAS (EDITAR.php) -->
<div id="modalHabDesocupadas" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_form">LISTA HABITACIONES</h4>
            </div>
            <div class="modal-body" id="showHabDesocupadas">
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
               
            </div>
        </div>
    </div>
</div>