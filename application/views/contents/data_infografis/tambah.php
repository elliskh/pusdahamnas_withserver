<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form class="form form-horizontal" action="<?php echo base_url('data_infografis/simpan')?>" enctype='multipart/form-data' method="POST" autocomplete="off">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Tambah Infografis</h4> 
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="<?=base_url('data_infografis/index/'.$menu_id)?>" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Judul</label> <span class="text-danger">*</span>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" value="<?=$menu_id?>" name="menu_id" hidden>
									<input type="text" class="form-control" value="<?=encode_id(@$data->id)?>" name="id" hidden>
									<input type="text" class="form-control" name="judul" placeholder="Judul Infografis" value="<?=@$data->judul?>" required>
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Gambar</label> <span class="text-danger">*</span>
								</div>
								<div class="col-md-10" id="imageUploads">
									<input type="file" class="form-control" name="poster[]" id="poster" value="">
									
									<button type="button" onclick="addUpload()" class="btn btn-primary mt-3 mb-3">Tambah</button>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Link Video</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="link_video" placeholder="Link Video" value="<?= @$data->link_video;?>">
									<span class="validasi"></span>
									<small id="emailHelp" class="form-text text-danger">Jika anda memilih video, maka pada bagian gambar anda hanya cukup upload 1 gambar ( thumbnail / preview )</small>
									<small id="emailHelp" class="form-text text-danger">Hanya Menerima Link Youtube contoh : https://www.youtube.com/embed/(id_video)</small>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Deskripsi Infografis</label>
								</div>
								<div class="col-md-10">
									<textarea class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Infografis" rows="15"><?=@$data->deskripsi?></textarea>
									<span class="validasi"></span>
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-md-12 d-flex justify-content-center ">
									<button type="submit" class="btn btn-lg btn-primary mr-1 mb-1 mt-5 btn-block w-50"> <i class="bx bx-check-circle"></i> Simpan</button>
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
