<style type="text/css">
	table { width: 100%; font-size: 12px; }
	table.bordered { border-left: 1px solid #fff; border-bottom: 1px solid #fff; width: 100%; }
	td { font-family:"Times New Roman"; color: #fff; }
	td { border-right: 1px solid #fff; border-top: 1px solid #fff; font-family:"Times New Roman" }
	.no-border {border: none; padding: 1px 0; }
	.ttd {padding: 42px 0; text-align: center; color: #fff; }
	.p7 {padding: 7px 12px; vertical-align: top;}
	.step {width: 20px; vertical-align: top; }
	.label {width: 110px; }
	.pt10 { padding-top: 10px; }
	table td.black { color: #000; }
</style>
<table cellpadding="0" cellspacing="0" class="bordered">
	<tr>
		<td width="50%" class="p7">&nbsp;</td>
		<td width="50%" class="p7">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="no-border step">I.</td>
					<td class="no-border label">Berangkat dari</td>
					<td class="no-border">: <?php print $pejabat_peserta["kab"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">Ke</td>
					<td class="no-border">: <?php print $kegiatan["kab_tempat_kegiatan"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">Pada tanggal</td>
					<td class="no-border">: <?php print $this->utility->formatDateIndo($kegiatan["tgl_mulai_kegiatan"]); ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border pt10" colspan="2"><?php print $pejabat_peserta["jabatan"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2"><?php print $pejabat_peserta["unit_kerja"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border ttd">V</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2"><?php print $pejabat_peserta["nama"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2">NIP <?php print $pejabat_peserta["nip"]; ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="50%" class="p7">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="no-border step">II.</td>
					<td class="no-border label">Tiba di</td>
					<td class="no-border">: <?php print $kegiatan["kab_tempat_kegiatan"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">Pada tanggal</td>
					<td class="no-border">: <?php print $this->utility->formatDateIndo($kegiatan["tgl_mulai_kegiatan"]); ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">&nbsp;</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border pt10 black" colspan="2"><?php print $pejabat_peserta["jabatan"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border black" colspan="2"><?php print $pejabat_peserta["unit_kerja"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">
						<?php
							if (isset($pejabat_peserta["id"]) && !empty($pejabat_peserta["id"])) {
								print '<img src="'.base_url('/assets/ttd/pejabat/'.$pejabat_peserta["id"].".png").'" style="height:96px;" />';
							}
						?>
					</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border black" colspan="2"><?php print $pejabat_peserta["nama"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border black" colspan="2">
						<?php
							if (!empty($pejabat_peserta["nip"])) {
								print "NIP ".$pejabat_peserta["nip"];
							}
						?>
					</td>
				</tr>
			</table>
		</td>
		<td width="50%" class="p7">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="no-border step">&nbsp;</td>
					<td class="no-border label">Berangkat dari</td>
					<td class="no-border">: <?php print $kegiatan["kab_tempat_kegiatan"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">Ke</td>
					<td class="no-border">: <?php print $pejabat_peserta["kab"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">Pada tanggal</td>
					<td class="no-border">: <?php print $this->utility->formatDateIndo($kegiatan["tgl_selesai_kegiatan"]); ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border black pt10" colspan="2"><?php print $pejabat_peserta["jabatan"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border black" colspan="2"><?php print $pejabat_peserta["unit_kerja"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">
						<?php
							if (isset($pejabat_peserta["id"]) && !empty($pejabat_peserta["id"])) {
								print '<img src="'.base_url('/assets/ttd/pejabat/'.$pejabat_peserta["id"].".png").'" style="height:96px;" />';
							}
						?>
					</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border black" colspan="2"><?php print $pejabat_peserta["nama"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border black" colspan="2">
						<?php
							if (!empty($pejabat_peserta["nip"])) {
								print "NIP ".$pejabat_peserta["nip"];
							}
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="50%" class="p7">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="no-border step">III.</td>
					<td class="no-border label">Tiba di</td>
					<td class="no-border">:</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">Pada tanggal</td>
					<td class="no-border">:</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">&nbsp;</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">&nbsp;</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border ttd">&nbsp;</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2">&nbsp;</td>
				</tr>
			</table>
		</td>
		<td width="50%" class="p7">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="no-border step">&nbsp;</td>
					<td class="no-border label">Berangkat dari</td>
					<td class="no-border">:</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">Ke</td>
					<td class="no-border">:</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">Pada tanggal</td>
					<td class="no-border">:</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">&nbsp;</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border ttd">&nbsp;</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="50%" class="p7">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="no-border step">IV.</td>
					<td class="no-border label">Tiba di</td>
					<td class="no-border">: <?php print $pejabat_peserta["kab"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">Pada tanggal</td>
					<td class="no-border">: <?php print $this->utility->formatDateIndo($kegiatan["tgl_selesai_kegiatan"]); ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">&nbsp;</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border">&nbsp;</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2" style="padding-top: 5px;"><?php print $pejabat_peserta["jabatan"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2"><?php print $pejabat_peserta["unit_kerja"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border ttd">V</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2"><?php print $pejabat_peserta["nama"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2">NIP <?php print $pejabat_peserta["nip"]; ?></td>
				</tr>
			</table>
		</td>
		<td width="50%" class="p7">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="no-border step">&nbsp;</td>
					<td class="no-border label" colspan="2">Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2" style="padding-top: 12px;">Pejabat Pembuat Komitmen</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2">Balai Guru Penggerak Provinsi Bali</td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border ttd">&nbsp;</td>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2"><?php print $ppk["nama"]; ?></td>
				</tr>
				<tr>
					<td class="no-border"></td>
					<td class="no-border" colspan="2">NIP <?php print $ppk["nip"]; ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="p7" colspan="2">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="no-border step">V.</td>
					<td class="no-border label">Catatan Lain-lain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="p7" colspan="2">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="no-border step">VI.</td>
					<td class="no-border label">PERHATIAN:<br />
PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan Keuangan Negara apabila negara menderita rugi akibat kesalahan, kelalaian dan kealpaannya.</td>
				</tr>
			</table>
		</td>
	</tr>
</table>