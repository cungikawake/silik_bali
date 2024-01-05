<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_model extends CI_Model{
	var $tablePeserta = "kegiatan_peserta";
	
    function __construct() {
		if (isset($_SESSION["tahun_anggaran"]) && !empty($_SESSION["tahun_anggaran"]) && $_SESSION["tahun_anggaran"] < date("Y")) {
			$this->tablePeserta = "kegiatan_peserta_".$_SESSION["tahun_anggaran"];
		}
    }
	
	public function getPeserta ($kegiatan, $nik) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from($this->tablePeserta);
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
	
	public function getPesertaById ($id) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from($this->tablePeserta);
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
		$this->db->from($this->tablePeserta);
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
	
	public function getPesertaByKode ($kode) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from($this->tablePeserta);
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
	
	public function getPesertaAllYearsByKode ($kode) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from($this->tablePeserta);
		$this->db->where("kode", $kode);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		$this->db->reset_query();
		
		if (empty($out)) {
		    $this->db->select("*");
    		$this->db->from("kegiatan_peserta_2022");
    		$this->db->where("kode", $kode);
    		
    		$query = $this->db->get();
    		
    		if($query->num_rows() > 0) {
    			foreach ($query->result_array() as $row) {
    				$out = $row;
    			}
    		}
    		
    		$this->db->reset_query();
		}
		
		return $out;
	}
	
	public function getPesertaKegiatan ($kegiatan, $sortKab = false) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from($this->tablePeserta);
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
	
	public function getPesertaByNik ($nik) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from($this->tablePeserta);
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
	
	public function getPesertaAllYearsByNik ($nik) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from($this->tablePeserta);
		$this->db->where("ktp", $nik);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		$this->db->reset_query();
		
		$this->db->select("*");
		$this->db->from("kegiatan_peserta_2022");
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
	
	public function getByKegiatanIdNik ($kegiatanId, $ktp) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from($this->tablePeserta);
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
		
			$this->db->select("id, no_urut_terakhir, kode");
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

			if (!isset($kegiatan["no_urut_terakhir"]["peserta"])) {
				$kegiatan["no_urut_terakhir"]["peserta"] = 1;
			}
			
			
			$this->db->reset_query();
			
			$data['kode']  = "";
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			
			if (isset($_SESSION["user"]["id"])) {
				$data['dibuat_oleh'] = $_SESSION["user"]["id"];
				$data['diubah_oleh'] = $_SESSION["user"]["id"];	
			}
			
			$this->db->insert($this->tablePeserta, $data);
			$id = $this->db->insert_id();
			$this->db->reset_query();
			
			
			
			// Kode
			$queryNoUrut = "";
			$queryIdIn = array();
		
			$this->db->select("id");
			$this->db->from($this->tablePeserta);
			$this->db->where("kegiatan_id", $data["kegiatan_id"]);

			$query = $this->db->get();
			
			$urutkan = 1;
			
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$queryNoUrut .= " WHEN ".$row["id"]." THEN '".$this->utility->penomoran($urutkan)."-PS-".$kegiatan["kode"]."'";
					
					$queryIdIn[] = $row["id"];
					
					$urutkan++;
				}
			}
			
			$sql = "UPDATE ".$this->tablePeserta." SET kode = CASE id ".$queryNoUrut."  
                      ELSE kode
                      END 
					  WHERE id IN(".implode(",",$queryIdIn).");";
			
			$this->db->query($sql);
			$this->db->reset_query();
				
			
			
			$kegiatan["no_urut_terakhir"]["peserta"] = $urutkan;

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
			$this->db->update($this->tablePeserta, $data);
			$this->db->reset_query();
		}
		
		return $id;
	}
	
	public function save2 ($data, $id = 0) {

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

			if (!isset($kegiatan["no_urut_terakhir"]["peserta"])) {
				$kegiatan["no_urut_terakhir"]["peserta"] = 1;
			}
			
			
			$this->db->reset_query();
			
			$data['kode']  = "";
			$data['dibuat_tgl']  = date("Y-m-d H:i:s");
            $data['diubah_tgl'] = date("Y-m-d H:i:s");
			
			if (isset($_SESSION["user"]["id"])) {
				$data['dibuat_oleh'] = $_SESSION["user"]["id"];
				$data['diubah_oleh'] = $_SESSION["user"]["id"];	
			}
			
			$this->db->insert($this->tablePeserta, $data);
			$id = $this->db->insert_id();
			$this->db->reset_query();
			
			$kode = array();
			
			$kode["kode"] = $this->utility->penomoran($kegiatan["no_urut_terakhir"]["peserta"])."-PS-".$kegiatan["kode"];
			
			$kodeLolos = 0;
			
			while ($kodeLolos < 1) {
				$sudahAdaKode = $this->getPesertaByKode($kode["kode"]);
				
				if (!empty($sudahAdaKode)) {
			    	$kegiatan["no_urut_terakhir"]["peserta"] = $kegiatan["no_urut_terakhir"]["peserta"] + 1;
			    
			    	$kode["kode"] = $this->utility->penomoran($kegiatan["no_urut_terakhir"]["peserta"])."-PS-".$kegiatan["kode"];
				}
				else {
					$kodeLolos = 1;
				}
			}
			
			
			/*$kodeLolos = 0;
			
			while ($kodeLolos < 1) {
				$sudahAdaKode = $this->getPesertaByKode($kode["kode"]);
				
				if (!empty($sudahAdaKode)) {
			    	$kegiatan["no_urut_terakhir"]["peserta"] = $kegiatan["no_urut_terakhir"]["peserta"] + 1;
			    
			    	$kode["kode"] = $this->utility->penomoran($kegiatan["no_urut_terakhir"]["peserta"])."-PS-".$kegiatan["kode"];
				}
				else {
					$kodeLolos = 1;
				}
			}*/
			

			$this->db->where("id", $id);
			$this->db->update($this->tablePeserta, $kode);
			$this->db->reset_query();

			$kegiatan["no_urut_terakhir"]["peserta"] = $kegiatan["no_urut_terakhir"]["peserta"] + 1;

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
			$this->db->update($this->tablePeserta, $data);
			$this->db->reset_query();
		}
		
		return $id;
	}
	
	public function delete ($id) {
		
		$this->db->where('id', $id);
		$this->db->delete($this->tablePeserta);
		$this->db->reset_query();
	}
	
	public function refreshNoUrutPeserta ($kegiatanId) {
		
		$kegiatan = array();
		
		$this->db->select("*");
		$this->db->from("kegiatan");
		$this->db->where("id", $kegiatanId);

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$kegiatan = $row;
			}
		}
		
		
		// Kode
		$queryNoUrut = "";
		$queryIdIn = array();

		$this->db->select("id");
		$this->db->from($this->tablePeserta);
		$this->db->where("kegiatan_id", $kegiatanId);

		$query = $this->db->get();

		$urutkan = 1;

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$queryNoUrut .= " WHEN ".$row["id"]." THEN '".$this->utility->penomoran($urutkan)."-PS-".$kegiatan["kode"]."'";

				$queryIdIn[] = $row["id"];

				$urutkan++;
			}
		}

		$sql = "UPDATE ".$this->tablePeserta." SET kode = CASE id ".$queryNoUrut."  
				  ELSE kode
				  END 
				  WHERE id IN(".implode(",",$queryIdIn).");";
		
		$this->db->query($sql);
		$this->db->reset_query();
	}
}