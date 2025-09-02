<style>
	.google-btn {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		background-color: #fff;
		color: #555;
		border: 1px solid #ddd;
		border-radius: 8px;
		padding: 10px 15px;
		font-weight: 500;
		font-size: 15px;
		width: 100%;
		transition: all 0.3s ease;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	}

	.google-btn img {
		width: 20px;
		height: 20px;
		margin-right: 10px;
	}

	.google-btn:hover {
		background-color: #f7f7f7;
		transform: translateY(-1px);
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
	}

	.or-divider {
		display: flex;
		align-items: center;
		text-align: center;
		color: #999;
		margin: 15px 0;
	}

	.or-divider::before,
	.or-divider::after {
		content: "";
		flex: 1;
		border-bottom: 1px solid #ddd;
	}

	.or-divider:not(:empty)::before {
		margin-right: .75em;
	}

	.or-divider:not(:empty)::after {
		margin-left: .75em;
	}
</style>

<div class="container mt-100">
	<div class="row d-flex justify-content-center" style="text-align: center;">
		<div class="col-md-6" style="margin-top: 3%;">
			<div class="card" style="margin-bottom:0px;">
				<div class="card-body">
					<img src="<?= base_url('assets/img/logo-pusdahamnas-dark.png') ?>" alt="logo" height="45" class="auth-logo-dark">
					<h4 class="card-title mt-3 text-center">Silahkan Masuk</h4>
					<br>
					<div class="row d-flex align-items-center justify-content-center">
						<div class="col-xl-12 col-md-6">
							<div class="display_form_registrasi">
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

									<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
									<div class="form-group input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"> <i class="fa fa-user"></i> </span>
										</div>
										<input type="text" class="form-control" value="" name="menu_id" hidden>
										<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="" required>
									</div>
									<div class="form-group input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
										</div>
										<input id="input-password" name="password" class="form-control" placeholder="Kata sandi" type="password" required="">

										<div class="input-group-prepend">
											<span id="show-password" class="input-group-text"> <i class="toggle-password fa fa-eye-slash"></i> </span>
											<span id='message_password'></span>
										</div>
									</div>
									<div class="form-group">
										<?= recaptchaDisplay() ?>
									</div>
									<div class="mt-2">
										<button class="btn btn-success btn-block" type="submit">Login</button>
										<div class="or-divider">atau</div>
										<a href="<?php echo site_url('oauth/google'); ?>" class="google-btn">
											<img src="https://developers.google.com/identity/images/g-logo.png"
												alt="Google Logo">
											Masuk dengan Google
										</a>
										<p class="text-left"><a href="<?= site_url('home/forgot') ?>"
												style="color: blue;">Lupa kata sandi?</a> </p>
										<p class="text-left">Belum punya akun? <a
												href="<?= site_url('home/pendaftaran') ?>" style="color: blue;">Daftar
												disini</a> </p>
										<a href="#" class="text-danger bg-light mt-15" onclick="history.go(-1)"
											type="submit">Kembali</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- <script src="http://devpusdahamnas.komnasham.go.id/assets_front/libs/jquery/jquery.min.js"></script> -->
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
						//siteHeader.removeClass("fixed-header");          
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
<script>
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
	});
</script>