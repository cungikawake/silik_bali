<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komponen_kegiatan_model extends CI_Model{
	 
    function __construct() {
		// if (isset($_SESSION["tahun_anggaran"]) && !empty($_SESSION["tahun_anggaran"]) && $_SESSION["tahun_anggaran"] < date("Y")) {
		// 	$this->tablePeserta = "kegiatan_peserta_".$_SESSION["tahun_anggaran"];
		// }
    }
	
	 
	public function save ($table, $code_komponen, $data, $id = 0) {

		if (empty($id)) {
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
					$queryNoUrut .= " WHEN ".$row["id"]." THEN '".$this->utility->penomoran($urutkan)."-PS-".$kegiatan["kode"]."'";
					
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
	
	 
}