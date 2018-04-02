<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipohabitacion extends CI_Controller {
	public function index(){
		layoutSystem("tipohabitacion/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM tipohabitacion WHERE estado='1' ORDER BY idtipohabitacion asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("tipohabitacion/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"descripcion" => $this->input->post("descripcion"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("tipohabitacion", $data);
		}else{
			$status = $this->allmodel->update("tipohabitacion", $data, array('idtipohabitacion'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('tipohabitacion',array("idtipohabitacion"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('tipohabitacion',$delete,array('idtipohabitacion' => $this->input->post("id")));
		echo json_encode($status);
	}
}
