<script>
	let datatable
$(() => {
	load_datatable()
})

const load_datatable = () => {
	$('#datatable-wrapper').html(
		`<table class="table table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
            <thead class="bg-theme-custom-dark bg-custom-thead text-white">
                <tr>
                    <th style="width: 5%;" class="align-middle text-center">#</th>
                    <th> Nama </th> 
                    <th style="width: 10%" class="align-middle text-center">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>`
	)

	datatable = $('#table-data').DataTable({
		serverSide: true,
		processing: true,
		language: dtLang,
		scrollX: true,
		dom: dtDom,
		buttons: {
			buttons: [
				{
					className: 'btn bg-theme-custom text-white btn-rounded waves-effect waves-light btn-tambah',
					text: $('<i>', {
						class: 'bx bx-plus-circle'
					}).prop('outerHTML') + ' Tambah', // Tambah Data
					action: (e, dt, node, config) => $('#modal-tambah').modal('show')
				},
			],
			dom: {
				button: {
					className: 'btn'
				},
				buttonLiner: {
					tag: null
				}
			}
		},
		ajax: {
			url: base_url('data'),
			type: 'POST',
			dataType: 'json',
			data: function (d) {
				d[CSRF.token_name] = CSRF.hash
			},
			//error: dtErrorHandler,
			complete: function ({ responseJSON }) {
				if (responseJSON) {
					let { csrf } = responseJSON;
					CSRF.token_name = csrf.token_name
					CSRF.hash = csrf.hash
				}
			}
		},
		order: [],
		columnDefs: [{
			targets: [0, -2, -1],
			searchable: false,
			orderable: false,
			className: 'text-center align-top w-5'
		}, {
			targets: [1],
			className: 'text-left align-top'
		}],
		columns: [{
			data: 'no',
			render: (data) => {
				return data + '.'
			}
		}, {
			data: 'nama_jenis',
		}, {
			data: 'id_jenis',
			render: (id_jenis) => {
				let button_edit = '', button_delete = '';

				if (UPDATE_ACCESS) {
					button_edit = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-pencil'
						}).prop('outerHTML'),
						class: 'btn btn-outline-info btn-update',
						type: 'button',
						title: 'Ubah Data'
					})
				}

				if (DELETE_ACCESS) {
					button_delete = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-trash'
						}).prop('outerHTML'),
						class: 'btn btn-outline-danger btn-remove',
						title: 'Hapus Data'
					});
				}

				return $('<div>', {
					class: 'btn-group',
					html: [button_edit, button_delete]
				}).prop('outerHTML');
			}
		}],
		initComplete: async function () {

			$('#modal-tambah').on('hide.bs.modal', function (event) {
				$('#form-tambah').trigger('reset')
				validator.tambah.resetForm()
			})

			$('#form-tambah').on('submit', function (event) {
				event.preventDefault();
				if (!$(this).valid()) {
					validator.tambah.focusInvalid()
					return;
				}

				// Before send
				$(this).find('.btn-submit').fadeOut();
				$(this).LoadingOverlay('show')
				// ------------------------------------------------				

				let formData = new FormData(this);
				formData.append(CSRF.token_name, CSRF.hash)

				fetch(base_url('store'), {
					method: 'POST',
					body: formData
				}).then(res => {	// Success
					let { message, code, csrf } = res

					if (code === 200) toastrSuccess('Sukses', message);
					else if (code === 404) toastrError('Gagal', message);
					else if (code === 422) toastrError('Gagal', message);

					CSRF.token_name = csrf.token_name
					CSRF.hash = csrf.hash
					datatable.ajax.reload(null, false);
					// ------------------------------------------------
				}).catch(err => {	// Error
					let { message } = err;
					toastrError('Gagal', message);
					// ------------------------------------------------
				}).finally(() => { // Complete
					$('#modal-tambah').modal('hide');
					$(this).find('.btn-submit').fadeIn();
					$(this).LoadingOverlay('hide')
					// ------------------------------------------------
				})
			})

			$(this).on('click', '.btn-update', function (event) {
				let tr = $(this).closest('tr');
				let data = datatable.row(tr).data();
				$('#ubah-id').val(data.id_jenis)
				$('#ubah-nama').val(data.nama_jenis)
				$('#modal-ubah').modal('show')
			})

			$('#modal-ubah').on('hide.bs.modal', function (event) {
				$('#form-ubah').trigger('reset')
				$('#form-ubah').data('id', null)
				validator.tambah.resetForm()
			})

			$('#form-ubah').on('submit', function (event) {
				event.preventDefault();
				if (!$(this).valid()) {
					validator.ubah.focusInvalid()
					return;
				}

				// Before send
				$(this).find('.btn-submit').fadeOut();
				$(this).LoadingOverlay('show')
				// ------------------------------------------------

				let formData = new FormData(this);
				formData.append(CSRF.token_name, CSRF.hash)

				fetch(base_url('update'), {
					method: 'POST',
					body: formData
				}).then(res => {	// Success
					let { message, code, csrf } = res

					if (code === 200) toastrSuccess('Sukses', message);
					else if (code === 404) toastrError('Gagal', message);
					else if (code === 422) toastrError('Gagal', message);

					CSRF.token_name = csrf.token_name
					CSRF.hash = csrf.hash
					datatable.ajax.reload(null, false);
					// ------------------------------------------------
				}).catch(err => {	// Error
					let { message } = err;
					toastrError('Gagal', message);
					// ------------------------------------------------
				}).finally(() => { // Complete
					$('#modal-ubah').modal('hide');
					$(this).find('.btn-submit').fadeIn();
					$(this).LoadingOverlay('hide')
					// ------------------------------------------------
				})
			})

			$(this).on('click', '.btn-remove', function (event) {
				event.preventDefault()

				let tr = $(this).closest('tr');
				let data = datatable.row(tr).data();


				let { id_jenis } = data;
				console.log(id_jenis);

				Swal.fire({
					title: 'Apakah anda yakin?',
					html: `Data akan segera dihapus!`,
					footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
					icon: 'question',
					showCancelButton: true,
					confirmButtonText: 'Ya, Hapus!',
					cancelButtonText: 'Batal',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {

						fetch(base_url('delete'), {
							method: 'POST',
							body: { id_jenis, [CSRF.token_name]: CSRF.hash }
						}).then(res => {	// Success
							let { message, code, csrf } = res

							if (code === 200) toastrSuccess('Sukses', message);
							else if (code === 404) toastrError('Gagal', message);
							else if (code === 422) toastrError('Gagal', message);

							CSRF.token_name = csrf.token_name
							CSRF.hash = csrf.hash
							datatable.ajax.reload(null, false);
							// ------------------------------------------------
						}).catch(err => {	// Error
							let { message } = err;
							toastrError('Gagal', message);
							// ------------------------------------------------
						}).finally(() => { // Complete
							// ------------------------------------------------
						})
					}
				})
			})
		}
	})
}

const validator = {
	tambah: $('#form-tambah').validate({
		errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
		errorElement: 'div',
		errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
		highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
		unhighlight: (element) => $(element).removeClass('is-invalid'),
		success: (element) => $(element).remove(),
		rules: {
			nama: "required",

		},
		messages: {
			nama: "Jenis Dokumen menu tidak boleh kosong",
		}
	}),
	ubah: $('#form-ubah').validate({
		errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
		errorElement: 'div',
		errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
		highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
		unhighlight: (element) => $(element).removeClass('is-invalid'),
		success: (element) => $(element).remove(),
		rules: {
			nama: "required",
		},
		messages: {
			nama: "Jenis Dokumen menu tidak boleh kosong",
		}
	})
}
</script>