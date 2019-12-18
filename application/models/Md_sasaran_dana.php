<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_sasaran_dana extends CI_Model {

	var $table = 'sasaran_dana';

	function getSasaranDanaAll(){
		return $this->db->get($this->table)->result();
	}	

	function getSasaranDanaById($sasarandana_id){
		$this->db->where('sasarandana_id', $sasarandana_id);
		return $this->db->get($this->table)->row();
	}

	function addSasaranDana($data){
		$this->db->insert($this->table, $data);
	}

	function updateSasaranDana($sasarandana_id, $data){
		$this->db->where('sasarandana_id', $sasarandana_id);
		$this->db->update($this->table, $data);
	}

	function deleteSasaranDana($sasarandana_id){
		$this->db->where('sasarandana_id', $sasarandana_id);
		$this->db->delete($this->table);
	}

}

/* End of file Md_sasaran_dana.php */
/* Location: ./application/models/Md_sasaran_dana.php */