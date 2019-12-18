<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_tanggungan_pemilik extends CI_Model {

	var $table = 'tanggungan_pemilik';
	function addTanggunganPemilik($data){
		$this->db->insert($this->table, $data);
	}

	function updateTanggunganPemilik($id, $data){
		$this->db->where('tanggunganpemilik_id',$id);
		$this->db->update($this->table, $data);
	}

	function deleteTanggunganPemilik($id){
		$this->db->where('tanggunganpemilik_id', $id);
		$this->db->delete($this->table);
	}

}

/* End of file Md_tanggungan_pemilik.php */
/* Location: ./application/models/Md_tanggungan_pemilik.php */