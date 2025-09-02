<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>    
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
<!--    
<div class="row"> 
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Sebaran Lembaga HAM</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php //echo base_url()?>">Beranda</a></li>
                    <li class="breadcrumb-item active">Sebaran Lembaga HAM</li>
                </ol>
            </div>
        </div>
    </div>
</div>-->
<!-- Title Page End -->
<?php
}
?>
<div class="container">
  <div class="card" style="margin-bottom: 15px;margin-top: 8%;">
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
</div>
<div class="container">
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
</div>
<!-- JAVASCRIPT -->
    <script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url() ?>assets_front/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets_front/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets_front/libs/node-waves/waves.min.js"></script>
    <script src="https://ministry.phicos.co.id/front/pusdahamnas/assets/libs/social-sharing/socialSharing.js"></script>
    <script src="<?= base_url() ?>assets_front/js/app.js"></script>


    <?= isset($_js) ? $_js : ''; ?>

	<!-- owl.carousel js -->
	<script src="<?= themeUrl() ?>assets/libs/owl.carousel/owl.carousel.min.js"></script>

	<!-- auth-2-carousel init -->
	<script src="<?= themeUrl() ?>assets/js/pages/auth-2-carousel.init.js"></script>
 
	<!-- App js -->
	<script src="<?= themeUrl() ?>assets/js/app.js"></script>

	<!-- JQuery Validate -->
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?= themeUrl() ?>assets/libs/toastr/build/toastr.min.js"></script>
	<script src="<?= base_url('assets/js/custom/cryptojs-aes-php/cryptojs-aes.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/custom/cryptojs-aes-php/cryptojs-aes-format.js') ?>"></script>
	<script src="<?= base_url('assets/js/script.js?q=' . random_string()) ?>"></script>
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
      gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
      gambar.alt = 'gambar baru';
      scrollLink.fadeIn(300);
    } else {
      siteHeader.addClass("fixed-header");
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
          // siteHeader.removeClass("fixed-header");
          siteNav.removeClass("text-custom");
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
    