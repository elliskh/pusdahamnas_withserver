<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form class="form form-horizontal" action="<?=base_url('data_dok/simpan')?>" enctype='multipart/form-data' method="POST">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Tambah</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="<?=base_url('data_dok/index/'.$menu_id)?>" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-md-2">
									<label>Unit Kerja</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" value="<?=$menu_id?>" name="menu_id" hidden>
									<input type="text" class="form-control" value="<?=encode_id(@$data->id)?>" name="id" hidden>
									<input type="text" class="form-control" name="unit_kerja" placeholder="Unit Kerja" value="<?=@$data->unit_kerja?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Nama Dokumen</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="nama_dokumen" placeholder="Nama Dokumen"  value="<?=@$data->nama_dokumen?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>No Dokumen</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="no_dok" placeholder="No Dokumen"  value="<?=@$data->no_dok?>">
									<span class="validasi"></span>
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Tahun</label>
								</div>
								<div class="col-md-10">
									<input type="number" class="form-control" name="tahun" placeholder="Tahun"  value="<?=@$data->tahun?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Kata kunci <br> (antar kata kunci dipisah dengan koma)</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="katakunci" placeholder="Kata kunci"  value="<?=@$data->katakunci?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Deskripsi</label>
								</div>
								<div class="col-md-10">
									<textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"><?=@$data->deskripsi?></textarea>
									<span class="validasi"></span>
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Media</label>
								</div>
								<div class="col-md-10">
									<select name="id_media_dokumen" class="form-control select2" >
										<option value="" disabled selected>Pilih</option>
										<?php foreach ($media as $key => $value) { ?>
											<option value="<?=encode_id($value->id_media)?>" <?=@$data->id_media_dokumen==$value->id_media?'selected':''?>><?=$value->nama_media?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Jenis Dokumen</label>
								</div>
								<div class="col-md-10">
									<select name="id_jenis_dokumen" class="form-control select2" >
										<option value="" disabled selected>Pilih</option>
										<?php foreach ($jenis as $key => $value) { ?>
											<option value="<?=encode_id($value->id_jenis)?>" <?=@$data->id_jenis_dokumen==$value->id_jenis?'selected':''?>><?=$value->nama_jenis?></option>
										<?php } ?>
									</select>
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
									<label>Cover Dokumen</label>
								</div>
								<div class="col-md-10">
									<input type="file" class="form-control" name="cover" id="input_upload2">
									<?php
									if (@$data->gambar!="")
									{
										?>
										<div class="note">File Tersimpan : <a target='_blank' href='<?php echo base_url('uploads/cover/'.@$data->gambar.'')?>'><?php echo @$data->gambar ?></a></div>
										<?php
									}
									?>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Status Dokumen</label>
								</div>
								<div class="col-md-10">
									<select name="id_status_dokumen" class="form-control select2" >
										<option value="" disabled selected>Pilih</option>
										<?php foreach ($status as $key => $value) { ?>
											<option value="<?=encode_id($value->id_status)?>" <?=@$data->id_status_dokumen==$value->id_status?'selected':''?>><?=$value->nama_status?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Mitra</label>
								</div>
								<div class="col-md-10">
									<select name="id_lembaga" class="form-control select2" >
										<option value="" disabled selected>Pilih</option>
										<?php foreach ($lembaga as $key => $value) { ?>
											<option value="<?=encode_id($value->id)?>" <?=@$data->id_lembaga==$value->id?'selected':''?>><?=$value->nama_lembaga?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Link/Upload</label>
								</div>
								<div class="col-md-10">
									<select name="link_upload" id="link_upload" class="form-control select2" onchange="link_uploads()">
										<option value="" disabled selected>Pilih</option>
										<option value="link" <?=@$data->link?'selected':''?>>Link</option>
										<option value="upload" <?=!@$data->link?'selected':''?>>Upload</option>
									</select>
								</div>
							</div>
							<div class="row mb-3" id="dokumen_link" style="display:none;">
								<div class="col-md-2">
									<label>Dokumen Link</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="link" id="input_link" value="<?=@$data->link?>">
								</div>
							</div>
							<div class="row mb-3" id="dokumen_upload" style="display:none;">
								<div class="col-md-2">
									<label>Dokumen Upload</label>
								</div>
								<div class="col-md-10">
									<input type="file" class="form-control" name="dokumen" id="input_upload">
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
<script>
	

	function link_uploads(){
		if ($('#link_upload').val() == 'link') {
			$('#dokumen_link').show();
			$('#dokumen_upload').hide();
			$('#input_upload').val(null);
		} else if($('#link_upload').val() == 'upload'){
			$('#dokumen_link').hide();
			$('#input_link').val(null);
			$('#dokumen_upload').show();
		}
	}
</script>