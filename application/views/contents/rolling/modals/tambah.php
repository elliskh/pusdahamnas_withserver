<div id="modal-tambah-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-modal-form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-form">Form Pengguna</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('rollisu/store/' . $menu_id) ?>" method="post" id="form-tambah-user">
					<div class="form-group">
						<label for="username">Username <span class="text-danger">*</span></label>
						<input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username">
					</div>
					<div class="form-group">
						<label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap">
					</div>
					<div class="form-group">
						<label for="password">Kata Sandi <span class="text-danger">*</span></label>
						<input type="password" name="password" id="password" class="form-control">
					</div>
					<div class="form-group">
						<label for="password_confirmation">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
				<button type="submit" form="form-tambah-user" class="btn bg-theme-custom text-white waves-effect waves-light btn-submit"><i class="bx bx-check-circle"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
