<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Request extends Login_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Request_model');
        $this->load->model('Eksekutor_model');
		$this->load->model('login_model');
        //$this->load->library('form_validation');
    }

    public function index(){
		redirect(site_url('admin/dashboard'));
		/*
			ID KATEGORI:
			KR01 = PERBAIKAN
			KR02 = PERMINTAAN
			KR03 = PENYEDIA RUANGAN
		*/
    }
	public function kategori($id_kategori, $kategori){
		date_default_timezone_set('Asia/Jakarta');
		$tglHariIni = date('Y-m-d');
        $reqKategori = $this->Request_model->request_ByKategori($id_kategori)->result();

        $data = array(
            'reqKategori'		=> $reqKategori,
            'title_kategori'	=> $kategori == 'penyedia' ? ucwords($kategori).' Ruangan':ucwords($kategori),
            'kategori'			=> $kategori,
            'view'				=> 'admin/req_bykategori_list'
        );
        $this->load->view('template', $data);
	}
	public function detail($kategori, $id_kategori, $id_request){
		$this->_baca_admin($id_request);
		
		$queryReq 		= $this->Request_model->get_by_id($id_request);
		$tglReq			= $this->Request_model->detail_tanggal($id_request);
		$jamReq			= $this->Request_model->detail_jam($id_request);
		$tgl_request	= $this->tanggal->konversi($tglReq['tgl']);
		
        $data = array(
            'title_kategori'	=> $kategori == 'penyedia' ? ucwords($kategori).' Ruangan':ucwords($kategori),
            'eksekutors'		=> $this->Eksekutor_model->get_orderbyUnit(),
			'action' 			=> site_url('admin/request/forward/'),
            'idpengguna'		=> $queryReq->idpengguna,
            'sts_eksekusi'		=> $queryReq->sts_eksekusi,
            'id_klasifikasi'	=> $queryReq->id_klasifikasi,
            'request'			=> ucwords($queryReq->request),
            'photo'				=> $queryReq->photo,
            'lokasi'			=> ($queryReq->lokasi == '' ? '' : ' '.ucwords($queryReq->lokasi)),
            'deskripsi_request'	=> ucfirst($queryReq->deskripsi_request),
            'kategori'			=> $kategori,
            'klasifikasis'		=> $this->Request_model->get_kalsifikasi()->result(),
            'id_request' 		=> $id_request,
            'id_kategori' 		=> $id_kategori,
            'tgl_request' 		=> $tgl_request,
            'jam_request' 		=> $jamReq['jam'],
			
			'estimasi' 			=> set_value('estimasi'),
			'id_klasifikasi' 	=> set_value('id_klasifikasi'),
			'ideksekuor' 		=> set_value('ideksekuor'),
			
            'view' => 'admin/detail_request'
        );
        $this->load->view('template', $data);
			
	}

	function forward(){
		//ubah status request flag_fwd = 1 jika sudah diforward	
		//$this->keamanan->post($this->input->post('lokasi',TRUE))
		$this->_rules();

		$level 				= $this->session->userdata('level');
		$id_admin			= $this->session->userdata('idpengguna');

		$kategori 	 	= $this->input->post('kategori',TRUE);
		$id_kategori	= $this->input->post('id_kategori',TRUE);
		$id_request 	= $this->input->post('id_request',TRUE);
		$forward 		= $this->input->post('forwad',TRUE);
		
        if($this->form_validation->run() == FALSE){
            redirect(site_url('admin/dashboard'));
        }
		else
		{
			$ideksekutor = $this->keamanan->post($this->input->post('ideksekutor',TRUE));
			$data = array(
				'id_klasifikasi'	=> $this->keamanan->post($this->input->post('id_klasifikasi',TRUE)),
				'ideksekutor' 		=> $ideksekutor,
				'estimasi' 			=> $this->keamanan->post($this->input->post('estimasi',TRUE)),
				'dropby_idadmin' 	=> $id_admin,
				'flag_fwd' 			=> 1,
			);
			$this->Request_model->forward($id_request, $data);

			$queryReq 		= $this->Request_model->get_by_id($id_request);
			
			$qpegawai	= $this->db->query("select nama_lengkap from pegawai where idpengguna='".$queryReq->idpengguna."'")->row();
			$adm		= $this->db->query("select nama_lengkap from admin where idpengguna='".$id_admin."'")->row();
			$qadm 		= $this->db->query("select username from login where idpengguna='".$id_admin."'")->row();
			$qeks		= $this->db->query("select username from login where idpengguna='".$ideksekutor."'")->row();
					
			$config['protocol']		= 'smtp';  
			$config['smtp_host']	= 'ssl://smtp.googlemail.com';  
			$config['smtp_port']	= '465';  
			$config['smtp_timeout']	= '30';  
			$config['smtp_user']	= 'adikusumah2012@gmail.com'; //email pengirim dalam hal ini admin
			$config['smtp_pass']	= 'kh4izur4n'; // Password email pengirim
			$config['charset']		= 'utf-8';  
			$config['newline']		= "\r\n";
			$config['mailtype'] 	= 'html';		
			$this->load->library('email', $config);
			
			//KIRIM EMAIL KE EKSEKUTOR
			$subject = "ID Request ".$id_request;
			$message = "Ada request baru dengan ID ".$id_request." dari Pegawai ".ucwords($pegawai->nama_lengkap)." pada Portal Support di http://www.bi-andromeda.net, Silahkan review request segera.";		
			$this->email->from($qadm->username, ucwords($adm->nama_lengkap));
			$this->email->to($qeks->username);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();

            redirect(site_url('admin/request/historifwd/'.$kategori.'/'.$id_kategori.'/'.$id_request.'/fordward'));
			
		}
	}

	public function historifwd(){
		
        $historifwd = $this->Request_model->historifwd()->result();

        $data = array(
            'historifwd'		=> $historifwd,
            'title'				=> 'Daftar Request', //$kategori == 'penyedia' ? ucwords($kategori).' Ruangan':ucwords($kategori),
            'view'				=> 'admin/historifwd_list'
        );
        $this->load->view('template', $data);
	}
	
	function progres($id_request){
		
		$queryReq 		= $this->Request_model->get_by_id($id_request);
		$tglReq			= $this->Request_model->detail_tanggal($id_request);
		$jamReq			= $this->Request_model->detail_jam($id_request);
		$tgl_request	= $this->tanggal->konversi($tglReq['tgl']);
		
		$this->_baca_progres($id_request);
		
        if($queryReq){
            $data = array(
			//'action' 			=> site_url('eksekutor/request/progres/'),
            'idpengguna'		=> $queryReq->idpengguna,
            'id_request'		=> $id_request,
            'ideksekutor'		=> $queryReq->ideksekutor,
            'sts_eksekusi'		=> $queryReq->sts_eksekusi,
            'id_klasifikasi'	=> $queryReq->id_klasifikasi,
            'request'			=> ucwords($queryReq->request),
            'photo'				=> $queryReq->photo,
            'lokasi'			=> ($queryReq->lokasi == '' ? '' : ' '.ucwords($queryReq->lokasi)),
            'deskripsi_request'	=> ucfirst($queryReq->deskripsi_request),
            'id_request' 		=> $id_request,
            'id_kategori' 		=> $queryReq->id_kategori,
            'tgl_request' 		=> $tgl_request,
            'jam_request' 		=> $jamReq['jam'],
			'sts_eksekusi' 		=> $queryReq->sts_eksekusi,			
			'id_admin' 			=> $queryReq->dropby_idadmin,
			'photo' 			=> $queryReq->photo,
			'estimasi' 			=> $queryReq->estimasi,
			'id_klasifikasi' 	=> $queryReq->id_klasifikasi,
			//'cek_progres'		=> $this->Request_model->get_progres_byid($queryReq->ideksekutor, $id_request)->num_rows(),
			'histori_progres' 	=> $this->Request_model->get_progres($queryReq->ideksekutor, $id_request)->result(),
			'view'				=>'admin/progres_request',
	 		);
		$this->load->view('template', $data);
        }else{
            //$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/historifwd'));
        }
	}	
	
	function _baca_progres($id_request){

		$data = array(
			'baca_admin' =>1	
		);
		$this->Request_model->baca_progres($id_request, $data);
	}
	function _baca_admin($id_request){
		date_default_timezone_set('Asia/Jakarta');
		$wkt	= date('Y-m-d h:i:s');

		$data = array(
			'baca_admin' =>$wkt,
			'sts_baca_admin' =>1	
		);
		$this->Request_model->baca($id_request, $data);
	}
	
    public function photo($kategori, $id_kategori, $id_request){
		$queryReq 		= $this->Request_model->get_by_id($id_request);
		if($queryReq){
			$data = array(
				'view' 			=> 'admin/link_pic',
				'photo' 		=> $queryReq->photo,
				'kategori'		=> $kategori,
				'id_request' 	=> $id_request,
				'id_kategori' 	=> $id_kategori,
			);
            $this->load->view('template', $data);
        }else{
            redirect(site_url('admin/request/kategori/'.$id_kategori.'/'.$kategori));
        }
    }
	
    public function photo_progres($field, $id_progres, $id_request){
		$q 		= $this->Request_model->progres_by_id($id_progres);
		if($q){
			$data = array(
				'view' 			=> 'admin/link_pic_progres',
				'id_request' 	=> $q->id_request,
				'foto_lokasi' 	=> $q->foto_lokasi,
				'foto_progres' 	=> $q->foto_progres
			);
            $this->load->view('template', $data);
        }else{
            redirect(site_url('admin/request/progres/'.$id_request.'/progres-request'));
        }
    }
	
	
    public function delete($kategori, $id_kategori, $id_request){
        $row = $this->Request_model->get_by_id($id_request);
		
		//echo $row->photo;
		
        if($row){
			if($row->photo != ''){
				unlink("assets/dist/img/request/".$row->photo);
			}
            $this->Request_model->delete($id_request);
            redirect(site_url('admin/request/kategori/'.$id_kategori.'/'.$kategori.'/delete'));
        }else{
            //$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/request/kategori/'.$id_kategori.'/'.$kategori));
        }
    }
    public function _rules() {
		$this->form_validation->set_rules('estimasi', 'estimasi', 'trim|required');
		$this->form_validation->set_rules('id_klasifikasi', 'klasifikasi', 'trim|required');
		$this->form_validation->set_rules('ideksekutor', 'eksekutor', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	
	
}

/* End of file Request.php */
/* Location: ./application/controllers/admin/Request.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-14 15:55:34 */
/* http://harviacode.com */