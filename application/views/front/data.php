<!-- <div class="back-wrapper">
  <div class="back-wrapper-inner">
    <div class="back-breadcrumbs">
      <div class="breadcrumbs-wrap">
        <img class="desktop" src="<?= base_url() ?>assets_front/assets/images/breadcrumbs/1.jpg" alt="Breadcrumbs">
        <img class="mobile" src="<?= base_url() ?>assets_front/assets/images/breadcrumbs/1.jpg" alt="Breadcrumbs">
        
        <div class="breadcrumbs-inner">
          <div class="container">
            <div class="breadcrumbs-text">
              <h1 class="breadcrumbs-title">Data HAM</h1>
              <div class="back-nav mt-20">
                <ul>
                  <li><a href="<?php echo base_url()?>">Beranda</a></li>
                  <li>Data HAM</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 pb-65 pt-116">
        <div class="card">
          <div class="card-body">
          <iframe id="isu3" name="isu3" class="" style="margin-right: -0.2%;float: right;margin-top: -1%;display:block" width="100%;" height="650px;" src="https://lookerstudio.google.com/embed/reporting/76232793-d12d-49c8-8bad-a9ceaf4594a6/page/p_qnxk2gjg9c" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<!-- Ignore the ugly SVG code -->

<section class="about-page-section rel z-1">
  <div class="container">
    <!--<ul class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?= base_url() ?>" class="breadcrumb-link"><span><i class="fas fa-home"></i> Beranda</span></a>
      </li>
      <li class="breadcrumb-item">
        <a href="#" class="breadcrumb-link active"><span><i class="far fa-chart-bar"></i> Data HAM</span></a>
      </li>
    </ul>-->

    <div class="row align-items-center" style="margin-top:111px;">
      <div class="col-xl-5 col-lg-6">
        <div class="about-page-content rmb-65 wow fadeInLeft delay-0-2s">
          <div class="section-title mb-25">
            <span class="sub-title">Visualisasi Data</span>
            <h2>Jejak HAM dalam Angka</h2>
          </div>
          <p>Memaparkan perjalanan visual melintasi data dengan grafik dan peta. Dari angka dapat menceritakan pengalaman, memunculkan pemahaman mendalam akan tantangan dan pencapaian hak asasi manusia.</p>
          <!-- <a href="about.html" class="theme-btn">Get Started <i class="fas fa-arrow-right"></i></a> -->
        </div>
      </div>
      <div class="col-xl-7 col-lg-6">
        <div class="d-flex justify-content-lg-end wow fadeInRight delay-0-2s">
            <?php
			foreach ($this->db->where('is_active','1')->get('tb_image_visualisasi')->result_array() as $gbr){?>							                        
                <img src="<?= base_url() ?>uploads/gambar_slide/<?=$gbr['gambar']?>" alt="About" style="width:70%;height:70%;"> 
          <?php }?>          
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 ">
        <div class="card">
          <div class="card-body">
            <iframe id="isu3" name="isu3" class="" style="margin-right: -0.2%;float: right;margin-top: -1%;display:block;border-radius: 10px;" width="100%;" height="700px;" src="https://lookerstudio.google.com/embed/reporting/76232793-d12d-49c8-8bad-a9ceaf4594a6/page/p_qnxk2gjg9c" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
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
