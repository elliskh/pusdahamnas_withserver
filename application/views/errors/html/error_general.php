<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title>Sistem Informasi ... | Error 500</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Sistem Informasi ..." name="description" />
	<meta content="PhicosDev" name="author" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/images/favicon.ico">

	<!-- Bootstrap Css -->
	<link href="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

	<div class="account-pages my-3 pt-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center mb-5">
						<h1 class="display-2 font-weight-medium">5<i class="bx bx-buoy bx-spin text-primary display-3"></i>0</h1>
						<h4 class="text-uppercase font-weight-bold">Terjadi kesalahan di server !</h4>
						<h5><?php echo $heading; ?></h5>
						<h6><?php echo $message; ?></h6>
						<div class="mt-5 text-center">
							<a class="btn btn-primary waves-effect waves-light" href="<?= config_item('base_url') ?>">Back to Dashboard</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-8 col-xl-6">
					<div>
						<img src="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/images/error-img.png" alt="" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JAVASCRIPT -->
	<script src="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/libs/jquery/jquery.min.js"></script>
	<script src="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/libs/node-waves/waves.min.js"></script>

	<script src="<?= ((isset($_SERVER['HTTPS']) || @$_SERVER['HTTPS'] == "on" || @$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . '/' ?>tema/Skote_v2.1.0/HTML/Admin/dist/assets/js/app.js"></script>

</body>

</html>