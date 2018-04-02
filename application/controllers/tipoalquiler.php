<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipoalquiler extends CI_Controller {
	public function index(){
		layoutSystem("tipoalquiler/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM tipoalquiler WHERE estado='1' ORDER BY idtipoalquiler asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("tipoalquiler/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"descripcion" => $this->input->post("descripcion"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("tipoalquiler", $data);
		}else{
			$status = $this->allmodel->update("tipoalquiler", $data, array('idtipoalquiler'=> $id));
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
}
