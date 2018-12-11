<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encargo extends CI_Controller {
	public function index(){
		layoutSystem("encargo/index");
	}

	public function nuevo(){
		$sql_almacen = "SELECT * FROM almacen WHERE estado = '1'";
		$data["almacenes"] = $this->allmodel->querySql($sql_almacen)->result();
		$this->load->view("encargo/nuevo",$data);
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
			"almacen_idalmacen" => $this->input->post("idalmacen"),
			"descripcion" => $this->input->post("descripcion"),
			"fecha_ingreso" => $this->input->post("fecha")." ".$this->input->post("hora"),
			"fecha_salida" => "1900-01-01 00:00:00",
			"cliente_idcliente" => $this->input->post("idcliente"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("encargo", $data);
		}else{
			$status = $this->allmodel->update("encargo", $data, array('idencargo'=> $id));
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
        
                
        public function encargoCliente($nrodoc){
            $sql="SELECT en.*,al.nomalmacen almacen
                  FROM encargo en INNER JOIN almacen al ON (en.almacen_idalmacen = al.idalmacen)
                  INNER JOIN cliente cli ON (en.cliente_idcliente = cli.idcliente)
                  WHERE en.estado ='1' and cli.estado='1' and al.estado='1' and cli.nrodocumento ='".$nrodoc."'";
            
            echo json_encode($this->allmodel->querySql($sql)->result());
        }
        
        public function createTableEncargoCliente($nrodoc){
            $sql="SELECT en.*,al.nomalmacen almacen
                  FROM encargo en INNER JOIN almacen al ON (en.almacen_idalmacen = al.idalmacen)
                  INNER JOIN cliente cli ON (en.cliente_idcliente = cli.idcliente)
                  WHERE en.estado ='1' and cli.estado='1' and al.estado='1' and cli.nrodocumento ='".$nrodoc."'";
            
            $data["encargo"] = $this->allmodel->querySql($sql)->result();
            $this->load->view("encargo/listaEncargosCliente",$data);
        }

}
