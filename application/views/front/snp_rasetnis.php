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
          <input type="text" class="form-control" placeholder="Masukkan kata kunci" id="rasetnis_cari_kata" name="rasetnis_cari_kata" value="<?= $this->session->key_snp ?>">
          <span class="bx bx-search-alt"></span>
        </div>
      </form>
    </div>
  </div>
</div> 
<div class="container">
  <div class="row">
    <div class="col-lg-12" id="rasetnis_hasil_cari" style="min-width: 100%;">
      <div class="card">
        <div class="card-body" style="display: block;">
         <!--<table class="table table-centered table-hover- mb-0">
            <tbody>-->
                                            <?php 
                                            $no = 0;
                                            $no_judul = '';
                                            $no_bab = '';
                                            $no_des = 0;
                                    
                                            if($list_rasetnis){
                                               foreach ($list_rasetnis as $list){ 
                                                ?>                       
                                                            <style type="text/css">
                                                            table{ table-layout: fixed; width:100%; }
                                                            </style>
                                                                  <div class="collapse multi-collapse show"  style="float: right;" id="<?php //$list['id_data_snp']?>">
                                                                        <?php  
                                                                          $cek_status='ada';
                                                                          $cek_rows  ='ada';
                                                                            foreach ($this->db->where('bab',$list['bab'])->order_by('id', 'asc')->get('tb_snp_detail')->result_array() as $row)
                                                                            { $no += 1;
                                                                             ?>
                                                               <!-- table -->  
                                                               <?php if($cek_status=='ada' && $cek_rows=='ada'){?>  
                                                                   <?php if($no_judul!=$list['judul'] && $no_bab!=$list['bab']){?>          
                                                    				<div class="table-responsive" data-pattern="priority-columns">
                                                    					<table class="table table-striped table-bordered table-hover-" id="table-data-" style="width: 100%;">
                                                    					  <?php 
                                                                            $Upkey = strtoupper($key_snp);
                                                                            $replaceStr = "<label style='background-color:#faefc2;'>" . $key_snp . "</label>";
                                                                             if(strcasecmp("/$key_snp/i", $row['deskripsi'])){ 
                                                                           ?>
                                                                          
                                                                           <?php if($no==1){?>                                                 
                                                                        	<thead class="text-black">
                                                    							<tr>
                                                    								<th style="background-color: #f4f4f4;border: 3px;">Judul</th>
                                                    								<th colspan="3" style="background-color: #f4f4f4;border: 3px;">Bab</th>
                                                    								<th colspan="4" style="background-color: #f4f4f4;border: 3px;">Paragraf</th>
                                                    							</tr>
                                                    						</thead>
                                                                            <?php }?>
                                                    						<tbody>                                                                              
                                                                              <?php if(($list['deskripsi'])){?>                                                                                 
                                                                              <tr>
                                                                                <?php if($no_judul!=$list['judul']){
                                                                                    $no_judul = $list['judul'];
                                                                                    ?>                                                                                
                                                                                  <td><?=$list['judul']?></td><!-- judul -->
                                                                                <?php }else{ ?> 
                                                                                  <td></td>
                                                                                <?php }?> 
                                                                                <?php if($no_bab!=$list['bab']){
                                                                                    $no_bab = $list['bab'];
                                                                                    ?>        
                                                                                  <td colspan="3"><?=$list['bab']?><label style='width: 100%;'>Halaman:&nbsp;<?=$list['nomor_halaman']?></label></label></td>
                                                                                <?php }else{ $cek_status='';?> 
                                                                                  <td><label style='width: 100%;'>xxxxxx</label></td><!-- bab -->
                                                                                <?php }?> 
                                                                                 <?php if($cek_status=='ada'){?>
                                                                                  <td colspan="4">
                                                                                 <?php 
                                                                                 //$where = 'bab = '.$list['bab'].' AND (bab like "%'.$key_snp.'%" OR deskripsi like "%'.$key_snp.'%")';
                                                                                 foreach ($this->db->where('bab',$list['bab'])->order_by('id', 'asc')->get('tb_snp_detail')->result_array() as $row)
                                                                                 { ?>
                                                                                 <?php 
                                                                                   if(strcasecmp("/$key_snp/", $row['deskripsi'])){                                                                                    
                                                                                                                                                                     ?>
                                                                                  <i class="fa fa-caret-right" type="button" id="toggle_all_<?php echo $row['id'];?>" data-toggle='collapse' aria-expanded='false' aria-controls="<?php echo $row['id'];?>"> Klik Disini &nbsp;</i>[&nbsp;]</br>
                                                                                    <label class="collapse multi-collapse_<?php echo $row['id'];?>"  style="float: right;" id="multi-collapse_<?=$row['id']?>">
                                                                                      <?php                                                                                         
                                                                                          $replaceStr = "<label style='background-color:#faefc2;'>" . $key_snp . "</label>";
                                                                                          $text = str_replace($key_snp, $replaceStr, $row['deskripsi']);
                                                                                          echo $text; //-data deskripsi
                                                                                      ?>
                                                                                    </label>                                                                                  
                                                                                 <br />
                                                                                 <?php }else{
                                                                                         if(array_key_exists(ucfirst($key_snp),(array)$row['deskripsi'])){ 
                                                                                            ?>
                                                                                      <i class="fa fa-caret-right" type="button" id="toggle_all_<?php echo $row['id'];?>" data-toggle='collapse' aria-expanded='false' aria-controls="<?php echo $row['id'];?>"> Klik Disini &nbsp;</i>[&nbsp;]</br>
                                                                                       <label class="collapse multi-collapse_<?php echo $row['id'];?>"  style="float: right;" id="multi-collapse_<?=$row['id']?>">
                                                                                            <?php                                                                                                                                                                                                                                                                                     
                                                                                            $replaceStr = "<label style='background-color:#faefc2;'>" . ucfirst($key_snp) . "</label>";
                                                                                            $text = str_replace(ucfirst($key_snp), $replaceStr, ($row['deskripsi']));
                                                                                            echo $text;//-data deskripsi ?>
                                                                                            </label>                                                                                  
                                                                                            <br />
                                                                                       <?php  }else{ ?>
                                                                                      <i class="fa fa-caret-right" type="button" id="toggle_all_<?php echo $row['id'];?>" data-toggle='collapse' aria-expanded='false' aria-controls="<?php echo $row['id'];?>"> Klik Disini &nbsp;</i>[&nbsp;]</br>
                                                                                       <label class="collapse multi-collapse_<?php echo $row['id'];?>"  style="float: right;" id="multi-collapse_<?=$row['id']?>">                                                                                        
                                                                                        <?php 
                                                                                            $replaceStr = "<label style='background-color:#faefc2;'>" . strtoupper($key_snp) . "</label>";
                                                                                            $text = str_replace(strtoupper($key_snp), $replaceStr, ($row['deskripsi']));
                                                                                            echo $text;//-data deskripsi ?>
                                                                                           </label>
                                                                                           <br />                                                                                            
                                                                                      <?php                                                                                               
                                                                                         }                                                                                                                                                                                           
                                                                                    }                                                                                    ?>
                                                                    <script type="text/javascript">                                                                                                                               
                                                                        var toggle_all = $('#toggle_all_<?=$row['id']?>');
                                                                        
                                                                        toggle_all.on('click', function(event) {                                                                    
                                                                          if (toggle_all.attr("aria-expanded") === 'false') {
                                                                            $('.multi-collapse_<?=$row['id']?>').collapse('show');                                                                    
                                                                            toggle_all.attr('aria-expanded', 'true'); 
                                                                            ///return false;                                                              
                                                                          } else {
                                                                            $('.multi-collapse_<?=$row['id']?>').collapse('hide');
                                                                            toggle_all.attr('aria-expanded', 'false');                                                                    
                                                                          }
                                                                        });
                                                                    </script>  
                                                                                 <?php $cek_rows = ''; } ?>     
                                                                                 </td> 
                                                                               <?php }else{?>   
                                                                                 <td colspan="6"></td>
                                                                                <?php }?>                                                                           
                                                                                </tr>  
                                                                              <?php } ?>                                                                               
                                                                            </tbody>
                                                                          <?php } ?>
                                                    					</table>                                                                       
                                                    				</div>            
                                                                       <?php }?>                                                        
                                                                        <?php        
                                                                           } }  
                                                                         ?>        
                                                                  </div>
                                                            
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                                            <?php }} ?>
                                           <!-- </tbody>
                                          </table>-->
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
  ///var key_snp = $('#rasetnis_cari_kata').val();
  /*if (key_snp == '') {
    key_snp = '';
    $.ajax({
      type: "POST",
      url: "<?php //echo base_url('home/snp_rasetnis_cari')?>",
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
  }*/
  // get uri
  /*const currentUrl = window.location.href;
    var arr=currentUrl.split('/');//arr[0]='example.com' //arr[1]='event' //arr[2]='14aD9Uxp?p=10'
    var parameter = arr[arr.length-1].split('?');//parameter[0]='14aD9Uxp' //parameter[1]='p=10'
    var p_value=parameter[1].split('=')[1];//p_value='10';
    var parameter1= parameter[1].split('=')[0]                                        
  */
  // if(parameter1=='per_page'){ //alert('ok');
            /*$.ajax({
                type : "POST",
                url  : "<?php //echo base_url('home/snp_rasetnis_cari')?>",
                dataType : "HTML",
                ///dataType : "json",
                data : {key: key, data_page: Y},
                success: function(res){
                    $("#rasetnis_hasil_cari").html(res);
                },error: function(data){     
                    Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                    })
                }
            });*/
   //}
 
  
        $("#rasetnis_cari_kataxx").keyup(function(){
            var key = $('#rasetnis_cari_kata').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('home/snp_rasetnis_cari')?>",
                dataType : "HTML",
                ///dataType : "json",
                data : {key: key},
                success: function(res){
                    $("#rasetnis_hasil_cari").html(res);
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

<!-- JAVASCRIPT -->
<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>


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

<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets_front/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>