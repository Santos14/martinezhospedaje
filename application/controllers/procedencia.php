<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procedencia extends CI_Controller {
	public function index(){
		layoutSystem("procedencia/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM procedencia WHERE estado='1' ORDER BY idprocedencia asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("procedencia/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"lugar" => $this->input->post("lugar"),
			"tipoprocedencia" => $this->input->post("tipoprocedencia"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("procedencia", $data);
		}else{
			$status = $this->allmodel->update("procedencia", $data, array('idprocedencia'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('procedencia',array("idprocedencia"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('procedencia',$delete,array('idprocedencia' => $this->input->post("id")));
		echo json_encode($status);
	}
}
