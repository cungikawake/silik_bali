<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komponen_kegiatan_model extends CI_Model{
	 
    protected $group_prefix = 'transaction_';
	protected $new_db = '';

    function __construct() { 
		$db_tahun = $this->group_prefix . $_SESSION['tahun_anggaran']; 
		$this->new_db = $this->load->database($db_tahun, true);
		 
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
			
				$this->new_db->select("id, no_urut_terakhir, kode");
				$this->new_db->from('kegiatan');
				$this->new_db->where("id", $data["kegiatan_id"]);

				$query = $this->new_db->get();

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

				$this->new_db->reset_query();
				

				$data['kode']  = "";
				$data['dibuat_tgl']  = date("Y-m-d H:i:s");
				$data['diubah_tgl'] = date("Y-m-d H:i:s");
				
				if (isset($_SESSION["user"]["id"])) {
					$data['dibuat_oleh'] = $_SESSION["user"]["id"];
					$data['diubah_oleh'] = $_SESSION["user"]["id"];	
				}
				
				$this->new_db->insert($table, $data);
				$id = $this->new_db->insert_id();
				$this->new_db->reset_query();

				
				// Kode
				$queryNoUrut = "";
				$queryIdIn = array();
			
				$this->new_db->select("id");
				$this->new_db->from($table);
				$this->new_db->where("kegiatan_id", $data["kegiatan_id"]);

				$query = $this->new_db->get();
				
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
				
				$this->new_db->query($sql);
				$this->new_db->reset_query(); 
				
				$kegiatan["no_urut_terakhir"][$code_komponen] = $urutkan;

				$lastQueue = array();
				$lastQueue["no_urut_terakhir"] = json_encode($kegiatan["no_urut_terakhir"]);
				$this->new_db->where("id", $kegiatan["id"]);
				$this->new_db->update("kegiatan", $lastQueue);
				$this->new_db->reset_query();
			}
			else {
				$data['diubah_tgl'] = date("Y-m-d H:i:s");
				
				if (isset($_SESSION["user"]["id"])) {
					$data['diubah_oleh'] = $_SESSION["user"]["id"];	
				}
				
				$this->new_db->where("id", $id);
				$this->new_db->update($table, $data);
				$this->new_db->reset_query();
			}
		}
		
		return $id;
	}
	 
	public function delete ($table, $id) {
		$this->new_db->where('id', $id);
		$this->new_db->delete($table);
		$this->new_db->reset_query();
	}

	public function getDetailByNik ($table,  $kegiatan, $nik) {
		$out = array();
		
		$this->new_db->select("*");
		$this->new_db->from($table);
		$this->new_db->where("kegiatan_id", $kegiatan);
		$this->new_db->where("ktp", $nik);
		
		$query = $this->new_db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		$this->new_db->reset_query();
		
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
		$this->new_db->select("*");
		$this->new_db->from($komponen["table_name"]);
		$this->new_db->where("id", $id);
		
		$query = $this->new_db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		$this->new_db->reset_query();
		
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
		$this->new_db->select("*");
		$this->new_db->from($komponen["table_name"]);
		$this->new_db->where("kode", $kode);
		
		$query = $this->new_db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out = $row;
			}
		}
		
		$this->new_db->reset_query();
		
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
				$this->new_db->select("*");
				$this->new_db->from($komp["table_name"]);
				$this->new_db->where("ktp", $nik);
				
				$query = $this->new_db->get();
				
				if($query->num_rows() > 0) {
					$out[$komp["code"]] = array();

					foreach ($query->result_array() as $row) {
						$out[$komp["code"]][] = $row;
					}
				}
				
				$this->new_db->reset_query();
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
			$this->new_db->select("*");
			$this->new_db->from($komponen["table_name"]);
			$this->new_db->where("kegiatan_id", $kegiatanId);
			
			$this->new_db->order_by('kategori', 'ASC');
			
			if ($sortKab) {
				$this->new_db->order_by('kab_unit_kerja', 'ASC');
			}
			
			$query = $this->new_db->get();
			
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$out[] = $row;
				}
			}
			
			$this->new_db->reset_query();
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
		
		$this->new_db->select("*");
		$this->new_db->from("kegiatan");
		$this->new_db->where("id", $kegiatanId);

		$query = $this->new_db->get();

		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$kegiatan = $row;
			}
		}
		
		
		// Kode
		$queryNoUrut = "";
		$queryIdIn = array();

		$this->new_db->select("id");
		$this->new_db->from($komponen["table_name"]);
		$this->new_db->where("kegiatan_id", $kegiatanId);

		$query = $this->new_db->get();

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
		
			$this->new_db->query($sql);
			$this->new_db->reset_query();
		}
	}
}