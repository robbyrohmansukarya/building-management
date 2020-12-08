<?php if(!defined('BASEPATH')) exit('No Direct Script Allowed');

	class Keamanan
	{
		private $CI = NULL;
		
		function __construct() {
			$this->CI =& get_instance();
		}

		function table_pengguna($level){
			switch($level):
				case 'admin':
					$tabel = 'admin';
				break;
				case 'pegawai':
					$tabel = 'pegawai';
				break;
				case 'eksekutor':
					$tabel = 'eksekutor';
				break;
			endswitch;
			return $tabel;
		}		
		function post($input){
			return addslashes(htmlspecialchars($input));
		}
		
		function post_array($input)
		{
			$temp="";
			for($i=0; $i<count($input); $i++)
			{
				$temp.=$input[$i];
				$i!=count($input)-1 ? $temp.=", " : "";
			}	
			return $this->post($temp);
		}
		
		function panjang($input)
		{
			$i=0;
			while($i<count($input))
			{
				if(strlen($input[$i])>$input[$i+1])
				{
					return TRUE;
				}
				$i+=2;					
			}
		}
		function konfigurasi($field){
			$this->CI->db->from('TCONFIG');
			$this->CI->db->where('NAMFAK', 'TEKNIK');
			$result = $this->CI->db->get();
			$r = $result->row();
			return $r->$field;
		}
		
		function cari($input)
		{
			return strip_tags($input);
		}
		
		function url_enkripsi($url)
		{
			return str_replace(" ", "-", $url);
		}
		
		function url_deskripsi($url)
		{
			return str_replace("-", " ", $url);	
		}
		
		function get($url)
		{
			return str_replace("%20", "-", $url);	
		}		
		
		function menu($url){
			//$active_master = ($url == 'mahasiswa' ? 'active' : '');
			$active_master	= '';
			$active_absen	= '';
			$active = '';
			if($url === 'master'){
				return($active_master='active');	
			}
			else if($url === 'absen'){
				return($active_absen='active');					
			}
			else{
				return($active);	
			}
		}		
			
	}//end class
	