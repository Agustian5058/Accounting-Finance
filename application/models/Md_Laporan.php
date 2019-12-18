<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_laporan extends CI_Model {

	var $table = 'pengeluaran';
	var $column_order = array(null,'pem.pengeluaran_id', 'pem.rincian', 'pem.pengeluaran', 'pem.tgl_pengeluaran', 'al.kode_alat', 'pemil.kode_pemilik', null); //set column field database for datatable orderable
	var $column_search = array('pem.rincian','pem.pengeluaran','pem.tgl_pengeluaran', 'al.kode_alat', 'pemil.kode_pemilik'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('pem.tgl_pengeluaran' => 'desc'); // default order 

	function getPengeluaranAll(){
		$hasil = $this->db->get($this->table)->result();
		return $hasil;
	}

	function getPengeluaranById($pengeluaran_id){
		$hasil = $this->db->get_where($this->table, array('pengeluaran_id' => $pengeluaran_id))->row();
		return $hasil;
	}	

	function queryDataTable(){
		$this->db->select('pem.pengeluaran_id, pem.rincian, pem.pengeluaran, pem.tgl_pengeluaran, al.kode_alat, pemil.kode_pemilik')
				 ->from('pengeluaran as pem')
				 ->join('alat as al','al.alat_id=pem.alat_id')
				 ->join('pemilik_alat as pemil','pemil.pemilikalat_id=pem.pemilikalat_id');
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

/* End of file Md_pemakai_alat.php */
/* Location: ./application/models/Md_pemakai_alat.php */