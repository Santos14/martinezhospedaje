<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	public function index(){
		$sql = "SELECT * FROM personal WHERE idpersonal NOT IN (
				SELECT p.idpersonal FROM usuarios u INNER JOIN personal p ON (p.idpersonal = u.personal_idpersonal) WHERE u.estado = '1' and p.estado='1' ) and estado = '1'";
		$data["dataC"] = $this->allmodel->querySql($sql);
		layoutSystem("usuarios/index",$data);
	}

	public function tableList(){
		$sql = "SELECT u.*,p.nombres,p.apellidos,p.dni
				FROM usuarios u INNER JOIN personal p ON (p.idpersonal = u.personal_idpersonal)
				WHERE u.estado = '1' and p.estado='1' 
				ORDER BY u.idusuarios asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("usuarios/lista",$data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"personal_idpersonal" => $this->input->post("idpersonal"),
			"usuario" => $this->input->post("username"),
			"clave" => $this->input->post("password"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("usuarios", $data);
		}else{
			$status = $this->allmodel->update("usuarios", $data, array('idusuarios'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('usuarios',array("idusuarios"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('usuarios',$delete,array('idusuarios' => $this->input->post("id")));
		echo json_encode($status);
	}
}
