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
<!--<div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Infografis HAM</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                                        <li class="breadcrumb-item active">Infografis HAM</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>-->
<!-- Title Page End -->
<?php
}
?>

<!--<div class="card" style="margin-bottom: 15px;">
                        <div class="card-body">
                            <h4 class="card-title font-size-24">Infografis HAM</h4>
                            <p class="mb-0">Pencarian Kosa Kata terkait HAM</p>
                             <form class="hero-search">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Pencarian Data Glossarium HAM" id="cari_kata" value="<?= $key ?>">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form> 
                        </div>
                    </div>-->
<!--<div class="container">
                        <div class="row" style="margin-top: 8%;">
                            <div class="col-md-12" id="hasil_cari">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= base_url('home/infografis') ?>" method="POST">
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                            <div class="nav-letter mb-4">
                                            <input class="btn <?= ($huruf==''||$huruf=='Semua')?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="Semua">
                                            <?php //foreach ($all_huruf as $hrf) { ?>
                                            <input class="btn <?= ($hrf==$huruf)?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="<?= $hrf ?>">
                                            <?php //} ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                            </div>
                    </div>-->
<div class="container mt-130" id="data_dokumen" name="data_dokumen" style="display: block;">
    <!-- <div class="row justify-content-center text-center">
        <div class="col-xl-6 col-lg-8 col-md-10">
            <div class="section-title mb-55">
                <h2>Infografis HAM Terbaru </h2>
            </div>
        </div>
    </div> -->
    <div class="row align-items-center">
      <?php foreach ($list_infografis as $info) {
            // var_dump($id_hak);
            $limited_text_judul = substr($info['judul'], 0, 20);
            if (strlen($info['judul']) > 20) {
              $limited_text_judul .= '...';
            }

            $limited_text_deskripsi = substr($info['judul'], 0, 30);
            if (strlen($info['deskripsi']) > 30) {
              $limited_text_deskripsi .= '...';
            }
            //1
            $infografis_id = $info['id']; // Ganti dengan kolom yang sesuai sebagai kunci
            $query_gambar = $this->db->get_where('image_infografis', array('infografis_id' => $infografis_id), 1);
            $gambar_infografis = $query_gambar->result_array();
			?>
            


      <div class="col-xl-4 col-md-6">
        <div class="blog-item wow fadeInUp delay-0-2s"> 
          <div class="image">
          <?php if (!empty($gambar_infografis) && isset($gambar_infografis[0]['nama_file'])) { ?>
                <img src="<?= base_url('uploads/infografis/'.$gambar_infografis[0]['nama_file']) ?>" alt="Deskripsi gambar">
            <?php } else { ?>
                <p>Tidak ada gambar tersedia</p>
            <?php } ?>

            <!-- <img id="img-infografis" src="<?= ($info['gambar']!="") ? base_url('uploads/infografis/'.$info['gambar'].'') : '' ?>" alt="Blog"> -->
          </div>
          <div class="blog-content">
            <h4><a href="<?= base_url('home/infografis_detail/'.encode_id($info['id'])) ?>"><?= $limited_text_judul ?></a></h4>

            <p><?=$limited_text_deskripsi ?></p>
          </div>
          <a href="<?= base_url('home/infografis_detail/'.encode_id($info['id'])) ?>" class="learn-more">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>

      <?php } ?>
      <div class="col-lg-12">
        <div class="news-more-btn text-center pt-30">
          <a href="#" class="theme-btn style-three">Lihat Semua Infografis <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-12 text-center mt-4 mt-md-5">
        <?php if (count($list_infografis)>0) {
            echo $pagging; 
            } else {
            echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
        } ?>
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
                        //siteHeader.removeClass("fixed-header");          
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