<div class="row">
	<div class="col-12">
		<div class="card rounded-pill-top">
			<div class="card-header bg-theme-custom-dark rounded-pill-top">
				<h2 class="mb-0 text-white font-weight-bold"><i class="bx bx-book"></i>Data Nama SNP</h2>
				<h5 class="mb-0 text-white">Data Nama SNP beserta detailnya</h5>
			</div>
			<div class="card-body">
				<div class="row mb-2">
                  <?php 
                  $check_ss = decrypt($this->session->ss_iduser);
                  if($check_ss==30){ ?>
					<div class="col-sm-12">
                      <p>Note: Untuk menambah BAB, klik link yang berwarna biru</p>
						<div class="text-right mb-3">
							<a class="btn bg-theme-custom text-white btn-rounded waves-effect waves-light btn-tambah" href="<?= '' . $link . '/' . $menu_id . '' ?>">
								<i class="bx bx-plus-circle"></i> Tambah Nama SNP
							</a>
						</div>
					</div>
                 <?php }?>   
				</div>
        <style type="text/css">
        div.dataTables_length {/*margin left datatable button CSV*/
          margin-right: 1em;
        }
        </style>                
				<div class="table-responsive" data-pattern="priority-columns">
					<table class="table table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
  <!--  <thead>
        <tr>
            <th colspan="3">Deduction</th>
            <th colspan="3">Incentive</th>
        </tr>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
            <th>Column 3</th>
            <th>Column 1</th>
            <th>Column 2</th>
            <th>Column 3</th>
        </tr>
   </thead>   -->  
                        <thead class="bg-theme-custom-dark bg-custom-thead text-white">
                            <tr>
								<th style="width: 5%;">#</th>
								<th>Nama SNP</th>
								<th>Deskripsi</th>
								<th>Status publik</th>
								<th style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$.fn.dataTable.ext.errMode = 'throw';
</script>
