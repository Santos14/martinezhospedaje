<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encargo extends CI_Controller {
	public function index(){
		layoutSystem("encargo/index");
	}

	public function nuevo(){
		$this->load->view("encargo/nuevo");
	}
	public function tableList(){
		$sql = "SELECT en.*,al.nomalmacen,cli.tipodocumento,cli.nombres,cli.apellidos,cli.nrodocumento,cli.telefono
			FROM almacen al INNER JOIN encargo en ON (al.idalmacen = en.almacen_idalmacen)
			INNER JOIN cliente cli ON (en.cliente_idcliente = cli.idcliente)
			WHERE en.estado = '1' and al.estado = '1' and cli.estado='1' ORDER BY en.fecha_ingreso desc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("encargo/lista",$data);
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

	public function ajax_edit(){
		$id = $this->input->post("id");

		$this->db->trans_start();
		$data = array(
			"fecha_salida" => date("Y-m-d")." ".date("H:i:s"),
			"estado" => '2'
		);

		$s = $this->allmodel->update("encargo", $data, array('idencargo'=> $id));

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

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('encargo',$delete,array('idencargo' => $this->input->post("id")));
		echo json_encode($status);
	}
}
