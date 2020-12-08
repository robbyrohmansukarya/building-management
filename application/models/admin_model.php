<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public $table = 'admin';
    public $id = 'idpengguna';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }

	function cekLastId(){
		$sql = "SELECT right(idpengguna, 5) AS maxs FROM admin order by idpengguna desc limit 0, 1";
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('idpengguna', $q);
	$this->db->or_like('nama_lengkap', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_telp', $q);
	$this->db->or_like('photo', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idpengguna', $q);
	$this->db->or_like('nama_lengkap', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_telp', $q);
	$this->db->or_like('photo', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function get_akses($idpengguna){
        $this->db->where('idpengguna', $idpengguna);
        return $this->db->get('login')->row();
    }
    // insert data
    function insert($data){
        $this->db->insert($this->table, $data);
    }
    // insert data login
    function insert_akses($newId, $email){
		$data = array(
			'idpengguna'	=> $newId,
			'username'		=> $email,
			'password'		=> md5($newId),
			'level'			=> 'admin'
		);
        $this->db->insert('login', $data);
    }
    function update_akses($idpengguna, $email, $data){
        $this->db->where('idpengguna', $idpengguna);
        $this->db->where('username', $email);
        $this->db->update('login', $data);
    }
    // update data
	function update_akses_log($idpengguna, $email){
		$data = array(
			'username'		=> $email,
		);
		$this->db->where('idpengguna', $idpengguna);
		$this->db->update('login', $data);
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

    function delete_login($id){
        $this->db->where('idpengguna', $id);
        $this->db->delete('login');
    }

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-15 10:27:24 */
/* http://harviacode.com */