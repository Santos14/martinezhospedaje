<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Concepto extends CI_Controller {
	public function index(){
		$data["tipomovimientos"] = $this->allmodel->selectWhere('tipomovimiento',array("estado"=>'1'))->result();
		layoutSystem("concepto/index",$data);
	}

	public function tableList(){
		$sql = "SELECT c.*,tm.descripcion tipomovimiento 
				FROM concepto c INNER JOIN tipomovimiento tm ON (tm.idtipomovimiento = c.tipomovimiento_idtipomovimiento)
				WHERE c.estado='1' and c.fijo='0' 
				ORDER BY c.idconcepto asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("concepto/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"tipomovimiento_idtipomovimiento" => $this->input->post("idtipomovimiento"),
			"descripcion" => $this->input->post("descripcion"),
			"estado" => '1',
			"fijo" => '0'
		);

		if ($id == ""){
			$status = $this->allmodel->create("concepto", $data);
		}else{
			$status = $this->allmodel->update("concepto", $data, array('idconcepto'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('concepto',array("idconcepto"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('concepto',$delete,array('idconcepto' => $this->input->post("id")));
		echo json_encode($status);
	}
}
