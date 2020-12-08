<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Login_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model('Pegawai_model');
		$this->load->model('login_model');
		$this->load->model('Ruangan_model');
		$this->load->model('Perbaikan_model');
	}
	
	public function index() { $this->beranda(); }
	
	public function beranda() {
		
		$level 				= $this->session->userdata('level');
		$ideksekutor		= $this->session->userdata('idpengguna');
		$table 				= $this->keamanan->table_pengguna($level);
		$info_pengguna= $this->login_model->info_pengguna($table, 'idpengguna', $ideksekutor);

		$data['view']		= 'eksekutor/beranda';
		$data['title']		='Dashboard Eksekutor';

		$this->load->view('template', $data);
	}
}

/* End of file beranda.php */
/* Location: ./application/controllers/costumer/dashboard.php */