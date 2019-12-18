<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_penyedia extends CI_Model {

	var $table = 'penyedia';
	function getPenyediaAll(){
		$hasil = $this->db->get('penyedia')->result();
		return $hasil;
	}

	function getPenyediaByKode($data){
		return $this->db->get_where($this->table, array('kode_penyedia' => $data))->row();
	}	

	function getPenyediaById($penyedia_id){
		return $this->db->get_where($this->table, array('penyedia_id' => $penyedia_id))->row();
	}

}

/* End of file Md_penyedia.php */
/* Location: ./application/models/Md_penyedia.php */