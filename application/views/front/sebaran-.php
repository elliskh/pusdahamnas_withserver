<style>
    #peta_lokasi {
        width: 100%;
        height: 450px;
    }
</style>
<?php
$show=0;
if ($show==1)
{
    ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Sebaran Lembaga HAM</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Beranda</a></li>
                    <li class="breadcrumb-item active">Sebaran Lembaga HAM</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Title Page End -->
<?php
}
?>
<div class="card" style="margin-bottom: 15px;">
    <div class="card-body">
        <h4 class="card-title font-size-24">Sebaran Lembaga Hak Asasi Manusia</h4>
        <p class="mb-0">Daftar Lembaga Hak Asasi Manusia</p>
		<div class="text-right mb-3" style="margin-top: -4%;">
			<a class="btn btn-primary btn-rounded btn-tambah" href="<?=base_url('home/pendaftaran_lembaga')?>">
				<i class="bx bx-plus-circle"></i> Daftarkan Lembaga Anda
			</a>
		</div>
        <!--                             <form class="hero-search">
            <div class="position-relative">
                <input type="text" class="form-control" placeholder="Pencarian Data Glossarium HAM" id="cari_kata" value="<?= $key ?>">
                <span class="bx bx-search-alt"></span>
            </div>
        </form> -->
    </div>
</div>

<div class="row">

    <div class="col-12">
        <div class="card" id="pengguna">
            <div class="card-body">
                <h4 class="card-title" style="text-align: center;font-size: xx-large;">LEMBAGA HAM</h4>
                <div class="hori-timeline mt-0 mt-lg-0">
                    <div class="col-12" style="height: 40%;">
                        <div id="peta_lokasi"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>