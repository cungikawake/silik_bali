<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Perjadin_model extends CI_Model{
	
    function __construct() {
		
    }
	
	public function getPerjadinById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("perjadin");
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
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("perjadin", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("perjadin", $data);
		}
		
		return $id;
	}
	
	public function getPerjadinYerNowBySubKomponenId ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("perjadin");
		$this->db->where("rkakl_sub_komponen_id", $id);
		$this->db->where("YEAR(dibuat_tgl)", date("Y"));
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		return $out;
	}
	
	public function getPerjadinNominatifByPerjadinId ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("perjadin_nominatif");
		$this->db->where("perjadin_id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		return $out;
	}
	
	public function getPerjadinNominatifById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("perjadin_nominatif");
		$this->db->where("id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		return $out;
	}
	
	public function saveNominatif ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("perjadin_nominatif", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("perjadin_nominatif", $data);
		}
		
		return $id;
	}
	
	public function hitungPajakPct ($golongan) {
		$pajak = $this->config->item("golongan_pajak");
		return $pajak[$golongan];
	}
	
	public function hitungPajak ($golongan, $honor) {
		$pajak = $this->config->item("golongan_pajak");
		$nominalPajak = $honor * $pajak[$golongan] / 100;
		
		return $nominalPajak;
	}
	
	public function hitungDibayarkan ($golongan, $honor) {
		$nominalPajak = $this->hitungPajak($golongan, $honor);
		$dibayarkan = $honor - $nominalPajak;
		
		return $dibayarkan;
	}
	
	public function saveNominatifDetail ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("perjadin_nominatif_detail", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("perjadin_nominatif_detail", $data);
		}
		
		return $id;
	}
	
	public function getPerjadinNominatifDetailByPerjadinNominatifId ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("perjadin_nominatif_detail");
		$this->db->where("perjadin_nominatif_id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		return $out;
	}
	
	public function getPerjadinNominatifByAkunId ($akunId) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("perjadin_nominatif");
		$this->db->where("rkakl_akun_id", $akunId);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		return $out;
	}
	
	public function getPerjadinNominatifDetailByMultiNominatifId ($multiIdPejadinNominatif) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("perjadin_nominatif_detail");
		$this->db->where_in("perjadin_nominatif_id", $multiIdPejadinNominatif);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		return $out;
	}
	
	public function deletePerjadinNominatifDetail ($id) {
		if (!empty($id)) {
			$this->db->where('id', $id);
			$this->db->delete('perjadin_nominatif_detail');
			$this->db->reset_query();
		}
	}
	
	public function deletePerjadinNominatif ($id) {
		if (!empty($id)) {
			$this->db->where('id', $id);
			$this->db->delete('perjadin_nominatif');
			$this->db->reset_query();
		}
	}
}