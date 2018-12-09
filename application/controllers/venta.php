<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta extends CI_Controller {
	public function index(){
		layoutSystem("venta/index");
	}

	public function tableList(){
		$sql1 = "SELECT vt.*, 
                (SELECT sum(precio) 
                from detalle_venta dv 
                WHERE dv.venta_idventa = vt.idventa 
                GROUP BY dv.venta_idventa) total
                ,
                (SELECT val.alquiler_idalquiler 
                FROM venta_alquiler val 
                WHERE val.venta_idventa = vt.idventa),
                (SELECT cli.nombres || ' '  ||cli.apellidos || ' ( Cuarto N° ' || hb.nrohabitacion || ' )' 
                FROM venta_alquiler val INNER JOIN alquiler al ON (al.idalquiler = val.alquiler_idalquiler)
                INNER JOIN habitacion hb ON (al.habitacion_idhabitacion = hb.idhabitacion)
                INNER JOIN cliente cli ON (al.cliente_idcliente = cli.idcliente)
                WHERE val.venta_idventa = vt.idventa) cliente
                FROM venta vt INNER JOIN venta_alquiler valq ON (valq.venta_idventa = vt.idventa)
                INNER JOIN alquiler aql ON (aql.idalquiler = valq.alquiler_idalquiler)
                WHERE aql.estado = '1'
                ORDER BY vt.fecha desc";

		$data["ventas"] = $this->allmodel->querySql($sql1)->result();

		$this->load->view("venta/lista",$data);
	}

	public function detalle_venta($idventa){
		$sql = "SELECT dv.*, prd.nombre producto
		FROM detalle_venta dv INNER JOIN producto prd ON(prd.idproducto = dv.producto_idproducto)
		WHERE dv.estado='1' and dv.venta_idventa =".$idventa;
		$data["productos"] = $this->allmodel->querySql($sql)->result();
		$this->load->view("venta/detalle",$data);	
	}

	public function form_nuevo(){
		$sql_habocupadas = "SELECT * FROM habitacion WHERE (disponibilidad='2' or disponibilidad='3' or disponibilidad='5' or disponibilidad='6' ) and estado <> '0' ORDER BY idhabitacion asc";
		$sql_producto = "SELECT * FROM producto WHERE estado='1'";
		$data["hab_ocupadas"] = $this->allmodel->querySql($sql_habocupadas)->result();
		$data["productos"] = $this->allmodel->querySql($sql_producto)->result();
		$this->load->view("venta/nuevo",$data);	
	}


	public function ajax_save(){
		$id = $this->input->post("id");

		$data = array(
			"fecha" => $this->input->post("fecha")." ".$this->input->post("hora"),
			"estado" => '1'
		);

		$this->db->trans_start();
		if ($id == ""){
			$v = $this->allmodel->create("venta", $data);
			$productos = $this->input->post("idproducto");
			$precio = $this->input->post("precio");
			$total = 0;
			for ($i = 0; $i < count($productos) ; $i++) {
				$total+=$precio[$i];
				$detalle = array(
					"venta_idventa" => $v,
					"producto_idproducto" => $productos[$i],
					"precio" => $precio[$i],
					"estado" => '1'
				);
				$dv = $this->allmodel->create("detalle_venta", $detalle);
			}
			if($this->input->post("tipocliente") == "on"){
				$venta_alquiler = array(
					"alquiler_idalquiler" => $this->input->post("idalquiler"),
					"venta_idventa" => $v
				);
				$va = $this->allmodel->create("venta_alquiler", $venta_alquiler);	
			}
			if($this->input->post("cancelado") == "on"){
				$movimiento = array(
					"concepto_idconcepto" => 3,
					"fecha" => $this->input->post("fecha")." ".$this->input->post("hora"),
					"estado" => '1',
					"monto" => $total
				);
				$m = $this->allmodel->create("movimiento", $movimiento);

				$venta_movimiento = array(
					"venta_idventa" => $v,
					"movimiento_idmovimiento" => $m
				);

				$vm = $this->allmodel->create("ventamovimiento", $venta_movimiento);	

				$uv = $this->allmodel->update("venta", array("estado" => '2'), array('idventa'=> $v));
			}
		}else{
			$status = $this->allmodel->update("venta", $data, array('idventa'=> $id));
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
		$data = $this->allmodel->selectWhere('venta',array("idventa"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('venta',$delete,array('idventa' => $this->input->post("id")));
		echo json_encode($status);
	}
}
