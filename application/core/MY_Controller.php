<?php if(!defined('BASEPATH')) exit('No Direct Script Allowed');
	class Login_Controller extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->access->is_login()){
				redirect('login');	
			}	
		}
		function is_logins(){
			return $this->access->is_login();
		}
	}
	
	class MY_Controller extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();	
		}	
	}