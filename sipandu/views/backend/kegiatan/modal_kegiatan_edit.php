<?php
	$this->load->model("biodata_model");
	$pegawaiBalai = $this->biodata_model->getBiodataByPegawaiBalai();
?>
<style type="text/css">
	.detail-tgl-kegiatan, .add-detail-tgl-kegiatan {
		display: inline-block;
		margin: 5px 0 0;
	}
	.form-detail-tgl-kegiatan + .form-detail-tgl-kegiatan {
		margin-top: 10px;
	}
	.input-group>:not(:first-child) {
		margin-left: -1px;
		border-top-left-radius: 0;
		border-bottom-left-radius: 0;
	}
	.input-group.form-detail-tgl-kegiatan .input-group-text {
		padding: 0;
		display: block;
	}
	.input-group.form-detail-tgl-kegiatan .del-detail-tgl-kegiatan {
		display: block;
		padding: 9px 15px;
	}
	.input-group.form-detail-tgl-kegiatan .del-detail-tgl-kegiatan i {
		font-size: 16px;
	}
</style>
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h5 class="modal-title">KEGIATAN</h5>
		</div>
		<form action="/admin/kegiatan/save" method="post" class="form-submit" autocomplete="off">
			<input type="hidden" name="id" required class="form-control" value="<?php print isset($id) ? $id : ""; ?>" />
			<div class="modal-body">
				<div class="form-group">
					<label>Nama Kegiatan</label>
					<input type="text" name="nama" required class="form-control" value="<?php print isset($nama) ? htmlspecialchars($nama) : ""; ?>" />
				</div>
				<div class="form-group">
					<label>Tipe Kegiatan</label>
					<select name="tipe_kegiatan" class="form-control select2">
						<?php
							$options = array("Daring","Luring");
							$valSelected = isset($tipe_kegiatan) ? $tipe_kegiatan : "";

							foreach ($options as $tipe) {
								$selected = '';

								if ($valSelected == $tipe) {
									$selected = 'selected="selected"';
								}

								print '<option value="'.$tipe.'" '.$selected.'>'.$tipe.'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<?php
						$hideDefaultTgl = "";
						$hideDetailTgl = "hide";
					
						if (isset($detail_tgl_kegiatan) && !empty($detail_tgl_kegiatan)) {
							$hideDefaultTgl = "hide";
							$hideDetailTgl = "";
						}
					?>
					<div class="row row-default-tgl-kegiatan <?php print $hideDefaultTgl; ?>">
						<div class="col-md-6">
							<label>Tgl Mulai Kegiatan</label>
							<input type="text" name="tgl_mulai_kegiatan" required class="form-control datepicker" value="<?php print isset($tgl_mulai_kegiatan) ? date("d/m/Y", strtotime($tgl_mulai_kegiatan)) : ""; ?>" />
						</div>
						<div class="col-md-6">
							<label>Tgl Selesai Kegiatan</label>
							<input type="text" name="tgl_selesai_kegiatan" required class="form-control datepicker" value="<?php print isset($tgl_selesai_kegiatan) ? date("d/m/Y", strtotime($tgl_selesai_kegiatan)) : ""; ?>" />
						</div>
					</div>
					
					<div class="row row-detail-tgl-kegiatan <?php print $hideDetailTgl; ?>">
						<div class="col-md-6 group-detail-tgl-kegiatan">
							<label>Tgl Kegiatan</label>
							<?php
								$tglDetail = array("");
						
								if (isset($detail_tgl_kegiatan) && !empty($detail_tgl_kegiatan)) {
									$tglDetail = $detail_tgl_kegiatan;
					
									foreach ($tglDetail as $keyTglku => $tglDet) {
										$tglKu = "";

										if (!empty($tglDet)) {
											$tglKu = date("d/m/Y", strtotime($tglDet));
										}
							?>
										<div class="input-group form-detail-tgl-kegiatan">
											<input type="text" name="detail_tgl_kegiatan[]" required class="form-control datepicker input-detail-tgl-kegiatan" value="<?php print $tglKu; ?>" />
											<span class="input-group-text"><a href="javascript:;" title="Hapus Tgl Kegiatan" class="del-detail-tgl-kegiatan"><i class="fas fa-trash-alt"></i></a></span>
										</div>
							<?php
									}
								}
							?>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<small>
								<a href="javascript:;" class="detail-tgl-kegiatan <?php print $hideDefaultTgl; ?>">Detailkan Tanggal Kegiatan</a>
								<a href="javascript:;" class="add-detail-tgl-kegiatan <?php print $hideDetailTgl; ?>">Tambah Tanggal Kegiatan</a>
							</small>
						</div>
					</div>
				</div>
				
				<?php
					$daringForm = "";
					$luringForm = "";
				
					if(isset($tipe_kegiatan) && $tipe_kegiatan == "Luring") {
						$daringForm = "display:none;";
					}
					else {
						$luringForm = "display:none;";
					}
				?>
				
				<div class="form-group luring-form" style="<?php print $luringForm; ?>">
					<label>Tempat</label>
					<input type="text" name="tempat_kegiatan" class="form-control" value="<?php print isset($tempat_kegiatan) ? $tempat_kegiatan : ""; ?>" />
				</div>
				<div class="form-group luring-form" style="<?php print $luringForm; ?>">
					<label>Tempat (Kabupaten)</label>
					<select name="kab_tempat_kegiatan" class="form-control select2">
						<option value="">&nbsp;</option>
						<?php
							foreach ($this->config->item("transport_area") as $areaId => $areaName) {
								$selected = "";

								if (isset($kab_tempat_kegiatan) && $areaId == $kab_tempat_kegiatan) {
									$selected = 'selected="selected"';
								}

								print '<option value="'.$areaId.'" '.$selected.'>'.$areaName.'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group daring-form" style="<?php print $daringForm; ?>">
					<div class="row">
						<div class="col-md-6">
							<label>Meeting ID</label>
							<input type="text" name="zoom_id_kegiatan" class="form-control" value="<?php print isset($zoom_id_kegiatan) ? $zoom_id_kegiatan : ""; ?>" />
						</div>
						<div class="col-md-6">
							<label>Meeting Passcode</label>
							<input type="text" name="zoom_code_kegiatan" class="form-control" value="<?php print isset($zoom_code_kegiatan) ? $zoom_code_kegiatan : ""; ?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<?php
						$kom = array(
							"peserta" => 1,
							"narasumber" => 1,
							"moderator" => 1,
							"panitia" => 1
						);
					
						if (isset($komponen) && !empty($komponen)) {
							$kom = json_decode($komponen, true);
						}
					?>
					<label>Komponen Yang Terlibat Pada Kegiatan</label>
					<div style="border: 1px solid #ccc; border-radius:4px; padding: 5px 10px 8px; background: #f4f7fa;">
						<div class="row">
							<?php
								if (isset($opsi_komponen) && !empty($opsi_komponen)) {
									foreach ($opsi_komponen as $opsi) {
							?>
									<div class="col-md-4">
										<div class="checkbox checkbox-primary d-inline" style="padding: 0; margin: 5px 0 0;">
											<input type="hidden" name="komponen[<?php print $opsi->code; ?>]" value="0" />
											<input type="checkbox" name="komponen[<?php print $opsi->code; ?>]" id="komp-check-<?php print $opsi->code; ?>" value="1" <?php print isset($kom[$opsi->code]) && $kom[$opsi->code] == "1" ? 'checked="checked"' : ""; ?> />
											<label for="komp-check-<?php print $opsi->code; ?>" class="cr"><?php print $opsi->name; ?></label>
										</div>
									</div>
							<?php
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-modal-form-submit">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			</div>
		</form>
	</div>
</div>

<div class="master-detail-tgl-kegiatan hide">
	<div class="input-group form-detail-tgl-kegiatan">
		<input type="text" name="detail_tgl_kegiatan[]" required class="form-control datepicker input-detail-tgl-kegiatan" value="" />
		<span class="input-group-text"><a href="javascript:;" title="Hapus Tgl Kegiatan" class="del-detail-tgl-kegiatan"><i class="fas fa-trash-alt"></i></a></span>
	</div>
</div>

<script type="text/javascript">
	$('[name="tipe_kegiatan"]').on('select2:select', function (e) {
		var data = e.params.data;
		var val = data.text;

		$('.daring-form').hide();
		$('.luring-form').hide();

		if (val == "Daring") {
			$('.daring-form').show();
			$('[name="kab_tempat_kegiatan"]').removeAttr("required");
		}
		else {
			$('.luring-form').show();
			$('[name="kab_tempat_kegiatan"]').attr("required");
		}
	});
	
	$(document).ready(function () {
		$('.detail-tgl-kegiatan').click(function () {
			$('.row-default-tgl-kegiatan input').val("").removeAttr("required");
			$('.row-default-tgl-kegiatan').addClass("hide");
			$('.detail-tgl-kegiatan').addClass("hide");
			
			var detailTgl = $('.master-detail-tgl-kegiatan').html();
			
			$('.group-detail-tgl-kegiatan').append(detailTgl);
			$('.row-detail-tgl-kegiatan').removeClass("hide");
			$('.add-detail-tgl-kegiatan').removeClass("hide");
			
			Datepicker.init();
		});
		
		$('.add-detail-tgl-kegiatan').click(function () {
			var detailTgl = $('.master-detail-tgl-kegiatan').html();
			
			$('.group-detail-tgl-kegiatan').append(detailTgl);
			Datepicker.init();
		});
	});
	
	$(document).on("click", ".del-detail-tgl-kegiatan", function () {
		$(this).closest('.form-detail-tgl-kegiatan').remove();
		
		var counter = $('.group-detail-tgl-kegiatan').find('.form-detail-tgl-kegiatan').length;
		
		if (counter == 0) {
			$('.row-default-tgl-kegiatan input').val("").attr("required", "required");
			$('.row-default-tgl-kegiatan').removeClass("hide");
			
			$('.detail-tgl-kegiatan').removeClass("hide");
			$('.add-detail-tgl-kegiatan').addClass("hide");
			$('.row-detail-tgl-kegiatan').addClass("hide");
		}
	});
</script>