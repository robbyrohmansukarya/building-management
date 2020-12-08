<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('access');
	}
	
	public function index() { $this->form_login(); }
	
	public function form_login() {
		$data = array(
			'action'	=> 'login/proses',
			'error'		=> FALSE
		);
		$this->load->view('login2', $data);	
	}
	
	public function proses(){
		$data['action']	= 'login/proses';
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		
		if($this->form_validation->run() == FALSE){
			$data['error'] = FALSE;
			$this->load->view('login2',$data);	
		}else{
			$username 	= $this->keamanan->post($this->input->post('username'));	
			$password 	= $this->keamanan->post($this->input->post('password'));	
			$cek 		= $this->access->login($username, md5($password));			
			if($cek){
				$level = $this->session->userdata('level');
				redirect($level.'/dashboard');				
			}else{
				$data['error'] = TRUE;
				$this->load->view('login2',$data);	
			}
		}
	}

	function signout(){
		$this->access->logout_admin();
		redirect('login');	
	}		
	
}

/* End of file login.php */
/* Location: ./application/akademik/controllers/login.php */