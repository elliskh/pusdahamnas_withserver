<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

<!-- for Bootstrap 4 -->
<link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>

<link href='<?=base_url()?>assets_front/calendar/lib/main.css' rel='stylesheet' />

<style>

  body {
    margin: 0;
    padding: 0;
    font-size: 14px;
  }
  a{
    text-decoration:none;
  }
  #top,
  #calendar.fc-theme-standard {
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  }

  #calendar.fc-theme-bootstrap {
    font-size: 14px;
  }

  #top {
    background: #eee;
    border-bottom: 1px solid #ddd;
    padding: 0 10px;
    line-height: 40px;
    font-size: 12px;
    color: #000;
  }

  #top .selector {
    display: inline-block;
    margin-right: 10px;
  }

  #top select {
    font: inherit; /* mock what Boostrap does, don't compete  */
  }

  .left { float: left }
  .right { float: right }
  .clear { clear: both }

  #calendar {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 10px;
  }
  .img-logo {
    width: 100%;
    max-width: 820px;
}
.fc-daygrid-event{
    font-size: 1.2em;
}
</style>
<!--
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18" style="color: white;">Kalender Kegiatan Mitra Pusdahamnas</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>" style="color: white;">Beranda</a></li>
                    <li class="breadcrumb-item- active" style="color: white;">/Kalender Kegiatan Mitra Pusdahamnas</li>
                </ol>
            </div>
        </div>
    </div>
</div>-->
<div class="container">
  <div class="row" style="margin-top: 10%;">
   <div class="col-lg-8" id="hasil_cari">
    <div class="card">
     <div class="card-body">                    
      <div id='top' hidden>
    
    <div class='left'>
    
    <div id='theme-system-selector' class='selector' hidden>
    Theme System:
    <select>
    <option value='bootstrap5' selected>Bootstrap 5</option>
    <option value='bootstrap'>Bootstrap 4</option>
    <option value='standard'>unthemed</option>
    </select>
    </div>
    
    
    <span id='loading' style='display:none'>loading theme...</span>
    
    </div>
    
    <div class='right'>
    <span class='credits' data-credit-id='bootstrap-standard' style='display:none'>
    <a href='https://getbootstrap.com/docs/3.3/' target='_blank'>Theme by Bootstrap</a>
    </span>
    <span class='credits' data-credit-id='bootstrap-custom' style='display:none'>
    <a href='https://bootswatch.com/' target='_blank'>Theme by Bootswatch</a>
    </span>
    </div>
    
    <div class='clear'></div>
    </div>
    
    <div id='calendar'></div> 
                    <div class="row">
                        <div class="col-12 text-center mt-4 mt-md-5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="bg-primary rounded p-2 mb-3">
                    <h6 class="card-title text-white text-center mb-0"><i class="fas fa-calendar"></i> Kalender Kegiatan Mitra Pusdahamnas</h6>
                </div>
                <ul class="list-unstyled chat-list slider">
                    <?php 
                    // var_dump($this->uri->segment(2));
                                    foreach ($agenda as $key => $value) {
                                     ?>
                    <li class="active mt-5" id="<?=encode_id($value->id_event)?>">
                        <a href="<?=base_url('home/detail_agenda/'.encode_id($value->id_event))?>">
                            <div class="media">
                                <div class="mr-2">
                                    <i class="bx bx-calendar font-size-18"></i>
                                </div>

                                <div class="media-body overflow-hidden pr-3">
                                    <div class="font-size-10 mb-2 text-dark"><i class="fas fa-calendar"></i> <?=date_to_id(get_date($value->start))?></div>
                                    <h6 class="limit-3-line-text font-size-15 mb-2"> <?=$value->judul?></h6>
                                    <h6 class="font-size-12 mb-0"><i class="fas fa-tag"></i> <?=$value->format?></h6>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>

            </div>
            <div class="card-footer">
                <a href="<?=base_url('home/semua_agenda')?>" class="btn btn-primary btn-block"> Lihat semua agenda <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
            </div>
        </div>
</div>

<!-- JAVASCRIPT -->
    <script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets_front/js/app.js"></script>


    <?= isset($_js) ? $_js : ''; ?>
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
          //siteHeader.removeClass("fixed-header");
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
<script>
    $(document).ready(function () {
        // slick carousel
        $('.slider').slick({
            dots: true,
            vertical: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            verticalSwiping: true,
            autoplay: true,
            autoplaySpeed: 5000,
        });

        var limit = 3;        
        $('.slick-prev').hide();
        $('.slick-next').hide();
    });
</script>

