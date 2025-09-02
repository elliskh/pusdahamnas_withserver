<style>
	.table_custom thead tr th {
		padding: 10px 22px 5px 7px;
		border: 1px solid #ddd !important;
	}

	.table_custom tbody tr td {
		padding: 5px 15px 5px 7px;
	}

	table.dataTable thead>tr>th.sorting_asc,
	table.dataTable thead>tr>th.sorting_desc,
	table.dataTable thead>tr>th.sorting,
	table.dataTable thead>tr>td.sorting_asc,
	table.dataTable thead>tr>td.sorting_desc,
	table.dataTable thead>tr>td.sorting {
		padding: 20px 15px 10px 7px;
	}

	.table_custom .btn-group .btn {
		border: 1px solid #ddd !important;
	}

	.table_custom .btn-group .btn:focus {
		opacity: 1;
		color: #EEE !important;
	}
</style>
<div class="row">
	<div class="col-12">
		<div class="card rounded-pill-top">
			<div class="card-header bg-theme-custom-dark rounded-pill-top">
				<h2 class="mb-1 text-white font-weight-bold"><i class="bx bx-list-check"></i> <?= $title; ?></h2>
				<h5 class="mb-1 text-white"> List Data Pegiat Ham </h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="text-right mb-3">
							<a class="btn bg-theme-custom text-white btn-rounded waves-effect waves-light btn-tambah" href="<?= '' . $link . '/' . $menu_id . '' ?>">
								<i class="bx bx-plus-circle"></i> Tambah
							</a>
						</div>
					</div>
				</div>
				<div id="datatable-wrapper" data-pattern="priority-columns " class="table-responsive">
					<table class="table_custom table table-striped table-bordered table-hover" style="width: 1100px;">
						<thead class="bg-theme-custom-dark bg-custom-thead text-white">
							<tr>
								<th class="align-middle text-center" rowspan="2">#</th>
								<th rowspan="2" style="width: 200px ;" class="align-middle "> Nama </th>
								<th colspan="3" class="text-center"> S2 </th>
								<th colspan="3" class="text-center"> S3 </th>
								<th class="align-middle text-center" rowspan="2">Aksi</th>
							</tr>
							<tr>
								<th> Universitas </th>
								<th> Tahun Masuk </th>
								<th> Tahun Lulus </th>
								<th> Universitas </th>
								<th> Tahun Masuk </th>
								<th> Tahun Lulus </th>
							</tr>
						</thead>
						<tbody>
							<?php
							$profil = ' 
							<ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
								<li>
									<a href="#" style="padding: 0;">
										<div class="media">
											<div class="align-self-center mr-1" hidden>
												<i class="mdi mdi-circle text-success font-size-10"></i>
											</div>
											<div class="avatar-xs align-self-center mr-2">
												<span class="avatar-title rounded-circle bg-soft-primary text-primary">
												 J 
												</span>
											</div>
											<div class="media-body overflow-hidden">
												<h5 class="text-truncate font-size-14 mb-1" style="margin-top: 5px;">  085728503421  </h5>
												<p class="text-truncate mb-0" style="text-transform: Uppercase;">  JION PURNOMO </p>
											</div> 
										</div>
									</a>
								</li>
							</ul>';
							?>
							<tr>
								<td> 1 </td>
								<td> <?= $profil ?> </td>
								<td> UGM </td>
								<td> 2016 </td>
								<td> 2018 </td>
								<td> UI </td>
								<td> 2018 </td>
								<td> 2020 </td>
								<td>
									<div class="btn-group">
										<button class="btn btn-outline-info btn-update" type="button" title="Ubah Data">
											<i class="bx bx-pencil"></i>
										</button>
										<button class="btn btn-outline-danger btn-remove" title="Hapus Data">
											<i class="bx bx-trash"></i></button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>