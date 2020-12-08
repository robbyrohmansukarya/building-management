<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Barang extends Login_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Barang_model');
		$this->load->model('login_model');
        $this->load->library('form_validation');
    }

    public function index(){
		$level 				= $this->session->userdata('level');
		$idPegawai			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idPegawai']	= $idPegawai;
		
        $ruangan = $this->Barang_model->get_all();
		$data = array(
            'barang_data' => $ruangan,
            'view' =>'pegawai/request/barang/barang_list'
        );

        $this->load->view('template', $data);
    }
	public function help(){
		$data = array(
            'view' =>'pegawai/request/barang/help_barang'
        );

        $this->load->view('template', $data);		
	}
	
    public function daftar(){
		$level 				= $this->session->userdata('level');
		$idPegawai			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idPegawai']	= $idPegawai;
		
        $pinjam = $this->Barang_model->get_pinjamGroupByIdrequest($idPegawai);
		$data = array(
            'pinjam_data' => $pinjam,
            'view' =>'pegawai/request/barang/pinjam_list'
        );
        $this->load->view('template', $data);
    }
    
    public function detail_peminjaman($id_request){
        $level              = $this->session->userdata('level');
        $idPegawai          = $this->session->userdata('idpengguna');
        $data['level']      = $level;
        $data['idPegawai']  = $idPegawai;
        
        //$pinjam = $this->Barang_model->get_pinjam($idPegawai);
        $pinjam = $this->Barang_model->get_pinjamDetail($idPegawai, $id_request);
        $data = array(
            'pinjam_data' => $pinjam,
            'view' =>'pegawai/request/barang/detail_pinjam_list'
        );
        $this->load->view('template', $data);

    }

    public function baru(){
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idpengguna']	= $idpengguna ;
		
		$data = array(
            'view' 			=> 'pegawai/request/barang/pinjam_form',
            'title' 		=> '<i class="fa fa-edit"></i><h3 class="box-title"> Pinjam Barang</h3>',
            'action' 		=> site_url('pegawai/barang/pinjam_action'),
            'barang' 		=> $this->Barang_model->get_allNotEmpty(),
            'kode_barang'	=> set_value('kode_barang'),
            'jumlah'        => set_value('jumlah'),
			'id_request' 	=> set_value('id_request'),
			'tanggal_pinjam' => set_value('tanggal_pinjam'),
			'tanggal_kembali' => set_value('tanggal_kembali'),
		);


        $this->load->view('template', $data);
    }

    function pinjam_action(){
        $level              = $this->session->userdata('level');
        $idpengguna         = $this->session->userdata('idpengguna');
       
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_request = date('Y-m-d H:i:s');
        
        $id_request = date('YmdHis');

        $kode_barangs  = $this->input->post('kode_barang',TRUE);
        $Qtys          = $this->input->post('jumlah',TRUE);
        $sukses        = FALSE;
        foreach ($kode_barangs as $key => $value){
            $kode_barang = "{$value}";
            $qty         = $Qtys[$key];

            $qStok = $this->db->query("select stok from barang where kode_barang='".$kode_barang."'")->row();

            //kalau qty lebih dari stok maka qty diisi stok yang ada    
            if($qty > $qStok->stok){
                $qty = $qStok->stok;
            } 
            //echo $kode_barang.'<br />';
            //echo $qty.'<br />';
            $data = array(
                'id_request'        => $id_request,
                'idpengguna'        => $idpengguna,
                'kode_barang'       => $kode_barang,
                'qty'               => $qty,
                'tanggal_request'   => $tanggal_request,
                'tanggal_peminjaman'    => $this->input->post('tanggal_pinjam',TRUE),
                'tanggal_pengembalian'  => $this->input->post('tanggal_kembali',TRUE),
                'verifikasi'        => 0,
                'keterangan'        => '',           
                'baca_admin'        => '0000-00-00 00:00:00',
                'sts_baca_admin'    => 0
            );
            if(($kode_barang !='') && ($qty !='') && ($qty !=0)){
                $this->Barang_model->insert_peminjaman($data);
                $this->Barang_model->update_stokBarang($kode_barang, $qty);
            }
        }
        
        $qpegawai   = $this->db->query("select nama_lengkap from pegawai where idpengguna='".$idpengguna."'")->row();
        $qlog       = $this->db->query("select username as email from login where idpengguna='".$idpengguna."'")->row();
        $qadm       = $this->db->query("select username from login where idpengguna='A00001'")->row();

        $isiEmail = "Ada request peminjaman baru baru dengan ID ".$id_request." dari Pegawai ".ucwords($qpegawai->nama_lengkap)." pada Portal Support di http://bi-andromeda.com/ Silahkan review request segera."; //ini isi emailnya

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


                
        redirect(site_url('pegawai/barang/baru/insert'));

    }

    public function delete_peminjaman($id_request){
        $row = $this->Barang_model->get_by_idrequest($id_request);
        if($row){
            $this->Barang_model->delete_peminjaman($id_request);
            redirect(site_url('pegawai/barang/daftar/delete'));
        }else{
            redirect(site_url('pegawai/barang/daftar'));
        }
    }
    public function delete_Reqbarang($id, $id_request){
        $row = $this->Barang_model->reqGetBy_id($id);
        if($row){
            $this->Barang_model->delete_peminjaman_byId($id);
            redirect(site_url('pegawai/barang/detail_peminjaman/'.$id_request.'/delete'));
        }else{
            redirect(site_url('pegawai/barang/detail_peminjaman/'.$id_request));
        }
    }


    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=request.doc");

        $data = array(
            'request_data' => $this->Barang_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('request/request_doc',$data);
    }

}

/* End of file barang.php */
/* Location: ./application/controllers/pegawai/barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-25 15:55:34 */
/* http://harviacode.com */