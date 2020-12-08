<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruangan_model extends CI_Model{

    public $table = 'ruangan';
    public $id = 'kode_ruangan';


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
        $sql = "SELECT $field FROM ".$tabel." WHERE ".$field." = '".$id."' group by id_request order by tanggal_kegiatan asc, sts_eksekusi asc";
        return $this->db->query($sql);
    }
    function admGet_allReq(){
        $this->db->order_by('id_request');
        $this->db->order_by('tanggal_kegiatan', 'ASC');
        $this->db->order_by('sts_eksekusi', 'ASC');
        return $this->db->get('request_ruangan');
    }
    function get_bookingInbox(){
        $sql  = "SELECT ruangan.nama_ruangan AS nama_ruangan, 
                        pegawai.nama_lengkap AS nama_lengkap, 
                        pegawai.jabatan,
                        request_ruangan.tanggal_kegiatan AS tanggal_kegiatan,
                        request_ruangan.tanggal_selesai AS tanggal_selesai,
                        request_ruangan.id_request,
                        request_ruangan.sts_eksekusi 
                    FROM pegawai, request_ruangan, ruangan 
                    WHERE request_ruangan.kode_ruangan=ruangan.kode_ruangan
                    AND pegawai.idpengguna = request_ruangan.idpengguna
                    AND request_ruangan.sts_baca_admin = 0
                    GROUP BY request_ruangan.id_request
                    ORDER BY request_ruangan.tanggal_kegiatan DESC";
        return $this->db->query($sql)->result();
    }

    function get_daftarBooking(){
        $sql  = "SELECT ruangan.nama_ruangan AS nama_ruangan, 
                        pegawai.nama_lengkap AS nama_lengkap, 
                        pegawai.jabatan,
                        request_ruangan.tanggal_kegiatan AS tanggal_kegiatan,
                        request_ruangan.id_request,
                        request_ruangan.sts_eksekusi 
                    FROM pegawai, request_ruangan, ruangan 
                    WHERE request_ruangan.kode_ruangan=ruangan.kode_ruangan
                    AND pegawai.idpengguna = request_ruangan.idpengguna
                    GROUP BY request_ruangan.id_request
                    ORDER BY request_ruangan.tanggal_kegiatan DESC";
        return $this->db->query($sql)->result();
    }
    function get_daftarUnForward(){
        $sql  = "SELECT ruangan.nama_ruangan AS nama_ruangan, 
                        pegawai.nama_lengkap AS nama_lengkap, 
                        pegawai.jabatan,
                        request_ruangan.tanggal_kegiatan AS tanggal_kegiatan,
                        request_ruangan.tanggal_selesai AS tanggal_selesai,
                        request_ruangan.id_request,
                        request_ruangan.sts_eksekusi 
                    FROM pegawai, request_ruangan, ruangan 
                    WHERE request_ruangan.kode_ruangan=ruangan.kode_ruangan
                    AND pegawai.idpengguna = request_ruangan.idpengguna
                    AND request_ruangan.flag_fwd = 0
                    GROUP BY request_ruangan.id_request
                    ORDER BY request_ruangan.tanggal_kegiatan DESC";
        return $this->db->query($sql)->result();
    }

    function get_daftarForward(){
        $sql  = "SELECT ruangan.nama_ruangan AS nama_ruangan, 
                        pegawai.nama_lengkap AS nama_lengkap, 
                        pegawai.jabatan,
                        request_ruangan.tanggal_kegiatan AS tanggal_kegiatan,
                        request_ruangan.tanggal_selesai AS tanggal_selesai,
                        request_ruangan.id_request,
                        request_ruangan.nama_kegiatan, 
                        request_ruangan.deskripsi_kegiatan, 
                        request_ruangan.sts_eksekusi 
                    FROM pegawai, request_ruangan, ruangan 
                    WHERE request_ruangan.kode_ruangan=ruangan.kode_ruangan
                    AND pegawai.idpengguna = request_ruangan.idpengguna
                    AND request_ruangan.flag_fwd = 1
                    GROUP BY request_ruangan.id_request
                    ORDER BY request_ruangan.tanggal_kegiatan DESC";
        return $this->db->query($sql)->result();
    }

    function get_bookingAdm(){
        $sql = "select ruangan.nama_ruangan, request_ruangan.* 
                from ruangan, request_ruangan 
                where ruangan.kode_ruangan=request_ruangan.kode_ruangan 
                group by request_ruangan.id_request
                order by request_ruangan.tanggal_kegiatan desc";
        return $this->db->query($sql)->result();
    }

    //baca request booking eksekutor
    function baca_booking($id_request,$ideksekutor, $data){
        $this->db->where('ideksekutor', $ideksekutor);
        $this->db->where('id_request', $id_request);
        $this->db->update('request_ruangan_forward', $data);
    }
	
    //baca request booking admin
    function baca($id_request, $data){
        $this->db->where('id_request', $id_request);
        $this->db->update('request_ruangan', $data);
    }
    // get data by id
    function get_by_idrequest($id_request){
        $sql  = "SELECT ruangan.nama_ruangan AS nama_ruangan, 
                        request_ruangan.* 
                    FROM request_ruangan, ruangan 
                    WHERE request_ruangan.kode_ruangan=ruangan.kode_ruangan
                    AND request_ruangan.id_request=$id_request
                    ORDER BY ruangan.nama_ruangan ASC";
        return $this->db->query($sql)->result();
    }

    function get_reqLimit($id_request){
        $sql = "SELECT 
                    pegawai.nama_lengkap AS nama_lengkap, 
                    pegawai.jabatan AS jabatan, 
                    request_ruangan.*
                FROM pegawai, request_ruangan 
                WHERE pegawai.idpengguna=request_ruangan.idpengguna
				AND request_ruangan.id_request=$id_request limit 0,1";
        return $this->db->query($sql)->row();
    }
    function detail_tanggal($id_request){
        $sql = "SELECT DATE(tanggal_kegiatan) AS tgl FROM request_ruangan where id_request = ? limit 0,1"; 
        return $this->db->query($sql, $id_request)->row_array();
    }
    
    function detail_jam($id_request, $field){
        $sql = "SELECT DATE_FORMAT(tanggal_kegiatan, '%H:%i:%s') AS jam FROM request_ruangan where id_request = ? limit 0,1";  
        return $this->db->query($sql, $id_request)->row_array();
    }




	function cekLastId(){
		$sql = "SELECT right(kode_ruangan, 5) AS maxs FROM ruangan order by kode_ruangan desc limit 0, 1";
		return $this->db->query($sql)->row();
	}
    // get all
    function get_all(){
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    // get data by id
    function get_by_id($id){
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function getByid_request($idBooking){
        $this->db->where('id', $idBooking);
        return $this->db->get('request_ruangan')->row();
    }
    function getByRequest($id_request){
        $this->db->where('id_request', $id_request);
        return $this->db->get('request_ruangan')->row();
    }

    function insert_forward($data){
        $this->db->insert('request_ruangan_forward', $data);
    }
    function insert_booking($data){
        $this->db->insert('request_ruangan', $data);
    }

    function getAll_booking(){
        $sql  = "SELECT ruangan.nama_ruangan AS nama_ruangan, 
                        pegawai.nama_lengkap AS nama_lengkap, 
                        pegawai.jabatan,
                        request_ruangan.tanggal_kegiatan AS tanggal_kegiatan,
                        request_ruangan.tanggal_selesai AS tanggal_selesai,
                        request_ruangan.id_request,
                        request_ruangan.nama_kegiatan, 
                        request_ruangan.deskripsi_kegiatan, 
                        request_ruangan.sts_eksekusi 
                    FROM pegawai, request_ruangan, ruangan 
                    WHERE request_ruangan.kode_ruangan=ruangan.kode_ruangan
                    AND pegawai.idpengguna = request_ruangan.idpengguna
                    GROUP BY request_ruangan.id_request
                    ORDER BY request_ruangan.tanggal_kegiatan DESC";
        return $this->db->query($sql)->result();
    }
    function getAll_byUser($idpengguna){
        $sql  = "SELECT ruangan.nama_ruangan AS nama_ruangan, 
                        pegawai.nama_lengkap AS nama_lengkap, 
                        pegawai.jabatan,
                        request_ruangan.* 
                    FROM pegawai, request_ruangan, ruangan 
                    WHERE request_ruangan.kode_ruangan=ruangan.kode_ruangan
                    AND pegawai.idpengguna = request_ruangan.idpengguna
                    AND request_ruangan.idpengguna='".$idpengguna."'
                    GROUP BY request_ruangan.id_request
                    ORDER BY request_ruangan.tanggal_kegiatan DESC";
        return $this->db->query($sql)->result();
    }

   function __bookingList($id_request){
        $sql  = "SELECT ruangan.nama_ruangan AS nama_ruangan, 
                        request_ruangan.* 
                    FROM request_ruangan, ruangan 
                    WHERE request_ruangan.kode_ruangan=ruangan.kode_ruangan
                    AND request_ruangan.id_request='".$id_request."'
                    ORDER BY request_ruangan.tanggal_kegiatan DESC";
        return $this->db->query($sql)->result();
    }


    // insert data
    function insert($data){
        $this->db->insert($this->table, $data);
    }

    // update data
    function update_ruangan_forward($id_request, $ideksekutor, $data){
        $this->db->where('id_request', $id_request);
        $this->db->where('ideksekutor', $ideksekutor);
        $this->db->update('request_ruangan_forward', $data);
    }
    function update($id, $data){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    // delete data
    function delete($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    function delete_reqRuagan($id){
        $this->db->where('kode_ruangan', $id);
        $this->db->delete('request_ruangan');
    }    
    function deleteByRequest($id_request){
        $this->db->where('id_request', $id_request);
        $this->db->delete('request_ruangan');
    }    
    function deleteIdRequest($idBooking){
        $this->db->where('id', $idBooking);
        $this->db->delete('request_ruangan');
    }    

    function delete_reqRuaganByPegawai($id){
        $this->db->where('idpengguna', $id);
        $this->db->delete('request_ruangan');
    }

}

/* End of file Ruangan_model.php */
/* Location: ./application/models/Ruangan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-13 06:16:54 */
/* http://harviacode.com */