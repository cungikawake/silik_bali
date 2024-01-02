<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Validasi_ttd_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
	
	public function get($jenisBerkas, $IdBerkas, $posisiTtd = "") {
		$out = array();
		
		$where = array();
		$where["jenis_berkas"] = $jenisBerkas;
		$where["id_berkas"] = $IdBerkas;
		
		if (!empty($posisiTtd)) {
			$where["posisi_ttd"] = $posisiTtd;
		}
		
		$this->db->where($where);
		
		$this->db->select('*');
		$this->db->from('validasi_ttd');
		
		$valids = $this->db->get();
		
		if($valids->num_rows() > 0) {
			foreach ($valids->result_array() as $key => $foo) {
				$foo["detail"] = json_decode($foo["detail"], true);
				$out[] = $foo;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getByKode($kode) {
		$out = array();
		
		$where = array();
		$where["kode"] = $kode;
		
		$this->db->where($where);
		
		$this->db->select('*');
		$this->db->from('validasi_ttd');
		
		$valids = $this->db->get();
		
		if($valids->num_rows() > 0) {
			foreach ($valids->result_array() as $key => $foo) {
				$foo["detail"] = json_decode($foo["detail"], true);
				$out = $foo;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function save ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
			
			$this->db->insert("validasi_ttd", $data);
			$id = $this->db->insert_id();
			
			$data = array();
			$data["kode"] = md5($id."BayuPrawira");
			
			$this->db->where("id", $id);
			$this->db->update("validasi_ttd", $data);
		}
		else {
			$this->db->where("id", $id);
			$this->db->update("validasi_ttd", $data);
		}
		
		return $id;
	}
}
?>