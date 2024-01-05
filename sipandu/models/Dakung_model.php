<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dakung_model extends CI_Model{
	
    function __construct() {
		
    }
	
	public function getByKegiatanIdAndSection ($kegiatanId, $section) {
		$out = array();
		$user = array();
		
		$this->db->select("*");
		$this->db->from("user");
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$user[$row["id"]] = $row["username"];
			}
		}
		
		$this->db->reset_query();
		
		$this->db->select("*");
		$this->db->from("kegiatan_data_dukung");
		$this->db->where("kegiatan_id", $kegiatanId);
		$this->db->where("section", $section);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$row["user"] = $user[$row["dibuat_oleh"]];
				$out[] = $row;
			}
		}
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getByKegiatanId ($kegiatanId) {
		$out = array();
		$user = array();
		
		$this->db->select("*");
		$this->db->from("user");
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$user[$row["id"]] = $row["username"];
			}
		}
		
		$this->db->reset_query();
		
		$this->db->select("*");
		$this->db->from("kegiatan_data_dukung");
		$this->db->where("kegiatan_id", $kegiatanId);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$row["user"] = $user[$row["dibuat_oleh"]];
				$out[] = $row;
			}
		}
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan_data_dukung");
		$this->db->where("id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function save ($data, $id = 0) {

		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("kegiatan_data_dukung", $data);
			$id = $this->db->insert_id();
			$this->db->reset_query();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("kegiatan_data_dukung", $data);
			$this->db->reset_query();
		}
		
		return $id;
	}
	
	public function delete ($id) {
		$this->db->where('id', $id);
		$this->db->delete('kegiatan_data_dukung');
		$this->db->reset_query();
		
		return true;
	}
}