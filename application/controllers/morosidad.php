<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Morosidad extends CI_Controller {
	public function index(){
		layoutSystem("morosidad/index");
	}

	public function tableList(){
		$sql = "SELECT mo.*, cp.descripcion concepto, cli.nombres, cli.apellidos,cli.tipodocumento,cli.nrodocumento FROM morosidad mo INNER JOIN concepto cp ON (mo.idconcepto = cp.idconcepto)
		INNER JOIN cliente cli ON (mo.idcliente = cli.idcliente)";
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
