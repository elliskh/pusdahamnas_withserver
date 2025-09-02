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
                        <h4 class="mb-0 font-size-18">#Dataset Media Audio</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Beranda</a></li>
                                <li class="breadcrumb-item active">Media Audio</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Title Page End -->
        <?php
}
?>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-size-24">Data Media Audio</h4>
                    <!-- <p class="mb-0">Lakukan pencarian database.</p> -->
            
                    <form class="hero-search" autocomplete="off">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Pencarian Data Media Audio" id="carikata">
                            <span class="bx bx-search-alt"></span>
                        </div>
                    </form>
                </div>
            </div>

          <div class="row">
            <!--<div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-4 mb-lg-5">
                        <div class="col-lg-4">
                            <h4 class="card-title font-size-18 mb-0"><?= count($data) ?> Data Media Audio ditemukan</h4>
                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-xl-4 col-sm-6 ml-auto">
                                    <div class="form-group mb-0">
                                        <label>Filter Berdasarkan :</label>
                                        <select class="form-control select2" id="id_hak">
                                            <option value="" selected>Pilih Semua Hak</option>
                                            <?php //foreach ($ref_hak_dokumen as $hak) { ?>
                                            <option value="<?= $hak['id_hak'] ?>"><?= $hak['nama_hak'] ?></option>
                                            <?php //} ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-sm-6 ml-auto">
                                    <div class="form-group mb-0">
                                        <label>Filter Berdasarkan :</label>
                                        <select class="form-control select2" id="id_subyek">
                                            <option value="" selected>Pilih Semua Subyek</option>
                                            <?php //foreach ($ref_subyek_dokumen as $subyek) { ?>
                                            <option value="<?= $subyek['id_subyek'] ?>"><?= $subyek['nama_subyek'] ?></option>
                                            <?php //} ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-2 col-sm-6 align-self-end">
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-primary w-100" id="btn-cari">Cari Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="datatable" class="table table-centered table-hover dt-responsive mb-0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th style="width: 20px;">#</th>
                                 <th>Preview Dokumen</th> 
                                <th class="text-left">Nama Ahli</th>
                                <th>Ahli HAM</th>
                                <th>Ahli Subyek</th>
                                 <th>Lihat Detail</th> 
                            </tr>
                        </thead>
                        <tbody class="text-center" id="data-ahli-ham">
                            <?php //$no=1; foreach ($data as $val) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                 <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-toggle="modal" data-target=".exampleModal"><i class="bx bx-show"></i> Preview</button>
                                </td>
                                <td class="text-left" style="width: 30%;">
                                    <a href="javascript(void)" id="infojenis" data-toggle="modal" data-id="<?php //echo $val['id'];?>"><h5 class="limit-2-line-text font-size-14 mb-1"><?= $val['nama'] ?></h5></a>
                                </td>
                                <td class="text-left" style="width: 40%;">
                                    <p class="limit-2-line-text mb-0"><?= $val['nama_hak'] ?></p>
                                </td>
                                <td class="text-left" style="width: 30%;">
                                    <p class="limit-2-line-text mb-0"><?= $val['nama_subyek'] ?></p>
                                </td>
                            </tr>
                            <?php //} ?>
                        </tbody>
                    </table>
                </div>
            </div>-->
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">VIDEO</h4>
                                    <hr>
                                    <?php
                                    $lama=0;
                                    if ($lama==1)
                                    {
                                        ?>
                                        <div class="attached-file">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap table-centered table-hover mb-0">
                                                    <tbody>
                                                        <?php foreach ($data as $val) { ?>
                                                        <tr>
                                                            <!-- <td style="width: 45px;">
                                                                <div class="avatar-sm">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                                        <i class="bx bxs-file-doc"></i>
                                                                    </span>
                                                                </div>
                                                            </td> -->
                                                            <td>
                                                                <h5 class="font-size-14 mb-1"><a href="<?= $val['link'] ?>" target="_blank" class="text-dark"><?= $val['judul'] ?></a></h5>
                                                            </td>
                                                            <!-- <td>
                                                                <div class="text-center">
                                                                    <a href="#" class="text-dark" title="Unduh Dokumen"><i class="bx bx-download h3 m-0"></i></a>
                                                                </div>
                                                            </td> -->
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <p class="mb-2; text-justify">Sistem Informasi Pusdahamnas disusun secara partisipatif dan transparan dengan melibatkan para pemangku kepentingan yaitu Kementerian, Lembaga Negara, Institusi HAM Nasional (NHRI), Organisasi Masyarakat Sipil, Pusat Studi HAM/Pusat Studi Universitas, dan Pekerja Media. Metode yang dilakukan melalui Workshop, Diskusi Kelompok Terfokus, Wawancara mendalam, Penyebaran survei secara online, studi literatur, kunjungan studi banding dan konsultasi. Adapun dokumen yang telah dihasilkan adalah Laporan Survei “Pemetaan Sumber Daya dalam Pembangunan Pusat Sumber Daya Hak Asasi Manusia”, Dokumen Grand Desain Pusdahamnas serta Dokumen Cetak Biru Pusdahamnas.</p>
                                        <?php
                                    }
                                    ?>
                                </div>
                                   <!-- <div class="hori-timeline mt-0 mt-lg-0" style="text-align: center;margin-top: 8%;position: relative;">
                                       <img src="<?= base_url() ?>assets/img/laptop-.png" alt="Image" style="height: 100%;width: 80%;margin-bottom: 3%;">
                                    </div>-->
                            </div>
                        </div>
                        
                      <div class="col-lg-6">  
                        <div class="card" id="pengguna">
                            <div class="card-body">
                               <h4 class="card-title" style="text-align: center;font-size: xx-large;">M E D I A</h4>
                                <div class="hori-timeline mt-0 mt-lg-0">
                                    <div class="col-12" style="height: 40%;text-align: center;">
                                        <img src="<?= base_url() ?>assets/img/player.png" alt="Image" style="height: 90%;width: 60%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                       </div> 
                       
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">PODCAST</h4>
                                    <hr>
                                    <?php
                                    $lama=0;
                                    if ($lama==1)
                                    {
                                        ?>
                                        <div class="attached-file">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap table-centered table-hover mb-0">
                                                    <tbody>
                                                        <?php foreach ($data as $val) { ?>
                                                        <tr>
                                                            <!-- <td style="width: 45px;">
                                                                <div class="avatar-sm">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                                        <i class="bx bxs-file-doc"></i>
                                                                    </span>
                                                                </div>
                                                            </td> -->
                                                            <td>
                                                                <h5 class="font-size-14 mb-1"><a href="<?= $val['link'] ?>" target="_blank" class="text-dark"><?= $val['judul'] ?></a></h5>
                                                            </td>
                                                            <!-- <td>
                                                                <div class="text-center">
                                                                    <a href="#" class="text-dark" title="Unduh Dokumen"><i class="bx bx-download h3 m-0"></i></a>
                                                                </div>
                                                            </td> -->
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <p class="mb-2; text-justify">Sistem Informasi Pusdahamnas disusun secara partisipatif dan transparan dengan melibatkan para pemangku kepentingan yaitu Kementerian, Lembaga Negara, Institusi HAM Nasional (NHRI), Organisasi Masyarakat Sipil, Pusat Studi HAM/Pusat Studi Universitas, dan Pekerja Media. Metode yang dilakukan melalui Workshop, Diskusi Kelompok Terfokus, Wawancara mendalam, Penyebaran survei secara online, studi literatur, kunjungan studi banding dan konsultasi. Adapun dokumen yang telah dihasilkan adalah Laporan Survei “Pemetaan Sumber Daya dalam Pembangunan Pusat Sumber Daya Hak Asasi Manusia”, Dokumen Grand Desain Pusdahamnas serta Dokumen Cetak Biru Pusdahamnas.</p>
                                        <?php
                                    }
                                    ?>
                                </div>
                                    <!--<div class="hori-timeline mt-0 mt-lg-0" style="text-align: center;margin-top: 8%;position: relative;">
                                       <img src="<?= base_url() ?>assets/img/podcast-.png" alt="Image" style="height: 140px;width: 180px;margin-bottom: 3%;">
                                    </div>-->
                            </div>
                        </div>
                       
                        <div class="col-lg-3">
                          <div class="card" id="pengguna3">
                                <div class="card-body">
                                    <div class="hori-timeline mt-0 mt-lg-0" style="text-align: center;margin-top: 8%;position: relative;">
                                       <img src="<?= base_url() ?>assets/img/laptop.png" alt="Image" style="height: 100%;width: 80%;margin-bottom: 3%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                      <div class="col-lg-6" style="margin-top: -15%;">  
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">MEDIA HAM</h4>
                                    <hr>
                                    <?php
                                    $lama=0;
                                    if ($lama==1)
                                    {
                                        ?>
                                        <div class="attached-file">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap table-centered table-hover mb-0">
                                                    <tbody>
                                                        <?php foreach ($data as $val) { ?>
                                                        <tr>
                                                            <!-- <td style="width: 45px;">
                                                                <div class="avatar-sm">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                                        <i class="bx bxs-file-doc"></i>
                                                                    </span>
                                                                </div>
                                                            </td> -->
                                                            <td>
                                                                <h5 class="font-size-14 mb-1"><a href="<?= $val['link'] ?>" target="_blank" class="text-dark"><?= $val['judul'] ?></a></h5>
                                                            </td>
                                                            <!-- <td>
                                                                <div class="text-center">
                                                                    <a href="#" class="text-dark" title="Unduh Dokumen"><i class="bx bx-download h3 m-0"></i></a>
                                                                </div>
                                                            </td> -->
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <p class="mb-2; text-justify">Sistem Informasi Pusdahamnas disusun secara partisipatif dan transparan dengan melibatkan para pemangku kepentingan yaitu Kementerian, Lembaga Negara, Institusi HAM Nasional (NHRI), Organisasi Masyarakat Sipil, Pusat Studi HAM/Pusat Studi Universitas, dan Pekerja Media. Metode yang dilakukan melalui Workshop, Diskusi Kelompok Terfokus, Wawancara mendalam, Penyebaran survei secara online, studi literatur, kunjungan studi banding dan konsultasi. Adapun dokumen yang telah dihasilkan adalah Laporan Survei “Pemetaan Sumber Daya dalam Pembangunan Pusat Sumber Daya Hak Asasi Manusia”, Dokumen Grand Desain Pusdahamnas serta Dokumen Cetak Biru Pusdahamnas.</p>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                       </div> 
                       
                        <div class="col-lg-3">
                          <div class="card" id="pengguna3">
                                <div class="card-body">
                                    <div class="hori-timeline mt-0 mt-lg-0" style="text-align: center;margin-top: 8%;position: relative;">
                                       <img src="<?= base_url() ?>assets/img/podcast.png" alt="Image" style="height: 140px;width: 180px;margin-bottom: 3%;">
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <!-- End Page-content -->

            <!-- Modal -->
           <!-- <div class="modal fade exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Preview Dokumen HAM</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="media mb-3">
                                <i class="bx bx-file font-size-24 mr-2"></i>

                                <div class="media-body overflow-hidden">
                                    <h5 class="limit-2-line-text font-size-15">June Medical Services, LLC, et al. v. Stephen Russo, Interim Secretary, Louisiana Department of Health and Hospitals</h5>
                                    <p class="text-muted limit-3-line-text mb-2">The applicants are parents of a child who died being treated at Burgas Multi-Profile Active Treatment Hospital. They alleged that the hospital’s failure to provide their daughter with adequate medical care led to her death, amounting to a breach of Article 2 of the European Convention on Human Rights.</p>
                                    <a class="btn btn-primary btn-sm" href="#">Lihat Detail Dokumen <i class="bx bx-right-arrow-alt"></i></a>
                                </div>
                            </div>

                            <div class="row modal-info">
                                <div class="col-sm-4 col-6">
                                    <div class="mt-4">
                                        <h5 class="font-size-14"><i class="bx bx-calendar mr-1 text-primary"></i> Diunggah</h5>
                                        <p class="text-muted mb-0">08 Oktober 2022</p>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mt-4">
                                        <h5 class="font-size-14"><i class="bx bx-hash mr-1 text-primary"></i> Kata Kunci</h5>

                                        <div class="tags">
                                            <a class="btn btn-primary btn-sm font-size-12" href="#">#Access to health care</a>
                                            <a class="btn btn-primary btn-sm font-size-12" href="#">#Access to treatment</a>
                                            <a class="btn btn-primary btn-sm font-size-12" href="#">#Children</a>
                                            <a class="btn btn-primary btn-sm font-size-12" href="#">#Emergency care</a>
                                            <a class="btn btn-primary btn-sm font-size-12" href="#">#Examination</a>
                                            <a class="btn btn-primary btn-sm font-size-12" href="#">#Health expenditures</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="card-title">Narasi / Fakta HAM :</h5>
    
                                <p class="text-muted">The applicants are parents of a child who died being treated at Burgas Multi-Profile Active Treatment Hospital. They alleged that the hospital’s failure to provide their daughter with adequate medical care led to her death, amounting to a breach of Article 2 of the European Convention on Human Rights.</p>
    
                                <div class="text-muted">
                                    <p class="mb-1"><i class="mdi mdi-chevron-right text-primary mr-1"></i> To achieve this, it would be necessary</p>
                                    <p class="mb-1"><i class="mdi mdi-chevron-right text-primary mr-1"></i> Separate existence is a myth.</p>
                                    <p class="mb-1"><i class="mdi mdi-chevron-right text-primary mr-1"></i> If several languages coalesce</p>
                                </div>
                            </div>

                            <div class="attached-file mt-4">
                                <h4 class="card-title mb-4">Dokumen Terlampir</h4>
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered table-hover mb-0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 45px;">
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                            <i class="bx bxs-file-doc"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">Landing.Zip</a></h5>
                                                    <small>Ukuran File : 3.25 MB</small>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="#" class="text-dark" title="Unduh Dokumen"><i class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                            <i class="bx bxs-file-doc"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">Admin.Zip</a></h5>
                                                    <small>Ukuran File : 3.15 MB</small>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="#" class="text-dark" title="Unduh Dokumen"><i class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                            <i class="bx bxs-file-doc"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">Logo.Zip</a></h5>
                                                    <small>Ukuran File : 2.02 MB</small>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="#" class="text-dark" title="Unduh Dokumen"><i class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="bx bx-x-circle mr-1"></i> Tutup</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="bx bx-download mr-1"></i> Unduh Semua Dokumen</button>
                        </div>
                    </div>
                </div>
            </div>-->
            <!-- end modal -->
          <!--  <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-body">
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>-->