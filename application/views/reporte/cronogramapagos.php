<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">REPORTES</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        

                </a>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Cronograma Pagos</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <div id="tableList">
            <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Reporte de Cronograma de Pagos</h3>
                    <p class="text-muted">Fecha de Pagos segun Huesped</p>
                 
                        <div class="form-group">
                            <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="habitacion">
                                Habitacion
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                               <select class='form-control form-control-line' name="habitacion" id="habitacion">
                                    <option value="">Seleccione...</option>

                                    <?php foreach ($hab_ocupadas as $val): ?>
                                        <option value="<?= $val->nrohabitacion ?>"><?= $val->nrohabitacion ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                               <button class="btn btn-success" onclick="cronogramapagos()">GENERAR</button>
                              
                            </div>
                        </div>
               
                <br>
                <br>
                <br>
                    <iframe id="iframe-reporte" src="" style="width: 100%; height:450px;border:none;"> </iframe>

                    <div style="display: none" id="showtable">
                    
                    </div>
                    
                </div>
            </div>
            
        </div>
            
        </div>

        
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <footer class="footer text-center"> 2018 &copy; Hospedaje Martinez</footer>
</div>
<!-- /#page-wrapper -->
</div>


