<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title><?= sistem()->nama ?> - Login</title>
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

<body class="auth-body-bg">
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

	<div>
		<div class="container-fluid p-0">
			<div class="row no-gutters">

				<div class="col-xl-9">
					<!-- <div class="auth-full-bg pt-lg-5 p-4" style="background-image: url('<?= base_url('assets/img/modern-city.jpg') ?>'); background-size: cover;"> -->
					<div class="auth-full-bg pt-lg-5 p-4" style="background-image: url('https://images.unsplash.com/photo-1549383028-df014fa3a325?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80'); background-size: cover;">
						<div class="w-100">
							<div class="d-flex h-100 flex-column">
								<div class="p-4 mt-auto">
									<div class="row justify-content-center">
										<div class="col-lg-7 pt-4 pb-2" style="background-color: #fff; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px; opacity: 0.8;">
											<div class="text-center">
												<h3 class="mb-0"><i class="bx bxs-quote-alt-left text-color-custom h1 align-middle mr-3 mb-0"></i>Sistem Informasi <span class="text-color-custom">PUSDAHAMNAS</span> </h3>
												<h4 class="text-color-custom"> </h4>
													<p>Sistem Informasi Pusat Sumber Daya Hak Asasi Manusia Nasional (Pusdahamnas) merupakan Program Prioritas Nasional pada Tahun Anggaran 2022-2024 sebagai terobosan atau inovasi bagi Komnas HAM untuk dapat memperluas jangkauan dan mempercepat proses penyebarluasan, diseminasi nilai dan pengetahuan HAM dan jejaring sumber daya HAM ke seluruh daerah di Indonesia.</p>
												<div dir="ltr">
													<div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
														<div class="item">
															<div class="py-3">
																<!-- <p class="font-size-16 mb-4">""</p> -->

																<div>
																	<p class="font-size-14 mb-0">
																		
																	</p>
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
					</div>
				</div>
				<!-- end col -->

				<div class="col-xl-3">
					<div class="auth-full-page-content p-md-5 p-4">
						<div class="w-100">
							<div class="d-flex flex-column h-100">
								<div class="my-auto">
									<div class="mb-4 mb-md-5">
										<a href="<?= base_url('/') ?>" class="d-block auth-logo">
											<!-- <img src="<?= themeUrl() ?>assets/images/logo-dark.png" alt="logo" height="18" class="auth-logo-dark"> -->
											<!-- <img src="<?= themeUrl() ?>assets/images/logo-light.png" alt="logo" height="18" class="auth-logo-light"> -->
											<img src="<?= base_url('assets/img/logo-pusdahamnas-dark.png') ?>" alt="logo" height="45" class="auth-logo-dark">
											<img src="<?= base_url('assets/img/logo-pusdahamnas.png') ?>" alt="logo" height="18" class="auth-logo-light">
										</a>
									</div>

									<div>
										<h4 class="text-color-custom font-weight-bold">Selamat Datang !</h4>
										<p class="text-muted">Silakan login terlebih dahulu</p>
									</div>

									<div class="mt-4">
										<form id="form-login" action="<?= site_url('auth/process') ?>" method="post">

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

											<input type="hidden" name="<?= @csrf()['token_name'] ?>" value="<?= @csrf()['hash'] ?>" autocomplete="new-password">

											<div class="form-group">
												<label for="username">Username</label>
												<input type="text" class="form-control" autofocus id="username" name="username" placeholder="Masukkan Username">
											</div>

											<div class="form-group">
												<label for="userpassword">Kata Sandi</label>
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
												<button class="btn bg-theme-custom text-white font-weight-bold btn-block waves-effect waves-light" type="submit">Login</button>
											</div> 
                                            <div style="float: right;margin-top: 3%;"><a href="<?php echo base_url()?>">Beranda</a></div>
										</form>
									</div>
								</div>

								<div class="mt-4 mt-md-5 text-center">
									<p class="mb-0">© <script>
											document.write(new Date().getFullYear())
										</script> <?= sistem()->nama ?></p>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container-fluid -->
	</div>

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
	<script src="<?= base_url('assets/js/pages/auth/login.js?q=' . random_string()) ?>"></script>
	<?= recaptchaRenderJs() ?>
</body>

</html>