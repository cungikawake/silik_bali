<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rkakl_model extends CI_Model{
	
    function __construct() {
    
	}
	
	public function saveProgram ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("rkakl_program", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("rkakl_program", $data);
		}
		
		return $id;
	}
	
	public function getProgramById ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_program");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out = $res;
			}
		}
		
		return $out;
	}
	
	public function saveKegiatan ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("rkakl_kegiatan", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("rkakl_kegiatan", $data);
		}
		
		return $id;
	}
	
	public function getKegiatanById ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_kegiatan");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out = $res;
			}
		}
		
		return $out;
	}
	
	public function saveOutput ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("rkakl_output", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("rkakl_output", $data);
		}
		
		return $id;
	}
	
	public function getOutputById ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_output");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out = $res;
			}
		}
		
		return $out;
	}
	
	public function saveKomponen ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("rkakl_komponen", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("rkakl_komponen", $data);
		}
		
		return $id;
	}
	
	public function getKomponenById ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_komponen");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out = $res;
			}
		}
		
		return $out;
	}
	
	public function saveSubKomponen ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("rkakl_sub_komponen", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("rkakl_sub_komponen", $data);
		}
		
		return $id;
	}
	
	public function getSubKomponenById ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_sub_komponen");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out = $res;
			}
		}
		
		return $out;
	}
	
	public function saveAkun ($data, $id = 0) {
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("rkakl_akun", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("rkakl_akun", $data);
		}
		
		return $id;
	}
	
	public function getAkunById ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_akun");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out = $res;
			}
		}
		
		return $out;
	}
	
	public function saveDetail ($data, $id = 0) {
		$volume = $data["volume_1"];
		
		if (isset($data["volume_2"]) && !empty($data["volume_2"])) {
			$volume = $volume * $data["volume_2"];
		}
		
		if (isset($data["volume_3"]) && !empty($data["volume_3"])) {
			$volume = $volume * $data["volume_3"];
		}
		
		if (isset($data["volume_4"]) && !empty($data["volume_4"])) {
			$volume = $volume * $data["volume_4"];
		}
		
		$data["anggaran"] = $volume * $data["harga_satuan"];
		
		if (empty($id)) {
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("rkakl_detail", $data);
			$id = $this->db->insert_id();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->where("id", $id);
			$this->db->update("rkakl_detail", $data);
		}
		
		$this->kalkulasiAkun($data["rkakl_akun_id"]);
		
		return $id;
	}
	
	public function getDetailById ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_detail");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out = $res;
			}
		}
		
		return $out;
	}
	
	public function kalkulasiAkun ($id) {		
		$this->db->select('*');
		$this->db->from("rkakl_detail");
		$this->db->where("rkakl_akun_id",$id);
		
		$result = $this->db->get();
		
		$anggaran = 0;
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$anggaran = $anggaran + $res["anggaran"];
			}
		}
		
		$this->db->reset_query();
		
		
		$data = array();
		$data['anggaran'] = $anggaran;
		$data['diubah_tgl'] = date("Y-m-d H:i:s");
		$data['diubah_oleh'] = $_SESSION["user"]["id"];

		$this->db->where("id", $id);
		$this->db->update("rkakl_akun", $data);
		
		$this->db->reset_query();
		
		
		$this->db->select('*');
		$this->db->from("rkakl_akun");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		$akun = array();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$akun = $res;
			}
		}
		
		$this->kalkulasiSubKomponen($akun["rkakl_sub_komponen_id"]);
	}
	
	public function kalkulasiSubKomponen ($id) {		
		$this->db->select('*');
		$this->db->from("rkakl_akun");
		$this->db->where("rkakl_sub_komponen_id",$id);
		
		$result = $this->db->get();
		
		$anggaran = 0;
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$anggaran = $anggaran + $res["anggaran"];
			}
		}
		
		$this->db->reset_query();
		
		
		$data = array();
		$data['anggaran'] = $anggaran;
		$data['diubah_tgl'] = date("Y-m-d H:i:s");
		$data['diubah_oleh'] = $_SESSION["user"]["id"];

		$this->db->where("id", $id);
		$this->db->update("rkakl_sub_komponen", $data);
		
		$this->db->reset_query();
		
		
		$this->db->select('*');
		$this->db->from("rkakl_sub_komponen");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		$subKomponen = array();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$subKomponen = $res;
			}
		}
		
		$this->kalkulasiKomponen($subKomponen["rkakl_komponen_id"]);
	}
	
	public function kalkulasiKomponen ($id) {		
		$this->db->select('*');
		$this->db->from("rkakl_sub_komponen");
		$this->db->where("rkakl_komponen_id",$id);
		
		$result = $this->db->get();
		
		$anggaran = 0;
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$anggaran = $anggaran + $res["anggaran"];
			}
		}
		
		$this->db->reset_query();
		
		
		$data = array();
		$data['anggaran'] = $anggaran;
		$data['diubah_tgl'] = date("Y-m-d H:i:s");
		$data['diubah_oleh'] = $_SESSION["user"]["id"];

		$this->db->where("id", $id);
		$this->db->update("rkakl_komponen", $data);
		
		$this->db->reset_query();
		
		
		$this->db->select('*');
		$this->db->from("rkakl_komponen");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		$komponen = array();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$komponen = $res;
			}
		}
		
		$this->kalkulasiOutput($komponen["rkakl_output_id"]);
	}
	
	public function kalkulasiOutput ($id) {		
		$this->db->select('*');
		$this->db->from("rkakl_komponen");
		$this->db->where("rkakl_output_id",$id);
		
		$result = $this->db->get();
		
		$anggaran = 0;
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$anggaran = $anggaran + $res["anggaran"];
			}
		}
		
		$this->db->reset_query();
		
		
		$data = array();
		$data['anggaran'] = $anggaran;
		$data['diubah_tgl'] = date("Y-m-d H:i:s");
		$data['diubah_oleh'] = $_SESSION["user"]["id"];

		$this->db->where("id", $id);
		$this->db->update("rkakl_output", $data);
		
		$this->db->reset_query();
		
		
		$this->db->select('*');
		$this->db->from("rkakl_output");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		$output = array();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$output = $res;
			}
		}
		
		$this->kalkulasiKegiatan($output["rkakl_kegiatan_id"]);
	}
	
	public function kalkulasiKegiatan ($id) {		
		$this->db->select('*');
		$this->db->from("rkakl_output");
		$this->db->where("rkakl_kegiatan_id",$id);
		
		$result = $this->db->get();
		
		$anggaran = 0;
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$anggaran = $anggaran + $res["anggaran"];
			}
		}
		
		$this->db->reset_query();
		
		
		$data = array();
		$data['anggaran'] = $anggaran;
		$data['diubah_tgl'] = date("Y-m-d H:i:s");
		$data['diubah_oleh'] = $_SESSION["user"]["id"];

		$this->db->where("id", $id);
		$this->db->update("rkakl_kegiatan", $data);
		
		$this->db->reset_query();
		
		
		$this->db->select('*');
		$this->db->from("rkakl_kegiatan");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		$kegiatan = array();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$kegiatan = $res;
			}
		}
		
		$this->kalkulasiProgram($kegiatan["rkakl_program_id"]);
	}
	
	public function kalkulasiProgram ($id) {		
		$this->db->select('*');
		$this->db->from("rkakl_kegiatan");
		$this->db->where("rkakl_program_id",$id);
		
		$result = $this->db->get();
		
		$anggaran = 0;
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$anggaran = $anggaran + $res["anggaran"];
			}
		}
		
		$this->db->reset_query();
		
		
		$data = array();
		$data['anggaran'] = $anggaran;
		$data['diubah_tgl'] = date("Y-m-d H:i:s");
		$data['diubah_oleh'] = $_SESSION["user"]["id"];

		$this->db->where("id", $id);
		$this->db->update("rkakl_program", $data);
		
		$this->db->reset_query();
		
		
		$this->db->select('*');
		$this->db->from("rkakl_program");
		$this->db->where("id",$id);
		
		$result = $this->db->get();
		
		$program = array();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$program = $res;
			}
		}
	}
	
	public function getAllProgramByYearNow () {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_program");
		$this->db->where("YEAR(dibuat_tgl)",date("Y"));
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out[] = $res;
			}
		}
		
		return $out;
	}
	
	public function getAllKegiatanByProgramId ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_kegiatan");
		$this->db->where("rkakl_program_id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out[] = $res;
			}
		}
		
		return $out;
	}
	
	public function getAllOutputByKegiatanId ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_output");
		$this->db->where("rkakl_kegiatan_id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out[] = $res;
			}
		}
		
		return $out;
	}
	
	public function getAllKomponenByOutputId ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_komponen");
		$this->db->where("rkakl_output_id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out[] = $res;
			}
		}
		
		return $out;
	}
	
	public function getAllSubKomponenByKomponenId ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_sub_komponen");
		$this->db->where("rkakl_komponen_id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out[] = $res;
			}
		}
		
		return $out;
	}
	
	public function getAllAkunBySubKomponenId ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_akun");
		$this->db->where("rkakl_sub_komponen_id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out[] = $res;
			}
		}
		
		return $out;
	}
	
	public function getAllDetailByAkunId ($id) {
		$out = array();
		
		$this->db->select('*');
		$this->db->from("rkakl_detail");
		$this->db->where("rkakl_akun_id",$id);
		
		$result = $this->db->get();
		
		if($result->num_rows() > 0) {
			foreach ($result->result_array() as $res) {
				$out[] = $res;
			}
		}
		
		return $out;
	}
}