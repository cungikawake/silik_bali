<div class="modal fade" id="modal-dakung" tabindex="-1" role="dialog" aria-labelledby="modal-button-row" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title">Upload <?php print $section; ?></h5>
			</div>

			<div class="modal-body">
				<div id="dropzone-dakung" class="dropzone">
					<div class="dz-message needsclick">    
					Drop files here or click to upload.
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-submit-dakung">Upload</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>