<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control")
	?>
<div class="container" style="margin-top: 8%;margin-bottom: 3%;">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="card">
				<div class="card-body">
					<div class="display_form_registrasi">
						<!-- El -->
						<?php if ($this->session->flashdata('error_messages')): ?>
							<?php $errors = $this->session->flashdata('error_messages'); ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<i class="mdi mdi-block-helper mr-2"></i>
								<ul class="mb-0">
									<?php foreach ($errors as $error): ?>
										<li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
									<?php endforeach; ?>
								</ul>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php endif; ?>

						<div class="d-flex justify-content-center align-items-center mb-4">
							<div class="card shadow p-4 text-center bg-warning">
								<p class="mb-0">
									⚠️ Pendaftaran Komunitas HAM memerlukan persetujuan admin. <br>
									Jika ingin segera mengunduh dokumen, silakan daftar sebagai
									<strong class="text-danger"><a href="<?= base_url('home/pendaftaran_pengunjung') ?>">Pengunjung</a></strong>.
								</p>
							</div>
						</div>

						<form id="form-register-komham" action="<?= site_url('auth/processRegAPI') ?>" method="post"
							autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
								value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Pendaftaran Komunitas HAM</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="<?= base_url('home/pendaftaran') ?>" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-user"></i> </span>
								</div>
								<input id="name" name="name" class="form-control" style="height: 15px;"
									placeholder="Nama Panjang" type="text" value="" required="" autofocus>
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-building"></i> </span>
								</div>
								<input id="lembaga_instansi" name="lembaga_instansi" class="form-control"
									style="height: 15px;" placeholder="Lembaga/Instansi" value="" type="text"
									required="">
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
								</div>
								<input id="email" name="email" class="form-control" style="height: 15px;"
									placeholder="Alamat Email" type="email" autocomplete="off" required="">
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-user"></i> </span>
								</div>
								<select name="status_person" class="form-control select2" required="">
									<option value="" disabled selected>Pilih Status</option>
									<option value="Akademisi">Akademisi</option>
									<option value="Praktisi">Praktisi</option>
									<option value="Peneliti">Peneliti</option>
								</select>
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-book"></i> </span>
								</div>
								<select class="custom-select" id="pendidikan" name="pendidikan" required>
									<option disable selected>Pilih Pendidikan Terakhir</option>
									<option value="SMA">SMA</option>
									<option value="S1">S1</option>
									<option value="S2">S2</option>
									<option value="S3">S3</option>
								</select>
								<!-- <input id="pendidikan" name="pendidikan" class="form-control" style="height: 15px;" placeholder="Pendidikan Terakhir" type="text" required=""> -->
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-user"></i> </span>
								</div>
								<input id="username" name="username" class="form-control" onchange="checkUser()"
									style="height: 15px;" placeholder="User pengguna" type="text" required="">
								<input id="tipe_daftar" name="tipe_daftar" class="form-control" style="height: 15px;"
									type="hidden" value="2">
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
								</div>
								<input id="input-password" name="password" class="form-control" style="height: 15px;"
									placeholder="Masukkan kata sandi" value="" type="password" required="">
								<div class="input-group-prepend">
									<span id="show-password" class="input-group-text"> <i class="fa fa-eye-slash"></i>
									</span>
								</div>
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
								</div>
								<input id="input-password2" name="password2" class="form-control" style="height: 15px;"
									placeholder="Ulang kata sandi" value="" type="password" required="">

								<div class="input-group-prepend">
									<span id="show-password2" class="input-group-text"> <i class="fa fa-eye-slash"></i>
									</span>
									<span id='message_password'></span>
								</div>
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Foto Profile</span>
									<span class="input-group-text"> <i class="fa fa-image"></i> </span>
								</div>
								<input type="file" class="form-control" name="gambar" id="gambar" value="">
							</div>
							<div class="d-flex mb-5 align-items-center">
								<label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Setujui
										Syarat dan <a href="#">Ketentuan kami</a></span>
									<input id="check_term" type="checkbox" required="" />
									<span id='message_term'></span>
									<span id='error_messages'></span>
									<div class="control__indicator"></div>
								</label>
							</div>
							<div class="form-group">
								<?= recaptchaDisplay() ?>
							</div>
							<div class="form-group">
								<button id="btn_register" form="form-register-komham" type="submit"
									class="btn btn-primary btn-block"><i class="bx bx-check-circle"></i> Daftar
								</button>
							</div>
							<p class="text-center">Sudah memiliki akun? <a href="<?= base_url('home/login') ?>"
									style="color: blue;">Masuk</a> </p>
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
<script>
	$('#username').keydown(function (e) {
		if (e.keyCode == 32) {
			alert('Penggunaan spasi tidak diperbolehkan!');
			return false;
		}
	});

	function checkUser() {
		var str = document.getElementById('username').value;
		var xxx = str.length;
		var ck = '6';

		if (xxx < ck) {
			alert('Username Minimal 6 karakter!');
			document.getElementById("btn_register").disabled = true;
			return false;
		} else {
			document.getElementById("btn_register").disabled = false;
		}
	}

	function link_uploads() {
		if ($('#link_upload').val() == 'link') {
			$('#dokumen_link').show();
			$('#dokumen_upload').hide();
			$('#input_upload').val(null);
		} else if ($('#link_upload').val() == 'upload') {
			$('#dokumen_link').hide();
			$('#input_link').val(null);
			$('#dokumen_upload').show();
		}
	}

	$(document).ready(function () {
		// slick carousel
		$("#show-password").click(function () {
			$(this).find('i').toggleClass("fa-eye fa-eye-slash");
			var input = $("#input-password");
			if (input.attr("type") === "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});

		$("#show-password2").click(function () {
			$(this).find('i').toggleClass("fa-eye fa-eye-slash");
			var input = $("#input-password2");
			if (input.attr("type") === "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	});
</script>
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