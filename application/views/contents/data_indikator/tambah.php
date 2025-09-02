<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form class="form form-horizontal" action="<?=base_url('data_indikator/simpan')?>" autocomplete="off" enctype='multipart/form-data' method="POST">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Indikator HAM</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="<?=base_url('data_indikator/index/'.$menu_id)?>" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Nama Lembaga</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" value="<?=$menu_id?>" name="menu_id" hidden>
									<input type="text" class="form-control" value="<?=encode_id(@$data->id_lembaga)?>" name="id" hidden>
									<input type="text" class="form-control" name="nama" placeholder="Nama Lembaga HAM" value="<?=@$data->nama_lembaga?>" required>
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Nama Propinsi</label>
								</div>
								<div class="col-md-10">
									<select name="propinsi" id="propinsi" class="form-control select2" required>
										<option value="" disabled selected>Pilih</option>
										<?php
										foreach ($this->db->get('ref_propinsi')->result_array() as $rr)
										{
											$select="";
											if ($rr['code']==$data->prop_lembaga)
											{
												$select="selected";
											}
											echo "<option value='".$rr['id']."' ".$select.">".$rr['name']."</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Nama Kab/Kota</label>
								</div>
								<div class="col-md-10">
									<select name="kabkota" id="kabkota" class="form-control select2" >
										<option value="" disabled selected>Pilih</option>
										<?php
										if (@$data->prop_lembaga!="")
										{
											$kodeprop=$this->db->where('code',$data->prop_lembaga)->get('ref_propinsi')->row_array()['id'];
											foreach ($this->db->where('provinceId',$kodeprop)->get('ref_kabupaten')->result_array() as $rr)
											{
												$select="";
												if ($rr['id']==$data->fokus_lembaga)
												{
													$select="selected";
												}
												echo "<option value='".$rr['id']."' ".$select.">".$rr['name']."</option>";
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Alamat Lembaga</label>
								</div>
								<div class="col-md-10">
									<textarea name="alamat" class="form-control" value="" rows="5" placeholder="Alamat Lembaga"><?=@$data->alamat_lembaga?></textarea>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-md-2">
									<label>Email Lembaga</label>
								</div>
								<div class="col-md-10">
									<input name="email" type="email" class="form-control" placeholder="Email Lembaga" value="<?=@$data->expand_lembaga?>">
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-md-2">
									<label>No Telepon Lembaga</label>
								</div>
								<div class="col-md-10">
									<input name="telepon" type="text" class="form-control" placeholder="No Telepon Lembaga" value="<?=@$data->url_lembaga?>">
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