<script src='https://www.google.com/recaptcha/api.js'></script>
                    <!--Title Page Start -->
                    <!--<div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18" style="color: white;"><?= $detail['judul'] ?></h4>
                            </div>
                        </div>
                    </div>-->
                    
                    <!-- Title Page End -->
<div class="container" style="margin-top:7.5%;">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-mitra mt-3">
                <?php if($detail['cover'] == ''){
                    $link_gbr = "assets_front/logo/no-image.png";
                }
                ?>
                <?php if($detail){?>
                    <center><img class="img-fluid card-img-top mt-3" src="<?= ($detail['cover']!="") ? base_url('uploads/cover_konten/'.$detail['cover'].'') : base_url($link_gbr) ?>" alt="Logo"></center>
                <?php } ?>
                <div class="card-body">
                    <h4 class="font-weight-bold text-center"><?= $detail['penulis'] ?></h4>
                </div>
              </div>
            </div>
            <div class="col-md-8 mt-2">
                <div class="blog-details content rmb-75 card">
                    <div class="blog-standard-item card-body">
                        <h3 class="font-weight-bold pusdahamnas-judul text-left"><?= $detail['judul'] ?></h3>
                                   <?php
                                   if(decrypt($this->session->id)== $detail['id_user'] && $this->session->username=='andiek123'){
                                        echo "<form id='form-konten-user' class='form form-horizontal' action='#' autocomplete='off' method='POST'>"; 
                                        echo "<div class='form-body'>";                                        
                                          $id_konten= encrypt($detail['id']);
                                          echo "<input type='text' class='form-control' value='$id_konten' id='id' name='id' hidden>";
                                          echo "<button type='submit' class='btn btn-dangger mt-1' style='color:red;'> <i class='fas fa-trash'></i> Hapus</button>";  
                                        echo "</div>";
                                        echo "</form>";
                                    } ?> 
                        <hr/>
                        <ul class="blog-meta">
                            <li><i class="fas fa-calendar"></i><span><?= formatTanggal(date('Y-m-d', strtotime($detail['created_at']))) ?></span></li>
                            <li><i class="fas fa-user"></i><span><?= $detail['penulis'] ?></span></li>
                            <li><i class="fas fa-database"></i><span><?= $detail['sumber_data'] ?></span></li>
                        </ul>

                        <div class="mt-4 mb-3">
                            <?= $detail['isi_konten'] ?>
                            <!-- <?php if ($detail['link']!=null && $detail['link']!='') { ?>
                            <a class="btn btn-primary" href="<?= $detail['link'] ?>" target="_blank"><i class="bx bx-download font-size-16 mr-1"></i> Lihat Dokumen sebagai PDF</a>
                            <?php } else if ($detail['file_path']!=null && $detail['file_path']!='') { ?>
                            <a class="btn btn-primary" href="<?= link_file($detail['id'], 'tb_dokumen', 'd') ?>" target="_blank"><i class="bx bx-download font-size-16 mr-1"></i> Lihat Dokumen sebagai PDF</a>
                            <?php } else { ?>
                            <a class="btn btn-primary" href="javascript:;"><i class="bx bx-download font-size-16 mr-1"></i> Lihat Dokumen sebagai PDF</a>
                            <?php } ?> 
                            <a class="btn btn-primary" href="javascript:;" data-toggle="modal" data-target="#form_download"><i class="bx bx-download font-size-16 mr-1"></i> Lihat Dokumen sebagai PDF</a>
                            -->
                            <div class="blog-footer d-flex flex-wrap align-items-center pt-25">
                                  <div class="tags mb-10 mr-auto">
                                    <b>Sumber Data:</b>
                                    <li><a href="#"> <i class="fas fa-tag"></i><?= $detail['sumber_data'] ?></a></li>
                                  </div>
                                <div class="social mb-10">
                                    <b>Share :</b>
                                    <a class="text-dark" id="fb"><i class="fab fa-facebook"></i></a>
                                    <a class="text-dark" id="tw"><i class="fab fa-twitter"></i></a>
                                    <!-- <a href="https://instagram.com" class="text-dark"><i class="fab fa-instagram"></i></a>-->
                                    <br/>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" 
                                    id="copyText"
                                    value="<?php echo current_url(); ?>"
                                    aria-describedby="inputGroupCopylink"
                                    readonly
                                    />
                                    <div class="input-group-append">
                                    <button
                                        class="btn btn-primary"
                                        id="copyBtn"
                                    >
                                    Salin
                                    </button>
                                    </div>
                                </div>
                            </div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
                            <button id="toggle_all" class="btn btn-primary mb-4" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2 multiCollapseExample3"><i class="fas fa-comment"></i> Buka Komentar</button>                            <div class="row">
                              <div class="col">
                                <!--<div class="collapse multi-collapse"   id="multiCollapseExample1">
                                <?php 
                                  /*if($data_pesan){
                                    foreach ($data_pesan as $pesan) {
                                      if ($pesan->pesan != "" && $pesan->id_user ==30) {
                                  ?>
                                  <img src='<?php //echo base_url('assets/img/user.png')?>' class='rounded-circle' alt='Gambar' width="35" height="35">
                    
                                  <?php
                                  echo "<strong>".$pesan->username."</strong>";
                                  $pesan     = $pesan->pesan;
                                  echo "<br>";
                                  echo "<div class='card card-body' style='width: 18rem;'>";
                                  echo $pesan; 
                                  echo "</div>";
                                }     
                              }  
                            } */
                            ?>  
                            </div>-->
                              <div class="collapse multi-collapse" style="float: right;" id="multiCollapseExample2">
                                <?php
                                  if($data_pesan){
                                    foreach($data_pesan as $pesan){
                                      if($pesan->pesan != ""){
                                        ?>
                                        <img src='<?php echo base_url('assets/img/user.png')?>' class='rounded-circle' alt='Gambar' width="35" height="35">
                                        <?php
                                    echo "<form id='form-pesan-user' class='form form-horizontal' action='#' autocomplete='off' method='POST'>"; 
                                    echo "<div class='form-body'>";
                                        echo "<strong>".$pesan->username."</strong>";
                                        $isi_pesan = $pesan->pesan;
                                        echo "<br/>";
                                        echo "<div class='card card-body' style='width: 18rem;'>";
                                        echo $isi_pesan;
                                        
                                        if(decrypt($this->session->id)== $pesan->id_user){
                                          $id_pesan = encrypt($pesan->id_pesan);
                                          echo "<input type='text' class='form-control' value='$id_pesan' id='id_msg' name='id_msg' hidden>";
                                          echo "<button type='submit' class='btn btn-dangger mt-1' style='color:red;'> <i class='fas fa-trash'></i> Hapus</button>";  
                                        } 
                                        echo "</div>";
                                    echo "</div>";
                                    echo "</form>"; 
                                           
                                      }
                                    }
                                  }
                                ?>
                              </div>
                              <div class="collapse multi-collapse" id="multiCollapseExample3">
                                <?php
                                  if(!$this->session->nama){
                                    echo "<form class='form form-horizontal' action='#' autocomplete='off' enctype='multipart/form-data' method='POST'>"; 
                                    echo "<div class='form-body'>";
                                    echo "<div><textarea type='text' class='form-control' value='' id='pesanx' name='pesanx'  rows='10' cols='10'></textarea><input type='hidden' class='form-control' value='' id='id_kontenx'></div>";
                                    echo "<button type='submit' class='btn btn-primary mt-3 ' onclick='callSS()' href='javascript:;'> <i class='fas fa-paper-plane'></i> Kirim</button>";
                                    echo "</div>";
                                    echo "</form>";
                                  }else{ ?>
                                  <?php
                                    //if($this->session->tipe_daftar==1){
                                   //     echo "<script>alert('Akses terbatas, Komentar bukan untuk user pengunjung!')</script>";
                                    //}else{    
                                        if($this->session->tipe_daftar==2){
                                        echo "<form id='form-pesan' class='form form-horizontal' action='#' autocomplete='off' method='POST'>";
                                        echo "<div class='form-body'>";
                                        echo "<div><textarea type='text' class='form-control' value='' id='pesan' name='pesan' rows='10' cols='10'></textarea></div><input type='hidden' id='id_konten' name='id_konten' class='form-control' value=".encode_id($detail['id'])." ></div>";        
                                        echo "<button type='submit' class='btn btn-primary mt-3'> <i class='bx bx-check-circle'></i> Kirim</button>";
                                        echo "</div>";
                                        echo "</form>";
                                        }
                                    //}
                                  }
                                ?>
                              </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
<div class="col-md-12">
                              <div class="blog-sidebar">
                                <div class="widget news-widget wow fadeInUp delay-0-2s"></div>
                                <h3 class="widget-title">Berita Terkait:</h3>
                                <ul class="list-unstyled chat-list slider">
                                  <?php foreach ($terkait as $dok) {  ?>
                                    <li class="active mt-4 bg-card" id="<?=encode_id($dok['id'])?>">
                                      <a href="<?= base_url('home/detail_komham/'.encode_id($dok['id'])) ?>">
                                        <div class="media">
                                          <div class="mr-2 d-flex align-items-center">
                                            <i class="fas fa-book font-size-18 text-dark"></i>
                                          </div>
                                          <div class="media-body overflow-hidden pr-3 d-flex align-items-center">
                                            <h6 class="limit-3-line-text font-size-15 mb-2"><?= $dok['judul'] ?></h6>
                                          </div>
                                        </div>
                                      </a>
                                    <li>
                                  <?php } ?> 
                                </ul>
                              </div>
</div>
            
        </div>
    </div>
</div>
<!-- JQUERY OPTIONAL -->
<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Settings Komentar -->
<script type="text/javascript">
function callSS(){ 
    alert("Silahkan Melakukan pendaftaran/login sebelum komen!");
    window.location.href = "../../~/register";
}
</script>     
<script type="text/javascript">
var toggle_all = $('#toggle_all');
toggle_all.on('click', function(event) {
  if (toggle_all.attr("aria-expanded") === 'false') {
    $('.multi-collapse').collapse('show')
    toggle_all.attr('aria-expanded', 'true');
    document.getElementById("msg_konten").focus();
  } else {
    $('.multi-collapse').collapse('hide')
    toggle_all.attr('aria-expanded', 'false');
  }
});
$(document).ready(function () { 
    $('#form-konten-user').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
	  //	data.append(CSRF.token_name, CSRF.hash);
    //alert(data);    
		$.ajax({
  	        url: "<?php echo base_url('komunitasham/deleteKontenUser');?>",//$(this).prop('action'),
	 		type: "POST",
			data: data, 
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {
			
				if (res.status=='sukses') {
				    alert("Konten telah dihapus");
                    //location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    window.location = "<?php echo site_url('home/pegiat_ham'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else if (res.status=='akses') {
				    alert("Akses Terbaatas!");
                    ///location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else {
					toastrError('Gagal', 'Terjadi kesalahan data');
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash

			//	table.ajax.reload();
			},
             error: (res) => {
              if(JSON.stringify(res.status)==500){
                //return res.status(500).json({error: err});
                alert("Terjadi kesalahan di server!");
              } else {
                //return res.status(200).json({success: 'Insert row success'});
                //toastrSuccess('success_messages', "Pendaftaran berhasil");
                <?php //$this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil'); ?>
                alert("Konten telah dihapus");                
                window.location = "<?php echo site_url('home/pegiat_ham'); ?>";
              }
            }
		});  
    });    
    
    $('#form-pesan-user').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
	  //	data.append(CSRF.token_name, CSRF.hash);
    //alert(data);    
		$.ajax({
  	        url: "<?php echo base_url('komen_pegiatham/deleteMsgUser');?>",//$(this).prop('action'),
	 		type: "POST",
			data: data, 
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {
			
				if (res.status=='sukses') {
				    alert("Pesan telah dihapus");
                    location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else if (res.status=='akses') {
				    alert("Akses Terbaatas!");
                    location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else {
					toastrError('Gagal', 'Terjadi kesalahan data');
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash

			//	table.ajax.reload();
			},
             error: (res) => {
              if(JSON.stringify(res.status)==500){
                //return res.status(500).json({error: err});
                alert("Terjadi kesalahan di server!");
              } else {
                //return res.status(200).json({success: 'Insert row success'});
                //toastrSuccess('success_messages', "Pendaftaran berhasil");
                <?php //$this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil'); ?>
                alert("Pesan telah dihapus");
                    location.reload()
              }
            }
		});  
    });    
    
	$('#form-pesan').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
	  //	data.append(CSRF.token_name, CSRF.hash);
    //alert(data);    
		$.ajax({
  	        url: "<?php echo base_url('home/save_komen');?>",//$(this).prop('action'),
	 		type: "POST",
			data: data, 
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {
			
				if (res.status=='sukses') {
				    alert("Terima kasih");
                    location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else if (res.status=='akses') {
				    alert("Akses Terbaatas!");
                    location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else {
					toastrError('Gagal', 'Terjadi kesalahan data');
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash

			//	table.ajax.reload();
			},
             error: (res) => {//alert("Terjadi kesalahan di server3!");
              if(JSON.stringify(res.status)==500){
                //return res.status(500).json({error: err});
                alert("Terjadi kesalahan di server!");
              } else {
                //return res.status(200).json({success: 'Insert row success'});
                //toastrSuccess('success_messages', "Pendaftaran berhasil");
                <?php //$this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil'); ?>
                alert("Terima kasih, Komen anda akan di lakukan review terlebih dahulu");
                    location.reload()
              }
            }
		});
	});
  });  
</script>

<!-- Header -->
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
<!--using sweetalert via CDN -->
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
            const fb=document.getElementById('fb');
            fb.addEventListener('click', shareOnFacebook);

            function shareOnFacebook(){
                const navUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + '<?= current_url() ?>';
                window.open(navUrl , '_blank');
            }

            const tw = document.getElementById('tw');
            tw.addEventListener('click', shareOnTwitter);
            
            function shareOnTwitter(){
                const navUrl ='https://twitter.com/intent/tweet?text=' + '<?= current_url() ?>';
                window.open(navUrl, '_blank');
            }
        </script>    
<!--  -->
<!-- JAVASCRIPT -->
<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url() ?>assets_front/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>assets_front/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>assets_front/libs/node-waves/waves.min.js"></script>
<script src="https://ministry.phicos.co.id/front/pusdahamnas/assets/libs/social-sharing/socialSharing.js"></script>
<script src="<?= base_url() ?>assets_front/js/app.js"></script>