<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src https://*; child-src 'none';" />
<style>
  .myFont2 {
    font-size: 14px;
  }
  .holds-the-iframe {
      background: url("<?php echo base_url('/assets/gif/loading.gif');?>") center center no-repeat;
      position: fixed;
      left: 50%;
      top: 35%;
      z-index: 1000;
      height: 50px;
      width: 60px;
    }

   
</style>

<div class="row">
  <div class="col-12">
    <div class="card mb-5">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h4 class="card-title font-size-24" id="title_isu"></h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Data HAM</a></li>
            <li class="breadcrumb-item active" id="title_isu2"></li>
          </ol>
        </div>
      </div>
    </div> 
  </div>
  <br />
  <?php 
  $url_get = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  
      if($url_get=='http://devpusdahamnas.komnasham.go.id/'){
        echo "<script>alert('Website sedang dalam pengembangan')</script>";
      } 
  ?>

  <div class="col-12">
    <div class="card">
      <div class="card-body pt-5 pb-5 pl-3 pr-3">
        <iframe id="isu3" name="isu3" class="" style="margin-right: -0.2%;float: right;margin-top: -1%;display:none" width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/76232793-d12d-49c8-8bad-a9ceaf4594a6/page/p_qnxk2gjg9c" frameborder="0" style="border:0" allowfullscreen></iframe>
        <iframe id="isu4" name="isu4" class="" style="margin-right: -0.2%;float: right;margin-top: -1%;display:none" width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/c0714ee0-44eb-4ec7-a5d0-8abab85fe489/page/p_8trcqmbr9c" frameborder="0" style="border:0" allowfullscreen></iframe>
        <iframe id="isu8" name="isu8" class="" style="margin-right: -0.2%;float: right;margin-top: -1%;display:none" width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/5efb3301-67eb-4a4a-b6cc-5dfc03d8a017/page/SAMdD" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
  <!--<div id="loading_looker" class="holds-the-iframe" style="height: 30px;width: 30px;text-align: center;"></div>-->


  <!--<iframe id="isulooker" name="isulooker" class="" style="margin-right: -0.2%;float: right;margin-top: -1%;display:none" width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/4ef9c70c-0ca4-432d-8e42-5abf83757868/page/p_qf8egstl9c" frameborder="0" style="border:0" allowfullscreen></iframe>-->

  <!-- konflik agraria -->
  <!--<iframe id="agraria" name="agraria" class="" style="margin-right: -0.2%;float: right;margin-top: -1%;display:none" width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/76232793-d12d-49c8-8bad-a9ceaf4594a6/page/p_qnxk2gjg9c" frameborder="0" style="border:0" allowfullscreen></iframe>-->
</div>

<script type="text/javascript">
  //$( document ).ready(function() {
  //document.getElementById("snplooker").style.display = "none"; //hides the frame
  //document.getElementById("isulooker").style.display = "none"; //hides the frame
  document.getElementById("isu3").style.display = "block"; //hides the frame     
  document.getElementById("isu4").style.display = "none"; //hides the frame     
  document.getElementById("isu8").style.display = "none"; //hides the frame     
  //document.getElementById("agraria").style.display = "none"; //shows the frame
  document.getElementById('title_isu').innerHTML = 'Konflik agraria';
  document.getElementById('title_isu2').innerHTML = 'Konflik Agraria';
  //document.getElementById('agraria').contentDocument.location.reload(true);
  document.getElementById('isu3').contentDocument.location.reload(true);
  document.getElementById('isu4').contentDocument.location.reload(false);
  document.getElementById('isu8').contentDocument.location.reload(false);

  function getAgraria() {
    document.getElementById("isu3").style.display = "block"; //hides the frame     
    document.getElementById("isu4").style.display = "none"; //hides the frame     
    document.getElementById("isu8").style.display = "none"; //hides the frame     
    document.getElementById('title_isu').innerHTML = 'Konflik agraria';
    document.getElementById('isu3').contentDocument.location.reload(true);
    document.getElementById('isu4').contentDocument.location.reload(false);
    document.getElementById('isu8').contentDocument.location.reload(false);
  }

  function getDokumen() {
    document.getElementById("isu3").style.display = "none"; //hides the frame     
    document.getElementById("isu4").style.display = "none"; //hides the frame     
    document.getElementById("isu8").style.display = "none"; //hides the frame     
  }

  function getIsu() {
    document.getElementById("isu3").style.display = "none"; //hides the frame     
    document.getElementById("isu4").style.display = "none"; //hides the frame     
    document.getElementById("isu8").style.display = "none"; //hides the frame     
  }

  function getIsu1() {
    document.getElementById('title_isu').innerHTML = 'Pelanggaran HAM berat';
  }

  function getIsu2() {
    document.getElementById('title_isu').innerHTML = 'Permasalahan HAM papua';
  }

  function getIsu3() {
    document.getElementById("isu3").style.display = "block"; //hides the frame     
    document.getElementById("isu4").style.display = "none"; //hides the frame     
    document.getElementById("isu8").style.display = "none"; //hides the frame     
    document.getElementById('title_isu').innerHTML = 'Konflik agraria';
    document.getElementById('isu3').contentDocument.location.reload(true);
    document.getElementById('isu4').contentDocument.location.reload(false);
    document.getElementById('isu8').contentDocument.location.reload(false);
  }

  function getIsu4() {
    document.getElementById("isu3").style.display = "none"; //hides the frame     
    document.getElementById("isu4").style.display = "block"; //hides the frame     
    document.getElementById("isu8").style.display = "none"; //hides the frame     
    document.getElementById('title_isu').innerHTML = 'Kelompok marginal (disabilitas, pekerja migran, masyarakat adat, dan PRT)';
    document.getElementById('isu3').contentDocument.location.reload(false);
    document.getElementById('isu4').contentDocument.location.reload(true);
    document.getElementById('isu8').contentDocument.location.reload(false);
  }

  function getIsu5() {
    document.getElementById('title_isu').innerHTML = 'Perlindungan pembela HAM';
  }

  function getIsu6() {
    document.getElementById('title_isu').innerHTML = 'Kebebasan beragama & berkeyakinan';
  }

  function getIsu7() {
    document.getElementById('title_isu').innerHTML = 'Bisnis & HAM';
  }

  function getIsu8() {
    document.getElementById("isu3").style.display = "none"; //hides the frame       
    document.getElementById("isu4").style.display = "none"; //hides the frame
    document.getElementById("isu8").style.display = "block"; //hides the frame  
    document.getElementById('title_isu').innerHTML = 'Antisipasi pemilu 2024';
    document.getElementById('isu3').contentDocument.location.reload(false);
    document.getElementById('isu4').contentDocument.location.reload(false);
    document.getElementById('isu8').contentDocument.location.reload(true);
  }

  function getIsu9() {
    document.getElementById('title_isu').innerHTML = 'Pemantauan RANHAM 2024';
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
                                            <?php //foreach ($all_huruf as $hrf) { ?>
                                            <input class="btn <?= ($hrf==$huruf)?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="<?= $hrf ?>">
                                            <?php //} ?>
                                        </div>
                                    </form>
        
                                    <table class="table table-centered table-hover mb-0">
                                        <tbody>
                                        <?php //if($list_dokumen){ ?>
                                            <?php //foreach ($list_dokumen as $list) { ?>
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
                                                                //$show=0;
                                                                //if ($show==1)
                                                               // {
                                                                    ?>
                                                                <h4 class="card-title font-size-14 mb-3">Jenis Dokumen : <?= $list['nama_jenis'] ?></h4>
                                                                <h4 class="card-title font-size-14">Penjelasan Dokumen :</h4>
                                                                <p class="limit-2-line-text"><?= $list['nama_hak'] ?></p>
                                                                    <?php
                                                                //}
                                                                ?>
                                                            </div>
                                                            <?php
                                                                //$show=0;
                                                                //if ($show==1)
                                                                //{
                                                                    ?>
                                                            <div class="tags">
                                                                <h4 class="card-title font-size-14 mb-1">Kata Kunci :</h4>
                                                                <?php 
                                                               // $keyword = array_keys(extractCommonWords($list['nama_dokumen']));
                                                               // foreach ($keyword as $kata) { if ($kata!='0') { ?>
                                                                    <a class="link-underline font-size-12 mr-1 mb-1" href="javascript:;">#<?= $kata ?></a>
                                                                <?php //} }?>
                                                            </div>
                                                            <?php
                                                              //  }
                                                                ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php //} ?>
                                         <?php// }?>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-12 text-center mt-4 mt-md-5">
                                         <?php //if($list_dokumen){?>  
                                            <?php //if (count($list_dokumen)>0) {
                                            ///echo $pagging; 
                                            ///} else {
                                            ///echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                           // } ?>
                                          <?php //}?>  
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
                                     //if($agenda){
                                     // foreach ($agenda as $key => $value) {
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
                                    <?php //} 
                                      //}
                                    ?>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a href="<?=base_url('home/agenda')?>" class="btn btn-info btn-block"> <i class="fa fa-arrow-right"></i> Lihat semua agenda  </a>
                                </div>
                            </div>
                        <?php
                        //$showw=0;
                        //if ($showw==1)
                        //{
                            ?>
                            <hr>
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled chat-list">
                                    <div class="bg-primary rounded p-2">
                                        <h4 class="card-title text-white text-center mb-0">Glosarium Hak Asasi Manusia</h4>
                                    </div>
                                    <?php 
                                    //foreach ($glossary as $value) {
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
                                    <?php //} ?>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a href="<?=base_url('home/glossary')?>" class="btn btn-info btn-block"> <i class="fa fa-arrow-right"></i> Lihat semua kosa kata  </a>
                                </div>
                        </div>
                        <?php
                        //}
                        ?>
                        </div>-->
</div>