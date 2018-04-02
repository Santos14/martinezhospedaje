<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipopersonal extends CI_Controller {
	public function index(){
		layoutSystem("tipopersonal/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM tipopersonal WHERE estado='1' ORDER BY idtipopersonal asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("tipopersonal/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"descripcion" => $this->input->post("descripcion"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("tipopersonal", $data);
		}else{
			$status = $this->allmodel->update("tipopersonal", $data, array('idtipopersonal'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('tipopersonal',array("idtipopersonal"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('tipopersonal',$delete,array('idtipopersonal' => $this->input->post("id")));
		echo json_encode($status);
	}
}
