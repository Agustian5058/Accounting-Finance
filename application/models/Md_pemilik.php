<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_pemilik extends CI_Model {

	var $table = 'pemilik';
	var $column_order = array('pemilik_id','kode_pemilik','nama_pemilik','alamat_pemilik','kontak_pemilik',null); //set column field database for datatable orderable
	var $column_search = array('kode_pemilik','nama_pemilik','kontak_pemilik','alamat_pemilik'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('pemilik_id' => 'asc'); // default order 

	function addPemilik($data){
		$insert = $this->db->insert($this->table, $data);
		return $insert;
	}

	function updatePemilik($pemilik_id, $data){
		$update = $this->db->where('pemilik_id', $pemilik_id)
						   ->update($this->table, $data);
		return $update;

	}

	function deletePemilik($pemilik_id){
		$update = $this->db->where('pemilik_id', $pemilik_id)
						   ->delete($this->table);
		return $update;
	}

	function getPemilikAll(){
		$hasil = $this->db->get($this->table)->result();
		return $hasil;
	}

	function getPemilikById($pemilik_id){
		$hasil = $this->db->get_where($this->table, array('pemilik_id' => $pemilik_id))->row();
		return $hasil;
	}	

	private function getDatatablesQuery()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function getDatatables()
	{
		$this->getDatatablesQuery();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function countFiltered()
	{
		$this->getDatatablesQuery();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAll()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

}

/* End of file Md_pemilik_alat.php */
/* Location: ./application/models/Md_pemilik_alat.php */