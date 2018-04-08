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

	public function tableList(){
		$sql_habitacion = "SELECT h.*,th.descripcion tipohabitacion,
		(SELECT idalquiler FROM alquiler a WHERE h.idhabitacion = a.habitacion_idhabitacion and a.estado='1') idalquiler  
		FROM habitacion h INNER JOIN tipohabitacion th ON(h.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
		WHERE h.estado<>'0' and th.estado<>'0'
		ORDER BY h.idhabitacion asc";
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
		$sql_tipoalquiler = "SELECT * FROM tipoalquiler WHERE estado <> '0' ORDER BY idtipoalquiler asc";
		$sql_tipoprocencia = "SELECT * FROM procedencia WHERE estado <> '0' and tipoprocedencia='N' ORDER BY lugar asc";
		$sql_motivoviaje = "SELECT * FROM motivoviaje WHERE estado = '1'";
		$data["habitacion"] = $this->allmodel->selectWhere('habitacion',array("idhabitacion"=>$id))->result();
		$data["tipo_alquileres"] = $this->allmodel->querySql($sql_tipoalquiler)->result();
		$data["tipo_procedencia"] = $this->allmodel->querySql($sql_tipoprocencia)->result();
		$data["motivo_viaje"] = $this->allmodel->querySql($sql_motivoviaje)->result();
		$this->load->view("alquiler/nuevo",$data);	
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
		WHERE v.estado <> '3' and a.idalquiler =".$alquiler[0]->idalquiler)->result();

		$data["pagado"] = $this->allmodel->querySql("SELECT sum(am.monto) monto
		FROM alquiler al INNER JOIN amortizacion am ON (al.idalquiler = am.alquiler_idalquiler)
		WHERE am.estado = '1' and al.idalquiler = ".$alquiler[0]->idalquiler."
		GROUP BY al.idalquiler")->result();


		$data["politica"] = $this->allmodel->selectWhere("politicas",array("idpoliticas" => 3))->result();

		$this->load->view("alquiler/detalle",$data);	
	}

	public function listapasajeros(){

		$sql_alquiler = "SELECT hb.idhabitacion,hb.nrohabitacion,al.fecha_ingreso,cli.nrodocumento,cli.nombres,cli.apellidos
			FROM habitacion hb INNER JOIN alquiler al ON (hb.idhabitacion = al.habitacion_idhabitacion)
			INNER JOIN cliente cli ON (cli.idcliente = al.cliente_idcliente)
			WHERE al.estado = '1'";
		$sql_habitacion = "SELECT * FROM habitacion WHERE estado <>'0' ORDER BY idhabitacion asc";

		$data["alquiler"] = $this->allmodel->querySql($sql_alquiler)->result();
		$data["habitaciones"] = $this->allmodel->querySql($sql_habitacion)->result();

		$this->load->view("alquiler/listapasajeros",$data);		
	}

	public function form_salir($id){
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
		WHERE v.estado <> '3' and a.idalquiler =".$alquiler[0]->idalquiler)->result();

		$data["pagado"] = $this->allmodel->querySql("SELECT sum(am.monto) monto
		FROM alquiler al INNER JOIN amortizacion am ON (al.idalquiler = am.alquiler_idalquiler)
		WHERE am.estado = '1' and al.idalquiler = ".$alquiler[0]->idalquiler."
		GROUP BY al.idalquiler")->result();

		$data["politica"] = $this->allmodel->selectWhere("politicas",array("idpoliticas" => 3))->result();


		$this->load->view("alquiler/detalle_salida",$data);	
	}

	public function cambiarprocedencia($lugar){
		$sql_tipoprocencia = "SELECT * FROM procedencia WHERE estado <> '0' and tipoprocedencia='".$lugar."' ORDER BY lugar asc";

		echo json_encode($this->allmodel->querySql($sql_tipoprocencia)->result());

	}
	public function ajax_save(){
		$id = $this->input->post("id");
		$idreserva = $this->input->post("idreserva");

		if($this->input->post('idtipoalquiler') == '2'){
			$disp = '5';
		}else{
			$disp = '2';
		}

		$data = array(
			"habitacion_idhabitacion" => $this->input->post("idhabitacion"),
			"personal_idpersonal" => $this->session->userdata('idpersonal'),
			"tipoalquiler_idtipoalquiler" => $this->input->post('idtipoalquiler'),
			"procedencia_idprocedencia" => $this->input->post('idprocedencia'),
			"cliente_idcliente" => $this->input->post('idcliente'),
			"motivoviaje_idmotivoviaje" => $this->input->post('idmotivoviaje'),
			"fecha_ingreso" => $this->input->post('fecha')." ".$this->input->post('hora'),
			"kit" => $this->input->post('kit'),
			"precioxdia" => $this->input->post('precioxdia'),
			"estado" => '1',
			"localidad" => $this->input->post('localidad')
		);

		$this->db->trans_start();
		if ($id == ""){
			$al = $this->allmodel->create("alquiler", $data);
			$politica= $this->allmodel->selectWhere("politicas",array("idpoliticas" => 1))->result();
			$cambsa = "+".number_format($politica[0]->numero,'0')." day";
			$estado = array(
				"disponibilidad" => '2',
				"cambiosabana" => date ('Y-m-d',strtotime ($cambsa,strtotime(date("Y-m-d")))),
				"estcambiosabana" => '0'
			);
			$uph = $this->allmodel->update("habitacion", $estado, array('idhabitacion'=> $this->input->post("idhabitacion")));


			//PAGO INICIAL
			if($this->input->post('pagoinicial') != 0){
				$movimiento = array(
					"concepto_idconcepto" => 1,
					"fecha" => date("Y-m-d H:i:s"),
					"estado" => '1',
					"monto" => $this->input->post('pagoinicial')
				);
				$m = $this->allmodel->create("movimiento", $movimiento);

				$amortizacion = array(
					"movimiento_idmovimiento" => $m,
					"alquiler_idalquiler" => $al,
					"fecha" => date("Y-m-d H:i:s"),
					"estado" => '1',
					"monto" => $this->input->post('pagoinicial')
				);

				$am = $this->allmodel->create("amortizacion", $amortizacion);	
				
			}

			if($idreserva != ""){
				$r = $this->allmodel->update("reserva", array("estado"=>"2"), array('idreserva'=>$idreserva));
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
						"monto" => $this->input->post("alojamiento")
					);
					$ma = $this->allmodel->create("movimiento", $movimiento);

					$alojamiento = array(
						"movimiento_idmovimiento" => $ma,
						"alquiler_idalquiler" =>$idalquiler,
						"fecha" => date("Y-m-d H:i:s"),
						"monto" =>$this->input->post("alojamiento"),
						"estado" => "1"
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
							"monto" => $c[$i]->total
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
							"monto" => $imp[$i]->monto
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
		$data = $this->allmodel->selectWhere('tipoalquiler',array("idtipoalquiler"=>$id));
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


}
