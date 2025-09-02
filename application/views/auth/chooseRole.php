<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title><?= sistem()->nama ?> - Choose Role</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="<?= sistem()->deskripsi ?>" name="description" />
	<meta content="<?= sistem()->author ?>" name="author" />
	<meta content="<?= @csrf()['token_name'] ?>" name="csrf-token_name" />
	<meta content="<?= @csrf()['hash'] ?>" name="csrf-hash" />
	<meta content="<?= base_url() ?>" name="base_url" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= base_url('assets/img/img-komnasham-favicon.png') ?>">

	<!-- Bootstrap Css -->
	<link href="<?= themeUrl() ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?= themeUrl() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="<?= themeUrl() ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
	<link href="<?= themeUrl() ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css?q=' . random_string()) ?>">

</head>

<body style="background-image: url('https://images.unsplash.com/photo-1549383028-df014fa3a325?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80'); background-size: cover;">
	<div class="auth-full-page-content d-lg-flex">
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

		<div class="container my-auto">
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5">
					<div class="card overflow-hidden">
						<div class="bg-soft-color-custom">
							<div class="row">
								<div class="col-7">
									<div class="text-color-custom p-4">
										<h5 class="text-color-custom font-weight-bold">Pilih Otoritas</h5>
										<p class="text-muted">Pilih otoritas yang ingin anda gunakan</p>
									</div>
								</div>
								<div class="col-5 align-self-end">
									<img src="<?= themeUrl() ?>assets/images/profile-img.png" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						<div class="card-body pt-0">
							<div>
								<a href="<?= base_url() ?>">
									<div class="avatar-md profile-user-wid mb-4">
										<span class="avatar-title rounded-circle bg-primary">
											<!-- <img src="<?= themeUrl() ?>assets/images/logo.svg" alt="" class="rounded-circle" height="34"> -->
											<img src="<?= base_url('assets/img/img-komnasham-favicon.png') ?>" alt="" class="rounded-circle" height="34">
										</span>
									</div>
								</a>
							</div>
							<div class="p-2">
								<form class="form-horizontal" id="form-choose-role" action="<?= site_url('auth/choose') ?>" method="post">
									<input type="hidden" name="<?= @csrf()['token_name'] ?>" value="<?= @csrf()['hash'] ?>" autocomplete="new-password">
									<input type="hidden" name="user_id" id="user_id" value="<?= encrypt($user_data->id) ?>">

									<div class="user-thumb text-center mb-4">
										<img src="<?= base_url('assets/img/user-icon.jpg') ?>" class="rounded-circle img-thumbnail avatar-md" alt="thumbnail">
										<h5 class="font-size-15 mt-3"><?= $user_data->nama ?></h5>
									</div>

									<div class="form-group">
										<label for="role_id">Otoritas</label>
										<select name="role_id" id="role_id" class="form-control">
											<option value="" selected disabled>Pilih Otoritas</option>
											<?php foreach ($roles as $item) : ?>
												<option value="<?= encrypt($item->role_id) ?>"><?= ucwords($item->nama) ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="mt-5 text-center bg-white rounded-lg py-3">
						<h6 class="">Bukan anda ? kembali ke halaman <a href="<?= site_url('auth/logout') ?>" class="font-weight-bold text-color-custom"> login </a> </h6>
						<p class="mb-0">Hak Cipta Pusdahamnas Komnasham Republik Indonesia © <script>document.write(new Date().getFullYear())</script></p>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- JAVASCRIPT -->
	<script src="<?= themeUrl() ?>assets/libs/jquery/jquery.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/node-waves/waves.min.js"></script>

	<!-- App js -->
	<script src="<?= themeUrl() ?>assets/js/app.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/select2/js/select2.min.js"></script>

	<script src="<?= base_url('assets/js/pages/auth/chooseRole.js?q=' . random_string()) ?>"></script>
</body>

</html>