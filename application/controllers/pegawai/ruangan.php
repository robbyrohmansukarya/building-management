<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Ruangan extends Login_Controller
{
    function __construct(){
        parent::__construct();
        //$this->load->model('Request_model');
        $this->load->model('Ruangan_model');
		$this->load->model('login_model');
        $this->load->library('form_validation');
    }

    public function index(){
    	$this->help();
    }
	
	public function help(){
		$data = array(
            'view' =>'pegawai/request/ruangan/help_ruangan'
        );

        $this->load->view('template', $data);		
	}
	
    public function master(){
		$level 				= $this->session->userdata('level');
		$idPegawai			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idPegawai']	= $idPegawai;
		
        $ruangan = $this->Ruangan_model->get_all();
		$data = array(
            'ruangan_data' => $ruangan,
            'view' =>'pegawai/request/ruangan/ruangan_list'
        );

        $this->load->view('template', $data);
    }
    public function tes(){
		$level 				= $this->session->userdata('level');
		$idPegawai			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['action']		= $level;
		$data['idPegawai']	= $idPegawai;
		
        $ruangan = $this->Ruangan_model->get_all();
		$data = array(
            'ruangan_data' => $ruangan,
            'view' =>'pegawai/request/ruangan/tes'
        );

        $this->load->view('template', $data);
    }
	
	public function tersedia(){
		$tgl = $this->input->post('tgl');
		//echo $tgl;
		
		$ruangan = '';
		
		
		/*echo '<span class="input-group-addon"><i class="fa fa-home"></i></span>';
		echo '<select id="kode_ruangan" class="form-control" name="kode_ruangan" required data-bv-trigger="blur" 
                        data-bv-notempty-message="<i class="fa fa-times-circle"></i> Silahkan pilih kategori request">';	
				echo '<option value="">'.'-- Pilih Ruangan --'.'</option>';
				foreach($dtRuangan as $row):
					echo $ruangan = '<option id="kode_ruangan" value="'.$row->kode_ruangan.'">'.$row->nama_ruangan.'- '.$tgl.'</option>';
					//$ruangan .= $row->nama;
				endforeach;
		echo '</select>';
		*/
		
		echo '<div class="row">
				<div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
					<div class="form-group">
					<table class="table table-bordered table-striped display responsive nowrap" id="" cellspacing="0" width="100%">
						<thead class="bg-default">
							<tr>
								<th width="30">No</th>
								<th>Nama Ruangan</th>
								<th width="100"><center>Pilih</center></th>
							</tr>
						</thead>
						<tbody>
						';
						$dtRuangan = $this->Ruangan_model->get_all();
						$cek = $this->db->query("select kode_ruangan from request_ruangan where tanggal_kegiatan='".$tgl."'")->num_rows();
						$no = 1;
						foreach($dtRuangan as $row):
							echo '<tr>
									<td>'.$no.'</td>
									<td>'.$row->nama_ruangan.$cek.'</td>
									<td><center><input type="checkbox" required="required" data-bv-trigger="blur" data-bv-notempty-message=" pilih ruangan" name="kode_ruangan[]" class="minimal" value="'.$row->kode_ruangan.'"></center></td>
								</tr>';
							$no++;
						endforeach;
						echo '
						</tbody>
					</table>
					</div>
				</div>
			</div>';		
	}
	
    public function booking(){
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idpengguna']	= $idpengguna ;
		
		$data = array(
            'view' 			=> 'pegawai/request/ruangan/ruangan_form',
            'title' 		=> '<i class="fa fa-edit"></i><h3 class="box-title"> Booking Room</h3>',
            'action' 		=> site_url('pegawai/ruangan/booking_action'),
            'ruangan' 		=> $this->Ruangan_model->get_all(),
            'kode_ruangan'	=> set_value('kode_ruangan'),
			'id_request' 	=> set_value('id_request'),
			'nama_kegiatan' => set_value('nama_kegiatan'),
			'deskripsi_kegiatan' => set_value('deskripsi_kegiatan'),
			'tanggal_kegiatan' => set_value('tanggal_kegiatan'),
			'tanggal_selesai' => set_value('tanggal_selesai'),
			'jam_mulai' 	=> set_value('jam_mulai'),
			'jam_selesai' 	=> set_value('jam_selesai'),
		);
        $this->load->view('template', $data);
    }
	
    public function booking_action(){
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
		
		date_default_timezone_set('Asia/Jakarta');
		$tanggal_request = date('Y-m-d H:i:s');
		
		$id_request 	= date('YmdHis');
		$kode_ruangans 	= $this->input->post('kode_ruangan',TRUE);
		//echo $this->input->post('tanggal_kegiatan',TRUE);
		foreach ($kode_ruangans as $key => $value){
			$kode_ruangan = "{$value}";
			//echo $kode_ruangan;
			$data = array(
				'id_request'		=> $id_request,
				'idpengguna' 		=> $idpengguna,
				'ideksekutor' 		=> '',
				'kode_ruangan' 		=> $kode_ruangan,
				'nama_kegiatan' 	=> $this->keamanan->post($this->input->post('nama_kegiatan',TRUE)),
				'deskripsi_kegiatan' => $this->keamanan->post($this->input->post('deskripsi_kegiatan',TRUE)),
				'tanggal_kegiatan' 	=> $this->input->post('tanggal',TRUE),
				'tanggal_selesai' 	=> $this->input->post('tanggal_selesai',TRUE),
				'jam_mulai' 		=> $this->input->post('jam_mulai',TRUE),
				'jam_selesai' 		=> $this->input->post('jam_selesai',TRUE),
				'dropby_idadmin' 	=> '',
				'baca_admin' 		=> '0000-00-00 00:00:00',
				'baca_eksekutor' 	=> '0000-00-00 00:00:00',
				'sts_baca_admin' 	=> 0,
				'sts_baca_eksekutor'=> 0,
				'sts_eksekusi' 		=> 0,
			);
			if($kode_ruangan !=''){
				$this->Ruangan_model->insert_booking($data);
			}
		}
			
		$qpegawai	= $this->db->query("select nama_lengkap from pegawai where idpengguna='".$idpengguna."'")->row();
		$qlog		= $this->db->query("select username as email from login where idpengguna='".$idpengguna."'")->row();
		$qadm 		= $this->db->query("select username from login where idpengguna='A00001'")->row();


		$isiEmail = "Ada request booking ruangan baru dengan ID ".$id_request." dari Pegawai ".ucwords($qpegawai->nama_lengkap)." pada Portal Support di http://bi-andromeda.com/ Silahkan review request segera."; //ini isi emailnya

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
        $this->email->from('bi.andromeda2019@gmail.com', 'bi-andromeda.com | '.ucwords($qpegawai->nama_lengkap));  // Email dan nama pengirim        
        $this->email->to($qadm->username); // Email penerima
        //$this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png'); // Lampiran email, isi dengan url/path file
        $this->email->subject("ID Request ".$id_request); // Subject email
        $this->email->message($isiEmail);
        $this->email->send();  


        redirect(site_url('pegawai/ruangan/booking_status/status-booking'));

 		
    }

    function cek_ruangan(){
		$level 				= $this->session->userdata('level');
		$idPegawai			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idPegawai']	= $idPegawai;
		
        $ruangan = $this->Ruangan_model->getAll_booking();
		$data = array(
            'ruangan_data' => $ruangan,
            'view' =>'pegawai/request/ruangan/cek_ruangan'
        );

        $this->load->view('template', $data);

    }

	function booking_status(){
		$level 				= $this->session->userdata('level');
		$idPegawai			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idPegawai']	= $idPegawai;
		
        $ruangan = $this->Ruangan_model->getAll_byUser($idPegawai);
		$data = array(
            'ruangan_data' => $ruangan,
            'view' =>'pegawai/request/ruangan/status_user'
        );

        $this->load->view('template', $data);
		
	}

	public function detail_booking($id_request){
		$level 				= $this->session->userdata('level');
		$idPegawai			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idPegawai']	= $idPegawai;
		
        $ruangan = $this->Ruangan_model->__bookingList($id_request);
		$data = array(
            'ruangan_data' => $ruangan,
            'view' =>'pegawai/request/ruangan/detail_booking'
        );

        $this->load->view('template', $data);
	}

    public function booking_list($id_request){
		$level 				= $this->session->userdata('level');
		$idPegawai			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idPegawai']	= $idPegawai;
		
        $ruangan = $this->Ruangan_model->__bookingList($id_request);
		$data = array(
            'ruangan_data' => $ruangan,
            'view' =>'pegawai/request/ruangan/booking_list'
        );

        $this->load->view('template', $data);
    }
        
	function delete_booking($idBooking, $id_request){
        $row = $this->Ruangan_model->getByid_request($idBooking);
        if($row){
            $this->Ruangan_model->deleteIdRequest($idBooking);
			redirect(site_url('pegawai/ruangan/detail_booking/'.$id_request.'/delete'));
        }else{
            redirect(site_url('pegawai/ruangan/detail_booking/'.$id_request.'/detail-status'));
        }
	}	
}

/* End of file Request.php */
/* Location: ./application/controllers/pegawai/ruangan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-14 15:55:34 */
/* http://harviacode.com */