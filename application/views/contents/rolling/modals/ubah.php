<div id="modal-ubah-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-modal-form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-form">Isu Prioritas</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('rolling/update/' . $menu_id) ?>" method="post" id="form-ubah-user">
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<label for="ubah-nama">Nama Isu Prioritas <span class="text-danger">*</span></label>
						<input type="text" name="nama" id="ubah-nama" class="form-control" placeholder="Masukkan nama Isu">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
				<button type="submit" form="form-ubah-user" class="btn bg-theme-custom text-white waves-effect waves-light btn-submit"><i class="bx bx-check-circle"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
