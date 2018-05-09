<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movimiento extends CI_Controller {
	public function index(){
		$data["anios"] = $this->allmodel->querySql("SELECT DISTINCT(EXTRACT(YEAR from fecha_ingreso)) anios FROM alquiler")->result();
		layoutSystem("movimiento/index",$data);
	}

	public function tableList(){
		$mes=date("m");
		$anio=date("Y");
		$sql = "SELECT tmo.idtipomovimiento,cp.idconcepto,mv.idmovimiento,tmo.descripcion tipomovimiento,cp.descripcion concepto, mv.fecha,mv.monto
			FROM movimiento mv INNER JOIN concepto cp ON (mv.concepto_idconcepto = cp.idconcepto)
			INNER JOIN tipomovimiento tmo ON (tmo.idtipomovimiento = cp.tipomovimiento_idtipomovimiento)
			WHERE mv.estado = '1' and (EXTRACT(MONTH FROM mv.fecha) = '".$mes."' and EXTRACT(YEAR FROM mv.fecha) = '".$anio."') ORDER BY mv.idmovimiento desc";
		$sql_ingreso = "SELECT sum(mo.monto) monto
		FROM movimiento mo INNER JOIN concepto cp ON (mo.concepto_idconcepto = cp.idconcepto)
		INNER JOIN tipomovimiento tm ON (cp.tipomovimiento_idtipomovimiento = tm.idtipomovimiento)
		WHERE mo.estado='1' and cp.estado = '1' and tm.estado = '1' and tm.idtipomovimiento=1 and (EXTRACT(MONTH FROM mo.fecha) = '".$mes."' and EXTRACT(YEAR FROM mo.fecha) = '".$anio."')";
		$sql_egreso = "SELECT sum(mo.monto) monto
		FROM movimiento mo INNER JOIN concepto cp ON (mo.concepto_idconcepto = cp.idconcepto)
		INNER JOIN tipomovimiento tm ON (cp.tipomovimiento_idtipomovimiento = tm.idtipomovimiento)
		WHERE mo.estado='1' and cp.estado = '1' and tm.estado = '1' and tm.idtipomovimiento=2 and (EXTRACT(MONTH FROM mo.fecha) = '".$mes."' and EXTRACT(YEAR FROM mo.fecha) = '".$anio."')";

		$data["data"] = $this->allmodel->querySql($sql);
		$data["ingreso"] = $this->allmodel->querySql($sql_ingreso)->result();
		$data["egreso"] = $this->allmodel->querySql($sql_egreso)->result();


		$this->load->view("movimiento/lista",$data);
	}

	public function form_nuevo(){
		$data["tipomovimientos"] = $this->allmodel->selectWhere("tipomovimiento",array("estado" => '1'))->result();
		$this->load->view("movimiento/nuevo",$data);	
	}
	public function conceptos($id){
		$concepto =$this->allmodel->querySql("SELECT * FROM concepto WHERE tipomovimiento_idtipomovimiento=".$id." ORDER BY idconcepto asc")->result();
		echo json_encode($concepto);
	}

	public function listaconcepto($id){
		switch ($id) {
			case '3':

				$sql1 = "SELECT *, (SELECT sum(precio) from detalle_venta dv WHERE dv.venta_idventa = vt.idventa GROUP BY dv.venta_idventa) total,(SELECT val.alquiler_idalquiler FROM venta_alquiler val WHERE val.venta_idventa = vt.idventa) FROM venta vt WHERE vt.estado = '1'";

				$sql2 = "SELECT al.idalquiler,hb.nrohabitacion,cli.apellidos,cli.nombres,al.estado estadoalquiler FROM alquiler al INNER JOIN cliente cli ON (al.cliente_idcliente = cli.idcliente) INNER JOIN habitacion hb ON (hb.idhabitacion = al.habitacion_idhabitacion)";

				$data["ventas"] = $this->allmodel->querySql($sql1)->result();
				$data["v_interno"] = $this->allmodel->querySql($sql2)->result();
				$this->load->view("movimiento/ventas",$data);	

				break;
			case '4':

				$sql_producto = "SELECT * FROM producto WHERE estado='1'";				
				$data["productos"] = $this->allmodel->querySql($sql_producto)->result();

				$this->load->view("movimiento/compras",$data);	

				break;

			case '1':

				$data["data_alquiler"] = pasajerosactuales();

				$this->load->view("movimiento/habitacion",$data);

				break;




			case '9':
				$sql = "SELECT ip.idimprevisto,ip.fecha,hb.nrohabitacion,cli.apellidos,cli.nombres,ti.descripcion tipoimprevisto,ip.monto,ip.estado
				FROM imprevisto ip INNER JOIN alquiler al ON (al.idalquiler = ip.alquiler_idalquiler)
				INNER JOIN tipoimprevisto ti ON (ti.idtipoimprevisto = ip.tipoimprevisto_idtipoimprevisto)
				INNER JOIN habitacion hb ON (hb.idhabitacion = al.habitacion_idhabitacion)
				INNER JOIN cliente cli ON (cli.idcliente = al.cliente_idcliente)
				WHERE ip.estado='1' and ti.estado = '1' and al.estado='1' and 
					hb.disponibilidad='2'";
				$data["data"] = $this->allmodel->querySql($sql);
				$this->load->view("movimiento/imprevistos",$data);
				break;

			default:
				$this->load->view("movimiento/general");
				break;

		}
		
	}

	
	

	public function ajax_save(){
		
		$this->db->trans_start();
		$data = array(
			"concepto_idconcepto" => $this->input->post("idconcepto"),
			"fecha" => $this->input->post("fecha")." ".$this->input->post("hora"),
			"estado" => '1',
			"descripcion" => $this->input->post("descripcion"),
			"monto" => $this->input->post("monto")
		);

		
		$m = $this->allmodel->create("movimiento", $data);
		


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

	public function ajax_pagohabitacion(){
		$this->db->trans_start();

			$movimiento = array(
				"concepto_idconcepto" => 1,
				"fecha" => date("Y-m-d H:i:s"),
				"estado" => '1',
				"monto" => $this->input->post("h_monto")
			);

			$m = $this->allmodel->create("movimiento", $movimiento);

			$amortizacion = array(
				"movimiento_idmovimiento" => $m,
				"alquiler_idalquiler" => $this->input->post("h_idalquiler"),
				"fecha" => date("Y-m-d H:i:s"),
				"monto" => $this->input->post("h_monto"),
				"estado" => "1"
			);

			$amort = $this->allmodel->create("amortizacion", $amortizacion);	



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

	public function ajax_pagoventa(){

	

		$this->db->trans_start();

			$movimiento = array(
				"concepto_idconcepto" => 3,
				"fecha" => date("Y-m-d H:i:s"),
				"estado" => '1',
				"monto" => $this->input->post("v_monto")
			);

			$m = $this->allmodel->create("movimiento", $movimiento);

			$venta_movimiento = array(
				"venta_idventa" => $this->input->post("v_idventa"),
				"movimiento_idmovimiento" => $m
			);

			$vm = $this->allmodel->create("ventamovimiento", $venta_movimiento);	

			$uv = $this->allmodel->update("venta", array("estado" => '2'), array('idventa'=> $this->input->post("v_idventa")));


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

	public function ajax_compras(){

		$this->db->trans_start();

		$movimiento = array(
			"concepto_idconcepto" => $this->input->post("idconcepto"),
			"fecha" => $this->input->post("fecha")." ".$this->input->post("hora"),
			"estado" => '1'
		);

		$m = $this->allmodel->create("movimiento", $movimiento);

		$compra = array(
			"movimiento_idmovimiento" => $m,
			"estado" => '2',
			"fecha" => date("Y-m-d H:i:s")
		);

		$c = $this->allmodel->create("compra", $compra);

		$productos = $this->input->post("idproducto");
		$precio = $this->input->post("precio");
		$total = 0;
		for ($i = 0; $i < count($productos) ; $i++) {
			$total+=$precio[$i];
			$detalle = array(
				"compra_idcompra" => $c,
				"producto_idproducto" => $productos[$i],
				"precio" => $precio[$i],
				"estado" => '1'
			);
			$dc = $this->allmodel->create("detalle_compra", $detalle);
		}

		$um = $this->allmodel->update("movimiento", array("monto" => $total), array('idmovimiento'=> $m));

	
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


	public function ajax_pagoimprevisto(){


		$this->db->trans_start();

			$movimiento = array(
				"concepto_idconcepto" => 9,
				"fecha" => date("Y-m-d H:i:s"),
				"estado" => '1',
				"monto" => $this->input->post("i_monto")
			);

			$m = $this->allmodel->create("movimiento", $movimiento);

			$imprevisto_movimiento = array(
				"imprevisto_idimprevisto" => $this->input->post("i_idimprevisto"),
				"movimiento_idmovimiento" => $m
			);

			$vm = $this->allmodel->create("imprevisto_movimiento", $imprevisto_movimiento);	

			$uv = $this->allmodel->update("imprevisto", array("estado" => '2'), array('idimprevisto'=> $this->input->post("i_idimprevisto")));


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
		$data = $this->allmodel->selectWhere('movimiento',array("idmovimiento"=>$id));
		echo json_encode($data->result());
	}

	public function ajax_delete(){
		$delete = array(
			'estado' => 0
		);
		$status = $this->allmodel->update('movimiento',$delete,array('idmovimiento' => $this->input->post("id")));
		echo json_encode($status);
	}
}
