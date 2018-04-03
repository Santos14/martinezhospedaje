<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Morosidad extends CI_Controller {
	public function index(){
		layoutSystem("morosidad/index");
	}

	public function tableList(){
		$sql = "SELECT mo.*, cp.descripcion concepto, cli.nombres, cli.apellidos,cli.tipodocumento,cli.nrodocumento FROM morosidad mo INNER JOIN concepto cp ON (mo.idconcepto = cp.idconcepto)
		INNER JOIN cliente cli ON (mo.idcliente = cli.idcliente)";
		$data["data"] = $this->allmodel->querySql($sql);
		$this->load->view("morosidad/lista",$data);
	}
}
