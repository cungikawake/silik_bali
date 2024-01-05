<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model("kegiatan_model");
		$this->load->model("peserta_model");
		$this->load->model("narasumber_model");
		$this->load->model("moderator_model");
		$this->load->model("pengajar_praktek_model");
		$this->load->model("fasilitator_model");
		$this->load->model("instruktur_model");
		$this->load->model("pengawas_model");
		$this->load->model("kepala_sekolah_model");
		$this->load->model("panitia_model");
		$this->load->model("biodata_model");
		$this->load->model("dakung_model");
		$this->load->model("pengaturan_model");
		$this->load->model("user_model");
	}
	
	public function index() {
		$this->auth->login();
		$this->load->view('/backend/kegiatan/lists');
	}
	
	public function save () {
		$this->auth->login();
		
		$out = array();
		$out["error"] = false;
		$out["msg"] = "Berhasil menyimpan kegiatan!";
		$out["close_modal"] = true;
		$out["reload_table"] = true;
		
		if (isset($_POST) && !empty($_POST)) {
			$data = $_POST;
			
			$id = (isset($data["id"]) ? $data["id"] : "");

			unset($data["id"]);
			
			if (isset($data["tgl_mulai_kegiatan"]) && !empty($data["tgl_mulai_kegiatan"])) {
				$data["tgl_mulai_kegiatan"] = date("Y-m-d",strtotime(str_replace(array("/"),array("-"),$data["tgl_mulai_kegiatan"])));
			}
			
			if (isset($data["tgl_selesai_kegiatan"]) && !empty($data["tgl_selesai_kegiatan"])) {
				$data["tgl_selesai_kegiatan"] = date("Y-m-d",strtotime(str_replace(array("/"),array("-"), $data["tgl_selesai_kegiatan"])));
			}
			
			if (isset($data["detail_tgl_kegiatan"]) && !empty($data["detail_tgl_kegiatan"])) {
				
				$tglDetail = array();
				
				foreach ($data["detail_tgl_kegiatan"] as $detailTglKegiatan) {
					$tglDetail[] = date("Y-m-d",strtotime(str_replace(array("/"),array("-"), $detailTglKegiatan)));
				}
				
				sort($tglDetail);
				
				$data["detail_tgl_kegiatan"] = json_encode($tglDetail);
				
				$lastDate = count($tglDetail);
				
				$data["tgl_mulai_kegiatan"] = $tglDetail[0];
				$data["tgl_selesai_kegiatan"] = $tglDetail[$lastDate-1];
			}
			else {
				$data["detail_tgl_kegiatan"] = "";
			}
			
			if (isset($data["komponen"]) && !empty($data["komponen"])) {
				$data["komponen"] = json_encode($data["komponen"]);
			}

			$id = $this->kegiatan_model->save($data, $id);

			if (empty($id)) {
				$out["error"] = true;
				$out["msg"] = "Gagal menyimpan kegiatan. Silahkan coba lagi!";
			}
		}
		
		print json_encode($out);
		exit();
	}
	
	public function duplikat () {
		$this->auth->login();
		
		ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
		
		$out = array();
		$out["error"] = false;
		$out["msg"] = "Berhasil menduplikat kegiatan!";
		$out["close_modal"] = true;
		$out["reload_table"] = true;
		
		if (isset($_POST) && !empty($_POST)) {
			$id = $_POST["id"];
			
			$kegiatan = $this->kegiatan_model->getKegiatanById($id);
			
			if (!empty($kegiatan)) {
				$data = $kegiatan;
				$data["nama"] = "COPY - ".$data["nama"];
				
				// UNSET
				unset($data["id"]);
				unset($data["kode"]);
				
				unset($data["link_peserta"]);
				unset($data["link_narasumber"]);
				unset($data["link_panitia"]);
				unset($data["link_moderator"]);
				unset($data["link_pp"]);
				unset($data["link_fasil"]);
				unset($data["link_instruktur"]);
				unset($data["link_pengawas"]);
				unset($data["link_kepala_sekolah"]);
				
				unset($data["link_peserta_on"]);
				unset($data["link_narasumber_on"]);
				unset($data["link_panitia_on"]);
				unset($data["link_moderator_on"]);
				unset($data["link_pp_on"]);
				unset($data["link_fasil_on"]);
				unset($data["link_instruktur_on"]);
				unset($data["link_pengawas_on"]);
				unset($data["link_kepala_sekolah_on"]);
				
				unset($data["sertificate_peserta"]);
				unset($data["sertificate_panitia"]);
				unset($data["sertificate_narasumber"]);
				unset($data["sertificate_pa"]);
				unset($data["sertificate_pp"]);
				unset($data["sertificate_fasil"]);
				unset($data["sertificate_instruktur"]);
				unset($data["sertificate_pengawas"]);
				unset($data["sertificate_kepala_sekolah"]);
				unset($data["no_urut_terakhir"]);
				unset($data["spj_kegiatan"]);
				
				unset($data["dibuat_tgl"]);
				unset($data["diubah_tgl"]);
				unset($data["dibuat_oleh"]);
				unset($data["diubah_oleh"]);
				
				if (isset($data["komponen"]) && !empty($data["komponen"])) {
					$data["komponen"] = json_encode($data["komponen"]);
				}
				
				if (isset($data["kategori"]) && !empty($data["kategori"])) {
					$data["kategori"] = json_encode($data["kategori"]);
				}
				
				$baru = $this->kegiatan_model->save($data);

				if (empty($baru)) {
					$out["error"] = true;
					$out["msg"] = "Gagal menduplikat kegiatan. Silahkan coba lagi!";
				}
			}
		}
		
		print json_encode($out);
		exit();
	}
	
	public function save_more_opt () {
		$this->auth->login();
		
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$out = array();
		$out["error"] = false;
		$out["msg"] = "Berhasil menyimpan pengaturan!";
		$out["close_modal"] = true;
		$out["reload_table"] = true;
		
		if (isset($_POST) && !empty($_POST)) {
			$data = $_POST;
			
			$id = (isset($data["id"]) ? $data["id"] : "");

			unset($data["id"]);
			
			if (!empty($id)) {
				$lookup = $this->kegiatan_model->getKegiatanById($id);
				
				if (isset($data["kategori"]) && !empty($data["kategori"])) {
					
					if (!isset($lookup["kategori"]) || empty($lookup["kategori"])) {
						$lookup["kategori"] = array();
					}
					
					foreach ($data["kategori"] as $katKey => $katVal) {
						$lookup["kategori"][$katKey] = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $katVal);
					}
				}
				
				$data["kategori"] = json_encode($lookup["kategori"]);
			}

			$id = $this->kegiatan_model->save($data, $id);

			if (empty($id)) {
				$out["error"] = true;
				$out["msg"] = "Gagal menyimpan pengaturan. Silahkan coba lagi!";
			}
		}
		
		print json_encode($out);
		exit();
	}
	
	public function checkRegistered () {
		$out = array();
		
		if (isset($_POST["kegiatan"]) && !empty($_POST["kegiatan"])) {
			$unsur = $_POST["unsur"];
			
			if ($unsur == "narasumber") {
				$out = $this->narasumber_model->getNarasumber($_POST["kegiatan"], $_POST["nik"]);
			}
			else if ($unsur == "panitia") {
				$out = $this->panitia_model->getPanitia($_POST["kegiatan"], $_POST["nik"]);
			}
			else if ($unsur == "fasilitator") {
				$out = $this->fasilitator_model->get($_POST["kegiatan"], $_POST["nik"]);
			}
			else if ($unsur == "instruktur") {
				$out = $this->instruktur_model->get($_POST["kegiatan"], $_POST["nik"]);
			}
			else if ($unsur == "pengajar praktek") {
				$out = $this->pengajar_praktek_model->get($_POST["kegiatan"], $_POST["nik"]);
			}
			else if ($unsur == "peserta") {
				$out = $this->peserta_model->getPeserta($_POST["kegiatan"], $_POST["nik"]);
			}
			else if ($unsur == "moderator") {
				$out = $this->moderator_model->get($_POST["kegiatan"], $_POST["nik"]);
			}
			else if ($unsur == "pengawas") {
				$out = $this->pengawas_model->get($_POST["kegiatan"], $_POST["nik"]);
			}
			else if ($unsur == "kepala sekolah") {
				$out = $this->kepala_sekolah_model->get($_POST["kegiatan"], $_POST["nik"]);
			}
		}
		
		print json_encode($out);
	}
	
	public function save_item () {
		$out = array();
		$out["error"] = false;
		$out["msg"] = "Berhasil menyimpan item!";
		$out["close_modal"] = true;
		$out["reload_table"] = true;
		
		if (isset($_POST["kegiatan_id"]) && !empty($_POST["kegiatan_id"])) {
			
			if ($_POST["kab_unit_kerja"] == "Lainnya") {
				$_POST["kab_unit_kerja"] = $_POST["kab_unit_kerja_lainnya"];
			}
			unset($_POST["kab_unit_kerja_lainnya"]);
			
			$data = $_POST;
			$id = (isset($data["id"]) ? $data["id"] : "");

			unset($data["id"]);
			
			
			$unsur = "";
			
			if (isset($data["unsur"])) {
				$unsur = $data["unsur"];
				unset($data["unsur"]);
			}
			
			
			if (isset($data["tgl_lahir"]) && !empty($data["tgl_lahir"])) {
				$data["tgl_lahir"] = date("Y-m-d",strtotime(str_replace(array("/"),array("-"),$data["tgl_lahir"])));
			}
			
			if ($unsur == "peserta") {
				$success = $this->peserta_model->save($data, $id);
			}
			else if ($unsur == "narasumber") {
				$success = $this->narasumber_model->save($data, $id);
			}
			else if ($unsur == "moderator") {
				$success = $this->moderator_model->save($data, $id);
			}
			else if ($unsur == "pengajar praktek") {
				$success = $this->pengajar_praktek_model->save($data, $id);
			}
			else if ($unsur == "fasilitator") {
				$success = $this->fasilitator_model->save($data, $id);
			}
			else if ($unsur == "instruktur") {
				$success = $this->instruktur_model->save($data, $id);
			}
			else if ($unsur == "panitia") {
				$success = $this->panitia_model->save($data, $id);
			}
			else if ($unsur == "pengawas") {
				$success = $this->pengawas_model->save($data, $id);
			}
			else if ($unsur == "kepala sekolah") {
				$success = $this->kepala_sekolah_model->save($data, $id);
			}
			
			// Update data Biodata
			$this->biodata_model->updateByNIK($data);
			
			if (!$success) {
				$out["error"] = true;
				$out["msg"] = "Gagal menyimpan panitia!";
			}
		}
		
		print json_encode($out);
		exit();
	}
	
	/*public function save_peserta () {
		$out = array();
		$out["error"] = false;
		$out["msg"] = "Berhasil menyimpan peserta!";
		$out["close_modal"] = true;
		$out["reload_table"] = true;
		
		if (isset($_POST["kegiatan_id"]) && !empty($_POST["kegiatan_id"])) {
			
			if ($_POST["kab_unit_kerja"] == "Lainnya") {
				$_POST["kab_unit_kerja"] = $_POST["kab_unit_kerja_lainnya"];
			}
			unset($_POST["kab_unit_kerja_lainnya"]);
			
			$data = $_POST;
			$id = (isset($data["id"]) ? $data["id"] : "");

			unset($data["id"]);
			
			if (isset($data["tgl_lahir"]) && !empty($data["tgl_lahir"])) {
				$data["tgl_lahir"] = date("Y-m-d",strtotime(str_replace(array("/"),array("-"),$data["tgl_lahir"])));
			}
			
			$success = $this->peserta_model->save($data, $id);
			
			// Update data Biodata
			//$this->biodata_model->updateByNIK($data);
			
			if (!$success) {
				$out["error"] = true;
				$out["msg"] = "Gagal menyimpan peserta!";
			}
		}
		
		print json_encode($out);
		exit();
	}*/
	
	/*public function save_narasumber () {
		$out = array();
		$out["error"] = false;
		$out["msg"] = "Berhasil menyimpan narasumber!";
		$out["close_modal"] = true;
		$out["reload_table"] = true;
		
		if (isset($_POST["kegiatan_id"]) && !empty($_POST["kegiatan_id"])) {
			
			if ($_POST["kab_unit_kerja"] == "Lainnya") {
				$_POST["kab_unit_kerja"] = $_POST["kab_unit_kerja_lainnya"];
			}
			unset($_POST["kab_unit_kerja_lainnya"]);
			
			$data = $_POST;
			$id = (isset($data["id"]) ? $data["id"] : "");

			unset($data["id"]);
			
			if (isset($data["tgl_lahir"]) && !empty($data["tgl_lahir"])) {
				$data["tgl_lahir"] = date("Y-m-d",strtotime(str_replace(array("/"),array("-"),$data["tgl_lahir"])));
			}
			
			$success = $this->narasumber_model->save($data, $id);
			
			// Update data Biodata
			//$this->biodata_model->updateByNIK($data);
			
			if (!$success) {
				$out["error"] = true;
				$out["msg"] = "Gagal menyimpan narasumber!";
			}
		}
		
		print json_encode($out);
		exit();
	}*/
	
	/*public function save_panitia () {
		$out = array();
		$out["error"] = false;
		$out["msg"] = "Berhasil menyimpan panitia!";
		$out["close_modal"] = true;
		$out["reload_table"] = true;
		
		if (isset($_POST["kegiatan_id"]) && !empty($_POST["kegiatan_id"])) {
			
			if ($_POST["kab_unit_kerja"] == "Lainnya") {
				$_POST["kab_unit_kerja"] = $_POST["kab_unit_kerja_lainnya"];
			}
			unset($_POST["kab_unit_kerja_lainnya"]);
			
			$data = $_POST;
			$id = (isset($data["id"]) ? $data["id"] : "");

			unset($data["id"]);
			
			if (isset($data["tgl_lahir"]) && !empty($data["tgl_lahir"])) {
				$data["tgl_lahir"] = date("Y-m-d",strtotime(str_replace(array("/"),array("-"),$data["tgl_lahir"])));
			}
			
			$success = $this->panitia_model->save($data, $id);
			
			// Update data Biodata
			//$this->biodata_model->updateByNIK($data);
			
			if (!$success) {
				$out["error"] = true;
				$out["msg"] = "Gagal menyimpan panitia!";
			}
		}
		
		print json_encode($out);
		exit();
	}*/
	
	public function peserta ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		if (!empty($kegiatan)) {
			if (isset($kegiatan["komponen"]) && !empty($kegiatan["komponen"])) {
				$komponenAktif = "";
				
				foreach ($kegiatan["komponen"] as $kom => $komAktif) {
					if ($komAktif == "1") {
						$komponenAktif = $kom;
						break;
					}
				}
				
				if ($komponenAktif != "peserta") {
					redirect(base_url("/admin/kegiatan/".$komponenAktif."/".$id."/"));
				}
			}
		}
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		$data["unsur"] = "peserta";
		
		$this->load->view('backend/kegiatan/peserta', $data);
	}
	
	public function narasumber ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		
		$this->load->view('backend/kegiatan/narasumber', $data);
	}
	
	public function moderator ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		
		$this->load->view('backend/kegiatan/moderator', $data);
	}
	
	public function pengajar_praktek ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		
		$this->load->view('backend/kegiatan/pengajar_praktek', $data);
	}
	
	public function fasilitator ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		
		$this->load->view('backend/kegiatan/fasilitator', $data);
	}
	
	public function instruktur ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		
		$this->load->view('backend/kegiatan/instruktur', $data);
	}
	
	public function panitia ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		
		$this->load->view('backend/kegiatan/panitia', $data);
	}
	
	public function pengawas ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		
		$this->load->view('backend/kegiatan/pengawas', $data);
	}
	
	public function kepala_sekolah ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		
		$this->load->view('backend/kegiatan/kepala_sekolah', $data);
	}
	
	public function data_dukung ($id) {
		$this->auth->login();
		
		$kegiatan = $this->kegiatan_model->getKegiatanById($id);
		
		$data = array();
		$data["kegiatan"] = $kegiatan;
		
		//$data["google"]["files"] = $this->google->createDriveFolder("Folder API Test");
		
		$this->load->view('backend/kegiatan/data_dukung', $data);
	}
	
	public function formUploadDakung () {
		$this->auth->login();
		
		$data = array();
		$data["kegiatan"] = $_POST["kegiatan"];
		$data["section"] = $_POST["section"];
		
		$this->load->view('backend/kegiatan/modal_dakung', $data);
	}
	
	public function uploadDakung () {
		$this->auth->login();
		
		$out = array();
		$out["error"] = false;
		
		if (isset($_FILES) && !empty($_FILES)) {
			$file = $_FILES['file'];
			$kegiatanId = $_POST["kegiatan"];
			$section = $_POST["section"];
			
			$kegiatan = $this->kegiatan_model->getKegiatanById($kegiatanId);
			
			$allowed = array('pdf', 'doc', 'docx', 'jpg', 'jpeg');
			$filename = $file['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
			$allowedSize = 5242880; // 5 Mb
						
			if (!empty($kegiatan)) {
				// Check File Type
				if (in_array($ext, $allowed)) {
					if ($file["size"] <= $allowedSize) {
						$user = $this->user_model->getUserById($_SESSION["user"]["id"]);
						
						// Make Sure Root Folder
						$rootDriveId = $this->google->createDriveFolder("Kegiatan", $user["drive_folder_id"]);
						
						$folderDriveId = $this->google->createDriveFolder($kegiatan["kode"], $rootDriveId);
						
						$fileDriveId = $this->google->createDriveFile($file, $folderDriveId);
						
						if ($fileDriveId) {
							// save file db
							$data = array();
							$data["kegiatan_id"] = $kegiatanId;
							$data["drive_file_id"] = $fileDriveId;
							$data["nama"] = $filename;
							$data["size"] = $file["size"];
							$data["type"] = $ext;
							$data["section"] = $section;
							
							$out["id"] = $this->dakung_model->save($data);
						}
						else {
							$out["error"] = true;
							$out["msg"] = "Gagal mengunggah file";
						}
					}
					else {
						$out["error"] = true;
						$out["msg"] = "Maksimal ukuran file adalah 5 Mb";
					}
				}
				else {
					$out["error"] = true;
					$out["msg"] = "Tipe file tidak diizinkan";
				}
			}
			else {
				$out["error"] = true;
				$out["msg"] = "Kegiatan Tidak Ditemukan";
			}
		}
		
		print json_encode($out);
	}
	
	public function dakungList () {
		$this->auth->login();
		
		$data = array();
		$data["list"] = array();
		
		if (isset($_POST["kegiatanId"]) && !empty($_POST["kegiatanId"])) {
			$data["list"] = $this->dakung_model->getByKegiatanIdAndSection($_POST["kegiatanId"], $_POST["section"]);
		}
		
		$this->load->view('backend/kegiatan/data_dukung_list', $data);
	}
	
	public function deleteDakung () {
		$this->auth->login();
		
		$out = array();
		$out["error"] = true;
		
		if (isset($_POST["id"]) && !empty($_POST["id"])) {
			$file = $this->dakung_model->getById($_POST["id"]);
			
			if (!empty($file)) {
				if ($file["dibuat_oleh"] == $_SESSION["user"]["id"]) {
					$this->google->deleteDriveFile($file["drive_file_id"]);
					$this->dakung_model->delete($file["id"]);
					
					$out["error"] = false;
					$out["kegiatan"] = $file["kegiatan_id"];
					$out["section"] = $file["section"];
				}
			}
		}
		
		print json_encode($out);
	}
	
	public function generateBitly () {
		$this->auth->login();
		
		$out = array();
		$out["error"] = true;
		
		if (isset($_POST["kegiatanId"]) && !empty($_POST["kegiatanId"])) {
			$kegiatanId = $_POST["kegiatanId"];
			$customLink = $_POST["customLink"];
			$type = $_POST["type"];
			
			if ($type == "peserta") {
				$key = "link_peserta";
			}
			else if ($type == "narasumber") {
				$key = "link_narasumber";
			}
			else if ($type == "moderator") {
				$key = "link_moderator";
			}
			else if ($type == "pengajar_praktek") {
				$key = "link_pp";
			}
			else if ($type == "fasilitator") {
				$key = "link_fasil";
			}
			else if ($type == "instruktur") {
				$key = "link_instruktur";
			}
			else if ($type == "pengawas") {
				$key = "link_pengawas";
			}
			else if ($type == "kepala_sekolah") {
				$key = "link_kepala_sekolah";
			}
			else {
				$key = "link_panitia";
			}
			
			$kegiatan = $this->kegiatan_model->getKegiatanById($kegiatanId);
			
			if (!empty($kegiatan[$key])) {
				if (empty($kegiatan[$key]["custom_bitlinks"])) {
					
					$bitly = $this->bitly->customLink($kegiatan[$key]["id"], $customLink);
					
					if (isset($bitly["id"])) {
						// Save Here
						$data = array();
						$data[$key] = json_encode($bitly);
						$this->kegiatan_model->save($data, $kegiatanId);
						
						$out = $bitly;
						$out["error"] = false;
					}
					else {
						$out = $bitly;
						$out["error"] = true;
					}
				}
				else {
					
					if ($kegiatan[$key]["custom_bitlinks"] != $customLink) {
						// UPDATE (CREATE) NEW LINK
						$longUrl = base_url("kegiatan/registrasi_".$type."/".$kegiatanId);
				
						$bitly = $this->bitly->shorten($longUrl);

						if (isset($bitly["id"])) {
							// Save Here
							$data = array();
							$data[$key] = json_encode($bitly);
							$this->kegiatan_model->save($data, $kegiatanId);


							$bitly = $this->bitly->customLink($bitly["id"], $customLink);

							if (isset($bitly["id"])) {
								// Save Here
								$data = array();
								$data[$key] = json_encode($bitly);
								$this->kegiatan_model->save($data, $kegiatanId);

								$out = $bitly;
								$out["error"] = false;
								$out["range"] = "custom link edit";
							}
							else {
								$out = $bitly;
								$out["error"] = true;
								$out["range"] = "bitly link edit";
							}
						}
						else {
							$out = $bitly;
							$out["error"] = true;
							$out["range"] = "gagal bitly link edit";
						}
					}
					else {
						$out = $kegiatan[$key];
						$out["error"] = false;
						$out["range"] = "custom bitly link edit sama";
					}
				}
			}
			else {
				$longUrl = base_url("kegiatan/registrasi_".$type."/".$kegiatanId);
				
				$bitly = $this->bitly->shorten($longUrl);
				
				if (isset($bitly["id"])) {
					// Save Here
					$data = array();
					$data[$key] = json_encode($bitly);
					$this->kegiatan_model->save($data, $kegiatanId);
					
					
					$bitly = $this->bitly->customLink($bitly["id"], $customLink);
					
					if (isset($bitly["id"])) {
						// Save Here
						$data = array();
						$data[$key] = json_encode($bitly);
						$this->kegiatan_model->save($data, $kegiatanId);
						
						$out = $bitly;
						$out["error"] = false;
					}
					else {
					    // Can't make custom link, Remove Data
						$data = array();
						$data[$key] = "";
						$this->kegiatan_model->save($data, $kegiatanId);
						
						$out = $bitly;
						$out["error"] = true;
					}
				}
				else {
					$out = $bitly;
					$out["error"] = true;
				}
			}
		}
		
		print json_encode($out);
		exit();
	}
	
	public function switchRegistration () {
		$this->auth->login();
		
		$out = array();
		$out["error"] = true;
		
		if (isset($_POST["kegiatanId"]) && !empty($_POST["kegiatanId"])) {
			$kegiatanId = $_POST["kegiatanId"];
			$switch = $_POST["switch"];
			$type = $_POST["type"];
			
			if ($type == "peserta") {
				$key = "link_peserta_on";
			}
			else if ($type == "narasumber") {
				$key = "link_narasumber_on";
			}
			else if ($type == "moderator") {
				$key = "link_moderator_on";
			}
			else if ($type == "pengajar_praktek") {
				$key = "link_pp_on";
			}
			else if ($type == "fasilitator") {
				$key = "link_fasil_on";
			}
			else if ($type == "instruktur") {
				$key = "link_instruktur_on";
			}
			else if ($type == "pengawas") {
				$key = "link_pengawas_on";
			}
			else if ($type == "kepala_sekolah") {
				$key = "link_kepala_sekolah_on";
			}
			else {
				$key = "link_panitia_on";
			}
			
			$data = array();
			$data[$key] = $switch;
			$this->kegiatan_model->save($data, $kegiatanId);
			
			$out["error"] = false;
		}
		
		print json_encode($out);
		exit();
	}
	
	public function download_biodata ($kegiatanId, $type) {
		$this->auth->login();
		
		$data = array();
		$data["type"] = $type;
		
		$pengaturan = $this->pengaturan_model->getPengaturanBySection("satker");
		
		if (!empty($pengaturan)) {
			foreach ($pengaturan as $foo) {
				$data["satker"][$foo["sistem"]] = $foo["value"];
			}
		}
		
		$data["kegiatan"] = $this->kegiatan_model->getKegiatanById($kegiatanId);
		
		if ($type == "peserta") {
			$biodatas = $this->peserta_model->getPesertaKegiatan($kegiatanId);	
		}
		else if ($type == "narasumber") {
			$biodatas = $this->narasumber_model->getNarasumberKegiatan($kegiatanId);	
		}
		else if ($type == "moderator") {
			$biodatas = $this->moderator_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "pengajar_praktek") {
			$biodatas = $this->pengajar_praktek_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "fasilitator") {
			$biodatas = $this->fasilitator_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "instruktur") {
			$biodatas = $this->instruktur_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "pengawas") {
			$biodatas = $this->pengawas_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "kepala_sekolah") {
			$biodatas = $this->kepala_sekolah_model->getByKegiatan($kegiatanId);	
		}
		else {
			$biodatas = $this->panitia_model->getPanitiaKegiatan($kegiatanId);	
		}
		
		$html = '<h3 style="text-align:center;">Tidak ada Data</h3>';
		
		if (!empty($biodatas)) {
			$html = '';
			
			foreach ($biodatas as $bio) {
				$data["biodata"] = $bio;
				
				$html .= $this->load->view('template/biodata', $data, true);
				$html .= "<pagebreak />";
			}
		}
		
		$this->mpdf->create($html,"biodata_".$type."_".$data["kegiatan"]["kode"]);
	}
	
	public function download_biodata2 ($kegiatanId, $type, $page = 0) {
		$this->auth->login();
		
		$data = array();
		$data["type"] = $type;
		
		$pengaturan = $this->pengaturan_model->getPengaturanBySection("satker");
		
		if (!empty($pengaturan)) {
			foreach ($pengaturan as $foo) {
				$data["satker"][$foo["sistem"]] = $foo["value"];
			}
		}
		
		$data["kegiatan"] = $this->kegiatan_model->getKegiatanById($kegiatanId);
		
		if ($type == "peserta") {
			$biodatas = $this->peserta_model->getPesertaKegiatan($kegiatanId);	
		}
		else if ($type == "narasumber") {
			$biodatas = $this->narasumber_model->getNarasumberKegiatan($kegiatanId);	
		}
		else if ($type == "moderator") {
			$biodatas = $this->moderator_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "pengajar_praktek") {
			$biodatas = $this->pengajar_praktek_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "fasilitator") {
			$biodatas = $this->fasilitator_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "instruktur") {
			$biodatas = $this->instruktur_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "pengawas") {
			$biodatas = $this->pengawas_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "kepala_sekolah") {
			$biodatas = $this->kepala_sekolah_model->getByKegiatan($kegiatanId);
		}
		else {
			$biodatas = $this->panitia_model->getPanitiaKegiatan($kegiatanId);	
		}
		
		$perPage = 100;
		
		if (!empty($biodatas)) {
			if (empty($page)) {
				print json_encode(array("page" => ceil(count($biodatas)/$perPage)));
			}
			else {
				$html = '';
				$lastKey = $page * $perPage;
				$startKey = $lastKey - $perPage;
				
				foreach (range($startKey, ($lastKey - 1)) as $key) {
					if (isset($biodatas[$key]) && !empty($biodatas[$key])) {
						$data["biodata"] = $biodatas[$key];
						
						if (!empty($html)) {
							$html .= "<pagebreak />";
						}
						
						$html .= $this->load->view('template/biodata', $data, true);
					}
				}
				
				$this->mpdf->create($html,"biodata_".$type."_".$data["kegiatan"]["kode"]);
			}
		}
		else {
			print "Tidak Ada Data";
		}
	}
	
	public function download_single_biodata ($type, $id) {
		
		$data = array();
		$data["type"] = $type;
		
		$pengaturan = $this->pengaturan_model->getPengaturanBySection("satker");
		
		if (!empty($pengaturan)) {
			foreach ($pengaturan as $foo) {
				$data["satker"][$foo["sistem"]] = $foo["value"];
			}
		}
		
		if ($type == "peserta") {
			$biodata = $this->peserta_model->getPesertaById($id);	
		}
		else if ($type == "narasumber") {
			$biodata = $this->narasumber_model->getNarasumberById($id);	
		}
		else if ($type == "moderator") {
			$biodata = $this->moderator_model->getById($id);	
		}
		else if ($type == "pengajar_praktek") {
			$biodata = $this->pengajar_praktek_model->getById($id);
		}
		else if ($type == "fasilitator") {
			$biodata = $this->fasilitator_model->getById($id);
		}
		else if ($type == "instruktur") {
			$biodata = $this->instruktur_model->getById($id);
		}
		else if ($type == "pengawas") {
			$biodata = $this->pengawas_model->getById($id);
		}
		else if ($type == "kepala_sekolah") {
			$biodata = $this->kepala_sekolah_model->getById($id);
		}
		else {
			$biodata = $this->panitia_model->getPanitiaById($id);	
		}
		
		if (!empty($biodata)) {
			$data["kegiatan"] = $this->kegiatan_model->getKegiatanById($biodata["kegiatan_id"]);
		}
		
		$html = '<h3 style="text-align:center;">Tidak ada Data</h3>';
		$namaFile = "tidak ada data";
		
		if (!empty($biodata)) {
			$data["biodata"] = $biodata;
			
			$html = $this->load->view('template/biodata', $data, true);
			
			$namaFile = "biodata_".$type."_".$data["biodata"]["nama"];
		}
		
		$this->mpdf->create($html,$namaFile,false);
	}
	
	public function download_daftar_hadir ($kegiatanId, $type) {
		$this->auth->login();
		
		$data = array();
		$data["type"] = $type;
		
		$pengaturan = $this->pengaturan_model->getPengaturanBySection("satker");
		
		if (!empty($pengaturan)) {
			foreach ($pengaturan as $foo) {
				$data["satker"][$foo["sistem"]] = $foo["value"];
			}
		}
		
		$data["kegiatan"] = $this->kegiatan_model->getKegiatanById($kegiatanId);
		
		if ($type == "peserta") {
			$data["biodata"] = $this->peserta_model->getPesertaKegiatan($kegiatanId, true);	
		}
		else if ($type == "narasumber") {
			$data["biodata"] = $this->narasumber_model->getNarasumberKegiatan($kegiatanId);	
		}
		else if ($type == "moderator") {
			$data["biodata"] = $this->moderator_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "pengajar_praktek") {
			$data["biodata"] = $this->pengajar_praktek_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "fasilitator") {
			$data["biodata"] = $this->fasilitator_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "instruktur") {
			$data["biodata"] = $this->instruktur_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "pengawas") {
			$data["biodata"] = $this->pengawas_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "kepala_sekolah") {
			$data["biodata"] = $this->kepala_sekolah_model->getByKegiatan($kegiatanId);	
		}
		else {
			$data["biodata"] = $this->panitia_model->getPanitiaKegiatan($kegiatanId);	
		}
		
		$html = '<h3 style="text-align:center;">Tidak ada Data</h3>';
		
		if (!empty($data["biodata"])) {
			$html = $this->load->view('template/daftar_hadir', $data, true);
		}
		
	    $this->mpdf->createLandscape($html,"daftar_hadir_".$type."_".$data["kegiatan"]["kode"]);
	}
	
	public function export_excel ($kegiatanId, $type) {
		$this->auth->login();
		
		$data = array();
		$data["type"] = $type;
		
		$pengaturan = $this->pengaturan_model->getPengaturanBySection("satker");
		
		if (!empty($pengaturan)) {
			foreach ($pengaturan as $foo) {
				$data["satker"][$foo["sistem"]] = $foo["value"];
			}
		}
		
		$data["kegiatan"] = $this->kegiatan_model->getKegiatanById($kegiatanId);
		
		if ($type == "peserta") {
			$data["biodata"] = $this->peserta_model->getPesertaKegiatan($kegiatanId);	
		}
		else if ($type == "narasumber") {
			$data["biodata"] = $this->narasumber_model->getNarasumberKegiatan($kegiatanId);	
		}
		else if ($type == "moderator") {
			$data["biodata"] = $this->moderator_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "pengajar_praktek") {
			$data["biodata"] = $this->pengajar_praktek_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "fasilitator") {
			$data["biodata"] = $this->fasilitator_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "instruktur") {
			$data["biodata"] = $this->instruktur_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "pengawas") {
			$data["biodata"] = $this->pengawas_model->getByKegiatan($kegiatanId);	
		}
		else if ($type == "kepala_sekolah") {
			$data["biodata"] = $this->kepala_sekolah_model->getByKegiatan($kegiatanId);	
		}
		else {
			$data["biodata"] = $this->panitia_model->getPanitiaKegiatan($kegiatanId);	
		}
		
		if (!empty($data["biodata"])) {
			$keyData = array(
				"kode" => "Kode",
				"ktp" => "NIK",
				"nama" => "Nama",
				"tempat_lahir" => "Tempat Lahir",
				"tgl_lahir" => "Tanggal Lahir",
				"jenis_kelamin" => "Jenis Kelamin",
				"alamat_tinggal" => "Alamat Rumah",
				"telp" => "Telp/Hp",
				"email" => "Email",
				"nip" => "NIP",
				"npwp" => "NPWP",
				"pangkat" => "Pangkat",
				"golongan" => "Golongan",
				"jabatan" => "Jabatan",
				"unit_kerja" => "Unit Kerja",
				"alamat_unit_kerja" => "Alamat Unit Kerja",
				"kab_unit_kerja" => "Kab/Kota Unit Kerja",
				"telp_unit_kerja" => "Telp Unti Kerja",
				"no_rekening" => "No Rekening",
				"nama_pemilik_rekening" => "Nama Pemilik Rekening",
				"nama_bank" => "Nama Bank",
				"konfirmasi_paket" => "Menerima Biaya Paket Data",
				"tanda_tangan" => "Tanda Tangan"
			);
			
			$exportData = array();
			
			$exp = array();
			$exp[] = "No";
			
			foreach ($keyData as $export) {
				$exp[] = $export;
			}
			
			$exportData[] = $exp;
			
			
			
			$i = 1;
			foreach ($data["biodata"] as $bios) {
				$exp = array();
				$exp[] = $i;
				
				foreach ($keyData as $dooKey => $doo) {
					foreach ($bios as $bioKey => $bio) {
						if ($bioKey == $dooKey) {
							$exp[] = $bio;
						}
					}
				}
				
				$exportData[] = $exp;
				$i++;
			}
		}
		else {
			$exportData = array(array("Data not found"));
		}
		
		$this->excel->create($exportData, "export_".$type."_".$data["kegiatan"]["kode"]);
	}
	
	protected function registrasi_form ($type = "Peserta", $kegiatanId) {
		$data = array();
		$data["type"] = $type;
		
		// Lookup Satker Header
		$pengaturan = $this->pengaturan_model->getPengaturanBySection("satker");
		
		if (!empty($pengaturan)) {
			foreach ($pengaturan as $foo) {
				$data["satker"][$foo["sistem"]] = $foo["value"];
			}
		}
		
		// Lookup Kegiatan
		$kegiatan = $this->kegiatan_model->getKegiatanById($kegiatanId);
		$data["kegiatan"] = $kegiatan;
		
		// Load View
		$this->load->view('frontend/kegiatan_registrasi', $data);
	}
	
	public function registrasi_peserta ($kegiatanId) {
		$this->registrasi_form("Peserta", $kegiatanId);
	}
	
	public function registrasi_panitia ($kegiatanId) {
		$this->registrasi_form("Panitia", $kegiatanId);
	}
	
	public function registrasi_narasumber ($kegiatanId) {
		$this->registrasi_form("Narasumber", $kegiatanId);
	}
	
	public function registrasi_save () {
		$out = array();
		$out["error"] = true;
		$out["msg"] = "Gagal melakukan pendaftaran!";
		
		if (isset($_POST) && !empty($_POST)) {
			$kegiatanId = $_POST["kegiatan_id"];
			
			$ktp = $_POST["nik"];
			unset($_POST["nik"]);
			
			$type = $_POST["type"];
			unset($_POST["type"]);
			
			$id = 0;
			$data = $_POST;
			$data["ktp"] = $ktp;
			
			// tgl lahir format
			if (isset($data["tgl_lahir"]) && !empty($data["tgl_lahir"])) {
				$data["tgl_lahir"] = date("Y-m-d",strtotime(str_replace(array("/"),array("-"),$data["tgl_lahir"])));
			}
			
			$kegiatan = $this->kegiatan_model->getKegiatanById($kegiatanId);
			
			if ($type == "Narasumber") {
				// Check Narasumber Apakah Sudah Pernah Daftar
				$narasumber = $this->narasumber_model->getNarasumber($kegiatanId, $data["ktp"]);

				if (!empty($narasumber)) {
					$id = $narasumber["id"];
				}

				$id = $this->narasumber_model->save($data, $id);
			}
			else if ($type == "Panitia") {
				// Check Panitia Apakah Sudah Pernah Daftar
				$panitia = $this->panitia_model->getPanitia($kegiatanId, $data["ktp"]);

				if (!empty($panitia)) {
					$id = $panitia["id"];
				}

				$id = $this->panitia_model->save($data, $id);
			}
			else {
				// Check Peserta Apakah Sudah Pernah Daftar
				$peserta = $this->peserta_model->getPeserta($kegiatanId, $data["ktp"]);

				if (!empty($peserta)) {
					$id = $peserta["id"];
				}

				$id = $this->peserta_model->save($data, $id);
			}
			
			
			if ($type == "Narasumber") {
				$registered = $this->narasumber_model->getNarasumber($kegiatanId, $data["ktp"]);
			}
			else if ($type == "Panitia") {
				$registered = $this->panitia_model->getPanitia($kegiatanId, $data["ktp"]);
			}
			else {
				$registered = $this->peserta_model->getPeserta($kegiatanId, $data["ktp"]);
			}
			
			// handle ttd
			if (isset($data["tanda_tangan"]) && !empty($data["tanda_tangan"])) {
				$data_uri = $data["tanda_tangan"];
				$encoded_image = explode(",", $data_uri)[1];
				$decoded_image = base64_decode($encoded_image);
				
				$dir = APPPATH . "../assets/ttd/".$kegiatan["kode"]; // Full Path
				$name = 'ttd-'.$registered["kode"].'.png';

				is_dir($dir) || @mkdir($dir) || die("Can't Create folder");
				
				file_put_contents($dir."/".$name, $decoded_image);
				
				$this->utility->resize_image($dir."/".$name, 200);
			}
			
			// Update data Biodata
			if (isset($data["konfirmasi_paket"])) {
				unset($data["konfirmasi_paket"]);
			}
			
			if (isset($data["tanda_tangan"])) {
				unset($data["tanda_tangan"]);
			}
			
			$this->biodata_model->updateByNIK($data);
			
			
			// Prepare For Preview
			$out["error"] = false;
			$out["msg"] = "Berhasil melakukan pendaftaran!";
			$data["kegiatan"] = $kegiatan;
			
			if ($type == "Narasumber") {
				$data["narasumber"] = $registered;
			}
			else if ($type == "Panitia") {
				$data["panitia"] = $registered;
			}
			else {
				$data["peserta"] = $registered;
			}
			
			$out["html"] = $this->load->view('frontend/kegiatan_registrasi_berhasil', $data, true);
		}
		
		print json_encode($out);
		exit();
	}
	
	function sertificate_typehead () {
		$out = array();
		
		if (isset($_GET["q"])) {
			$term = $_GET["q"];
			
			$this->load->model("sertifikat_model");
		
			$sertificates = $this->sertifikat_model->getTypeHead($term);
			
			$out["total_count"] = count($sertificates);
			$out["items"] = $sertificates;
		}
		
		print json_encode($out);
		exit();
	}
	
	function report () {
		$this->auth->login();
		
		$html = '<div class="alert alert-danger"><p>Gagal Memuat Laporan! (under maintenance)</p></div>';
		
		if (isset($_POST["id"]) && !empty($_POST["id"])) {
			$id = $_POST["id"];
			$unsur = $_POST["unsur"];
			
			$data = array();
			$data["unsur"] = $unsur;
			$data["report_kab"] = array();
			
			
			
			if ($unsur == "peserta") {
				$items = $this->peserta_model->getPesertaKegiatan($id, true);
			}
			
			$unsurSatuan = $this->config->item("unsur_satuan");
			
			$reportKab = array();
			$reportWaktuDaftar = array();
			$reportUnsur = array();
			
			if (!empty($items)) {
				foreach ($items as $item) {
					if (!isset($reportKab[$item["kab_unit_kerja"]])) {
						$reportKab[$item["kab_unit_kerja"]] = 0;
					}
					
					$tglDaftar = date("Y-m-d", strtotime($item["dibuat_tgl"]));
					
					if (!isset($reportWaktuDaftar[$tglDaftar])) {
						$reportWaktuDaftar[$tglDaftar] = 0;
					}
					
					$break = 0;
					
					foreach ($unsurSatuan as $keyUs => $paramUss) {
						
						foreach ($paramUss as $paramUs) {
							
							$regex = strtolower(substr($item["unit_kerja"], 0, strlen($paramUs)));
							
							if ($regex === $paramUs) {
								if (!isset($reportUnsur[$keyUs])) {
									$reportUnsur[$keyUs] = 0;
								}
								
								$reportUnsur[$keyUs] += 1;
								$break = 1;
								break;
							}
						}
						
						if ($break) {
							break;
						}
					}
					
					if (!$break) {
						if (!isset($reportUnsur[$item["unit_kerja"]])) {
							$reportUnsur[$item["unit_kerja"]] = 0;
						}
						
						$reportUnsur[$item["unit_kerja"]] += 1;
					}
					
					$reportKab[$item["kab_unit_kerja"]] += 1;
					$reportWaktuDaftar[$tglDaftar] += 1;
				}
			}
			
			// SORTING
			if (!empty($reportWaktuDaftar)) {
				ksort($reportWaktuDaftar);
			}
			
			if (!empty($reportUnsur)) {
				$sortReportUnsur = array();
				
				foreach ($unsurSatuan as $keyUs => $paramUss) {
					if (isset($reportUnsur[$keyUs])) {
						$sortReportUnsur[$keyUs] = $reportUnsur[$keyUs];
						unset($reportUnsur[$keyUs]);
					}
				}
				
				if (!empty($reportUnsur)) {
					foreach ($reportUnsur as $key => $foo) {
						$sortReportUnsur[$key] = $foo;
					}
				}
				
				$reportUnsur = $sortReportUnsur;
			}
			
			
			$data["report_kab"] = $reportKab;
			$data["report_waktu"] = $reportWaktuDaftar;
			$data["report_unsur"] = $reportUnsur;
			
			$html = $this->load->view('backend/kegiatan/report_pendaftaran', $data, true);
		}
		
		print $html;
		exit();
	}
	
	function turnOffForm () {
		$kegiatan = $this->kegiatan_model->turnOffForm();
		
		if (!empty($kegiatan)) {
			foreach ($kegiatan as $keg) {
				$id = $keg["id"];
				
				$data = array(
					"link_peserta_on" => 0,
					"link_panitia_on" => 0,
					"link_moderator_on" => 0,
					"link_pp_on" => 0,
					"link_fasil_on" => 0,
					"link_instruktur_on" => 0,
					"link_pengawas_on" => 0,
					"link_kepala_sekolah_on" => 0
				);
				
				$this->kegiatan_model->save($data, $id);
				
				print "Turn Off Form Registrastion - ".$keg["nama"]." <br />";
			}
		}
	}
	
	function testPeserta () {
		$start = microtime(TRUE);
		
		$kegiatan = $this->kegiatan_model->getKegiatanById("281");
		$peserta = $this->peserta_model->getPesertaKegiatan("281");
		$pesertaByKode = array();
		
		$end = microtime(TRUE);
		
		if (!empty($peserta)) {
			foreach ($peserta as $ps) {
				$pesertaByKode[$ps["kode"]] = $ps;
			}
		}
		
		
		$last = count($peserta) + 1;
		
		foreach (range(1, $last) as $no) {
			$noKode = $this->utility->penomoran($no)."-PS-".$kegiatan["kode"];
			
			if (!isset($pesertaByKode[$noKode])) {
				break;
			}
		}
		
		print "<pre>";
print_r($noKode);
print "</pre>";
		
		print $end - $start;
		
		/*print "<pre>";
		print_r($last);
		print "</pre>";
		
		print "<pre>";
		print_r($pesertaByKode);
		print "</pre>";*/
	}
}
