<!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
<style>
  .myFont2 {
    font-size: 14px;
  }
  a{
    color:var(--base-color);
  }
  th,td{
    width:100%;
  }
  @media only screen and(max-width:600px){
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
<div class="container" class="hero-section-three rel z-2 pt-105 rpt-150 pb-130 rpb-100">
  <div class="card" style="margin-bottom: 15px;margin-top: 8%;">
    <div class="card-body">
      <h6 class="card-title font-size-16">Pencarian Standar Norma & Pengaturan</h6>
      <form class="hero-search">
        <div class="position-relative">
          <input type="text" class="form-control" placeholder="Masukkan kata kunci" id="rasetnis_cari_kata" value="<?= $key_snp ?>">
          <span class="bx bx-search-alt"></span>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12" id="rasetnis_hasil_cari">
      <div class="card">
        <div class="card-body" style="display: none;">
          <!--  <h3 class="card-title font-size-24 mb-3">Penghapusan diskriminasi ras dan etnis</h3>   -->
         <div class="table-responsive">
         <table class="table table-centered table-hover- mb-0">
            <tbody>
              <?php 
                                            $no = 0;
                                            $tmp_judul = '';
                                            foreach ($list_rasetnis as $list) { ?>
              <tr>
                <td>
                  <div class="d-md-flex">
                    <div class="table-content ml-md-12">
                      <!--<h4 class="font-weight-semibold limit-2-line-text mb-3">
                                                                <a class="link-underline link-title">BAB:&nbsp;<?= $list['bab'] ?></a>
                                                            </h4>-->
                      <!-- detail -->
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
                      <!--
                                                            <button id="toggle_all_<?=$list['id']?>" class="btn btn-primary" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="<?=$list['id']?>">Detail >></button>
                                                             -->
                      <div class="row">
                        <div class="col">
                          <div class="collaps" style="float: right;" id="<?=$list['id']?>">
                            <?php 
                                                                            foreach ($this->db->where('bab',$list['bab'])->get('tb_snp_detail')->result_array() as $row)
                                                                            {
                                                                                echo "<div class='card-body' style='width: 100%;'>";
                                                                                ///echo "<labelstyle='width: 100%;'>Halaman:&nbsp;$row[nomor_halaman]</label><br>";
                                                                                ///echo "<labelstyle='width: 100%;'>Paragraf:&nbsp;$row[nomor_paragraf]</label><br>"; 
                                                                             ?>
                            <style type="text/css">
                              table {
                                table-layout: fixed;
                                width: 100%;
                              }

                              .head_w {
                                table-layout: fixed;
                                width: 100%;
                              }
                            </style>
                            <div class="table-responsive" data-pattern="priority-columns">
                              <table class="table table-striped table-bordered table-hover-" id="table-data-" style="width: 100%;">
                                <thead class="head_w text-black">
                                  <tr>
                                  <th style="background-color: #f4f4f4;border: 3px;">Judul</th>
                                  <th colspan="3" style="background-color: #f4f4f4;border: 3px;">Bab</th>
                                  <th colspan="4" style="background-color: #f4f4f4;border: 3px;">Paragraf</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <?php if($tmp_judul!=$list['judul']){
                                                                                    $tmp_judul = $list['judul'];
                                                                                 ?>
                                    <td><?=$list['judul']?></td>
                                    <?php }else{?>
                                    <td></td>
                                    <?php }?>
                                    <td colspan="3"><?=$row['bab']?></td>
                                    <td colspan="4">Klik Disini<i class="fa fa-caret-right" id="toggle_all_<?=$list['id']?>" data-toggle="collapse" aria-expanded="false" aria-controls="<?=$list['id']?>"> Klik Disini </i><br>
                                      <label class="collapse multi-collapse_<?=$list['id']?>" style="float: right;" id="<?=$list['id']?>">
                                        <?=$row['deskripsi']?>
                                      </label>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <?php        
                                                                                ///echo $row['deskripsi']; 
                                  echo "</div>";
                              }         
                                  
                            ?>
                          </div>
                        </div>
                      </div>
                      <script type="text/javascript">
                        var toggle_all = $('#toggle_all_<?=$list['
                          id ']?>')

                        toggle_all.on('click', function (e) {

                          if (toggle_all.attr("aria-expanded") === 'false') {
                            $('.multi-collapse_<?=$list['
                              id ']?>').collapse('show');
                            toggle_all.attr('aria-expanded', 'true');
                            return false;
                          } else {
                            $('.multi-collapse_<?=$list['
                              id ']?>').collapse('hide');
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
              <?php } ?>
            </tbody>
          </table>
         </div>
          <div class="row">
            <div class="col-12 text-center mt-4 mt-md-5 text-dark">
              <?php if (count($list_rasetnis)>0) {
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
  var key_snp = $('#rasetnis_cari_kata').val();
  if (key_snp == '') {
    key_snp = '';
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('home/snp_rasetnis_cari')?>",
      dataType: "HTML",
      ///dataType : "json",
      data: {
        key_snp: key_snp
      },
      success: function (res) {
        $("#rasetnis_hasil_cari").html(res);
      },
      error: function (data) {
        Swal.fire({
          type: 'warning',
          title: 'Tidak Ditemukan',
          text: 'Silahkan Refresh Halaman!',
        })
      }
    });
  }

  $( document ).ready(function() {
    console.log(key_snp);
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('home/snp_rasetnis_cari')?>",
        dataType: "HTML",
        ///dataType : "json",
        data: {
          key_snp: key_snp
        },
        success: function (res) {
          $("#rasetnis_hasil_cari").html(res);
        },
        error: function (data) {
          Swal.fire({
            type: 'warning',
            title: 'Tidak Ditemukan',
            text: 'Silahkan Refresh Halaman!',
          })
        }
      });
  });
</script>

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
        siteNav.addClass("text-custom");
        gambar.src = '/assets_landing/images/logos/logo-pusdahamnas-white.png';
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
            siteNav.removeClass("text-custom");
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