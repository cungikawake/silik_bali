
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h5 class="modal-title">IMPORT DATA BANK</h5>
		</div>
		
		<form action="/admin/biodata/execute_import_data_bank" method="post" class="import_data_bank" autocomplete="off">
			<input type="hidden" name="id" class="form-control" value="<?php print isset($id) ? $id : ""; ?>" />
			<div class="modal-body">
				<div class="form-group">
					<label>CSV File</label>
					<input type="file" name="csv_data_bank" class="csv_data_bank form-control" accept=".csv" />
					<small><a href="<?php print base_url("/assets/import_data_bank.xlsx"); ?>">Download Template</a></small>
				</div>
				<div class="form-group">
					<label>Log</label>
					<div class="log-import-data-bank form-control" style="background: #ddd; height: 200px; overflow-y: auto; padding: 0;">
					
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-modal-form-submit">Import</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			</div>
		</form>
	</div>
</div>