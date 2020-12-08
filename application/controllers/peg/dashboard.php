<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Login_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model('Pegawai_model');
		$this->load->model('login_model');
		$this->load->model('Request_model');
	}
	
	public function index() { $this->beranda(); }
	
	public function beranda() {
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idpengguna']	= $idpengguna ;
		$table 				= $this->keamanan->table_pengguna($level);
		
		//hitung
		$data['jmlWaiting'] 	= $this->Request_model->hitungRequest($idpengguna, 'request', 'sts_eksekusi', 0);
		$data['jmlSedang'] 		= $this->Request_model->hitungRequest($idpengguna, 'request', 'sts_eksekusi', 1);
		$data['jmlSelesai'] 	= $this->Request_model->hitungRequest($idpengguna, 'request', 'sts_eksekusi', 2);
		$data['allRequest'] 	= $this->Request_model->hitungRequest($idpengguna, 'request', 'idpengguna', $idpengguna);
		
		date_default_timezone_set('Asia/Jakarta');
		$tglHariIni = date('Y-m-d');

		$data['cekRequestHariIni'] = $this->Request_model->requestHariIni($idpengguna, $tglHariIni)->num_rows();
		$data['requestHariIni']	= $this->Request_model->requestHariIni($idpengguna, $tglHariIni)->result();
		$data['cekHRequest']		= $this->Request_model->getAllLimit($idpengguna, $tglHariIni)->num_rows();
		$data['HRequest']		= $this->Request_model->getAllLimit($idpengguna, $tglHariIni)->result();
		
		$data['info_pengguna'] = $this->login_model->info_pengguna($table, 'idpengguna', $idpengguna);
		//$data['pengguna']	= $this->costumer_model->pengguna($idcost);
		$data['view']		= $level.'/beranda';
		$data['title']		='Dashboard '.ucwords($level);

		$this->load->view('template', $data);
	}
}

/* End of file beranda.php */
/* Location: ./application/controllers/costumer/dashboard.php */