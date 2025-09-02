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
				<h5 class="mb-1 text-white"> List Pengunduh Dokumen </h5>
			</div>
			<div class="card-body">
				<div style="overflow-x:auto;">
					<table class="table_custom table table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
						<thead class="bg-theme-custom-dark bg-custom-thead text-white">
							<tr>
								<th class="align-middle text-center">No</th>
								<th class="align-middle "> Nama Pengunduh </th>
								<th class="align-middle "> Email </th>
								<th class="align-middle "> Lembaga/Instansi </th>
								<th class="align-middle "> Nama Dokumen </th>
								<th class="align-middle "> Tujuan Pengunduhan </th>
								<th class="align-middle " style="width:15%"> Tanggal Unduh </th>
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