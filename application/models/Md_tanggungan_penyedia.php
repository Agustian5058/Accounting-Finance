<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_tanggungan_penyedia extends CI_Model {

	var $table = 'tanggungan_penyedia';
	function addTanggunganPenyedia($data){
		$this->db->insert($this->table, $data);
	}

	function updateTanggunganPenyedia($id, $data){
		$this->db->where('tanggunganpenyedia_id',$id);
		$this->db->update($this->table, $data);
	}

	function deleteTanggunganPenyedia($id){
		$this->db->where('tanggunganpenyedia_id', $id);
		$this->db->delete($this->table);
	}

}

/* End of file Md_tanggungan_penyedia.php */
/* Location: ./application/models/Md_tanggungan_penyedia.php */