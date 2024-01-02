<?php
	$nama = "";
	$groups = array();
	$items = array();
	
	if (!empty($sertifikats["instruktur"])) {
		foreach ($sertifikats["instruktur"] as $sertifikat) {
			$sertifikat["jabatan_kegiatan"] = "Instruktur";
			
			$sortBy = strtotime($kegiatan[$sertifikat["kegiatan_id"]]["tgl_selesai_kegiatan"]);
			
			if (!isset($items[$sortBy])) {
				$items[$sortBy] = array();
			}
			
			$items[$sortBy][] = $sertifikat;
			
			$nama = $sertifikat["nama"];
		}
	}

	if (!empty($sertifikats["fasilitator"])) {
		foreach ($sertifikats["fasilitator"] as $sertifikat) {
			$sertifikat["jabatan_kegiatan"] = "Fasilitator";
			
			$sortBy = strtotime($kegiatan[$sertifikat["kegiatan_id"]]["tgl_selesai_kegiatan"]);
			
			if (!isset($items[$sortBy])) {
				$items[$sortBy] = array();
			}
			
			$items[$sortBy][] = $sertifikat;
			
			$nama = $sertifikat["nama"];
		}
	}

	if (!empty($sertifikats["pengajar_praktek"])) {
		foreach ($sertifikats["pengajar_praktek"] as $sertifikat) {
			$sertifikat["jabatan_kegiatan"] = "Pengajar Praktek";
			
			$sortBy = strtotime($kegiatan[$sertifikat["kegiatan_id"]]["tgl_selesai_kegiatan"]);
			
			if (!isset($items[$sortBy])) {
				$items[$sortBy] = array();
			}
			
			$items[$sortBy][] = $sertifikat;
			
			$nama = $sertifikat["nama"];
		}
	}

	if (!empty($sertifikats["narasumber"])) {
		foreach ($sertifikats["narasumber"] as $sertifikat) {
			$sertifikat["jabatan_kegiatan"] = "Narasumber";
			
			$sortBy = strtotime($kegiatan[$sertifikat["kegiatan_id"]]["tgl_selesai_kegiatan"]);
			
			if (!isset($items[$sortBy])) {
				$items[$sortBy] = array();
			}
			
			$items[$sortBy][] = $sertifikat;
			
			$nama = $sertifikat["nama"];
		}
	}

	if (!empty($sertifikats["moderator"])) {
		foreach ($sertifikats["moderator"] as $sertifikat) {
			$sertifikat["jabatan_kegiatan"] = "Moderator";
			
			$sortBy = strtotime($kegiatan[$sertifikat["kegiatan_id"]]["tgl_selesai_kegiatan"]);
			
			if (!isset($items[$sortBy])) {
				$items[$sortBy] = array();
			}
			
			$items[$sortBy][] = $sertifikat;
			
			$nama = $sertifikat["nama"];
		}
	}

	if (!empty($sertifikats["panitia"])) {
		foreach ($sertifikats["panitia"] as $sertifikat) {
			$sertifikat["jabatan_kegiatan"] = "Panitia";
			
			$sortBy = strtotime($kegiatan[$sertifikat["kegiatan_id"]]["tgl_selesai_kegiatan"]);
			
			if (!isset($items[$sortBy])) {
				$items[$sortBy] = array();
			}
			
			$items[$sortBy][] = $sertifikat;
			
			$nama = $sertifikat["nama"];
		}
	}

	if (!empty($sertifikats["peserta"])) {
		foreach ($sertifikats["peserta"] as $sertifikat) {
			$sertifikat["jabatan_kegiatan"] = "Peserta";
			
			$sortBy = strtotime($kegiatan[$sertifikat["kegiatan_id"]]["tgl_selesai_kegiatan"]);
			
			if (!isset($items[$sortBy])) {
				$items[$sortBy] = array();
			}
			
			$items[$sortBy][] = $sertifikat;
			
			$nama = $sertifikat["nama"];
		}
	}

	if (!empty($items)) {
		krsort($items);
		
		foreach ($items as $dateKeg => $itemSertifikats) {
			foreach ($itemSertifikats as $item) {
				$groups[] = $item;
			}
		}
	}
?>

<div class="table-result">
	<div style="text-align: center; font-size: 20px; margin-bottom: 15px;">Sertifikat <strong style="font-weight: bold;"><?php print $nama; ?></strong></div>
	<div class="wrap-table-bootgrid">
		<table class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Sebagai</th>
					<th>Kegiatan</th>
					<th>Tipe Keg.</th>
					<th>Tempat Keg.</th>
					<th>Tgl Keg.</th>
					<th style="text-align: center;">Sertifikat</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no = 1;
					foreach ($groups as $sertifikat) {
						$namaKeg = $kegiatan[$sertifikat["kegiatan_id"]]["nama"];
						
						if (strlen($namaKeg) > 60) {
							$namaView = substr($namaKeg,0,60)."...";
						}
						else {
							$namaView = $namaKeg;
						}
				?>
						<tr>
							<td><?php print $no; ?></td>
							<td><?php print $sertifikat["jabatan_kegiatan"]; ?></td>
							<td><span title='<?php print htmlspecialchars($namaKeg); ?>'><?php print $namaView; ?></span></td>
							<td><?php print $kegiatan[$sertifikat["kegiatan_id"]]["tipe_kegiatan"]; ?></td>
							<td>
								<?php
									if ($kegiatan[$sertifikat["kegiatan_id"]]["tipe_kegiatan"] == "Luring") {
										print $kegiatan[$sertifikat["kegiatan_id"]]["tempat_kegiatan"];
									}
									else {
										print "Zoom";
									}
								?>
							</td>
							<td><?php print $this->utility->formatRangeDate($kegiatan[$sertifikat["kegiatan_id"]]["tgl_mulai_kegiatan"], $kegiatan[$sertifikat["kegiatan_id"]]["tgl_selesai_kegiatan"]); ?></td>
							<td style="text-align: center;">
								<?php
									$download = 0;
						
									if ($sertifikat["jabatan_kegiatan"] == "Peserta" && !empty($kegiatan[$sertifikat["kegiatan_id"]]["sertificate_peserta"])) {
										$download = 1;
									}
									else if ($sertifikat["jabatan_kegiatan"] == "Panitia" && !empty($kegiatan[$sertifikat["kegiatan_id"]]["sertificate_panitia"])) {
										$download = 1;
									}
									else if ($sertifikat["jabatan_kegiatan"] == "Narasumber" && !empty($kegiatan[$sertifikat["kegiatan_id"]]["sertificate_narasumber"])) {
										$download = 1;
									}
									else if ($sertifikat["jabatan_kegiatan"] == "Fasilitator" && !empty($kegiatan[$sertifikat["kegiatan_id"]]["sertificate_fasil"])) {
										$download = 1;
									}
									else if ($sertifikat["jabatan_kegiatan"] == "Instruktur" && !empty($kegiatan[$sertifikat["kegiatan_id"]]["sertificate_instruktur"])) {
										$download = 1;
									}
									else if ($sertifikat["jabatan_kegiatan"] == "Pengajar Praktek" && !empty($kegiatan[$sertifikat["kegiatan_id"]]["sertificate_pp"])) {
										$download = 1;
									}
									else if ($sertifikat["jabatan_kegiatan"] == "Moderator" && !empty($kegiatan[$sertifikat["kegiatan_id"]]["sertificate_moderator"])) {
										$download = 1;
									}
						
									if ($download) {
								?>
										<a href="<?php print base_url("/download/sertifikat/".$sertifikat["kode"]); ?>" class="btn btn-info" target="_blank">Download</a></td>
								<?php
									}
									else {
										print "-";
									}
								?>
								
						</tr>
				<?php
						$no++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>