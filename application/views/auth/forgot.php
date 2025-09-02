<!DOCTYPE html>
<html lang="zxx">

<head>
	<!--====== Required meta tags ======-->
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<!--====== Title ======-->
	<title>Lupa sandi | Pusdahamnas Komnasham Republik Indonesia</title>
	<!--====== Favicon Icon ======-->
	<link rel="shortcut icon" href="<?= base_url() ?>assets_front/images/img-komnasham-favicon.png" type="image/x-icon">
	<!--====== Google Fonts ======-->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
	<!--====== Font Awesome ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/fontawesome.5.9.0.min.css">
	<!--====== Flaticon CSS ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/flaticon.css">
	<!--====== Bootstrap css ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/bootstrap.4.5.3.min.css">
	<!--====== Magnific Popup ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/magnific-popup.css">
	<!--====== Slick Slider ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/slick.css">
	<!--====== Animate CSS ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/animate.min.css">
	<!--====== Nice Select ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/nice-select.css">
	<!--====== Padding Margin ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/spacing.min.css">
	<!--====== Menu css ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/menu.css">
	<!--====== Main css ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/style.css">
	<!--====== Responsive css ======-->
	<link rel="stylesheet" href="<?= base_url() ?>assets_landing/css/responsive.css">

	<style>
		@media only screen and (min-width: 1283px) {
			.logo {
				width: 240px;
			}
		}

		@media only screen and (max-width: 1282px) {
			.logo {
				width: 200px;
			}
		}

		@media only screen and (max-width: 1269px) {
			.logo {
				width: 180px;
			}
		}

		@media only screen and (max-width: 1223px) {
			.logo {
				width: 140px;
			}
		}

		.logo-mobile {
			width: 70%;
			height: 100%;
		}
	</style>
	
	<script>
		(function (d) {
			var s = d.createElement("script");
			s.setAttribute("data-account", "gYvhBDoJQM");
			s.setAttribute("src", "https://accessibilityserver.org/widget.js");
			(d.body || d.head).appendChild(s);
		})(document)
	</script>
      
	<noscript>Please ensure Javascript is enabled for purposes of <a href="https://accessibilityserver.org">website accessibility</a></noscript>

</head>
<body data-topbar="dark" data-layout="horizontal">
	<div id="layout-wrapper"><!-- gradient -->
		<!--====== Header Part Start ======-->
		<header class="main-header header-three">
			<!--Header-Upper-->
			<div class="header-upper">
				<div class="container clearfix">
					<div class="header-inner py-20">
						<div class="logo-outer">
							<div class="logo"><a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets_landing/images/logos/logo-pusdahamnas.png" class="logo" alt="Logo"></a></div>
						</div>

						<div class="nav-outer d-flex align-items-center clearfix mx-lg-auto">
							<!-- Main Menu -->
							<nav class="main-menu navbar-expand-lg">
								<div class="navbar-header">
									<div class="logo-mobile"><a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets_landing/images/logos/logo-pusdahamnas.png" alt="Logo" class="logo-mobile"></a></div>
									<!-- Toggle Button -->
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="main-menu">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>

								<div class="navbar-collapse collapse clearfix" id="main-menu">
									<ul class="navigation clearfix" style="color:#333">
										<li class="" style="font-size: small;"><a href="<?= base_url() ?>" style="color:#333;">Beranda</a></li>
										<li class="dropdown"><a href="#" style="color:#333;">Data HAM</a>
											<ul>
												<li><a href="<?= base_url('home/data') ?>">Visualisasi Data</a></li>
												<li><a href="<?= base_url('home/media_analisis') ?>">Media Analisis</a></li>
											</ul>
										</li>
										<li class="dropdown" style="font-size: small;"><a href="#" style="color:#333;">Dokumen</a>
											<ul>
												<li><a href="<?= base_url('home/data_snp') ?>" style="text-color:#333">Standar Norma & Peraturan</a></li>
												<li><a href="<?= base_url('home/glossary') ?>" style="color:#333;">Glosarium</a></li>
											</ul>
										</li>
										<li class="dropdown" style="font-size: small;" style="color:#333;"><a href="#" style="color:#333;">Anggaran & Audit</a>
											<ul>
												<li><a href="<?= base_url('home/anggaran_ham') ?>" style="color:#333;">Anggaran HAM</a></li>
												<li><a href="<?= base_url('home/audit_ham') ?>" style="color:#333;">Audit HAM</a></li>
											</ul>
										</li>
										<li class="dropdown" style="font-size: small;"><a href="#" style="color:#333;">Komunitas Pegiat HAM</a>
											<ul>
												<li><a href="<?= base_url('home/lembaga') ?>" style="color:#333;">Lembaga HAM</a></li>
											</ul>
										</li>
									</ul>
								</div>

							</nav>

							<!-- Main Menu End-->

						</div>

						<div class="menu-right d-none d-lg-flex align-items-center">
							<!-- <a href="contact.html" class="login">Masuk <i class="fas fa-lock"></i></a> -->
							  
							<?php 
							if($this->session->tipe_daftar !=1 && $this->session->nama){?>
								<a href="<?=base_url('dashboard')?>"  class="btn btn-warning text-white">Dashboard</a>
							<?php    }else{
									//redirect(base_url());
								//echo '<a href="'. base_url('#') .'" class="theme-btn style-two"  style="font-size: small;width:18px;height:40px;">Daftar</a>&nbsp;';
								echo '<a href="'. base_url('home/login') .'" class="theme-btn style-two" style="font-size: small;width:85px;height:40px;">Masuk <i class="fas fa-arrow-right"></i></a>';
							} ?>
						</div>

					</div>
				</div>
			</div>
			<!--End Header Upper-->

		</header>
       </div> 
		<!--====== Header Part End ======-->
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

        <!--<div class="main-content">
            <div class="page-content">
                <div class="container-fluid">-->
                    <?php
                   $url_get = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";                   
                       if($url_get=='http://devpusdahamnas.komnasham.go.id/'){
                         echo "<marquee><span style='color: black;'>Ini adalah Website PUSDAHAMNAS yang sedang dalam Proses pengembangan. 
                               Sedangkan website PUSDAHAMNAS yang production tetap dapat di akses pada https://pusdahamnas.komnasham.go.id</span></marquee>";
                         
                       } 
                ?>                
                    <!-- Title Page Start -->
                <div class="container">
                  <div class="row" style="text-align: center;">
                	<div class="col-md-4" style="margin-top: 3%;"></div>
                    <div class="col-md-4" style="margin-top: 10%;">
                		<div class="card" style="margin-bottom:0px;">
                			<div class="card-body" style="margin-top: 8%;">
			            	<h5>Form Lupa Sandi</h5>
                				<div class="display_form_registrasi">
										<!--<form id="form-login" action="<?= site_url('auth/process') ?>" method="post">
											<?php if ($this->session->flashdata('error_messages')) : ?>
												<div class="alert alert-danger alert-dismissible fade show" role="alert">
													<i class="mdi mdi-block-helper mr-2"></i>
													<?= $this->session->flashdata('error_messages') ?>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
											<?php endif ?>

											<input type="hidden" name="<?= @csrf()['token_name'] ?>" value="<?= @csrf()['hash'] ?>" autocomplete="new-password">

											<div class="form-group">
												<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" autofocus>
											</div>

											<div class="form-group">
												<div class="input-group">
													<input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi">
													<div class="input-group-append">
														<button type="button" class="btn bg-theme-custom text-white" id="show-password"><i class="bx bx-show"></i></button>
													</div>
												</div>

											</div>

											<div class="form-group">
												<?= recaptchaDisplay() ?>
											</div>
											<div class="mt-3">
												<button class="btn btn-primary" onclick="history.go(-1)" type="submit">Batal</button>
												<button class="btn btn-primary" type="submit">Login</button>
											</div> 
										</form>-->
                                        
										<form id="form-login" action="<?php echo base_url('auth/request_password');?>" method="post">
											<?php if ($this->session->flashdata('error_messages')) : ?>
												<div class="alert alert-danger alert-dismissible fade show" role="alert">
													<i class="mdi mdi-block-helper mr-2"></i>
													<?= $this->session->flashdata('error_messages') ?>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
											<?php endif ?>
									<?php if ($this->session->flashdata('success_messages')) : ?>
												<div class="alert alert-success alert-dismissible fade show" role="alert">
													<i class="mdi mdi-block-helper mr-2"></i>
													<?= $this->session->flashdata('success_messages') ?>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
											<?php endif ?>
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                							<div class="form-group input-group">
                                        	  <div class="input-group-prepend">
                                    		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    		  </div>
                									<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="" required>
                							</div>
                                            <div class="form-group input-group">
                                        	  <div class="input-group-prepend">
                                    		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    		  </div>
                									<input type="email" class="form-control" id="email" name="email" placeholder="Nama Email" value="" required>
                							</div>
                						<div class="form-group">
                							<?= recaptchaDisplay() ?>
                						</div>    
											<div class="mt-2">
												<button class="btn btn-primary" style="width: 80px;" onclick="history.go(-1)" type="submit">Batal</button>											    
												<button class="btn btn-primary" style="width: 80px;" type="submit">Kirim</button>
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
                    <div class="col-md-4" style="margin-top: 3%;"></div>
                  </div>
               </div>
        	<!--</div>
          </div>
       </div>-->
<!-- end main content-->
<!-- JAVASCRIPT -->
<?= isset($_js) ? $_js : ''; ?>

    
	<?= recaptchaRenderJs() ?>

	<link rel="stylesheet" href="<?= themeUrl() ?>assets/libs/toastr/build/toastr.min.css">
	<script src="<?= themeUrl() ?>assets/libs/jquery/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    
 

	<!-- Scroll Top Button -->
	<button class="scroll-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></button>


	<!--====== Jquery ======-->
	<script src="<?= base_url() ?>assets_landing/js/jquery-3.6.0.min.js"></script>
	<!--====== Bootstrap ======-->
	<script src="<?= base_url() ?>assets_landing/js/bootstrap.4.5.3.min.js"></script>
	
	<!--====== Appear js ======-->
	<script src="<?= base_url() ?>assets_landing/js/appear.js"></script>
	<!--====== WOW js ======-->
	<script src="<?= base_url() ?>assets_landing/js/wow.min.js"></script>
	<!--====== Isotope ======-->
	<script src="<?= base_url() ?>assets_landing/js/isotope.pkgd.min.js"></script>
	<!--====== Circle Progress ======-->
	<script src="<?= base_url() ?>assets_landing/js/circle-progress.min.js"></script>
	<!--====== Image loaded ======-->
	<script src="<?= base_url() ?>assets_landing/js/imagesloaded.pkgd.min.js"></script>
	<!--====== Nice Select ======-->
	<script src="<?= base_url() ?>assets_landing/js/jquery.nice-select.min.js"></script>
	<!--====== Magnific ======-->
	<script src="<?= base_url() ?>assets_landing/js/jquery.magnific-popup.min.js"></script>
	<!--====== Slick Slider ======-->
	<script src="<?= base_url() ?>assets_landing/js/slick.min.js"></script>
	<!--====== Main JS ======-->
	<script src="<?= base_url() ?>assets_landing/js/script.js"></script>
	<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
</body>
</html>

<script type="text/javascript">
	$('#form-login-').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
	//	data.append(CSRF.token_name, CSRF.hash);
    //alert(data);    
		$.ajax({
  	        url: "<?php echo base_url('auth/process-');?>",//$(this).prop('action'),
	 		type: "POST",
			data: data, 
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {

				if (res.status=='true') {
				    //alert("Login berhasil...");
                    //window.location(history.go(-1));
                    //location.reload()
					toastrSuccess('success_messages', "Login berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else if (res.status=='error') {
				    //alert(res.messages);
                    toastrError('error_messages', 'Username atau password salah');
                    //window.location(history.go(-1));
                    //location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else {
					alert(res.messages);
                    toastrError('error_messages', 'Username Pengguna sedang dinonaktifkan');
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash

			//	table.ajax.reload();
			},
             error: (res) => {///
             //alert(res.status + res.message);
              if(JSON.stringify(res.status)==500){
                //return res.status(500).json({error: err});
                alert("Terjadi kesalahan di server!");
              } else {
                //return res.status(200).json({success: 'Insert row success'});
                //toastrSuccess('success_messages', "Pendaftaran berhasil");
                <?php //$this->session->set_flashdata('success_messages', 'Simpan Data Berhasil'); ?>                
                alert("Terjadi kesalahan di server2!");
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
<script type="text/javascript">
let width = $('.g-recaptcha').parent().width();
if (width < 302) {
	let scale = width / 302;
	$('.g-recaptcha').css('transform', 'scale(' + scale + ')');
	$('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
	$('.g-recaptcha').css('transform-origin', '0 0');
	$('.g-recaptcha').css('-webkit-transform-origin', '0 0');
}

let show_password = false;
$('#show-password').on('click', function () {
	if (!show_password) {
		$('#password').prop('type', 'text');
		show_password = true;
	} else {
		$('#password').prop('type', 'password');
		show_password = false;
	}
})

let width = $('.g-recaptcha').parent().width();
if (width < 302) {
	let scale = width / 302;
	$('.g-recaptcha').css('transform', 'scale(' + scale + ')');
	$('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
	$('.g-recaptcha').css('transform-origin', '0 0');
	$('.g-recaptcha').css('-webkit-transform-origin', '0 0');
}

let validator = $('#form-login').validate({
	errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
	errorElement: 'div',
	errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
	highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
	unhighlight: (element) => $(element).removeClass('is-invalid').addClass('is-valid'),
	success: (element) => $(element).remove(),
	rules: {
		username: "required",
		password: {
			required: true,
			minlength: 6
		},
	},
	messages: {
		username: "Username tidak boleh kosong",
		password: {
			required: 'Kata sandi tidak boleh kosong',
			minlength: 'Kata sandi minimal 6 karakter'
		},
	}
});
</script>


