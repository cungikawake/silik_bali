<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telegram extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("pengaturan_model");
	}
	
	private function contain ($string, $words) {
		foreach($words as $a) {
			if (strpos(strtolower($string),$a) !== false) return true;
		}
		
    	return false;
	}

	public function bot() {
		$telegramToken = $this->pengaturan_model->getPengaturanBySistem("telegram_bot_token");
		$token = $telegramToken["value"];
		
		$apiURL = "https://api.telegram.org/bot".$token;
        $update = json_decode(file_get_contents("php://input"), true);
        $chatID = $update["message"]["chat"]["id"];
        $message = $update["message"]["text"];
        
		$namaApp = "<b>".$this->config->item("site_name")."</b>";
		$namaBot = "<b>TEO</b>";
		$chat = "";
		
		$icon = array(
			"smile" => "\xF0\x9F\x98\x8A",
			"sad" => "\xF0\x9F\x98\x8C",
			"lol" => "\xF0\x9F\x98\x85",
			"love" => "\xF0\x9F\x92\x96",
			"smile_love" => "\xF0\x9F\x98\x8D",
			"two_hand" => "\xF0\x9F\x99\x8F"
		);
		
        if (strpos($message, "/start") === 0) {
			$this->load->model("user_model");
			$user = $this->user_model->getUserByTelegramChatId($chatID);
			
			if (!empty($user)) {
				$chat = "Hai! ".$user["nama"].", \n";
				$chat .= "Sepertinya kita sudah kenalan sebelumnya. ";
				$chat .= $namaBot." sudah mengenali data kamu. Jadi tidak perlu kenalan lagi ya! ".$icon["smile"];
				
				$chat = urlencode($chat);
				file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
			}
			else {
				$chat = "Hai! Semeton ".$_ENV['BGP_CONFIG_4'];
				file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML"); 


				$chat = "Saya bot ".$namaBot." temannya ".$namaApp.".";
				file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");

				$chat = "Saya ditugaskan oleh ".$namaApp." untuk mengingatkan dan memberitahukan semeton terkait informasi ataupun tugas yang ada di ".$namaApp;
				file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");


				$chat = "Sebelum itu, yok kita kenalan dulu. Balas chat ini dengan memasukan NIK semeton ya!. Contoh format <b>NIK.123123123123</b>";
				file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
			}
        }
		
		if (strpos($message, "NIK.") === 0) {
			$nik = str_replace("NIK.","", $message);
			
			$this->load->model("biodata_model");
			$this->load->model("user_model");
			
			$found = false;
			
			$biodata = $this->biodata_model->getBiodataByNik($nik);
			
			if (!empty($biodata)) {
				$user = $this->user_model->getUserBySyncBiodata($biodata["id"]);
				
				if (!empty($user)) {
					$found = true;
					
					$data = array();
					$data["telegram_chat_id"] = $chatID;
					
					$this->user_model->save($data, $user["id"]);
					
					$chat = "Hai! <b>".$user["nama"]."</b>,";
					file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
					
					$chat = $namaBot." sudah berhasil menemukan dan mengenali data semeton. Melalui chat ini, ".$namaBot." akan memberitahukan informasi terbaru dari ".$namaApp.".";
					file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
					
					$chat = "Jadi jangan hapus chat ini ya. Suksma ".$icon["two_hand"];
					file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
				}
			}
			
			if (!$found) {
				$chat = "Opps.. ".$namaBot." tidak bisa menemukan NIK ini ".$icon["sad"];
				file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
				
				$chat = "Pastikan NIK yang semeton inputkan sudah benar ya. Atau coba tanyakan ke Bayu ".$icon["lol"];
				file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
			}
		}
		
		if (strpos($message, "/me") === 0) {
			$this->load->model("user_model");
			$user = $this->user_model->getUserByTelegramChatId($chatID);
			
			if (!empty($user)) {
				$this->load->model("biodata_model");
				$biodata = $this->biodata_model->getBiodataById($user["sync_biodata"]);
				
				$chat = $namaBot." informasikan data semeton,\n";
				$chat .= "NIK: ".$biodata["ktp"]."\n";
				$chat .= "Nama: ".$biodata["nama"]."\n";
				$chat .= "Tempat lahir: ".$biodata["tempat_lahir"]."\n";
				$chat .= "Tgl lahir: ".date("d-m-Y", strtotime($biodata["tgl_lahir"]))."\n";
				$chat .= "NPWP: ".$biodata["npwp"]."\n";
				$chat .= "Jabatan: ".$biodata["jabatan"]."\n";
				$chat .= "Satker: ".$biodata["unit_kerja"]."\n";
				
				$chat = urlencode($chat);
				file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
			}
		}
		
		// Terimakasih
		$words = array("terimakasih","terima kasih");
		
		if ($this->contain($message, $words)) {
			$chat = "Terimakasih kembali ".$icon["smile"];
			file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
		}
		
		// Suksma
		$words = array("suksma","suksema");
		if ($this->contain($message, $words)) {
			$chat = "Suksma mewali ".$icon["smile"];
			file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
		}
		
		// Suksma
		$words = array("i love u","iloveu","loveu","i love you","love you","love u");
		if ($this->contain($message, $words)) {
			$chat = "Love you too ".$icon["love"];
			file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
		}
		
		$words = array("miss u","missu","miss you","missyou");
		if ($this->contain($message, $words)) {
			$chat = "Miss you more ".$icon["smile_love"];
			file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
		}
		
		if (strpos(strtolower($message), $_ENV['BGP_CONFIG_1']) === 0) {
			$chat = urlencode("<b>".$_ENV['BGP_CONFIG_5']."</b>\n<i>Saguyub Nangun Janakerthih</i>");
			file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
		}
		
		// Chat Unrecognise
		if (empty($chat)) {
			$chat = "Opps.. ".$namaBot." masih belum paham maksud pertanyaan ini 😌.";
			file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
			
			$chat = "Tapi nanti ".$namaBot." akan pelajari lagi \xF0\x9F\x98\x8A.";
			file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$chat."&parse_mode=HTML");
		}
	}
}