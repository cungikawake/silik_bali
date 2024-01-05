<?php
	$waGrup = "";
	$teleGrup = "";

	$komponen = "peserta";

	if (isset($narasumber) && !empty($narasumber)) {
		$type = "Narasumber";
		$komponen = "narasumber";
		$bio = $narasumber;
		
		if (!empty($kegiatan["wa_grup_narasumber"])) {
			$waGrup = $kegiatan["wa_grup_narasumber"];
		}
		
		if (!empty($kegiatan["tele_grup_narasumber"])) {
			$teleGrup = $kegiatan["tele_grup_narasumber"];
		}
	}
	else if (isset($panitia) && !empty($panitia)) {
		$type = "Panitia";
		$komponen = "panitia";
		$bio = $panitia;
		
		if (!empty($kegiatan["wa_grup_panitia"])) {
			$waGrup = $kegiatan["wa_grup_panitia"];
		}
		
		if (!empty($kegiatan["tele_grup_panitia"])) {
			$teleGrup = $kegiatan["tele_grup_panitia"];
		}
	}
	else if (isset($moderator) && !empty($moderator)) {
		$type = "Moderator";
		$komponen = "moderator";
		$bio = $moderator;
		
		if (!empty($kegiatan["wa_grup_moderator"])) {
			$waGrup = $kegiatan["wa_grup_moderator"];
		}
		
		if (!empty($kegiatan["tele_grup_moderator"])) {
			$teleGrup = $kegiatan["tele_grup_moderator"];
		}
	}
	else if (isset($pp) && !empty($pp)) {
		$type = "Pengajar Praktek";
		$komponen = "pengajar_praktek";
		$bio = $pp;
		
		if (!empty($kegiatan["wa_grup_pp"])) {
			$waGrup = $kegiatan["wa_grup_pp"];
		}
		
		if (!empty($kegiatan["tele_grup_pp"])) {
			$teleGrup = $kegiatan["tele_grup_pp"];
		}
	}
	else if (isset($fasil) && !empty($fasil)) {
		$type = "Fasilitator";
		$komponen = "fasilitator";
		$bio = $fasil;
		
		if (!empty($kegiatan["wa_grup_fasil"])) {
			$waGrup = $kegiatan["wa_grup_fasil"];
		}
		
		if (!empty($kegiatan["tele_grup_fasil"])) {
			$teleGrup = $kegiatan["tele_grup_fasil"];
		}
	}
	else if (isset($instruktur) && !empty($instruktur)) {
		$type = "Instruktur";
		$komponen = "instruktur";
		$bio = $instruktur;
		
		if (!empty($kegiatan["wa_grup_instruktur"])) {
			$waGrup = $kegiatan["wa_grup_instruktur"];
		}
		
		if (!empty($kegiatan["tele_grup_instruktur"])) {
			$teleGrup = $kegiatan["tele_grup_instruktur"];
		}
	}
	else if (isset($pengawas) && !empty($pengawas)) {
		$type = "Pengawas";
		$komponen = "pengawas";
		$bio = $pengawas;
		
		if (!empty($kegiatan["wa_grup_pengawas"])) {
			$waGrup = $kegiatan["wa_grup_pengawas"];
		}
		
		if (!empty($kegiatan["tele_grup_pengawas"])) {
			$teleGrup = $kegiatan["tele_grup_pengawas"];
		}
	}
	else if (isset($kepala_sekolah) && !empty($kepala_sekolah)) {
		$type = "Kepala Sekolah";
		$komponen = "kepala_sekolah";
		$bio = $kepala_sekolah;
		
		if (!empty($kegiatan["wa_grup_kepala_sekolah"])) {
			$waGrup = $kegiatan["wa_grup_kepala_sekolah"];
		}
		
		if (!empty($kegiatan["tele_grup_kepala_sekolah"])) {
			$teleGrup = $kegiatan["tele_grup_kepala_sekolah"];
		}
	}
	else {
		$type = "Peserta";
		$komponen = "peserta";
		$bio = $peserta;
		
		if (!empty($kegiatan["wa_grup_peserta"])) {
			$waGrup = $kegiatan["wa_grup_peserta"];
		}
		
		if (!empty($kegiatan["tele_grup_peserta"])) {
			$teleGrup = $kegiatan["tele_grup_peserta"];
		}
	}
?>

<div class="card-block card-block-congrats">
	<div class="modal-body">
		<div class="form-group m-b-10">
			<div class="congrats-logo"><img src="<?php print base_url("assets/images/hore.png"); ?>" /></div>
			<div class="congrats">SELAMAT!</div>
			<div class="congrats-desc">Berhasil Melakukan Pendaftaran.</div>
			
			<?php
				if ($kegiatan["tipe_kegiatan"] == "Luring") {
			?>
			<div class="text-wa-grup">Silahkan download dan print (A4) Biodata dilink berikut ini<br />
				<a href="<?php print base_url("/admin/kegiatan/download_single_biodata/".$komponen."/".$bio["id"]); ?>" class="btn btn-info" target="_blank"><strong><i class="fas fa-address-book"></i> &nbsp;Download Biodata</strong></a>
			</div>
			
			<div class="text-wa-grup">
				<strong>MOHON MEMBAWA KELENGKAPAN BERIKUT PADA SAAT KEGIATAN</strong><br />
					1. Surat Tugas<br />
								2. Surat Perjalanan Dinas (SPD)<br />
								3. Biodata<br />
								4. Dan lainnya sesuai undangan.<br />
			</div>
			<?php
				}
				else {
			?>
					<div class="text-no-reg">Nomor Pendaftaran Anda</div>
					<div class="no-reg"><div><?php print $bio["kode"]; ?></div></div>
			<?php
				}
			?>
			
			<?php
				if (!empty($waGrup) || !empty($teleGrup)) {
			?>
					<div class="text-wa-grup">Untuk informasi lebih lanjut, silahkan bergabung ke Grup Chat Dibawah ini</div>
			<?php
				}
			
				if (!empty($waGrup)) {
			?>
				<div class="btn-wa-grup"><a href="<?php print $waGrup; ?>" target="_blank" class="btn btn-primary"><i class="fab fa-whatsapp"></i> Bergabung Grup WA</a></div>
			<?php
				}
			
				if (!empty($teleGrup)) {
			?>
				<div class="btn-tele-grup"><a href="<?php print $teleGrup; ?>" target="_blank" class="btn btn-primary"><i class="fab fa-telegram-plane"></i> Bergabung Grup Telegram</a></div>
			<?php
				}
			?>
			
		</div>
	</div>
</div>