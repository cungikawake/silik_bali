<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kegiatan_model extends CI_Model{
	
    function __construct() {
		
    }

	public function get_all() {
        return $this->db->get('kegiatan')->result();
    }
	
	public function countKegiatan () {
		$this->db->where("YEAR(tgl_selesai_kegiatan)", $_SESSION["tahun_anggaran"]);
		$this->db->from('kegiatan');
		
		$count = $this->db->count_all_results();
		
		return $count;
	}
	
	public function getKegiatanById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan");
		$this->db->where("id", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		$this->db->reset_query();
		
		if (isset($out["link_peserta"]) && !empty($out["link_peserta"])) {
			$out["link_peserta"] = (array) json_decode($out["link_peserta"]);
		}
		
		if (isset($out["link_narasumber"]) && !empty($out["link_narasumber"])) {
			$out["link_narasumber"] = (array) json_decode($out["link_narasumber"]);
		}
		
		if (isset($out["link_panitia"]) && !empty($out["link_panitia"])) {
			$out["link_panitia"] = (array) json_decode($out["link_panitia"]);
		}
		
		if (isset($out["link_moderator"]) && !empty($out["link_moderator"])) {
			$out["link_moderator"] = (array) json_decode($out["link_moderator"]);
		}
		
		if (isset($out["link_pp"]) && !empty($out["link_pp"])) {
			$out["link_pp"] = (array) json_decode($out["link_pp"]);
		}
		
		if (isset($out["link_fasil"]) && !empty($out["link_fasil"])) {
			$out["link_fasil"] = (array) json_decode($out["link_fasil"]);
		}
		
		if (isset($out["link_instruktur"]) && !empty($out["link_instruktur"])) {
			$out["link_instruktur"] = (array) json_decode($out["link_instruktur"]);
		}
		
		if (isset($out["link_pengawas"]) && !empty($out["link_pengawas"])) {
			$out["link_pengawas"] = (array) json_decode($out["link_pengawas"]);
		}
		
		if (isset($out["link_kepala_sekolah"]) && !empty($out["link_kepala_sekolah"])) {
			$out["link_kepala_sekolah"] = (array) json_decode($out["link_kepala_sekolah"]);
		}
		
		if (isset($out["detail_tgl_kegiatan"]) && !empty($out["detail_tgl_kegiatan"])) {
			$out["detail_tgl_kegiatan"] = (array) json_decode($out["detail_tgl_kegiatan"]);
		}
		
		if (isset($out["komponen"]) && !empty($out["komponen"])) {
			$out["komponen"] = (array) json_decode($out["komponen"]);
		}
		
		if (isset($out["kategori"]) && !empty($out["kategori"])) {
			$out["kategori"] = (array) json_decode($out["kategori"]);
		}
		
		return $out;
	}
	
	public function getKegiatanByIds ($ids) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan");
		$this->db->where_in("id", $ids);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[$row["id"]] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function getKegiatanBySpjKegiatanId ($id = "0") {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan");
		$this->db->where("spj_kegiatan", $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[$row["id"]] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function save ($data, $id = 0) {
		if (empty($id)) {
			$data['kode'] = $this->utility->kode_kegiatan();
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			$data['dibuat_oleh'] = $_SESSION["user"]["id"];
			$data['diubah_oleh'] = $_SESSION["user"]["id"];
			
			$this->db->insert("kegiatan", $data);
			$id = $this->db->insert_id();
			
			$this->db->reset_query();
			
			$kode = array();
			$kode['kode'] = $data['kode'].$id;
			
			$this->db->where("id", $id);
			$this->db->update("kegiatan", $kode);
			$this->db->reset_query();
		}
		else {
			$data['diubah_tgl'] = date("Y-m-d H:i:s");
			
			if (isset($_SESSION["user"]["id"])) {
				$data['diubah_oleh'] = $_SESSION["user"]["id"];	
			}
			
			$this->db->where("id", $id);
			$this->db->update("kegiatan", $data);
			$this->db->reset_query();
		}
		
		return $id;
	}
	
	
	public function searchKegiatanByName ($term) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan");
		$this->db->like('nama', $term, 'both');
		$this->db->order_by('nama', 'ASC');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
	
	public function turnOffForm () {
		$out = array();
		
		$date = new DateTime("now");
		$CURDATE = $date->format('Y-m-d');
		
		$dataForm = array(
			"link_peserta_on",
			"link_panitia_on",
			"link_moderator_on",
			"link_pp_on",
			"link_fasil_on",
			"link_instruktur_on",
			"link_pengawas_on",
			"link_kepala_sekolah_on"
		);
		
		$where = "DATE(tgl_selesai_kegiatan) < '".$CURDATE."' AND (";
		
		$formOn = "";
		
		foreach ($dataForm as $fm) {
			if (!empty($formOn)) {
				$formOn .= " OR ";
			}
			
			$formOn .= $fm."=1";
		}
		
		$where .= $formOn.")";
		
		$this->db->select("*");
		$this->db->from("kegiatan");
		$this->db->where($where);
		$this->db->order_by('id', 'ASC');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
}