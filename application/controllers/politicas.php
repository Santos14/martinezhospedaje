<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Politicas extends CI_Controller {
	public function index(){
		layoutSystem("politicas/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM politicas WHERE estado<>'0' ORDER BY idpoliticas asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("politicas/lista",$data);
	}

	public function ajax_change(){
		$change = array(
			'estado' => $this->input->post("e")
		);
		$status = $this->allmodel->update('politicas',$change,array('idpoliticas' => $this->input->post("id")));
		echo json_encode($status);

	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"descripcion" => $this->input->post("descripcion"),
			"numero" => $this->input->post("numero"),
			"unidad_medida" => $this->input->post("unidad_medida"),
			"fecha" => $this->input->post("fecha"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("politicas", $data);
		}else{
			$status = $this->allmodel->update("politicas", $data, array('idpoliticas'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('politicas',array("idpoliticas"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('politicas',$delete,array('idpoliticas' => $this->input->post("id")));
		echo json_encode($status);
	}
}
