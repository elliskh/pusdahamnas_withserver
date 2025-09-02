<style>
#tahun {
  width: 100%;
  height: 350px;
}
#unit_kerja {
  width: 100%;
  height: 500px;
}
#jenis {
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
					<img src="https://ministry.phicos.co.id/pusdahamnas/assets/img/logo-pusdahamnas-dark.png" alt="" height="100">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
<?php
$show=0;
if ($show==1)
{
	?>
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
<?php
	}
?>
	<div class="col-lg-12">
		<div class="card rounded-pill-top">
			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
				<h5 class="font-size-14 mb-0">Dokumen Berdasarkan Tahun</h5>
				<div id="tahun"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="card rounded-pill-top">
			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
				<h5 class="font-size-14 mb-0">Dokumen Berdasarkan Unit Kerja</h5>
				<div id="unit_kerja"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card rounded-pill-top">
			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
				<h5 class="font-size-14 mb-0">Dokumen Berdasarkan Jenis Dokumen</h5>
				<div id="jenis"></div>
			</div>
		</div>
	</div>
</div>