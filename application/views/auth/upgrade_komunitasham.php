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
						<form id="form-register-komham" action="#" method="post" autocomplete="off"
							enctype="multipart/form-data">

							<?php if ($this->session->flashdata('error_messages')): ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<i class="mdi mdi-block-helper mr-2"></i>
									<?= $this->session->flashdata('error_messages') ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php endif ?>

							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
								value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Pendaftaran Komunitas HAM</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="#" onclick="history.go(-1)" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>
							<?php $data = $this->db->where('id', decrypt($this->session->id))->get('users')->result_array(); ?>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-user"></i> </span>
								</div>
								<input id="user_id" name="user_id" class="form-control" style="height: 15px;"
									placeholder="ID" value="<?= encrypt($data['0']['id']) ?>" type="text" required=""
									hidden>
								<input id="username" name="username" class="form-control" style="height: 15px;"
									placeholder="User pengguna" value="<?= $data['0']['username'] ?>" type="text"
									required="" readonly="">
								<input id="tipe_daftar" name="tipe_daftar" class="form-control" style="height: 15px;"
									type="hidden" value="2">
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-user"></i> </span>
								</div>
								<input id="name" name="name" class="form-control" style="height: 15px;"
									placeholder="Nama Panjang" type="text" value="<?= $data['0']['nama'] ?>" required=""
									autofocus>
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-building"></i> </span>
								</div>
								<input id="lembaga_instansi" name="lembaga_instansi" class="form-control"
									style="height: 15px;" placeholder="Lembaga/Instansi"
									value="<?= $data['0']['reglembaga_reginstansi'] ?>" type="text" required="">
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
								</div>
								<input id="email" name="email" class="form-control" style="height: 15px;"
									placeholder="Alamat Email" type="email" value="<?= $data['0']['email'] ?>"
									autocomplete="off" required="">
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
							<!--<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
								</div>
								<input id="input-password" name="password" class="form-control" style="height: 15px;" placeholder="Masukkan kata sandi" value="" type="password" required="">
								<div class="input-group-prepend">
									<span id="show-password" class="input-group-text"> <i class="fa fa-eye-slash"></i> </span>
								</div>
							</div>
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
								</div>
								<input id="input-password2" name="password2" class="form-control" style="height: 15px;" placeholder="Ulang kata sandi" value="" type="password" required="">

								<div class="input-group-prepend">
									<span id="show-password2" class="input-group-text"> <i class="fa fa-eye-slash"></i> </span>
									<span id='message_password'></span>
								</div>
							</div>-->
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
<script type="text/javascript">
	$('#form-register-komham').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
		//alert(CSRF.token_name + CSRF.hash);
		//data.append(CSRF.token_name, CSRF.hash);

		$.ajax({
			url: '<?= site_url('auth/upgradeToKomham') ?>',//$(this).prop('action'),
			type: "POST",
			data: data,
			dataType: 'json',
			processData: false,
			contentType: false,
			//async:false,
			//crossDomain:false,
			success: (res) => {
				///alert(JSON.stringify(res));
				if (res.status == 'sukses') {
					alert("Proses pendaftaran sukses, Menunggu Proses Konfirmasi dari Admin");//history.go(-1);
					//location.reload()
					window.location = "<?php echo site_url('auth/logout_front'); ?>";
					///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				} else {
					alert("Terjadi kesalahan di server!");
				}

				//	table.ajax.reload();
			},
			error: (res) => {//alert("Terjadi kesalahan di server3!");
				if (JSON.stringify(res.status) == 500) {
					//return res.status(500).json({error: err});
					alert("Terjadi kesalahan di server1!");
				} else {
					//alert("Terima kasih telah mendaftarkan Lembaga Anda, Sedang dalam proses peninjauan");history.go(-1);
					alert("Proses pendaftaran sukses");
					window.location = "<?php echo site_url('auth/logout_front'); ?>";
				}
			}
		});
	});

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
<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
<!-- js dropdown button profile -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
	integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	crossorigin="anonymous"></script>