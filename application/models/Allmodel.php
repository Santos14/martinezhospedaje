<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Allmodel extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function selectAll($table,$select='*'){
		$this->db->select($select);
		return $this->db->get($table);
	}
	public function selectWhere($table,$where){
		return $this->db->get_where($table,$where);
	}

	public function delete($table,$where){
		return $this->db->delete($table,$where);
	}
	public function update($table,$data,$where){
		return $this->db->update($table,$data,$where);
	}
	public function create($table,$data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	public function querySql($sql){
		return $this->db->query($sql);
	}
	public function transSql($sqls){
		$this->db->trans_start();
		foreach ($sqls as $sql) {
			$this->db->query($sql);
		}
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	public function searchPrimaryKey($data){
		foreach ($data->field_data() as $field) {
			if($field->primary_key == 2){
				$field_primary = $field->name;
			}
		}
		return $field_primary; 
	}


}