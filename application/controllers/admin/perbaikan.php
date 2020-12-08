<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Perbaikan extends Login_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Perbaikan_model');
        $this->load->model('Lokasi_model');
		$this->load->model('login_model');
        $this->load->model('Eksekutor_model');
        //$this->load->library('form_validation');
    }

    public function index(){
		$level 				= $this->session->userdata('level');
		$id_admin			= $this->session->userdata('idpengguna');
		

        //$perbaikan = $this->Perbaikan_model->get_all();
        $qperbaikan = $this->db->query("select * from perbaikan where flag_fwd=0 order by tanggal_request desc")->result();
		$data = array(
            'perbaikan_data' => $qperbaikan,
            'view' =>'admin/perbaikan/perbaikan_list'
        );

        $this->load->view('template', $data);
    }

	public function detail($id_request){

		$this->_baca_admin($id_request);
		
		$queryReq 		= $this->Perbaikan_model->get_by_id($id_request);
		$tglReq			= $this->Perbaikan_model->detail_tanggal($id_request);
		$jamReq			= $this->Perbaikan_model->detail_jam($id_request);
		$tgl_request	= $this->tanggal->konversi($tglReq['tgl']);

        $data = array(
            'title'				=> 'Daftar Request Perbaikan',
            'eksekutors'		=> $this->Eksekutor_model->get_orderbyUnit(),
			'action' 			=> site_url('admin/perbaikan/forward'),
            'idpengguna'		=> $queryReq->idpengguna,
            'sts_eksekusi'		=> $queryReq->sts_eksekusi,
            'id_klasifikasi'	=> $queryReq->id_klasifikasi,
            'request'			=> ucwords($queryReq->request),
            'photo'				=> $queryReq->photo,
            'kode_lokasi'		=> $queryReq->kode_lokasi,
            'deskripsi_request'	=> ucfirst($queryReq->deskripsi_request),
            'klasifikasis'		=> $this->Perbaikan_model->get_kalsifikasi()->result(),
            'id_request' 		=> $id_request,
            'tgl_request' 		=> $tgl_request,
            'jam_request' 		=> $jamReq['jam'],
			'estimasi' 			=> set_value('estimasi'),
			'id_klasifikasi' 	=> set_value('id_klasifikasi'),
			'ideksekuor' 		=> set_value('ideksekuor'),
			
            'view' => 'admin/perbaikan/detail_perbaikan'
        );

        $this->load->view('template', $data);
			
	}

	function forward(){
		//ubah status request flag_fwd = 1 jika sudah diforward	
		//$this->keamanan->post($this->input->post('lokasi',TRUE))
		$this->_rules();

		$level 				= $this->session->userdata('level');
		$id_admin			= $this->session->userdata('idpengguna');

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
			$this->Perbaikan_model->forward($id_request, $data);

			$queryReq 		= $this->Perbaikan_model->get_by_id($id_request);
			
			$qpegawai	= $this->db->query("select nama_lengkap from pegawai where idpengguna='".$queryReq->idpengguna."'")->row();
			$adm		= $this->db->query("select nama_lengkap from admin where idpengguna='".$id_admin."'")->row();
			$qadm 		= $this->db->query("select username from login where idpengguna='".$id_admin."'")->row();
			$qeks		= $this->db->query("select username from login where idpengguna='".$ideksekutor."'")->row();


			/*KIRIM NOTIFIKASI KE EMAIL EKSEKUTOR*/	
			$config = [
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'bi.andromeda2019@gmail.com',    // Ganti dengan email gmail kamu
               'smtp_pass' => 'bajurobek123',      // Password gmail kamu
               'smtp_port' => 465,
               'crlf'      => "\r\n",
               'newline'   => "\r\n"
            ];

			$this->load->library('email', $config); // Load library email dan konfigurasinya       
            $this->email->from('bi.andromeda2019@gmail.com', 'bi-andromeda.com | Admin' );  // Email dan nama pengirim
			
			//KIRIM EMAIL KE EKSEKUTOR
			$subject = "ID Request ".$id_request;
			$message = "Ada request baru dengan ID ".$id_request." dari Pegawai ".ucwords($qpegawai->nama_lengkap)." pada Portal Support di http://www.bi-andromeda.net, Silahkan review request segera.";

			
			$this->email->to($qeks->username); // Email penerima
            $this->email->subject($subject); // Subject email
            $this->email->message($message);
            $this->email->send();



            redirect(site_url('admin/perbaikan/historifwd/'.$id_request.'/fordward'));
			
		}
	}

	public function historifwd(){
		
        $historifwd = $this->Perbaikan_model->historifwd()->result();

        $data = array(
            'historifwd'		=> $historifwd,
            'title'				=> 'Daftar Request Perbaikan', 
            'view'				=> 'admin/perbaikan/historifwd_list'
        );
        $this->load->view('template', $data);
	}

	function progres($id_request){
		
		$queryReq 		= $this->Perbaikan_model->get_by_id($id_request);
		$tglReq			= $this->Perbaikan_model->detail_tanggal($id_request);
		$jamReq			= $this->Perbaikan_model->detail_jam($id_request);
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
            'kode_lokasi'		=> $queryReq->kode_lokasi,
            'deskripsi_request'	=> ucfirst($queryReq->deskripsi_request),
            'id_request' 		=> $id_request,
            'tgl_request' 		=> $tgl_request,
            'jam_request' 		=> $jamReq['jam'],
			'sts_eksekusi' 		=> $queryReq->sts_eksekusi,			
			'id_admin' 			=> $queryReq->dropby_idadmin,
			'photo' 			=> $queryReq->photo,
			'estimasi' 			=> $queryReq->estimasi,
			'id_klasifikasi' 	=> $queryReq->id_klasifikasi,
			//'cek_progres'		=> $this->Request_model->get_progres_byid($queryReq->ideksekutor, $id_request)->num_rows(),
			'histori_progres' 	=> $this->Perbaikan_model->get_progres($queryReq->ideksekutor, $id_request)->result(),
			'view'				=>'admin/perbaikan/progres_request',
	 		);
		$this->load->view('template', $data);
        }else{
            //$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/historifwd'));
        }
	}	

    public function photo_progres($field, $id_progres, $id_request){
		$q 		= $this->Perbaikan_model->progres_by_id($id_progres);
		if($q){
			$data = array(
				'view' 			=> 'admin/perbaikan/link_pic_progres',
				'id_request' 	=> $q->id_request,
				'foto_lokasi' 	=> $q->foto_lokasi,
				'foto_progres' 	=> $q->foto_progres
			);
            $this->load->view('template', $data);
        }else{
            redirect(site_url('admin/request/progres/'.$id_request.'/progres-request'));
        }
    }


    public function photo($id_request){
		$queryReq 		= $this->Perbaikan_model->get_by_id($id_request);
		if($queryReq){
			$data = array(
				'view' 			=> 'admin/perbaikan/link_pic',
				'photo' 		=> $queryReq->photo,
				'id_request' 	=> $id_request,
			);
            $this->load->view('template', $data);
        }else{
            redirect(site_url('admin/perbaikan/detail/'.$id_request.'/detail-perbaikan'));
        }
    }


	function _baca_admin($id_request){
		date_default_timezone_set('Asia/Jakarta');
		$wkt	= date('Y-m-d h:i:s');

		$data = array(
			'baca_admin' 		=>$wkt,
			'sts_baca_admin'	=>1	
		);
		$this->Perbaikan_model->baca($id_request, $data);
	}

	function _baca_progres($id_request){

		$data = array(
			'baca_admin' =>1	
		);
		$this->Perbaikan_model->baca_progres($id_request, $data);
	}

    public function delete($id_request){
    	$this->Perbaikan_model->delAllReqProgres($id_request);
    	$this->Perbaikan_model->delAllReqPerbaikan($id_request);
		redirect(site_url('admin/perbaikan/inbox/delete'));
    }

    public function _rules() {
		$this->form_validation->set_rules('estimasi', 'estimasi', 'trim|required');
		$this->form_validation->set_rules('id_klasifikasi', 'klasifikasi', 'trim|required');
		$this->form_validation->set_rules('ideksekutor', 'eksekutor', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


}

/* End of file Request.php */
/* Location: ./application/controllers/admin/perbaikan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-14 15:55:34 */
/* http://harviacode.com */