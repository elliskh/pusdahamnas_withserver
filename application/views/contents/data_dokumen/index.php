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
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />

<div class="row">
	<div class="col-12">
		<div class="card rounded-pill-top">
			<div class="card-header bg-theme-custom-dark rounded-pill-top">
				<h2 class="mb-1 text-white font-weight-bold"><i class="bx bx-list-check"></i> <?= $title; ?></h2>
				<h5 class="mb-1 text-white"> List Data Dokumen </h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<label for=""> <h3>Filter</h3></label>
					</div>
				</div>
			<div class="row align-items-center mb-4">
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
									<select name="id_topik_hak" id="id_topik_hak" class="form-control select2" >
										<option value="" disabled selected>Pilih Topik Hak</option>
										<?php foreach ($hak as $key => $value) { ?>
											<option value="<?=encode_id($value->id_hak)?>"><?=$value->nama_hak?></option>
										<?php } ?>
									</select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
                                                   
									<select name="id_topik_subyek" id="id_topik_subyek" class="form-control select2" >
										<option value="" disabled selected>Pilih Topik Subyek</option>
										<?php foreach ($subyek as $key => $value) { ?>
											<option value="<?=encode_id($value->id_subyek)?>"><?=$value->nama_subyek?></option>
										<?php } ?>
									</select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
                                                    
									<select name="id_lembaga" id="id_lembaga" class="form-control select2" >
										<option value="" disabled selected>Pilih Mitra/Lembaga</option>
										<?php foreach ($lembaga as $key => $value) { ?>
											<option value="<?=encode_id($value->id)?>"><?=$value->nama_lembaga?></option>
										<?php } ?>
									</select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="hidden" name="huruf_refresh" value="">
                                                <button type="button" onclick="load_table()" class="btn bg-theme-custom text-white btn-rounded waves-effect waves-light">Cari Data</button>
                                            </div>
                                        </div>
				<div class="row">
					<div class="col-md-12">
						<div class="text-right mb-3">
							<a class="btn bg-theme-custom text-white btn-rounded waves-effect waves-light btn-tambah" href="<?= '' . $link . '/' . $menu_id . '' ?>">
								<i class="bx bx-plus-circle"></i> Tambah
							</a>
						</div>
					</div>
				</div>
				<div style="overflow-x:auto;">
					<table class="table_custom table table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
						<thead class="bg-theme-custom-dark bg-custom-thead text-white">
							<tr>
								<th class="align-middle text-center">No</th>
								<th class="align-middle "> Nama Dokumen </th>
								<th class="align-middle "> Unit Kerja </th>
								<th class="align-middle "> No. Dok </th>
								<th class="align-middle "> Tahun </th>
								<th class="align-middle "> Media </th>
								<th class="align-middle "> Jenis Dokumen </th>
								<th class="align-middle "> Topik Isu Hak </th>
								<th class="align-middle "> Topik Isu Subyek </th>
								<th class="align-middle "> Status Dokumen </th>
								<th class="align-middle "> Keterangan </th>
								<th class="align-middle "> Aksi </th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>