<form id="form_movimiento" class="form-horizontal form-label-left form-material">
<div class="row">
    <div class="col-sm-12">
        <div class="text-left">
            <button type="button" class="btn btn-danger" onclick="window.location='<?= base_url('movimiento') ?>'">
        Atras
    </button>
        </div>
        <br>
        <div class="white-box">
            <h3 class="box-title">Nuevo Movimiento</h3>
            <p class="text-muted">Registrar Nuevo Movimiento</p>

            <div class="form-group">
                <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idtipomovimiento">
                    Tipo Movimiento
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <select class='form-control form-control-line' id="idtipomovimiento" name="idtipomovimiento" onchange="cambioTipo()">
                        <option value="">Seleccione...</option>
                        <?php foreach ($tipomovimientos as $tm): ?>
                            <option value="<?= $tm->idtipomovimiento ?>"><?= $tm->descripcion ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="idconcepto">
                    Concepto
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <select class='form-control form-control-line' id="idconcepto" name="idconcepto" onchange="cambioConcepto()">
                        <option value=''>Seleccione...</option>
                       
                    </select>
                </div>
            </div>
    <hr>

             <div id="listaconcepto">
                            
            </div>
                   
        </div>
    </div>
</div>

<!--div class="row" id='newpanel'>
    <div class="col-sm-12">
        <div class="white-box">

            <div id="listaconcepto">
                            
            </div>

            
                   
        </div>
    </div>
</div-->


</form>