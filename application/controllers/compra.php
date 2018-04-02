<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compra extends CI_Controller {
	public function index(){
		layoutSystem("compra/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM compra WHERE estado='1' ORDER BY idcompra asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("compra/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$movimiento = array(
			"tipomovimiento_idtipomovimiento" => "",
			"fecha" => "",
			"estado" => "1"
		);

		$compra = array(
			"movimiento_idmovimiento" => "",
			"descripcion" => "",
			"fecha" => "",
			"estado" => "1"
		);

		if ($id == ""){
			$status = $this->allmodel->create("producto", $data);
		}else{
			$status = $this->allmodel->update("producto", $data, array('idproducto'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('producto',array("idproducto"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('producto',$delete,array('idproducto' => $this->input->post("id")));
		echo json_encode($status);
	}
}
