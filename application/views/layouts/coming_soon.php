<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title>Sistem Informasi Manajemen Pusdahamnas | Coming Soon</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Sistem Informasi Manajemen Pusdahamnas" name="description" />
	<meta content="PhicosDev" name="author" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= config_item('theme_url') ?>assets/images/favicon.ico">

	<!-- Bootstrap Css -->
	<link href="<?= config_item('theme_url') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?= config_item('theme_url') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="<?= config_item('theme_url') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
	<div class="home-btn d-none d-sm-block">
		<a href="<?= site_url(strtolower($this->session->userdata('role_name')) . '/dashboard/') ?>" class="text-white"><i class="fas fa-home h2"></i></a>
	</div>

	<div class="my-5 pt-sm-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<a href="<?= site_url(strtolower($this->session->userdata('role_name')) . '/dashboard/') ?>">
							<img src="https://ministry.phicos.co.id/front/pusdahamnas1/assets/image/logo-pusdahamnas.png" alt="logo" height="100" />
						</a>
						<div class="row justify-content-center mt-5">
							<div class="col-sm-4">
								<div class="maintenance-img">
									<img src="<?= config_item('theme_url') ?>assets/images/maintenance.png" alt="" class="img-fluid mx-auto d-block">
								</div>
							</div>
						</div>
						<h3 class="mt-5">Halaman ini masih dalam pengembangan.</h3>
						<p class="text-muted">Akan ada informasi dari developer untuk perkembangan lebih lanjut.</p>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-4" style="text-align:center">
					<img class="img-responsive" src="<?= base_url('assets/desain2.JPG')?>" style="width:50%"><hr>
					<a href="https://ministry.phicos.co.id/pusdahamnas/desain1/" target="_blank" class="btn btn-sm btn-primary">Akses Desain 1</a>
				</div>
				<div class="col-lg-4" style="text-align:center">
					<img class="img-responsive" src="<?= base_url('assets/desain1.JPG')?>" style="width:50%"><hr>
					<a href="https://ministry.phicos.co.id/pusdahamnas/desain2/" target="_blank" class="btn btn-sm btn-primary">Akses Desain 2</a>
				</div>
				<div class="col-lg-4" style="text-align:center">
					<img class="img-responsive" src="<?= base_url('assets/desain3.JPG')?>" style="width:50%"><hr>
					<a href="https://ministry.phicos.co.id/pusdahamnas/desain3/" target="_blank" class="btn btn-sm btn-primary">Akses Desain 3</a>
				</div>
			</div>
		</div>
	</div>

	<!-- JAVASCRIPT -->
	<script src="<?= config_item('theme_url') ?>assets/libs/jquery/jquery.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/node-waves/waves.min.js"></script>

	<!-- Plugins js-->
	<script src="<?= config_item('theme_url') ?>assets/libs/jquery-countdown/jquery.countdown.min.js"></script>

	<!-- Countdown js -->
	<script src="<?= config_item('theme_url') ?>assets/js/pages/coming-soon.init.js"></script>

	<script src="<?= config_item('theme_url') ?>assets/js/app.js"></script>

</body>

</html>
