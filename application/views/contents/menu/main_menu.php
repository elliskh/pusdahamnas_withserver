<div class="row">
	<div class="col-12">
		<div class="card rounded-pill-top">
			<div class="card-header bg-theme-custom-dark rounded-pill-top">
				<h2 class="mb-0 text-white font-weight-bold"><i class="bx bx-list-check"></i> Menu utama</h2>
				<h5 class="mb-0 text-white">Manajemen Menu</h5>
			</div>
			<div class="card-body">
				<div class="row mb-2">
					<div class="col-sm-12">
						<div class="text-sm-right">
							<?php if ($access['tambah']) : ?>
								<button type="button" class="btn bg-theme-custom text-white btn-rounded waves-effect waves-light btn-tambah"><i class="bx bx-plus-circle mr-1"></i> Tambah</button>
							<?php endif ?>
						</div>
					</div>
				</div>
				<div class="table-responsive" data-pattern="priority-columns">
					<table class="table table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
						<thead class="bg-theme-custom-dark bg-custom-thead text-white">
							<tr>
								<th style="width: 5%;">#</th>
								<th>Group Menu</th>
								<th>Menu Utama</th>
								<th>Link</th>
								<th>Urutan</th>
								<th>Icon</th>
								<th>Aksi</th>
								<th></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>