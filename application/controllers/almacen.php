<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Almacen extends CI_Controller {
	public function index(){
		layoutSystem("almacen/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM almacen WHERE estado='1' ORDER BY idalmacen asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("almacen/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");
		$this->db->trans_start();
		$data = array(
			"descripcion" => $this->input->post("descripcion"),
			"nomalmacen" => $this->input->post("nomalmacen"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("almacen", $data);
		}else{
			$status = $this->allmodel->update("almacen", $data, array('idalmacen'=> $id));
		}

		$this->db->trans_complete();
		$trans_status = $this->db->trans_status();

		if($trans_status== FALSE){
			$this->db->trans_rollback();
			$status = 0;			
		}else{
			$status = 1;
			$this->db->trans_commit();			
		}
		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('almacen',array("idalmacen"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('almacen',$delete,array('idalmacen' => $this->input->post("id")));
		echo json_encode($status);
	}
}
