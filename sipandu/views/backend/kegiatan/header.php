<!-- [ breadcrumb ] start -->
<div class="page-header">
	<div class="page-block">
		<div class="row align-items-center">
			<div class="col-md-12">
				<div class="page-header-title">
					<h4 class=""><?php print $kegiatan["nama"]; ?></h5>
					<p class="m-b-10">Tanggal Kegiatan: 
						<?php
							if (!empty($kegiatan["detail_tgl_kegiatan"])) {
								print $this->utility->formatDetailDate($kegiatan["detail_tgl_kegiatan"]);
							}
							else {
								print $this->utility->formatRangeDate($kegiatan["tgl_mulai_kegiatan"], $kegiatan["tgl_selesai_kegiatan"]);
							}
						 ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ breadcrumb ] end -->