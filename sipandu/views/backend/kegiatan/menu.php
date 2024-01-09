<?php $url_2 = $this->uri->segment(4); ?>

<ul class="nav nav-pills nav-pills-perjadin nav-pills-keg" style="padding:15px 15px 5px;">
	<?php
		$showMoreOpt = false;
		$opt = "keg-more-opt-peserta";

		if (!empty($opsi_komponen)) {
			foreach ($opsi_komponen as $kom) {
				if (isset($kegiatan["komponen"][$kom->code]) && $kegiatan["komponen"][$kom->code] == "1") {
			?>
				<li class="nav-item">
					<a class="nav-link <?php if ($url_2 == $kom->code) { print "active"; } ?>" href="<?php print base_url("admin/item/".$kegiatan["id"]."/".$kom->code."/"); ?>"><?php print $kom->name; ?></a>
				</li>
			<?php
				}

				if ($url_2 == $kom->code) {
					$showMoreOpt = true;
					$opt = "keg-more-opt-".$kom->code;
				}
			}
		}
	?>

	<?php /*if ($this->utility->hasUserAccess("data_dukung_kegiatan","list")) { ?>
	<li class="nav-item">
		<a class="nav-link <?php if ($url_2 == "data_dukung") { print "active"; } ?>" href="<?php print base_url("admin/kegiatan/data_dukung/".$kegiatan["id"]."/"); ?>">Data Dukung</a>
	</li>
	<?php }*/ ?>
	
	<?php if ($showMoreOpt) { ?>
		<li class="nav-more-opt"><a data-toggle="collapse" href="#<?php print $opt; ?>" role="button" aria-expanded="true" aria-controls="<?php print $opt; ?>"><i class="fas fa-angle-down"></i></a></li>
	<?php } ?>
</ul>
<style type="text/css">
	.btn-edit-spd-link { padding: 6px 10px; margin: 0 0 4px; }
	.btn-edit-spd-link i { margin: 0; }
	.input-edit-spd-link { width: 85%; padding: 7px 12px; display: inline-block; cursor: pointer; }
</style>

<div class="keg-more-opt">
	<?php
		if (!empty($opsi_komponen)) {
			foreach ($opsi_komponen as $kom) {
				if ($url_2 == $kom->code) {
					
					$komKode = $kom->code;

					if ($komKode == "fasilitator") {
						$komKode = "fasil";
					}

					if ($komKode == "pengajar_praktek") {
						$komKode = "pp";
					}
				?>
					<div id="keg-more-opt-<?php print $kom->code; ?>" class="collapse">
						<div class="keg-opt-form">
							<form action="/admin/kegiatan/save_more_opt" method="post" class="form-submit" autocomplete="off">
								<input type="hidden" name="id" value="<?php print $kegiatan["id"]; ?>" />
								<input type="hidden" name="komponen" value="<?php print $kom->code; ?>" />
								<input type="hidden" name="base_url" value="<?php print base_url(); ?>" />
								<input type="hidden" name="option[form_show_bank]" value="0" />
								<input type="hidden" name="option[form_show_confirm_paket]" value="0" />
								<input type="hidden" name="option[form_ttd]" value="0" />
								<input type="hidden" name="option[form_upload_surtug]" value="0" />
								<input type="hidden" name="option[form_wajib_surtug]" value="0" />
								<?php
									$bank = '';
									$paket = '';
									$ttd = '';
									$upSurtug = '';
									$surtug = '';

									if (isset($kegiatan_options["form_show_bank"]) && $kegiatan_options["form_show_bank"] == 1) {
										$bank = 'checked="checked"';
									}

									if (isset($kegiatan_options["form_show_confirm_paket"]) && $kegiatan_options["form_show_confirm_paket"] == 1) {
										$paket = 'checked="checked"';
									}
									
									if (isset($kegiatan_options["form_ttd"]) && $kegiatan_options["form_ttd"] == 1) {
										$ttd = 'checked="checked"';
									}
									
									if (isset($kegiatan_options["form_upload_surtug"]) && $kegiatan_options["form_upload_surtug"] == 1) {
										$upSurtug = 'checked="checked"';
									}
									
									if (isset($kegiatan_options["form_wajib_surtug"]) && $kegiatan_options["form_wajib_surtug"] == 1) {
										$surtug = 'checked="checked"';
									}
								?>
								<div class="row">
									
									<div class="col-md-12">
										<ul class="nav nav-tabs" role="tablist">
											<li class="nav-item active">
												<a class="nav-link" href="#form-<?php print $kom->code;?>" data-toggle="tab">Form Pendaftaran</a>
											</li>
											
											<?php
												if ($kegiatan["tipe_kegiatan"] == "Daring") {
											?>
													<li class="nav-item">
														<a class="nav-link" href="#dh-<?php print $kom->code;?>" data-toggle="tab">Daftar Hadir</a>
													</li>
											<?php
												}
												else {
											?>
													<li class="nav-item">
														<a class="nav-link" href="#spd-<?php print $kom->code;?>" data-toggle="tab">Surat Perjalanan Dinas</a>
													</li>
											<?php
												}
											?>
											<li class="nav-item">
												<a class="nav-link" href="#sertifikat-<?php print $kom->code;?>" data-toggle="tab">Sertifikat</a>
											</li>
										</ul>
									</div>
									
									<div class="col-md-12">
										<div class="tab-content">
											<div class="tab-pane active" id="form-<?php print $komKode;?>">
												<div class="row">
													<div class="col-md-6">
														<label>Form Pendaftaran <?php print $kom->name;?></label>
														<div class="form-group">
															<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
																<input type="checkbox" name="option[form_show_bank]" id="checkbox-p-1" <?php print $bank; ?> value="1" />
																<label for="checkbox-p-1" class="cr">Tampilkan Form Akun Bank</label>
															</div>
															<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
																<input type="checkbox" name="option[form_show_confirm_paket]" id="checkbox-p-2" <?php print $paket; ?> value="1" />
																<label for="checkbox-p-2" class="cr">Tampilkan Form Konfirmasi Penerimaan Paket Data</label>
															</div>
															<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
																<input type="checkbox" name="option[form_ttd]" id="checkbox-p-x1" <?php print $ttd; ?> value="1" />
																<label for="checkbox-p-x1" class="cr">Tampilkan Form Tanda Tangan</label>
															</div>
														</div>
														<div class="form-group">
															<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
																<input type="checkbox" name="option[form_upload_surtug]" id="checkbox-st-1" <?php print $upSurtug; ?> value="1" />
																<label for="checkbox-st-1" class="cr">Tampilkan Form Upload Surat Tugas</label>
															</div>
															<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
																<input type="checkbox" name="option[form_wajib_surtug]" id="checkbox-st-2" <?php print $surtug; ?> value="1" />
																<label for="checkbox-st-2" class="cr">Peserta Wajib Upload Surat Tugas</label>
															</div>
														</div>
														<label>Pengkelasan</label>
														<div class="form-group">
															<?php
																$pengkelasan = "";
																if (isset($kegiatan_options["kategori"]) && !empty($kegiatan_options["kategori"])) {
																	$pengkelasan = $kegiatan_options["kategori"];
																}
															?>
															<textarea class="form-control" rows="4" name="option[kategori]"><?php print $pengkelasan; ?></textarea>
															<small>Kosongkan jika tidak ada pengkelasan; Enter untuk tiap nama kelas.</small>
														</div>
														
													</div>
													<div class="col-md-5">
														<label>Link WA Grup <?php print $kom->name;?></label>
														<div class="form-group">
															<div class="input-group input-group-sm">
																<div class="input-group-prepend">
																	<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #25d366; color: #fff;"><i class="fab fa-whatsapp"></i></span>
																</div>
																<?php
																	$waGrup = "";
																	if (isset($kegiatan_options["wa_grup"]) && !empty($kegiatan_options["wa_grup"])) {
																		$waGrup = $kegiatan_options["wa_grup"];
																	}
																?>
																<input type="text" class="form-control" name="option[wa_grup]" value="<?php print $waGrup; ?>" />
															</div>
														</div>

														<label>Link Telegram Grup <?php print $kom->name;?></label>
														<div class="form-group">
															<div class="input-group input-group-sm">
																<div class="input-group-prepend">
																	<span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #0088cc; color: #fff;"><i class="fab fa-telegram-plane"></i></span>
																</div>
																<?php
																	$teleGrup = "";
																	if (isset($kegiatan_options["tele_grup"]) && !empty($kegiatan_options["tele_grup"])) {
																		$teleGrup = $kegiatan_options["tele_grup"];
																	}
																?>
																<input type="text" class="form-control" name="option[tele_grup]" value="<?php print $teleGrup; ?>" />
															</div>
															<small>Link akan ditampilkan setelah pendaftaran berhasil</small>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="dh-<?php print $kom->code;?>">
												<div class="row">
													<div class="col-md-6">
														<?php
															if ($kegiatan["tipe_kegiatan"] == "Daring") {
																$start_date = new DateTime($kegiatan["tgl_mulai_kegiatan"]);
																$end_date = new DateTime($kegiatan["tgl_selesai_kegiatan"]);
																$end_date->setTime(0,0,1);

																// Step 2: Defining the Date Interval
																$interval = new DateInterval('P1D');

																// Step 3: Creating the Date Range
																$date_range = new DatePeriod($start_date, $interval, $end_date);
																
																$date_sign = array();
																foreach($date_range as $date) {
																	$dateFormated = $date->format('Y-m-d');
																	$date_sign[] = $dateFormated;
																}

																if (!empty($kegiatan["detail_tgl_kegiatan"])) {
																	$date_sign = $kegiatan["detail_tgl_kegiatan"];
																}

																foreach ($date_sign as $tglDetail) {
																	?>
																		<div class="form-group">
																			<label>Daftar Hadir (<?php print $this->utility->formatShortDateIndo($tglDetail); ?>)</label>
																			<input type="text" class="form-control" readonly value="<?php print base_url("daftar_hadir_".$kom->code."/".$kegiatan["id"]."/".strtotime($tglDetail)); ?>" />
																		</div>
																<?php
																}
															}
														?>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="spd-<?php print $kom->code;?>">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Nama Pejabat Tujuan Perjalanan Dinas</label>
															<?php
																$spdNama = "";
																if (isset($kegiatan_options["spd_nama"]) && !empty($kegiatan_options["spd_nama"])) {
																	$spdNama = $kegiatan_options["spd_nama"];
																}
															?>
															<input type="text" class="form-control" name="option[spd_nama]" value="<?php print $spdNama; ?>" />
														</div>
														<div class="form-group">
															<label>NIP Pejabat Tujuan Perjalanan Dinas</label>
															<?php
																$spdNip = "";
																if (isset($kegiatan_options["spd_nip"]) && !empty($kegiatan_options["spd_nip"])) {
																	$spdNip = $kegiatan_options["spd_nip"];
																}
															?>
															<input type="text" class="form-control" name="option[spd_nip]" value="<?php print $spdNip; ?>" />
														</div>
														<div class="form-group">
															<label>Jabatan Pejabat Tujuan Perjalanan Dinas</label>
															<?php
																$spdJabatan = "";
																if (isset($kegiatan_options["spd_jabatan"]) && !empty($kegiatan_options["spd_jabatan"])) {
																	$spdJabatan = $kegiatan_options["spd_jabatan"];
																}
															?>
															<input type="text" class="form-control" name="option[spd_jabatan]" value="<?php print $spdJabatan; ?>" />
														</div>
														<div class="form-group">
															<label>Nama Unit Kerja Pejabat Tujuan Perjalanan Dinas</label>
															<?php
																$spdSatker = "";
																if (isset($kegiatan_options["spd_satker"]) && !empty($kegiatan_options["spd_satker"])) {
																	$spdSatker = $kegiatan_options["spd_satker"];
																}
															?>
															<input type="text" class="form-control" name="option[spd_satker]" value="<?php print $spdSatker; ?>" />
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
											<div class="tab-pane" id="sertifikat-<?php print $kom->code;?>">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group" style="width: 70%;">
															<label>Template Sertifikat Peserta</label>
															<?php
																$sertifikat = "";
																if (isset($kegiatan_options["sertificate"]) && !empty($kegiatan_options["sertificate"])) {
																	$sertifikat = $kegiatan_options["sertificate"];
																}
															?>
															<select id="select-serticate" class="form-control" name="option[sertificate]" data-selected-sertificate="<?php print $sertifikat; ?>"></select>
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
				<?php
				}
			}
		}
	?>

	<?php /*if ($url_2 == "peserta") { ?>
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
												if ($kegiatan["tipe_kegiatan"] == "Daring") {
													$start_date = new DateTime($kegiatan["tgl_mulai_kegiatan"]);
													$end_date = new DateTime($kegiatan["tgl_selesai_kegiatan"]);
													$end_date->setTime(0,0,1);

													// Step 2: Defining the Date Interval
													$interval = new DateInterval('P1D');

													// Step 3: Creating the Date Range
													$date_range = new DatePeriod($start_date, $interval, $end_date);
													
													$date_sign = array();
													foreach($date_range as $date) {
														$dateFormated = $date->format('Y-m-d');
														$date_sign[] = $dateFormated;
													}

													if (!empty($kegiatan["detail_tgl_kegiatan"])) {
														$date_sign = $kegiatan["detail_tgl_kegiatan"];
													}

													foreach ($date_sign as $tglDetail) {
														?>
															<div class="form-group">
																<label>Daftar Hadir (<?php print $this->utility->formatShortDateIndo($tglDetail); ?>)</label>
																<input type="text" class="form-control" readonly value="<?php print base_url("daftar_hadir/peserta/".$kegiatan["id"]."/".strtotime($tglDetail)); ?>" />
															</div>
													<?php
													}
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
						<div class="col-md-12">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item active">
									<a class="nav-link" href="#form-panitia" data-toggle="tab">Form Pendaftaran</a>
								</li>
								
								<?php
									if ($kegiatan["tipe_kegiatan"] == "Daring") {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#dh-panitia" data-toggle="tab">Daftar Hadir</a>
										</li>
								<?php
									}
									else {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#spd-panitia" data-toggle="tab">Surat Perjalanan Dinas</a>
										</li>
								<?php
									}
								?>
								<li class="nav-item">
									<a class="nav-link" href="#sertifikat-panitia" data-toggle="tab">Sertifikat</a>
								</li>
							</ul>
						</div>
						
						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane active" id="form-panitia">
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
								</div>
								<div class="tab-pane" id="dh-panitia">
									<div class="row">
										<div class="col-md-6">
											<?php
												if ($kegiatan["tipe_kegiatan"] == "Daring") {
													$start_date = new DateTime($kegiatan["tgl_mulai_kegiatan"]);
													$end_date = new DateTime($kegiatan["tgl_selesai_kegiatan"]);
													$end_date->setTime(0,0,1);

													// Step 2: Defining the Date Interval
													$interval = new DateInterval('P1D');

													// Step 3: Creating the Date Range
													$date_range = new DatePeriod($start_date, $interval, $end_date);
													
													$date_sign = array();
													foreach($date_range as $date) {
														$dateFormated = $date->format('Y-m-d');
														$date_sign[] = $dateFormated;
													}

													if (!empty($kegiatan["detail_tgl_kegiatan"])) {
														$date_sign = $kegiatan["detail_tgl_kegiatan"];
													}

													foreach ($date_sign as $tglDetail) {
														?>
															<div class="form-group">
																<label>Daftar Hadir (<?php print $this->utility->formatShortDateIndo($tglDetail); ?>)</label>
																<input type="text" class="form-control" readonly value="<?php print base_url("kegiatan/daftar_hadir/panitia/".$kegiatan["id"]."/".strtotime($tglDetail)); ?>" />
															</div>
													<?php
													}
												}
											?>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="spd-panitia">
									<div class="row">
										SPD
									</div>
								</div>
								<div class="tab-pane" id="sertifikat-panitia">
									<div class="row">
										SERTIFIKAT
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
						<div class="col-md-12">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item active">
									<a class="nav-link" href="#form-narasumber" data-toggle="tab">Form Pendaftaran</a>
								</li>
								
								<?php
									if ($kegiatan["tipe_kegiatan"] == "Daring") {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#dh-narasumber" data-toggle="tab">Daftar Hadir</a>
										</li>
								<?php
									}
									else {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#spd-narasumber" data-toggle="tab">Surat Perjalanan Dinas</a>
										</li>
								<?php
									}
								?>
								<li class="nav-item">
									<a class="nav-link" href="#sertifikat-narasumber" data-toggle="tab">Sertifikat</a>
								</li>
							</ul>
						</div>

						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane active" id="form-narasumber">
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
								</div>
								<div class="tab-pane" id="dh-narasumber">
									<div class="row">
										DAFTAR HADIR
									</div>
								</div>
								<div class="tab-pane" id="spd-narasumber">
									<div class="row">
										SPD
									</div>
								</div>
								<div class="tab-pane" id="sertifikat-narasumber">
									<div class="row">
										SERTIFIKAT
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
						<div class="col-md-12">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item active">
									<a class="nav-link" href="#form-moderator" data-toggle="tab">Form Pendaftaran</a>
								</li>
								
								<?php
									if ($kegiatan["tipe_kegiatan"] == "Daring") {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#dh-moderator" data-toggle="tab">Daftar Hadir</a>
										</li>
								<?php
									}
									else {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#spd-moderator" data-toggle="tab">Surat Perjalanan Dinas</a>
										</li>
								<?php
									}
								?>
								<li class="nav-item">
									<a class="nav-link" href="#sertifikat-moderator" data-toggle="tab">Sertifikat</a>
								</li>
							</ul>
						</div>
						

						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane active" id="form-moderator">
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
								</div>
								<div class="tab-pane" id="dh-moderator">
									<div class="row">
										DAFTAR HADIR
									</div>
								</div>
								<div class="tab-pane" id="spd-moderator">
									<div class="row">
										SPD
									</div>
								</div>
								<div class="tab-pane" id="sertifikat-moderator">
									<div class="row">
										SERTIFIKAT
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
	<?php } else if ($url_2 == "pengajar_praktek") { ?>
		<div id="keg-more-opt-pengajar_praktek" class="collapse">
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
						<div class="col-md-12">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item active">
									<a class="nav-link" href="#form-pp" data-toggle="tab">Form Pendaftaran</a>
								</li>
								
								<?php
									if ($kegiatan["tipe_kegiatan"] == "Daring") {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#dh-pp" data-toggle="tab">Daftar Hadir</a>
										</li>
								<?php
									}
									else {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#spd-pp" data-toggle="tab">Surat Perjalanan Dinas</a>
										</li>
								<?php
									}
								?>
								<li class="nav-item">
									<a class="nav-link" href="#sertifikat-pp" data-toggle="tab">Sertifikat</a>
								</li>
							</ul>
						</div>
						

						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane active" id="form-pp">
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
								</div>
								<div class="tab-pane" id="dh-pp">
									<div class="row">
										DAFTAR HADIR
									</div>
								</div>
								<div class="tab-pane" id="spd-pp">
									<div class="row">
										SPD
									</div>
								</div>
								<div class="tab-pane" id="sertifikat-pp">
									<div class="row">
										SERTIFIKAT
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
	<?php } else if ($url_2 == "fasilitator") { ?>
		<div id="keg-more-opt-fasilitator" class="collapse">
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
						<div class="col-md-12">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item active">
									<a class="nav-link" href="#form-fasil" data-toggle="tab">Form Pendaftaran</a>
								</li>
								
								<?php
									if ($kegiatan["tipe_kegiatan"] == "Daring") {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#dh-fasil" data-toggle="tab">Daftar Hadir</a>
										</li>
								<?php
									}
									else {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#spd-fasil" data-toggle="tab">Surat Perjalanan Dinas</a>
										</li>
								<?php
									}
								?>
								<li class="nav-item">
									<a class="nav-link" href="#sertifikat-fasil" data-toggle="tab">Sertifikat</a>
								</li>
							</ul>
						</div>
						
						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane active" id="form-fasil">
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
								</div>
								<div class="tab-pane" id="dh-fasil">
									<div class="row">
										DAFTAR HADIR
									</div>
								</div>
								<div class="tab-pane" id="spd-fasil">
									<div class="row">
										SPD
									</div>
								</div>
								<div class="tab-pane" id="sertifikat-fasil">
									<div class="row">
										SERTIFIKAT
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
						<div class="col-md-12">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item active">
									<a class="nav-link" href="#form-instruktur" data-toggle="tab">Form Pendaftaran</a>
								</li>
								
								<?php
									if ($kegiatan["tipe_kegiatan"] == "Daring") {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#dh-instruktur" data-toggle="tab">Daftar Hadir</a>
										</li>
								<?php
									}
									else {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#spd-instruktur" data-toggle="tab">Surat Perjalanan Dinas</a>
										</li>
								<?php
									}
								?>
								<li class="nav-item">
									<a class="nav-link" href="#sertifikat-instruktur" data-toggle="tab">Sertifikat</a>
								</li>
							</ul>
						</div>
						

						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane active" id="form-instruktur">
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
								</div>
								<div class="tab-pane" id="dh-instruktur">
									<div class="row">
										DAFTAR HADIR
									</div>
								</div>
								<div class="tab-pane" id="spd-instruktur">
									<div class="row">
										SPD
									</div>
								</div>
								<div class="tab-pane" id="sertifikat-instruktur">
									<div class="row">
										SERTIFIKAT
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
						<div class="col-md-12">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item active">
									<a class="nav-link" href="#form-pengawas" data-toggle="tab">Form Pendaftaran</a>
								</li>
								
								<?php
									if ($kegiatan["tipe_kegiatan"] == "Daring") {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#dh-pengawas" data-toggle="tab">Daftar Hadir</a>
										</li>
								<?php
									}
									else {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#spd-pengawas" data-toggle="tab">Surat Perjalanan Dinas</a>
										</li>
								<?php
									}
								?>
								<li class="nav-item">
									<a class="nav-link" href="#sertifikat-pengawas" data-toggle="tab">Sertifikat</a>
								</li>
							</ul>
						</div>
						

						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane active" id="form-pengawas">
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
								</div>
								<div class="tab-pane" id="dh-pengawas">
									<div class="row">
										DAFTAR HADIR
									</div>
								</div>
								<div class="tab-pane" id="spd-pengawas">
									<div class="row">
										SPD
									</div>
								</div>
								<div class="tab-pane" id="sertifikat-pengawas">
									<div class="row">
										SERTIFIKAT
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
						<div class="col-md-12">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item active">
									<a class="nav-link" href="#form-kepsek" data-toggle="tab">Form Pendaftaran</a>
								</li>
								
								<?php
									if ($kegiatan["tipe_kegiatan"] == "Daring") {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#dh-kepsek" data-toggle="tab">Daftar Hadir</a>
										</li>
								<?php
									}
									else {
								?>
										<li class="nav-item">
											<a class="nav-link" href="#spd-kepsek" data-toggle="tab">Surat Perjalanan Dinas</a>
										</li>
								<?php
									}
								?>
								<li class="nav-item">
									<a class="nav-link" href="#sertifikat-kepsek" data-toggle="tab">Sertifikat</a>
								</li>
							</ul>
						</div>
						

						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane active" id="form-kepsek">
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
								</div>
								<div class="tab-pane" id="dh-kepsek">
									<div class="row">
										DAFTAR HADIR
									</div>
								</div>
								<div class="tab-pane" id="spd-kepsek">
									<div class="row">
										SPD
									</div>
								</div>
								<div class="tab-pane" id="sertifikat-kepsek">
									<div class="row">
										SERTIFIKAT
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
	<?php } */?>
</div>
<style type="text/css">
	.nav-pills-keg .nav-item {margin-bottom: 10px;}
</style>
<div style="display: block;height: 15px;">&nbsp;</div>