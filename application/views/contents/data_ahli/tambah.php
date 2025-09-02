<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
	 .multiselect-container {
        width: 320px !important;
        z-index: 9999;
    }

    .multiselect-container>li>a>label {
        padding: 7px 20px 7px 20px;
    }

    .multiselect {
        border: 1px solid #556ee6;
        color: #556ee6;
        width: 220px;
        margin-right: 0;
        margin-left: 0;
    }

    .input-group {
        width: 100% !important;
    }

    .multiselect-search {
        margin-left: 3px !important;
        min-width: 85px !important;
        max-width: 285px !important;
    }
	.input__multi {
        width: 100%;
    }
	btn-group {
        width: 85px;
        margin-left: 15px;
    }

    .dropdown-toggle {
        margin-right: 15px;

    }

    .btn-default {
        min-width: 210px;
        max-width: 220px;
    }
</style>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form id="form-add-pegiat" class="form form-horizontal" action="<?=base_url('data_ahli/simpan')?>" autocomplete="off" enctype='multipart/form-data' method="POST">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Tambah Pegiat HAM</h4>
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
									<label>Nama Pegiat</label>
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
									<label>Instansi Pegiat</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="instansi" placeholder="Instansi Ahli"  value="<?=@$data->instansi?>">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Email Pegiat</label>
								</div>
								<div class="col-md-10">
									<input type="email" class="form-control" name="email" placeholder="Email Ahli"  value="<?=@$data->email?>">
									<span class="validasi"></span>
								</div>
							</div>						
                            <div class="row mb-3">
								<div class="col-md-2">
									<label>Status Personal</label>
								</div>
								<div class="col-md-10">
									<select name="status_person" class="form-control select2" >
										<option value="" disabled selected>Pilih</option>                                           
                                           <?php 
                                           $slc = "";
                                           if(@$data->status_person=='Akademisi'){
                                              $slc = "selected";?>
                                              <option value="Akademisi" <?php echo $slc; ?>>Akademisi</option>
                                              <option value="Praktisi">Praktisi</option>
                                              <option value="Peneliti">Peneliti</option>
                                           <?php }elseif(@$data->status_person=='Praktisi'){ 
                                              $slc = "selected";?>
                                              <option value="Akademisi">Akademisi</option>
                                              <option value="Praktisi" <?php echo $slc; ?>>Praktisi</option>
                                              <option value="Peneliti">Peneliti</option>
                                           <?php }elseif(@$data->status_person=='peneliti'){
                                              $slc = "selected";?>
                                              <option value="Akademisi">Akademisi</option>
                                              <option value="Praktisi">Praktisi</option>
                                              <option value="Peneliti" <?php echo $slc; ?>>Peneliti</option>
                                           <?php }else{
                                              $slc = "";?>
                                              <option value="Akademisi">Akademisi</option>
                                              <option value="Praktisi">Praktisi</option>
                                              <option value="Peneliti">Peneliti</option>
                                           <?php }?>
									</select>
								</div>
							</div>						
                            <div class="row mb-3">
								<div class="col-md-2">
									<label>Pendidikan</label>
								</div>
								<div class="col-md-10">
									<select name="pendidikan" class="form-control select2" >
										<option value="" disabled selected>Pilih</option>
                                           
                                           <?php 
                                          
                                           if(@$data->pendidikan==''){
                                              $slc = "selected";?>
                                              <option value="SMA">SMA</option>
                                              <option value="S1">S1</option>
                                              <option value="S2">S2</option>
                                              <option value="S3">S3</option>
                                          <?php }elseif(@$data->pendidikan=='SMA'){
                                              $slc = "selected"; ?>
                                              <option value="SMA" <?php echo $slc; ?>>SMA</option>
                                              <option value="S1">S1</option>
                                              <option value="S2">S2</option>
                                              <option value="S3">S3</option>
                                          <?php }elseif(@$data->pendidikan=='S1'){
                                              $slc = "selected"; ?>
                                              <option value="SMA">SMA</option>
                                              <option value="S1" <?php echo $slc; ?>>S1</option>
                                              <option value="S2">S2</option>
                                              <option value="S3">S3</option>
                                         <?php }elseif(@$data->pendidikan=='S2'){
                                              $slc = "selected";?>
                                              <option value="SMA">SMA</option>
                                              <option value="S1">S1</option>
                                              <option value="S2" <?php echo $slc; ?>>S2</option>
                                              <option value="S3">S3</option>
                                         <?php }elseif(@$data->pendidikan=='S3'){
                                              $slc = "selected";?>
                                              <option value="SMA">SMA</option>
                                              <option value="S1">S1</option>
                                              <option value="S2">S2</option>
                                              <option value="S3" <?php echo $slc; ?>>S3</option>
                                         <?php }?>
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
									<!-- <select name="id_topik_subyek" class="form-control select2">
										<option value="" disabled selected>Pilih</option>-->
										<!--<?php //foreach ($subyek as $key => $value) { ?>-->
											<!--<option value="<?=encode_id($value->id_subyek)?>" <?=@$data->id_topik_subyek==$value->id_subyek?'selected':''?>><?=$value->nama_subyek?></option>-->
										<!--<?php //} ?>-->
									<!--</select> -->
									<select name="id_topik_subyek[]" id="id_topik_subyek" class="form-control" multiple="multiple">
										<option value="" disabled>Pilih</option>
                                    <?php 
                                    $selected = '';
                                    $exp  = (explode(",", @$data->id_topik_subyek));
                                    foreach ($exp AS $value){
                                        $arrx[] = (int)$value; 
                                    }
                                          ?>                                        
                                           <?php foreach ($subyek as $key => $value){ ?>
                                           <?php if(in_array($value->id_subyek, $arrx)){
                                               $selected ='selected'; $cek_id = 'ada';?>
                                               <option value="<?=($value->id_subyek)?>" <?php echo $selected;?>><?=$value->nama_subyek?></option>
                                          <?php  }else{?>
                                                  <option value="<?=($value->id_subyek)?>"><?=$value->nama_subyek?></option>
                                    <?php  }} 
                                     ?>                                     
											<!--<option value="<?=($value->id_subyek)?>" <?=@$data->id_topik_subyek==$value->id_subyek?'selected':''?>><?=$value->nama_subyek?></option>-->
                                       
									</select>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-md-2">
									<label>Foto Pegiat</label>
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
									<button type="submit" form="form-add-pegiat" class="btn btn-lg btn-primary mr-1 mb-1 mt-5 btn-block w-50"> <i class="bx bx-check-circle"></i> Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>

				<style type="text/css">
    .multiselect-all {
        color: #757473;
    }

    .btn-default {
        width: 230px;
    }
</style>
				<div class="row mb-2">
					<div class="col-sm-12">
						<div class="text-sm-right">
						</div>
					</div>
				</div>
				<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
				<script src="<?= base_url() ?>assets_front/js/app.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
				<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
				<script type="text/javascript">
    $('#form-add-pegiat-').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
	  //	data.append(CSRF.token_name, CSRF.hash);
    //alert(data);    
		$.ajax({
  	        url: "<?=base_url('data_ahli/simpan')?>",//$(this).prop('action'),
	 		type: "POST",
			data: data, 
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {
			
				if (res.status=='sukses') {
				    alert("Sukses tambah data");history.go(-1);
                    //location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else if (res.status=='akses') {
				    alert("Akses Terbaatas!");
                    //location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else {
					toastrError('Gagal', 'Terjadi kesalahan data');
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash

			//	table.ajax.reload();
			},
             error: (res) => {
              if(JSON.stringify(res.status)==500){
                //return res.status(500).json({error: err});
                alert("Terjadi kesalahan di server!");
              } else {
                //return res.status(200).json({success: 'Insert row success'});
                //toastrSuccess('success_messages', "Pendaftaran berhasil");
                <?php //$this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil'); ?>
                alert("Sukses tambah data");history.go(-1);
                 //   location.reload()
              }
            }
		});  
    });    	
                    
        $('#id_topik_subyek').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 250,
            buttonText: function (options, select) {
                if (options.length > 0 && options.length < 400) {
                    return 'Anda Memilih ' + options.length + ' Pilihan';
                } else if (options.length == 0) {
                    return 'Pilih Topik Data';
                } else {
                    return options.length + ' Pilihan Di Pilih';
                }
            }
        });
				</script>
			</div>
		</div>
	</div>
</div>
