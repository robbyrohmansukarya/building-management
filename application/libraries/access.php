<?php if(!defined('BASEPATH')) exit('No Direct Script Allowed');
	class Access 
	{
		public $user;
		
		function __construct()
		{
			$this->CI =& get_instance();
			$auth = $this->CI->config->item('auth');
			
			$this->CI->load->helper('cookie');
			$this->CI->load->model('login_model');
			
			$this->login_model =& $this->CI->login_model;	
		}
		
		//******************** costumer **********************************//
		
		function login($username, $password){
			$result = $this->login_model->login($username, $password);
			if($result){
				if(($username === $result->username) &&($password === $result->password)){
					$infouser = array(
									'idpengguna'=>$result->idpengguna,
									'username'=>$result->username,
									'level'=>$result->level
								);
					$this->CI->session->set_userdata($infouser);
					return TRUE;	
				}	
			}
			return FALSE;
		}
		function is_login(){
			return(($this->CI->session->userdata('idpengguna')) ? TRUE : FALSE);	
		}	
		
		
		function logout_admin(){
			$infouser = array('idpengguna','username','level');
			$this->CI->session->unset_userdata($infouser);	
		}
	
	}