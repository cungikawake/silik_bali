<table class="table table-dakung">
	<tbody>
		<?php
			if (!empty($list)) {
				foreach ($list as $dakung) {
					$id = $dakung["id"];
					$nama = strtolower($dakung["nama"]);
					$size = $this->utility->formatSizeUnits($dakung["size"]);
					$type = $dakung["type"];
					$driveFileId = $dakung["drive_file_id"];
					$user = $dakung["user"];
					$tgl = $this->utility->formatDateIndo($dakung["dibuat_tgl"]);
					
					$icon = "fa-file-pdf";
					
					if ($type == "doc" || $type == "docx") {
						$icon = "fa-file-word";
					}
					else if ($type == "jpg" || $type == "jpeg") {
						$icon = "fa-file-image";
					}
					
					$showDelete = false;
					
					if ($dakung["dibuat_oleh"] == $_SESSION["user"]["id"]) {
						$showDelete = true;
					}
		?>
					<tr>
						<td width="30px">
							<i class="dakung-icon fas <?php print $icon; ?>"></i>
						</td>
						<td>
							<h6 class="m-0"><a href="https://drive.google.com/open?id=<?php print $driveFileId; ?>" target="_blank" class="dakung-title" title="<?php print $nama; ?>"><?php print $nama; ?></a></h6>
							<div class="dakung-attr">
								<div class="dakung-size"><?php print $size; ?></div>
								<div class="dakung-date"><i class="fas fa-calendar-alt"></i> <?php print $tgl; ?></div>
								<div class="dakung-user"><i class="fas fa-user"></i> <?php print $user; ?></div>
							</div>
						</td>
						<td class="text-right">
							<?php
								if ($showDelete) {
							?>
									<a href="javascript:;" class="delete-dakung" data-id="<?php print $id; ?>" title="Hapus File"><i class="fas fa-trash-alt"></i></a> 
							<?php
								}
							?>
							
							<a href="https://drive.google.com/uc?export=download&id=<?php print $driveFileId; ?>" title="Download File"><i class="fas fa-download"></i></a>
						</td>
					</tr>
		<?php
				}
			}
		?>
	</tbody>
</table>