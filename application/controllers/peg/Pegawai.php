<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $pegawai = $this->Pegawai_model->get_all();

        $data = array(
            'pegawai_data' => $pegawai,
            'view' => 'pegawai/pegawai_list'
        );

        $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->Pegawai_model->get_by_id($id);
        if ($row) {
            $data = array(
                'view' => 'pegawai/pegawai_read',
		'idpengguna' => $row->idpengguna,
		'nama_lengkap' => $row->nama_lengkap,
		'alamat' => $row->alamat,
		'no_telp' => $row->no_telp,
		'email_pegawai' => $row->email_pegawai,
		'foto_pegawai' => $row->foto_pegawai,
	 );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function create() 
    {
        $data = array(
            'view' => 'pegawai/pegawai_form',
            'button' => 'Create',
            'action' => site_url('pegawai/create_action'),
	    'idpengguna' => set_value('idpengguna'),
	    'nama_lengkap' => set_value('nama_lengkap'),
	    'alamat' => set_value('alamat'),
	    'no_telp' => set_value('no_telp'),
	    'email_pegawai' => set_value('email_pegawai'),
	    'foto_pegawai' => set_value('foto_pegawai'),
	);
        $this->load->view('template', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'email_pegawai' => $this->input->post('email_pegawai',TRUE),
		'foto_pegawai' => $this->input->post('foto_pegawai',TRUE),
	    );

            $this->Pegawai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pegawai'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
				'view' => 'pegawai/pegawai_form',
                'action' => site_url('pegawai/update_action'),
		'idpengguna' => set_value('idpengguna', $row->idpengguna),
		'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
		'alamat' => set_value('alamat', $row->alamat),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'email_pegawai' => set_value('email_pegawai', $row->email_pegawai),
		'foto_pegawai' => set_value('foto_pegawai', $row->foto_pegawai),
	
				);
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idpengguna', TRUE));
        } else {
            $data = array(
		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'email_pegawai' => $this->input->post('email_pegawai',TRUE),
		'foto_pegawai' => $this->input->post('foto_pegawai',TRUE),
	    );

            $this->Pegawai_model->update($this->input->post('idpengguna', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pegawai'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $this->Pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('email_pegawai', 'email pegawai', 'trim|required');
	$this->form_validation->set_rules('foto_pegawai', 'foto pegawai', 'trim|required');

	$this->form_validation->set_rules('idpengguna', 'idpengguna', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pegawai.xls";
        $judul = "pegawai";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Lengkap");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Telp");
	xlsWriteLabel($tablehead, $kolomhead++, "Email Pegawai");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto Pegawai");

	foreach ($this->Pegawai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email_pegawai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto_pegawai);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pegawai.doc");

        $data = array(
            'pegawai_data' => $this->Pegawai_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pegawai/pegawai_doc',$data);
    }

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-13 18:39:50 */
/* http://harviacode.com */