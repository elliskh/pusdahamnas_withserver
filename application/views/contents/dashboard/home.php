<style>
#mitra {
  width: 100%;
  height: 250px;
}
#hak {
  width: 100%;
  height: 500px;
}
#subyek {
  width: 100%;
  height: 500px;
}
</style>

<div class="row">
	<div class="col-lg-12">
		<div class="card rounded-pill-top">
			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
				<h3 class="font-weight-bold mb-1 text-color-custom"></h3>
				<div class="mb-1">
					<img src="<?=base_url('assets/img/logo-pusdahamnas-dark.png')?>" alt="" height="100">
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($this->session->tipe_daftar == 1 ){
	redirect(base_url());
} else if($this->session->tipe_daftar == 2){
	
} else{?>
<div class="row">
	<div class="col-lg-4">
		<div class="card rounded-pill-top">
			<div class="card-body">
				<div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs mr-3">
                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                            <i class="bx bx-archive-in"></i>
                        </span>
                    </div>
                    <h5 class="font-size-14 mb-0">Total Unduh Dokumen</h5> 
                </div>
                <div class="text-muted mt-4">
                    <h4><?= number_format($total_unduh) ?> <span class="text-success">Kali</span></h4>
                    
					<?php foreach ($unduh_terbanyak as $dok) { ?>
                    <div class="d-flex mb-2">
                        <span class="badge badge-soft-success font-size-12" style="height: fit-content;"> <?= $dok['jumlah'] ?> Kali </span> <span class="ml-2"><?= $dok['nama_dokumen'] ?></span>
                    </div>
                	<?php } ?>
                </div>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card rounded-pill-top">
			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
				<h5 class="font-size-14 mb-0">Dokumen Berdasarkan Mitra</h5>
				<div id="mitra"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="card rounded-pill-top">
			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
				<h5 class="font-size-14 mb-0">Dokumen Berdasarkan Hak</h5>
				<div id="hak"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card rounded-pill-top">
			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
				<h5 class="font-size-14 mb-0">Dokumen Berdasarkan Subyek</h5>
				<div id="subyek"></div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!-- jika komnasham down -->
<!--<script src="http://devpusdahamnas.komnasham.go.id/assets/assets_theme/assets/libs/jquery/jquery.min.js"></script>
<script src="http://devpusdahamnas.komnasham.go.id/assets/assets_theme/assets/libs/simplebar/simplebar.min.js"></script>
<script src="http://devpusdahamnas.komnasham.go.id/assets/assets_theme/assets/libs/node-waves/waves.min.js"></script>
<script src="http://devpusdahamnas.komnasham.go.id/assets/assets_theme/assets/js/app.js"></script>
<script src="http://devpusdahamnas.komnasham.go.id/assets/assets_theme/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="http://devpusdahamnas.komnasham.go.id/assets/assets_theme/assets/libs/toastr/build/toastr.min.js"></script>
http://devpusdahamnas.komnasham.go.id/assets/assets_theme/assets/libs/metismenu/metisMenu.min.js"></script>-->
<script src="https://dataham.komnasham.go.id/assets/assets_theme/assets/libs/jquery/jquery.min.js"></script>  
<script src="https://dataham.komnasham.go.id/assets/assets_theme/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="https://dataham.komnasham.go.id/assets/assets_theme/assets/libs/simplebar/simplebar.min.js"></script> 
<script src="https://dataham.komnasham.go.id/assets/assets_theme/assets/libs/node-waves/waves.min.js"></script>
<script src="https://dataham.komnasham.go.id/assets/assets_theme/assets/js/app.js"></script>
<script src="https://dataham.komnasham.go.id/assets/assets_theme/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="https://dataham.komnasham.go.id/assets/assets_theme/assets/libs/toastr/build/toastr.min.js"></script>
