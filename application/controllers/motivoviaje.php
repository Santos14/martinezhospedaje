<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motivoviaje extends CI_Controller {
	public function index(){
		layoutSystem("motivoviaje/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM motivoviaje WHERE estado='1' ORDER BY idmotivoviaje asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("motivoviaje/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"descripcion" => $this->input->post("descripcion"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("motivoviaje", $data);
		}else{
			$status = $this->allmodel->update("motivoviaje", $data, array('idmotivoviaje'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('motivoviaje',array("idmotivoviaje"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('motivoviaje',$delete,array('idmotivoviaje' => $this->input->post("id")));
		echo json_encode($status);
	}
}
