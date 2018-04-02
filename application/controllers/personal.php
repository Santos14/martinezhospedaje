<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends CI_Controller {

	public function index(){
		$data["dataC"] = $this->allmodel->selectWhere('cargo',array('estado' => '1'));
		$data["dataT"] = $this->allmodel->selectWhere('tipopersonal',array('estado' => '1'));
		layoutSystem("personal/index",$data);
	}

	public function tableList(){
		$sql = "SELECT p.*,c.descripcion cargo,tp.descripcion tipopersonal
				FROM personal p INNER JOIN cargo c ON (p.cargo_idcargo = c.idcargo) 
				INNER JOIN tipopersonal tp ON (p.tipopersonal_idtipopersonal = tp.idtipopersonal)
				WHERE p.estado='1' and c.estado='1' and tp.estado='1'
				ORDER BY p.idpersonal asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("personal/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"tipopersonal_idtipopersonal" => $this->input->post("idtipopersonal"),
			"cargo_idcargo" => $this->input->post("idcargo"),
			"nombres" => $this->input->post("nombre"),
			"apellidos" => $this->input->post("apellido"),
			"dni" => $this->input->post("dni"),
			"fechanac" => $this->input->post("fechanac"),
			"telefono" => $this->input->post("telefono"),
			"direccion" => $this->input->post("direccion"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("personal", $data);
		}else{
			$status = $this->allmodel->update("personal", $data, array('idpersonal'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('personal',array("idpersonal"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('personal',$delete,array('idpersonal' => $this->input->post("id")));
		echo json_encode($status);
	}
}
