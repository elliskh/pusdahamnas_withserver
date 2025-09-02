<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form class="form form-horizontal" action="<?php echo base_url('data_event/simpan')?>" enctype='multipart/form-data' method="POST" autocomplete="off">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Tambah Event</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="<?=base_url('data_event/index/'.$menu_id)?>" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Mitra</label>
								</div>
								<div class="col-md-10">
									<select name="id_lembaga" class="form-control select2" >
										<?php foreach ($lembaga as $key => $value) { ?>
											<option value="<?=encode_id($value->id)?>" <?=@$data->id_lembaga==$value->id?'selected':''?>><?=$value->nama_lembaga?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Judul</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" value="<?=$menu_id?>" name="menu_id" hidden>
									<input type="text" class="form-control" value="<?=encode_id(@$data->id_event)?>" name="id" hidden>
									<input type="text" class="form-control" name="judul" placeholder="Judul Event" value="<?=@$data->judul?>" required>
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Sub Judul</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="sub_judul" placeholder="Sub Judul"  value="<?=@$data->sub_judul?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Kategori</label>
								</div>
								<div class="col-md-10">
									<select name="kategori" class="form-control">
										<option value="">---Pilih Kategori---</option>
										<option value="DATA" <?php echo (@$data->kat=='DATA') ? 'selected' : '' ?>>DATA</option>
										<option value="HAM" <?php echo (@$data->kat=='HAM') ? 'selected' : '' ?>>HAM</option>
									</select>
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Format</label>
								</div>
								<div class="col-md-10">
									<select name="format" class="form-control" required>
										<option value="">---Pilih Format Event---</option>
										<option value="Webinar" <?php echo (@$data->format=='Webinar') ? 'selected' : '' ?>>Webinar</option>
										<option value="Konferensi" <?php echo (@$data->format=='Konferensi') ? 'selected' : '' ?>>Konferensi</option>
										<option value="Pelatihan" <?php echo (@$data->format=='Pelatihan') ? 'selected' : '' ?>>Pelatihan</option>
										<option value="Diseminasi" <?php echo (@$data->format=='Diseminasi') ? 'selected' : '' ?>>Diseminasi</option>
										<option value="Diskusi Publik" <?php echo (@$data->format=='Diskusi Publik') ? 'selected' : '' ?>>Diskusi Publik</option>
									</select>
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Waktu Pelaksanaan</label>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control" name="waktu_mulai" placeholder="Waktu Mulai" id="datetimepicker6" value="<?=@$data->start?>" required>
									<span class="validasi"></span>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control" name="waktu_selesai" placeholder="Waktu Selesai" id="datetimepicker7" value="<?=@$data->end?>" required>
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Deskripsi Event</label>
								</div>
								<div class="col-md-10">
									<textarea class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Event" rows="5"><?=@$data->deskripsi?></textarea>
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Data Narahubung</label>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control" name="nama_hubung" placeholder="Nama Narahubung" value="<?=@$data->nama_hubung?>">
									<span class="validasi"></span>
								</div>
								<div class="col-md-5">
									<input type="number" class="form-control" name="hp_hubung" placeholder="Nomor HP Narahubung" value="<?=@$data->hp_hubung?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Leaflet / Poster Event</label>
								</div>
								<div class="col-md-10">
									<input type="file" class="form-control" name="poster" id="input_upload2">
									<?php
									if (@$data->poster!="")
									{
										?>
										<div class="note">File Tersimpan : <a target='_blank' href='<?php echo base_url('uploads/poster/'.@$data->poster.'')?>'><?php echo @$data->poster ?></a></div>
										<?php
									}
									?>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Lokasi Event / Link Conference</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="link_meet" placeholder="Masukkan Lokasi Event atau Link Video Conference apabila dilaksanakan daring"  value="<?=@$data->link_meet?>" required>
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