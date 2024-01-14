<?php
	if (! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Notif {
		protected $CI;
		protected $new_db;
		public function __construct() {
			$this->CI =& get_instance();
			//$this->CI->load->database();

			$group_prefix = 'transaction_'.$_SESSION['tahun_anggaran'];
			$this->new_db = $this->CI->load->database($group_prefix, true);
			 
			/*$this->new_db->select("*");
			$this->new_db->from("pengaturan");
			$this->new_db->where("sistem", "telegram_bot_token");
			$this->new_db->order_by("pos", "ASC");

			$query = $this->new_db->get();

			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->accessToken = $row["value"];
				}
			}*/
		}
		
		public function getNotifHAI () {
			// NEW TIKET
			$this->new_db->select("*");
			$this->new_db->from("tiket");
			$this->new_db->where("user_id", "0");
			$this->new_db->where("status", "0");
			$this->new_db->where("feedback", "1");

			$query = $this->new_db->get();
			
			$count = $query->num_rows();
			
			$this->new_db->reset_query();
			
			// PROSES TIKET
			if (isset($_SESSION["user"])) {
				$this->new_db->select("*");
				$this->new_db->from("tiket");
				$this->new_db->where("user_id", $_SESSION["user"]["id"]);
				$this->new_db->where("status", "1");
				$this->new_db->where("feedback", "1");

				$query = $this->new_db->get();
				
				$count = $count + $query->num_rows();
			}
			

			return $count;
		}
		
		public function getNotifPenugasan () {
			$this->new_db->select("*");
			$this->new_db->from("penugasan_item");
			//echo "<pre>"; print_r($this->new_db); die;
			$where = "ktp='".$_SESSION["biodata"]["ktp"]."' AND (status = '0' OR status = '1' OR status = '3' OR status = '4') AND YEAR(tgl_selesai_tugas)='".$_SESSION["tahun_anggaran"]."'";
			
			$this->new_db->where($where);

			$query = $this->new_db->get();
			
			$count = $query->num_rows();
			
			$this->new_db->reset_query();
			
			return $count;
		}
		
		public function getNotifAprPenugasan () {
			if (isset($_SESSION["user"]["akses"]["kepegawaian"]["apr_penugasan"]) && $_SESSION["user"]["akses"]["kepegawaian"]["apr_penugasan"] == "1") {
				$this->new_db->select("*");
				$this->new_db->from("penugasan");
				$this->new_db->where("status", "1");

				$query = $this->new_db->get();

				$count = $query->num_rows();
				$this->new_db->reset_query();
			}
			else {
				$count = "";
			}
			
			return $count;
		}
		
		public function getNotifKepegawaianPenugasan () {
			if (isset($_SESSION["user"]["akses"]["kepegawaian"]["penugasan"]) && $_SESSION["user"]["akses"]["kepegawaian"]["penugasan"] == "1") {
				$this->new_db->select("*");
				$this->new_db->from("penugasan");
				$this->new_db->where("status", "3");

				$query = $this->new_db->get();

				$count = $query->num_rows();
				$this->new_db->reset_query();
			}
			else {
				$count = "";
			}
			
			return $count;
		}
		
		public function getNotifAprPerjadin () {
			if (isset($_SESSION["user"]["akses"]["keuangan"]["apr_perjadin"]) && $_SESSION["user"]["akses"]["keuangan"]["apr_perjadin"] == "1") {
				$this->new_db->select("*");
				$this->new_db->from("penugasan_item");
				$this->new_db->where("status", "2");

				$query = $this->new_db->get();

				$count = $query->num_rows();
				$this->new_db->reset_query();
			}
			else {
				$count = "";
			}
			
			return $count;
		}
	}
?>