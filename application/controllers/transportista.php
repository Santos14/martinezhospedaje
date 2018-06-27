<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mototaxis extends CI_Controller {
	public function index(){
		layoutSystem("tipoimprevisto/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM tipoimprevisto WHERE estado='1' ORDER BY idtipoimprevisto asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("tipoimprevisto/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"descripcion" => $this->input->post("descripcion"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("tipoimprevisto", $data);
		}else{
			$status = $this->allmodel->update("tipoimprevisto", $data, array('idtipoimprevisto'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('tipoimprevisto',array("idtipoimprevisto"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('tipoimprevisto',$delete,array('idtipoimprevisto' => $this->input->post("id")));
		echo json_encode($status);
	}
}
