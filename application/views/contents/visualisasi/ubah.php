<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form id="form-edit-visualisasi" class="form form-horizontal" action="#" enctype='multipart/form-data'  method="POST">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Visualisasi</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="#" onclick="history.go(-1)" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Judul</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" value="<?=encode_id($data['detail']['id'])?>" name="idkonten" hidden>
									<input type="text" class="form-control" name="judul" placeholder="Judul"  value="<?=$data['detail']['judul']?>" required="">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Looker Studio</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="looker_studio" placeholder="Looker studio"  value="<?=$data['detail']['looker_studio']?>">
                                    <span><strong>Contoh:</strong> Cukup masukan link yang berwarna merah<br /> https://lookerstudio.google.com/embed/reporting/<label style="color: red;">76232793-d12d-49c8-8bad-a9ceaf4594a6/page/p_qnxk2gjg9c</label></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-12 d-flex justify-content-center ">
									<button form="form-edit-visualisasi" type="submit" class="btn btn-lg btn-primary mr-1 mb-1 mt-5 btn-block w-50"> <i class="bx bx-check-circle"></i> Simpan</button>
								</div>                                
							</div>                            
						</div>
					</form>
                        

                    <!--=========  End of Form  =========-->
                <script src="https://www.tinymce-bootstrap-plugin.com/assets/javascripts/loadjs.min.js"></script>
                <script src="https://www.tinymce-bootstrap-plugin.com/assets/javascripts/jquery-3.3.1.min.js"></script>
                <script async defer src="https://www.tinymce-bootstrap-plugin.com/assets/javascripts/project.min.js"></script>

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#form-edit-visualisasi').on('submit', function (e) {
		e.preventDefault();

		var data = new FormData(this);
        //var gambar = $('#gambar').val();
        //var deskripsi = $('#deskripsi').val();
	//	data.append(CSRF.token_name, CSRF.hash);
    //alert(data);    
		$.ajax({
  	        url: "<?php echo base_url('visualisasi/edit_update');?>",//$(this).prop('action'),
	 		type: "POST",
			data: new FormData(this), 
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {

				if (res.status=='sukses') {
				    toastrSuccess('sukses', 'Update data berhasil');
				    //alert("Update data berhasil");history.go(-1);
                    //location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    window.location(history.go(-1));
                    ///window.locations.replace("<?php //echo site_url('~/login'); ?>");                    
				}else {
					toastrError('Gagal', 'Terjadi kesalahan data');
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash

			//	table.ajax.reload();
			},
             error: (res) => {
                ///alert("Terjadi kesalahan di server3!");
              if(JSON.stringify(res.status)==500){
                alert("Terjadi kesalahan di server!");
              } else {
                <?php $this->session->set_flashdata('success_messages', 'Update Data Berhasil'); ?>                
                alert("Update data berhasil");history.go(-1);
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url() ?>assets_front/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>assets_front/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>assets_front/libs/node-waves/waves.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<script src="https://ministry.phicos.co.id/front/pusdahamnas/assets/libs/social-sharing/socialSharing.js"></script>
<script src="<?= base_url() ?>assets_front/js/app.js"></script>

	<!-- JAVASCRIPT -->
	<script src="<?= themeUrl() ?>assets/libs/jquery/jquery.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/node-waves/waves.min.js"></script>

	<!-- owl.carousel js -->
	<script src="<?= themeUrl() ?>assets/libs/owl.carousel/owl.carousel.min.js"></script>

	<!-- auth-2-carousel init -->
	<script src="<?= themeUrl() ?>assets/js/pages/auth-2-carousel.init.js"></script>
 
	<!-- App js -->
	<script src="<?= themeUrl() ?>assets/js/app.js"></script>
	<!-- JQuery Validate -->
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?= themeUrl() ?>assets/libs/toastr/build/toastr.min.js"></script>
	<script src="<?= base_url('assets/js/custom/cryptojs-aes-php/cryptojs-aes.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/custom/cryptojs-aes-php/cryptojs-aes-format.js') ?>"></script>
	<script src="<?= base_url('assets/js/script.js?q=' . random_string()) ?>"></script>