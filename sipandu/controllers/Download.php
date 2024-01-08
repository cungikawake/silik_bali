<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->sertifikat();
	}
	
	public function sertifikat ($kode = null, $html = null) {
		$data = array();
		
		if (!empty($kode)) {
			$this->load->model("narasumber_model");
			$this->load->model("peserta_model");
			$this->load->model("panitia_model");
			$this->load->model("moderator_model");
			$this->load->model("instruktur_model");
			$this->load->model("pengajar_praktek_model");
			$this->load->model("fasilitator_model");
			$this->load->model("sertifikat_model");
			$this->load->model("kegiatan_model");
			
			$data = array();
			$jabatan = "peserta";
			$data["person"] = $this->peserta_model->getPesertaAllYearsByKode($kode);
			
			if (empty($data["person"])) {
				$jabatan = "panitia";
				$data["person"] = $this->panitia_model->getPanitiaByKode($kode);
			}
			
			if (empty($data["person"])) {
				$jabatan = "narasumber";
				$data["person"] = $this->narasumber_model->getNarasumberByKode($kode);
			}
			
			if (empty($data["person"])) {
				$jabatan = "moderator";
				$data["person"] = $this->moderator_model->getByKode($kode);
			}
			
			if (empty($data["person"])) {
				$jabatan = "instruktur";
				$data["person"] = $this->instruktur_model->getByKode($kode);
			}
			
			if (empty($data["person"])) {
				$jabatan = "pengajar_praktek";
				$data["person"] = $this->pengajar_praktek_model->getByKode($kode);
			}
			
			if (empty($data["person"])) {
				$jabatan = "fasilitator";
				$data["person"] = $this->fasilitator_model->getByKode($kode);
			}
			
			if (!empty($data["person"])) {
				$kegiatanId = $data["person"]["kegiatan_id"];
				
				$data["kegiatan"] = $this->kegiatan_model->getKegiatanById($kegiatanId);
				
				// Generate QR Code
				$this->load->library('qr_code');
				$urlSertifikat = base_url("/download/sertifikat/".$kode);
				$data["qr_code"] = $this->qr_code->create(400, $urlSertifikat);
				
				// HACK Sertifikat Nomor to Slash
				$countHype = substr_count ($kode, '-');

				if ($countHype == 2) {
					$kodeItem = explode("-", $data["person"]["kode"]);

					$kodeBaru = $kodeItem[0]."/".$kodeItem[2].".".$kodeItem[1];
					$data["person"]["kode"] = $kodeBaru;
				}
				
				
				if (!empty($data["kegiatan"])) {
					if ($jabatan == "narasumber") {
						$templateId = $data["kegiatan"]["sertificate_narasumber"];
					}
					else if ($jabatan == "panitia") {
						$templateId = $data["kegiatan"]["sertificate_panitia"];
					}
					else if ($jabatan == "moderator") {
						$templateId = $data["kegiatan"]["sertificate_moderator"];
					}
					else if ($jabatan == "instruktur") {
						$templateId = $data["kegiatan"]["sertificate_instruktur"];
					}
					else if ($jabatan == "pengajar_praktek") {
						$templateId = $data["kegiatan"]["sertificate_pp"];
					}
					else if ($jabatan == "fasilitator") {
						$templateId = $data["kegiatan"]["sertificate_fasil"];
					}
					else {
						$templateId = $data["kegiatan"]["sertificate_peserta"];
					}
					
					if ($templateId) {
						$data["sertifikat"] = $this->sertifikat_model->getById($templateId);
						$html = $this->load->view('template/sertifikat', $data, true);

						$this->mpdf->createSertifikat($html, "sertifikat", false);	
					}
				}
			}
		}
		else {
			$this->load->view('/frontend/sertifikat/download', $data);	
		}
	}
	
	public function table_sertifikat () {
		$html = "<div class='alert alert-danger' style='text-align:center;'>Anda belum memiliki sertifikat</div>";
		
		if (isset($_POST["nik"]) & !empty($_POST["nik"]) && isset($_POST["captchaToken"]) & !empty($_POST["captchaToken"])) {
			
			$token = $_POST['captchaToken'];
			$action = $_POST['captchaAction'];

			// call curl to POST request
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => "6LcFeHAhAAAAACqaawpUKfqCjOwS8xWgVP-slo3D", 'response' => $token)));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);
			$arrResponse = json_decode($response, true);

			// verify the response
			if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
			
				$this->load->model("kegiatan_model");
				$this->load->model("peserta_model");
				$this->load->model("narasumber_model");
				$this->load->model("moderator_model");
				$this->load->model("instruktur_model");
				$this->load->model("fasilitator_model");
				$this->load->model("pengajar_praktek_model");
				$this->load->model("panitia_model");

				$data = array();
				$peserta = $this->peserta_model->getPesertaAllYearsByNik($_POST["nik"]);
				$panitia = $this->panitia_model->getPanitiaByNik($_POST["nik"]);
				$narasumber = $this->narasumber_model->getNarasumberByNik($_POST["nik"]);
				$moderator = $this->moderator_model->getByNik($_POST["nik"]);
				$instruktur = $this->instruktur_model->getByNik($_POST["nik"]);
				$fasilitator = $this->fasilitator_model->getByNik($_POST["nik"]);
				$pengajar_praktek = $this->pengajar_praktek_model->getByNik($_POST["nik"]);

				if (!empty($peserta)) {
					foreach ($peserta as $ps) {
						$data["sertifikats"]["peserta"][] = $ps;
					}
				}
				
				if (!empty($narasumber)) {
					foreach ($narasumber as $ps) {
						$data["sertifikats"]["narasumber"][] = $ps;
					}
				}
				
				if (!empty($moderator)) {
					foreach ($moderator as $ps) {
						$data["sertifikats"]["moderator"][] = $ps;
					}
				}

				if (!empty($panitia)) {
					foreach ($panitia as $ps) {
						$data["sertifikats"]["panitia"][] = $ps;
					}
				}

				

				if (!empty($instruktur)) {
					foreach ($instruktur as $ps) {
						$data["sertifikats"]["instruktur"][] = $ps;
					}
				}

				if (!empty($fasilitator)) {
					foreach ($fasilitator as $ps) {
						$data["sertifikats"]["fasilitator"][] = $ps;
					}
				}

				if (!empty($pengajar_praktek)) {
					foreach ($pengajar_praktek as $ps) {
						$data["sertifikats"]["pengajar_praktek"][] = $ps;
					}
				}


				if (!empty($data["sertifikats"])) {
					$lookupIdKegiatan = array();

					if (!empty($data["sertifikats"]["peserta"])) {
						foreach ($data["sertifikats"]["peserta"] as $sertifikat) {
							$lookupIdKegiatan[] = $sertifikat["kegiatan_id"];
						}
					}
					
					if (!empty($data["sertifikats"]["narasumber"])) {
						foreach ($data["sertifikats"]["narasumber"] as $sertifikat) {
							$lookupIdKegiatan[] = $sertifikat["kegiatan_id"];
						}
					}
					
					if (!empty($data["sertifikats"]["moderator"])) {
						foreach ($data["sertifikats"]["moderator"] as $sertifikat) {
							$lookupIdKegiatan[] = $sertifikat["kegiatan_id"];
						}
					}

					if (!empty($data["sertifikats"]["panitia"])) {
						foreach ($data["sertifikats"]["panitia"] as $sertifikat) {
							$lookupIdKegiatan[] = $sertifikat["kegiatan_id"];
						}
					}

					if (!empty($data["sertifikats"]["instruktur"])) {
						foreach ($data["sertifikats"]["instruktur"] as $sertifikat) {
							$lookupIdKegiatan[] = $sertifikat["kegiatan_id"];
						}
					}

					if (!empty($data["sertifikats"]["fasilitator"])) {
						foreach ($data["sertifikats"]["fasilitator"] as $sertifikat) {
							$lookupIdKegiatan[] = $sertifikat["kegiatan_id"];
						}
					}

					if (!empty($data["sertifikats"]["pengajar_praktek"])) {
						foreach ($data["sertifikats"]["pengajar_praktek"] as $sertifikat) {
							$lookupIdKegiatan[] = $sertifikat["kegiatan_id"];
						}
					}

					$lookupIdKegiatan = array_unique($lookupIdKegiatan);

					$data["kegiatan"] = $this->kegiatan_model->getKegiatanByIds($lookupIdKegiatan);

					$html = $this->load->view('/frontend/sertifikat/table_download', $data, true);
				}
			}
			else {
				$html = "<div class='alert alert-warning' style='text-align:center;'>Protect by reCAPTCHA ~ Contact Developer</div>";
			}
		}
		
		print $html;
	}
	
	public function sppd_peserta ($kegiatanId = "", $download = null) {
		$this->load->model("kegiatan_model");
		
		$data = array();
		$data["kegiatan_id"] = $kegiatanId;
		$data["kegiatan"] = $this->kegiatan_model->getKegiatanById($kegiatanId);
		
		if ($download == "execute") {
			if (empty($kegiatanId)) {
				$this->load->view('frontend/errors/logo');
			}
			else {

				if (empty($data["kegiatan"])) {
					$this->load->view('frontend/errors/logo');
				}
				else {
					if (empty($data["kegiatan"]["kab_tempat_kegiatan"])) {
						$data["kegiatan"]["kab_tempat_kegiatan"] = "Denpasar";
					}
					
					$dataPeserta = array();
					$dataPeserta["kab"] = "";
					$dataPeserta["nama"] = "";
					$dataPeserta["unit_kerja"] = "";
					$dataPeserta["jabatan"] = "";
					$dataPeserta["nip"] = "";
					
					if (isset($_GET["unit_kerja"]) && !empty($_GET["unit_kerja"])) {
						$dataPeserta["unit_kerja"] = $_GET["unit_kerja"];
					}
					
					if (isset($_GET["kab_unit_kerja"]) && !empty($_GET["kab_unit_kerja"])) {
						$dataPeserta["kab"] = $_GET["kab_unit_kerja"];
					}
					
					if (isset($_GET["nama"]) && !empty($_GET["nama"])) {
						$dataPeserta["nama"] = $_GET["nama"];
					}
					
					if (isset($_GET["jabatan"]) && !empty($_GET["jabatan"])) {
						$dataPeserta["jabatan"] = $_GET["jabatan"];
					}
					
					if (isset($_GET["nip"]) && !empty($_GET["nip"])) {
						$dataPeserta["nip"] = $_GET["nip"];
					}
					
					$data["pejabat_peserta"] = $dataPeserta;
					$data["ppk"] = array("nama" => "", "nip" => "");

					$this->load->model("pengaturan_model");
					$this->load->model("biodata_model");
					
					$ppk = $this->pengaturan_model->getPengaturanBySistem("ppk");
					
					if (!empty($ppk)) {
						$biodataId = $ppk["value"];
						
						$data["ppk"] = $this->biodata_model->getBiodataById($biodataId);
					}

					$html = $this->load->view('template/sppd_peserta', $data, true);

					$this->mpdf->createSPPD($html, "sppd", false);
				}
			}
		}
		else {
			$this->load->view('/frontend/sppd/download', $data);
		}
	}
	
	public function tembak_sppd_peserta ($kegiatanId = "", $download = null) {
		$data = array();
		$data["kegiatan_id"] = $kegiatanId;
		
		if ($download == "execute") {
			if (empty($kegiatanId)) {
				$this->load->view('frontend/errors/logo');
			}
			else {
				$this->load->model("kegiatan_model");
				$data["kegiatan"] = $this->kegiatan_model->getKegiatanById($kegiatanId);

				if (empty($data["kegiatan"])) {
					$this->load->view('frontend/errors/logo');
				}
				else {
					if (empty($data["kegiatan"]["kab_tempat_kegiatan"])) {
						$data["kegiatan"]["kab_tempat_kegiatan"] = "Denpasar";
					}
					
					$dataPeserta = array();
					$dataPeserta["kab"] = "";
					$dataPeserta["id"] = "";
					$dataPeserta["nama"] = "";
					$dataPeserta["unit_kerja"] = "";
					$dataPeserta["jabatan"] = "";
					$dataPeserta["nip"] = "";
					
					$this->load->model("pengaturan_model");
					$this->load->model("biodata_model");
					
					if (isset($_GET["pejabat"]) && !empty($_GET["pejabat"])) {
						$biodataId = $_GET["pejabat"];
						$pejabat = $this->biodata_model->getBiodataById($biodataId);
						
						if (!empty($pejabat)) {
							$dataPeserta["id"] = $pejabat["id"];
							$dataPeserta["nama"] = $pejabat["nama"];
							$dataPeserta["unit_kerja"] = $pejabat["unit_kerja"];
							$dataPeserta["jabatan"] = $pejabat["jabatan"];
							$dataPeserta["nip"] = $pejabat["nip"];
						}
					}
					
					$data["pejabat_peserta"] = $dataPeserta;
					$data["ppk"] = array("nama" => "", "nip" => "");
					
					$ppk = $this->pengaturan_model->getPengaturanBySistem("ppk");
					
					if (!empty($ppk)) {
						$biodataId = $ppk["value"];
						
						$data["ppk"] = $this->biodata_model->getBiodataById($biodataId);
					}
					
					$html = $this->load->view('template/tembak_sppd_peserta', $data, true);

					$this->mpdf->createSPPD($html, "sppd", false);
				}
			}
		}
		else {
			
			$this->load->model("pengaturan_model");
			$this->load->model("biodata_model");
			
			$kepala = $this->pengaturan_model->getPengaturanBySistem("kepala");

			if (!empty($kepala)) {
				$biodataId = $kepala["value"];

				$data["pejabat"][] = $this->biodata_model->getBiodataById($biodataId);
			}
			
			$kasubbag = $this->pengaturan_model->getPengaturanBySistem("kasubbag");

			if (!empty($kasubbag)) {
				$biodataId = $kasubbag["value"];

				$data["pejabat"][] = $this->biodata_model->getBiodataById($biodataId);
			}
			
			$ppk = $this->pengaturan_model->getPengaturanBySistem("ppk");

			if (!empty($ppk)) {
				$biodataId = $ppk["value"];

				$data["pejabat"][] = $this->biodata_model->getBiodataById($biodataId);
			}
			
			$this->load->view('/frontend/sppd/tembak', $data);
		}
	}
}