<div id="modal-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-modal-form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-form">Form Sub Menu</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('menu/storeSubMenu') ?>" method="post" id="form-sub-menu" autocomplete="off">
					<input type="hidden" name="id" id="id">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="ref_menu_group_id">Group Menu <span class="text-danger">*)</span></label>
								<select name="ref_menu_group_id" id="ref_menu_group_id" class="form-control select2">
									<option value="">Pilih Menu Group</option>
									<?php
									$ref_menu_group = $this->db->get_where('ref_menu_group', [
										'is_active' => '1'
									])->result();

									foreach ($ref_menu_group as $item) : ?>
										<option value="<?= $item->id ?>"><?= ucfirst($item->nama) ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="parent_id">Menu Utama <span class="text-danger">*)</span></label>
								<select name="parent_id" id="parent_id" class="form-control select2">
									<option value="">Pilih Menu Utama</option>
								</select>
							</div>
							<div class="form-group">
								<label for="nama">Nama Sub Menu <span class="text-danger">*)</span></label>
								<input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama sub menu">
							</div>
							<div class="form-group">
								<label for="route">Link <span class="text-danger">*)</span></label>
								<input type="text" name="route" id="route" class="form-control" placeholder="Masukkan link menu">
							</div>
							<div class="form-group">
								<label for="urutan">Urutan <span class="text-danger">*)</span></label>
								<input type="text" name="urutan" id="urutan" class="form-control" placeholder="Masukkan urutan menu">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
				<button type="submit" form="form-sub-menu" class="btn bg-theme-custom text-white waves-effect waves-light btn-submit"><i class="bx bx-check-circle"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
