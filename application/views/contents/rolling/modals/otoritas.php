<div id="modal-ubah-role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-modal-role" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-form">Form Otoritas Pengguna: <span class="nama"></span></h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('rollisu/updateRole/' . $menu_id) ?>" method="post" id="form-ubah-role">
					<input type="hidden" name="id" id="ubah_role_id">
					<div class="row">
						<?php foreach ($roles as $role) : ?>
							<div class="col-md-6">
								<div class="custom-control custom-checkbox mb-3">
									<input type="checkbox" class="custom-control-input checkbox-role" id="roles-<?= $role->id ?>" name="role_<?= $role->id ?>" value="<?= $role->id ?>">
									<label class="custom-control-label" for="roles-<?= $role->id ?>"><?= ucfirst($role->nama) ?></label>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
				<button type="submit" form="form-ubah-role" class="btn bg-theme-custom text-white waves-effect waves-light btn-submit"><i class="bx bx-check-circle"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
