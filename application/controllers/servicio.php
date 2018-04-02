<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends CI_Controller {

	public function ajax_save(){
		$id = $this->input->post("serv_id");

		$data = array(
			"descripcion" => $this->input->post("serv_descripcion"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("servicio", $data);
		}else{
			$status = $this->allmodel->update("servicio", $data, array('idservicio'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('servicio',array("idservicio"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('servicio',$delete,array('idservicio' => $this->input->post("id")));
		echo json_encode($status);
	}
}
