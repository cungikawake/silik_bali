<style type="text/css">
	.spernyataan td { vertical-align:top; font-size:12px; font-family: 'tahoma'; padding: 2px 0; }
	.spernyataan .center { text-align:center; }
	.spernyataan .font16 { font-size:16px; }
	.spernyataan .bold { font-weight:bold; }
	.spernyataan .bordered { border-top:1px solid #000; border-left:1px solid #000; }
	.spernyataan .bordered td { border-bottom:1px solid #000; border-right:1px solid #000; padding:4px 6px;}
	.spernyataan .middle { vertical-align:middle; }
	.spernyataan .font4 { font-size:4px;}
	.spernyataan .justify { text-align:justify; }
	.spernyataan .right { text-align:right; }
	.spernyataan .bordered td.bb {border-bottom: 2px solid #000;}
	.spernyataan .bt {border-top: 1px solid #000;}
</style>
<table class="spernyataan" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td align="right" style="font-size:7px;"><?php print $item["no_urut"]; ?></td>
					</tr>
				</tbody>
			</table>
			<table width="100%" style="border-bottom: 3px solid #000; margin-bottom:25px;">
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

			<table width="100%" style="margin-bottom:15px;">
				<tr>
					<td class="center font16 bold">SURAT PERNYATAAN</td>
				</tr>
				<tr>
					<td class="center">(kebenaran atas bukti - bukti perjalanan dinas)</td>
				</tr>
			</table>

			<table width="100%" style="margin-bottom:15px;" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2">Yang bertanda tangan dibawah ini :</td>
				</tr>
				<tr>
					<td colspan="2" class="font4">&nbsp;</td>
				</tr>
				<tr>
					<td width="25%" style="padding-left:28px;padding-top:5px;">Nama</td>
					<td style="padding-top:5px;">: <?php print $spj_item["nama"]; ?></td>
				</tr>
				<tr>
					<td style="padding-left:28px;">NIP</td>
					<td>: <?php if (!empty($spj_item["nip"])) { print $spj_item["nip"]; } ?></td>
				</tr>
				<tr>
					<td style="padding-left:28px;">Jabatan</td>
					<td>: <?php print $spj_item["jabatan"]; ?> <?php print $spj_item["unit_kerja"]; ?></td>
				</tr>
				<tr>
					<td style="padding-left:28px;">Nomor Surat Tugas</td>
					<td>: <?php print $spj_item["nomor_surat"]; ?></td>
				</tr>
				<tr>
					<td style="padding-left:28px;">Tgl Surat Tugas</td>
					<td>: <?php print $this->utility->formatDateIndo($spj_item["tgl_surat"]); ?></td>
				</tr>
			</table>

			<table width="100%" style="margin-bottom:15px;" cellpadding="0" cellspacing="0">
				<tr>
					<td class="justify">
					Dengan ini menyatakan bahwa, dokumen/berkas-berkas pertanggungjawaban perjalanan dinas yang saya sampaikan sebagaimana terlampir adalah benar dan dapat dipertanggungjawabkan, apabila ada kelebihan pembayaran dan ada bukti-bukti tersebut tidak benar dan sah, maka saya bersedia untuk mengembalikan kelebihan ke kas negara dan dikenakan sanksi sesuai dengan ketentuan perundang-undangan yang berlaku.
					</td>
				</tr>
				<tr>
					<td class="justify">&nbsp;</td>
				</tr>
			</table>

			<table width="100%" cellpadding="1" cellspacing="0" style="margin-top:10px;">
				<tr>
					<td width="4%">&nbsp;</td>
					<td width="64%">&nbsp;</td>
					<td width="32%"><?php print $spj_item["kab_kuitansi"]; ?>, <?php print $this->utility->formatDateIndo($spj_item["tgl_kuitansi"]); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Pelaksana SPD,</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td style="color: #ddd;">materai</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				 <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?php print $spj_item["nama"]; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?php if(!empty($spj_item["nip"])) { print "NIP ".$spj_item["nip"]; } ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>