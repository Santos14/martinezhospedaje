<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">REPORTES</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Estadistica Mensual</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <div id="tableList">
            <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Estadistica Mensual</h3>
                    <p class="text-muted">Estadisticas Mensuales del Hospedaje Martinez</p>

                    <div class="form-group">
                        <label  class="control-label col-md-1 col-sm-3 col-xs-12" for="mes">
                            MES
                        </label>
                        <div class="col-md-1 col-sm-6 col-xs-12">
                            <select class='form-control form-control-line' id="mes" name="mes">
                                <option value="">MES...</option>
                                <option value="1">ENE</option>
                                <option value="2">FEB</option>
                                <option value="3">MAR</option>
                                <option value="4">ABR</option>
                                <option value="5">MAY</option>
                                <option value="6">JUN</option>
                                <option value="7">JUL</option>
                                <option value="8">AGO</option>
                                <option value="8">SET</option>
                                <option value="10">OCT</option>
                                <option value="11">NOV</option>
                                <option value="12">DIC</option>
                            </select>
                        </div>
                        <div class="col-md-1 col-sm-6 col-xs-12">
                            <select class='form-control form-control-line' id="anio" name="anio">
                                <option value="">AÑO...</option>
                                <?php foreach ($anios as $a): ?>
                                    <option value="<?= $a->anios ?>"><?= $a->anios ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-xs-12">
                           <button class="btn btn-success" onclick="verinforme()">VER</button>
                        </div>
                    </div>
               
                    <br>
                    <br>
                    <br>


                    <div id="showtable">
                        
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


