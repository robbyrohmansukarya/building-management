<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends Login_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');
        $this->load->model('Ruangan_model');
    }

    public function index(){
        $pegawai = $this->Pegawai_model->get_all();

        $data = array(
            'pegawai_data' => $pegawai,
            'view' => 'pegawai/pegawai_list'
        );
		
        $this->load->view('template', $data);
    }

    public function read($id){
		$row = $this->Pegawai_model->get_by_id($id);
		if ($row) {
			$data = array(
				'view' 			=> 'pegawai/pegawai_read',
				'idpengguna' 	=> $row->idpengguna,
				'nomor_induk' 	=> $row->nomor_induk,
				'nama_lengkap' 	=> $row->nama_lengkap,
				'jabatan' 		=> $row->jabatan,
				'jk' 			=> $row->jk,
				'alamat' 		=> $row->alamat,
				'no_telp' 		=> $row->no_telp,
				'photo'			=> $row->photo,
			);
			$this->load->view('template', $data);
		} else {
			redirect(site_url('admin/pegawai'));
		}
    }

    public function create(){
		$data = array(
			'view' 			=> 'pegawai/pegawai_form',
			'title' 		=> '<i class="fa fa-plus-square"></i> Tambah Pegawai',
			'action' 		=> site_url('admin/pegawai/create_action'),
			'idpengguna' 	=> set_value('idpengguna'),
			'nomor_induk' 	=> set_value('nomor_induk'),
			'nama_lengkap' 	=> set_value('nama_lengkap'),
			'jabatan' 		=> set_value('jabatan'),
			'jk' 			=> set_value('jk'),
			'email' 		=> set_value('email'),
			'alamat' 		=> set_value('alamat'),
			'no_telp' 		=> set_value('no_telp'),
			'photo' 		=> set_value('photo'),
		);
        $this->load->view('template', $data);
    }
    
    public function create_action(){
        $this->_rules();
		
        if($this->form_validation->run() == FALSE){
            $this->create();
        }
		else{
			
			$photo				= $_FILES['photo']['tmp_name'];
			$nama_photo 		= $_FILES['photo']['name'];
			$nmphoto = '';
			
			$lastID	= $this->Pegawai_model->cekLastId();
			$urut = (empty($lastID->maxs) ? 1 : $lastID->maxs += 1);
			$newId = 'P'.sprintf("%05s", $urut);

			if($nama_photo != ''){
				$tipe 				= $_FILES['photo']['type'];
				$extensi			= explode('.',$nama_photo);	
				$extension		 	= $extensi[1];				
				$nmphoto			= time().'.'.$extension;
				
				if(($extension=="jpg")||($extension=="png")){
					copy($photo, "assets/dist/img/pegawai/".$nmphoto);	
					
					$data = array(
						'idpengguna' 	=> $newId,
						'nama_lengkap'	=> $this->input->post('nama_lengkap',TRUE),
						'nomor_induk'	=> $this->input->post('nomor_induk',TRUE),
						'jabatan'		=> $this->input->post('jabatan',TRUE),
						'jk'			=> $this->input->post('jk',TRUE),
						'alamat' 		=> $this->input->post('alamat',TRUE),
						'no_telp' 		=> $this->input->post('no_telp',TRUE),
						'photo' 		=> $nmphoto,
					);
					$this->Pegawai_model->insert($data);
					$this->Pegawai_model->insert_akses($newId, $this->input->post('email',TRUE));
					redirect(site_url('admin/pegawai/create/insert'));
				}
				else 
				{
					redirect(site_url('admin/pegawai/create/extension'));			
				}// else extension			
			}
			else 
			{
				$data = array(
					'idpengguna' 	=> $newId,
					'nama_lengkap'	=> $this->input->post('nama_lengkap',TRUE),
					'nomor_induk'	=> $this->input->post('nomor_induk',TRUE),
					'jabatan'		=> $this->input->post('jabatan',TRUE),
					'jk'			=> $this->input->post('jk',TRUE),
					'alamat' 		=> $this->input->post('alamat',TRUE),
					'no_telp' 		=> $this->input->post('no_telp',TRUE),
					'photo' 		=> '',
				);
	
				$this->Pegawai_model->insert($data);
				$this->Pegawai_model->insert_akses($newId, $this->input->post('email',TRUE));
				redirect(site_url('admin/pegawai'));
			
			}// else $nama_photo != ''
        } //else form validation
    }
    
    public function update($id){
        $row = $this->Pegawai_model->get_by_id($id);
        
		if($row){
			$qLogin = $this->Pegawai_model->get_akses($row->idpengguna);

			$data = array(
				'title' 		=> '<i class="fa fa-edit"></i> Update Pegawai',
				'view' 			=> 'pegawai/pegawai_form',
				'action' 		=> site_url('admin/pegawai/update_action'),
				'idpengguna' 	=> set_value('idpengguna', $row->idpengguna),
				'nomor_induk' 	=> set_value('nomor_induk', $row->nomor_induk),
				'nama_lengkap' 	=> set_value('nama_lengkap', $row->nama_lengkap),
				'jabatan' 		=> set_value('jabatan', $row->jabatan),
				'jk'		 	=> set_value('jk', $row->jk),
				'alamat' 		=> set_value('alamat', $row->alamat),
				'email'			=> set_value('email', $qLogin->username),
				'no_telp' 		=> set_value('no_telp', $row->no_telp),
				'photo' 		=> set_value('photo', $row->photo),
			);
			$this->load->view('template', $data);
        }else{
            redirect(site_url('admin/pegawai'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        if($this->form_validation->run() == FALSE){
            $this->update($this->input->post('idpengguna', TRUE));
        }//end if validation
		else{
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
					$row = $this->Pegawai_model->get_by_id($idpengguna);
					if($row->photo != ''){
						unlink("assets/dist/img/pegawai/".$row->photo);
					}
	
					copy($photo, "assets/dist/img/pegawai/".$nmphoto);		

					$data = array(
						'nama_lengkap' 	=> $this->input->post('nama_lengkap',TRUE),
						'nomor_induk'	=> $this->input->post('nomor_induk',TRUE),
						'jabatan'		=> $this->input->post('jabatan',TRUE),
						'jk'			=> $this->input->post('jk',TRUE),
						'alamat' 		=> $this->input->post('alamat',TRUE),
						'no_telp' 		=> $this->input->post('no_telp',TRUE),
						'photo' 		=> $nmphoto
					);
					$this->Pegawai_model->update($idpengguna, $data);
					$this->Pegawai_model->update_akses_log($idpengguna, $this->input->post('email',TRUE));
			
					redirect(site_url('admin/pegawai/update/'.$idpengguna.'/success'));
					
				}//end if extension
				else
				{
					redirect(site_url('admin/pegawai/update/'.$idpengguna.'/extension'));
				}//end else extendsion			
			}//end if foto !=''
			else
			{
				$data = array(
					'nama_lengkap' 	=> $this->input->post('nama_lengkap',TRUE),
					'nomor_induk'	=> $this->input->post('nomor_induk',TRUE),
					'jabatan'		=> $this->input->post('jabatan',TRUE),
					'jk'			=> $this->input->post('jk',TRUE),
					'alamat' 		=> $this->input->post('alamat',TRUE),
					'no_telp' 		=> $this->input->post('no_telp',TRUE),
				);
				$this->Pegawai_model->update($idpengguna, $data);
				$this->Pegawai_model->update_akses_log($idpengguna, $this->input->post('email',TRUE));			
				redirect(site_url('admin/pegawai/update/'.$idpengguna.'/success'));
			}//end else foto !=''
        }//end else validation
    }
 	function ubah_pwd($idpengguna){
        $row = $this->Pegawai_model->get_akses($idpengguna);
		
		$data = array(
			'password' => md5($idpengguna),
		);

		$this->Pegawai_model->update_akses($idpengguna, $row->username, $data);
		redirect(site_url('admin/pegawai/read/'.$idpengguna.'/success'));
	}
    
    public function delete($id){
        $row = $this->Pegawai_model->get_by_id($id);
        if($row){
			if($row->photo != ''){
				unlink("assets/dist/img/pegawai/".$row->photo);
			}
			
            $this->Pegawai_model->delete($id);
			$this->Pegawai_model->delete_request($id);
            $this->Pegawai_model->delete_login($id);
            $this->Ruangan_model->delete_reqRuaganByPegawai($id);
			redirect(site_url('admin/pegawai/index/delete'));
        }else{
            redirect(site_url('admin/pegawai'));
        }
    }

    public function _rules(){
		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
		$this->form_validation->set_rules('email', 'alamat', 'trim|required');
		$this->form_validation->set_rules('idpengguna', 'idpengguna', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
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