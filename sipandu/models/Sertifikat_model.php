<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sertifikat_model extends CI_Model{
	
    function __construct() {
		
    }
	
	public function getById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("sertifikat");
		$this->db->where("id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		return $out;
	}
	
	public function save ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			
			$this->db->insert('sertifikat', $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			
			$this->db->where('id', $id);
			$this->db->update('sertifikat', $data);
		}
		
		return $id;
	}
	
	public function getTypeHead ($term) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("sertifikat");
		$this->db->like('nama', $term);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		return $out;
	}
}