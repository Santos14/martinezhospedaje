<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elemento extends CI_Controller {

	public function ajax_save(){
		$id = $this->input->post("elem_id");

		$data = array(
			"descripcion" => $this->input->post("elem_descripcion"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("elemento", $data);
		}else{
			$status = $this->allmodel->update("elemento", $data, array('idelemento'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('elemento',array("idelemento"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('elemento',$delete,array('idelemento' => $this->input->post("id")));
		echo json_encode($status);
	}
}
