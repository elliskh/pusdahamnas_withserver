<div id="modal-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-modal-form" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-form">Form Menu Utama</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('menu/storeMainMenu') ?>" method="post" id="form-menu" autocomplete="off">
					<input type="hidden" name="id" id="id">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="ref_menu_group_id">Group Menu <span class="text-danger">*</span></label>
								<select name="ref_menu_group_id" id="ref_menu_group_id" class="form-control select2">
									<option value="">Pilih Group Menu</option>
									<?php
									$group_menu = $this->db->get_where('ref_menu_group', [
										'is_active' => '1'
									])->result();

									foreach ($group_menu as $group) : ?>                                    
										<option value="<?= $group->id ?>"><?= $group->nama ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="name">Nama Menu <span class="text-danger">*)</span></label>
								<input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama menu">
							</div>
							<div class="form-group">
								<label for="route">Link <span class="text-danger">*)</span></label>
								<input type="text" name="route" id="route" class="form-control" placeholder="Masukkan link menu">
							</div>
							<div class="form-group">
								<label for="path">Path <span class="text-danger">*)</span></label>
								<input type="text" name="path" id="path" class="form-control" placeholder="Masukkan path menu">
							</div>
							<div class="form-group">
								<label for="urutan">Urutan <span class="text-danger">*)</span></label>
								<input type="text" name="urutan" id="urutan" class="form-control" placeholder="Masukkan urutan menu">
							</div>
							<div class="form-group">
								<label for="icon">Icon <span class="text-danger">*)</span></label>
								<input type="text" name="icon" id="icon" class="form-control" readonly placeholder="Pilih icon di tabel yang tersedia">
							</div>
						</div>
						<div class="col-md-7">
							<table class="table table-striped table-hover table-icons" style="width: 100%;">
								<thead>
									<tr>
										<th class="text-center" style="width: 10%;">Icon</th>
										<th>Nama Icon</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach (icons() as $key => $value) : ?>
										<tr>
											<td class="text-center" style="width: 10%;"><i class="<?= $value ?> fa-2x text-primary pilih-icon" data-icon_name="<?= $value ?>"></i></td>
											<td><span class="pilih-icon" data-icon_name="<?= $value ?>"><?= $value ?></span></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
				<button type="submit" form="form-menu" class="btn bg-theme-custom text-white waves-effect waves-light btn-submit"><i class="bx bx-check-circle"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
