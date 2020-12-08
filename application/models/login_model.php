<?php if(!defined('BASEPATH')) exit('No Direct Script Allowed');
	class Login_model extends CI_Model
	{
		public $table_login = 'login';
		
		function __construct(){parent::__construct();}
		
		//info pengguna
		function info_pengguna($tabel, $field, $idpengguna){
			$this->db->where($field, $idpengguna);
			$this->db->limit(1);
			$query = $this->db->get($tabel);
			return ($query->num_rows() > 0) ? $query->row() : FALSE;	
		}
		
		function login($username, $password)
		{
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$this->db->limit(1);
			$query = $this->db->get($this->table_login);
			return ($query->num_rows() > 0) ? $query->row() : FALSE;	
		}
		function password_baru_admin($username, $password)
		{
			$data = array(
						  'password'=>$password,
						  );
			$this->db->where('username', $username);
			$this->db->update($this->table_login, $data);
		}		
	}