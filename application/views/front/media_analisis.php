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
<div class="row">
    <div class="col-12">
        <div class="card mb-5">
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="card-title font-size-24" id="title_isu">Media Analisis</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Data HAM</a></li>
                        <li class="breadcrumb-item active">Media Analisis</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Title Page End -->
<?php
}
?>
<div class="container mtx-3 mb-3">
    <div class="row align-items-center">
        <div class="col-12">
            <div class="card mb-4 mtx-3">
                <div class="card-body">
                    <h4 class="card-title fs-2 text-center" id="title_isu">Media Analisis</h4>
                    <p class="text-center mb-2 fw-normal">Menampilkan Media Informasi dalam Bentuk Grafis
                        Berdasarkan Fakta Yang ada</p>
                </div>
            </div>
            <!--<div class="card mb-5">
                <div class="card-body d-flex align-items-center justify-content-between text-primary">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Data HAM</a></li>
                            <li class="breadcrumb-item active">Media Analisis</li>
                        </ol>
                    </div>
                </div>
            </div>-->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <iframe width="100%" id="ccc" height="750" src="https://lookerstudio.google.com/embed/u/0/reporting/78474d15-83c0-405d-b767-3e001566f16e/page/p_fcr8bsqxbd" frameborder="0" style="border:0" allowfullscreen></iframe>
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

$(document).ready(function() {

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

	<!-- JAVASCRIPT -->
	<script src="<?= themeUrl() ?>assets/libs/jquery/jquery.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/node-waves/waves.min.js"></script>

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