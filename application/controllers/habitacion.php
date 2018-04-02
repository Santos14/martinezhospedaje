<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Habitacion extends CI_Controller {
	public function index(){
		layoutSystem("habitacion/index");
	}

	public function tableList(){
		$sql = "SELECT h.*,th.descripcion tipohabitacion 
				FROM habitacion h INNER JOIN tipohabitacion th ON (h.tipohabitacion_idtipohabitacion = th.idtipohabitacion)
				WHERE h.estado<>'0' 
				ORDER BY h.idhabitacion asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("habitacion/lista",$data);
	}

	public function form_nuevo(){
		$data["tipohabitacion"] = $this->allmodel->selectWhere('tipohabitacion',array("estado"=>'1'))->result();
		$this->load->view("habitacion/nuevo",$data);	
	}

	public function space_servicio(){
		$data["servicios"] = $this->allmodel->selectWhere('servicio',array("estado"=>'1'))->result();
		$this->load->view("habitacion/servicio",$data);	
	}

	public function space_elemento(){
		$data["elementos"] = $this->allmodel->selectWhere('elemento',array("estado"=>'1'))->result();
		$this->load->view("habitacion/elemento",$data);	
	}

	public function ajax_save(){
		$id = $this->input->post("id");
		/*
			disponibilidad       Estado
			- Ocupado (2)			 - Limpio (1)
			- Libre  (1)			 - Sucio (2)
			- Reservado. (3)		 - Eliminado (0)
		*/
		$habitacion = array(
			"nrohabitacion" => $this->input->post("nrohabitacion"),
			"tipohabitacion_idtipohabitacion" => $this->input->post("idtipohabitacion"),
			"precio" => $this->input->post("precio"),
			"disponibilidad" => '1',
			"estado" => '1',
			"cambiosabana" => '1900-01-01',
			"estcambiosabana" => '0'
		);

		$this->db->trans_start();

		if ($id == ""){

			$idhabitacion = $this->allmodel->create("habitacion", $habitacion);
			
			$serv_checks = $this->input->post("serv_cheks");
			$elem_checks = $this->input->post("elem_cheks");
			$elem_especificacion = $this->input->post("elem_especificacion");
			if($this->input->post("serv_cheks")!=null){
				if(count($serv_checks)!=0){
					foreach ($serv_checks as $value) {
						$detalle_servicio = array(
							"servicio_idservicio" => $value,
							"habitacion_idhabitacion" => $idhabitacion
						);
						$ds = $this->allmodel->create("detalle_servicio",$detalle_servicio);
					}
				}
			}
			if($this->input->post("elem_cheks")!=null){
				if(count($elem_checks)!=0){
					for ($i = 0; $i < count($elem_checks) ; $i++) {
						$detalle_elemento = array(
							"habitacion_idhabitacion" => $idhabitacion,
							"elemento_idelemento" => $elem_checks[$i],
							"especificacion" => $elem_especificacion[$i]
						);
						$de = $this->allmodel->create("detalle_elementos",$detalle_elemento);	
					}
				}
			}
		}else{
			$this->allmodel->update("habitacion", $habitacion, array('idhabitacion'=> $id));
			$this->allmodel->delete("detalle_servicio",array('habitacion_idhabitacion'=> $id));
			$this->allmodel->delete("detalle_elementos",array('habitacion_idhabitacion'=> $id));

			if($this->input->post("serv_cheks")!=null){
				$serv_checks = $this->input->post("serv_cheks");
				if(count($serv_checks)!=0){
					foreach ($serv_checks as $value) {
						$detalle_servicio = array(
							"servicio_idservicio" => $value,
							"habitacion_idhabitacion" => $id
						);
						$ds = $this->allmodel->create("detalle_servicio",$detalle_servicio);
					}
				}
			}

			if($this->input->post("elem_cheks")!=null){
				$elem_checks = $this->input->post("elem_cheks");
				$elem_especificacion = $this->input->post("elem_especificacion");
				if(count($elem_checks)!=0){
					for ($i = 0; $i < count($elem_checks) ; $i++) {
						$detalle_elemento = array(
							"habitacion_idhabitacion" => $id,
							"elemento_idelemento" => $elem_checks[$i],
							"especificacion" => $elem_especificacion[$i]
						);
						$de = $this->allmodel->create("detalle_elementos",$detalle_elemento);	
						
					}
				}

			}
			
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
		$data["habitacion"] = $this->allmodel->selectWhere('habitacion',array("idhabitacion"=>$id))->result();
		$data["detalle_servicio"]  = $this->allmodel->selectWhere('detalle_servicio',array("habitacion_idhabitacion"=>$id))->result();
		$data["detalle_elemento"] = $this->allmodel->selectWhere('detalle_elementos',array("habitacion_idhabitacion"=>$id))->result();
		echo json_encode($data);
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('habitacion',$delete,array('idhabitacion' => $this->input->post("id")));
		echo json_encode($status);
	}
}
