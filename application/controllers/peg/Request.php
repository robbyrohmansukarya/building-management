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
		$idpengguna			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idpengguna']	= $idpengguna ;
		
        $request = $this->Request_model->get_all();
        $data = array(
            'request_data' => $request,
            'view' => $level.'/request/request_list'
        );

        $this->load->view('template', $data);
    }
    public function create(){
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idpengguna']	= $idpengguna ;
		//$table 				= $this->keamanan->table_pengguna($level);
        
		$data = array(
            'view' 			=> $level.'/request/request_form',
            'action' 		=> site_url($level.'/request/create_action'),
            'kategori' 		=> $this->Request_model->get_allKategori(),
			'id_request' 	=> set_value('id_request'),
			'id_kategori' 	=> set_value('id_kategori'),
			'id_klasifikasi'=> set_value('id_klasifikasi'),
			'idpengguna' 	=> set_value('idpengguna'),
			'request' 		=> set_value('request'),
			'deskripsi_request' => set_value('deskripsi_request'),
			'baca_admin' 	=> set_value('baca_admin'),
			'baca_eksekutor'=> set_value('baca_eksekutor'),
			'sts_baca_admin'=> set_value('sts_baca_admin'),
			'sts_baca_eksekutor'=> set_value('sts_baca_eksekutor'),
			'sts_eksekusi' 		=> set_value('sts_eksekusi'),
		);
        $this->load->view('template', $data);
    }
    public function create_action(){
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');

        $this->_rules();
		
        if($this->form_validation->run() == FALSE) {
            redirect(site_url($level.'/request/create/add'));
        }else{
			date_default_timezone_set('Asia/Jakarta');
			$tanggal_request = date('Y-m-d H:i:s');
			//cek banyak ticket.. 
			$banyakRequest	= $this->Request_model->cekbanyak('request');
			$urut = (empty($banyakRequest) ? 1 : $banyakRequest += 1);
			$id_request = date('md').sprintf("%04s", $urut);

            $data = array(
				'id_request'	=> $id_request,
				'id_kategori' 	=> $this->input->post('id_kategori',TRUE),
				'id_klasifikasi'=> 0,
				'idpengguna' 	=> $idpengguna,
				'request' 		=> $this->keamanan->post($this->input->post('request',TRUE)),
				'deskripsi_request' => $this->keamanan->post($this->input->post('deskripsi_request',TRUE)),
				'tanggal_request' 	=> $tanggal_request,
				'baca_admin' 		=> '0000-00-00 00:00:00',
				'baca_eksekutor' 	=> '0000-00-00 00:00:00',
				'sts_baca_admin' 	=> 0,
				'sts_baca_eksekutor'=> 0,
				'sts_eksekusi' 		=> 0,
			);
            $this->Request_model->insert($data);
            //$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url($level.'/request/success/add'));
        }
    }
	public function success($param){
		$level 				= $this->session->userdata('level');
		$idpengguna			= $this->session->userdata('idpengguna');
		$data['level']		= $level;
		$data['idpengguna']	= $idpengguna ;
		$data['param']	= $param;
		$data['view']		= $level.'/success';
		$data['title']		='Success';
			$this->load->view('template', $data);
	}

    public function read($id) 
    {
        $row = $this->Request_model->get_by_id($id);
        if ($row) {
            $data = array(
                'view' => 'request/request_read',
		'id_request' => $row->id_request,
		'id_kategori' => $row->id_kategori,
		'id_klasifikasi' => $row->id_klasifikasi,
		'idpengguna' => $row->idpengguna,
		'request' => $row->request,
		'deskripsi_request' => $row->deskripsi_request,
		'baca_admin' => $row->baca_admin,
		'baca_eksekutor' => $row->baca_eksekutor,
		'sts_baca_admin' => $row->sts_baca_admin,
		'sts_baca_eksekutor' => $row->sts_baca_eksekutor,
		'sts_eksekusi' => $row->sts_eksekusi,
	 );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('request'));
        }
    }
        
    public function update($id) 
    {
        $row = $this->Request_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
				'view' => 'request/request_form',
                'action' => site_url('request/update_action'),
		'id_request' => set_value('id_request', $row->id_request),
		'id_kategori' => set_value('id_kategori', $row->id_kategori),
		'id_klasifikasi' => set_value('id_klasifikasi', $row->id_klasifikasi),
		'idpengguna' => set_value('idpengguna', $row->idpengguna),
		'request' => set_value('request', $row->request),
		'deskripsi_request' => set_value('deskripsi_request', $row->deskripsi_request),
		'baca_admin' => set_value('baca_admin', $row->baca_admin),
		'baca_eksekutor' => set_value('baca_eksekutor', $row->baca_eksekutor),
		'sts_baca_admin' => set_value('sts_baca_admin', $row->sts_baca_admin),
		'sts_baca_eksekutor' => set_value('sts_baca_eksekutor', $row->sts_baca_eksekutor),
		'sts_eksekusi' => set_value('sts_eksekusi', $row->sts_eksekusi),
	
				);
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('request'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_request', TRUE));
        } else {
            $data = array(
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'id_klasifikasi' => $this->input->post('id_klasifikasi',TRUE),
		'idpengguna' => $this->input->post('idpengguna',TRUE),
		'request' => $this->input->post('request',TRUE),
		'deskripsi_request' => $this->input->post('deskripsi_request',TRUE),
		'baca_admin' => $this->input->post('baca_admin',TRUE),
		'baca_eksekutor' => $this->input->post('baca_eksekutor',TRUE),
		'sts_baca_admin' => $this->input->post('sts_baca_admin',TRUE),
		'sts_baca_eksekutor' => $this->input->post('sts_baca_eksekutor',TRUE),
		'sts_eksekusi' => $this->input->post('sts_eksekusi',TRUE),
	    );

            $this->Request_model->update($this->input->post('id_request', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('request'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Request_model->get_by_id($id);

        if ($row) {
            $this->Request_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('request'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('request'));
        }
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