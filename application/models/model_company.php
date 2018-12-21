<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_company extends CI_model{

	//-------insert Data------//
	public function insertData($table_name,$data)
	{
		$insert = $this->db->insert($table_name,$data);
		return $insert;
	}

	//--------------Get Data---------------//
	public function getAllData($table_name){
		$data = $this->db->get($table_name);
		return $data->result_array();
	}

	//------------Delete Data-------------//
	function delete($table_name,$id,$id_db){
		$this->db->delete($table_name, array($id_db => $id));
		return;
	}
	
	//-----------Get Data by Id------------//
	function getData($table_name, $id,$id_db){
		$query = $this->db->where($id_db, $id)
		 					->get($table_name);
		if($query->num_rows()>0){
			return $query->row();
		}
	}

	//------------Update Data-------------//
	function update($table_name, $data, $id, $id_db){
		$this->db->where($id_db, $id);
		$this->db->update($table_name, $data);
	}

	function ambillogin($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get('admin')->row();
	}
}