<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
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
<div class="container">

    <div class="card mb-3" style="margin-top: 8%;">
        <div class="card-body">
            <h4 class="card-title font-size-24">Komunitas pegiat HAM</h4>
             <form class="hero-search">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Masukkan kata kunci" id="komham_cari_kata" value="<?= $key ?>">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form> 
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12" id="komham_hasil_cari"> 
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-size-18 mb-3">Data Komunitas pegiat HAM</h4>
                    <!--<form action="<?= base_url('home/glossary') ?>" method="POST">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <div class="nav-letter mb-4">
                            <input class="btn <?= ($huruf==''||$huruf=='Semua')?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="Semua">
                            <?php //foreach ($all_huruf as $hrf) { ?>
                            <input class="btn <?= ($hrf==$huruf)?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="<?= $hrf ?>">
                            <?php //} ?>
                        </div>
                    </form>-->
    
                    <table class="table table-centered table-hover mb-0">
                        <tbody>
                            <?php foreach ($list_komham as $list) { ?>
                            <tr>
                                <td>
                                    <div class="d-md-flex">
                                        <div class="table-content ml-md-12">
                                            <div class="blog-standart-item">
                                                <ul class="blog-meta">
                                                    <li><i class="fas fa-user"></i><?=$list['penulis'] ?></li>
                                                    <li><i class="fas fa-calendar"></i><?php echo date('d-m-Y',strtotime($list['created_at']));?></li>
                                                </ul>
                                             
                                            </div>
                                            <h6 class="font-size-12 mb-0"></h6>
                                            <!--<div class="mb-12">
                                                <p class="text-justify"><?= $list['deskripsi'] ?></p>
                                            </div>-->
                                            
                                            <div class="media-body overflow-hidden pr-12">
                                                <h3 class="font-weight-semibold limit-2-line-text mb-3 mt-4">
                                                    <p><?= $list['judul'] ?></p>
                                                </h3>        
                                                <p class="font-size-12 mb-3"><?php echo substr($list['isi_konten'],0,200).'...';?></p>
                                                <a href="<?=base_url('home/detail_komham/'.encode_id($list['id']));?>" 
                                                class="link-underline link-title btn btn-outline-primary mb-3">Baca Selengkapnya</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 text-center mt-4 mt-md-5">
                            <?php if (count($list_komham)>0) {
                            echo $pagging; 
                            } else {
                            echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#komham_cari_kata").keyup(function(){
        var key = $("#komham_cari_kata").val();
        // alert(key);
        $.ajax({
            type: "POST",
            url :"<?=base_url()?>home/komham_cari",
            // dataType:"HTML",
            dataType: "HTML",
            data:{key: key},
            success: function(res){
                $("#komham_hasil_cari").html(res);
            },error: function(data){
                // Swal.fire({
                //         type: 'warning',
                //         title: 'Tidak Ditemukan',
                //         text: 'Silahkan Refresh Halaman!',
                // });
            }
        });
    });
</script>
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