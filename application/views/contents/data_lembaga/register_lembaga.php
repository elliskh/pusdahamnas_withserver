  <!-- Favicon -->
    <link rel='shortcut icon' href='<?= base_url() ?>assets_front/images/img-komnasham-favicon.png'>
  <style>
        .form-control {
            font-size: 1rem !important;
        }

        @media screen and (min-width: 1024px) {
            .nav-span {
                font-weight: bold;
            }
        }

        @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
            .nav-span {
                font-size: 8px !important;
            }
        }

    body {
      /* background-image: url(../../assets/img/bg_new.png);
      background-image: url('https://cdn.pnghd.pics/data/9/background-batik-vector-png-27.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      width: 100% !important; */
      background-image: url('https://cdn.pnghd.pics/data/9/background-batik-vector-png-27.jpg');
      /* background-color: #EAEDED !important; */
    }
  </style>

  <?= isset($_css) ? $_css : ''; ?>

  <script>
    (function (d) {
      var s = d.createElement("script");
      s.setAttribute("data-account", "gYvhBDoJQM");
      s.setAttribute("src", "https://accessibilityserver.org/widget.js");
      (d.body || d.head).appendChild(s);
    })(document)
  </script>
  <noscript>Please ensure Javascript is enabled for purposes of <a href="https://accessibilityserver.org">website accessibility</a></noscript>

  <title>Pendaftaran | Pusdahamnas Komnasham Republik Indonesia</title>

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-WLXJVQRB3H"></script>
  
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-WLXJVQRB3H');
  </script>
</head>
<style>
    .img-logo {
        width: 100%;
        max-width: 820px;
    }

    .box-icon {
        font-size: 20px !important;
    }

    .breadcrumb {
        background-color: transparent !important;
    }

    #title_isu {
        font-size: 20px;
        text-transform: capitalize;
        font-weight: bold;
    }
</style>
<style type="text/css">
.gradient {
  height: 100px;
  background-color: white;
  background-image:
    linear-gradient(
      to right, 
      #e7dc07, #ffffff
    );
}
</style>
<body data-topbar="dark" data-layout="horizontal">
  <div id="layout-wrapper" class="hero-section-three rel z-2 pt-105 rpt-150 pb-130 rpb-100">
    <header id="page-topbar">
      <div class="navbar-header">
        <div class="d-flex" style="width:25%">
          <!-- Bilingual -->
          <!--<div class="dropdown d-inline-block">
                        <span id="ttg_kami"> 
                            <a href="<?php echo base_url('home/about')?>">
                                <span style="font-size: small;color:black;">Tentang Kami</span>
                            </a>
                            <a href="<?php echo base_url('home/kontak')?>">
                                <span style="font-size: small;color:black;">
                            &nbsp;|&nbsp;Hubungi Kami</span>
                            </a>
                        </span> 
                        <span style="color: blue;">
                        <?php 
                           if($this->session->tipe_daftar || $this->session->nama){
                            echo strtoupper($this->session->nama);
                            echo "<a href='auth/logout_front'> | Keluar</a></li>";                            
                            }
                        ?>
                        </span>
                    </div>-->

          <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
            <i class="fa fa-fw fa-bars"></i>
          </button>
        </div>
      </div>
    </header>
    <style type="text/css">
      .grad9isuH {
        background-image: linear-gradient(to bottom right, #e9e9ec, white);
      }
    </style>
    <style type="text/css">
      .dropdown-menu li {
        position: relative;
      }

      .dropdown-menu .dropdown-submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
      }

      .dropdown-menu .dropdown-submenu-right {
        left: 100%;
        left: auto;
      }

      .dropdown-menu>li:hover>.dropdown-submenu {
        display: block;
      }

      .menu-toggle {
        color: white;
      }

      @media only screen and (max-width: 771px) {
        .sidebar {
          transform: translateY(0);
          transition: all .25s ease-in-out;
        }

        #ttg_kami {
          display: none;
        }
      }
    </style>

    <!-- start main content -->

    <div class="main-content">
      <div class="page-content">
        <div class="container-fluid">
          <?php
                   $url_get = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";                   
                       if($url_get=='http://devpusdahamnas.komnasham.go.id/'){
                         echo "<marquee><span style='color: black;'>Ini adalah Website PUSDAHAMNAS yang sedang dalam Proses pengembangan. 
                               Sedangkan website PUSDAHAMNAS yang production tetap dapat di akses pada https://pusdahamnas.komnasham.go.id</span></marquee>";
                         
                       } 
                ?>
          <!-- Title Page Start -->
          <div class="container-" style="margin-top: 8%;margin-bottom: 3%;">
            <div class="row">
              <div class="col-md-8 offset-md-2">
                <div class="card">
                  <div class="card-body">
                    <div class="display_form_registrasi">
                      <form id="form-register-lembaga" action="#" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <div class="row mt-1 mb-1">
                          <div class="col-md-6 col-sm-8">
                            <h4> Form Daftarkan Lembaga HAM</h4>
                          </div>
                          <div class="col-md-6 col-sm-4">
                            <div class="text-right">
                              <a href="<?=base_url('home/lembaga')?>" class="btn btn-link text-right">
                                <i class="bx bx-left-arrow-circle"></i> Kembali</a>
                            </div>
                          </div>
                        </div>
                        <div class="form-group input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                          </div>
                          <input type="text" class="form-control" value="" name="menu_id" hidden>
                          <input type="text" class="form-control" value="" name="id" hidden>
                          <input type="text" class="form-control" style="height: 15px;" id="nama_pendaftar" name="nama_pendaftar" placeholder="Nama Lengkap" value="" required>
                        </div>
                        <div class="form-group input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                          </div>
                          <input type="text" class="form-control" value="" name="menu_id" hidden>
                          <input type="text" class="form-control" value="" name="id" hidden>
                          <input type="text" class="form-control" style="height: 15px;" id="nama_lembaga" name="nama_lembaga" placeholder="Nama Lembaga HAM" value="" required>
                        </div>
                        <div class="form-group input-group">
                          <div class="input-group-prepend" style="height:39px;">
                            <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                          </div>
                          <select name="propinsi" id="propinsi" class="form-control select2-container select2" required>
                            <option class="form-control" style="height: 3%;" value="" disabled="" selected>Pilih Propinsi</option>
                            <?php
                										foreach ($this->db->get('ref_propinsi')->result_array() as $rr)
                										{
                											$select="";
                											if ($rr['code']==$data->prop_lembaga)
                											{
                												$select="selected";
                											}
                											echo "<option class='select2-container form-control' value='".$rr['id']."' ".$select.">".$rr['name']."</option>";
                										}
                										?>
                          </select>
                        </div>
                        <div class="form-group input-group">
                          <div class="input-group-prepend" style="height:39px;">
                            <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                          </div>
                          <select name="kabkota" id="kabkota" class="form-control select2-container select2" style="height: 15px;" required>
                            <option value="" disabled="" selected>Pilih Kab/Kota</option>
                            <?php
                                                        
                									//	if (@$data->prop_lembaga!="")
                									//	{
                											$kodeprop=$this->db->where('code',$data->prop_lembaga)->get('ref_propinsi')->row_array()['id'];
                											foreach ($this->db->where('provinceId',$kodeprop)->get('ref_kabupaten')->result_array() as $rr)
                											{
                												$select="";
                												if ($rr['id']==$data->fokus_lembaga)
                												{
                													$select="selected";
                												}
                												echo "<option value='".$rr['id']."' ".$select.">".$rr['name']."</option>";
                											}
                									//	}
                										?>
                          </select>
                        </div>
                        <div class="form-group input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                          </div>
                          <textarea name="alamat" class="form-control" value="" rows="5" placeholder="Alamat Lembaga" required></textarea>
                        </div>

                        <div class="form-group input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                          </div>
                          <input name="email" type="email" class="form-control" style="height: 15px;" placeholder="Email Lembaga" value="" required>
                        </div>

                        <div class="form-group input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                          </div>
                          <input name="telepon" type="text" class="form-control" style="height: 15px;" placeholder="No Telepon Lembaga" value="" required>
                        </div>
                        <div class="form-group input-group">
                          <div class="input-group-prepend">
                          <span class="input-group-text">Logo Lembaga</span>
                            <span class="input-group-text"> <i class="fa fa-image"></i> </span>
                          </div>
                          <input type="file" class="form-control" name="gambar" id="gambar" value="">
                        </div>
                        <div class="form-group input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                          </div>
                          <textarea name="keterangan" class="form-control" value="" rows="5" placeholder="Keterangan" required></textarea>
                        </div>
                        <div class="form-group">
                          <?= recaptchaDisplay() ?>
                        </div>
                        <div class="form-group">
                          <button id="btn_register" type="submit" form="form-register-lembaga" class="btn btn-primary btn-block"><i class="bx bx-check-circle"></i> Daftar </button>
                        </div>
                      </form>
                    </div>


                    <div class="row mb-2">
                      <div class="col-sm-12">
                        <div class="text-sm-right">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- end main content-->
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
    
	<?= recaptchaRenderJs() ?>

</body>
</html>
<script type="text/javascript">
let width = $('.g-recaptcha').parent().width();
if (width < 302) {
	let scale = width / 302;
	$('.g-recaptcha').css('transform', 'scale(' + scale + ')');
	$('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
	$('.g-recaptcha').css('transform-origin', '0 0');
	$('.g-recaptcha').css('-webkit-transform-origin', '0 0');
}

let validator = $('#form-register').validate({
	errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
	errorElement: 'div',
	errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
	highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
	unhighlight: (element) => $(element).removeClass('is-invalid').addClass('is-valid'),
	success: (element) => $(element).remove(),
	rules: {
		name: "required",
		email: "required",
		username: "required",
		tipe_daftar: "required",
		password: {
			required: true,
			minlength: 8
		},
        password2: {
			required: true,
			minlength: 8
		},
	},
	messages: {
		name: "Nama tidak boleh kosong",
		email: "Email tidak boleh kosong",
		username: "Username tidak boleh kosong",
		tipe_daftar: "Tipe daftar tidak boleh kosong",
		password: {
			required: 'Kata sandi tidak boleh kosong',
			minlength: 'Kata sandi minimal 8 karakter'
		},
	}
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>

<style type="text/css">
.select2-container {
  max-width: 600px;
  height: 35px;
}
</style>

<script type="text/javascript">
	$('.select2').select2();

    $("#propinsi").change(function(){
           var id_provinces = $(this).val(); 

           $.ajax({
              type: "GET",
              dataType: "html",
              url: "<?php echo base_url('home/getkab')?>",
              data: "idprop="+id_provinces,
              success: function(msg){ 
                 $("select#kabkota").html(msg);                                                  
              }
           });                    
         }); 

</script>
<script type="text/javascript">
	$('#form-register-lembaga').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
	//	data.append(CSRF.token_name, CSRF.hash);
		$.ajax({
  	        url: "<?php echo base_url('home/simpan_lembaga');?>",//$(this).prop('action'),
	 		type: "POST",
			data: data, 
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {
			
				if (res.status=='sukses') {
				    alert("Terima kasih telah mendaftarkan Lembaga Anda, Sedang dalam proses peninjauan");history.go(-1);
                    //location.reload()
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
                alert("Terima kasih telah mendaftarkan Lembaga Anda, Sedang dalam proses peninjauan");history.go(-1);
              }
			/*error: (res) => {
                alert("Terjadi kesalahan di server!");
				//toastrError('Gagal', 'Terjadi kesalahan di server');
				//table.ajax.reload();
			}*/
            }
		});
	});
</script>

<style type="text/css">

.select2.select2-container {
  width: 100% !important;
}

.select2.select2-container .select2-selection {
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  height: 39px;
  margin-bottom: 15px;
  outline: none !important;
  transition: all .15s ease-in-out;
}

.select2.select2-container .select2-selection .select2-selection__rendered {
  color: #333;
  line-height: 36px;
  padding-right: 33px;
}

.select2.select2-container .select2-selection .select2-selection__arrow {
  background: #f8f8f8;
  border-left: 1px solid #ccc;
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
  height: 36px;
  width: 33px;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
  background: #f8f8f8;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
  -webkit-border-radius: 0 3px 0 0;
  -moz-border-radius: 0 3px 0 0;
  border-radius: 0 3px 0 0;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
  border: 1px solid #34495e;
}

.select2.select2-container .select2-selection--multiple {
  height: auto;
  min-height: 34px;
}

.select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
  margin-top: 0;
  height: 32px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__rendered {
  display: block;
  padding: 0 4px;
  line-height: 29px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice {
  background-color: #f8f8f8;
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: 4px 4px 0 0;
  padding: 0 6px 0 22px;
  height: 24px;
  line-height: 24px;
  font-size: 12px;
  position: relative;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 22px;
  margin: 0;
  text-align: center;
  color: #e74c3c;
  font-weight: bold;
  font-size: 16px;
}

.select2-container .select2-dropdown {
  background: transparent;
  border: none;
  margin-top: -5px;
}

.select2-container .select2-dropdown .select2-search {
  padding: 0;
}

.select2-container .select2-dropdown .select2-search input {
  outline: none !important;
  border: 1px solid #34495e !important;
  border-bottom: none !important;
  padding: 4px 6px !important;
}

.select2-container .select2-dropdown .select2-results {
  padding: 0;
}

.select2-container .select2-dropdown .select2-results ul {
  background: #fff;
  border: 1px solid #34495e;
}

.select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
  background-color: #3498db;
}
</style>
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