<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form id="form-add-gbr-dokumen" class="form form-horizontal" action="<?php echo base_url('image_komunitasham/simpan');?>"  method="POST" enctype='multipart/form-data' autocomplete="off">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Gambar</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="<?=base_url('image_komunitasham/index/'.$menu_id)?>" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-md-2">
									<label>Deskripsi</label>
								</div>
								<div class="col-md-10">
                                    <input type="text" class="form-control" id="menu_id" name="menu_id" placeholder="Deskripsi"  value="<?= $menu_id?>" hidden>
									<input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"  value="" required="">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Gambar</label>
								</div>
								<div class="col-md-10">
									<input type="file" class="form-control" name="gambar" id="gambar" value="">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-12 d-flex justify-content-center ">
									<button form="form-add-gbr-dokumen" type="submit" class="btn btn-lg btn-primary mr-1 mb-1 mt-5 btn-block w-50"> <i class="bx bx-check-circle"></i> Simpan</button>
								</div>
                                
							</div>
                            
						</div>
					</form>
                        

                    <!--=========  End of Form  =========-->
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	$('#form-add-gbr-dokumen-').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
	//	data.append(CSRF.token_name, CSRF.hash);
    alert(data);    
		$.ajax({
  	        url: "<?php echo base_url('image_komunitasham/simpan');?>",//$(this).prop('action'),
	 		type: "POST",
			data: data, 
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {
			alert('o');
				if (res.status=='sukses') {
				    alert("Data berhasil ditambahkan ");
                    window.location(history.go(-1));
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
             error: (res) => {///alert("Terjadi kesalahan di server3!");
              if(JSON.stringify(res.status)==500){
                //return res.status(500).json({error: err});
                alert("Terjadi kesalahan di server!");
              } else {
                //return res.status(200).json({success: 'Insert row success'});
                //toastrSuccess('success_messages', "Pendaftaran berhasil");
                <?php //$this->session->set_flashdata('success_messages', 'Simpan Data Berhasil'); ?>                
                alert("Simpan data berhasil");history.go(-1);
              }
			/*error: (res) => {
                alert("Terjadi kesalahan di server!");
				//toastrError('Gagal', 'Terjadi kesalahan di server');
				//table.ajax.reload();
			}*/
            }
		});
	});
</script>
<!-- JAVASCRIPT -->
<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>