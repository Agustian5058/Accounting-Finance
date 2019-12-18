<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_alat extends CI_Model {

	var $table = 'alat';
	var $column_order = array(null,'al.kode_alat','al.nama_alat','pm.kode_pemilik','al.harga_perjam',null); //set column field database for datatable orderable
	var $column_search = array('al.nama_alat','al.kode_alat','al.harga_perjam'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('alat_id' => 'asc'); // default order 

	function getAlatAll(){
		$hasil = $this->db->get($this->table)->result();
		return $hasil;
	}

	function getAlatById($alat_id){
		$hasil = $this->db->get_where($this->table, array('alat_id' => $alat_id))->row();
		return $hasil;
	}

	
	function addAlat($data){
		$hasil = $this->db->insert($this->table, $data);
		return $hasil;
	}

	function updateAlat($alat_id, $data){
		$this->db->where('alat_id', $alat_id);
		$hasil = $this->db->update($this->table, $data);
		return $hasil;
	}

	function deleteAlat($alat_id){
		$this->db->where('alat_id', $alat_id);
		$hasil = $this->db->delete($this->table);
		return $hasil;
	}

	function queryDataTable(){
		$this->db->select('al.alat_id, al.nama_alat, al.kode_alat, al.harga_perjam, al.keterangan, pm.kode_pemilik')
				 ->from('alat as al')
				 ->join('pemilik as pm','pm.pemilik_id=al.pemilik_id');
	}

	private function getDatatablesQuery()
	{
		
		$this->queryDataTable();

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
		$this->queryDataTable();
		return $this->db->count_all_results();
	}

}

/* End of file Md_alat.php */
/* Location: ./application/models/Md_alat.php */