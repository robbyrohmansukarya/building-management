<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Eksekutor extends Login_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Eksekutor_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $eksekutor = $this->Eksekutor_model->get_all();

        $data = array(
            'eksekutor_data' => $eksekutor,
            'view' => 'eksekutor/eksekutor_list'
        );

        $this->load->view('template', $data);
    }

    public function read($id){
		$row = $this->Eksekutor_model->get_by_id($id);
		if($row){
			$data = array(
				'view' => 'eksekutor/eksekutor_read',
				'idpengguna' => $row->idpengguna,
				'nama_lengkap' => $row->nama_lengkap,
				'unit' => $row->unit,
				'alamat' => $row->alamat,
				'no_telp' => $row->no_telp,
				'photo' => $row->photo,
			);
            $this->load->view('template', $data);
        }else{
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('eksekutor'));
        }
    }

    public function create(){
        $data = array(
			'title' 		=> '<i class="fa fa-plus-square"></i> Tambah Eksekutor',
            'view' 			=> 'eksekutor/eksekutor_form',
            'action' 		=> site_url('admin/eksekutor/create_action'),
			'idpengguna' 	=> set_value('idpengguna'),
			'nama_lengkap' 	=> set_value('nama_lengkap'),
			'unit' 			=> set_value('unit'),
			'email' 		=> set_value('email'),
			'alamat' 		=> set_value('alamat'),
			'no_telp' 		=> set_value('no_telp'),
			'photo' 		=> set_value('photo'),
		);
        $this->load->view('template', $data);
    }
    
    public function create_action(){
		$photo				= $_FILES['photo']['tmp_name'];
		$nama_photo 		= $_FILES['photo']['name'];
		$nmphoto = '';
		
		$lastID	= $this->Eksekutor_model->cekLastId();
		$urut = (empty($lastID->maxs) ? 1 : $lastID->maxs += 1);
		$newId = 'E'.sprintf("%05s", $urut);

		if($nama_photo != ''){
			$tipe 				= $_FILES['photo']['type'];
			$extensi			= explode('.',$nama_photo);	
			$extension		 	= $extensi[1];				
			$nmphoto			= time().'.'.$extension;
			//copy($photo, "assets/dist/img/eksekutor/".$nmphoto);		
			
			if(($extension=="jpg")||($extension=="png")){
				copy($photo, "assets/dist/img/eksekutor/".$nmphoto);	
				
				$data = array(
					'idpengguna' 	=> $newId,
					'nama_lengkap' 	=> $this->input->post('nama_lengkap',TRUE),
					'unit' 			=> $this->input->post('unit',TRUE),
					'alamat' 		=> $this->input->post('alamat',TRUE),
					'no_telp' 		=> $this->input->post('no_telp',TRUE),
					'photo' 		=> $nmphoto,
				);
				$this->Eksekutor_model->insert($data);
				$this->Eksekutor_model->insert_akses($newId, $this->input->post('email',TRUE));
				
				//$this->session->set_flashdata('message', 'Create Record Success');
				redirect(site_url('admin/eksekutor/create/insert'));
			}else{
				redirect(site_url('admin/eksekutor/create/extension'));			
			}			
		}else{
			$nmphoto='';
			$data = array(
					'idpengguna' 	=> $newId,
					'nama_lengkap' 	=> $this->input->post('nama_lengkap',TRUE),
					'unit' 			=> $this->input->post('unit',TRUE),
					'alamat' 		=> $this->input->post('alamat',TRUE),
					'no_telp' 		=> $this->input->post('no_telp',TRUE),
					'photo' 		=> $nmphoto,
			);
			$this->Eksekutor_model->insert($data);
			$this->Eksekutor_model->insert_akses($newId, $this->input->post('email',TRUE));
			
			//$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('admin/eksekutor/create/insert'));
							
		}//end else	
    }
    
    public function update($id){
        $row = $this->Eksekutor_model->get_by_id($id);
        if($row){
			$qLogin = $this->Eksekutor_model->get_akses($row->idpengguna);
			$data = array(
				'title' 		=> '<i class="fa fa-edit"></i> Update Eksekutor',
				'view' 			=> 'eksekutor/eksekutor_form',
				'action' 		=> site_url('admin/eksekutor/update_action'),
				'idpengguna' 	=> set_value('idpengguna', $row->idpengguna),
				'nama_lengkap' 	=> set_value('nama_lengkap', $row->nama_lengkap),
				'unit'	 		=> set_value('unit', $row->unit),
				'email'			=> set_value('email', $qLogin->username),
				'alamat' 		=> set_value('alamat', $row->alamat),
				'no_telp' 		=> set_value('no_telp', $row->no_telp),
				'photo' 		=> set_value('photo', $row->photo),			
			);
			$this->load->view('template', $data);
		}else{
			//$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('admin/eksekutor'));
		}
    }
    
    public function update_action(){
		$photo				= $_FILES['photo']['tmp_name'];
		$nama_photo 		= $_FILES['photo']['name'];
		$nmphoto = '';
		
		$idpengguna			= $this->input->post('idpengguna', TRUE);

		if($nama_photo != ''){
			$tipe 				= $_FILES['photo']['type'];
			$extensi			= explode('.',$nama_photo);	
			$extension		 	= $extensi[1];				
			$nmphoto			= time().'.'.$extension;
			//copy($photo, "assets/dist/img/eksekutor/".$nmphoto);		
			
			if(($extension=="jpg")||($extension=="png")){
				//ambil photo lama kemudian hapus di directori
				$row = $this->Eksekutor_model->get_by_id($idpengguna);
				if($row->photo != ''){
					unlink("assets/dist/img/eksekutor/".$row->photo);
				}

				copy($photo, "assets/dist/img/eksekutor/".$nmphoto);		
				
				$data = array(
					'nama_lengkap' 	=> $this->input->post('nama_lengkap',TRUE),
					'unit' 			=> $this->input->post('unit',TRUE),
					'alamat' 		=> $this->input->post('alamat',TRUE),
					'no_telp' 		=> $this->input->post('no_telp',TRUE),
					'photo' 		=> $nmphoto,
				);
				$this->Eksekutor_model->update($idpengguna, $data);
				$this->Eksekutor_model->update_akses_log($idpengguna, $this->input->post('email',TRUE));
		
				redirect(site_url('admin/eksekutor/update/'.$idpengguna.'/success'));
				
			}else{
				redirect(site_url('admin/eksekutor/update/'.$idpengguna.'/extension'));
			}			
		}else{
			$nmphoto='';
				$data = array(
					'nama_lengkap' 	=> $this->input->post('nama_lengkap',TRUE),
					'unit' 			=> $this->input->post('unit',TRUE),
					'alamat' 		=> $this->input->post('alamat',TRUE),
					'no_telp' 		=> $this->input->post('no_telp',TRUE),
				);
				$this->Eksekutor_model->update($idpengguna, $data);
				$this->Eksekutor_model->update_akses_log($idpengguna, $this->input->post('email',TRUE));			
				redirect(site_url('admin/eksekutor/update/'.$idpengguna.'/success'));
							
		}//end else	

    }

	function ubah_pwd($idpengguna){
        $row = $this->Eksekutor_model->get_akses($idpengguna);
		
		$data = array(
			'password' => md5($idpengguna),
		);

		$this->Eksekutor_model->update_akses($idpengguna, $row->username, $data);
		$this->session->set_flashdata('message', 'Update Record Success');
		redirect(site_url('eksekutor/read/'.$idpengguna.'/success'));
	}
    
    public function delete($id){
        $row = $this->Eksekutor_model->get_by_id($id);
        if($row){
			if($row->photo != ''){
				unlink("assets/dist/img/eksekutor/".$row->photo);
			}
            $this->Eksekutor_model->delete($id);
			$this->Eksekutor_model->delete_request($id);
			$this->Eksekutor_model->delete_progres($id);
            $this->Eksekutor_model->delete_login($id);
            //$this->session->set_flashdata('message', 'Delete Record Success');
            //redirect(site_url('eksekutor'));
			redirect(site_url('admin/eksekutor/index/delete'));
        }else{
            //$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/eksekutor'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('unit', 'unit', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('photo', 'photo', 'trim|required');

	$this->form_validation->set_rules('idpengguna', 'idpengguna', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=eksekutor.doc");

        $data = array(
            'eksekutor_data' => $this->Eksekutor_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('eksekutor/eksekutor_doc',$data);
    }
	
}

/* End of file Eksekutor.php */
/* Location: ./application/controllers/Eksekutor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-13 06:16:53 */
/* http://harviacode.com */