<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pejabat_model extends CI_Model{
	
    function __construct() {
		
    }
	
	public function getPejabatGrupById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("pejabat_grup");
		$this->db->where("id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		return $out;
	}
	
	public function saveGrup ($data, $id = 0) {
		if (isset($data["status"]) && $data["status"] == "1") {
			
			$this->db->select("*");
			$this->db->from("pejabat_grup");

			$query = $this->db->get();
			
			$pejabatGrups = array();
			
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$pejabatGrups[] = $row;
				}
			}
			
			$this->db->reset_query();
			
			if (!empty($pejabatGrups)) {
				foreach ($pejabatGrups as $pejabatGrup) {
					$status = array();
					$status["status"] = "0";
					$this->db->where("id", $pejabatGrup["id"]);
					$this->db->update("pejabat_grup", $status);
					
					$this->db->reset_query();
				}
			}
		}
		
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("pejabat_grup", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("pejabat_grup", $data);
		}
		
		return $id;
	}
	
	public function saveTeam ($data, $id = 0) {
		
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("pejabat_biodata", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("pejabat_biodata", $data);
		}
		
		return $id;
	}
	
	public function deleteTeamByGrupId ($id) {
		if (isset($id) && !empty($id)) {
			$this->db->where('pejabat_grup_id', $id);
			$this->db->delete('pejabat_biodata');
			$this->db->reset_query();
		}
	}
	
	public function getPejabatTeamByGrupId ($pejabat = "KPA", $id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("pejabat_biodata");
		$this->db->where("pejabat", $pejabat);
		$this->db->where("pejabat_grup_id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		return $out;
	}
	
}