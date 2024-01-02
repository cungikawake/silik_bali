<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kepala_sekolah_model extends CI_Model{
	
    function __construct() {
		
    }
	
	public function get ($kegiatan, $nik) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan_kepala_sekolah");
		$this->db->where("kegiatan_id", $kegiatan);
		$this->db->where("ktp", $nik);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan_kepala_sekolah");
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
	
	public function getByIds ($ids) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan_kepala_sekolah");
		$this->db->where_in('id', $ids);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getByKode ($kode) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan_kepala_sekolah");
		$this->db->where("kode", $kode);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getByNik ($nik) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan_kepala_sekolah");
		$this->db->where("ktp", $nik);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getByKegiatan ($kegiatan, $sortKab = false) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan_kepala_sekolah");
		$this->db->where("kegiatan_id", $kegiatan);
		
		$this->db->order_by('kategori', 'ASC');
		
		if ($sortKab) {
			$this->db->order_by('kab_unit_kerja', 'ASC');
		}
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getByKegiatanIdNik ($kegiatanId, $ktp) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan_kepala_sekolah");
		$this->db->where("kegiatan_id", $kegiatanId);
		$this->db->where("ktp", $ktp);
		
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
			$kegiatan = array();
		
			$this->db->select("*");
			$this->db->from("kegiatan");
			$this->db->where("id", $data["kegiatan_id"]);

			$query = $this->db->get();

			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$kegiatan = $row;
				}
			}
			
			if (!empty($kegiatan["no_urut_terakhir"])) {
				$kegiatan["no_urut_terakhir"] = json_decode($kegiatan["no_urut_terakhir"],true);
			}
			else {
				$kegiatan["no_urut_terakhir"] = array();
			}

			if (!isset($kegiatan["no_urut_terakhir"]["kepala_sekolah"])) {
				$kegiatan["no_urut_terakhir"]["kepala_sekolah"] = 1;
			}
			
			$this->db->reset_query();
			
			$data['kode']  = "";
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			
			if (isset($_SESSION["user"]["id"])) {
				$data['dibuat_oleh'] = $_SESSION["user"]["id"];
				$data['diubah_oleh'] = $_SESSION["user"]["id"];	
			}
			
			$this->db->insert("kegiatan_kepala_sekolah", $data);
			$id = $this->db->insert_id();
			$this->db->reset_query();
			
			$kode = array();
			$kode["kode"] = $this->utility->penomoran($kegiatan["no_urut_terakhir"]["kepala_sekolah"])."-KS-".$kegiatan["kode"];
			
			$this->db->where("id", $id);
			$this->db->update("kegiatan_kepala_sekolah", $kode);
			$this->db->reset_query();
			
			$kegiatan["no_urut_terakhir"]["kepala_sekolah"] = $kegiatan["no_urut_terakhir"]["kepala_sekolah"] + 1;

			$lastQueue = array();
			$lastQueue["no_urut_terakhir"] = json_encode($kegiatan["no_urut_terakhir"]);
			$this->db->where("id", $kegiatan["id"]);
			$this->db->update("kegiatan", $lastQueue);
			$this->db->reset_query();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			
			if (isset($_SESSION["user"]["id"])) {
				$data['diubah_oleh'] = $_SESSION["user"]["id"];	
			}
			
			$this->db->where("id", $id);
			$this->db->update("kegiatan_kepala_sekolah", $data);
			$this->db->reset_query();
		}
		
		return $id;
	}
	
	public function delete ($id) {
		$this->db->where('id', $id);
		$this->db->delete('kegiatan_kepala_sekolah');
		$this->db->reset_query();
	}
}