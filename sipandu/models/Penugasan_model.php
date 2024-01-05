<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penugasan_model extends CI_Model{
	
    function __construct() {
    }
	
	public function save ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("penugasan", $data);
			$id = $this->db->insert_id();
			
			$this->db->reset_query();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("penugasan", $data);
			$this->db->reset_query();
		}
		
		return $id;
	}
	
	public function getById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("penugasan");
		$this->db->where("id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		if (isset($out["petugas"]) && !empty($out["petugas"])) {
			$out["petugas"] = json_decode($out["petugas"], true);
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getByStatus ($status) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("penugasan");
		$this->db->where("status", $status);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				if (isset($row["petugas"]) && !empty($row["petugas"])) {
					$row["petugas"] = json_decode($row["petugas"], true);
				}
				
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getByKegiatanId ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("penugasan");
		$this->db->where("kegiatan_id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				if (isset($row["petugas"]) && !empty($row["petugas"])) {
					$row["petugas"] = json_decode($row["petugas"], true);
				}
				
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function saveItem ($data, $id = 0) {
		if (empty($id)) {
			
			if (!isset($data['dibuat_tgl'])) {
				$data['dibuat_tgl'] = date("Y-m-d H:i:s");
			}
			
			if (!isset($data['diubah_tgl'])) {
				$data['diubah_tgl'] = date("Y-m-d H:i:s");
			}
			
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("penugasan_item", $data);
			$id = $this->db->insert_id();
			
			$this->db->reset_query();
		}
		else {
			if (!isset($data['diubah_tgl'])) {
				$data['diubah_tgl'] = date("Y-m-d H:i:s");
			}
			
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("penugasan_item", $data);
			$this->db->reset_query();
		}
		
		return $id;
	}
	
	public function getItemById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("penugasan_item");
		$this->db->where("id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		if (isset($out["laporan_foto"]) && !empty($out["laporan_foto"])) {
			$out["laporan_foto"] = json_decode($out["laporan_foto"], true);
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getItemsByPenugasanId ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("penugasan_item");
		$this->db->where("penugasan_id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				if (isset($row["laporan_foto"]) && !empty($row["laporan_foto"])) {
					$row["laporan_foto"] = json_decode($row["laporan_foto"], true);
				}
				
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getItemByStatus ($status) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("penugasan_item");
		$this->db->where("status", $status);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {				
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getItemBySpjItemId ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("penugasan_item");
		$this->db->where("spj_item_id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {				
				$out = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
}