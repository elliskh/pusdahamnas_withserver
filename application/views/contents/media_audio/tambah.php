<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form class="form form-horizontal" action="<?=base_url('data_ahli/simpan')?>" autocomplete="off" enctype='multipart/form-data' method="POST">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Tambah Ahli HAM</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="<?=base_url('data_ahli/index/'.$menu_id)?>" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Nama Ahli</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" value="<?=$menu_id?>" name="menu_id" hidden>
									<input type="text" class="form-control" value="<?=encode_id(@$data->id)?>" name="id" hidden>
									<input type="text" class="form-control" name="nama" placeholder="Nama Ahli HAM" value="<?=@$data->nama?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Instansi Ahli</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="instansi" placeholder="Instansi Ahli"  value="<?=@$data->instansi?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Email Ahli</label>
								</div>
								<div class="col-md-10">
									<input type="email" class="form-control" name="email" placeholder="Email Ahli"  value="<?=@$data->email?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Topik Isu Hak</label>
								</div>
								<div class="col-md-10">
									<select name="id_topik_hak" class="form-control select2" >
										<option value="" disabled selected>Pilih</option>
										<?php foreach ($hak as $key => $value) { ?>
											<option value="<?=encode_id($value->id_hak)?>" <?=@$data->id_topik_hak==$value->id_hak?'selected':''?>><?=$value->nama_hak?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Topik Isu Subyek</label>
								</div>
								<div class="col-md-10">
									<select name="id_topik_subyek" class="form-control select2" >
										<option value="" disabled selected>Pilih</option>
										<?php foreach ($subyek as $key => $value) { ?>
											<option value="<?=encode_id($value->id_subyek)?>" <?=@$data->id_topik_subyek==$value->id_subyek?'selected':''?>><?=$value->nama_subyek?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-md-2">
									<label>Foto Ahli</label>
								</div>
								<div class="col-md-10">
									<input type="file" class="form-control" accept="image/png, image/gif, image/jpeg, image/jpg" name="foto" id="input_upload2">
									<?php
									if (@$data->foto!="")
									{
										?>
										<div class="note">File Tersimpan : <a target='_blank' href='<?php echo base_url('uploads/fotoahli/'.@$data->foto.'')?>'><?php echo @$data->foto ?></a></div>
										<?php
									}
									?>
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