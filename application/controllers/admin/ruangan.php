<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruangan extends Login_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Ruangan_model');
        $this->load->library('form_validation');
    }

    //MASTER DATA
    public function index(){
        $ruangan = $this->Ruangan_model->get_all();

        $data = array(
            'ruangan_data' => $ruangan,
            'view' => 'ruangan/ruangan_list'
        );
		
        $this->load->view('template', $data);
    }


    public function create(){
		
		$lastID	= $this->Ruangan_model->cekLastId();
		$urut = (empty($lastID->maxs) ? 1 : $lastID->maxs += 1);
		$newId = 'R'.sprintf("%05s", $urut);

		$data = array(
			'view' 			=> 'ruangan/ruangan_form',
			'title' 		=> '<i class="fa fa-plus-square"></i> Tambah Data Ruangan',
			'action' 		=> site_url('admin/ruangan/create_action'),
			'kode_ruangan' 	=> $newId,
			'nama_ruangan' 	=> set_value('nama_ruangan'),
			'keterangan' 	=> set_value('keterangan'),
		);
        $this->load->view('template', $data);
    }
    
    public function create_action(){
		
		$lastID	= $this->Ruangan_model->cekLastId();
		$urut = (empty($lastID->maxs) ? 1 : $lastID->maxs += 1);
		$newId = 'R'.sprintf("%05s", $urut);
		
		$data = array(
			'kode_ruangan'	=> $newId,
			'nama_ruangan'	=> $this->input->post('nama_ruangan',TRUE),
			'keterangan'	=> $this->input->post('keterangan',TRUE),
		);

		$this->Ruangan_model->insert($data);
		redirect(site_url('admin/ruangan/index/insert'));
			
    }
    
    public function update($id){
        $row = $this->Ruangan_model->get_by_id($id);
        
		if($row){
			$data = array(
				'title' 		=> '<i class="fa fa-edit"></i> Update Ruangan',
				'view' 			=> 'ruangan/ruangan_form',
				'action' 		=> site_url('admin/ruangan/update_action'),
				'kode_ruangan' 	=> set_value('kode_ruangan', $row->kode_ruangan),
				'nama_ruangan' 	=> set_value('nama_ruangan', $row->nama_ruangan),
				'keterangan' 	=> set_value('keteragan', $row->keterangan),
			);
			$this->load->view('template', $data);
        }else{
            redirect(site_url('admin/ruangan'));
        }
    }
    
    public function update_action(){
		
		$kode_ruangan			= $this->input->post('kode_ruangan', TRUE);
		
		$data = array(
			'nama_ruangan'	=> $this->input->post('nama_ruangan',TRUE),
			'keterangan'	=> $this->input->post('keterangan',TRUE),
		);
		$this->Ruangan_model->update($kode_ruangan, $data);
		redirect(site_url('admin/ruangan/update/'.$kode_ruangan.'/success'));
    }
    
    public function delete($id){
        $row = $this->Ruangan_model->get_by_id($id);
        if($row){
            $this->Ruangan_model->delete($id);
            $this->Ruangan_model->delete_reqRuagan($id);
			redirect(site_url('admin/ruangan/index/delete'));
        }else{
            redirect(site_url('admin/ruangan'));
        }
    }
    public function delete_request($id_request){
        $row = $this->Ruangan_model->getByRequest($id_request);
        if($row){
            $this->Ruangan_model->deleteByRequest($id_request);
			redirect(site_url('admin/ruangan/daftar_booking/delete'));
        }else{
            redirect(site_url('admin/ruangan/daftar_booking'));
        }
    }
 
    public function inbox(){
        $ruangan = $this->Ruangan_model->get_bookingInbox();

        $data = array(
            'ruangan_data' => $ruangan,
            'view' => 'admin/booking/inbox_booking'
        );
        
        $this->load->view('template', $data);
    }
	
    public function daftar_booking(){
        $ruangan = $this->Ruangan_model->get_daftarUnForward();

        $data = array(
            'ruangan_data' => $ruangan,
            'view' => 'admin/booking/daftar_booking'
        );
        
        $this->load->view('template', $data);
    }
    public function forward($id_request){
        $this->_baca_admin($id_request);
        $ruangan     = $this->Ruangan_model->get_by_idrequest($id_request);
        $info       = $this->Ruangan_model->get_reqLimit($id_request);

        $data = array(
            'info'          => $info,
            'ruangan_data'   => $ruangan,
            'id_request'   => $id_request,
            'action'        => 'admin/ruangan/forward_action/'.$id_request,
            'view'          => 'admin/booking/forward_booking'
        );
        
        $this->load->view('template', $data);
    }  	
	  
    public function forward_action($id_request){
		$flag_fwd			= $this->input->post('flag_fwd', TRUE);
		$sts_eksekusi		= $this->input->post('sts_eksekusi', TRUE);
		$qEksekutor			= $this->db->query("select eksekutor.idpengguna, login.username from eksekutor left join login on eksekutor.idpengguna = login.idpengguna order by eksekutor.idpengguna asc")->result();
		$cek_table_forward	= $this->db->query("select id_request from request_ruangan_forward where id_request='".$id_request."'")->num_rows();
        
        $data = array(
            'flag_fwd' =>$flag_fwd,
            'sts_eksekusi' =>$sts_eksekusi    
        );

		if($cek_table_forward <= 0){

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

			foreach($qEksekutor as $row){


				$data_eksekutor = array(
					'id_request' 	=>$id_request,
					'ideksekutor' 	=>$row->idpengguna,    
				);
				//FORWARD KE SEMUA EKSEKUTOR	
				$this->Ruangan_model->insert_forward($data_eksekutor);

                // echo $row->idpengguna. ' email : '.$row->username;
                // echo "<br>";

                $isiEmail = "Ada request booking ruangan baru dengan ID ".$id_request." dari Admin pada Portal Support di http://bi-andromeda.com/ Silahkan review request segera.";

                $this->email->to($row->username); // Email penerima
                $this->email->subject("ID Request ".$id_request); // Subject email
                $this->email->message($isiEmail);
                $this->email->send();


			}
		}

		//update tabel request_ruangan ubah status flag_fwd dan sts_eksekusi
		$this->Ruangan_model->baca($id_request, $data);
		redirect(site_url('admin/ruangan/forward/'.$id_request.'/success/detail-request'));
    }    

    public function status_eksekutor(){
        $ruangan = $this->Ruangan_model->get_daftarForward();

        $data = array(
            'ruangan_data' => $ruangan,
            'view' => 'admin/booking/status_eksekutor'
        );
        
        $this->load->view('template', $data);
    }

    public function detail_sts_eksekutor($id_request){
        //$pinjam     = $this->Ruangan_model->get_by_idrequest($id_request);
        $qforward	= $this->db->query("select 
											eksekutor.unit, request_ruangan_forward.sts_eksekusi,
                                            request_ruangan_forward.foto, request_ruangan_forward.id 
											from eksekutor, request_ruangan_forward
											where eksekutor.idpengguna=request_ruangan_forward.ideksekutor
											and id_request=$id_request 
											order by request_ruangan_forward.sts_eksekusi asc")->result();
		$info       = $this->Ruangan_model->get_reqLimit($id_request);

        $data = array(
            'info'          => $info,
            'qforward'      => $qforward,
            'id_request'    => $id_request,
            'action'        => 'admin/ruangan/sts_eksekutor_action/'.$id_request,
            'view'          => 'admin/booking/detail_status_eksekutor'
        );
        
        $this->load->view('template', $data);
    }  	
    public function sts_eksekutor_action($id_request){
		$sts_eksekusi		= $this->input->post('sts_eksekusi', TRUE);
        $data = array(
            'sts_eksekusi' =>$sts_eksekusi    
        );

		//update tabel request_ruangan ubah status sts_eksekusi
		$this->Ruangan_model->baca($id_request, $data);
		redirect(site_url('admin/ruangan/detail_sts_eksekutor/'.$id_request.'/success/detail-status-eksekutor'));
    }    

    function _baca_admin($id_request){
        date_default_timezone_set('Asia/Jakarta');
        $wkt    = date('Y-m-d h:i:s');

        $data = array(
            'baca_admin' =>$wkt,
            'sts_baca_admin' =>1    
        );
        $this->Ruangan_model->baca($id_request, $data);
    }

   public function photo($id_request, $id){
        $q      = $this->db->query("select foto from request_ruangan_forward where id=$id")->row();
        $data = array(
           'view'          => 'admin/booking/link_pic',
           'id_request'    => $id_request,
           'photo'         => $q->foto
        );
        $this->load->view('template', $data);
    }


    public function _rules(){
		$this->form_validation->set_rules('kode_barang', 'kode_barang', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
		$this->form_validation->set_rules('jumlah_barang', 'jumlah barang', 'trim|required');
		//$this->form_validation->set_rules('email', 'alamat', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=barang.doc");

        $data = array(
            'pegawai_data' => $this->Ruangan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('barang/barang_doc',$data);
    }

}

/* End of file Ruangan.php */
/* Location: ./application/controllers/admin/Ruangan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-13 18:39:50 */
/* http://harviacode.com */