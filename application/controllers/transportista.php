<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transportista extends CI_Controller {

	public function index(){
		layoutSystem("transportista/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM transportista WHERE estado='1' ORDER BY idtransportista desc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("transportista/lista",$data);
	}

	public function form_cli(){
		$this->load->view("transportista/nuevo");	
	}

	public function transportistaListModal(){
		$sql_cliente = "SELECT * FROM transportista WHERE estado <> '0'";
		$data["clientes"] = $this->allmodel->querySql($sql_cliente)->result();
		$this->load->view("transportista/listamodal",$data);	
	}

	public function ajax_searchdni($dni){
		$sqldni = "SELECT * FROM transportista WHERE dni LIKE '%".$dni."%' LIMIT 1";
		$data = $this->allmodel->querySql($sqldni)->result();
		echo json_encode($data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"dni" => $this->input->post("dni"),
			"nombres" => $this->input->post("nombres"),
			"apellidos" => $this->input->post("apellidos"),
			"direccion" => $this->input->post("direccion"),
			"telefono" => $this->input->post("telefono"),
			"fechanac" => $this->input->post("fechanac"),
			"sexo" => $this->input->post("sexo"),
                        "placa_vehiculo" => $this->input->post("placa_vehiculo"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("transportista", $data);
		}else{
			$status = $this->allmodel->update("transportista", $data, array('idtransportista'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('transportista',array("idtransportista"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('transportista',$delete,array('idtransportista' => $this->input->post("id")));
		echo json_encode($status);
	}
}
