<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/swiper-slider.css" />

<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/style_index.css" />

<!-- <style>
  .box-counter {
    display: -webkit-box;
    display: flex;
    -webkit-box-orient: horizontal;
    width: 100%;
    flex-flow: row wrap
  }

  .counter {
    padding: 0 30px 0 0;
    -webkit-box-flex: 1;
    -flex: 1 1 25%;
    flex: 1 1 25%;
    max-width: 25%;
    box-sizing: border-box;
    color: var(--dark);
    text-align: center;
    position: relative;
    z-index: 1;
    display: -webkit-box;
    display: -flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -flex-align: center;
    align-items: center;
    -webkit-transition: .5s;
    -o-transition: .5s;
    transition: .5s
  }

  .counter:nth-of-type(4n+0) {
    padding-right: 0
  }

  .counter .counter-timer {
    font-weight: 700;
    font-size: 40px
  }

  .counter .counter-title {
    font-size: 18px;
    margin: 0
  }

  .counter #percent::after {
    content: "";
    font-size: 35px;
    font-weight: 600
  }

  h5.counter-number {
    margin-top: 20px;
    margin-bottom: 0
  }
  .counter .counter-content {
    position: relative;
    width: 80px;
    height: 80px;
    display: -webkit-box;
    display: flex;
    -webkit-box-align: center;
    -flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -flex-pack: center;
    justify-content: center;
    font-size: 32px;
    color: var(--purple);
    margin-bottom: 35px;
    -webkit-transform: translateY(0);
    -transform: translateY(0);
    transform: translateY(0);
    -webkit-transition: .5s;
    -o-transition: .5s;
    transition: .5s
  }

  .box-counter,
  .deverow {
    -flex-flow: row wrap;
    -webkit-box-direction: normal
  }

  .counter .counter-content:before {
    background: #fff;
    -webkit-box-shadow: 0 5px 10px rgb(0 9 128 / 4%), 0 7px 18px rgb(0 9 128 / 5%);
    box-shadow: 0 5px 10px rgb(0 9 128 / 4%), 0 7px 18px rgb(0 9 128 / 5%);
    width: 80px;
    height: 80px;
    border-radius: 100px 100px 0;
    -webkit-transform: rotate(45deg);
    -transform: rotate(45deg);
    transform: rotate(45deg);
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1
  }

  .counter .counter-shadow {
    background: -o-radial-gradient(center, ellipse, #777 0, rgba(0, 0, 0, 0) 70%, rgba(0, 0, 0, 0) 100%);
    background: radial-gradient(ellipse at center, #777 0, rgba(0, 0, 0, 0) 70%, rgba(0, 0, 0, 0) 100%);
    bottom: -40px;
    border-radius: 50%;
    height: 8px;
    position: absolute;
    width: 0;
    z-index: 1;
    -webkit-transition: .5s;
    -o-transition: .5s;
    transition: .5s;
    opacity: 0
  }

  .counter.active .counter-shadow,
  .counter:hover .counter-shadow {
    bottom: -40px;
    height: 12px;
    width: 40px;
    opacity: .5;
    -webkit-transition: .5s;
    -o-transition: .5s;
    transition: .5s
  }

  .counter {
    padding: 0 30px 0 0;
    -webkit-box-flex: 1;
    -flex: 1 1 25%;
    flex: 1 1 25%;
    max-width: 25%;
    box-sizing: border-box;
    color: var(--dark);
    text-align: center;
    position: relative;
    z-index: 1;
    display: -webkit-box;
    display: -flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -flex-align: center;
    align-items: center;
    -webkit-transition: .5s;
    -o-transition: .5s;
    transition: .5s
  }

  .counter:nth-of-type(4n+0) {
    padding-right: 0
  }

  .counter .counter-timer {
    font-weight: 700;
    font-size: 40px
  }

  .counter .counter-title {
    font-size: 18px;
    margin: 0
  }

  .counter #percent::after {
    content: "";
    font-size: 35px;
    font-weight: 600
  }

  h5.counter-number {
    margin-top: 20px;
    margin-bottom: 0
  }

  .bg1 {
    background-color:'#f9f9f9';
}


</style> -->

<style>
  .blog-item .image #img-infografis{
    height: 300px !important;
  }
  
</style>
<!--====== Hero Section Start ======-->
<div class="swiper">
  <div class="wrapper__pusda">
    <div class="col-lg-10 col-md-11">
      <div class="hero-content-three pt-40 pl-80 rpt-15 rmb-75">
        <p class="text__welcome wow fadeInUp">Selamat Datang Di </p>
        <h1 class="text__pusda mb-15 wow fadeInUp delay-0-2s text-tagline text-white">Pusat Informasi <br> HAM Terpercaya</h1>
        <p class="wow fadeInUp delay-0-4s">Ayo telusuri Data HAM, Dokumen, Analisis Media Online dan Sosial, dan bergabung dengan komunitas pegiat HAM di sini. Mari berkenalan dengan Audit HAM dan Anggaran Ramah HAM bersama!</p>
        <!--<form class="newsletter-form mt-40" action="#">-->
        <div class="newsletter-email wow fadeInUp delay-0-6s">
          <input class="input__gw" type="text" name="key" id="key" onkeypress="handle(event)" value="" placeholder="Cari Informasi HAM" required>
          <button id="btn_search" name="btn_search"><i class="fas fa-search fa-2x"></i> &nbsp;Telusuri</button>
        </div>
        <div class="newsletter-radios wow fadeInUp delay-0-8s">
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="dokumen" name="dokumen" checked>
            <label class="custom-control-label" for="dokumen">Dokumen</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="snp" name="snp">
            <label class="custom-control-label" for="snp">SNP</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="agenda" name="agenda">
            <label class="custom-control-label" for="agenda">Agenda</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="glosarium" name="glosarium">
            <label class="custom-control-label" for="glosarium">Glosarium</label>
          </div>
        </div>
        <!--</form>-->
      </div>
    </div>
  </div>
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <!--<div class="swiper-slide"><img src="<?= base_url() ?>assets_landing/images/hero/hero-slider1.png" class="gambar-slider"></div>
            <div class="swiper-slide"><img src="<?= base_url() ?>assets_landing/images/hero/hero-slider2.png" class="gambar-slider"></div>-->
    <?php
					foreach ($this->db->where('is_active','1')->get('tb_image_slide')->result_array() as $gbr)
					{?>
    <div class="swiper-slide"><img src="<?= base_url() ?>uploads/gambar_slide/<?=$gbr['gambar']?>" class="gambar-slider"></div>
    <?php    }
			?>
  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need scrollbar -->
  <img class="dots-shape" src="<?= base_url() ?>assets_landing/images/shapes/dots.png" alt="Shape">
  <img class="tringle-shape" src="<?= base_url() ?>assets_landing/images/shapes/tringle.png" alt="Shape">
  <img class="close-shape" src="<?= base_url() ?>assets_landing/images/shapes/close.png" alt="Shape">
</div>

<!-- <section class="hero-section-three rel z-2 pt-105 rpt-150 pb-130 rpb-100">

</section> -->
<!--====== Hero Section End ======-->

<!--====== Blog Section Start ======-->
<section class="blog-section rel z-1 pt-30 pb-100 rpb-100 rpb-150 rmb-30">
  <div class="container" id="src_glosarium" name="src_glosarium" style="margin-top:3%;display: none;">
    <div class="row">
      <div class="col-lg-12" id="glosarium_hasil_cari">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title font-size-18 mb-3">Daftar Kosa Kata Hak Asasi Manusia</h4>
            <table class="table table-centered table-hover mb-0">
              <tbody>
                <?php 
                                            if($list_glossari){
                                              foreach ($list_glossari as $list) { ?>
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
                <?php } } ?>
              </tbody>
            </table>
            <div class="row">
              <div class="col-lg-12 text-center mt-4 mt-md-5">
                <div class="news-more-btn text-center pt-30">
                  <a href="<?= base_url('home/glosarium') ?>" class="theme-btn style-three">Lihat selengkapnya <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
              <!--<div class="col-12 text-center mt-4 mt-md-5">
                                            <?php 
                                            /*if($list_glossari){
                                              if (count($list_glossari)>0) {
                                                 echo $pagging_src; 
                                               } else {
                                                 echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                            } }*/ ?>
                                        </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" id="data_dokumen" name="data_dokumen" style="display: block;">
    <div class="row justify-content-center text-center mx-auto">
      <div class="col-xl-6 col-lg-8 col-md-10">
        <div class="section-title mb-55">
          <span class="sub-title">Dokumen</span>
          <h2>Dokumen HAM Terbaru </h2>
        </div>
      </div>
    </div>
    <div class="row align-items-center justify-content-center mx-auto">
    <?php foreach ($list_dokumen_terbaru as $list) {
                            // var_dump($id_hak);
						foreach ($list_dokumen_terbaru as $key => $value) {
							if ($value['id'] == $list['id']) {
								if ($value['gambar'] != null) {
									$image = $value['gambar'];
								} else {
									$image = 'image_default.png';
								}
								
								$id_lembaga = $value['id_lembaga'];
							}
						} 

						$nama_dokumen = $list['nama_dokumen'];

						$words = explode(" ", $nama_dokumen);
						$limited_text = substr($nama_dokumen, 0, 30);

						// Tambahkan elipsis jika jumlah kata lebih dari lima
						if (strlen($nama_dokumen) > 30) {
							$limited_text .= '...';
						}

						$nama_jenis = $list['nama_jenis'];
						$limited_text_jenis = substr($nama_jenis, 0, 13);

						// Tambahkan elipsis jika jumlah kata lebih dari lima
						if (strlen($nama_jenis) > 13) {
							$limited_text_jenis .= '...';
						}

						if ($list['deskripsi']) {
							$deskripsi = $list['deskripsi'];
							$limited_text_deskripsi = substr($deskripsi, 0, 20);

							if (strlen($deskripsi) > 28) {
								$limited_text_deskripsi .= '...';
							}
						} else {
							$limited_text_deskripsi = 'Tidak ada deskripsi';
						}
					?>

      <div class="col-xl-3 col-md-6">
        <div class="blog-item wow fadeInUp delay-0-2s">
          <div class="image">
            <img src="<?= ($image!="") ? base_url('uploads/cover/'.$image.'') : '' ?>" alt="Blog">
          </div>
          <div class="blog-author">
            <h5><?= $list['nama_lembaga'] ?></h5>
          </div>
          <div class="blog-content">
            <ul class="blog-meta">
              <li><i class="fas fa-calendar-alt"></i> <a href="blog-details.html" class="text-dark"><?= $list['tahun'] ?></a></li>
              <li><i class="fas fa-swatchbook"></i> <a href="#" data-toggle="tooltip" title="Some tooltip text!" class="text-dark"><?= $limited_text_jenis ?></a></li>
            </ul>

            <h4><a href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>"><strong><?= $limited_text ?></strong></a></h4>

            <p><?=$limited_text_deskripsi ?></p>
            <hr>
            <p class="text-bold"> </p>
          </div>
          <a href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>" class="learn-more">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>

      <?php } ?>
      <?php foreach ($list_dokumen as $list) {
                            // var_dump($id_hak);
						foreach ($list_dokumen as $key => $value) {
							if ($value['id'] == $list['id']) {
								if ($value['gambar'] != null) {
									$image = $value['gambar'];
								} else {
									$image = 'image_default.png';
								}
								
								$id_lembaga = $value['id_lembaga'];
							}
						} 

						$nama_dokumen = $list['nama_dokumen'];

						$words = explode(" ", $nama_dokumen);
						$limited_text = substr($nama_dokumen, 0, 30);

						// Tambahkan elipsis jika jumlah kata lebih dari lima
						if (strlen($nama_dokumen) > 30) {
							$limited_text .= '...';
						}

						$nama_jenis = $list['nama_jenis'];
						$limited_text_jenis = substr($nama_jenis, 0, 13);

						// Tambahkan elipsis jika jumlah kata lebih dari lima
						if (strlen($nama_jenis) > 13) {
							$limited_text_jenis .= '...';
						}

						if ($list['deskripsi']) {
							$deskripsi = $list['deskripsi'];
							$limited_text_deskripsi = substr($deskripsi, 0, 20);

							if (strlen($deskripsi) > 28) {
								$limited_text_deskripsi .= '...';
							}
						} else {
							$limited_text_deskripsi = 'Tidak ada deskripsi';
						}
					?>

      <div class="col-xl-3 col-md-6">
        <div class="blog-item wow fadeInUp delay-0-2s">
          <div class="image">
            <img src="<?= ($image!="") ? base_url('uploads/cover/'.$image.'') : '' ?>" alt="Blog">
          </div>
          <div class="blog-author">
            <h5><?= $list['nama_lembaga'] ?></h5>
          </div>
          <div class="blog-content">
            <ul class="blog-meta">
              <li><i class="fas fa-calendar-alt"></i> <a href="blog-details.html" class="text-dark"><?= $list['tahun'] ?></a></li>
              <li><i class="fas fa-swatchbook"></i> <a href="#" data-toggle="tooltip" title="Some tooltip text!" class="text-dark"><?= $limited_text_jenis ?></a></li>
            </ul>

            <h4><a href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>"><strong><?= $limited_text ?></strong></a></h4>

            <p><?=$limited_text_deskripsi ?></p>
            <hr>
            <p class="text-bold"> </p>
          </div>
          <a href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>" class="learn-more">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>

      <?php } ?>
      <div class="col-lg-12">
        <div class="news-more-btn text-center pt-30">
          <a href="<?= base_url('home/dokumen') ?>" class="theme-btn style-three">Lihat Semua Dokumen <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--====== Blog Section End ======-->


<!--====== Feedback Section Start ======-->
<section class="feedback-section-two bg-blue rel z-1 py-85 rpy-85" style="background-image: url(<?= base_url() ?>assets_landing/images/feedbacks/feedback-bg.png);">
  <div class="container">
    <div class="row align-items-end mb-20">
      <div class="col-xl-5 col-lg-8">
        <div class="section-title mb-20">
          <h2 class="text-white">Agenda Kegiatan HAM</h2>
        </div>
      </div>
      <div class="col-xl-7 col-lg-4">
        <div class="slider-arrow-btns text-lg-right mb-30">
          <a href="<?=base_url('home/agenda')?>" class="btn btn-link text-right">
            <button class="feedback-prev">Lihat Semua Agenda &nbsp;<i class="fas fa-arrow-right"></i></button>
          </a>
        </div>
      </div>
    </div>
    <div class="feedback-active">

      <?php 
				foreach ($agenda as $key => $value) {

				$judul = $value->judul;

				$words = explode(" ", $judul);
				$limited_text = substr($judul, 0, 40);

				// Tambahkan elipsis jika jumlah kata lebih dari lima
				if (strlen($judul) > 40) {
					$limited_text .= '...';
				}

				if ($value->deskripsi) {
					$deskripsi = $value->deskripsi;
					$limited_text_deskripsi = substr($deskripsi, 0, 20);

					if (strlen($deskripsi) > 35) {
						$limited_text_deskripsi .= '...';
					}
				} else {
					$limited_text_deskripsi = 'Tidak ada deskripsi';
				}
			?>

      <div class="blog-item-two wow fadeInUp delay-0-4s" style="border-radius:10px;">
        <div class="blog-two-image" style="background-image: url(<?= base_url() ?>assets_landing/images/blog/blog-two.jpg);"></div>
        <ul class="blog-meta">
          <li><i class="fas fa-calendar-alt" style="color:var(--primary-color);"></i> <a href="<?=base_url('home/detail_agenda/'.encode_id($value->id_event))?>" style="color:var(--primary-color);"><?=date_to_id(get_date($value->start))?></a></li>
          <li><i class="fas fa-tag" style="color:var(--primary-color);"></i> <a href="#" style="color:var(--primary-color);"><?=$value->format?></a></li>
        </ul>
        <h3><a href="<?=base_url('home/detail_agenda/'.encode_id($value->id_event))?>" style="color:var(--primary-color)"><?=$limited_text?></a></h3>
        <p><?= $limited_text_deskripsi ?></p>
        <a href="<?=base_url('home/detail_agenda/'.encode_id($value->id_event))?>" class="read-more btn btn-outline-primary">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
      </div>

      <?php } ?>
    </div>
  </div>
</section>
<!--====== Feedback Section End ======-->

<!--====== Blog Section Start ======-->
<section class="blog-section rel z-1 pt-30 pb-100 rpb-100 rpb-150 rmb-30">
  <div class="container" id="src_glosarium" name="src_glosarium" style="margin-top:3%;display: none;">
    <div class="row">
      <div class="col-lg-12" id="glosarium_hasil_cari">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title font-size-18 mb-3">Daftar Kosa Kata Hak Asasi Manusia</h4>
            <table class="table table-centered table-hover mb-0">
              <tbody>
                <?php 
                                            if($list_glossari){
                                              foreach ($list_glossari as $list) { ?>
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
                <?php } } ?>
              </tbody>
            </table>
            <div class="row">
              <div class="col-lg-12 text-center mt-4 mt-md-5">
                <div class="news-more-btn text-center pt-30">
                  <a href="<?= base_url('home/glosarium') ?>" class="theme-btn style-three">Lihat selengkapnya <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
              <!--<div class="col-12 text-center mt-4 mt-md-5">
                                            <?php 
                                            /*if($list_glossari){
                                              if (count($list_glossari)>0) {
                                                 echo $pagging_src; 
                                               } else {
                                                 echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                            } }*/ ?>
                                        </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" id="data_dokumen" name="data_dokumen" style="display: block;">
    <div class="row justify-content-center text-center mx-auto">
      <div class="col-xl-6 col-lg-8 col-md-10">
        <div class="section-title mb-55">
          <span class="sub-title">Infografis</span>
          <h2>Infografis HAM Terbaru </h2>
        </div>
      </div>
    </div>
    <div class="row align-items-center justify-content-center mx-auto">
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
          <a href="<?= base_url('home/infografis') ?>" class="theme-btn style-three">Lihat Semua Infografis <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--====== Blog Section End ======-->
<style type="text/css">
.slick-dots li.slick-active {
    background-color: #555;
}
.slick-dots li {
    border: 2px solid #6666;
}
</style>
<div class="box padding2 bg1-- radius">
  <div class="row" id="content-wrapper">
    <div class="col-12 col-md-12 col-sm-12 mb-3">
      <div class="box-element animation-right wow fadeInRight section" id="countener" name="Counter" style="visibility: visible; animation-name: fadeInRight;">
        <div class="widget HTML" data-version="2" id="HTML4">
          <h3 class="title text-primary">Rekapitulasi Data</h3>
          <div class="widget-content">
            <div class="section-title text-center mb-30">
              <p>Rekapitulasi Data Yang Terkumpul Dalam Sistem Informasi Pusdahamnas</p>
            </div>
            <div class="container">
              <div class="row align-items-center justify-content-center">
                <div class="box-counter text-center swiper-wrapper">
                  
                  <div class="counter active wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInRight;width:300px;">
                    <div class="counter-content">
                      <!-- <i class="fas fa-user-graduate"></i> -->
                      <img src="<?= base_url() ?>uploads/gambar_slide/dokumen-ham.png" alt="">
                      <div class="counter-shadow"></div>
                    </div>
                    <h5 class="counter-number">
                      <span class="counter-timer text-primary" data-from="0" data-to="<?= $total_dokumen ?>"><?= $total_dokumen ?></span></h5>
                    <h5 class="counter-title text-primary"><a href="<?= base_url('home/dokumen') ?>" class="text-primary">Dokumen HAM</a></h5>
                  </div>

                  <div class="counter active wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 300ms; animation-name: fadeInRight;width:300px;">
                    <div class="counter-content">
                      <!-- <i class="fas fa-cloud-download-alt"></i> -->
                      <img src="<?= base_url() ?>uploads/gambar_slide/SNP.png" alt="">
                      <div class="counter-shadow"></div>
                    </div>
                    <h5 class="counter-number">
                      <span class="counter-timer text-primary" data-from="0" data-to="<?= $total_snp ?>"><?= $total_snp ?></span></h5>
                    <h5 class="counter-title text-primary"><a href="<?= base_url('home/data_snp') ?>" class="text-primary">Standar Norma & Pengaturan</a></h5>
                  </div>

                  <div class="counter active wow fadeInRight" data-wow-delay="600ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 600ms; animation-name: fadeInRight;width:300px;">
                    <div class="counter-content">
                      <!-- <i class="fab fa-accusoft"></i> -->
                      <img src="<?= base_url() ?>uploads/gambar_slide/Glossarium_Ham.png" alt="">
                      <div class="counter-shadow"></div>
                    </div>
                    <h5 class="counter-number">
                      <span class="counter-timer text-primary" data-from="0" data-to="<?= $total_glosarium ?>"><?= $total_glosarium ?></span></h5>
                    <h5 class="counter-title text-primary"><a href="<?= base_url('home/glossary') ?>" class="text-primary">Glosarium HAM</a></h5>
                  </div>

                  <div class="counter active wow fadeInRight" data-wow-delay="900ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 900ms; animation-name: fadeInRight;width:300px;">
                    <div class="counter-content">
                      <!-- <i class="fad fa-layer-group"></i> -->
                      <img src="<?= base_url() ?>uploads/gambar_slide/Lembaga_Ham_1.png" alt="">
                      <div class="counter-shadow"></div>
                    </div>
                    <h5 class="counter-number">
                      <span class="counter-timer text-primary" data-from="0" data-to="<?= $total_lembaga ?>"><?= $total_lembaga ?></span></h5>
                    <h5 class="counter-title text-primary"><a href="<?= base_url('home/lembaga') ?>" class="text-primary">Lembaga HAM</a></h5>
                  </div>

                  <div class="counter active wow fadeInRight" data-wow-delay="900ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 900ms; animation-name: fadeInRight;width:300px;">
                    <div class="counter-content">
                      <!-- <i class="fad fa-layer-group"></i> -->
                      <img src="<?= base_url() ?>uploads/gambar_slide/Pegiat_Ham_1.png" alt="">
                      <div class="counter-shadow"></div>
                    </div>
                    <h5 class="counter-number">
                      <span class="counter-timer text-primary" data-from="0" data-to="<?= $total_pegiatham ?>"><?= $total_pegiatham ?></span></h5>
                    <h5 class="counter-title text-primary"><a href="<?= base_url('home/pegiat_ham') ?>" class="text-primary">Pegiat HAM</a></h5>
                  </div>

                  <div class="counter active wow fadeInRight" data-wow-delay="900ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 900ms; animation-name: fadeInRight;width:300px;">
                    <div class="counter-content">
                      <!-- <i class="fad fa-layer-group"></i> -->
                      <img src="<?= base_url() ?>uploads/gambar_slide/SNP.png" alt="">
                      <div class="counter-shadow"></div>
                    </div>
                    <h5 class="counter-number">
                      <span class="counter-timer text-primary" data-from="0" data-to="<?= $total_mitra ?>"><?= $total_mitra ?></span></h5>                    
                    <h5 class="counter-title text-primary"><a href="<?= base_url('home/mitra') ?>" class="text-primary">Mitra HAM </a></h5>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--====== Partner Section Start ======-->
<!-- <div class="partner-area-three pt-4 rpt-100">
  <div class="container mb-3">
    <h2 class="fw-bold mb-30 pt-40 ">Rekapitulasi Pusdahamnas</h2>
    <div class="row">
      <div class="col-12 col-md-4 col-sm-12 mb-3">
        <div class="card card-rekap px-2 py-3">
          <div class="text-center">
            <i class="fas fa-file fs-2 mt-3"></i>
          </div>
          <a href="<?= base_url('home/dokumen') ?>" class="text-center fw-bold">Dokumen HAM</a>
          <p class="text-center">232 Dokumen</p>
        </div>
      </div>
      <div class="col-12 col-md-4 col-sm-12 mb-3">
        <div class="card card-rekap px-2 py-3">
          <div class="text-center">
            <i class="fas fa-book fs-2 mt-3"></i>
          </div>
          <a href="<?= base_url('home/data_snp') ?>" class="text-center fw-bold">SNP HAM</a>
          <p class="text-center">12 SNP</p>
        </div>
      </div>
      <div class="col-12 col-md-4 col-sm-12">
        <div class="card card-rekap px-2 py-3">
          <div class="text-center">
            <i class="fas fa-quote-right fs-2 mt-3"></i>
          </div>
          <a href="<?= base_url('home/glossary') ?>" class="text-center fw-bold">Glossarium HAM</a>
          <p class="text-center">33 Istilah</p>
        </div>
      </div>
      <div class="col-12 col-md-4 col-sm-12 mt-3">
        <div class="card card-rekap px-2 py-3">
          <div class="text-center">
            <i class="fas fa-building fs-2 mt-3"></i>
          </div>
          <a href="<?= base_url('home/lembaga') ?>" class="text-center fw-bold">Lembaga HAM</a>
          <p class="text-center">99 Lembaga</p>
        </div>
      </div>
      <div class="col-12 col-md-4 col-sm-12 mt-3">
        <div class="card card-rekap px-2 py-3">
          <div class="text-center">
            <i class="fas fa-user fs-2 mt-3"></i>
          </div>
          <a href="<?= base_url('home/pegiat_ham') ?>" class="text-center fw-bold">Pengiat HAM</a>
          <p class="text-center">57 Pegiat HAM</p>
        </div>
      </div>
      <div class="col-12 col-md-4 col-sm-12 mt-3">
        <div class="card card-rekap px-2 py-3">
          <div class="text-center">
            <i class="fas fa-users fs-2 mt-3"></i>
          </div>
          <a href="#" class="text-center fw-bold">Mitra Pusdahamnas</a>
          <p class="text-center">8 Mitra</p>
        </div>
      </div>
    </div>
    <hr>
  </div>
</div> -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper', {
    // Optional parameters
  spaceBetween: 20,
    direction: 'horizontal',
    loop: true,
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    autoplay: {
      delay: 5000,
    },

  });
</script>
<script src="<?= base_url() ?>assets_landing/js/script.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<script type="text/javascript">
 function handle(e){ 
      //  e.preventDefault(); // Otherwise the form will be submitted    
      if(e.keyCode === 13){ // fungsi enter-jangan dihapus
        $("#btn_search").click();
      }        
      
      // validasi input data-> hanya angka dan huruf
      var key = $('#key').val(); 
      var regex = new RegExp("^[a-zA-Z0-9 ]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
          return true;
        }
    e.preventDefault();
    return false;
 } 

  var key_data = 'dokumen';
  var key = $('#key').val();
  //document.getElementById('data_dokumen').style.display = 'block';          
  //document.getElementById('src_glosarium').style.display = 'none'; 

  $("#dokumen").click(function () {
    document.getElementById("dokumen").checked = true;
    document.getElementById("snp").checked = false;
    document.getElementById("agenda").checked = false;
    document.getElementById("glosarium").checked = false;
    key_data = 'dokumen';
  });

  $("#snp").click(function () {
    document.getElementById("snp").checked = true;
    document.getElementById("dokumen").checked = false;
    document.getElementById("agenda").checked = false;
    document.getElementById("glosarium").checked = false;
    key_data = 'snp';
  });


  $("#agenda").click(function () {
    document.getElementById("agenda").checked = true;
    document.getElementById("dokumen").checked = false;
    document.getElementById("snp").checked = false;
    document.getElementById("glosarium").checked = false;
    key_data = 'agenda';
  });

  $("#glosarium").click(function () {
    document.getElementById("glosarium").checked = true;
    document.getElementById("dokumen").checked = false;
    document.getElementById("snp").checked = false;
    document.getElementById("agenda").checked = false;
    key_data = 'glosarium';
  });

  $("#btn_search").click(function () {
    ///  document.getElementById( 'data_dokumen' ).style.display = 'none';
    //$("#key_search").keyup(function(){
    var key = $('#key').val();
    var url_post = '';
    if(key_data=='dokumen'){
      //url_post = "<?php //echo base_url('home/home_dokumen_cari')?>";
      url_post = "<?php echo base_url('home/dokumen')?>";
    }else if(key_data=='snp'){
      //url_post = "<?php echo base_url('home/home_snp_cari')?>";
      url_post = "<?php echo base_url('home/data_snp')?>";
    }else if(key_data=='agenda'){
      ///url_post = "<?php echo base_url('home/home_agenda_cari')?>";
      url_post = "<?php echo base_url('home/semua_agenda')?>";
    }else{ 
      ////url_post = "<?php echo base_url('home/home_glossari_cari')?>";
      url_post = "<?php echo base_url('home/glossary')?>";       
    }

    $.ajax({
      type: "POST",
      url: url_post,
      data: {
        key: key,
        key_data: key_data
      },
      dataType: "HTML",
      success: function (res) {
        if(key_data=='dokumen'){
          //$("#dokumen_hasil_cari").html(res);
          var src = url_post +'/'+ 'key' + '/' + key;
          window.location.replace(src);
        } else if(key_data=='snp'){
          //$("#snp_hasil_cari").html(res);
          var src = url_post + '/' + key;
          window.location.replace(src);
        } else if(key_data=='agenda'){
          //$("#agenda_hasil_cari").html(res);
          var src = url_post +'/'+ 'key' + '/' + key; 
          window.location.replace(src);
        } else{ 
          //$("#glosarium_hasil_cari").html(res);
          var src = url_post +'/'+ 'key' + '/' + key;
          window.location.replace(src);
        }  
      },
      error: function (data) {
        Swal.fire({
          type: 'warning',
          title: 'Tidak Ditemukan',
          text: 'Silahkan Refresh Halaman!',
        })
      }
    });

    if (key_data == 'glosarium') {
      document.getElementById("glosarium").checked = true;
      document.getElementById("dokumen").checked = false;
      document.getElementById("snp").checked = false;
      document.getElementById("agenda").checked = false;
      document.getElementById('data_dokumen').style.display = 'none';

      document.getElementById('src_agenda').style.display = 'none';
      document.getElementById('src_dokumen').style.display = 'none';
      document.getElementById('src_snp').style.display = 'none';
      document.getElementById('src_glosarium').style.display = 'block';

    } else if (key_data == 'agenda') {
      document.getElementById("glosarium").checked = false;
      document.getElementById("dokumen").checked = false;
      document.getElementById("snp").checked = false;
      document.getElementById("agenda").checked = true;
      document.getElementById('data_dokumen').style.display = 'none';

      document.getElementById('src_glosarium').style.display = 'none';
      document.getElementById('src_dokumen').style.display = 'none';
      document.getElementById('src_snp').style.display = 'none';
      document.getElementById('src_agenda').style.display = 'block';
    } else if (key_data == 'snp') {
      document.getElementById("glosarium").checked = false;
      document.getElementById("dokumen").checked = false;
      document.getElementById("snp").checked = true;
      document.getElementById("agenda").checked = false;
      document.getElementById('data_dokumen').style.display = 'none';

      document.getElementById('src_glosarium').style.display = 'none';
      document.getElementById('src_dokumen').style.display = 'none';
      document.getElementById('src_agenda').style.display = 'none';
      document.getElementById('src_snp').style.display = 'block';
    } else {
      document.getElementById("glosarium").checked = false;
      document.getElementById("dokumen").checked = true;
      document.getElementById("snp").checked = false;
      document.getElementById("agenda").checked = false;
      document.getElementById('data_dokumen').style.display = 'none';

      document.getElementById('src_glosarium').style.display = 'none';
      document.getElementById('src_snp').style.display = 'none';
      document.getElementById('src_agenda').style.display = 'none';
      document.getElementById('src_dokumen').style.display = 'block';
    }

  });
</script>
<!--====== Partner Section End ======-->
