<?php 

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Request_model extends CI_Model
{
    public $table = 'request';
    public $id = 'id_request';
    public $order = 'DESC';
	
	// Setelah Revisi
    function get_allByKategori($tabel, $idpengguna){
        $this->db->order_by('sts_eksekusi', 'ASC');
        $this->db->order_by('tanggal_request', 'DESC');
		$this->db->where('idpengguna', $idpengguna);
        return $this->db->get($tabel);
    }
	//INSERT KOMPLEN PERBAIKAN, RUANG RAPAT, PEMINJAMAN
    function insert_komplen($_table, $data){
        $this->db->insert($_table, $data);
    }
	
    //GET BY ID komplen perbaikan, ruang rapat, peminjaman
    function __getByID($_table, $id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($_table)->row();
    }
    // UPDATE komplen perbaikan, ruang rapat, peminjaman
    function __update($_table, $id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($_table, $data);
    }

    function delete_progres_byuser($id_request){
        $this->db->where('id_request', $id_request);
        $this->db->delete('progres');
    }
    
    function __delete($_table, $id){
        $this->db->where($this->id, $id);
        $this->db->delete($_table);
    }





//SELECT DATE(tanggal_request) FROM `request` WHERE 1 
    function __construct(){
        parent::__construct();
    }
	function cekbanyak($table){
		$sql = "SELECT * FROM $table";
		return $this->db->query($sql)->num_rows();
	}

	function hitungRequest($idpengguna, $tabel, $field, $id){
		$sql = "SELECT $field FROM ".$tabel." WHERE idpengguna ='".$idpengguna."' AND ".$field." = ?";
		return $this->db->query($sql, $id)->num_rows();
	}
	function hitungRequest_eksekutor($ideksekutor, $tabel, $field, $id){
		$sql = "SELECT $field FROM ".$tabel." WHERE ideksekutor ='".$ideksekutor."' AND ".$field." = ?";
		return $this->db->query($sql, $id)->num_rows();
	}
	
	function requestHariIni($idpengguna, $tglHariIni){
		$sql = "SELECT * FROM request WHERE idpengguna='".$idpengguna."' AND DATE(tanggal_request)='".$tglHariIni."' order by tanggal_request asc, sts_eksekusi asc";
		return $this->db->query($sql);
	}
	function getAllLimit($idpengguna, $tglHariIni){
		$sql = "SELECT * FROM request WHERE idpengguna='".$idpengguna."' AND DATE(tanggal_request)<>'".$tglHariIni."' order by tanggal_request asc, sts_eksekusi asc limit 0, 5";
		return $this->db->query($sql);
	}

    // get data pegawai by id
    function get_lokasi_pegawai($id){
        $sql = "select alamat_ruma, alamat_kantor from pegawai where idpegawai='".$id."'";
		return $this->db->query($sql)->row();
    }
	
    function get_kalsifikasi(){
        $this->db->order_by('id_klasifikasi', 'ASC');
        return $this->db->get('klasifikasi_request');
    }
	
    function get_all($idpengguna){
        $this->db->order_by('sts_eksekusi', 'ASC');
        $this->db->order_by('tanggal_request', 'DESC');
		$this->db->where('idpengguna', $idpengguna);
        return $this->db->get($this->table);
    }
	
    function get_allKategori(){
        $this->db->order_by('id_kategori', 'ASC');
        return $this->db->get('kategori_request')->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_detail($tabel, $field, $id){
        $this->db->where($field, $id);
        return $this->db->get($tabel)->row();
    }
	
	//=================== EKSEKUTOR =============
    function er_get_all($ideksekutor){
        $this->db->where('ideksekutor', $ideksekutor);
       	$this->db->order_by('id_klasifikasi', 'DESC');
       	$this->db->order_by('tanggal_request', 'DESC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get($this->table);
    }
	
	function get_progres_byid($ideksekutor, $id_request){
		$sql = "select * from progres where id_eksekutor='".$ideksekutor."' and id_request='".$id_request."' order by id desc, waktu_eksekusi desc limit 0,1";
		return $this->db->query($sql);
		
        //$this->db->where('id_eksekutor', $ideksekutor);
        //$this->db->where('id_request', $id_request);
       	//$this->db->order_by('id', 'DESC');
        //return $this->db->get('progres');
	}

	function tgl_progres($id){
		$sql = "SELECT DATE(waktu_eksekusi) AS tgl_progres FROM progres where id='".$id."'";	
		return $this->db->query($sql)->row_array();
	}
	function jam_progres($id){
		$sql = "SELECT DATE_FORMAT(waktu_eksekusi, '%H:%i:%s') AS jam_progres FROM progres where id='".$id."'";	
		return $this->db->query($sql)->row_array();
	}
	
	function get_progres($ideksekutor, $id_request){
        $this->db->where('id_eksekutor', $ideksekutor);
        $this->db->where('id_request', $id_request);
       	$this->db->order_by('waktu_eksekusi', 'DESC');
        return $this->db->get('progres');
	}
	function get_kategori($id_kategori){
        $this->db->where('id_kategori', $id_kategori);
        return $this->db->get('kategori_request');
	}
	
    function insert_progres($data){
        $this->db->insert('progres', $data);
    }
    function update_status($id_request, $data){
        $this->db->where($this->id, $id_request);
        $this->db->update($this->table, $data);
    }
   
	//=================== ADMIN =============
    function getRequestSts($tabel, $field, $id){
		$sql = "SELECT $field FROM ".$tabel." WHERE ".$field." = ?  order by tanggal_request asc, sts_eksekusi asc";
		return $this->db->query($sql, $id);
    }

    function getRequestStsBykat($tabel, $field, $id, $idkategori){
		$sql = "SELECT $field FROM ".$tabel." WHERE ".$field." = '".$id."' AND id_kategori='".$idkategori."' order by tanggal_request asc, sts_eksekusi asc";
		return $this->db->query($sql);
    }
	
    function historifwd(){
        $this->db->where('flag_fwd', 1);
       	$this->db->order_by('tanggal_request', 'DESC');
       	$this->db->order_by('id_klasifikasi', 'DESC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get($this->table);
    }
    function historifwd_pegawai($idpengguna){
        $this->db->where('idpengguna', $idpengguna);
        $this->db->where('flag_fwd', 1);
       	$this->db->order_by('tanggal_request', 'DESC');
       	$this->db->order_by('id_klasifikasi', 'DESC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get($this->table);
    }
	
    function admGet_all(){
        $this->db->order_by('tanggal_request', 'ASC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get($this->table);
    }

    function admGet_allByKat($id_kategori){
        $this->db->where('id_kategori', $id_kategori);
        $this->db->order_by('tanggal_request', 'ASC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get($this->table);
    }

	function reqHrIni($tglHariIni){
		$sql = "SELECT * FROM request WHERE DATE(tanggal_request)='".$tglHariIni."' order by tanggal_request asc, sts_eksekusi asc";
		return $this->db->query($sql);
	}
		function admGetAllLimit($tglHariIni){
		$sql = "SELECT * FROM request WHERE DATE(tanggal_request)<>'".$tglHariIni."' order by tanggal_request asc, sts_eksekusi asc limit 0, 5";
		return $this->db->query($sql);
	}
	
	function reqByKategori($id_kategori, $tglHariIni){
		$sql = "SELECT * FROM request WHERE id_kategori='".$id_kategori."' AND DATE(tanggal_request)<>'".$tglHariIni."' order by sts_eksekusi asc, tanggal_request asc";
		return $this->db->query($sql);
	}
	function request_ByKategori($id_kategori){
		$sql = "SELECT * FROM request WHERE id_kategori='".$id_kategori."' AND flag_fwd=0 order by tanggal_request DESC, sts_eksekusi asc";
		return $this->db->query($sql);
	}
	function detail_tanggal($id_request){
		$sql = "SELECT DATE(tanggal_request) AS tgl FROM request where id_request = ?";	
		return $this->db->query($sql, $id_request)->row_array();
	}
	function detail_jam($id_request){
		$sql = "SELECT DATE_FORMAT(tanggal_request, '%H:%i:%s') AS jam FROM request where id_request = ?";	
		return $this->db->query($sql, $id_request)->row_array();
	}
	

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_request', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('id_klasifikasi', $q);
	$this->db->or_like('idpengguna', $q);
	$this->db->or_like('request', $q);
	$this->db->or_like('deskripsi_request', $q);
	$this->db->or_like('baca_admin', $q);
	$this->db->or_like('baca_eksekutor', $q);
	$this->db->or_like('sts_baca_admin', $q);
	$this->db->or_like('sts_baca_eksekutor', $q);
	$this->db->or_like('sts_eksekusi', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_request', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('id_klasifikasi', $q);
	$this->db->or_like('idpengguna', $q);
	$this->db->or_like('request', $q);
	$this->db->or_like('deskripsi_request', $q);
	$this->db->or_like('baca_admin', $q);
	$this->db->or_like('baca_eksekutor', $q);
	$this->db->or_like('sts_baca_admin', $q);
	$this->db->or_like('sts_baca_eksekutor', $q);
	$this->db->or_like('sts_eksekusi', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data){
        $this->db->insert($this->table, $data);
    }

    // update data
    function forward($id_request, $data){
        $this->db->where('id_request', $id_request);
        $this->db->update('request', $data);
    }
    function baca($id_request, $data){
        $this->db->where('id_request', $id_request);
        $this->db->update('request', $data);
    }
    function baca_progres($id_request, $data){
        $this->db->where('id_request', $id_request);
        $this->db->update('progres', $data);
    }
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
	
    function delete_progres($id_progres){
        $this->db->where('id', $id_progres);
        $this->db->delete('progres');
    }
	
    function progres_by_id($id_progres){
        $this->db->where('id', $id_progres);
        return $this->db->get('progres')->row();
    }


}

/* End of file Request_model.php */
/* Location: ./application/models/Request_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-14 15:55:34 */
/* http://harviacode.com */