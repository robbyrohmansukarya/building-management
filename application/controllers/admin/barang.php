<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends Login_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $barang = $this->Barang_model->get_all();

        $data = array(
            'barang_data' => $barang,
            'view' => 'barang/barang_list'
        );		
        $this->load->view('template', $data);
    }

    public function inbox(){
        $pinjam = $this->Barang_model->get_pinjamAdm();

        $data = array(
            'pinjam_data' => $pinjam,
            'view' => 'barang/inbox_list'
        );
		
        $this->load->view('template', $data);
    }

    public function tracking(){
        $pinjam = $this->Barang_model->getTracking();

        $data = array(
            'pinjam_data' => $pinjam,
            'view' => 'barang/tracking_list'
        );
        $this->load->view('template', $data);

    }
    public function tracking_detail($kode_barang){
        $pinjam = $this->Barang_model->get_pinjamByKode($kode_barang);
		$barang = $this->Barang_model->get_by_id($kode_barang);
        $data = array(
            'nama_barang' 	=> $barang->nama_barang,
            'pinjam_data' 	=> $pinjam,
            'view' 			=> 'barang/tracking_detail'
        );		
        $this->load->view('template', $data);

    }

	public function detail_peminjaman($id_request){
		$this->_baca_admin($id_request);
        $pinjam = $this->Barang_model->get_by_idrequest($id_request);
        $info = $this->Barang_model->get_reqLimit($id_request);

        $data = array(
            'info' => $info,
            'pinjam_data' => $pinjam,
            'id_request' => $id_request,
            'action' => 'admin/barang/verifikasi/'.$id_request,
            'view' => 'barang/detail_peminjaman'
        );
        $this->load->view('template', $data);
	}    
	
	function verifikasi($id_request){

  		$data = array(
			'verifikasi'	=> $this->input->post('verifikasi',TRUE),
		);
		$this->Barang_model->verifikasi($id_request, $data);
		redirect(site_url('admin/barang/detail_peminjaman/'.$id_request.'/success'));	}    

    public function create(){
		
		$lastID	= $this->Barang_model->cekLastId();
		$urut = (empty($lastID->maxs) ? 1 : $lastID->maxs += 1);
		$newId = 'B'.sprintf("%05s", $urut);

		$data = array(
			'view' 			=> 'barang/barang_form',
			'title' 		=> '<i class="fa fa-plus-square"></i> Tambah Barang',
			'action' 		=> site_url('admin/barang/create_action'),
			'kode_barang' 	=> $newId,
			'nama_barang' 	=> set_value('nama_barang'),
			'keterangan' 	=> set_value('keterangan'),
			'jumlah_stok' 	=> set_value('jumlah_stok')
		);
        $this->load->view('template', $data);
    }
    
    public function create_action(){
		
		$lastID	= $this->Barang_model->cekLastId();
		$urut = (empty($lastID->maxs) ? 1 : $lastID->maxs += 1);
		$newId = 'B'.sprintf("%05s", $urut);
		
		$data = array(
			'kode_barang'	=> $newId,
			'nama_barang'	=> $this->input->post('nama_barang',TRUE),
			'keterangan'	=> $this->input->post('keterangan',TRUE),
			'jumlah_stok'	=> $this->input->post('jumlah_stok',TRUE),
			'stok'			=> $this->input->post('jumlah_stok',TRUE)
		);

		$this->Barang_model->insert($data);
		redirect(site_url('admin/barang'));
			
    }
    
    public function update($id){
        $row = $this->Barang_model->get_by_id($id);
        
		if($row){
			$data = array(
				'title' 		=> '<i class="fa fa-edit"></i> Update Barang',
				'view' 			=> 'barang/barang_form',
				'action' 		=> site_url('admin/barang/update_action'),
				'kode_barang' 	=> set_value('kode_barang', $row->kode_barang),
				'nama_barang' 	=> set_value('nama_barang', $row->nama_barang),
				'keterangan' 	=> set_value('keterangan', $row->keterangan),
				'jumlah_stok' 	=> set_value('jumlah_stok', $row->jumlah_stok),
			);
			$this->load->view('template', $data);
        }else{
            redirect(site_url('admin/barang'));
        }
    }

    public function update_action(){
		
		$kode_barang			= $this->input->post('kode_barang', TRUE);
		
		$data = array(
			'nama_barang'	=> $this->input->post('nama_barang',TRUE),
			'keterangan'	=> $this->input->post('keterangan',TRUE),
			'jumlah_stok'	=> $this->input->post('jumlah_stok',TRUE),
			'stok'			=> $this->input->post('jumlah_stok',TRUE)
		);
		$this->Barang_model->update($kode_barang, $data);
		redirect(site_url('admin/barang/update/'.$kode_barang.'/success'));
    }
    
    public function delete($id){
        $row = $this->Barang_model->get_by_id($id);
        if($row){
            $this->Barang_model->delete($id);
            $this->Barang_model->deleteByKodeBarang($id);

			redirect(site_url('admin/barang/index/delete'));
        }else{
            redirect(site_url('admin/barang'));
        }
    }
    public function delete_peminjaman($id_request){
        $row = $this->Barang_model->get_by_idrequest($id_request);
        if($row){
            $this->Barang_model->delete_peminjaman($id_request);
			redirect(site_url('admin/barang/inbox/delete'));
        }else{
            redirect(site_url('admin/barang/inbox'));
        }
    }
	function _baca_admin($id_request){
		date_default_timezone_set('Asia/Jakarta');
		$wkt	= date('Y-m-d h:i:s');

		$data = array(
			'baca_admin' =>$wkt,
			'sts_baca_admin' =>1	
		);
		$this->Barang_model->baca($id_request, $data);
	}

    public function _rules(){
		$this->form_validation->set_rules('kode_barang', 'kode_barang', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan barang', 'trim|required');
		$this->form_validation->set_rules('jumlah_barang', 'jumlah barang', 'trim|required');
		//$this->form_validation->set_rules('email', 'alamat', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function cetak($id_request)
    {
		/*
        $data = array(
	        'pinjam' 	=> $this->Barang_model->get_by_idrequest($id_request),
    	    'info' 		=> $this->Barang_model->get_reqLimit($id_request),
            'start' => 0
        );
		*/
		$this->load->library('cfpdf');		
		$pdf = new FPDF('P','mm','A5');
		$pdf->SetMargins(10, 10, 10,0);		
		$pdf->AddPage();

				
		//$this->fpdf->Image('assets/direktori/images/logo-baru-warna.jpg', 10, 10, 0, 0);
		//Geser ke kanan
		//$this->fpdf->Cell(40);

		//inquery data
		$pinjam_data 	= $this->Barang_model->get_by_idrequest($id_request);
		$info			= $this->Barang_model->get_reqLimit($id_request);
		$qpegawai 		= $this->db->query("select * from pegawai where idpengguna='".$info->idpengguna."'");
		$cekPegawai 	= $qpegawai->num_rows();

		$pegawaiName = '';
		$sts = '';	
		
		if($qpegawai->num_rows() > 0){
			$pegawai = $qpegawai->row();
			$jabatan = $pegawai->jabatan;
			$pegawaiName = ucwords($pegawai->nama_lengkap).' / '.$jabatan;
		}
		else{
			$jabatan = '';
			$peagwaiName = 'Pegawai Tidak Terdaftar';
		}
		$tanggal_peminjaman		= $this->tanggal->konversi($info->tanggal_peminjaman);
		$tanggal_pengembalian	= $this->tanggal->konversi($info->tanggal_pengembalian);
		if($info->verifikasi==1){
			$sts = 'Dipinjamkan';
		}
		else if($info->verifikasi==2){
			$sts = 'Diambil';
		}
		else{
			$sts = 'Menunggu';
		}

		$pdf->SetFont('Arial','B', 14);
		$pdf->Image('assets/dist/img/bi_logo.png', 10, 18, 0, 0);
		$pdf->Cell(130, 25, 'BUKTI PENGAMBILAN BARANG', 0, 1, 'C');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(130, 12, 'DATA PEMINJAMAN', 1, 1, 'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40, 7, 'Peminjam', 1, 0, 'L');
		$pdf->Cell(90, 7, $pegawaiName, 1, 1, 'L');
		$pdf->Cell(40, 7, 'Tanggal Pinjam', 1, 0, 'L');
		$pdf->Cell(90, 7, $tanggal_peminjaman, 1, 1, 'L');
		$pdf->Cell(40, 7, 'Tanggal Kembali', 1, 0, 'L');
		$pdf->Cell(90, 7, $tanggal_pengembalian, 1, 1, 'L');
		$pdf->Cell(40, 7, 'Status', 1, 0, 'L');
		$pdf->Cell(90, 7, $sts, 1, 1, 'L');
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(130, 12, 'DATA BARANG', 1, 1, 'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25, 7, 'Kode', 1, 0, 'C');
		$pdf->Cell(90, 7, 'Nama Barang', 1, 0, 'C');
		$pdf->Cell(15, 7, 'Qty', 1, 1, 'C');
		foreach($pinjam_data as $row)
		{
			if($row->verifikasi==1){
				$sts = 'Dipinjamkan';
			}
			else if($row->verifikasi==2){
				$sts = 'Diambil';
			}
			else{
				$sts = 'Menunggu';
			}
			$pdf->Cell(25, 7, $row->kode_barang, 1, 0, 'C');
			$pdf->Cell(90, 7, ucwords($row->nama_barang), 1, 0, 'C');
			$pdf->Cell(15, 7, $row->qty, 1, 1, 'C');
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(65, 12, 'Diambil Oleh', 0, 0, 'L');
		$pdf->Cell(65, 12, 'Diketahui Oleh', 0, 1, 'R');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(130, 12, 'Catatan:', 0, 1, 'L');

		$pdf->Output();
		
    }

}

/* End of file Barang.php */
/* Location: ./application/controllers/admin/Barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-13 18:39:50 */
/* http://harviacode.com */