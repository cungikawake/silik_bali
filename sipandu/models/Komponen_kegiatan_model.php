<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komponen_kegiatan_model extends CI_Model{
	 
    function __construct() {
		// if (isset($_SESSION["tahun_anggaran"]) && !empty($_SESSION["tahun_anggaran"]) && $_SESSION["tahun_anggaran"] < date("Y")) {
		// 	$this->tablePeserta = "kegiatan_peserta_".$_SESSION["tahun_anggaran"];
		// }
    }
	 
	public function save ($table, $code_komponen, $data, $id = 0) {

		// Komponen
		$komponen = array();
		
		$this->db->select("*");
		$this->db->from('master_komponen_kegiatan');
		$this->db->where("code", $code_komponen);

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$komponen = $row;
			}
		}
		
		$this->db->reset_query();


		if (!empty($komponen)) {
			
			if (empty($id)) {
				// Kegiatan
				$kegiatan = array();
			
				$this->db->select("id, no_urut_terakhir, kode");
				$this->db->from('kegiatan');
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

				if (!isset($kegiatan["no_urut_terakhir"][$code_komponen])) {
					$kegiatan["no_urut_terakhir"][$code_komponen] = 1;
				}

				$this->db->reset_query();
				

				$data['kode']  = "";
				$data['dibuat_tgl']  = date("Y-m-d H:i:s");
				$data['diubah_tgl'] = date("Y-m-d H:i:s");
				
				if (isset($_SESSION["user"]["id"])) {
					$data['dibuat_oleh'] = $_SESSION["user"]["id"];
					$data['diubah_oleh'] = $_SESSION["user"]["id"];	
				}
				
				$this->db->insert($table, $data);
				$id = $this->db->insert_id();
				$this->db->reset_query();

				
				// Kode
				$queryNoUrut = "";
				$queryIdIn = array();
			
				$this->db->select("id");
				$this->db->from($table);
				$this->db->where("kegiatan_id", $data["kegiatan_id"]);

				$query = $this->db->get();
				
				$urutkan = 1;
				
				if($query->num_rows() > 0) {
					foreach ($query->result_array() as $row) {
						$queryNoUrut .= " WHEN ".$row["id"]." THEN '".$this->utility->penomoran($urutkan)."-".$komponen["short_code"]."-".$kegiatan["kode"]."'";
						
						$queryIdIn[] = $row["id"];
						
						$urutkan++;
					}
				}
				
				$sql = "UPDATE ".$table." SET kode = CASE id ".$queryNoUrut."  
						ELSE kode
						END 
						WHERE id IN(".implode(",",$queryIdIn).");";
				
				$this->db->query($sql);
				$this->db->reset_query(); 
				
				$kegiatan["no_urut_terakhir"][$code_komponen] = $urutkan;

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
				$this->db->update($table, $data);
				$this->db->reset_query();
			}
		}
		
		return $id;
	}
	 
	public function delete ($table, $id) {
		$this->db->where('id', $id);
		$this->db->delete($table);
		$this->db->reset_query();
	}

	public function getDetailByNik ($table,  $kegiatan, $nik) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from($table);
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

	public function getItemById ($code_komponen, $id) {
		$out = array();
		
		// Komponen
		$this->db->select("*");
		$this->db->from("master_komponen_kegiatan");
		$this->db->where("code", $code_komponen);
		
		$query = $this->db->get();

		$komponen = array();

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$komponen = $row;
			}
		}
		
		$this->db->reset_query();

		// Item
		$this->db->select("*");
		$this->db->from($komponen["table_name"]);
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

	public function getItemByKode ($code_komponen, $kode) {
		$out = array();
		
		// Komponen
		$this->db->select("*");
		$this->db->from("master_komponen_kegiatan");
		$this->db->where("code", $code_komponen);
		
		$query = $this->db->get();

		$komponen = array();

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$komponen = $row;
			}
		}
		
		$this->db->reset_query();

		// Item
		$this->db->select("*");
		$this->db->from($komponen["table_name"]);
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

	public function getAllItemByNik ($nik) {
		$out = array();
		
		// Komponen
		$this->db->select(array("code", "table_name"));
		$this->db->from("master_komponen_kegiatan");
		
		$query = $this->db->get();

		$komponen = array();

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$komponen[] = $row;
			}
		}
		
		$this->db->reset_query();

		if (!empty($komponen)) {
			foreach ($komponen as $komp) {
				// Item
				$this->db->select("*");
				$this->db->from($komp["table_name"]);
				$this->db->where("ktp", $nik);
				
				$query = $this->db->get();
				
				if($query->num_rows() > 0) {
					$out[$komp["code"]] = array();

					foreach ($query->result_array() as $row) {
						$out[$komp["code"]][] = $row;
					}
				}
				
				$this->db->reset_query();
			}
		}
		
		return $out;
	}
	
	public function getItemByKegiatanId ($code_komponen, $kegiatanId, $sortKab = false) {
		$out = array();

		// Komponen
		$this->db->select("*");
		$this->db->from("master_komponen_kegiatan");
		$this->db->where("code", $code_komponen);
		
		$query = $this->db->get();

		$komponen = array();

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$komponen = $row;
			}
		}
		
		$this->db->reset_query();

		if (!empty($komponen)) {
			$this->db->select("*");
			$this->db->from($komponen["table_name"]);
			$this->db->where("kegiatan_id", $kegiatanId);
			
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
		}
		
		return $out;
	}

	public function refreshNoUrut ($code_komponen, $kegiatanId) {
		// Komponen
		$this->db->select("*");
		$this->db->from("master_komponen_kegiatan");
		$this->db->where("code", $code_komponen);
		
		$query = $this->db->get();

		$komponen = array();

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$komponen = $row;
			}
		}
		
		$this->db->reset_query();


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
		$this->db->from($komponen["table_name"]);
		$this->db->where("kegiatan_id", $kegiatanId);

		$query = $this->db->get();

		$urutkan = 1;

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$queryNoUrut .= " WHEN ".$row["id"]." THEN '".$this->utility->penomoran($urutkan)."-".$komponen["short_code"]."-".$kegiatan["kode"]."'";

				$queryIdIn[] = $row["id"];

				$urutkan++;
			}
		}

		if (!empty($queryIdIn)) {
			$sql = "UPDATE ".$komponen["table_name"]." SET kode = CASE id ".$queryNoUrut."  
				  ELSE kode
				  END 
				  WHERE id IN(".implode(",",$queryIdIn).");";
		
			$this->db->query($sql);
			$this->db->reset_query();
		}
	}
}