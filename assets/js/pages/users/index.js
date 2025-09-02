let table;
$(() => {
	$('#modal-tambah').on('hide.bs.modal', function (event) {
		$('#form-tambah-user').trigger('reset')
		validator.tambah.resetForm()
	})

	$('#modal-ubah').on('hide.bs.modal', function (event) {
		$('#form-ubah-user').trigger('reset')
		$('#form-ubah-user').data('id', null)
		validator.ubah.resetForm()
	})

	$('#form-ubah-role').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
		data.append(CSRF.token_name, CSRF.hash)

		$.ajax({
			url: $(this).prop('action'),
			type: $(this).prop('method'),
			data: data,
			dataType: 'json',
			processData: false,
			contentType: false,
			beforeSend: () => {
				$(this).find('.btn-submit').fadeOut();
			},
			success: (res) => {
				$(this).find('.btn-submit').fadeIn();
				toastrSuccess('Sukses', res.message);

				table.ajax.reload();
				$('.checkbox-role').prop('checked', false);
				$('#modal-ubah-role').modal('hide');
				CSRF.token_name = res.csrf.token_name
				CSRF.hash = res.csrf.hash
			},
			error: (res) => {
				$(this).find('.btn-submit').fadeIn();
				toastrError('Gagal', 'Terjadi kesalahan di server');
				table.ajax.reload();
			}
		})
	})

	$('#table-data').on('click', '.btn-roles', function () {
		let tr = $(this).closest('tr');
		let data = table.row(tr).data();

		let { id, roles, nama } = data;

		if (roles) {
			roles = roles.split(',');
			for (const role of roles) {
				$('#roles-' + role).prop('checked', true);
			}
		}

		$('input[name=id]').val(id);
		$('.nama').text(nama);

		$('#modal-ubah-role').modal('show');
	})

	$('#table-data').on('click', '.btn-remove', function () {
		let tr = $(this).closest('tr');
		let data = table.row(tr).data();

		let { id, nama } = data;

		Swal.fire({
			title: 'Anda yakin?',
			html: `Anda akan menghapus user "<b>${nama}</b>"!`,
			footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
			reverseButtons: true,
		}).then((result) => {
			if (result.isConfirmed) {
				$.post(BASE_URL + 'users/deleteUser/' + MENU_ID, { id, [CSRF.token_name]: CSRF.hash }).done((res) => {
					if (res.status) {
						toastrSuccess('Sukses', res.message);
						table.ajax.reload();
						loadSidebar();
					}

					CSRF.token_name = res.csrf.token_name
					CSRF.hash = res.csrf.hash
				}).fail((res) => {
					toastrError('Gagal', 'Terjadi kesalahan di server');
				})
			}
		})
	})

	$('#table-data').on('click', '.btn-reset', function () {
		let id = $(this).data('id');
		let tr = $(this).closest('tr');
		let data = table.row(tr).data();

		let { username, nama } = data;

		Swal.fire({
			title: 'Anda yakin?',
			html: `Anda akan mereset password untuk pengguna "<b>${nama}</b>"!`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, Reset!',
			cancelButtonText: 'Batal',
			reverseButtons: true,
		}).then((result) => {
			if (result.isConfirmed) {
				$.post(BASE_URL + 'users/resetPassword/' + MENU_ID, { id, [CSRF.token_name]: CSRF.hash }).done((res) => {
					if (res.status) {
						toastrSuccess('Sukses', res.message);
						table.ajax.reload();
						loadSidebar();
					}

					CSRF.token_name = res.csrf.token_name
					CSRF.hash = res.csrf.hash
				}).fail((res) => {
					toastrError('Gagal', 'Terjadi kesalahan di server');
				})
			}
		})
	})

	$('#table-data').on('change', '.change-active', function () {
		let id = $(this).data('user_id');
		let checked = $(this).prop('checked');

		$.post(BASE_URL + 'users/changeUserActive/' + MENU_ID, { id, val: (checked ? 1 : 0), [CSRF.token_name]: CSRF.hash }).done((res) => {
			if (res.status) {
				toastrSuccess('Sukses', res.message);
				table.ajax.reload();
				CSRF.token_name = res.csrf.token_name
				CSRF.hash = res.csrf.hash
			}

		}).fail((res) => {
			toastrError('Gagal', 'Terjadi kesalahan');
			table.ajax.reload();
		})
	})

	$('#form-ubah-user').on('submit', function (e) {
		e.preventDefault();

		if (!$(this).valid()) {
			validator.ubah.focusInvalid()
			return;
		}

		let data = new FormData(this);
		data.append(CSRF.token_name, CSRF.hash)

		$.ajax({
			url: $(this).prop('action'),
			type: $(this).prop('method'),
			data: data,
			dataType: 'json',
			processData: false,
			contentType: false,
			beforeSend: () => {
				$(this).find('.btn-submit').fadeOut();
			},
			success: (res) => {
				$(this).find('.btn-submit').fadeIn();

				if (res.status) {
					toastrSuccess('Sukses', res.message);
				} else {
					toastrError('Gagal', 'Terjadi kesalahan');
				}
				CSRF.token_name = res.csrf.token_name
				CSRF.hash = res.csrf.hash
				$(this)[0].reset();
				$('#modal-ubah-user').modal('hide');
				table.ajax.reload();
			},
			error: (res) => {
				$(this).find('.btn-submit').fadeIn();
				toastrError('Gagal', 'Terjadi kesalahan di server');
				table.ajax.reload();
			}
		})
	})

	$('#table-data').on('click', '.btn-update', function () {
    	let tr = $(this).closest('tr');
		let data = table.row(tr).data();

		$('#form-ubah-user')[0].reset();

		let { id, username, nama, email } = data;

		$('input[name=id]').val(id);
		$('#ubah-username').val(username);
		$('#ubah-nama').val(nama);
		$('#ubah-email').val(email);

		$('#modal-ubah-user').modal('show');
	})

	$('#form-tambah-user').on('submit', function (e) {
		e.preventDefault();

		if (!$(this).valid()) {
			validator.tambah.focusInvalid()
			return;
		}

		let data = new FormData(this);
		data.append(CSRF.token_name, CSRF.hash)

		$.ajax({
			url: $(this).prop('action'),
			type: $(this).prop('method'),
			data: data,
			dataType: 'json',
			processData: false,
			contentType: false,
			beforeSend: () => {
				$(this).find('.btn-submit').fadeOut();
			},
			success: (res) => {
				$(this).find('.btn-submit').fadeIn();

				if (res.status) {
					toastrSuccess('Sukses', res.message);
				} else {
					toastrError('Gagal', 'Terjadi kesalahan');
				}
				CSRF.token_name = res.csrf.token_name
				CSRF.hash = res.csrf.hash

				$(this)[0].reset();
				$('#modal-tambah-user').modal('hide');
				table.ajax.reload();
			},
			error: (res) => {
				$(this).find('.btn-submit').fadeIn();
				toastrError('Gagal', 'Terjadi kesalahan di server');
				table.ajax.reload();
			}
		})
	})

	$('.btn-tambah').on('click', function () {
		$('#form-tambah-user')[0].reset();
		$('#modal-tambah-user').modal('show');
	})

	table = $('#table-data').DataTable({
		serverSide: true,
		processing: true,
		language: dtLang,
		ajax: {
			url: BASE_URL + 'users/data/' + MENU_ID,
			type: 'get',
			dataType: 'json'
		},
		order: [[5, 'desc']],
		columnDefs: [{
			targets: [0, 4, 5],
			searchable: false,
			orderable: false,
			className: 'text-center align-top w-5'
		}, {
			targets: [1, 2],
			className: 'text-left align-top'
		}, {
			targets: [5],
			visible: false,
		}],
		columns: [{
			data: 'no',
			render: (data) => {
				return data + '.'
			}
		}, {
			data: 'username',
			render: (data, type, row) => `<h6 class="mb-1 font-size-14 font-weight-bold">${data}</h6>
            <h6 class="badge badge-custom font-size-12">${row.email}</h6>`
		}, {
			data: 'nama'
		}, {
			data: 'is_active',
			render: (data, type, row) => {
				let { id } = row;
				return `
                <div class="custom-control custom-switch mb-3" dir="ltr">
                    <input type="checkbox" class="custom-control-input change-active" name="active-${id}" id="active-${id}" data-user_id="${id}" ${data == '1' ? 'checked' : ''}>
                    <label class="custom-control-label" for="active-${id}">${data == '1' ? 'Aktif' : 'Nonaktif'}</label>
                </div>
                `;
			}
		}, {
			data: 'id',
			render: (id) => {
				let button_reset_pass = '', button_roles = '', button_edit = '', button_delete = '';
				if (UPDATE_ACCESS) {
					button_reset_pass = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-key'
						}),
						class: 'btn btn-outline-warning btn-reset',
						type: 'button',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Reset Password',
					});

					button_roles = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-shield-quarter'
						}),
						class: 'btn btn-outline-success btn-roles',
						type: 'button',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Ubah otoritas pengguna'
					});

					button_edit = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-pencil'
						}).prop('outerHTML'),
						class: 'btn btn-outline-info btn-update',
						type: 'button',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Ubah Data'
					})
				}

				if (DELETE_ACCESS) {
					button_delete = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-trash'
						}).prop('outerHTML'),
						class: 'btn btn-outline-danger btn-remove',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Hapus Data'
					});
				}

				return $('<div>', {
					class: 'btn-group',
					html: [button_reset_pass, button_roles, button_edit, button_delete]
				}).prop('outerHTML');
			}
		}, {
			data: 'created_at'
		}]

	})
})

const validator = {
	tambah: $('#form-tambah-user').validate({
		errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
		errorElement: 'div',
		errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
		highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
		unhighlight: (element) => $(element).removeClass('is-invalid'),
		success: (element) => $(element).remove(),
		rules: {
			///username: "required",
            username: {
				"required": true,
				"minlength": 6,
			},
			nama: "required",
			email: "required",
			password: {
				"required": true,
				"minlength": 6,
			},
			password_confirmation: {
				"required": true,
				"minlength": 6,
				"equalTo": '#password',
			},
		},
		messages: {
			///username: "Username tidak boleh kosong",
			nama: "Nama lengkap tidak boleh kosong",
			email: "Email lengkap tidak boleh kosong",
			username: {
				"required": "username tidak boleh kosong",
				"minlength": "username minimal 6 karakter",
			},password: {
				"required": "Kata sandi tidak boleh kosong",
				"minlength": "Kata sandi minimal 6 karakter",
			},
			password_confirmation: {
				"required": "Konfirmasi kata sandi tidak boleh kosong",
				"minlength": "Konfirmasi kata sandi minimal 6 karakter",
				"equalTo": "Konfirmasi kata sandi tidak sama",
			},
		}
	}),

	ubah: $('#form-ubah-user').validate({
		errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
		errorElement: 'div',
		errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
		highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
		unhighlight: (element) => $(element).removeClass('is-invalid'),
		success: (element) => $(element).remove(),
		rules: {
			///username: "required",
            username: {
				"required": true,
				"minlength": 6,
			},
			nama: "required",
			email: "required",
		},
		messages: {
			///username: "Username tidak boleh kosong",
            username: {
				"required": "username tidak boleh kosong",
				"minlength": "username minimal 6 karakter",
			},
			nama: "Nama lengkap tidak boleh kosong",
			//email: "required",
            email: {
				"required": "Email tidak boleh kosong",
			}
		}
	}),
}
