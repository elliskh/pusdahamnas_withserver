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
                    <!--
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Glossarium Hak Asasi Manusia</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                                        <li class="breadcrumb-item active">Glossarium Hak Asasi Manusia</li>
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
                    <div class="card" style="margin-top: 8%;margin-bottom: 15px;">
                        <div class="card-body">
                            <h6 class="card-title font-size-16">Glossarium Hak Asasi Manusia</h6>
                            <!--<p class="mb-0">Pencarian Kosa Kata terkait Hak Asasi Manusia</p>-->
                             <form class="hero-search">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Pencarian Data Glossarium HAM" id="glossari_cari_kata" value="<?= $key ?>">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form> 
                        </div>
                    </div>
                 </div>   

                 <div class="container">
                    <div class="row">
                        <div class="col-lg-12" id="glossari_hasil_cari">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title font-size-18 mb-3">Daftar Kosa Kata Hak Asasi Manusia</h4>
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
                                            <?php foreach ($list_glossari as $list) { ?>
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
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-12 text-center mt-4 mt-md-5">
                                            <?php if (count($list_glossari)>0) {
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
      gambar.src = '/assets_landing/images/logos/logo-pusdahamnas-white.png';
      gambar.alt = 'gambar baru';
      scrollLink.fadeIn(300);
    } else {
      siteHeader.addClass("fixed-header");      
      siteNav.addClass("text-custom");
      siteNav.removeClass("text-custom");
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
<!-- JAVASCRIPT -->
    <script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets_front/js/app.js"></script>
 
    <script>
        $("#glossari_cari_kata").keyup(function(){
            var key = $('#glossari_cari_kata').val();
            ///$('#cari').val(key);
            // var id_hak = $('#pilih_hak').val();
            // var id_subyek = $('#pilih_subyek').val();
            // var id_lembaga = $('#pilih_lembaga').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('home/glossari_cari')?>",
                dataType : "HTML",
                ///dataType : "json",
                data : {key: key},
                success: function(res){
                    $("#glossari_hasil_cari").html(res);
                },error: function(data){     
                    Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                    })
                }
            });
        });
    </script>