<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_pemasukan extends CI_Model {

	var $table = 'pemasukan';
	var $column_order = array(null,'pem.tgl_pemasukan', 'al.kode_alat', 'pem.pemasukan_setelah_pph', 'peny.kode_penyedia'); //set column field database for datatable orderable
	var $column_search = array('pem.tgl_pemasukan', 'al.kode_alat', 'pem.pemasukan_setelah_pph', 'peny.kode_penyedia'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('pem.tgl_pemasukan' => 'desc'); // default order 

	function addPemasukan($data){
		$insert = $this->db->insert($this->table, $data);
		// return $insert;
	}

	function updatePemasukan($pemasukan_id, $data){
		$update = $this->db->where('pemasukan_id', $pemasukan_id)
						   ->update($this->table, $data);
		return $update;

	}

	function deletePemasukan($pemasukan_id){
		$this->db->where('pemasukan_id', $pemasukan_id);
		$hasil = $this->db->delete($this->table);
		return $hasil;
	}

	function getPemasukanAll(){
		$hasil = $this->db->get($this->table)->result();
		return $hasil;
	}

	function getJumlahPemasukanByAlatIdAndPenyediaIdAndRangeTglPemasukan($alat_id, $penyedia_id, $tgl_awal, $tgl_akhir){
		$query = "	SELECT sum(pem.pemasukan_setelah_pph) as total_pemasukan, sum(pem.potongan_fee) as fee_op 
					from pemasukan as pem 
					inner join penyewaan as peny on peny.penyewaan_id=pem.penyewaan_id
					where peny.alat_id = ?
					and pem.penyedia_id = ?
					and ( pem.tgl_pemasukan between ? and ? )";
		$hasil = $this->db->query($query, array($alat_id, $penyedia_id, $tgl_awal, $tgl_akhir))->row();
		return $hasil;
	}

	function getPemasukanByAlatIdAndRangeTglPemasukan($alat_id,$tgl_awal,$tgl_akhir){
		$query = "	SELECT pem.pemasukan_id, pem.pemasukan_setelah_pph as jumlah_pemasukan, al.nama_alat, al.kode_alat, peny.lama_pemakaian, peny.harga_perjam, peny.biaya_penyewaan, 
						   peny.pph_penyewaan, pem.tgl_pemasukan, cl.nama_client, penyet.kode_penyedia
					from pemasukan as pem
					inner join penyewaan as peny on peny.penyewaan_id=pem.penyewaan_id
					inner join alat as al on peny.alat_id=al.alat_id
					inner join client as cl on cl.client_id=peny.client_id
					inner join penyedia as penyet on penyet.penyedia_id=pem.penyedia_id
					where peny.alat_id= ? and (pem.tgl_pemasukan between ? and ?)";
		$hasil = $this->db->query($query, array($alat_id, $tgl_awal, $tgl_akhir))->result();
		return $hasil;
	}

	function getPemasukanById($pemasukan_id){
		$hasil = $this->db->get_where($this->table, array('pemasukan_id' => $pemasukan_id))->row();
		return $hasil;
	}

	function getPemasukanByPenyewaanId($penyewaan_id){
		$hasil = $this->db->get_where($this->table, array('penyewaan_id' => $penyewaan_id))->row();
		return $hasil;
	}	

	function getPemasukanFeeByAlatIdAndRangeTglPemasukan($alat_id,$tgl_awal,$tgl_akhir){
		$query = "	SELECT pem.pemasukan_id, pem.pemasukan_setelah_pph as jumlah_pemasukan, al.nama_alat, al.kode_alat, peny.lama_pemakaian, peny.harga_perjam, peny.biaya_penyewaan, pem.potongan_fee, peny.pph_penyewaan, pem.tgl_pemasukan, cl.nama_client, penyet.kode_penyedia
					from pemasukan as pem
					inner join penyewaan as peny on peny.penyewaan_id=pem.penyewaan_id
					inner join alat as al on peny.alat_id=al.alat_id
					inner join client as cl on cl.client_id=peny.client_id
					inner join penyedia as penyet on penyet.penyedia_id=pem.penyedia_id
					where peny.alat_id= ? and (pem.tgl_pemasukan between ? and ?)";
		$hasil = $this->db->query($query, array($alat_id, $tgl_awal, $tgl_akhir))->result();
		return $hasil;
	}

	function getPemasukanFeeRangeTglPemasukan($tgl_awal,$tgl_akhir){
		$query = "	SELECT sum(pem.potongan_fee) as jumlah_pemasukan_fee
					from pemasukan as pem
					inner join fee on fee.pemasukan_id=pem.pemasukan_id
					where (pem.tgl_pemasukan between ? and ?)";
		$hasil = $this->db->query($query, array($tgl_awal, $tgl_akhir))->result();
		return $hasil;
	}

	function getPemasukanFeeRangeSebelumTglPemasukan($tgl_awal){
		$query = "	SELECT sum(pem.potongan_fee) as jumlah_pemasukan_fee
					from pemasukan as pem
					inner join fee on fee.pemasukan_id=pem.pemasukan_id
					where pem.tgl_pemasukan < ?";
		$hasil = $this->db->query($query, array($tgl_awal))->result();
		return $hasil;
	}

	function getPemasukanByTgl($tgl_awal, $tgl_akhir){
		$query = "	SELECT pem.pemasukan_id, pem.pemasukan_setelah_pph as jumlah_pemasukan, al.nama_alat, al.kode_alat, peny.lama_pemakaian, peny.harga_perjam, peny.biaya_penyewaan, 
						   peny.pph_penyewaan, pem.tgl_pemasukan, cl.nama_client, py.kode_penyedia, pem.potongan_fee
					from pemasukan as pem
					inner join penyewaan as peny on peny.penyewaan_id=pem.penyewaan_id
					inner join alat as al on peny.alat_id=al.alat_id
					inner join client as cl on cl.client_id=peny.client_id
					inner join penyedia as py on py.penyedia_id=pem.penyedia_id
					where (pem.tgl_pemasukan between ? and ?)
					order by pem.tgl_pemasukan, al.kode_alat;";
		$hasil = $this->db->query($query, array($tgl_awal, $tgl_akhir))->result();
		return $hasil;
	}

	function queryDataTable(){
		$this->db->select('pem.tgl_pemasukan, al.kode_alat, pem.pemasukan_setelah_pph, peny.kode_penyedia')
				 ->from('pemasukan as pem')
				 ->join('penyewaan as pe','pe.penyewaan_id=pem.penyewaan_id')
				 ->join('alat as al','al.alat_id=pe.alat_id')
				 ->join('penyedia as peny','peny.penyedia_id=pem.penyedia_id');
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