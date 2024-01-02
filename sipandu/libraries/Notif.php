<?php
	if (! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Notif {
		protected $CI;
		
		public function __construct() {
			$this->CI =& get_instance();
			$this->CI->load->database();
			
			/*$this->CI->db->select("*");
			$this->CI->db->from("pengaturan");
			$this->CI->db->where("sistem", "telegram_bot_token");
			$this->CI->db->order_by("pos", "ASC");

			$query = $this->CI->db->get();

			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->accessToken = $row["value"];
				}
			}*/
		}
		
		public function getNotifHAI () {
			// NEW TIKET
			$this->CI->db->select("*");
			$this->CI->db->from("tiket");
			$this->CI->db->where("user_id", "0");
			$this->CI->db->where("status", "0");
			$this->CI->db->where("feedback", "1");

			$query = $this->CI->db->get();
			
			$count = $query->num_rows();
			
			$this->CI->db->reset_query();
			
			// PROSES TIKET
			if (isset($_SESSION["user"])) {
				$this->CI->db->select("*");
				$this->CI->db->from("tiket");
				$this->CI->db->where("user_id", $_SESSION["user"]["id"]);
				$this->CI->db->where("status", "1");
				$this->CI->db->where("feedback", "1");

				$query = $this->CI->db->get();
				
				$count = $count + $query->num_rows();
			}
			

			return $count;
		}
		
		public function getNotifPenugasan () {
			$this->CI->db->select("*");
			$this->CI->db->from("penugasan_item");
			
			$where = "ktp='".$_SESSION["biodata"]["ktp"]."' AND (status = '0' OR status = '1' OR status = '3' OR status = '4') AND YEAR(tgl_selesai_tugas)='".$_SESSION["tahun_anggaran"]."'";
			
			$this->CI->db->where($where);

			$query = $this->CI->db->get();
			
			$count = $query->num_rows();
			
			$this->CI->db->reset_query();
			
			return $count;
		}
		
		public function getNotifAprPenugasan () {
			if (isset($_SESSION["user"]["akses"]["kepegawaian"]["apr_penugasan"]) && $_SESSION["user"]["akses"]["kepegawaian"]["apr_penugasan"] == "1") {
				$this->CI->db->select("*");
				$this->CI->db->from("penugasan");
				$this->CI->db->where("status", "1");

				$query = $this->CI->db->get();

				$count = $query->num_rows();
				$this->CI->db->reset_query();
			}
			else {
				$count = "";
			}
			
			return $count;
		}
		
		public function getNotifKepegawaianPenugasan () {
			if (isset($_SESSION["user"]["akses"]["kepegawaian"]["penugasan"]) && $_SESSION["user"]["akses"]["kepegawaian"]["penugasan"] == "1") {
				$this->CI->db->select("*");
				$this->CI->db->from("penugasan");
				$this->CI->db->where("status", "3");

				$query = $this->CI->db->get();

				$count = $query->num_rows();
				$this->CI->db->reset_query();
			}
			else {
				$count = "";
			}
			
			return $count;
		}
		
		public function getNotifAprPerjadin () {
			if (isset($_SESSION["user"]["akses"]["keuangan"]["apr_perjadin"]) && $_SESSION["user"]["akses"]["keuangan"]["apr_perjadin"] == "1") {
				$this->CI->db->select("*");
				$this->CI->db->from("penugasan_item");
				$this->CI->db->where("status", "2");

				$query = $this->CI->db->get();

				$count = $query->num_rows();
				$this->CI->db->reset_query();
			}
			else {
				$count = "";
			}
			
			return $count;
		}
	}
?>