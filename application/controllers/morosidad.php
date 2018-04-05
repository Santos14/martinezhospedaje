<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Morosidad extends CI_Controller {
	public function index(){
		layoutSystem("morosidad/index");
	}

	public function tableList(){
		$sql = "SELECT mo.*, cp.descripcion concepto, cli.nombres, cli.apellidos,cli.tipodocumento,cli.nrodocumento FROM morosidad mo INNER JOIN concepto cp ON (mo.idconcepto = cp.idconcepto)
		INNER JOIN cliente cli ON (mo.idcliente = cli.idcliente) WHERE mo.estado = '1'";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("morosidad/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"fecha" => $this->input->post("fecha")." ".$this->input->post("hora"),
			"idconcepto" => $this->input->post("idconcepto"),
			"idcliente" => $this->input->post("idcliente"),
			"monto" => $this->input->post("monto"),
			"estado" => '1',
			"idalquiler" => '0'
		);

		if ($id == ""){
			$status = $this->allmodel->create("morosidad", $data);
		}else{
			$status = $this->allmodel->update("morosidad", $data, array('idmorosidad'=> $id));
		}

		echo json_encode($status);
	}

	public function pagarmorosidad(){
		$idmorosidad = $this->input->post("id");

		$morosidad = $this->allmodel->selectWhere("morosidad",array("idmorosidad"=>$idmorosidad))->result();

		$this->db->trans_start();

		//id basse = 16; 10
		if($morosidad[0]->idalquiler == "0"){
			$movimiento = array(
				"concepto_idconcepto" => $morosidad[0]->idconcepto,
				"fecha" => date("Y-m-d H:i:s"),
				"estado" => '1',
				"monto" => $morosidad[0]->monto
			);
			$m = $this->allmodel->create("movimiento", $movimiento);
			
		}else{
			
			if($morosidad[0]->idconcepto == '1'){
				$movimiento = array(
					"concepto_idconcepto" => $morosidad[0]->idconcepto,
					"fecha" => date("Y-m-d H:i:s"),
					"estado" => '1',
					"monto" => $morosidad[0]->monto
				);
				$m = $this->allmodel->create("movimiento", $movimiento);
				$amortizacion = array(
					"movimiento_idmovimiento" => $m,
					"alquiler_idalquiler" =>$morosidad[0]->idalquiler,
					"fecha" => date("Y-m-d H:i:s"),
					"monto" => $morosidad[0]->monto,
					"estado" => "1"
				);
				$am = $this->allmodel->create("amortizacion", $amortizacion);
			
			}
			if($morosidad[0]->idconcepto == '3'){
				$sql_compras = "SELECT v.*,(
				SELECT sum(dv.precio)
				FROM venta ve INNER JOIN detalle_venta dv ON (ve.idventa = dv.venta_idventa)
				WHERE ve.estado='1' and ve.idventa = v.idventa
				GROUP BY ve.idventa
				) total FROM alquiler a INNER JOIN venta_alquiler va on(a.idalquiler = va.alquiler_idalquiler) INNER JOIN venta v ON(va.venta_idventa = v.idventa) WHERE v.estado ='1' and a.idalquiler =".$morosidad[0]->idalquiler;

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
					WHERE v.estado ='1' and a.idalquiler =".$morosidad[0]->idalquiler.")";

					$upv = $this->allmodel->querySql($sql_updateVenta);
				}
				
			}
			if($morosidad[0]->idconcepto == '9'){

				$sql_imprevistos = "SELECT i.*
				FROM imprevisto i INNER JOIN tipoimprevisto ti ON (i.tipoimprevisto_idtipoimprevisto = ti.idtipoimprevisto) WHERE ti.estado = '1' and alquiler_idalquiler=".$morosidad[0]->idalquiler;

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
					WHERE ti.estado = '1' and alquiler_idalquiler=".$morosidad[0]->idalquiler.")";

					$upimp = $this->allmodel->querySql($sql_updateImp);
				}
			}

		}
		$upm = $this->allmodel->update("morosidad",array("estado" =>2), array('idmorosidad'=> $idmorosidad));

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
		$data = $this->allmodel->selectWhere('morosidad',array("idmorosidad"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('morosidad',$delete,array('idmorosidad' => $this->input->post("id")));
		echo json_encode($status);
	}
}
