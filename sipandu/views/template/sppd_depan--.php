<style type="text/css">
	.sppd-depan td { vertical-align:top; font-size:13px; font-family: 'timesnewromanxx'; line-height: normal;}
	.sppd-depan .center { text-align:center; }
	.sppd-depan .font16 { font-size:16px; }
	.sppd-depan .bold { font-weight:bold; }
	.sppd-depan .bordered { border-top:1px solid #000; border-left:1px solid #000; }
	.sppd-depan .bordered td { border-bottom:1px solid #000; border-right:1px solid #000; padding:4px 6px;}
	.sppd-depan .middle { vertical-align:middle; }
	.sppd-depan .font4 { font-size:4px;}
</style>
<table class="sppd-depan" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td align="right" style="font-size:7px;"><?php print $item["no_urut"]; ?></td>
					</tr>
				</tbody>
			</table>
			<table width="100%" style="border-bottom: 3px solid #000; margin-bottom:10px;">
				<tbody>
					<tr>
						<td width="22%" style="text-align: center; vertical-align: middle; font-family: 'timesnewromanxx';">
							<img style="width:120px;" src="<?php print base_url("/assets/images/logo-kemdikbud-black.png"); ?>" />
						</td>
						<td width="78%" style="text-align: center; font-family: 'timesnewromanxx'; padding-bottom: 3px;">
							<div style="font-size: 20px;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</div>
							<div style="font-size: 20px;">RISET DAN TEKNOLOGI</div>
							<div style="font-size: 18px; font-weight: bold;"><?php print strtoupper($satker["upt"]); ?></div>
							<div style="font-size: 14px;"><?php print $satker["alamat"]; ?></div>
							<div style="font-size: 14px;">Telp. <?php print $satker["telepon"]; ?>, Laman: <?php print $satker["website"]; ?></div>
							<div style="font-size: 14px;">Pos-el. <?php print $satker["email"]; ?></div>
						</td>
					</tr>
				</tbody>
			</table>

			<table width="100%" style="margin-bottom:15px;" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td width="62%">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td>Kementerian Negara / Lembaga</td>
								</tr>
								<tr>
									<td>Pendidikan, Kebudayaan, Riset, Dan Teknologi</td>
								</tr>
							</table>
						</td>
						<td width="38%">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td width="26%">Lembar Ke</td>
									<td>: 1</td>
								</tr>
								<tr>
									<td width="26%">Kode No.</td>
									<td style="font-size: 12px;">: </td>
								</tr>
								<tr>
									<td width="26%">Nomor</td>
									<td>: <?php print $item["no_spd"]; ?></td>
								</tr>
							</table>
						</td>
					</tr>
				</tbody>
			</table>

			<table width="100%" style="margin-bottom:10px;">
				<tr>
					<td class="center font16 bold">SURAT PERJALANAN DINAS (SPD)</td>
				</tr>
			</table>

			<table width="100%" class="bordered" cellpadding="0" cellspacing="0">
				<tr>
					<td class="center middle" width="5%">1</td>
					<td class="middle" width="42%">Pejabat Pembuat Komitmen / NIP</td>
					<td>
						<div><?php print $item["nama_ppk"]; ?></div>
						<div>NIP <?php print $item["nip_ppk"]; ?></div>
					</td>
				</tr>
				<tr>
					<td class="center middle">2</td>
					<td class="middle">Nama / NIP Pegawai yang diberi perintah</td>
					<td>
						<div><?php print $item["nama"]; ?></div>
						<div>
							<?php
								if (!empty($item["nip"])) {
									print "NIP ".$item["nip"];
								}
								else {
									print "-";
								}
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td class="center">3</td>
					<td class="middle">
						<div>a. Pangkat dan golongan</div>
						<div>b. Jabatan / Instansi</div>
						<div>c. Tingkat biaya perjalanan dinas</div>
					</td>
					<td>
						<div>a. <?php print $item["pangkat"]; ?><?php if (!empty($item["golongan"])) { print ", ".$item["golongan"];} ?></div>
						<div>b. <?php print $item["jabatan"]." ".$item["unit_kerja"] ?></div>
						<div>c. C</div>
					</td>
				</tr>
				<tr>
					<td class="center">4</td>
					<td>Maksud perjalanan dinas</td>
					<td style="word-wrap:break-word;"><?php print $item["deskripsi_kuitansi"]." sesuai ".$item["jenis_surat"]." No. ".$item["nomor_surat"]." tgl ".$this->utility->formatDateIndo($item["tgl_surat"]); ?></td>
				</tr>
				<tr>
					<td class="center middle">5</td>
					<td class="middle">Alat angkut yang dipergunakan</td>
					<td><?php print ($item["provinsi_tujuan"] == $_ENV['DEFAULT_PROVINSI']) ? "Darat" : "Darat & udara" ?></td>
				</tr>
				<tr>
					<td class="center">6</td>
					<td class="middle">
						<div>a. Tempat berangkat</div>
						<div>b. Tempat tujuan</div>
					</td>
					<td>
						<div>a. <?php print $item["kab_asal"]; ?></div>
						<div>b. <?php print $item["kab_tujuan"]; ?></div>
					</td>
				</tr>
				<tr>
					<td class="center">7</td>
					<td class="middle">
						<div>a. Lamanya perjalanan dinas</div>
						<div>b. Tanggal berangkat</div>
						<div>c. Tanggal harus kembali/ tiba di tempat baru *)</div>
					</td>
					<?php
						$diff = $this->utility->lama_tugas($item["tgl_mulai_tugas"], $item["tgl_selesai_tugas"]);
					?>
					<td>
						<div>a. <?php print $diff; ?> hari</div>
						<div>b. <?php print $this->utility->formatDateIndo($item["tgl_mulai_tugas"]); ?></div>
						<div>c. <?php print $this->utility->formatDateIndo($item["tgl_selesai_tugas"]); ?></div>
					</td>
				</tr>
				<tr>
					<td class="center">8</td>
					<td class="middle">
						<div>Pengikut: &nbsp;&nbsp;&nbsp; Nama</div>
						<div>1. </div>
						<div>2. </div>
						<div>3. </div>
					</td>
					<td style="padding:0;">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td>Tanggal lahir</td>
								<td style="border-right:none;">Keterangan</td>
							</tr>
							<tr>
								<td style="border-bottom:none;">
									<div>&nbsp;</div>
									<div>&nbsp;</div>
									<div>&nbsp;</div>
								</td>
								<td style="border-right:none; border-bottom:none;">
									<div>&nbsp;</div>
									<div>&nbsp;</div>
									<div>&nbsp;</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="center">9</td>
					<td class="middle">
						<div>Pembebanan anggaran</div>
						<div>a. Instansi</div>
						<div>b. Mata anggaran</div>
					</td>
					<td>
						<div>&nbsp;</div>
						<div>a. <?php print $satker["upt"]; ?></div>
						<div>b. <?php print $item["dipa_mak"]; ?></div>
					</td>
				</tr>
				<tr>
					<td class="center">10</td>
					<td class="middle">Keterangan lain-lain</td>
					<td>&nbsp;</td>
				</tr>
			</table>

			<table width="100%" cellpadding="0" cellspacing="0" style="margin-top:4px;">
				<tr>
					<td class="center middle" width="5%">&nbsp;</td>
					<td class="middle" width="40%">*) coret yang tidak perlu</td>
					<td>&nbsp;</td>
				</tr>
			</table>

			<table width="100%" cellpadding="1" cellspacing="0" style="margin-top:10px;">
				<tr>
					<td width="71%">&nbsp;</td>
					<td>Dikeluarkan di : Denpasar</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Tanggal : <?php print $this->utility->formatDateIndo($item["tgl_surat"]); ?></td>
				</tr>
				<tr>
					<td rowspan="7">
						<?php
							if (isset($validasi)) {
								print '<img class="qr-code" src="'.$validasi["spd_depan"].'" />';
							}
							else {
								print '&nbsp;';
							}
						?>
					</td>
					<td>Pejabat Pembuat Komitmen</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?php print $item["nama_ppk"]; ?></td>
				</tr>
				<tr>
					<td>NIP <?php print $item["nip_ppk"]; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>