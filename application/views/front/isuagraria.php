<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
<?php
$show=0;
if ($show==1)
{
    ?>
                    <!-- Title Page Start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Anggaran HAM</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                                        <li class="breadcrumb-item active">Anggaran HAM</li>
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
                            <!--<h4 class="card-title font-size-24">Anggaran HAM</h4>
                            <p class="mb-0">Pencarian Kosa Kata terkait HAM</p>-->
                            <h4 class="card-title font-size-24">Anggaran ramah HAM</h4>
                            <p class="mb-0">Pencarian Kata
                             <form class="hero-search">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Pencarian Data Anggaran HAM" id="cari_kata" value="<?= $key ?>">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" id="hasil_cari">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title font-size-18 mb-3">Daftar Kosa Kata</h4>
                                    <form action="<?= base_url('home/anggaran') ?>" method="POST">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                        <!--<div class="nav-letter mb-4">
                                            <input class="btn <?= ($huruf==''||$huruf=='Semua')?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="Semua">
                                            <?php //foreach ($all_huruf as $hrf) { ?>
                                            <input class="btn <?= ($hrf==$huruf)?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="<?= $hrf ?>">
                                            <?php //} ?>
                                        </div>-->
                                    </form>
        
                                    <table class="table table-centered table-hover mb-0">
                                        <tbody>
                                            <?php foreach ($list_anggaran as $list) { ?>
                                            <tr>
                                                <td>
                                                    <div class="d-md-flex">
                                                        <div class="table-content ml-md-3">
                                                            <h4 class="font-weight-semibold limit-2-line-text mb-3">
                                                                <a class="link-underline link-title"><?= $list['judul'] ?></a>
                                                            </h4>
        
                                                            <div class="mb-3">
                                                                <h4 class="card-title font-size-14">Penjelasan Kosa Kata :</h4>
                                                                <p class="text-justify"><?= $list['deskripsi'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-12 text-center mt-4 mt-md-5">
                                            <?php if (count($list_anggaran)>0) {
                                            echo $pagging; 
                                            } else {
                                            echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>