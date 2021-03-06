<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<?php 
    $cargo = $this->session->userdata('cargo');
 ?>


<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
        </div>
        <ul class="nav side-menu" id="side-menu">
            <li style="padding: 70px 0 0;">
                <a href="<?= base_url() ?>home" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Home </a>
            </li>





            <?php if ($cargo == 'Desarrollador'): ?>
            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-table fa-fw" aria-hidden="true"></i>MANTENIMIENTO
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('almacen');?>">Almacen</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('tipoimprevisto');?>">Tipo Imprevisto</a>
                    </li>   
                     <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('procedencia');?>">Procedencias</a>
                    </li>     
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('tipohabitacion');?>">Tipo Habitacion</a>
                    </li>
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('motivoviaje');?>">Motivo Viaje</a>
                    </li>    
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('tipoalquiler');?>">Tipo Alquiler</a>
                    </li> 
                </ul>

            </li>
            

             <li>
                <a href="<?php echo base_url('cliente');?>" class="waves-effect">
                    <i class="fa fa-group" aria-hidden="true"></i> CLIENTES
                </a>
            </li>
            
            
            <li>
                <a href="<?php echo base_url('habitacion');?>" class="waves-effect">
                    <i class="fa fa-book" aria-hidden="true"></i> HABITACIONES
                </a>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                    ALQUILER
                </a>
                <ul class="nav child_menu" >
                               
                     <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('alquiler');?>">Alquiler</a>
                    </li>
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('imprevisto');?>">Imprevistos</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('encargo');?>">Encargos</a>
                    </li> 
                   
                </ul>
            </li>

          

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> KIOSKO
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('producto');?>">Productos</a>
                    </li>           
                     <!--li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('compra');?>">Compras</a>
                    </li-->
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('venta');?>">Venta</a>
                    </li>
                   
                </ul>
            </li>
            
            <li>
                <a href="<?php echo base_url('transportista');?>" class="waves-effect">
                    <i class="fa fa-car" aria-hidden="true"></i> MOTOTAXISTA
                </a>
            </li>
            
            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-database" aria-hidden="true"></i>  CONTA PUNTOS
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('puntocliente');?>">Clientes</a>
                    </li>           
                     <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('puntotransportista');?>">Mototaxistas</a>
                    </li> 
                </ul>
            </li>

             <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>  CAJA
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('concepto');?>">Conceptos</a>
                    </li>           
                     <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('movimiento');?>">Ingresos y Gastos</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('morosidad');?>">Morosos</a>
                    </li>
                </ul>
            </li>

            <!--li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                    PROMOCIONES
                </a>
                <ul class="nav child_menu" >
                               
                     <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('mototaxis');?>">Mototaxis</a>
                    </li> 
                   
                </ul>
            </li-->
            
            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-cogs" aria-hidden="true"></i>  ADMINISTRACION
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('cargos');?>">Cargos</a>
                    </li>   
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('tipopersonal');?>">Tipo Personal</a>
                    </li>        
                     <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('personal');?>">Personal</a>
                    </li> 
                    
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('usuarios');?>">Usuarios</a>
                    </li>
                      <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('politicas');?>">Politicas</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-signal" aria-hidden="true"></i> REPORTES
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/dia');?>">Reporte Dia</a>
                    </li>
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/cronopagos');?>">Cronograma de Pagos</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/estadodia');?>">Movimientos del Dia</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/estadomes');?>">Movimientos por Mes</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/historialpasajeros');?>">Historial de Pasajeros</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/alojamiento');?>">Pagos por Alquiler</a>
                    </li>           
                     
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/adelantopersonal');?>">Adelanto Personal</a>
                    </li>

                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/estadisticamensual');?>">Estadistica Mensual</a>
                    </li>
                
                </ul>
            </li>

            <?php endif; ?>


            <?php if($cargo == 'Recepcion'): ?>
            

             <li>
                <a href="<?php echo base_url('cliente');?>" class="waves-effect">
                    <i class="fa fa-group" aria-hidden="true"></i> CLIENTES
                </a>
            </li>
            
            
        

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                    ALQUILER
                </a>
                <ul class="nav child_menu" >
                               
                     <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('alquiler');?>">Alquiler</a>
                    </li>
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('imprevisto');?>">Imprevistos</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('encargo');?>">Encargos</a>
                    </li> 
                   
                </ul>
            </li>

             <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>  CAJA
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('concepto');?>">Conceptos</a>
                    </li>           
                     <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('movimiento');?>">Ingresos y Gastos</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('morosidad');?>">Morosos</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-cogs" aria-hidden="true"></i>  ADMINISTRACION
                </a>
                <ul class="nav child_menu" >
                   
                      <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('politicas');?>">Politicas</a>
                    </li>
                </ul>
            </li>


             <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-signal" aria-hidden="true"></i> REPORTES
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/dia');?>">Reporte Dia</a>
                    </li>

                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/historialpasajeros');?>">Historial de Pasajeros</a>
                    </li>        

                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/estadisticamensual');?>">Estadistica Mensual</a>
                    </li>
                
                </ul>
            </li>


            <?php endif ?>


            <?php if($cargo == 'Cajero'): ?>


            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> KIOSKO
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('producto');?>">Productos</a>
                    </li>           
                     <!--li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('compra');?>">Compras</a>
                    </li-->
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('venta');?>">Venta</a>
                    </li>
                   
                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>  CAJA
                </a>
                <ul class="nav child_menu" >         
                     <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('movimiento');?>">Ingresos y Gastos</a>
                    </li> 
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('morosidad');?>">Morosos</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-signal" aria-hidden="true"></i> REPORTES
                </a>
                <ul class="nav child_menu" >
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/dia');?>">Caja Dia Habitaciones</a>
                    </li>
                    
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/estadomes');?>">Caja Mes Habitaciones</a>
                    </li> 

                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/cajakiosko');?>">Caja Kiosko</a>
                    </li> 
            
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/alojamiento');?>">Pagos por Alquiler</a>
                    </li>           
                     
                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/adelantopersonal');?>">Adelanto Personal</a>
                    </li>

                    <li style='padding-left: 14%;'>
                        <a style="width: 90%;" href="<?php echo base_url('reporte/estadisticamensual');?>">Estadistica Mensual
                        </a>
                    </li>
                
                </ul>
            </li>


            <?php endif ?>



        </ul>
    </div>
    
</div>
<!-- ============================================================== -->
<!-- End Left Sidebar -->
<!-- ============================================================== -->