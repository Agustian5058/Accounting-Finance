<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_client extends CI_Model {

	var $table = 'client';
	var $column_order = array('client_id','kode_client','nama_client','alamat_client','kontak_client',null); //set column field database for datatable orderable
	var $column_search = array('kode_client','nama_client','alamat_client','kontak_client'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('client_id' => 'asc'); // default order 

	function addClient($data){
		$insert = $this->db->insert($this->table, $data);
		return $insert;
	}

	function updateClient($client_id, $data){
		$update = $this->db->where('client_id', $client_id)
						   ->update($this->table, $data);
		return $update;

	}

	function deleteClient($client_id){
		$update = $this->db->where('client_id', $client_id)
						   ->delete($this->table);
		return $update;
	}

	function getClientAll(){
		$hasil = $this->db->get($this->table)->result();
		return $hasil;
	}

	function getClientById($client_id){
		$hasil = $this->db->get_where($this->table, array('client_id' => $client_id))->row();
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

/* End of file Md_pemakai_alat.php */
/* Location: ./application/models/Md_pemakai_alat.php */