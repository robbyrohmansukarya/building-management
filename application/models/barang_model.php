<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_model extends CI_Model{

    public $table = 'pegawai';
    public $id = 'idpengguna';

    public $table_barang = 'barang';
    public $kode_barang = 'kode_barang';

    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }
   //BERANDA
	function hitungRequest($idpengguna, $tabel, $field, $id){
		$sql = "SELECT $field FROM ".$tabel." WHERE idpengguna ='".$idpengguna."' AND ".$field." = ?";
		return $this->db->query($sql, $id)->num_rows();
	}
	function hitungAllRequest($idpengguna, $tabel){
		$sql = "SELECT * FROM ".$tabel." WHERE idpengguna ='".$idpengguna."'";
		return $this->db->query($sql)->num_rows();
	}
   
    function getRequestSts($tabel, $field, $id){
        $sql = "SELECT $field FROM ".$tabel." WHERE ".$field." = '".$id."' group by id_request order by tanggal_request asc, verifikasi asc";
        return $this->db->query($sql);
    }
    function admGet_allReq(){
        $this->db->order_by('tanggal_request', 'ASC');
        $this->db->order_by('verifikasi', 'ASC');
        return $this->db->get('request_barang');
    }


	function cekLastId(){
		$sql = "SELECT right(kode_barang, 5) AS maxs FROM barang order by kode_barang desc limit 0, 1";
		return $this->db->query($sql)->row();
	}
    // get all
    function get_all(){
        $this->db->order_by($this->kode_barang, $this->order);
        return $this->db->get($this->table_barang)->result();
    }
    
    function get_allNotEmpty(){
        $sql = "select * from barang where stok > 0 order by nama_barang ASC";
        return $this->db->query($sql)->result();
    }

    // get peminjaman barang GROUP BY ID REQUEST
    function get_pinjamGroupByIdrequest($idpengguna){
        $sql = "select barang.nama_barang, request_barang.* 
                from barang, request_barang 
                where barang.kode_barang=request_barang.kode_barang 
                and request_barang.idpengguna='".$idpengguna."' 
                group by id_request
                order by request_barang.tanggal_request desc, barang.nama_barang ASC";
        return $this->db->query($sql)->result();
    }
    // get peminjaman barang
    function get_pinjam($idpengguna){
        $sql = "select barang.nama_barang, request_barang.* 
                from barang, request_barang 
                where barang.kode_barang=request_barang.kode_barang 
                and request_barang.idpengguna='".$idpengguna."'
                order by request_barang.tanggal_request desc, barang.nama_barang ASC";
        return $this->db->query($sql)->result();
    }
    function get_pinjamDetail($idpengguna, $id_request){
        $sql = "select barang.nama_barang, request_barang.* 
                from barang, request_barang 
                where barang.kode_barang=request_barang.kode_barang 
                and request_barang.idpengguna='".$idpengguna."'
				and request_barang.id_request='".$id_request."'
                order by request_barang.tanggal_request desc, barang.nama_barang ASC";
        return $this->db->query($sql)->result();
    }

    // get BY ADMIN peminjaman barang 
    function get_pinjamAdm(){
        $sql = "select barang.nama_barang, request_barang.* 
                from barang, request_barang 
                where barang.kode_barang=request_barang.kode_barang 
                group by request_barang.id_request
                order by request_barang.tanggal_request desc, barang.nama_barang ASC";
        return $this->db->query($sql)->result();
    }
    function get_pinjamByKode($kode_barang){
        $sql = "select barang.nama_barang, request_barang.* 
                from barang, request_barang 
                where barang.kode_barang=request_barang.kode_barang
				and request_barang.kode_barang='".$kode_barang."' 
                group by request_barang.id_request
                order by request_barang.tanggal_request desc, barang.nama_barang ASC";
        return $this->db->query($sql)->result();
    }

    function getTracking(){
        $sql = "select * from barang order by kode_barang asc";
        return $this->db->query($sql)->result();
    }

    // get data by id
    function get_by_id($id){
        $this->db->where($this->kode_barang, $id);
        return $this->db->get($this->table_barang)->row();
    }
    // get data by id
    function reqGetBy_id($id){
        $this->db->where('id', $id);
        return $this->db->get('request_barang')->row();
    }
    
    // get data by id
    function get_by_idrequest($id_request){
        $sql = "select barang.nama_barang, request_barang.* 
                from barang, request_barang 
                where barang.kode_barang=request_barang.kode_barang 
                and request_barang.id_request='".$id_request."'
                order by request_barang.tanggal_request desc, barang.nama_barang ASC";
        return $this->db->query($sql)->result();
    }

    function get_reqLimit($id_request){
        $sql = "select * from request_barang where id_request='".$id_request."' limit 0,1";
        return $this->db->query($sql)->row();
    }

    // get data all by id_request
    function get_all_idrequest($id_request){
        $this->db->where('id_request', $id_request);
        return $this->db->get('request_barang')->result();
    }

    // insert data
    function insert($data){
        $this->db->insert($this->table_barang, $data);
    }
    // insert data peminjaman
    function insert_peminjaman($data){
        $this->db->insert('request_barang', $data);
    }

    // update data
    function update($id, $data){
        $this->db->where($this->kode_barang, $id);
        $this->db->update($this->table_barang, $data);
    }

    function update_stokBarang($kode_barang, $qty){
        $sql = "UPDATE barang SET stok=(stok - $qty) WHERE kode_barang='".$kode_barang."'";
        return $this->db->query($sql);
    }
	
    // update verifikasi
    function verifikasi($id_request, $data){
        $this->db->where('id_request', $id_request);
        $this->db->update('request_barang', $data);
    }
    
    // delete data
    function delete($id){
        $this->db->where($this->kode_barang, $id);
        $this->db->delete($this->table_barang);
    }
    // delete data peminjaman
    function delete_peminjaman($id_request){
        $this->db->where('id_request', $id_request);
        $this->db->delete('request_barang');
    }
    // delete data peminjaman
    function delete_peminjaman_byId($id){
        $this->db->where('id', $id);
        $this->db->delete('request_barang');
    }
    function deleteByKodeBarang($kode_barang){
        $this->db->where('kode_barang', $kode_barang);
        $this->db->delete('request_barang');
    }


    function detail_tanggal($id_request){
        $sql = "SELECT DATE(tanggal_request) AS tgl FROM request_barang where id_request = ?"; 
        return $this->db->query($sql, $id_request)->row_array();
    }
    function detail_jam($id_request){
        $sql = "SELECT DATE_FORMAT(tanggal_request, '%H:%i:%s') AS jam FROM request_barang where id_request = ?";  
        return $this->db->query($sql, $id_request)->row_array();
    }
    //baca request perbaikan admin
    function baca($id_request, $data){
        $this->db->where('id_request', $id_request);
        $this->db->update('request_barang', $data);
    }
  
}

/* End of file Barang_model.php */
/* Location: ./application/models/Eksekutor_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-13 06:16:54 */
/* http://harviacode.com */