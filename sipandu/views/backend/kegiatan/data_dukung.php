<?php $this->load->view("backend/includes/header"); ?>
<?php $this->load->view("backend/kegiatan/header"); ?>
<?php $this->load->view("backend/kegiatan/menu"); ?>

<?php
	$dakungs = array(
		"Surat Keputusan" => "Surat Keputusan",
		"Prosedur Operasional" => "Prosedur Operasional",
		"Surat Undangan" => "Surat Undangan",
		"Surat Tugas" => "Surat Tugas",
		"Notula" => "Notula, Materi, Daftar Hadir Dll",
		"Laporan" => "Laporan",
		"Bukti Pembayaran" => "Bukti Pembayaran & Pajak",
	);
?>

<div class="main-body">
	<div class="page-wrapper">
		<!-- [ Main Content ] start -->
		<?php
			$syncDrive = false;

			if (isset($_SESSION["user"]["sync_drive"]) && !empty($_SESSION["user"]["sync_drive"])) {
				$syncDrive = true;
			}
			
			if (!$syncDrive) {
		?>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-danger mb-5" role="alert">
							<h5 class="alert-heading"><i class="feather icon-alert-octagon me-2"></i>
						Hubungkan Google Drive</h5>
							<p class="mb-2">Untuk mengunggah file, anda harus menghubungkan akun anda dengan Google Drive.</p>
							<a class="btn btn-sm btn-danger" href="<?php print base_url("/admin/user/sync_drive"); ?>">Hubungkan sekarang</a>
						</div>
					</div>
				</div>
		<?php
			}
		?>
		
		<div class="row">
			<?php	
				$i = 1;
				foreach ($dakungs as $dakungKey => $dakungVal) {
			?>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h5><?php print $dakungVal; ?> <i class="fas fa-circle dakung-alert-circle text-c-red f-10 m-r-15"></i></h5>

								<?php if ($this->utility->hasUserAccess("data_dukung_kegiatan","add") && $syncDrive) { ?>
								<div class="card-header-right" style="top:16px;right:24px;">
									<a href="javascript:;" class="bootgrid-add-btn btn btn-info add-dakung" data-kegiatan="<?php print $kegiatan["id"]; ?>" data-section="<?php print $dakungKey; ?>">Tambah</a>
								</div>
								<?php } ?>
							</div>
							<div class="card-block pb-0">
								<div class="table-responsive wrap-dakung" data-kegiatan="<?php print $kegiatan["id"]; ?>" data-section="<?php print $dakungKey; ?>">

								</div>
							</div>
						</div>
					</div>
			<?php
					if ($i%2 == 0) {
						print '</div><div class="row">';
					}

					$i++;
				}
			?>
		</div>
		<!-- [ Main Content ] end -->
	</div>
</div>
<div id="modal-perjadin-nomnatif"></div>

<?php $this->load->view("backend/includes/footer"); ?>
