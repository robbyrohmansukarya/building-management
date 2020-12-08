<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Request extends Login_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Request_model');
		$this->load->model('login_model');
        $this->load->library('form_validation');
    }

    public function index(){
		$level 				= $this->session->userdata('level');
		$ideksekutor		= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idPegawai']	= $ideksekutor;
		
        $request = $this->Request_model->er_get_all($ideksekutor)->result();

		$data = array(
            'request_data' => $request,
            'view' =>'eksekutor/request/request_list'
        );

        $this->load->view('template', $data);
    }

    public function read($id_request){
		$level 				= $this->session->userdata('level');
		$ideksekutor		= $this->session->userdata('idpengguna');

		$this->_baca_eksekutor($id_request);
		
		$queryReq 		= $this->Request_model->get_by_id($id_request);
		$tglReq			= $this->Request_model->detail_tanggal($id_request);
		$jamReq			= $this->Request_model->detail_jam($id_request);
		$tgl_request	= $this->tanggal->konversi($tglReq['tgl']);
		
        if($queryReq){
            $data = array(
			'action' 			=> site_url('eksekutor/request/progres/'),
            'id_request'		=> $id_request,
            'idpengguna'		=> $queryReq->idpengguna,
            'ideksekutor'		=> $ideksekutor,
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
			'progress'		 	=> $this->Request_model->get_progres($ideksekutor, $id_request)->result(),
			'view'				=>'eksekutor/request/request_read',
	 		);
		$this->load->view('template', $data);
        }else{
            //$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('eksekutor/request'));
        }
    }
	function progres(){
		date_default_timezone_set('Asia/Jakarta');

		$id_request 		= $this->input->post('id_request',TRUE);
		
		$photo_lokasi		= $_FILES['photo_lokasi']['tmp_name'];
		$nama_photo_lokasi	= $_FILES['photo_lokasi']['name'];
		$nmphoto_lokasi		= '';

		$photo_progres		= $_FILES['photo_progres']['tmp_name'];
		$nama_photo_progres	= $_FILES['photo_progres']['name'];
		$nmphoto_photo_progres = '';
		
		if($nama_photo_lokasi != ''){
			$tipe_lokasi		= $_FILES['photo_lokasi']['type'];
			
			$extensi_l			= explode('.',$nama_photo_lokasi);	
			$extension_l		 = $extensi_l[1];				
			if(($extension_l=="jpg")||($extension_l=="png")){				
			$nmphoto_lokasi		= 'l'.time().'.'.$extension_l;
				copy($photo_lokasi, "assets/dist/img/progres/".$nmphoto_lokasi);		
			}else{
				redirect(site_url('eksekutor/request/read/'.$id_request.'/extension'));
			}
		}
		if($nama_photo_progres != ''){
			$tipe_progres		= $_FILES['photo_progres']['type'];
			
			$extensi_p			= explode('.',$nama_photo_progres);	
			$extension_p		= $extensi_p[1];				
			if(($extension_p=="jpg")||($extension_p=="png")){				
				$nmphoto_photo_progres	= 'p'.time().'.'.$extension_p;
				copy($photo_progres, "assets/dist/img/progres/".$nmphoto_photo_progres);		
			}else{
				redirect(site_url('eksekutor/request/read/'.$id_request.'/extension'));
			}
		}
		
		$idpegawai 		= $this->input->post('id_pegawai',TRUE);
		$id_admin 		= $this->input->post('id_admin',TRUE);
		$ideksekutor 	= $this->input->post('ideksekutor',TRUE);
		$data = array(
			'id_request' 		=> $id_request,
			'id_eksekutor' 		=> $ideksekutor,
			'sts_eksekusi' 		=> $this->input->post('sts_eksekusi',TRUE),
			'progres' 			=> $this->input->post('progres',TRUE),
			'biaya' 			=> $this->input->post('biaya',TRUE),
			'id_admin' 			=> $id_admin,
			'id_pegawai' 		=> $idpegawai,
			'baca_admin' 		=> 0,
			'baca_pegawai' 		=> 0,			
			'foto_lokasi' 		=> $nmphoto_lokasi,
			'foto_progres' 		=> $nmphoto_photo_progres
		);
		//update status eksekusi di tabel request
		$data2 = array(
			'sts_eksekusi' 		=> $this->input->post('sts_eksekusi',TRUE),
		);
		$this->Request_model->update_status($id_request, $data2);
		$this->Request_model->insert_progres($data);

		$qpegawai	= $this->db->query("select nama_lengkap from pegawai where idpengguna='".$idpegawai."'")->row();
		$adm		= $this->db->query("select nama_lengkap from admin where idpengguna='".$id_admin."'")->row();
		$eks		= $this->db->query("select nama_lengkap, unit from eksekutor where idpengguna='".$ideksekutor."'")->row();
		
		$qadm 		= $this->db->query("select username from login where idpengguna='".$id_admin."'")->row();
		$qeks		= $this->db->query("select username from login where idpengguna='".$ideksekutor."'")->row();
		$qpeg		= $this->db->query("select username from login where idpengguna='".$idpegawai."'")->row();
				
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
		
		//KIRIM EMAIL KE ADMIN
		$subject = "ID Request ".$id_request;
		$message = "Progres request baru terkait dengan ID ".$id_request." dari Eksekutor ".ucwords($eks->unit)." pada Portal Support di http://www.bi-andromeda.net, Silahkan review progres request.";		
		$this->email->from($qeks->username, ucwords($eks->nama_lengkap));
		$this->email->to($qadm->username);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
		
		//KIRIM EMAIL KE PEGAWAI
		$this->email->from($qeks->username, ucwords($eks->nama_lengkap));
		$this->email->to($qpeg->username);//email penerima 
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();


		redirect(site_url('eksekutor/request/read/'.$id_request.'/success'));
	}

    public function photo($id_request){
		$q 		= $this->Request_model->get_by_id($id_request);
		if($q){
			$data = array(
				'view' 			=> 'eksekutor/request/link_pic',
				'id_request' 	=> $q->id_request,
				'photo' 		=> $q->photo
			);
            $this->load->view('template', $data);
        }else{
            redirect(site_url('eksekutor/request'));
        }
    }

	function _baca_eksekutor($id_request){
		date_default_timezone_set('Asia/Jakarta');
		$wkt	= date('Y-m-d h:i:s');

		$data = array(
			'baca_eksekutor' =>$wkt,
			'sts_baca_eksekutor' =>1	
		);
		$this->Request_model->baca($id_request, $data);
	}

    public function delete_progres($id_progres, $id_request){
        $row = $this->Request_model->progres_by_id($id_progres);
				
        if($row){
			if($row->foto_lokasi != ''){
				unlink("assets/dist/img/progres/".$row->foto_lokasi);
			}
			if($row->foto_progres != ''){
				unlink("assets/dist/img/progres/".$row->foto_progres);
			}
            $this->Request_model->delete_progres($id_progres);
			redirect(site_url('eksekutor/request/read/'.$id_request.'/delete'));
        }else{
            //$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('eksekutor/request/read/'.$id_request.'/detail-request'));
        }
    }

            
    public function _rules(){
		$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
		$this->form_validation->set_rules('request', 'request', 'trim|required');
		$this->form_validation->set_rules('deskripsi_request', 'deskripsi request', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=request.doc");

        $data = array(
            'request_data' => $this->Request_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('request/request_doc',$data);
    }

}

/* End of file Request.php */
/* Location: ./application/controllers/Request.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-14 15:55:34 */
/* http://harviacode.com */