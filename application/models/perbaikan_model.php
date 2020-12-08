<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perbaikan_model extends CI_Model{

    public $table = 'perbaikan';
    public $id = 'id_request';


    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }
	function hitungRequest($idpengguna, $tabel, $field, $id){
		$sql = "SELECT $field FROM ".$tabel." WHERE idpengguna ='".$idpengguna."' AND ".$field." = ?";
		return $this->db->query($sql, $id)->num_rows();
	}
	function hitungAllRequest($idpengguna, $tabel){
		$sql = "SELECT * FROM ".$tabel." WHERE idpengguna ='".$idpengguna."'";
		return $this->db->query($sql)->num_rows();
	}

    //PEGAWAI
    function get_allNew($tabel, $idpengguna){
        $this->db->where('flag_fwd', 0);
        $this->db->order_by('sts_eksekusi', 'ASC');
        $this->db->order_by('tanggal_request', 'DESC');
        $this->db->where('idpengguna', $idpengguna);
        return $this->db->get($tabel);
    }
    function historifwd_pegawai($idpengguna){
        $this->db->where('idpengguna', $idpengguna);
        $this->db->where('flag_fwd', 1);
        $this->db->order_by('tanggal_request', 'DESC');
        $this->db->order_by('id_klasifikasi', 'DESC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get($this->table);
    }
    //INSERT KOMPLEN PERBAIKAN, RUANG RAPAT, PEMINJAMAN
    function insert_komplen($_table, $data){
        $this->db->insert($_table, $data);
    }
    function __update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    function __delete($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function delete_progres_byuser($id_request){
        $this->db->where('id_request', $id_request);
        $this->db->delete('progres_perbaikan');
    }

    //BERANDA
    function getRequestSts($tabel, $field, $id){
        $sql = "SELECT $field FROM ".$tabel." WHERE ".$field." = '".$id."' order by tanggal_request asc, sts_eksekusi asc";
        return $this->db->query($sql);
    }
    function admGet_allReq(){
        $this->db->order_by('tanggal_request', 'ASC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get($this->table);
    }



    // get all
    function get_all(){
        $this->db->order_by('tanggal_request', 'DESC');
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id){
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    function detail_tanggal($id_request){
        $sql = "SELECT DATE(tanggal_request) AS tgl FROM perbaikan where id_request = ?"; 
        return $this->db->query($sql, $id_request)->row_array();
    }
    function detail_jam($id_request){
        $sql = "SELECT DATE_FORMAT(tanggal_request, '%H:%i:%s') AS jam FROM perbaikan where id_request = ?";  
        return $this->db->query($sql, $id_request)->row_array();
    }
    
    function get_kalsifikasi(){
        $this->db->order_by('id_klasifikasi', 'ASC');
        return $this->db->get('klasifikasi_request');
    }
    // update data tabel perbaikan
    function forward($id_request, $data){
        $this->db->where('id_request', $id_request);
        $this->db->update('perbaikan', $data);
    }

    function historifwd(){
        $this->db->where('flag_fwd', 1);
        $this->db->order_by('tanggal_request', 'DESC');
        $this->db->order_by('id_klasifikasi', 'DESC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get($this->table);
    }
    function get_detail($table, $field, $id){
        $this->db->where($field, $id);
        return $this->db->get($table)->row();
    }
    //baca request perbaikan admin
    function baca($id_request, $data){
        $this->db->where('id_request', $id_request);
        $this->db->update('perbaikan', $data);
    }

    function baca_progres($id_request, $data){
        $this->db->where('id_request', $id_request);
        $this->db->update('progres_perbaikan', $data);
    }

    function progres_by_id($id_progres){
        $this->db->where('id', $id_progres);
        return $this->db->get('progres_perbaikan')->row();
    }
    
    function get_progres($ideksekutor, $id_request){
        $this->db->where('id_eksekutor', $ideksekutor);
        $this->db->where('id_request', $id_request);
        $this->db->order_by('waktu_eksekusi', 'DESC');
        return $this->db->get('progres_perbaikan');
    }

    function get_progres_byid($ideksekutor, $id_request){
        $sql = "select * from progres_perbaikan where id_eksekutor='".$ideksekutor."' and id_request='".$id_request."' order by id desc, waktu_eksekusi desc limit 0,1";
        return $this->db->query($sql);
        
        //$this->db->where('id_eksekutor', $ideksekutor);
        //$this->db->where('id_request', $id_request);
        //$this->db->order_by('id', 'DESC');
        //return $this->db->get('progres');
    }


    //=================== EKSEKUTOR =============
    function er_get_all($ideksekutor){
        $this->db->where('ideksekutor', $ideksekutor);
        $this->db->order_by('id_klasifikasi', 'DESC');
        $this->db->order_by('tanggal_request', 'DESC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get($this->table);
    }

    function update_status($id_request, $data){
        $this->db->where($this->id, $id_request);
        $this->db->update($this->table, $data);
    }

    function insert_progres($data){
        $this->db->insert('progres_perbaikan', $data);
    }
    function delete_progres($id_progres){
        $this->db->where('id', $id_progres);
        $this->db->delete('progres_perbaikan');
    }

    function delAllReqProgres($id_request){
        $this->db->where('id_request', $id_request);
        $this->db->delete('progres_perbaikan');
    }
    function delAllReqPerbaikan($id_request){
        $this->db->where('id_request', $id_request);
        $this->db->delete('perbaikan');
    }


    function tgl_progres($id){
        $sql = "SELECT DATE(waktu_eksekusi) AS tgl_progres FROM progres_perbaikan where id='".$id."'";    
        return $this->db->query($sql)->row_array();
    }
    function jam_progres($id){
        $sql = "SELECT DATE_FORMAT(waktu_eksekusi, '%H:%i:%s') AS jam_progres FROM progres_perbaikan where id='".$id."'"; 
        return $this->db->query($sql)->row_array();
    }
    
}

/* End of file Perbaikan_model.php */
/* Location: ./application/models/Perbaikan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-13 06:16:54 */
/* http://harviacode.com */