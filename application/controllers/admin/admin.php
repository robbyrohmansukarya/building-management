<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
    }

    public function index(){
		$this->daftar();
    }
	
	public function daftar(){
        $admin = $this->Admin_model->get_all();
        $data = array(
            'admin_data' => $admin,
            'view' => 'admin/admin_list'
        );
        $this->load->view('template', $data);
	}
	
    public function read($id){
		$row = $this->Admin_model->get_by_id($id);
		if ($row) {
			$data = array(
				'view' 			=> 'admin/admin_read',
				'idpengguna' 	=> $row->idpengguna,
				'nama_lengkap' 	=> $row->nama_lengkap,
				'alamat' 		=> $row->alamat,
				'no_telp' 		=> $row->no_telp,
				'photo' 		=> $row->photo,
			);
            $this->load->view('template', $data);
        } else {
            redirect(site_url('admin/admin'));
        }
    }

    public function create(){
        $data = array(
			'view'			=> 'admin/admin_form',
			'title' 		=> '<i class="fa fa-plus-square"></i> Tambah Admin',
			'action' 		=> site_url('admin/admin/create_action'),
			'idpengguna'	=> set_value('idpengguna'),
			'nama_lengkap'	=> set_value('nama_lengkap'),
			'email' 		=> set_value('email'),
			'alamat' 		=> set_value('alamat'),
			'no_telp' 		=> set_value('no_telp'),
			'photo' 		=> set_value('photo'),
		);
        $this->load->view('template', $data);
    }
    
    public function create_action(){
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        }
		else{
			$photo				= $_FILES['photo']['tmp_name'];
			$nama_photo 		= $_FILES['photo']['name'];
			$nmphoto = '';
			
			$lastID	= $this->Admin_model->cekLastId();
			$urut = (empty($lastID->maxs) ? 1 : $lastID->maxs += 1);
			$newId = 'A'.sprintf("%05s", $urut);

			if($nama_photo != ''){
				$tipe 				= $_FILES['photo']['type'];
				$extensi			= explode('.',$nama_photo);	
				$extension		 	= $extensi[1];				
				$nmphoto			= time().'.'.$extension;
				
				if(($extension=="jpg")||($extension=="png")){
					copy($photo, "assets/dist/img/admin/".$nmphoto);	
					
					$data = array(
						'idpengguna' 	=> $newId,
						'nama_lengkap'	=> $this->input->post('nama_lengkap',TRUE),
						'alamat' 		=> $this->input->post('alamat',TRUE),
						'no_telp' 		=> $this->input->post('no_telp',TRUE),
						'photo' 		=> $nmphoto,
					);
					$this->Admin_model->insert($data);
					$this->Admin_model->insert_akses($newId, $this->input->post('email',TRUE));
					redirect(site_url('admin/admin/create/insert'));
				}else{
					redirect(site_url('admin/admin/create/extension'));			
				}			
			}else{
				$data = array(
						'idpengguna' 	=> $newId,
						'nama_lengkap'	=> $this->input->post('nama_lengkap',TRUE),
						'alamat' 		=> $this->input->post('alamat',TRUE),
						'no_telp' 		=> $this->input->post('no_telp',TRUE),
						'photo' 		=> '',
				);
				$this->Admin_model->insert($data);
				$this->Admin_model->insert_akses($newId, $this->input->post('email',TRUE));
				redirect(site_url('admin/admin/create/insert'));
								
			}//end else				
        }
    }
    
    public function update($id){
        $row = $this->Admin_model->get_by_id($id);

        if($row){
			$qLogin = $this->Admin_model->get_akses($row->idpengguna);
            $data = array(
				'title' 		=> '<i class="fa fa-edit"></i> Update Admin',
				'view' 			=> 'admin/admin_form',
                'action' 		=> site_url('admin/admin/update_action'),
				'idpengguna' 	=> set_value('idpengguna', $row->idpengguna),
				'nama_lengkap' 	=> set_value('nama_lengkap', $row->nama_lengkap),
				'email'			=> set_value('email', $qLogin->username),
				'alamat' 		=> set_value('alamat', $row->alamat),
				'no_telp' 		=> set_value('no_telp', $row->no_telp),
				'photo' 		=> set_value('photo', $row->photo),
			);
            $this->load->view('template', $data);
        }else{
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        if($this->form_validation->run() == FALSE){
            $this->update($this->input->post('idpengguna', TRUE));
        }
		else
		{
			$photo				= $_FILES['photo']['tmp_name'];
			$nama_photo 		= $_FILES['photo']['name'];
			$nmphoto = '';
			
			$idpengguna			= $this->input->post('idpengguna', TRUE);
			if($nama_photo != ''){
				$tipe 				= $_FILES['photo']['type'];
				$extensi			= explode('.',$nama_photo);	
				$extension		 	= $extensi[1];				
				$nmphoto			= time().'.'.$extension;
				
				if(($extension=="jpg")||($extension=="png")){
					//ambil photo lama kemudian hapus di directori
					$row = $this->Admin_model->get_by_id($idpengguna);
					if($row->photo != ''){
						unlink("assets/dist/img/admin/".$row->photo);
					}
	
					copy($photo, "assets/dist/img/admin/".$nmphoto);		

					$data = array(
						'nama_lengkap' 	=> $this->input->post('nama_lengkap',TRUE),
						'alamat' 		=> $this->input->post('alamat',TRUE),
						'no_telp' 		=> $this->input->post('no_telp',TRUE),
						'photo' 		=> $nmphoto
					);
					$this->Admin_model->update($idpengguna, $data);
					$this->Admin_model->update_akses_log($idpengguna, $this->input->post('email',TRUE));
			
					redirect(site_url('admin/admin/update/'.$idpengguna.'/success'));
					
				}//end if extension
				else
				{
					redirect(site_url('admin/admin/update/'.$idpengguna.'/extension'));
				}//end else extendsion			
			}//end if foto !=''
			else
			{
					$data = array(
						'nama_lengkap' 	=> $this->input->post('nama_lengkap',TRUE),
						'alamat' 		=> $this->input->post('alamat',TRUE),
						'no_telp' 		=> $this->input->post('no_telp',TRUE),
					);
					$this->Admin_model->update($idpengguna, $data);
					$this->Admin_model->update_akses_log($idpengguna, $this->input->post('email',TRUE));			
					redirect(site_url('admin/admin/update/'.$idpengguna.'/success'));
			}//end else foto !=''
        }//end else form validation
    }//end function
	
 	function ubah_pwd($idpengguna){
        $row = $this->Admin_model->get_akses($idpengguna);
		
		$data = array(
			'password' => md5($idpengguna),
		);

		$this->Admin_model->update_akses($idpengguna, $row->username, $data);
		redirect(site_url('admin/admin/read/'.$idpengguna.'/success'));
	}
    
   
    public function delete($id){
        $row = $this->Admin_model->get_by_id($id);
        if($row){
			if($row->photo != ''){
				unlink("assets/dist/img/admin/".$row->photo);
			}
			
            $this->Admin_model->delete($id);
            $this->Admin_model->delete_login($id);
			redirect(site_url('admin/admin/daftar/delete'));
        }else{
            redirect(site_url('admin/admin'));
        }
    }

    public function _rules(){
		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
	
		$this->form_validation->set_rules('idpengguna', 'idpengguna', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=admin.doc");

        $data = array(
            'admin_data' => $this->Admin_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/admin_doc',$data);
    }

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-15 10:27:24 */
/* http://harviacode.com */