<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_toko extends CI_Model {

	function getTokoAll(){
		$hasil = $this->db->get('toko')->result();
		return $hasil;
	}

	function addToko($data){
		return $this->db->insert('toko', $data);
	}

	function getTokoById($toko_id){
		$hasil = $this->db->get_where('toko', array('toko_id' => $toko_id))->row();
		return $hasil;
	}

	function updateToko($toko_id, $data){
		$this->db->where('toko_id', $toko_id);
		return $this->db->update('toko', $data);
	}

	function deleteToko($toko_id){
		$this->db->where('toko_id',$toko_id);
		return $this->db->delete('toko');
	}

}

/* End of file Md_toko.php */
/* Location: ./application/models/Md_toko.php */