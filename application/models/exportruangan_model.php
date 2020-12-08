<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class exportruangan_model extends CI_Model {

public function __construct()
{
parent::__construct();
$this->load->database();
}

// Listing
public function listing()
{
$this->db->select('*');
$this->db->from('laporan_ruangan');
$this->db->order_by('id_request', 'ASC');
$query = $this->db->get();
return $query->result();
}


}

/* End of file Provinsi_model.php */
/* Location: ./application/models/export_model.php */