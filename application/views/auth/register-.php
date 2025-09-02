<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title><?= sistem()->nama ?> - Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="<?= sistem()->deskripsi ?>" name="description" />
	<meta content="<?= sistem()->author ?>" name="author" />
	<meta content="<?= @csrf()['token_name'] ?>" name="csrf-token_name" />
	<meta content="<?= @csrf()['hash'] ?>" name="csrf-hash" />
	<meta content="<?= base_url() ?>" name="base_url" />
	<meta content="<?= bin2hex(base64_encode(config_item('cryptojs_aes_password'))) ?>" name="cryptoJsAes" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= base_url('assets/img/img-komnasham-favicon.png') ?>">

	<!-- owl.carousel css -->
	<link rel="stylesheet" href="<?= themeUrl() ?>assets/libs/owl.carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= themeUrl() ?>assets/libs/owl.carousel/assets/owl.theme.default.min.css">

	<!-- Bootstrap Css -->
	<link href="<?= themeUrl() ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?= themeUrl() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="<?= themeUrl() ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

	<link rel="stylesheet" href="<?= themeUrl() ?>assets/libs/toastr/build/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css?q=' . random_string()) ?>">
</head>

<body class="auth-body-bg" style="background-image: url('<?= base_url('assets/img/komnasham.jpg') ?>'); background-size: cover; background-position: top center; min-height: 700px;">
	<!-- Loader -->
	<div id="preloader">
		<div id="status" class="status-preloader">
			<div class="spinner-chase">
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
			</div>
		</div>
	</div>
<div class="container">
<div class="card bg-light" style="text-align: center; background-image: url('<?= base_url('assets/img/komnasham.jpg') ?>'); background-size: cover; background-position: top center; min-height: 700px;">
		<div class="container-fluid p-0">
			<div class="row no-gutters">
<article class="card-body mx-auto" style="max-width: 400px;background-color: white;margin-top: 5%;">
<img src="<?= base_url('assets/img/logo-pusdahamnas-dark.png') ?>" alt="logo" height="45" class="auth-logo-dark">
	<h4 class="card-title mt-3 text-center">Pendaftaran</h4><hr />
	<form id="form-register" action="<?= site_url('auth/processReg') ?>" method="post">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input id="name" name="name" class="form-control" placeholder="Nama Panjang" type="text" autofocus>
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input id="email" name="email" class="form-control" placeholder="Alamat Email" type="email">
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input id="username" name="username" class="form-control" placeholder="User pengguna" type="text">
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
		</div>
		<select id="tipe_daftar" onchange="callForm()" name="tipe_daftar" class="form-control" required>
			<option value="" selected>- Pilih Tipe pendaftaran -</option>
			<option value="1">Pengunjung</option>
			<option value="2">Komunitas HAM</option>
		</select>
	</div> 
    <!-- form komunitas -->  
  <div id="form_komunitas" style="display: none;">                           
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		 </div>
        <input id="telepon" name="telepon" class="form-control" placeholder="Telepon" type="text">
    </div>                            
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="bx bxl-instagram font-size-14"></i> </span>
		 </div>
        <input id="instagram" name="instagram" class="form-control" placeholder="instagram" type="text">
    </div>                          
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="bx bxl-linkedin font-size-14"></i> </span>
		 </div>
        <input id="linkedin" name="linkedin" class="form-control" placeholder="linkedin" type="text">
    </div>
                            
  <div class="row mb-1">
				<div class="col-md-12">
					<h4 class="card-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
						<i class="bx bx-building-house"></i> S2
					</h4>
				</div>
			</div>
             
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		 </div>
        <input id="s2_bidang" name="s2_bidang" class="form-control" placeholder="Bidang" type="text">
    </div>    
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		 </div>
        <input id="s2_universitas" name="s2_universitas" class="form-control" placeholder="Universitas" type="text">
    </div>   
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		 </div>
        <input id="s2_tahun_masuk" name="s2_tahun_masuk" class="form-control" placeholder="Tahun Masuk" type="text">
    </div>   
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		 </div>
        <input id="s2_tahun_lulus" name="s2_tahun_lulus" class="form-control" placeholder="Tahun Lulus" type="text">
    </div>

      <div class="row mb-1">
					<div class="col-md-12">
						<h4 class="card-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
							<i class="bx bx-building-house"></i> S3
						</h4>
					</div>
				</div>
   
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		 </div>
        <input id="s3_bidang" name="s3_bidang" class="form-control" placeholder="Bidang" type="text">
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		 </div>
        <input id="s3_universitas" name="s3_universitas" class="form-control" placeholder="Universitas" type="text">
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		 </div>
        <input id="s3_tahun_masuk" name="s3_tahun_masuk" class="form-control" placeholder="Tahun Masuk" type="text">
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		 </div>
        <input id="s3_tahun_lulus" name="s3_tahun_lulus" class="form-control" placeholder="Tahun Lulus" type="text">
    </div>
   </div> 
    <!--/ end -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input id="password" name="password" class="form-control" placeholder="Masukkan kata sandi" type="password">
    	<div class="input-group-prepend">
		    <span id="show-password" class="input-group-text"> <i class="fa fa-eye"></i> </span>
		</div>
    </div> 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input id="password2" name="password2" class="form-control" placeholder="Ulang kata sandi" type="password">
         
    	<div class="input-group-prepend">
		    <span id="show-password2" class="input-group-text"> <i class="fa fa-eye"></i> </span>
            <span id='message_password'></span>
		</div>
    </div>                     
    <div class="d-flex mb-5 align-items-center">
        <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Setujui Syarat dan <a href="#">Ketentuan kami</a></span>
        <input id="check_term" type="checkbox"/>        
            <span id='message_term'></span>
        <div class="control__indicator"></div>
        </label>
    </div>               
    <div class="form-group">
        <button id="btn_register" type="submit" class="btn btn-primary btn-block"> Daftar  </button>
    </div>     
    <a href="<?=base_url('')?>" style="color: blue;">Kembali</a> 
    <p class="text-center">Sudah memiliki akun? <a href="<?=base_url('~/login')?>">Masuk</a> </p>                                                                 
</form>
</article></div></div>
</div> <!-- card.// -->
</div> 
<script type="text/javascript">
function callForm(){
    var dt = $('#tipe_daftar').val();
    if(dt==1){
        document.getElementById( 'form_komunitas' ).style.display = 'none';
    }else if(dt==2){
        document.getElementById( 'form_komunitas' ).style.display = 'block';
    }else{
        document.getElementById( 'form_komunitas' ).style.display = 'none';
    }
}
</script>
<!--container end.//-->
<footer class="landing-footer py-4">
    <div class="container-fluid">
        <div class="text-center">
            <h5 class="mb-3 footer-list-title">Kontak Pusdahamnas</h5>
            <p><i class="bx bx-map mr-1"></i> Lantai 17 Hayam Wuruk Tower.
                Jl. Hayam Wuruk No.108, RT.4/RW.9, Maphar, Kec. Taman Sari, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11160</p>
            <p><i class="bx bx-envelope mr-1"></i> pusdahamnas@komnasham.go.id</p>

            <div class="d-flex mt-4 team-social-links justify-content-center">
                <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Facebook">
                    <i class="bx bxl-facebook-circle font-size-14"></i>
                </a>&nbsp;
                <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Instagram">
                    <i class="bx bxl-instagram font-size-14"></i>
                </a>&nbsp;
                <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Twitter">
                    <i class="bx bxl-twitter font-size-14"></i>
                </a>&nbsp;
                <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Youtube">
                    <i class="bx bxl-youtube font-size-14"></i>
                </a>
            </div>
        </div>

        <hr class="footer-border my-4">

        <p class="text-center mb-0">Hak Cipta Komnas HAM Republik Indonesia © <script>
                document.write(new Date().getFullYear())
            </script>
        </p>
    </div>
</footer>

	<!-- JAVASCRIPT -->
	<script src="<?= themeUrl() ?>assets/libs/jquery/jquery.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/node-waves/waves.min.js"></script>

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
	<script src="<?= base_url('assets/js/pages/auth/register.js?q=' . random_string()) ?>"></script>
	<?= recaptchaRenderJs() ?>
 </body>

</html>