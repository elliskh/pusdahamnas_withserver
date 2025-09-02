<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form class="form form-horizontal" onsubmit="event.preventDefault();do_submit(this);">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Tambah</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="#" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>

							<div class="row mb-1">
								<div class="col-md-12">
									<h4 class="card-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
										<i class="bx bx-user"></i> Profil
									</h4>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Nama Lengkap</label>
								</div>
								<div class="col-md-10">
									<input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Lengkap">
									<span id='error_nama' class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Email</label>
								</div>
								<div class="col-md-10">
									<input type="email" id="email" class="form-control" name="email" placeholder="Email">
									<span id='error_email' class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>No Telepon</label>
								</div>
								<div class="col-md-10">
									<input type="text" id="telepon" class="form-control" name="telepon" placeholder="Telepon">
									<span id='error_telepon' class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label> Instagram </label>
								</div>
								<div class="col-md-10">
									<input type="text" id="instagram" class="form-control" name="instagram" placeholder="instagram">
									<span id='error_instagram' class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label> Linkedin </label>
								</div>
								<div class="col-md-10">
									<input type="text" id="linkedin" class="form-control" name="linkedin" placeholder="linkedin">
									<span id='error_linkedin' class="validasi"></span>
								</div>
							</div>




							<div class="row">
								<div class="col-lg-6 col-md-12 col-sm-12 ">


									<div class="row mb-1">
										<div class="col-md-12">
											<h4 class="card-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
												<i class="bx bx-building-house"></i> S2
											</h4>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label> Bidang </label>
										</div>
										<div class="col-md-8">
											<input type="text" id="s2_bidang" class="form-control" name="s2_bidang" placeholder="Bidang">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label> Universitas </label>
										</div>
										<div class="col-md-8">
											<input type="text" id="s2_universitas" class="form-control" name="s2_universitas" placeholder="Universitas">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label> Tahun Masuk </label>
										</div>
										<div class="col-md-8">
											<input type="text" id="s2_tahun_masuk" class="form-control" name="s2_tahun_masuk" placeholder="Tahun Masuk">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label> Tahun Lulus </label>
										</div>
										<div class="col-md-8">
											<input type="text" id="s2_tahun_lulus" class="form-control" name="s2_tahun_lulus" placeholder="Tahun Lulus">
										</div>
									</div>


								</div>

								<div class="col-lg-6 col-md-12 col-sm-12 ">
									<div class="row mb-1">
										<div class="col-md-12">
											<h4 class="card-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
												<i class="bx bx-building-house"></i> S3
											</h4>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label> Bidang </label>
										</div>
										<div class="col-md-8">
											<input type="text" id="s2_bidang" class="form-control" name="s2_bidang" placeholder="Bidang">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label> Universitas </label>
										</div>
										<div class="col-md-8">
											<input type="text" id="s2_universitas" class="form-control" name="s2_universitas" placeholder="Universitas">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label> Tahun Masuk </label>
										</div>
										<div class="col-md-8">
											<input type="text" id="s2_tahun_masuk" class="form-control" name="s2_tahun_masuk" placeholder="Tahun Masuk">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-4">
											<label> Tahun Lulus </label>
										</div>
										<div class="col-md-8">
											<input type="text" id="s2_tahun_lulus" class="form-control" name="s2_tahun_lulus" placeholder="Tahun Lulus">
										</div>
									</div>

								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-12 ">
									<hr>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-12 d-flex justify-content-end ">
									<button type="submit" class="btn btn-primary mr-1 mb-1"> <i class="bx bx-check-circle"></i> Simpan</button>
									<button type="reset" class="btn btn-light-secondary mr-1 mb-1 btn_reset">Reset</button>
								</div>
							</div>
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