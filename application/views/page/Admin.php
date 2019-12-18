<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Md_alat');
		$this->load->model('Md_pemilik');
		$this->load->model('Md_client');
		$this->load->model('Md_penyedia');
		$this->load->model('Md_toko');
		$this->load->model('Md_sasaran_dana');
		$this->load->model('Md_penyewaan');
		$this->load->model('Md_tanggungan_penyedia');
		$this->load->model('Md_tanggungan_pemilik');



		$this->load->model('Md_pemasukan');
		$this->load->model('Md_pengeluaran');
		$this->load->model('Md_fee');
	}

	public function index()
	{
		$pageData['page_name'] = 'dashboard'; 
		$this->load->view('index', $pageData);
	}

	public function alat($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['pemilik_alat'] = $this->Md_pemilik->getPemilikAll();
		}

		if ($argv == 'list'){
			$list = $this->Md_alat->getDatatables();
            $data = array();
            $no   = $_POST['start'];
            foreach ($list as $alat) {
                $no++;
                $row = array();
				$row[] = $no;
				$row[] = $alat->kode_alat;
				$row[] = $alat->nama_alat;
				$row[] = $alat->kode_pemilik;
				$row[] = 'Rp. '.number_format($alat->harga_perjam);
				$row[] = $alat->keterangan;
                
                $row[] = '
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a title="Edit" href="javascript:void(0)" onclick="edit_alat('."'".$alat->alat_id."'".')">
                                    <i class="fa fa-edit"></i> Edit </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" title="Hapus" onclick="delete_alat('."'ask','".$alat->alat_id."'".')">
                                    <i class="fa fa-trash"></i> Delete </a>
                            </li>
                        </ul>
                    </div>
                ';
            
                $data[] = $row;
            }

            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->Md_alat->countAll(),
                            "recordsFiltered" => $this->Md_alat->countFiltered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);die;
		}

		if ($argv == 'add'){
			$nama_alat    = $this->input->post('nama_alat');
			$kode_alat    = $this->input->post('kode_alat');
			$pemilik_alat = $this->input->post('pemilik_alat');
			$harga_sewa   = $this->input->post('harga_sewa');
			$keterangan   = $this->input->post('keterangan');

			$dataInsert = array(
				'kode_alat'    => strtoupper($kode_alat),
				'nama_alat'    => ucwords($nama_alat),
				'pemilik_id'   => $pemilik_alat,
				'harga_perjam' => $harga_sewa,
				'keterangan'   => $keterangan
			);

			$insert = $this->Md_alat->addAlat($dataInsert);
			if ($insert){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'edit'){
			if ($argv1 == ""){
				redirect(base_url(),'refresh');
			}else{
				$alat_id = $argv1;
				$data_alat = $this->Md_alat->getAlatById($alat_id);
				echo json_encode($data_alat);PHP_EOL;die;
			}
		}

		if ($argv == 'update'){
			$alat_id      = $this->input->post('alat_id_edit');
			$nama_alat    = $this->input->post('nama_alat_edit');
			$kode_alat    = $this->input->post('kode_alat_edit');
			$pemilik_alat = $this->input->post('pemilik_alat_edit');
			$harga_sewa   = $this->input->post('harga_sewa_edit');
			$keterangan   = $this->input->post('keterangan_edit');

			$dataEdit = array(
				'kode_alat'    => strtoupper($kode_alat),
				'nama_alat'    => ucwords($nama_alat),
				'pemilik_id'   => $pemilik_alat,
				'harga_perjam' => $harga_sewa,
				'keterangan'   => $keterangan
			);

			$update = $this->Md_alat->updateAlat($alat_id, $dataEdit);
			if ($update){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'delete'){
			$alat_id = $this->input->post('alat_id_delete');

			$delete = $this->Md_alat->deleteAlat($alat_id);
			if ($delete){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		$pageData['page_name'] = 'alat'; 
		$this->load->view('index', $pageData);
	}

	public function pemilik($argv = '', $argv1 = ''){
		if ($argv == 'list'){
			$list = $this->Md_pemilik->getDatatables();
            $data = array();
            $no   = $_POST['start'];
            foreach ($list as $pemilik) {
                $no++;
                $row = array();
				$row[] = $no;
				$row[] = $pemilik->kode_pemilik;
				$row[] = $pemilik->nama_pemilik;
				$row[] = $pemilik->alamat_pemilik;
				$row[] = $pemilik->kontak_pemilik;
                
                $row[] = '
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a title="Edit" href="javascript:void(0)" onclick="edit_pemilikalat('."'".$pemilik->pemilik_id."'".')">
                                    <i class="fa fa-edit"></i> Edit </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" title="Hapus" onclick="delete_pemilikalat('."'ask','".$pemilik->pemilik_id."'".')">
                                    <i class="fa fa-trash"></i> Delete </a>
                            </li>
                        </ul>
                    </div>
                ';
            
                $data[] = $row;
            }

            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->Md_pemilik->countAll(),
                            "recordsFiltered" => $this->Md_pemilik->countFiltered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);die;
		}

		if ($argv == 'add'){
			$nama_pemilik   = $this->input->post('nama_pemilik');
			$kode_pemilik   = $this->input->post('kode_pemilik');
			$alamat_pemilik = $this->input->post('alamat_pemilik');
			$kontak_pemilik = $this->input->post('kontak_pemilik');

			$dataInsert = array(
				'nama_pemilik'   => ucwords($nama_pemilik),
				'kode_pemilik'   => strtoupper($kode_pemilik),
				'alamat_pemilik' => $alamat_pemilik,
				'kontak_pemilik' => $kontak_pemilik
			);

			$insert = $this->Md_pemilik->addPemilik($dataInsert);
			if ($insert){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'edit'){
			if ($argv1 == ""){
				redirect(base_url(),'refresh');
			}else{
				$pemilik_id = $argv1;
				$data_pemilikalat = $this->Md_pemilik->getPemilikById($pemilik_id);
				echo json_encode($data_pemilikalat);PHP_EOL;die;
			}
		}

		if ($argv == 'update'){
			$pemilikalat_id = $this->input->post('pemilikalat_id_edit');
			$nama_pemilik   = $this->input->post('nama_pemilik_edit');
			$kode_pemilik   = $this->input->post('kode_pemilik_edit');
			$alamat_pemilik = $this->input->post('alamat_pemilik_edit');
			$kontak_pemilik = $this->input->post('kontak_pemilik_edit');

			$dataUpdate = array(
				'nama_pemilik'   => ucwords($nama_pemilik),
				'kode_pemilik'   => strtoupper($kode_pemilik),
				'alamat_pemilik' => $alamat_pemilik,
				'kontak_pemilik' => $kontak_pemilik
			);

			$insert = $this->Md_pemilik->updatePemilik($pemilikalat_id, $dataUpdate);
			if ($insert){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'delete'){
			$pemilikalat_id = $this->input->post('pemilikalat_id_delete');

			$delete = $this->Md_pemilik->deletePemilik($pemilikalat_id);
			if ($delete){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		$pageData['page_name'] = 'pemilik'; 
		$this->load->view('index', $pageData);
	}

	public function client($argv = '', $argv1 = ''){
		if ($argv == 'list'){
			$list = $this->Md_client->getDatatables();
            $data = array();
            $no   = $_POST['start'];
            foreach ($list as $pemakai) {
                $no++;
                $row = array();
				$row[] = $no;
				$row[] = $pemakai->kode_client;
				$row[] = $pemakai->nama_client;
				$row[] = $pemakai->alamat_client;
				$row[] = $pemakai->kontak_client;
                
                $row[] = '
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a title="Edit" href="javascript:void(0)" onclick="edit_pemakaialat('."'".$pemakai->client_id."'".')">
                                    <i class="fa fa-edit"></i> Edit </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" title="Hapus" onclick="delete_pemakaialat('."'ask','".$pemakai->client_id."'".')">
                                    <i class="fa fa-trash"></i> Delete </a>
                            </li>
                        </ul>
                    </div>
                ';
            
                $data[] = $row;
            }

            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->Md_client->countAll(),
                            "recordsFiltered" => $this->Md_client->countFiltered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);die;
		}

		if ($argv == 'add'){
			$nama_penyewa   = $this->input->post('nama_penyewa');
			$kode_penyewa   = $this->input->post('kode_penyewa');
			$alamat_penyewa = $this->input->post('alamat_penyewa');
			$kontak_penyewa = $this->input->post('kontak_penyewa');

			$dataInsert = array(
				'nama_client'   => ucwords($nama_penyewa),
				'kode_client'   => strtoupper($kode_penyewa),
				'alamat_client' => $alamat_penyewa,
				'kontak_client' => $kontak_penyewa
			);

			$insert = $this->Md_client->addClient($dataInsert);
			if ($insert){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'edit'){
			if ($argv1 == ""){
				redirect(base_url(),'refresh');
			}else{
				$client_id = $argv1;
				$data_client = $this->Md_client->getClientById($client_id);
				echo json_encode($data_client);PHP_EOL;die;
			}
		}

		if ($argv == 'update'){
			$penyewa_id     = $this->input->post('penyewa_id_edit');
			$nama_penyewa   = $this->input->post('nama_penyewa_edit');
			$kode_penyewa   = $this->input->post('kode_penyewa_edit');
			$alamat_penyewa = $this->input->post('alamat_penyewa_edit');
			$kontak_penyewa = $this->input->post('kontak_penyewa_edit');

			$dataUpdate = array(
				'nama_client'   => ucwords($nama_penyewa),
				'kode_client'   => strtoupper($kode_penyewa),
				'alamat_client' => $alamat_penyewa,
				'kontak_client' => $kontak_penyewa
			);

			$insert = $this->Md_client->updateClient($penyewa_id, $dataUpdate);
			if ($insert){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'delete'){
			$penyewa_id = $this->input->post('penyewa_id_delete');

			$delete = $this->Md_client->deleteClient($penyewa_id);
			if ($delete){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		$pageData['page_name'] = 'client'; 
		$this->load->view('index', $pageData);
	}

	public function penyedia($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['penyedia'] = $this->Md_penyedia->getPenyediaAll();
		}

		$pageData['page_name'] = 'penyedia'; 
		$this->load->view('index', $pageData);
	}

	public function toko($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['toko'] = $this->Md_toko->getTokoAll();
		}

		if ($argv == 'add'){
			$nama_toko   = $this->input->post('nama_toko');
			$kode_toko   = $this->input->post('kode_toko');
			$alamat_toko = $this->input->post('alamat_toko');
			$kontak_toko = $this->input->post('kontak_toko');

			$dataInsert = array(
				'nama_toko'   => ucwords($nama_toko),
				'kode_toko'   => strtoupper($kode_toko),
				'alamat_toko' => $alamat_toko,
				'kontak_toko' => $kontak_toko
			);

			$insert = $this->Md_toko->addToko($dataInsert);
			if ($insert){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'edit'){
			if ($argv1 == ""){
				redirect(base_url(),'refresh');
			}else{
				$toko_id = $argv1;
				$data_toko = $this->Md_toko->getTokoById($toko_id);
				echo json_encode($data_toko);PHP_EOL;die;
			}
		}

		if ($argv == 'update'){
			$toko_id     = $this->input->post('toko_id_edit');
			$nama_toko   = $this->input->post('nama_toko_edit');
			$kode_toko   = $this->input->post('kode_toko_edit');
			$alamat_toko = $this->input->post('alamat_toko_edit');
			$kontak_toko = $this->input->post('kontak_toko_edit');

			$dataUpdate = array(
				'nama_toko'   => ucwords($nama_toko),
				'kode_toko'   => strtoupper($kode_toko),
				'alamat_toko' => $alamat_toko,
				'kontak_toko' => $kontak_toko
			);

			$insert = $this->Md_toko->updateToko($toko_id, $dataUpdate);
			if ($insert){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'delete'){
			$toko_id = $this->input->post('toko_id_delete');
			
			$delete = $this->Md_toko->deleteToko($toko_id);
			if ($delete){
				echo json_encode(array('status' => true));die;
			}else{
				echo json_encode(array('status' => false));die;
			}
		}

		$pageData['page_name'] = 'toko'; 
		$this->load->view('index', $pageData);
	}

	public function sasaran_dana($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['sasaran_dana'] = $this->Md_sasaran_dana->getSasaranDanaAll();
		}

		if ($argv == 'add'){
			$kode_sasaran = $this->input->post('kode_sasaran');
			$sasaran      = $this->input->post('sasaran');

			$dataInsert = array(
				'kode_sasaran' => strtoupper($kode_sasaran),
				'sasaran'      => ucwords($sasaran)
			);

			$this->db->trans_begin();
			$this->Md_sasaran_dana->addSasaranDana($dataInsert);
			if ($this->db->trans_status() === TRUE){
				$this->db->trans_commit();
				echo json_encode(array('status' => true));die;
			}else{
				$this->db->trans_rollback();
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'edit'){
			if ($argv1 == ""){
				redirect(base_url(),'refresh');
			}else{
				$sasarandana_id = $argv1;
				$data_toko = $this->Md_sasaran_dana->getSasaranDanaById($sasarandana_id);
				echo json_encode($data_toko);PHP_EOL;die;
			}
		}

		if ($argv == 'update'){
			$sasarandana_id = $this->input->post('sasarandana_id_edit');
			$kode_sasaran   = $this->input->post('kode_sasaran_edit');
			$sasaran        = $this->input->post('sasaran_edit');

			$dataUpdate = array(
				'kode_sasaran' => strtoupper($kode_sasaran),
				'sasaran'      => ucwords($sasaran)
			);

			$this->db->trans_begin();
			$insert = $this->Md_sasaran_dana->updateSasaranDana($sasarandana_id, $dataUpdate);
			if ($this->db->trans_status() === TRUE){
				$this->db->trans_commit();
				echo json_encode(array('status' => true));die;
			}else{
				$this->db->trans_rollback();
				echo json_encode(array('status' => false));die;
			}
		}

		if ($argv == 'delete'){
			$sasarandana_id_delete = $this->input->post('sasarandana_id_delete');
			
			$this->db->trans_begin();
			$this->Md_sasaran_dana->deleteSasaranDana($sasarandana_id_delete);
			if ($this->db->trans_status() === TRUE){
				$this->db->trans_commit();
				echo json_encode(array('status' => true));die;
			}else{
				$this->db->trans_rollback();
				echo json_encode(array('status' => false));die;
			}
		}

		$pageData['page_name'] = 'sasaran_dana'; 
		$this->load->view('index', $pageData);
	}

	public function penyewaan($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['view']         = 'data';
		}
		if ($argv == 'list'){
			$list = $this->Md_penyewaan->getDatatables();
            $data = array();
            $no   = $_POST['start'];
            foreach ($list as $penyewaan) {
                $no++;
                $row = array();
				$row[] = $no;
				$row[] = $penyewaan->nama_alat;
				$row[] = $penyewaan->lama_pemakaian;
				$row[] = $penyewaan->nama_client;
				$row[] = '<div class="left">Rp. </div><div class="right">'.number_format($penyewaan->harga_perjam).'</div>';
				$row[] = '<div class="left">Rp. </div><div class="right">'.number_format($penyewaan->biaya_penyewaan).'</div>';
				$row[] = '<div class="left">Rp. </div><div class="right">'.number_format($penyewaan->pph_penyewaan).'</div>';
                
                $row[] = '
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a title="Edit" href="'.base_url().'index.php/admin/penyewaan/edit/'.$penyewaan->penyewaan_id.'" >
                                    <i class="fa fa-edit"></i> Edit </a>
                            </li>
                            <li>
                                <a href="'.base_url().'index.php/admin/penyewaan/delete/'.$penyewaan->penyewaan_id.'" title="Hapus" >
                                    <i class="fa fa-trash"></i> Delete </a>
                            </li>
                        </ul>
                    </div>
                ';
            
                $data[] = $row;
            }

            $output = array(
		                    "draw" => $_POST['draw'],
		                    "recordsTotal" => $this->Md_penyewaan->countAll(),
		                    "recordsFiltered" => $this->Md_penyewaan->countFiltered(),
		                    "data" => $data,
		            );
            //output to json format
            echo json_encode($output);die;
		}
		if ($argv == 'add'){
			$pageData['alat']     = $this->Md_alat->getAlatAll();
			$pageData['penyedia'] = $this->Md_penyedia->getPenyediaAll();
			$pageData['client']   = $this->Md_client->getClientAll();
			$pageData['view']     = 'form';
		}
		if ($argv == 'simpan'){
			$alat             = $this->input->post('alat');
			$client           = $this->input->post('client');
			$lama_pemakaian   = $this->input->post('lama_pemakaian');
			$harga_pemakaian  = intval($this->input->post('harga_pemakaian'));
			$penerima_dana    = $this->input->post('penerima_dana');
			$tgl_pemasukan    = date('Y-m-d',strtotime($this->input->post('tgl_pemasukan')));
			$pph              = $this->input->post('pph');
			$fee_operasional  = intval($this->input->post('fee_operasional'));
			
			$jumlah_pph       = (($pph)/100)*(($lama_pemakaian)*($harga_pemakaian)); 
			$jumlah_fee       = $fee_operasional*($lama_pemakaian);
			$jumlah_pemasukan = (($lama_pemakaian)*($harga_pemakaian))-$jumlah_pph;

			$dataPenyewaan = array(
				'alat_id'         => $alat,
				'lama_pemakaian'  => $lama_pemakaian,
				'client_id'       => $client,
				'harga_perjam'    => $harga_pemakaian,
				'biaya_penyewaan' => ($harga_pemakaian)*($lama_pemakaian),
				'pph_penyewaan'   => $jumlah_pph
			);
			$this->db->trans_begin();
			$this->Md_penyewaan->addPenyewaan($dataPenyewaan);
			$penyewaan_id = $this->db->insert_id();

			$dataPemasukan = array(
				'penyewaan_id'          => $penyewaan_id,
				'pemasukan_setelah_pph' => $jumlah_pemasukan,
				'penyedia_id'           => $penerima_dana,
				'tgl_pemasukan'         => $tgl_pemasukan,
				'potongan_fee'          => $jumlah_fee
			);
			$this->Md_pemasukan->addPemasukan($dataPemasukan);
			$pemasukan_id = $this->db->insert_id();

			$dataFee = array(
				'jenis_fee'      => 'Debit',
				'penyedia_id'    => $penerima_dana,
				'pengeluaran_id' => NULL,
				'pemasukan_id'   => $pemasukan_id,
			);
			$this->Md_fee->addFee($dataFee);

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$this->session->set_flashdata('statuserror', 'Tambah data penyewaan gagal');
				redirect(base_url().'index.php/admin/penyewaan','refresh');
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('statussucccess', 'Tambah data penyewaan berhasil');
				redirect(base_url().'index.php/admin/penyewaan','refresh');
			}
		}
		if ($argv == 'edit'){
			if ($argv1 == ""){
				redirect(base_url(),'refresh');
			}else{
				$penyewaan_id   = $argv1;
				$data_penyewaan = $this->Md_penyewaan->getPenyewaanForEdit($penyewaan_id);
				$dataPenyewaan = array(
					'penyewaan_id'    => $data_penyewaan->penyewaan_id,
					'alat_id'         => $data_penyewaan->alat_id,
					'lama_pemakaian'  => $data_penyewaan->lama_pemakaian,
					'client_id'       => $data_penyewaan->client_id,
					'harga_perjam'    => $data_penyewaan->harga_perjam,
					'biaya_penyewaan' => $data_penyewaan->biaya_penyewaan,
					'pph'             => $data_penyewaan->biaya_penyewaan/$data_penyewaan->pph_penyewaan/100,
					'tgl_pemasukan'   => date('Y-m-d',strtotime($data_penyewaan->tgl_pemasukan)),
					'penyedia_id'     => $data_penyewaan->penyedia_id,
					'jumlah_fee'      => $data_penyewaan->potongan_fee/$data_penyewaan->lama_pemakaian,
				);

				$pageData['alat']      = $this->Md_alat->getAlatAll();
				$pageData['penyedia']  = $this->Md_penyedia->getPenyediaAll();
				$pageData['client']    = $this->Md_client->getClientAll();
				$pageData['data_edit'] = $dataPenyewaan;
				$pageData['view']      = 'form';
			}
		}
		if ($argv == 'update'){
			$penyewaan_id     = $this->input->post('penyewaan_id');
			$alat             = $this->input->post('alat');
			$client           = $this->input->post('client');
			$lama_pemakaian   = $this->input->post('lama_pemakaian');
			$harga_pemakaian  = ($this->input->post('harga_pemakaian'));
			$penerima_dana    = $this->input->post('penerima_dana');
			$tgl_pemasukan    = date('Y-m-d',strtotime($this->input->post('tgl_pemasukan')));
			$pph              = $this->input->post('pph');
			$fee_operasional  = ($this->input->post('fee_operasional'));
			
			$jumlah_pph       = (($pph)/100)*(($lama_pemakaian)*($harga_pemakaian)); 
			$jumlah_fee       = $fee_operasional*($lama_pemakaian);
			$jumlah_pemasukan = (($lama_pemakaian)*($harga_pemakaian))-$jumlah_pph;

			$data_pemasukan   = $this->Md_pemasukan->getPemasukanByPenyewaanId($penyewaan_id);
			$data_fee		  = $this->Md_fee->getFeeByPemasukanId($data_pemasukan->pemasukan_id);

			$dataPenyewaan = array(
				'alat_id'         => $alat,
				'lama_pemakaian'  => $lama_pemakaian,
				'client_id'       => $client,
				'harga_perjam'    => $harga_pemakaian,
				'biaya_penyewaan' => ($harga_pemakaian)*($lama_pemakaian),
				'pph_penyewaan'   => $jumlah_pph
			);
			$this->db->trans_begin();
			$this->Md_penyewaan->updatePenyewaan($penyewaan_id, $dataPenyewaan);

			$dataPemasukan = array(
				'penyewaan_id'          => $penyewaan_id,
				'pemasukan_setelah_pph' => $jumlah_pemasukan,
				'penyedia_id'           => $penerima_dana,
				'tgl_pemasukan'         => $tgl_pemasukan,
				'potongan_fee'          => $jumlah_fee
			);
			$this->Md_pemasukan->updatePemasukan($data_pemasukan->pemasukan_id, $dataPemasukan);

			$dataFee = array(
				'jenis_fee'      => 'Debit',
				'penyedia_id'    => $penerima_dana,
				'pengeluaran_id' => NULL,
				'pemasukan_id'   => $data_pemasukan->pemasukan_id,
			);
			$this->Md_fee->updateFee($data_fee->fee_id, $dataFee);

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$this->session->set_flashdata('statuserror', 'Edit data penyewaan gagal');
				redirect(base_url().'index.php/admin/penyewaan','refresh');
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('statussucccess', 'Edit data penyewaan berhasil');
				redirect(base_url().'index.php/admin/penyewaan','refresh');
			}
		}
		if ($argv == 'delete'){
			$penyewaan_id = $argv1;

			$data_pemasukan   = $this->Md_pemasukan->getPemasukanByPenyewaanId($penyewaan_id);
			$data_fee		  = $this->Md_fee->getFeeByPemasukanId($data_pemasukan->pemasukan_id);

			$this->db->trans_begin();
			$this->Md_fee->deleteFee($data_fee->fee_id);
			$this->Md_pemasukan->deletePemasukan($data_pemasukan->pemasukan_id);
			$this->Md_penyewaan->deletePenyewaan($penyewaan_id);

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$this->session->set_flashdata('statuserror', 'Delete data penyewaan gagal');
				redirect(base_url().'index.php/admin/penyewaan','refresh');
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('statussucccess', 'Delete data penyewaan berhasil');
				redirect(base_url().'index.php/admin/penyewaan','refresh');
			}
		}
		if ($argv == 'gethargaalat'){
			$alat_id = $argv1;
			$alat = $this->Md_alat->getAlatById($alat_id);
			echo json_encode(array('harga' => $alat->harga_perjam));PHP_EOL;die;
		}

		$pageData['page_name'] = 'penyewaan'; 
		$this->load->view('index', $pageData);
	}

	public function pemasukan($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['view']         = 'data';
		}
		if ($argv == 'list'){
			$list = $this->Md_pemasukan->getDatatables();
            $data = array();
            $no   = $_POST['start'];
            foreach ($list as $pemasukan) {
                $no++;
                $row = array();
				$row[] = $no;
				$row[] = date('d-M-Y',strtotime($pemasukan->tgl_pemasukan));
				$row[] = $pemasukan->kode_alat;
				$row[] = '<div class="left">Rp. </div><div class="right">'.number_format($pemasukan->pemasukan_setelah_pph).'</div>';
				if ($pemasukan->kode_penyedia == 'AHONG'){
					$row[] = '<button class="btn bg-teal btn-xs">'.$pemasukan->kode_penyedia.'</span>';
				}
				if ($pemasukan->kode_penyedia == 'MJA'){
					$row[] = '<button class="btn bg-purple btn-xs">'.$pemasukan->kode_penyedia.'</button>';
				}
            
                $data[] = $row;
            }

            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->Md_pemasukan->countAll(),
                            "recordsFiltered" => $this->Md_pemasukan->countFiltered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);die;
		}

		$pageData['page_name'] = 'pemasukan'; 
		$this->load->view('index', $pageData);
	}

	public function pengeluaran($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['view']         = 'data';

		}
		if ($argv == 'list'){
			$list = $this->Md_pengeluaran->getDatatables();
            $data = array();
            $no   = $_POST['start'];
            foreach ($list as $pengeluaran) {
                $no++;
                $row = array();

                if ($pengeluaran->kode_alat) $alat = $pengeluaran->kode_alat;
                else $alat = " - ";

                $penanggungjawab = "";
                if ($pengeluaran->fee_id) $penanggungjawab = 'Kas Fee';
                else if ($pengeluaran->kode_pemilik) $penanggungjawab = $pengeluaran->kode_pemilik;
                else if ($pengeluaran->kode_penyedia) $penanggungjawab = $pengeluaran->kode_penyedia;

                if (strlen($pengeluaran->keterangan) > 20 ) $ket = substr($pengeluaran->keterangan,0,20).'...';
                else $ket = $pengeluaran->keterangan;

				$row[] = $no;
				$row[] = date('d-M-Y',strtotime($pengeluaran->tgl_pengeluaran));
				$row[] = $pengeluaran->kode_voucher;
				$row[] = $pengeluaran->kode_sasaran;
				$row[] = $alat;
				$row[] = $ket;
				$row[] = '<div class="left">Rp. </div><div class="right">'.$pengeluaran->jumlah_pengeluaran.'</div>';
				$row[] = $penanggungjawab;
                $row[] = '
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a title="Edit" href="'.base_url().'index.php/admin/pengeluaran/edit/'.$pengeluaran->pengeluaran_id.'" >
                                    <i class="fa fa-edit"></i> Edit </a>
                            </li>
                            <li>
                                <a href="'.base_url().'index.php/admin/pengeluaran/delete/'.$pengeluaran->pengeluaran_id.'" title="Hapus" >
                                    <i class="fa fa-trash"></i> Delete </a>
                            </li>
                        </ul>
                    </div>
                ';
            
                $data[] = $row;
            }

            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->Md_pengeluaran->countAll(),
                            "recordsFiltered" => $this->Md_pengeluaran->countFiltered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);die;
		}

		if ($argv == 'add'){
			$pageData['alat']        = $this->Md_alat->getAlatAll();
			$pageData['jenis_biaya'] = $this->Md_sasaran_dana->getSasaranDanaAll();
			$pageData['toko']        = $this->Md_toko->getTokoAll();
			$pageData['view']        = 'form';
		}

		if ($argv == 'simpan'){
			$sumber_dana      = $this->input->post('sumber_dana');
			$penanggung_jawab = $this->input->post('penanggung_jawab');
			$kode_voucher     = $this->input->post('kode_voucher');
			$tgl_pengeluaran  = date('Y-m-d',strtotime($this->input->post('tgl_pengeluaran')));
			$jenis_biaya      = $this->input->post('jenis_biaya');
			$rincian          = $this->input->post('rincian');
			$alat             = $this->input->post('alat');
			$toko             = $this->input->post('toko');
			$pengeluaran      = intval($this->input->post('pengeluaran'));

			if (!$alat) $alat = NULL;
			if (!$toko) $toko = NULL;

			$dataInsert = array(
				'sasarandana_id'     => $jenis_biaya,
				'alat_id'            => $alat,
				'toko_id'            => $toko,
				'tgl_pengeluaran'    => $tgl_pengeluaran,
				'keterangan'         => $rincian,
				'jumlah_pengeluaran' => $pengeluaran,
				'kode_voucher'       => $kode_voucher
			);
			$this->db->trans_begin();
			$this->Md_pengeluaran->addPengeluaran($dataInsert);
			$pengeluaran_id = $this->db->insert_id();

			if ($sumber_dana == 'dana alat'){
				if ($penanggung_jawab == 'AHONG'){
					$ahong_id = $this->Md_penyedia->getPenyediaByKode('AHONG');
					$dataTanggungan = array(
						'pengeluaran_id' => $pengeluaran_id,
						'penyedia_id'    => $ahong_id->penyedia_id
					);
					$this->Md_tanggungan_penyedia->addTanggunganPenyedia($dataTanggungan);
				}else if($penanggung_jawab == 'MJA'){
					$mja_id = $this->Md_penyedia->getPenyediaByKode('MJA');
					$dataTanggungan = array(
						'pengeluaran_id' => $pengeluaran_id,
						'penyedia_id'    => $mja_id->penyedia_id
					);
					$this->Md_tanggungan_penyedia->addTanggunganPenyedia($dataTanggungan);
				}else if($penanggung_jawab == 'PEMILIK'){
					$alat = $this->Md_alat->getAlatById($alat);
					$pemilik_id = $alat->pemilik_id;
					$dataTanggungan = array(
						'pengeluaran_id' => $pengeluaran_id,
						'pemilik_id'     => $pemilik_id
					);
					$this->Md_tanggungan_pemilik->addTanggunganPemilik($dataTanggungan);
				}
			}else if ($sumber_dana == 'dana fee'){
				if ($penanggung_jawab == 'AHONG'){
					$ahong_id = $this->Md_penyedia->getPenyediaByKode('AHONG');
					$dataFee = array(
						'jenis_fee'      => 'Kredit',
						'penyedia_id'    => $ahong_id->penyedia_id,
						'pengeluaran_id' => $pengeluaran_id,
						'pemasukan_id'   => NULL,
					);

				}else if($penanggung_jawab == 'MJA'){
					$mja_id = $this->Md_penyedia->getPenyediaByKode('MJA');
					$dataFee = array(
						'jenis_fee'      => 'Kredit',
						'penyedia_id'    => $mja_id->penyedia_id,
						'pengeluaran_id' => $pengeluaran_id,
						'pemasukan_id'   => NULL,
					);
				}
				$this->Md_fee->addFee($dataFee);
			}
			
			if ($this->db->trans_status() === TRUE){
				$this->db->trans_commit();
				$this->session->set_flashdata('statussucccess', 'Tambah data pengeluaran berhasil');
				redirect(base_url().'index.php/admin/pengeluaran','refresh');
			}else{
				$this->db->trans_rollback();
				$this->session->set_flashdata('statuserror', 'Tambah data pengeluaran gagal');
				redirect(base_url().'index.php/admin/pengeluaran','refresh');
			}
		}

		if ($argv == 'edit'){
			if ($argv1 == ""){
				redirect(base_url(),'refresh');
			}else{
				$pengeluaran_id   = $argv1;
				$data_pengeluaran = $this->Md_pengeluaran->getPengeluaranForEdit($pengeluaran_id);
				
				// echo '<pre>';
				// print_r($data_pengeluaran);
				// echo '</pre>';die;

				$alat             = NULL;
				$toko             = NULL;
				$penanggung_jawab = NULL;
				$sumber_dana      = NULL;

				if ($data_pengeluaran->alat_id)
					$alat = $data_pengeluaran->alat_id;
				if ($data_pengeluaran->toko_id)
					$toko = $data_pengeluaran->toko_id;
				if ($data_pengeluaran->fee_id){
					$sumber_dana = 'dana fee';
					$penyedia = $this->Md_penyedia->getPenyediaById($data_pengeluaran->fee_via);
					$penanggung_jawab = $penyedia->kode_penyedia;
				}else{
					$sumber_dana = 'dana alat';
					if ($data_pengeluaran->kode_pemilik)
						$penanggung_jawab = 'PEMILIK';
					else
						$penanggung_jawab = $data_pengeluaran->kode_penyedia;
				}

				$dataPengeluaran = array(
					'pengeluaran_id'   => $data_pengeluaran->pengeluaran_id,
					'sumber_dana'      => $sumber_dana,
					'penanggung_jawab' => $penanggung_jawab,
					'kode_voucher'     => $data_pengeluaran->kode_voucher,
					'tgl_pengeluaran'  => $data_pengeluaran->tgl_pengeluaran,
					'jenis_biaya'      => $data_pengeluaran->sasarandana_id,
					'rincian'          => $data_pengeluaran->keterangan,
					'alat'             => $data_pengeluaran->alat_id,
					'toko'             => $data_pengeluaran->toko_id,
					'pengeluaran'      => $data_pengeluaran->jumlah_pengeluaran,
				);

				$pageData['alat']        = $this->Md_alat->getAlatAll();
				$pageData['jenis_biaya'] = $this->Md_sasaran_dana->getSasaranDanaAll();
				$pageData['toko']        = $this->Md_toko->getTokoAll();
				$pageData['data_edit']   = $dataPengeluaran;
				$pageData['view']        = 'form';
			}
		}

		if ($argv == 'update'){
			$pengeluaran_id   = $this->input->post('pengeluaran_id');
			$sumber_dana      = $this->input->post('sumber_dana');
			$penanggung_jawab = $this->input->post('penanggung_jawab');
			$kode_voucher     = $this->input->post('kode_voucher');
			$tgl_pengeluaran  = date('Y-m-d',strtotime($this->input->post('tgl_pengeluaran')));
			$jenis_biaya      = $this->input->post('jenis_biaya');
			$rincian          = $this->input->post('rincian');
			$alat             = $this->input->post('alat');
			$toko             = $this->input->post('toko');
			$pengeluaran      = intval($this->input->post('pengeluaran'));

			$data_pengeluaran = $this->Md_pengeluaran->getPengeluaranForEdit($pengeluaran_id);

			if (!$alat) $alat = NULL;
			if (!$toko) $toko = NULL;

			$dataInsert = array(
				'sasarandana_id'     => $jenis_biaya,
				'alat_id'            => $alat,
				'toko_id'            => $toko,
				'tgl_pengeluaran'    => $tgl_pengeluaran,
				'keterangan'         => $rincian,
				'jumlah_pengeluaran' => $pengeluaran,
				'kode_voucher'       => $kode_voucher
			);
			$this->db->trans_begin();
			$this->Md_pengeluaran->updatePengeluaran($pengeluaran_id, $dataInsert);

			if ($sumber_dana == 'dana alat'){
				if ($penanggung_jawab == 'AHONG'){
					$ahong_id = $this->Md_penyedia->getPenyediaByKode('AHONG');
					$dataTanggungan = array(
						'pengeluaran_id' => $data_pengeluaran->pengeluaran_id,
						'penyedia_id'    => $ahong_id->penyedia_id
					);

					if ($data_pengeluaran->tanggunganpenyedia_id){ //sebelumnya memang tanggungan penyedia
						$this->Md_tanggungan_penyedia->updateTanggunganPenyedia($data_pengeluaran->tanggunganpenyedia_id, $dataTanggungan);
					}else if($data_pengeluaran->tanggunganpemilik_id){
						$this->Md_tanggungan_pemilik->deleteTanggunganPemilik($data_pengeluaran->tanggunganpemilik_id);
						$this->Md_tanggungan_penyedia->addTanggunganPenyedia($dataTanggungan);
					}else if($data_pengeluaran->fee_id){
						$this->Md_fee->deleteFee($data_pengeluaran->fee_id);
						$this->Md_tanggungan_penyedia->addTanggunganPenyedia($dataTanggungan);
					}
				}else if($penanggung_jawab == 'MJA'){
					$mja_id = $this->Md_penyedia->getPenyediaByKode('MJA');
					$dataTanggungan = array(
						'pengeluaran_id' => $data_pengeluaran->pengeluaran_id,
						'penyedia_id'    => $mja_id->penyedia_id
					);

					if ($data_pengeluaran->tanggunganpenyedia_id){ //sebelumnya memang tanggungan penyedia
						$this->Md_tanggungan_penyedia->updateTanggunganPenyedia($data_pengeluaran->tanggunganpenyedia_id, $dataTanggungan);
					}else if($data_pengeluaran->tanggunganpemilik_id){
						$this->Md_tanggungan_pemilik->deleteTanggunganPemilik($data_pengeluaran->tanggunganpemilik_id);
						$this->Md_tanggungan_penyedia->addTanggunganPenyedia($dataTanggungan);
					}else if($data_pengeluaran->fee_id){
						$this->Md_fee->deleteFee($data_pengeluaran->fee_id);
						$this->Md_tanggungan_penyedia->addTanggunganPenyedia($dataTanggungan);
					}
				}else if($penanggung_jawab == 'PEMILIK'){
					$alat = $this->Md_alat->getAlatById($alat);
					$pemilik_id = $alat->pemilik_id;
					$dataTanggungan = array(
						'pengeluaran_id' => $data_pengeluaran->pengeluaran_id,
						'pemilik_id'     => $pemilik_id
					);
					
					if ($data_pengeluaran->tanggunganpemilik_id){ //sebelumnya memang tanggungan pemilik
						$this->Md_tanggungan_pemilik->updateTanggunganPemilik($data_pengeluaran->tanggunganpemilik_id, $dataTanggungan);
					}else if($data_pengeluaran->tanggunganpenyedia_id){
						$this->Md_tanggungan_penyedia->deleteTanggunganPenyedia($data_pengeluaran->tanggunganpenyedia_id);
						$this->Md_tanggungan_pemilik->addTanggunganPemilik($dataTanggungan);
					}else if($data_pengeluaran->fee_id){
						$this->Md_fee->deleteFee($data_pengeluaran->fee_id);
						$this->Md_tanggungan_pemilik->addTanggunganPemilik($dataTanggungan);
					}
				}
			}else if ($sumber_dana == 'dana fee'){
				$fee_before = TRUE;
				if ($data_pengeluaran->fee_id){
					if ($penanggung_jawab == 'AHONG'){
						$ahong_id = $this->Md_penyedia->getPenyediaByKode('AHONG');
						$dataFee = array(
							'jenis_fee'      => 'Kredit',
							'penyedia_id'    => $ahong_id->penyedia_id,
							'pemasukan_id'   => NULL,
						);

					}else if($penanggung_jawab == 'MJA'){
						$mja_id = $this->Md_penyedia->getPenyediaByKode('MJA');
						$dataFee = array(
							'jenis_fee'      => 'Kredit',
							'penyedia_id'    => $mja_id->penyedia_id,
							'pemasukan_id'   => NULL,
						);
					}
					$this->Md_fee->updateFee($data_pengeluaran->fee_id, $dataFee);
				}else if ($data_pengeluaran->tanggunganpemilik_id){ //sebelumnya memang tanggungan pemilik
					$this->Md_tanggungan_pemilik->deleteTanggunganPemilik($data_pengeluaran->tanggunganpemilik_id);
					$fee_before = FALSE;
				}else if($data_pengeluaran->tanggunganpenyedia_id){
					$this->Md_tanggungan_penyedia->deleteTanggunganPenyedia($data_pengeluaran->tanggunganpenyedia_id);
					$fee_before = FALSE;
				}

				if (!$fee_before){
					if ($penanggung_jawab == 'AHONG'){
						$ahong_id = $this->Md_penyedia->getPenyediaByKode('AHONG');
						$dataFee = array(
							'jenis_fee'      => 'Kredit',
							'penyedia_id'    => $ahong_id->penyedia_id,
							'pengeluaran_id' => $data_pengeluaran->pengeluaran_id,
							'pemasukan_id'   => NULL,
						);

					}else if($penanggung_jawab == 'MJA'){
						$mja_id = $this->Md_penyedia->getPenyediaByKode('MJA');
						$dataFee = array(
							'jenis_fee'      => 'Kredit',
							'penyedia_id'    => $mja_id->penyedia_id,
							'pengeluaran_id' => $data_pengeluaran->pengeluaran_id,
							'pemasukan_id'   => NULL,
						);
					}
					$this->Md_fee->addFee($dataFee);
				}
			}
			
			if ($this->db->trans_status() === TRUE){
				$this->db->trans_commit();
				$this->session->set_flashdata('statussucccess', 'Update data pengeluaran berhasil');
				redirect(base_url().'index.php/admin/pengeluaran','refresh');
			}else{
				$this->db->trans_rollback();
				$this->session->set_flashdata('statuserror', 'Update data pengeluaran gagal');
				redirect(base_url().'index.php/admin/pengeluaran','refresh');
			}
		}

		if ($argv == 'delete'){
			$pengeluaran_id = $argv1;
			$data_pengeluaran = $this->Md_pengeluaran->getPengeluaranForEdit($pengeluaran_id);

			$this->db->trans_begin();

			if ($data_pengeluaran->tanggunganpenyedia_id){ //sebelumnya memang tanggungan penyedia
				$this->Md_tanggungan_penyedia->deleteTanggunganPenyedia($data_pengeluaran->tanggunganpenyedia_id);
			}else if($data_pengeluaran->tanggunganpemilik_id){
				$this->Md_tanggungan_pemilik->deleteTanggunganPemilik($data_pengeluaran->tanggunganpemilik_id);
			}else if($data_pengeluaran->fee_id){
				$this->Md_fee->deleteFee($data_pengeluaran->fee_id);
			}

			$delete = $this->Md_pengeluaran->deletePengeluaran($pengeluaran_id);
			if ($this->db->trans_status() === TRUE){
				$this->db->trans_commit();
				$this->session->set_flashdata('statussucccess', 'Hapus data pengeluaran berhasil');
				redirect(base_url().'index.php/admin/pengeluaran','refresh');
			}else{
				$this->db->trans_rollback();
				$this->session->set_flashdata('statuserror', 'Hapus data pengeluaran gagal');
				redirect(base_url().'index.php/admin/pengeluaran','refresh');
			}
		}

		$pageData['page_name'] = 'pengeluaran'; 
		$this->load->view('index', $pageData);
	}

	public function fee($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['view']         = 'data';

		}
		if ($argv == 'list'){
			$list = $this->Md_fee->getDatatables();
            $data = array();
            $no   = $_POST['start'];
            foreach ($list as $fee) {
                $no++;
                $row = array();

				$tgl          = date('d-M-Y',strtotime($fee->tgl_pemasukan));;
				$kode_sasaran = 'FEE OPERASIONAL';
				$jumlah       = $fee->potongan_fee;


                if ($fee->tgl_pengeluaran){
                	$tgl = date('d-M-Y',strtotime($fee->tgl_pengeluaran));
                	$kode_sasaran = $fee->kode_sasaran;
                	$jumlah = $fee->jumlah_pengeluaran;
                }

				$row[] = $no;
				$row[] = $tgl;
				$row[] = $fee->jenis_fee;
				$row[] = $kode_sasaran;
				$row[] = '<div class="left">Rp. </div><div class="right">'.$jumlah.'</div>';

				if ($fee->kode_penyedia == 'AHONG'){
					$row[] = '<button class="btn bg-teal btn-xs">'.$fee->kode_penyedia.'</span>';
				}
				if ($fee->kode_penyedia == 'MJA'){
					$row[] = '<button class="btn bg-purple btn-xs">'.$fee->kode_penyedia.'</button>';
				}
				
                $data[] = $row;
            }

            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->Md_fee->countAll(),
                            "recordsFiltered" => $this->Md_fee->countFiltered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);die;
		}

		$pageData['page_name'] = 'fee'; 
		$this->load->view('index', $pageData);
	}

	public function lap_keuangan($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['alat']     = $this->Md_alat->getAlatAll();
			$pageData['penyedia'] = $this->Md_penyedia->getPenyediaAll();
			$pageData['client']   = $this->Md_client->getClientAll();
			$pageData['view']     = 'form';
		}

		if ($argv == 'generate'){
			$tgl_awal        = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
			$tgl_akhir       = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
			$alat_id         = $this->input->post('alat');

			//dont allow if coming without parameter post value
			if(!$this->input->post('tgl_awal') || !$this->input->post('tgl_akhir')) redirect(base_url().'index.php/admin/lap_keuangan','refresh');

			//verify the value of last date isn't biger than first date
			if (date('Y-m-d',strtotime($tgl_awal)) > date('Y-m-d',strtotime($tgl_akhir))){
				$this->session->set_flashdata('statuserror', 'Periode tanggal yang anda pilih tidak benar');
				redirect(base_url().'index.php/admin/lap_keuangan','refresh');
			}

			$data = array();
			//if without filtering data
			if (!$alat_id){
				$alat = $this->Md_alat->getAlatAll();
				$no = 0;
				foreach ($alat as $list) {
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $list->kode_alat;


					$pem_ahong  = 0;
					$pem_mja    = 0;
					$peng_ahong = 0;
					$peng_mja   = 0;
					$penyedia   = $this->Md_penyedia->getPenyediaAll();
					foreach ($penyedia as $list2) {
						$pemasukan = $this->Md_pemasukan->getJumlahPemasukanByAlatIdAndPenyediaIdAndRangeTglPemasukan($list->alat_id, $list2->penyedia_id,$tgl_awal,$tgl_akhir);
						$pengeluaran = $this->Md_pengeluaran->getJumlahPengeluaranByAlatIdAndPenyediaIdAndRangTglPengeluaran($list->alat_id, $list2->penyedia_id,$tgl_awal,$tgl_akhir);
						if (substr($list2->kode_penyedia, 0,2) == 'AH'){
							$pem_ahong  = $pemasukan->total_pemasukan;
							$peng_ahong = $pengeluaran->total_pengeluaran+$pemasukan->fee_op;
						}
						if (substr($list2->kode_penyedia, 0,2) == 'MJ'){
							$pem_mja  = $pemasukan->total_pemasukan;
							$peng_mja = $pengeluaran->total_pengeluaran+$pemasukan->fee_op;
						}
					}

					$row[] = $pem_ahong+$pem_mja;
					$row[] = $pem_ahong;
					$row[] = $pem_mja;
					$row[] = $peng_ahong;
					$row[] = $peng_mja;
					$row[] = $pem_ahong-$peng_ahong;
					$row[] = $pem_mja-$peng_mja;

					
					$data[] = $row;
				}
				// echo '<pre>';
				// print_r($data);
				// echo '</pre>';die;
			}else{
				$list = $this->Md_alat->getAlatById($alat_id);
				$no = 0;
				// foreach ($alat as $list) {
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $list->kode_alat;


					$pem_ahong  = 0;
					$pem_mja    = 0;
					$peng_ahong = 0;
					$peng_mja   = 0;
					$penyedia   = $this->Md_penyedia->getPenyediaAll();
					foreach ($penyedia as $list2) {
						$pemasukan = $this->Md_pemasukan->getJumlahPemasukanByAlatIdAndPenyediaIdAndRangeTglPemasukan($list->alat_id, $list2->penyedia_id,$tgl_awal,$tgl_akhir);
						$pengeluaran = $this->Md_pengeluaran->getJumlahPengeluaranByAlatIdAndPenyediaIdAndRangTglPengeluaran($list->alat_id, $list2->penyedia_id,$tgl_awal,$tgl_akhir);
						if (substr($list2->kode_penyedia, 0,2) == 'AH'){
							$pem_ahong  = $pemasukan->total_pemasukan;
							$peng_ahong = $pengeluaran->total_pengeluaran+$pemasukan->fee_op;
						}
						if (substr($list2->kode_penyedia, 0,2) == 'MJ'){
							$pem_mja  = $pemasukan->total_pemasukan;
							$peng_mja = $pengeluaran->total_pengeluaran+$pemasukan->fee_op;
						}
					}

					$row[] = $pem_ahong+$pem_mja;
					$row[] = $pem_ahong;
					$row[] = $pem_mja;
					$row[] = $peng_ahong;
					$row[] = $peng_mja;
					$row[] = $pem_ahong-$peng_ahong;
					$row[] = $pem_mja-$peng_mja;

					
					$data[] = $row;
				// }
			}

			//set parameter post for excel form
			$pageData['excel'] = array(
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'alat_id'   => $alat_id
			);

			$pageData['laporan'] = $data;
			$pageData['periode'] = date('d-M-Y',strtotime($tgl_awal)).' - '.date('d-M-Y',strtotime($tgl_akhir));
			$pageData['view']    = 'data';
		}

		//select option view
		if ($argv1 == 'excel'){
			if (!$pageData['excel']) redirect(base_url().'index.php/admin/lap_keuangan','refresh');
			$this->load->view('page/excel_lap_keu', $pageData);
		}else{
			$pageData['page_name'] = 'lap_keuangan'; 
			$this->load->view('index', $pageData);
		}
	}

	public function lap_labarugi($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['alat']     = $this->Md_alat->getAlatAll();
			$pageData['penyedia'] = $this->Md_penyedia->getPenyediaAll();
			$pageData['client']   = $this->Md_client->getClientAll();
			$pageData['view']     = 'form';
		}

		if ($argv == 'generate'){
			$tgl_awal        = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
			$tgl_akhir       = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
			$alat_id         = $this->input->post('alat');

			//dont allow if coming without parameter post value
			if(!$this->input->post('tgl_awal') || !$this->input->post('tgl_akhir')) redirect(base_url().'index.php/admin/lap_labarugi','refresh');

			if (date('Y-m-d',strtotime($tgl_awal)) > date('Y-m-d',strtotime($tgl_akhir))){
				$this->session->set_flashdata('statuserror', 'Periode tanggal yang anda pilih tidak benar');
				redirect(base_url().'index.php/admin/lap_labarugi','refresh');
			}

			$data = array();
			if (!$alat_id){
				$alat = $this->Md_alat->getAlatAll();
				$no = 0;
				foreach ($alat as $list) {
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $list->kode_alat;


					$pem_ahong  = 0;
					$pem_mja    = 0;
					$peng_ahong = 0;
					$peng_mja   = 0;
					$penyedia   = $this->Md_penyedia->getPenyediaAll();
					foreach ($penyedia as $list2) {
						$pemasukan = $this->Md_pemasukan->getJumlahPemasukanByAlatIdAndPenyediaIdAndRangeTglPemasukan($list->alat_id, $list2->penyedia_id,$tgl_awal,$tgl_akhir);
						$pengeluaran = $this->Md_pengeluaran->getJumlahPengeluaranByAlatIdAndPenyediaIdAndRangTglPengeluaran($list->alat_id, $list2->penyedia_id,$tgl_awal,$tgl_akhir);
						if (substr($list2->kode_penyedia, 0,2) == 'AH'){
							$pem_ahong  = $pemasukan->total_pemasukan;
							$peng_ahong = $pengeluaran->total_pengeluaran+$pemasukan->fee_op;
						}
						if (substr($list2->kode_penyedia, 0,2) == 'MJ'){
							$pem_mja  = $pemasukan->total_pemasukan;
							$peng_mja = $pengeluaran->total_pengeluaran+$pemasukan->fee_op;
						}
					}

					$row[] = $pem_ahong+$pem_mja;
					$row[] = $pem_ahong;
					$row[] = $pem_mja;
					$row[] = $peng_ahong;
					$row[] = $peng_mja;
					$row[] = $pem_ahong-$peng_ahong;
					$row[] = $pem_mja-$peng_mja;

					
					$data[] = $row;
				}
				// echo '<pre>';
				// print_r($data);
				// echo '</pre>';die;
			}else{
				$list                 = $this->Md_alat->getAlatById($alat_id);
				$data_pendapatan      = array();
				$data_pengeluaran     = array();
				$data_pengeluaran_fee = array();
				
				$pendapatan           = $this->Md_pemasukan->getPemasukanByAlatIdAndRangeTglPemasukan($alat_id,$tgl_awal,$tgl_akhir);
				$pengeluaran          = $this->Md_pengeluaran->getPengeluaranByAlatIdAndRangeTglPemasukan($alat_id,$tgl_awal,$tgl_akhir);
				$pengeluaran_fee      = $this->Md_pemasukan->getPemasukanFeeByAlatIdAndRangeTglPemasukan($alat_id,$tgl_awal,$tgl_akhir);
				
				$pageData['periode']     = date('Y-M-d',strtotime($tgl_awal)).' - '.date('Y-M-d',strtotime($tgl_akhir));
				$pageData['view']     = 'paper';
			}

			$pageData['excel'] = array(
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'alat_id'   => $alat_id
			);

			$pageData['periode'] = date('d-M-Y',strtotime($tgl_awal)).' - '.date('d-M-Y',strtotime($tgl_akhir));
			$pageData['nama_alat'] = '[ '.$list->kode_alat.' ] - '.$list->nama_alat;
			$pageData['pendapatan'] = $pendapatan;
			$pageData['pengeluaran'] = $pengeluaran;
			$pageData['pengeluaran_fee'] = $pengeluaran_fee;
		}

		//select option view
		if ($argv1 == 'excel'){
			if (!$pageData['excel']) redirect(base_url().'index.php/admin/lap_labarugi','refresh');
			$this->load->view('page/excel_lap_labarugi', $pageData);
		}else{
			$pageData['page_name'] = 'lap_labarugi'; 
			$this->load->view('index', $pageData);
		}
	}

	public function lap_fee($argv = '', $argv1 = ''){
		if ($argv == ''){
			$pageData['view']     = 'form';
		}

		if ($argv == 'generate'){
			$tgl_awal        = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
			$tgl_akhir       = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));

			//dont allow if coming without parameter post value
			if(!$this->input->post('tgl_awal') || !$this->input->post('tgl_akhir')) redirect(base_url().'index.php/admin/lap_fee','refresh');

			if (date('Y-m-d',strtotime($tgl_awal)) > date('Y-m-d',strtotime($tgl_akhir))){
				$this->session->set_flashdata('statuserror', 'Periode tanggal yang anda pilih tidak benar');
				redirect(base_url().'index.php/admin/lap_fee','refresh');
			}

			$data                         = array();
			$data_pendapatan_fee_sebelum  = array();
			$data_pengeluaran_fee_sebelum = array();
			$data_pendapatan_fee          = array();
			$data_pengeluaran_fee         = array();
			$pendapatan_fee_sebelum       = $this->Md_pemasukan->getPemasukanFeeRangeSebelumTglPemasukan($tgl_awal);
			$pengeluaran_fee_sebelum      = $this->Md_pengeluaran->getPengeluaranFeeByRangeSebelumTglPemasukan($tgl_awal);
			$pemasukan_fee                = $this->Md_pemasukan->getPemasukanFeeRangeTglPemasukan($tgl_awal,$tgl_akhir);
			$pengeluaran_fee              = $this->Md_pengeluaran->getPengeluaranFeeByRangeTglPemasukan($tgl_awal,$tgl_akhir);

			$penyedia = $this->Md_penyedia->getPenyediaAll();
			$dataFeePenyedia = array();
			foreach ($penyedia as $list) {
				$row = array();
				$row['kode_penyedia'] = $list->kode_penyedia;
				$totalPemasukanFeeViaPenyedia = $this->Md_fee->getJumlahFeeDebitByPenyediaIdAndTglPemasukan($list->penyedia_id, $tgl_akhir);
				$totalPegeluaranFeeViaPenyedia = $this->Md_fee->getJumlahFeeKreditByPenyediaIdAndTglPemasukan($list->penyedia_id, $tgl_akhir); 
				$row['fee_debit'] = $totalPemasukanFeeViaPenyedia->fee_debit;
				$row['fee_kredit'] = $totalPegeluaranFeeViaPenyedia->fee_kredit;

				$dataFeePenyedia[] = (object) $row;
			}

			$pageData['excel'] = array(
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir
			);

			$pageData['periode'] = date('d-M-Y',strtotime($tgl_awal)).' - '.date('d-M-Y',strtotime($tgl_akhir));
			$pageData['view']                    = 'paper';
			$pageData['pendapatan_fee_sebelum']  = $pendapatan_fee_sebelum;
			$pageData['pengeluaran_fee_sebelum'] = $pengeluaran_fee_sebelum;
			$pageData['pemasukan_fee']           = $pemasukan_fee;
			$pageData['pengeluaran_fee']         = $pengeluaran_fee;
			$pageData['tgl_awal']                = $tgl_awal;
			$pageData['tgl_akhir']               = $tgl_akhir;
			$pageData['keterangan_fee']          = $dataFeePenyedia;
			
			$pageData['view']                    = 'data';
		}

		//select option view
		if ($argv1 == 'excel'){
			if (!$pageData['excel']) redirect(base_url().'index.php/admin/lap_fee','refresh');
			$this->load->view('page/excel_lap_fee', $pageData);
		}else{
			$pageData['page_name'] = 'lap_fee'; 
			$this->load->view('index', $pageData);
		}		
	}

	public function lap_jurnal($argv = '' , $argv1 = ''){
		if ($argv == ''){
			$pageData['alat']        = $this->Md_alat->getAlatAll();
			$pageData['kode_biaya'] = $this->Md_sasaran_dana->getSasaranDanaAll();
			$pageData['view']        = 'form';
		}

		if ($argv == 'generate'){
			$tgl_awal       = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
			$tgl_akhir      = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));

			//dont allow if coming without parameter post value
			if(!$this->input->post('tgl_awal') || !$this->input->post('tgl_akhir')) redirect(base_url().'index.php/admin/lap_jurnal','refresh');

			if (date('Y-m-d',strtotime($tgl_awal)) > date('Y-m-d',strtotime($tgl_akhir))){
				$this->session->set_flashdata('statuserror', 'Periode tanggal yang anda pilih tidak benar');
				redirect(base_url().'index.php/admin/lap_jurnal','refresh');
			}

				$pengeluaran = $this->Md_pengeluaran->getPengeluaranByRangeDate($tgl_awal, $tgl_akhir);
				// $this->echo_array($pengeluaran);die;
				$data = array();
				foreach ($pengeluaran as $list) {
					$row=array();
					$penanggungjawab = "";
	                if ($list->fee_id) $penanggungjawab = 'Kas Fee';
	                else if ($list->kode_pemilik) $penanggungjawab = $list->kode_pemilik;
	                else if ($list->kode_penyedia) $penanggungjawab = $list->kode_penyedia;

					$row['kode_voucher']       =$list->kode_voucher;
					$row['tgl_pengeluaran']    =$list->tgl_pengeluaran;
					$row['jumlah_pengeluaran'] =$list->jumlah_pengeluaran;
					$row['keterangan']         =$list->keterangan;
					$row['kode_sasaran']       =$list->kode_sasaran;
					$row['penanggungjawab']    =$penanggungjawab;
					$row['alat']       			=$list->kode_alat;

					$data[]=(object) $row;
				}

				$pageData['excel'] = array(
					'tgl_awal'  => $tgl_awal,
					'tgl_akhir' => $tgl_akhir
				);

				$pageData['periode'] = date('d-M-Y',strtotime($tgl_awal)).' - '.date('d-M-Y',strtotime($tgl_akhir));
				$pageData['pengeluaran'] = $data;
				$pageData['view']        = 'peralat';
		}

		//select option view
		if ($argv1 == 'excel'){
			if (!$pageData['excel']) redirect(base_url().'index.php/admin/lap_jurnal','refresh');
			$this->load->view('page/excel_lap_jurnal', $pageData);
		}else{
			$pageData['page_name'] = 'lap_jurnal'; 
			$this->load->view('index', $pageData);
		}	
	}

	public function lap_belanjatoko($argv = '' , $argv1 = ''){
		if ($argv == ''){
			$pageData['toko']     = $this->Md_toko->getTokoAll();
			$pageData['view']     = 'form';
		}

		if ($argv == 'generate'){
			$tgl_awal        = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
			$tgl_akhir       = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
			$toko_id         = $this->input->post('toko');
			//dont allow if coming without parameter post value
			if(!$this->input->post('tgl_awal') || !$this->input->post('tgl_akhir') || !$this->input->post('toko')) redirect(base_url().'index.php/admin/lap_belanjatoko','refresh');
			// echo "sampai sini";die;
			if (date('Y-m-d',strtotime($tgl_awal)) > date('Y-m-d',strtotime($tgl_akhir))){
				$this->session->set_flashdata('statuserror', 'Periode tanggal yang anda pilih tidak benar');
				redirect(base_url().'index.php/admin/lap_belanjatoko','refresh');
			}

			$pengeluaran = $this->Md_pengeluaran->getPengeluaranAllTokoIdAndRangeDate($toko_id, $tgl_awal, $tgl_akhir);
			// $this->echo_array($pengeluaran);die;
			$data = array();
			foreach ($pengeluaran as $list) {
				$row=array();
				$alat = " - ";
				if ($list->kode_alat) $alat = $list->kode_alat;

				$penanggungjawab = "";
                if ($list->fee_id) $penanggungjawab = 'Kas Fee';
                else if ($list->kode_pemilik) $penanggungjawab = $list->kode_pemilik;
                else if ($list->kode_penyedia) $penanggungjawab = $list->kode_penyedia;

				$row['kode_voucher']       =$list->kode_voucher;
				$row['tgl_pengeluaran']    =$list->tgl_pengeluaran;
				$row['jumlah_pengeluaran'] =$list->jumlah_pengeluaran;
				$row['keterangan']         =$list->keterangan;
				$row['alat']               =$alat;
				$row['kode_sasaran']       =$list->kode_sasaran;
				$row['toko']               =$list->kode_toko;
				$row['penanggungjawab']    =$penanggungjawab;

				$data[]=(object) $row;
			}
			$pageData['excel'] = array(
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'toko' => $toko_id
			);

			$pageData['periode'] = date('d-M-Y',strtotime($tgl_awal)).' - '.date('d-M-Y',strtotime($tgl_akhir));
			$pageData['belanja'] = $data;
			$pageData['toko']    = $this->Md_toko->getTokoById($toko_id);
			$pageData['view']    = 'peralat';
			
			$pageData['view']    = 'data';
		}

		if ($argv1 == 'excel'){
			
			if (!$pageData['excel']) redirect(base_url().'index.php/admin/lap_belanjatoko','refresh');
			$this->load->view('page/excel_lap_belanjatoko', $pageData);
		}else{
			$pageData['page_name'] = 'lap_belanjatoko'; 
			$this->load->view('index', $pageData);
		}
	}

	public function lap_tanggunganpemilik($argv = '' , $argv1 = ''){
		if ($argv == ''){
			$pageData['pemilik'] = $this->Md_pemilik->getPemilikAll();
			$pageData['view']    = 'form';
		}

		if ($argv == 'generate'){
			$tgl_awal        = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
			$tgl_akhir       = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
			$pemilik_id      = $this->input->post('pemilik');

			//dont allow if coming without parameter post value
			if(!$this->input->post('tgl_awal') || !$this->input->post('tgl_akhir')) redirect(base_url().'index.php/admin/lap_tanggunganpemilik','refresh');

			if (date('Y-m-d',strtotime($tgl_awal)) > date('Y-m-d',strtotime($tgl_akhir))){
				$this->session->set_flashdata('statuserror', 'Periode tanggal yang anda pilih tidak benar');
				redirect(base_url().'index.php/admin/lap_tanggunganpemilik','refresh');
			}

			$pengeluaran = $this->Md_pengeluaran->getPengeluaranAllPemilikIdAndRangeDate($pemilik_id, $tgl_awal, $tgl_akhir);
			// $this->echo_array($pengeluaran);die;
			$data = array();
			foreach ($pengeluaran as $list) {
				$row=array();
				$toko = " - ";
				if ($list->kode_toko) $toko = $list->kode_toko;

				$penanggungjawab = "";
                if ($list->fee_id) $penanggungjawab = 'Kas Fee';
                else if ($list->kode_pemilik) $penanggungjawab = $list->kode_pemilik;
                else if ($list->kode_penyedia) $penanggungjawab = $list->kode_penyedia;

				$row['kode_voucher']       =$list->kode_voucher;
				$row['tgl_pengeluaran']    =$list->tgl_pengeluaran;
				$row['jumlah_pengeluaran'] =$list->jumlah_pengeluaran;
				$row['keterangan']         =$list->keterangan;
				$row['alat']               =$list->kode_alat;
				$row['kode_sasaran']       =$list->kode_sasaran;
				$row['toko']               =$toko;
				$row['penanggungjawab']    =$penanggungjawab;

				$data[]=(object) $row;
			}
			$pageData['excel'] = array(
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'pemilik' => $pemilik_id
			);

			$pageData['periode'] = date('d-M-Y',strtotime($tgl_awal)).' - '.date('d-M-Y',strtotime($tgl_akhir));
			$pageData['belanja'] = $data;
			$pageData['pemilik'] = $this->Md_pemilik->getPemilikById($pemilik_id);
			$pageData['view']    = 'peralat';
			
			$pageData['view']                    = 'data';
		}

		if ($argv1 == 'excel'){
			if (!$pageData['excel']) redirect(base_url().'index.php/admin/lap_tanggunganpemilik','refresh');
			$this->load->view('page/excel_lap_tanggunganpemilik', $pageData);
		}else{
			$pageData['page_name'] = 'lap_tanggunganpemilik'; 
			$this->load->view('index', $pageData);
		}
	}

	private function echo_array($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	} 

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
/*
laporan

laporan keuangan
laporan labarugi
laporan penggunan fee
laporan belanja toko
*/