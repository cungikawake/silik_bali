<?php $url_2 = $this->uri->segment(3); ?>

<ul class="nav nav-pills nav-pills-perjadin">
	<?php if ($this->utility->hasUserAccess("peserta_kegiatan","list") && isset($kegiatan["komponen"]["peserta"]) && $kegiatan["komponen"]["peserta"] == "1") { ?>
	<li class="nav-item">
		<a class="nav-link <?php if ($url_2 == "peserta") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/peserta/".$kegiatan["id"]."/"); ?>">Peserta</a>
	</li>
	<?php } ?>

	<?php if ($this->utility->hasUserAccess("narasumber_kegiatan","list") && isset($kegiatan["komponen"]["narasumber"]) && $kegiatan["komponen"]["narasumber"] == "1") { ?>
	<li class="nav-item">
		<a class="nav-link <?php if ($url_2 == "narasumber") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/narasumber/".$kegiatan["id"]."/"); ?>">Narasumber</a>
	</li>
	<?php } ?>
	
	<?php if ($this->utility->hasUserAccess("moderator_kegiatan","list") && isset($kegiatan["komponen"]["moderator"]) && $kegiatan["komponen"]["moderator"] == "1") { ?>
		<li class="nav-item">
			<a class="nav-link <?php if ($url_2 == "moderator") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/moderator/".$kegiatan["id"]."/"); ?>">Moderator</a>
		</li>
	<?php } ?>	
	
	<?php if ($this->utility->hasUserAccess("panitia_kegiatan","list") && isset($kegiatan["komponen"]["panitia"]) && $kegiatan["komponen"]["panitia"] == "1") { ?>
	<li class="nav-item">
		<a class="nav-link <?php if ($url_2 == "panitia") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/panitia/".$kegiatan["id"]."/"); ?>">Panitia</a>
	</li>
	<?php } ?>
	
	<?php if ($this->utility->hasUserAccess("instruktur_kegiatan","list") && isset($kegiatan["komponen"]["instruktur"]) && $kegiatan["komponen"]["instruktur"] == "1") { ?>
		<li class="nav-item">
			<a class="nav-link <?php if ($url_2 == "instruktur") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/instruktur/".$kegiatan["id"]."/"); ?>">Instruktur</a>
		</li>
	<?php } ?>
	
	<?php if ($this->utility->hasUserAccess("pengajar_praktek_kegiatan","list") && isset($kegiatan["komponen"]["pengajar_praktek"]) && $kegiatan["komponen"]["pengajar_praktek"] == "1") { ?>
		<li class="nav-item">
			<a class="nav-link <?php if ($url_2 == "pengajar_praktek") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/pengajar_praktek/".$kegiatan["id"]."/"); ?>">Pengajar Praktek</a>
		</li>
	<?php } ?>
	
	<?php if ($this->utility->hasUserAccess("fasilitator_kegiatan","list") && isset($kegiatan["komponen"]["fasilitator"]) && $kegiatan["komponen"]["fasilitator"] == "1") { ?>
		<li class="nav-item">
			<a class="nav-link <?php if ($url_2 == "fasilitator") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/fasilitator/".$kegiatan["id"]."/"); ?>">Fasilitator</a>
		</li>
	<?php } ?>
	
	<?php if ($this->utility->hasUserAccess("pengawas_kegiatan","list") && isset($kegiatan["komponen"]["pengawas"]) && $kegiatan["komponen"]["pengawas"] == "1") { ?>
		<li class="nav-item">
			<a class="nav-link <?php if ($url_2 == "pengawas") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/pengawas/".$kegiatan["id"]."/"); ?>">Pengawas</a>
		</li>
	<?php } ?>
	
	<?php if ($this->utility->hasUserAccess("kepala_sekolah_kegiatan","list") && isset($kegiatan["komponen"]["kepala_sekolah"]) && $kegiatan["komponen"]["kepala_sekolah"] == "1") { ?>
		<li class="nav-item">
			<a class="nav-link <?php if ($url_2 == "kepala_sekolah") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/kepala_sekolah/".$kegiatan["id"]."/"); ?>">Kepala Sekolah</a>
		</li>
	<?php } ?>
	
	

	<?php if ($this->utility->hasUserAccess("data_dukung_kegiatan","list")) { ?>
	<li class="nav-item">
		<a class="nav-link <?php if ($url_2 == "data_dukung") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/data_dukung/".$kegiatan["id"]."/"); ?>">Data Dukung</a>
	</li>
	<?php } ?>
	
	<?php
		$showMoreOpt = false;
		$opt = "keg-more-opt-peserta";
	
		if ($url_2 == "peserta") {
			$showMoreOpt = true;
			$opt = "keg-more-opt-peserta";
		}
		else if ($url_2 == "narasumber") {
			$showMoreOpt = true;
			$opt = "keg-more-opt-narasumber";
		}
		else if ($url_2 == "panitia") {
			$showMoreOpt = true;
			$opt = "keg-more-opt-panitia";
		}
		else if ($url_2 == "moderator") {
			$showMoreOpt = true;
			$opt = "keg-more-opt-moderator";
		}
		else if ($url_2 == "pengajar_praktek") {
			$showMoreOpt = true;
			$opt = "keg-more-opt-pp";
		}
		else if ($url_2 == "fasilitator") {
			$showMoreOpt = true;
			$opt = "keg-more-opt-fasil";
		}
		else if ($url_2 == "instruktur") {
			$showMoreOpt = true;
			$opt = "keg-more-opt-instruktur";
		}
		else if ($url_2 == "pengawas") {
			$showMoreOpt = true;
			$opt = "keg-more-opt-pengawas";
		}
		else if ($url_2 == "kepala_sekolah") {
			$showMoreOpt = true;
			$opt = "keg-more-opt-kepala_sekolah";
		}
	
		if ($showMoreOpt) {
	?>
		<li class="nav-more-opt"><a data-toggle="collapse" href="#<?php print $opt; ?>" role="button" aria-expanded="true" aria-controls="<?php print $opt; ?>"><i class="fas fa-angle-down"></i></a></li>
	<?php
		}
	?>
</ul>
<style type="text/css">
	.btn-edit-spd-link { padding: 6px 10px; margin: 0 0 4px; }
	.btn-edit-spd-link i { margin: 0; }
	.input-edit-spd-link { width: 85%; padding: 7px 12px; display: inline-block; cursor: pointer; }
</style>

<div class="keg-more-opt">
	<?php if ($url_2 == "peserta") { ?>
		<div id="keg-more-opt-peserta" class="collapse">
			<div class="keg-opt-form">
				<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
					<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
					<input type="hidden" name="form_show_bank_peserta" value="0" />
					<input type="hidden" name="form_show_confirm_paket_peserta" value="0" />
					<input type="hidden" name="form_ttd_peserta" value="0" />
					<input type="hidden" name="form_upload_surtug_peserta" value="0" />
					<input type="hidden" name="form_wajib_surtug_peserta" value="0" />
					<?php
						$bankPeserta = '';
						$paketPeserta = '';
						$ttdPeserta = '';
						$upSurtugPeserta = '';
						$surtugPeserta = '';

						if ($kegiatan["form_show_bank_peserta"]) {
							$bankPeserta = 'checked="checked"';
						}

						if ($kegiatan["form_show_confirm_paket_peserta"]) {
							$paketPeserta = 'checked="checked"';
						}

						if ($kegiatan["form_ttd_peserta"]) {
							$ttdPeserta = 'checked="checked"';
						}
									
						if ($kegiatan["form_upload_surtug_peserta"]) {
							$upSurtugPeserta = 'checked="checked"';
						}
									
						if ($kegiatan["form_wajib_surtug_peserta"]) {
							$surtugPeserta = 'checked="checked"';
						}
					?>
					<div class="row">
						
						<div class="col-md-12">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item active">
									<a class="nav-link" href="#form-peserta" data-toggle="tab">Form Pendaftaran</a>
								</li>
								
								<?php
									if ($kegiatan["tipe_kegiatan"] == "Daring") {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#dh-peserta" data-toggle="tab">Daftar Hadir</a>
										</li>
								<?php
									}
									else {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#spd-peserta" data-toggle="tab">Surat Perjalanan Dinas</a>
										</li>
								<?php
									}
								?>
								<li class="nav-item">
									<a class="nav-link" href="#sertifikat-peserta" data-toggle="tab">Sertifikat</a>
								</li>
							</ul>
						</div>
						
						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane active" id="form-peserta">
									<div class="row">
										<div class="col-md-6">
											<label>Form Pendaftaran Peserta</label>
											<div class="form-group">
												<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
													<input type="checkbox" name="form_show_bank_peserta" id="checkbox-p-1" <?php print $bankPeserta; ?> value="1" />
													<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
												</div>
												<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
													<input type="checkbox" name="form_show_confirm_paket_peserta" id="checkbox-p-2" <?php print $paketPeserta; ?> value="1" />
													<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
												</div>
												<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
													<input type="checkbox" name="form_ttd_peserta" id="checkbox-p-x1" <?php print $ttdPeserta; ?> value="1" />
													<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
												</div>
											</div>
											<div class="form-group">
												<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
													<input type="checkbox" name="form_upload_surtug_peserta" id="checkbox-st-1" <?php print $upSurtugPeserta; ?> value="1" />
													<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
												</div>
												<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
													<input type="checkbox" name="form_wajib_surtug_peserta" id="checkbox-st-2" <?php print $surtugPeserta; ?> value="1" />
													<label for="checkbox-st-2" class="cr">Peserta Wajib Upload Surat Tugas</label>
												</div>
											</div>
											<label>Pengkelasan</label>
											<div class="form-group">
												<?php
													$pengkelasan = "";
													if (isset($kegiatan["kategori"]["peserta"]) && !empty($kegiatan["kategori"]["peserta"])) {
														$pengkelasan = $kegiatan["kategori"]["peserta"];
													}
												?>
												<textarea class="form-control" rows="4" name="kategori[peserta]"><?php print $pengkelasan; ?></textarea>
												<small>Kosongkan jika tidak ada pengkelasan; Enter untuk tiap nama kelas.</small>
											</div>
											
										</div>
										<div class="col-md-5">
											<label>Link WA Grup Peserta</label>
											<div class="form-group">
												<div class="input-group input-group-sm">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
													</div>
													<input type="text" class="form-control" name="wa_grup_peserta" value="<?php print $kegiatan["wa_grup_peserta"]; ?>" />
												</div>
											</div>

											<label>Link Telegram Grup Peserta</label>
											<div class="form-group">
												<div class="input-group input-group-sm">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
													</div>
													<input type="text" class="form-control" name="tele_grup_peserta" value="<?php print $kegiatan["tele_grup_peserta"]; ?>" />
												</div>
												<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="dh-peserta">
									<div class="row">
										<div class="col-md-6">
											<?php
												if (isset($kegiatan["detail_tgl_kegiatan"]) && !empty($kegiatan["detail_tgl_kegiatan"])) {
													foreach ($kegiatan["detail_tgl_kegiatan"] as $tglDetail) {
											?>
													<div class="form-group">
														<label>Daftar Hadir (<?php print $this->utility->formatShortDateIndo($tglDetail); ?>)</label>
														<input type="text" class="form-control" readonly value="<?php print base_url("kegiatan/daftar_hadir_peserta/".$kegiatan["id"]."/".strtotime($tglDetail)); ?>" />
													</div>
											<?php
													}
												}
												else {
													
												}
											?>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="spd-peserta">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Nama Pejabat Tujuan Perjalanan Dinas</label>
												<input type="text" class="form-control" name="spd_nama" value="<?php print $kegiatan["spd_nama"]; ?>" />
											</div>
											<div class="form-group">
												<label>NIP Pejabat Tujuan Perjalanan Dinas</label>
												<input type="text" class="form-control" name="spd_nip" value="<?php print $kegiatan["spd_nip"]; ?>" />
											</div>
											<div class="form-group">
												<label>Jabatan Pejabat Tujuan Perjalanan Dinas</label>
												<input type="text" class="form-control" name="spd_jabatan" value="<?php print $kegiatan["spd_jabatan"]; ?>" />
											</div>
											<div class="form-group">
												<label>Nama Unit Kerja Pejabat Tujuan Perjalanan Dinas</label>
												<input type="text" class="form-control" name="spd_satker" value="<?php print $kegiatan["spd_satker"]; ?>" />
											</div>
										</div>
										<div class="col-md-6">
											<label>Link SPD Peserta</label>
											<div class="form-group">
												<?php
													if (!isset($kegiatan["link_spd_peserta"]) || (isset($kegiatan["link_spd_peserta"]) && empty($kegiatan["link_spd_peserta"]))) {
														$spdLink = base_url("/download/sppd_peserta/".$kegiatan["id"]);
													}
													else {
														$spdLink = $kegiatan["link_spd_peserta"];
													}
												?>
												<input type="text" class="form-control input-edit-spd-link" value="<?php print $spdLink; ?>" readonly /> <!--<button type="button" class="btn btn-info btn-edit-spd-link" title="Edit SPD Link"><i class="fas fa-edit"></i></button>--><br />
												<small>Link untuk download SPD apabila peserta perlu membawa SPD</small>
											</div>
											
											<div class="alert alert-info">
												<div><label>Informasi Data Kasubbag Umum BGP Provinsi Bali</label></div>
												<div class="form-group mb-1">
													<div>I Made Abdi Wismana, S.T., M.T</div>
												</div>
												<div class="form-group">
													<div>NIP 197705032001121003</div>
												</div>
												<div class="form-group mb-1">
													<div>Kasubbag Umum</div>
												</div>
												<div class="form-group mb-0">
													<div>Balai Guru Penggerak Provinsi Bali</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="sertifikat-peserta">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" style="width: 70%;">
												<label>Template Sertifikat Peserta</label>
												<select id="select-serticate" class="form-control" name="sertificate_peserta" data-selected-sertificate="<?php print $kegiatan["sertificate_peserta"]; ?>"></select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
							
						
						
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-top: 15px;">
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } else if ($url_2 == "panitia") { ?>
		<div id="keg-more-opt-panitia" class="collapse">
			<div class="keg-opt-form">
				<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
					<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
					<input type="hidden" name="form_show_bank_panitia" value="0" />
					<input type="hidden" name="form_show_confirm_paket_panitia" value="0" />
					<input type="hidden" name="form_ttd_panitia" value="0" />
					<input type="hidden" name="form_upload_surtug_panitia" value="0" />
					<input type="hidden" name="form_wajib_surtug_panitia" value="0" />
					
					<?php
						$bankPanitia = '';
						$paketPanitia = '';
						$ttdPanitia = '';
						$upSurtugPanitia = '';
						$surtugPanitia = '';

						if ($kegiatan["form_show_bank_panitia"]) {
							$bankPanitia = 'checked="checked"';
						}

						if ($kegiatan["form_show_confirm_paket_panitia"]) {
							$paketPanitia = 'checked="checked"';
						}

						if ($kegiatan["form_ttd_panitia"]) {
							$ttdPanitia = 'checked="checked"';
						}
										   
						if ($kegiatan["form_upload_surtug_panitia"]) {
							$upSurtugPanitia = 'checked="checked"';
						}
									
						if ($kegiatan["form_wajib_surtug_panitia"]) {
							$surtugPanitia = 'checked="checked"';
						}
					?>
					<div class="row">
						<div class="col-md-6">
							<label>Form Pendaftaran Panitia</label>
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_bank_panitia" id="checkbox-p-1" <?php print $bankPanitia; ?> value="1" />
									<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_confirm_paket_panitia" id="checkbox-p-2" <?php print $paketPanitia; ?> value="1" />
									<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_ttd_panitia" id="checkbox-p-x1" <?php print $ttdPanitia; ?> value="1" />
									<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
								</div>
							</div>
							
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_upload_surtug_panitia" id="checkbox-st-1" <?php print $upSurtugPanitia; ?> value="1" />
									<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_wajib_surtug_panitia" id="checkbox-st-2" <?php print $surtugPanitia; ?> value="1" />
									<label for="checkbox-st-2" class="cr">Panitia Wajib Upload Surat Tugas</label>
								</div>
							</div>
							
							<div class="form-group" style="width: 70%;">
								<label>Template Sertifikat Panitia</label>
								<select id="select-serticate" class="form-control" name="sertificate_panitia" data-selected-sertificate="<?php print $kegiatan["sertificate_panitia"]; ?>"></select>
							</div>
						</div>
						<div class="col-md-5">
							<label>Link WA Grup Panitia</label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
									</div>
									<input type="text" class="form-control" name="wa_grup_panitia" value="<?php print $kegiatan["wa_grup_panitia"]; ?>" />
								</div>
							</div>
							
							<label>Link Telegram Grup Panitia</label>
							<div class="form-group">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
									</div>
									<input type="text" class="form-control" name="tele_grup_panitia" value="<?php print $kegiatan["tele_grup_panitia"]; ?>" />
								</div>
								<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-top: 15px;">
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } else if ($url_2 == "narasumber") { ?>
		<div id="keg-more-opt-narasumber" class="collapse">
			<div class="keg-opt-form">
				<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
					<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
					<input type="hidden" name="form_show_bank_narasumber" value="0" />
					<input type="hidden" name="form_show_confirm_paket_narasumber" value="0" />
					<input type="hidden" name="form_ttd_narasumber" value="0" />
					<input type="hidden" name="form_upload_surtug_narasumber" value="0" />
					<input type="hidden" name="form_wajib_surtug_narasumber" value="0" />
					
					<?php
						$bankNarasumber = '';
						$paketNarasumber = '';
						$ttdNarasumber = '';
						$upSurtugNarasumber = '';
						$surtugNarasumber = '';

						if ($kegiatan["form_show_bank_narasumber"]) {
							$bankNarasumber = 'checked="checked"';
						}

						if ($kegiatan["form_show_confirm_paket_narasumber"]) {
							$paketNarasumber = 'checked="checked"';
						}

						if ($kegiatan["form_ttd_narasumber"]) {
							$ttdNarasumber = 'checked="checked"';
						}
											  
						if ($kegiatan["form_upload_surtug_narasumber"]) {
							$upSurtugNarasumber = 'checked="checked"';
						}
									
						if ($kegiatan["form_wajib_surtug_narasumber"]) {
							$surtugNarasumber = 'checked="checked"';
						}
					?>
					<div class="row">
						<div class="col-md-6">
							<label>Form Pendaftaran Narasumber</label>
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_bank_narasumber" id="checkbox-p-1" <?php print $bankNarasumber; ?> value="1" />
									<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_confirm_paket_narasumber" id="checkbox-p-2" <?php print $paketNarasumber; ?> value="1" />
									<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_ttd_narasumber" id="checkbox-p-x1" <?php print $ttdNarasumber; ?> value="1" />
									<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
								</div>
							</div>
							
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_upload_surtug_narasumber" id="checkbox-st-1" <?php print $upSurtugNarasumber; ?> value="1" />
									<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_wajib_surtug_narasumber" id="checkbox-st-2" <?php print $surtugNarasumber; ?> value="1" />
									<label for="checkbox-st-2" class="cr">Narasumber Wajib Upload Surat Tugas</label>
								</div>
							</div>
							
							
							<div class="form-group" style="width: 70%;">
								<label>Template Sertifikat Narasumber</label>
								<select id="select-serticate" class="form-control" data-selected-sertificate="<?php print $kegiatan["sertificate_narasumber"]; ?>" name="sertificate_narasumber"></select>
							</div>
							
						</div>
						<div class="col-md-5">
							<label>Link WA Grup Narasumber</label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
									</div>
									<input type="text" class="form-control" name="wa_grup_narasumber" value="<?php print $kegiatan["wa_grup_narasumber"]; ?>" />
								</div>
							</div>
							
							<label>Link Telegram Grup Narasumber</label>
							<div class="form-group">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
									</div>
									<input type="text" class="form-control" name="tele_grup_narasumber" value="<?php print $kegiatan["tele_grup_narasumber"]; ?>" />
								</div>
								<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-top: 15px;">
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } else if ($url_2 == "moderator") { ?>
		<div id="keg-more-opt-moderator" class="collapse">
			<div class="keg-opt-form">
				<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
					<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
					<input type="hidden" name="form_show_bank_moderator" value="0" />
					<input type="hidden" name="form_show_confirm_paket_moderator" value="0" />
					<input type="hidden" name="form_ttd_moderator" value="0" />
					<input type="hidden" name="form_upload_surtug_moderator" value="0" />
					<input type="hidden" name="form_wajib_surtug_moderator" value="0" />
					
					<?php
						$bankModerator = '';
						$paketModerator = '';
						$ttdModerator = '';
						$upSurtugModerator = '';
						$surtugModerator = '';

						if ($kegiatan["form_show_bank_moderator"]) {
							$bankModerator = 'checked="checked"';
						}

						if ($kegiatan["form_show_confirm_paket_moderator"]) {
							$paketModerator = 'checked="checked"';
						}

						if ($kegiatan["form_ttd_moderator"]) {
							$ttdModerator = 'checked="checked"';
						}
											  
						if ($kegiatan["form_upload_surtug_moderator"]) {
							$upSurtugModerator = 'checked="checked"';
						}
									
						if ($kegiatan["form_wajib_surtug_moderator"]) {
							$surtugModerator = 'checked="checked"';
						}
					?>
					<div class="row">
						<div class="col-md-6">
							<label>Form Pendaftaran Moderator</label>
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_bank_moderator" id="checkbox-p-1" <?php print $bankModerator; ?> value="1" />
									<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_confirm_paket_moderator" id="checkbox-p-2" <?php print $paketModerator; ?> value="1" />
									<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_ttd_moderator" id="checkbox-p-x1" <?php print $ttdModerator; ?> value="1" />
									<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
								</div>
							</div>
							
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_upload_surtug_moderator" id="checkbox-st-1" <?php print $upSurtugModerator; ?> value="1" />
									<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_wajib_surtug_moderator" id="checkbox-st-2" <?php print $surtugModerator; ?> value="1" />
									<label for="checkbox-st-2" class="cr">Moderator Wajib Upload Surat Tugas</label>
								</div>
							</div>
							
							
							<div class="form-group" style="width: 70%;">
								<label>Template Sertifikat Pelatih Ahli</label>
								<select id="select-serticate" class="form-control" data-selected-sertificate="<?php print $kegiatan["sertificate_moderator"]; ?>" name="sertificate_moderator"></select>
							</div>
							
						</div>
						<div class="col-md-5">
							<label>Link WA Grup Pelatih Ahli</label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
									</div>
									<input type="text" class="form-control" name="wa_grup_moderator" value="<?php print $kegiatan["wa_grup_moderator"]; ?>" />
								</div>
							</div>
							
							<label>Link Telegram Grup Pelatih Ahli</label>
							<div class="form-group">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
									</div>
									<input type="text" class="form-control" name="tele_grup_moderator" value="<?php print $kegiatan["tele_grup_moderator"]; ?>" />
								</div>
								<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-top: 15px;">
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } else if ($url_2 == "pengajar_praktek") { ?>
		<div id="keg-more-opt-pp" class="collapse">
			<div class="keg-opt-form">
				<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
					<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
					<input type="hidden" name="form_show_bank_pp" value="0" />
					<input type="hidden" name="form_show_confirm_paket_pp" value="0" />
					<input type="hidden" name="form_ttd_pp" value="0" />
					<input type="hidden" name="form_upload_surtug_pp" value="0" />
					<input type="hidden" name="form_wajib_surtug_pp" value="0" />
					
					<?php
						$bankPP = '';
						$paketPP = '';
						$ttdPP = '';
						$upSurtugPP = '';
						$surtugPP = '';

						if ($kegiatan["form_show_bank_pp"]) {
							$bankPP = 'checked="checked"';
						}

						if ($kegiatan["form_show_confirm_paket_pp"]) {
							$paketPP = 'checked="checked"';
						}

						if ($kegiatan["form_ttd_pp"]) {
							$ttdPP = 'checked="checked"';
						}
											  
						if ($kegiatan["form_upload_surtug_pp"]) {
							$upSurtugPP = 'checked="checked"';
						}
									
						if ($kegiatan["form_wajib_surtug_pp"]) {
							$surtugPP = 'checked="checked"';
						}
					?>
					<div class="row">
						<div class="col-md-6">
							<label>Form Pendaftaran Pengajar Praktek</label>
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_bank_pp" id="checkbox-p-1" <?php print $bankPP; ?> value="1" />
									<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_confirm_paket_pp" id="checkbox-p-2" <?php print $paketPP; ?> value="1" />
									<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_ttd_pp" id="checkbox-p-x1" <?php print $ttdPP; ?> value="1" />
									<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
								</div>
							</div>
							
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_upload_surtug_pp" id="checkbox-st-1" <?php print $upSurtugPP; ?> value="1" />
									<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_wajib_surtug_pp" id="checkbox-st-2" <?php print $surtugPP; ?> value="1" />
									<label for="checkbox-st-2" class="cr">Pengajar Praktek Wajib Upload Surat Tugas</label>
								</div>
							</div>
							
							
							<div class="form-group" style="width: 70%;">
								<label>Template Sertifikat Pengajar Praktek</label>
								<select id="select-serticate" class="form-control" data-selected-sertificate="<?php print $kegiatan["sertificate_pp"]; ?>" name="sertificate_pp"></select>
							</div>
							
						</div>
						<div class="col-md-5">
							<label>Link WA Grup Pengajar Praktek</label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
									</div>
									<input type="text" class="form-control" name="wa_grup_pp" value="<?php print $kegiatan["wa_grup_pp"]; ?>" />
								</div>
							</div>
							
							<label>Link Telegram Grup Pengajar Praktek</label>
							<div class="form-group">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
									</div>
									<input type="text" class="form-control" name="tele_grup_pp" value="<?php print $kegiatan["tele_grup_pp"]; ?>" />
								</div>
								<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-top: 15px;">
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } else if ($url_2 == "fasilitator") { ?>
		<div id="keg-more-opt-fasil" class="collapse">
			<div class="keg-opt-form">
				<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
					<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
					<input type="hidden" name="form_show_bank_fasil" value="0" />
					<input type="hidden" name="form_show_confirm_paket_fasil" value="0" />
					<input type="hidden" name="form_ttd_fasil" value="0" />
					<input type="hidden" name="form_upload_surtug_fasil" value="0" />
					<input type="hidden" name="form_wajib_surtug_fasil" value="0" />
					
					<?php
						$bankFasil = '';
						$paketFasil = '';
						$ttdFasil = '';
						$upSurtugFasil = '';
						$surtugFasil = '';

						if ($kegiatan["form_show_bank_fasil"]) {
							$bankFasil = 'checked="checked"';
						}

						if ($kegiatan["form_show_confirm_paket_fasil"]) {
							$paketFasil = 'checked="checked"';
						}

						if ($kegiatan["form_ttd_fasil"]) {
							$ttdFasil = 'checked="checked"';
						}
											  
						if ($kegiatan["form_upload_surtug_fasil"]) {
							$upSurtugFasil = 'checked="checked"';
						}
									
						if ($kegiatan["form_wajib_surtug_fasil"]) {
							$surtugFasil = 'checked="checked"';
						}
					?>
					<div class="row">
						<div class="col-md-6">
							<label>Form Pendaftaran Fasilitator</label>
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_bank_fasil" id="checkbox-p-1" <?php print $bankFasil; ?> value="1" />
									<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_confirm_paket_fasil" id="checkbox-p-2" <?php print $paketFasil; ?> value="1" />
									<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_ttd_fasil" id="checkbox-p-x1" <?php print $ttdFasil; ?> value="1" />
									<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
								</div>
							</div>
							
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_upload_surtug_fasil" id="checkbox-st-1" <?php print $upSurtugFasil; ?> value="1" />
									<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_wajib_surtug_fasil" id="checkbox-st-2" <?php print $surtugFasil; ?> value="1" />
									<label for="checkbox-st-2" class="cr">Fasilitator Wajib Upload Surat Tugas</label>
								</div>
							</div>
							
							
							<div class="form-group" style="width: 70%;">
								<label>Template Sertifikat Fasilitator</label>
								<select id="select-serticate" class="form-control" data-selected-sertificate="<?php print $kegiatan["sertificate_fasil"]; ?>" name="sertificate_fasil"></select>
							</div>
							
						</div>
						<div class="col-md-5">
							<label>Link WA Grup Fasilitator</label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
									</div>
									<input type="text" class="form-control" name="wa_grup_fasil" value="<?php print $kegiatan["wa_grup_fasil"]; ?>" />
								</div>
							</div>
							
							<label>Link Telegram Grup Fasilitator</label>
							<div class="form-group">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
									</div>
									<input type="text" class="form-control" name="tele_grup_fasil" value="<?php print $kegiatan["tele_grup_fasil"]; ?>" />
								</div>
								<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-top: 15px;">
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } else if ($url_2 == "instruktur") { ?>
		<div id="keg-more-opt-instruktur" class="collapse">
			<div class="keg-opt-form">
				<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
					<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
					<input type="hidden" name="form_show_bank_instruktur" value="0" />
					<input type="hidden" name="form_show_confirm_paket_instruktur" value="0" />
					<input type="hidden" name="form_ttd_instruktur" value="0" />
					<input type="hidden" name="form_upload_surtug_instruktur" value="0" />
					<input type="hidden" name="form_wajib_surtug_instruktur" value="0" />
					
					<?php
						$bankInstruktur = '';
						$paketInstruktur = '';
						$ttdInstruktur = '';
						$upSurtugInstruktur = '';
						$surtugInstruktur = '';

						if ($kegiatan["form_show_bank_instruktur"]) {
							$bankInstruktur = 'checked="checked"';
						}

						if ($kegiatan["form_show_confirm_paket_instruktur"]) {
							$paketInstruktur = 'checked="checked"';
						}

						if ($kegiatan["form_ttd_instruktur"]) {
							$ttdInstruktur = 'checked="checked"';
						}
											  
						if ($kegiatan["form_upload_surtug_instruktur"]) {
							$upSurtugInstruktur = 'checked="checked"';
						}
									
						if ($kegiatan["form_wajib_surtug_instruktur"]) {
							$surtugInstruktur = 'checked="checked"';
						}
					?>
					<div class="row">
						<div class="col-md-6">
							<label>Form Pendaftaran Instruktur</label>
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_bank_instruktur" id="checkbox-p-1" <?php print $bankInstruktur; ?> value="1" />
									<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_confirm_paket_instruktur" id="checkbox-p-2" <?php print $paketInstruktur; ?> value="1" />
									<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_ttd_instruktur" id="checkbox-p-x1" <?php print $ttdInstruktur; ?> value="1" />
									<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
								</div>
							</div>
							
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_upload_surtug_instruktur" id="checkbox-st-1" <?php print $upSurtugInstruktur; ?> value="1" />
									<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_wajib_surtug_instruktur" id="checkbox-st-2" <?php print $surtugInstruktur; ?> value="1" />
									<label for="checkbox-st-2" class="cr">Instruktur Wajib Upload Surat Tugas</label>
								</div>
							</div>
							
							
							<div class="form-group" style="width: 70%;">
								<label>Template Sertifikat Instruktur</label>
								<select id="select-serticate" class="form-control" data-selected-sertificate="<?php print $kegiatan["sertificate_instruktur"]; ?>" name="sertificate_instruktur"></select>
							</div>
							
						</div>
						<div class="col-md-5">
							<label>Link WA Grup Instruktur</label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
									</div>
									<input type="text" class="form-control" name="wa_grup_instruktur" value="<?php print $kegiatan["wa_grup_instruktur"]; ?>" />
								</div>
							</div>
							
							<label>Link Telegram Grup Instruktur</label>
							<div class="form-group">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
									</div>
									<input type="text" class="form-control" name="tele_grup_instruktur" value="<?php print $kegiatan["tele_grup_instruktur"]; ?>" />
								</div>
								<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-top: 15px;">
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } else if ($url_2 == "pengawas") { ?>
		<div id="keg-more-opt-pengawas" class="collapse">
			<div class="keg-opt-form">
				<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
					<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
					<input type="hidden" name="form_show_bank_pengawas" value="0" />
					<input type="hidden" name="form_show_confirm_paket_pengawas" value="0" />
					<input type="hidden" name="form_ttd_pengawas" value="0" />
					<input type="hidden" name="form_upload_surtug_pengawas" value="0" />
					<input type="hidden" name="form_wajib_surtug_pengawas" value="0" />
					
					<?php
						$bankPengawas = '';
						$paketPengawas = '';
						$ttdPengawas = '';
						$upSurtugPengawas = '';
						$surtugPengawas = '';

						if ($kegiatan["form_show_bank_pengawas"]) {
							$bankPengawas = 'checked="checked"';
						}

						if ($kegiatan["form_show_confirm_paket_pengawas"]) {
							$paketPengawas = 'checked="checked"';
						}

						if ($kegiatan["form_ttd_pengawas"]) {
							$ttdPengawas = 'checked="checked"';
						}
											  
						if ($kegiatan["form_upload_surtug_pengawas"]) {
							$upSurtugPengawas = 'checked="checked"';
						}
									
						if ($kegiatan["form_wajib_surtug_pengawas"]) {
							$surtugPengawas = 'checked="checked"';
						}
					?>
					<div class="row">
						<div class="col-md-6">
							<label>Form Pendaftaran Pengawas</label>
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_bank_pengawas" id="checkbox-p-1" <?php print $bankPengawas; ?> value="1" />
									<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_confirm_paket_pengawas" id="checkbox-p-2" <?php print $paketPengawas; ?> value="1" />
									<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_ttd_pengawas" id="checkbox-p-x1" <?php print $ttdPengawas; ?> value="1" />
									<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
								</div>
							</div>
							
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_upload_surtug_pengawas" id="checkbox-st-1" <?php print $upSurtugPengawas; ?> value="1" />
									<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_wajib_surtug_pengawas" id="checkbox-st-2" <?php print $surtugPengawas; ?> value="1" />
									<label for="checkbox-st-2" class="cr">Pengawas Wajib Upload Surat Tugas</label>
								</div>
							</div>
							
							
							<div class="form-group" style="width: 70%;">
								<label>Template Sertifikat Pengawas</label>
								<select id="select-serticate" class="form-control" data-selected-sertificate="<?php print $kegiatan["sertificate_pengawas"]; ?>" name="sertificate_pengawas"></select>
							</div>
							
						</div>
						<div class="col-md-5">
							<label>Link WA Grup Pengawas</label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
									</div>
									<input type="text" class="form-control" name="wa_grup_pengawas" value="<?php print $kegiatan["wa_grup_pengawas"]; ?>" />
								</div>
							</div>
							
							<label>Link Telegram Grup Pengawas</label>
							<div class="form-group">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
									</div>
									<input type="text" class="form-control" name="tele_grup_pengawas" value="<?php print $kegiatan["tele_grup_pengawas"]; ?>" />
								</div>
								<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-top: 15px;">
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } else if ($url_2 == "kepala_sekolah") { ?>
		<div id="keg-more-opt-kepala_sekolah" class="collapse">
			<div class="keg-opt-form">
				<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
					<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
					<input type="hidden" name="form_show_bank_kepala_sekolah" value="0" />
					<input type="hidden" name="form_show_confirm_paket_kepala_sekolah" value="0" />
					<input type="hidden" name="form_ttd_kepala_sekolah" value="0" />
					<input type="hidden" name="form_upload_surtug_kepala_sekolah" value="0" />
					<input type="hidden" name="form_wajib_surtug_kepala_sekolah" value="0" />
					
					<?php
						$bankKepalaSekolah = '';
						$paketKepalaSekolah = '';
						$ttdKepalaSekolah = '';
						$upSurtugKepalaSekolah = '';
						$surtugKepalaSekolah = '';

						if ($kegiatan["form_show_bank_kepala_sekolah"]) {
							$bankKepalaSekolah = 'checked="checked"';
						}

						if ($kegiatan["form_show_confirm_paket_kepala_sekolah"]) {
							$paketKepalaSekolah = 'checked="checked"';
						}

						if ($kegiatan["form_ttd_kepala_sekolah"]) {
							$ttdKepalaSekolah = 'checked="checked"';
						}
											  
						if ($kegiatan["form_upload_surtug_kepala_sekolah"]) {
							$upSurtugKepalaSekolah = 'checked="checked"';
						}
									
						if ($kegiatan["form_wajib_surtug_kepala_sekolah"]) {
							$surtugKepalaSekolah = 'checked="checked"';
						}
					?>
					<div class="row">
						<div class="col-md-6">
							<label>Form Pendaftaran Kepala Sekolah</label>
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_bank_kepala_sekolah" id="checkbox-p-1" <?php print $bankKepalaSekolah; ?> value="1" />
									<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_show_confirm_paket_kepala_sekolah" id="checkbox-p-2" <?php print $paketKepalaSekolah; ?> value="1" />
									<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_ttd_kepala_sekolah" id="checkbox-p-x1" <?php print $ttdKepalaSekolah; ?> value="1" />
									<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
								</div>
							</div>
							
							<div class="form-group">
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_upload_surtug_kepala_sekolah" id="checkbox-st-1" <?php print $upSurtugKepalaSekolah; ?> value="1" />
									<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
								</div>
								<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
									<input type="checkbox" name="form_wajib_surtug_kepala_sekolah" id="checkbox-st-2" <?php print $surtugKepalaSekolah; ?> value="1" />
									<label for="checkbox-st-2" class="cr">Kepala Sekolah Wajib Upload Surat Tugas</label>
								</div>
							</div>
							
							
							<div class="form-group" style="width: 70%;">
								<label>Template Sertifikat Kepala Sekolah</label>
								<select id="select-serticate" class="form-control" data-selected-sertificate="<?php print $kegiatan["sertificate_kepala_sekolah"]; ?>" name="sertificate_kepala_sekolah"></select>
							</div>
							
						</div>
						<div class="col-md-5">
							<label>Link WA Grup Kepala Sekolah</label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
									</div>
									<input type="text" class="form-control" name="wa_grup_kepala_sekolah" value="<?php print $kegiatan["wa_grup_kepala_sekolah"]; ?>" />
								</div>
							</div>
							
							<label>Link Telegram Grup Kepala Sekolah</label>
							<div class="form-group">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
									</div>
									<input type="text" class="form-control" name="tele_grup_kepala_sekolah" value="<?php print $kegiatan["tele_grup_kepala_sekolah"]; ?>" />
								</div>
								<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-top: 15px;">
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>
</div>
<div style="display: block;height: 15px;">&nbsp;</div>