<!-- Modal Ubah -->
<div id="modal-ubah" class="modal fade" role="dialog" aria-labelledby="label-modal-ubah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-ubah">Form Ubah Data</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-ubah" enctype="multipart/form-data" autocomplete="off">
					<div class="form-group">
						<label for="ubah-kolom_1">Kolom 1 <span class="text-danger">*)</span></label>
						<input type="text" name="kolom_1" id="ubah-kolom_1" class="form-control" placeholder="Masukkan kolom_1">
					</div>
					<div class="form-group">
						<label for="ubah-kolom_2">Kolom 2 <span class="text-danger">*)</span></label>
						<input type="text" name="kolom_2" id="ubah-kolom_2" class="form-control" placeholder="Masukkan kolom_2">
					</div>
					<div class="form-group">
						<label for="ubah-kolom_3">Kolom 3 <span class="text-danger">*)</span></label>
						<input type="text" name="kolom_3" id="ubah-kolom_3" class="form-control" placeholder="Masukkan kolom_3">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
				<button type="submit" form="form-ubah" class="btn bg-theme-custom text-white waves-effect waves-light btn-submit"><i class="bx bx-check-circle"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
