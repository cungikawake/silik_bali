<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suka_duka_model extends CI_Model{
	
    function __construct() {
    }
	
	public function getPembayaranItem ($userId = 0, $year = 0, $month = 0) {
		$out = array();
		
		$this->db->select("*");
		$this->db->from("suka_duka_pembayaran_item");
		
		if (!empty($userId)) {
			$this->db->where("user_id", $userId);
		}
		
		if (!empty($year)) {
			$this->db->where("tahun", $year);
		}
		
		if (!empty($month)) {
			$this->db->where("bulan", $month);
		}
		
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$out[] = $row;
			}
		}
		
		return $out;
	}
}