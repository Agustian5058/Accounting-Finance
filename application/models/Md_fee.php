<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_fee extends CI_Model {

	var $table = 'fee';
	var $column_order = array(null,null, 'f.jenis_fee',null,null); //set column field database for datatable orderable
	var $column_search = array('pem.tgl_pemasukan','peng.tgl_pengeluaran','s.kode_sasaran','pem.potongan_fee','peng.jumlah_pengeluaran','peny.kode_penyedia'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('f.fee_id' => 'desc'); // default order 

	function addFee($data){
		$insert = $this->db->insert($this->table, $data);
		// return $insert;
	}

	function updateFee($fee_id, $data){
		$update = $this->db->where('fee_id', $fee_id)
						   ->update($this->table, $data);
		return $update;

	}

	function deleteFee($fee_id){
		$this->db->where('fee_id', $fee_id);
		$hasil = $this->db->delete($this->table);
		return $hasil;
	}

	function getFeeAll(){
		$hasil = $this->db->get($this->table)->result();
		return $hasil;
	}

	function getFeeById($fee_id){
		$hasil = $this->db->get_where($this->table, array('fee_id' => $fee_id))->row();
		return $hasil;
	}	

	function getFeeByPemasukanId($pemasukan_id){
		$hasil = $this->db->get_where($this->table, array('pemasukan_id' => $pemasukan_id))->row();
		return $hasil;
	}

	function getJumlahFeeDebitByPenyediaIdAndTglPemasukan($penyedia_id, $tgl_akhir){
		$query = "	SELECT sum(pem.potongan_fee) as fee_debit
					from fee as f
					inner join pemasukan as pem on pem.pemasukan_id=f.pemasukan_id
					where f.jenis_fee= ? and f.penyedia_id= ? and pem.tgl_pemasukan <= ?";
		$hasil = $this->db->query($query,array('Debit',$penyedia_id,$tgl_akhir))->row();
		return $hasil;
	}

	function getJumlahFeeKreditByPenyediaIdAndTglPemasukan($penyedia_id, $tgl_akhir){
		$query = "	SELECT sum(peng.jumlah_pengeluaran) as fee_kredit
					from fee as f
					inner join pengeluaran as peng on peng.pengeluaran_id=f.pengeluaran_id
					where f.jenis_fee= ? and f.penyedia_id= ? and peng.tgl_pengeluaran <= ?";
		$hasil = $this->db->query($query,array('Kredit',$penyedia_id,$tgl_akhir))->row();
		return $hasil;
	}

	function queryDataTable(){
		$this->db->select(' f.fee_id,
							f.jenis_fee,
							pem.potongan_fee,
							pem.tgl_pemasukan,
							peng.jumlah_pengeluaran,
							peng.tgl_pengeluaran,
							sd.kode_sasaran,
							peny.kode_penyedia,
							')
				 ->from('fee as f')
				 ->join('penyedia as peny','peny.penyedia_id=f.penyedia_id')
				 ->join('pemasukan as pem','pem.pemasukan_id=f.pemasukan_id','left')
				 ->join('pengeluaran as peng','peng.pengeluaran_id=f.pengeluaran_id','left')
				 ->join('sasaran_dana as sd','sd.sasarandana_id=peng.sasarandana_id','left');
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