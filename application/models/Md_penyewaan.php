<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_penyewaan extends CI_Model {

	var $table = 'penyewaan';
	function addPenyewaan($data){
		$this->db->insert($this->table, $data);
	}

	var $column_order = array(null,'al.nama_alat', 'pm.tgl_pemasukan','se.lama_pemakaian','cl.nama_client','se.harga_perjam','se.pph_penyewaan',null); //set column field database for datatable orderable
	var $column_search = array('al.nama_alat', 'pm.tgl_pemasukan','se.lama_pemakaian','cl.nama_client','se.harga_perjam','se.pph_penyewaan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('se.penyewaan_id' => 'desc'); // default order 

	function getPenyewaanAll(){
		$hasil = $this->db->get($this->table)->result();
		return $hasil;
	}

	function getPenyewaanById($penyewaan_id){
		$hasil = $this->db->get_where($this->table, array('penyewaan_id' => $penyewaan_id))->row();
		return $hasil;
	}

	function getPenyewaanForEdit($penyewaan_id){
		$this->db->select(' se.penyewaan_id,
							se.alat_id,
							se.lama_pemakaian,
							se.client_id,
							se.harga_perjam,
							se.biaya_penyewaan,
							se.pph_penyewaan,
							pm.tgl_pemasukan,
							pm.penyedia_id,
							pm.potongan_fee
						   ')
				 ->from('penyewaan as se')
				 ->join('pemasukan as pm','pm.penyewaan_id=se.penyewaan_id')
				 ->where('se.penyewaan_id', $penyewaan_id);
		return  $this->db->get()->row();
	}

	function updatePenyewaan($penyewaan_id, $data){
		$this->db->where('penyewaan_id', $penyewaan_id);
		$hasil = $this->db->update($this->table, $data);
		return $hasil;
	}

	function deletePenyewaan($penyewaan_id){
		$this->db->where('penyewaan_id', $penyewaan_id);
		$hasil = $this->db->delete($this->table);
		return $hasil;
	}

	function queryDataTable(){
		$this->db->select('se.penyewaan_id,al.nama_alat,se.lama_pemakaian,cl.nama_client,se.harga_perjam,se.pph_penyewaan,se.biaya_penyewaan, pm.tgl_pemasukan')
				 ->from('penyewaan as se')
				 ->join('alat as al','al.alat_id=se.alat_id')
				 ->join('client as cl','cl.client_id=se.client_id')
				 ->join('pemasukan as pm','pm.penyewaan_id=se.penyewaan_id');
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

/* End of file Md_penyewaan.php */
/* Location: ./application/models/Md_penyewaan.php */