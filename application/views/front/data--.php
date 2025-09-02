<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<meta
  http-equiv="Content-Security-Policy"
  content="default-src 'self'; img-src https://*; child-src 'none';" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
                    <!-- Title Page Start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <?php
                                $show=0;
                                if ($show==1)
                                {
                                    ?>
                                <h4 class="mb-0 font-size-18">Database Hak Asasi Manusia</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                                        <li class="breadcrumb-item active">Database Hak Asasi Manusia</li>
                                    </ol>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Title Page End -->

                    <div class="card" style="margin-bottom: 15px;">
                        <div class="card-body">
                            <h4 class="card-title font-size-24">Database Hak Asasi Manusia</h4>
                            <p class="mb-0">Pencarian data, laporan, dokumen, dan ahli hak asasi manusiia.</p>

                            <form class="hero-search">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Pencarian Data HAM" id="cari_kata" value="<?= $key ?>">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form>
                        </div>
                    </div>

<!-- test lookerstudio --> 
<!--<div class="col-12" style="margin-left: -0.8%;float: left;">
    <iframe width="102%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/5efb3301-67eb-4a4a-b6cc-5dfc03d8a017/page/SAMdD" frameborder="0" style="border:0" allowfullscreen></iframe> 
</div>-->
<!--<div class="col-12" style="margin-left: -0.8%;float: left;">
  <iframe width="102%;" height="650px;" src="https://lookerstudio.google.com" frameborder="0" style="border:0" allowfullscreen></iframe> 
</div><br />-->
<!-- end -->
                    <div class="row">
 <style type="text/css">
.vertical-menu-looker {
  width: 200px; /* Set a width if you like */
}

.vertical-menu-looker a {
  background-color: #eee; /* Grey background color */
  color: black; /* Black text color */
  display: block; /* Make the links appear below each other */
  padding: 12px; /* Add some padding */
  text-decoration: none; /* Remove underline from links */
}

.vertical-menu-looker a:hover {
  background-color: #ccc; /* Dark grey background on mouse-over */
}

.vertical-menu-looker a.active {
  background-color: #04AA6D; /* Add a green color to the "active/current" link */
  color: white;
}
</style>      
        

                    <!-- test lookerstudio -->
                    <div class="col-12" style="margin-left: -0.05%;float: left;">
                        <div class="btn-group dropright" style="padding-top: -1%;margin-left: 0%;">
                            <button onclick="getAgraria()" type="button" class="btn btn-primary">
                              Beranda
                            </button>&nbsp;&nbsp;
                            <button onclick="getDokumen()" type="button" class="btn btn-primary">
                              SNP/Dokumen
                            </button>
                            <!--<div class="dropdown-menu">
                              <a class="dropdown-item" href="#">1. Penghapusan diskriminasi Ras dan Etnis</a>
                              <a class="dropdown-item" href="#">2. Hak atas kebebasan beragama dan berkeyakinan</a>
                              <a class="dropdown-item" href="#">3. Hak atas kebebasan berkumpul dan berorganisasi</a>
                              <a class="dropdown-item" href="#">4. Hak atas kesehatan</a>
                              <a class="dropdown-item" href="#">5. Hak atas kebebasan berpendapat dan berekpresi</a>
                              <a class="dropdown-item" href="#">6. Pembela HAM</a>
                              <a class="dropdown-item" href="#">7. HAM atas tanah dan sumber alam</a>
                              <a class="dropdown-item" href="#">8. Hak memperoleh keadilan</a>
                              <a class="dropdown-item" href="#">9. Pemulihan hak-hak korban pelanggaran HAM berat</a>
                              <a class="dropdown-item" href="#">10.Hak Untuk Bebas Dari Penyiksaan, Perlakuan Kejam, Tidak Manusiawi atau Merendahkan Martabat Manusia</a>
                              <a class="dropdown-item" href="#">11.Hak Atas Tempat Tinggal yang Layak</a>
                              <a class="dropdown-item" href="#">12.Pemilu (On going)</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">Separated link</a>
                            </div>-->&nbsp;&nbsp;
                            <button onclick="getIsu()" type="button" class="btn btn-primary">
                              Isu Prioritas
                            </button>
                            <!--<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="sr-only">Isu Prioritas</span>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="#">1. Pelanggaran HAM yang Berat</a>
                              <a class="dropdown-item" href="#">2. Permasalahan HAM Papua</a>
                              <a class="dropdown-item" href="#">3. Konflik Agraria</a>
                              <a class="dropdown-item" href="#">4. Kelompok marginal (disabilitas, pekerja migran, masyarakat adat, dan PRT)</a>
                              <a class="dropdown-item" href="#">5. Perlindungan Pembela HAM</a>
                              <a class="dropdown-item" href="#">6. Kebebasan Beragama & Berkeyakinan</a>
                              <a class="dropdown-item" href="#">7. Bisnis & HAM</a>
                              <a class="dropdown-item" href="#">8. Antisipasi Pemilu 2024</a>
                              <a class="dropdown-item" href="#">9. Pemantauan RANHAM 2022-2024</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">Separated link</a>
                            </div>-->
                        </div><br />
                      <!-- snp -->
                        <iframe id="snplooker" name="snplooker" class="" style="margin-right: -0.2%;float: right;margin-top: 1%;display:none" width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/4ef9c70c-0ca4-432d-8e42-5abf83757868/page/svpbD" frameborder="0" style="border:0" allowfullscreen></iframe>  
                    <br />    
                      <!-- isu prioritas -->
                        <iframe id="isulooker" name="isulooker" class="" style="margin-right: -0.2%;float: right;margin-top: -1%;display:none" width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/4ef9c70c-0ca4-432d-8e42-5abf83757868/page/p_qf8egstl9c" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <br />
                      <!-- konflik agraria -->
                        <iframe id="agraria" name="agraria" class="" style="margin-right: -0.2%;float: right;margin-top: -3%;display:block" width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/76232793-d12d-49c8-8bad-a9ceaf4594a6/page/p_qnxk2gjg9c" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
<script type="text/javascript">
//$( document ).ready(function() {
 document.getElementById("snplooker").style.display = "none"; //hides the frame
 document.getElementById("isulooker").style.display = "none"; //hides the frame
 document.getElementById("agraria").style.display = "block"; //shows the frame

    function getAgraria(){
        document.getElementById("snplooker").style.display = "none"; //hides the frame
        document.getElementById("isulooker").style.display = "none"; //hides the frame
        document.getElementById("agraria").style.display = "block"; //shows the frame
        var iframe = document.getElementById('agraria');
    iframe.style.display = 'block';
    }
    function getDokumen(){
        document.getElementById("snplooker").style.display = "block"; //hides the frame
        document.getElementById("isulooker").style.display = "none"; //hides the frame
        document.getElementById("agraria").style.display = "none"; //shows the frame
        var iframe = document.getElementById('agraria');
    iframe.style.display = 'none';
    }
    function getIsu(){
        document.getElementById("snplooker").style.display = "none"; //hides the frame
        document.getElementById("isulooker").style.display = "block"; //hides the frame
        document.getElementById("agraria").style.display = "none"; //shows the frame
        var iframe = document.getElementById('agraria');
    iframe.style.display = 'none';
    }
//});
</script>                    
                    <!--<div class="col-12" style="margin-left: -0.05%;float: left;">
                        <iframe width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/5efb3301-67eb-4a4a-b6cc-5dfc03d8a017/page/SAMdD" frameborder="0" style="border:0" allowfullscreen></iframe> 
                    </div>-->
                    <!-- end -->
                    <!--    <div class="col-lg-9" id="hasil_cari">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?= base_url('home/data') ?>" method="POST">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                        <div class="row align-items-center mb-4">
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
                                                    <select class="form-control select2" name="id_hak" id="pilih_hak">
                                                        <option value="" selected>Semua Topik Isu Hak </option>
                                                        <?php foreach ($ref_hak_dokumen as $ref) { ?>
                                                            <option value="<?= $ref['id_hak'] ?>" <?= ($ref['id_hak']==$id_hak?'selected':'') ?>><?= $ref['nama_hak'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
                                                    <select class="form-control select2" name="id_subyek" id="pilih_subyek">
                                                        <option value="" selected>Semua Topik Isu Subyek</option>
                                                        <?php foreach ($ref_subyek_dokumen as $ref) { ?>
                                                            <option value="<?= $ref['id_subyek'] ?>" <?= ($ref['id_subyek']==$id_subyek?'selected':'') ?>><?= $ref['nama_subyek'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
                                                    <select class="form-control select2" name="id_lembaga" id="pilih_lembaga">
                                                        <option value="" selected>Semua Mitra</option>
                                                        <?php foreach ($ref_lembaga as $ref) { ?>
                                                            <option value="<?= $ref['id'] ?>" <?= ($ref['id']==$id_lembaga?'selected':'') ?>><?= $ref['nama_lembaga'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary w-100 filter_pilihan">Cari Data</button>
                                            </div>
                                        </div>

                                        <div class="nav-letter mb-4">
                                            <input class="btn <?= ($huruf==''||$huruf=='Semua')?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="Semua">
                                            <?php foreach ($all_huruf as $hrf) { ?>
                                            <input class="btn <?= ($hrf==$huruf)?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="<?= $hrf ?>">
                                            <?php } ?>
                                        </div>
                                    </form>
        
                                    <table class="table table-centered table-hover mb-0">
                                        <tbody>
                                        <?php if($list_dokumen){ ?>
                                            <?php foreach ($list_dokumen as $list) { ?>
                                            <tr>
                                                <td>
                                                    <div class="d-md-flex">
                                                        
                                                        <div class="table-content ml-md-3" style="width:100%">
                                                            <h4 class="font-weight-semibold limit-2-line-text mb-3">
                                                                <i class="bx bxs-file-pdf h1"></i> <a class="link-underline link-title" href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>"><?= $list['nama_dokumen'] ?></a>
                                                            </h4>
        
                                                            <div class="mb-3">
                                                                <table style="width:100%">
                                                                    <tr>
                                                                        <td style="width:15%;padding:0.25rem"><b>Penerbit</b></td>
                                                                        <td style="width:5%;padding:0.25rem"><b>:</b></td>
                                                                        <td style="width:80%;padding:0.25rem"><b><?= $list['nama_lembaga'] ?></b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width:15%;padding:0.25rem"><b>Tahun Terbit</b></td>
                                                                        <td style="width:5%;padding:0.25rem"><b>:</b></td>
                                                                        <td style="width:80%;padding:0.25rem"><b><?= $list['tahun'] ?></b></td>
                                                                    </tr>
                                                                </table>
                                                                <?php
                                                                $show=0;
                                                                if ($show==1)
                                                                {
                                                                    ?>
                                                                <h4 class="card-title font-size-14 mb-3">Jenis Dokumen : <?= $list['nama_jenis'] ?></h4>
                                                                <h4 class="card-title font-size-14">Penjelasan Dokumen :</h4>
                                                                <p class="limit-2-line-text"><?= $list['nama_hak'] ?></p>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php
                                                                $show=0;
                                                                if ($show==1)
                                                                {
                                                                    ?>
                                                            <div class="tags">
                                                                <h4 class="card-title font-size-14 mb-1">Kata Kunci :</h4>
                                                                <?php 
                                                                $keyword = array_keys(extractCommonWords($list['nama_dokumen']));
                                                                foreach ($keyword as $kata) { if ($kata!='0') { ?>
                                                                    <a class="link-underline font-size-12 mr-1 mb-1" href="javascript:;">#<?= $kata ?></a>
                                                                <?php } }?>
                                                            </div>
                                                            <?php
                                                                }
                                                                ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                         <?php }?>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-12 text-center mt-4 mt-md-5">
                                         <?php if($list_dokumen){?>  
                                            <?php if (count($list_dokumen)>0) {
                                            echo $pagging; 
                                            } else {
                                            echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                            } ?>
                                          <?php }?>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        
                        
                       <!-- <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled chat-list">
                                    <div class="bg-primary rounded p-2 mb-3">
                                        <h4 class="card-title text-white text-center mb-0">Kalender Kegiatan Mitra Pusdahamnas</h4>
                                    </div>
                                    <?php 
                                     if($agenda){
                                      foreach ($agenda as $key => $value) {
                                     ?>
                                        <li class="active">
                                            <a href="<?=base_url('home/detail_agenda/'.encode_id($value->id_event))?>">
                                                <div class="media">
                                                    <div class="mr-2">
                                                        <i class="bx bx-calendar font-size-18"></i>
                                                    </div>
                                                    
                                                    <div class="media-body overflow-hidden pr-3">
                                                        <h5 class="limit-3-line-text font-size-15 mb-2"> <?=$value->judul?></h5>
                                                        <div class="font-size-10 mb-2"><i class="bx bx-calendar"></i><?=date_to_id(get_date($value->start))?></div>
                                                        <h6 class="font-size-12 mb-0">Format Event: <?=$value->format?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } 
                                      }
                                    ?>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a href="<?=base_url('home/agenda')?>" class="btn btn-info btn-block"> <i class="fa fa-arrow-right"></i> Lihat semua agenda  </a>
                                </div>
                            </div>
                        <?php
                        $showw=0;
                        if ($showw==1)
                        {
                            ?>
                            <hr>
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled chat-list">
                                    <div class="bg-primary rounded p-2">
                                        <h4 class="card-title text-white text-center mb-0">Glosarium Hak Asasi Manusia</h4>
                                    </div>
                                    <?php 
                                    foreach ($glossary as $value) {
                                     ?>
                                        <li class="active">
                                            <a href='#' onclick="return false;">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden pr-3">
                                                        <hr>
                                                        <h5 class="font-size-15 mb-2"> <?=$value->judul?></h5>
                                                        <hr>
                                                        <p class="font-size-12 mb-1" style="text-align: justify;"> <?=$value->deskripsi?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a href="<?=base_url('home/glossary')?>" class="btn btn-info btn-block"> <i class="fa fa-arrow-right"></i> Lihat semua kosa kata  </a>
                                </div>
                        </div>
                        <?php
                        }
                        ?>
                        </div>-->
                    </div>