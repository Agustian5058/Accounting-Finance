<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_pengeluaran extends CI_Model {

	var $table = 'pengeluaran';
	var $column_order = array(null,'p.tgl_pengeluaran', 'p.kode_voucher', 's.kode_sasaran', null, 'p.keterangan', 'p.jumlah_pengeluaran', null, null); //set column field database for datatable orderable
	var $column_search = array('p.tgl_pengeluaran', 'p.kode_voucher', 's.kode_sasaran', 'a.kode_alat', 'p.keterangan', 'p.jumlah_pengeluaran'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('p.tgl_pengeluaran' => 'desc'); // default order 

	function addPengeluaran($data){
		$insert = $this->db->insert($this->table, $data);
		return $insert;
	}

	function updatePengeluaran($pengeluaran_id, $data){
		$update = $this->db->where('pengeluaran_id', $pengeluaran_id)
						   ->update($this->table, $data);
		return $update;

	}

	function deletePengeluaran($pengeluaran_id){
		$this->db->where('pengeluaran_id', $pengeluaran_id);
		$hasil = $this->db->delete($this->table);
		return $hasil;
	}

	function getPengeluaranAll(){
		$hasil = $this->db->get($this->table)->result();
		return $hasil;
	}

	function getPengeluaranById($pengeluaran_id){
		$hasil = $this->db->get_where($this->table, array('pengeluaran_id' => $pengeluaran_id))->row();
		return $hasil;
	}

	function getJumlahPengeluaranByAlatIdAndPenyediaIdAndRangTglPengeluaran($alat_id, $penyedia_id, $tgl_awal, $tgl_akhir){
		$query = "	SELECT sum(peng.jumlah_pengeluaran) as total_pengeluaran 
					from pengeluaran as peng
					inner join tanggungan_penyedia tgp on tgp.pengeluaran_id=peng.pengeluaran_id
					where peng.alat_id = ?
					and tgp.penyedia_id = ?
					and ( peng.tgl_pengeluaran between ? and ? )";
		$hasil = $this->db->query($query, array($alat_id, $penyedia_id, $tgl_awal, $tgl_akhir))->row();
		return $hasil;
	}	

	function getPengeluaranByAlatIdAndRangeTglPemasukan($alat_id,$tgl_awal,$tgl_akhir){
		$query = " SELECT DISTINCT peng.pengeluaran_id, peng.keterangan, peng.jumlah_pengeluaran, 
					peng.tgl_pengeluaran, al.nama_alat, al.kode_alat, sasdan.sasaran, peny.kode_penyedia, peng.kode_voucher
					from pengeluaran as peng
					inner join sasaran_dana as sasdan on sasdan.sasarandana_id=peng.sasarandana_id
					inner join alat as al on peng.alat_id=al.alat_id
					inner join tanggungan_penyedia as tgp on tgp.pengeluaran_id=peng.pengeluaran_id
					inner join penyedia as peny on peny.penyedia_id=tgp.penyedia_id
					where peng.alat_id= ? and (peng.tgl_pengeluaran between ? and ?)";
		$hasil = $this->db->query($query, array($alat_id, $tgl_awal, $tgl_akhir))->result();
		return $hasil;
	}

	function getPengeluaranFeeByRangeTglPemasukan($tgl_awal,$tgl_akhir){
		$query = " SELECT DISTINCT peng.pengeluaran_id, peng.keterangan, peng.jumlah_pengeluaran, sasdan.sasaran, peny.kode_penyedia
					from pengeluaran as peng
					inner join fee on fee.pengeluaran_id=peng.pengeluaran_id
					inner join sasaran_dana as sasdan on sasdan.sasarandana_id=peng.sasarandana_id
					inner join penyedia as peny on peny.penyedia_id=fee.penyedia_id
					where (peng.tgl_pengeluaran between ? and ?)";
		$hasil = $this->db->query($query, array($tgl_awal, $tgl_akhir))->result();
		return $hasil;
	}

	function getPengeluaranFeeByRangeTglPemasukanAndJenisBiaya($tgl_awal,$tgl_akhir,$jenis_biaya){
		$query = " SELECT DISTINCT peng.pengeluaran_id, peng.keterangan, peng.jumlah_pengeluaran, sasdan.sasaran, peny.kode_penyedia
					from pengeluaran as peng
					inner join fee on fee.pengeluaran_id=peng.pengeluaran_id
					inner join sasaran_dana as sasdan on sasdan.sasarandana_id=peng.sasarandana_id
					inner join penyedia as peny on peny.penyedia_id=fee.penyedia_id
					where (peng.tgl_pengeluaran between ? and ?) and sasdan.sasarandana_id = ?";
		$hasil = $this->db->query($query, array($tgl_awal, $tgl_akhir, $jenis_biaya))->result();
		return $hasil;
	}

	function getPengeluaranAllBySasaranDanaIdAndRangeDate($sasarandana_id,$tgl_awal,$tgl_akhir){
		$this->db->select('p.pengeluaran_id, 
						   p.tgl_pengeluaran, 
						   p.kode_voucher, 
						   p.keterangan, 
						   p.jumlah_pengeluaran, 
						   s.kode_sasaran, 
						   a.kode_alat, 
						   f.fee_id, 
						   pl.kode_pemilik, 
						   py.kode_penyedia')
				 ->from('pengeluaran as p')
				 ->join('sasaran_dana as s','p.sasarandana_id=s.sasarandana_id')
				 ->join('alat as a','a.alat_id=p.alat_id','left')
				 ->join('fee as f','f.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('tanggungan_pemilik as tp','tp.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('pemilik as pl','pl.pemilik_id=tp.pemilik_id','left')
				 ->join('tanggungan_penyedia as tj','tj.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('penyedia as py','py.penyedia_id=tj.penyedia_id','left')
				 ->where('s.sasarandana_id',$sasarandana_id)
				 ->where('p.tgl_pengeluaran >=',$tgl_awal)
				 ->where('p.tgl_pengeluaran <=',$tgl_akhir)
				 ->order_by('s.kode_sasaran', 'asc');
		$hasil = $this->db->get()->result();
		return $hasil;
	}

	function getPengeluaranFeeByRangeSebelumTglPemasukan($tgl_awal){
		$query = " SELECT DISTINCT sum(peng.jumlah_pengeluaran) as jumlah_pengeluaran_fee
					from pengeluaran as peng
					inner join fee on fee.pengeluaran_id=peng.pengeluaran_id
					where (peng.tgl_pengeluaran < ?)";
		$hasil = $this->db->query($query, array($tgl_awal))->result();
		return $hasil;
	}

	function getPengeluaranAllTokoIdAndRangeDate($toko_id, $tgl_awal, $tgl_akhir){
		$this->db->select('p.pengeluaran_id, 
						   p.tgl_pengeluaran, 
						   p.kode_voucher, 
						   p.keterangan, 
						   p.jumlah_pengeluaran, 
						   s.kode_sasaran, 
						   a.kode_alat, 
						   f.fee_id, 
						   pl.kode_pemilik, 
						   py.kode_penyedia,
						   t.kode_toko')
				 ->from('pengeluaran as p')
				 ->join('toko as t','t.toko_id=p.toko_id')
				 ->join('sasaran_dana as s','p.sasarandana_id=s.sasarandana_id')
				 ->join('alat as a','a.alat_id=p.alat_id','left')
				 ->join('fee as f','f.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('tanggungan_pemilik as tp','tp.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('pemilik as pl','pl.pemilik_id=tp.pemilik_id','left')
				 ->join('tanggungan_penyedia as tj','tj.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('penyedia as py','py.penyedia_id=tj.penyedia_id','left')
				 ->where('t.toko_id',$toko_id)
				 ->where('p.tgl_pengeluaran >=',$tgl_awal)
				 ->where('p.tgl_pengeluaran <=',$tgl_akhir)
				 ->order_by('p.pengeluaran_id', 'asc');
		$hasil = $this->db->get()->result();
		return $hasil;
	}

	function getPengeluaranTokoAndRangeDate($tgl_awal, $tgl_akhir){
		$this->db->select('p.pengeluaran_id, 
						   p.tgl_pengeluaran, 
						   p.kode_voucher, 
						   p.keterangan, 
						   p.jumlah_pengeluaran, 
						   s.kode_sasaran, 
						   a.kode_alat, 
						   f.fee_id, 
						   pl.kode_pemilik, 
						   py.kode_penyedia,
						   t.kode_toko,
						   t.nama_toko')
				 ->from('pengeluaran as p')
				 ->join('toko as t','t.toko_id=p.toko_id')
				 ->join('sasaran_dana as s','p.sasarandana_id=s.sasarandana_id')
				 ->join('alat as a','a.alat_id=p.alat_id','left')
				 ->join('fee as f','f.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('tanggungan_pemilik as tp','tp.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('pemilik as pl','pl.pemilik_id=tp.pemilik_id','left')
				 ->join('tanggungan_penyedia as tj','tj.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('penyedia as py','py.penyedia_id=tj.penyedia_id','left')
				 ->where('p.tgl_pengeluaran >=',$tgl_awal)
				 ->where('p.tgl_pengeluaran <=',$tgl_akhir)
				 ->order_by('p.pengeluaran_id', 'asc');
		$hasil = $this->db->get()->result();
		return $hasil;
	}

	function getPengeluaranAllPemilikIdAndRangeDate($pemilik_id, $tgl_awal, $tgl_akhir){
		$this->db->select('p.pengeluaran_id, 
						   p.tgl_pengeluaran, 
						   p.kode_voucher, 
						   p.keterangan, 
						   p.jumlah_pengeluaran, 
						   s.kode_sasaran, 
						   a.kode_alat, 
						   f.fee_id, 
						   pl.kode_pemilik, 
						   py.kode_penyedia,
						   t.kode_toko')
				 ->from('pengeluaran as p')
				 ->join('toko as t','t.toko_id=p.toko_id','left')
				 ->join('sasaran_dana as s','p.sasarandana_id=s.sasarandana_id')
				 ->join('alat as a','a.alat_id=p.alat_id','left')
				 ->join('fee as f','f.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('tanggungan_pemilik as tp','tp.pengeluaran_id=p.pengeluaran_id')
				 ->join('pemilik as pl','pl.pemilik_id=tp.pemilik_id')
				 ->join('tanggungan_penyedia as tj','tj.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('penyedia as py','py.penyedia_id=tj.penyedia_id','left')
				 ->where('pl.pemilik_id',$pemilik_id)
				 ->where('p.tgl_pengeluaran >=',$tgl_awal)
				 ->where('p.tgl_pengeluaran <=',$tgl_akhir)
				 ->order_by('p.pengeluaran_id', 'asc');
		$hasil = $this->db->get()->result();
		return $hasil;
	}

	function getPengeluaranAllByAlatIdAndRangeDate($alat_id, $tgl_awal, $tgl_akhir){
		$this->db->select('p.pengeluaran_id, 
						   p.tgl_pengeluaran, 
						   p.kode_voucher, 
						   p.keterangan, 
						   p.jumlah_pengeluaran, 
						   s.kode_sasaran, 
						   a.kode_alat, 
						   f.fee_id, 
						   pl.kode_pemilik, 
						   py.kode_penyedia')
				 ->from('pengeluaran as p')
				 ->join('sasaran_dana as s','p.sasarandana_id=s.sasarandana_id')
				 ->join('alat as a','a.alat_id=p.alat_id','left')
				 ->join('fee as f','f.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('tanggungan_pemilik as tp','tp.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('pemilik as pl','pl.pemilik_id=tp.pemilik_id','left')
				 ->join('tanggungan_penyedia as tj','tj.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('penyedia as py','py.penyedia_id=tj.penyedia_id','left')
				 ->where('a.alat_id',$alat_id)
				 ->where('p.tgl_pengeluaran >=',$tgl_awal)
				 ->where('p.tgl_pengeluaran <=',$tgl_akhir)
				 ->order_by('p.tgl_pengeluaran', 'asc')
				 ->order_by('s.kode_sasaran', 'asc');
		$hasil = $this->db->get()->result();
		return $hasil;
	}

	function getPengeluaranByRangeDate($tgl_awal, $tgl_akhir){
		$this->db->select('p.pengeluaran_id, 
						   p.tgl_pengeluaran, 
						   p.kode_voucher, 
						   p.keterangan, 
						   p.jumlah_pengeluaran, 
						   s.kode_sasaran, 
						   a.kode_alat, 
						   f.fee_id, 
						   pl.kode_pemilik, 
						   py.kode_penyedia')
				 ->from('pengeluaran as p')
				 ->join('sasaran_dana as s','p.sasarandana_id=s.sasarandana_id')
				 ->join('alat as a','a.alat_id=p.alat_id','left')
				 ->join('fee as f','f.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('tanggungan_pemilik as tp','tp.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('pemilik as pl','pl.pemilik_id=tp.pemilik_id','left')
				 ->join('tanggungan_penyedia as tj','tj.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('penyedia as py','py.penyedia_id=tj.penyedia_id','left')
				 ->where('p.tgl_pengeluaran >=',$tgl_awal)
				 ->where('p.tgl_pengeluaran <=',$tgl_akhir)
				 ->order_by('p.tgl_pengeluaran', 'asc')
				 ->order_by('s.kode_sasaran', 'asc');
		$hasil = $this->db->get()->result();
		return $hasil;
	}

	function getPengeluaranForEdit($pengeluaran_id){
		$this->db->select('p.pengeluaran_id, 
						   p.tgl_pengeluaran, 
						   p.kode_voucher, 
						   p.keterangan, 
						   p.jumlah_pengeluaran, 
						   p.toko_id,
						   p.alat_id,
						   s.sasarandana_id,
						   f.fee_id, 
						   f.penyedia_id as fee_via,
						   tp.tanggunganpemilik_id,
						   tj.tanggunganpenyedia_id,
						   pl.kode_pemilik, 
						   py.kode_penyedia')
				 ->from('pengeluaran as p')
				 ->join('sasaran_dana as s','p.sasarandana_id=s.sasarandana_id')
				 ->join('alat as a','a.alat_id=p.alat_id','left')
				 ->join('fee as f','f.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('tanggungan_pemilik as tp','tp.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('pemilik as pl','pl.pemilik_id=tp.pemilik_id','left')
				 ->join('tanggungan_penyedia as tj','tj.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('penyedia as py','py.penyedia_id=tj.penyedia_id','left')
				 ->where('p.pengeluaran_id',$pengeluaran_id);
		$hasil = $this->db->get()->row();
		return $hasil;
	}

	function queryDataTable(){
		$this->db->select('p.pengeluaran_id, 
						   p.tgl_pengeluaran, 
						   p.kode_voucher, 
						   p.keterangan, 
						   p.jumlah_pengeluaran, 
						   s.kode_sasaran, 
						   a.kode_alat, 
						   f.fee_id, 
						   pl.kode_pemilik, 
						   py.kode_penyedia')
				 ->from('pengeluaran as p')
				 ->join('sasaran_dana as s','p.sasarandana_id=s.sasarandana_id')
				 ->join('alat as a','a.alat_id=p.alat_id','left')
				 ->join('fee as f','f.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('tanggungan_pemilik as tp','tp.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('pemilik as pl','pl.pemilik_id=tp.pemilik_id','left')
				 ->join('tanggungan_penyedia as tj','tj.pengeluaran_id=p.pengeluaran_id','left')
				 ->join('penyedia as py','py.penyedia_id=tj.penyedia_id','left');
	}

	private function getDatatablesQuery()
	{
		
		$this->queryDataTable();

		$i = 0;
		if ($_POST['search']['value'] != ''){
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