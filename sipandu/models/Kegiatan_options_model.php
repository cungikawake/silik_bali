<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kegiatan_options_model extends CI_Model{
	
    function __construct() {

    }
	
	public function get ($kegiatanId, $komponen = 0, $key = 0) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan_options");
		$this->db->where("kegiatan_id", $kegiatanId);

		if (!empty($komponen)) {
			$this->db->where("code_komponen", $komponen);
		}

		if (!empty($key)) {
			$this->db->where("key", $key);
		}
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {

				// Parse Json to Array
				if ($row["key"] == "link") {
					$row["value"] = json_decode($row["value"], true);
				}

				if ($row["key"] == "kategori") {
					$row["value"] = json_decode($row["value"], true);
				}

				$out[$row["id"]] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function save ($data, $id = 0) {

		if (empty($id)) {
			$this->db->insert("kegiatan_options", $data);
			$id = $this->db->insert_id();
			$this->db->reset_query();
		}
		else {			
			$this->db->where("id", $id);
			$this->db->update("kegiatan_options", $data);
			$this->db->reset_query();
		}
		
		return $id;
	}
	
	public function delete ($id) {
		
		$this->db->where('id', $id);
		$this->db->delete("kegiatan_options");
		$this->db->reset_query();
	}
}