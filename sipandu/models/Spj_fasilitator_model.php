<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Spj_fasilitator_model extends CI_Model{
	
    function __construct() {
		
    }
	
	public function getById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("spj_kegiatan_fasilitator");
		$this->db->where("id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		return $out;
	}
	
	public function getByIds ($ids) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("spj_kegiatan_fasilitator");
		$this->db->where_in('id', $ids);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		return $out;
	}
	
	public function getBySpjId ($spjId) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("spj_kegiatan_fasilitator");
		$this->db->where("spj_id", $spjId);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[$row["id"]] = $row;
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
			
			$this->db->insert("spj_kegiatan_fasilitator", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("spj_kegiatan_fasilitator", $data);
		}
		
		$this->db->reset_query();
		
		return $id;
	}
	
	public function deleteBySpjId ($spjId, $lock = "0") {
		$this->db->where('spj_id', $spjId);
		$this->db->where('kunci', $lock);
		$this->db->delete('spj_kegiatan_fasilitator');
		$this->db->reset_query();
		
		return true;
	}
	
	public function updateLockBySpjId ($spjId, $lock) {
		$this->db->where("spj_id", $spjId);
		
		$data = array();
		$data["kunci"] = $lock;
		
		$this->db->update("spj_kegiatan_fasilitator", $data);
		
		$this->db->reset_query();
	}
	
	public function getTypeHead ($spjId, $term) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("spj_kegiatan_fasilitator");
		$this->db->where("spj_id", $spjId);
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