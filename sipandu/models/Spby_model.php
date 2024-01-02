<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Spby_model extends CI_Model{
	
    function __construct() {
		
    }
	
	public function getAll () {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("spby");
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[$row["id"]] = $row;
			}
		}
		
		return $out;
	}
	
	public function getById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("spby");
		$this->db->where("id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		return $out;
	}
	
	public function getByTipeSpjId ($tipe = "transport", $spjId) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("spby");
		$this->db->where("spj_id", $spjId);
		$this->db->where("tipe", $tipe);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		return $out;
	}
	
	public function getSpbyKegiatanBySpjId ($spj = "spj_kegiatan_peserta", $spjId, $akun) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("spby");
		$this->db->where($spj, $spjId);
		$this->db->where("dipa_akun", $akun);
		
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
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("spby", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("spby", $data);
		}
		
		return $id;
	}
}