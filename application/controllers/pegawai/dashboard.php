<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Login_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model('Pegawai_model');
		$this->load->model('login_model');
		$this->load->model('Ruangan_model');
		$this->load->model('Perbaikan_model');
		$this->load->model('Barang_model');
	}
	
	public function index() { $this->beranda(); }
	
	public function beranda() {
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idpengguna']	= $idpengguna ;
		$table 				= $this->keamanan->table_pengguna($level);
		
		date_default_timezone_set('Asia/Jakarta');
		$tglHariIni = date('Y-m-d');
		
		$data['info_pengguna'] = $this->login_model->info_pengguna($table, 'idpengguna', $idpengguna);
		//$data['pengguna']	= $this->costumer_model->pengguna($idcost);
		$data['view']		= 'pegawai/beranda';
		$data['title']		='Dashboard '.ucwords($level);

		$this->load->view('template', $data);
	}
}

/* End of file beranda.php */
/* Location: ./application/controllers/costumer/dashboard.php */