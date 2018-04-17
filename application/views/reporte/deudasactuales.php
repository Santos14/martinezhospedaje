<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style='margin-top: 40px;'>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tabla Productos</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a onclick="form_add()" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Nuevo

                </a>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="active">Deudas</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <div id="tableList">
            <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Reporte de Deudas del Dia</h3>
                    <p class="text-muted">Deudas de los pasjeros Actuales</p>
                    <br>
                    <button class="btn btn-success" onclick="deudasdia()">VER DEUDAS</button>
                     <button class="btn btn-success" onclick="probar()">Probar</button>

                <br>
                <br>
                <br>
                    <iframe id="iframe-reporte" src="" style="width: 100%; height:450px;border:none;"> </iframe>
                    
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


