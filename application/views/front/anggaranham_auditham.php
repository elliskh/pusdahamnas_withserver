<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2 {
        font-size: 14px;
    }
</style>
<?php
$show=0;
if ($show==1)
{
    ?>
<!-- Title Page Start -->
<!-- Title Page End -->
<?php
}
?>

<!--<div class="card" style="margin-bottom: 15px;margin-top: 8%;"> 
                        <div class="card-body">
                            <h6 class="card-title font-size-16">Pencarian data anggaran ramah HAM</h6>
                             <form class="hero-search">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Masukkan kata kunci" id="anggaranham_cari_kata" value="<?= $key ?>">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form> 
                        </div>
                    </div>-->
<section class="about-page-section rel z-1 rpt-100">
    <div class="container">
        <!--<ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url() ?>" class="breadcrumb-link"><span><i class="fas fa-home"></i> Beranda</span></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#" class="breadcrumb-link active"><span><i class="far fa-chart-bar"></i> Anggaran Dan Audit HAM</span></a>
                                </li>
                            </ul>-->

        <div class="row align-items-center" style="padding-top:80px;">
            <div class="col-xl-5 col-lg-6">
                <div class="about-page-content rmb-65 wow fadeInLeft delay-0-2s" style="padding-top:30px;">
                    <div class="section-title mb-25">
                        <span class="sub-title">Penilain HAM dan Anggaran Ramah HAM</span>
                        <h2>Paham Penilain HAM dan Anggaran Ramah HAM</h2>
                    </div>
                    <p>Kenali kegunaan penilain ham dan anggaran ramah ham untuk memastikan alokasi dana yang sesuai dengan nilai-nilai hak asasi manusia, menjaga keadilan, dan mendukung pembangunan berkelanjutan yang inklusif.</p>
                </div>
                <a href="#info__ham" class="btn btn-outline-primary" style="scroll-behaviour:smooth">Pelajari Selengkapnya <i class="fas fa-arrow-circle-down"></i></a>
            </div>
            <div class="col-xl-7 col-lg-7">
                <div class="d-flex justify-content-lg-end wow fadeInRight delay-0-2s">
                    <!--<img src="<?= base_url() ?>uploads/gambar_slide/Anggaran_Ramah.webp" alt="Anggaran Ramah Ham" style="width:70%;height:70%;">-->
                    <?php
       					foreach ($this->db->where('is_active','1')->get('tb_image_anggaran_ham')->result_array() as $gbr){?>							    
                       <div class="swiper-slide" style="width: 60%;height:60%;padding-top:30px;"><img src="<?= base_url() ?>uploads/gambar_slide/<?=$gbr['gambar']?>" class="gambar-Dokumen"></div>                        
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section End -->
<div class="container">
    <div class="row">
        <div class="col-lg-12" id="rasetnis_hasil_cari">
            <!--<div class="card" style="margin-bottom: 2px;margin-top: 0px;">
                                <div class="card-body">
                                    <h3 class="card-title font-size-24 mb-3">Data Anggaran ramah HAM</h3>        
                                    <table class="table table-centered table-hover mb-0">
                                        <tbody>
                                            <?php 
                                            $no = 0;
                                            //foreach ($list_anggaranham as $list) { ?>
                                            <tr>            
                                                <td>
                                                    <div class="d-md-flex">
                                                        <div class="table-content ml-md-12">
                                                            <h4 class="font-weight-semibold limit-2-line-text mb-3" style="text-align: center;">
                                                                <a class="link-underline link-title"><?= $list['instansi'] ?></a>
                                                                ANGGARAN RAMAH HAM
                                                            </h4>-->
            <!-- detail -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
            <!--<button id="toggle_all_<?=$list['id_anggaran']?>" class="btn btn-primary" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="<?=$list['id_anggaran']?>">Detail >></button>
                                                             -->
            <!--<div class="row">
                                                                <div class="col">
                                                                  <!--<div class="collapse multi-collapse_<?=$list['id_anggaran']?>"  style="width:1240px" id="<?=$list['id_anggaran']?>">        
                                                                        <div style="overflow-x: auto;">
                                                                         <div class="table-responsive-" data-pattern="priority-columns">
                                                                            <table style="width: 100%;">
                                                                                <col style="width: 40%;" />
                                                                                <col style="width: 60%;" />
                                                                        <?php  
                                                                           ///$where = "id_anggaran = $list[id_anggaran]";
                                                                           $no = 0;
                                                                           $isi_bab = '';
                                                                            foreach (
                                                                                $this->db->where('id_anggaran', $list['id_anggaran'])
                                                                                      //->group_by('bab')
                                                                                      ->get('tb_anggaran_ham_detail')
                                                                                      ->result_array() as $row)
                                                                            { $no += 1;                                                                         
                                                                                ?>
                                                                               
                                                                               <?php if($no == 1){?>
                                                                               <thead class="head_w text-black" style="background-color: #ededed;">
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: center;">INDIKATOR</th>
                                                                                        <th colspan="2" style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;YA&nbsp;&nbsp;&nbsp;</th>
                                                                                        <th colspan="2" style="text-align: center;">TIDAK</th>
                                                                                    </tr>
                                                                                </thead>                                                                                
                                                                                <tbody>
                                                                                
                                                                                <?php }?>                                                                                    
                                                                                    <tr>
                                                                                    <?php if($isi_bab != $row['bab']){ 
                                                                                         $isi_bab = $row['bab'];; 
                                                                                         $rows_span = 0;
                                                                                       foreach(
                                                                                        $this->db->where('bab', $row['bab'])
                                                                                          ->get('tb_anggaran_ham_detail')
                                                                                          ->result_array() as $rowx)
                                                                                        {
                                                                                            $rows_span += 1;
                                                                                            
                                                                                        }
                                                                                      ?>     
                                                                                        <td rowspan="<?php echo $rows_span;?>">&nbsp;<?= $row['bab']?></td>
                                                                                    <?php }
                                                                                      
                                                                                    
                                                                                    ?>  
                                                                                        <td><?= $row['deskripsi']?></td>
                                                                                        <?php 
                                                                                        $status = '';
                                                                                        if($row['ya_tidak']==1){ ?>
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="ya" value="" checked="" onclick="return false;"></td>                         
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="tidak" value="" onclick="return false;"></td>
                                                                                       <?php }else{?>                             
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="tidak" value="" onclick="return false;"></td>    
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="ya" value="" checked="" onclick="return false;"></td>                                                                                                                                              
                                                                                       <?php }?>
                                                                                    </tr>
                                                                            
                                                                        <?php         
                                                                                //echo "</div>";
                                                                            }                                                                                    
                                                                         ?>  

                                                                                </tbody>
                                                                            </table>
                                                                          </div>  
                                                                        </div>      
                                                                  </div> -->
            <p>
                <!--<strong>TUJUAN:</strong><br />
1) Tersedianya indikator anggaran ramah HAM serta rekomendasi atas RAPBN sebagai informasi bagi masyarakat sipil tentang hubungan relasi HAM dengan proses anggaran dan keputusan penggunaan anggaran/ RAPBN yang ditetapkan sehingga masyarakat sipil dapat meminta dapat pertanggungjawaban pemerintah atas realisasi hak-hak mereka.<br />
2) Tersedianya panduan bagi pejabat pemerintah serta pemangku kebijakan untuk dapat mengembangkan serta menerapkan peningkatan alokasi anggaran yang ramah HAM serta melaksanakan pengeluaran yang direncanakan dan menilai dampak anggaran terhadap pemenuhan HAM.<br />
3) Terwujudnya pengelolaan anggaran ramah HAM dalam RAPBN untuk mewujudkan pemenuhan hak asasi manusia.
                                                                  </p>
                                                                </div>
                                                              </div>
                                                            <script type="text/javascript">
                                                                var toggle_all = $('#toggle_all_<?=$list['id_anggaran']?>')
                                                                
                                                                toggle_all.on('click', function(e) {
                                                                    
                                                                  if (toggle_all.attr("aria-expanded") === 'false') {
                                                                    $('.multi-collapse_<?=$list['id_anggaran']?>').collapse('show');                                                                    
                                                                    toggle_all.attr('aria-expanded', 'true'); 
                                                                    return false;                                                              
                                                                  } else {
                                                                    $('.multi-collapse_<?=$list['id_anggaran']?>').collapse('hide');
                                                                    toggle_all.attr('aria-expanded', 'false');
                                                                  }
                                                                });
                                                            </script>-->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                <!-- </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php //} ?>
                                        </tbody>
                                    </table>-->

                <style>
                    table,
                    th,
                    td {
                        border: 1px solid #fff;
                        border-collapse: collapse;
                    }

                    table {
                        width: 50%;
                    }

                    table.fixed {
                        table-layout: fixed;
                    }

                    table.fixed td {
                        overflow: hidden;
                    }
                </style>

                <!-- <div class="row">
                                        <div class="col-12 text-center mt-4 mt-md-5">
                                            <?php if (count($list_anggaranham)>0) {
                                            echo $pagging; 
                                            } else {
                                            echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                <!-- audit ham -->
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                <style>
                    .myFont2 {
                        font-size: 14px;
                    }
                </style>
                <?php
$show=0;
if ($show==1)
{
    ?>
                <!-- Title Page Start -->
                <!-- Title Page End -->
                <?php
}
?>

                <!--<div class="card" style="margin-bottom: 15px;margin-top: 8%;">
                        <div class="card-body">
                            <h6 class="card-title font-size-16">Pencarian data audit HAM</h6>
                             <form class="hero-search">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Masukkan kata kunci" id="auditham_cari_kata" value="<?= $key ?>">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form> 
                        </div>
                    </div>-->
                <h2 class="text-bolder text-center mb-4" id="info__ham">Anggaran Ramah Ham</h2>
                <div class="row" style="margin-top:8%">
                    <div class="col-md-6" id="rasetnis_hasil_cari">
                        <div class="card">
                            <div class="card-body">
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
                                <h3 class="card-title font-size-24 mb-3">Apa itu Anggaran Ramah HAM</h3>
                                <table class="table table-centered table-hover mb-0">
                                    <tbody>
                                        <?php
                                            $no = 0;
                                            foreach ($list_anggaranham as $list) { ?>

                                        <tr>
                                            <td>
                                                <div class="d-md-flex">
                                                    <div class="table-content ml-md-12">
                                                        <h4 class="font-weight-semibold limit-2-line-text mb-3" style="text-align: center;">
                                                            <!--<a class="link-underline link-title"><?= $list['instansi'] ?></a>-->
                                                            <!--Apa itu Anggaran Ramah HAM-->
                                                        </h4>
                                                        <div class="row">
                                                            <div class="col" style="height:280px">
                                                                <strong>Pemahaman Anggaran Ramah HAM</strong><br />
                                                                Anggaran ramah ham untuk memastikan alokasi dana yang sesuai dengan nilai-nilai hak asasi manusia, menjaga keadilan, dan mendukung pembangunan berkelanjutan yang inklusif.<br />
                                                                .
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="rasetnis_hasil_cari">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title font-size-24 mb-3">Latar Belakang</h3>
                                <table class="table table-centered table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-md-flex">
                                                    <div class="table-content ml-md-12">
                                                        Anggaran ramah ham untuk memastikan alokasi dana yang sesuai dengan nilai-nilai hak asasi manusia, menjaga keadilan, dan mendukung pembangunan berkelanjutan yang inklusif.

                                                    </div>
                                                    <!-- SCRIPT ORIGINAL -->

                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3" id="rasetnis_hasil_cari">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title font-size-24 mb-3">Tujuan Anggaran Ramah Ham</h3>
                                <table class="table table-centered table-hover mb-0">
                                    <tbody>
                                        <?php 
                                            $no = 0;
                                            //foreach ($list_auditham as $list) { ?>
                                        <tr>
                                            <td>
                                                <div class="d-md-flex">
                                                    <div class="table-content ml-md-12">
                                                        <h4 class="font-weight-semibold limit-2-line-text mb-3" style="text-align: center;">
                                                            <!--<a class="link-underline link-title"><?= $list['instansi'] ?></a>-->
                                                            <!--Tujuan Anggaran Ramah Ham-->
                                                        </h4>
                                                        <!-- detail -->
                                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
                                                        <!--<button id="toggle_all_<?=$list['id_audit']?>" class="btn btn-primary" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="<?=$list['id_audit']?>">Detail >></button>
                                                             -->
                                                        <div class="row">
                                                            <div class="col">
                                                                <!-- <div class="collapse multi-collapse_<?=$list['id_audit']?>"  style="width:1240px" id="<?=$list['id_audit']?>">        
                                                                        <div style="overflow-x: auto;">
                                                                         <div class="table-responsive-" data-pattern="priority-columns">
                                                                            <table style="width: 100%;">
                                                                                <col style="width: 40%;" />
                                                                                <col style="width: 60%;" />
                                                                        <?php  
                                                                           $no = 0;
                                                                           $isi_bab = '';
                                                                            foreach (
                                                                                $this->db->where('id_audit', $list['id_audit'])
                                                                                      //->group_by('bab')
                                                                                      ->get('tb_audit_ham_detail')
                                                                                      ->result_array() as $row)
                                                                            { $no += 1; 
                                                                                                                                                   
                                                                                ?>
                                                                               
                                                                               <?php if($no == 1){?>
                                                                               <thead class="head_w text-black" style="background-color: #ededed;">
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: center;">INDIKATOR</th>
                                                                                        <th colspan="2" style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;YA&nbsp;&nbsp;&nbsp;</th>
                                                                                        <th colspan="2" style="text-align: center;">TIDAK</th>
                                                                                    </tr>
                                                                                </thead>                                                                                
                                                                                <tbody>
                                                                                
                                                                                <?php }?>                                                                                    
                                                                                    <tr>
                                                                                    <?php if($isi_bab != $row['bab']){ 
                                                                                         $isi_bab = $row['bab'];; 
                                                                                         $rows_span = 0;
                                                                                       foreach(
                                                                                        $this->db->where('bab', $row['bab'])
                                                                                          ->get('tb_audit_ham_detail')
                                                                                          ->result_array() as $rowx)
                                                                                        {
                                                                                            $rows_span += 1;
                                                                                            
                                                                                        }
                                                                                      ?>     
                                                                                        <td rowspan="<?php echo $rows_span;?>">&nbsp;<?= $row['bab']?></td>
                                                                                    <?php }
                                                                                      
                                                                                    
                                                                                    ?>  
                                                                                        <td><?= $row['deskripsi']?></td>
                                                                                        <?php 
                                                                                        $status = '';
                                                                                        if($row['ya_tidak']==1){ ?>
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="ya" value="" checked="" onclick="return false;"></td>                         
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="tidak" value="" onclick="return false;"></td>
                                                                                       <?php }else{?>                             
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="tidak" value="" onclick="return false;"></td>    
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="ya" value="" checked="" onclick="return false;"></td>                                                                                                                                              
                                                                                       <?php }?>
                                                                                    </tr>
                                                                            
                                                                        <?php         
                                                                                //echo "</div>";
                                                                            }                                                                                    
                                                                         ?>  

                                                                                </tbody>
                                                                            </table>
                                                                          </div>  
                                                                        </div>      
                                                                  </div>  -->
                                                                <strong>TUJUAN:</strong><br />
                                                                1) Tersedianya indikator anggaran ramah HAM serta rekomendasi atas RAPBN sebagai informasi bagi masyarakat sipil tentang hubungan relasi HAM dengan proses anggaran dan keputusan penggunaan anggaran/ RAPBN yang ditetapkan sehingga masyarakat sipil dapat meminta dapat pertanggung jawaban
                                                                pemerintah atas realisasi hak-hak mereka.<br />
                                                                2) Tersedianya panduan bagi pejabat pemerintah serta pemangku kebijakan untuk dapat mengembangkan serta menerapkan peningkatan alokasi anggaran yang ramah HAM serta melaksanakan pengeluaran yang direncanakan dan menilai dampak anggaran terhadap pemenuhan HAM.<br />
                                                                3) Terwujudnya pengelolaan anggaran ramah HAM dalam RAPBN untuk mewujudkan pemenuhan hak asasi manusia.
                                                            </div>
                                                        </div>

                                                        <script type="text/javascript">
                                                            var toggle_all = $('#toggle_all_<?=$list['
                                                                id_anggaran ']?>')

                                                            toggle_all.on('click', function (e) {

                                                                if (toggle_all.attr("aria-expanded") === 'false') {
                                                                    $('.multi-collapse_<?=$list['
                                                                        id_anggaran ']?>').collapse('show');
                                                                    toggle_all.attr('aria-expanded', 'true');
                                                                    return false;
                                                                } else {
                                                                    $('.multi-collapse_<?=$list['
                                                                        id_anggaran ']?>').collapse('hide');
                                                                    toggle_all.attr('aria-expanded', 'false');
                                                                }
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php //} ?>
                                    </tbody>
                                </table>
                            </div>

                            <style>
                                table,
                                th,
                                td {
                                    border: 1px solid #fff;
                                    border-collapse: collapse;
                                }

                                table {
                                    width: 50%;
                                }

                                table.fixed {
                                    table-layout: fixed;
                                }

                                table.fixed td {
                                    overflow: hidden;
                                }
                            </style>


                            <div class="row">
                                <div class="col-12 text-center mt-4 mt-md-5">
                                    <?php 
                                            /*if (count($list_auditham)>0) {
                                            echo $pagging; 
                                            } else {
                                            echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                            } */
                                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <h2 class="text-bolder text-center" style="margin-top:4%;margin-bottom:4%" id="info__ham">Penilaian Ham</h2>
    <div class="row" style="margin-bottom: 15px;">
        <div class="col-md-6" id="rasetnis_hasil_cari">
            <div class="card">
                <div class="card-body">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
                    <h3 class="card-title font-size-24 mb-3">Apa itu Penilaian HAM?</h3>
                    <table class="table table-centered table-hover mb-0">
                        <tbody>
                            <?php
                                            $no = 0;
                                            //foreach ($list_auditham as $list) { ?>

                            <tr>
                                <td>
                                    <div class="d-md-flex">
                                        <div class="table-content ml-md-12">
                                            <h4 class="font-weight-semibold limit-2-line-text mb-3" style="text-align: center;">
                                                <!--<a class="link-underline link-title"><?= $list['instansi'] ?></a>-->
                                                <!--Apa itu Anggaran Ramah HAM-->
                                            </h4>
                                            <div class="row">
                                                <div class="col" style="height:280px">
                                                    <strong>Apa itu Penilaian HAM?</strong><br />
                                                    Penilaian HAM merupakan proses pemeriksaan yang terencana dan sistematis atas berbagai aspek hukum dan perundang-undangan yang telah diambil oleh Intansi Negara yang berpotensi melanggar HAM sesuai standar HAM.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!--<?php //} ?>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title font-size-24 mb-3">Latar Belakang</h3>
                    <table class="table table-centered table-hover mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-md-flex">
                                        <div class="table-content ml-md-12">
                                            Sampai dengan saat ini belum terdapat metode yang dapat mengukur kepatuhan atas prinsip-prinsip hak asasi manusia yang di selenggarakan secara komperhenship dan berkelanjutan yang mampu mendorong Negara untuk semakin patuh akan kewajibanya terhadap hak asasi manusia.
                                            Keberadaan Komnas HAM dalam mengusung program penilaian HAM, merupakan kontribusi nyata dan sebagai rujukan bagi para aparatur negara untuk melakukan upaya pencegahan terhadap potensi pelanggaran HAM yang dilakukan oleh aparatur negara di Intansi Negara.
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3" id="auditham_hasil_cari">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title font-size-24 mb-3">Tujuan Penilaian HAM:</h3>
                    <table class="table table-centered table-hover mb-0">
                        <tbody>
                            <?php 
                                            $no = 0;
                                            //foreach ($list_auditham as $list) { ?>
                            <tr>
                                <td>
                                    <div class="d-md-flex">
                                        <div class="table-content ml-md-12">
                                            <h4 class="font-weight-semibold limit-2-line-text mb-3" style="text-align: center;">
                                                <!--<a class="link-underline link-title"><?= $list['instansi'] ?></a>-->
                                                <!--Tujuan Anggaran Ramah Ham-->
                                            </h4>
                                            <!-- detail -->
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
                                            <!--<button id="toggle_all_<?=$list['id_audit']?>" class="btn btn-primary" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="<?=$list['id_audit']?>">Detail >></button>
                                                             -->
                                            <div class="row">
                                                <div class="col">
                                                    <!-- <div class="collapse multi-collapse_<?=$list['id_audit']?>"  style="width:1240px" id="<?=$list['id_audit']?>">        
                                                                        <div style="overflow-x: auto;">
                                                                         <div class="table-responsive-" data-pattern="priority-columns">
                                                                            <table style="width: 100%;">
                                                                                <col style="width: 40%;" />
                                                                                <col style="width: 60%;" />
                                                                        <?php  
                                                                           $no = 0;
                                                                           $isi_bab = '';
                                                                            foreach (
                                                                                $this->db->where('id_audit', $list['id_audit'])
                                                                                      //->group_by('bab')
                                                                                      ->get('tb_audit_ham_detail')
                                                                                      ->result_array() as $row)
                                                                            { $no += 1; 
                                                                                                                                                   
                                                                                ?>
                                                                               
                                                                               <?php if($no == 1){?>
                                                                               <thead class="head_w text-black" style="background-color: #ededed;">
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: center;">INDIKATOR</th>
                                                                                        <th colspan="2" style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;YA&nbsp;&nbsp;&nbsp;</th>
                                                                                        <th colspan="2" style="text-align: center;">TIDAK</th>
                                                                                    </tr>
                                                                                </thead>                                                                                
                                                                                <tbody>
                                                                                
                                                                                <?php }?>                                                                                    
                                                                                    <tr>
                                                                                    <?php if($isi_bab != $row['bab']){ 
                                                                                         $isi_bab = $row['bab'];; 
                                                                                         $rows_span = 0;
                                                                                       foreach(
                                                                                        $this->db->where('bab', $row['bab'])
                                                                                          ->get('tb_audit_ham_detail')
                                                                                          ->result_array() as $rowx)
                                                                                        {
                                                                                            $rows_span += 1;
                                                                                            
                                                                                        }
                                                                                      ?>     
                                                                                        <td rowspan="<?php echo $rows_span;?>">&nbsp;<?= $row['bab']?></td>
                                                                                    <?php }
                                                                                      
                                                                                    
                                                                                    ?>  
                                                                                        <td><?= $row['deskripsi']?></td>
                                                                                        <?php 
                                                                                        $status = '';
                                                                                        if($row['ya_tidak']==1){ ?>
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="ya" value="" checked="" onclick="return false;"></td>                         
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="tidak" value="" onclick="return false;"></td>
                                                                                       <?php }else{?>                             
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="tidak" value="" onclick="return false;"></td>    
                                                                                        <td colspan="2" style="text-align: center;">&nbsp;<input type="checkbox" name="ya" value="" checked="" onclick="return false;"></td>                                                                                                                                              
                                                                                       <?php }?>
                                                                                    </tr>
                                                                            
                                                                        <?php         
                                                                                //echo "</div>";
                                                                            }                                                                                    
                                                                         ?>  

                                                                                </tbody>
                                                                            </table>
                                                                          </div>  
                                                                        </div>      
                                                                  </div>  -->
                                                    <strong>Tujuan Penilaian HAM:</strong><br />
                                                    Mendorong agar Instansi Negara mampu mewujudkan kewajiban menghormati, memenuhi dan melindungi HAM setiap warga negara secara optimal.
                                                </div>
                                            </div>

                                            <script type="text/javascript">
                                                var toggle_all = $('#toggle_all_<?=$list['
                                                    id_audit ']?>')

                                                toggle_all.on('click', function (e) {

                                                    if (toggle_all.attr("aria-expanded") === 'false') {
                                                        $('.multi-collapse_<?=$list['
                                                            id_audit ']?>').collapse('show');
                                                        toggle_all.attr('aria-expanded', 'true');
                                                        return false;
                                                    } else {
                                                        $('.multi-collapse_<?=$list['
                                                            id_audit ']?>').collapse('hide');
                                                        toggle_all.attr('aria-expanded', 'false');
                                                    }
                                                });
                                            </script>
                                            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                                            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                                            <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <?php //} ?>
                        </tbody>
                    </table>
                </div>

                <style>
                    table,
                    th,
                    td {
                        border: 1px solid #fff;
                        border-collapse: collapse;
                    }

                    table {
                        width: 50%;
                    }

                    table.fixed {
                        table-layout: fixed;
                    }

                    table.fixed td {
                        overflow: hidden;
                    }
                </style>


                <div class="row">
                    <div class="col-12 text-center mt-4 mt-md-5">
                        <?php 
                                            /*if (count($list_auditham)>0) {
                                            echo $pagging; 
                                            } else {
                                            echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                            } */
                                            ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title font-size-24 mb-3">Landasan Di Bentuknya Penilaian HAM</h3>
                                <table class="table table-centered table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <th>
                                                1. Filosofis
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                Setiap warga negara memiliki HAM yang melekat karena harkat dan martabatnya sebagai manusia. Oleh karena itu, adalah kewajiban utama dari Negara sebagai pemangku kewajiban untuk secara terus-menerus penghormatan, perlindungan, dan pemenuhan HAM
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                2. Yuridis
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                HAM telah diakui dijamin oleh Hukum Hak Asasi Manusia Nasional dan Hukum Hak Asasi Manusia International
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                3. Empiris
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                Komnas HAM RI masih menerima berbagai pengaduan dari masyarakat terkait indikasi pelanggaran hak asasi manusia dari berbagai klasifikasi hak.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
</div>
</div>
</div>
</div>
<script>
    function headerStyle() {
        if ($(".main-header").length) {
            var windowpos = $(window).scrollTop();
            var siteHeader = $(".main-header");
            var siteNav = $("a");
            var scrollLink = $(".scroll-top");
            const gambar = document.getElementById('logo-img');
            if (windowpos <= 100) {
                siteHeader.addClass("fixed-header");
                siteNav.addClass("text-custom");
                gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                gambar.alt = 'gambar baru';
                scrollLink.fadeIn(300);
            } else {
                siteHeader.addClass("fixed-header");
                siteNav.addClass("text-custom");
                gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                gambar.alt = 'gambar baru';
                scrollLink.fadeOut(300);
            }
        }
    }

    headerStyle();

    $(document).ready(function () {

        $(window).on("scroll", function () {
            // Header Style and Scroll to Top
            function headerStyle() {
                if ($(".main-header").length) {
                    var windowpos = $(window).scrollTop();
                    var siteHeader = $(".main-header");
                    var siteNav = $("a");
                    var scrollLink = $(".scroll-top");
                    const gambar = document.getElementById('logo-img');
                    if (windowpos >= 100) {
                        siteHeader.addClass("fixed-header");
                        siteNav.addClass("text-custom");
                        gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                        gambar.alt = 'gambar baru';
                        scrollLink.fadeIn(300);
                    } else {
                        siteHeader.removeClass("fixed-header");
                        siteNav.addClass("text-custom");
                        //siteNav.removeClass("text-custom");
                        gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                        gambar.alt = 'gambar baru';
                        scrollLink.fadeOut(300);
                    }
                }
            }

            headerStyle();
        });
    });
</script>