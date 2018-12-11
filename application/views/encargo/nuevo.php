<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Nuevo Encargo</h3>
            <p class="text-muted">Registrar encargos para Almacen del Hospedaje Martinez</p>
        
                <form id="form" class="form-horizontal form-label-left form-material">
                   
                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                        Cliente
                    </label>
                    <input type="hidden" name="idcliente" id="idcliente">
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input onblur="searchdni(this)" id="al_dni" name="al_dni" class="form-control" value="" placeholder="Nro Documento">
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input id="cliente" name="cliente" readonly class="form-control" value="" placeholder="Cliente">
                    </div>
  
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <button onclick="search_cliente('1')" type="button" class='btn btn-info'>
                            <i class="fa fa-search"></i> Buscar   
                        </button>
                    </div>
                </div>

                 <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idalmacen">
                        Almacen
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                   
                        <select class='form-control form-control-line' id="idalmacen" name="idalmacen">
                            <option value="">Seleccione...</option>
                        <?php foreach ($almacenes as $alm):?>
                            <option value="<?= $alm->idalmacen ?>"><?= $alm->nomalmacen ?></option>
                        <?php endforeach;?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="descripcion">
                        Encargo
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                   
                       <textarea id="descripcion" name="descripcion" class="form-control" rows="5" placeholder="Nombre del Encargo"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha">
                        Fecha Ingreso
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="date" max="<?= date("Y-m-d") ?>" name="fecha" id="fecha" class="form-control" value="<?= date("Y-m-d") ?>">
                    </div>
                    <label  class="control-label col-md-2 col-sm-3 col-xs-12" for="hora">
                        Hora Ingreso
                    </label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="time" id="hora" name="hora" class="form-control" value='<?= date("H:i:s") ?>'>
                    </div>
                </div>

                 <div class="text-center">
                    <button type="button" class="btn btn-default" onclick="window.location='<?= base_url('encargo') ?>'">
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-success" onclick="save()" id='btn_save_encargo'>
                        Guardar
                    </button>
                </div>

            </form>

          
        </div>
    </div>
    
</div>

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