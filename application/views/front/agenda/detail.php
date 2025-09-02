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
<style>
  .tooltip {
    position: relative;
    display: inline-block;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 150%;
    left: 50%;
    margin-left: -75px;
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
</style>

<!--<section class="blog-details-area pt-130 pb-160 rpt-100 rpb-90">-->
  <div class="container">
    <div class="row" style="margin-top: 8%;">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">             
        <div class="blog-details-content rmb-75">
          <div class="blog-standart-item">
            <?php
             if($data->poster !="")
             {
                echo "<img src='".base_url('uploads/poster/'.$data->poster)."' class='img-thumbnail'></img>";
             }
             if(strpos($data->link_meet, 'http') !== false)
             {
               $linkurl = $data->link_meet;
             }
             else 
             {
                $linkurl="javascript:void()";
             }
            ?>
            <ul class="blog-meta ml-2 mt-3">
              <li>
                <i class="fas fa-user"></i>
                <span class="ml-1"><?= $data->nama_hubung ?></span>
              </li>
              <li>
                <i class="fas fa-calendar"></i>
                <abbr title="<?=date_to_id(get_date($data->start)) ?>"><?=date_to_id(get_date($data->start)) ?></abbr>
              </li>
              <li>
                <i class="fas fa-phone"></i>
                  <span class="ml-1"><?= $data->hp_hubung ?></span>
              </li>
            </ul>
            <h3 class="card-title px-1 mt-3 mb-3"><?= $data->judul ?></h3>
            <p><?php echo $data->deskripsi; ?></p>

            <div class="container-fiuid mt-4">
              <h4 class="fw-bold">Link Media Converence :</h4>
              <a href="<?=$linkurl?>" class="text-primary text-decoration-none" onclick="javascript:void()">
             <?php if($data->format == 'Webinar') {?>
                <h6 class="pt-3">
                  <i class="fas fa-sign-in-alt font-size-16 mr-2"></i>
                  <?=$data->link_meet?>
                </h6>
                <?php }else{ ?>
                <h6 class="pt-3"><i class="fas fa-map-marker-alt"></i> <?=$data->link_meet?></h6>
              <?php } ?>
            </a>
            </div>
            <div class="blog-footer d-flex flex-wrap align-items-center pt-25">
              <div class="tags mb-10 mr-auto">
                <b>Categories : </b>
                <a href="#"><i class="fas fa-tag"></i> <?= $data->format ?></a>
              </div>
              <div class="social mb-10">
                <b>Bagikan Ke Social Media:</b>
                <a class="text-dark" id="fb"><i class="fab fa-facebook"></i></a>
                <a class="text-dark" id="tw"><i class="fab fa-twitter"></i></a>
                <br/>
              </div>
              <div class="input-group mb-3">
              <input type="text" class="form-control" value="<?php echo current_url(); ?>" aria-describedby="inputGroupCopylink"  id="copyText" readonly style="background-color: #e9ecef;">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="copyBtn">SALIN</button>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
     </div> 
      
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">       
        <div class="blog-sidebar">
          <div class="widget news-widget wow fadeInUp delay-0-2s" style="visibility: visible; animation-name:fadeInUp;">
            <h3 class="widget-title">
              Event Terkait :
            </h3>
            <div class="news-widget-wrap">
            <ul class="list-unstyled chat-list slider">
              <?php 
                // var_dump($this->uri->segment(2));
                foreach ($agenda as $key => $value) {
              ?>
              <li class="active mt-4 bg-card" id="<?=encode_id($value->id_event)?>">
                <a href="<?=base_url('home/detail_agenda/'.encode_id($value->id_event))?>">
                  <div class="media">
                    <div class="mr-2">
                      <i class="far fa-calendar text-dark"></i>
                    </div>

                    <div class="media-body overflow-hidden pr-3">
                      <h5 class="limit-3-line-text font-size-15 mb-2"> <?=$value->judul?></h5>
                    </div>
                  </div>
                </a>
              </li>
              <?php } ?>
            </ul>
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
      //siteNav.addClass("text-custom");
      gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
      gambar.alt = 'gambar baru';
      scrollLink.fadeIn(300);
    } else {
      siteHeader.addClass("fixed-header");      
      siteNav.addClass("text-custom");
      //siteNav.removeClass("text-custom");
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
          //siteNav.removeClass("text-custom");
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

  <script src="http://devpusdahamnas.komnasham.go.id/assets_front/libs/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
            const copyBtn = document.getElementById('copyBtn')
            const copyText = document.getElementById('copyText')
            
            copyBtn.onclick = () => {
                copyText.select();    // Selects the text inside the input
                document.execCommand('copy');    // Simply copies the selected text to clipboard 
                 Swal.fire({         //displays a pop up with sweetalert
                    icon: 'success',
                    title: 'Text copied to clipboard',
                    showConfirmButton: false,
                    timer: 1000
                });
            }
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
<script>
  const fb = document.getElementById('fb');
  fb.addEventListener('click', shareOnFacebook);

  function shareOnFacebook(){
    const navUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + '<?= current_url() ?>';
    window.open(navUrl, '_blank');
  }
  const tw = document.getElementById('tw');
  tw.addEventListener('click', shareOnTwitter);
            
  function shareOnTwitter(){
    const navUrl ='https://twitter.com/intent/tweet?text=' + '<?= current_url() ?>';
    window.open(navUrl, '_blank');
  }
</script>
<!--</section>-->