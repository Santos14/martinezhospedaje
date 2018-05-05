<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imprevisto extends CI_Controller {
	public function index(){
		$sql_habocupadas = "SELECT * FROM habitacion WHERE disponibilidad='2' and estado <> '0' ORDER BY nrohabitacion asc";
		$tipoimprevisto = "SELECT * FROM tipoimprevisto WHERE estado = '1'";
		$data["hab_ocupadas"] = $this->allmodel->querySql($sql_habocupadas)->result();
		$data["tipoimprevisto"] = $this->allmodel->querySql($tipoimprevisto)->result();
		layoutSystem("imprevisto/index",$data);
	}



	public function tableList(){
		$sql = "SELECT ip.idimprevisto,ip.fecha,hb.nrohabitacion,cli.apellidos,cli.nombres,ti.descripcion tipoimprevisto,ip.monto,ip.estado
		FROM imprevisto ip INNER JOIN alquiler al ON (al.idalquiler = ip.alquiler_idalquiler)
		INNER JOIN tipoimprevisto ti ON (ti.idtipoimprevisto = ip.tipoimprevisto_idtipoimprevisto)
		INNER JOIN habitacion hb ON (hb.idhabitacion = al.habitacion_idhabitacion)
		INNER JOIN cliente cli ON (cli.idcliente = al.cliente_idcliente)
		WHERE ti.estado = '1' and al.estado='1' and 
			hb.disponibilidad='2'";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("imprevisto/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"alquiler_idalquiler" => $this->input->post("idalquiler"),
			"tipoimprevisto_idtipoimprevisto" => $this->input->post("idtipoimprevisto"),
			"monto" => $this->input->post("monto"),
			"fecha" => $this->input->post("fecha"),
			"estado" => '1'
		);

		$this->db->trans_start();

		if ($id == ""){
			$imp = $this->allmodel->create("imprevisto", $data);

			if($this->input->post("imp_pagado")=="on"){
				$movimiento = array(
					"concepto_idconcepto" => 9,
					"fecha" => date("Y-m-d H:i:s"),
					"estado" => '1',
					"monto" => $this->input->post("monto")
				);
				$m = $this->allmodel->create("movimiento", $movimiento);

				$imp_mov = array(
					"imprevisto_idimprevisto" => $imp,
					"movimiento_idmovimiento" => $m
				);

				$im = $this->allmodel->create("imprevisto_movimiento", $imp_mov);	
				$uimp = $this->allmodel->update("imprevisto", array("estado" => '2'), array('idimprevisto'=> $imp));
			}

		}else{
			$status = $this->allmodel->update("imprevisto", $data, array('idimprevisto'=> $id));
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
		$data = $this->allmodel->selectWhere('imprevisto',array("idimprevisto"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('imprevisto',$delete,array('idimprevisto' => $this->input->post("id")));
		echo json_encode($status);
	}
}
