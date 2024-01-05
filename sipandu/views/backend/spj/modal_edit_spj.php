<div class="modal fade" id="add-spj-modal" role="dialog" aria-hidden="false" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title">Buat SPJ Keuangan</h5>
			</div>
			<form method="post" class="form-spj">
				<input type="hidden" name="id" class="form-control" value="<?php print isset($id) ? $id : ""; ?>">
				<div class="modal-body">
					<div class="form-group">
						<?php
							$tipe = "monev";
							$disabled = '';
						
							if (isset($id) && !empty($id)) {
								$disabled = 'disabled';
							}
						
							if (isset($kegiatan_id) && !empty($kegiatan_id)) {
								$tipe = "kegiatan";
							}
						
							if ($tipe == "monev") {
								$showMonev = true;
								$showKegiatan = false;
							}
							else {
								$showMonev = false;
								$showKegiatan = true;
							}
						
							$tipes = array(
								"monev" => "Monev / Pendampingan / Undangan Luar",
								"kegiatan" => "Kegiatan Balai"
							);
						?>
						<label>Tipe Tugas</label>
						<select class="form-control select2 tipe-tugas" <?php print $disabled; ?>>
							<?php
								foreach ($tipes as $tipeKey => $tipeVal) {
									$selected = "";
									
									if ($tipeKey == $tipe) {
										$selected = 'selected="selected"';
									}
									
									print '<option value="'.$tipeKey.'" '.$selected.'>'.$tipeVal.'</option>';
								}
							?>
						</select>
					</div>
					<div class="opt-kegiatan" style="<?php print (!$showKegiatan) ? 'display:none;' : ''; ?>">
						<div class="form-group">
							<label>Pilih Kegiatan</label>
							<select class="form-control select2-kegiatan" <?php print $disabled; ?> <?php print (!$showKegiatan) ? 'disabled' : ''; ?> name="kegiatan_id" data-selected-kegiatan="<?php print isset($kegiatan_id) ? $kegiatan_id : ""; ?>"></select>
						</div>
					</div>
					<div class="opt-monev" style="<?php print (!$showMonev) ? 'display:none;' : ''; ?>">
						<div class="form-group">
							<label>Pilih Penugasan</label>
							<select class="form-control select2-penugasan" <?php print $disabled; ?> <?php print (!$showMonev) ? 'disabled' : ''; ?> name="penugasan_id" data-selected-penugasan="<?php print isset($penugasan_id) ? $penugasan_id : ""; ?>">
								<option>&nbsp;</option>
								<?php
									if (isset($penugasan_options) && !empty($penugasan_options)) {
										foreach ($penugasan_options as $opt) {
											print '<option value="'.$opt["id"].'">'.$opt["nama"].'</option>';
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>Nama SPJ Keuangan</label>
						<textarea class="form-control" rows="2" name="nama"><?php print isset($nama) ? $nama : ""; ?></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info btn-submit-spj mb-0">Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>