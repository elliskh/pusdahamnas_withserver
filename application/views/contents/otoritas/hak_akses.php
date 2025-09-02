<div class="row">
	<div class="col-12">
		<div class="card rounded-pill-top">
			<div class="card-header bg-theme-custom-dark rounded-pill-top">
				<h2 class="mb-0 text-white font-weight-bold"><i class="bx bx-key"></i> Otoritas | Plotting Hak Akses</h2>
				<h5 class="mb-0 text-white">Pengaturan Otoritas</h5>
			</div>
			<div class="card-body">
				<div class="row mb-4">
					<div class="col-sm-6">
						<div class="text-sm-left">
							<button type="button" class="btn btn-secondary btn-rounded waves-effect waves-light" onclick="javascript:history.back();"><i class="bx bx-left-arrow-alt"></i> Kembali</button>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="text-sm-right">
							<button type="submit" form="form-hak-akses" class="btn text-white bg-theme-custom btn-rounded waves-effect waves-light"><i class="bx bx-check-circle"></i> Simpan</button>
						</div>
					</div>
				</div>

				<?php if (!empty($this->session->flashdata('update-hak-akses'))) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Perubahan hak akses sudah disimpan. Sejumlah <b><?= $this->session->flashdata('update-hak-akses') ?></b> data dirubah!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
				<form method="post" id="form-hak-akses" action="<?= site_url('otoritas/updateHakAkses/' . $menu_id) ?>">
					<input type="hidden" name="role_id" class="role_id" value="<?= $role_id ?>">
					<input type="hidden" name="<?= @csrf()['token_name'] ?>" value="<?= @csrf()['hash'] ?>" autocomplete="new-password">
					<?php foreach ($list_menu as $menu) : ?>
						<div class="form-group col-12">
							<h6 class="font-weight-bold font-size-15"><?= $menu['nama'] ?></h6>
							<div class="form-group col-12 row">
								<?php if (empty($menu['child'])) : ?>
									<?php $menu_actions = explode(',', $menu['actions']); ?>
									<?php foreach ($actions as $action) : ?>
										<div class="custom-control custom-checkbox mb-3 mr-4 col-1">
											<input type="checkbox" value="1" class="custom-control-input" id="<?= $menu['id'] . '_' . $menu['role_id'] . '_' . $action->id ?>" name="<?= $menu['id'] . '_' . $menu['role_id'] . '_' . $action->id ?>" <?= in_array($action->id, $menu_actions) ? 'checked' : '' ?>>
											<label class="custom-control-label" for="<?= $menu['id'] . '_' . $menu['role_id'] . '_' . $action->id ?>"><?= $action->nama ?></label>
										</div>
									<?php endforeach ?>
								<?php else : ?>
									<?php $first_action = reset($actions); ?>
									<div class="custom-control custom-checkbox mb-3 col-2">
										<input type="checkbox" value="1" class="custom-control-input" id="<?= $menu['id'] . '_' . $menu['role_id'] . '_' . $first_action->id ?>" name="<?= $menu['id'] . '_' . $menu['role_id'] . '_' . $first_action->id ?>" <?= $menu['actions'] == '1' ? 'checked' : '' ?>>
										<label class="custom-control-label" for="<?= $menu['id'] . '_' . $menu['role_id'] . '_' . $first_action->id ?>"><?= $first_action->nama ?></label>
									</div>
									<div class="col-12 ml-3">
										<?php foreach ($menu['child'] as $child) : ?>
											<h6 class="font-weight-bold font-size-14"><?= $child['nama'] ?></h6>
											<div class="form-group row mt-2">
												<?php $child_menu_actions = explode(',', $child['actions']); ?>
												<?php foreach ($actions as $action) : ?>
													<div class="custom-control custom-checkbox mb-3 mr-4 ml-3 col-1">
														<input type="checkbox" value="1" class="custom-control-input" id="<?= $child['id'] . '_' . $child['role_id'] . '_' . $action->id ?>" name="<?= $child['id'] . '_' . $child['role_id'] . '_' . $action->id ?>" <?= in_array($action->id, $child_menu_actions) ? 'checked' : '' ?>>
														<label class="custom-control-label" for="<?= $child['id'] . '_' . $child['role_id'] . '_' . $action->id ?>"><?= $action->nama ?></label>
													</div>
												<?php endforeach ?>
											</div>
										<?php endforeach ?>
									</div>
								<?php endif ?>
							</div>
						</div>
					<?php endforeach ?>
				</form>
			</div>
		</div>
	</div>
</div>
