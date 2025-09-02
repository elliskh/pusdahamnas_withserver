<!-- Modal ajax -->

<div id="modal-small" class="modal fade" role="dialog" aria-labelledby="label-modal-small" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-small"></h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="text-center py-4">
					<i class="bx bx-loader bx-spin font-size-16 align-middle m-auto font-size-24"></i>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-default" class="modal fade" role="dialog" aria-labelledby="label-modal-default" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-default"></h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="text-center py-4">
					<i class="bx bx-loader bx-spin font-size-16 align-middle m-auto font-size-24"></i>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-large" class="modal fade" role="dialog" aria-labelledby="label-modal-large" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-large"></h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="text-center py-4">
					<i class="bx bx-loader bx-spin font-size-16 align-middle m-auto font-size-24"></i>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-extra-large" class="modal fade" role="dialog" aria-labelledby="label-modal-extra-large" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-extra-large"></h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="text-center py-4">
					<i class="bx bx-loader bx-spin font-size-16 align-middle m-auto font-size-24"></i>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- End modal ajax -->
            <script src="<?php echo base_url('assets_front/libs/jquery/jquery.min.js');?>"></script>
<!-- Modal profil -->
<div id="modal-profil" class="modal fade" role="dialog" aria-labelledby="label-modal-profil" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content rounded-pill-top">
			<div class="modal-header bg-theme-custom-dark rounded-pill-top">
				<h5 class="modal-title mt-0 text-white" id="label-modal-profil">Profil</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!--<form id="form-profil" data-id="<?= session('id') ?>" autocomplete="off" onsubmit="javascript:event.preventDefault(); onSubmitProfil(this);" enctype="multipart/form-data">-->				
                <form id="form-profil" data-id="<?= session('id') ?>" action="#" class="form form-horizontal" autocomplete="off" enctype="multipart/form-data">	
                <div class="form-group">
						<label for="profil-username">Username</label>
						<input type="text" name="username" id="profil-username" class="form-control" disabled value="<?= session('username') ?>">
                        <input type="hidden" name="role" id="profil-role" class="form-control" disabled value="<?= session('nama_role') ?>">
                        <input type="hidden" style="background-color:white;" class="form-control heighttext" id="id" name="id" value="<?= session('id') ?>">        
					</div>
                    <div class="form-group">
						<label for="profil-email">Username</label>
						<input type="text" name="email" id="profil-email" class="form-control" disabled value="<?= session('email') ?>">
					</div>
					<div class="form-group">
						<label for="profil-role">Otoritas</label>
						<input type="text" name="role" id="profil-role" class="form-control" disabled value="<?= session('nama_role') ?>">
					</div>
					<div class="form-group">
						<label for="profil-nama">Nama Lengkap <span class="text-danger">*)</span></label>
						<input type="text" name="nama" id="profil-nama" class="form-control" placeholder="Masukkan nama lengkap" value="<?= session('nama') ?>">
						<div id="error-profil-nama"></div>
					</div>
					<div class="form-group">
						<label for="profil-password">Kata Sandi <span class="text-danger">*) kosongi jika tidak ingin mengubah kata sandi</span></label>
						<input type="password" name="password" id="profil-password" class="form-control" placeholder="Masukkan kata sandi">
						<div id="error-profil-password"></div>
					</div>
					<div class="form-group">
						<label for="profil-password_confirmation">Konfirmasi Kata Sandi <span class="text-danger">*)</span></label>
						<input type="password" name="password_confirmation" id="profil-password_confirmation" class="form-control" placeholder="Masukkan konfirmasi kata sandi">
						<div id="error-profil-password_confirmation"></div>
					</div>
					<div class="form-group">
						<label for="photo">Photo</span></label>
						<input type="file" class="form-control" name="gambar" id="gambar" value="">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
				<button type="submit" form="form-profil" class="btn bg-theme-custom text-white waves-effect waves-light btn-submit"><i class="bx bx-check-circle"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            <script type="text/javascript">
              $('#form-profil').on('submit', function (e) {
                e.preventDefault();

                let data = new FormData(this);
                //	data.append(CSRF.token_name, CSRF.hash);
                //alert(data);    
                $.ajax({
                  url: "<?php echo base_url('welcome/editProfilBiasa');?>", //$(this).prop('action'),
                  type: "POST",
                  data: data,
                  dataType: 'json',
                  processData: false,
                  contentType: false,
                  //async:true,
                  //crossDomain:true,
                  success: (res) => {

                    if (res.status == 'sukses') {
                      alert("Data berhasil update ");
                      location.reload()
                    } else {
                      toastrError('Gagal', 'Terjadi kesalahan data');
                    }
                  },
                  error: (res) => {
                    if (JSON.stringify(res.status) == 500) {
                      alert("Terjadi kesalahan di server!");
                    } else {
                      alert("Simpan data berhasil");
                      history.go(-1);
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
<!-- End modal profil -->
