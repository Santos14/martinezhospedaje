<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alquiler extends CI_Controller {
    public $bd;
    function __contruct(){
            parent::__contruct();
    }

    public function index(){
            layoutSystem("alquiler/index");
    }

    public function s(){
            $data_alquiler = pasajerosactuales();
            echo "<pre>";
            print_r($data_alquiler);
    }

    public function monto_mensual($montoxdia){
            $politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 4))->result();
            $pDescuento = number_format($politica[0]->numero,'0')/100;
            $subtotal = $montoxdia * 30;
            $descuento = $subtotal*$pDescuento;
            $total = $subtotal - $descuento;
            echo json_encode($total); 
    }

    public function fecha_mensual($fecha){
            $nuevo = date ('Y-m-d',strtotime('+1 months',strtotime(date($fecha))));
            echo json_encode($nuevo);
    }

    public function tableList(){
            $sql_habitacion = "SELECT h.*,th.descripcion tipohabitacion,
            (SELECT idalquiler FROM alquiler a WHERE h.idhabitacion = a.habitacion_idhabitacion and a.estado='1') idalquiler  
            FROM habitacion h INNER JOIN tipohabitacion th ON(h.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
            WHERE h.estado<>'0' and th.estado<>'0'
            ORDER BY h.nrohabitacion asc";
            $sql_servicios = "SELECT ds.*,s.descripcion servicio 
            FROM servicio s INNER JOIN detalle_servicio ds ON(s.idservicio = ds.servicio_idservicio) 
            INNER JOIN habitacion h ON (h.idhabitacion = ds.habitacion_idhabitacion)
            WHERE  h.estado <> '0' and s.estado<>'0'";

            $data["habitaciones"] = $this->allmodel->querySql($sql_habitacion)->result();
            $data["servicios"] = $this->allmodel->querySql($sql_servicios)->result();
            $this->load->view("alquiler/lista",$data);
    }


    public function cambioestadocuarto(){
            $estadocuarto = $this->input->post("estado_cuarto");
            //2:SUCIO ; 3: CAMBIO 
            $politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 1))->result();
            $cambsa = "+".number_format($politica[0]->numero,'0')." day";

            $cambiosabana = array(
                    "cambiosabana" => date ('Y-m-d',strtotime($cambsa,strtotime(date("Y-m-d")))),
                     "estcambiosabana" => '0'
            );
            $limpiar = array(
                     "estado" => '1'
            );

            if($estadocuarto=='3'){
                    $uph = $this->allmodel->update("habitacion", $cambiosabana, array('idhabitacion'=> $this->input->post("id")));
            }else if($estadocuarto=='2'){
                    $uph = $this->allmodel->update("habitacion", $limpiar, array('idhabitacion'=> $this->input->post("id")));
            }else{
                    $uph='0';
            }

            echo json_encode($uph);
    }
    public function form_alquiler($id){
            // POLITICAS DE APERTURA
        
            $politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 3))->result();
            $dataActivePuntos= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 6))->result();
            $horaTermino = number_format($politica[0]->numero,'0');
            $aperturaPuntos = number_format($dataActivePuntos[0]->numero,'0'); 
            // GENERANDO CONSULTAS
            $sql_tipoalquiler = "SELECT * FROM tipoalquiler WHERE estado <> '0' ORDER BY idtipoalquiler asc";
            $sql_tipoprocencia = "SELECT * FROM procedencia WHERE estado <> '0' and tipoprocedencia='N' ORDER BY lugar asc";
            $sql_motivoviaje = "SELECT * FROM motivoviaje WHERE estado = '1'";
            
            // CREANDO VARIABLES DE ENVIO A VISTA
            $data["habitacion"] = $this->allmodel->selectWhere('habitacion',array("idhabitacion"=>$id))->result();
            $data["tipo_alquileres"] = $this->allmodel->querySql($sql_tipoalquiler)->result();
            $data["tipo_procedencia"] = $this->allmodel->querySql($sql_tipoprocencia)->result();
            $data["motivo_viaje"] = $this->allmodel->querySql($sql_motivoviaje)->result();
            $data["horatermino"] = $horaTermino;
            $data["isMarketingPuntos"] = $aperturaPuntos;
            $this->load->view("alquiler/nuevo",$data);	
    }

    public function edit_alquiler($idalquiler){

            $politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 3))->result();

            $sql_alquiler = "SELECT 
            alq.*,
            hb.nrohabitacion,
            hb.precio,
            tpa.descripcion tipoalquiler,
            pr.lugar procedencia,
            pr.tipoprocedencia,
            cli.tipodocumento,
            cli.nrodocumento,
            cli.nombres,
            cli.apellidos,
            mv.descripcion motivoviaje
            FROM alquiler alq INNER JOIN habitacion hb ON (alq.habitacion_idhabitacion = hb.idhabitacion)
            INNER JOIN tipoalquiler tpa ON (alq.tipoalquiler_idtipoalquiler = tpa.idtipoalquiler)
            INNER JOIN procedencia pr ON (pr.idprocedencia = alq.procedencia_idprocedencia)
            INNER JOIN cliente cli ON (cli.idcliente = alq.cliente_idcliente)
            INNER JOIN motivoviaje mv ON (mv.idmotivoviaje = alq.motivoviaje_idmotivoviaje)
            WHERE alq.idalquiler = ".$idalquiler;

            $alq = $this->allmodel->querySql($sql_alquiler)->result();
            $data["alquiler"] = $alq;

            $sql_tipoalquiler = "SELECT * FROM tipoalquiler WHERE estado <> '0' and idtipoalquiler <> 3 ORDER BY idtipoalquiler asc";
            $sql_cliente = "SELECT * FROM cliente WHERE estado <> '0'";

            $pr_actual = $this->allmodel->selectWhere("procedencia",array('idprocedencia' =>$alq[0]->procedencia_idprocedencia ))->result();

            $sql_tipoprocencia = "SELECT * FROM procedencia WHERE estado <> '0' and tipoprocedencia='".$pr_actual[0]->tipoprocedencia."' ORDER BY lugar asc";

            $sql_motivoviaje = "SELECT * FROM motivoviaje WHERE estado = '1'";


            $data["alquiler"] = $this->allmodel->querySql($sql_alquiler)->result();
            $data["clientes"] = $this->allmodel->querySql($sql_cliente)->result();
            $data["tipo_alquileres"] = $this->allmodel->querySql($sql_tipoalquiler)->result();
            $data["tipo_procedencia"] = $this->allmodel->querySql($sql_tipoprocencia)->result();
            $data["motivo_viaje"] = $this->allmodel->querySql($sql_motivoviaje)->result();
            $data["horatermino"] = number_format($politica[0]->numero,'0');
            $this->load->view("alquiler/editar",$data);	
    }

    public function ver_alquiler($id){
            $alquiler = $this->allmodel->selectWhere('alquiler',array("idalquiler"=>$id))->result();
            $data["alquiler"] = $alquiler;
            $data["habitacion"] = $this->allmodel->selectWhere('habitacion',array("idhabitacion"=>$alquiler[0]->habitacion_idhabitacion))->result();
            $data["tipoalquiler"] = $this->allmodel->selectWhere('tipoalquiler',array("idtipoalquiler"=>$alquiler[0]->tipoalquiler_idtipoalquiler))->result();
            $data["procedencia"] = $this->allmodel->selectWhere('procedencia',array("idprocedencia"=>$alquiler[0]->procedencia_idprocedencia))->result();
            $data["cliente"] = $this->allmodel->selectWhere('cliente',array("idcliente"=>$alquiler[0]->cliente_idcliente))->result();
            $data["motivoviaje"] = $this->allmodel->selectWhere('motivoviaje',array("idmotivoviaje"=>$alquiler[0]->motivoviaje_idmotivoviaje))->result();
            $data["acompaniantes"] = $this->allmodel->selectWhere('acompaniante',array("alquiler_idalquiler"=>$id))->result();


            $this->load->view("alquiler/ver",$data);
    }

    public function form_detalle($id){
            $alquiler = $this->allmodel->selectWhere('alquiler',array("idalquiler"=>$id))->result();
            $data["alquiler"] = $alquiler;
            $data["habitacion"] = $this->allmodel->selectWhere('habitacion',array("idhabitacion"=>$alquiler[0]->habitacion_idhabitacion))->result();
            $data["tipoalquiler"] = $this->allmodel->selectWhere('tipoalquiler',array("idtipoalquiler"=>$alquiler[0]->tipoalquiler_idtipoalquiler))->result();
            $data["procedencia"] = $this->allmodel->selectWhere('procedencia',array("idprocedencia"=>$alquiler[0]->procedencia_idprocedencia))->result();
            $data["cliente"] = $this->allmodel->selectWhere('cliente',array("idcliente"=>$alquiler[0]->cliente_idcliente))->result();
            $data["motivoviaje"] = $this->allmodel->selectWhere('motivoviaje',array("idmotivoviaje"=>$alquiler[0]->motivoviaje_idmotivoviaje))->result();
            $data["imprevistos"] = $this->allmodel->querySql("SELECT i.*,ti.descripcion tipoimprevisto
            FROM imprevisto i INNER JOIN tipoimprevisto ti ON (i.tipoimprevisto_idtipoimprevisto = ti.idtipoimprevisto)
            WHERE ti.estado <> '0' and alquiler_idalquiler=".$alquiler[0]->idalquiler)->result();

            $data["ventas"] = $this->allmodel->querySql("SELECT v.*,(
            SELECT sum(dv.precio)
            FROM venta ve INNER JOIN detalle_venta dv ON (ve.idventa = dv.venta_idventa)
            WHERE ve.estado<>'3' and ve.idventa = v.idventa
            GROUP BY ve.idventa
            ) total
            FROM alquiler a INNER JOIN venta_alquiler va on(a.idalquiler = va.alquiler_idalquiler)
            INNER JOIN venta v ON(va.venta_idventa = v.idventa)
            WHERE v.estado <> '0' and a.idalquiler =".$alquiler[0]->idalquiler)->result();

            $data["pagado"] = $this->allmodel->querySql("SELECT sum(am.monto) monto
            FROM alquiler al INNER JOIN amortizacion am ON (al.idalquiler = am.alquiler_idalquiler)
            WHERE am.estado = '1' and al.idalquiler = ".$alquiler[0]->idalquiler."
            GROUP BY al.idalquiler")->result();


            $data["politica"] = $this->allmodel->selectWhere("politicas",array("idpoliticas" => 3))->result();

            $this->load->view("alquiler/detalle",$data);	
    }

    public function buscarAlquiler($idalquiler){
            $sql = "SELECT 
            alq.*,
            hb.nrohabitacion,
            hb.precio,
            tpa.descripcion tipoalquiler,
            pr.lugar procedencia,
            pr.tipoprocedencia,
            cli.nrodocumento,
            cli.nombres,
            cli.apellidos,
            mv.descripcion motivoviaje
            FROM alquiler alq INNER JOIN habitacion hb ON (alq.habitacion_idhabitacion = hb.idhabitacion)
            INNER JOIN tipoalquiler tpa ON (alq.tipoalquiler_idtipoalquiler = tpa.idtipoalquiler)
            INNER JOIN procedencia pr ON (pr.idprocedencia = alq.procedencia_idprocedencia)
            INNER JOIN cliente cli ON (cli.idcliente = alq.cliente_idcliente)
            INNER JOIN motivoviaje mv ON (mv.idmotivoviaje = alq.motivoviaje_idmotivoviaje)
            WHERE alq.idalquiler = ".$idalquiler;

            $data = $this->allmodel->querySql($sql)->result();

            echo json_encode($data);
    }

    public function listapasajeros(){

            $sql_habitacion = "SELECT * FROM habitacion WHERE estado <>'0' ORDER BY nrohabitacion asc";

            $data["data_alquiler"] = pasajerosactuales();
            $data["habitaciones"] = $this->allmodel->querySql($sql_habitacion)->result();

            $this->load->view("alquiler/listapasajeros",$data);		
    }

    public function ultimo_alquiler($idcliente){
            $sql = "SELECT alq.*
                            FROM alquiler alq INNER JOIN cliente cli ON (alq.cliente_idcliente = cli.idcliente)
                            WHERE alq.estado='2' and cli.idcliente = ".$idcliente."
                            ORDER BY alq.fecha_ingreso desc
                            LIMIT 1";

            echo json_encode($this->allmodel->querySql($sql)->result());
    }

    public function anular_alquiler(){
        $idalquiler = $this->input->post("id");

        $this->db->trans_start();

        // EXTRAIGO TODOS LOS DATOS DEL ALQUILER
        $alquiler = $this->allmodel->selectWhere("alquiler",array('idalquiler'=>$idalquiler))->result();

        // CUANDO ANULO UN ALQUILER SE DEVUELVE LA PLATA DE CAJA, Y CUANDO SE RESTAURA SE RESTAURA SIN PAGO
        $sql_amorti = "SELECT * FROM amortizacion WHERE	estado='1' and alquiler_idalquiler = ".$idalquiler;
        $amort = $this->allmodel->querySql($sql_amorti)->result();

        // ELABORO LA DATA DE CAMBIO DE ESTADO 
        $cambioEst = array(
                "estado" => '0'
        );

        // VERIFICO QUE AYA HABIDO AMORTIZACIONES PARA PROCEDER A CAMBIAR DE ESTADO
        if(count($amort)>0){
                // CAMBIO DE ESTADO A TODAS LAS AMORTIZACIONES Y MOVIMIENTOS DE ESE ALQUILER
                for ($i=0; $i < count($amort) ; $i++) { 	
                        $upamor = $this->allmodel->update("amortizacion",$cambioEst,array("idamortizacion"=>$amort[$i]->idamortizacion));
                        $upmov = $this->allmodel->update("movimiento",$cambioEst,array("idmovimiento"=>$amort[$i]->movimiento_idmovimiento));
                }
        }
        
        // ANULAR PUNTOS ALQUILER
        $dataActivePuntos= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 6))->result();
        $aperturaPuntos = number_format($dataActivePuntos[0]->numero,'0'); 

        if($aperturaPuntos){ // SI ESTA ACTIVO EL MARKETING PUNTOS
            $panulados = $this->allmodel->update("movimientopuntos",$cambioEst,array("idalquiler"=>$idalquiler));
        }

        // CAMBIO DE ESTADO AL ALQUILER (ESTADO => ANULADO)
        $upal = $this->allmodel->update("alquiler",array("estado"=>'0'),array("idalquiler"=>$idalquiler));


        // CREACION DE LA DATA PARA ACTUALIZAR LA HABITACION A UN ESTADO DISPONIBLE
        $update_hb = array(
                "disponibilidad" => "1",
                "cambiosabana" => "1900-01-01",
                "estcambiosabana" => '0'
        );

        // ACTALIZO LA HABITACION
        $uphb = $this->allmodel->update("habitacion",$update_hb,array("idhabitacion"=>$alquiler[0]->habitacion_idhabitacion));

        $this->db->trans_complete();
        $trans_status = $this->db->trans_status();
        if($trans_status== FALSE){
                $this->db->trans_rollback();
                $status = 0;			
        }else{
                $status = 1;
                $this->db->trans_commit();			
        }
        echo json_encode($status);
    }
    
    
    public function restaurar_alquiler(){
            $idalquiler = $this->input->post("id");

            $this->db->trans_start();

            $alquiler = $this->allmodel->selectWhere("alquiler",array('idalquiler'=>$idalquiler))->result();


            $sql_amorti = "SELECT * FROM amortizacion WHERE	estado='0' and alquiler_idalquiler = ".$idalquiler;
            $amort = $this->allmodel->querySql($sql_amorti)->result();

            $cambioEst = array(
                    "estado" => '1'
            );

            if(count($amort)>0){
                    for ($i=0; $i < count($amort) ; $i++) { 	
                            $upamor = $this->allmodel->update("amortizacion",$cambioEst,array("idamortizacion"=>$amort[$i]->idamortizacion));
                            $upmov = $this->allmodel->update("movimiento",$cambioEst,array("idmovimiento"=>$amort[$i]->movimiento_idmovimiento));
                    }
            }

            $upal = $this->allmodel->update("alquiler",array("estado"=>'1'),array("idalquiler"=>$idalquiler));

            $politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 1))->result();
            $cambsa = "+".number_format($politica[0]->numero,'0')." day";

            if($alquiler[0]->tipoalquiler_idtipoalquiler == '2'){ //EVENTUAL
                    $disp = '5';
            }else if($alquiler[0]->tipoalquiler_idtipoalquiler == '3'){ // MENSUAL
                    $disp = '6';
            }else{
                    $disp = '2';
            }

            $update_hb = array(
                    "disponibilidad" => $disp,
                    "cambiosabana" => date ('Y-m-d',strtotime($cambsa,strtotime(date("Y-m-d")))),
                    "estcambiosabana" => '0'
            );

            $uphb = $this->allmodel->update("habitacion",$update_hb,array("idhabitacion"=>$alquiler[0]->habitacion_idhabitacion));

            $this->db->trans_complete();
            $trans_status = $this->db->trans_status();
            if($trans_status== FALSE){
                    $this->db->trans_rollback();
                    $status = 0;			
            }else{
                    $status = 1;
                    $this->db->trans_commit();			
            }
            echo json_encode($status);

    }

    public function listarOpcion($id){

            $sql = "SELECT 
            alq.*,
            hb.nrohabitacion,
            hb.precio,
            tpa.descripcion tipoalquiler,
            pr.lugar procedencia,
            pr.tipoprocedencia,
            cli.nrodocumento,
            cli.nombres,
            cli.apellidos,
            mv.descripcion motivoviaje
            FROM alquiler alq INNER JOIN habitacion hb ON (alq.habitacion_idhabitacion = hb.idhabitacion)
            INNER JOIN tipoalquiler tpa ON (alq.tipoalquiler_idtipoalquiler = tpa.idtipoalquiler)
            INNER JOIN procedencia pr ON (pr.idprocedencia = alq.procedencia_idprocedencia)
            INNER JOIN cliente cli ON (cli.idcliente = alq.cliente_idcliente)
            INNER JOIN motivoviaje mv ON (mv.idmotivoviaje = alq.motivoviaje_idmotivoviaje)
            WHERE alq.idalquiler = ".$id;

            $data["alq"] = $this->allmodel->querySql($sql)->result();

            $this->load->view("alquiler/opciones",$data);	

    }

    public function listaalquiler(){

            $sql_alq = "SELECT al.*,cli.nrodocumento,cli.nombres,cli.apellidos,hb.nrohabitacion,
            (
            SELECT sum(amr.monto)
            FROM alquiler alq INNER JOIN amortizacion amr ON (alq.idalquiler = amr.alquiler_idalquiler)
            WHERE amr.estado = '1' and alq.idalquiler = al.idalquiler
            GROUP BY alq.idalquiler
            ) montopagado
            FROM alquiler al INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion)
            INNER JOIN cliente cli ON (al.cliente_idcliente = cli.idcliente)

            ORDER BY al.fecha_ingreso desc";

            $data["alquileres"] = $this->allmodel->querySql($sql_alq)->result();

            $this->load->view("alquiler/listaalquiler",$data);		
    }

    public function form_salir($id){
            $data["data_alquiler"] = pasajerosactuales();
            $data["idalquiler"] = $id;
            $this->load->view("alquiler/detalle_salida",$data);	
    }

    public function forms($id){
            $s = pasajerosactuales();
            echo "<pre>";
            print_r($s);
    }

    public function cambiarprocedencia($lugar){
            $sql_tipoprocencia = "SELECT * FROM procedencia WHERE estado <> '0' and tipoprocedencia='".$lugar."' ORDER BY lugar asc";

            echo json_encode($this->allmodel->querySql($sql_tipoprocencia)->result());

    }

    public function save_edit(){
            $id = $this->input->post("id");

            $alq_v = $this->allmodel->selectWhere("alquiler",array("idalquiler"=>$id))->result();

            if($alq_v[0]->estado != '2'){
                    if($this->input->post('idtipoalquiler') == '2'){ //EVENTUAL
                            $disp = '5';
                    }else if($this->input->post('idtipoalquiler') == '1'){ // DIARIO
                            $disp = '2';
                    }
                    else if($this->input->post('idtipoalquiler') == '3'){ // MENSUAL
                            $disp = '6';
                    }
            }

            $data = array(
                    "tipoalquiler_idtipoalquiler" => $this->input->post('idtipoalquiler'),
                    "procedencia_idprocedencia" => $this->input->post('idprocedencia'),
                    "motivoviaje_idmotivoviaje" => $this->input->post('idmotivoviaje'),
                    "fecha_ingreso" => $this->input->post('fecha')." ".$this->input->post('hora'),
                    "fecha_salida" => $this->input->post('fecha_fin')." ".$this->input->post('hora_fin'),
                    "nrodias" => $this->input->post('nrodias'),
                    "kit" => $this->input->post('kit'),
                    "localidad" => $this->input->post('localidad'),
                    "evaluacion" => $this->input->post('evaluacion')
            );

            $this->db->trans_start();
            if ($id != ""){

                    $al = $this->allmodel->update("alquiler", $data , array("idalquiler" => $id));

                    if($alq_v[0]->estado != '2'){
                            $estado = array(
                                    "disponibilidad" => $disp
                            );
                            $uph = $this->allmodel->update("habitacion", $estado, array('idhabitacion'=> $this->input->post("idhabitacion")));
                    }

            }else{
                    //$status = $this->allmodel->update("alquiler", $data, array('idalquiler'=> $id));
            }
            $this->db->trans_complete();
            $trans_status = $this->db->trans_status();

            if($trans_status== FALSE){
                    $this->db->trans_rollback();
                    $status = 0;			
            }else{
                    $status = 1;
                    $this->db->trans_commit();			
            }


            echo json_encode($status);
    }

    public function ajax_save(){
            $id = $this->input->post("id");
            $idreserva = $this->input->post("idreserva");

            // CONFIGURACIONES SEGUN EL TIPO DE ALQUILER
            $tipoalquiler = $this->input->post('idtipoalquiler');
            if($tipoalquiler == '2'){ //EVENTUAL
                    $disp = '5';
                    $fecha_salida = "1900-01-01";
                    $nrodias = 0;
            }else if($tipoalquiler == '3'){ // MENSUAL
                    $disp = '6';
                    $fecha_salida = $this->input->post('fecha_fin')." ".$this->input->post('hora_fin');
                    $nrodias = 30;
            }else{ // DIARIO
                    $disp = '2';
                    $fecha_salida = "1900-01-01";
                    $nrodias = 0;
            }

            // CREANDO ARRAY CON LOS DATOS DEL ALQUILER PARA ¨PODER ENVIAR A BASE DE DATOS
            
            $data = array(
                    "habitacion_idhabitacion" => $this->input->post("idhabitacion"),
                    "personal_idpersonal" => $this->session->userdata('idpersonal'),
                    "tipoalquiler_idtipoalquiler" => $tipoalquiler,
                    "procedencia_idprocedencia" => $this->input->post('idprocedencia'),
                    "cliente_idcliente" => $this->input->post('idcliente'),
                    "motivoviaje_idmotivoviaje" => $this->input->post('idmotivoviaje'),
                    "fecha_ingreso" => $this->input->post('fecha')." ".$this->input->post('hora'),
                    "fecha_salida" => $fecha_salida,
                    "nrodias" => $nrodias,
                    "kit" => $this->input->post('kit'),
                    "precioxdia" => $this->input->post('precioxdia'),
                    "estado" => '1',
                    "localidad" => $this->input->post('localidad')
            );

            // EMPEZANDO EL ENVIO A BASE DE DATOS
             
            $this->db->trans_start();
            
            if ($id == ""){ // NUEVO ALQUILER
                
                // CREANDO EL NUEVO ALQUILER
                
                $al = $this->allmodel->create("alquiler", $data);
                
                
                //AGREGANDO ACOMPAÑANTES
                if($this->input->post("nombres_acomp")!=null){
                    $nom_acomp = $this->input->post("nombres_acomp");
                    $dni_acomp = $this->input->post("dni_acomp");

                    if(count($dni_acomp)>0){
                        for ($ind = 0; $ind < count($dni_acomp) ; $ind++) {
                            $detalle = array(
                                    "nomcompleto" => $nom_acomp[$ind],
                                    "nrodoc" => $dni_acomp[$ind],
                                    "alquiler_idalquiler" => $al,
                                    "estado" => '1'
                            );
                            $ac = $this->allmodel->create("acompaniante", $detalle);
                        }
                    }
                }
                
                
             
                // ACTUALIZANDO DATOS DE LA HABITACION ALQUILADA (TABLA: HABITACION)
                
                // - EXTRAYENDO DATOS DE DIAS DE CAMBIO DE SABANA
                $politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 1))->result();
                $cambsa = "+".number_format($politica[0]->numero,'0')." day";
                // - ARMANDO DATOS A ACTUALIZAR DE LA HABITACION
                $estado = array(
                        "disponibilidad" => $disp,
                        "cambiosabana" => date ('Y-m-d',strtotime ($cambsa,strtotime(date("Y-m-d")))),
                        "estcambiosabana" => '0'
                );
                $uph = $this->allmodel->update("habitacion", $estado, array('idhabitacion'=> $this->input->post("idhabitacion")));
                
                //METODOS DE PAGO
                $dataActivePuntos= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 6))->result();
                $aperturaPuntos = number_format($dataActivePuntos[0]->numero,'0'); 

                
                
                $metPago = $this->input->post('fpago');
        
                
                if($metPago == '1'){ // METODO: DINERO
                    // EXTRAEMOS PAGO INICIAL (DINERO)
                    $pagoInicial = $this->input->post('pagoinicial');
                    
                    // INSERTAMOS EL PAGO INICIAL A LA TABLA AMORTIZACION Y MOVIMIENTO
                    if($pagoInicial >= 0){
                        
                        // CREAMOS REGISTRO EN LA TABLA MOVIMIENTO
                        $movimiento = array(
                                "concepto_idconcepto" => 1,
                                "fecha" => date("Y-m-d H:i:s"),
                                "estado" => '1',
                                "monto" => $pagoInicial,
                                "tipopago" => "D"
                        );
                        $m = $this->allmodel->create("movimiento", $movimiento);

                        // CREAMOS REGISTRO EN LA TABLA AMORTIZACION
                        $amortizacion = array(
                                "movimiento_idmovimiento" => $m,
                                "alquiler_idalquiler" => $al,
                                "fecha" => date("Y-m-d H:i:s"),
                                "estado" => '1',
                                "monto" => $pagoInicial,
                                "tipopago" => "D"
                        );

                        $am = $this->allmodel->create("amortizacion", $amortizacion);
                        
                        // GENERAMOS LOS PUNTOS CORRESPONDIENTES AL PAGO
                        /*
                         * NOTACION DE PUNTOS:
                         *  tipomovimiento:
                         *      - I: Ingreso
                         *      - E: Egreso
                         *  tipoactor:
                         *      - C: Cliente Recomendador
                         *      - M: Mototaxista Recomendador
                         *  concepto:
                         *      - E: Estancia
                         *      - R: Recomendacion
                         *      - C: Compra
                         */
                        
                        // SI ES EVENTUAL NO HACER ESTE PROCESO
                        
                        if($tipoalquiler != 2){
                            
                            // VERIFICAMOS SI ESTA ACTIVO EL MARKETING DE PUNTOS

                            if($aperturaPuntos){ // SI ESTA ACTIVO EL MARKETING PUNTOS
                                                                
                                // SECCION SOLO PARA CLIENTES
                                if($pagoInicial >= $data["precioxdia"]){

                                    // EXTRAYENDO BASE PARA GENERAR PUNTOS

                                    $dataPConversion= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 5))->result();
                                    $baseConversion = number_format($dataPConversion[0]->numero,'0');
                                    
                                    // CALCULAR TOTAL PUNTOS
                                    $puntos_cli = round($pagoInicial/$baseConversion, 1);
                                    
                                    // CARGANDO DATOS PARA INSERTAR PUNTOS POR ESTANCIA
                                    $data_puntos_a = array(
                                        "fecha" => date("Y-m-d H:i:s"),
                                        "tipomovimiento" => "I",
                                        "puntos" => $puntos_cli,
                                        "tipoactor" => "C",
                                        "idactor" => $data["cliente_idcliente"],
                                        "concepto" => "E",
                                        "estado" => "1",
                                        "idalquiler" => $al
                                    );
                                    
                                    $cl = $this->allmodel->create("movimientopuntos", $data_puntos_a);
                                }
                                
                                // SECCION SOLO PARA MOTOTAXISTAS RECOMENDADORES
                                $idmototaxista_recomendador = $this->input->post('t_idtransportista');
                                $puntos_moto = round($data["precioxdia"]/$baseConversion, 1);
                                $data_puntos_b = array(
                                    "fecha" => date("Y-m-d H:i:s"),
                                    "tipomovimiento" => "I",
                                    "puntos" => $puntos_moto,
                                    "tipoactor" => "M",
                                    "idactor" => $idmototaxista_recomendador,
                                    "concepto" => "R",
                                    "estado" => "1",
                                    "idalquiler" => $al 
                                );
                                $mr = $this->allmodel->create("movimientopuntos", $data_puntos_b);
                                
                                // SECCION SOLO PARA CLIENTES RECOMENDADORES
                                $idcliente_recomendador = $this->input->post('c_idcliente');
                                $puntos_moto = round($data["precioxdia"]/$baseConversion, 1);
                                $data_puntos_c = array(
                                    "fecha" => date("Y-m-d H:i:s"),
                                    "tipomovimiento" => "I",
                                    "puntos" => $puntos_moto,
                                    "tipoactor" => "C",
                                    "idactor" => $idcliente_recomendador,
                                    "concepto" => "C",
                                    "estado" => "1",
                                    "idalquiler" => $al
                                );
                                $cr = $this->allmodel->create("movimientopuntos", $data_puntos_c);   
                            }
                           
                        } 
                    }
                }else if($metPago == '2'){ // METODO: PUNTOS MARTINEZ
                    
                    if($aperturaPuntos){
                        
                        // EXTRAEMOS PAGO INICIAL (PUNTOS)
                        $pagoPuntos = $this->input->post('montopagopuntos');
                        
                        if($pagoPuntos >= 0){
                            // CREAMOS REGISTRO EN LA TABLA MOVIMIENTO
                            $movimiento = array(
                                    "concepto_idconcepto" => 1,
                                    "fecha" => date("Y-m-d H:i:s"),
                                    "estado" => '1',
                                    "monto" => $pagoPuntos,
                                    "tipopago" => "P"
                            );
                            $m = $this->allmodel->create("movimiento", $movimiento);

                            // CREAMOS REGISTRO EN LA TABLA AMORTIZACION
                            $amortizacion = array(
                                    "movimiento_idmovimiento" => $m,
                                    "alquiler_idalquiler" => $al,
                                    "fecha" => date("Y-m-d H:i:s"),
                                    "estado" => '1',
                                    "monto" => $pagoPuntos,
                                    "tipopago" => "P"
                            );

                            $am = $this->allmodel->create("amortizacion", $amortizacion);
                            
                            // CREAMOS EL REGISTRO EN MOVIMIENTO PUNTOS (EGRESO)
                            
                            $data_puntos_d = array(
                                "fecha" => date("Y-m-d H:i:s"),
                                "tipomovimiento" => "E",
                                "puntos" => $pagoPuntos,
                                "tipoactor" => "C",
                                "idactor" => $data["cliente_idcliente"],
                                "concepto" => "E",
                                "estado" => "1",
                                "idalquiler" => $al
                            );
                            $er = $this->allmodel->create("movimientopuntos", $data_puntos_d);
                        } 
                    }
                }
                

                // CAMBIANDO EL ESTADO DE LA RESERVA SI ES QUE HUBIERA
                if($idreserva != ""){
                        $r = $this->allmodel->update("reserva", array("estado"=>"2"), array('idreserva'=>$idreserva));
                }


            }else{ // ACTUALIZAR ALQUILER
            
                    //$status = $this->allmodel->update("alquiler", $data, array('idalquiler'=> $id));
            }
            $this->db->trans_complete();
            $trans_status = $this->db->trans_status();

            if($trans_status== FALSE){
                    $this->db->trans_rollback();
                    $status = 0;			
            }else{
                    $status = 1;
                    $this->db->trans_commit();			
            }


            echo json_encode($status);
    }

    public function reservar(){
            $id = $this->input->post("id");

            $data = array(
                    "habitacion_idhabitacion" => $this->input->post("idhabitacion"),
                    "personal_idpersonal" => $this->session->userdata('idpersonal'),
                    "cliente_idcliente" => $this->input->post('idcliente'),
                    "fecha" => $this->input->post('fecha'),
                    "estado" => '1'
            );

            $this->db->trans_start();

            if ($id == ""){
                    $al = $this->allmodel->create("reserva", $data);
                    $d = array(
                            "disponibilidad" => '3'
                    );
                    $hb = $this->allmodel->update("habitacion", $d, array('idhabitacion'=> $this->input->post("idhabitacion")));
            }else{
                    //$status = $this->allmodel->update("alquiler", $data, array('idalquiler'=> $id));
            }
            $this->db->trans_complete();
            $trans_status = $this->db->trans_status();

            if($trans_status== FALSE){
                    $this->db->trans_rollback();
                    $status = 0;			
            }else{
                    $status = 1;
                    $this->db->trans_commit();			
            }		
            echo json_encode($status);
    }

    public function cancelar_reservacion(){

            $idhabitacion = $this->input->post("cancelar_id");

            $sql_r = "SELECT hb.*,r.idreserva FROM habitacion hb INNER JOIN reserva r ON (hb.idhabitacion = r.habitacion_idhabitacion) WHERE hb.disponibilidad='3' and r.estado='1' and hb.idhabitacion=".$idhabitacion;

            $hb = $this->allmodel->querySql($sql_r)->result();

            $this->db->trans_start();

            //CAMBIAR ESTADO A LA RESERVACION
            $this->allmodel->update("reserva",array("estado" => '0'), array('idreserva'=> $hb[0]->idreserva));
            //CAMBIAR ESTADO HABITACION
            $this->allmodel->update("habitacion",array("disponibilidad" => '1'), array('idhabitacion'=> $hb[0]->idhabitacion));

            $this->db->trans_complete();
            $trans_status = $this->db->trans_status();

            if($trans_status== FALSE){
                    $this->db->trans_rollback();
                    $status = 0;			
            }else{
                    $status = 1;
                    $this->db->trans_commit();			
            }

            echo json_encode($status);

    }

    public function ver_reservacion($id){
            $sql = "SELECT hb.idhabitacion,hb.nrohabitacion,r.idreserva,r.fecha,cli.idcliente,cli.nrodocumento,cli.nombres,cli.apellidos
            FROM habitacion hb INNER JOIN reserva r ON (hb.idhabitacion = r.habitacion_idhabitacion)
            INNER JOIN cliente cli ON (cli.idcliente = r.cliente_idcliente)
            WHERE hb.disponibilidad='3' and r.estado='1' and hb.idhabitacion =".$id;
            echo json_encode($this->allmodel->querySql($sql)->result());
    }

 
    public function pagartodo(){
            $idalquiler = $this->input->post("idalquiler");
            $est = $this->input->post("est");

            $this->db->trans_start();

            $alq = $this->allmodel->selectWhere("alquiler",array("idalquiler" => $idalquiler))->result();

            if(!($this->input->post("alojamiento")==0 && $this->input->post("compras")==0 && $this->input->post("imprevistos")==0)){

                    if($this->input->post("pagado")=="on"){
                            if($this->input->post("alojamiento")!=0){
                                    $movimiento = array(
                                            "concepto_idconcepto" => 1,
                                            "fecha" => date("Y-m-d H:i:s"),
                                            "estado" => '1',
                                            "monto" => $this->input->post("alojamiento"),
                                            "tipopago" => "D"
                                    );
                                    $ma = $this->allmodel->create("movimiento", $movimiento);

                                    $alojamiento = array(
                                            "movimiento_idmovimiento" => $ma,
                                            "alquiler_idalquiler" =>$idalquiler,
                                            "fecha" => date("Y-m-d H:i:s"),
                                            "monto" =>$this->input->post("alojamiento"),
                                            "estado" => "1",
                                            "tipopago" => "D"
                                    );
                                    $a = $this->allmodel->create("amortizacion", $alojamiento);
                                    //falta cambiar de estado a la habitacion
                            }
                            if($this->input->post("compras")!=0){

                                    $sql_compras = "SELECT v.*,(
                                    SELECT sum(dv.precio)
                                    FROM venta ve INNER JOIN detalle_venta dv ON (ve.idventa = dv.venta_idventa)
                                    WHERE ve.estado='1' and ve.idventa = v.idventa
                                    GROUP BY ve.idventa
                                    ) total FROM alquiler a INNER JOIN venta_alquiler va on(a.idalquiler = va.alquiler_idalquiler) INNER JOIN venta v ON(va.venta_idventa = v.idventa) WHERE v.estado ='1' and a.idalquiler =".$idalquiler;

                                    $c = $this->allmodel->querySql($sql_compras)->result();

                                    for ($i = 0; $i < count($c); $i++) {
                                            $movimiento = array(
                                                    "concepto_idconcepto" => 3,
                                                    "fecha" => date("Y-m-d H:i:s"),
                                                    "estado" => '1',
                                                    "monto" => $c[$i]->total,
                                                    "tipopago" => "D"
                                            );
                                            $mv = $this->allmodel->create("movimiento", $movimiento);

                                            $ventamovimiento = array(
                                                    "venta_idventa" => $c[$i]->idventa,
                                                    "movimiento_idmovimiento" => $mv
                                            );

                                            $v_m = $this->allmodel->create("ventamovimiento", $ventamovimiento);

                                            $sql_updateVenta = "UPDATE venta SET estado='2' WHERE idventa IN (
                                            SELECT v.idventa
                                            FROM alquiler a INNER JOIN venta_alquiler va on(a.idalquiler = va.alquiler_idalquiler)
                                            INNER JOIN venta v ON(va.venta_idventa = v.idventa)
                                            WHERE v.estado ='1' and a.idalquiler =".$idalquiler.")";

                                            $upv = $this->allmodel->querySql($sql_updateVenta);
                                    }
                            }
                            if($this->input->post("imprevistos")!=0){
                                    $sql_imprevistos = "SELECT i.*
                                    FROM imprevisto i INNER JOIN tipoimprevisto ti ON (i.tipoimprevisto_idtipoimprevisto = ti.idtipoimprevisto) WHERE ti.estado = '1' and alquiler_idalquiler=".$idalquiler;

                                    $imp = $this->allmodel->querySql($sql_imprevistos)->result();

                                    for ($i = 0; $i < count($imp); $i++) {
                                            $movimiento = array(
                                                    "concepto_idconcepto" => 9,
                                                    "fecha" => date("Y-m-d H:i:s"),
                                                    "estado" => '1',
                                                    "monto" => $imp[$i]->monto,
                                                    "tipopago" => "D"
                                            );
                                            $mi = $this->allmodel->create("movimiento", $movimiento);

                                            $imprevisto_movimiento = array(
                                                    "imprevisto_idimprevisto" => $imp[$i]->idimprevisto,
                                                    "movimiento_idmovimiento" => $mi
                                            );

                                            $i_m = $this->allmodel->create("imprevisto_movimiento", $imprevisto_movimiento);

                                            $sql_updateImp = "UPDATE imprevisto SET estado='2' WHERE idimprevisto IN (
                                            SELECT i.idimprevisto
                                            FROM imprevisto i INNER JOIN tipoimprevisto ti ON (i.tipoimprevisto_idtipoimprevisto = ti.idtipoimprevisto)
                                            WHERE ti.estado = '1' and alquiler_idalquiler=".$idalquiler.")";

                                            $upimp = $this->allmodel->querySql($sql_updateImp);
                                    }
                            }

                    }else{

                            if($this->input->post("alojamiento")!=0){
                                    $morosidad_alojamiento = array(
                                            "fecha" => date("Y-m-d H:i:s"),
                                            "idalquiler" => $idalquiler,
                                            "idconcepto" => 1,
                                            "idcliente" => $alq[0]->cliente_idcliente, 
                                            "monto" =>$this->input->post("alojamiento"),
                                            "estado" => "1"
                                    );
                                    $ma = $this->allmodel->create("morosidad", $morosidad_alojamiento);
                            }
                            if($this->input->post("compras")!=0){
                                    $morosidad_compras = array(
                                            "fecha" => date("Y-m-d H:i:s"),
                                            "idalquiler" => $idalquiler,
                                            "idconcepto" => 3,
                                            "idcliente" => $alq[0]->cliente_idcliente, 
                                            "monto" =>$this->input->post("compras"),
                                            "estado" => "1"
                                    );
                                    $mc = $this->allmodel->create("morosidad", $morosidad_compras);
                            }
                            if($this->input->post("imprevistos")!=0){
                                    $morosidad_imprevistos = array(
                                            "fecha" => date("Y-m-d H:i:s"),
                                            "idalquiler" => $idalquiler,
                                            "idconcepto" => 9,
                                            "idcliente" => $alq[0]->cliente_idcliente, 
                                            "monto" =>$this->input->post("imprevistos"),
                                            "estado" => "1"
                                    );
                                    $mi = $this->allmodel->create("morosidad", $morosidad_imprevistos);
                            }

                    }

            }

            if($est == '1'){

                            $fi = new DateTime($alq[0]->fecha_ingreso);

                            $dias = (strtotime(date_format($fi,"Y-m-d"))-strtotime(date("Y-m-d")))/86400;
                            $dias = abs($dias); $dias = floor($dias); 

                            $nuevo_dias = $dias;

                            if($fi->format('H')>='00' && $fi->format('i') >= '00' && $fi->format('s') >= '00'){             
                             if($fi->format('H')<='02' && $fi->format('i') <= '59' && $fi->format('s') <= '59'){
                              $nuevo_dias++;
                             }
                    }

                            $act_alquiler = array(
                                    "fecha_salida" => date("Y-m-d H:i:s"),
                                    "nrodias" => $nuevo_dias,
                                    "evaluacion" => $this->input->post("observacion"),
                                    "estado" =>'2'
                            );

                            $upalq = $this->allmodel->update("alquiler",$act_alquiler, array('idalquiler'=> $idalquiler));			

                            $actualizar_hab = array(
                                    "disponibilidad" => "1",
                                    "estado" => "2",
                                    "cambiosabana" => "1900-01-01",
                                    "estcambiosabana" => "0"
                            );

                            $uphab = $this->allmodel->update("habitacion",$actualizar_hab, array('idhabitacion'=> $alq[0]->habitacion_idhabitacion));
            }	

            $this->db->trans_complete();
            $trans_status = $this->db->trans_status();

            if($trans_status== FALSE){
                    $this->db->trans_rollback();
                    $status = 0;			
            }else{
                    $status = 1;
                    $this->db->trans_commit();			
            }



            echo json_encode($status);

    }

    public function ajax_edit($id){
            $data = $this->allmodel->selectWhere('alquiler',array("idalquiler"=>$id));
            echo json_encode($data->result());
    }

    public function ajax_delete(){
            $delete = array(
                    'estado' => 0
            );
            $status = $this->allmodel->update('tipoalquiler',$delete,array('idtipoalquiler' => $this->input->post("id")));
            echo json_encode($status);
    }

    public function ajax_morosidad($idcliente,$e){
            $sql = "SELECT mo.*, cp.descripcion concepto
            FROM morosidad mo INNER JOIN concepto cp ON (mo.idconcepto = cp.idconcepto)
            WHERE mo.estado='1' and mo.idcliente =".$idcliente;
            $data["morosidad"] = $this->allmodel->querySql($sql)->result();
            if($e == '1'){
                    $this->load->view("alquiler/morosidad",$data);	
            }else if($e == '2'){
                    echo json_encode($data["morosidad"]);
            }

    }
    
    
    // MOVIMIENTO PUNTOS
    public function totalpuntos($tipoactor,$idactor){
        $sql_ing = "SELECT SUM(puntos) puntos
                    FROM movimientopuntos
                    WHERE 
                    estado = '1' and 
                    tipoactor='".$tipoactor."' and 
                    tipomovimiento='I' and 
                    idactor=".$idactor;
        $sql_egr = "SELECT SUM(puntos) puntos
                    FROM movimientopuntos
                    WHERE 
                    estado = '1' and 
                    tipoactor='".$tipoactor."' and 
                    tipomovimiento='E' and 
                    idactor=".$idactor;
        
        $ing = $this->allmodel->querySql($sql_ing)->result();
        $egr = $this->allmodel->querySql($sql_egr)->result();
        $total = $ing[0]->puntos - $egr[0]->puntos;
        echo json_encode($total);
    }
    
    
    
    
}
