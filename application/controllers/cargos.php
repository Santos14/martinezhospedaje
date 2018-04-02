<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargos extends CI_Controller {
	public function index(){
		layoutSystem("cargos/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM cargo WHERE estado='1' ORDER BY idcargo asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("cargos/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"descripcion" => $this->input->post("descripcion"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("cargo", $data);
		}else{
			$status = $this->allmodel->update("cargo", $data, array('idcargo'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('cargo',array("idcargo"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('cargo',$delete,array('idcargo' => $this->input->post("id")));
		echo json_encode($status);
	}
}
