<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_model extends CI_Model{
	
    function __construct() {
		
    }
	
	public function getLaporanPenugasan ($ktps) {
		$out = array();
		
		$this->db->select("ktp, SUM(pesawat_berangkat) AS sum_pesawat_berangkat, SUM(pesawat_pulang) AS sum_pesawat_pulang, SUM(taksi_berangkat) AS sum_taksi_berangkat, SUM(taksi_pulang) AS sum_taksi_pulang, SUM(transport) AS sum_transport, SUM(transport_lainnya) AS sum_transport_lainnya, SUM(uang_harian) AS sum_uang_harian, SUM(penginapan) AS sum_penginapan");
		$this->db->from("spj_item");
		$this->db->where_in("ktp",$ktps);
		$this->db->where('YEAR(dibuat_tgl)', $_SESSION["tahun_anggaran"]);
		$this->db->group_by("ktp");
		$this->db->order_by('ktp', 'DESC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[$row["ktp"]] = $row; 
			}
		}
		
		$this->db->reset_query();
		
		return $out;
	}
}