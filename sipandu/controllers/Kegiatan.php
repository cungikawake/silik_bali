<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model("kegiatan_model");
		$this->load->model("peserta_model");
		$this->load->model("narasumber_model");
		$this->load->model("panitia_model");
		$this->load->model("moderator_model");
		$this->load->model("pengajar_praktek_model");
		$this->load->model("fasilitator_model");
		$this->load->model("instruktur_model");
		$this->load->model("pengawas_model");
		$this->load->model("kepala_sekolah_model");
		$this->load->model("biodata_model");
		$this->load->model("dakung_model");
		$this->load->model("pengaturan_model");
		$this->load->model("master_komponen_kegiatan_model");
		$this->load->model("komponen_kegiatan_model");
	}
	
	public function index() {
		$this->load->view('frontend/errors/logo');
	}
	
	protected function registrasi_form ($komponen, $kegiatanId) {
		$data = array(); 
		$data["komponen"] = $this->master_komponen_kegiatan_model->get_record_by_code($komponen);
		$data["type"] = $data["komponen"]->name;
		$data["title"] = "Pendaftaran Kegiatan";
		
		// Lookup Satker Header
		$pengaturan = $this->pengaturan_model->getPengaturanBySection("satker");
		
		if (!empty($pengaturan)) {
			foreach ($pengaturan as $foo) {
				$data["satker"][$foo["sistem"]] = $foo["value"];
			}
		}
		
		// Lookup Kegiatan
		$kegiatan = $this->kegiatan_model->getKegiatanById($kegiatanId);
		
		if (!empty($kegiatan)) {
			$data["kegiatan"] = $kegiatan;
			$data["title"] .= " ".$kegiatan["nama"];
			 
			$data["kegiatan_options"] = $this->db->from('kegiatan_options')->where('kegiatan_id', $kegiatan['id'])->where('code_komponen', $data["komponen"]->code)->get()->result_array();
			 
            $this->load->view('frontend/kegiatan/kegiatan_registrasi2', $data);
		}
		else {
			$this->load->view('frontend/errors/logo');
		}
	}
	
	public function registrasi ($komponen, $kegiatanId) {
		$this->registrasi_form($komponen, $kegiatanId);
	}

	// public function registrasi_peserta ($kegiatanId) {
	// 	$this->registrasi_form("Peserta", $kegiatanId);
	// }
	
	// public function registrasi_panitia ($kegiatanId) {
	// 	$this->registrasi_form("Panitia", $kegiatanId);
	// }
	
	// public function registrasi_narasumber ($kegiatanId) {
	// 	$this->registrasi_form("Narasumber", $kegiatanId);
	// }
	
	// public function registrasi_fasilitator ($kegiatanId) {
	// 	$this->registrasi_form("Fasilitator", $kegiatanId);
	// }
	
	// public function registrasi_moderator ($kegiatanId) {
	// 	$this->registrasi_form("Moderator", $kegiatanId);
	// }
	
	// public function registrasi_instruktur ($kegiatanId) {
	// 	$this->registrasi_form("Instruktur", $kegiatanId);
	// }
	
	// public function registrasi_pengajar_praktek ($kegiatanId) {
	// 	$this->registrasi_form("Pengajar Praktek", $kegiatanId);
	// }
	
	// public function registrasi_pengawas ($kegiatanId) {
	// 	$this->registrasi_form("Pengawas", $kegiatanId);
	// }
	
	// public function registrasi_kepala_sekolah ($kegiatanId) {
	// 	$this->registrasi_form("Kepala Sekolah", $kegiatanId);
	// }
	
	/**tidak dipakai */
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
			
			if ($_POST["kab_unit_kerja"] == "Lainnya") {
				$_POST["kab_unit_kerja"] = $_POST["kab_unit_kerja_lainnya"];
			}
			unset($_POST["kab_unit_kerja_lainnya"]);
			
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
			else if ($type == "Moderator") {
				// Check Moderator Apakah Sudah Pernah Daftar
				$pa = $this->moderator_model->get($kegiatanId, $data["ktp"]);

				if (!empty($pa)) {
					$id = $pa["id"];
				}

				$id = $this->moderator_model->save($data, $id);
			}
			else if ($type == "Pengajar Praktek") {
				// Check Pengajar Praktek Apakah Sudah Pernah Daftar
				$pp = $this->pengajar_praktek_model->get($kegiatanId, $data["ktp"]);

				if (!empty($pp)) {
					$id = $pp["id"];
				}

				$id = $this->pengajar_praktek_model->save($data, $id);
			}
			else if ($type == "Fasilitator") {
				// Check Fasilitator Apakah Sudah Pernah Daftar
				$fasil = $this->fasilitator_model->get($kegiatanId, $data["ktp"]);

				if (!empty($fasil)) {
					$id = $fasil["id"];
				}

				$id = $this->fasilitator_model->save($data, $id);
			}
			else if ($type == "Instruktur") {
				// Check Fasilitator Apakah Sudah Pernah Daftar
				$instruktur = $this->instruktur_model->get($kegiatanId, $data["ktp"]);

				if (!empty($instruktur)) {
					$id = $instruktur["id"];
				}

				$id = $this->instruktur_model->save($data, $id);
			}
			else if ($type == "Pengawas") {
				// Check Pengawas Apakah Sudah Pernah Daftar
				$pengawas = $this->pengawas_model->get($kegiatanId, $data["ktp"]);

				if (!empty($pengawas)) {
					$id = $pengawas["id"];
				}

				$id = $this->pengawas_model->save($data, $id);
			}
			else if ($type == "Kepala Sekolah") {
				// Check Kepala Sekolah Apakah Sudah Pernah Daftar
				$kepsek = $this->kepala_sekolah_model->get($kegiatanId, $data["ktp"]);

				if (!empty($kepsek)) {
					$id = $kepsek["id"];
				}

				$id = $this->kepala_sekolah_model->save($data, $id);
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
			else if ($type == "Moderator") {
				$registered = $this->moderator_model->get($kegiatanId, $data["ktp"]);
			}
			else if ($type == "Pengajar Praktek") {
				$registered = $this->pengajar_praktek_model->get($kegiatanId, $data["ktp"]);
			}
			else if ($type == "Fasilitator") {
				$registered = $this->fasilitator_model->get($kegiatanId, $data["ktp"]);
			}
			else if ($type == "Instruktur") {
				$registered = $this->instruktur_model->get($kegiatanId, $data["ktp"]);
			}
			else if ($type == "Pengawas") {
				$registered = $this->pengawas_model->get($kegiatanId, $data["ktp"]);
			}
			else if ($type == "Kepala Sekolah") {
				$registered = $this->kepala_sekolah_model->get($kegiatanId, $data["ktp"]);
			}
			else {
				$registered = $this->peserta_model->getPeserta($kegiatanId, $data["ktp"]);
			}
			
			// handle surat tugas
			if (isset($_FILES) && !empty($_FILES)) {
				$files = array();
				$allowed = array('pdf', 'jpg', 'jpeg', 'png');
				$allowedSize = 3145728; // 3 Mb
				
				$tempFile = $_FILES['surat_tugas']["tmp_name"];          
      
				$targetPath = $dir = APPPATH . "../assets/surat_tugas/".$kegiatan["kode"];
				
				is_dir($targetPath) || @mkdir($targetPath) || die("Can't Create folder");
				
				$filename = $_FILES['surat_tugas']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);

				$targetFile =  "Surat_Tugas_".$registered["kode"].".".$ext;

				move_uploaded_file($tempFile,$targetPath. "/" .$targetFile);
				
				$data["surat_tugas"] = $targetFile;
				
				if ($type == "Narasumber") {
					$id = $this->narasumber_model->save($data, $id);
				}
				else if ($type == "Panitia") {
					$id = $this->panitia_model->save($data, $id);
				}
				else if ($type == "Moderator") {
					$id = $this->moderator_model->save($data, $id);
				}
				else if ($type == "Pengajar Praktek") {
					$id = $this->pengajar_praktek_model->save($data, $id);
				}
				else if ($type == "Fasilitator") {
					$id = $this->fasilitator_model->save($data, $id);
				}
				else if ($type == "Instruktur") {
					$id = $this->instruktur_model->save($data, $id);
				}
				else if ($type == "Pengawas") {
					$id = $this->pengawas_model->save($data, $id);
				}
				else if ($type == "Kepala Sekolah") {
					$id = $this->kepala_sekolah_model->save($data, $id);
				}
				else {
					$id = $this->peserta_model->save($data, $id);
				}
			}
			
			// handle ttd
			if (isset($data["tanda_tangan"]) && !empty($data["tanda_tangan"])) {
				$data_uri = $data["tanda_tangan"];
				$encoded_image = explode(",", $data_uri)[1];
				$decoded_image = base64_decode($encoded_image);
				
				$dir = APPPATH . "../assets/ttd/".$kegiatan["kode"]; // Full Path
				//$name = 'ttd-'.$registered["kode"].'.png';
				$name = 'ttd-'.$ktp.'.png';

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
			
			if (isset($data["surat_tugas"])) {
				unset($data["surat_tugas"]);
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
			else if ($type == "Moderator") {
				$data["moderator"] = $registered;
			}
			else if ($type == "Pengajar Praktek") {
				$data["pp"] = $registered;
			}
			else if ($type == "Fasilitator") {
				$data["fasil"] = $registered;
			}
			else if ($type == "Instruktur") {
				$data["instruktur"] = $registered;
			}
			else if ($type == "Pengawas") {
				$data["pengawas"] = $registered;
			}
			else if ($type == "Kepala Sekolah") {
				$data["kepala_sekolah"] = $registered;
			}
			else {
				$data["peserta"] = $registered;
			}
			
			$out["html"] = $this->load->view('frontend/kegiatan/kegiatan_registrasi_berhasil', $data, true);
		}
		
		print json_encode($out);
		exit();
	}
	
	/**
	 * save registrasi kegiatan 
	 */
	public function registrasi_save2 () {
		$out = array();
		$out["error"] = true;
		$out["msg"] = "Gagal melakukan pendaftaran!";
		
		if (isset($_POST) && !empty($_POST)) {
			$kegiatanId = $_POST["kegiatan_id"];
			
			$ktp = $_POST["nik"];
			unset($_POST["nik"]);
			
			$type = $_POST["type"];
			unset($_POST["type"]);
			
			if ($_POST["kab_unit_kerja"] == "Lainnya") {
				$_POST["kab_unit_kerja"] = $_POST["kab_unit_kerja_lainnya"];
			}
			unset($_POST["kab_unit_kerja_lainnya"]);
			
			if (isset($_POST["buku_tabungan"])) {
			    unset($_POST["buku_tabungan"]);
			}
			
			$id = 0;
			$data = $_POST;
			$data["ktp"] = $ktp;
			
			// tgl lahir format
			if (isset($data["tgl_lahir"]) && !empty($data["tgl_lahir"])) {
				$data["tgl_lahir"] = date("Y-m-d",strtotime(str_replace(array("/"),array("-"),$data["tgl_lahir"])));
			}
			
			$kegiatan = $this->kegiatan_model->getKegiatanById($kegiatanId);
			$komponen = $this->master_komponen_kegiatan_model->get_record_by_code($_POST['code_komponen']);
			 
			$user = $this->komponen_kegiatan_model->getDetailByNik($data['table_komponen'], $kegiatanId, $data["ktp"]);
			
			if (!empty($user)) {
				$id = $user["id"];
			}
			unset($data['code_komponen']);
			unset($data['table_komponen']);

			$id = $this->komponen_kegiatan_model->save($_POST['table_komponen'], $_POST['code_komponen'], $data, $id);
 
			// if ($type == "Narasumber") {
			// 	// Check Narasumber Apakah Sudah Pernah Daftar
			// 	$narasumber = $this->narasumber_model->getNarasumber($kegiatanId, $data["ktp"]);

			// 	if (!empty($narasumber)) {
			// 		$id = $narasumber["id"];
			// 	}

			// 	$id = $this->narasumber_model->save($data, $id);
			// }
			// else if ($type == "Panitia") {
			// 	// Check Panitia Apakah Sudah Pernah Daftar
			// 	$panitia = $this->panitia_model->getPanitia($kegiatanId, $data["ktp"]);

			// 	if (!empty($panitia)) {
			// 		$id = $panitia["id"];
			// 	}

			// 	$id = $this->panitia_model->save($data, $id);
			// }
			// else if ($type == "Moderator") {
			// 	// Check Moderator Apakah Sudah Pernah Daftar
			// 	$pa = $this->moderator_model->get($kegiatanId, $data["ktp"]);

			// 	if (!empty($pa)) {
			// 		$id = $pa["id"];
			// 	}

			// 	$id = $this->moderator_model->save($data, $id);
			// }
			// else if ($type == "Pengajar Praktek") {
			// 	// Check Pengajar Praktek Apakah Sudah Pernah Daftar
			// 	$pp = $this->pengajar_praktek_model->get($kegiatanId, $data["ktp"]);

			// 	if (!empty($pp)) {
			// 		$id = $pp["id"];
			// 	}

			// 	$id = $this->pengajar_praktek_model->save($data, $id);
			// }
			// else if ($type == "Fasilitator") {
			// 	// Check Fasilitator Apakah Sudah Pernah Daftar
			// 	$fasil = $this->fasilitator_model->get($kegiatanId, $data["ktp"]);

			// 	if (!empty($fasil)) {
			// 		$id = $fasil["id"];
			// 	}

			// 	$id = $this->fasilitator_model->save($data, $id);
			// }
			// else if ($type == "Instruktur") {
			// 	// Check Fasilitator Apakah Sudah Pernah Daftar
			// 	$instruktur = $this->instruktur_model->get($kegiatanId, $data["ktp"]);

			// 	if (!empty($instruktur)) {
			// 		$id = $instruktur["id"];
			// 	}

			// 	$id = $this->instruktur_model->save($data, $id);
			// }
			// else if ($type == "Pengawas") {
			// 	// Check Pengawas Apakah Sudah Pernah Daftar
			// 	$pengawas = $this->pengawas_model->get($kegiatanId, $data["ktp"]);

			// 	if (!empty($pengawas)) {
			// 		$id = $pengawas["id"];
			// 	}

			// 	$id = $this->pengawas_model->save($data, $id);
			// }
			// else if ($type == "Kepala Sekolah") {
			// 	// Check Kepala Sekolah Apakah Sudah Pernah Daftar
			// 	$kepsek = $this->kepala_sekolah_model->get($kegiatanId, $data["ktp"]);

			// 	if (!empty($kepsek)) {
			// 		$id = $kepsek["id"];
			// 	}

			// 	$id = $this->kepala_sekolah_model->save($data, $id);
			// }
			// else {
			// 	// Check Peserta Apakah Sudah Pernah Daftar
			// 	$peserta = $this->peserta_model->getPeserta($kegiatanId, $data["ktp"]);

			// 	if (!empty($peserta)) {
			// 		$id = $peserta["id"];
			// 	}

			// 	$id = $this->peserta_model->save($data, $id);
			// }
			$registered = $this->komponen_kegiatan_model->getDetailByNik($_POST['table_komponen'], $kegiatanId, $data["ktp"]);
			
			// if ($type == "Narasumber") {
			// 	$registered = $this->narasumber_model->getNarasumber($kegiatanId, $data["ktp"]);
			// }
			// else if ($type == "Panitia") {
			// 	$registered = $this->panitia_model->getPanitia($kegiatanId, $data["ktp"]);
			// }
			// else if ($type == "Moderator") {
			// 	$registered = $this->moderator_model->get($kegiatanId, $data["ktp"]);
			// }
			// else if ($type == "Pengajar Praktek") {
			// 	$registered = $this->pengajar_praktek_model->get($kegiatanId, $data["ktp"]);
			// }
			// else if ($type == "Fasilitator") {
			// 	$registered = $this->fasilitator_model->get($kegiatanId, $data["ktp"]);
			// }
			// else if ($type == "Instruktur") {
			// 	$registered = $this->instruktur_model->get($kegiatanId, $data["ktp"]);
			// }
			// else if ($type == "Pengawas") {
			// 	$registered = $this->pengawas_model->get($kegiatanId, $data["ktp"]);
			// }
			// else if ($type == "Kepala Sekolah") {
			// 	$registered = $this->kepala_sekolah_model->get($kegiatanId, $data["ktp"]);
			// }
			// else {
			// 	$registered = $this->peserta_model->getPesertaById($id);
			// }
			
			// handle surat tugas
			if (isset($_FILES['surat_tugas']) && !empty($_FILES['surat_tugas'])) {
				$files = array();
				$allowed = array('pdf', 'jpg', 'jpeg', 'png');
				$allowedSize = 3145728; // 3 Mb
				
				$tempFile = $_FILES['surat_tugas']["tmp_name"];          
      
				$targetPath = $dir = APPPATH . "../assets/surat_tugas/".$kegiatan["kode"];
				
				is_dir($targetPath) || @mkdir($targetPath) || die("Can't Create folder");
				
				$filename = $_FILES['surat_tugas']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);

				$targetFile =  "Surat_Tugas_".$registered["kode"].".".$ext;

				move_uploaded_file($tempFile,$targetPath. "/" .$targetFile);
				
				$data["surat_tugas"] = $targetFile;
				
				$id = $this->komponen_kegiatan_model->save($_POST['table_komponen'], $_POST['code_komponen'], $data, $id);
				
				// if ($type == "Narasumber") {
				// 	$id = $this->narasumber_model->save($data, $id);
				// }
				// else if ($type == "Panitia") {
				// 	$id = $this->panitia_model->save($data, $id);
				// }
				// else if ($type == "Moderator") {
				// 	$id = $this->moderator_model->save($data, $id);
				// }
				// else if ($type == "Pengajar Praktek") {
				// 	$id = $this->pengajar_praktek_model->save($data, $id);
				// }
				// else if ($type == "Fasilitator") {
				// 	$id = $this->fasilitator_model->save($data, $id);
				// }
				// else if ($type == "Instruktur") {
				// 	$id = $this->instruktur_model->save($data, $id);
				// }
				// else if ($type == "Pengawas") {
				// 	$id = $this->pengawas_model->save($data, $id);
				// }
				// else if ($type == "Kepala Sekolah") {
				// 	$id = $this->kepala_sekolah_model->save($data, $id);
				// }
				// else {
				// 	$id = $this->peserta_model->save($data, $id);
				// }
			}
			
			// handle buku tabungan
			if (isset($_FILES['buku_tabungan']) && !empty($_FILES['buku_tabungan'])) {
				$files = array();
				$allowed = array('pdf', 'jpg', 'jpeg', 'png');
				$allowedSize = 3145728; // 3 Mb
				
				$tempFile = $_FILES['buku_tabungan']["tmp_name"];          
      
				$targetPath = $dir = APPPATH . "../assets/buku_tabungan";
				
				is_dir($targetPath) || @mkdir($targetPath) || die("Can't Create folder");
				
				$filename = $_FILES['buku_tabungan']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);

				$targetFile =  "tabungan_".$ktp.".".$ext;

				move_uploaded_file($tempFile,$targetPath. "/" .$targetFile);
				
				if ($ext == "jpeg" || $ext == "jpg" || $ext == "png") {
					
					if ($ext == "jpeg" || $ext == "jpg") {
						$imageTmp = imagecreatefromjpeg($targetPath. "/" .$targetFile);
					}
					else if ($ext == "png") {
						$imageTmp = imagecreatefrompng($targetPath. "/" .$targetFile);
					}
				    
				    imagejpeg($imageTmp, $targetPath. "/" ."tabungan_".$ktp.".jpg", 25);
                    imagedestroy($imageTmp);
                    
					if ($ext != "jpg") {
						unlink($targetPath. "/" .$targetFile);
					}
				}
				
				if (file_exists($targetPath. "/" ."tabungan_".$ktp.".jpg")) {
					$im = new imagick($targetPath. "/" ."tabungan_".$ktp.".jpg");
					$im->setImageCompression(true);
					$im->setCompression(Imagick::COMPRESSION_JPEG);
					$im->setCompressionQuality(25); 
					$im->setImageFormat("jpg");
					$im->stripImage();

					$im->writeImage($targetPath. "/" ."tabungan_".$ktp.".jpg"); 
					$im->clear(); 
					$im->destroy();
				}
			}
			
			// handle ttd
			if (isset($data["tanda_tangan"]) && !empty($data["tanda_tangan"])) {
				$data_uri = $data["tanda_tangan"];
				$encoded_image = explode(",", $data_uri)[1];
				$decoded_image = base64_decode($encoded_image);
				
				$dir = APPPATH . "../assets/ttd/".$kegiatan["kode"]; // Full Path
				$name = 'ttd-'.$ktp.'.png';

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
			
			if (isset($data["surat_tugas"])) {
				unset($data["surat_tugas"]);
			}
			
			if (isset($data["kategori"])) {
				unset($data["kategori"]);
			}
			
			$this->biodata_model->updateByNIK($data);
			
			
			// Prepare For Preview
			$out["error"] = false;
			$out["msg"] = "Berhasil melakukan pendaftaran!";
			$data["kegiatan"] = $kegiatan;
			
			$data[$komponen->code] = $registered;

			// if ($type == "Narasumber") {
			// 	$data["narasumber"] = $registered;
			// }
			// else if ($type == "Panitia") {
			// 	$data["panitia"] = $registered;
			// }
			// else if ($type == "Moderator") {
			// 	$data["moderator"] = $registered;
			// }
			// else if ($type == "Pengajar Praktek") {
			// 	$data["pp"] = $registered;
			// }
			// else if ($type == "Fasilitator") {
			// 	$data["fasil"] = $registered;
			// }
			// else if ($type == "Instruktur") {
			// 	$data["instruktur"] = $registered;
			// }
			// else if ($type == "Pengawas") {
			// 	$data["pengawas"] = $registered;
			// }
			// else if ($type == "Kepala Sekolah") {
			// 	$data["kepala_sekolah"] = $registered;
			// }
			// else {
			// 	$data["peserta"] = $registered;
			// }
			
			$out["html"] = $this->load->view('frontend/kegiatan/kegiatan_registrasi_berhasil', $data, true);
		}
		
		print json_encode($out);
		exit();
	}
	
	public function form_daftar_hadir ($type = "peserta", $idKegiatan, $tglKegiatan) {
		$data = array();
		$data["type"] = $type;
		$data["tgl_daftar_hadir"] = date("Y-m-d", $tglKegiatan);
		$data["title"] = "Daftar Hadir";
		
		// Lookup Satker Header
		$pengaturan = $this->pengaturan_model->getPengaturanBySection("satker");
		
		if (!empty($pengaturan)) {
			foreach ($pengaturan as $foo) {
				$data["satker"][$foo["sistem"]] = $foo["value"];
			}
		}
		
		// Lookup Kegiatan
		$kegiatan = $this->kegiatan_model->getKegiatanById($idKegiatan);
		
		if (!empty($kegiatan)) {
			$data["title"] .= " Kegiatan ".$kegiatan["nama"];
			$data["kegiatan"] = $kegiatan;
            $this->load->view('frontend/kegiatan/daftar_hadir', $data);
		}
		else {
			$this->load->view('frontend/errors/logo');
		}
	}
	
	public function daftar_hadir ($komponen, $idKegiatan, $tglKegiatan) {
		$this->form_daftar_hadir($komponen, $idKegiatan, $tglKegiatan);
	}
	
	public function getItemKegiatan () {
		$data = array();
		
		if (isset($_POST) && !empty($_POST)) {
			$nik = $_POST["nik"];
			$kegiatan = $_POST["kegiatan"];
			$type = $_POST["type"];
			
			$biodata = array();
			
			if ($type == "narasumber") {
				$biodata = $this->narasumber_model->getNarasumber($kegiatan, $nik);
			}
			else if ($type == "panitia") {
				$biodata = $this->panitia_model->getPanitia($kegiatan, $nik);
			}
			else if ($type == "moderator") {
				$biodata = $this->moderator_model->get($kegiatan, $nik);
			}
			else if ($type == "pengajar_praktik") {
				$biodata = $this->pengajar_praktek_model->get($kegiatan, $nik);
			}
			else if ($type == "fasilitator") {
				$biodata = $this->fasilitator_model->get($kegiatan, $nik);
			}
			else if ($type == "instruktur") {
				$biodata = $this->instruktur_model->get($kegiatan, $nik);
			}
			else if ($type == "pengawas") {
				$biodata = $this->pengawas_model->get($kegiatan, $nik);
			}
			else if ($type == "kepala_sekolah") {
				$biodata = $this->kepala_sekolah_model->get($kegiatan, $nik);
			}
			else {
				$biodata = $this->peserta_model->getPeserta($kegiatan, $nik);
			}
			
			if (!empty($biodata)) {
				$data["biodata"] = $biodata;
			}
		}
		
		print json_encode($data);
	}
	
	public function daftar_hadir_save () {
		$out = array();
		$out["error"] = false;
		$out["msg"] = "Daftar hadir berhasil disimpan";
		
		if (isset($_POST) && !empty($_POST)) {
			
			$kegiatanId = $_POST["kegiatan_id"];
			
			$kegiatan = $this->kegiatan_model->getKegiatanById($kegiatanId);
			
			if (!empty($kegiatan)) {
				$data = $_POST;
				$type = $_POST["type"];
				
				if ($type == "narasumber") {
					$registered = $this->narasumber_model->getNarasumber($kegiatanId, $data["nik"]);
				}
				else if ($type == "panitia") {
					$registered = $this->panitia_model->getPanitia($kegiatanId, $data["nik"]);
				}
				else if ($type == "moderator") {
					$registered = $this->moderator_model->get($kegiatanId, $data["nik"]);
				}
				else if ($type == "pengajar_praktik") {
					$registered = $this->pengajar_praktek_model->get($kegiatanId, $data["nik"]);
				}
				else if ($type == "fasilitator") {
					$registered = $this->fasilitator_model->get($kegiatanId, $data["nik"]);
				}
				else if ($type == "instruktur") {
					$registered = $this->instruktur_model->get($kegiatanId, $data["nik"]);
				}
				else if ($type == "pengawas") {
					$registered = $this->pengawas_model->get($kegiatanId, $data["nik"]);
				}
				else if ($type == "kepala_sekolah") {
					$registered = $this->kepala_sekolah_model->get($kegiatanId, $data["nik"]);
				}
				else {
					$registered = $this->peserta_model->getPeserta($kegiatanId, $data["nik"]);
				}
				
				if (!empty($registered)) {
					$id = $registered["id"];
					$kehadiran = date("Y-m-d", strtotime($data["tgl_daftar_hadir"]));
					
					$update = array();
					
					$update["daftar_hadir"] = array();
					$update["daftar_hadir"][$kehadiran] = 1;

					if (isset($registered["daftar_hadir"]) && !empty($registered["daftar_hadir"])) {
						$update["daftar_hadir"] = json_decode($registered["daftar_hadir"], true);
						$update["daftar_hadir"][$kehadiran] = 1;
					}
					
					$update["daftar_hadir"] = json_encode($update["daftar_hadir"]);
					
					if ($type == "narasumber") {
						$id = $this->narasumber_model->save($update, $id);
					}
					else if ($type == "panitia") {
						$id = $this->panitia_model->save($update, $id);
					}
					else if ($type == "moderator") {
						$id = $this->moderator_model->save($update, $id);
					}
					else if ($type == "pengajar_praktik") {
						$id = $this->pengajar_praktek_model->save($update, $id);
					}
					else if ($type == "fasilitator") {
						$id = $this->fasilitator_model->save($update, $id);
					}
					else if ($type == "instruktur") {
						$id = $this->instruktur_model->save($update, $id);
					}
					else if ($type == "pengawas") {
						$id = $this->pengawas_model->save($update, $id);
					}
					else if ($type == "kepala_sekolah") {
						$id = $this->kepala_sekolah_model->save($update, $id);
					}
					else {
						$id = $this->peserta_model->save($update, $id);
					}
				}
				
				// TTD HANDLE
				if (isset($data["tanda_tangan"]) && !empty($data["tanda_tangan"])) {
					$data_uri = $data["tanda_tangan"];
					$encoded_image = explode(",", $data_uri)[1];
					$decoded_image = base64_decode($encoded_image);

					$dir = APPPATH . "../assets/ttd/".$kegiatan["kode"]; // Full Path
					
					is_dir($dir) || @mkdir($dir) || die("Can't Create folder");
					
					$dir .= "/".date("d_m_Y", strtotime($data["tgl_daftar_hadir"]));
					
					is_dir($dir) || @mkdir($dir) || die("Can't Create folder");
					
					$name = 'ttd-'.$data["nik"].'.png';

					file_put_contents($dir."/".$name, $decoded_image);

					$this->utility->resize_image($dir."/".$name, 200);
				}

				$data["kegiatan"] = $kegiatan;
				
				$out["html"] = $this->load->view('frontend/kegiatan/kegiatan_daftar_hadir_berhasil', $data, true);
			}
			else {
				$out["error"] = true;
				$out["msg"] = "Anda Belum Terdaftar";
			}
		}
		else {
			$out["error"] = true;
			$out["msg"] = "Anda Belum Terdaftar";
		}
		
		print json_encode($out);
	}
}
