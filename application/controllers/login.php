<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		if($this->session->userdata('logged_in')){
			layoutSystem('dashboard/index');
		}else{
			$data["name_system"] = "Hospedaje Martinez";
			$this->load->view('login/index',$data);
		}
	
	}
	
	public function In(){
		if($this->input->post('usuario')){
			$data_autorizacion = array(
				'usuario' => $this->input->post('usuario'),
				'clave' => $this->input->post('clave'),
				'estado' => '1'
			);
			$user = $this->allmodel->selectWhere('usuarios',$data_autorizacion)->result();
			if(count($user) > 0){
				$data_personal = array(
					'idpersonal' => $user[0]->personal_idpersonal
				);

				$person = $this->allmodel->selectWhere('personal',$data_personal)->result();
				$cargo = $this->allmodel->selectWhere('cargo',array('idcargo' => $person[0]->cargo_idcargo))->result();

				$varSession = array(
					'nombres' => $person[0]->nombres,
					'apellidos' => $person[0]->apellidos,				
					'dni' => $person[0]->dni,
					'idpersonal' => $person[0]->idpersonal,
					'idusuario' => $user[0]->idusuario,
					'cargo' => $cargo[0]->descripcion,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($varSession);

				redirect("home");
			}else{
				redirect();
			}	
		}else{
			redirect();
		}
		
	}

	public function Out(){
		$varSession = $this->session->all_userdata();
		$this->session->unset_userdata($varSession);
		$this->session->sess_destroy();
		redirect();
	}

}
