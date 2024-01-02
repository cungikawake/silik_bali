<?php $this->load->view("backend/includes/header"); ?>
	<!-- [ breadcrumb ] start -->
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h5 class="m-b-20"><i class="feather icon-map"></i> Laporan Penugasan</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ breadcrumb ] end -->

	<div class="main-body">
		<div class="page-wrapper">
			<!-- [ Main Content ] start -->
			<div class="row">
				<div class="col-md-12">										
					<div class="card" style="margin-bottom: 20px;">
						<div class="card-header">
							<h5 class="bootgrid-title">Laporan Penugasan</h5>
						</div>
						<div class="card-body">
							<div class="wrap-table-bootgrid">
								<table id="grid-penugasan-list" class="table table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th data-column-id="id" data-type="numeric" width="3%">No</th>
											<th data-column-id="nama" width="25%">Nama Petugas</th>
											<th data-column-id="tugas">Tugas</th>
											<th data-column-id="hari">Hari</th>
											<th data-column-id="tiket" data-type="currency">Tiket</th>
											<th data-column-id="penginapan" data-type="currency">Penginapan</th>
											<th data-column-id="transport" data-type="currency">Transport</th>
											<th data-column-id="uang_harian" data-type="currency">Uang Harian</th>
											<th data-column-id="transport_uang_harian" data-type="currency">Trans + Uang Harian</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<?php
											if (!empty($laporan)) {
												$i = 1;
												
												foreach ($laporan as $lap) {
													$pesawat = $lap["sum_pesawat_berangkat"] + $lap["sum_pesawat_pulang"];
													$transport = $lap["sum_transport"] + $lap["sum_taksi_berangkat"] + $lap["sum_taksi_pulang"] + $lap["sum_transport_lainnya"];
										?>
												<tr>
													<td width="3%"><?php print $i; ?></td>
													<td width="25%"><?php print $lap["nama"]; ?></td>
													<td>Tugas</td>
													<td>Hari</td>
													<td><?php print $pesawat; ?></td>
													<td><?php print $lap["sum_penginapan"]; ?></td>
													<td><?php print $transport; ?></td>
													<td><?php print $lap["sum_uang_harian"]; ?></td>
													<td><?php print ($transport + $lap["sum_uang_harian"]); ?></td>
													<td>&nbsp;</td>
												</tr>
										<?php
													$i++;
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- [ Main Content ] end -->
		</div>
	</div>
<?php $this->load->view("backend/includes/footer"); ?>
<script src="<?php print base_url('assets/js/laporan.js?v='.rand()); ?>"></script>
