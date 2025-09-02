<style>
        #peta_lokasi{
            width: 100%;
            height: 600px;
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
            <h4 class="mb-0 font-size-18">Indikator HAM</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Beranda</a></li>
                    <li class="breadcrumb-item active">Indikator HAM</li>
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
        <h4 class="card-title font-size-24">Indikator Hak Asasi Manusia</h4>
        <p class="mb-0">Daftar Indikator Hak Asasi Manusia</p>
<!--                             <form class="hero-search">
            <div class="position-relative">
                <input type="text" class="form-control" placeholder="Pencarian Data Glossarium HAM" id="cari_kata" value="<?= $key ?>">
                <span class="bx bx-search-alt"></span>
            </div>
        </form> -->
    </div>
</div>

<div class="card" id="pengguna">
    <div class="card-body">
        <div class="hori-timeline mt-4 mt-lg-5">
            <div class="col-12">
                <div id="peta_lokasi"></div>
            </div>
        </div>
    </div>
</div>