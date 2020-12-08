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
		$data['info_pengguna'] = $this->login_model->info_pengguna($table, 'idpengguna', $idpengguna);
		$data['view']		= 'admin/beranda';
		$data['title']		='Dashboard '.ucwords($level);

		$this->load->view('template', $data);
	}


	public function monitor()
	{
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idpengguna']	= $idpengguna ;
		$table 				= $this->keamanan->table_pengguna($level);
		$data['info_pengguna'] = $this->login_model->info_pengguna($table, 'idpengguna', $idpengguna);
		//$data['view']		= 'admin/beranda';
		$data['view']		= 'admin/monitor';
		$data['title']		='Dashboard '.ucwords($level);

        $this->load->view('monitor', $data);
	}
}

/* End of file beranda.php */
/* Location: ./application/controllers/costumer/dashboard.php */