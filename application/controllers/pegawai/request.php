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
		$idPegawai			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idPegawai']	= $idPegawai;
		
        $request = $this->Request_model->get_all($idPegawai)->result();
		
		$data = array(
            'request_data' => $request,
            'view' =>'pegawai/request/request_list'
        );

        $this->load->view('template', $data);
    }
    public function create(){
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idpengguna']	= $idpengguna ;
		//$table 				= $this->keamanan->table_pengguna($level);
        
		//$qlokasi			= $this->Request_model->get_lokasi_pegawai($idpengguna);
		
		$data = array(
            'view' 			=> 'pegawai/request/request_form',
            'title' 		=> '<i class="fa fa-edit"></i><h3 class="box-title">Quick Request</h3>',
            'action' 		=> site_url('pegawai/request/create_action'),
            'kategori' 		=> $this->Request_model->get_allKategori(),
            'alamat'		=> set_value('alamat'),
            'lokasi'		=> set_value('lokasi'),
			'id_request' 	=> set_value('id_request'),
			'id_kategori' 	=> set_value('id_kategori'),
			'idpengguna' 	=> set_value('idpengguna'),
			'request' 		=> set_value('request'),
			'deskripsi_request' => set_value('deskripsi_request'),
			'sts_eksekusi' 		=> set_value('sts_eksekusi'),
			'photo'				=> set_value('photo')
		);
        $this->load->view('template', $data);
    }
    public function create_action(){
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
	
		date_default_timezone_set('Asia/Jakarta');
		$tanggal_request = date('Y-m-d H:i:s');
		
		$id_request = date('YmdHis');
				
		$photo				= $_FILES['photo']['tmp_name'];
		$nama_photo 		= $_FILES['photo']['name'];
		
		$nmphoto = '';
		
		if($nama_photo != ''){
			$tipe 				= $_FILES['photo']['type'];
			$extensi			= explode('.',$nama_photo);	
			$extension		 	= $extensi[1];				
			$nmphoto			= $id_request.'.'.$extension;
			if(($extension=="jpg")||($extension=="png")){
				copy($photo, "assets/dist/img/request/".$nmphoto);	
			}else{
				redirect(site_url('pegawai/request/create/extension'));		
			}
		}else{
			$nmphoto = '';
		}
		$data = array(
			'id_request'		=> $id_request,
			'id_kategori' 		=> $this->input->post('id_kategori',TRUE),
			'id_klasifikasi'	=> 0,
			'idpengguna' 		=> $idpengguna,
			'lokasi' 			=> $this->keamanan->post($this->input->post('lokasi',TRUE)),
			'request' 			=> $this->keamanan->post($this->input->post('request',TRUE)),
			'deskripsi_request' => $this->keamanan->post($this->input->post('deskripsi_request',TRUE)),
			'tanggal_request' 	=> $tanggal_request,
			'baca_admin' 		=> '0000-00-00 00:00:00',
			'baca_eksekutor' 	=> '0000-00-00 00:00:00',
			'sts_baca_admin' 	=> 0,
			'sts_baca_eksekutor'=> 0,
			'sts_eksekusi' 		=> 0,
			'photo' 			=> $nmphoto
		);
		$this->Request_model->insert($data);
		
		$qpegawai	= $this->db->query("select nama_lengkap from pegawai where idpengguna='".$idpengguna."'")->row();
		$qlog		= $this->db->query("select username as email from login where idpengguna='".$idpengguna."'")->row();
		$qadm 		= $this->db->query("select username from login where level='admin'")->row();
				
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
		$message = "Ada request baru dengan ID ".$id_request." dari Pegawai ".ucwords($pegawai->nama_lengkap)." pada Portal Support di http://www.bi-andromeda.net, Silahkan review request segera.";		
		$this->email->from($log->username, ucwords($pegawai->nama_lengkap));
		$this->email->to($qadm->username);//email admin.. nantinya di ganti email admin
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
				
		redirect(site_url('pegawai/request/create/insert'));

    }

    public function read($id){
        $row 	= $this->Request_model->get_by_id($id);
        if($row){
            $data = array(
			'view'			=>'pegawai/request/request_read',
			'tanggal_request'	=> $row->tanggal_request,
			'id_request'	=> $row->id_request,
			'id_kategori' 	=> $row->id_kategori,
			'id_klasifikasi'=> $row->id_klasifikasi,
			'idpengguna'	=> $row->idpengguna,
			'lokasi' 		=> $row->lokasi,
			'request'		=> $row->request,
			'deskripsi_request' => $row->deskripsi_request,
			'sts_eksekusi'	=> $row->sts_eksekusi,
			'sts_eksekusi'	=> $row->sts_eksekusi,
			'photo'	=> $row->photo
	 	);
		$this->load->view('template', $data);
        }else{
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/request'));
        }
    }
        
    public function update($id){
        $row = $this->Request_model->get_by_id($id);

        if($row){
            $data = array(
			'view' 				=> 'pegawai/request/request_form',
            'title'				=> '<i class="fa fa-edit"></i><h3 class="box-title">Edit Request</h3>',
			'action' 			=> site_url('pegawai/request/update_action'),
			'id_request' 		=> set_value('id_request', $row->id_request),
            'kategori' 			=> $this->Request_model->get_allKategori(),
			'id_kategori' 		=> set_value('id_kategori', $row->id_kategori),
			'id_klasifikasi' 	=> set_value('id_klasifikasi', $row->id_klasifikasi),
			'idpengguna' 		=> set_value('idpengguna', $row->idpengguna),
			'lokasi' 		=> $this->keamanan->post($this->input->post('lokasi',TRUE)),
			'request' 			=> set_value('request', $row->request),
			'deskripsi_request' => set_value('deskripsi_request', $row->deskripsi_request),
			'sts_eksekusi' 		=> set_value('sts_eksekusi', $row->sts_eksekusi),
			'photo'				=> set_value('photo', $row->photo)
		);
			$this->load->view('template', $data);
        }else{
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/request'));
        }
    }
    
    public function update_action(){
			
		$id_request 		= $this->input->post('id_request',TRUE);

		$photo				= $_FILES['photo']['tmp_name'];
		$nama_photo 		= $_FILES['photo']['name'];
		
		$nmphoto = '';

		if($nama_photo != ''){
			$tipe 				= $_FILES['photo']['type'];
			$extensi			= explode('.',$nama_photo);	
			$extension		 	= $extensi[1];				
			$nmphoto			= $id_request.'.'.$extension;
			if(($extension=="jpg")||($extension=="png")){
				//ambil photo lama kemudian hapus di directori
				$row = $this->Request_model->get_by_id($id);
				if($row->photo != ''){
					unlink("assets/dist/img/request/".$row->photo);
				}
				
				copy($photo, "assets/dist/img/request/".$nmphoto);		
				
				$data = array(
					'id_kategori' 		=> $this->input->post('id_kategori',TRUE),
					'lokasi' 			=> $this->keamanan->post($this->input->post('lokasi',TRUE)),
					'request' 			=> $this->input->post('request',TRUE),
					'deskripsi_request' => $this->input->post('deskripsi_request',TRUE),
					'photo' 		=> $nmphoto
				);
				$this->Request_model->update($this->input->post('id_request', TRUE), $data);
				redirect(site_url('pegawai/request/update/'.$id_request.'/success'));
			}else{
				redirect(site_url('pegawai/request/update/'.$id_request.'/extension'));
			}
		}else{
			$data = array(
				'id_kategori' 		=> $this->input->post('id_kategori',TRUE),
				'lokasi' 		=> $this->keamanan->post($this->input->post('lokasi',TRUE)),
				'request' 			=> $this->input->post('request',TRUE),
				'deskripsi_request' => $this->input->post('deskripsi_request',TRUE)
			);
			$this->Request_model->update($this->input->post('id_request', TRUE), $data);
			redirect(site_url('pegawai/request/update/'.$id_request.'/success'));
		}
    }

	public function historifwd($idpengguna){
		
        $historifwd = $this->Request_model->historifwd_pegawai($idpengguna)->result();

        $data = array(
            'historifwd'		=> $historifwd,
            'title'				=> 'Daftar Request', //$kategori == 'penyedia' ? ucwords($kategori).' Ruangan':ucwords($kategori),
            'view'				=> 'pegawai/request/historifwd_list'
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
			'view'				=>'pegawai/request/progres_request',
	 		);
		$this->load->view('template', $data);
        }else{
            //$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/request/historifwd'));
        }
	}	

    
    public function delete($id){
        $row = $this->Request_model->get_by_id($id);

        if($row){
			if($row->photo != ''){
				unlink("assets/dist/img/request/".$row->photo);
			}
            $this->Request_model->delete($id);
			$this->Request_model->delete_progres_byuser($id);
            redirect(site_url('pegawai/request/index/delete'));
        }else{
            //$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/request'));
        }
    }
	
    public function photo($id_request){
		$queryReq 		= $this->Request_model->get_by_id($id_request);
		if($queryReq){
			$data = array(
				'view' 			=> 'pegawai/request/link_pic',
				'photo' 		=> $queryReq->photo,
				'id_request' 	=> $id_request,
			);
            $this->load->view('template', $data);
        }else{
            redirect(site_url('pegawai/request/progres/'.$id_request));
        }
    }
	
    public function photo_progres($field, $id_progres, $id_request){
		$q 		= $this->Request_model->progres_by_id($id_progres);
		if($q){
			$data = array(
				'view' 			=> 'pegawai/request/progres_link_pic',
				'id_request' 	=> $q->id_request,
				'foto_lokasi' 	=> $q->foto_lokasi,
				'foto_progres' 	=> $q->foto_progres
			);
            $this->load->view('template', $data);
        }else{
            redirect(site_url('pegawai/request/progres/'.$id_request.'/progres-request'));
        }
    }
	function _baca_progres($id_request){

		$data = array(
			'baca_pegawai' =>1
		);
		$this->Request_model->baca_progres($id_request, $data);
	}

    public function _rules() 
    {
		$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
		$this->form_validation->set_rules('request', 'request', 'trim|required');
		$this->form_validation->set_rules('deskripsi_request', 'deskripsi request', 'trim|required');
		//$this->form_validation->set_rules('id_klasifikasi', 'id klasifikasi', 'trim|required');
		//$this->form_validation->set_rules('idpengguna', 'idpengguna', 'trim|required');
		//$this->form_validation->set_rules('baca_admin', 'baca admin', 'trim|required');
		//$this->form_validation->set_rules('baca_eksekutor', 'baca eksekutor', 'trim|required');
		//$this->form_validation->set_rules('sts_baca_admin', 'sts baca admin', 'trim|required');
		//$this->form_validation->set_rules('sts_baca_eksekutor', 'sts baca eksekutor', 'trim|required');
		//$this->form_validation->set_rules('sts_eksekusi', 'sts eksekusi', 'trim|required');
	
		//$this->form_validation->set_rules('id_request', 'id_request', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "request.xls";
        $judul = "request";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kategori");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Klasifikasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Idpengguna");
	xlsWriteLabel($tablehead, $kolomhead++, "Request");
	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi Request");
	xlsWriteLabel($tablehead, $kolomhead++, "Baca Admin");
	xlsWriteLabel($tablehead, $kolomhead++, "Baca Eksekutor");
	xlsWriteLabel($tablehead, $kolomhead++, "Sts Baca Admin");
	xlsWriteLabel($tablehead, $kolomhead++, "Sts Baca Eksekutor");
	xlsWriteLabel($tablehead, $kolomhead++, "Sts Eksekusi");

	foreach ($this->Request_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_kategori);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_klasifikasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->idpengguna);
	    xlsWriteLabel($tablebody, $kolombody++, $data->request);
	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi_request);
	    xlsWriteLabel($tablebody, $kolombody++, $data->baca_admin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->baca_eksekutor);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sts_baca_admin);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sts_baca_eksekutor);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sts_eksekusi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
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