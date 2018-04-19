<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function index(){
		layoutSystem("cliente/index");
	}

	public function tableList(){
		$sql = "SELECT * FROM cliente WHERE estado='1' ORDER BY idcliente asc";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("cliente/lista",$data);
	}

	public function form_cli(){
		$this->load->view("cliente/nuevo");	
	}

	public function clienteActual($habitacion){
		$sql = "SELECT al.idalquiler, hb.nrohabitacion, cli.apellidos,cli.nombres
		FROM habitacion hb INNER JOIN alquiler al ON (hb.idhabitacion = al.habitacion_idhabitacion)
		INNER JOIN cliente cli ON (cli.idcliente = al.cliente_idcliente)
		WHERE hb.disponibilidad = '2' and al.estado = '1' and hb.idhabitacion =".$habitacion;
		$data = $this->allmodel->querySql($sql)->result();
		echo json_encode($data);
	}

	public function verhistorial($id){

		$sql_alq = "SELECT al.*,cli.nrodocumento,cli.nombres,cli.apellidos,hb.nrohabitacion,thb.descripcion tipohabitacion,
		(
		SELECT sum(amr.monto)
		FROM alquiler alq INNER JOIN amortizacion amr ON (alq.idalquiler = amr.alquiler_idalquiler)
		WHERE amr.estado = '1' and alq.idalquiler = al.idalquiler
		GROUP BY alq.idalquiler
		) montopagado
		FROM alquiler al INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion)
		INNER JOIN cliente cli ON (al.cliente_idcliente = cli.idcliente)
		INNER JOIN tipohabitacion thb ON (thb.idtipohabitacion = hb.tipohabitacion_idtipohabitacion)
		WHERE cli.idcliente=".$id." ORDER BY al.fecha_ingreso desc";

		$data["alquileres"] = $this->allmodel->querySql($sql_alq)->result();

		$data["cliente"] = $this->allmodel->selectWhere("cliente",array("idcliente"=>$id))->result();

		$this->load->view("cliente/historial",$data);

	}

	public function ajax_searchdni($dni){
		$sqldni = "SELECT * FROM cliente WHERE estado='1' and nrodocumento='".$dni."'";
		$data = $this->allmodel->querySql($sqldni)->result();
		echo json_encode($data);
	}

	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"tipodocumento" => $this->input->post("tipodocumento"),
			"nrodocumento" => $this->input->post("nrodocumento"),
			"nombres" => $this->input->post("nombre"),
			"apellidos" => $this->input->post("apellido"),
			"nacionalidad" => $this->input->post("nacionalidad"),
			"ocupacion" => $this->input->post("ocupacion"),
			"fechanac" => $this->input->post("fechanac"),
			"sexo" => $this->input->post("sexo"),
			"telefono" => $this->input->post("telefono"),
			"estado" => '1'
		);

		if ($id == ""){
			$status = $this->allmodel->create("cliente", $data);
		}else{
			$status = $this->allmodel->update("cliente", $data, array('idcliente'=> $id));
		}

		echo json_encode($status);
	}

	public function ajax_edit($id){
		$data = $this->allmodel->selectWhere('cliente',array("idcliente"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('cliente',$delete,array('idcliente' => $this->input->post("id")));
		echo json_encode($status);
	}
}
